<?php
		extract($_GET, EXTR_OVERWRITE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style >

</style>
<link href="css/default_tool.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="report_display">
<div class="login-div" ><div class="down-div2">
  <p><img src="../images/warning.png" width="62" height="55" /></p>
  <p><?php if(isset($msg))echo $msg ?></p>
</div>
</div></div>
<script language="javascript" type="text/javascript">
	parent.document.getElementById('report_display').innerHTML=document.getElementById('report_display').innerHTML;
	if(parent.document.modalCover !=undefined)parent.document.modalCover.style.display="none";
	if(parent.document.modalDialog !=undefined)parent.document.modalDialog.style.display="none";
	parent.swapView('report_display','open_form|report_display');
</script>
</body>
</html>
