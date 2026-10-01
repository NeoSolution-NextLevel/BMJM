<?php

class main_dashboard_summary
{
    public function get_summary()
    {
        $data_base_obj = new DataBase();
        $summary = array(
            'active_members' => 0,
            'collected_amount' => 0,
            'pending_approvals' => 0,
            'database_status' => 'Connected',
            'server_time' => date('Y-m-d H:i:s')
        );

        $member_result = $data_base_obj->get_result(
            "SELECT COUNT(id) AS total
             FROM wwjm_member_list
             WHERE ast='1' AND active_state='1'"
        );
        if ($member_result && $row = $member_result->fetch_assoc()) {
            $summary['active_members'] = (int) $row['total'];
        }

        $collection_result = $data_base_obj->get_result(
            "SELECT COALESCE(SUM(payment.amount), 0) AS total
             FROM wwjm_payment_slip AS payment
             WHERE payment.ast='1'
               AND YEAR(COALESCE(payment.payment_date, payment.sdt)) = YEAR(CURDATE())
               AND (
                    payment.is_bank_deposit='0'
                    OR EXISTS (
                        SELECT deposit.id
                        FROM wwjm_bank_deposit_slip AS deposit
                        WHERE deposit.wwjm_payment_slip_id=payment.id
                          AND deposit.ast='1'
                          AND deposit.approve_state='1'
                          AND deposit.approve_cancel='0'
                    )
               )"
        );
        if ($collection_result && $row = $collection_result->fetch_assoc()) {
            $summary['collected_amount'] = (float) $row['total'];
        }

        $pending_result = $data_base_obj->get_result(
            "SELECT COUNT(DISTINCT deposit.wwjm_payment_slip_id) AS total
             FROM wwjm_bank_deposit_slip AS deposit
             INNER JOIN wwjm_payment_slip AS payment ON payment.id=deposit.wwjm_payment_slip_id
             WHERE deposit.ast='1'
               AND payment.ast='1'
               AND deposit.approve_state='0'
               AND deposit.approve_cancel='0'"
        );
        if ($pending_result && $row = $pending_result->fetch_assoc()) {
            $summary['pending_approvals'] = (int) $row['total'];
        }

        return $summary;
    }
}
