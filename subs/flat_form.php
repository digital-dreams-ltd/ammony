<?php  
			require "select_subpage.php";
			require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 

		extract($_GET,EXTR_OVERWRITE);

		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$sub_order="";$sub_required="";$Label=""; $sub_columns=array();$sub_coldesc=array(); $sub_required=array();$sub_order=array(); 



				$vcount=0;
				
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
							$sub_columns[$k1][]=$sparam[0];
							$sub_coldesc[$k1][]=$sparam[1];
							$sub_required[$k1][]=$sparam[2];
							$sub_order[$k1][]=$sparam[3];
							if(!empty($sparam[4]))
							{
								$sub_src[$k1][]=$sparam[4];
								$source[]=$sparam[4];
							}else $sub_src[$k1][]="";
							$vcount++;
						}
					}
					
				}

?>
<div>
<div class="top-control row"> 
        
            
            <div class="input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $sub_title ?></label></div><div class="col s2"><a href="javascript" class="btn ">Actions</a></div></div>
<div class="collection row" id="<?php echo str_replace(' ','',$subType); ?>_DP" ><div class="center" style="margin-top:100px;margin-bottom:100px"><img src="images/loading.gif" /></div></div>

</div>
<div class="" id="_newForm_modal_<?php echo $subType; ?>" >

	 <form id="formData_<?php echo $subType; ?>"> <div class="modal-content black-text"><?php foreach($sub_coldesc as $k => $v) { ?> <div class="row"><div class="col s12 "><div class="row" style="padding-bottom:20px;overflow:visible;">
   
     <div class="card-content" ><?php foreach($v as $k2=>$v2) {  ?>
	  
         <?php if($sub_order[$k][$k2]=="i") { ?>
		 <div class="input-field col s12 m6">
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB capitalize" type="text"/><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($sub_order[$k][$k2]=="s") { ?>
		<div class="input-field col s12 m6">
		<select name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?> " > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($sub_order[$k][$k2]=="sl") { ?>
		<div class="input-field col s12">
		<select name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>
       	  <option value=""> Select <?php echo $v2 ?> </option>
          <?php $data=loadData($src[$k][$k1][$k2]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $k3 ?>" > <?php echo $v3 ?> </option>
          <?php  } ?>  
		</select><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php } else if($sub_order[$k][$k2]=="cb") { ?>
		<div class="input-field col s12 m6">
		<input type='text' name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" class="combo <?php if($required[$k][$k1][$k2]=="r") echo "required" ?>" data-type="<?php echo $src[$k][$k1][$k2]; ?>">
       	  <label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		<?php  } else if($sub_order[$k][$k2]=="l") { ?>
		<div class="input-field col s12">		
		  <input name="<?php echo $sub_columns[$k][$k2]; ?>" type="text" class="capitalize" id="<?php echo $sub_columns[$k][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> /><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($sub_order[$k][$k2]=="t") { ?>
		<div class="input-field col s12">		
		  <textarea name="<?php echo $sub_columns[$k][$k2]; ?>" class="capitalize materialize-textarea" id="<?php echo $sub_columns[$k][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> /></textarea><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($sub_order[$k][$k2]=="c") { ?>
		  <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" value="" type="hidden" />
        <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>
        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $sub_columns[$k][$k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>
        <?php  } } else if($sub_order[$k][$k2]=="h") { ?>
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" value="<?php echo $value[$value_count] ?>" type="hidden" />
        <?php  } else if($sub_order[$k][$k2]=="n") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="number"/><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($sub_order[$k][$k2]=="pw") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password"/><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  }  else if($sub_order[$k][$k2]=="pl") { ?>
		<div class="input-field col s12">
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="password"/><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php  } else if($sub_order[$k][$k2]=="d") { ?>
		<div class="input-field col s6">
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="date validate nB" type="text"/><label for="<?php echo $sub_columns[$k][$k2]; ?>"><?php echo $v2; ?></label></div>
        <?php   } else if($sub_order[$k][$k2]=="rl") { $pages=json_decode(get_page_module(),true);?>
		<div class="input-field col s12 role"><input type="hidden" name='<?php echo $sub_columns[$k][$k2]; ?>' />
        <ul class="collection">
  <?php foreach($pages as $k => $v ) { $vp=json_decode($v['props'],true);?>
    <li>
      <div class="collection-header "><input id='<?php echo str_replace(':','_',$vp['id']) ?>' value='<?php echo $vp['id'] ?>' type="checkbox"><label for='<?php echo $vp['id'] ?>' class="collection-header"><?php echo $k ?></label></div>
      <div class="collection-item"><p class="collection"><?php foreach($v['subs'] as $k1=> $v1){ $sp=json_decode($v1,true); ?><div class="collection-item"><input type="checkbox" id="<?php echo $vp['id'].'_'.$sp['id'] ?>" value="<?php echo $vp['id'].':'.$sp['id'] ?>"><label for="<?php echo $vp['id'].'_'.$sp['id'] ?>"  ><?php echo $sp['name']; ?></label></div><?php } ?></p></div>
    </li> <?php } ?>
   
  </ul></div>
        <?php  } else if($sub_order[$k][$k2]=="p") { ?>
		<div class="input-field col 12">
		<a href="javascript:;"  id="uploadPic" data-href="upload.php" data-dir="assets/pictures/" ><img src="images/default.png" style="width: 100%;" class='form_pic'><div class="white black-text center-align valign-wrapper" style="position: absolute; right: 0px; top: 0px; opacity: 0.8; margin-top: 20px;"><i class="material-icons black-text medium valign">photo_camera</i><span class="valign"> Click to change picture </span></div></a>
        <input name="<?php echo $sub_columns[$k][$k2]; ?>" id="<?php echo $sub_columns[$k][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="hide validate nB" type="text"/></div>
        <?php  } ?> 
	  <?php  } ?></div></div></div></div><?php  } ?></div><div class="modal-footer">

      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn subformSave" data-action="#formData_<?php echo $subType; ?>_<?php echo str_replace(' ','_',$page_title); ?>" ><?php echo "New ".$sub_title; ?></a>

    </div><input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="" style="display:none" class="uniqueId" />
			<input name="pageType" type="hidden" value="<?php echo $subType; ?>" />
 
   </form></div>
