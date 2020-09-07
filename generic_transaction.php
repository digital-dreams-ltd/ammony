<?php
	$category_source=array();$page_title="";$_form=array();$_sign=1;
		require_once "../select_page.php";
		require_once "../get_param.php"; 
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
  <div class="house" id="_<?php echo str_replace(' ','_',$page_title); ?>"><div class="row" id="new_form" style="display:none"> <div class="left-desc"><div class="row"><div class="col s12">
 
        <div class="">
          <div class="card hoverable">
            <div class="card-content">
              <div class="row"><div class="input-field col s3"><input  id="_qty" type="number" value="1"/><label for="qty" class="active" >Qty</label></div><div class="input-field col s9"><i class="material-icons prefix"><img src="images/icons/search.svg" /></i><input class="" type="text" id="_item" /><label for="_item" class="active">Item</label></div></div>
              <div class="" id="_item_panel_div" >
			  <div class="collection panel" id="_category_div">
      
    </div>
	<div class="collection panel" id="_item_search" style="display:none"></div>
			  </div>
			  <div class="" id="_invoice_div" style="display:none" >
			  <div class="collection panel" id="_invoice_category">
      
    </div>
	<div class="collection panel" id="_invoice_list" style="display:none"></div>
			  </div>
            </div>
            <div class="card-action right-align"><div class="left">
               <a href="#" class="waves-effect waves-light disable" id='_show_invoiceitem'><i class="material-icons" style='font-size:1.5rem'><img src="images/icons/dns.svg" /></i></a><a href="#" class="waves-effect waves-light disable" id='_show_invoice'><i class="material-icons" style='font-size:1.5rem'><img src="images/icons/event_note.svg" /></i></a><a href="#" class="waves-effect waves-light" id='_show_category'><i class="material-icons" style='font-size:1.5rem'><img src="images/icons/line_weight.svg" /></i></a><a href="#" class="waves-effect waves-light disable" id='_show_categoryitem'><i class="material-icons" style='font-size:1.5rem'><img src="images/icons/playlist_add_check.svg" /></i></a></div><a href="#" class="waves-effect waves-light btn white-text"><i class="medium material-icons"><img src="images/icons/send.svg" /></i></a>
             
            </div>
          </div>
        </div></div></div></div><div class="right-desc1" id="transRight">
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
              <div class="row"><input type="text" id="_cid" class="capitalize" name="cid" style="display:none" /><div class="input-field col s12 m6"><input type="text" id="_address" class="capitalize" name="address" /><label for="_address">Address</label></div><div class="input-field col s6 m3"><input type="text" id="_state" class="capitalize" name="state"/><label for="_state">State</label></div><div class="input-field col s6 m3"><input type="text" id="_country" class="capitalize" name="country"/><label for="country">Country</label></div></div>
			  <div class="row"><div class="input-field col s6"><input type="tel" id="_telephone" class="validate" name="telephone" /><label for="_telephone">Phone</label></div><div class="input-field col s6 "><input type="email" id="_email" class="validate" name="email"/><label for="_email">Email</label><input type="text" id="_current_balance" style="display:none" name="current_balance" /></div></div>
            </div>
			<div class="card-action can "><a href="javascript:;" data-position="left" data-delay="50" data-tooltip="Show Customers" class="tooltipped right" id="customer-icon"><i class="material-icons"><img src="images/icons/person.svg" /></i></a><a href="javascript:;" data-position="left" data-delay="50" data-tooltip="Show Vendors" class="tooltipped right" id="vendor-icon"><i class="material-icons"><img src="images/icons/person_outline.svg" /></i></a><input type="text" id="_count" name='count' value="1" style="display:none" /><input type="text" id="_invoice_count" name='invoice_count' value="1" style="display:none" /><input type="text" id="_amount" name='amount' value="" style="display:none" /><input type="hidden" id="_type" name='trans_type' value="<?php echo $_type ?>" /><input type="text" id="_tid" name='tid' value="" style="display:none" /><input type="text" id="_trans_no" name='trans_no' value="" style="display:none" /><input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			<?php if(!empty($_account)) { ?><input type="hidden" id="_account" name='_account' value="<?php echo $_account ?>" /><?php } ?><?php if(!empty($_invaccount)){ ?><input type="hidden" id="_invaccount" name='_invaccount' value="<?php echo $_invaccount ?>" /><?php } ?><?php if(!empty($_preaccount)){ ?><input type="hidden" id="_preaccount" name='_preaccount' value="<?php echo $_preaccount ?>" /><?php } ?><?php if(!empty($_glaccount)){ ?><input type="hidden" id="_glaccount" name='_glaccount' value="<?php echo $_glaccount ?>" /><?php } ?><input type="hidden" id="_glaccount" name='sign' value="<?php echo $_sign ?>" /><?php if(!empty($c_type)) { ?><input type="hidden" id="_ctype" name='c_type' value="<?php echo $c_type ?>" /><?php } ?><?php if(!empty($_zero_balance)) { ?><input type="hidden" id="_zero_balance" name='_zero_balance' value="<?php echo $_zero_balance ?>" /><?php } ?><?php if(!empty($_customer_invoiceitem)) { ?><input type="hidden" id="_customer_invoiceitem" name='_zero_balance' value="<?php echo $_customer_invoiceitem ?>" /><?php } ?></div>
            </div>
        </div>
		<?php $k="middle"; if(!empty($columns[$k])) { ?>
		<div class="col s12">
          <div class="card hoverable">
		  <div class="cldv">
		  <div id="_prep_div" style="display:none"><div class="row teal-text lighten-1 desc"><div class="col s8">Description</div><div class="col s4">Amount</div></div><div class="row"><input type="text" class="col s8" id="_predesc" name="description1" disabled="disabled"><input type="text" class="col s4 amount" name="amount1" disabled="disabled" id="_predamount"><input type="hidden" name='quantity1' value="1" disabled="disabled" /><input type="hidden" name='tid1' value="" disabled="disabled" id="_predtid" /></div></div>
		  
		  <div id="_item_div"><div id="_invoiceitem_div" style="display:none" ><div class="row teal-text lighten-1 desc"><div class="col s3">Invoice</div><div class="col s2">Date</div><div class="col s2">Amount Due</div><div class="col s2">Discount</div><div class="col s2">Amount Paid</div></div><div class="card-content striped" id="_invoice_display" style="border-bottom:solid 1px #CCCCCC"></div></div><div id="_itemlist_div" style="display:none" class="table"><div class="row teal-text lighten-1 desc"><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="col <?php echo $size[$k][$k1] ?>"><?php echo $coldesc[$k][$k1]?></div><?php } ?></div>
            <div class="card-content striped" id="_item_display" <?php if(!empty($show_account)) echo 'data-account="1"'; ?> >
              </div></div></div></div>
            <div class="card-action row exbold">
			<input type="text" class="col s6 left-align cmp"  value="Thanks" style="display:none" />
			<input type="text" class="col s6 left-align words" value="300" style="display:none" />
			<input type="text" class="col s11 right-align bold" readonly="true" autocomplete="off" id="total" /><label for="total" class="hide-on-small-only" >TOTAL</label>
              
              
            </div>
          </div>
        </div>
		<?php } ?>
		</form></div>
		<div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Print" class="tooltipped btn-floating btn-large red" id="formPrint">
      <i class="large material-icons" ><img src="images/icons/print.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Reset Form" class="tooltipped btn-floating green" id="formReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li><li><a data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating pink" id="formSave"><i class="material-icons"><img src="images/icons/save.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>
<div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control row"> 
        
            
            <div class="input-field col s<?php echo 12 - (count($category_column) * 2); ?>"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><div id="_filterList" ><?php for($k=0;$k<count($category_column);$k++) { ?><div class='input-field col s2'><select name="<?php echo $category_column[$k] ?>" id="" class="filterList"><option ></option><?php  $data=loadData( $category_source[$k]); foreach($data as $k3=> $v3) { ?>
            <option value="<?php echo  $k3 ?>" <?php if(strtolower($v3)==strtolower($category_default[$k])) echo "selected" ?>> <?php echo $v3; ?> </option>
          <?php  } ?></select> <label class="cat" for='<?php echo $category_column[$k] ?>'>Filter by <?php echo $category_name[$k] ?> </label></div><?php } ?></div>
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