<?php 
	require_once "Database_Connect.php";
	require_once 'html2pdf.class.php';
	require_once 'select_page.php';
	
	$new=array();
	$query="select * from $t where $idcol in ($printIds)";
	$result = $db->query($query) or die($db->error);
	while($row=$result->fetch_assoc())
	{
		$new[]=$row;
	}
ob_start();
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	padding-left: 10px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	background-color: #FFFFFF;
}
.box-border {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	padding-left: 2px;
	text-align: left;
}
.bottom-right {
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-right-style: solid;
	border-bottom-style: solid;
	border-right-color: #000000;
	border-bottom-color: #000000;

}
-->
</style>
<?php foreach($new as $k=>$v) { ?>
<page format="A4" orientation="P" style="font: arial;">
<div>Hello</div> 
</page>
<?php } 

   $content = ob_get_clean();
	 if(empty( $content)) continue;
		 
	
    // convert
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $cb=$html2pdf->Output("",false);
		
	}	
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }



?>