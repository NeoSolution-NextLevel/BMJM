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
    

</head>

<body>


<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Collection_dashboard_close_all();
            Collection_dashboard_restore_page();
        });
    </script>

    
        
        <?php 
        include_once '../imports/need/DB.php';
        include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';
        include_once '../UxUI-Back/Includes/Sidebar-loader.php';

        

        include_once '../UxUI-Back/Needs/Check_User_Login.php';
        bmjm_require_access(1);
        //include_once '../UxUI-Back/Needs/Collection_dashboard_Pre_loader.php';
        ?>
        
            <?php
            $bmjm_suppress_shared_header = true;
           
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_JS.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_01_dashboard/Collection_dashboard_01_A_dashboard.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_01_dashboard/JS/Collection_dashboard_01_A_JS.php';
          

          
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_02_payment/Collection_dashboard_02_A_payment_List.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_02_payment/Collection_dashboard_02_B_payment_details.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_02_payment/Collection_dashboard_02_C_new_payment.php';

            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_03_expences/Collection_dashboard_03_A_expences.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_03_expences/Collection_dashboard_03_B_new_expence.php';
            include_once '../UxUI-Back/Collection_dashboard/Collection_dashboard_03_expences/Collection_dashboard_03_C_expence_details.php';



            ?>

        <?php 
        
        //include_once '../includes/footer2.php'; 
        
        ?>
</body>

</html>
