<?php 
$clientid=1;

require_once 'Database_Connect.php';

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
$db->query($query7) or die($db->error);
echo "job Order created"."<br/>";


$query7 = "create table if not exists warehouse (
wId int unsigned not null auto_increment,
primary key (wId),
transcid varchar(50),
warehouseid	varchar(100),
warehousename	varchar(255),
contact	varchar(255),
telephone	varchar	(50),
address	varchar	(255),
address2	varchar	(255),
city	varchar	(255),
state	varchar	(255),
zipcode	varchar	(255),
country	varchar	(255),
latlng	varchar	(50),
email	varchar	(50),
website	varchar	(50)
)";
$db->query($query7) or die($db->error);
echo "warehouse created"."<br/>";

$query7 = "create table if not exists customer (
cId int unsigned not null auto_increment,
primary key (cId),
transcid varchar(50),
customerid	varchar(100),
customername	varchar(255),
contact	varchar(255),
address	varchar	(255),
address2	varchar	(255),
city	varchar	(255),
state	varchar	(255),
zipcode	varchar	(255),
country	varchar	(255),
telephone	varchar	(50),
telephone1	varchar	(50),
email	varchar(255),
website	varchar(255),
fax	varchar(255),
sales_tax_code	varchar	(255),
latlng varchar(255),
customer_since date,
wid	int,
warehouse	varchar	(255),	
ship_to_name	varchar	(255),
ship_to_address1	varchar	(255),
ship_to_address2	varchar	(255),
ship_to_city	varchar	(255),
ship_to_state	varchar	(255),
ship_to_zipcode	varchar	(255),
ship_to_country	varchar	(255),
ship_to_sales_tax_code	varchar	(255),
publish int,
type varchar(100),
inactive varchar(10),
prospect varchar(10),
picture varchar(255),
referal varchar(255),
sales_representative_id varchar(255),
gl_sales_account varchar(255),
ship_via varchar(255),
pricing_level int,
use_standard_terms varchar(10),
cod_terms varchar(10),
prepaid_terms varchar(10),
terms_type varchar(10),
due_days int,
discount_days int,
discount_percent float(12,2),
credit_limit float(12,2),
charge_finance_charges varchar(10),
due_month_end_terms varchar(10),
cardholder_name varchar(255),
credit_card_address1 varchar(255),
credit_card_address2 varchar(255),
credit_card_city varchar(255),
credit_card_state varchar(255),
credit_card_zip_code varchar(255),
credit_card_country varchar(255),
credit_card_number varchar(255),
credit_card_expiration_date varchar(255),
current_balance  float(10,2),
punit varchar(50),
created_by int,
clientid int
)";
$db->query($query7) or die($db->error);
echo "customer created"."<br/>";

$query7 = "create table if not exists item (
tid int unsigned not null auto_increment,
primary key (tid),
transcid varchar(50),
itemID	varchar(100),
description varchar(100),
sales_desc varchar(200),
purchase_desc varchar(200),
upc varchar(200),
item_type varchar(200),
location varchar(200),
wid	int,
warehouse	varchar	(255),	
unit varchar(200),
sunit varchar(200),
subdivision int,
weight decimal(14,2),
unit_cost decimal(14,2),
taxable varchar(10),
price1 float(10,2),
price2 float(10,2),
price3 float(10,2),
price4 float(10,2),
price5 float(10,2),
price6 float(10,2),
price7 float(10,2),
price8 float(10,2),
price9 float(10,2),
price10 float(10,2),
picture text,
publish int,
inactive varchar(10),
commission varchar(10),
costing_method varchar(10),
gl_sales_account varchar(50),
gl_inventory_account varchar(50),
gl_cos_account varchar(50),
minimum_stock varchar(50),
reorder_quantity	varchar(50),
vendor_id	varchar(50),
buyer_id	varchar(50),
alternate_vendor	varchar(50),
substitution	varchar(50),
special_note	varchar(255),
special_order varchar(50),
master_stock_id varchar(50),
primary_attrib_name	 varchar(50),
substock_primary_attrib_id	 varchar(50),
substock_primary_attrib_desc	 varchar(50),
secondary_attrib_name	 varchar(50),
substock_second_attrib_id	 varchar(50),
substock_second_attrib_desc	 varchar(50),
quantity_on_sales_orders	 varchar(50),
quantity_on_purchase_orders	 varchar(50),
quantity_on_hand  varchar(50),
asset_type int,
date_purchased date,
date_created date,
created_by int,
clientid int
)";
$db->query($query7) or die($db->error);
echo "item created"."<br/>";

$query21 = "create table if not exists default_account_settings (
sid int unsigned not null auto_increment,
primary key (sid),
account_receivable varchar(255),
other_receivable varchar(255),
account_payable varchar(255),
other_payable varchar(255),
cash varchar(255),
sales varchar(255),
cost_of_sales varchar(255),
fixed_assets varchar(255),
other_assets varchar(255),
expenses varchar(255),
current_assets varchar(255),
current_liabilities varchar(255),
long_term_liabilities varchar(255),
equity_open varchar(255),
equity_closed varchar(255),
equity_retained varchar(255),
inventory varchar(255),
accumulated_depreciation varchar(255),
payroll varchar(255),
discount varchar(255),
pur_discount varchar(255),
production varchar(255),
clientid int
)";
$db->query($query21) or die($db->error);
echo "default account settings created"."<br/>";

$query="replace into default_account_settings (sid, account_receivable,other_receivable,account_payable,sales,cost_of_sales,expenses,inventory,clientid) values ('1', '11000', '11400', '20000','40000','50000','12000','89000','$clientid')";
$db->query($query21) or die($db->error);

$query21 = "create table if not exists category_type (
typeid int unsigned not null auto_increment,
primary key (typeid),
shortcode varchar(255),
name varchar(255),
type int,
parent int,
category int,
clientid int
)";
$db->query($query21) or die($db->error);
echo "account type table created"."<br/>";

	$query4 = "create table if not exists file_count(
	countid int unsigned not null auto_increment,
	primary key (countid),
	type varchar(20),
	number int,
	warehouse int,
	clientid int
	)";
	$db->query($query4) or die($db->error);
	echo "file count table created"."<br/>";

$query21 = "create table if not exists account_chart (
typeid int unsigned not null auto_increment,
primary key (typeid),
account_id varchar(50),
account_type int,
account_name varchar(255),
inactive varchar(10),
clientid int
)";
$db->query($query21) or die($db->error);
echo "account chart table created"."<br/>";

//$db->query("drop table transactions") or die($db->error);
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
		wid	int,
		warehouse	varchar	(255),
		widto	int,
		warehouseto	varchar	(255),
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
	
	$query="replace into category_type (typeid, name, type, parent,category,clientid) values ('1', 'account receivable', '1', '1','1','$clientid'), ('2', 'account_payable', '-1', '10','1','$clientid'), ('3', 'cash', '1', '0','1','$clientid'), ('4', 'income', '-1', '21','1','$clientid'),('5', 'cost of sales', '1', '23','1','$clientid'),('6', 'fixed assets', '1', '5','1','$clientid'),('7', 'other current assets', '1', '4','1','$clientid'), ('8','expenses', '1', '24','1','$clientid'),('9', 'other current liabilities', '-1', '12','1','$clientid'),('10', 'long term liabilities', '-1', '14','1','$clientid'),('11', 'equity doesnt close', '-1', '16','1','$clientid'),('12', 'equity closed', '-1', '19','1','$clientid'),('13', 'equity retained', '-1', '18','1','$clientid'),('14',  'inventory', '1', '2','1','$clientid'), ('15', 'accumulated depreciation', '-1', '6','1','$clientid'),('16', 'other assets', '1', '8','1','$clientid')";
		$db->query($query) or die($db->error.$query);
	echo "account type inserted created <br>";	
	
	
	$query9="replace into account_chart (typeid, account_id, account_type, account_name, inactive,clientid) values 
('1', '10000', 0,'Petty Cash', 'FALSE','$clientid')
,('2',  '10100', 0, 'Cash on Hand', 'FALSE','$clientid')
,('3',  '10300', 0, 'Payroll Checking Account', 'FALSE','$clientid')
,('4',  '11000', '1', 'Accounts Receivable', 'FALSE','$clientid')
,('5',  '11400', '1', 'Other Receivables', 'FALSE','$clientid')
,('6',  '11500', '1', 'Allowance for Doubtful Account', 'FALSE','$clientid')
,('7',  '12000', '2', 'Goods Inventory', 'FALSE','$clientid')
,('8',  '12100', '2', 'Work in Progress Inventory', 'FALSE','$clientid')
,('9',  '12150', '2', 'Finished Goods Inventory', 'FALSE','$clientid')
,('10', '14000', '4', 'Prepaid Expenses', 'FALSE','$clientid')
,('11', '14100', '4', 'Employee Advances', 'FALSE','$clientid')
,('12', '14200', '4', 'Notes Receivable-Current', 'FALSE','$clientid')
,('13', '14300', '4', 'Prepaid Interest', 'FALSE','$clientid')
,('14', '14700', '4', 'Other Current Assets', 'FALSE','$clientid')
,('15', '15000', '5', 'Furniture and Fixtures', 'FALSE','$clientid')
,('16', '15100', '5', 'Equipment', 'FALSE','$clientid')
,('17', '15200', '5', 'Automobiles', 'FALSE','$clientid')
,('18', '15300', '5', 'Plant & Machineries', 'FALSE','$clientid')
,('19', '15400', '5', 'Leasehold Improvements', 'FALSE','$clientid')
,('20', '15500', '5', 'Buildings', 'FALSE','$clientid')
,('21', '15600', '5', 'Building Improvements', 'FALSE','$clientid')
,('22', '16900', '5', 'Land', 'FALSE','$clientid')
,('23', '17000', '6', 'Accum. Depreciation-Furniture', 'FALSE','$clientid')
,('24', '17100', '6', 'Accum. Depreciation-Equipment', 'FALSE','$clientid')
,('25', '17200', '6', 'Accum. Depreciation-Automobil', 'FALSE','$clientid')
,('26', '17300', '6', 'Accum. Depreciation-Plant/Mach', 'FALSE','$clientid')
,('27', '17400', '6', 'Accum. Depreciation-Leasehold', 'FALSE','$clientid')
,('28', '17500', '6', 'Accum. Depreciation-Computers', 'FALSE','$clientid')
,('29', '17600', '6', 'Accum. Depreciation-Bldg Imp', 'FALSE','$clientid')
,('30', '17650', '6', 'Accumu.Dep. Plant & Machinery', 'FALSE','$clientid')
,('31', '19000', '8', 'Deposits', 'FALSE','$clientid')
,('32', '19100', '8', 'Organization Costs', 'FALSE','$clientid')
,('33', '19150', '8', 'Accum Amortiz - Organiz Costs', 'FALSE','$clientid')
,('34', '19200', '8', 'Notes Receivable- Noncurrent', 'FALSE','$clientid')
,('35', '19900', '8', 'Other Noncurrent Assets', 'FALSE','$clientid')
,('36', '20000', '10', 'Accounts Payable', 'FALSE','$clientid')
,('37', '23000', '12', 'Accrued Expenses', 'FALSE','$clientid')
,('38', '23100', '12', 'Sales Tax Payable', 'FALSE','$clientid')
,('39', '23200', '12', 'Wages Payable', 'FALSE','$clientid')
,('43', '23600', '12', 'State Payroll Taxes Payable', 'FALSE','$clientid')
,('45', '23800', '12', 'Local Payroll Taxes Payable', 'FALSE','$clientid')
,('46', '23900', '12', 'Income Taxes Payable', 'FALSE','$clientid')
,('47', '24000', '12', 'Other Taxes Payable', 'FALSE','$clientid')
,('48', '24100', '12', 'Current Portion Long-Term Debt', 'FALSE','$clientid')
,('49', '24300', '12', 'Deposits from Customers', 'FALSE','$clientid')
,('50', '24700', '12', 'Other Current Liabilities', 'FALSE','$clientid')
,('51', '24800', '12', 'Suspense - Clearing Account', 'FALSE','$clientid')
,('52', '27000', '14', 'Notes Payable-Noncurrent', 'FALSE','$clientid')
,('53', '27100', '14', 'Deferred Revenue', 'FALSE','$clientid')
,('54', '27400', '14', 'Other Long-Term Liabilities', 'FALSE','$clientid')
,('55', '39002', '16', 'Beginning Balance Equity', 'FALSE','$clientid')
,('56', '39003', '16', 'Common Stock', 'FALSE','$clientid')
,('57', '39004', '16', 'Paid-in Capital', 'FALSE','$clientid')
,('58','39005', '18', 'Retained Earnings', 'FALSE','$clientid')
,('59', '39007', '19', 'Dividends Paid', 'FALSE','$clientid')
,('60', '40000', '21', 'Sales #1', 'FALSE','$clientid')
,('63', '40200', '21', 'Interest/Dividend Income', 'FALSE','$clientid')
,('64', '40250', '21', 'Other Income', 'FALSE','$clientid')
,('69', '50000', '23', 'Cost of Goods Sold', 'FALSE','$clientid')
,('70', '50500', '23', 'Raw Material Purchases', 'FALSE','$clientid')
,('71', '51000', '23', 'Direct Labor Costs', 'FALSE','$clientid')
,('72', '51500', '23', 'Indirect Labor Costs', 'FALSE','$clientid')
,('73', '52000', '23', 'Heat-Light and Power', 'FALSE','$clientid')
,('74', '52500', '23', 'Commissions', 'FALSE','$clientid')
,('75', '53000', '23', 'Miscellaneous Factory Costs', 'FALSE','$clientid')
,('76', '57000', '23', 'Cost of Sales- Salaries and Wa', 'FALSE','$clientid')
,('77', '57500', '23', 'Cost of Sales- Freight', 'FALSE','$clientid')
,('78',  '58000', '23', 'Cost of Sales- Other', 'FALSE','$clientid')
,('79',  '58500', '23', 'Inventory Adjustments', 'FALSE','$clientid')
,('80',  '59000', '23', 'Purchase Returns and Allowance', 'FALSE','$clientid')
,('81',  '59500', '23', 'Purchase Discounts', 'FALSE','$clientid')
,('82',  '60000', '24', 'Advertising Expense', 'FALSE','$clientid')
,('83',  '60500', '24', 'Diesel/Lubricants Expenses', 'FALSE','$clientid')
,('84',  '61000', '24', 'Auto Expenses', 'FALSE','$clientid')
,('85',  '61500', '24', 'Bad Debt Expense', 'FALSE','$clientid')
,('86',  '62000', '24', 'Bank Charges', 'FALSE','$clientid')
,('87',  '62500', '24', 'Fuel Expenses', 'FALSE','$clientid')
,('88',  '63000', '24', 'Charitable Contributions Exp', 'FALSE','$clientid')
,('89',  '63500', '24', 'Commissions and Fees Exp', 'FALSE','$clientid')
,('90',  '64000', '24', 'Depreciation Expense', 'FALSE','$clientid')
,('91',  '64500', '24', 'Hotel/Logding Expenses', 'FALSE','$clientid')
,('92',  '65000', '24', 'Employee Benefit Programs Exp', 'FALSE','$clientid')
,('93',  '65500', '24', 'Waybill/Road Expenses', 'FALSE','$clientid')
,('94',  '65550', '24', 'Electrical Expenses', 'FALSE','$clientid')
,('95', '66000', '24', 'Gifts/PR Expense', 'FALSE','$clientid')
,('96', '66500', '24', 'Income Tax Expense', 'FALSE','$clientid')
,('97',  '67000', '24', 'Insurance Expense', 'FALSE','$clientid')
,('98', '67500', '24', 'Interest Expense', 'FALSE','$clientid')
,('99', '68000', '24', 'Laundry and Cleaning Exp', 'FALSE','$clientid')
,('100', '68500', '24', 'Legal and Professional Expense', 'FALSE','$clientid')
,('101', '69000', '24', 'Licenses Expense', 'FALSE','$clientid')
,('103', '70000', '24', 'Machine Maintenance Expense', 'FALSE','$clientid')
,('104', '70500', '24', 'Meals and Entertainment Exp', 'FALSE','$clientid')
,('105', '71000', '24', 'Office Expense', 'FALSE','$clientid')
,('106', '71500', '24', 'Other Taxes', 'FALSE','$clientid')
,('107', '72000', '24', 'Payroll Tax Expense', 'FALSE','$clientid')
,('108', '72500', '24', 'Penalties and Fines Exp', 'FALSE','$clientid')
,('109', '73000', '24', 'Pension/Profit-Sharing Plan Ex', 'FALSE','$clientid')
,('110', '73500', '24', 'Postage Expense', 'FALSE','$clientid')
,('111', '74000', '24', 'Rent or Lease Expense', 'FALSE','$clientid')
,('112', '74500', '24', 'Repairs Expense', 'FALSE','$clientid')
,('113', '74600', '24', 'Registration Fees Expenses', 'FALSE','$clientid')
,('114', '75000', '24', 'Salaries Expense', 'FALSE','$clientid')
,('115', '75500', '24', 'Stationeries Expense', 'FALSE','$clientid')
,('116', '76000', '24', 'Telephone Expense', 'FALSE','$clientid')
,('117', '76500', '24', 'Travel Expense', 'FALSE','$clientid')
,('118', '77000', '24', 'Water supply Expense', 'FALSE','$clientid')
,('119', '77500', '24', 'Wages Expense', 'FALSE','$clientid')
,('120', '89000', '24', 'Other Expense', 'FALSE','$clientid')
,('121', '89500', '24', 'Purchase Disc- Expense Items', 'FALSE','$clientid')
,('122', '90000', '24', 'Gain/Loss on Sale of Assets', 'FALSE','$clientid')
,('123', '99500', '24', 'Heating/Utility expenses', 'FALSE','$clientid')
,('176', '41100', '21', 'Refund', 'FALSE','$clientid')
,('177', '41150', '21', 'Loan', 'FALSE','$clientid')
";
	$db->query($query9) or die($db->error.$query);
	echo "account chart inserted created <br>";	
	

?>