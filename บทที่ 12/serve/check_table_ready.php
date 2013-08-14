<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
			
$sql_dinning_table = "select * from DinningTable";
	
$res = mysql_query($sql_dinning_table) or die(mysql_error());		

	
$dinning_table = array();
	
$i = 0;
	
while($row = mysql_fetch_array($res)){
	
	$sql_chef_message = "select chef_message from Temp_Orders where table_id=" .$row['table_id'];
	$sql_chef_message .=" and chef_message like 'ready'";
	
	$res_chef_message = mysql_query($sql_chef_message) or die(mysql_error());
		
	if(mysql_num_rows($res_chef_message)>0){
		$row_chef = mysql_fetch_array($res_chef_message);
		$chef_message = $row_chef['chef_message'];		
	}else {
		$chef_message = "";
	}			
	
	$dinning_table[$i] = array('table_id'=>$row['table_id'], 'table_status'=>$row['table_status'], 'chef_message'=>$chef_message);
	
	$i++;
}  //while

$json_dinning_table = array("json_table"=>$dinning_table);

echo json_encode($json_dinning_table);

?>