<?php 
		
		$page_title="Sales Invoice";
		$table=	"sales_invoice";
		$idcol="transcid";
		
		$iopenCol="invoice_date,Invoice Date|reference_no,Invoice ID|customer_name,Customer|total,Amount";
		$oparam=explode("|",$iopenCol);
		for($i=0;$i<count($oparam);$i++)
		{
			$osparam=explode(",",$oparam[$i]);
			$openCol[]=$osparam[0];
			$openColD[]=$osparam[1];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../css/dialog.css" rel="stylesheet" type="text/css" />
<link href="../css/default_tool.css" rel="stylesheet" type="text/css" />
<link href="../css/default_tool2.css" rel="stylesheet" type="text/css" media="print" />
<link href="../css/invoice.css" rel="stylesheet" type="text/css" />
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<link href="../css/item.css" rel="stylesheet" type="text/css" />
<link href="../css/combo.css" rel="stylesheet" type="text/css" />
<link href="../css/customer.css" rel="stylesheet" type="text/css" />
<link href="../css/account.css" rel="stylesheet" type="text/css" />
<link href="../css/email_invoice.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="house">
<div class="" id="new_form" >
 <form id="form_div" method="post" action="process_invoice.php" target="edit-frame" >
  <div>
    <table width="100%">
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;Invoice Number</td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;Date</td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;Job Order </td>
      </tr>
      <tr><td align="right">&nbsp;</td><td><input type="text" name="invoice_no" id="invoice_no" /></td>
      <td align="right">&nbsp;</td>
      <td>
        <input name="invoice_date" type="text"  id="invoice_date" onclick="editDate(this)" value="<?php if(isset($_COOKIE["today"])) echo $_COOKIE["today"]; else echo date("Y-m-d"); ?>" />      </td>
      <td>&nbsp;</td>
      <td><input name="joborder" type="text"  id="joborder" onfocus="setupComboControl(a,'tid','joborder','reference_no|description','itemid|description|'+o+'|'+d+'|'+p,'item'+n+'|desc'+n+'|price'+n+'|'+d+n+'|unit'+n,'getAmount','quantity'+n+'|price'+n+',amount'+n+',amount|total|salesTax');" value="" /></td>
      </tr>
    </table>
  </div>
  <div class="upload_bar" id="upload_bar">
      <div class="top-control"> <div class="magic-div"> <span> Customer </span> <input name="" type="text" autocomplete="off" onfocus="searchCustomer(this)" class="searchBox" id="customername" /> </div>
      </div>
        <iframe src="" scrolling="No" frameborder="0" height="1" width="1" id="inlineframe" name="inlineframe" style="display:none"></iframe></div>
   <div class="billTo" >Bill To <div class="borderless-box">
    <div class="rowBox" ><input type="text" name="billname" id="billname" class="subObj15" required /></div>
    <div class="rowBox" ><input type="text" name="billaddress" id="billaddress" class="subObj15" />
    </div><div class="rowBox" ><input type="text" name="billaddress2" id="billaddress2" class="subObj15" />
    </div>
    <div class="rowBox" ><input type="text" name="billcity" id="billcity" class="setBoxLeft" /><input type="text" name="billstate" id="billstate" class="setBoxRight" /></div>
	<div class="rowBox" ><input type="text" name="billzipcode" id="billzipcode" class="setBoxLeft" /><input type="text" name="billcountry" id="billcountry" class="setBoxRight" /></div>
	<div class="rowBox" ><input type="text" name="billphone" id="billphone" class="subObj15" /><input type="hidden" name="count" id="count" value="10" /><input type="hidden" name="submit_type" id="submit_type" /><input type="text" name="offline_id" id="offline_id" style="display:none"/><input type="text" name="customer_id" id="customer_id" style="display:none" /><input type="text" name="invoiceid" id="invoiceid" style="display:none" /><input type="text" name="current_balance" id="current_balance" style="display:none"  /><input type="text" name="recur_type" id="recur_type"  style="display:none" /><input type="text" name="recur_times" id="recur_times"  style="display:none"/><input type="text" name="punit" id="punit" value="unit"   style="display:none"/><input type="text" name="pricing_level" id="pricing_level"  style="display:none"/></div>
     </div></div>
  <div class="billTo" >Ship To 
    <div class="border-box">
      <div class="rowLine"><input type="text" name="ship_to" id="ship_to" class="setBox" /></div>
       <div class="rowLine"><input type="text" name="ship_address1" id="ship_address1" class="setBox" /></div><div class="rowLine"><input type="text" name="ship_address2" id="ship_address2" class="setBox" /></div> <div class="rowLine"><input type="text" name="ship_city" id="ship_city" class="setBoxLeft" /><input type="text" name="ship_state" id="ship_state" class="setBoxRight" /></div><div class="rowLine"><input type="text" name="ship_country" id="ship_country" class="setBoxLeft" /><input type="text" name="ship_zipcode" id="ship_zipcode" class="setBoxRight" /></div>
    <div class="rowLine">
      <input type="checkbox" name="ship_drop" id="bill" class="cbx" /> 
      Drop Ship</div>
   
  </div></div>
  <div class="shipRowTitle"><div class="subColTitle">Customer PO</div><div class="subColTitle">Warehouse</div>
  <div class="subColTitle">Ship Via</div>
  <div class="subColTitle">Ship Date</div><div class="subColTitle">Terms</div><div class="subColTitle">Sales Rep</div>
  </div><table cellspacing="0" class="itemTitle22" >
    <tr ><td class="subCol123"><input type="text" name="customerPO" id="customerPO" class="subObj15" /></td><td class="subCol123">
      <select name="wharehouse"  class="subObj15" id="wharehouse"><option value=""></option><?php for($i=0;$i<$wharehouse_count;$i++) { ?><option value="<?php echo $wharehouse_id[$i] ?>" <?php if(isset($_COOKIE['wharehouse']) && $_COOKIE['wharehouse']==$wharehouse_id[$i]) echo 'selected='; ?>><?php echo $wharehouse_name[$i] ?></option><?php } ?></select>
       </td><td class="subCol123">
      <select name="ship_via"  class="subObj15" id="ship_via"><option value=""></option><?php for($i=0;$i<$ship_via_count;$i++) { ?><option value="<?php echo $ship_via_id[$i] ?>"><?php echo $ship_via_name[$i] ?></option><?php } ?></select>
       </td><td class="subCol123"><input name="ship_date" type="text" class="subObj15" id="ship_date" onclick="editDate(this)" /></td><td class="subCol123"><input name="terms" type="text" class="subObj15" id="terms" /></td><td class="subCol123"><select name="sales_rep"  class="subObj15" id="sales_rep">
         <option value="-1"></option>
         <?php for($i=0;$i<$sales_rep_count;$i++) { ?>
         <option value="<?php echo $sales_rep_id[$i] ?>"><?php echo $sales_rep_name[$i] ?></option>
         <?php } ?>
      </select></td></tr></table>
  
  <table cellspacing="0" class="itemTitle22" >
  <tr ><td class="subColTitle124">Quantity</td><td class="subColTitle123">Item</td><td class="MainColTitle2">Description</td>
  
  <td class="subColTitle123">Unit Price</td>
  <td class="subColTitle123">Unit</td>
  <td class="subColTitle123">Amount</td></tr>
  <?php for($i=1;$i<11;$i++) { ?>
  <tr ><td class="subCol123"><input name="typeid<?php echo $i ?>" type="text" id="typeid<?php echo $i ?>" style="display:none" /><input name="subdivision<?php echo $i ?>" type="text" id="subdivision<?php echo $i ?>" style="display:none" /><input name="dunit<?php echo $i ?>" type="text" id="dunit<?php echo $i ?>" style="display:none" /><input name="quantity<?php echo $i ?>" type="text" class="subObj22" onkeyup="getAmount('quantity<?php echo $i ?>|price<?php echo $i ?>','amount<?php echo $i ?>','amount|total|salesTax')" id="quantity<?php echo $i ?>"  /></td><td class="subCol123"><input autocomplete="off" name="item<?php echo $i ?>"type="text" class="subObj22" id="item<?php echo $i ?>" onkeyup="setCombo(this,<?php echo $i ?>)" onclick="setCombo(this,<?php echo $i ?>)" /></td><td class="mainCol123"><input name="desc<?php echo $i ?>" type="text" class="MainObj22" id="desc<?php echo $i ?>" /></td><td class="subCol123"><input name="price<?php echo $i ?>" type="text" class="subObj22" id="price<?php echo $i ?>" onchange="getAmount('quantity<?php echo $i ?>|price<?php echo $i ?>','amount<?php echo $i ?>','amount|total|salesTax')"  /></td><td class="subCol123"><input name="unit<?php echo $i ?>" type="text" class="subObj22" id="unit<?php echo $i ?>" onclick="setSelect(this,<?php echo $i ?>)" readonly="readonly" /></td><td class="subCol123"><input name="amount<?php echo $i ?>" type="text" class="subObj22"  id="amount<?php echo $i ?>" onchange="getPrice('<?php echo $i ?>')"  /></td></tr> <?php } ?>  <tr ><td colspan="5" align="left" class="subCol1242">&nbsp;<a href="javascript:;" onclick ="addNewAdv2(this)" id="addClick">Add New </a></td>
  <td class="subCol123"><input name="sales_taxid" type="text" class="subObj22"  id="sales_taxid" onchange="sumColumn('amount','total','salesTax')" /></td></tr> <tr >
    <td colspan="5" class="subCol124">Sales Tax</td>
    <td class="subCol123"><input name="sales_tax" type="text" class="subObj22"  id="sales_tax" onchange="sumColumn('amount','total','salesTax')" /></td></tr><tr >
      <td colspan="5" class="subCol124">Freight</td>
      <td class="subCol123"><input name="freight" type="text" class="subObj22"  id="frieght" onchange="sumColumn('amount','total','salesTax')" /></td></tr>
</table><table class="itemTitle23"><tr><td>&nbsp;</td>
    <td class="subCol126">Other Applied Credit</td>
    <td class="subCol125">
      <input name="applied_credit" type="text" class="subObj22"  id="applied_credit" onchange="sumColumn('amount','total','salesTax')" />
   </td>
    <td  class="subCol126">Invoice Total</td>
    <td class="subCol125"><input name="total" type="text" class="subObj22"  id="total" /></td>
</tr>
<tr><td align="right"><label>
<input name="account" type="text" id="account" style="display:none" value="<?php echo getdefault_account("cash"); ?>" />
<input name="reference" type="text" id="reference" style="display:none" />
<input name="payment_method" type="text" id="payment_method" style="display:none" />
<input name="deposit_id" type="text" id="deposit_id" style="display:none" />
</label></td>
<td class="subCol126">Amount Paid at Sale </td>
    <td class="subCol125"><input name="paid_at_sale" type="text" class="subObj22"  id="paid_at_sale" readonly="readonly" /></td>
    <td  class="subCol126">Net Due</td>
    <td class="subCol125"><input name="net_due" type="text" class="subObj22"  id="net_due" /></td>
</tr>
</table>
  </form></div><div class="open_diplay_box" id="open_form" style="display:none" >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control"> <span> Search</span><input name="search" type="text" onkeyup="initializeOpen('<?php echo $idcol ?>','<?php echo $table ?>','<?php echo join('|',$openCol) ?>',this)" class="searchBox" id="Search Invoice" /><select name="daterange" id="daterange" onchange="initializeOpen('<?php echo $idcol ?>','<?php echo $table ?>','<?php echo join('|',$openCol) ?>')"><?php $dt=getDatePeriod(); for($k=0;$k<count($dt);$k++) { ?><option <?php if($dt[$k]=="Today") {?>selected="selected"  <?php } ?>><?php echo $dt[$k] ?></option> <?php } ?></select><select name="select_wh"  id="select_wh" onchange="initializeOpen('<?php echo $idcol ?>','<?php echo $table ?>','<?php echo join('|',$openCol) ?>')"><option value="-1"></option><?php for($i=0;$i<$wharehouse_count;$i++) { ?><option value="<?php echo $wharehouse_id[$i] ?>" <?php if(isset($_COOKIE['wharehouse']) && $_COOKIE['wharehouse']==$wharehouse_id[$i]) echo 'selected='; ?>><?php echo $wharehouse_name[$i] ?></option><?php } ?></select></div>
       </div><div class="tab_bar_title"><a href="javascript:;" class="inactive_sn" > S/ N</a><a href="javascript:;" class="inactive_sn" ></a><?php for($k=0;$k<count($openColD);$k++) { ?> <a href="javascript:;" onclick="changeBarTable('<?php echo $openCol[$k]; ?>')" class="inactive_title" id="<?php echo $openColD[$k]; ?>" style="width:<?php echo floor(90 / count($openColD)) ?>%"> <?php echo $openColD[$k] ;?> </a><?php } ?></div><div id="dialog_display" class="open_select-div"> <script type="text/javascript" language="javascript">function initializeOpen2(){ initializeOpen('<?php echo $idcol ?>','<?php echo $table ?>','<?php echo join('|',$openCol) ?>'); } ; initializeOpen2();</script></div>
</div>

</div>
<div class="sub-toolbar">
  <div class="sub-tools"><a href="javascript:;" class="st_dummy"></a><a href="javascript:;" class="st_a" onclick="swapView('new_form','open_form|new_form')"><img src="../images/icons/new.png" width="13" height="15" hspace="3" border="0" align="left"> &nbsp;New</a><a href="javascript:;" class="st_a" onclick="swapView('open_form','open_form|new_form')"><img src="../images/icons/open.png" height="15" hspace="2" border="0" align="left">&nbsp;Open</a><a href="javascript:;" class="st_a" onclick="checkSubmit(0)"><img src="../images/icons/save.png" height="15" hspace="2" border="0" align="left">&nbsp;Save</a><a href="javascript:;" class="st_a" onclick="checkSubmit(1)"><img src="../images/icons/print.png" width="16" height="16" hspace="2" border="0" align="left">&nbsp;Print</a><a href="javascript:;" class="st_a" onclick="checkSubmit(2)"><img src="../images/icons/message.png" width="24" height="14" hspace="2" border="0" align="left">&nbsp;Email</a><a href="javascript:;" class="st_a" onclick="document.getElementById('form_div').reset()"><img src="../images/icons/reset.png" hspace="2" border="0" align="left">&nbsp;Reset</a><a href="javascript:;" class="st_a" onclick="voidReference()"><img src="../images/icons/void.png" height="15" hspace="2" border="0" align="left">&nbsp;Void</a><a href="javascript:;" class="st_a" onclick="formDelete('invoice','../processInvoiceDeleteAjax.php')"><img src="../images/icons/delete.png" height="15" hspace="2" border="0" align="left">&nbsp;Delete</a><a href="javascript:;" class="st_dummy2"></a><a href="javascript:;" class="st_a" onclick="dialog(this,600,400,'recieve_payment.php')">&nbsp;Payment</a><a href="javascript:;" class="st_a" onclick="recur()">Recur</a><a href="javascript:;" class="st_dummy3"></a><a href="javascript:;" class="st_b" onclick="closeForm()"><img src="../images/icons/close.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onclick="minimize()"><img src="../images/icons/minimize.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onclick="refresh()"><img src="../images/icons/refresh.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onclick="printForm()"><img src="../images/icons/print.png"  hspace="1" border="0" align="left"></a></div>
  <div class="msg-board" id="msg-board"> :: </div>
  <div class="sub-title"><?php echo $page_title ?></div>
</div>
</body>
</html>