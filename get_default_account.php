<?php
function getdefault_account($id)
{
	require "Database_Connect.php";
	$query="select $id from default_account_settings limit 1";
	$function_result=$db->query($query) or die($db->error);
	list($function_verge_name)=$function_result->fetch_row();
	return $function_verge_name;
}
function get_trans_account($type,$numeric)
{
	global $default_accounts, $db;
	if(!empty($default_accounts[$type]) || $numeric==1)
	{
		$pr="";
		if($numeric)$account_id=$type; 
		else $account_id=$default_accounts[$type];
		$query="select typeid as account_id,account_name,account_id as account,account_type from account_chart where account_id='$account_id'";
		$function_result=$db->query($query) or die($db->error.$query);
		if($fname=$function_result->fetch_assoc())
		{
			foreach($fname as $k => $v)
			{
				$pr .=",$k='$v'";
			}
		}
		return $pr;
	}
	return "";
}	
	$query="select * from default_account_settings limit 1";
	$f_result=$db->query($query) or die($db->error);
	if($default_accounts=$f_result->fetch_assoc());
?>