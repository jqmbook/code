<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

$last_temp_id = $_GET['last_temp_id'];

$sql_check = "select table_number, temp_id, Temp_Orders.menu_id, menu_name, quantity ";

$sql_check .=  "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
$sql_check .=  "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
$sql_check .= " where status like 'order' and chef_message is NULL and temp_id > ". $last_temp_id ." ORDER BY Temp_Orders.temp_id ASC";
	
$res = mysql_query($sql_check) or die(mysql_error());
			
	
	if(mysql_num_rows($res) == 0){
		$json_status = array("status"=>"Not have an order"); 
	}else {
		$new = array();
		$i = 0;
		$lastest_id;
		while($row = mysql_fetch_array($res)){
			
			
			$new[$i] = array('menu_name'=>$row['menu_name'],'table_number'=>$row['table_number'], 'quantity'=>$row['quantity'],'temp_id'=>$row['temp_id']);
				 
			$i++;
			$lastest_id = $row['temp_id'];
		}  //while
		
		
		$json_status = array("status"=>"Have new order", "new_last_id"=>$lastest_id, "newlist"=>$new);
	}
	
	echo json_encode($json_status);
	
?>