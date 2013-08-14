<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

//ตรวจดูว่ามาจาก page ใด
if(isset($_GET['cat_id'])){
	$frompage = "view_menu";
}else {
	$frompage = "view_category";
}
?>


<div data-role="page" id="page-view_summary" data-overlay-theme="a" >
	<div data-role="header">

		<?php
		if($frompage == "view_menu"){
			//หากมาจาก page ดูรายเมนูอาหารให้ใส่ id ประเภทอาหารไว้ในแอตทริบิวต์ data-cat_id
			?>	
			<h1>สรุปออร์เดอร์โต๊ะ <span id="table_num" data-cat_id="<?=$_GET['cat_id']?>"><?=$_GET['table_number']?></span></h1>
			<?php
		}else {		
			?>	
			<h1>สรุปออร์เดอร์โต๊ะ <span id="table_num"><?=$_GET['table_number']?></span></h1>
			<?php
		}
		?>
	</div>

	<div data-role="content">

		<?php
		$sql = "select * from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
		$sql .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
		$sql .= "where DinningTable.table_number like '". $_GET['table_number'] ."'";
		$sql .= " and status like 'pending'";
		$sql .= " order by datetime DESC"; 

		$res = mysql_query($sql) or die(mysql_error());
		$num_rows = mysql_num_rows($res);

		if($num_rows > 0){
			?>
			<ul data-role="listview" id="listsummary" data-inset="true">

				<?php
				while($row = mysql_fetch_array($res)){
					?>				

					<li data-icon="false">
											
						<h1><?=$row['menu_name']?></h1>

						<span class="ui-li-count" data-menu_id="<?=$row['menu_id']?>"><?=$row['quantity']?></span>
					</li>

					<?php
				}  //while

				?>
			</ul>
			<p>
				<br>
				<a data-role="button" data-theme="b" href="#" id="confirm_order">ยืนยันออร์เดอร์</a>
				<?php
			}else {
				?>
				<div align="center"><p>ไม่มีออร์เดอร์</p></div>
				<?php
			}//if numrow

			?>

			<a data-role="button" id="closebutton" href="#">ปิด</a>
			
		</div>		

	</div>
