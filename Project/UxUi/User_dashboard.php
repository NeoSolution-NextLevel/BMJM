<?php 
include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';
include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';

?>





<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0B2E24">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Member Dashboard · bmjm</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bmjm-member-mobile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            user_dashboard_close_all();
            user_dashboard_restore_page();
        });
    </script>

    
        
        <?php 
        include_once '../imports/need/DB.php';
        include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';
        include_once '../UxUI-Back/Includes/Sidebar-loader.php';

        

        include_once '../UxUI-Back/Needs/Check_User_Login.php';

        bmjm_require_access(2);

        include_once '../imports/need/processing_loader.php';
        
        //include_once '../UxUI-Back/Needs/Collection_dashboard_Pre_loader.php';
        ?>
        
            <?php

           
            include_once '../UxUI-Back/User_dashboard/User_dashboard_JS.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_01_dashboard/User_dashboard_01_A_dashboard_summary.php';

            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_A_payments_list.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_B_create_payment.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_C_select_payment_type.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_D_bank_receipt_upload.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_E_online_payment.php';
                         
            include_once '../UxUI-Back/User_dashboard/User_dashboard_03_settings/User_dashboard_03_A_settings.php';



            include_once '../UxUI-Back/User_dashboard/User_dashboard_01_dashboard/JS/User_dashboard_01_A_JS.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/JS/User_dashboard_02_A_JS.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_02_payments/JS/User_dashboard_02_D_JS.php';
            include_once '../UxUI-Back/User_dashboard/User_dashboard_03_settings/JS/User_dashboard_03_A_JS.php';
            ?>
    <link rel="stylesheet" href="../assets/css/bmjm-user-dashboard.css">
</body>

</html>
