<?php
$source_count=0; $extras="";
require_once "Database_Connect.php";
require_once "table_func.php";
require_once "select_page.php";
//print_r($_POST);
			adv_extract($_POST); 
if(!empty($extras)) $extras =",".$extras;			
if(!empty($fixed)) {$extras =",".$fixed;}			
if(!empty(${$idcol})) {
if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']>=2)
	{	 
	  $table_fields=getFields($t);

			$col=""; $val =""; $c=0;
			foreach($_POST as $k => $v)
			{
 				if(array_search(strtolower($k),$table_fields) !==false)
				{
				  if($c)
				  {
					  $col .=",";
					  $val .=",";
				  }
				  $v=$db->real_escape_string($v);
				  $col .="$k='{$v}'";
				  $value[]=$v;
				  $key[]=$k;
				  $c++;
				}
			}
			
			$query="update $t set $col $extras where $idcol='${$idcol}'";
			$db->query($query) or die($db->error);
			$id=${$idcol};
	}else $id=0;
} else
{
if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']>=1)
	{	 
	  $table_fields=getFields("$t");
			
			
			$col=""; $val =""; $c=0;
			foreach($_POST as $k => $v)
			{
 				if(array_search(strtolower($k),$table_fields) !==false)
				{
				  if($c)
				  {
					  $col .=",";
					  $val .=",";
				  }
				  $col .="$k";
				  $val .="'".$db->real_escape_string($v)."'";
				  $col2[] ="$k="."'".$db->real_escape_string($v)."'";
				  $value[]=$v;
				  $key[]=$k;
				  $c++;
				}
			}
			$colstr=implode(",",$col2);
			if(!empty($transcid))
			{
				$query="insert into $t set transcid=concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )),$colstr $extras";
			} else $query="insert into $t set $colstr $extras";
			$db->query($query) or die($db->error);
			
			$result=$db->query("select $idcol from $t order by $idcol desc limit 1 ") or die($db->error);
			$row=$result->fetch_row();
			$id=$row[0];
	}else $id=0;		
	
}
echo $id;
?>