<?php
include_once 'imports/need/DB.php';
$db_obj = new DataBase();
$db = $db_obj->get_data_base_connction();

echo "main_user_login COLUMNS:\n";
$res1 = $db->query("SHOW COLUMNS FROM main_user_login");
while($row = $res1->fetch_assoc()) echo $row['Field'] . "\n";

echo "\nbmjm_member_list COLUMNS:\n";
$res2 = $db->query("SHOW COLUMNS FROM bmjm_member_list");
while($row = $res2->fetch_assoc()) echo $row['Field'] . "\n";
?>
