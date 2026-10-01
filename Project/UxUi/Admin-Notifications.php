<?php
include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';
include_once '../Controller/Main/Cook_Managment/Cook_Managing.php';

$pth = '../';
$bmjm_suppress_shared_header = true;

$_SESSION['login_return_url'] = 'UxUi/Admin-Notifications.php';

include_once '../UxUI-Back/Needs/Check_User_Login.php';
bmjm_require_access(1);
unset($_SESSION['login_return_url']);

$bmjm_notification_standalone = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="theme-color" content="#0B2E24">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <title>Notifications - bmjm Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    *{box-sizing:border-box;}
    html,body{margin:0;min-height:100%;background:#FAF7F0;}
    body{min-height:100vh;overflow-x:hidden;}
    #Main_Dashboard_06_A{display:block;min-height:100vh;}
    #Main_Dashboard_06_A .notify-app{min-height:100vh;}
    @media (max-width:700px){
      #Main_Dashboard_06_A .notify-main{overflow-y:visible;}
    }
  </style>
</head>
<body>
  <script>
    function main_dashboard_00_OPEN() {
      window.location.href = 'Main-Dashboard.php';
    }
    function Main_Dashboard_06_A_OPEN() {
      if (typeof adminNotificationsLoad === 'function') adminNotificationsLoad();
    }
  </script>

  <?php include '../UxUI-Back/Main-Dashboard/Main_Dashboard_06_notifications/Main_Dashboard_06_A_notifications.php'; ?>
</body>
</html>
