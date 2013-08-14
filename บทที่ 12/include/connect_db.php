<?php

$DBServer = "localhost";
$DBName = "webapp_restaurant";
$DBUsername = "root";
$DBPassword = "root";

$conn = mysql_connect($DBServer, $DBUsername , $DBPassword ) or die("ไม่สามารถติดต่อฐานข้อมูลได้");

mysql_select_db($DBName,$conn);
mysql_query("SET NAMES UTF8");

?>