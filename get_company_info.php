<?php
		require_once "Database_Connect.php";
		$company_name="";
		$n_cols="name,shortname,staff_prefix,address1,address1_title,address1_phone,address2,address2_title,address2_phone,address3,address3_title,address3_phone,motto,latlng,pic_ref,logo_ref,bg_ref,website,sms_sender,email,email_sender,sms_acount_name,sms_acount_password,return_policy,sale_message";
		$query="select $n_cols from company_info where id='1'";
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			foreach($row as $k => $v)
			{
				${"company_".$k}=$v;
			}
		}else
		{
			$pcol=explode(",",$n_cols);
			foreach($pcol as $k => $v)
			{
				${"company_".$v}="";
			}
		}
		if(empty($company_sms_sender)) $company_sms_sender="LinkBiz";
		if(empty($company_email_sender)) $company_email_sender="LinkBiz";
		if(empty($company_staff_prefix)) $company_staff_prefix="EMP";
		$con=array($company_sms_acount_name,$company_sms_acount_password);
		$result->free();		

?>