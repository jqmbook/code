<?php 

$uname=$_POST["username"];
$pwd=$_POST["password"];

?>
		<div data-role="page" id="page-php">			
			<div data-role="header"data-position="fixed">				
				<h1>Header</h1>				
			</div>
			<div data-role="content">	
						
				username ของคุณคือ <?=$uname?> <br>
				password ของคุณคือ <?=$pwd?>
         		
			</div>						
			<div data-role="footer" data-position="fixed">
				<h4>Footer</h4>		
			</div>
		</div>				
		