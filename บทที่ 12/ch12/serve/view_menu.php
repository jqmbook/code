<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

?>

<div data-role="page" id="page-view_menu">			
	<div data-role="header" data-position="fixed">		
		<a data-rel="back" data-icon="back">กลับ</a>		
		<?php
		if(!isset($_GET['table_number'])){
			?>
			<h1>ไม่ได้เลือกโต๊ะ</h1>
			<?php
		}else {
			?>
			<h1>โต๊ะ <span id="table_num" data-cat_id="<?=$_GET['cat_id']?>"><?=$_GET['table_number']?></span></h1>
			<a href="#" id="btn_summary_menu" data-icon="grid" >สรุป</a>
			<?php							
		}					
		?>			
					
	</div>
	
	<div data-role="content">	
				
		<ul data-role="listview" id="listmenu" data-inset="true" data-theme="d" >
			<?php
			//หา ชื่อประเภท
			$sql_catname = "select category_name from Category where category_id=". $_GET['cat_id'];
			$res_catname = mysql_query($sql_catname) or die(mysql_error());
			
			$row_catname = mysql_fetch_array($res_catname);
		
			?>
			<li data-role="list-divider"><?=$row_catname['category_name']?></li>
 
			<?php
			if(isset($_GET['table_number'])){
				$sql = "select menu_id, menu_name, menu_price, menu_picture, ";
				
				$sql .= "(select quantity from Temp_Orders join DinningTable on "; 
				$sql .= "Temp_Orders.table_id=DinningTable.table_id ";
				$sql .= "where Menu.menu_id = Temp_Orders.menu_id and ";
				$sql .= "table_number like '".$_GET['table_number']. "' ";
				$sql .= "and status like 'pending') as quantity ";
				
				$sql .= "from Menu where category_id=". $_GET['cat_id'];
				
			}else {
				$sql = "select menu_id, menu_name, menu_price, menu_picture ";
				$sql .= "from Menu where category_id=". $_GET['cat_id'];
			}

			$res = mysql_query($sql) or die (mysql_error());

			while($row = mysql_fetch_array($res)){
				?>
				<li data-icon="false">
					<?php
					if(isset($_GET['table_number'])){
						?>
						<a class="link_menu">
							<?php
						}					
						?> 
						<img src="../<?=$row['menu_picture']?>"/> 
						<h1><?=$row['menu_name']?></h1>
						<p><?=$row['menu_price']?> บาท</p>
	
						<?php
						$quan = 0;

						if(isset($row["quantity"]) && $row["quantity"]>0){
							$quan = $row["quantity"];
						}
						?>


						<span class="ui-li-count" data-menu_id="<?=$row['menu_id']?>"><?=$quan?></span>
							
						<?php
						if(isset($_GET['table_number'])){
							?>
						</a>
						<?php
					}					
					?> 
					
				</li>
				<?php
			}
			?>
		</ul>

	</div>		
					
	<div data-role="footer" data-position="fixed" data-id="mynav">
				
		<div data-role="navbar">
			<ul>
				<li><a href="view_table.php">โต๊ะอาหาร</a></li>
				<li><a href="#" class="ui-btn-active ui-state-persist">รับออร์เดอร์</a></li>
				<li><a href="view_table_order.php">ดูออร์เดอร์</a></li>
			</ul>
		</div>
					
	</div>
						
</div>		
		
<!--  end page  -->