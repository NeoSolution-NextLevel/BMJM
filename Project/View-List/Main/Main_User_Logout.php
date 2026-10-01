<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/Main/Cook_Managment/Cook_Managing.php';

$json = [];
$state = [];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($user_main_cook_id) && $user_main_cook_id !== "0" && !empty($user_id) && $user_id !== "0") {

        $Cook_Management_obj = new Cook_Management($user_main_cook_id);

        if ($Cook_Management_obj->main_user_login_logout($user_id)) {
            $state['error'] = "0";
        } else {
            $state['error'] = "DB_LOGOUT_FAILED";
        }
    } else {
        $state['error'] = "0";
    }

    setcookie('main_user_account_cook', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
    setcookie('Web_View_Cookie_Yes_No', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
    unset($_COOKIE['main_user_account_cook'], $_COOKIE['Web_View_Cookie_Yes_No']);

    unset(
        $_SESSION['user'],
        $_SESSION['user_id'],
        $_SESSION['user_main_cook_id'],
        $_SESSION['temp_user'],
        $_SESSION['otp_pending'],
        $_SESSION['otp_encrypt']
    );

    session_destroy();
} else {
    $state['error'] = "INVALID_REQUEST";
}

$json[] = $state;

header('Content-Type: application/json');
echo json_encode($json);
exit;
