<!DOCTYPE html>
<?php
include_once './imports/need/session_setup.php';
?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0B2E24">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/bmjm-member-mobile.css">
    <title>New Member Registration · bmjm</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php
    include_once './UxUI-Back/NewMemberForm/new-member-form.php';
    include_once './UxUI-Back/NewMemberForm/JS/new-member-form_JS.php';

    ?>
</body>

</html>