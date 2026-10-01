<?php
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_Sec_id_SINGLE_DATA.php';

class notification_for_send_details_IPG
{

  private $form_url = "https://www.bmjm.lk/UxUi/Payment_IPG/IPG_Pay_form_sec_Pass.php";

  private function get_base_url($company_obj)
  {
    $base_url = trim((string)$company_obj->get_app_URL());

    if ($base_url === "") {
      $base_url = trim((string)$company_obj->get_compnay_full_web());
    }

    if ($base_url === "" || $base_url === "http://www.bmjm.lk" || $base_url === "http://www.bmjm.lk/") {
      $base_url = "https://www.bmjm.lk";
    }

    return rtrim($base_url, "/");
  }

  public function __construct($get_IPG_sec_encript_id)
  {
    $company_obj = new Company_Info_Variable_List();
    $base_url = $this->get_base_url($company_obj);
    
    $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
    $Advance_Security_obj = new Advance_Security();
    $decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $get_IPG_sec_encript_id);
    
    $ipg_data = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($decrypted_sec_id);
    
    if ($ipg_data->get_state() && $ipg_data->get_is_projcet() == "1") {
        $cache_file = __DIR__ . '/../../../View-List/Payment_gateway/OnePay/project_ipg_cache.json';
        $cache = file_exists($cache_file) ? json_decode(file_get_contents($cache_file), true) : [];
        $project_id = isset($cache[(string)$ipg_data->get_id()]) ? $cache[(string)$ipg_data->get_id()]['id'] : null;

        if ($project_id) {
            $public_project_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $project_id);
            $this->form_url = $base_url . "/UxUi/Payment_IPG/Project_IPG_Pay_form.php?public_project_id=" . urlencode($public_project_id) . "&pre_amount=" . $ipg_data->get_transation_amount();
        } else {
            $this->form_url = $base_url . "/UxUi/Payment_IPG/Project_IPG_Pay_form.php?id=" . urlencode($get_IPG_sec_encript_id);
        }
    } else {
        $this->form_url = $base_url . "/UxUi/Payment_IPG/IPG_Pay_form_sec_Pass.php?id=" . urlencode($get_IPG_sec_encript_id);
    }
  }



  public function sending_form_by_email($member_name, $member_phone, $member_address, $amount)
  {
    $company_obj = new Company_Info_Variable_List();


    $form_str = "   

        <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; background-color: #f9f9f9;'>
    <div style='max-width: 700px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);'>

      <h2 style='text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 30px; color:#007BFF;'>
        Payment Receipt
      </h2>

      <p style='margin-bottom: 15px; text-align: left;'>
        Dear <strong>.  $member_name .  </strong>,
      </p>

      <p style='margin-bottom: 20px; text-align: left;'>
        Here are the details of your recent transaction:
      </p>

      <table style='width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size:14px;'>
        <tr>
          <td style='width: 180px; padding: 8px;'>Name</td>
          <td style='padding: 8px;'>:</td>
          <td style='padding: 8px;'> $member_name </td>
        </tr>
        <tr>
          <td style='padding: 8px;'>Phone Number</td>
          <td style='padding: 8px;'>:</td>
          <td style='padding: 8px;'> $member_phone </td>
        </tr>
        <tr>
          <td style='padding: 8px;'>Address</td>
          <td style='padding: 8px;'>:</td>
          <td style='padding: 8px;'> $member_address</td>
        </tr>
        <tr>
          <td style='padding: 8px;'>Amount</td>
          <td style='padding: 8px;'>:</td>
          <td style='padding: 8px;'> $amount</td>
        </tr>
        <tr>
          <td style='padding: 8px; font-weight: bold;'>Total</td>
          <td style='padding: 8px;'>:</td>
          <td style='padding: 8px; font-weight: bold;'> $amount </td>
        </tr>
      </table>

      <!-- Pay Online Button -->
      <div style='text-align: center; margin-top: 30px;'>
        <a href='.$this->form_url.'
          style='display: inline-block; background-color: #28a745; color: #fff; text-decoration: none; 
                  padding: 12px 24px; border-radius: 5px; font-weight: bold; font-size: 14px;'>
          Pay Online Now
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
    return "IPG Payment Email";
  }


  public function form_by_sms($member_name, $member_phone, $member_address, $amount)
  {
    $formatted_amount = number_format((float)$amount, 2, '.', ',');
    $sms = "bmjm Payment Link\nDear $member_name,\nAmount: LKR $formatted_amount\nPay here: $this->form_url\nThank you.";

    return $sms;
  }


  public function from_whatsup($member_name, $member_phone)
  {
    return "https://api.whatsapp.com/send/?phone=%2B94" . $member_phone . "&text=" . "Hi " . $member_name . " Click this link and you can do the payment now(" . urlencode($this->form_url) . ")";
  }

  public function form_by_IPG_QR_scan()
  {
    return $this->form_url;
  }


  public function form_by_url()
  {

    // return $this->form_url;
  }
}
