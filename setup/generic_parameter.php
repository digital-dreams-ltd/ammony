<?php
		$page_title="";$_form=array();$_actions=array();$action_columns=array();$coldesc=array(); $category_source=array();
		require_once "../select_page.php"; 
		require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";

		$cln[]=$idcol;
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
					$cln[]=$sparam[0];
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
		$table=	$t;
		if(!empty($fixed))
		{
			
				$fsieve[]=$fixed;
			
		}
		$fstr=implode(" and ", $fsieve);
		$dbcol=implode(',',$cln);
		
		$query="select $dbcol from $table where $fstr limit 1";
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc());
		
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
<div class="upload" id="new_form" >
<form id="formData">
 <?php foreach($coldesc as $k => $v) { ?><div class="<?php echo $k."desc" ?>"> <?php foreach( $v as $k1 => $v1) { ?><div class="row"><div class="col s12 "><div class="row card hoverable" style="padding-bottom:40px;overflow:visible;">
   
     <div class="card-content" > <div class="card-title black-text"><?php echo $k1; ?></div><?php foreach($v1 as $k2=>$v2) {  ?>
	  
         <?php if($order[$k][$k1][$k2]=="i") { ?>
		 <div class="input-field col s12 m6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB capitalize" type="text" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="s") { ?>
		<div class="input-field col s12 m6">
		<select name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?> " > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="sl") { ?>
		<div class="input-field col s12">
		<select name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?>" > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($order[$k][$k1][$k2]=="cb") { ?>
		<div class="input-field col s12 m6">
		<input type='text' name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" class="combo <?php if($required[$k][$k1][$k2]=="r") echo "required" ?>" data-type="<?php echo $src[$k][$k1][$k2]; ?>" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>>
       	  <label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php  } else if($order[$k][$k1][$k2]=="l") {?>
		<div class="input-field col s12">		
		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" type="text" class="capitalize" id="<?php echo $columns[$k][$k1][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?> /><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>" class="active" ><?php echo $v2; ?></label></div>
		  <?php } else if($order[$k][$k1][$k2]=="c") { ?>
		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="" type="hidden" />
        <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>
        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $columns[$k][$k1][$k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>
        <?php  } } else if($order[$k][$k1][$k2]=="h") { ?>
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="<?php echo $value[$value_count] ?>" type="hidden" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/>
        <?php  } else if($order[$k][$k1][$k2]=="n") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="number" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/ ><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($order[$k][$k1][$k2]=="pw") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($order[$k][$k1][$k2]=="pl") { ?>
		<div class="input-field col s12">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  } else if($order[$k][$k1][$k2]=="d") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="date validate nB" type="text" <?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"' ?>/><label class="active" for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php   } else if($order[$k][$k1][$k2]=="rl") { $pages=json_decode(get_page_module(),true);?>
		<div class="input-field col s12 role"><input type="hidden" name='<?php echo $columns[$k][$k1][$k2]; ?>' />
        <ul class="collection">
  <?php foreach($pages as $k => $v ) { $vp=json_decode($v['props'],true);?>
    <li>
      <div class="collection-header "><input id='<?php echo str_replace(':','_',$vp['id']) ?>' value='<?php echo $vp['id'] ?>' type="checkbox"><label class="active" for='<?php echo $vp['id'] ?>' class="collection-header"><?php echo $k ?></label></div>
      <div class="collection-item"><p class="collection"><?php foreach($v['subs'] as $k1=> $v1){ $sp=json_decode($v1,true); ?><div class="collection-item"><input type="checkbox" id="<?php echo $vp['id'].'_'.$sp['id'] ?>" value="<?php echo $vp['id'].':'.$sp['id'] ?>"><label class="active" for="<?php echo $vp['id'].'_'.$sp['id'] ?>"  ><?php echo $sp['name']; ?></label></div><?php } ?></p></div>
    </li> <?php } ?>
   
  </ul></div>
        <?php  } else if($order[$k][$k1][$k2]=="p") { ?>
		<div class="input-field col 12">
		<a href="javascript:;"  id="uploadPic" data-href="upload.php" data-dir="assets/pictures/" ><img src="<?php if(!empty($row[$columns[$k][$k1][$k2]])) echo 'value="'.$row[$columns[$k][$k1][$k2]].'"'; else echo 'images/default.png'; ?>" style="width: 100%;" class='form_pic'><div class="white black-text center-align valign-wrapper" style="position: absolute; right: 0px; top: 0px; opacity: 0.8; margin-top: 20px;"><i class="material-icons black-text medium valign">photo_camera</i><span class="valign"> Click to change picture </span></div></a>
        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="hide validate nB" type="text"/></div>
        <?php  } ?> 
	  <?php  } ?></div></div></div></div><?php  } ?></div><?php } ?>
       <input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="<?php if(!empty($row[$idcol])) echo $row[$idcol]; ?>" style="display:none" class="uniqueId" />
            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			<input name="noreset" type="hidden" id="noreset" value="1" />
       
   </form>
  <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons" id="formSave"><img src="images/icons/save.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Reset" class="tooltipped btn-floating green" id="formReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>

 
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
	formInitialize(pageId,2);
</script>
</div>
<?php if(empty($ajax)) { ?>

</body>
</html>
<?php } ?>