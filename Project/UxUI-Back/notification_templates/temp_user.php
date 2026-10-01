<!DOCTYPE html>
<html>

<head>
  <meta charset='UTF-8'>
  <title>Bank Deposit Approval</title>
</head>

<body>

  <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; background-color: #f9f9f9;'>
    <div style='max-width: 700px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);'>

      <h2 style='text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 30px; color:#007BFF;'>
        Payment Receipt
      </h2>

      <p style='margin-bottom: 15px; text-align: left;'>
        Dear <strong> $member_name </strong>,
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
          <td style='padding: 8px; font-weight: bold;'> $total </td>
        </tr>
      </table>

      <!-- Pay Online Button -->
      <div style='text-align: center; margin-top: 30px;'>
        <a href='  $payment_link '
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
</body>

</html>