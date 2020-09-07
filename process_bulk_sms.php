<?php $sender_name="AMMONY";
require_once "Database_Connect.php";
require_once "sms_functions.php";
require_once "select_page.php";
require_once "get_company_info.php";
require_once "HTML_functions.php";

$ptcount=0;$phoneCol="Telephone";
extract($_GET, EXTR_OVERWRITE);
extract($_POST, EXTR_OVERWRITE);
	if(isset($col)) $phoneCol=$col;
	if($filter_checkbox=="")
	{
		$redirection ="../report_view_transfer.php";
		die("None Selected: Please select by checking the checkbox");
		
	}
	if(isset($filter_checkbox)) $ids=str_replace("|",",",$filter_checkbox); else if(isset($sendId)) $ids=$sendId; else $ids="";
		
		
		if(isset($sendId) && $sendId=="All")
		{
			$query="select group_concat(distinct($phoneCol)) from $_t where abs( $phoneCol ) >0 and abs( $_actionCol ) <>'80' ";
		} else
		{
			$query="select group_concat(distinct($_actionCol)) from $_t where $_idcol in ({$ids})";	
		}
		
		$rs=$db->query($query) or die($db->error.$query);
		if($rw=$rs->fetch_row())
		{
			$number=$rw[0];
			$msg=sendsms($number,$company_sms_sender,$message,$con);
			$k[0]=$msg;
			
			if(isset($k[0]) && strstr($k[0],"OK") !==false)
			{
				$msg="SMS successfully sent";
				$query="insert into sent_messages values('','SMS','$number','$message','$elims_id',now())";
				//$db->query($query) or die($db->error);
				$msg=urlencode($msg);
				
				die($msg);
			} else
			{
				$message="Problem encountered sending SMS. Please check your connection or SMS credit balance";
				die($msg);
				
			}
		}
$db->close();
?>