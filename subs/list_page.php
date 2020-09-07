<?php  
			require "select_subpage.php";
			require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 

		extract($_GET,EXTR_OVERWRITE);

		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$sub_order="";$sub_required="";$Label=""; $sub_columns=array();$sub_coldesc=array(); $sub_required=array();$sub_order=array(); 



				$vcount=0;
				
				

?>
<div>
<div class="top-control row"> 
        
            
            <div class="input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $sub_title ?></label></div><div class="col s2"><a href="javascript" class="btn ">Actions</a></div></div>
<div class="collection row" id="<?php echo str_replace(' ','',$subType); ?>_DP" ><div class="center" style="margin-top:100px;margin-bottom:100px"><img src="images/loading.gif" /></div></div>

</div>

