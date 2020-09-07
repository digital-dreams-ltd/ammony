<?php
		$page_title="";$Form=array();$group="";
		require_once "../Database_Connect.php";
		require_once "../select_page.php";
		require_once "../get_page_func.php"; 
		require_once "../get_filter_parameter.php";		   
		$coldesc=array();
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col=array();$realCol=array();$colD=array();$order=array();$required="";$Label=""; $data=array() ;$label=array(); $item=array();

		if(!empty($group_others)){ $g_dimension=$group_others;  }else $g_dimension='';
		

		$ifilter="";
		if(!empty($group_filter))
		{
			$gxfilter=explode("|",$group_filter);
			for($i=0;$i<count($gxfilter);$i++)
			{
				
				$sflt=explode(",",$gxfilter[$i]);
				
				$filter [$i]=trim($sflt[0]);
				$dsfilter[$i] =trim($sflt[1]);
				$sfilter[$i] =trim($sflt[2]);
				$cfilter[$i] =trim($sflt[3]);
			}
		}
		
		$grp=explode(",",$group);
		if(!empty($dimension))
		{
			$xdim=explode("|",$dimension);
			for($i=0;$i<count($xdim);$i++)
			{
				$rdim=str_replace("[","",$xdim[$i]);
				$sdim=superExplode(",",$rdim);
				$dimC[$i]=trim($sdim[0]);
				$dimD[$i]=trim($sdim[2]);
				$dimV[$i]=trim($sdim[3]);
				$dimO[$i]=trim($sdim[4]);
				if(isset($sdim[5]))$stitle[$i]=trim($sdim[5]);
				if(isset($sdim[6]))$cbreak[$i]=trim($sdim[6]);
				if(!empty($sdim[7]))
				{ 
					$group_dimension[]=$sdim[0];
					$group_dimension_label[]=$sdim[2];
				
				}
			}
		}
		

		if(!empty($graphCol))
		{
			$grpCol=explode("|",$graphCol);
			foreach($grpCol as $k => $v)
			{
				$v1=explode(',',$v);
				$datacol[]=$v1[0];
				$datacol_label[]=$v1[1];
				$datacol_prefix[]=$v1[2];
			}
		}
		$cdate =!isset($_COOKIE["_today"]) ? $cdate= date("Y-m-d") : $_COOKIE["_today"]; 

		$topField=array(0=>array('INV','blue darken-1'),1=>array('RCP','red darken-1'),2=>array('PYT','green darken-1'),3=>array('PCH','yellow darken-3'));
		foreach($topField as $k => $v)
		{
			$var=str_replace(' ','',$v[0]);
			$date_filter=getDateValue('This Month',$datecol);
			$colstr=implode(",",$realCol);
			if(!empty($date_filter)) $date_filter = " and $date_filter";
			$q="select sum({$datacol[0]}) from $t where $condition $date_filter and trans_type='{$v[0]}' and $datecol <= '$cdate' $_wdn";
			$r=$db->query($q) or die($db->error.$q);
			if($row=$r->fetch_row())
			{
			  		
					 ${$var}=$row[0];
			}else ${$var}=0;
		}
		$q="select $datecol,sum({$datacol[0]}) from transactions where $condition and $datecol >='$cdate' - INTERVAL 30 DAY and $datecol < '$cdate' $_wdn group by date";
		
		$result = $db->query($q) or die($db->error.$q);
		while($row = $result->fetch_row()) 
		{
			$label[]=$row[0];
			$data[]=$row[1];
		}
		
		$q="SELECT customername,current_balance FROM customer  where current_balance > 0 and type=1 $_wd ORDER BY current_balance DESC LIMIT 5";
		$result = $db->query($q) or die($db->error.$q);
		while($row = $result->fetch_row()) 
		{
			$customer_name[]=$row[0];
			$balance[]=$row[1];
		}
		$q="SELECT description,quantity_on_hand FROM item  where quantity_on_hand > 0 $_wd ORDER BY quantity_on_hand ASC LIMIT 5";
		$result = $db->query($q) or die($db->error.$q);
		while($row = $result->fetch_row()) 
		{
			$item_name[]=$row[0];
			$quantity[]=$row[1];
		}
		
		$q="SELECT {$grp[0]},SUM({$datacol[0]}) AS sm FROM transactions WHERE $condition and $datecol >='$cdate' - INTERVAL 30 DAY and $datecol < '$cdate' $_wdn  GROUP BY {$grp[0]} ORDER BY sm DESC LIMIT 5";
		$result = $db->query($q) or die($db->error.$q);
		while($row = $result->fetch_row()) 
		{
			$item[]=$row[0];
			$sum[]=$row[1];
		}
		$q="SELECT account_id, account_name FROM account_chart WHERE account_type=0 ORDER BY account_id DESC ";
		$result = $db->query($q) or die($db->error.$q);
		while($row = $result->fetch_row()) 
		{
			$account=$row[0];
			$account_name[]=$row[1];
			$q="SELECT SUM(gl_amount) AS sm FROM transactions WHERE account='$account' and $datecol < '$cdate' $_wdn";
			$result2 = $db->query($q) or die($db->error.$q);
			while($row2 = $result2->fetch_row()) 
			{
				$account_sum[]=$row2[0];
			}
		}
		$top_title=array("0-30","31-60","61-90","Over 90 days");
		$ctk=array();$tpk=array();
		$date_period=array("$datecol>='$cdate' - INTERVAL 30 DAY and $datecol<='$cdate'","$datecol<'$cdate' - INTERVAL 30 DAY and $datecol>='$cdate' - INTERVAL 60 DAY","$datecol<'$cdate' - INTERVAL 60 DAY and $datecol>='$cdate' - INTERVAL 90 DAY","$datecol<'$cdate' - INTERVAL 90 DAY");
			foreach($date_period as $k => $v)
			{
				
				
				$query="select sum(net_due) from transactions where  $v and net_due >0  and trans_type='INV' $_wdn";
				$r=$db->query($query) or die($db->error.$query); 
				if($rw=$r->fetch_row())
				{
						if(!empty($rw[0]))
						{
							$ctk[$k]=$rw[0];
							$tpk[$k]=$top_title[$k];
						}
				}
				
			}
			
			$query="select sum(amount_paid),sum(net_due) from transactions where trans_type='INV' and sub=0 $_wdn ";
			$r=$db->query($query) or die($db->error.$query); 
			if($rw=$r->fetch_row())
			{
					
				$paid_amount=array($rw[0],$rw[1]);
				$paid_label=array('Amount Paid','Amount Owed');
			}
?>
<div  id="_<?php echo str_replace(' ','_',$page_title) ?>" >
<div class="open_diplay_box" id="open_form"  >
   <div><div ><div class="grey-text" style="padding: 0.75rem 0.75rem;">This Month <a href="javascript:;" class="right" id="daily_register"><?php echo $cdate ?><i class="material-icons"><img src="images/icons/chevron_right.svg" /></i>View Today's Register</a></div></div><div  class="row"><div class="col s4 "> <div class="card purple">
        <div class="card-content white-text"><div class="boldData">N<?php $v1=$topField[1][0]; $v2=$topField[2][0]; $sm=${$v1}-${$v2};echo number_format($sm,2,'.',',') ?></div><div class="dataLabel">NET INCOME</div></div></div></div><?php foreach($topField as $k => $v){ $var=str_replace(' ','',$v[0]); ?><div class="col s2"> <div class="card <?php echo $v[1];?>">
        <div class="card-content white-text">
          <div class="dataSpan"><?php echo $datacol_prefix[0];?><?php echo number_format(${$var},2,'.',',');?></div>
          <span class="dataLabel"><?php echo $v[0];?></span>
		  
        </div>
        
      </div></div> <?php } ?></div><div class="row"><div class="col s12 m5"><div class="card">
            <div class="card-content">
              <span class="black-text">Sales Last 30 Days</span>
              <div id="sales" style="height:300px;width:100%"><canvas id="myChart" width="400" ></canvas></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div><div class="col s12 m3"><div class="card">
            <div class="card-content">
              <span class="black-text">Paid Invoice</span>
              <div id="register" style="height:140px;width:100%"><canvas id="myChart2" width="400" ></div>
			  
            </div>
            
          </div><div class="card">
            <div class="card-content">
              <span class="black-text">Aged Receivables</span>
			  <div id="register" style="height:150px;width:100%"><canvas id="myChart3" ></div>
            </div>
            
          </div>
  </div><div class="col s12 m4"><div class="card" style="overflow-y:scroll">
            <div class="card-content">
              <span class="black-text">Cash Account Balances</span>
              <div id="register" style="height:300px;width:100%"><ul class="collection no-collection">
			  <?php foreach($account_name as $k => $v) { ?>
    <li class="collection-item avatar">
      <div class="circle white grey-text center-align valign-wrapper" ><span ><?php echo $k+1 ?></span></div>
      <span class="title capitalize"><?php echo $v ?></span>
      <a href="#!" class="secondary-content" style="top:30px"><?php echo $datacol_prefix[0];?><?php echo number_format($account_sum[$k],2,'.',','); ?></a>
    </li> <?php } ?>
  </ul></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div></div><div class="row"><div class="col s12 m4"><div class="card">
            <div class="card-content">
              <span class="black-text">Item with low quantity</span>
               <div id="register" style="height:300px;width:100%"><ul class="collection no-collection">
			  <?php foreach($item_name as $k => $v) { ?>
    <li class="collection-item avatar">
      <div class="circle white grey-text center-align valign-wrapper" ><span ><?php echo $k+1 ?></span></div>
      <span class="title capitalize"><?php echo $v ?></span>
      <a href="#!" class="secondary-content" style="top:30px"><?php echo number_format($quantity[$k],2,'.',','); ?></a>
    </li> <?php } ?>
  </ul></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div><div class="col s12 m4"><div class="card">
            <div class="card-content">
              <span class="black-text">Top 5 Debtors</span>
               <div id="register" style="height:300px;width:100%"><ul class="collection no-collection">
			  <?php foreach($customer_name as $k => $v) { ?>
    <li class="collection-item avatar">
      <div class="circle white grey-text center-align valign-wrapper" ><span ><?php echo $k+1 ?></span></div>
      <span class="title capitalize"><?php echo $v ?></span>
      <a href="#!" class="secondary-content" style="top:30px"><?php echo $datacol_prefix[0];?><?php echo number_format($balance[$k],2,'.',','); ?></a>
    </li> <?php } ?>
  </ul></div>
            </div>
            <div class="card-action">
              <a href="javascript:;" class="right" id="debtors"><i class="material-icons">chevron_right</i>View More</a>
              <a href="#"></a>            </div>
          </div>
  </div><div class="col s12 m4"><div class="card">
            <div class="card-content">
              <span class="black-text">Top 5 items by sales</span>
              <div id="register" style="height:300px;width:100%"><ul class="collection no-collection">
			  <?php foreach($item as $k => $v) { ?>
    <li class="collection-item avatar">
      <div class="circle white grey-text center-align valign-wrapper" ><span ><?php echo $k+1 ?></span></div>
      <span class="title capitalize"><?php echo $v ?></span>
      <a href="#!" class="secondary-content" style="top:30px"><?php echo $datacol_prefix[0];?><?php echo number_format($sum[$k],2,'.',','); ?></a>
    </li> <?php } ?>
  </ul></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div></div> </div>
  <!--<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a data-position="left" data-delay="50" data-tooltip="Setup Report" class="tooltipped btn-floating btn-large red">
      <i class="large material-icons" id="reportSetup"><img src="images/icons/add.svg" /></i>
    </a>
    <ul>
      <li><a data-position="left" data-delay="50" data-tooltip="Show Report" class="tooltipped btn-floating blue hide" id="new"><i class="material-icons"><img src="images/icons/visibility.svg" /></i></a></li>
    </ul>
  </div>-->
 </div> <div id="load_form" style="display:none" class="open_diplay_box"><div class="row"><a href="javascript:;" id="return_back" class="col s12">Back</a></div><div id="next_report"></div><div id="more_report"></div></div></div>
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
	var ctx = $('#myChart3'+ pageId);
	data = {
    datasets: [{
        data: [<?php echo implode(",",$ctk) ?>],
		label:'Aged Receivables',
		backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: ['<?php echo implode("','",$tpk) ?>']
};
	var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
   options: {
		responsive:true,
		cutoutPercentage :50,
		circumference: Math.PI,
		rotation : 2* Math.PI
        
    }
});
	var ctx = $('#myChart2'+ pageId);
	data = {
    datasets: [{
        data: [<?php echo implode(",",$paid_amount) ?>],
		label:'Aged Receivables',
		backgroundColor: [
                'rgba(0, 255, 0, 1)',
                'rgba(255, 0, 0, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: ['<?php echo implode("','",$paid_label) ?>']
};
	var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
   options: {
		responsive:true,
		cutoutPercentage :50,
		circumference: Math.PI,
		rotation :  Math.PI
        
    }
});
	var ctx = $('#myChart'+ pageId);
	var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['<?php echo implode("','",$label) ?>'],
        datasets: [{
            label: 'Volume of Sales ',
            data: [<?php echo implode(",",$data) ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
		responsive:true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
	formInitialize(pageId);
	dashboardInitialize(pageId);
	
</script>