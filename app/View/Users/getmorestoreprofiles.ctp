	<?php if($tab=='trending'){ 
		  $selectedTab = 'trending'; 
		  if(!empty($item_details)){ 
		  foreach($item_details as $ky=>$itemsd){?>	
		  
		  <div class="figure-product figure-200 productalign">
			<a title="<?php echo $itemsd['Item']['item_title']; ?>" id="img_id<?php echo $itemsd['Item']['id']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active">
				<figure>
					<span class="wrapper-fig-image"><span class="fig-image" style="width: 184px;"><img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb350/<?php echo $itemsd['Photo'][0]['image_name']; ?>"></span></span>
					<figcaption><?php echo UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2); ?></figcaption>
				</figure>
			</a>
			<br class="hidden">
			<?php 	$shpnme = $itemsd['User']['username']; 
			$shpnme_url = $itemsd['User']['username_url'];  ?>
			<span class="username">
			<?php	echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url)); ?>
			</span>
			<br class="hidden">
		    <!--a href="#" class="button fantacy" tid="265732549" ><span><i></i></span>Liked</a-->
			<?php
			foreach($itemsd['Itemfav'] as $useritemfav){
				if($useritemfav['user_id'] == $userid ){
					$usecoun[] = $useritemfav['item_id'];
				}
			}
			
			if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
			echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
			}else{
			echo  '<a class="button fantacy" style = "left:52%;" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
			}
			?>	
			
		</div>	
		<?php }
		}else{
			/*echo '<div style="height:200px">';
	        echo '<center style="font-size:23px;margin-top:100px;">'?><?php echo __('No items found');echo '</center>';
			echo '<center style="font-size:14px;">'?><?php echo __('Add something favorite');echo '</li> </center> ';
			echo '</div>';*/
		}
	} ?>
	
	
			<?php if($tab=="added" ) {
	if (!empty($item_details)){
		foreach($item_details as $ky=>$itemsd){
			echo '<div class="figure-product figure-200"  id="addeitem_'.$itemsd['Item']['id'].'" >';
			echo '<a title="'.$itemsd['Item']['item_title'].'" href="'.SITE_URL.'listing/'.$itemsd['Item']['id'].'/'.$itemsd['Item']['item_title_url'].'?ref=shop_home_active">
						<figure>
							<span class="wrapper-fig-image"><span class="fig-image"><img alt="'.$itemsd['Item']['item_title'].'" src="'.$_SESSION['media_url'].'media/items/thumb350/'.$itemsd['Photo'][0]['image_name'].'"></span></span>
							<figcaption>'.UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2).'</figcaption>
						</figure>
					</a>
					<br class="hidden">';
			$shpnme = $itemsd['User']['username']; 
			$shpnme_url = $itemsd['User']['username_url'];
			echo '<span class="username">';
			echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url));
			echo '</span>';
			echo '<input type="hidden" id="deli" value="'.$itemsd['Item']['id'].'" >';
			
			if($userid == $usr_datas['User']['id']){
				echo "<div class='ppeditdelete'>";	
					if($itemsd['Item']['status']=='draft'){				
						echo "<a href='javascript:void(0);' title='Waiting for admin approval'><i class='glyphicons white clock' style='padding-left: 0px;'></i></a>";
					}
					echo "<a href='".SITE_URL."editselleritem/".$itemsd['Item']['id']."' title='Edit'><i class='glyphicons white edit' style='padding-left: 10px;'></i></a>";
					echo "<a href='javascript:void(0);' title='Delete'  onclick ='return deleteadditem(\"".$itemsd['Item']['id']."\")'><i class='glyphicons white bin' style='padding-left: 10px;'></i></a>";
				echo "</div>";	
			}
			
			echo  '</div>';
			
		}
	}else{
		//echo "false";
	}
			}
		  	?>	
		  	
			<?php if($tab=='categories'){ 
		  		$selectedTab = 'categories'; 
		  		if($cat_details) {
				foreach($cat_details as $cat_data){ ?>
		  			<div class="cat_tab">
		  				<div class="cat_img">
		  				<!-- <a href="<?php //echo SITE_URL.'shop/'.$cat_data['Category']['category_urlname']; ?>"> -->
		  				<div style="width:70px;height:70px;border:1px solid #fff;background: url('<?php echo $_SESSION['media_url'].'media/items/thumb150/'.$cat_data['Category']['category_image'];?>') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);"> </div>
		  				<!--</a> -->
		  				</div>
		  				<div class="cat_name">
		  					<?php echo $cat_data['Category']['category_name'];?>
		  				</div>
		  			</div>
		  		<?php }
		  		} else {
		  			//echo "<p style='font-size:14px;margin:0 249px'> No Caegories are found </p>";
		  		}
			}
		  	?>		  	
	