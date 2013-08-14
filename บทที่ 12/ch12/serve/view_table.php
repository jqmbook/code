<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Serve</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 

	<link rel="stylesheet" href="../css/jquery.ui-1.8.23.custom.css" />
	<link rel="stylesheet" href="../css/jquery.mobile-1.3.0.min.css" />	
		
	<script src="../js/jquery-1.8.2.min.js"></script>
	<script src="../js/jquery-ui-1.8.23.custom.min.js"></script>		
	<script src="../js/jquery.mobile-1.3.0.min.js"></script>
	
	<script src="js_serve/webapp.serve.view_category.js"></script>
	<script src="js_serve/webapp.serve.view_menu.js"></script>
	<script src="js_serve/webapp.serve.view_summary.js"></script>
	<script src="js_serve/webapp.serve.view_table_order_detail.js"></script>
		
	<script src="js_serve/webapp.serve.view_table.js"></script>
	
	
</head>
	
<body>
	
	<div data-role="page" id="page-view_table">			
		<div data-role="header" data-position="fixed">				
			<h1>โต๊ะอาหาร</h1>
						
			<a href="../index.html" data-icon="home" data-ajax="false">Home</a>
								
		</div>
		<div data-role="content">						
			<ul data-role="listview" data-inset="true" id="list_view_table">
				<li data-role="list-divider">โต๊ะอาหาร</li>
 
				<?php
				$sql = "select * from DinningTable";

				$res = mysql_query($sql) or die(mysql_error());

				while($row = mysql_fetch_array($res)){
					?>
					<li ><a href="view_category.php?table_number=<?=$row['table_number']?>">โต๊ะ <?=$row['table_number']?>
	
						<span class="ui-li-count" data-table_id="<?=$row['table_id']?>" ><?=$row['table_status']?></span>
							</a></li>
 
						<?php
					}
					?>
				</ul>

			</div>						
			<div data-role="footer" data-position="fixed" data-id="mynav">
				
				<div data-role="navbar">
					<ul>
						<li><a href="#"  class="ui-btn-active ui-state-persist">โต๊ะอาหาร</a></li>
						<li><a href="view_category.php">รับออร์เดอร์</a></li>
						<li><a href="view_table_order.php">ดูออร์เดอร์</a></li>
					</ul>
				</div>
					
			</div>
		</div>			
	
	</body>
	</html>