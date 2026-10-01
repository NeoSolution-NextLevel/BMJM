<?php
include_once 'imports/need/DB.php';
$db_obj = new DataBase();
$db = $db_obj->get_data_base_connction();

$res = $db->query("SELECT * FROM main_user_account_access_level_list");
echo "AVAILABLE ACCESS LEVELS:\n";
while($row = $res->fetch_assoc()) {
    echo "ID: " . $row['id'] . " | access_name: " . $row['access_name'] . " | type_of_access: " . $row['type_of_access'] . "\n";
}
?>
