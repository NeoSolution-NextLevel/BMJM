<?php
class notification_for_member_cash_subcription
{

    // private $form_url = "https://www.wbmjm.lk/UxUi/Registration-form-mangment-approve.php";
    public function __construct()
    {
        $company_obj = new Company_Info_Variable_List();
    }



    public function sending_form_by_email($reason, $amount, $total)
    {
        $company_obj = new Company_Info_Variable_List();


        $form_str = "   
         
    <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;'>

        <!-- Main container -->
        <div style='max-width: 650px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

            <!-- Header -->
            <div style='text-align: center; margin-bottom: 25px;'>
                <img src='" . $company_obj->get_compnay_logo_url() . "' alt='Company Logo' style='width:120px; margin-bottom:10px;'>
                <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>Payment Receipt</h2>
            </div>

            <!-- Company Info -->
            <div style='text-align: center; font-size: 14px; color: #555; margin-bottom: 15px;'>
                " . implode(', ', array_filter([
            $company_obj->get_address_line_01(),
            $company_obj->get_address_line_02(),
            $company_obj->get_address_line_03(),
            $company_obj->get_address_street(),
            $company_obj->get_address_city()
        ])) . "<br>
                " . implode(' / ', array_filter([
            $company_obj->get_compnay_phone(),
            $company_obj->get_system_infom_email()
        ])) . "
            </div>

            <!-- Payment Details -->
            <div style='margin: 25px 0;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 16px;'>
                    <tr style='background-color: #f2f2f2; font-weight: bold;'>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: center;'>Reason</th>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: center;'>Amount</th>
                    </tr>
                    <tr>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . $reason . "</td>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . $amount . "</td>
                    </tr>
                    <tr style='background-color: #e0e0e0; font-weight: bold;'>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>Total</td>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . $total . "</td>
                    </tr>
                </table>
            </div>

            <!-- Thank You -->
            <div style='text-align: center; font-size: 18px; margin-top: 25px; color: #333;'>
                Thank You
            </div>

        </div>
    </div>
    ";




        return $form_str;
    }
    public function email_subject($reason)
    {
        return "Payment for Subcrip" + $reason ;
    }


    public function form_by_sms($reason, $amount, $total)
    {

        $sms = "Payment received for " . $reason . ": Rs." . $amount . ". Total: Rs." . $total . ". Thank you!";
        return $sms;
    }

    public function form_by_url()
    {

        // return $this->form_url;
    }
}
