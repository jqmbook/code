<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>

<div data-role="page" id="page-view_category">			
	<div data-role="header" data-position="fixed">	
		<a data-rel="back" data-icon="back">กลับ</a>				
			 
		<?php
		if(!isset($_GET['table_number'])){
			?>
			<h1>ไม่ได้เลือกโต๊ะ</h1>
			<?php
		}else {
			?>
			<h1>โต๊ะ <span id="table_num"><?=$_GET['table_number']?></span></h1>
			<a href="#" id="btn_summary_category" data-icon="grid" >สรุป</a>
			<?php							
		}					
		?>					
							
	</div>
	
	<div data-role="content">			

		<ul data-role="listview" data-inset="true" id="list_view_category">
			<li data-role="list-divider">ประเภท</li>
 
			<?php
			$sql = "select * from Category";

			$res = mysql_query($sql) or die(mysql_error());

			while($row = mysql_fetch_array($res)){
				?>
				<li>
	
					<?php
					if(isset($_GET['table_number'])){
					?>
						<a href="view_menu.php?cat_id=<?=$row['category_id']?>&table_number=<?=$_GET['table_number']?>">
							<?php
					}else {
							?>
						<a href="view_menu.php?cat_id=<?=$row['category_id']?>">
							<?php
					}
							?>
		
							<img src="../<?=$row['category_picture']?>"/><?=$row['category_name']?>
						</a></li>
  
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

