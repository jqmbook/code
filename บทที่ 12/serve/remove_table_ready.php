<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

$sql_remove_table_ready = "update Temp_Orders set status='served',chef_message = NULL where chef_message='ready' and table_id=". $_GET['table_id'];
	
$res = mysql_query($sql_remove_table_ready) or die(mysql_error());			


$json_remove_table = array("status"=>"OK");

echo json_encode($json_remove_table);

?>