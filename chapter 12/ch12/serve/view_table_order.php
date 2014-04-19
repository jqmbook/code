<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

?>
	
<div data-role="page" id="page-view_table_order">			
	<div data-role="header" data-position="fixed">				
		<h1>ดูออร์เดอร์</h1>							
	</div>
	
	<div data-role="content">						
		<ul data-role="listview" id="list_view_table_order" data-inset="true">
			<li data-role="list-divider">โต๊ะอาหาร</li>
 
			<?php
			$sql = "select * from DinningTable where table_id in (select table_id from Temp_Orders where status like 'order' or status like 'served')";

			$res = mysql_query($sql) or die("can't find DinningTable");

			while($row = mysql_fetch_array($res)){
	
				//หายอดรวมค่าอาหารของแต่ละโต๊ะ
				$sql_total = "select sum(menu_price * quantity) as total ";
				$sql_total .=  "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
				$sql_total .=  "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
				$sql_total .=  "where (Temp_Orders.status like 'order' or Temp_Orders.status like 'served') and table_number like '". $row['table_number'] ."'";
				
				$res_total = mysql_query($sql_total) or die (mysql_error());
				
				$row_total = mysql_fetch_array($res_total);	
	
				?>
				
				<li><a href="view_table_order_detail.php?table_number=<?=$row['table_number']?>">โต๊ะ <?=$row['table_number']?>
					<span class="ui-li-aside"><?=number_format($row_total['total'])?> บาท</span>
				</a></li>
				 
				<?php
			}
			?>
			
		</ul>

	</div>		
					
	<div data-role="footer" data-position="fixed" data-id="mynav">
				
		<div data-role="navbar">
			<ul>
				<li><a href="view_table.php"  >โต๊ะอาหาร</a></li>
				<li><a href="view_category.php">รับออร์เดอร์</a></li>
				<li><a href="#" class="ui-btn-active ui-state-persist">ดูออร์เดอร์</a></li>
			</ul>
		</div>
					
	</div>
</div>	