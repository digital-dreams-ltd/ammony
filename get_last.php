<?php

function getlast($type)

{
	if(isset($_COOKIE["ELIMS-Warehouse"])) $_whs=$_COOKIE["ELIMS-Warehouse"]; else $_whs='';
	require "Database_Connect.php";

	 $function_verge_name=0;

	$query="select  number from file_count where type='$type' and warehouse='$_whs' limit 1";

	$function_result=$db->query($query) or die($db->error);

	list($func)=$function_result->fetch_row();

	if(empty($func))

	{

		$db->query("insert into file_count set number=1, type='$type', warehouse='$_whs'") or die($db->error);

	}else $db->query("update file_count set number=number +1 where type='$type' and warehouse='$_whs'") or die($db->error);

	

	return $func +1;

}

?>