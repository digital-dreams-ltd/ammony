
<style type="text/css">
<!--
body {
	background-color: #FFF;
}
.refnumber {
	width: 35%;
	float: left;
}
.customerid {
	width: 20%;
	float: left;
}
.telephone {
	width: 20%;
	float: left;
}
.invoiceid {
	width: 35%;
	float: left;
}
.invoice_date{
	width: 20%;
	float: left;
}
.bill_to {
	width: 20%;
	float: left;
}
.sales_invoice {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%

}
.product {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%

}
.product-selected {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%;
	background:#9CF;

}
.ship_via {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%

}
.ship_via-selected {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%;
	background:#9CF;

}
.customer {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%

}
.customer-selected {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #DDD;
	float: left;
	width:100%;
	background:#9CF;

}
.product:hover {
	background:#DCDDE9
}
.sales_invoice:hover {
	background:#DCDDE9
}
.customer:hover {
	background:#DCDDE9
}
.name {
	width: 65%;
	float: left;
}
.customername {
	width: 60%;
	float: left;
}
.magic-div {
	height: 30px;
	width: 90%;
	overflow: hidden;
	position: absolute;
	background-color: #FFF;
	border: 1px solid #CCC;
}
.billTo {
	height: 100px;
	width: 40%;
	float: left;
	margin-left: 4%;
	margin-right: 4%;
}
.border-box {
	width: 100%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #333;
	border-right-color: #333;
	border-bottom-color: #333;
	border-left-color: #333;
}
.setBox {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: none;
	border-top-color: #FFF;
	border-right-color: #FFF;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	width: 98%;
	height: 15px;
	font-size: 11px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	margin: 0px;
	padding-top: 0px;
	padding-right: 1%;
	padding-bottom: 0px;
	padding-left: 1px;
}

.top-control {
	height: 30px;
}
.select-div {
	height: 230px;
	border: 1px solid #F5F5F5;
	overflow: auto;
	position: absolute;
	width: 94%;
	margin-top: 5px;
	margin-right: 1%;
	margin-bottom: 5px;
	margin-left: 1%;
	padding-top: 5px;
	padding-right: 1%;
	padding-bottom: 5px;
	padding-left: 1%;
}
.btn-tools {
	height: 25px;
	background-color: #F0F0F0;
	background-image: url(../images/graph-bg-darker.jpg);
	margin-top: 250px;
}
.setBoxLeft {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: none;
	border-top-color: #FFF;
	border-right-color: #333;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	width: 49%;
	height: 15px;
	font-size: 11px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	display: inline;
}
.setBoxRight {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: none;
	border-top-color: #FFF;
	border-right-color: #FFF;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	width: 50%;
	height: 15px;
	font-size: 11px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	margin-left: 0px;
	display: inline;
}
.rowLine {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	width: 100%;
	border-right-style: none;
}
.rowbox {
	border-bottom-width: 1px;
	border-bottom-color: #333;
	width: 100%;
}
.borderless-box {
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.shipRow {
	width: 95%;
	border: 1px solid #333;
	float: left;
	margin-right: 2%;
	margin-left: 2%;
}
.shipRowTitle {
	width: 95%;
	float: left;
	height: 15px;
	margin-right: 2%;
	margin-left: 2%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.POcol {
	text-align: center;
	width: 40%;
	float: left;
}
.subColTitle {
	text-align: center;
	float: left;
	width: 15%;
	margin: 0px;
	padding: 0px;
}
.MainObj {
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-right-color: #333;
	border-top-color: #FFF;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	font-size: 11px;
}


.MainColTitle {
	text-align: center;
	width: 40%;
	float: left;
	margin: 0px;
	padding: 0px;
}
.subObj15 {
	width: 100%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	padding: 0px;
	margin: 0px;
}
.itemTitle {
	width: 95%;
	float: left;
	height: 15px;
	margin-right: 2%;
	margin-left: 2%;
	background-color: #F2F9FF;
	margin-top: 15px;
	border: 1px solid #000;
}
.subColTitle12 {
	text-align: center;
	float: left;
	width: 12%;
	margin: 0px;
	padding: 0px;
}
.itemObj {
	width: 95%;
	margin-right: 2%;
	margin-left: 2%;
	margin-top: 0px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
	padding: 0px;
}
.subObj12 {
	width: 12%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #FFF;
	border-right-color: #333;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	padding: 0px;
	margin: 0px;
	height: 15px;
	font-size: 11px;
}
.subObj12Right {
	width: 12%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1%;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #FFF;
	border-right-color: #333;
	border-bottom-color: #FFF;
	border-left-color: #333;
	padding: 0px;
	margin: 0px;
	height: 15px;
	font-size: 11px;
}
.rightItem {
	width: 95%;
	margin-right: 2%;
	margin-left: 2%;
	margin-top: 0px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: none;
	padding: 0px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-right-color: #333;
	border-bottom-color: #333;
	height: 18px;
	clear: left;
}
.leftDummy {
	background-color: #FFF;
	display: block;
}
.subObjRight {
	width: 11%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #333;
	border-right-color: #333;
	border-bottom-color: #333;
	border-left-color: #333;
}
.subObj13 {
	width: 11%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #FFF;
	border-right-color: #333;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
	padding: 0px;
	margin: 0px;
	height: 15px;
	font-size: 11px;
}
.subColTitle123 {
	text-align: center;
	width: 12%;
	margin: 0px;
	padding: 0px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	background-color: #F2F9FF;
}
.MainColTitle2 {
	text-align: center;
	width: 40%;
	margin: 0px;
	padding: 0px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	background-color: #F2F9FF;
}
.subCol123 {
	width: 12%;
	border-bottom-width: 1px;
	border-bottom-style: none;
	border-bottom-color: #333;
	border-right-width: 1px;
	border-right-style: none;
	border-right-color: #333;
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: #333;
	border-top-style: none;
}
.searchBox {
	width: 90%;
	border: 1px solid #CCC;
	margin-top: 5px;
	margin-left: 5px;
}

.mainCol123 {
	width: 40%;
	border-right-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-right-color: #333;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	height: 15px;
	border-top-color: #FFF;
	border-bottom-color: #333;
	border-left-color: #333;
	font-size: 11px;
}
.subObj22 {
	width: 99%;
	margin: 0px;
	height: 15px;
	font-size: 11px;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	border: 1px none #FFF;
}
.MainObj22 {
	width: 99%;
	height: 15px;
	font-size: 11px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	padding: 0px;
}
.subCol124 {
	width: 12%;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	border-right-style: none;
}
.itemTitle22 {
	width: 95%;
	float: left;
	height: 15px;
	margin-right: 2%;
	margin-left: 2%;
	background-color: #FFF;
	margin-top: 15px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
}
.subColTitle124 {
	text-align: center;
	width: 12%;
	margin: 0px;
	padding: 0px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	background-color: #F2F9FF;
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: #000;
}
.subCol124 {
	text-align: right;
	width: 12%;
	margin: 0px;
	border-bottom-width: 1px;
	border-bottom-style: none;
	border-bottom-color: #333;
	border-left-width: 1px;
	border-left-style: none;
	border-left-color: #000;
	padding-top: 0px;
	padding-right: 5px;
	padding-bottom: 0px;
	padding-left: 0px;
}
.itemTitle23 {
	width: 95%;
	float: left;
	height: 15px;
	margin-right: 2%;
	margin-left: 2%;
	background-color: #FFF;
	margin-top: 0px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
}
.subCol125 {
	width: 12%;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	border-right-width: 1px;
	border-right-style: none;
	border-right-color: #333;
	border-left-width: 1px;
	border-left-style: none;
	border-left-color: #333;
}
.subCol126 {
	width: 12%;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333;
	border-right-width: 1px;
	border-right-style: none;
	border-right-color: #333;
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: #333;
	border-top-style: none;
	text-align: center;
}
.btn-item {
	margin: 2px;
	height: 23px;
	border: 1px solid #828282;
	float: left;
	padding-top: 2px;
	padding-right: 10px;
	padding-bottom: 2px;
	padding-left: 10px;
	color: #000;
	text-decoration: none;
}
.span-element {
	padding-right: 5px;
	padding-left: 5px;
}
.form-element {
	border: 1px solid #999;
	margin-right: 5px;
	margin-left: 5px;
	font-size: 11px;
}
.label-element {
	padding-top: 5px;
	padding-bottom: 5px;
}
.partition-element {
	width: 47%;
	height: 180px;
	margin-top: 1%;
	overflow: auto;
	float: left;
}
.gray {
	border: 1px solid #999;
	margin-right: 5px;
	margin-left: 5px;
	font-size: 11px;
	font-style: italic;
	color: #CCC;
}
.hold-div {
	float: left;
}
.billTo2 {
	height: 120px;
	width: 85%;
	float: left;
	margin-left: 4%;
	margin-right: 4%;
	padding: 10px;
	clear: left;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #E1E1E1;
	border-right-color: #E1E1E1;
	border-bottom-color: #E1E1E1;
	border-left-color: #E1E1E1;
}
.input-label {
	text-align: right;
	width: 40%;
	padding-right: 10px;
}
.top_line {
	border-top-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
	width: 12%;
}
.top_line2 {
	border-top-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
	width: 40%;
}
.title_print {
	font-size: 16px;
	font-weight: bold;
}
.bold {
	font-weight: bold;
}
.mainCol124 {
	width: 40%;
}
.logo-lg {
	float: right;
}
.report_header {
	font-family: "Trebuchet MS";
	font-size: 11px;
	display:none;
}

-->
</style>
<style type="text/css">
<!--
body,td,th {
	font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
	font-size: 12px;
	
	text-transform: uppercase;

}
-->
</style>
<?php if($trans_type=="JBJ") { ?>
<div>
<table cellpadding="0"  cellspacing="0" > 
  <tr >
    <td width="29%"></td>
    <td colspan="2"></td>
    <td colspan="2" align="right"></td>
  </tr>
  <tr >
    <td colspan="4" align="left" style="font-size:26px" > <?php echo $company_name; ?></td><td></td>
    </tr>
  <tr >
    <td colspan="3" align="center"><?php echo $company_motto; ?></td>
    <td colspan="2" align="right"><h2><?php echo $page_title ?></h2></td>
    </tr>
  <tr >
    <td class="bold"><?php echo $company_address1_title ?></td>
    <td width="16%" class="bold"><?php echo $company_address2_title ?></td>
    <td width="17%" class="bold"><?php echo $company_address3_title ?></td>
    <td width="20%" align="right" class="bold">Invoice Number:&nbsp; </td>
    <td width="18%" align="left" class="bold"><?php echo $ref ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1; ?></td>
    <td><?php echo $company_address2 ?> </td>
    <td><?php echo $company_address3; ?></td>
    <td align="right"><span class="bold">Date:&nbsp;</span></td>
    <td align="left"><?php echo $date ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1_phone ; ?></td>
    <td><?php echo $company_address2_phone ; ?></td>
    <td><?php echo $company_address3_phone ; ?></td>
    <td align="right"><span class="bold">Warehouse:</span></td>
    <td><?php echo $warehouse  ?></td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
</table>
  <div class="billTo" >Customer 
    <div class="borderless-box">
    <div class="rowBox" ><?php echo $customer; ?></div>
    <div class="rowBox" ><?php echo $address; ?></div>
    <div class="rowBox" ><?php echo $billaddress2 ?></div>
    <div class="rowBox" ><?php echo "$state $country ";  ?></div>
    <div class="rowBox" ><?php echo $telephone ?></div>
    <div class="rowBox" ></div>
    <div class="rowBox">&nbsp;</div>
  </div></div>
  <div class="billTo" >Ship To 
    <div class="borderless-box">
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
  </div></div>
  <table cellspacing="0" class="itemTitle22" style="background-image:url(<?php echo $company_bg_ref; ?>); background-position:center; background-repeat:no-repeat;" >
    <tr ><td class="subColTitle123">Item</td><td class="MainColTitle2">Description</td>
      
    <td class="subColTitle124">Quantity</td><td class="subColTitle123">Amount</td><td class="subColTitle123">Comment</td></tr>
    <?php for($i=1;$i<=$count;$i++) { if(!empty(${"itemid".$i }) )
		{?>
  <tr ><td align="center" class="subCol123"><?php echo ${"itemid".$i } ?></td>
  <td class="mainCol123"><span class="bold"><?php echo ${"description".$i } ?></span></td><td align="center" class="subCol123"><?php echo ${"quantity".$i }. ' '.${"unit".$i } ?></td>
  <td align="center" class="subCol123"><?php echo number_format(${"amount".$i },2,'.',','); ?></td>
  <td align="center" class="subCol123"><?php echo ${"memo".$i }; ?></td>
  </tr> <?php } }?>     <?php for($i=$count;$i<10;$i++) { ?>
  <tr ><td class="subCol123">&nbsp;</td><td class="mainCol123">&nbsp;</td><td class="subCol123">&nbsp;</td><td class="subCol123">&nbsp;</td><td class="subCol123">&nbsp;</td></tr> <?php  }?></table><table cellpadding="0"  cellspacing="0" class="itemTitle23"> <tr ><td width="14%" class="top_line">&nbsp;</td>
      <td width="30%" class="top_line">&nbsp;</td>
      <td width="28%" class="top_line2">&nbsp;</td>
      <td width="14%" class="top_line">&nbsp;</td>
      <td width="14%" class="top_line">&nbsp;</td>
  </tr> <tr ><td colspan="2" rowspan="5"><?php echo $company_return_policy ?><br />
<?php echo $company_sale_message ?> </td>
    <td class="subCol124">Total </td>
    <td colspan="2" align="left" >N <?php echo number_format($amount,2,'.',','); ?></td>
    </tr><tr ><td colspan="2" class="subCol124">&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    
    <tr ><td colspan="2" class="subCol124">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr ><td class="subCol124"><span class="title-span">Total</span></td>
      <td colspan="2" ><span class="title-span">N <?php echo number_format(($amount -($applied_credit + $paid_at_sale)),2,'.',','); ?></span></td>
    </tr>
  </table>
  <table cellpadding="0"  cellspacing="0" class="itemTitle23">
    
    <tr >
      <td class="subCol124">&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td class="subCol125">&nbsp;</td>
      <td class="subCol124">&nbsp;</td>
      <td class="subCol125">&nbsp;</td>
    </tr>
    <tr >
      <td  align="center" >Customer's Signature </td>
      <td align="center" >Processed by : <?php echo getUser($elims_id) ?></td>
      <td align="center" >For <?php echo $company_name; ?> </td>
    </tr>
  </table>
</div>
<?php } else {?>
<div>
<table cellpadding="0"  cellspacing="0" > 
  <tr >
    <td width="29%"></td>
    <td colspan="2"></td>
    <td colspan="2" align="right"></td>
  </tr>
  <tr >
    <td colspan="4" align="left" style="font-size:26px" > <?php echo $company_name; ?></td><td></td>
    </tr>
  <tr >
    <td colspan="3" align="center"><?php echo $company_motto; ?></td>
    <td colspan="2" align="right"><h2><?php echo $page_title ?></h2></td>
    </tr>
  <tr >
    <td class="bold"><?php echo $company_address1_title ?></td>
    <td width="16%" class="bold"><?php echo $company_address2_title ?></td>
    <td width="17%" class="bold"><?php echo $company_address3_title ?></td>
    <td width="20%" align="right" class="bold">Invoice Number:&nbsp; </td>
    <td width="18%" align="left" class="bold"><?php echo $ref ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1; ?></td>
    <td><?php echo $company_address2 ?> </td>
    <td><?php echo $company_address3; ?></td>
    <td align="right"><span class="bold">Date:&nbsp;</span></td>
    <td align="left"><?php echo $date ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1_phone ; ?></td>
    <td><?php echo $company_address2_phone ; ?></td>
    <td><?php echo $company_address3_phone ; ?></td>
    <td align="right"><span class="bold">Warehouse:</span></td>
    <td><?php echo $warehouse; ?></td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
</table>
  <div class="billTo" >Sold To 
    <div class="borderless-box">
    <div class="rowBox" ><?php echo $customer; ?></div>
    <div class="rowBox" ><?php echo $address; ?></div>
    <div class="rowBox" ><?php echo $billaddress2 ?></div>
    <div class="rowBox" ><?php echo "$state $country ";  ?></div>
    <div class="rowBox" ><?php echo $telephone ?></div>
    <div class="rowBox" ></div>
    <div class="rowBox">&nbsp;</div>
  </div></div>
  <div class="billTo" >Ship To 
    <div class="borderless-box">
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
  </div></div>
  <table cellspacing="0" class="itemTitle22" style="background-image:url(<?php echo $company_bg_ref; ?>); background-position:center; background-repeat:no-repeat;" >
    <tr ><td class="subColTitle123">Item</td><td class="MainColTitle2">Description</td>
      
    <td class="subColTitle124">Quantity</td><td class="subColTitle123">Unit Price</td><td class="subColTitle123">Amount</td></tr>
    <?php for($i=1;$i<=$count;$i++) { if(!empty(${"amount".$i}) &&  ${"amount".$i} !=0 )
		{?>
  <tr ><td align="center" class="subCol123"><?php echo ${"itemid".$i } ?></td>
  <td class="mainCol123"><span class="bold"><?php echo ${"description".$i } ?></span></td><td align="center" class="subCol123"><?php echo ${"quantity".$i }. ' '.${"unit".$i } ?></td>
  <td align="center" class="subCol123"><?php echo number_format(${"rate".$i },2,'.',','); ?></td>
  <td align="center" class="subCol123"><?php echo number_format(${"amount".$i },2,'.',','); ?></td>
  </tr> <?php } }?>     <?php for($i=$count;$i<10;$i++) { ?>
  <tr ><td class="subCol123">&nbsp;</td><td class="mainCol123">&nbsp;</td><td class="subCol123">&nbsp;</td><td class="subCol123">&nbsp;</td><td class="subCol123">&nbsp;</td></tr> <?php  }?></table><table cellpadding="0"  cellspacing="0" class="itemTitle23"> <tr ><td width="14%" class="top_line">&nbsp;</td>
      <td width="30%" class="top_line">&nbsp;</td>
      <td width="28%" class="top_line2">&nbsp;</td>
      <td width="14%" class="top_line">&nbsp;</td>
      <td width="14%" class="top_line">&nbsp;</td>
  </tr> <tr ><td colspan="2" rowspan="5"><?php echo $company_return_policy ?><br />
<?php echo $company_sale_message ?> </td>
    <td class="subCol124">Total Invoice Amount</td>
    <td colspan="2" align="left" >N <?php echo number_format($amount,2,'.',','); ?></td>
    </tr><tr ><td colspan="2" class="subCol124">&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr ><td class="subCol124">Payment/Credit Applied</td>
      <td colspan="2" >N <?php echo number_format(($applied_credit + $paid_at_sale),2,'.',','); ?></td>
    </tr>
    <tr ><td colspan="2" class="subCol124">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr ><td class="subCol124"><span class="title-span">Total</span></td>
      <td colspan="2" ><span class="title-span">N <?php echo number_format(($amount -($applied_credit + $paid_at_sale)),2,'.',','); ?></span></td>
    </tr>
  </table>
  <table cellpadding="0"  cellspacing="0" class="itemTitle23">
    
    <tr >
      <td class="subCol124">&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td class="subCol125">&nbsp;</td>
      <td class="subCol124">&nbsp;</td>
      <td class="subCol125">&nbsp;</td>
    </tr>
    <tr >
      <td  align="center" >Customer's Signature </td>
      <td align="center" >Processed by : <?php //echo getUser($elims_id) ?></td>
      <td align="center" >For <?php echo $company_name; ?> </td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if($trans_type=="INV") { ?>
<table cellpadding="0"  cellspacing="0" style="display: block; page-break-before: always;" > 
  <tr >
    <td width="29%"></td>
    <td colspan="2"></td>
    <td colspan="2" align="right"></td>
  </tr>
  <tr >
    <td colspan="4" align="left" style="font-size:26px" > <?php echo $company_name; ?></td><td></td>
    </tr>
  <tr >
    <td colspan="3" align="center"><?php echo $company_motto; ?></td>
    <td colspan="2" align="right"><h2>WAY BILL</h2></td>
    </tr>
  <tr >
    <td class="bold"><?php echo $company_address1_title ?></td>
    <td width="16%" class="bold"><?php echo $company_address2_title ?></td>
    <td width="17%" class="bold"><?php echo $company_address3_title ?></td>
    <td width="20%" align="right" class="bold">Invoice Number:&nbsp; </td>
    <td width="18%" align="left" class="bold"><?php echo $ref ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1; ?></td>
    <td><?php echo $company_address2 ?> </td>
    <td><?php echo $company_address3; ?></td>
    <td align="right"><span class="bold">Date:&nbsp;</span></td>
    <td align="left"><?php echo $date ?></td>
  </tr>
  <tr >
    <td><?php echo $company_address1_phone ; ?></td>
    <td><?php echo $company_address2_phone ; ?></td>
    <td><?php echo $company_address3_phone ; ?></td>
    <td align="right"><span class="bold">Warehouse:</span></td>
    <td><?php //echo getwharehouse("$wharehouse")."($wharehouse)" ?></td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
</table>
  <div class="billTo" >Sold To 
    <div class="borderless-box">
    <div class="rowBox" ><?php echo $customer; ?></div>
    <div class="rowBox" ><?php echo $address; ?></div>
    <div class="rowBox" ><?php echo $billaddress2 ?></div>
    <div class="rowBox" ><?php echo "$state $country ";  ?></div>
    <div class="rowBox" ><?php echo $telephone ?></div>
    <div class="rowBox" ></div>
    <div class="rowBox">&nbsp;</div>
  </div></div>
  <div class="billTo" >Ship To 
    <div class="borderless-box">
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
    <div class="rowBox"></div>
  </div></div>
  <table cellspacing="0" class="itemTitle22" style="background-image:url(<?php echo $company_bg_ref; ?>); background-position:center; background-repeat:no-repeat;" >
    <tr ><td class="subColTitle123">Item</td><td class="MainColTitle2">Description</td>
      
    <td class="subColTitle124">Quantity</td></tr>
    <?php for($i=1;$i<=$count;$i++) { if(!empty(${"amount".$i}) &&  ${"amount".$i} !=0 )
		{?>
  <tr ><td align="center" class="subCol123"><?php echo ${"itemid".$i } ?></td>
  <td class="mainCol123"><span class="bold"><?php echo ${"description".$i } ?></span></td><td align="center" class="subCol123"><?php echo ${"quantity".$i }. ' '.${"unit".$i } ?></td>
  
  </tr> <?php } }?>     <?php for($i=$count;$i<10;$i++) { ?>
  <tr ><td class="subCol123">&nbsp;</td><td class="mainCol123">&nbsp;</td><td class="subCol123">&nbsp;</td></tr> <?php  }?></table><table cellpadding="0"  cellspacing="0" class="itemTitle23"> <tr ><td width="14%" class="top_line">&nbsp;</td>
      <td width="30%" class="top_line">&nbsp;</td>
      <td width="28%" class="top_line2">&nbsp;</td>
      
  </tr> 
    
    
    
  </table>
  <table cellpadding="0"  cellspacing="0" class="itemTitle23">
    
    <tr >
      <td class="subCol124">&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td class="subCol125">&nbsp;</td>
      <td class="subCol124">&nbsp;</td>
      <td class="subCol125">&nbsp;</td>
    </tr>
    <tr >
      <td  align="center" >Supplied By </td>
      <td align="center" >Vehicle No : <?php //echo getUser($elims_id) ?></td>
      <td align="center" >Received By</td>
    </tr>
	<tr >
      <td class="subCol125">&nbsp;</td>
      <td class="subCol124">&nbsp;</td>
      <td class="subCol125">&nbsp;</td>
    </tr>
    <tr >
      <td  align="center" >Date </td>
      <td align="center" ></td>
      <td align="center" >Date</td>
    </tr>
	<tr >
      <td class="subCol125">&nbsp;</td>
      <td class="subCol124">&nbsp;</td>
      <td class="subCol125">&nbsp;</td>
    </tr>
    <tr >
      <td  align="center" >Signature </td>
      <td align="center" ></td>
      <td align="center" >Signature</td>
    </tr>
  </table>
<?php } ?>