<?php
require_once '../Database_Connect.php';
		
		$sql="select customerid,customername, current_balance from customer where current_balance > 0 and type=1 $_wd order by current_balance desc";
		
		$result = $db->query($sql) or die($db->error.$sql);
		  //Loop through each message and create an XML message node for each.
		  
		  while($row = $result->fetch_assoc()) 
		  {
		  	$p[]=$row;
		  
		  }
		
?><div id="customer_balance" class='row' ><h5 class="grey-text col s12">Customer Balance </h5></div><div class="col s12"><table class="striped capitalize"><thead><tr><th>S/N</th><th>CUSTOMER ID</th><th>CUSTOMER NAME</th><th>CURRENT BALANCE</th></tr></thead>
<tbody>
<?php foreach($p as $k=> $v){ ?>
<tr>
<td> <?php echo $k +1 ?> </td><td><?php echo $v["customerid"] ?></td><td><?php echo $v["customername"] ?></td><td><?php echo number_format($v["current_balance"],2,'.',',') ?></td>
</tr>
<?php } ?>
</tbody>
</table></div>
</div> 