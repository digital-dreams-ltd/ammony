<?php
function getCategory($type,$id)
{
	require "Database_Connect.php";
	$query="select name from customer_type where typeid='$id'";
	$function_result=$db->query($query) or die($db->error);
	list($function_verge_name)=$function_result->fetch_row();
	return $function_verge_name;
}
function getCategoryList($type,$id)
{	
	require_once "Database_Connect.php";
	$count=0;
	$query="select  typeid,name from customer_type order by name";
	$result=$db->query($query) or die($db->error);
	while ($row=$result->fetch_assoc())
	{
		$category[$type][$count]["id"]=$row["name"];
		$category[$type][$count]["name"]=$row["name"];
		$count++;
	}
	$result->free();
	return $category;
}
?>