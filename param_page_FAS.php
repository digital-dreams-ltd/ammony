<?php
// Settings parameters
	$param["document"]=array("t"=>"document",'idcol'=>'id','sub_title'=>'document','transcid'=>false,"c"=>"title,Title,t,a|description,Description,c,a|src,Source,p,a",'fixed'=>'type=1');
	
	$param["services"]=array("t"=>"service",'idcol'=>'id','sub_title'=>'Service','transcid'=>false,"c"=>"name,name,t,a|description,Description,c,a|startdate,Start Date,p,a",'fixed'=>'type=1');
	$param["services"]["_form"]["left"][""]="name,Name,r,l|description,Description,r,l";
	$param["services"]["_form"]["left"]["Details"]="start_date,Start Date,r,d|end_date,End Date,r,d|cost,Cost,r,n";
	$param["services"]["_form"]["left"]["Vendor"]="vendor_id,Vendor ID,r,cb,vendor";
	
	$param["comments"]=array("t"=>"comment",'idcol'=>'id','sub_title'=>'comment','transcid'=>false,"c"=>"description,Description,t,a|date,Date,i,a",'fixed'=>'type=1');
	$param["comments"]["_form"]["left"][""]="description,Comment,r,t";
?>