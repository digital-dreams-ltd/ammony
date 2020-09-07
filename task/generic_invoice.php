<?php
	$category_source=array();$page_title="";$_form=array();$_sign=1;
		require_once "../select_page.php";
		require_once "../get_param.php"; 
		require_once "../get_company_info.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$page_type=	$pageType;
		foreach($_form as $k1=> $v1)
		{
			$vcount=0;
			$xparam=explode("|",$v1);
			for($i=0;$i<count($xparam);$i++)
			{
				$rparam=$xparam[$i];
				$sparam=explode(",",$rparam);
				$columns[$k1][]=$sparam[0];
				$coldesc[$k1][]=$sparam[1];
				$size[$k1][]=$sparam[2];
				$order[$k1][]=$sparam[3];
				if(!empty($sparam[4]))
				{
					$src[$k1][]=$sparam[4];
					$source[]=$sparam[4];
				}else $src[$k1][]="";
				$vcount++;
			}
			
		}
		if(!empty($_category))
		{
			$xparam=explode("|",$_category);
			for($i=0;$i<count($xparam);$i++)
			{
				$rparam=$xparam[$i];
				$sparam=explode(",",$rparam);
				$category_column[]=$sparam[0];
				$category_name[]=$sparam[1];
				$category_source[]=$sparam[2];
				if(!empty($sparam[3])) $category_default[]=$sparam[3];
				else $category_default[]='';
			}
		}else $category_column=array();
?>
<?php if(empty($ajax)) { ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page_title ?></title>
<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="../css/materialize.css" type="text/css" rel="stylesheet"/>
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<link href="../css/datetimepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/materialize.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/extensions.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/openform.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/opentransaction.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/comboControl.js" ></script>
</head>

<body>
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?>
  <div class="house" id="_<?php echo str_replace(' ','_',$page_title); ?>"><div class="row" id="new_form" style="display:none"> <div class="" id="transRight">
		<form id="formData">
		<?php $k="top";if(!empty($columns[$k])) { ?>
		<div class="col s12 options_div" >
          <div class="card hoverable" style="overflow:visible" >
            <div class="card-content">
              <div class="row"><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="inpf input-field col <?php echo $size[$k][$k1] ?>"><?php if($order[$k][$k1]=="i") { ?><input type="text" id="_<?php echo $v1 ?>"  name='<?php echo $v1 ?>' /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php } else if($order[$k][$k1]=="d") { ?><input type="text" id="_<?php echo $v1 ?>" class='date' name='<?php echo $v1 ?>' /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="cb") { ?><input type="text" id="_<?php echo $v1 ?>" class='combo' name='<?php echo $v1 ?>' data-type="<?php echo $src[$k][$k1]; ?>" value="<?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) echo getData($param[$pr]['default']);?>" default-value="<?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) echo getData($param[$pr]['default']);?>" /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="ac") { ?><select id="_<?php echo $v1 ?>"  name='<?php echo $v1 ?>' class="account" <?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) $df= getData($param[$pr]['default']);?> default="<?php echo $df ?>">
          <?php  $data=loadData( $src[$k][$k1]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $v3 ?>" <?php if($v3==$df) echo 'selected'; ?> > <?php echo $v3 ?> </option>
          <?php  } ?>  </select><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="pr") { ?><input id="<?php echo $v1 ?>"  name='<?php echo $v1 ?>' type="checkbox" class="prepayment" value="1" />
          <label for="<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php } ?></div><?php } ?></div></div></div></div>
			<?php } ?>  
			  <div class="col s12 c_div">
          <div class="card hoverable" id="_customer_div">
            <div class="card-content cust" >
              <div class="row"><div class="input-field col s12"><input type="text" id="_customer" class="capitalize" name="customer"/><label for="_customer" id="customer_label"><?php echo $client ?></label></div></div></div><div class="card-content c_address" style="display:none" id="_new_customer" >
              <div class="row"><input type="text" id="_cid" class="capitalize" name="cid" style="display:none" /><div class="input-field col s12 m12 l6"><input type="text" id="_address" class="capitalize" name="address" /><label for="_address">Address</label></div><div class="input-field col s6 m3"><input type="text" id="_state" class="capitalize" name="state"/><label for="_state">State</label></div><div class="input-field col s6 m3"><input type="text" id="_country" class="capitalize" name="country"/><label for="country">Country</label></div></div>
			  <div class="row"><div class="input-field col s6 m3"><input type="tel" id="_telephone" class="validate" name="telephone" /><label for="_telephone">Phone</label></div><div class="input-field col s6 m3"><input type="email" id="_email" class="validate" name="email"/><label for="_email">Email</label><input type="text" id="_current_balance" style="display:none" name="current_balance" /></div></div>
            </div>
			<div class="card-action can "><a href="javascript:;" data-position="left" data-delay="50" data-tooltip="Show Customers" class="tooltipped right" id="customer-icon"><i class="material-icons"><img src="images/icons/person.svg" /></i></a><a href="javascript:;" data-position="left" data-delay="50" data-tooltip="Show Vendors" class="tooltipped right" id="vendor-icon"><i class="material-icons"><img src="images/icons/person_outline.svg" /></i></a><input type="text" id="_count" name='count' class='count' value="" style="display:none" /><input type="text" id="_invoice_count" name='invoice_count' class='invoice_count' value="0" style="display:none" /><input type="text" id="_amount" name='amount' value="" style="display:none" /><input type="hidden" id="_trans_type" name='trans_type' value="<?php echo $_type ?>" /><input type="text" id="_tid" name='tid' value="" style="display:none" /><input type="text" id="_trans_no" name='trans_no' value="" style="display:none" /><input name="_pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" /><input name="_invoice" type="hidden" id="_invoice" value="" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			<?php if(!empty($_account)) { ?><input type="hidden" id="_account" name='_account' value="<?php echo $_account ?>" /><?php } ?><?php if(!empty($_invaccount)){ ?><input type="hidden" id="_invaccount" name='_invaccount' value="<?php echo $_invaccount ?>" /><?php } ?><?php if(!empty($_preaccount)){ ?><input type="hidden" id="_preaccount" name='_preaccount' value="<?php echo $_preaccount ?>" /><?php } ?><?php if(!empty($_glaccount)){ ?><input type="hidden" id="_glaccount" name='_glaccount' value="<?php echo $_glaccount ?>" /><?php } ?><input type="hidden" id="_glaccount" name='sign' value="<?php echo $_sign ?>" /><?php if(!empty($c_type)) { ?><input type="hidden" id="_ctype" name='c_type' value="<?php echo $c_type ?>" /><?php } ?><?php if(!empty($_glsign)) { ?><input type="hidden" id="_glsign" name='_glsign' value="<?php echo $_glsign ?>" /><?php } ?><?php if(!empty($_zero_balance)) { ?><input type="hidden" id="_zero_balance" name='_zero_balance' value="<?php echo $_zero_balance ?>" /><?php } ?><?php if(!empty($_customer_invoiceitem)) { ?><input type="hidden" id="_customer_invoiceitem"  value="<?php echo $_customer_invoiceitem ?>" /><?php } ?><input id="sparam" type="hidden" value="<?php echo $_form["middle"]; ?>" /></div>
            </div>
        </div>
		<?php $k="middle"; if(!empty($columns[$k])) { ?>
		<div class="col s12">
          <div class="card hoverable">
		  <div class="cldv1">
		  <div id="_prep_div" ><div class="row teal-text lighten-1 desc"><div class="col s8">Description</div><div class="col s4">Amount</div></div><div class="row"><input type="text" class="col s8" id="_predesc" name="description1" disabled="disabled"><input type="text" class="col s4 amount" name="amount1" disabled="disabled" id="_predamount"><input type="hidden" name='quantity1' value="1" disabled="disabled" /><input type="hidden" name='tid1' value="" disabled="disabled" id="_predtid" /></div></div>
		  
		  <div id="_item_div1"><div id="_itemlist_div1" class="table"><div class="row teal-text lighten-1 desc crv capitalize"><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="col <?php echo $size[$k][$k1] ?>"><?php echo $coldesc[$k][$k1]?></div><?php } ?></div><div class="row teal-text lighten-1 desc crv " ><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="input-field no-padding col <?php echo $size[$k][$k1] ?>" style="margin-top:0px !important"><input type="text" name="<?php echo $columns[$k][$k1]."1"?>" id="<?php echo $columns[$k][$k1]."1"?>" class="<?php echo $columns[$k][$k1]?>" style="margin-bottom:0px !important"/><label for="<?php echo $columns[$k][$k1]."1"?>"></label></div><?php } ?></div><div id="_item_display"></div>
            </div></div></div>
            <div class="card-action row exbold">
			<div class="col s6 st">
			<div id="words" class="words"></div>
			<div class="smsg"> <?php echo $company_sale_message ?></div>
			 <div class="rtpc"> <?php echo $company_return_policy ?></div>
			</div>
			<div class="col s6 right">
			<input type="text" class="col s6 m8 r-align-bold total" readonly="true" autocomplete="off" id="_total"  /><label for="_total" class="hide-on-small-only r-label" >TOTAL</label></div>
          <?php if(!empty($_payment)){ ?> <div class="col s12 m6 right">
			<input type="text" class="col s6 m8 r-align " readonly="true" autocomplete="off" id="_amountPaid" name="_payment_made"  /><label for="_amountPaid" class="hide-on-small-only r-label" >AMOUNT PAID</label></div><?php if(!empty($_applied_credit)){ ?><div class="col s12 m6 left">
			<input type="text" class="col s8 m8 r-align " readonly="true" autocomplete="off" id="_applied_credit" name="applied_credit"  /><label for="_appplied_credit" class="hide-on-small-only r-label" >APPLIED CREDIT</label></div> <?php } ?><div class="col s12 m6 right">
			<input type="text" class="col s8 m8 r-align bold" readonly="true" autocomplete="off" id="_net_due"  /><label for="_net_due" class="hide-on-small-only r-label" >NET DUE</label></div><?php } ?>    
              
            </div>
          </div>
        </div>
		<?php } ?>
		<?php if(!empty($_payment)){ ?> <div class="modal fixed-footer" id="paymentModal"><div class="modal-content"><h5>Make Payment</h5><div class="row"><div class="col s12 m6 input-field"><input name="receipt_id" id="_receipt_id" type="text" style="display:none"/> <input name="deposit_id" id="_deposit_id" type="text"/> <label for="_deposit_id">Deposit ID</label></div><div class="col s12 m6 input-field"><select name='payment_method' id="_payment_method"><option selected="selected" >Cash</option><option >Cheque</option></select><label for="_payment_method">Payment Method</label></div></div><div class="row"><div class="col s12 m6 input-field"><input name="amount_paid" id="__amount_paid" type="text"/> <label for="_amount_paid">Amount Paid</label></div><div class="col s12 m6 input-field"><input name="receipt_account" id="_receipt_account" type="text" class="combo" data-type="cashAccount"/> <label for="_reciept_account">Cash Account</label></div></div></div><div class="modal-footer">
  <a href="#!" class="modal-action modal-close waves-effect waves-green btn ">Close</a>
    </div></div><?php } ?>
		</form></div>
		<div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Print" class="tooltipped btn-floating btn-large red" id="formPrint">
      <i class="large material-icons" ><img src="images/icons/print.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
	  <?php if(!empty($_payment)){ ?> <li><a data-position="left" data-delay="50" data-tooltip="Make Payment" class="tooltipped btn-floating purple" id="loadPayment"><i class="material-icons"><img src="images/icons/payment.svg" /></i></a></li><?php } ?>
      <li><a data-position="left" data-delay="50" data-tooltip="Reset Form" class="tooltipped btn-floating green" id="formReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li><li><a data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating pink" id="formSave"><i class="material-icons"><img src="images/icons/save.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>
<div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control row"> 
        
            
            <div class="input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><div id="_filterList" ><?php for($k=0;$k<count($category_column);$k++) { if($category_source[$k]=="period") {?><div class='input-field col s3 right'> <input class="dateFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" /><label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label></div><?php } else $jn[]=$xparam[$k]; }?><?php if(!empty($jn)) {?><div class="input-field col s3 right"><input name="search" type="text"  id='_filter' size="50" class="filter" data-value="<?php echo implode("|",$jn)?>"  /><label for="_filter">Filter By</label></div><?php } ?></div>
       </div>

  </div><div id="dialog_display" class="open_select-div collection with-header" >
  </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Create New <?php echo $page_title ?>" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="new"><img src="images/icons/add.svg" /></i>
    </a>
 	<ul>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating blue" id="_multiDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
	  <li><a data-position="left" data-delay="50" data-tooltip="Print" class="tooltipped btn-floating green" id="_multiPrint"><i class="material-icons"><img src="images/icons/print.svg" /></i></a></li>
	  <li><a data-position="left" data-delay="50" data-tooltip="Void" class="tooltipped btn-floating pink" id="_void"><i class="material-icons"><img src="images/icons/grid_off.svg" /></i></a></li>
    </ul>
  </div>
 </div>
      </div>

	  
<script language="javascript" type="text/javascript">
	var pageId='_<?php echo str_replace(' ','_',$page_title); ?>';
	$('#'+pageId).find('[id]').each(function()
	{
		var tmp=$(this).attr('id')+ pageId;
		$(this).attr({'id':tmp});
		$(this).attr({'data-pageid':pageId});
	})
	$('#'+pageId).find('[for]').each(function()
	{
		var tmp=$(this).attr('for')+ pageId;
		$(this).attr({'for':tmp});
	})
	
	formInitialize(pageId);
	transInitialize(pageId);
</script>
<?php if(empty($ajax)) { ?>
</html>
<?php } ?>