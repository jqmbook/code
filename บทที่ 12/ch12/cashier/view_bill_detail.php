<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";
?>

<div data-role="page" id="page-view_bill_detail" data-overlay-theme="a" >
	<div data-role="header" data-position="fixed">
		<a href="view_table_check_bill.php" data-ajax="false" data-icon="back">กลับ</a>
		<h1>บิลโต๊ะ <span id="table_num"><?=$_GET['table_number']?></span></h1>
		<a href="#" id="btn_print" >พิมพ์ </a>
	</div>
		
	<div data-role="content">
		<?php
		$sql_bill_info = "select * from Bill join DinningTable on Bill.table_id=DinningTable.table_id ";
		
		$sql_bill_info .= "where payment_type is NULL and Bill.bill_id=". $_GET['bill_id'];
		$res_bill_info = mysql_query($sql_bill_info) or die(mysql_error());		
		
		$row_bill_info = mysql_fetch_array($res_bill_info);
			
		?>
		<div align="center"><strong>Webapp Restaurant</strong></div><p>
			<div class="ui-grid-a" id="grid_bill_info">
				<div class="ui-block-a" style="width:25%;line-height:1.5;">Bill ID</div>
				<div class="ui-block-b" style="width:75%;line-height:1.5;">:&nbsp;&nbsp;&nbsp;<span id="bill_id"><?=$row_bill_info['bill_id']?></span></div>
				<div class="ui-block-a" style="width:25%;line-height:1.5;">โต๊ะ</div>
				<div class="ui-block-b" style="width:75%;line-height:1.5;">:&nbsp;&nbsp; <?=$row_bill_info['table_number']?></div>
				<div class="ui-block-a" style="width:25%;line-height:1.5;">วัน/เวลา</div>
				<div class="ui-block-b" style="width:75%;line-height:1.5;">:&nbsp;&nbsp; <?=$row_bill_info['datetime']?></div>
			
			</div>
			<p>
			
				<div class="ui-grid-b" id="grid_bill_detail">
					<div class="ui-block-a grid_heading">รายการ</div>
					<div class="ui-block-b grid_heading">จำนวน</div>
					<div class="ui-block-c grid_heading">รวม</div>
							
					<?php
				
					$sql = "select Bill.bill_id, Bill.table_id, Bill_Detail.menu_id, menu_name, sum(quantity) as sumquan, sum(menu_price * quantity) as amount ";
			
					$sql .= "from Bill_Detail join Bill on Bill_Detail.bill_id=Bill.bill_id ";
					$sql .= "join Menu on Bill_Detail.menu_id=Menu.menu_id ";
					$sql .= "join DinningTable on Bill.table_id=DinningTable.table_id ";
					$sql .= " where Bill.bill_id=". $_GET['bill_id'];
		
					$sql .= " group by menu_id order by datetime ASC";
					
					$res = mysql_query($sql) or die (mysql_error());
				
					$total = 0;

					while($row = mysql_fetch_array($res)){
						?>
						<div class="ui-block-a"> 					
							<?=$row['menu_name']?>
				
						</div>
					
						<div class="ui-block-b"> 
							<?=$row['sumquan']?>
						</div>
				
						<div class="ui-block-c">
							<?=number_format($row['amount'])?>
						</div>					

						<?php				
						$total += $row['amount'];
					} //while

					?>
					<div class="ui-block-a"></div>
					<div class="ui-block-b"></div>
					<div class="ui-block-c"></div>
					
					<div class="ui-block-a"></div>
					<div class="ui-block-b">รวมทั้งสิ้น</div>
					<div class="ui-block-c"><span style="font-size:22px;line-height:1.0;" id="bill_total"><strong><?=number_format($total)?></strong></span></div>					
						
				</div><!-- /grid-b -->
			
			</div>			
		
			<div data-role="footer" data-position="fixed"  >
				<div class="ui-grid-b" id="grid_bill_footer" style="text-align:center;">
								
					<div class="ui-block-a" >
						<select name="select" id="select_payment_type" data-mini="true" >
							<option value="CASH">เงินสด</option>
							<option value="CREDIT CARD">บัตรเครดิต</option>
					  
						</select></div>
						<div class="ui-block-b"><input type="text" id="txt_cash_pay" value="" data-mini="true" style="text-align:right;"/></div>
						<div class="ui-block-c">
							<a href="#" data-role="button" data-theme="b" id="pay_bill"><span style="font-size:18px;">ชำระเงิน</span></a>
						</div>
												
					</div><!--grid-->
						
				</div>
							
			</div>
			