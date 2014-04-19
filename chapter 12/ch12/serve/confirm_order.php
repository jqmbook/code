<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

//หา id ของโต๊ะ
$sql_tableid = "select table_id from DinningTable where table_number like '" .$_POST['table_number'] . "'";
$res_tableid = mysql_query($sql_tableid) or die (mysql_error());
$row_tableid = mysql_fetch_array($res_tableid);

$sql_confirm = "update Temp_Orders set status='order' ";
$sql_confirm .= " where status like 'pending' and table_id=" .$row_tableid['table_id'];

mysql_query($sql_confirm) or die (mysql_error());
	
$sql_update_DinningTable = "update DinningTable set table_status='ไม่ว่าง' ";
$sql_update_DinningTable .= "where table_number like '" .$_POST['table_number'] . "'";

mysql_query($sql_update_DinningTable) or die(mysql_error());
	
echo "OK from confirm_order.php";

?>

