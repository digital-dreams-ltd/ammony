<?php
	$category_source=array();$page_title="";$_form=array();$_sign=1;
		require_once "../select_page.php";
		require_once "../get_param.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$page_type=	$pageType;
		foreach($_form as $k1=> $v1)
		{
			$vcount=0;
			$xparam=explode("|",$v1);
			for($i=0;$i<count($xparam);$i++)
			{
				$rparam=$xparam[$i];
				$sparam=explode(",",$rparam);
				$columns[$k1][]=$sparam[0];
				$coldesc[$k1][]=$sparam[1];
				$size[$k1][]=$sparam[2];
				$order[$k1][]=$sparam[3];
				if(!empty($sparam[4]))
				{
					$src[$k1][]=$sparam[4];
					$source[]=$sparam[4];
				}else $src[$k1][]="";
				$vcount++;
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
<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="../css/materialize.css" type="text/css" rel="stylesheet"/>
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<link href="../css/datetimepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/materialize.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/extensions.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/openform.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/opentransaction.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/comboControl.js" ></script>
</head>

<body>
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?>
  <div class="house" id="_<?php echo str_replace(' ','_',$page_title); ?>"><div class="row" id="new_form" style="display:none"> <form id="formData"><input type="text" id="_count" name='count' class='count'  value="1" style="display:none" /><input type="text" id="_journal_no" style="display:none" /><input type="text" name='trans_no' id='_trans_no' value="" style="display:none" class="uniqueId" /><input type="hidden" id="_trans_type" name='trans_type' value="<?php echo $_type ?>" /><input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" /><input id="sparam" type="hidden" value="<?php echo $_form["middle"]; ?>" /><div id="transRight">
		
		<?php $k="top";if(!empty($columns[$k])){ ?>
		<div class="col s12 options_div" >
          <div class="card hoverable red-border" style="overflow:visible" >
		  
            <div class="card-content">
              <div class="row"><?php foreach($columns[$k] as $k1 => $v1 ) {  if(!empty($_COOKIE["ELIMS-Warehouse"]) && $v1=='warehouse'); else{ ?><div class="inpf input-field col <?php echo $size[$k][$k1] ?>"><?php if($order[$k][$k1]=="i") { ?><input type="text" id="_<?php echo $v1 ?>"  name='<?php echo $v1 ?>' /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php } else if($order[$k][$k1]=="d") { ?><input type="text" id="_<?php echo $v1 ?>" class='date' name='<?php echo $v1 ?>' /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="cb") { ?><input type="text" id="_<?php echo $v1 ?>" class='combo' name='<?php echo $v1 ?>' data-type="<?php echo $src[$k][$k1]; ?>" value="<?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) echo getData($param[$pr]['default']);?>" default-value="<?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) echo getData($param[$pr]['default']);?>" /><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="ac") { ?><select id="_<?php echo $v1 ?>"  name='<?php echo $v1 ?>' class="account" <?php $pr=$src[$k][$k1]; if(!empty($param[$pr]['default'])) $df= getData($param[$pr]['default']);?> default="<?php echo $df ?>">
          <?php  $data=loadData( $src[$k][$k1]); foreach($data as $k3=> $v3) { ?>
          <option value="<?php echo $v3 ?>" <?php if($v3==$df) echo 'selected'; ?> > <?php echo $v3 ?> </option>
          <?php  } ?>  </select><label for="_<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php }else if($order[$k][$k1]=="pr") { ?><input id="<?php echo $v1 ?>"  name='<?php echo $v1 ?>' type="checkbox" class="prepayment" value="1" />
          <label for="<?php echo $v1 ?>" class="active"><?php echo $coldesc[$k][$k1] ?></label><?php } ?></div><?php } }?></div></div></div></div>
			<?php }  ?>  
			  <div >
		<?php $k="middle"; if(!empty($columns[$k])) { ?>
		<div class="col s12">
          <div class="card hoverable blue-ground">
		  <div class="cldv">
		  <div><div  id="_itemlist_div1" class="table" style="display:block"><div class="row teal-text lighten-1  desc crv"><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="col <?php echo $size[$k][$k1] ?>"><?php echo $coldesc[$k][$k1]?></div><?php } ?></div>
            <div class="row l-row "><input type="text" name="tid1" id="tid1" style="display:none" /><?php foreach($columns[$k] as $k1 => $v1 ) { ?><div class="input-field no-padding col <?php echo $size[$k][$k1] ?>" style="margin-top:0px !important"><input type="text" name="<?php echo $columns[$k][$k1]."1"?>" id="<?php echo $columns[$k][$k1]."1"?>" class="<?php echo $columns[$k][$k1]?> capitalize" data-class="<?php echo $columns[$k][$k1]?>" placeholder="<?php echo $coldesc[$k][$k1]?>" style="margin-bottom:0px !important" data-count='1'/><label for="<?php echo $columns[$k][$k1]."1"?>"></label></div><?php } ?></div>
              </div></div>
            <div class="card-action row ">
			<div class="input-field col s6 m8" style="min-height:1px"><input type="text"  readonly="true" autocomplete="off" id="total" /><label for="total" class="hide-on-small-only active" >OUT OF BALANCE</label></div>
			<div class="input-field col s2"><input type="text"  readonly="true" autocomplete="off" id="debitTotal" /><label for="debitTotal" class="hide-on-small-only active" >TOTAL DEBIT</label></div><div class="input-field col s2"><input type="text" readonly="true" autocomplete="off" id="creditTotal" /><label for="debitTotal" class="hide-on-small-only active" >TOTAL CREDIT</label></div>
              
              
            </div><div class="card-action right-align"><a href="#" class="waves-effect waves-light btn white-text sendEntry" data-id='1'><i class="medium material-icons"><img src="images/icons/add.svg" /></i> Add Row</a>
             
            </div>
          </div>
        </div>
		</div>
		<?php } ?>
		</div></div></form>
		<div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Print" class="tooltipped btn-floating btn-large red" id="formPrint">
      <i class="large material-icons" ><img src="images/icons/print.svg" /></i>
    </a>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"><i class="material-icons"><img src="images/icons/reply.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Delete" class="tooltipped btn-floating red" id="_singleDelete"><i class="material-icons"><img src="images/icons/delete.svg" /></i></a></li>
      <li><a data-position="left" data-delay="50" data-tooltip="Reset Form" class="tooltipped btn-floating green" id="formReset"><i class="material-icons"><img src="images/icons/replay.svg" /></i></a></li><li><a data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating pink" id="formSave"><i class="material-icons"><img src="images/icons/save.svg" /></i></a></li>
 
    </ul>
  </div>
</div></div>
<div class="open_diplay_box" id="open_form"  >
   <div class="upload_bar" id="upload_bar">
      <div class="top-control row"> 
        
            
            <div class="input-field col s<?php echo 12 - (count($category_column) * 2); ?>"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $page_title ?></label></div><div id="_filterList" ><?php for($k=0;$k<count($category_column);$k++) { ?><div class='input-field col s2'><select name="<?php echo $category_column[$k] ?>" id="" class="filterList"><option ></option><?php  $data=loadData( $category_source[$k]); foreach($data as $k3=> $v3) { ?>
            <option value="<?php echo  $k3 ?>" <?php if(strtolower($v3)==strtolower($category_default[$k])) echo "selected" ?>> <?php echo $v3; ?> </option>
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
 </div>
      </div>

	  
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
	
	formInitialize(pageId);
	transInitialize(pageId);
</script>
<?php if(empty($ajax)) { ?>
</html>
<?php } ?>