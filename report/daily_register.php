<?php
require_once '../Database_Connect.php';
		
		$rs=array(); $sum=array();
		if(isset($_ixt) && isset($report_name[$_ixt])) $com_title=$report_name[$_ixt]; else $com_title=""; $ct=0;
		
		$tables=array("INV"=>"Sales Invoice","RCP"=>"Reciept","PCH"=>"Purchase","PYT"=>"Payment");
		$rowcount=count($tables);
		$tb="transactions";
		$cols="ref,customer,description,quantity,rate,amount";
		$acol=7;
		$detail_title=array("Reference","Customer Name","Description","Quantity","Price","Amount");
		 if(isset($_COOKIE["_today"])) $cdate =$_COOKIE["_today"]; else $cdate= date("Y-m-d"); 
		$query="select trans_no,trans_type, $cols from $tb as t1 where date='$cdate'  and sub=0 $_wd ";
		$r=$db->query($query) or die($db->error.$query); 
		while($rw=$r->fetch_row())
		{
			
			$type=$rw[1];
			
			$rs[$type][]=$rw;
			if(isset($sum[$type])) $sum[$type] +=$rw[$acol] ; else $sum[$type]=$rw[$acol];
		}
			
		
?><div id="daily_register"  class='col s12' ><div class="gr-header"><span ><?php echo $com_title ?></span></div>
<h5 class="grey-text col s12">Daily Register </h5>
<div  class="row">
<?php foreach($sum as $k => $v){  $var=str_replace(' ','',$v[0]); ?><div class="col s3"> <div class="card <?php echo $_color[$ct];?>">
        <div class="card-content white-text">
          <div class="dataSpan">N<?php echo number_format($v,2,'.',',');?></div>
          <span class="dataLabel"><?php echo $tables[$k];?></span>
		  
        </div>
        
      </div></div> <?php $ct++;} ?></div>
<?php foreach($tables as $k=> $v){  if(!isset($rs[$k])) continue; ?> <div class="card"><div class="card-title black-text col s12"><?php  echo $v; ?></div>
<table ><thead><tr ><th >&nbsp;</th><?php foreach($detail_title as $j => $v1){ ?> <th  ><?php echo $v1; ?>
  <?php } ?></th>  </tr></thead>
<?php foreach($rs[$k] as $k2=> $v2){ ?>
<tr id="<?php echo $v2[0] ?>" type="<?php echo $v2[1] ?>" class="hoverable"><td ></td><?php for($j=2;$j<count($v2);$j++){ ?> <td ><?php echo $v2[$j] ?></td>
   <?php }  ?></tr><?php } ?><tr ><td class="right-align bold" colspan="<?php echo count($detail_title);?>">TOTAL</td> <td ><h5>N<?php echo number_format($sum[$k],2,'.',',')?></h5></td> </tr></table></div> <?php }?>
   
</div> 
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Print Report" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="registerPrint"><img src="images/icons/print.svg" /></i>
    </a>
    
  </div>
<script language="javascript" type="text/javascript">
	$('#registerPrint').click(function()
	{
	    	$('#daily_register').divPrint();
	})
	$('#daily_register tr').click(function()
	{
		var ths=$(this);
		var type=$(ths).attr("type");
		var pnt =getTransType(type);
		if(!pnt) return 0;
		loadModule('task/generic_transaction.php?pageType='+pnt[0]+'&ajax=1',pnt[1],function()
		{
			
			a='_'+pnt[1].replace(' ','_');
			newForm(a);
			loadTransaction(ths,a);
		})
	
	})

</script>