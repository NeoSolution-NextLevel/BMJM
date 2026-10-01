<!DOCTYPE html>
<html lang="en">

<head></head>

<body>
  <table width="100%" border="0" cellspacing="0" cellpadding="5"
    style="font-family: Arial, sans-serif; border-collapse: collapse; text-align: center; background-color: #ffffff; color:#000000;"
    id="Member_body_01_01_B_02_need_print">

    <!-- Company Logo -->
    <tr>
      <td colspan="2" style="text-align: center; padding: 10px;">
        <img src="<?php echo $company_obj->get_compnay_logo_url(); ?>" style="width:120px;">
      </td>
    </tr>

    <!-- Address -->
    <tr>
      <td colspan="2" style="font-size: 14px; text-align: center; padding: 5px;">
        <?php
        $address_parts = array_filter([
          $company_obj->get_address_line_01(),
          $company_obj->get_address_line_02(),
          $company_obj->get_address_line_03(),
          $company_obj->get_address_street(),
          $company_obj->get_address_city()
        ]);
        echo implode(', ', $address_parts);
        ?>
      </td>
    </tr>

    <!-- Contact -->
    <tr>
      <td colspan="2" style="font-size: 14px; text-align: center; padding: 5px;">
        <?php
        $phone = $company_obj->get_compnay_phone();
        $email = $company_obj->get_system_infom_email();
        $contact_parts = array_filter([$phone, $email]);
        echo implode(' / ', $contact_parts);
        ?>
      </td>
    </tr>

    <!-- Title -->
    <tr>
      <td colspan="2" style="font-size: 22px; font-weight: bold; text-align: center; padding: 15px 0; border-top: 1px solid #ddd;">
        PAYMENT RECEIPT
      </td>
    </tr>

    <!-- User details -->
    <tr>
      <td colspan="2" style="padding: 15px; text-align:left;">
        <table border="0" width="100%" cellspacing="0" cellpadding="5" style="font-size:14px;">
          <tr>
            <td width="20%" style="text-align:left;"><strong>Name</strong></td>
            <td width="5%">:</td>
            <td><span id="Member_body_01_01_B_02_data_member_name"><?php echo "John Doe"; ?></span></td>
          </tr>
          <tr>
            <td style="text-align:left;"><strong>Mobile</strong></td>
            <td>:</td>
            <td><span id="Member_body_01_01_B_02_data_member_phone"><?php echo "0771234567"; ?></span></td>
          </tr>
          <tr>
            <td style="text-align:left;"><strong>Address</strong></td>
            <td>:</td>
            <td><span id="Member_body_01_01_B_02_data_member_address"><?php echo "45/1, Main Street, Colombo"; ?></span></td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Payment Details -->
    <tr>
      <td colspan="2">
        <center>
          <table width="90%" border="1" cellspacing="0" cellpadding="8"
            style="border-collapse: collapse; font-size:14px; background-color:#ffffff; color:#000000;">

            <!-- Header -->
            <thead>
              <tr>
                <th style="text-align:center; background:#e5e4e2; font-weight:bold;">REASON</th>
                <th style="text-align:center; background:#e5e4e2; font-weight:bold;">AMOUNT - LKR</th>
              </tr>
            </thead>

            <!-- Body -->
            <tbody>
              <tr>
                <td id="Member_body_01_01_B_02_data_resone" style="text-align:center; background:#f9f9f9;">
                  <?php echo "Membership Fee"; ?>
                </td>
                <td id="Member_body_01_01_B_02_data_pay_amount" style="text-align:right; background:#f9f9f9;">
                  <?php echo "1500"; ?>
                </td>
              </tr>
              <tr>
                <td style="text-align:center; background:#f9f9f9;">
                  <?php echo "Donation"; ?>
                </td>
                <td style="text-align:right; background:#f9f9f9;">
                  <?php echo "2000"; ?>
                </td>
              </tr>
            </tbody>

            <!-- Total Row -->
            <tfoot>
              <tr style="font-size:16px; font-weight:bold;">
                <td style="text-align:center; background:#e5e4e2;">TOTAL PAID AMOUNT</td>
                <td id="Member_body_01_01_B_02_data_total" style="text-align:right; background:#e5e4e2;">
                  <?php echo "3500"; ?>
                </td>
              </tr>
            </tfoot>
          </table>
        </center>
      </td>
    </tr>

    <!-- Thank You -->
    <tr>
      <td colspan="2" style="font-size: 20px; font-weight: bold; text-align: center; padding: 20px 0;">
        THANK YOU COME AGAIN
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td colspan="2" style="font-size: 12px; text-align: center; padding: 10px; color:#555;">
        <?php echo $company_obj->get_compnay_footer_txt(); ?>
      </td>
    </tr>
  </table>

</body>

</html>