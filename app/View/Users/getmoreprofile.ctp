<?php 
if ($tab == 'added') {
	if (!empty($item_datas)){
		foreach($item_datas as $ky=>$itemsd){
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
}elseif($tab == 'fantacy'){
	if(!empty($itematas)){
		foreach($itematas as $ky=>$itemsd){
	
			echo '<div class="figure-product figure-200 productalign">
				<a title="'.$itemsd['Item']['item_title'].'" id="img_id'.$itemsd['Item']['id'].'" href="'.SITE_URL.'listing/'.$itemsd['Item']['id'].'/'.$itemsd['Item']['item_title_url'].'?ref=shop_home_active">
					<figure>
						<span class="wrapper-fig-image"><span class="fig-image" style="width: 184px;"><img alt="'.$itemsd['Item']['item_title'].'" src="'.$_SESSION['media_url'].'media/items/thumb350/'.$itemsd['Photo'][0]['image_name'].'"></span></span>
						<figcaption>'.UrlfriendlyComponent::limit_text($itemsd['Item']['item_title'],2).'</figcaption>
					</figure>
				</a>
				<br class="hidden">';
			$shpnme = $itemsd['User']['username']; 
				$shpnme_url = $itemsd['User']['username_url'];
				echo '<span class="username">';
				echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/people/'.$shpnme_url));
				echo '</span>
				<br class="hidden">';
			    //<!--a href="#" class="button fantacy" tid="265732549" ><span><i></i></span>Liked</a-->
				
			foreach($itemsd['Itemfav'] as $useritemfav){
				if($useritemfav['user_id'] == $userid ){
					$usecoun[] = $useritemfav['item_id'];
				}
			}
			
//			if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
//			echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//			}else{
//			echo  '<a class="button fantacy" style = "left:52%;" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" ><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itemsd['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//			}
            if(isset($usecoun) &&  in_array($itemsd['Item']['id'],$usecoun)){
	        echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itemsd['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
	        echo  '<a class="button fantacyd edit" iteid="'.$itemsd['Item']['id'].'" onclick = "share_post('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itemsd['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
	        }else{
	        echo  '<a class="button fantacy" onclick = "itemcou('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itemsd['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
	        echo  '<a class="button fantacy" onclick = "share_post('.$itemsd['Item']['id'].');"  id="dd'.$itemsd['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itemsd['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
	        }
			echo '</div>';
			
		}
	}else{
		//echo "false";
	}
}elseif($tab == 'wantit'){
	if(!empty($wantItemModel)){
		foreach($wantItemModel as $ky=>$itemsd){ 
			echo '<div class="figure-product figure-200"  id="wantit_'.$itemsd['Item']['id'].'" >
				<a title="'.$itemsd['Item']['item_title'].'" href="'.SITE_URL.'listing/'.$itemsd['Item']['id'].'/'.$itemsd['Item']['item_title_url'].'?ref=shop_home_active">
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
				if($itemsd['Item']['status']=='things') {
					//echo "<pre>";print_r($itemsd['I'.]['id']);die;
				echo '<input type="hidden" id="deli" value="'.$itemsd['Item']['id'].' >'; 
					if($userid == $usr_datas['User']['id']){
						echo '<button class="delete-comment" onclick = "return wantit('.$itemsd['Item']['id'].')" >Delete</button>';
					}
				}
			echo '</div>';
		}
	}else{
		//echo "false";
	}
}elseif($tab == 'ownit'){
	if(!empty($ownItemModel)){
		foreach($ownItemModel as $ky=>$itemsd){ 
			echo '<div class="figure-product figure-200"  id="wantit_'.$itemsd['Item']['id'].'" >
				<a title="'.$itemsd['Item']['item_title'].'" href="'.SITE_URL.'listing/'.$itemsd['Item']['id'].'/'.$itemsd['Item']['item_title_url'].'?ref=shop_home_active">
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
				if($itemsd['Item']['status']=='things') {
					//echo "<pre>";print_r($itemsd['I'.]['id']);die;
				echo '<input type="hidden" id="deli" value="'.$itemsd['Item']['id'].' >'; 
					if($userid == $usr_datas['User']['id']){
						echo '<button class="delete-comment" onclick = "return wantit('.$itemsd['Item']['id'].')" >Delete</button>';
					}
				}
			echo '</div>';
		}
	}else{
		//echo "false";
	}
}elseif($tab == 'lists'){
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
	         	echo '</li>';
	   }
	 }else{
		//echo "false";
	}
}elseif($tab == 'followers'){
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
		//echo "false";
	}
}elseif($tab == 'following'){
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
		//echo "false";
	}
}
