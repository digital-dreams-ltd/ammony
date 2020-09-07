<?php
	require_once "get_role_func.php";
	require_once "get_role_desc.php";
	require_once "get_company_info.php";
	
	$pages=json_decode(get_page_module(),true);
?>
<!DOCTYPE html> 
<html >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo strtoupper($company_name); ?> | LinkBiz</title>

<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/materialize.css" type="text/css" rel="stylesheet" >
<link href="css/datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
<link href="css/material_icons.css" rel="stylesheet" type="text/css" />
</head>

<body><div class="navbar-fixed height50">
    <nav class="height50">
      <div class="nav-wrapper myLineHeight  pink darken-2">
	  	<a class="vhBlend noref" href="report/dashboard.php?pageType=dashboardOne" label="Dashboard" id="_home"><i class="material-icons myIconSize iconColor iconPad"><img src="images/icons/home.svg"/></i></a>
        <a href="" class="brand-logo" id="_logo"><img src="images/logo.png" height="50px" align="left"><span id='_name'><?php echo strtoupper($company_name); ?></span></a>
        <ul class="right hide-on-med-and-down pink darken-4">
          <li id="pageLabel">Dashboard</li>
        </ul>
      </div>
    </nav>
	 <div style="" ><div class=" progress hide">
      <div class="indeterminate"></div>
  </div></div>
  </div>
 <?php include "navbar.php"; ?>
  <div class="row"><div class="mv" id="default_div"> 
  </div></div>
  <div id='_address' class="cpaddress"><div class="row bd"><div class="col s5"><?php echo $company_address1_title; ?></div><div class="col s5"><?php echo $company_address2_title; ?></div></div><div class="row"><div class="col s5"><?php echo $company_address1; ?></div><div class="col s5"><?php echo $company_address2; ?></div></div><div class="row"><div class="col s5"><?php echo $company_address1_phone; ?></div><div class="col s5"><?php echo $company_address2_phone; ?></div></div></div>
 <div class="modal" id="changeDate"><div class="modal-content"><h5>Change Accounting Date</h5><div class="row"><div class="col s12 input-field"><input id="cDate" type="text" class="date"/><label for="cDate">Change Today's Date</label></div></div></div><div class="modal-footer"><a class="modal-action modal-close waves-effect waves-green btn" id="setDate">Ok</a><a class="modal-action modal-close waves-effect waves-green btn-flat">Close</a></div></div>
 <script language="javascript" type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/moment.js"></script>
<script language="javascript" type="text/javascript" src="scripts/daterangepicker.js"></script>
<script language="javascript" type="text/javascript" src="scripts/default_page.js"></script>
<script language="javascript" type="text/javascript" src="scripts/materialize.js"></script>
<script language="javascript" type="text/javascript" src="scripts/extensions.js"></script>
<script language="javascript" type="text/javascript" src="scripts/openform.js"></script>
<script language="javascript" type="text/javascript" src="scripts/opentransaction.js"></script>
<script language="javascript" type="text/javascript" src="scripts/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" src="scripts/uniqueControl.js" ></script>
<script language="javascript" type="text/javascript" src="scripts/filterControl.js" ></script>
<script language="javascript" type="text/javascript" src="scripts/comboControl.js" ></script>
<script type="text/javascript" language="javascript" src="scripts/graph.js"></script>
<script type="text/javascript" language="javascript" src="scripts/printElement.js"></script>
<script type="text/javascript" language="javascript" src="scripts/richtext.js"></script>
<script type="text/javascript" language="javascript" src="scripts/anchorDialog.js"></script>
<script type="text/javascript" language="javascript" src="scripts/uploadDialog.js"></script>
<script type="text/javascript" language="javascript" src="scripts/selectCategory.js"></script>
<script type="text/javascript" language="javascript" src="scripts/numeric_function.js"></script>
<script language="javascript" type="text/javascript" src="scripts/localforage.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/Chart.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/offline.js">
</script>

<script language="javascript" type="text/javascript">
			var td=getCookie('_today')==''?_today:getCookie('_today');
			$('.date').datetimepicker({'format':'Y-m-d','timepicker':false}).val(td);
			$('#setDate').click(function()
			{
				setCookie('_today',$('#cDate').val(), 120)
			});
			var pid=$('#_home').attr('href');
			$('#_home').attr({'href':'javascript:;'})
			var nId=new Date().getTime();
			var nDiv=$("<div></div>").attr({'id':nId}).addClass("active-div");
			var crr=$(this);
			if(pid.indexOf('?')==-1) var url=pid+'?ajax=1';
			else var url=pid+'&ajax=1';
			$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
				{
					if(statusTxt == "success")
						$('#_home').attr({'data-active':nId})
						$("#default_div").append(nDiv);
					if(statusTxt == "error")
						Materialize.toast('Connection Error', 4000);
				});
</script>

</body>
</html>