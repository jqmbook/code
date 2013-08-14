<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

$sqlupdate_ready = "update Temp_Orders set chef_message='ready' ";
$sqlupdate_ready .= " where temp_id=" .$_POST['temp_id'];

mysql_query($sqlupdate_ready) or die(mysql_error());
		

	
$json_status = array("status"=>"OK"); 
echo json_encode($json_status);

?>