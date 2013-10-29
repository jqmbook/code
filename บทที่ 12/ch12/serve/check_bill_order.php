<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

//Begin Transaction
mysql_query("BEGIN");
	
$sql_insert_bill = "insert into Bill ";
$sql_insert_bill .= "select null, sum(menu_price * quantity),Temp_Orders.table_id,null, now() ";
$sql_insert_bill .= "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
$sql_insert_bill .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
//$sql_insert_bill .= "where (status like 'order' or status like 'served') and table_number like '". $_POST['table_number'] ."'";
//fix for MySQL 5.0.51b (AppServ 2.5.10)
$sql_insert_bill .= "where (status like 'order' or status like 'served') and table_number like '". $_POST['table_number'] ."' group by DinningTable.table_number";

$res1 = mysql_query($sql_insert_bill) or die(mysql_error());

$error_msg = "";
if(mysql_error()){
	$error_msg = "$res1: \n" .mysql_error();
}
	
$order_id = mysql_insert_id();
	
//insert to Bill_Detail
$sql_bill_detail = "insert into Bill_Detail ";
$sql_bill_detail .= "select ". $order_id .", Temp_Orders.menu_id, ";
$sql_bill_detail .= "menu_price, sum(quantity), sum(menu_price * quantity) ";

		
$sql_bill_detail .= "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
$sql_bill_detail .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
$sql_bill_detail .= "where (status like 'order' or status like 'served') and table_number like '". $_POST['table_number'] ."' ";
$sql_bill_detail .= "group by Temp_Orders.menu_id";	


$res2 = mysql_query($sql_bill_detail) or die(mysql_error());

if(mysql_error()){
	$error_msg .=  "$res2: \n". mysql_error();
}

$sql_delete_temp = "delete from Temp_Orders ";
$sql_delete_temp .= "where table_id in (select table_id from DinningTable where table_number like '". $_POST['table_number'] ."')";

$res3 = mysql_query($sql_delete_temp) or die(mysql_error());
	
if(mysql_error()){
	$error_msg .=  "$res3: \n". mysql_error();
}

if($res1 && $res2 && $res3){
	mysql_query("COMMIT");
	$json_status = array("status"=>"OK"); 
}else {
	mysql_query("ROLLBACK");
	$json_status = array("status"=>$error_msg); 
}	
	
echo json_encode($json_status);

?>