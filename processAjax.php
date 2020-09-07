<?php
//Send some headers to keep the user's browser from caching the response.

$_exception=1;
$sort_col="";$sort_col2=""; $ncount;

require('Database_Connect.php');
require_once "table_func.php";
require_once "get_page_func.php";
require_once "select_page.php";
require_once "get_param.php";

//Create the XML response.
//Check to ensure the user is in a chat room.
$json=array();
if(isset($new))
{
	 $table_fields=getFields($t);
	 $col=""; $val =""; $ct=0;
	foreach($_GET as $k => $v)
	{
		if(array_search(strtolower($k),$table_fields) !==false)
		{
		  $col[]="`{$k}`='{$v}'";
		}
	}
	foreach($_POST as $k => $v)
	{
		if(array_search(strtolower($k),$table_fields) !==false)
		{
			$col[]="`{$k}`='{$v}'";
		}
	}
	if(!empty($newcol))
	{
		$col[]="`$newcol`='$new'";
	}
	if(!empty($fixed))
	{
		$col[]="$fixed";
	}	
		$colstr=implode(',',$col);
		if(!empty($extras)) $colstr.=','.$extras;
	  $sql = "insert into $t set $colstr";
	  $db->query($sql) or die($db->error.$sql);
	  $sql = "select $idcol  from $t order by $idcol desc limit 1";
	  $res=$db->query($sql) or die($db->error.$sql);
	  if($rw=$res->fetch_row()) $json=$rw[0] ; else $json=0;
}else if(isset($_edit))
{
	if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']>=2)
	{
		 $table_fields=getFields($t);
		 $col=""; $val =""; $ct=0;
		foreach($_GET as $k => $v)
		{
			if(array_search(strtolower($k),$table_fields) !==false)
			{
				$col[]="`{$k}`='{$v}'";
			}
		}
		foreach($_POST as $k => $v)
		{
			if(array_search(strtolower($k),$table_fields) !==false)
			{
				$col[]="`{$k}`='{$v}'";
			}
		}	
			$colstr=implode(',',$col);
		  $sql = "update $t set $colstr where $idcol='$edit'";
		  $db->query($sql) or die($db->error.$sql);
		  $json=$edit;
	}else $json=0;
} else if(isset($id))
{
	$sql = "SELECT * FROM $t where $idcol = '$id'";
		//echo $sql;
	  $result = $db->query($sql) or die($db->error.$sql);
	  //Loop through each message and create an XML message node for each.
	  
	  while($row = $result->fetch_assoc()) 
	  {
	  	$nr=array();
		foreach($row as $k => $v)
		{
			if(empty($v)) continue;
			$k1=strtolower($k);
			$nr[$k1]=$v;
		}
		$json[]=$nr;
	  }
}else if(isset($delIds))
{
	if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']==3)
	{
		$query="delete from $t where $idcol in ($delIds)";
		$result = $db->query($query) or die($db->error);
		$json=1;
	}else $json=0;
}
else if(isset($voidIds))
{
	if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']==3 && !empty($voidIds))
	{
		$trans_no=time().rand(5,50);
		$query="insert into $t (memo ,	ref ,method ,`date`,`date_due`,c_type,cid ,cref ,customer ,address,city,state,zipcode,country,telephone,email,customerPO,quantity,gl_quantity,subdivision,it_id,it_type,itemid,description,rate,amount_due,amount_paid,applied_credit,net_due,amount,discount,gl_amount,wharehouse,wharehouse_name,sign,account_id,account,account_name,account_type,glaccount_id,glaccount,glaccount_name,glaccount_type,trans_no,s_no,trans_type,type,prepayment,sub,approved,user,clientid) select memo ,	concat(ref,' - V') ,method ,`date`,`date_due`,c_type,cid ,cref ,customer ,address,city,state,zipcode,country,telephone,email,customerPO,-quantity,-gl_quantity,subdivision,it_id,it_type,itemid,description,rate,-amount_due,-amount_paid,-applied_credit,-net_due,-amount,discount,-gl_amount,wharehouse,wharehouse_name,sign,account_id,account,account_name,account_type,glaccount_id,glaccount,glaccount_name,glaccount_type,'$trans_no',s_no,trans_type,type,prepayment,sub,approved,user,clientid from $t where $idcol in ($voidIds)";
		$result = $db->query($query) or die($db->error);
		$json=1;
	}else $json=0;
}
else if(isset($t))
{
	$coldesc=array();$column=array();$element=array();
	if(!isset($table_fields)) $table_fields=getFields($t);
	$cp = explode("|",$c);
	foreach($cp as $k=> $v)
	{
		$crp=explode(",",$v);
		$column[$k]=$crp[0];
		$coldesc[$k]=$crp[1];
		if(!empty($crp[2]))$element[$k]=$crp[2]; else $element[$k]="t";
		if(!empty($crp[3]))$actions[$k]=$crp[3]; else $actions[$k]="";
		if(!empty($crp[4]))$source[$k]=$crp[4]; else $source[$k]="";
		
	}
	$json["desc"]=$coldesc;
	$json["col"]=$column;
	$json["fmt"]=$element;
	$json["ord"]=$actions;
	$col=""; $val =""; $ct=0;
	foreach($column as $k => $v)
	{
		if(array_search(strtolower($v),$table_fields) !==false)
		{
		  if($ct)
		  {
		  		$col .=",";
			  if(!empty($search))$val .=" or ";
		  }
		  $col .="`{$v}`";
		  if(!empty($search))$val .="$v like '%{$search}%'";
		  if($sort_col=="") $sort_col=$v;
		  $sort_col2 .= ", `{$v}`"; 
		  $ct++;
		}
	}
	$text="";
	if(!empty($condition))
	{
		$cnd=explode("|",$condition);
		 $combine="and";
		foreach($cnd as $k => $v)
		{
			$tx=explode(",",$v);
			if(empty($tx[1])) continue;
			if($text !="") $text .=" $combine "; 
			if(isset($tx[2]) && $tx[2]=="negate")
		   {
			   $text .=$tx[0]. "<>'". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="null")
		   {
			   $text .=$tx[0]. " is null ";
		   }else if(isset($tx[2]) && $tx[2]=="not")
		   {
			   $text .=$tx[0]. " not like '". $tx[1]. "'";
		   } else if(isset($tx[2]) && $tx[2]=="start")
		   {
			   $text .=$tx[0]. " like '". $tx[1]. "%'";
		   } else if(isset($tx[2]) && $tx[2]=="end")
		   {
			   $text .=$tx[0]. " like '%". $tx[1]. "'";
		   } else if(isset($tx[2]) && $tx[2]=="contain")
		   {
			   $text .=$tx[0]. " like '%". $tx[1]. "%'";
		   }else if(isset($tx[2]) && $tx[2]=="greater")
		   {
			   $text .=$tx[0]. " > '". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="less")
		   {
			   $text .=$tx[0]. " <'". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="date")
		   {
			   $text .=getDateValue($tx[1],$tx[0]);
		   }
		   else {
		   	 $text .=$tx[0]. "='". $tx[1]. "'";
			}
		
		}
	}
	if(!empty($filter))
	{
		if($text !="" ) $text .=" and ";
		$text .=$filter;
	}
	if(isset($dateRange))
	{
		if($text !="" && $dateRange !="All Time" ) $text .=" and "; 
		 $text .=getDateValue($dateRange,$dateColumn);
	}
	if(isset($page) && isset($limit)) 
	{	
		$lt=($page - 1) *$limit;
		if($lt <0) $lt=0;
		$limit_query= " LIMIT $lt , $limit ";
		
	}else if(isset($limit))
	{
		$limit_query= "LIMIT $limit ";
	} else $limit_query= "";
	
	if(!empty($val)) $val = "where ($val) ";
	if(!empty($val) && !empty($text)) $val .= "and $text";  else if(empty($val) && !empty($text)) $val = "where $text"; 
	if(!empty($idcol) && !empty($pkey)) $val ="where $idcol='$pkey'";
	if(!empty($col))
	{		  
	  if(!empty($idcol)) $col= "$idcol , $col";
	  $sql = "SELECT $col FROM $t $val order by $sort_col $sort_col2 $limit_query";
	  
	//die($sql);
		
	  $result = $db->query($sql) or die($db->error.$sql);
	  //Loop through each message and create an XML message node for each.
	  
	  while($row = $result->fetch_row()) 
	  {
	  	$r=array();
		$r["i"]=$row[0];
	  	for($k=1;$k<count($row);$k++)
		{
			if($actions[$k-1]=='s') $row[$k]=getDataValue($row[$k],$source[$k-1]);
			$r["c"][]=$row[$k];
		}
		
		  $json["row"][]=$r;
	}	  
	  $result->free();
	}
}

echo json_encode($json);
$db->close();
?>