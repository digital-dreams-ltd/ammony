<?php 
$datacol=array();$count=0; $filter_text="";

		$xdim=explode("|",$_form);
		for($i=0;$i<count($xdim);$i++)
		{
			$rdim=str_replace("[","",$xdim[$i]);
			$sdim=superExplode(",",$rdim);
			$dimC[$i]=trim($sdim[0]);
			$pType=trim($sdim[0]);
			$dimR[$pType]=trim($sdim[1]);
			$dimD[$pType]=trim($sdim[2]);
			$dimO[$pType]=trim($sdim[4]);
			$dimB[$pType]=trim($sdim[6]);		
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
		if(!empty($filter))
		{
			$ifilter=$filter;
			$filter=explode("|",$filter);
		} 
		if(isset($combine) && isset($filter)) 
		{
			$icombine=$combine;
			$combine=explode("|",$icombine);
		} 
		if(!empty($selectDate)) 
		{
			$dateQuery=getDateQuery($selectDate,$datecol); 
			if(empty($dateQuery)) $dateQuery="$idcol like '%%'";
		} else  $dateQuery="$idcol like '%%'"	;	
		if(trim($paramSet)=="") 
		{
			
			$msg="No column selected. Please select column to display report";
			$msg=urlencode($msg);
			header("Location:../report_view.php?msg=$msg");
			die();
		}
		$xparam=explode("|",$paramSet);
		for($i=0;$i<count($xparam);$i++)
		{
			$sparam=superExplode(",",$xparam[$i]);
			$columns[$i]=trim($sparam[0]);
			if(isset($sparam[1]))$stitle[$i]=trim($sparam[1]);
			if(isset($sparam[2]))$cbreak[$i]=trim($sparam[2]);
		}
		$xfparam=explode("|",$filter_param);
		for($i=0;$i<count($xfparam);$i++)
		{
			$rparam=$xfparam[$i];
			
			$sparam=explode(",",$rparam);
			if($ifilter !="") $ifilter .=",";
			$ifilter .=trim($sparam[0]);
			if($filter_text !="" and $sparam[1] !=0) $filter_text .=" and ";
			$filter_text .=get_parameter_operation($sparam[0], trim($sparam[1]), $sparam[2], $sparam[3]);

		}
		if(empty($condition))$icondition=""; else $icondition="and $condition";
		foreach ($columns as $k=>$v)
		{
				$realCol[]=$dimR[$v] ." as ". $v."1";
				$coldesc[]=$dimD[$v];
				$order[]=$dimO[$v];
		}

		$colstr=implode(",",$realCol);
		if(!empty($noTrans) ) $trans=$idcol;else $trans='trans_type';
		if(!empty($filter_text)) $filter_text = " and $filter_text";
		$q="select $idcol,$trans,$colstr from $t where $dateQuery  $filter_text $icondition group by $idcol order by $sort_col $dir";
		//print_r($_GET);
		//die($q);
		$r=$db->query($q) or die($db->error.$q.'is a boy');
		while($row=$r->fetch_assoc())
		{
		  
		  
			  $id[$count]=$row["$idcol"];
			   $trans_type[$count]=$row["$trans"];
			  foreach($columns as $i => $v)
			  {
				  ${$columns[$i]}[]=$row["{$v}1"];
			  }
			  $count++;
		}
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
        <th> <?php for($j=0;$j<count($coldesc);$j++) { if(!isset($columns[$j]) )continue;?>
		<?php if($stitle[$j]=='s') { ?>
		<a href="javascript:;" onclick=<?php if(!isset($_GET["saved_report"])) { ?>"runSort('<?php echo $columns[$j]; ?>')" <?php } else { ?> "runSaveSort('<?php echo $columns[$j]; ?>','<?php echo $_GET["saved_report"]; ?>')"<?php } ?>><?php echo $coldesc[$j]; ?></a><?php } if(isset($cbreak[$j]) && $cbreak[$j]=="k"  && $j<count($coldesc)-1){ ?></th><th> <?php } ?>
<?php } ?></th>
      </tr></thead>
<?php if (!isset($count) || $count==0) { ?>
<tr> <td colspan="<?php echo count($coldesc) +1 ?>"><div id="Header">
  <div class="no-result" id="top-div">No result found to display</div>
</div></td></tr>
<?php } ?>
<tbody>
	<?php for($i=0;$i<$count;$i++){ ?>
     <tr class="hoverable graph_row" id="<?php echo $id[$i] ?>" type="<?php echo $trans_type[$i] ?>" >
        
        <td class="gr-sn-col"><?php $source_count=0; $dummy_count=0;$details_count=0; for($j=0;$j<count($coldesc);$j++) {  if($order[$j]=="a") {?>
 	   <?php  if( array_search($columns[$j],$datacol) !==false){echo number_format(${$columns[$j]}[$i],2,".",",") ;} else echo ${$columns[$j]}[$i];  ?><?php } else if($order[$j]=="n") {?>
 	   <?php   echo number_format(${$columns[$j]}[$i],2,'.',','); ?><?php } else if($order[$j]=="s") { ?>
  <?php  echo $func[$source_count](${$columns[$j]}[$i]); ?>
 <?php $source_count++;}  else if($order[$j]=="d") { ?>
  <?php  echo $dummy[$dummy_count]; ?>
 <?php $dummy_count++;} else if($order[$j]=="i") {?>
 	  <?php   echo ${$columns[$j]}[$i]; ?><?php  $details_count++;}?><?php if(isset($cbreak[$j]) && $cbreak[$j]=="k"  && $j<count($coldesc)-1){ ?></td><td class="gr-sn-col"> <?php } ?> <?php  } ?></td>
      </tr> 
	  <?php } ?><?php $rf=array_intersect($columns,$datacol); if (!empty($count) && count($rf) !=0) { ?>
	  <tr class="graph_row"  >
       </td><td class="gr-sn-col" style="font-weight:bold"><?php for($j=0;$j<count($columns);$j++) { ?><a href="javascript:;"><?php if(array_search($columns[$j],$datacol) !==false) echo number_format(array_sum(${$columns[$j]}),2,".",","); else if($j==0)echo "TOTAL"; ?>&nbsp;</a><?php if(isset($cbreak[$j]) && $cbreak[$j]=="k"  && $j<count($coldesc)-1){ ?></td><td class="gr-sn-col" style="font-weight:bold"> <?php } ?> <?php  } ?></td></tr>
		<?php } ?>
      </tbody> 
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