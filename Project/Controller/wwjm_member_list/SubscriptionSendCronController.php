<?php

class SubscriptionSendCronController
{
    private $db;
    private $connection;
    private $companyInfo;
    private $timezone;

    public function __construct()
    {
        $this->db = new DataBase();
        $this->connection = $this->db->get_data_base_connction();
        $this->companyInfo = new Company_Info_Variable_List();
        $this->timezone = new DateTimeZone('Asia/Colombo');
    }

    public function generateForCurrentMonth($dryRun = false, DateTimeImmutable $runDate = null)
    {
        $runDate = $runDate ?: new DateTimeImmutable('now', $this->timezone);
        $billingDate = $this->getBillingDate($runDate);
        $result = [
            'status' => 'success',
            'dry_run' => (bool) $dryRun,
            'run_date' => $runDate->format('Y-m-d H:i:s'),
            'billing_date' => $billingDate->format('Y-m-d'),
            'eligible' => 0,
            'created' => 0,
            'existing' => 0,
            'failed' => 0,
            'email_sent' => 0,
            'sms_sent' => 0,
            'notification_failed' => 0,
            'errors' => [],
        ];

        if ($runDate->format('Y-m-d') < $billingDate->format('Y-m-d')) {
            $result['status'] = 'not_due';
            return $result;
        }

        $members = $this->getEligibleMembers();
        $result['eligible'] = count($members);

        foreach ($members as $member) {
            try {
                if ($this->subscriptionExists((int) $member['id'], $billingDate)) {
                    $result['existing']++;
                    continue;
                }

                if ($dryRun) {
                    $result['created']++;
                    continue;
                }

                $subscriptionId = $this->createSubscription($member, $billingDate, $runDate);
                if (!$subscriptionId) {
                    $result['existing']++;
                    continue;
                }

                $result['created']++;
                $this->sendNotifications($subscriptionId, $member, $billingDate, $result);
            } catch (Throwable $exception) {
                $result['failed']++;
                $message = 'Member ' . (int) $member['id'] . ': ' . $exception->getMessage();
                $result['errors'][] = $message;
                error_log('[Subscription Cron] ' . $message);
            }
        }

        if ($result['failed'] > 0) {
            $result['status'] = 'completed_with_errors';
        }

        return $result;
    }

    private function getBillingDate(DateTimeImmutable $runDate)
    {
        $configuredDay = (int) $this->companyInfo->get_subscription_cron_run_month_date();
        $configuredDay = max(1, min($configuredDay, (int) $runDate->format('t')));

        return $runDate->setDate(
            (int) $runDate->format('Y'),
            (int) $runDate->format('m'),
            $configuredDay
        )->setTime(0, 0, 0);
    }

    private function getEligibleMembers()
    {
        $sql = "SELECT id, name_M, membership_no, email, notification_moible_no,
                       secondry_mobile, notification_whatup, monlty_payment
                FROM wwjm_member_list
                WHERE ast = 1
                  AND active_state = 1
                  AND account_type_subcrption = 1
                  AND IFNULL(monlty_payment, 0) > 0
                ORDER BY id";
        $query = $this->connection->query($sql);
        $members = [];

        while ($row = $query->fetch_assoc()) {
            $members[] = $row;
        }

        return $members;
    }

    private function subscriptionExists($memberId, DateTimeImmutable $billingDate)
    {
        $statement = $this->connection->prepare(
            'SELECT id FROM wwjm_subscription
             WHERE wwjm_member_list_id = ?
               AND YEAR(genarate_date) = ?
               AND MONTH(genarate_date) = ?
             LIMIT 1'
        );
        $year = (int) $billingDate->format('Y');
        $month = (int) $billingDate->format('m');
        $statement->bind_param('iii', $memberId, $year, $month);
        $statement->execute();
        $statement->store_result();
        $exists = $statement->num_rows > 0;
        $statement->close();

        return $exists;
    }

    private function createSubscription(array $member, DateTimeImmutable $billingDate, DateTimeImmutable $runDate)
    {
        $memberId = (int) $member['id'];
        $amount = (float) $member['monlty_payment'];
        $date = $billingDate->format('Y-m-d');
        $createdAt = $runDate->format('Y-m-d H:i:s');
        $description = 'Monthly subscription for ' . $billingDate->format('F Y');

        $this->connection->begin_transaction();

        try {
            $statement = $this->connection->prepare(
                'INSERT INTO wwjm_subscription
                    (genarate_date, sdt, ast, disption_pay, crt_amount, dbt_amount,
                     wwjm_member_list_id, sms_send_state, email_send_state)
                 VALUES (?, ?, 1, ?, 0, ?, ?, 0, 0)'
            );
            $statement->bind_param('sssdi', $date, $createdAt, $description, $amount, $memberId);
            $statement->execute();
            $subscriptionId = (int) $this->connection->insert_id;
            $statement->close();

            $statement = $this->connection->prepare(
                'UPDATE wwjm_member_list
                 SET due_to_pay = IFNULL(due_to_pay, 0) + ?
                 WHERE id = ?'
            );
            $statement->bind_param('di', $amount, $memberId);
            $statement->execute();

            if ($statement->affected_rows !== 1) {
                throw new RuntimeException('Member balance could not be updated.');
            }

            $statement->close();
            $this->connection->commit();
            return $subscriptionId;
        } catch (mysqli_sql_exception $exception) {
            $this->connection->rollback();

            if ((int) $exception->getCode() === 1062) {
                return 0;
            }

            throw $exception;
        } catch (Throwable $exception) {
            $this->connection->rollback();
            throw $exception;
        }
    }

    private function sendNotifications($subscriptionId, array $member, DateTimeImmutable $billingDate, array &$result)
    {
        $memberName = trim((string) $member['name_M']);
        $amount = number_format((float) $member['monlty_payment'], 2);
        $currency = $this->companyInfo->get_default_currency();
        $month = $billingDate->format('F Y');
        $subject = 'Monthly subscription - ' . $month;
        $message = "Dear {$memberName}, your {$month} mosque subscription of {$currency} {$amount} has been added to your account.";

        $email = trim((string) $member['email']);
        if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                $html = '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
                $mailer = new Email($email, $subject, $html);
                if ($mailer->send_email()) {
                    $this->markNotificationSent($subscriptionId, 'email_send_state');
                    $result['email_sent']++;
                } else {
                    $result['notification_failed']++;
                    error_log('[Subscription Cron] Email failed for member ' . (int) $member['id']);
                }
            } catch (Throwable $exception) {
                $result['notification_failed']++;
                error_log('[Subscription Cron] Email error for member ' . (int) $member['id'] . ': ' . $exception->getMessage());
            }
        }

        $phone = $this->getMemberPhone($member);
        if ($phone !== '') {
            try {
                $sms = new SMS_Sending($phone, $message);
                $response = $sms->send_message();
                if ($this->smsWasSuccessful($response)) {
                    $this->markNotificationSent($subscriptionId, 'sms_send_state');
                    $result['sms_sent']++;
                } else {
                    $result['notification_failed']++;
                    error_log('[Subscription Cron] SMS failed for member ' . (int) $member['id'] . ': ' . (string) $response);
                }
            } catch (Throwable $exception) {
                $result['notification_failed']++;
                error_log('[Subscription Cron] SMS error for member ' . (int) $member['id'] . ': ' . $exception->getMessage());
            }
        }
    }

    private function getMemberPhone(array $member)
    {
        foreach (['notification_moible_no', 'secondry_mobile', 'notification_whatup'] as $column) {
            $phone = preg_replace('/[^0-9+]/', '', trim((string) $member[$column]));
            if (strlen(preg_replace('/[^0-9]/', '', $phone)) >= 9) {
                return $phone;
            }
        }

        return '';
    }

    private function smsWasSuccessful($response)
    {
        if ($response === false || trim((string) $response) === '') {
            return false;
        }

        $data = json_decode((string) $response, true);
        if (is_array($data) && isset($data['status'])) {
            return !in_array(strtolower((string) $data['status']), ['error', 'failed', 'false'], true);
        }

        return stripos((string) $response, 'error') === false;
    }

    private function markNotificationSent($subscriptionId, $column)
    {
        if (!in_array($column, ['sms_send_state', 'email_send_state'], true)) {
            throw new InvalidArgumentException('Invalid notification state column.');
        }

        $statement = $this->connection->prepare(
            "UPDATE wwjm_subscription SET {$column} = 1 WHERE id = ?"
        );
        $statement->bind_param('i', $subscriptionId);
        $statement->execute();
        $statement->close();
    }
}
