<?php 
$datacol=array();$count=0; $filter_text=""; $prim=array(); $val=array();  $precolumns=array();

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
			if( strtolower(trim($pri))==strtolower(trim($idcol)) &&!empty($sdim[8])){ 	$precolumns[]=$pType;	 };	
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
		$columns=array_merge($precolumns,$columns);
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
				$realCol[]=$dimR[$v] ." as ". $v.'1';
				$coldesc[$v]=$dimD[$v];
				$order[]=$dimO[$v];
		}

		$colstr=implode(",",$realCol);
		if(!empty($filter_text)) $filter_text = " and $filter_text";
		$q="select $idcol,$igroup,$colstr from $t where $dateQuery $filter_text $icondition group by $pri, $sec order by $sort_col $dir";
		$r=$db->query($q) or die($db->error);
		while($row=$r->fetch_assoc())
		{
			  $priVal=$row["$pri"."1"];
			  $secVal=$row["$sec"."1"];
			  $prim[$secVal]=0;
			  
				$val[$priVal][$secVal]=$row["$igroup"];
				foreach($precolumns as $i => $v)
			  {
				  ${$v}[$priVal]=$row["{$v}1"];
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
?><!DOCTYPE html PUBLIC >
<html >
<link href="../css/materialize.css" type="text/css" rel="stylesheet">
<body>
 <div id="report_display"><?php require_once "../report_header.php"; ?>
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
      <tr class="graph-title" id="title-row"><th ></th>
       <th colspan="<?php echo count($prim); ?>" class="center"> 
		<?php echo $coldesc[$sec]; ?> </th><th></th>
      </tr>
	  <tr class="graph-title" id="title-row"><?php foreach($precolumns as $k=> $v) { ?> <th><?php echo $coldesc[$v];?></th><?php } ?><th><?php echo $coldesc[$pri];?></th>
       <?php foreach($prim as $k1=> $v1) { ?> <th> 
		<a href="javascript:;"  ><?php echo $k1; ?></a> </th>
<?php } ?><th>TOTAL</th>
      </tr></thead>
<?php if (!isset($count) || $count==0) { ?>
<tr> <td colspan="<?php echo count($prim) +1 ?>"><div id="Header">
  <div class="no-result" id="top-div">No result found to display</div>
</div></td></tr>
<?php } ?>
<tbody>
	<?php foreach($val as $k => $v){ ?>
     <tr class="graph_row"  >
        
        <?php foreach($precolumns as $pk=> $pv) { ?> <td><?php echo ${$pv}[$k];?></td><?php } ?><td class="gr-sn-col"><?php $source_count=0; $dummy_count=0;$details_count=0; for($j=0;$j<1;$j++) {  if($order[$j]=="a") {?>
 	   <?php   echo $k;  ?><?php } else if($order[$j]=="n") {?>
 	   <?php   echo number_format($k,2,'.',','); ?><?php } else if($order[$j]=="s") { ?>
<?php  echo $func[$source_count]($k); ?>
<?php $source_count++;}  else if($order[$j]=="d") { ?>
<?php  echo $dummy[$dummy_count]; ?>
<?php $dummy_count++;} else if($order[$j]=="i") {?>
 	   <?php   echo $k; ?><?php  $details_count++;}?> <?php  } ?></td><?php foreach($prim as $k1=> $v1) { ?><td><?php if(!empty($v[$k1])){ echo number_format($v[$k1],2,'.',','); $prim[$k1]+=$v[$k1];}else echo '-'; ?></td> <?php } ?><td><?php echo number_format(array_sum($v),2,'.',','); ?></td>
      </tr> 
	  <?php } ?>
	  <tr style="font-weight:bold" ><td colspan="<?php echo count($precolumns)+1; ?>" class="center"> TOTAL </td>
       <?php foreach($prim as $k1=> $v1) { ?><td><?PHP echo number_format($v1,2,'.',','); ?></td><?PHP } ?> <td> <?php echo number_format(array_sum($prim),2,'.',',') ?> </td></tr>
		
      </tbody> 
    </table>
</div>
</div>

</body>
</html>
