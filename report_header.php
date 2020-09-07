<?php require_once "../get_company_info.php"; ?>

<div ><div style="display:none"><img src="<?php echo $company_logo_ref; ?>" height="50" /><?php echo $company_name; ?></div><div class="row right"><h3 class="col s12"><?php echo $page_title; ?></h3>

    <div class="col s6"><?php if(!empty($dateTitle)) echo $dateTitle ?></div><div class="col s6"><?php if(!empty( $sort_col)) echo  "Order by $sort_col".orderSet($sort_col) ?></div>

    <div><?php if(isset($filter_param)) echo interpretFilter($filter_param); ?></div></div>

  

</div>