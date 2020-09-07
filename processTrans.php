<?php
	require_once "Database_Connect.php";
	require_once "get_company_info.php";
	require_once "get_last.php";
	require_once "get_default_account.php";
	require_once "table_func.php";
	require_once "sms_functions.php";
	require_once "updater.php";
	if($_POST["trans_type"]=="JBJ") {require_once "processJoborder.php"; die(); }
	
	$_payment_made=0; $_glsign=0;
	$inx=array('amount_paid','old_amount','old_discount');
    if(!empty($_COOKIE["ELIMS-Warehouse"])) $_POST['warehouse']=$_COOKIE["ELIMS-Warehouse_Name"];
	foreach($inx as $k=> $v)
	{
		${$v}=0;
	}
	if(empty($_POST['trans_no']))
	{
		$type=$_POST['trans_type'];
		$_POST['trans_no']=time().rand(5,50);
		if(empty($_POST['ref']))$_POST['ref']="WH".$_POST['warehouse']."-".$type.getlast($type);
	}
	$xt=array('applied_credit');
	foreach($xt as $k => $v)
	{
		if(empty($_POST[$v]))$_POST[$v]=0;
	}
	adv_extract($_POST); 
	
	
	
	if(empty($cid))
	{
			$id=getLastInsert("cid","customer","cid");
			$customer_id ="CTMX".sprintf("%06d",$id+1);
			$q="select cid,customerid from customer where customername='$customer'";
			$rs=$db->query($q) or die($db->error);
			if($rw=$rs->fetch_row())
			{
				$cid=$rw[0];
				$customer_id=$rw[1];
			} else if(!empty($customer))
			{
				
				$query="insert into customer (customerid,customername ,address ,state ,country ,telephone,email,type,prospect,warehouse) values('$customer_id','$customer' ,'$address' ,'$state' ,'$country' ,'$telephone','$email','$c_type','TRUE' ,'$warehouse')";
				$db->query($query) or die($db->error);
				$cid=getLastInsert("cid","customer","cid");
			}
			$_POST['cid']=$cid;
	}
		
	$tci=array();
	$t="transactions";
	$items=array('tid','it_id','itemid','description','quantity','rate','amount','jid','joborder');
	$invoices=array('tid'=>'tid','it_id'=>'in_id','date_due'=>'date','description'=>'invoice','rate'=>'amountdue','discount'=>'discount','amount'=>'amount_paid');
	$table_fields=getFields($t);
			

	$col=array(); $tcol=array();
	foreach($_POST as $k => $v)
	{
		if(array_search(strtolower($k),$table_fields) !==false)
		{

		  	$col["$k"]="$k='".$db->real_escape_string($v)."'";
			if(array_search(strtolower($k),$items) ===false)
			{
				$tcol["$k"]="$k='".$db->real_escape_string($v)."'";
			}
		}
	}
	if(!empty($tid) && !empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']<2) die('-1');
	$tp_col=$col;
	$col["sub"]="sub=0";
	$col["gl_amount"]="gl_amount=".($amount - $_payment_made) * -$sign ;
	if(!empty($_prepayment) || $invoice_count>1) 
	{
		$col["amount_due"]="amount_due='0'"; 
	}else 	
	{
		$col["amount_due"]="amount_due='$amount'";
	}
	if(!empty($_glsign)){ $col["amount_due"]="amount_due='$_payment_made'";  $col["amount_paid"]="amount_paid='$amount'";}
	if(!empty($_prepayment)){ $col["prepayment"]="prepayment=1";$tcol["prepayment"]="prepayment=1"; $count=2; $_glaccount=$_preaccount; }
	//if(!empty($_account))$col[]="account='$_account'";
	$col["net_due"]="net_due=".($amount-$applied_credit - $amount_paid);
	if(!empty($_zero_balance))$col["amount_paid"]="amount_paid='$amount'";
	$colstr=join(' ,',$col);
	if(!empty($_account))
	{
		$pr=get_trans_account($_account,1);
		$colstr .=$pr;
	}
	if(!empty($_payment_made))
	{
		$tp_col["sub"]="sub=-1";
		$tp_col["tid"]="tid='$receipt_id'";
		$tp_col["gl_amount"]="gl_amount=".( $_payment_made) * -$sign;
		$tp_col["memo"]="memo='$deposit_id'";
		$tp_col["net_due"]="net_due=".($amount-$applied_credit - $amount_paid);
		$tp_colstr=join(' ,',$tp_col);
		if(!empty($receipt_account))
		{
			$pr=get_trans_account($receipt_account,1);
			//echo $pr."00000";
			$tp_colstr .=$pr;
		}
		if(empty($receipt_id))
		{
			$query="insert $t set $tp_colstr ";
			$db->query($query) or die($db->error);
			$tci[]=getLastInsert("tid","transactions","tid");
		}else
		{
			$query="update $t set $tp_colstr where tid='$receipt_id'";
			$db->query($query) or die($db->error.$query);
			$tci[]=$receipt_id;
		}
	}
	if(empty($tid))
	{
		$query="insert $t set $colstr ";
		$db->query($query) or die($db->error.$query);
		
	}else
	{
		$query="update $t set $colstr where tid='$tid'";
		//echo $query."<br>";
		$db->query($query) or die($db->error.$query);
	}
	for($i=1;$i<$invoice_count;$i++)
	{
		$icol=$tcol;
		foreach($invoices as $k => $v)
		{
			if(isset(${$v.$i}))$icol[$k]=$k."='".${$v.$i}."'";
		}
		if(count($icol)!=count($tcol))
		{
			$icol["sub"]="sub=$i";
			$icol["type"]="type=1";
			$icol["gl_amount"]="gl_amount=".(${'amount_paid'.$i} * $sign);
			$icol["gl_quantity"]="gl_quantity=0";
			$icol["amount_due"]="amount_due=0";
			$icol["amount_paid"]="amount_paid='".(${'amount_paid'.$i})."'";
			$icolstr=join(',',$icol);
			if(empty(${'account'.$i}))
			{
				$pr=get_trans_account($_invaccount,0);
				$icolstr .=$pr;
			}
			if(empty(${'tid'.$i}))
			{
				$inid=${'in_id'.$i};
				$amount_paid=${'amount_paid'.$i};
				$discount=${'discount'.$i};
				$query="insert $t set $icolstr ";
				//echo $query;
				$db->query($query) or die($db->error);
				$tci[]=getLastInsert("tid","transactions","tid");
				$cx=$amount_paid+$discount;
				$query="update $t set applied_credit=applied_credit + '$cx',net_due=net_due - '$cx' where tid='$inid'";
				//echo $query;
				$db->query($query) or die($db->error);
			}
			else
			{
				$tid= ${'tid'.$i};
				$tci[]=$tid;
				$inid=${'in_id'.$i};
				$amount_paid=${'amount_paid'.$i};
				$discount=${'discount'.$i};
				$old_amount=${'old_amount'.$i};
				$old_discount=${'old_discount'.$i};
				$query="update $t set $icolstr where tid= '$tid'";
				//echo $query."<br>";
				$db->query($query) or die($db->error);
				$cx=$amount_paid-$old_amount+$discount-$old_discount;
				$query="update $t set applied_credit=applied_credit + '$cx',net_due=net_due - $cx where tid='$inid'";
				//echo $query;
				$db->query($query) or die($db->error);
			}
		}
	}
	$i=1; $end_count=0;
	for($i=1;$i<=$count; $i++)
	{
		$icol=$tcol;
		foreach($items as $k => $v)
		{
			if(isset(${$v.$i}))$icol[$v]=$v."='".$db->real_escape_string(${$v.$i})."'";
		}
		if(count($icol)!=count($tcol))
		{
			$icol["sub"]="sub=$i";
			$icol["gl_amount"]="gl_amount=".(${'amount'.$i} * $sign );
			$icol["gl_quantity"]="gl_quantity=".(${'quantity'.$i} * $sign);
			$icol["amount_due"]="amount_due='".(${'amount'.$i})."'";
			if(!empty($_glsign)){ $icol["amount_due"]="amount_due='$_payment_made'";  $icol["amount_paid"]="amount_paid='".${'amount'.$i}."'";}
			if(!empty($_zero_balance))$icol["amount_paid"]="amount_paid='".(${'amount'.$i})."'";
			$icolstr=join(',',$icol);
			if(empty(${'account'.$i}))
			{
				$pr=get_trans_account($_glaccount,0);
				$icolstr .=$pr;
			}else
			{
				$pr=get_trans_account(${'account'.$i},1);
				$icolstr .=$pr;
			}
			if(empty(${'tid'.$i}))
			{
				$query="insert $t set $icolstr ";
				//echo $query."<br>";
				$db->query($query) or die($db->error.$query);
				$tci[]=getLastInsert("tid","transactions","tid");
			}
			else
			{
				$tid= ${'tid'.$i};
				$tci[]=$tid;
				$query="update $t set $icolstr where tid= '$tid'";
				//echo $query."<br>";
				$db->query($query) or die($db->error.$query.$query);
			}
			$end_count++;
		}
	}
	
		
		$stci=join(',',$tci);
		prepareUpdate($trans_no, $stci);
		if(empty($stci) ) $stci=0;
		$query="delete from $t where tid not in ($stci) and trans_no='$trans_no' and sub<>0";
		//echo $query."<br>";
		$db->query($query) or die($db->error);
		executeUpdate();
		if(empty($tid) && !empty($telephone) && !empty($con))
		{
			sendsms($telephone,$company_sms_sender,$company_sale_message,$con);
		}
		//echo $_POST['ref'];
		require "print_transaction.php";
?>