<?php

function remove_backslash($data)
{
	$clean_data = array();
	
	foreach ($data as $key=>$value)
	{
		$key = stripslashes($key);
		
		if(is_array($value)){
			remove_backslash($value);
		}else {
			$clean_data[$key]=stripslashes($value);
		}		
	}
	
	return $clean_data;
}


if (get_magic_quotes_gpc())
{	
	$_GET = remove_backslash($_GET);
	$_POST = remove_backslash($_POST);
	$_REQUEST = remove_backslash($_REQUEST);
	$_COOKIE = remove_backslash($_COOKIE);
}

?>