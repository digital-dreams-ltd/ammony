<?php
	require_once "Database_Connect.php";
	//require_once "get_account_chart.php";
	require_once "get_last.php";
	require_once "get_default_account.php";
	require_once "table_func.php";
	require_once "updater.php";
	//print_r($_POST);
	if(!empty($_COOKIE["ELIMS-Warehouse"])) $_POST['warehouse']=$_COOKIE["ELIMS-Warehouse_Name"];
	if(empty($_POST['trans_no']))
	{
		$type=$_POST['trans_type'];
		$_POST['trans_no']=time().rand(5,50);
		if(empty($_POST['ref']))$_POST['ref']="WH".$_POST['warehouse']."-".$type.getlast($type);
	}

	adv_extract($_POST); 
	
	
	
	
	$t="transactions";

	$journal=array('tid'=>'tid','description'=>'description','amount'=>'credit','amount2'=>'debit','account'=>'account');
	$table_fields=getFields($t);
			

	$col=array(); $tcol=array();
	$tci=array();
	for($i=1;$i<$count;$i++)
	{
		if(empty(${'account'.$i})) continue;
		$icol=$tcol;
		
		foreach($journal as $k => $v)
		{
			if(empty(${$v.$i})){if ($v=='debit')$sign=1; else $sign=-1; continue; }
			if(isset(${$v.$i}) && $k!='account')
			{ 
				$k=str_replace('2','',$k);
				$icol[]=$k."='".${$v.$i}."'";
				${$k."_s"}=${$v.$i};
			}
		}
		$icol[]="warehouse='$warehouse'";
		$icol[]="trans_no='$trans_no'";
		$icol[]="date='$date'";
		$icol[]="ref='$ref'";
		$icol[]="sub='".($i-1)."'";
		$icol[]="type=1";
		$icol[]="trans_type='GNJ'";
		$icol[]="gl_amount=".(${'amount_s'} * $sign);
		$icolstr=join(',',$icol);

		
		
		$pr=get_trans_account(${'account'.$i},1);
		$icolstr .=$pr;
		
		if(empty(${'tid'.$i}))
		{
			$icol[]="gl_amount=".(${'amount_s'} * $sign);
			$query="insert $t set $icolstr ";
			$db->query($query) or die($db->error);
			$tci[]=getLastInsert("tid","transactions","tid");
			
		}
		else
		{
			$tid= ${'tid'.$i};
			$tci[]=$tid;
			
			$query="update $t set $icolstr where tid= '$tid'";
			//echo $query;
			$db->query($query) or die($db->error.$query);
			
		}
	
	}
		
		$stci=join(',',$tci);
		if(empty($stci) ) $stci=0;
		$query="delete from $t where tid not in ($stci) and trans_no='$trans_no'";
		$db->query($query) or die($db->error);
		echo $_POST['ref'];
?>