<?php
	date_default_timezone_set("UTC"); 
	//if(isset($_COOKIE["ELIMS-Warehouse"])) $_wd=" and (warehouse is null or warehouse='' or warehouse='".$_COOKIE["ELIMS-Warehouse"]."')"; else $_wd='';
	if(!empty($_COOKIE["ELIMS-Warehouse"])) $_wd=" AND warehouse='".$_COOKIE["ELIMS-Warehouse"]."'"; else $_wd='';
	
		//if(!empty($_COOKIE["ELIMS-Warehouse_Name"])) $_wdn=" and ( warehouse is null or warehouse='' or warehouse='".$_COOKIE["ELIMS-Warehouse_Name"]."')"; else $_wdn='';
		if(!empty($_COOKIE["ELIMS-Warehouse_Name"])) $_wdn=" AND warehouse='".$_COOKIE["ELIMS-Warehouse_Name"]."'"; else $_wdn='';
		//$_wdn='';
	require_once "param_page.php";

	extract($_GET, EXTR_OVERWRITE);

	extract($_POST, EXTR_OVERWRITE);

	//print_r($_POST);

	if(isset($pageType))

	{	$pageType=trim($pageType);

		if(isset($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);

	

	}

		//echo $delIds .'pppp';







?>