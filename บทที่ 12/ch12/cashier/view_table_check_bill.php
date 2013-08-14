<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cashier</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
		
	<link rel="stylesheet" href="../css/jquery.ui-1.8.23.custom.css" />
	<link rel="stylesheet" href="../css/jquery.mobile-1.3.0.min.css" />
				
	<link rel="stylesheet" href="css_cashier/webapp.cashier.view_bill_detail.css" />
	<link rel="stylesheet" href="css_cashier/webapp.cashier.print.css" media="print">
			
	<script src="../js/jquery-1.8.2.min.js"></script>	
	<script src="../js/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="../js/jquery.mobile-1.3.0.min.js"></script>
		
	<script src="js_cashier/webapp.cashier.view_table_check_bill.js"></script>	
	<script src="js_cashier/webapp.cashier.view_bill_detail.js"></script>	
			
</head>

<body>
		
	<div data-role="page" id="page-view_table_check_bill">			
		<div data-role="header" data-position="fixed">				
			<h1>โต๊ะอาหารที่เช็กบิล</h1>
			<a href="../index.html" data-icon="home" data-ajax="false">Home</a>							
		</div>
		
		<div data-role="content">						
			<ul data-role="listview" id="list_view_table_check_bill" data-inset="true">
				<li data-role="list-divider">โต๊ะอาหาร</li>
 
				<?php			

				$sql = "select * from Bill join DinningTable on Bill.table_id=DinningTable.table_id ";
				$sql .= "where payment_type is NULL ORDER BY Bill.bill_id ASC";

				$res = mysql_query($sql) or die(mysql_error());				

				while($row = mysql_fetch_array($res)){
	
					?>
					<li><a href="view_bill_detail.php?bill_id=<?=$row['bill_id']?>&table_number=<?=$row['table_number']?>">โต๊ะ <?=$row['table_number']?>
				
						<span class="ui-li-aside"><?=number_format($row['total'])?> บาท</span> 
					</a></li>
 
					<?php
				}
				?>
			</ul>
		</a>
	</div>						
			
</div>		

</body>
</html>	
	
