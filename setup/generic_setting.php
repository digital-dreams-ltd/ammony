<?php

		$page_title="";$_form=array();

		require_once "../select_page.php"; $coldesc=array();

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

					$col[]=$sparam[0];

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

<div class="upload" id="new_form"  >

<form id="formData">

 <?php foreach($coldesc as $k => $v) { ?><div class="<?php echo $k."desc" ?>"> <?php foreach( $v as $k1 => $v1) { ?><div class="row"><div class="col s12"><div class="card hoverable" style="padding-bottom:40px">

   

     <div class="card-content" > <div class="card-title black-text"><?php echo $k1; ?></div><?php foreach($v1 as $k2=>$v2) {  ?>

	  

         <?php if($order[$k][$k1][$k2]=="i") { ?>

		 <div class="input-field col s12 m6">

        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB capitalize" type="text"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>

		<?php } else if($order[$k][$k1][$k2]=="s") { ?>

		<div class="input-field col s12 m6">

		<select name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>>

       	  <option value=""> <?php echo $label[$k][$k1][$k2] ?> </option>

          <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>

          <option value="<?php echo ${$source[$source_count]."_id"}[$i] ?> " > <?php echo ${$source[$source_count]."_name"}[$i] ?> </option>

          <?php  } $source_count++ ;?>  

		</select><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>

		<?php } else if($order[$k][$k1][$k2]=="cb") { ?>

		<div class="input-field col s12 m6">

		<input type='text' name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" class="combo <?php if($required[$k][$k1][$k2]=="r") echo "required" ?>" data-type="<?php echo $src[$k][$k1][$k2]; ?>">

       	  <label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>

		<?php  } else if($order[$k][$k1][$k2]=="l") { ?>

		<div class="input-field col s12">		

		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" type="text" class="capitalize" id="<?php echo $columns[$k][$k1][$k2]; ?>"  <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> /><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>

		  <?php } else if($order[$k][$k1][$k2]=="c") { ?>

		  <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="" type="hidden" />

        <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>

        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $columns[$k][$k1][$k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>

        <?php  } } else if($order[$k][$k1][$k2]=="h") { ?>

        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" value="<?php echo $value[$value_count] ?>" type="hidden" />

        <?php  } else if($order[$k][$k1][$k2]=="n") { ?>

		<div class="input-field col s6">

        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $columns[$k][$k1][$k2]; ?>" <?php if($required[$k][$k1][$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="number"/><label for="<?php echo $columns[$k][$k1][$k2]; ?>"><?php echo $v2; ?></label></div>

        <?php  } else if($order[$k][$k1][$k2]=="d") { ?>

		<div class="colc"><div class="right-pad"><span class="sn-col"><?php echo $v2; ?></span></div>

        <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="<?php echo $label[$k][$k1][$k2]; ?>" type="text" size="50" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?>/>

        <?php  } else if($order[$k][$k1][$k2]=="p") { ?>

		<div class="colc"><div class="right-pad"><span class="sn-col"><?php echo $v2; ?></span></div>

        <a href="javascript:;"><img src="../Pictures/Testpic.jpg" name="<?php echo $columns[$k][$k1][$k2]; ?>" width="113" border="0" id="<?php echo $columns[$k][$k1][$k2]; ?>" onClick="picture_dialog(this,600,400,'picture_dialog.php')" /></a>

	    <input name="<?php echo $columns[$k][$k1][$k2]; ?>" id="" type="text" size="50" <?php if($required[$k][$k1][$k2]=="r") { ?> class="required" <?php } ?> style="display:none"/></div>

        <?php  } ?> 

	  <?php  } ?></div></div></div></div><?php  } ?></div><?php } ?>

       <input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="" style="display:none" class="uniqueId" />

            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />

            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />

       

   </form>

  <div class="flt">

  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">

    <a data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating btn-large red">

      <i class="large material-icons" id="formSave"><img src="images/icons/save.svg" /></i>

    </a>

    <ul>

	     

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

	formInitialize(pageId);

</script>

</div>

<?php if(empty($ajax)) { ?>



</body>

</html>

<?php } ?>