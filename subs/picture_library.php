<div><?php ?>
<div class="top-control row"> 
        
            
            <div class="input-field col s4"><input name="search" type="text"  id='_searchBox' size="50" value="" /><label for="_searchBox">Search <?php echo $sub_title ?></label></div><div class="col s2"><a href="javascript" class="btn ">Actions</a></div><div class="col s3 right"><a href="javascript:;" class="btn uploadDoc" data-href="upload.php" data-dir="assets/pictures/" data-div="<?php echo str_replace(' ','',$sub_title); ?>_DP_<?php echo str_replace(' ','',$page_title); ?>" data-pagetype="<?php echo $subType; ?>"><i class="large material-icons" id="new_<?php echo $sub_title; ?>"><img src="images/icons/add.svg" /></i>New</a></div></div>
<div class="collection row" id="<?php echo str_replace(' ','',$subType); ?>_DP" list-type="card" action-type="uploadDoc" ><div class="center" style="margin-top:100px;margin-bottom:100px"><img src="images/loading.gif" /></div></div>

</div>