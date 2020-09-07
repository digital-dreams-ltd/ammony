<?php

		$page_title="";$Form=array(); 

		require_once "../select_page.php";
		require_once "../get_param.php"; 
		
		 $coldesc=array();

		extract($_GET,EXTR_OVERWRITE);

		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";



		

				$vcount=0;

				$xparam=explode("|",$c);

				for($i=0;$i<count($xparam);$i++)

				{

					$rparam=$xparam[$i];

					$sparam=explode(",",$rparam);

					$columns[]=$sparam[0];

					$coldesc[]=$sparam[1];

					$required[]=$sparam[2];

					$order[]=$sparam[3];

					if(!empty($sparam[4]))

					{

						$src[]=$sparam[4];

						$source[]=$sparam[4];

					}else $src[]="";

					$vcount++;

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



     <div class="modal modal-fixed-footer" id="_newForm_modal" >

	 <form id="formData"> <div class="modal-content black-text"><h4><?php echo "New ".$page_title; ?></h4><?php foreach($coldesc as $k2=>$v2) {  ?>

	  

         <?php if($order[$k2]=="i") { ?>

		 <div class="input-field col s12 m6">

        <input name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" <?php if($required[$k2]=="r") { ?> required="required" <?php } ?> class="validate nB capitalize" type="text"/><label for="<?php echo $columns[$k2]; ?>" class="active"><?php echo $v2; ?></label></div>

		<?php } else if($order[$k2]=="s") { ?>

		<div class="input-field col s12 m6">

		<select name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" <?php if($required[$k2]=="r") { ?> class="required" <?php } ?>>

       	  <option value="">  </option>

          <?php $data=loadData( $src[$k2]); foreach($data as $k3=> $v3) {  ?>

          <option value="<?php echo $k3 ?> " data-value="<?php echo $v3; ?>" > <?php echo ucwords($v3) ?> </option>

          <?php  } ?>  

		</select><label for="<?php echo $columns[$k2]; ?>"><?php echo $v2; ?></label></div>

		<?php } else if($order[$k2]=="cb") { ?>

		<div class="input-field col s12 m6">

		<input type='text' name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" class="combo <?php if($required[$k2]=="r") echo "required" ?>" data-type="<?php echo $src[$k2]; ?>">

       	  <label for="<?php echo $columns[$k2]; ?>"><?php echo $v2; ?></label></div>

		<?php  } else if($order[$k2]=="l") { ?>

		<div class="input-field col s12">		

		  <input name="<?php echo $columns[$k2]; ?>" type="text" class="capitalize" id="<?php echo $columns[$k2]; ?>"  <?php if($required[$k2]=="r") { ?> required="required" <?php } ?> /><label for="<?php echo $columns[$k2]; ?>" class="active"><?php echo $v2; ?></label></div>

		  <?php } else if($order[$k2]=="c") { ?>

		  <input name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" value="" type="hidden" />

        <?php for($i=0;$i<${$source[$source_count]."_count"};$i++) { ?>

        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $columns[$k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>

        <?php  } } else if($order[$k2]=="h") { ?>

        <input name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" value="<?php echo $value[$value_count] ?>" type="hidden" />

        <?php  } else if($order[$k2]=="n") { ?>

		<div class="input-field col s6">

        <input name="<?php echo $columns[$k2]; ?>" id="<?php echo $columns[$k2]; ?>" <?php if($required[$k2]=="r") { ?> required="required" <?php } ?> class="validate nB" type="number"/><label for="<?php echo $columns[$k2]; ?>"><?php echo $v2; ?></label></div>

        <?php  } else if($order[$k2]=="d") { ?>

		<div class="colc"><div class="right-pad"><span class="sn-col"><?php echo $v2; ?></span></div>

        <input name="<?php echo $columns[$k2]; ?>" id="<?php echo $label[$k2]; ?>" type="text" size="50" <?php if($required[$k2]=="r") { ?> class="required" <?php } ?>/>

        <?php  } else if($order[$k2]=="p") { ?>

		<div class="colc"><div class="right-pad"><span class="sn-col"><?php echo $v2; ?></span></div>

        <a href="javascript:;"><img src="../Pictures/Testpic.jpg" name="<?php echo $columns[$k2]; ?>" width="113" border="0" id="<?php echo $columns[$k2]; ?>" onClick="picture_dialog(this,600,400,'picture_dialog.php')" /></a>

	    <input name="<?php echo $columns[$k2]; ?>" id="" type="text" size="50" <?php if($required[$k2]=="r") { ?> class="required" <?php } ?> style="display:none"/></div>

        <?php  } ?> 

	  <?php  } ?> </div><div class="modal-footer">

      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn" id="formSave">SUBMIT</a><a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>

    </div><input name="<?php echo $idcol ?>" type="text" id="<?php echo $idcol ?>" value="" style="display:none" class="uniqueId" />

            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />

            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			<input name="modal" type="hidden" id="modal" value="1" />
       

   </form></div>

       



<div class="open_diplay_box" id="open_form"  >

   <div class="upload_bar" id="upload_bar">

      <div class="top-control row"> 

        

            

            <div class="input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label><i class="material-icons prefix"><img src="images/icons/search.svg" /></i></div><div id="_filterList" ><?php for($k=0;$k<count($category_column);$k++) { if($category_source[$k]=="period") {?><div class='input-field col s3 right'> <input class="dateFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" /><label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label></div><?php } else $jn[]=$xparam[$k]; }?><?php if(!empty($jn)) {?><div class="input-field col s3 right"><input name="search" type="text"  id='_filter' size="50" class="filter" data-value="<?php echo implode("|",$jn)?>"  /><label for="_filter">Filter By</label></div><?php } ?></div>

       </div>



  </div><div id="dialog_display" class="open_select-div collection with-header" >

  </div>

  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">

    <a class="btn-floating btn-large red" id="#<?php echo $page_title ?>_newForm_modal" class="modal-triger">

      <i class="large material-icons" id="newFloat"><img src="images/icons/add.svg" /></i>

    </a>

    <ul>

      <li><a class="btn-floating blue" id="_multiDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>

    </ul>

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

	formInitialize(pageId,1);

</script>

</div>

<?php if(empty($ajax)) { ?>



</body>

</html>

<?php } ?>