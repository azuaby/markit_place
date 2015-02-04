<?php

	$site = $_SESSION['site_url'];
	$media = $_SESSION['media_url'];
	@$username = @$_SESSION['media_server_username'];
	@$password = @$_SESSION['media_server_password'];
	@$hostname = $_SESSION['media_host_name'];
	
	
	$roundProf = "";
	if ($profileImgStyle == 'round') {
		$roundProf = "border-radius:150px;";
	}
	$roundProfile = "";
	$roundProfileFlag = 0;
	if ($roundProf == "round")  {
		$roundProfile = "border-radius:40px;";
		$roundProfileFlag = 1;
	}
	
	
	
	
		
?>
		
		<div class='container' style='width:960px;'>		
		<div class="wrapper-content">
		<?php 
		$user_imges = $usr_datas['User']['profile_image'];
		$firstnameforpro = $usr_datas['User']['first_name'];
		$usernameforpro = $usr_datas['User']['username'];
		$about = UrlfriendlyComponent::limit_char($usr_datas['User']['about'], 100);
		$website = $usr_datas['User']['website'];
		$shop_address = $usr_datas['Shop']['shop_address'];
		$phone_no = $usr_datas['Shop']['phone_no'];
		$roundProf = "";
		if ($profileImgStyle == 'round') {
			$roundProf = "border-radius:150px;";
		}
		
		
		echo "<div class='leftclas'>";
			echo "<div class='profilImg'>";
				if(!empty($user_imges)){
					echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb150/".$user_imges."'  style='border-top-left-radius: 4px; border-bottom-left-radius: 4px;width:200px;height:200px;' class='prof_img' />";
				}else{
					echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb150/usrimg.jpg'  style='border-top-left-radius: 4px; border-bottom-left-radius: 4px;width:200px;height:200px;' class='prof_img' />";
				}
			echo "</div>";
			
			echo "<div class='profilImgName'>";
				echo "<div class='profilImgName1'>".$firstnameforpro."</div>";
				echo "<div class='profilImgName2' style='font-size: 13px;'>@".$usernameforpro."</div>";
				echo "<div class='profilImgName3about' style='font-size: 13px; font-weight: normal;'>".$about."</div>";
			echo "<div style='position: absolute;bottom: 2px;'>";
				if(empty($shop_address)){
					
				}else {
				 echo "<div class='glyphicons direction profileicon' style='float:left;margin: 0 5px;padding:0;'><p style='margin: -17px 0 0 26px;color: #C7C6CB;font-size: 13px;font-weight: bold;max-width: 250px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding:0px;'>".$shop_address."</p></div>";
					   }
				if(empty($phone_no)){
					
				}else{
				echo "<div class='glyphicons phone_alt profileicon' style='float:left;margin: 0 5px;padding:0;' ><p style='margin: -17px 0 0 26px;color: #C7C6CB;font-size: 13px;font-weight: bold;padding:0;'>".$phone_no."</p></div>";
				   	}
				 if(empty($website)){
				 	
				 }else{
				echo "<div class='glyphicons globe_af profileicon' style='float:left;margin: 0 5px;padding:0;' ><p style='margin: -17px 0 0 26px;color: #C7C6CB;font-size: 13px;font-weight: bold;max-width: 250px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding:0px;'><a href='http://$website' target='_blank' style='color: #C7C6CB;font-size: 13px;font-weight: bold;max-width: 250px;overflow: hidden;white-space: nowrap;word-wrap: break-word;padding:0px;'>".$website."</a></div>";
				
				 }
			echo "</div>";
			echo "</div>";
		echo "</div>";
		
		
		
		echo "<div class='rightclas'>";
		
			if($userid != $usr_datas['User']['id']){
				foreach($flwrscnt as $flcnt){
					if($flcnt['Follower']['follow_user_id'] == $userid){
						$flwrcntid[] = $flcnt['Follower']['user_id'];
					}
						
				}
				if($userid != $usr_datas['User']['id']){
					if(!in_array($usr_datas['User']['id'],$flwrcntid)){
						$flw = true;
					}else{
						$flw = false;
					}
					if($flw){
						echo "<span class='follow' id='foll".$usr_datas['User']['id']."'>";
						echo "<div class='profilImgName'>";
						echo '<button type="button" id="follow_btn'.$usr_datas['User']['id'].'" class="editPrfcls" onclick="getfollowsuserpro('.$usr_datas['User']['id'].')" style="height: 57px;">';
						echo '<span class="foll'.$usr_datas['User']['id'].'" >'?><?php echo __('Follow');echo '</span>';
						echo '</button>';
						echo "</div>";
						echo "</span>";
					}else{
						echo "<span class='follow' id='unfoll".$usr_datas['User']['id']."'>";
						echo "<div class='profilImgName'>";
						echo '<button type="button" id="unfollow_btn'.$usr_datas['User']['id'].'" class="editPrfcls" onclick="deletefollowsuserpro('.$usr_datas['User']['id'].')" style="height: 57px;">';
						echo '<span class="unfoll'.$usr_datas['User']['id'].'" >Following</span>';
						echo '</button>';
						echo "</div>";
						echo "</span>";
					}
					echo '<span id="changebtn'.$usr_datas['User']['id'].'" ></span>';
				}
			}else{
				echo "<div class='profilImgName' style='line-height: 16px;'>";
				echo "<a href='".SITE_URL."settings' class='editPrfcls'><div class='editPrfclsfnt'>"?><?php echo __('Edit profile');echo "</div></a>";
				echo "</div>";
			}
			//echo "<div class='profilImgName'>";
				//echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?lists' class='contctLis'><span class='followCnts'>".count($itemListsAll)." </span> Lists </a>";
			//echo "</div>";
			echo "<div class='profilImgName'>";
			if(isset($_REQUEST['following'])){
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?following' class='activeContctLis'><span class='followCnts'>".$followCount." </span>"?><?php echo __('Following');  echo "</a>";
				}else{
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?following' class='contctLis'><span class='followCnts'>".$followCount." </span>"?><?php echo __('Following'); echo  "</a>";
				}
			echo "</div>";
			echo "<div class='profilImgName'>";
			if(isset($_REQUEST['followers'])){
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?followers' class='activeContctLis'><span class='followCnts'>".$followerCount."</span>"?><?php echo __('Follower'); echo "</a>";
				}else{
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?followers' class='contctLis'><span class='followCnts'>".$followerCount."</span>"?><?php echo __('Follower'); echo "</a>";
				}
			echo "</div>";
			
			
			
			
			
		
			
			//echo "<div class='profilwantgift'>";
				//echo "<a href='' class='contctLisgift'><span class='editPrfclsfntgift'>Find @$usernameforpro Want a Gift</span></a>";			
			//echo "</div>";
		
		echo "</div>";
		
		
		?>
						
		</div>
		</div>
		
		<div class='container' style='padding:0px;width:960px;'>
		<?php 
		$selectedTab = '';
		echo '<div>';
			echo '<ul class="feedsandtrent">';
				if(count($_GET)==1){
					echo '<li class="active myfeeds">';
				}else{
					echo '<li class="myfeeds">';
				}
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."'> ".$favitemCount." "?><?php echo __($setngs[0]['Sitesetting']['liked_btn_cmnt']); echo "</a>";
					
				echo '</li>';
				if(isset($_REQUEST['lists'])){
					echo '<li class="active myfeeds">';
				}else{
					echo '<li class="myfeeds">';
				}
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?lists'>".$itemListsCount." "?><?php echo __('Lists');echo "</a>";
				echo '</li>';
				if(isset($_REQUEST['added'])){
					echo '<li class="active myfeeds">';
				}else{
					echo '<li class="myfeeds">';
				}
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?added'> ".$item_datas_count." "?><?php echo __('Added');echo "</a>";
				echo '</li>';
				
				if(isset($_REQUEST['wantit'])){
					echo '<li class="active myfeeds">';
				}else{
					echo '<li class="myfeeds">';
				}
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?wantit'>".$wantCount." "?><?php echo __(' Want it');echo "</a>";
				echo '</li>';
				
				if(isset($_REQUEST['ownit'])){
					echo '<li class="active myfeeds">';
				}else{
					echo '<li class="myfeeds">';
				}
				echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?ownit'>".$ownCount." "?><?php echo __('Own it'); echo "</a>";
				echo '</li>';
				
				/* 
				if(isset($usr_datas['Shop']['shop_latitude']) && isset($usr_datas['Shop']['shop_longitude'])){
					if(isset($_REQUEST['locations'])){
						echo '<li class="active myfeeds">';
					}else{
						echo '<li class="myfeeds">';
					}
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?locations'> Locations </a>";
					echo '</li>';
				}
				 */
				
				if(isset($usr_datas['Shop']['shop_latitude']) && isset($usr_datas['Shop']['shop_longitude'])){
					/* if(isset($_REQUEST['locations'])){
						echo '<li class="active myfeeds">';
					}else{
						echo '<li class="myfeeds">';
					}
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?locations'> More info </a>";
					echo '</li>'; */
				
					if($userid == $usr_datas['User']['id']){
						if(isset($_REQUEST['news'])){
							echo '<li class="active myfeeds">';
						}else{
							echo '<li class="myfeeds">';
						}
						echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?news'> "?><?php echo __('News'); echo "</a>";
						echo '</li>';
				
					}
				
					if($userid == $usr_datas['User']['id']){
						if(isset($_REQUEST['userapprove'])){
							echo '<li class="active myfeeds">';
						}else{
							echo '<li class="myfeeds">';
						}
						echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?userapprove'> " ?> <?php echo __('User Fashion'); echo "</a>";
						echo '</li>';
				
					}
				
					/* if(isset($_REQUEST['photos'])){
						echo '<li class="active myfeeds">';
					}else{
						echo '<li class="myfeeds">';
					}
					echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?photos'>Photo</a>";
					echo '</li>';
				
					if($userid == $usr_datas['User']['id']){
						if(isset($_REQUEST['shopphotoapprove'])){
							echo '<li class="active myfeeds">';
						}else{
							echo '<li class="myfeeds">';
						}
						echo "<a href='".SITE_URL.'people/'.$_SESSION['username_urls']."?shopphotoapprove'>Shop Photo Approve</a>";
						echo '</li>';
					} */
				}
				
				
			echo '</ul>';
		
		
		
		echo '</div>';
		?>
		
		
		
		
		<div class="wrapper-content profile-content" style="border-radius: 0px 0px 4px 4px;"><br />
		<?php
					//echo "<pre>";print_r($itematas);
					if(count($_GET)==1){
						$selectedTab = 'fantacy';
						if(!empty($itematas)){
						foreach($itematas as $ky=>$itemsd){
					?>
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
						
//						if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
//						echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//						}else{
//						echo  '<a class="button fantacy" style = "left:52%;" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//						}

						if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
						echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
                        echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                        echo '<input type="hidden" value="'.$itemsd['Item']['id'].'" name="listing_id">';
                        echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                        echo '<button type="submit" class="button fantacyd edit" style="margin-left: -22px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
						echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "share_post('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
						}else{
						echo  '<a class="button fantacy" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
                        echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                        echo '<input type="hidden" value="'.$itemsd['Item']['id'].'" name="listing_id">';
                        echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                        echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
						echo  '<a class="button fantacy" onclick = "share_post('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
						}

							?>	
							
						</div>
						
					<?php
					}
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">'?><?php echo __('No items found');echo '</center>';
						echo '<center style="font-size:14px;">'?><?php echo __('Add something favorite');echo '</li> </center> ';
						echo '</div>';
					}
					}
		
		
		?>		
		<?php if(isset($_REQUEST['lists'])){
					$selectedTab = 'lists';
		?>
		 <div class="find-people">
		
		 <div class="select-list">
		 	<ul class="stream">
            
          	<?php 	
				if(!empty($itemListsAll)){
					foreach($itemListsAll as $key => $list){
					$lists_name = $list['Itemlist']['lists'];
					$lists_nameurl = urlencode($lists_name);
						
						echo "<li class='stream-item' style='padding:0;'>";
					
          	
          			echo "<div class='peopleheaders'>";
			          	if(!empty($user_imges)){
			          		echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."'  style='height: 40px; width: 40px; padding: 7px;".$roundProf."' class='prof_img' />";
			          	}else{
			          		echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'  style='height: 40px; width: 40px; padding: 7px;".$roundProf."' class='prof_img' />";
			          	}
	          			echo "<a href='".SITE_URL."user_lists/".$lists_nameurl.'/'.$usr_datas['User']['id']."'   style='position: absolute; top: 10px;'><strong class='nickname'>$lists_name</strong></a>";
          		
					echo '</div>';
					echo '<div class="things">';
						$list_itemides = json_decode($list['Itemlist']['list_item_id']);
						$count = 0;
						foreach($itemdatasall as $key=>$itemsd){
							$id = $itemsd['Item']['id'];
							$itemNamee = $itemsd['Item']['item_title_url'];
							if((isset($list_itemides)) && in_array($itemsd['Item']['id'],$list_itemides) && $count<8){
							echo "<a href='".SITE_URL."listing/".$id."/".$itemNamee."' >"; ?>
							<!-- <img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb150/<?php echo $itemsd['Photo'][0]['image_name']; ?>" title="<?php echo $itemsd['Item']['item_title'] ;?>" > -->
						<?php
							echo "<div style='background:url(\"".$_SESSION['media_url']."media/items/thumb150/".$itemsd['Photo'][0]['image_name']."\") no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);margin: 10px 6px 10px 7px;'></div>";
							 echo "</a>";
								$count++;
							}
										
							}
			  		echo '</div>';
		
	  		?>
		
		
         	</li>
         	<?php } }else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">'?><?php echo __('No items found');echo '</center>';
						echo '<center style="font-size:14px;">'?><?php echo __('Add something favorite');echo '</li> </center> ';
						echo '</div>';
					} ?>
			</ul>
		</div>	
		</div>	
		
		
		
		
		<?php }	?>
		
		
		
		
		<?php if(isset($_REQUEST['added'])){
					$selectedTab = 'added';
					if(!empty($item_datas)){
					foreach($item_datas as $ky=>$itemsd){  
					//echo "<pre>";print_r($item_datas);die;
					//print_r($followcnt);
					//print_r($flwrscnt);
					?>
					<?php 	
					
					echo '<div class="figure-product figure-200"  id="addeitem_'.$itemsd['Item']['id'].'" >';?>
							<a title="<?php echo $itemsd['Item']['item_title']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>/<?php echo $usr_datas['User']['id']; ?>?ref=shop_home_active">
								<figure>
									<span class="wrapper-fig-image"><span class="fig-image"><img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb350/<?php echo $itemsd['Photo'][0]['image_name']; ?>"></span></span>
									<figcaption><?php echo UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2); ?></figcaption>
								</figure>
							</a>
							<br class="hidden">
							<?php 	$shpnme = $itemsd['User']['username']; 
							$shpnme_url = $itemsd['User']['username_url'];  ?>
							<span class="username">
							<?php	echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url)); ?>
							</span>
							<?php  //if($itemsd['Item']['status']=='things') {
								//echo "<pre>";print_r($itemsd['Item']['id']);die;
							?><input type="hidden" id="deli" value=<?php echo $itemsd['Item']['id']; ?> ><?php 
								//if($userid == $usr_datas['User']['id']){
									//echo '<button class="delete-comment" onclick = "return deleteadditem('.$itemsd['Item']['id'].')" >Delete</button>';
								//}
							//}
							?>
					
					<?php
					
					
					/* if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
						echo  '<a class="button fantacy edit" style = "background-color:#6EAA53;" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'"  style = "background-color:#84C069;border-color: #4A9528;"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
					}else{
						echo  '<a class="button fantacy" style = "left:52%;" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
					} */
					
					if($userid == $usr_datas['User']['id']){
						echo "<div class='ppeditdelete'>";	
							if($itemsd['Item']['status']=='draft'){				
								echo "<a href='javascript:void(0);' title='Waiting for admin approval'><i class='glyphicons white clock' style='padding-left: 0px;'></i></a>";
								echo "<a href='".SITE_URL."editselleritem/".$itemsd['Item']['id']."' title='Edit'><i class='glyphicons white edit' style='padding-left: 10px;'></i></a>";
								echo "<a href='javascript:void(0);' title='Delete'  onclick ='return deleteadditem(\"".$itemsd['Item']['id']."\")'><i class='glyphicons white bin' style='padding-left: 10px;'></i></a>";
							}elseif($itemsd['Item']['status']=='things'){				
								//echo "<a href='javascript:void(0);' title='Waiting for admin approval'><i class='glyphicons white clock' style='padding-left: 0px;'></i></a>";
								//echo "<a href='".SITE_URL."editselleritem/".$itemsd['Item']['id']."' title='Edit'><i class='glyphicons white edit' style='padding-left: 10px;'></i></a>";
								echo "<a href='javascript:void(0);' title='Delete'  onclick ='return deleteadditem(\"".$itemsd['Item']['id']."\")'><i class='glyphicons white bin' style='padding-left: 0px;'></i></a>";
							}else{				
								//echo "<a href='javascript:void(0);' title='Waiting for admin approval'><i class='glyphicons white clock' style='padding-left: 0px;'></i></a>";
								echo "<a href='".SITE_URL."editselleritem/".$itemsd['Item']['id']."' title='Edit'><i class='glyphicons white edit' style='padding-left: 0px;'></i></a>";
								echo "<a href='javascript:void(0);' title='Delete'  onclick ='return deleteadditem(\"".$itemsd['Item']['id']."\")'><i class='glyphicons white bin' style='padding-left: 10px;'></i></a>";
							}
							
						echo "</div>";	
						
						
						
					}
					
					echo  '</div>';
					
					}
					
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">'?><?php echo __('No items found');echo '</center>';
						echo '<center style="font-size:14px;">'?><?php echo __('Add something');echo '</li> </center> ';
						echo '</div>';
					}
					}
					?>	
				
		
		<?php if(isset($_REQUEST['locations'])){
					$selectedTab = 'locations'; ?>
			<div class="find-people">
			<section class="followers-listings">
				<ol>
					<div id="wrapper" style="margin: 5px 5px 100px;"><div id="map" style="background-color: rgb(229, 227, 223); overflow: hidden; margin-left: 50px; position: relative; height: 500px; top: 25px; width: 820px;"></div></div>
      		
			 	
				</ol>
			</section>
			
			</div>
		<?php }	?>
		
		
		
		<?php if(isset($_REQUEST['followers'])){
					$selectedTab = 'followers'; ?>
		 <div class="find-people">
		
		 <div class="select-list">
		 	<ul class="stream">
					 <?php 
					 	if(!empty($people_details)){
						foreach($people_details as $key => $ppls){
						
						echo "<li class='stream-item'  style='padding:0;'>";
         				echo "<div class='peopleheaders'>";
						//if(!empty($ppls['Itemfav'])){
						//echo "<pre>";print_r($ppls);
						$user_nam = $ppls['User']['username'];
						$user_nam_url = $ppls['User']['username_url'];
						$user_first = $ppls['User']['first_name'];
						$user_imges = $ppls['User']['profile_image']; 
						if(!empty($user_imges)){
							echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 10px; position: absolute;'>$user_nam</strong></a>";
								
						}else{
							echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 10px; position: absolute;'>$user_nam</strong></a>";
						}
					
						foreach($followcnt as $flcnt){	
							$flwrcntid[] = $flcnt['Follower']['user_id'];
						
						}
						if($userid != $ppls['User']['id']){				
							if(in_array($ppls['User']['id'],$flwrcntid)  && isset($loguser[0]['User']['id']) ){
								$flw = false;
							}else{
							    $flw = true;
						    }
					
					if($flw){
					echo "<span class='follow' id='foll".$ppls['User']['id']."'>";
					echo '<button type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" >Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" >Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
				} 
						
						 
				//echo '<a href="#follow" class="follow-user-link" uid="'.$user_nam.'">Follow</a>';
				
				echo '</div>';
				echo '<div class="things">';
				if(!empty($ppls['Itemfav'])){
				$count_im =0;
				foreach($ppls['Itemfav'] as $key=>$img_dtel){
				$itemid = $img_dtel['item_id'];
				//$itemNamee = $img_dtel['Item']['item_title_url'];
				
				foreach($pho_datass as $key=>$val){
					if(!empty($val) && $count_im < 8){
						$itemNameef =$val[0]['Item']['item_title_url'];
					//if($itemid == $key and $count_im<8){
					if($itemid == $key){
						echo "<a href='".SITE_URL."listing/".$itemid."/".$itemNameef."' >";
						if(!empty($val)){
							$imggname = $val[0]['Photo'][0]['image_name'];
							//echo "<img src='".$_SESSION['media_url']."media/items/thumb150/".$imggname."'  title='".$imggname."'/> &nbsp";
							echo "<div style='background:url(\"".$_SESSION['media_url']."media/items/thumb150/".$imggname."\") no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);margin: 10px 6px 10px 7px;'></div>";
					 	}
						echo "</a>";
					}
					$count_im++;
					}else
					{
						$count_im = 0;
					}
				}		
				
			}
			
			}/* else{
				echo '<div style="height:200px">';
				echo '<center style="font-size:23px;margin-top:100px;">No body follows  </center>';
				echo '<center style="font-size:14px;"> ask  someone to follow</li> </center> ';
				echo '</div>';
			} */
			
			echo '</li>';
			}
			}else{
					echo '<div style="height:200px">';
					echo '<center style="font-size:23px;margin-top:100px;">No body follows  </center>';
					echo '<center style="font-size:14px;"> ask  someone to follow</li> </center> ';
					echo '</div>';
				}
		?>
				
		</ul>
		</div>
		</div>
		<?php }	?>
		
		
		
		
			
			<?php if(isset($_REQUEST['following'])){
					$selectedTab = 'following';
			//echo "<pre>";print_r($followcnt);die;
				?>
			<div class="find-people">
				<div class="select-list">
		 		<ul class="stream">
			
			 	<?php 
				if(!empty($people_details_for_following)){
				
					//echo "<pre>";print_r($people_details_for_following);die;
					foreach($people_details_for_following as $key => $ppls){
						
						echo "<li class='stream-item'  style='padding:0;'>";
						echo "<div class='peopleheaders'>";
					//	echo "<pre>";print_r($people_details_for_following);die;
					$user_nam = $ppls['User']['username'];
					$user_nam_url = $ppls['User']['username_url'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 
					
			       if(!empty($user_imges)){
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 10px; position: absolute;'>$user_nam</strong></a>";
					}else{
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 10px; position: absolute;'>$user_nam</strong></a>";
					}
					 
				
				
				foreach($followcnt as $flcnt){
					$flwrcntid[] = $flcnt['Follower']['user_id'];
				}
				if($userid != $ppls['User']['id']){						
						if(in_array($ppls['User']['id'],$flwrcntid) && isset($loguser[0]['User']['id']) ){
							$flw = false;
						}else{
							$flw = true;
						}
					
					if($flw){
					echo "<span class='follow' id='foll".$ppls['User']['id']."'>";
					echo '<button type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" >Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" >Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
				} 
					 
					 
				
				echo '</div>';
				echo '<div class="things">';
				
				if(!empty($ppls['Itemfav'])){
				$count_im = 0;
				foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
					
					foreach($pho_datass_for_following as $key=>$val){
						$itemnnamee = $val[0]['Item']['item_title_url'];
						$imggNamee = $val[0]['Photo'][0]['image_name'];
						if(!empty($val) && $count_im < 8){
						if($itemid == $key){
							echo "<a href='".SITE_URL."listing/".$itemid."/".$itemnnamee."' >";
								//echo "<img src='".$_SESSION['media_url']."media/items/thumb150/".$imggNamee."'  title='".$itemnnamee."'/> &nbsp";
								echo "<div style='background:url(\"".$_SESSION['media_url']."media/items/thumb150/".$imggNamee."\") no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);margin: 10px 6px 10px 7px;'></div>";
							echo "</a>";
						}
						$count_im++;
						
						}else{
							$count_im = 0;
						}
					
					}		
						
					}
					}else{
						echo '<div style="width: 454px; height: 250px; margin-top: 20%;">';
						echo '<center style="font-size:14px;"> No Items Found </center> ';
						echo '</div>';
					}
					
					echo '</div>';
					echo '</li>';
						}
				
				}else{
					echo '<div style="height:200px">';
					echo '<center style="font-size:23px;margin-top:100px;"> Following none</center>';
					echo '<center style="font-size:14px;"> Follow someone  </center> ';
					echo '</div>';
				}
				?>
			
		</ul>
		</div>
		</div>
	<?php }	?>
	
		
		<?php if(isset($_REQUEST['wantit'])){ 
					$selectedTab = 'wantit';
					if(!empty($wantItemModel)){
					foreach($wantItemModel as $ky=>$itemsd){  
					//echo "<pre>";print_r($item_datas);die;
					//print_r($followcnt);
					//print_r($flwrscnt);
					?>
					<?php 	echo '<div class="figure-product figure-200"  id="wantit_'.$itemsd['Item']['id'].'" >';?>
							<a title="<?php echo $itemsd['Item']['item_title']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active">
								<figure>
									<span class="wrapper-fig-image"><span class="fig-image"><img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb350/<?php echo $itemsd['Photo'][0]['image_name']; ?>"></span></span>
									<figcaption><?php echo UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2); ?></figcaption>
								</figure>
							</a>
							<br class="hidden">
							<?php 	$shpnme = $itemsd['User']['username']; 
							$shpnme_url = $itemsd['User']['username_url'];  ?>
							<span class="username">
							<?php	echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url)); ?>
							</span>
							<?php  if($itemsd['Item']['status']=='things') {
								//echo "<pre>";print_r($itemsd['Item']['id']);die;
							?><input type="hidden" id="deli" value=<?php echo $itemsd['Item']['id']; ?> ><?php 
								if($userid == $usr_datas['User']['id']){
									echo '<button class="delete-comment" onclick = "return wantit('.$itemsd['Item']['id'].')" >Delete</button>';
								}
							}
							?>
						</div>
					<?php
					}
					
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">No items found</center>';
						echo '<center style="font-size:14px;">  Add something</li> </center> ';
						echo '</div>';
					}
		 }	?>
		
		
		
		
			
			<?php if(isset($_REQUEST['ownit'])){
					$selectedTab = 'ownit';
					if(!empty($ownItemModel)){
					foreach($ownItemModel as $ky=>$itemsd){  
					//echo "<pre>";print_r($item_datas);die;
					//print_r($followcnt);
					//print_r($flwrscnt);
					?>
					<?php 	echo '<div class="figure-product figure-200"  id="ownit_'.$itemsd['Item']['id'].'" >';?>
							<a title="<?php echo $itemsd['Item']['item_title']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active">
								<figure>
									<span class="wrapper-fig-image"><span class="fig-image"><img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb350/<?php echo $itemsd['Photo'][0]['image_name']; ?>"></span></span>
									<figcaption><?php echo UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2); ?></figcaption>
								</figure>
							</a>
							<br class="hidden">
							<?php 	$shpnme = $itemsd['User']['username']; 
							$shpnme_url = $itemsd['User']['username_url'];  ?>
							<span class="username">
							<?php	echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url)); ?>
							</span>
							<?php  if($itemsd['Item']['status']=='things') {
								//echo "<pre>";print_r($itemsd['Item']['id']);die;
							?><input type="hidden" id="deli" value=<?php echo $itemsd['Item']['id']; ?> ><?php 
								if($userid == $usr_datas['User']['id']){
									echo '<button class="delete-comment" onclick = "return ownit('.$itemsd['Item']['id'].')" >Delete</button>';
								}
							}
							?>
						</div>
					<?php
					}
					
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">No items found</center>';
						echo '<center style="font-size:14px;">  Add something</li> </center> ';
						echo '</div>';
					}
			 }	?>
		
		
	
	
	
	<?php 
		
		if(isset($_REQUEST['news'])){
			$selectedTab = 'news';
			if($userid == $usr_datas['User']['id']){
				echo "<div class='newsleft'  style='width: 600px; float: left;'>";
				echo $this->Form->Create('sellermsg',array('url'=>array('controller'=>'/','action'=>'/sellerpost'),'id'=>'msgForm'));
					
					echo $this->Form->input('message',array('type'=>'textarea','label'=>false,'maxlength'=>'180','style'=>'overflow: auto; resize: none; padding: 5px 0px 0px 10px; width: 400px; float: left; margin: 0px 15px 15px; height: 32px;','class'=>'inputform','placeholder'=>'Send a message or coupon code to your followers','id'=>'sellerMsg'));

					echo $this->Form->submit('POST',array('class'=>'btn-save','style'=>'float: left; margin: 0px 0px 2px; height: 40px; border-radius: 4px;'));
					
				echo $this->Form->end();
				
				echo "<br clear='all' />";
				
								
				if(!empty($postmessage)){
					foreach($postmessage as $key=>$temp){
						$bnr_id = $temp['Log']['id'];
						$title = $temp['Log']['seller_message'];
						?>
								<li class="notification-item" style="padding: 10px 25px; word-wrap: break-word; width: 530px;">
						           <p style="font-weight:bold;"><span class="title"> <?php echo $title; ?></span>
						          				           
						           <span class="activity-reply">
										<?php 
											$ldate =$temp['Log']['cdate'];
											echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
										?>
									</span>
						           
						        </li>
								
						<?php 						
							}
						}else{
							echo "<tr>";
							echo "<div style='margin: 29px -3px -5px 199px;'>";
								echo "No record Found";
							echo "</div>";
							echo "</tr>";
						}
						
						echo "</div>";
						
						echo "<div class='newsright'>";
							echo "<div class='newsrighttitle'>";
								echo "What is the News?";
							echo "</div>";
							echo "<p>";
							echo "This is the news section where any merchant can update their followers with any new updates , sales or any upcome events on your merchant account.";
							
							echo "</p>";
							echo "<p>";
							echo "This notifications will be posted in their notification section . The users who connected with mobile apps will receive push notification updates from this sections.";
								
							
							echo "</p>";
						echo "</div>";
			}	
		}  
		
		
		?>
		
			
			<?php
				if($userid == $usr_datas['User']['id']){				
				if(isset($_REQUEST['userapprove'])){	
					$selectedTab = 'userapprove';				
			?>
					<div class="set_area section shipping">
					<h3>Fashion User Image</h3>
					<div class="chart-wrap">
				<?php 
				if(!empty($fashionuser)){  ?>
				
				<table class="chart">
				<thead>
					<tr>
						<th>Username</th>
						<th>Fashion User Image</th>
						<th>Product</th>
						<th>Create date</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				foreach($fashionuser as $key=>$temp){
					if ($temp['Fashionuser']['status'] == "No") {
						$buttonLabel = "Show";
						$color = "btn-success";
					} else {
						$buttonLabel = "Hide";
						$color = "btn-warning";
					}
						$fId = $temp['Fashionuser']['id'];
						$fstatus = $temp['Fashionuser']['status'];
						$itemIDD = $temp['Item']['id'];
						$imagesname = $temp['Fashionuser']['userimage'];
						//$ItemImagesname = $temp['Photo']['image_name'];
						$itemNamee = $temp['Item']['item_title'];
						$itemUrl = $temp['Item']['item_title_url'];
						$username = $temp['User']['username'];
						$usernameUrl = $temp['User']['username_url'];
						echo "<tr id='item".$fId."'>";
							echo "<td><a target='_blank' href='".SITE_URL."people/".$usernameUrl."'>".$username."</a></td>";												
							echo "<td><img src='".SITE_URL."media/avatars/thumb70/".$imagesname."' /></td>";
							echo "<td><a  target='_blank' href='".SITE_URL."listing/".$itemIDD."/".$itemUrl."' >".$itemNamee."</a></td>";
							
							echo "<td>".date("m/d/Y",$temp['Fashionuser']['cdate'])."</td>";
							echo "<td ><span id='statuss".$fId."'>";
								echo "<button class='btn ".$color."' style='display:inline-table;' onclick='changeUserImgStatus(".$fId.",\"".$fstatus."\");'>".$buttonLabel."<img id='loadd".$fId."' src='".SITE_URL."images/loading.gif' style='width: 13px; position: absolute; margin-top: 4px; margin-left: 6px; display: none;'></button>";
							
							echo "</span></td>";
						echo "</tr>";
				}
								?>
				</tbody>
				</table>
				<?php 
				}else{
					echo "<div style='text-align:center;padding:25px;color:#ad3535;'>No record Found</div>";
				}
				?>
			</div>
			</div>							
						
						
						
				<?php 
				
			if($pagecount > 0){						
				$nextPage = $this->Paginator->params->paging['Fashionuser']['nextPage'];
				$prevPage = $this->Paginator->params->paging['Fashionuser']['prevPage'];
				if(!empty($nextPage) || !empty($prevPage)){
					echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
						echo '<ul>';
							echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/'),$this->passedArgs)));	
							echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
							echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
							echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
						echo '<ul>';
					echo "</div>";
				}
			}	
				
				
				}
			}
			?>

		
			
			<?php	
			/*
			
			if(isset($_REQUEST['photos'])){		?>	
			<?php	if(isset($userid)){		?>				
			<a href="#" onclick = "inshopprofile()" class="color"><span class="shareebtn" style="float: right; margin-right: 25px;"><i class="glyphicons camera" style="margin-top: -6px; padding: 0px 5px 0px 0px;"></i> Upload photos </span></a>
			<br clear="all" />
				
			
			<?php 
			echo '<input type="hidden" value="'.$usr_datas['User']['id'].'" id="shopIId" />';
			
			} ?>
			
			
			<div style="margin-left: 0px;">
			<?php 
			
			if(!empty($shpusrimgg)){
				foreach($shpusrimgg as $key=>$shpimgg){
					//$shpimgg['Shopuserphoto']['user_id'];					
					$spuId = $shpimgg['Shopuserphoto']['id'];
					$user_id = $shpimgg['Shopuserphoto']['user_id'];
					$favorte_count = $shpimgg['Shopuserphoto']['fav_count'];
					$username = $shpimgg['User']['username'];
					$item_price = $shpimgg['Shopuserphoto']['price'];
					$userimage = $shpimgg['Shopuserphoto']['userimage'];
					?>
					<div style="float: left; margin: 10px;">
					<figure>
						<span class="wrapper-fig-image">
							<span class="fig-image" style="width: 184px;">
								<?php
								$img = $_SESSION['media_url']."media/avatars/thumb150/".$userimage;
								$img_ori = $_SESSION['media_url']."media/avatars/original/".$userimage;
								
								echo '<a href="'.$img_ori.'" data-lightbox="roadtrip">';
								echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 100px; height: 100px;"></span>';
								echo '</a>';
								
								?>
							</span>
						</span>
					</figure>
					<br class="hidden">
					<?php 	$shpnme = $itemsd['User']['username']; 
					$shpnme_url = $itemsd['User']['username_url'];  ?>
					<span class="username">
					<?php	
						echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/'.$shpnme_url)); 
						
						
					?>
					</span>				
					
					
				</div>
					
				<?php 	
					
				}
			}	
			
			
			?>
			</div>
			
			
			</div>
			
				
			<?php 	}	?>			
				
				
				
			<?php
			
				if($userid == $usr_datas['User']['id']){				
				if(isset($_REQUEST['shopphotoapprove'])){					
			?>
					<div class="set_area section shipping">
					<h3>User Image</h3>
					<div class="chart-wrap">
				
				<table class="chart">
				<thead>
					<tr>
						<th>Username</th>
						<th>User Image</th>
						<th>Create date</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if(!empty($inshoppageuserimgapprove)){
					foreach($inshoppageuserimgapprove as $key=>$temp){
					if ($temp['Shopuserphoto']['status'] == "No") {
						$buttonLabel = "Show";
						$color = "btn-success";
					} else {
						$buttonLabel = "Hide";
						$color = "btn-warning";
					}
						$suId = $temp['Shopuserphoto']['id'];
						$fstatus = $temp['Shopuserphoto']['status'];
						//$itemIDD = $temp['Item']['id'];
						$imagesname = $temp['Shopuserphoto']['userimage'];
						//$ItemImagesname = $temp['Photo']['image_name'];
						//$itemNamee = $temp['Item']['item_title'];
						//$itemUrl = $temp['Item']['item_title_url'];
						$username = $temp['User']['username'];
						$usernameUrl = $temp['User']['username_url'];
						echo "<tr id='item".$suId."'>";
							echo "<td><a target='_blank' href='".SITE_URL.$usernameUrl."'>".$username."</a></td>";												
							echo "<td><img src='".SITE_URL."media/avatars/thumb70/".$imagesname."' /></td>";
							
							echo "<td>".date("m/d/Y",$temp['Shopuserphoto']['cdate'])."</td>";
							echo "<td ><div id='loaddsuId".$suId."' style='display:none;'><img src='".SITE_URL."images/loading.gif'></div><span style='padding: 0px 0px 0px 0px;' id='statuss".$suId."'>";
								echo "<button  class='btn ".$color."' onclick='changeStatusForuserphotoinshppage(".$suId.",\"".$fstatus."\");'>".$buttonLabel."</button>";
							
							echo "</span></td>";
						echo "</tr>";
					}
				}else{
					echo "<tr>";
						echo "No record Found";
					echo "</tr>";
				}
								?>
				</tbody>
				</table>
			</div>
			</div>							
						
						
						
						<?php 
						
					if($pagecount > 0){						
						$nextPage = $this->Paginator->params->paging['Fashionuser']['nextPage'];
						$prevPage = $this->Paginator->params->paging['Fashionuser']['prevPage'];
						if(!empty($nextPage) || !empty($prevPage)){
							echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
								echo '<ul>';
									echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/'),$this->passedArgs)));	
									echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
									echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
									echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
								echo '<ul>';
							echo "</div>";
						}
					}	
						
				
				}
			}
			*/
			?>
			</div>
			<div id="infscr-loading" style="display:none;text-align:center;">
				<img alt="Loading..." src="<?php echo SITE_URL; ?>img/loading.gif">
			</div>
	
	
	
	<?php 
	if(empty($userid)){
		echo "<input type='hidden' id='gstid' value='0' />";
	}else{
		echo "<input type='hidden' id='gstid' value='".$userid."' />";
	}
	echo "<input type='hidden' id='selectedtab' value='".$selectedTab."' />";
		
		?>
		
		
		<footer id="footer">
		<!-- <a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a> -->
		<hr>
		<ul class="footer-nav">
			<li><a href="<?php //echo SITE_URL.'help'; ?>"><!-- Help --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/contact"><!-- Contact --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/terms_service"><!-- Terms --></a></li>
		</ul>
		<!-- / footer-nav -->
	</footer>
		
		
					
		</div>
		
	</div>
		
		
		
		
		
		
	<!-- popups -->
	<div id="popup_container">
	<!-- add_to_list overlay -->
	<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
		<div class="default">
			<p class="ltit">Add to List</p>
			<button type="button" class="ly-close" id="btn-browses"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
			<div class="fancyd-item">
				<div class="image-wrapper">
					<div class="item-image"><img id ='selectimgs' src=""></div>
				</div>
				<div class="item-categories">
					<form class="categorycls" id="categorycls">
						<fieldset class="list-categories"><div class="list-box"><ul>
						<?php 
						//echo "<pre>";print_r($items_list_data);die;
						foreach($items_list_data as $list_item){
							//$user_c_item_list[] = $list_item['Itemlist']['lists'];
							echo '<li><input type="checkbox" name="category_items[]" value="'.$list_item['Itemlist']['lists'].'" />'.$list_item['Itemlist']['lists'].'</br></li>';
	                	
						}
						
						foreach($prnt_cat_data as $main_cat){
							echo '<li><input type="checkbox" name="category_items[]" value="'.$main_cat['Category']['category_name'].'" />'.$main_cat['Category']['category_name'].'</br></li>';
	                	}
						echo '<div class="appen_div" ></div>';
						?>
						
						</ul></div></fieldset></form>
						<fieldset class="new-list">
							<i class="ic-plus"></i>
							<input type="text" name="list_name" id="new-create-list" maxlength="40" placeholder="Create New List">
							<button type="submit" id="list_createid" class="btn-create">Create</button>
						</fieldset>
					<!--/form-->
				</div>
			</div>
			<div class="btn-area">
					<button type="button" class="btn-add-to-list btn-done" id="btn-doneid">Done</button>
					<!--button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button-->
					<a href="#" class="btn_set" style="float: right;"><span >Settings</span><div class="fancysettings"></div></a>
					<div class="set-dropdown">
						<ul>
							<li><a href="#" class="btn-unfancy">UnMarkit</a></li>
						</ul>
					</div>
				</div>
				<input type="hidden" id="passedFromItemId" value="" />
		</div>
		<div class="create-list" style="display:none">
			<p class="ltit">Create New List</p>
			<button class="close cancel" title="Close" ><i class="ic-del-black"></i></button>
			<form loid="">
			<fieldset>
				<div class="frm">
					<p><b class="stit">Title</b> <input type="text" name="list_name" class="right" placeholder="Enter a title"></p>
					
				</div>
				<div class="frm">
					<p>
						<b class="stit">Category</b>
						<select name="category_id" id="categories-for-new-list" class="right">
							<option value="0">Select category</option>
						</select>
					</p>
				</div>
				
				<div class="frm">
					<b class="stit">Contributors</b>
					<div class="right">
						<p>
							<input type="text" id="create-list-find-user" placeholder="Username or email address">
							<button class="btn-invite">Invite</button>
							<div class="comment-autocomplete">
								<ul>
									<script type="fancy/template">
										<li><img src="##image_url##" class="photo"><span class="username">##username##</span><span class="name">(##fullname##)</span></li>
									</script>
								</ul>
							</div>
							<input type="hidden" name="collaborators" id="create-list-collaborators" value="">
						</p>
						<ul class="user-list">
							<li>
								<img src="" alt="">
								<span class="left"><b></b></span>
								<span class="right">Creator</span>
							</li>
							<script type="fancy/template" id="tpl-invite-user-list">
								<li data-id="##id##"><img src="##image_url##"><span class="left"><b>##fullname##</b>##username##</span><span class="right"><a href="#"><i class="ic-del"></i><span class="hidden">Delete</span></a></span></li>
							</script>
						</ul>
					</div>
				</div>
			</fieldset>
			<div class="btn-area">
				<button type="submit" class="btn-create">Create list</button>
				<button type="button" class="cancel">Cancel</button>
			</div>
			</form>
		</div>
	</div>
	<!-- /add_to_list overlay -->
	
	
	<!--share-social-->
	<div id="share-social" class="popup ly-title share-new"  style="margin-top: 5px; margin-left: 414px; opacity: 1; display: none;">
		 
		<p class="ltit">
			<span class="share-thing">Share This Thing</span>
		</p>
		<div class="fig">
			<span class="thum"  style="width:100px;height:100px" ><img id="thum_img" src=""></span>
			<div class="fig-info">
				<span class="figcaption" id="figcaption_title_popup" > </span>
				<span class="username" ><b>$<span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
				<h4>dsasas</h4><p class="from">qq</p>
			</div>
			
			
			
			
			
		</div>
		<div class="share-via">
			<ul class="less">
			
			
				
				<li><a style="float: left; padding-right: 5px;" class='facebook' href="" alt="Share this on facebook"  title="Facebook"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
				<li><a style="float: left; padding-right: 5px;" class='twitter' href="" alt="Share this on twitter"   title="Twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
				<li><a style="float: left; padding-right: 5px;" class='google'  href="" alt="Share this on Google+"  title="Google +" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
	  			<li><a style="float: left; padding-right: 5px;" class='linkedin' href="" alt="Share this on linkedin"      title="Linkedin"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
	 			<li><a style="float: left; padding-right: 5px;" class='stumbleupon' href="" title="Stumbleupon"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
	 			<li><a class='tumblr' href=""  title="Tumblr" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
				
				
				
				
				
				<!--
				<li><a  href="http://www.facebook.com/sharer.php?s=100&p[title]='titlesssss'&p[summary]=' + encodeURIComponent('description here') + '&p[url]=' + encodeURIComponent('http://www.nufc.com') + '&p[images][0]='http://cf1.thingd.com/default/179335694966068439_d27b575231de.jpeg.small.jpeg')" >Fb Share</a> </li>
				
				-->
				
				
				
				
			</ul>
			<a href="#" class="show"><i class="arrow"></i></a>
		</div>
			
		<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		
		
	</div>
	<!--/share-social-->

	
	
	<!--share-user-profile-->
	<div id="share-user-profile" class="popup ly-title share-new"  style="margin-top: 160px; margin-left: 414px; opacity: 1; display: none;">
		 
		<p class="ltit">
			<span class="share-thing">Share <?php echo $usr_datas['User']['username']; ?>'s Profile</span>
		</p>
		<div class="share-via">
			<ul style="padding: 9px 25px;">
			
			
				
				<li><a style="float: left; padding-right: 5px;" class='facebook_usr' href="" alt="Share this on facebook"  title="Facebook"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
				<li><a style="float: left; padding-right: 5px;" class='twitter_usr' href="" alt="Share this on twitter"   title="Twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
				<li><a style="float: left; padding-right: 5px;" class='google_usr'  href="" alt="Share this on Google+"  title="Google +" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
	  			<li><a style="float: left; padding-right: 5px;" class='linkedin_usr' href="" alt="Share this on linkedin"      title="Linkedin"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
	 			<li><a style="float: left; padding-right: 5px;" class='stumbleupon_usr' href="" title="Stumbleupon"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
	 			<li><a class='tumblr_usr' href=""  title="Tumblr" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
				
			
				
			</ul>
			<a href="#" class="show"><i class="arrow"></i></a>
		</div>
			
		<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		
		
	</div>
	<!--/share-user-profile-->
	
		<!-- show profile -->
<div id="showprofile"  style="width:315px;" class="popup ly-title update add-to-list">

	<div class="default">
		<p class="ltit">Add Your Photos to this Shop</p>
		<button type="button" class="ly-close" id="btn-browses" style="margin-top:0px;"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<?php	//echo $this->Form->Create('update',array('url'=>array('controller'=>'/','action'=>'/update'))); ?>
  		
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image">
				<fieldset>
			
				<?php 				
					echo '<table border=200>';
					echo "<img id='show_shop_photo_url'  style='float: left;margin-left: 40px;margin-top: 20px;margin-bottom: 10px;width: 220px;height:220px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb350/usrimg.jpg'>";
					echo '</table>';
				?>
					</fieldset>
						</div>
			</div>
			<div class="section photo" style="margin-top:-30px;">
			<h3 class="stit"></h3>
			<fieldset class="frm">			
				<?php 				
				if(session_id() == '') {
					session_start();
				}
				$site = $_SESSION['site_url'];
				$media = $_SESSION['media_url'];
				@$username = @$_SESSION['media_server_username'];
				@$password = @$_SESSION['media_server_password']; 
				@$hostname = $_SESSION['media_host_name'];
				//$site = "http://localhost:9002/fancy/";
				echo "<div class='input-group' style='margin-top:10px;margin-left:10px;display:inline;text-align: center;'>";
						 
						echo '<div class="venueimg" style="padding-left:-100px;height:35px;"><iframe class="image_iframe" id="frame"  style="padding-left:30px;" name="frame" src="'.$this->webroot.'inshopphotos.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 90px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
							echo "<a href='javascript:void(0);' id='removeimg' class='glyphicons remove' style='display: none; margin-top: -30px; padding: 0px;' onclick='removeinshopusrimg(\" 1 \")'></a>";
						echo "</div>";
						
					?>
					</div>
					<hr size=2>
				<div id="loadderss" style="text-align: center; display: none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
				<div class="btn-area" style="float: right; margin-top: 10px; margin-right: 105px;" >
				<button class="btn-save" id="save_profile_image" onclick="inshopuseraddimage();" > Publish </button>
				<span class="checking" style="display:none" ><i class="ic-loading"></i></span>

				</fieldset>
				</div>
			

</form>
</div>
</div>
</div>
<!--  show profile -->
	
	
	</div>
	<!-- /popups -->
	
	
	<script>
	
	  $('#btn-browse').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"}); 
		$('#slideshow-box').hide();
		$('.btn-slideshow').removeClass('current');
    });
    
   
	
	$('#btn_close_share').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});
		$('#share-social').hide();
		$('.share-thing').hide();
		
    });

	
    var lat= "<?php echo  $usr_datas['Shop']['shop_latitude']; ?>";
    var longg = "<?php echo  $usr_datas['Shop']['shop_longitude']; ?>";
	if(lat !='' && longg !=''){
		window.load = sellerloc(lat,longg);
	}else{
		window.load = sellerloc(25.226736, 55.288925);
	}
	</script>
	<?php
if(!empty($loguser)){
	echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
}else{
	echo "<input type='hidden' id='loguserid' value='0' />";
}
echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
?>
<script type="text/javascript">
var sIndex = <?php echo $startIndex; ?>, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();var selectedtab = $('#selectedtab').val();
$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
		var baseurl = getBaseURL()+"getmoreprofile";
	    $(".LoaderImage").css("display", "block");

	    $.ajax({
	      type: "POST",
	      url: baseurl+'?startIndex=' + sIndex + '&offset=' + offSet + '&tab=' + selectedtab,
	      data: {},
	      beforeSend: function () {
	    	  $('#infscr-loading').show();
			},
		  dataType: 'html',
	      success: function (responce) {
	      	$('#infscr-loading').hide();
	      	if (responce != 'false') {
		      	if (selectedtab == 'added') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'fantacy') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'ownit') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'wantit') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'lists') {
			        $('.stream').append(responce);
		      	}else if (selectedtab == 'followers') {
			        $('.stream').append(responce);
		      	}else if (selectedtab == 'following') {
			        $('.stream').append(responce);
		      	}
	        }else {
	            isDataAvailable = false;
			}
	        sIndex = sIndex + offSet;
	        isPreviousEventComplete = true;
	      }
	    });

	  }
	 }
	 });
</script>

