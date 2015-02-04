<?php 
if (count($items_data) != 0) {
 		foreach($items_data as $key=>$itms){
 			$usercmntcount='';
 			$itm_id = $itms['Item']['id'];
 			$user_id = $itms['Item']['user_id'];
 			$item_title_url = $itms['Item']['item_title_url'];
 			$item_title = $itms['Item']['item_title'];
 			$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
 			if(isset($itms['Photo'][0])){
 				$image_name = $itms['Photo'][0]['image_name'];
 			}
 			$username_url = $itms['User']['profile_image'];
 			$username = $itms['User']['username'];
 			$username_urlss = $itms['User']['username_url'];
 			$favorte_count = $itms['Item']['fav_count'];
 			$shop_address = $itms['Shop']['shop_address'];
 	
 			//$cdate = $itms['Item']['created_on'];
 			//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
 			$item_titletwo = UrlfriendlyComponent::limit_char($item_title,16);
 	
 			echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="big" >';
 			echo  '<div class="figure-item">';
 	
 	
 	
 			//list($width, $height) = getimagesize($_SESSION['media_url']."media/items/thumb350/".$image_name);
 			//$countuser = 1;
 			//}
 	
 			$mediaul = trim($_SESSION['media_url']);
 			$border = "";
 			list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
 			list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
 			echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
 			echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
 			echo  '<span class="figure classic">';
 			echo  '<em class="back"></em>';
 			if ($height_ori < 640){
 				$border = "border-radius:0;";
 			}
 			echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='background:#F9F9F9;".$border."' >";
 			echo  '</span>';
 			echo  '<span class="figure vertical">';
 			echo  '<em class="back"></em>';
 			echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#F9F9F9;' data-height=".$height." data-width=".$width.">";
 			echo  '</span>';
 			echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
 			echo  '</a>';
 			echo  '<em class="figure-detail">';
 			echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
 			echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."people/".$username_urlss.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"></a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
 			echo  '</em>';
 	
 			echo '<ul class="function">';
 			echo '<li class="share shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share btnforlike  glyphicons share" style="padding: 3px 0px;" ><span class="shareimg123"></span></a></li>';
 			/* if(!empty($usercmntcount)){
 			 $cmnt = " ".count($usercmntcount);
 			}else{
 			$cmnt = " 0";
 			}
 			echo '<span class="comment shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons comments btnforlike" style="padding: 3px 4px; width: auto;">'.$cmnt.'</span></span>';
 			echo '<span class="fantcyHeart heartli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons heart btnforlike" style="padding: 3px 4px; width: auto;"> '.$favorte_count.'</span></span>';
 			*/
 			echo '</ul>';
 	
 	
 			foreach($itms['Itemfav'] as $useritemfav){
 				if($useritemfav['user_id'] == $userid ){
 					$usecoun[] = $useritemfav['item_id'];
 				}
 			}
 	
 			/* foreach($itms['Comment'] as $usrcmnts){
 				$usercmntcount[] = $usrcmnts['id'];
 			} */
 	
// 			if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) &&  in_array($itm_id,$usecoun)){
// 				echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//			}else{
// 				echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//			}
 			if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) &&  in_array($itm_id,$usecoun)){
	        echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
	        echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
	        }else{
	        echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
	        echo  '<a class="button fantacy" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
	        }

 	
 			echo "<div class='userimagesthirtyfive'>";
 			if(!empty($username_url)){
 				echo  "<a href='".SITE_URL."people/".$username_urlss."' class='userv vcard'>
 				<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
 				<i class='arrow-sml' style='margin-top: 17px;'>$username</i>
 				<br />
 	
 				</a>";
 				//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
 			}else{
 	
 				echo  "<a href='".SITE_URL."people/".$username_urlss."' class='userv vcard '>
 				<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."'>
 				<i class='arrow-sml' style='margin-top: 17px;'>$username </i>
 				<br />
 				</a>";
 				}
 				echo  "<div style='text-align:left;'><a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm' >".$item_titletwo.'  <b>'.$_SESSION['currency_symbol'].$item_price."</b> </a></div>";
 				echo  '</div>';
 	
 	
 				echo  '</div>';
 				echo  '</li>';
 	
 		}
 } else {
 		echo 'false';
 }
