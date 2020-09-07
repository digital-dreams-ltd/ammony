<?php
		$page_title="";$_form=array();$_actions=array();$action_columns=array();$coldesc=array(); $category_source=array();
		require_once "../select_page.php"; 
		require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 
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
<link href="../css/index.css" rel="stylesheet" type="text/css" />

<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="../css/materialize.css" type="text/css" rel="stylesheet">
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<link href="../css/default_tool2.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body> 
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?><div class="house" id="_<?php echo str_replace(' ','_',$page_title) ?>" >
<div class="upload" id="new_form" style="display:none" >
<form id="formData">
 <?php foreach($coldesc as $k => $v) { ?><div class="<?php echo $k."desc" ?>"> <?php foreach( $v as $k1 => $v1) { ?><div class="row"><div class="col s12 "><div class="row card hoverable" style="padding-bottom:40px;overflow:visible;">
   
     <div class="card-content" > <div class="card-title black-text"><?php echo $k1; ?></div><?php foreach($v1 as $k2=>$v2) {  ?>
	  
         <?php if($order[$k][$k1][$k2]=="i") { ?>
		 <div class="inpf input-field col s12 m6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB capitalize" type="text"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="s") { ?>
		<div class="inpf input-field col s12 m6">
		<select name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?> " > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="sl") { ?>
		<div class="inpf input-field col s12">
		<select name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?>" > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="sw") { ?>
		<div class="inpf input-field col s12 m6">
		 <?php $data=loadData($src[$k][$k1][$k2]); ?>
		 <label for="<?php echo $columns[$k][$k1][$k2]; ?>" class"active"></label>
		 <div class="switch" style="height:50px">
		 	
			<label>
			 <?php echo $data[0] ?>
		<input type='checkbox' name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") echo "required" ?>" >
       	  <span class="lever"></span>
      			<?php echo $data[1] ?>
    		</label>
  </div></div>
		<?php } else if($order[$k][$k1][$k2]=="cb") { ?>
		<div class="inpf input-field col s12 m6">
		<input type='text' name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" class="combo capitalize <?php if($required[$k][$k1][$k2]=="r") echo "required" ?>" data-type="<?php echo $src[$k][$k1][$k2]; ?>" data-create="1" >
       	  <label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php   } else if($order[$k][$k1][$k2]=="q") { ?>
		<div class="inpf input-field col s12">		
		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" type="text" class="capitalize unique" id="<?php echo $columns[$k][$k1][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> data-type="<?php echo $pageType; ?>"  /><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($order[$k][$k1][$k2]=="l") { ?>
		<div class="inpf input-field col s12">		
		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" type="text" class="capitalize" id="<?php echo $columns[$k][$k1][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?>  /><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($order[$k][$k1][$k2]=="t") { ?>
		<div class="inpf input-field col s12">		
		  <textarea name="<?php echo $columns[$k][$k1][$k2]; ?>" class="capitalize materialize-textarea" id="<?php echo $columns[$k][$k1][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> /></textarea><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($order[$k][$k1][$k2]=="c") { ?>
		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="" type="hidden" />
        <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>
        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $columns[$k][$k1][$k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>
        <?php  } } else if($order[$k][$k1][$k2]=="h") { ?>
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="<?php echo $value[$value_count] ?>" type="hidden" />
        <?php  } else if($order[$k][$k1][$k2]=="n") { ?>
		<div class="inpf input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="number"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($order[$k][$k1][$k2]=="pw") { ?>
		<div class="inpf input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($order[$k][$k1][$k2]=="pl") { ?>
		<div class="inpf input-field col s12">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  } else if($order[$k][$k1][$k2]=="d") { ?>
		<div class="inpf input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="date validate nB" type="text"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php   } else if($order[$k][$k1][$k2]=="rl") { $pages=json_decode(get_page_module(),true);?>
		<div class="inpf input-field col s12 role"><input type="hidden" name='<?php echo $columns[$k][$k1][$k2]; ?>' />
        <ul class="collection">
  <?php foreach($pages as $k => $v ) { $vp=json_decode($v['props'],true);?>
    <li>
      <div class="collection-header "><input id='<?php echo str_replace(':','_',$vp['id']) ?>' value='<?php echo $vp['id'] ?>' type="checkbox" class="rlAll"><label for='<?php echo $vp['id'] ?>' class="collection-header"><?php echo $k ?></label></div>
      <div class="collection-item"><p class="collection"><?php foreach($v['subs'] as $k1=> $v1){ $sp=json_decode($v1,true); ?><div class="collection-item"><input class='cbr<?php echo $vp['id'] ?>' type="checkbox" id="<?php echo $vp['id'].'_'.$sp['id'] ?>" value="<?php echo $vp['id'].':'.$sp['id'] ?>"><label for="<?php echo $vp['id'].'_'.$sp['id'] ?>"  ><?php echo $sp['name']; ?></label></div><?php } ?></p></div>
    </li> <?php } ?>
   
  </ul></div>
        <?php  } else if($order[$k][$k1][$k2]=="p") { ?>
		<div class="inpf input-field col 12">
		<a href="javascript:;"  id="uploadPic" data-href="upload.php" data-dir="assets/pictures/" ><img src="images/default.png" style="width: 100%;" class='form_pic'><div class="white black-text center-align valign-wrapper" style="position: absolute; right: 0px; top: 0px; opacity: 0.8; margin-top: 20px;"><i class="material-icons black-text medium valign">photo_camera</i><span class="valign"> Click to change picture </span></div></a>
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="hide validate nB" type="text"/></div>
        <?php  } ?> 
	  <?php  } ?></div></div></div></div><?php  } ?></div><?php } ?>
       <input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="" style="display:none" class="uniqueId" />
            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
       
   </form>
  <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons" id="formSave"><img src="images/icons/save.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg"></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Reset" class="tooltipped btn-floating green" id="formReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li>
	  <li><a data-position="left" data-delay="50" data-tooltip="Print" class="tooltipped btn-floating orange" id="formPrint"><i class="material-icons"><img src="images/icons/print.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>
<div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control row"> 
        
            
           <div class="inpf input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label><i class="material-icons prefix"><img src="images/icons/search.svg" /></i></div><div id="_filterList" ><?php for($k=0;$k<count($category_column);$k++) { if($category_source[$k]=="period") {?><div class='inpf input-field col s3 right'> <input class="dateFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" /><label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label></div><?php } else $jn[]=$xparam[$k]; }?><?php if(!empty($jn)) {?><div class="inpf input-field col s3 right"><input name="search" type="text"  id='_filter' size="50" class="filter" data-value="<?php echo implode("|",$jn)?>"  /><label for="_filter">Filter By</label></div><?php } ?></div>
       </div>

  </div><div id="dialog_display" class="open_select-div collection with-header" >
  </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Add New <?php echo $page_title; ?>" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="new"><img src="images/icons/add.svg" /></i>
    </a>
    <ul>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating blue" id="_multiDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
<?php foreach($action_columns as $k => $v) {?><li> <a href="#actionpanel<?php echo $k.'_'.$page_title ?>" data-position="left" data-delay="50" data-tooltip="<?php echo $action_name[$k] ?>" class="tooltipped btn-floating <?php echo $_color[$k]; ?> modal-trigger"><i class="material-icons"><img src="images/icons/<?php echo $action_icon[$k] ?>.svg" /></i></a></li><?php } ?>    </ul>
  </div>
 </div>
 <?php foreach($action_columns as $k=> $v) { ?>
<form action="<?php echo $action_page[$k] ?>" method="post" name="form2" id="fm_action_<?php echo $k ?>"  data-submit="<?php if(isset($action_submit[$k]))echo $action_submit[$k]; else echo '0' ?>" enctype="multipart/form-data">
    <div class="modal modal-fixed-footer" id="actionpanel<?php echo $k ?>">
  
  <div class="modal-content">
      <h5><i class="material-icons small"><?php echo $action_icon[$k] ?></i> <?php echo $action_name[$k] ?></h5>
        <?php for($j=0;$j<count($action_coldesc[$k]);$j++) { ?><div class="row"><?php  if($action_order[$k][$j]=="i") {?>
        <div class="col s12 inpf input-field"><input name="<?php echo $action_columns[$k][$j]; ?>" type="text" id="acn_<?php echo $action_columns[$k][$j]; ?>" /><label for="acn_<?php echo $action_columns[$k][$j]; ?>"><?php echo $action_coldesc[$k][$j]; ?></label></div>
        <?php } else if($action_order[$k][$j]=="t") {?>
        <div class="col s12 inpf input-field"><textarea name="<?php echo $action_columns[$k][$j]; ?>"  id="acn_<?php echo $action_columns[$k][$j]; ?>" class="materialize-textarea" length="120"></textarea><label for="acn_<?php echo $action_columns[$k][$j]; ?>"><?php echo $action_coldesc[$k][$j]; ?></label></div>
        <?php } else if($action_order[$k][$j]=="u") {?>
        <div class="col s12 file-field inpf input-field"><div class="btn">
        <span><?php echo $action_coldesc[$k][$j]; ?></span>
        <input type="file" name="<?php echo $action_columns[$k][$j]; ?>">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div></div>
        <?php } else if($action_order[$k][$j]=="s") { ?>
         <div class="col s12 inpf input-field">
            <select name="<?php echo $action_columns[$k][$j]; ?>" id="acn_<?php echo $action_columns[$k][$j]; ?>">
            <?php $data=loadData($action_source[$k]);foreach($data as $k=> $v) { ?>
            <option value="<?php echo  ${$action_source[$k][$action_source_count[$k]]."_id"}[$i] ?>"> <?php echo ${$action_source[$k][$action_source_count[$k]]."_name"}[$i] ?> </option>
            <?php  } $action_source_count[$k]++ ;?>  </select>
          <label for="acn_<?php echo $action_columns[$k][$j]; ?>"><?php echo $action_coldesc[$k][$j]; ?></label></div>
             <?php } else if($action_order[$k][$j]=="c") { ?>
         <div class="col s12 inpf input-field"><span class="sn-col"><?php echo $action_coldesc[$k][$j]; ?> </span>
            <input name="<?php echo $action_columns[$k][$j]; ?>" id="<?php echo $action_columns[$k][$j]; ?>" value="" type="hidden" />
            <?php for($i=0;$i<${$action_source[$k][$source_count]."_count"};$i++) { ?>
            <input  type="checkbox" value="<?php echo  ${$action_source[$k][$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $action_columns[$k][$j]; ?>')" id='acn_<?php echo $action_columns[$k][$j].$i; ?>'/> <label for="acn_<?php echo $action_columns[$k][$j].$i; ?>"><?php echo ${$action_source[$k][$source_count]."_name"}[$i] ?> </label>
            <?php  }$action_source_count[$k]++ ;?> <?php } else if($action_order[$k][$j]=="j") { ?>
         <div class="col s12 inpf input-field"><?php echo $action_coldesc[$k][$j]; ?> </div> <?php } ?>
</div>
        <?php } ?>
	</div>
        <div class="modal-footer"><a href="#fm_action_<?php echo $k ?>" class="modal-action modal-close waves-effect waves-green btn action-btn">Ok</a>   
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat action-btn">CANCEL</a>
               <input name="filter_checkbox" class="filter_checkbox" type="hidden" />
			   <input name="pageType" type="hidden" value="<?php echo $action_type[$k]; ?>" />
               
           </div>
  
  
    </div></form>
        <?php } ?>
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
</script>
</div>
<?php if(empty($ajax)) { ?>

</body>
</html>
<?php } ?>