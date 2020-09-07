<?php
function get_parameter_operation($c,$k, $v, $v2 )
{
				$tv=trim($v);
				$tv1=trim($v2);
				if(trim($tv) !="")
				{
				   if($k==0)
				   {
					   return "";
				   }else if($k==1)
				   {
					   return  "$c >= '{$tv}'  and $c <= '{$tv1}' ";
				   }else if($k==2)
				   {
					   return "$c = '{$tv}' ";
				   } else if($k==3)
				   {
					    return "$c < '{$tv}' ";
				   }  else if($k==4)
				   {
					    return "$c > '{$tv}' ";
				   }  else if($k==5)
				   {
					    return "$c like '{$tv}%'";
				   } else if($k==6)
				   {
					    return "$c like '%{$tv}'";
				   } else if($k==7)
				   {
					    return "$c like '%{$tv}%' ";
				   }else if($k==8)
				   {
					    return "$c <> '{$tv}' ";
				   }
				}

}
function get_parameter_label($c,$k, $v, $v2 )
{
require "Database_Connect.php";
				$tv=trim($v);
				$tv1=trim($v2);
				if(trim($tv) !="")
				{
				   if($k==0)
				   {
					   return "";
				   }else if($k==1)
				   {
					   echo  strtoupper("$c")." >= {$tv}  and ".strtoupper("$c")." <= {$tv1} ";
				   }else if($k==2)
				   {
					   echo strtoupper("$c")." = {$tv} : ".getMore($c,$tv);
				   } else if($k==3)
				   {
					   echo strtoupper("$c")." < {$tv} ";
				   }  else if($k==4)
				   {
					    echo strtoupper("$c")." > {$tv} ";
				   }  else if($k==5)
				   {
					    echo strtoupper("$c")." starting with {$tv}";
				   } else if($k==6)
				   {
					    echo strtoupper("$c")." ending with '{$tv}'";
				   } else if($k==7)
				   {
					    echo strtoupper("$c")." contains '{$tv}' ";
				   }else if($k==8)
				   {
					    echo strtoupper("$c")." not equal to '{$tv}' ";
				   }
				}
				

}
function getMore($c,$tv)
{
	if($c=='itemid')
	{
		return getParam("itemid","item","description",$tv);
	}else if($c=='wharehouse')
	{
		return getParam("wharehouseid","wharehouse","wharehousename",$tv);
	}else if($c=='customer')
	{
		return getParam("customerid","customer","customername",$tv);
	}else if($c=='vendor')
	{
		return getParam("vendorid","vendor","vendorname",$tv);
	}
}
$filter_name_array=array("All","Range","Equal To","Less Than","Greater Than","Starting With","Ending With","Contains","Not Equal To");
	foreach($filter_name_array as $k => $v)
	{
		$filter_parameter_name[]=$v;

	}
	$filter_parameter_count=count($filter_name_array);

?>