<?php 
if ($tab == 'added') {
	if (!empty($item_datas)){
		foreach($item_datas as $ky=>$itms){
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
				
				$username_url_ori = $itms['User']['username_url'];
				$favorte_count = $itms['Item']['fav_count'];
				$comment_count = $itms['Item']['comment_count'];
				$shop_address = $itms['Shop']['shop_address'];
				//$cdate = $itms['Item']['created_on'];
				//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
				$item_titletwo = UrlfriendlyComponent::limit_char($item_title,16);
				echo "<div class='ui-body ui-body-a' style='border-radius:5px;margin-top:15px;'>";
				echo  '<li imgid="'.$image_name.'"  class="big" style="list-style:none;margin-top:5px;">'; 
				
				
					echo "<div class='userimagesthirtyfive'>";
					//echo '<div style="with:98%!important;padding:5px;height:45px;"><div style="width:70%;float:left;">';
			if(!empty($username_url)){
					
					echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."width:50px;height:50px;'></a>
					<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
						
					</a>";
					//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
				}else{
					
					echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."width:50px;height:50px;'></a>
					<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
					</a>";
					}
					echo  "<a data-ajax='false' style='text-decoration:none;margin-top:-50px;font-weight: bold ! important;float:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;position: relative; left:60px;color: #373D48;width:120px;font-size:15px;' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm'>".$item_titletwo."</a>";
					//echo '</div> <div style="width:28%;float:left;">';
					echo "<div style='font-weight:bold;margin-top:-40px;float:right;'>
                            <b style='color:#969696!important;'> ".$_SESSION['currency_symbol'].$item_price."</b></div>";
					//echo '</div></div>';
					echo  '</div>';
					
				
				
				echo  '<div class="figure-item" style="margin-top:5px;background:#FBFCFC">';
				
				
				$mediaul = trim($_SESSION['media_url']);
				$border = "";
				list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
				list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
				//list($width, $height) = getimagesize($_SESSION['media_url']."media/items/thumb350/".$image_name);
				echo  "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				//echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
				//echo  '<span class="figure classic">';
				//echo  '<em class="back"></em>';
				if ($height_ori < 640){
					$border = "border-radius:0;";
				}
				//echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='background:#F9F9F9;".$border."' >";
				//echo  '</span>';
				//echo  '<span class="figure vertical">';
				//echo  '<em class="back"></em>';
				echo  "<center><img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#FBFCFC;' data-height=".$height." data-width=".$width."></center>";
				//echo  '</span>';
				//echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '</a>';
				//echo  '<em class="figure-detail back">';
				//echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
				//echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."mobile/people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"> </a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
				//echo  '</em>';
				
				foreach($itms['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				$comment_count = 0;
				foreach($itms['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];		
					$comment_count++;		
				}
				echo '<div style="margin-top:-15px;">
				<div style="width:70%;float:left;height:20px;">';
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacydbtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacyd.png" style="margin: -1px;margin-left:-8px;"></span> 
    <span style="margin-left:2px;top:-2px;position:relative;color:#188EE6;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'">
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacy.png" style="margin: -1px;margin-left:-8px;"></span>
     <span style="margin-left:2px;top:-2px;position:relative;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span>
     <input type="hidden" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'">
     </span></a>';
				}
				echo '</div> <div style="width:28%;float:left;text-align:right;">';
				echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				echo '<span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" style="margin-right:-5px;float:right;margin-top:20px;">
				<span style="position: relative;float: right;margin-top:5px;" class="comment">
				<div style="width:auto;border:1px solid #D5D9DC;border-radius:5px;height:26px; !important;float:left;">
				<img src="'.SITE_URL.'images/menu/chat.png" style="margin-top:5px;">
				 <span style="color:#707070!important;margin-right:4px;top:-2px;position:relative;">'.$comment_count.'</span></div></span></span>';
				echo "</a>";
							
				echo  '</div>';
			echo  '</li></div>';
		}
	}else{
		echo "false";
	}
}elseif($tab == 'fantacy'){
	if(!empty($itematas)){
		foreach($itematas as $ky=>$itms){
	
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
				
				$username_url_ori = $itms['User']['username_url'];
				$favorte_count = $itms['Item']['fav_count'];
				$comment_count = $itms['Item']['comment_count'];
				$shop_address = $itms['Shop']['shop_address'];
				//$cdate = $itms['Item']['created_on'];
				//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
				$item_titletwo = UrlfriendlyComponent::limit_char($item_title,16);
				echo "<br /><div class='ui-body ui-body-a' style='border-radius:5px;'>";
				echo  '<li imgid="'.$image_name.'"  class="big" style="list-style:none;margin-top:5px;">'; 
				
				
					echo "<div class='userimagesthirtyfive'>";
					//echo '<div style="with:98%!important;padding:5px;height:45px;"><div style="width:70%;float:left;">';
			if(!empty($username_url)){
					
					echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."width:50px;height:50px;'></a>
					<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
						
					</a>";
					//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
				}else{
					
					echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."width:50px;height:50px;'></a>
					<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
					</a>";
					}
					echo  "<a data-ajax='false' style='text-decoration:none;margin-top:-50px;font-weight: bold ! important;float:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;position: relative; left:60px;color: #373D48;width:120px;font-size:15px;' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm'>".$item_titletwo."</a>";
					//echo '</div> <div style="width:28%;float:left;">';
					echo "<div style='font-weight:bold;margin-top:-40px;float:right;'>
                            <b style='color:#969696!important;'> ".$_SESSION['currency_symbol'].$item_price."</b></div>";
					//echo '</div></div>';
					echo  '</div>';
					
				
				
				echo  '<div class="figure-item" style="margin-top:5px;background:#FBFCFC">';
				
				
				$mediaul = trim($_SESSION['media_url']);
				$border = "";
				list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
				list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
				//list($width, $height) = getimagesize($_SESSION['media_url']."media/items/thumb350/".$image_name);
				echo  "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				//echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
				//echo  '<span class="figure classic">';
				//echo  '<em class="back"></em>';
				if ($height_ori < 640){
					$border = "border-radius:0;";
				}
				//echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='background:#F9F9F9;".$border."' >";
				//echo  '</span>';
				//echo  '<span class="figure vertical">';
				//echo  '<em class="back"></em>';
				echo  "<center><img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#FBFCFC;' data-height=".$height." data-width=".$width."></center>";
				//echo  '</span>';
				//echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '</a>';
				//echo  '<em class="figure-detail back">';
				//echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
				//echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."mobile/people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"> </a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
				//echo  '</em>';
				
				foreach($itms['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				
				$comment_count = 0;
				foreach($itms['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];		
					$comment_count++;		
				}
				echo '<div style="margin-top:-15px;">
				<div style="width:70%;float:left;height:20px;">';
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacydbtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacyd.png" style="margin: -1px;margin-left:-8px;"></span> 
    <span style="margin-left:2px;top:-2px;position:relative;color:#188EE6;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'">
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacy.png" style="margin: -1px;margin-left:-8px;"></span>
     <span style="margin-left:2px;top:-2px;position:relative;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span>
     <input type="hidden" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'">
     </span></a>';
				}
				echo '</div> <div style="width:28%;float:left;text-align:right;">';
				echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				echo '<span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" style="margin-right:-5px;float:right;margin-top:20px;">
				<span style="position: relative;float: right;margin-top:5px;" class="comment">
				<div style="width:auto;border:1px solid #D5D9DC;border-radius:5px;height:26px; !important;float:left;">
				<img src="'.SITE_URL.'images/menu/chat.png" style="margin-top:5px;">
				 <span style="color:#707070!important;margin-right:4px;top:-2px;position:relative;">'.$comment_count.'</span></div></span></span>';
				echo "</a>";
							
				echo  '</div>';
			echo  '</li></div>';
			
		}
	}else{
		echo "false";
	}
}elseif($tab == 'wantit'){
	if(!empty($wantItemModel)){
		foreach($wantItemModel as $ky=>$itemsd){ 
			echo '<div class="figure-product figure-200"  id="wantit_'.$itemsd['Item']['id'].'" >
				<a title="'.$itemsd['Item']['item_title'].'" href="'.SITE_URL.'mobile/listing/'.$itemsd['Item']['id'].'/'.$itemsd['Item']['item_title_url'].'?ref=shop_home_active">
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
		echo "false";
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
		echo "false";
	}
}elseif($tab == 'lists'){
	if(!empty($itemListsAll)){
		foreach($itemListsAll as $key => $list){
$lists_name = $list['Itemlist']['lists'];
					$lists_nameurl = urlencode($lists_name);
						echo '<div class="ui-body ui-body-a" style="border-radius:5px;">';
						echo "<li class='stream-item' style='padding:0;list-style:none;'>";
					
          	
          			echo "<div class='peopleheaders'>";
			          	if(!empty($user_imges)){
			          		echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."'  style='height: 40px; width: 40px; padding: 7px;".$roundProf."' class='prof_img' />";
			          	}else{
			          		echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'  style='height: 40px; width: 40px; padding: 7px;".$roundProf."' class='prof_img' />";
			          	}
	          			echo "<a data-ajax='false' href='".SITE_URL."mobile/user_lists/".$lists_nameurl.'/'.$usr_datas['User']['id']."'   style='position: relative; top: -20px;text-decoration:none;color:#373D48;font-size:15px;'><strong class='nickname'>$lists_name</strong></a>";
          		
					echo '</div>';
					echo '<div class="things">';
						$list_itemides = json_decode($list['Itemlist']['list_item_id']);
						$count = 0;
						$index = 1;
						//print_r($itemdatasall);
						echo '<table width="100%"><thead><tr><th colspan="3"></th></tr></thead>
						<tbody><tr>';
						foreach($itemdatasall as $key=>$itemsd){
						echo '<td>';
							$id = $itemsd['Item']['id'];
							$itemNamee = $itemsd['Item']['item_title_url'];
							//if((isset($list_itemides)) && in_array($itemsd['Item']['id'],$list_itemides) && $count<8){
							if((isset($list_itemides)) && $count<8){
							echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$id."/".$itemNamee."' >"; ?>
							 <img alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb70/<?php echo $itemsd['Photo'][0]['image_name']; ?>" title="<?php echo $itemsd['Item']['item_title'] ;?>" style="width:70px;height:70px;"> 
							 				<?php
							echo "<div style='background:url(\"".$_SESSION['media_url']."media/items/thumb150/".$itemsd['Photo'][0]['image_name']."\") no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);margin: 10px 6px 10px 7px;'></div>";
							 echo "</a></td>";
								$count++;
								
							}
										if($index%3==0)
								echo '</tr><tr>';
								$index++;
									
							}
								echo '</tr></tbody></table>';
			  		echo '</div>';
			  		echo '</div>';
	         	echo '</li><br />';
	   }
	 }else{
		echo "false";
	}
}elseif($tab == 'followers'){
					 	if(!empty($people_details)){
						foreach($people_details as $key => $ppls){
						echo '<div class="ui-body ui-body-a" style="border-radius:5px;margin-top:-5px;">';
						echo "<li class='stream-item'  style='margin:-20px -20px -47px -7px;list-style:none;position:relative;bottom:-15px;'>";
         				echo "<div class='peopleheaders'>";
						//if(!empty($ppls['Itemfav'])){
						//echo "<pre>";print_r($ppls);
						$user_nam = $ppls['User']['username'];
						$user_nam_url = $ppls['User']['username_url'];
						$user_first = $ppls['User']['first_name'];
						$user_imges = $ppls['User']['profile_image']; 
						echo '<table style="width:100%;height:100%;"><thead><tr><th coslpan="2"></th></tr></thead><tbody><tr><td>';
					$user_first = UrlfriendlyComponent::limit_char($user_first,10);
					$user_nam = UrlfriendlyComponent::limit_char($user_nam,10);					
						if(!empty($user_imges)){
							echo "<a data-ajax='false' href='".SITE_URL."mobile/people/".$user_nam_url."' style='float:none;text-decoration:none;color:#000000;font-size:13px;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px;  margin-top:-5px;".$roundProf."' /><strong class='nickname' style='position:absolute;margin-left:10px;'>$user_first<br /><span style='font-weight:normal;'>@$user_nam</span></strong></a>";
								
						}else{
							echo "<a data-ajax='false' href='".SITE_URL."mobile/people/".$user_nam_url."' style='float:none;text-decoration:none;color:#000000;font-size:13px;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px;  margin-top:-5px;".$roundProf."' /><strong class='nickname' style='position:absolute;margin-left:10px;'>$user_first<br /><span style='font-weight:normal;'>@$user_nam</span></strong></a>";
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
					echo '</td><td align="right">';				
					if($flw){
					echo "<span class='follow' id='foll".$ppls['User']['id']."'>";
					echo '<button type="button" style="width:100px;height:35px;left:-10px;top:-5px;" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button style="background:#339EF0;color:#FFFFFF;text-shadow:none;width:100px;height:35px;left:-10px;top:-5px;" type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
				} 
						
						 
				//echo '<a href="#follow" class="follow-user-link" uid="'.$user_nam.'">Follow</a>';
				echo '</td></tr></table><br /><br />';
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
			
			} /*else{
				echo '<div style="height:200px">';
				echo '<center style="font-size:23px;margin-top:100px;">No body follows  </center>';
				echo '<center style="font-size:14px;"> ask  someone to follow</li> </center> ';
				echo '</div>';
			} */
			
			echo '</li></div><br/>';
		}
	}else{
		//echo "false";
	}
}elseif($tab == 'following'){
	if(!empty($people_details_for_following)){
	
	//echo "<pre>";print_r($people_details_for_following);die;
					foreach($people_details_for_following as $key => $ppls){
						echo '<div class="ui-body ui-body-a" style="border-radius:5px;margin-top:-5px;">';
						echo "<li class='stream-item'  style='margin:-20px -20px -40px -7px;list-style:none;position:relative;bottom:-15px;'>";
						
						echo "<div class='peopleheaders'>";
					//	echo "<pre>";print_r($people_details_for_following);die;
					$user_nam = $ppls['User']['username'];
					$user_nam_url = $ppls['User']['username_url'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 
					echo '<table style="width:100%;height:100%;"><thead><tr><th coslpan="2"></th></tr></thead><tbody><tr><td>';
					$user_first = UrlfriendlyComponent::limit_char($user_first,10);
					$user_nam = UrlfriendlyComponent::limit_char($user_nam,10);						
			       if(!empty($user_imges)){
						echo "<a data-ajax='false' href='".SITE_URL."mobile/people/".$user_nam_url."' style='float:none;text-decoration:none;color:#000000;font-size:13px;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px; margin-top:-5px;".$roundProf."' /><strong class='nickname' style='position:absolute;margin-left:10px;'>$user_first<br /><span style='font-weight:normal;'>@$user_nam</span></strong></a>";
					}else{
						echo "<a data-ajax='false' href='".SITE_URL."mobile/people/".$user_nam_url."' style='float:none;text-decoration:none;color:#000000;font-size:13px;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px; margin-top:-5px;".$roundProf."' /><strong class='nickname' style='position:absolute;margin-left:10px;'>$user_first<br /><span style='font-weight:normal;'>@$user_nam</span></strong></a>";
					}
					 
				echo '</td><td align="right">';
				
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
					echo '<button type="button" style="width:100px;height:35px;left:-10px;top:-7px;" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button style="background:#339EF0;color:#FFFFFF;text-shadow:none;width:100px;height:35px;left:-10px;top:-7px;" type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
				} 
					 
				echo '</td></tr></table><br /><br />';
				echo '</div>';
				/*echo '<div class="things">';
				
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
					
					echo '</div>';*/
					echo '</li>
					</div><br />';
				
				}
	
	}else{
		//echo "false";
	}
}
