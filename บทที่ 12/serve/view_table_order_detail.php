<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>


<div data-role="page" id="page-view_table_order_detail" data-overlay-theme="a" >
	<div data-role="header">
		<a data-rel="back" data-icon="back">กลับ</a>
		<h1>ออร์เดอร์โต๊ะ <span id="table_num"><?=$_GET['table_number']?></span></h1>

	</div>

	<div data-role="content">			 

		<ul data-role="listview" id="list_table_order_detail" data-inset="true">

			<?php

		$sql = "select Temp_Orders.menu_id, menu_name, sum(quantity) as sumquan,sum(menu_price * quantity) as amount ";

		$sql .= "from Temp_Orders join Menu on Temp_Orders.menu_id=Menu.menu_id ";
		$sql .= "join DinningTable on Temp_Orders.table_id=DinningTable.table_id ";
		$sql .= "where (status like 'order' or status like 'served') and table_number like '". $_GET['table_number'] ."' ";

		$sql .= "group by menu_id order by datetime ASC";

		$res = mysql_query($sql) or die(mysql_error());

		$total = 0;

		while($row = mysql_fetch_array($res)){
			?>
			<li><a class="link_menu" href="#"> 					
				<h1><?=$row['menu_name']?></h1>
				<p>จำนวน: <?=$row['sumquan']?></p>
				<?php				

				?>

				<span class="ui-li-aside" style="margin:1em auto;" data-menu_id="<?=$row['menu_id']?>"><?=number_format($row['amount'])?> บาท</span>
			</a>
		</li>

		<?php

	$total += $row['amount'];
}  //while

?>

</ul>	

<br>			

</div>

<div data-role="footer" data-position="fixed">

	<div class="ui-grid-a" id="grid_order_footer">
		<div class="ui-block-a" style="width:66%;text-align:center;padding-top:15px;font-size:18px">ยอดรวม&nbsp;&nbsp;&nbsp; <?=number_format($total)?> บาท</div>
		<div class="ui-block-b" style="width:34%;"><a href="#" data-role="button" data-theme="b" id="btn_check_bill"><span style="font-size:18px;">เช็กบิล</span></a></div>					

	</div>

</div>

</div>
