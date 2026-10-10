<?php 
include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';
include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';

$bmjm_suppress_shared_header = true;
?>





<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            max-height: 100vh;
            background: #FAF7F0;
        }
    </style>

</head>

<body>


<script type="text/javascript">
        (function() {
            var nativeAlert = window.alert;
            window.alert = function(message) {
                if (typeof window.bmjmShowPopup === 'function') {
                    window.bmjmShowPopup(message);
                } else if (typeof nativeAlert === 'function') {
                    nativeAlert.call(window, message);
                }
            };
        })();

        document.addEventListener("DOMContentLoaded", function() {
            Admin_user_dashboard_close_all();
            var requestedReceiptId = <?php echo json_encode(isset($_GET['id']) ? $_GET['id'] : (isset($_GET['receipt_id']) ? $_GET['receipt_id'] : '')); ?>;
            var requestedPage = <?php echo json_encode(isset($_GET['page']) ? $_GET['page'] : ''); ?>;
            if (requestedPage === "payment-slip" || requestedPage === "payment_slip" || requestedReceiptId) {
                if (requestedReceiptId && typeof openPaymentSlipView === "function") {
                    openPaymentSlipView(requestedReceiptId);
                } else if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                    Admin_user_dashboard_02_A_OPEN();
                } else if (typeof Admin_user_dashboard_restore_page === "function") {
                    Admin_user_dashboard_restore_page();
                }
            } else if (typeof Admin_user_dashboard_restore_page === "function") {
                Admin_user_dashboard_restore_page();
            } else {
                Admin_user_dashboard_01_OPEN();
            }
        });
    </script>

    
        
        <?php 
        include_once '../imports/need/DB.php';
        include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';
        include_once '../UxUI-Back/Includes/Sidebar-loader.php';

        

        include_once '../UxUI-Back/Needs/Check_User_Login.php';
        bmjm_require_access(1);
        //include_once '../UxUI-Back/Needs/Admin_pannel_Pre_loader.php';
        ?>
        
            <?php
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_JS.php';

            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_01_dashboard/Admin_user_dashboard_01_dashboard.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_01_dashboard/JS/Admin_user_dashboard_01_JS.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_01_dashboard/Admin_user_dashboard_01_B_payment_slip_view.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_01_dashboard/JS/Admin_user_dashboard_01_B.php';



            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_A_payment_lis.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_B_select_paymentlis.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_C_member_list.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_D_payment_type_choose.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_E_cash_payment.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_F_select_bank.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_G_submit_bank_deposit.php'; 
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_H_payment_slip_view.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/Admin_user_dashboard_02_I.php';


            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/JS/Admin_user_dashboard_02_A_JS_payment_lis.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/JS/Admin_user_dashboard_02_H_JS_payment_slip_view.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/JS/Admin_user_dashboard_02_I_JS_send_card_link.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_02_payment/JS/Admin_user_dashboard_02_F_JS_select_bank.php';
          
            

            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/Admin_user_dashboard_03_B_edit_profile.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/JS/Admin_user_dashboard_03_B_JS.php';





            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/Admin_user_dashboard_03_A_view_profile.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/JS/Admin_user_dashboard_03_A_JS.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/Admin_user_dashboard_03_C_block_profile.php';
            include_once '../UxUI-Back/Admin_user_dashboard/Admin_user_dashboard_03_profile/JS/Admin_user_dashboard_03_C_JS.php';

            ?>

        <?php 
        
        //include_once '../includes/footer2.php'; 
        
        ?>
</body>

</html>
