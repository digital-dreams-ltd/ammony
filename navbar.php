	<div class="myNav transit brown darken-4 white-text">
        <ul class="sideNav">
		<?php $_i=-1; foreach($pages as $k => $v ) { $_i++; $vp=json_decode($v['props'],true); if(empty($check[$vp['id']]))continue; ?>
        	<li class="myMenu valign-wrapper <?php echo $_color[$_i]?>">
			
            	<div class="iconColor valign-wrapper width70">
                	<i class="material-icons myIconSize white-text iconPad"><img src="images/icons/<?php echo $vp['icon']; ?>.svg"  /></i>
                	<span class="menu">
                    	<span class="option"><?php echo $k ?></span>
                    	<ul>
                            <div class="menuHead <?php echo $_color[$_i]?>"><span class="white-text"><?php echo $k ?></span></div><?php foreach($v['subs'] as $k1=> $v1){ $sp=json_decode($v1,true); if(empty($check[$vp['id']][$sp['id']]))continue;?>
                            <li><a href="<?php echo $sp['url']; ?>" class="noref waves-effect waves"><?php echo $sp['name']; ?></a></li><?php } ?>
                            
                        </ul>
                    </span>
                </div>
                <div class="width30">
                	<!--<i class="material-icons forMore"><img src="images/icons/more_vert.svg" /></i>-->
                </div>
            </li>
			<?php } ?>
						<?php if(!empty($_COOKIE['ELIMS-AccessLevel']) && $_COOKIE['ELIMS-AccessLevel']>=2){ ?><li class="myMenu valign-wrapper">
            	<div class="iconColor valign-wrapper">
                	<i class="material-icons myIconSize iconColor iconPad"><img src="images/icons/date_range.svg"/></i>
                	<span class="menu">
                    	<span class="option"><a href="#changeDate" class="modal-trigger">Set Today's Date</a></span>
                    </span>
                </div>
            </li><?php } ?>
                        <li class="myMenu valign-wrapper">
            	<div class="iconColor valign-wrapper">
                	<i class="material-icons myIconSize iconColor iconPad"><img src="images/icons/power_settings_new.svg"/></i>
                	<span class="menu">
                    	<span class="option"><a href="log_out.php">Logout</a></span>
                    </span>
                </div>
            </li>
        </ul>
    </div>