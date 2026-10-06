<?php
class notification_template_payment_slip
{

  private $form_url = "https://www.bmjm.lk/UxUi/User_dashboard_02_F_view_receipt.php";
  public function __construct($encrypt_wwjm_payment_slip_id)
  {
    $company_obj = new Company_Info_Variable_List();
    $base_url = trim((string) $company_obj->get_app_URL());
    if ($base_url === '') {
      $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
      $scheme = $is_https ? 'https' : 'http';
      $host = isset($_SERVER['HTTP_HOST']) ? preg_replace('/[^A-Za-z0-9.:-]/', '', $_SERVER['HTTP_HOST']) : 'www.bmjm.lk';
      $base_url = $scheme . '://' . $host;
    }
    $this->form_url = rtrim($base_url, '/') . "/UxUi/User_dashboard_02_F_view_receipt.php?id=" . urlencode($encrypt_wwjm_payment_slip_id);
  }


  public function sending_form_by_email($amount, $member_name, $payment_date, $receipt_number = '')
  {
    $safe_name = htmlspecialchars($member_name, ENT_QUOTES, 'UTF-8');
    $safe_amount = htmlspecialchars($amount, ENT_QUOTES, 'UTF-8');
    $safe_date = htmlspecialchars($payment_date, ENT_QUOTES, 'UTF-8');
    $safe_receipt = htmlspecialchars($receipt_number, ENT_QUOTES, 'UTF-8');
    $safe_url = htmlspecialchars($this->form_url, ENT_QUOTES, 'UTF-8');

    return "<div style='font-family:Arial,sans-serif;color:#1E2B26;line-height:1.6;background:#F7F5EF;padding:24px;'>
      <div style='max-width:640px;margin:0 auto;background:#FFFFFF;border:1px solid #E6E0D0;border-radius:8px;overflow:hidden;'>
        <div style='background:#0B2E24;padding:26px 30px;text-align:center;'><h2 style='color:#FFFFFF;font-size:22px;margin:0 0 5px;'>Payment received</h2><p style='color:#E4C766;font-size:13px;margin:0;'>Bambalapitiya Jumma Masjid official receipt</p></div>
        <div style='padding:30px;'><p>Dear <strong>{$safe_name}</strong>,</p><p>Thank you. Your payment has been recorded successfully.</p>
          <table style='width:100%;border-collapse:collapse;margin:24px 0;background:#FAF7F0;'>
            <tr><td style='padding:11px 14px;font-weight:bold;'>Receipt Number</td><td style='padding:11px 14px;'>{$safe_receipt}</td></tr>
            <tr><td style='padding:11px 14px;font-weight:bold;border-top:1px solid #E6E0D0;'>Payment Date</td><td style='padding:11px 14px;border-top:1px solid #E6E0D0;'>{$safe_date}</td></tr>
            <tr><td style='padding:11px 14px;font-weight:bold;border-top:1px solid #E6E0D0;'>Amount Paid</td><td style='padding:11px 14px;font-weight:bold;color:#0B2E24;border-top:1px solid #E6E0D0;'>LKR {$safe_amount}</td></tr>
          </table>
          <div style='text-align:center;margin:30px 0 12px;'><a href='{$safe_url}' style='display:inline-block;background:#C9A227;color:#0B2E24;text-decoration:none;padding:13px 24px;border-radius:6px;font-weight:bold;'>View or Download Receipt</a></div>
          <p style='font-size:12px;text-align:center;color:#6B756F;'>This is an automated payment confirmation. Please keep it for your records.</p>
        </div>
      </div>
    </div>";
  }
  public function email_subject()
  {
    return "BMJM Payment Receipt";
  }


  public function form_by_sms($member_name, $amount = '', $receipt_number = '')
  {
    $message = 'bmjm: Dear ' . $member_name . ', your payment';
    if ($amount !== '') $message .= ' of LKR ' . $amount;
    $message .= ' was received successfully.';
    if ($receipt_number !== '') $message .= ' Receipt ' . $receipt_number . '.';
    return $message . ' View/download: ' . $this->form_url;
  }
}
