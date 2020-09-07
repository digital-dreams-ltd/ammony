<?php
		//Invoice Parameter
	$param["invoice"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,customer,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='INV' $_wdn",'page_title'=>'Sales Invoice','_type'=>'INV','_account'=>"account_receivable",'_glaccount'=>"sales","_sign"=>'-1','client'=>'Customer','c_type'=>'1',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"0","_payment"=>1,"_applied_credit"=>1);
	
	$param["invoice"]["_form"]["top"]="date,Date,s12 m4,d|ref,Invoice No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["invoice"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m2,i|description,&nbsp;Description,s12 m4,i|quantity,Qty,s12 m1,i|rate,Rate,s12 m1,i|amount,Amount,s12 m2,i|joborder,Job,s12 m2,i";
		//End of invoice parameter

		//Purchase Parameter
	$param["purchase"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,vendor,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='PCH' $_wdn",'page_title'=>'Purchase','_type'=>'PCH','_account'=>"account_payable",'_glaccount'=>"inventory","_sign"=>'1','client'=>'Vendor','c_type'=>'2',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"0","_payment"=>1,"_applied_credit"=>1);
	
	$param["purchase"]["_form"]["top"]="date,Date,s12 m4,d|ref,Invoice No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["purchase"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m1,i|description,&nbsp;Description,s12 m4,i|account,Account,s12 m1,i|quantity,Qty,s12 m1,i|rate,Rate,s12 m1,i|amount,Amount,s12 m2,i|joborder,Job,s12 m2,i";
		//End of purchase parameter

		//Receipt Parameter
	$param["receipt"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,customer,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='RCP' $_wdn",'page_title'=>'Receipt','_type'=>'RCP','_glaccount'=>"sales",'_preaccount'=>"account_receivable",'_invaccount'=>"account_receivable","_sign"=>'-1','client'=>'Customer','c_type'=>'1','_zero_balance'=>1,"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"1");
	
	$param["receipt"]["_form"]["top"]="_prepayment,Prepayment,s12,pr|method,Mode of Payment,s12 m4,s,paymentMode|description,Memo,s12 m4,i|date,Date,s12 m4,d|ref,Receipt No,s12 m4,i|_account,Cash Account,s12 m4,ac,cashAccount|warehouse,Location,s12 m4,cb,warehouse";
	$param["receipt"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m2,i|description,&nbsp;Description,s12 m4,i|quantity,Qty,s12 m1,i|rate,Rate,s12 m1,i|amount,Amount,s12 m2,i|joborder,Job,s12 m2,i";
		//End of receipt parameter

		//Payment Parameter
	$param["payment"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,vendor,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='PYT' $_wdn",'page_title'=>'Payment','_type'=>'PYT','_glaccount'=>"inventory","_sign"=>'1','client'=>'Vendor','c_type'=>'2','_zero_balance'=>1,'show_account'=>1,"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"1");
	
	$param["payment"]["_form"]["top"]="_prepayment,Prepayment,s12,pr|method,Mode of Payment,s12 m4,s,paymentMode|description,Memo,s12 m4,i|date,Date,s12 m4,d|ref,Invoice No,s12 m4,i|_account,Cash Account,s12 m4,ac,cashAccount|warehouse,Location,s12 m4,cb,warehouse";
	$param["payment"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m1,i|description,&nbsp;Description,s12 m4,i|account,Account,s12 m1,i|quantity,Qty,s12 m1,i|rate,Rate,s12 m1,i|amount,Amount,s12 m2,i|joborder,Job,s12 m2,i";
		//End of payment parameter
		
		//Credit Memo  Parameter
	$param["creditMemo"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,customer,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='CDM' $_wdn",'page_title'=>'Credit Memo','_type'=>'CDM','_account'=>"account_receivable",'_glaccount'=>"sales","_sign"=>'1',"_glsign"=>'-1','client'=>'Customer','c_type'=>'1',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"2","_payment"=>1);
	
	$param["creditMemo"]["_form"]["top"]="date,Date,s12 m4,d|ref,Invoice No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["creditMemo"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m2,i|description,&nbsp;Description,s12 m4,i|quantity,Qty,s12 m2,i|rate,Rate,s12 m2,i|amount,Amount,s12 m2,i";
		//End of Credit Memo parameter

		//Vendor Credit Parameter
	$param["vendorCredit"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,vendor,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='VCM' $_wdn",'page_title'=>'Vendor Credit Memo','_type'=>'VCM','_account'=>"account_payable",'_glaccount'=>"inventory","_sign"=>'-1','client'=>'Vendor','c_type'=>'2',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse","_customer_invoiceitem"=>"2");
	
	$param["vendorCredit"]["_form"]["top"]="date,Date,s12 m4,d|ref,Invoice No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["vendorCredit"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m2,i|description,&nbsp;Description,s12 m4,i|quantity,Qty,s12 m2,i|rate,Rate,s12 m2,i|amount,Amount,s12 m2,i";
		//End of Vendor Credit parameter
		
		//General Journal Parameter
	$param["generalJournal"]=array("t"=>"transactions","c"=>"ref,reference,b,a|date,date,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='GNJ' $_wdn",'page_title'=>'General Journal','_type'=>'GNJ','_account'=>"account_payable",'_glaccount'=>"inventory","_sign"=>'-1','client'=>'Vendor','c_type'=>'0',"_category"=>"date,Date,period,today|wharehouse,Warehouse,warehouse","_customer_invoiceitem"=>"2");
	
	$param["generalJournal"]["_form"]["top"]="date,Date,s12 m4,d|ref,Reference No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["generalJournal"]["_form"]["middle"]="account,&nbsp;Account,s12 m2,i|description,Description,s12 m6,i|debit,Debit,s12 m2,i|credit,Credit,s12 m2,i";
		//End of General Journal parameter
		
		//Requsition Parameter
	$param["requisition"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a|customer,customer,s,a|amount,amount,s,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='RQJ' $_wdn",'page_title'=>'Requisition','_type'=>'RQJ','_account'=>"account_receivable",'_glaccount'=>"sales","_sign"=>'-1','client'=>'','c_type'=>'0',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse");
	
	$param["requisition"]["_form"]["top"]="date,Date,s12 m3,d|ref,Requisition No,s12 m3,i|warehouse,Location From,s12 m3,cb,warehouse|warehouseto,Location To,s12 m3,cb,warehouse";
	$param["requisition"]["_form"]["middle"]="itemid,&nbsp;Item,s12 m2,i|description,&nbsp;Description,s12 m4,i|quantity,Qty,s12 m2,i|rate,Rate,s12 m2,i|amount,Amount,s12 m2,i";
		//End of Requsition parameter
		
		//Job Order Parameter
	$param["job_order"]=array("t"=>"transactions","c"=>"date,Date,s,a|ref,reference,b,a",'idcol'=>'trans_no','filter'=>"sub=0 and trans_type='JBJ' $_wd ",'page_title'=>'Job Order','_type'=>'JBJ','_account'=>"account_receivable",'_glaccount'=>"sales","_sign"=>'1','client'=>'Customer','c_type'=>'1',"_category"=>"date,Date,period,today|wharehouse,Location,warehouse");
	

	$param["job_order"]["_form"]["top"]="date,Date,s12 m4,d|ref,Job Order No,s12 m4,i|warehouse,Location,s12 m4,cb,warehouse";
	$param["job_order"]["_form"]["middle"]="itemid,Serial Number,s12 m2,i|description,&nbsp;Description,s12 m3,i|quantity,Quantity,s12 m2,i|amount,Amount,s12 m2,i|memo,Comment,s12 m3,i";
		//End of Job order parameter


?>