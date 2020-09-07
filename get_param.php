<?php
	require_once "Database_Connect.php";
	require_once "param_page.php";
	require_once "get_page_func.php";
	function loadData($pageType)
	{
		if($pageType=="period")
		{
			$v=getDatePeriod();
			foreach($v as $k=> $v1){ $v2[$v1]=$v1;}
			return $v2;
		}
		if($pageType=="active")return array("Inactive","Active");
		if($pageType=="publish")return array("","Publish On Website");
		if($pageType=="accessLevel")return array("View Access","Creation Access","Modification Access","Full Access");
		if($pageType=="paymentMode")return array("Cash","Check","Transfer","POS");
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return 0;
		
		}else return 0;
		
		$p=explode("|",$c);
		$p1=explode(",",$p[0]);
		$name=$p1[0];
		if(!empty($filter)) $ft="where $filter "; else $ft="";
		$query="select $idcol,$name from $t $ft order by $name";
		$result=$db->query($query) or die($db->error);
		while($row=$result->fetch_assoc())
		{
			$id=$row["$idcol"];
			$data["$id"]=$row["$name"];
		}
		return $data;
	}
	function getData($pageType)
	{
		
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return '';
		
		}else return '';
		
		$p=explode("|",$c);
		$p1=explode(",",$p[0]);
		$name=$p1[0];
		$data='';
		if(!empty($filter)) $f="where $filter"; else $f='';
		$query="select $idcol,$name from $t $f order by $name";
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			$id=$row["$idcol"];
			$data=$row["$name"];
		}
		return $data;
	}
	function getDataValue($d,$pageType)
	{
		
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return '';
		
		}else return '';
		
		$p=explode("|",$c);
		$p1=explode(",",$p[0]);
		$name=$p1[0];
		$data='';
		$f="where $idcol='$d'"; 
		if(!empty($filter)) $f .=" and $filter";
		$query="select $idcol,$name from $t $f order by $name";
		//echo $query;
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			$id=$row["$idcol"];
			$data=$row["$name"];
		}
		return $data;
	}
?>