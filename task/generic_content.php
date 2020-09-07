<?php 
		$page_title="";$_form=array();$_actions=array();$action_columns=array();$coldesc=array(); $category_source=array();
		require_once "../select_page.php"; 
		require_once "../get_param.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";

		foreach($_form as $k=> $v)
		{
			
			foreach($v as $k1 => $v1)
			{
				$vcount=0;
				$xparam=explode("|",$v1);
				for($i=0;$i<count($xparam);$i++)
				{
					$rparam=$xparam[$i];
					$sparam=explode(",",$rparam);
					$columns[$k][$k1][]=$sparam[0];
					$coldesc[$k][$k1][]=$sparam[1];
					$required[$k][$k1][]=$sparam[2];
					$order[$k][$k1][]=$sparam[3];
					if(!empty($sparam[4]))
					{
						$src[$k][$k1][]=$sparam[4];
						$source[]=$sparam[4];
					}else $src[$k][$k1][]="";
					$vcount++;
				}
			}
			
		}
		foreach($_actions as $k=> $v)
		{
			$action_columns[$k]=array();$action_coldesc[$k]=array(); $action_order[$k]=array();
			if(!empty($param[$v]))
			{
			  $xparam=explode("|",$param[$v]['_c']);
			  foreach($xparam as $k2 => $v2)
			  {
				  
				  $sparam=explode(",",$v2);
				  
				   $action_columns[$k][]=$sparam[0];
				  $action_coldesc[$k][]=$sparam[1];
				  $action_order[$k][]=$sparam[2];
				  if(isset($sparam[2]))$action_source[$k]=$sparam[2];
			  }
			  $action_page[$k]=$param[$v]['_page'];
			  $action_name[$k]=$param[$v]['page_title'];
			  $action_icon[$k]=$param[$v]['_icon'];
			  $action_type[$k]=$v;
			}	
			
		}


?>
<?php if(empty($ajax)) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="../css/view_css2.css" rel="stylesheet" type="text/css" />
<title>Upload Resources</title>

<script  src="../scripts/elementLibrary.js" type="text/javascript"></script>
<script  src="../scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="../scripts/materialize.js" type="text/javascript"></script>
<script src="../scripts/uploadDialog.js" language="javascript" type="text/javascript"></script>
<script src="../scripts/selectCategory.js" type="text/javascript"></script>
<script src="../scripts/mangeusers.js" type="text/javascript"></script>
<script src="../scripts/anchorDialog.js" type="text/javascript"></script>
<script src="../scripts/richtext.js" type="text/javascript"></script>



</head>
<body><div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?>
  <div class="house" id="_<?php echo str_replace(' ','_',$page_title); ?>"><div class="row" id="new_form" style="display:none"> 
	
<form id="formData">
 <?php foreach($coldesc as $k => $v) { ?><div class="<?php echo $k."desc" ?>"> <?php foreach( $v as $k1 => $v1) { ?><div class="row"><div class="col s12"><div class="hold" style="padding-bottom:40px">
   
     <div class="richtext" data-url='<?php echo $_url; ?>' data-publish='<?php echo $_publish ?>' data-main='<?php echo $page_title ?>' data-col='<?php echo $_publishCol ?>'><?php foreach($v1 as $k2=>$v2) {?> <?php if($order[$k][$k1][$k2]=="t") { ?>
		 <h2 class="richtext-title" data-id="" name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>"></h2>
		<?php } else if($order[$k][$k1][$k2]=="b") { ?>
		<div class="richtext-body" style="font-size:22px" name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>"></div>
		<?php } ?><?php } ?></div></div></div></div><?php  } ?></div><?php } ?>
       <input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="" style="display:none" class="uniqueId" />
            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
       
   </form>
  </div><div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control"> 
        
            
            <div class="input-field"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><div id="_filterList" class="hide"><?php for($k=0;$k<count($category_source);$k++) { ?><div class='input-field'><select name="category_list" id="<?php echo $category_column[$k] ?>"><option ></option><?php for($i=0;$i<${$category_source[$k]."_count"};$i++) { ?>
            <option value="<?php echo  ${$category_source[$k]."_id"}[$i] ?>"> <?php echo ${$category_source[$k]."_name"}[$i] ?> </option>
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
 </div></div>
	  
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
	$('.richtext').richtext();
	formInitialize(pageId);
	transInitialize(pageId);
</script>
<?php if(empty($ajax)) { ?>
</html>
<?php } ?>