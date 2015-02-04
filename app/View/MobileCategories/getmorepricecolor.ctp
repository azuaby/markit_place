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
		 

		echo '<div class="ui-body ui-body-a">';
		echo  '<li imgid="'.$image_name.'" style="list-style:none;">';
		
		echo  '<div class="figure-product-new mini boxradius">';
		
	
		echo '<div style="with:98%!important;padding:5px;height:45px;">
				<div style="width:70%;float:left;">';
					echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;'>
		<img style='width: 35px; height: 35px; position: relative; top: 8px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>";
		echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" 
		style="top: -14px; position: relative; left: 4px;font-weight: bold ! important;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;position: relative; left:8px;color: #373D48;width:120px;font-size:15px;"  >'.$item_title.'</span>';
		echo "<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 24px; left: 52px;display:none;'>$username</i>
		</a>";
		echo '</div> <div style="width:28%;float:left;text-align:right;">';
		echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="font-weight:bold;margin-top:5px;">
		<b style="color:#969696!important;"> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
		echo '</div></div>';
		echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
		//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
		
		echo "<figure>";
		echo '<span class="back"></span>';
		$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
		echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: auto;overflow:hidden;"></span>';
		echo  "<center><img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></center>";
		echo "</figure>";
		echo  '</a>';

		echo  '<em class="figure-detail">';
	
		//echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="top: -14px; position: relative; left: 4px;" >'.$item_title.'</span>';
		
		//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
		echo  '</em>';
		
		
		
		
		foreach($itms['Itemfav'] as $useritemfav){
			if($useritemfav['user_id'] == $userid ){
				$usecoun[] = $useritemfav['item_id'];
			}
		}
		echo '<div>
				<div style="width:70%;float:left;">';
		if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <span class="ui-body ui-body-a" style="width:85px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img border="1" src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: -4px;"></span> 
    <span style="margin-left:4px;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <span class="ui-body ui-body-a" style="width:85px;"><span id="spandd'.$itms['Item']['id'].'">
    <img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: -4px;"></span>
     <span style="margin-left:4px;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span>
     <input type="hidden" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'">
     </span></a>';
				}
		echo '</div></div>';
		echo  '</div>';
		echo  '</li></div><br />';
	} 
				
}else{
	echo 'false';
}