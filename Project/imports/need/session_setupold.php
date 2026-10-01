<?php

if (!isset($_SESSION)) {
    $timeout_duration = 3600 * 24; // Setting timeout duration
    ini_set('session.gc_maxlifetime', $timeout_duration);
    session_start(); // Start session if not started already
}

date_default_timezone_set('Asia/Colombo');
$time_stamp_data_obj = date('Y-m-d H:i:s');

$time = $_SERVER['REQUEST_TIME'];
$_SESSION['LAST_ACTIVITY'] = $time;

$total_url = $_SERVER['REQUEST_URI'] . "";

$pth = "";
$online_offline_extention = "";
$pth_php = "";

//---------------local host-------------------------------------
// $curnt_location = explode("bmjm/", $total_url)[1];
// $count = count(explode("/", $curnt_location)) - 1;

//-------------------online-------------------------------
$count = count(explode("/", $total_url)) - 1;
$online_offline_extention = ".php";

for ($i = 0; $i < $count; $i++) {
    $pth = $pth . "../";
}

//-------------------online-------------------------------
//
//$pth_php ="C:/xampp/htdocs/Statement_Management/";
//$pth_php = "/home/shadowshinecom/public_html/";
$pth_php = "/home/neosolut/public_html/";

//---------------local host-------------------------------------
$_SESSION['pth'] = $pth;

$_SESSION['pth_php'] = $pth_php;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "0";
$user_main_cook_id = isset($_SESSION['user_main_cook_id']) ? $_SESSION['user_main_cook_id'] : "0";

//----------------------company data--------------------------------
