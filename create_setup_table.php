<?php

require_once "Database_Connect.php" ;

require_once "get_role_func.php" ;



$query26 = "create table if not exists company_info (

id int unsigned not null auto_increment,

primary key (id),

transcid varchar(50),

name varchar(250),

shortname varchar(50),

address1 varchar(250),

address1_title varchar(250),

address1_phone varchar(250),

address2 varchar(250),

address2_title varchar(250),

address2_phone varchar(250),

address3 varchar(250),

address3_title varchar(250),

address3_phone varchar(250),

motto varchar(250),

latlng varchar(250),

pic_ref varchar(250),

logo_ref varchar(250),

bg_ref varchar(250),

website varchar(250),

sms_sender varchar(250),

email varchar(250),

email_sender varchar(250),

sms_acount_name varchar(250),

sms_acount_password varchar(250),

return_policy text,

sale_message varchar(255),

staff_prefix varchar(50) 

)";

$db->query($query26) or die($db->error);

echo "company_info table created"."<br/>";



$query="replace into company_info(id,transcid,name) values ('1',concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )),'')";

$db->query($query) or die($db->error);

echo "Company Info inserted"."<br/>";



$query21 = "create table if not exists roles (

roleid int unsigned not null auto_increment,

primary key (roleid),

transcid varchar(50),

rolename varchar(255),

roledesc text,

clientid int

)";

$db->query($query21) or die($db->error);

echo "roles created"."<br/>";





$query21 = "create table if not exists event (

id int unsigned not null auto_increment,

primary key (id),

transcid varchar(50),

`table` varchar(50),

`datecol` varchar(50),

`idcol` varchar(50),

`ref_transcid` varchar(50),

`entrydate` datetime,

`eventdate` datetime,

`completedate` datetime,

`customer_type` int,

`customer_id` varchar(50),

`comment` varchar(255),

`customer_name` varchar(250),

`recur_type` int,

`display` int,

`display_day` int,

`display_type` int,

`completed` int,

`number` int,

`user` int,

clientid int

)";

$db->query($query21) or die($db->error);

echo "event created"."<br/>";



$query21 = "create table if not exists event_log (

transcid varchar(50),

primary key (transcid),

`ref_transcid` varchar(255),

`eventdate` datetime,

`completedate` datetime,

`completed` int,

clientid int

)";

$db->query($query21) or die($db->error);

echo "event log created"."<br/>";



$query21 = "create table if not exists deleted (

id int unsigned not null auto_increment,

transcid varchar(50),

primary key (id),

`table` varchar(255),

`desc` varchar(255),

`entrydate` datetime,

`user`  varchar(255),

clientid int 

)";

$db->query($query21) or die($db->error);

echo "deleted created"."<br/>";



$query2 = "create table if not exists accesslog (

transcid varchar(50),

user  varchar(255)  ,

logindate	datetime, 

logoutdate	datetime,

clientid int

)";

$db->query($query2) or die($db->error);

echo "Access Log table created"."<br/>";






$clientid=1;

$default_role= get_default_role();

$query="replace into roles(roleid,transcid,clientid,rolename,roledesc) values ('1',concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )), '$clientid','Administrator','$default_role')";

$db->query($query) or die($db->error);

echo "Default Role inserted"."<br/>";



	//$db->query("drop table users") or die($db->error);

	

	$query6 = "create table if not exists users (

		  id int unsigned not null auto_increment,

		  primary key (id),

		  transcid varchar(50),

		  picture_ref varchar(100),

		  surname varchar(50),

		  first_name varchar(50),

		  middle varchar(50),

		  name varchar(255),

		  sex varchar(50),

		  spouse varchar(200),

		  emergency_contact varchar(200),

		 contact_no varchar(200),

		  birthdate date,

		  address varchar(200),

		  address2 varchar(200),

		  city varchar(100),

		  state varchar(100),

		  country varchar(100),

		  zip varchar(100),
		  wid	int,
		  
		warehouse	varchar	(255),	

		  tax_id varchar(100),

		  phone varchar(70),

		  telephone2 varchar(70),

		  email varchar(70),

		  staff_no varchar(50),

		  marital_status varchar(10),

		  registrationtime datetime ,

		  grade int,

		  department varchar(100),

		  section varchar(100),

		  designation varchar(100),

		  sales_rep varchar(10),

		  full_employee varchar(100),

		  employment_type varchar(100),

		  inactive  varchar(10),

		  statutory  varchar(10),

		  username varchar(50),

		password varchar(50),

		date_employed date,

		date_last_raise date,

		date_terminated date,

		date_reviewed date,

		pension varchar(50),

		 email_account varchar(50),

		email_password varchar(50),

		roleId int,

		accessLevel int,

		bank int,

		account_no varchar(150),

		branch varchar(150),

		pay_method varchar(50),

		pay_frequency varchar(50),

		hours_per_day varchar(50),

		billing_rate float(10,2),

		clientid int

		  )";

	$db->query($query6) or die($db->error);

	echo "users created"."<br/>";



	$query6="replace into users(id,transcid,username,password,name,roleid,accesslevel,clientid) value ('1',concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )),'administrator','linkbiz','administrator','1','3','$clientid')";

	$db->query($query6) or die($db->error);

	echo "administrator inserted successfully"."<br/>";

?>