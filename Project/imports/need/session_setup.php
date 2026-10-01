<?php

date_default_timezone_set('Asia/Colombo');

if (session_status() === PHP_SESSION_NONE) {
    $timeout_duration = 3600 * 24; // 24 hours
    ini_set('session.gc_maxlifetime', $timeout_duration);
    session_start();
}

$time = $_SERVER['REQUEST_TIME'];
$_SESSION['LAST_ACTIVITY'] = $time;

$pth = "";
$online_state = false;
$online_exnction = ".php";
$online_offline_extention = ".php";

$home_page_url = "http://localhost:3000/";
$home_page = "http://localhost:3000/";

$User_login_url = "UxUi/Main/";

$total_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$path_only = parse_url($total_url, PHP_URL_PATH);
$parts = $path_only ? explode("/", trim($path_only, "/")) : array();

if (!empty($parts)) {
    array_pop($parts);
}

for ($i = 0; $i < count($parts); $i++) {
    $pth .= "../";
}

$pth_php = dirname(__FILE__);

$_SESSION['pth'] = $pth;
$_SESSION['pth_php'] = $pth_php;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "0";
$user_main_cook_id = isset($_SESSION['user_main_cook_id']) ? $_SESSION['user_main_cook_id'] : "0";
