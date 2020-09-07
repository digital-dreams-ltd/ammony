<?php //die("here");
$datacol=array();$count=0; $filter_text=""; $dir="";$_total=0;
$extra["col"]=array("_debit","_credit","_bal"); $text=array();$prev=array(); $itext='';$iprev='';

if(!empty($form_filter))$filter=$form_filter;
if(!empty($form_condition))$condition=$form_condition;
if(!empty($form_table))$t=$form_table;
if(!empty($form_idcol)) $idcol=$form_idcol;
		$xdim=explode("|",$_form);
		for($i=0;$i<count($xdim);$i++)
		{
			$rdim=str_replace("[","",$xdim[$i]);
			$sdim=superExplode(",",$rdim);
			$dimC[$i]=trim($sdim[0]);
			$pType=trim($sdim[0]);
			$dimR[$pType]=trim($sdim[1]);
			$dimD[$pType]=trim($sdim[2]);
			$dimO[$pType]=trim($sdim[3]);
			$dimB[$pType]=trim($sdim[5]);		
		}	

		if(isset($idatacol)) 
		{
			$datacol=explode("|",$idatacol);
		} 
		if(isset($idatacol_label)) 
		{
			$datacol_label=explode("|",$idatacol_label);
		} 
		if(isset($idatacol_prefix)) 
		{
			$datacol_prefix=explode("|",$idatacol_prefix);
		} 
		if(isset($combine) && isset($filter)) 
		{
			$icombine=$combine;
			$combine=explode("|",$icombine);
		}
		if(!empty($_condition))
		{
			$cnd=explode("|",$_condition);
			 $_combine="and";
			foreach($cnd as $k => $v)
			{
				$tx=explode(",",$v);
				$txr=$tx[0];
				if(empty($tx[1])) continue;
				if($text !="") $text[$txr]=" $_combine "; 
				if(isset($tx[2]) && $tx[2]=="negate")
			   {
				   $text[$txr]=$tx[0]. "<>'". $tx[1]. "'";
			   }else if(isset($tx[2]) && $tx[2]=="null")
			   {
				   $text[$txr]=$tx[0]. " is null ";
			   }else if(isset($tx[2]) && $tx[2]=="not")
			   {
				   $text[$txr]=$tx[0]. " not like '". $tx[1]. "'";
			   } else if(isset($tx[2]) && $tx[2]=="start")
			   {
				   $text[$txr]=$tx[0]. " like '". $tx[1]. "%'";
			   } else if(isset($tx[2]) && $tx[2]=="end")
			   {
				   $text[$txr]=$tx[0]. " like '%". $tx[1]. "'";
			   } else if(isset($tx[2]) && $tx[2]=="contain")
			   {
				   $text[$txr]=$tx[0]. " like '%". $tx[1]. "%'";
			   }else if(isset($tx[2]) && $tx[2]=="greater")
			   {
				   $text[$txr]=$tx[0]. " > '". $tx[1]. "'";
			   }else if(isset($tx[2]) && $tx[2]=="less")
			   {
				   $text[$txr]=$tx[0]. " <'". $tx[1]. "'";
			   }else if(isset($tx[2]) && $tx[2]=="date")
			   {
			   		$txr=$tx[2];
				   $text[$txr]=getDateValue($tx[1],$tx[0]);
				   $prev[$txr]=getDatePrevious($tx[1],$tx[0]);
			   }
			   else {
				 $text[$txr]=$tx[0]. "='". $tx[1]. "'";
				}
			
			}
			$itext=implode ("$_combine",$text);
			$text['date']=$prev['date'];
			$iprev=implode ("$_combine",$text);
		} 
		if(!empty($selectDate)) 
		{
			$dateQuery=getDateQuery($selectDate,$datecol); 
			if(empty($dateQuery)) $dateQuery="$idcol like '%%'";} else  $dateQuery="$idcol like '%%'"	;
		if(trim($_form)=="") 
		{
			
			$msg="No column selected. Please select column to display report";
			die($msg);
			
		}
		$xparam=explode("|",$_form);
		for($i=0;$i<count($xparam);$i++)
		{
			$sparam=superExplode(",",$xparam[$i]);
			$columns[$i]=trim($sparam[0]);
			if(isset($sparam[4]))$stitle[$i]=trim($sparam[4]);
			if(isset($sparam[5]))$cbreak[$i]=trim($sparam[5]);
		}

		if(empty($condition))$icondition=""; else $icondition="and $condition";
		foreach ($columns as $k=>$v)
		{
				$realCol[]=$dimR[$v] ." as ". $v;
				$coldesc[]=$dimD[$v];
				$order[]=$dimO[$v];
		}

		if(isset($filter))
		{
			$filter_text=" and $filter='$reportId'";
		}
		if(!empty($combine))
		{
			foreach ($combine as $k => $v)
			{
					if($dcombine !="") $dcombine .=",";
					$dcombine .="$v";
			}
		}
		$dcf="";
		if(!empty($itext)) $itext =" and $itext";
		if(!empty($iprev)) $iprev =" and $iprev";
		$colstr=implode(",",$realCol);
		$q="select sum($form_action) from $t where $dateQuery $dcf $filter_text $icondition $iprev $_wdn order by $form_sort_col $dir";
		//echo($q);
		$r=$db->query($q) or die($db->error.$q.'is a boy');
		list($obal)=$r->fetch_row();
		$trans='trans_type'; $_total= $obal;
		$q="select $idcol,$trans,$colstr,$form_action from $t where $dateQuery $dcf $filter_text $icondition $itext $_wdn group by $idcol order by $form_sort_col $dir";
		//die($q);
		$r=$db->query($q) or die($db->error.$q.'is a boy');
		while($row=$r->fetch_assoc())
		{
		  
		  
			  $id[$count]=$row["$idcol"];
			   $trans_type[$count]=$row["$trans"];
			  for($i=0;$i<count($columns);$i++)
			  {
				  ${$columns[$i]}[]=$row["{$columns[$i]}"];
			  }
			  if(isset($row["{$form_action}"]))
			  {
				  if($row["{$form_action}"] < 0) ${$extra["col"][0]}[]=abs($row["{$form_action}"]); else ${$extra["col"][0]}[]="";
				  if($row["{$form_action}"] >= 0) ${$extra["col"][1]}[]=$row["{$form_action}"]; else ${$extra["col"][1]}[]="";
				  $_total +=$row["{$form_action}"];
				  ${$extra["col"][2]}[]= $_total;
			  }
			  $count++;
		}
		$coldesc=array_merge($coldesc,$extra["coldesc"]);
		$columns=array_merge($columns,$extra["col"]);
		$order=array_merge($order,array('n','n','n'));
		$cbreak=array_merge($cbreak,array('k','k','k'));
		if(isset($_POST["export_report"]))
		{
			require_once "../export_csv.php";
			die();
		} else if(isset($_POST["email_report"]))
		{
			require_once "mini_report_email.php";
			die();
		}if(isset($_POST["report_pdf"]))
		{
			require_once "mini_report_pdf.php";
			die();
		}
?>
 <div id="report_display_<?php echo str_replace(' ','_',$page_title) ?>"><?php require_once "../report_header.php"; ?>
<div class="graphpanel">
   <?php if(!empty($data) && !empty($graph)) { ?> 
  <div class="graph-div" id="addpanel">
       <div class="graph-left" ><div class="graph-text" id="display-div"></div></div>
     <div class="graph-right">
     </div>
    </div> <?php } ?>
 
</div>
  <div class="clear">
      <table width="100%" cellpadding="0" cellspacing="0" class="striped bordered highlight capitalize">
	  <thead>
	  
	  
      <tr class="graph-title" id="title-row">
        <th> <?php for($j=0;$j<count($coldesc);$j++) { if(!isset($columns[$j]))continue;?>
		<a href="javascript:;" onclick=<?php if(!isset($_GET["saved_report"])) { ?>"runSort('<?php echo $columns[$j]; ?>')" <?php } else { ?> "runSaveSort('<?php echo $columns[$j]; ?>','<?php echo $_GET["saved_report"]; ?>')"<?php } ?>><?php echo $coldesc[$j]; ?></a><?php if(isset($cbreak[$j]) && $cbreak[$j]=="k"  && $j<count($coldesc)-1){ ?></th><th> <?php } ?>
<?php } ?></th>
      </tr></thead>
	  <tbody>
	  <tr>
      	<td colspan="<?php echo count($columns)-1 ?>" align="center">OPENING BALANCE</td><td><?php echo number_format($obal,2,".",",")?></td>
              
      </tr>
<?php if (!isset($count) || $count==0) { ?>
<tr> <td colspan="<?php echo count($coldesc) +1 ?>"><div id="Header">
  <div class="no-result" id="top-div">No result found to display</div>
</div></td></tr>
<?php } else { ?>


	<?php for($i=0;$i<$count;$i++){ ?>
	
     <tr class="hoverable graph_row" id="<?php echo $id[$i] ?>" type="<?php echo $trans_type[$i] ?>">
        
        <td class="gr-sn-col"><?php $source_count=0; $dummy_count=0;$details_count=0; for($j=0;$j<count($coldesc);$j++) { if(!isset($columns[$j]))continue; if($order[$j]=="a") {?>
 	   <a href="javascript:;" ><?php  if( array_search($columns[$j],$datacol) !==false){echo number_format(${$columns[$j]}[$i],2,".",",") ;} else echo ${$columns[$j]}[$i];  ?></a><?php } else if($order[$j]=="n" && !empty(${$columns[$j]}[$i])) {?>
 	   <a href="javascript:;" ><?php   echo number_format(${$columns[$j]}[$i],2,'.',','); ?></a><?php } else if($order[$j]=="s") { ?>
<a href="javascript:;" >  <?php  echo $func[$source_count](${$columns[$j]}[$i]); ?>
</a> <?php $source_count++;}  else if($order[$j]=="d") { ?>
<a href="javascript:;" >  <?php  echo $dummy[$dummy_count]; ?>
</a> <?php $dummy_count++;} else if($order[$j]=="i") {?>
 	   <a href="javascript:;" ><?php   echo ${$columns[$j]}[$i]; ?></a><?php  $details_count++;}?><?php if(isset($cbreak[$j]) && $cbreak[$j]=="k"  && $j<count($coldesc)-1){ ?></td><td class="gr-sn-col"> <?php } ?> <?php  } ?></td>
      </tr> 
	  <?php } ?><?php $rf=array_intersect($columns,$datacol); if (!empty($count) && count($rf) !=0) { ?>
	  <tr class="graph_row"  >
        <td class="gr-sn-coltiny"></td><?php for($j=0;$j<count($columns);$j++) { ?><td class="gr-sn-col" style="font-weight:bold"><a href="javascript:;"><?php if(array_search($columns[$j],$datacol) !==false) echo number_format(array_sum(${$columns[$j]}),2,".",","); else if($j==0)echo "TOTAL"; ?>&nbsp;</a></td> <?php } ?></tr>
		<tr class="graph_row"  >
        <td class="gr-sn-coltiny"></td><?php for($j=0;$j<count($columns);$j++) { ?><td class="gr-sn-col"  style="font-weight:bold"><a href="javascript:;"><?php if(array_search($columns[$j],$datacol) !==false) echo number_format(array_sum(${$columns[$j]})/count(${$columns[$j]}),2,".",","); else if($j==0)echo "AVERAGE"; ?>&nbsp;</a></td> <?php } ?></tr><?php } ?>
		
	
	  <tr>
      	<td colspan="<?php echo count($columns)-1 ?>" align="center">CURRENT BALANCE</td><td class="bold"><h4><?php echo number_format($_total ,2,".",",")?></h4></td>
              
      </tr>
      </tbody>  <?php } ?>
    </table>
</div>
</div>
<script language="javascript" type="text/javascript">
	var pageId='_<?php echo str_replace(' ','_',$page_title) ?>';
	
	<?php if(empty($noTrans)) { ?>
	$('#report_display'+pageId +' tr').click(function()
	{
		var ths=$(this);
		var type=$(ths).attr("type");
		var pnt =getTransType(type);
		if(!pnt) return 0;
		loadModule('task/generic_transaction.php?pageType='+pnt[0]+'&ajax=1',pnt[1],function()
		{
			
			a='_'+pnt[1].replace(' ','_');
			resetForm(a)
			newForm(a);
			loadTransaction(ths,a);
		})
	
	})
<?php } ?>
</script>