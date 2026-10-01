<html>

<head></head>

<body>
    <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;'>

        <!-- Main container -->
        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

            <!-- Header -->
            <div style='text-align: center; margin-bottom: 25px;'>
                <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>Member Approval Update</h2>
            </div>

            <!-- Intro text -->
            <div style='margin-bottom: 20px;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                    Dear Admin, <br><br>
                    The following member has successfully completed <strong>Approval Step 1</strong>.
                    Please proceed to the next step (<strong>Approval Step 2</strong>) to continue the process.
                </p>
            </div>

            <!-- User Details Table -->
            <div style='margin-bottom: 25px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 16px; text-align: left;'>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Name</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'>Ramith</td>
                    </tr>
                    <tr>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Address</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'>Egaloya, Bulathsnihala</td>
                    </tr>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Contact Number</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'><?php echo $contact_no; ?></td>
                    </tr>
                    <tr>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Email</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'><?php echo $email; ?></td>
                    </tr>
                </table>
            </div>

            <!-- Group info / notes -->
            <div style='margin-bottom: 25px;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 0 10px 0;'>
                    ✅ Approval Step 1 has been completed.
                </p>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 0 10px 0;'>
                    ➡️ Next Action: Please proceed with <strong>Approval Step 2</strong>.
                </p>
            </div>

            <!-- Approve Button -->
            <div style='text-align: center;'>
                <a href='#' style='text-decoration: none;'>
                    <button style='background-color: #2196F3; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;'>
                        Continue to Approval 2
                    </button>
                </a>
            </div>

        </div>
    </div>

</body>

</html>