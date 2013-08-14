<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

?>

<div data-role="page" id="page-view_menu_order_detail" data-overlay-theme="a" >
	<div data-role="header">			
		
		<h1>รายละเอียด</span></h1>
		
	</div>
		
	<div data-role="content">
		<ul data-role="listview" id="list_menu_order_detail" data-inset="true">
			<?php
			$sql = "select * from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
			$sql .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
			$sql .= "where DinningTable.table_number like '". $_GET['table_number'] ."' ";
			$sql .= "and (status like 'order' or status like 'served') and Temp_Orders.menu_id=".$_GET['menu_id'];
			$sql .= " order by datetime DESC"; 

			$res = mysql_query($sql) or die(mysql_error());

			while($row = mysql_fetch_array($res)){
				?>
				<li data-icon="false"> 					
					<h1><?=$row['menu_name']?></h1>
					<p><?=$row['datetime']?></p>			
					<span class="ui-li-count"><?=$row['quantity']?></span>
				</li>

			<?php
			}
			?>
		</ul>
		<p>
			<br>
			
			<a data-role="button" data-rel="back" href="#">ปิด</a>
			
		</div>		
		
	</div>
	
	
