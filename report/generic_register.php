<?php
		$page_title="";$Form=array();$group="";
		require_once "../select_page.php";
		require_once "../get_page_func.php"; 
		require_once "../get_filter_parameter.php";	
		require_once "../get_param.php";		   
		$coldesc=array();
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";

		if(!empty($others))$dimension=$Form."|".$others; else $dimension=$Form;
		if(!empty($group_others)){if(!empty($group)) $g_dimension=$group."|".$group_others; else $g_dimension=$group_others;  }else $g_dimension=$group;
		
		$old_param=$dimension;

		$ifilter="";
		if(!empty($group_filter))
		{
			$gxfilter=explode("|",$group_filter);
			for($i=0;$i<count($gxfilter);$i++)
			{
				
				$sflt=explode(",",$gxfilter[$i]);
				
				$filter [$i]=trim($sflt[0]);
				$dsfilter[$i] =trim($sflt[1]);
				$sfilter[$i] =trim($sflt[2]);
				$cfilter[$i] =trim($sflt[3]);
			}
		}
		/*$xparam=explode("|",$Form);
		for($i=0;$i<count($xparam);$i++)
		{
			$rparam=str_replace("[","",$xparam[$i]);
			$sparam=superExplode(",",$rparam);
			if($col !="") $col .=",";
			$col .=trim($sparam[0]);
			if($realcol !="") $realcol .=",";
			$realcol .=trim($sparam[1]);
			if($colD !="") $colD .=",";
			$colD .=trim($sparam[2]);
			$order .=trim($sparam[3]);
			if(isset($sparam[4]))$stitle[$i]=trim($sparam[4]);
			if(isset($sparam[4]))$cbreak[$i]=trim($sparam[5]);
		}*/
		if(!empty($dimension))
		{
			$xdim=explode("|",$dimension);
			for($i=0;$i<count($xdim);$i++)
			{
				$rdim=str_replace("[","",$xdim[$i]);
				$sdim=superExplode(",",$rdim);
				$dimC[$i]=trim($sdim[0]);
				$dimD[$i]=trim($sdim[2]);
				$dimO[$i]=trim($sdim[3]);
				if(isset($sdim[4]))$stitle[$i]=trim($sdim[4]);
				if(isset($sdim[5]))$cbreak[$i]=trim($sdim[5]);
				$dimV[$i]=$rdim;
			}
		}
		if(!empty($g_dimension))
		{
			$gpt3=explode("|",$g_dimension);
			for($i=0;$i<count($gpt3);$i++)
			{
				$group_dimension_hold[]=$gpt3[$i];
				$gpt4=explode(",",$gpt3[$i]);
				$group_dimension[]=$gpt4[0];
				$group_dimension_label[]=$gpt4[1];
			}
		}
		if(!empty($group))
		{
			$gpt=explode("|",$group);
			for($i=0;$i<count($gpt);$i++)
			{
				
				$gpt2=explode(",",$gpt[$i]);
				$group[]=$gpt2[0];
				$group_Label[]=$gpt2[1];
				if($group_set !="") $group_set .=",";
				$group_set .=trim($gpt2[0]);
			}
		}
		if(!empty($graphCol))
		{
			$grpCol=explode("|",$graphCol);
			foreach($grpCol as $k => $v)
			{
				$v1=explode(',',$v);
				$datacol[]=$v1[0];
				$datacol_label[]=$v1[1];
				$datacol_prefix[]=$v1[2];
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
<script language="javascript" type="text/javascript" src="../scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/materialize.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/extensions.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/openform.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/comboControl.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/datetimepicker.js"></script>
<script type="text/javascript" language="javascript" src="../scripts/graph.js"></script>
<link href="../css/index.css" rel="stylesheet" type="text/css" />

<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="../css/materialize.css" type="text/css" rel="stylesheet">
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<link href="../css/default_tool2.css" rel="stylesheet" type="text/css" media="print" />
<link href="../css/datetimepicker.css" rel="stylesheet" type="text/css" />
</head>

<body> 
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?><div class="house" id="_<?php echo str_replace(' ','_',$page_title) ?>" >
<div class="upload" id="new_form" style="display:none" >
<div class="top-control row"> 
        
            
            <div id="_formfilterList" ><?php for($k=0;$k<count($category_column);$k++) { if($category_source[$k]=="period") {?><div class='input-field col s3 right'> <input class="dateFormFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" /><label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label></div><?php } else $jn[]=$xparam[$k]; }?><?php if(!empty($jn)) {?><div class="input-field col s3 right"><input name="search" type="text"  id='_filter' size="50" class="formFilter" data-value="<?php echo implode("|",$jn)?>" /><label for="_filter">Filter By</label></div><?php } ?></div>
       </div>
<div id="_load_report"></div>
  <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Print Report" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="reportPrint"><img src="images/icons/print.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg" /></i></a></li> 
      <li><a data-position="left" data-delay="50" data-tooltip="Reset" class="tooltipped btn-floating green" id="reportReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li>
	  <li><a data-position="left" data-delay="50" data-tooltip="Download Report" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/get_app.svg" /></i></a></li><li><a data-position="left" data-delay="50" data-tooltip="Email Report" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/email.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>
<div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control"> 
        
            
            <div class="input-field"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" /><input name="page_id" type="hidden" id="page_id" value="" />
       </div>

  </div><div id="dialog_display" class="open_select-div collection with-header" >
  </div>
  
 </div>
 
<script language="javascript" type="text/javascript">
	var pageId='_<?php echo str_replace(' ','_',$page_title) ?>';
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
	reportInitialize(pageId);


</script>
</div>
<?php if(empty($ajax)) { ?>

</body>
</html>
<?php } ?>