<?php
class notification_template_bank_deposit_aprrove_user
{
  private $form_url = "https://www.bmjm.lk/UxUi/Verification-Process/bank_deposit_varification_receipt_user.php";
  public function __construct($encrypt_wwjm_payment_slip_id)
  {
    $company_obj = new Company_Info_Variable_List();

    $this->form_url = $company_obj->get_app_URL() . "/UxUi/Verification-Process/bank_deposit_varification_receipt_user.php?id=" . $encrypt_wwjm_payment_slip_id;
  }


  public function sending_form_by_email($bank_name, $branch_name, $bank_no, $amount, $member_name)
  {
    $company_obj = new Company_Info_Variable_List();
    $form_url = $company_obj->get_app_URL() . "";

    $form_str = "
<div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; background-color: #f9f9f9;'>
  <div style='max-width: 700px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);'>

    <h2 style='text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 30px; color:#28a745;'>
      Payment Accepted Notification
    </h2>

    <p style='margin-bottom: 15px; text-align: left;'>
      Dear <strong>" . $member_name . "</strong>,
    </p>

    <p style='margin-bottom: 20px; text-align: left;'>
      We are pleased to inform you that your bank deposit payment has been <strong style='color:#28a745;'>successfully accepted</strong>.
      Below are the details of your transaction for your reference:
    </p>

    <table style='width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size:14px;'>
      <tr>
        <td style='width: 180px; padding: 8px;'>User Name</td>
        <td style='padding: 8px;'>:</td>
        <td style='padding: 8px;'>" . $member_name . "</td>
      </tr>
      <tr>
        <td style='padding: 8px;'>Bank Account No</td>
        <td style='padding: 8px;'>:</td>
        <td style='padding: 8px;'>" . $bank_no . "</td>
      </tr>
      <tr>
        <td style='padding: 8px;'>Bank Name</td>
        <td style='padding: 8px;'>:</td>
        <td style='padding: 8px;'>" . $bank_name . "</td>
      </tr>
      <tr>
        <td style='padding: 8px;'>Branch</td>
        <td style='padding: 8px;'>:</td>
        <td style='padding: 8px;'>" . $branch_name . "</td>
      </tr>
      <tr>
        <td style='padding: 8px;'>Amount</td>
        <td style='padding: 8px;'>:</td>
        <td style='padding: 8px;'>" . $amount . "</td>
      </tr>
    </table>

    <p style='margin-bottom: 20px; text-align: left;'>
      Thank you for your payment. You can view the receipt by clicking the button below.
    </p>

    <!-- Button Section -->
    <div style='text-align: center; margin-top: 40px;'>
      <a href='" . $this->form_url . "'
         style='display: inline-block; background-color: #007BFF; color: #fff; text-decoration: none; 
                padding: 12px 24px; border-radius: 5px; font-weight: bold; font-size: 14px;'>
         View Receipt
      </a>
    </div>

    <p style='margin-top: 30px; font-size: 12px; text-align: center; color:#777;'>
      This is an automated message. Please do not reply directly to this email.
    </p>

  </div>
</div>
";



    return $form_str;
  }
  public function email_subject()
  {
    return "Payment Approved";
  }


  public function form_by_sms()
  {

    $sms = 'Your payment has been successfully received. Thank you for your transaction. (' . $this->form_url . ')';
    return $sms;
  }
}
