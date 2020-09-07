<?php
function getFields($t)
{
	require "Database_Connect.php";
	$result=$db->query("desc $t") or die(mysql_error());
	while($row=$result->fetch_row())
	{
	  $col_desc[]=strtolower($row[0])  ;
	}
	return $col_desc;
}
function checkFieldExists($t,$f)
{
	global $db;
	$result=$db->query("desc $t") or die(mysql_error());
	while($row=$result->fetch_row())
	{
	  $col_desc[]=strtolower($row[0])  ;
	}
	if(array_search(strtolower($f),$col_desc) !==false) return true; else return false;
}
function checkFieldExists2($a,$f)
{
	global $db;
	while($row=$result->fetch_row())
	{
	  $col_desc[]=strtolower($row[0])  ;
	}
	if(array_search(strtolower($f),$col_desc) !==false) return true; else return false;
}
function transferTableRow($t1,$t2,$id)
{
	global $db;
	$fields=getFields($t1);
	$v="";
	for($i=1;$i<count($fields);$i++)
	{
		if($v!="") $v .=",";
		$v .=$fields[$i];
	}
	$idrow=$fields[0];
	$query="insert into $t2 ($v) select $v from $t1 where $idrow = $id";
	$result=$db->query($query) or die(mysql_error());
}

function extractRow($table,$idcol, $id)
{
	global $db;
	$result=$db->query("desc $table") or die(mysql_error());
	while($row=$result->fetch_row())
	{
	  $col_desc[]=strtolower($row[0])  ;
	}
	$query="select * from $table where $idcol = '$id'";
	$result=$db->query($query) or die(mysql_error());
	while($row=$result->fetch_row())
	{
	  for ($i=1;$i<count($col_desc); $i++)
	  {
	  	$v=$col_desc[$i];
		$GLOBALS["$v"]=htmlspecialchars_decode($row[$i])  ;
	  }
	  if(isset($GLOBALS["datacol"]))$GLOBALS["datacol"]=explode(',',$GLOBALS["datacol"]);
	  if(isset($GLOBALS["datacol_label"]))$GLOBALS["datacol_label"]=explode(',',$GLOBALS["datacol_label"]);
	}
		
}
function getLastInsert($idcol,$table,$param)
{
	global $db;
	$query="select $param from $table order by $idcol desc limit 1";
	$gt_result=$db->query($query) or die($db->error.$query);
	if($r=$gt_result->fetch_row())
	{
		return $r[0];
	}
	return false;
}
function getLastInsert2($idcol,$table,$param)
{
	global $db;
	$query="select $param from $table order by $idcol desc limit 1";
	$gt_result=$db->query($query) or die($db->error);
	if($r=$gt_result->fetch_row())
	{
		return $r[0];
	}
	return false;
}
function getSynchParam($idcol,$table,$param,$search)
{
	$query="select $param from $table where $idcol='$search' ";
	$gt_result=$db->query($query) or die($db->error.$query);
	while($r=$gt_result->fetch_row())
	{
		$query2="replace into synch (transcid,`table`,entrydate) values ('{$r[0]}','$table',now())";
		$db->query($query2) or die($db->error.$query2);
		
	}
	return true;
}
function getParam($idcol,$table,$param,$search)
{
	global $db;
	$query="select $param from $table where $idcol='$search' limit 1";
	$gt_result=$db->query($query) or die($db->error.$query);
	if($r=$gt_result->fetch_row())
	{
		return $r[0];
	}
	return false;
}
function getParamS($table,$param,$search)
{
	global $db;
	if(!empty($search)) $search= "where $search";
	$query="select $param from $table $search limit 1";
	$gt_result=$db->query($query) or die($db->error.$query);
	if($r=$gt_result->fetch_row())
	{
		return $r[0];
	}
	return false;
}
function getParamSG($table,$param,$search,$group)
{
	global $db;
	if(!empty($search)) $search= "where $search";
	if(!empty($group)) $group= "group by $group";
	$query="select $param from $table $search  $group limit 1";
	//die($query);
	$gt_result=$db->query($query) or die($db->error.$query);
	if($r=$gt_result->fetch_row())
	{
		return $r[0];
	}
	return false;
}
function getMultiParam($table,$param,$search,$group)
{
	global $db;
	if(!empty($search)) $search= "where $search";
	if(!empty($group)) $group= "group by $group";
	$p=array();
	$c=explode(",",$param);
	$query="select $param from $table $search  $group ";
	$gt_result=$db->query($query) or die($db->error.$query);
	while($r=mysql_fetch_array($gt_result,MYSQL_ASSOC))
	{
		foreach($c as $k => $v)
		{
			$p[$v][]=$r["$v"];
		}
	}
	return $p;
}

function updateParam($idcol,$table,$param,$search,$value)
{
	global $db;
	$query="update $table set $param ='$value' where $idcol='$search' limit 1";
	$gt_result=$db->query($query) or die($db->error.$query);
	return $gt_result;
}
function incrementParam($idcol,$table,$param,$search,$value)
{
	global $db;
	$q="select $param from $table where $idcol='$search' limit 1";
	$rs=$db->query($q) or die($db->error.$query);
	if($rw=$rs->fetch_row())
	{
		$query="update $table set $param='' where $idcol='$search' and $param is null limit 1";
		$gt_result=$db->query($query) or die($db->error.$query);
		$query="update $table set $param= $param + '$value' where $idcol='$search' limit 1";
		$gt_result=$db->query($query) or die($db->error.$query);
	} else
	{
		$query="insert into $table set $param=  '$value', $idcol='$search' , transcid=concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )) ";
		$gt_result=$db->query($query) or die($db->error.$query);
	}
	$query="select transcid from $table where $idcol='$search' limit 1";
	$gt_result2=$db->query($query) or die($db->error);
	if($r=mysql_fetch_row($gt_result2))
	{
		$query="replace into synch (transcid,`table`,entrydate) values ('{$r[0]}','$table',now())";
		$db->query($query) or die($db->error);
	}
	return $gt_result;
}


function adv_extract($ar)
{
	global $db;
	$s=array();
	foreach($ar as $k=>$v)
	{
		
		$GLOBALS["$k"] =$db->real_escape_string($v);
	}

}
?>