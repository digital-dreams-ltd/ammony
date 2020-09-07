<?php
// Settings parameters
	$param["info"]=array("t"=>"company_info",'idcol'=>'id','page_title'=>'Settings','transcid'=>false,'fixed'=>'id=1');
	$param["info"]["_form"]["left"][""]="name,Business Name,r,l|address1_title,Address 1 Title,r,l|address1,Address 1,r,l|address1_phone,Address 1 Phone,r,l|address2_title,Address 2 Title,r,l|address2,Adress 2,i,l|address2_phone,Address 2 Phone,i,l|motto, Slogan,i,l|latlng,Lat Lng,i,l|website,Website,i,l|sms_sender,SMS Sender,i,l|email,Email,i,l|email_sender,Email Sender Name,i,l|sms_acount_name,SMS Account,i,l|sms_acount_password,SMS Account Password,i,l|return_policy,Return Policy,i,l|sale_message, Sales Message,i,l";
	$param["info"]["_form"]["right"][""]="logo_ref,Logo,i,p";
// Role parameters
	$param["role"]=array("t"=>"roles","c"=>"rolename,Role Name,b,a",'idcol'=>'roleid','page_title'=>'Role','transcid'=>false);
	$param["role"]["_form"]["center"][""]="rolename,Role Name,r,l|roledesc,,r,rl";
		
// Users Parameter
	$param["users"]=array("t"=>"users","c"=>"name,Name,b,a",'idcol'=>'id','page_title'=>'Users','transcid'=>false);
	$param["users"]["_form"]["left"][""]="staff_no,Staff ID,r,l|name,Full Name,r,l";
		$param["users"]["_form"]["left"]["Contact"]="address,Address,r,l|state,State,r,i|country,Country,i,i|phone,Phone,i,i|email,Email,i,i";
		$param["users"]["_form"]["left"]["Access"]="username,Username,i,l|password,Password,i,pl|roleid,Role,i,sl,role|accesslevel,Access Level,i,sl,accessLevel|warehouse,Location,i,sl,warehouse";
	$param["users"]["_form"]["right"]["Picture"]="picture,User Pictures,i,p";
	//item parameter
	$param["item"]=array("t"=>"item",
	"c"=>"description,Description,b,a|itemid,Item ID,s,a|price1,Price,h,a",
	'idcol'=>'tid','newcol'=>'description','page_title'=>'Item','transcid'=>true,"extras"=>"asset_type=0",'filter'=>"asset_type=0 $_wdn ");
	$param["item"]["_form"]["left"][""]="itemid,Item ID,r,q|description,Short Description,r,l";
	$param["item"]["_form"]["left"]["Description"]="upc,UPC,i,i|inactive,Status,r,sw,active|item_type,Product Line,r,cb,productType|warehouse,Location,i,s,warehouse|unit,Unit,Unit,i,i|weight,Weight,i,n|quantity_on_hand,Quantity on Hand,i,i";
		$param["item"]["_form"]["left"]["Price"]="unit_cost,Unit Cost,n,i|taxable,Tax Type,i,i|price1,Price,i,i|quantity_on_hand,Quantity,i,i";
		$param["item"]["_form"]["right"]["Marketing"]="sales_desc,Description for sale,i,l|publish,,i,sw,publish";
		$param["item"]["_form"]["right"]["Image"]="picture,Item Pictures,i,p";
		// end of item
		
		//Job order parameter
	$param["joborder"]=array("t"=>"joborder",
	"c"=>"joborderid,Job Order ID,b,a|item_description,Item,s,a|customer_name,Customer,s,a|description,Description,s,a|revenue,Cost,s,a",
	'idcol'=>'jid','newcol'=>'description','page_title'=>'Job Order','filter'=>"status=0 $_wdn ",'transcid'=>true,"extras"=>"status=0","_category"=>"wharehouse,Location,warehouse");
	$param["joborder"]['_actions']=array('customerSms');
	$param["joborder"]["_form"]["center"][""]="joborderid, Job Order ID,r,l|description,Description,r,l";
	$param["joborder"]["_form"]["center"]["Details"]="supervisor,Supervisor,i,i|customer_name,Customer,r,cb,minicustomer|item_description,Item,i,cb,item|warehouse,Location,i,s,warehouse";
		$param["joborder"]["_form"]["center"]["Duration & Cost"]="start_date,Date,i,d|end_date,End Date,i,d|revenue,Cost,i,i";
		//$param["joborder"]["_form"]["right"]["Image"]="picture,Item Pictures,i,p";
		
		$param["joborder"]["_details"]['pages']="Documents,subs/picture_library.php,document|Services,subs/modal_form.php,services|Comments,subs/flat_form.php,comments|History,subs/list_page.php,history|Work Orders,subs/list_page.php,workorder";
		// end of Asset
		
		//Asset parameter
	$param["assets"]=array("t"=>"item",
	"c"=>"description,Description,b,a|itemid,Item ID,s,a|price1,Price,h,a",
	'idcol'=>'tid','newcol'=>'description','page_title'=>'Fixed Assets','transcid'=>true,"extras"=>"asset_type=2",'filter'=>'asset_type=2');
	$param["assets"]['_actions']=array('customerSms');
	$param["assets"]["_form"]["left"][""]="description,Name of Asset,r,l|itemid,Model Number,r,l|purchase_desc,Description,i,t";
	$param["assets"]["_form"]["left"]["Description"]="upc,Identification Number,i,i|item_type,Product Line,r,cb,productType|wharehouse,Location,i,s,warehouse|purchase_date,Date Purchased,i,d";
		$param["assets"]["_form"]["left"]["Cost & Depreciation"]="unit_cost,Unit Cost,n,i|depreciation,Depreciation,i,n|taxable,Taxable,i,i";
		$param["assets"]["_form"]["right"]["Image"]="picture,Item Pictures,i,p";
		
		$param["assets"]["_details"]['pages']="Documents,subs/picture_library.php,document|Services,subs/modal_form.php,services|Comments,subs/flat_form.php,comments|History,subs/list_page.php,history|Work Orders,subs/list_page.php,workorder";
		// end of Asset
		
		// Asset stock
		$param["stock"]=array("t"=>"item",
	"c"=>"description,Description,b,a|itemid,Item ID,s,a|price1,Price,h,a",
	'idcol'=>'tid','newcol'=>'description','page_title'=>'Asset Stock','transcid'=>true,"extras"=>"asset_type=0",'filter'=>'asset_type=0');
	
	$param["stock"]["_form"]["left"][""]="description,Name of Asset,r,l|itemid,Model Number,r,l|purchase_desc,Description,i,t";
	$param["stock"]["_form"]["left"]["Description"]="upc,Identification Number,i,i|item_type,Product Line,r,cb,productType|wharehouse,Location,i,s,warehouse|purchase_date,Date Purchased,i,d|quantity_on_hand,Quantity on Hand,i,i";
		$param["stock"]["_form"]["left"]["Cost & Depreciation"]="unit_cost,Unit Cost,n,i|depreciation,Depreciation,i,n|taxable,Taxable,i,i";
		$param["stock"]["_form"]["right"]["Image"]="picture,Item Pictures,i,p";
		// end of Asset stock
		
		// Customer Parameter
		$param["mainCustomer"]=array("t"=>"customer","c"=>"customername,Customer Name,b,a|customerid,Customer ID,s,a",'idcol'=>'cid','page_title'=>'Customer',"extras"=>"type=1",'filter'=>"type=1 $_wd",'transcid'=>true,"_category"=>"customer_type,Customer Type,customerType,");
		$param["mainCustomer"]['_actions']=array('customerSms');
		$param["mainCustomer"]["_form"]["left"][""]="customerid,Customer ID,r,l|customername,Customer Name,r,l";
		$param["mainCustomer"]["_form"]["left"]["Contact"]="contact,Name of Primary Contact,i,l|address,Address,r,l|state,State,r,i|country,Country,i,i|telephone,Phone,i,i|email,Email,i,i|website,Website,i,n|zipcode,Zip Code,i,i";
		$param["mainCustomer"]["_form"]["right"][""]="warehouse,Location,i,sl,warehouse|sales_representative_id,Sales Rep,s,i|credit_limit,Credit Limit,i,i|price_level,Price Level,i,i|customer_type,Customer Type,r,cb,customerType";
		$param["mainCustomer"]["_form"]["right"]["Picture"]="picture,Customer Pictures,i,p";
		//end of customer parameter
		
		//Vendor Parameter
		$param["mainVendor"]=array("t"=>"customer","c"=>"customername,Vendor Name,b,a|customerid,Vendor ID,s,a",'idcol'=>'cid','page_title'=>'Vendor',"extras"=>"type=2",'filter'=>"type=2 $_wd",'transcid'=>true);
		$param["mainVendor"]["_form"]["left"][""]="customerid,Vendor ID,r,l|customername,Vendor Name,r,l";
		$param["mainVendor"]["_form"]["left"]["Contact"]="contact,Name of Primary Contact,i,i|address,Address,r,l|state,State,r,i|country,Country,i,i|telephone,Phone,i,i|email,Email,i,i|website,Website,i,n|zipcode,Zip Code,i,i";
		$param["mainVendor"]["_form"]["right"][""]="warehouse,Location,i,s,warehouse|credit_limit,Credit Limit,i,i";
		$param["mainVendor"]["_form"]["right"]["Picture"]="picture,Customer Pictures,i,p";
		// End of vendor parameter
		//Default Account Parameter
		$param["defaultAccount"]=array("t"=>"default_account_settings",'idcol'=>'sid','page_title'=>'Default Accounts','transcid'=>false,'fixed'=>'sid=1');
		$param["defaultAccount"]["_form"]["center"]["Default Accounts"]="account_receivable,Account Receivable,r,cb,accounts|account_payable,Account Payable,r,cb,accounts|cash,Cash Account,r,cb,accounts|sales,Sales Account,r,cb,accounts|cost_of_sales,Cost of Sales,r,cb,accounts|inventory,Inventory,r,cb,accounts";
		
		// End of default account parameter
		
	$param["miniJoborder"]=array("t"=>"joborder",
	"c"=>"joborderid,Joborder ID,s,a|description,Description,b,a",
	'idcol'=>'jid','newcol'=>'description','page_title'=>'Joborder','transcid'=>true,"extras"=>"status=0",'filter'=>'status=0');
	
	$param["miniItem"]=array("t"=>"item",
	"c"=>"description,Description,b,a|itemid,Item ID,s,a|price1,Price,h,a|gl_cos_account,COS,h,a|quantity_on_hand,Quantity,r,a",
	'idcol'=>'tid','newcol'=>'description','page_title'=>'Item','transcid'=>true,"extras"=>"asset_type=0",'filter'=>"asset_type=0 $_wd");
	
	$param["microItem"]=array("t"=>"item",
	"c"=>"itemid,Item ID,s,a|description,Description,b,a|price1,Price,h,a|gl_cos_account,COS,h,a|quantity_on_hand,Quantity,r,a",
	'idcol'=>'tid','newcol'=>'description','page_title'=>'Item','transcid'=>true,"extras"=>"asset_type=0",'filter'=>"asset_type=0 $_wd");	
		
	$param["customer"]=array("t"=>"customer","c"=>"customername,customer,s,a|cid,cid,h,a|address,address,h,a|state,state,h,a|country,country,h,a|email,email,h,a|telephone,telephone,t,a|current_balance,current_balance,r,a",'idcol'=>'cid','filter'=>"type=1 $_wd");

	$param["minicustomer"]=array("t"=>"customer","c"=>"customername,customer,s,a",'idcol'=>'cid','filter'=>"type=1 $_wd");
	$param["minivendor"]=array("t"=>"customer","c"=>"customername,customer,s,a",'idcol'=>'cid','filter'=>"type=2 $_wd");

$param["vendor"]=array("t"=>"customer","c"=>"customername,customer,s,a|cid,cid,h,a|address,address,h,a|state,state,h,a|country,country,h,a|email,email,h,a|telephone,Phone,t,a",'idcol'=>'cid','filter'=>"type=2 $_wd");

$param["customerInvoice"]=array("t"=>"transactions","c"=>"tid,tid,h,a|ref,reference,b,a|date,date,s,a|net_due,amount,r,a|trans_no,trans_no,h,a",'idcol'=>'tid','filter'=>"sub=0 and net_due>0 and trans_type='INV'");

$param["vendorInvoice"]=array("t"=>"transactions","c"=>"tid,tid,h,a|ref,reference,b,a|date,date,s,a|net_due,amount,r,a|trans_no,trans_no,h,a",'idcol'=>'tid','filter'=>"sub=0 and net_due>0 and trans_type='PCH'");
	
	$param["accountType"]=array("t"=>"category_type","c"=>"name,name,b,a","fixed"=>"category=2","newcol"=>'name','idcol'=>'parent',"filter"=>'category=1');
		
	$param["productType"]=array("t"=>"category_type","c"=>"name,name,b,a","fixed"=>"category=2","newcol"=>'name','idcol'=>'typeid',"filter"=>'category=2');
	$param["customerType"]=array("t"=>"category_type","c"=>"name,name,b,a","fixed"=>"category=5","newcol"=>'name','idcol'=>'typeid',"filter"=>'category=5');
	
	$param["accountChart"]=array("t"=>"account_chart","c"=>"account_name,Account Name,i,l|account_id,Account ID,i,i|account_type,Account Type,i,s,accountType",'idcol'=>'typeid',"page_title"=>"Accounts","sort_col"=>"account_id");
	
	$param["accounts"]=array("t"=>"account_chart","c"=>"account_id,Account ID,b,l|account_name,Account Name,s,l",'idcol'=>'typeid',"page_title"=>"Accounts");
	
	$param["cashAccount"]=array("t"=>"account_chart","c"=>"account_id,Account ID,b,l|account_name,Account Name,s,l",'idcol'=>'typeid',"page_title"=>"Accounts",'filter'=>'account_type=0','default'=>'defaultCash');
	
	$param["defaultCash"]=array("t"=>"default_account_settings","c"=>"cash,Cash Account ID,b,l",'idcol'=>'sid',"page_title"=>"Accounts",'filter'=>'sid=1');
	
	$param["warehouse"]=array("t"=>"warehouse","c"=>"warehousename,Location Name,b,l|warehouseid,Location ID,i,l",'idcol'=>'cid',"page_title"=>"Location");			
	$param["warehouse"]["_form"]["center"][""]="warehouseid,Location ID,r,l|warehousename,Location Name,r,l";
		$param["warehouse"]["_form"]["center"]["Address"]="contact,Name of Primary Contact,i,i|address,Address,r,l|state,State,r,i|country,Country,i,i|telephone,Phone,i,i|email,Email,i,i|website,Website,i,n|zipcode,Zip Code,i,i";	
		
	$param["warehouse2"]=array("t"=>"warehouse","c"=>"warehousename,Warehouse Name,b,l",'idcol'=>'cid',"page_title"=>"Warehouse","_url"=>"processAjax.php","_publish"=>"accounts","_publishCol"=>'address');			
	$param["warehouse2"]["_form"]["center"][""]="warehousename,Warehouse Name,r,t|contact,Name of Primary Contact,i,b";
		
require_once "report_param_page.php";
require_once "task_param_page.php";
require_once "action_param_page.php";
require_once "param_page_FAS.php";
?>