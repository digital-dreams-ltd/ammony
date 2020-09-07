<?php
	require_once "Database_Connect.php";
	
	$q="select tid,itemid from transactions where date>'2018-05-01'";
	$result = $db->query($q) or die($db->error.$q);
	while($row = $result->fetch_row()) 
	{
		$tid=$row[0];
		$tem=$row[1];
		$_sq="select tid from item where  itemID='$tem'";
		$res = $db->query($_sq) or die($db->error.$_sq);
		if($r = $res->fetch_row()) 
		{
			$it_id=$r[0];
		
		
			$_update="update transactions set it_id='$it_id' where tid='$tid'";
			//echo $_update."<br>";
			$db->query($_update) or die($db->error.$_update);
		}
	
	}

?>
