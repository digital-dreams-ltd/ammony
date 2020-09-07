<?php

	require_once 'Database_Connect.php';

	$q="alter table transactions add jid int after glaccount_type, add joborder varchar(255) after jid";

	$db->query($q) or die($db->error);





?>