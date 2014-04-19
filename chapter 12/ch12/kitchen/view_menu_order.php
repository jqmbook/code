<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>
<!DOCTYPE html>
<html>
<head>

	<title>Kitchen</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../css/jquery.ui-1.8.23.custom.css" />
	<link rel="stylesheet" href="../css/jquery.mobile-1.3.0.min.css" />

	<script src="../js/jquery-1.8.2.min.js"></script>
	<script src="../js/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="../js/jquery.mobile-1.3.0.min.js"></script>
	<script src="js_kitchen/webapp.kitchen.view_menu_order.js"></script>

</head>
<body>

	<div data-role="page" id="page-view_menu_order" data-overlay-theme="a" >
		<div data-role="header">
			<a data-rel="back" data-icon="back">Home</a>
			<h1>รายการออร์เดอร์</h1>

		</div>

		<div data-role="content">			 

			<ul data-role="listview" id="list_view_menu_order" data-inset="true">

				<?php			
			$sql = "select table_number, temp_id, Temp_Orders.menu_id, menu_name, quantity ";

			$sql .= "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
			$sql .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
			$sql .= "where status like 'order' and chef_message is NULL ORDER BY Temp_Orders.temp_id ASC";

			$res = mysql_query($sql) or die(mysql_error());


			while($row = mysql_fetch_array($res)){
				?>
				<li data-icon="false">					

					<a href="#" > 					
						<h1><?=$row['menu_name']?></h1>
						<p>โต๊ะ: <?=$row['table_number']?></p>		
						<span class="ui-li-count"><?=$row['quantity']?></span>
					</a>
					<a data-icon="delete" href="#" data-temp_id="<?=$row['temp_id']?>" class="btn_delete_order_menu">ลบ</a>
				</li>

				<?php				

		}  //while

		?>

	</ul>

</div>				

</div>

</body>
</html>