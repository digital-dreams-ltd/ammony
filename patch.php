<?php
require_once "Database_Connect.php";
/*
$query="update customer as t1 set current_balance=(select sum(amount_due - amount_paid) from transactions as t2 where t1.cid=t2.cid and sub=0 group by cid) ";
	$rs=$db->query($query) or die(mysql_error());	
	echo "Customer Patched";
		$query="update item as t1 set quantity_on_hand=(select sum(sign* quantity) from transactions as t2 where t2.it_id=t1.tid group by it_id) where tid='$v'";

$rs=$db->query($query) or die(mysql_error());
echo "Item Patched";


$clientid=1;
$query21="replace into default_account_settings (sid, account_receivable,account_payable,sales,cost_of_sales,expenses,inventory,clientid) values ('1', '11000', '20000','40000','50000','12000','89000','$clientid')";
$db->query($query21) or die($db->error);
$db->query("drop table transactions") or die($db->error);
	$query6 = "CREATE TABLE IF NOT EXISTS transactions (
		  tid INT UNSIGNED NOT NULL AUTO_INCREMENT,
		  PRIMARY KEY (tid),
		  memo varchar(255),
		ref varchar(100),
		method varchar(100),
		`date` date,
		`date_due` date,
		c_type int,
		cid varchar(100),
		cref varchar(100),
		customer varchar(255),
		address	varchar	(255),
		city	varchar	(255),
		state	varchar	(255),
		zipcode	varchar	(255),
		country	varchar	(255),
		telephone	varchar	(50),
		email	varchar(255),
		customerPO varchar(255),
		quantity decimal(12,2),
		gl_quantity decimal(12,2),
		subdivision decimal(12,2),
		it_id int,
		it_type varchar(100),
		itemid varchar(100),
		description varchar(255),
		rate decimal(14,2),
		amount_due decimal(14,2),
		amount_paid decimal(14,2),
		applied_credit decimal(14,2),
		net_due decimal(14,2),
		amount decimal(14,2),
		discount decimal(14,2),
		gl_amount decimal(14,2),
		warehouse	varchar	(255),
		warehouse_name	varchar	(255),
		sign int,
		account_id int,
		account varchar(100),
		account_name varchar(255),
		account_type int,
		glaccount_id int,
		glaccount varchar(100),
		glaccount_name varchar(100),
		glaccount_type int,
		jid int,
		joborder varchar(255),
		trans_no bigint,
		s_no varchar(255),
		trans_type varchar(50),
		start_date datetime,
		end_date datetime,
		type int,
		prepayment int,
		sub int,
		approved int,
		
		user int,
		clientid int
		  )";
	$db->query($query6) or die($db->error);
echo "transaction created <br>";	


$query7 = "create table if not exists joborder (
jid int unsigned not null auto_increment,
primary key (jid),
transcid varchar(50),
date date,
joborderid	varchar(100),
description	varchar(255),
supervisor	varchar(255),
itemid	varchar	(50),
item_description	varchar	(255),
it_id	int,
cid int,
customerid	varchar	(255),
customer_name	varchar	(255),
wid	int,
warehouse	varchar	(255),		
start_date date,
end_date date,
revenue decimal(14,2),
expenses decimal(14,2),
status int
)";
//$db->query($query7) or die($db->error);
echo "job Order created"."<br/>";

$query = "alter table customer
add  wid int after customer_since, add  warehouse varchar(255) after wid";
$db->query($query) or die($db->error);
echo "customer altered <br>";	

$query = "alter table item
add  wid int after location, add  warehouse varchar(255) after wid, add 
asset_type int after quantity_on_hand";
$db->query($query) or die($db->error);
echo "item altered <br>";	
$query = "update item set asset_type =0";
$db->query($query) or die($db->error);
echo "item updated <br>";

$query = "alter table joborder
add  wid int after customer_name, add  warehouse varchar(255) after wid";
//$db->query($query) or die($db->error);
//echo "joborder altered <br>";

$query = "alter table transactions add wid	int after gl_amount,add warehouse	varchar	(255) after wid, add  widto int after warehouse, add  warehouseto varchar(255) after widto ,add  jid int after glaccount_type,add  joborder varchar(255) after jid";
//$db->query($query) or die($db->error);
echo "transactions altered <br>";

*/
$query = "alter table users
add  wid int after zip, add  warehouse varchar(255) after wid";
$db->query($query) or die($db->error);
echo "user altered <br>";
/*

$query = "update transactions set warehouse	='ENUGU OFFICE' WHERE warehouse	=''";
$db->query($query) or die($db->error);
echo "transactions altered <br>";
*/	
?>