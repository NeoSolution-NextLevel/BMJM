<?php
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
$Company_Info = new Company_Info_Variable_List();
$home_url = !empty($Company_Info->get_compnay_full_web()) ? $Company_Info->get_compnay_full_web() : "#";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful | bmjm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #FAF7F0;
            --card-bg: #FFFFFF;
            --green-950: #042A1B;
            --gold-600: #B8923D;
            --shadow: 0 12px 40px rgba(4, 42, 27, 0.08);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--green-950);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 24px;
        }
        .success-card {
            background: var(--card-bg);
            padding: 48px 32px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            text-align: center;
            max-width: 440px;
            width: 100%;
        }
        .icon {
            width: 80px;
            height: 80px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px auto;
        }
        .title {
            font-family: 'Poppins', sans-serif;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .desc {
            font-size: 15px;
            line-height: 1.6;
            color: #5C6662;
            margin-bottom: 32px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, var(--gold-600), #9e7a2b);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <div class="title">Payment Successful!</div>
        <div class="desc">Thank you for your payment. Your transaction has been securely processed and recorded dynamically. You may now safely close this window.</div>
        <a href="<?php echo htmlspecialchars($home_url); ?>" class="btn">Return Home</a>
    </div>
</body>
</html>
