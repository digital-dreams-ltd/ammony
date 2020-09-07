<?php
function prepareUpdate($tid, $stci)
{
	global $_update,$db;
	$q="update transactions set amount_paid=0 where amount_paid is null";
	$result = $db->query($q) or die($db->error.$q);
	$q="select cid, group_concat(it_id) from transactions where trans_no='$tid' group by trans_no";
	$result = $db->query($q) or die($db->error.$q);
	while($row = $result->fetch_row()) 
	{
		$cid=$row[0];
		$_update[]="update customer as t1 set current_balance=(select sum(amount_due - amount_paid) from transactions as t2 where t1.cid=t2.cid and sub=0 group by cid) where cid='$cid'";
		$it_id=explode(',',$row[1]);
		foreach($it_id as $k => $v )
		{
			$_update[]="update item as t1 set quantity_on_hand=(select sum(sign* quantity) from transactions as t2 where t2.it_id=t1.tid group by it_id) where tid='$v'";
		
		}
	
	}
	if(empty($stci)) $stci=0;
	$q="select group_concat(amount_paid),group_concat(discount), group_concat(it_id) from transactions where trans_no='$tid' and type=1 and tid not in ($stci) and sub<>0 group by trans_no";
	
	$result = $db->query($q) or die($db->error.$q);
	while($row = $result->fetch_row()) 
	{
		$amt=explode(',',$row[0]);
		$dst=explode(',',$row[1]);
		$it_id=explode(',',$row[2]);
		foreach($it_id as $k => $v )
		{
			$cx=$amt[$k] + $dst[$k];
			echo "update transactions set applied_credit=applied_credit -'$cx', net_due=net_due + '$cx' where tid='$v'";
			$_update[]="update transactions set applied_credit=applied_credit -'$cx', net_due=net_due + '$cx' where tid='$v'";
		
		}
	
	}

}
function executeUpdate()
{
	global $_update,$db;
	foreach($_update as $k => $q)
	{
		$db->query($q) or die($db->error.$q);
	
	}
	$_update=array();
}

?>