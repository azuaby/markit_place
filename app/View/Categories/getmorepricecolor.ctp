<?php 
if(!empty($itemByColor)){
	foreach($itemByColor as $itms){
		$itm_id = $itms['Item']['id'];
		$item_title_url = $itms['Item']['item_title_url'];
		$item_title = $itms['Item']['item_title'];
		$image_name = $itms['Photo'][0]['image_name'];
		$favorte_count = $itms['Item']['fav_count'];
		$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
		$username = $itms['User']['username'];
		$username_url_ori = $itms['User']['username_url'];
		$username_url = $itms['User']['profile_image'];
		if($username_url == ''){
			$username_url = 'usrimg.jpg';
		}
		
		$item_title = UrlfriendlyComponent::limit_char($item_title,12);
		 


		echo  '<li imgid="'.$image_name.'" >';
		
		echo  '<div class="figure-product-new mini boxradius">';
		
	
		
		echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
		//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
		
		echo "<figure>";
		echo '<span class="back"></span>';
		$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
		echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
		//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
		echo "</figure>";
		echo  '</a>';

		echo  '<em class="figure-detail">';
		echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
		<img style='width: 35px; height: 35px; position: relative; top: 8px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
		<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 24px; left: 52px;'>$username + $favorte_count</i>
		</a>";
		echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="top: -14px; position: relative; left: 4px;" >'.$item_title.'</span>';
		echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="top: -14px; position: relative; left: 4px;"><b> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
		//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
		echo  '</em>';
		
		
		echo '<ul class="function">';
		echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
		echo '</ul>';
		
		foreach($itms['Itemfav'] as $useritemfav){
			if($useritemfav['user_id'] == $userid ){
				$usecoun[] = $useritemfav['item_id'];
			}
		}
//		if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
//		echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//		}else{
//		echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//		}
		
        if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
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
		
		echo  '</div>';
		echo  '</li>';
	} 
				
}else{
	//echo 'false';
}
