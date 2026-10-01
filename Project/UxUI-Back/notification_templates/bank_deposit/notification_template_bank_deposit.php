<?php
class notification_template_bank_deposit
{
  private $form_url = "";
  private $person_name = "Member";
  private $amount = "0.00";

  public function __construct($get_payment_encrypted_slip_id, $project_id = 0, $person_name = "Member", $amount = "0.00")
  {
    $company_obj = new Company_Info_Variable_List();
    $base_url = trim($company_obj->get_app_URL()) !== "" ? $company_obj->get_app_URL() : $company_obj->get_compnay_full_web();
    $this->form_url = rtrim($base_url, "/") . "/UxUi/Verification-Process/bank_deposit_varification_manager.php?id=" . $get_payment_encrypted_slip_id . "&project_id=" . $project_id;
    $this->person_name = trim($person_name) !== "" ? trim($person_name) : "Member";
    $this->amount = trim((string)$amount) !== "" ? trim((string)$amount) : "0.00";
  }

  public function sending_form_by_email($bank_name = "", $branch_name = "", $bank_no = "", $amount = "0.00", $person_name = "Member", $membership_no = "", $member_email = "", $member_mobile_no = "", $address = "", $image_pth = "")
  {
    $company_obj = new Company_Info_Variable_List();
    $final_url = $this->form_url;

    $img_full_url = "";
    if (!empty($image_pth)) {
        if (strpos($image_pth, 'http://') === 0 || strpos($image_pth, 'https://') === 0 || strpos($image_pth, 'data:image/') === 0) {
            $img_full_url = $image_pth;
        } else {
            $img_full_url = rtrim($company_obj->get_compnay_full_web(), '/') . '/' . ltrim($image_pth, '/');
        }
    }

    $form_str = "   
    <div style='font-family: Arial, sans-serif; color: #1E2B26; line-height: 1.6; margin: 0; background-color: #FAF7F0; padding: 20px;'>
      <div style='max-width: 680px; margin: 30px auto; background: #ffffff; border-radius: 12px; border: 1px solid #E6E0D0; box-shadow: 0 4px 16px rgba(11,46,36,0.08); overflow: hidden;'>
        
        <!-- Header -->
        <div style='background: linear-gradient(135deg, #123832, #0B2E24); padding: 24px 30px; color: #ffffff;'>
          <h2 style='margin: 0; font-size: 20px; font-weight: bold;'>bmjm Finance Admin Notification</h2>
          <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Bank Deposit Review Required</p>
        </div>

        <div style='padding: 30px;'>
          <p style='font-size: 15px; margin-bottom: 20px;'>
            A new bank deposit receipt has been submitted and is waiting for finance review. Please verify the member details, amount, bank information, and receipt image before approving.
          </p>

          <!-- Customer Details -->
          <h3 style='font-size: 14px; text-transform: uppercase; color: #0B2E24; border-bottom: 2px solid #E6E0D0; padding-bottom: 6px; margin-bottom: 12px;'>Customer / Member Details</h3>
          <table style='width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 14px;'>
            <tr>
              <td style='width: 140px; padding: 6px 0; font-weight: bold;'>Customer Name:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($person_name) . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Membership No:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($membership_no ?: 'N/A') . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Mobile No:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($member_mobile_no ?: 'N/A') . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Email Address:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($member_email ?: 'N/A') . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Address:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($address ?: 'N/A') . "</td>
            </tr>
          </table>

          <!-- Bank Deposit Details -->
          <h3 style='font-size: 14px; text-transform: uppercase; color: #0B2E24; border-bottom: 2px solid #E6E0D0; padding-bottom: 6px; margin-bottom: 12px;'>Bank Account & Deposit Details</h3>
          <table style='width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 14px;'>
            <tr>
              <td style='width: 140px; padding: 6px 0; font-weight: bold;'>Paid Amount:</td>
              <td style='padding: 6px 0; color: #123832; font-size: 16px; font-weight: bold;'>LKR " . htmlspecialchars($amount) . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Deposited Bank:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($bank_name) . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Branch:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($branch_name) . "</td>
            </tr>
            <tr>
              <td style='font-weight: bold; padding: 6px 0;'>Account No:</td>
              <td style='padding: 6px 0;'>" . htmlspecialchars($bank_no) . "</td>
            </tr>
          </table>

          <!-- Receipt Slip Preview Link -->
          " . (!empty($img_full_url) ? "
          <div style='margin-bottom: 24px; background: #FAF7F0; padding: 16px; border-radius: 8px; border: 1px dashed #E6E0D0; text-align: center;'>
            <p style='margin: 0 0 10px; font-weight: bold; font-size: 13px;'>Bank Receipt Slip Attached</p>
            <a href='" . htmlspecialchars($img_full_url) . "' target='_blank' style='color: #B8923D; text-decoration: underline; font-weight: bold;'>View Uploaded Bank Receipt Slip</a>
          </div>" : "") . "

          <!-- Action Approve Button -->
          <div style='text-align: center; margin-top: 30px;'>
            <a href='" . $final_url . "'
              style='display: inline-block; background: linear-gradient(135deg, #C9A227, #B8923D); color: #0B2E24; text-decoration: none; 
                           padding: 14px 32px; border-radius: 8px; font-weight: bold; font-size: 15px; box-shadow: 0 4px 12px rgba(184,146,61,0.3);'>
              Review Bank Deposit
            </a>
          </div>

        </div>
      </div>
    </div>
    ";

    return $form_str;
  }

  public function email_subject()
  {
    return "Review Required: Bank Deposit - bmjm Finance";
  }

  public function form_by_sms()
  {
    $sms = "bmjm Finance Alert\n"
      . "Bank deposit waiting for review.\n"
      . "Member: " . $this->person_name . "\n"
      . "Amount: LKR " . $this->amount . "\n"
      . "Review and approve: " . $this->form_url;
    return $sms;
  }
}
?>
