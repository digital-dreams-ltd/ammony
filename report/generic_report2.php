<?php
		$page_title="";$Form=array();$group="";
		require_once "../select_page.php";
		require_once "../get_page_func.php"; 
		require_once "../get_filter_parameter.php";		   
		$coldesc=array();
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";

		if(!empty($others))$dimension=$_form."|".$others; else $dimension=$_form;
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
				$dimV[$i]=trim($sdim[3]);
				$dimO[$i]=trim($sdim[4]);
				if(isset($sdim[5]))$stitle[$i]=trim($sdim[5]);
				if(isset($sdim[6]))$cbreak[$i]=trim($sdim[6]);
				if(!empty($sdim[7]))
				{ 
					$group_dimension[]=$sdim[0];
					$group_dimension_label[]=$sdim[2];
				
				}
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
        
            
            <div class="input-field"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><div id="_filterList" class="hide"><?php for($k=0;$k<count($category_source);$k++) { ?><div class='input-field'><select name="category_list" id="<?php echo $category_column[$k] ?>"><option ></option><?php for($i=0;$i<${$category_source[$k]."_count"};$i++) { ?>
            <option value="<?php echo  ${$category_source[$k]."_id"}[$i] ?>"> <?php echo ${$category_source[$k]."_name"}[$i] ?> </option>
          <?php  } ?></select> <label class="cat" for='<?php echo $category_column[$k] ?>'>Filter by <?php echo $category_name[$k] ?> </label></div><?php } ?></div>
       </div>

  </div><div id="dialog_display" class="open_select-div collection with-header" >
  </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Setup Report" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="reportSetup"><img src="images/icons/add.svg" /></i>
    </a>
    <ul>
      <li><a data-position="left" data-delay="50" data-tooltip="Show Report" class="tooltipped btn-floating blue hide" id="new"><i class="material-icons"><img src="images/icons/visibility.svg" /></i></a></li>
    </ul>
  </div>
 </div>
 <div id="_report_setup" class="modal modal-fixed-footer">
  <div class="row"><div class="col s3"><div class="collection" id="report_menu" ><a href="javascript:;" onClick="changePanel(this)" id="date" class="collection-item">Select Date</a><a href="javascript:;" id="column" class="collection-item">Column</a><a href="javascript:;" id="primary" class="collection-item">Primary Grouping</a><a href="javascript:;" id="secondary" class="collection-item" >Secondary Grouping</a><a href="javascript:;" id="graph" class="collection-item">Select Graph</a><a href="javascript:;" id="filters" class="collection-item">Filters</a>
    
  </div><a type="button" class="btn" id="_runReport" >Run Report</a><div class="preloader-wrapper small active" id="_spinner" style="display:none">
    <div class="spinner-layer spinner-green-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
  </div>
  <div class="col s9" id="panel-div">
<div class="row" name="float_div" id="subdiv_date"><h5 "tab_title" id="dateTabTitle">Select Date </h5>
<div class="row">
  <div class="col s6"><div class="sub-date-title">Date Range</div><div class="input-field"><input type="text" name="startdate" id="startdate" class='date'/><label for="startdate">Start Date</label></div><div class="date-seperator"></div>  <div class="input-field"><input type="text" name="enddate" id="enddate" class='date'/><label for="enddate">End Date</label></div><a href="javascript:;" class="btn" id="dateRange" >Apply</a><a href="javascript:;" class="btn-flat" onClick="this.parentNode.parentNode.style.display='none'">Cancel</a></div>
  <div class="col s6"><div class="sub-date-title">Quick Dates </div><ul><ul><li>
<input name="drd" type="radio" value=""  id="drd"/><label for="drd">None</label></li><?php $date_array=getReportPeriod(); $date_array_count=count($date_array);for($i=0;$i<$date_array_count;$i++) { ?><li>
<input name="drd" type="radio" value="<?php echo $date_array[$i]; ?>" class="dateVal" id="drd_<?php echo $i ?>" /><label for="drd_<?php echo $i ?>"><?php echo $date_array[$i]; ?></label></li><?php } ?></ul></ul></div></div>
</div><div class="drop-down" name="float_div" id="subdiv_filters" style="display:none"><h5 >Filter </h5><ul id="filter_data"><?php for($j=0;$j<count($dsfilter);$j++){ ?><div class="row">
  <div class="col s3 input-field"><select name="<?php echo $filter[$j];?>" class="sl1 fchange" id="<?php echo $filter[$j];?>">
    <?php for($i=0; $i<$filter_parameter_count; $i++) { ?><option value="<?php echo $i ?>"><?php echo $filter_parameter_name[$i] ?></option><?php } ?>
    </select><label for="<?php echo $filter[$j];?>"><?php echo ucfirst(trim($dsfilter[$j])) ?></label>
  </div><div class="col s3  input-field">
  <?php if($sfilter[$j]=="i") {?>
  <input name="<?php echo $filter[$j]; ?>2" type="text" id="from<?php echo $filter[$j] ?>" size="10" disabled="disabled" />
  <?php } else if($sfilter[$j]=="n") {?>
  <input name="<?php echo $filter[$j]; ?>2" type="text" id="from<?php echo $filter[$j] ?>" size="10" onKeyUp="checkUnsignedInt(this)" disabled="disabled" />
  <?php } else if($sfilter[$j]=="s") {?>
  <select name="<?php echo $filter[$j]; ?>" id="from<?php echo $filter[$j] ?>" disabled="disabled">
            <?php for($i=0;$i<${$filter_source[$fsource_count]."_count"};$i++) { ?>
            <option value="<?php echo ${$filter_source[$fsource_count]."_id"}[$i] ?> " > <?php echo ${$filter_source[$fsource_count]."_name"}[$i] ?> </option>
            <?php  }  ;?>  </select><?php } else if($sfilter[$j]=="r") {?><input name="<?php echo $filter[$j]; ?>" type="text" id="from<?php echo $filter[$j] ?>" class="combo" data-type="<?php echo $cfilter[$j]; ?>" disabled="disabled" /><?php } ?><label  for="from<?php echo $filter[$j] ?>">From</label></div><div class="col s3 input-field"><?php if($sfilter[$j]=="i") {?>
  <input name="<?php echo $filter[$j]; ?>2" type="text" id="to<?php echo $filter[$j] ?>" size="10" disabled="disabled"/>
  <?php } else if($sfilter[$j]=="n") {?>
  <input name="<?php echo $filter[$j]; ?>2" type="text" id="to<?php echo $filter[$j] ?>" size="10" onKeyUp="checkUnsignedInt(this)" disabled="disabled" />
  <?php } else if($sfilter[$j]=="s") {?>
  <select name="<?php echo $filter[$j]; ?>" id="to<?php echo $filter[$j] ?>" disabled="disabled">
            <?php for($i=0;$i<${$filter_source[$fsource_count]."_count"};$i++) { ?>
            <option value="<?php echo ${$filter_source[$fsource_count]."_id"}[$i] ?> " > <?php echo ${$filter_source[$fsource_count]."_name"}[$i] ?> </option>
            <?php  } $fsource_count++ ;?>  </select><?php } else if($sfilter[$j]=="r") {?><input name="<?php echo $filter[$j]; ?>2" type="text" id="to<?php echo $filter[$j] ?>" class="combo" data-type="<?php echo $cfilter[$j]; ?>" disabled="disabled"/><?php } ?><label  for="to<?php echo $filter[$j] ?>">To</label></div></div><?php } ?></ul>
</div><div class="drop-down-unfixed" name="float_div" id="subdiv_graph" style="display:none"><h4>Select Graph Type</h4><ul><li><a href="javascript:;" class="no_underline" onClick="changeSelectGraph(this,'')"><i class="material-icons">do_not_disturb_off</i> None</a></li><li><a href="javascript:;" class="no_underline" onClick="changeSelectGraph(this,'Graph')"><i class="material-icons">show_chart</i> Line Graph</a></li><li><a href="javascript:;" class="no_underline" onClick="changeSelectGraph(this,'Bar Chart')"><i class="material-icons">equalizer</i> Bar Chart</a></li><li><a href="javascript:;" class="no_underline" onClick="changeSelectGraph(this,'Pie Chart')"><i class="material-icons">pie_chart</i> Pie Chart</a></li></ul><div class="tab_title" >&nbsp;</div><div class="tab_title" >Select Graph Data</div><ul><?php for($j=0;$j<count($datacol);$j++){ ?><li>
  <input type="checkbox" name="comb_checkbox" class="pri_cbx sx" id="comb_checkbox<?php echo $j ?>" checked="checked" disabled value="<?php echo $datacol[$j] ?>" onClick="changeCheckbox2(this,'idatacol')"/><label for="comb_checkbox<?php echo $j ?>" ><?php echo ucfirst(trim($datacol_label[$j])) ?></label></li><?php } ?></ul></div><div class="drop-down-unfixed row" name="float_div" id="subdiv_primary" style="display:none"><h4 >Primary Grouping </h4><div class="col s7"><ul><li><input type="radio" name="group_box<?php echo $i ?>" id="_checkbox30"  value="" class="pri_none" selected  /><label for="_checkbox30">None</label><?php for($j=0;$j<count($group_dimension);$j++){ ?><li>
    <input type="radio" name="group_box<?php echo $i ?>" id="checkbox33_<?php echo $j ?>"  value="<?php echo $group_dimension[$j] ?>" class="pri" /><label for="checkbox33_<?php echo $j ?>" ><?php echo ucfirst(trim($group_dimension_label[$j])) ?></label></li><?php } ?></ul></div><div class="col s5"><div class="tab_title" >Select Data</div><ul><?php for($j=0;$j<count($datacol);$j++){ ?><li>
  <input type="checkbox" name="pri_checkbox" id="pri_checkbox<?php echo $j ?>" checked="checked" value="<?php echo $datacol[$j] ?>" class="pri_cbx sx px" disabled="disabled"/><label for="pri_checkbox<?php echo $j ?>" ><?php echo ucfirst(trim($datacol_label[$j])) ?></label></li><?php } ?></ul></div></div><div class="drop-down-unfixed row" name="float_div" id="subdiv_secondary" style="display:none"><h4 >Secondary Grouping </h4><div class="col s7"><ul><li><input type="radio" name="group_box<?php echo count($group) ?>" id="_checkbox20"  value=""  selected="selected" class="pri_cbx sec_none" /><label for="_checkbox20">None</label></li><?php for($j=0;$j<count($group_dimension);$j++){ ?><li>
      <input type="radio" name="group_box<?php echo count($group) ?>" class="pri_cbx sec" id="cb_<?php echo $group_dimension[$j] ?>" disabled="disabled"  value="<?php echo $group_dimension[$j] ?>"  class="sec"  /><label for="cb_<?php echo $group_dimension[$j] ?>"><?php echo ucfirst(trim($group_dimension_label[$j])) ?></label></li><?php } ?></ul></div><div class="col s5"><div class="tab_title" >Select Data</div><ul><?php for($j=0;$j<count($datacol);$j++){ ?><li>
  <input type="radio" name="sec_checkbox" id="sec_data<?php echo $j ?>"  value="<?php echo $datacol[$j] ?>" class="sec_cbx vx" disabled="disabled"/><label for="sec_data<?php echo $j ?>" ><?php echo ucfirst(trim($datacol_label[$j])) ?></label></li><?php } ?></ul></div></div>
    <div class="drop-down" name="float_div" id="subdiv_column" style="display:none"><h4>Columns </h4>
      <div class="row"><div class="col s6">Show Field</div><div class="col s3">Show Title</div><div class="col s3">Column Break</div></div><ul id="col_data" class="sortable"><?php $source_count=0; for($i=0;$i<count($dimD);$i++){ ?><div class="row z-depth-1" id="c_<?php echo  $dimC[$i] ?>"><div class="col s6"><input  type="checkbox" value="<?php echo  $dimC[$i] ?>" class="gcol" <?php if($dimV[$i]=="v"){ ?> checked="checked" <?php } ?> alt="<?php if($dimO[$i]=="s") {echo $source_others[$source_count] ;$source_count++; }?>" id="checkbox5_<?php echo $i?>"  /><label for="checkbox5_<?php echo $i?>"> <?php echo $dimD[$i] ?></label></div><div class="col s3"><input name="show" type="checkbox" <?php if(isset($stitle[$i]) && $stitle[$i]="s" && $dimV[$i]=="v"){ ?> checked="checked" <?php } else if($dimV[$i]!="v") {?> disabled="disabled" <?php } ?> id="checkbox4_<?php echo $i?>"/><label for="checkbox4_<?php echo $i?>"></label></div><div class="col s3"><input name="show" type="checkbox" class="bcol"  <?php if(isset($cbreak[$i]) && $cbreak[$i]="k" && $dimV[$i]=="v"){ ?> checked="checked" <?php } else if($dimV[$i]!="v") {?> disabled="disabled" <?php } ?> id="checkbox6_<?php echo $i?>"/><label for="checkbox6_<?php echo $i?>"></label></div></div><?php } ?></ul>
        
    </div> </div>
  </div>
 <form action="run_report.php" method="post" name="form2" id="form2" target="edit-frame" >
<input name="paramSet" id="param" value="<?php echo $param ?>" type="hidden" />
 <input name="filter_param" id="filter_param" value="<?php echo $filter_param ?>" type="hidden" />
<input type="hidden" name="dateTitle" id="dateTitle" <?php if (isset($dateTitle)){ ?> value="<?php echo $dateTitle ?>" <?php } ?> /><input type="hidden" name="selectDate" id="selectDate" <?php if (isset($selectDate)){ ?> value="<?php echo $selectDate ?>" <?php } ?> />
      <input name="icombine"  id="icombine" type="hidden" value="" /><input name="distribute"  id="distribute" type="hidden" value="" /><input name="ifilter"  id="ifilter" type="hidden" value="" /><input name="pri"  id="pri" type="hidden" value="" /><input name="sec"  id="sec" type="hidden" value="" />
      <input name="igroup"  id="igroup" type="hidden" value="" /><input name="sort_col" id="sort_col" type="hidden" value="<?php echo $sort_col ?>" /><input name="dir" id="dir" type="hidden" value="<?php echo $dir ?>" /><input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" /><input name="pageType" type="hidden" value="<?php echo $pageType ?>" />
</form>
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