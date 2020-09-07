<?php

	
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
		if(empty($_POST['ref']))$_POST['ref']=$type.sprintf("%06d",getlast($type));
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
	$itemlist=array("itemid","description","primary_attrib_name","secondary_attrib_name");
	$items=array('tid','it_id','itemid','description','quantity','rate','amount','jid','joborder','primary_attrib_name','secondary_attrib_name',"memo");
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
			if(empty(${'amount'.$i}) && empty(${'description'.$i})) continue;
			if($invoice_count >1)$icol["sub"]="sub=".($i+$invoice_count-1); else $icol["sub"]="sub=$i";
			$icol["gl_amount"]="gl_amount=".(${'amount'.$i} * $sign );
			$icol["gl_quantity"]="gl_quantity=".(${'quantity'.$i} * $sign);
			$icol["amount_due"]="amount_due='".(${'amount'.$i})."'";
			if(!empty($_glsign)){ $icol["amount_due"]="amount_due='$_payment_made'";  $icol["amount_paid"]="amount_paid='".${'amount'.$i}."'";}
			if(!empty($_zero_balance))$icol["amount_paid"]="amount_paid='".(${'amount'.$i})."'";
			
			if(empty(${"it_id".$i}))
			{
				$m_item=${"itemid".$i};
				$m_price=${"amount".$i};
				$q="select * from item where itemid='$m_item'";
				$rs=$db->query($q) or die($db->error);
				if($rw=$rs->fetch_assoc())
				{
					$icol["it_id"]=$rw["tid"];
				}else
				{
					$tc=array();
					foreach($itemlist as $k=>$v)
					{
						
						$tc[$v]="$v='".${$v.$i}."'";
						
					}
					$tc["transcid"]="transcid=concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) ))";
					$tc["asset_type"]="asset_type=0";
					$tc["master_stock_id"]="master_stock_id=0";
					$tc["price1"]="price1='$m_price'";
					$tcstr=implode(",",$tc);
					$query="insert into item set $tcstr";
					$db->query($query) or die($db->error);
					$icol["it_id"]="it_id=".getLastInsert("tid","item","tid");
				}
			}
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