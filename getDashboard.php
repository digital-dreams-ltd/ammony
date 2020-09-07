<?php
require_once "Database_Connect.php";
require_once "get_page_func.php";
require_once "table_func.php";
if(isset($_GET['register']))
{
	echo '
	{
	 "cols": [
			{"id":"","label":"Transaction","pattern":"","type":"string"},
			{"id":"","label":"Amount","pattern":"","type":"number"},
			{"id":"","label":"Number","pattern":"","type":"number"}
			
		  ],
	 "rows": [
	';
	$r=array("Invoice"=>"INV","Receipt"=>"RCP","Purchase"=>"PCH","Payment"=>"PYT","Credit Memo"=>"CDM","Vendor Credit Memo"=>"VCM");
		$i=0;
		foreach($r as $k => $v)
		{
			$q="select sum(amount), count(*) from transactions where trans_type='$v' and sub=0 and date=curdate() group by trans_type";
			$result = $db->query($q) or die($db->error.$q);
		  //Loop through each message and create an XML message node for each.
				
		  while($row = $result->fetch_row()) 
		  {
				if($i) echo ',';
				echo '{"c":[{"v":"'.$k.'","f":null},{"v":'.$row[0].',"f":null},{"v":'.$row[1].',"f":null}]}';
				$i++;
				}
				
			}
	echo '  ]
		}';	
} 
if(isset($_GET['balance']))
{
	echo '
	{
	 "cols": [
			{"id":"","label":"Type","pattern":"","type":"string"},
			{"id":"","label":"Amount","pattern":"","type":"number"}
		  ],
	 "rows": [
	';
	$r=array("Postive Balance"=>"current_balance>0","Zero Balance"=>"current_balance=0","Negative Balance"=>"current_balance<0");
	
		$i=0;
		foreach($r as $k => $v)
		{
			$q="select sum(current_balance) from customer where $v";
			$result = $db->query($q) or die($db->error.$q);
		  //Loop through each message and create an XML message node for each.
				
		  	while($row = $result->fetch_row()) 
		  	{
		  		if(empty($row[0])) $row[0]=0;
				if($i) echo ',';
				echo '{"c":[{"v":"'.$k.'","f":null},{"v":'.$row[0].',"f":null}]}';
				$i++;
			}
				
		}
	echo '  ]
		}';	
}
if(isset($_GET['receivable']))
{
	if(isset($_COOKIE["today"])) $cdate =$_COOKIE["today"]; else $cdate= date("Y-m-d"); 
	echo '
	{
	 "cols": [
			{"id":"","label":"Duration","pattern":"","type":"string"},
			{"id":"","label":"Amount","pattern":"","type":"number"}
		  ],
	 "rows": [
	';
	$r=array("0 - 30 days"=>" date >='$cdate' - INTERVAL 30 DAY","31 - 60 days"=>"date <'$cdate' - INTERVAL 30 DAY and date >='$cdate' - INTERVAL 60 DAY","61 - 90 days"=>"date <'$cdate' - INTERVAL 60 DAY and date >='$cdate' - INTERVAL 90 DAY","over 90 days"=>"date<'$cdate' - INTERVAL 90 DAY");
		$i=0;
		foreach($r as $k => $v)
		{
			$q="select sum(net_due) from transactions where $v and trans_type='INV'";
			$result = $db->query($q) or die($db->error.$q);
		  //Loop through each message and create an XML message node for each.
				
		  	while($row = $result->fetch_row()) 
		  	{
		  		if(empty($row[0])) $row[0]=0;
				if($i) echo ',';
				echo '{"c":[{"v":"'.$k.'","f":null},{"v":'.$row[0].',"f":null}]}';
				$i++;
			}
				
		}
	echo '  ]
		}';	
}
if(isset($_GET['sales']))
{
	if(isset($_COOKIE["_today"])) $cdate =$_COOKIE["_today"]; else $cdate= date("Y-m-d"); 
	echo '
	{
	 "cols": [
			{"id":"","label":"Date","pattern":"","type":"string"},
			{"id":"","label":"Amount","pattern":"","type":"number"},
			{"id":"","label":"Number","pattern":"","type":"number"}
		  ],
	 "rows": [
	';

			$q="select date,sum(amount),count(*) from transactions where date >='$cdate' - INTERVAL 30 DAY and sign=-1 and quantity is not null and it_id is not null group by date";
			$result = $db->query($q) or die($db->error.$q);
		  //Loop through each message and create an XML message node for each.
			$i=0;	
		  	while($row = $result->fetch_row()) 
		  	{
		  		if(empty($row[0])) $row[0]=0;
				if($i) echo ',';
				echo '{"c":[{"v":"'.$row[0].'","f":null},{"v":'.$row[1].',"f":null},{"v":'.$row[2].',"f":null}]}';
				$i++;
			}
				

	echo '  ]
		}';	
}

?>