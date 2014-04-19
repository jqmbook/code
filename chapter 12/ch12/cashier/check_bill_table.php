<?php 
require_once "../include/common.php";
require_once "../include/connect_db.php";

$sql = "select * from DinningTable join Bill on DinningTable.table_id=Bill.table_id where payment_type is NULL ORDER BY Bill.bill_id ASC";

$res = mysql_query($sql) or die(mysql_error());

?>
<li data-role="list-divider">โต๊ะ</li>
<?php

while($row = mysql_fetch_array($res)){
	
	?>
	<li><a href="view_bill_detail.php?bill_id=<?=$row['bill_id']?>&table_number=<?=$row['table_number']?>">โต๊ะ <?=$row['table_number']?>
		<span class="ui-li-aside"><?=number_format($row['total'])?> บาท</span>
	</a></li>
 
	<?php
}
?>