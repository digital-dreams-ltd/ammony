<?php
function get_page_module()
{
	$json["Setup"]["props"]='{"id":1,"icon":"settings"}';
	$json["Setup"]["subs"][]='{"id":1,"name":"Account Chart", "url":"setup/generic_setup.php?pageType=accountChart"}';
	$json["Setup"]["subs"][]='{"id":2,"name":"Default Account", "url":"setup/generic_parameter.php?pageType=defaultAccount"}';
	$json["Setup"]["subs"][]='{"id":3,"name":"Users", "url":"setup/generic.php?pageType=users"}';
	$json["Setup"]["subs"][]='{"id":4,"name":"Location", "url":"setup/generic.php?pageType=warehouse"}';
	$json["Setup"]["subs"][]='{"id":5,"name":"Role", "url":"setup/generic.php?pageType=role"}';
	$json["Setup"]["subs"][]='{"id":6,"name":"Settings", "url":"setup/generic_parameter.php?pageType=info"}';

	$json["Maintain"]["props"]='{"id":2,"icon":"widgets"}';
	$json["Maintain"]["subs"][]='{"id":1,"name":"Item", "url":"setup/generic.php?pageType=item"}';
	$json["Maintain"]["subs"][]='{"id":2,"name":"Customer", "url":"setup/generic.php?pageType=mainCustomer"}';
	$json["Maintain"]["subs"][]='{"id":3,"name":"Vendor", "url":"setup/generic.php?pageType=mainVendor"}';
	$json["Maintain"]["subs"][]='{"id":4,"name":"Fixed Assets", "url":"setup/generic_details.php?pageType=assets"}';
	$json["Maintain"]["subs"][]='{"id":5,"name":"Assets Stock", "url":"setup/generic.php?pageType=stock"}';
	
	
	$json["Task"]["props"]='{"id":3,"icon":"shop"}';
	$json["Task"]["subs"][]='{"id":1,"name":"Sales Invoice", "url":"task/generic_transaction.php?pageType=invoice"}';
	$json["Task"]["subs"][]='{"id":2,"name":"Receipt ", "url":"task/generic_transaction.php?pageType=receipt"}';
	$json["Task"]["subs"][]='{"id":3,"name":"Credit Memo", "url":"task/generic_transaction.php?pageType=creditMemo"}';
	$json["Task"]["subs"][]='{"id":4,"name":"Purchase", "url":"task/generic_transaction.php?pageType=purchase"}';
	$json["Task"]["subs"][]='{"id":5,"name":"Payment", "url":"task/generic_transaction.php?pageType=payment"}';
	$json["Task"]["subs"][]='{"id":6,"name":"Vendor Credit Memo", "url":"task/generic_transaction.php?pageType=vendorCredit"}';
	$json["Task"]["subs"][]='{"id":7,"name":"Requisition ", "url":"task/generic_transaction.php?pageType=requisition"}';
	$json["Task"]["subs"][]='{"id":8,"name":"General Journal ", "url":"task/generic_journal.php?pageType=generalJournal"}';
	$json["Task"]["subs"][]='{"id":9,"name":"Job Order ", "url":"task/generic_production.php?pageType=job_order"}';
	
	

	$json["Report"]["props"]='{"id":4,"icon":"equalizer"}';
	$json["Report"]["subs"][]='{"id":1,"name":"Account Register", "url":"report/generic_register.php?pageType=accountRegister"}';
	$json["Report"]["subs"][]='{"id":2,"name":"Sales Report", "url":"report/generic_report.php?pageType=salesReport"}';
	$json["Report"]["subs"][]='{"id":3,"name":"Purchase Report", "url":"report/generic_report.php?pageType=purchaseReport"}';
	$json["Report"]["subs"][]='{"id":4,"name":"Receipt Report", "url":"report/generic_report.php?pageType=receiptReport"}';
	$json["Report"]["subs"][]='{"id":5,"name":"Payment Report", "url":"report/generic_report.php?pageType=paymentReport"}';
	$json["Report"]["subs"][]='{"id":6,"name":"Inventory Report", "url":"report/generic_list.php?pageType=inventoryReport"}';
	$json["Report"]["subs"][]='{"id":7,"name":"Item Balance Report", "url":"report/generic_register.php?pageType=inventoryBalance"}';
	$json["Report"]["subs"][]='{"id":8,"name":"Customer Report", "url":"report/generic_list.php?pageType=customerReport"}';
	$json["Report"]["subs"][]='{"id":9,"name":"Customer Activity Report", "url":"report/generic_register.php?pageType=customerActivity"}';
	$json["Report"]["subs"][]='{"id":10,"name":"Customer Balance Report", "url":"report/generic_register.php?pageType=customerBalance"}';
	$json["Report"]["subs"][]='{"id":11,"name":"Vendor Report", "url":"report/generic_list.php?pageType=vendorReport"}';
	$json["Report"]["subs"][]='{"id":12,"name":"Vendor Activity Report", "url":"report/generic_register.php?pageType=vendorActivity"}';
	$json["Report"]["subs"][]='{"id":13,"name":"Vendor Balance Report", "url":"report/generic_register.php?pageType=vendorBalance"}';
	$json["Report"]["subs"][]='{"id":15,"name":"Job Order Report", "url":"report/generic_list.php?pageType=joborderReport"}';
	
	return json_encode($json);
}
function get_default_role()
{
	$d=array();
	$pages=json_decode(get_page_module(),true);
	foreach($pages as $k => $v)
	{
		$vp=json_decode($v['props'],true);
		$id=$vp['id'];
		foreach($v['subs'] as $k1=>$v1)
		{
			$sp=json_decode($v1,true);
			$d[]="$id:".$sp["id"];
		}
	}
	return implode(",",$d);
}

?>
