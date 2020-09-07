<?php

require_once "Database_Connect.php" ;






$query21 = "create table if not exists document (

id int unsigned not null auto_increment,

primary key (id),


title varchar(255),

description text,

tag int,
type int,
`date` datetime, 
src varchar(255)

)";

$db->query($query21) or die($db->error);

echo "document created"."<br/>";


$query21 = "create table if not exists service (

id int unsigned not null auto_increment,
primary key (id),
name varchar(255),
description text,
`date` date, 
tag int,
type int,
reference varchar(255),
start_date datetime,
end_date datetime,
cost decimal(14,2),
vendor_id int,
vendor_name varchar(255),
vendor_type int


)";

$db->query($query21) or die($db->error);

echo "service created"."<br/>";

$query21 = "create table if not exists comment (

id int unsigned not null auto_increment,

primary key (id),


name varchar(255),

description text,
`date` date, 
tag int,
type int,
user int

)";

$db->query($query21) or die($db->error);

echo "comment created"."<br/>";


?>