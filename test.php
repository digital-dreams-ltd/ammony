<?php
 	require_once "Database_Connect.php";
 	
	$sql="SELECT * FROM transactions where date='2018-02-21' and trans_type='GNJ' ORDER BY tid desc limit 50 ";
	$result=$db->query($sql) or die($db->error);
	while($row=$result->fetch_assoc())
	{
	
		print_r($row);
		echo "<br><br>";
	}

?>