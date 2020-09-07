<?php
	date_default_timezone_set("UTC");
	$db = mysqli_connect("localhost","digitav2_newbiz","Draco1982?","digitav2_newbiz")  ;

	if($db->connect_errno > 0){

    die('Unable to connect to database [' . $db->connect_error . ']');

}

	

	$_color=array("green","yellow darken-4","red","blue darken-3","cyan darken-3","teal darken-4");

	$_color_count=count($_color);

	//if(isset($_COOKIE["ELIMS-Warehouse"])) $_wd=" and (warehouse is null or warehouse='' or warehouse='".$_COOKIE["ELIMS-Warehouse"]."')"; else $_wd='';
    if(!empty($_COOKIE["ELIMS-Warehouse"])) $_wd=" and warehouse='".$_COOKIE["ELIMS-Warehouse"]."'"; else $_wd='';
	

?>