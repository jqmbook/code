<?php

require_once "../include/common.php";
require_once "../include/connect_db.php";

//Begin Transaction
mysql_query("BEGIN");

$sql_update_bill = "update Bill set payment_type='".$_POST['pay_type'] ."' ";
$sql_update_bill .= "where bill_id=" .$_POST['bill_id'];
$res1 = mysql_query($sql_update_bill) or die (mysql_error());

$sql_table_id = "select table_id from Bill where bill_id=". $_POST['bill_id'];
$res_table_id = mysql_query($sql_table_id) or die(mysql_error());
$row_table_id = mysql_fetch_array($res_table_id);

$sql_update_DinningTable = "update DinningTable set table_status='ว่าง' ";
$sql_update_DinningTable .= "where table_id=" .$row_table_id['table_id'];

$res2 = mysql_query($sql_update_DinningTable);

if($res1 && $res2){
	mysql_query("COMMIT");
	$json_status = array("status"=>"OK"); 
}else {
	mysql_query("ROLLBACK");
	$json_status = array("status"=>"ERROR"); 
}

echo json_encode($json_status);

?>