<?php
require_once "../include/common.php";
require_once "../include/connect_db.php";

$cus_order = json_decode($_POST['order'],true);

//หา id ของโต๊ะ
$sql_tableid = "select table_id from DinningTable where table_number like '" .$cus_order['table_number'] . "'";

$res_tableid = mysql_query($sql_tableid) or die (mysql_error());
$row_tableid = mysql_fetch_array($res_tableid);

for($i=0; $i<count($cus_order['order']); ++$i){
	//ตรวจดูว่ามีออร์เดอร์ที่ยังไม่ได้ยืนยันซ้ำกับที่ส่งเข้ามาหรือไม่  ถ้าหากมีให้ปรับปรุงจำนวนที่สั่ง
	$sql_check_pending = "select menu_id, status, temp_id 
	from Temp_Orders where menu_id=" .$cus_order['order'][$i]['menu_id'];

	$sql_check_pending .= " and table_id=". $row_tableid['table_id'] ." and status like 'pending'";

	$res_check_pending=mysql_query($sql_check_pending) 
	or die (mysql_error());

	$row_check_pending = mysql_fetch_array($res_check_pending);

	if($row_check_pending){
		//พบข้อมูลอยู่ในตาราง ให้ทำการลบหรือปรับปรุงข้อมูล

		if($cus_order['order'][$i]['quantity'] == "0"){
			//quantity = 0, ลบข้อมูลทิ้ง
			$sqlupdate_quantity = "delete from Temp_Orders where menu_id=" .$cus_order['order'][$i]['menu_id'];
			$sqlupdate_quantity .= " and table_id=". $row_tableid['table_id']." and status like 'pending'";
			
			mysql_query($sqlupdate_quantity) or die(mysql_error());
			
		}else {
			//quantity > 0, ปรับปรุงข้อมูล

			$sqlupdate_quantity = "update Temp_Orders set quantity=". 
			$cus_order['order'][$i]['quantity'];

			$sqlupdate_quantity .= " where menu_id=" .$cus_order['order'][$i]['menu_id'];

			$sqlupdate_quantity .= " and table_id=". $row_tableid['table_id']." and status like 'pending'";
			
			mysql_query($sqlupdate_quantity) or die(mysql_error());
			

		}

	}else {
		//insert ข้อมูลใหม่
		$sql = "insert into Temp_Orders values(null,". 
		$row_tableid['table_id'] . ", ". $cus_order['order'][$i]['menu_id'] 
		. ",". $cus_order['order'][$i]['quantity'] .",now(),
		'pending','". $_SERVER['REMOTE_ADDR'] ."', null)";

		mysql_query($sql) or die(mysql_error());

	}

}//for

echo "OK from send_order.php";
?>
