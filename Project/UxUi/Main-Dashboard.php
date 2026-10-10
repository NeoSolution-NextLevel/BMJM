<?php 
include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';
include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';

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
            overflow: hidden !important;
            background: #FAF7F0;
        }

        body > div[id^="Main"] {
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }

        body > div[id^="Main"] > div[class$="-app"],
        body > div[id^="Main"] > div[class*="-app "] {
            height: 100%;
            min-height: 0;
            overflow: hidden;
        }

        body > div[id^="Main"] main {
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
        }

        body > div[id^="Main"] select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 38px;
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
            main_dashboard_close_all();
            var requestedPage = <?php echo json_encode(isset($_GET['page']) ? $_GET['page'] : ''); ?>;
            var requestedReceiptId = <?php echo json_encode(isset($_GET['id']) ? $_GET['id'] : (isset($_GET['receipt_id']) ? $_GET['receipt_id'] : '')); ?>;
            if (requestedPage === "members" && typeof main_dashboard_01_A_OPEN === "function") {
                main_dashboard_01_A_OPEN();
                var dashboardUrl = new URL(window.location.href);
                dashboardUrl.searchParams.delete("page");
                window.history.replaceState({}, document.title, dashboardUrl.pathname + dashboardUrl.search + dashboardUrl.hash);
            } else if (requestedPage === "payment-slip" || requestedPage === "payment_slip" || (requestedReceiptId && requestedPage !== "members")) {
                if (requestedReceiptId && typeof openPaymentSlipView === "function") {
                    openPaymentSlipView(requestedReceiptId);
                } else if (typeof main_dashboard_02_A_OPEN === "function") {
                    main_dashboard_02_A_OPEN();
                } else if (typeof main_dashboard_restore_page === "function") {
                    main_dashboard_restore_page();
                }
            } else if (typeof main_dashboard_restore_page === "function") {
                main_dashboard_restore_page();
            } else {
                main_dashboard_00_OPEN();
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
            include $pth.'imports/Company_Info/Company_Info_Variable_List.php';
            $company_obj = new Company_Info_Variable_List(); 
            $bmjm_suppress_shared_header = true;
            include_once '../UxUI-Back/Main-Dashboard/Main-Dashboard.php';
            include_once '../UxUI-Back/Main-Dashboard/Main-Dashboard_JS.php';
            
            include_once '../UxUI-Back/Main-Dashboard/Main-Dashboard_00/Main-Dashboard_00_dshboard.php';
            

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/Main-Dashboard_01_A.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/Main-Dashboard_01_B_add_member.php';
            

            

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/Main-Dashboard_01_E_add_new_road.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/Main-Dashboard_01_F_member_street_list.php'; 
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/Main-Dashboard_01_G_.process_new_member.php'; 

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_A_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_B_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_C_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_D_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_E_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_F_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_01/JS/Main-Dashboard_01_G_JS.php';







            // MAIN DASHBOARD 02 PAYMENT

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_A.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_B_select_payment.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_C2_project_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_C_member_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_C3_ticket_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_D_payment_type_choose.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_E_cash_payment.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_F_select_bank.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_G_submit_bank_deposit.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_H_payment_slip_view.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/Main-Dashboard_02_I_send_ipg.php';   

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_A_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_C2_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_C_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_C3_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_E_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_F_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_G_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_H_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_02_payment/JS/Main-Dashboard_02_I_JS.php';


            

            //MAIN DASHBOARD 03 PROJECTS
            
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_03_projects/Main_Dashboard_03_A_select_project_type.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_03_projects/Main_Dashboard_03_B_collection_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_03_projects/JS/Main_Dashboard_03_B_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_03_projects/Main_Dashboard_03_C_add_new_collection.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_03_projects/Main_Dashboard_03_D_manage_collection.php';

            


            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/Main_Dashboard_04_A_income_expence_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/JS/Main_Dashboard_04_A_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/Main_Dashboard_04_B_inside_income_expence.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/JS/Main_Dashboard_04_B_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/Main_Dashboard_04_C_expense_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/JS/Main_Dashboard_04_C_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/Main_Dashboard_04_D_inside_expense.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/JS/Main_Dashboard_04_D_JS.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/Main_Dashboard_04_E_add_income_expense.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_04_income_expence/JS/Main_Dashboard_04_E_JS.php';

           
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_05_settings/Main_Dashboard_05_01_setting_types.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_05_settings/Main_Dashboard_05_03_A_bank_account_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_05_settings/Main_Dashboard_05_03_B_add_new_bank_ac.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_05_settings/Main_Dashboard_05_04_A_income_expence_type_list.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_05_settings/Main_Dashboard_05_04_B_add_income_expense_type.php';

            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_06_notifications/Main_Dashboard_06_A_notifications.php';
            
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_07_financial_report/Main_Dashboard_07_A_financial_report.php';
            include_once '../UxUI-Back/Main-Dashboard/Main_Dashboard_07_financial_report/JS/Main_Dashboard_07_A_JS.php';
            
            ?>

        <?php 
        
        //include_once '../includes/footer2.php'; 
        
        ?>
</body>

</html>
