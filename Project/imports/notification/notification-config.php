<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../Company_Info/Company_Info_Variable_List.php';

date_default_timezone_set('Asia/Colombo');
$company_info_obj = new Company_Info_Variable_List();
$firebaseProjectId = $company_info_obj->get_firebase_project_id();
$firebaseServiceAccountJson = '';
$firebaseServiceAccountCandidates = [
    __DIR__ . DIRECTORY_SEPARATOR . 'firebase-service-account.json',
    dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'firebase-service-account.json',
    dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'firebase-service-account.json',
    __DIR__ . DIRECTORY_SEPARATOR . 'bmjm-197e1-firebase-adminsdk-fbsvc-a8abab2695.json',
];
foreach ($firebaseServiceAccountCandidates as $candidate) {
    if (is_file($candidate)) {
        $firebaseServiceAccountJson = $candidate;
        break;
    }
}

$sessionMemberIdKey = 'member_list_id';
$sessionAccessLevelKey = 'main_user_account_access_level_list_id';

$adminAccessId = '1';
$memberAccessId = '2';

$fcmAllTopic = $company_info_obj->get_fcm_all_topic();
$fcmSubscriptionTopicPrefix = $company_info_obj->get_fcm_subscription_topic_prefix();

require_once __DIR__ . '/../../Controller/notification/notification_member_SINGLE_DATA.php';

if (!function_exists('bmjm_restore_login_from_cookie')) {
    function bmjm_restore_login_from_cookie() {
        if ((int) ($_SESSION['user_id'] ?? 0) > 0) {
            return;
        }

        $cookId = trim((string) ($_COOKIE['main_user_account_cook'] ?? $_COOKIE['Web_View_Cookie_Yes_No'] ?? ''));
        if ($cookId === '' || $cookId === 'NO_DATA') {
            return;
        }

        include_once __DIR__ . '/../need/DB.php';
        if (!class_exists('Cook_Management', false)) {
            include_once __DIR__ . '/../../Controller/Main/Cook_Managment/Cook_Managing.php';
        }

        $cookie_check_obj = new Cook_Management($cookId);
        if (!$cookie_check_obj->check_login_availability()) {
            return;
        }

        $_SESSION['user_id'] = $cookie_check_obj->get_user_id();
        $_SESSION['user_main_cook_id'] = $cookId;
        $_SESSION['access_control_id'] = $cookie_check_obj->get_access_level_id();
    }
}

bmjm_restore_login_from_cookie();

if (!function_exists('bmjm_json')) {
    function bmjm_json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}

if (!function_exists('bmjm_current_main_user_login_id')) {
    function bmjm_current_main_user_login_id() {
        $value = $_SESSION['user_id'] ?? $_SESSION['Main_User_Account_List_Id'] ?? 0;
        return (int) $value;
    }
}

if (!function_exists('bmjm_current_member_id')) {
    function bmjm_current_member_id() {
        global $sessionMemberIdKey;
        $memberId = (int) ($_SESSION[$sessionMemberIdKey] ?? 0);
        if ($memberId > 0) {
            return $memberId;
        }

        $mainUserLoginId = bmjm_current_main_user_login_id();
        if ($mainUserLoginId <= 0) {
            return 0;
        }

        $member_data_obj = new notification_member_SINGLE_DATA();
        return $member_data_obj->get_bmjm_member_list_id_from_main_user_login_id($mainUserLoginId);
    }
}

if (!function_exists('bmjm_current_access_id')) {
    function bmjm_current_access_id() {
        global $sessionAccessLevelKey;
        return (string) ($_SESSION['access_control_id'] ?? $_SESSION[$sessionAccessLevelKey] ?? $_SESSION['bmjm_access_id'] ?? '');
    }
}

if (!function_exists('bmjm_require_main_user_login')) {
    function bmjm_require_main_user_login() {
        $mainUserLoginId = bmjm_current_main_user_login_id();
        if ($mainUserLoginId <= 0) {
            bmjm_json(['ok' => false, 'error' => 'Please sign in'], 401);
        }
        return $mainUserLoginId;
    }
}

if (!function_exists('bmjm_require_member_login')) {
    function bmjm_require_member_login() {
        $memberId = bmjm_current_member_id();
        if ($memberId <= 0) {
            bmjm_json(['ok' => false, 'error' => 'Please sign in'], 401);
        }
        return $memberId;
    }
}

if (!function_exists('bmjm_require_login')) {
    function bmjm_require_login() {
        return bmjm_require_member_login();
    }
}

if (!function_exists('bmjm_is_admin')) {
    function bmjm_is_admin() {
        global $adminAccessId;
        return bmjm_current_access_id() === (string) $adminAccessId;
    }
}

if (!function_exists('bmjm_notification_public_image_pth')) {
    function bmjm_notification_public_image_pth($image_pth) {
        $image_pth = trim((string) $image_pth);
        if ($image_pth === '' || preg_match('/^https?:\/\//i', $image_pth)) {
            return $image_pth;
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? '';
        if ($host === '' || preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $host)) {
            $scheme = 'https';
            $host = 'bmjm.lk';
        }

        return $scheme . '://' . $host . '/' . ltrim($image_pth, '/');
    }
}
