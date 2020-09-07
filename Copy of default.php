<?php
	require_once "get_role_func.php";
	require_once "get_role_desc.php";
	require_once "get_company_info.php";
?>
<!DOCTYPE html> 
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $company_name; ?> | LinkBiz</title>
<script language="javascript" type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/default_page.js"></script>
<script language="javascript" type="text/javascript" src="scripts/materialize.js"></script>

<style type="text/css">
<!--
html { height: 100% }   
body {
	height: 100%;
	margin: 0;
	padding: 0;
	background-color: #DBDBDB;
}    

-->
</style>
<link href="css/index.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css" />
<link href="css/invoice.css" rel="stylesheet" type="text/css" />
<link href="css/materialize.css" type="text/css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body><div class="left-div"><div class="dummy_bar"><img src="images/ammony-logo.png<?php echo str_replace("../","",$company_logo_ref); ?>" height="65" alt="Logo"></div><div class="tool-bar"><?php $active=0;for($i=0;$i<$role_func_count;$i++) { if(!strpos($check,"~{$role_func_id[$i]}:")) continue; $active++; ?><a href="javascript:;" class="name-bar <?php if($active !=1) echo "inactive"; else echo "active" ?>" id="<?php echo $role_func_name[$i] ?>_btn"><?php echo $role_func_name[$i] ?></a><div id="<?php echo $role_func_name[$i] ?>_subdiv" class="tool-div <?php if($active !=1) echo 'hide-div'; else  echo 'show-div';?>" ><?php for($j=0;$j<$role_func_module_count[$i];$j++){ if(!strpos($check,"~{$role_func_id[$i]}:".$role_func_module_id[$i][$j])) continue; ?><a class="tool-item" href="javascript:;" id="<?php echo $role_func_module_href[$i][$j]?>" ><?php echo $role_func_module_name[$i][$j] ?></a><?php } ?></div><?php } ?></div></div><div class="main-div" id="default_div"><div class="header">
  <div class="c_name"><?php echo $company_name; ?></div>
  </div><div class="mid-div"></div>
  <div class="centralize active-div" >
  <div class="sub-toolbar"><div class="sub-title">Dashboard</div>
      <div class="sub-tools"><a href="javascript:;" class="st_b" onClick="closeForm()"><img src="images/icons/close.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onClick="minimize()"><img src="images/icons/minimize.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onClick="refresh()"><img src="images/icons/refresh.png"  hspace="1" border="0" align="left"></a><a href="javascript:;" class="st_b" onClick="printForm()"><img src="images/icons/print.png"  hspace="1" border="0" align="left"></a></div>
  </div><div class="body-div">
      <div class="r_content"></div>
    </div></div></div>

</body>
</html>