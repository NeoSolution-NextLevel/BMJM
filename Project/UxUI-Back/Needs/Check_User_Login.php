<?php
function bmjm_back_to_login()
{
    global $pth;
    $login_url = $pth . "Login.php";
    echo "<script type=\"text/javascript\">window.location.href = " . json_encode($login_url) . ";</script>";
    exit;
}

function bmjm_require_access($allowed_access_levels)
{
    global $user_id, $user_main_cook_id, $access_level;

    if (!is_array($allowed_access_levels)) {
        $allowed_access_levels = [$allowed_access_levels];
    }

    $allowed_access_levels = array_map('intval', $allowed_access_levels);

    if (
        empty($user_id) ||
        empty($user_main_cook_id) ||
        empty($access_level) ||
        !in_array((int) $access_level, $allowed_access_levels, true)
    ) {
        bmjm_back_to_login();
    }
}

$get_cookie_id = "0";

if (isset($_SESSION['user_main_cook_id'])) {
    $get_cookie_id = $_SESSION['user_main_cook_id'];
} else if (isset($_COOKIE['main_user_account_cook'])) {
//            echo 'line 02';
    $get_cookie_id = $_COOKIE['main_user_account_cook'];
    $_SESSION['user_main_cook_id'] = $get_cookie_id;
} else {
    
}
$cookie_check_obj = new Cook_Management($get_cookie_id);
if ($cookie_check_obj->check_login_availability()) {
    $user_id = $cookie_check_obj->get_user_id();
    $access_level = $cookie_check_obj->get_access_level_id();
    $user_main_cook_id = $get_cookie_id;

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_main_cook_id'] = $user_main_cook_id;
    $_SESSION['access_control_id'] = $access_level;
} else if ($cookie_check_obj->cook_remove_fouse_state()) {
    $_SESSION['login_error'] = $cookie_check_obj->get_error_msg();
    

    if (isset($_COOKIE['main_user_account_cook'])) {
        unset($_COOKIE['main_user_account_cook']);
    }
    if (isset($_SESSION['user_main_cook_id'])) {
        unset($_SESSION['user_main_cook_id']);
        session_destroy();
    }
    bmjm_back_to_login();
}
?>
