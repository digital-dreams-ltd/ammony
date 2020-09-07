<?php
require_once '../Database_Connect.php';
require_once '../graph_func.php';
require_once "../table_func.php";		   
require_once '../get_page_func.php';
require_once "../get_filter_parameter.php";	
require_once "../select_page.php";
if(isset($report_type))
{
	if($report_type==0)
	{
		if(!empty($igroup)) 
		{
			if(!empty($sec))require_once "run_distribution_report.php";
			else require_once "run_group_report.php";
		}
		else require_once "run_plain_report.php";
	}else if($report_type==1)
	{
		require_once "run_register_report.php";
	}else if($report_type==2)
	{
		require_once "run_balance_report.php";
	}


}
?>