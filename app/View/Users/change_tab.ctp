<?php
$roundProf = "";
if ($profileImgStyle == "round") {
	$roundProf = "border-radius:40px;";
}
if(!empty($itemDetails)){
	$out = '';
	$id = 1;
	foreach($itemDetails as $key=>$itms){
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
		
		//$cdate = $itms['Item']['created_on'];
		//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
		$shop_address = $itms['Shop']['shop_address'];
		$item_titletwo = UrlfriendlyComponent::limit_text($item_title,1);
	    if ($id == 1) {
		    $out .=  '<li id="s-f_" imgid="'.$image_name.'" auserid="'.$user_id.'" class="big" >';
		    $id = 0; 
	    } else {
		    $out .=  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="big" >';
	    }
		$out .=  '<div class="figure-item">';
		$mediaul = trim($_SESSION['media_url']);
		list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
		$out .=   "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
		$out .=   "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
		$out .=   '<span class="figure classic">';
		$out .=   '<em class="back"></em>';
		$out .=   "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' >";
		$out .=   '</span>';
		$out .=   '<span class="figure vertical">';
		$out .=   '<em class="back"></em>';
		$out .=   "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#cdcdcd;' data-height=".$height." data-width=".$width." >";
		$out .=   '</span>';
		$out .=   '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
		$out .=   '</a>';
		$out .=   '<em class="figure-detail">';
		$out .=   '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" >  </span>';
		$out .=   '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"></a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
		$out .=   '</em>';
		
		/* $out .=  '<ul class="function">';
		$out .=  '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
		$out .=  '</ul>'; */
		
		$out .=  '<ul class="function">';
		$out .=  '<li class="share shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share btnforlike  glyphicons share" style="padding: 3px 0px;" ><span class="shareimg123"></span></a></li>';
		/* if(!empty($usercmntcount)){
		 $cmnt = " ".count($usercmntcount);
		}else{
		$cmnt = " 0";
		}
		echo '<span class="comment shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons comments btnforlike" style="padding: 3px 4px; width: auto;">'.$cmnt.'</span></span>';
		echo '<span class="fantcyHeart heartli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons heart btnforlike" style="padding: 3px 4px; width: auto;"> '.$favorte_count.'</span></span>';
		*/
		$out .=  '</ul>';
		
		foreach($itms['Itemfav'] as $useritemfav){
			if($useritemfav['user_id'] == $userid ){
				$usecoun[] = $useritemfav['item_id'];
			}
		}
		
		foreach($itms['Comment'] as $usrcmnts){
			$usercmntcount[] = $usrcmnts['id'];
		}
		
//			if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
//			$out .=   '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//			}else{
//			$out .=   '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//			}
        if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
        $out .=  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
        $out .= $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
        $out .= '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
        $out .= '<input type="hidden" value="1" name="quantity" id="qty_opt">';
        $out .= '<button type="submit" class="button fantacyd edit" style="margin-left: -27px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
        $out .=  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
        }else{
        $out .=  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
        $out .= $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
        $out .= '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
        $out .= '<input type="hidden" value="1" name="quantity" id="qty_opt">';
        $out .= '<button type="submit" class="button fantacyd edit" style="margin-left: -28px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
        $out .=  '<a class="button fantacy" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
        }
		
			
		//$out .=   "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' style='color:#000000;' class='titleforitm'>".$item_titletwo.' | '.$item_price." USD </a>";
			
		
		
		/* $out .=    "<div class='favcountandcmmnt'>";
		$out .=     "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm' >";
		
		if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
			$out .= "<div class='favcountandcmmntimgleft glyphicons heart' > ";
		}else{
			$out .= "<div class='favcountandcmmntimgleft glyphicons heart_empty' > ";
		}
		
		
		//$out .=    "<div class='favcountandcmmntimgleft' >";
		//$out .=     "<img src='".$_SESSION['media_url']."images/fantacylikimg.png' > &nbsp;";
		$out .=    $favorte_count." &nbsp;";
		$out .=    "</div>";
		$out .=  "<div class='favcountandcmmntimgright glyphicons comments' > ";
		//$out .=    "<div class='favcountandcmmntimgright' >";
		//$out .=     "<img src='".$_SESSION['media_url']."images/fantacycmtimg.png'> &nbsp;";
		if(!empty($usercmntcount)){
			$out .=    count($usercmntcount)." &nbsp;";
		}else{
			$out .=    "0 &nbsp;";
		}
		$out .=    "</div>";
		$out .=    "</a>";
		$out .=     '</div>'; */
		
		
		$out .=  "<div class='userimagesthirtyfive'>";
		if(!empty($username_url)){
			$out .=  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
				<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
				<i class='arrow-sml' style='margin-top: 15px;'>$username + $favorte_count</i>
				<br />					
				</a>";
		}else{
			$out .=  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
				<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."'>
				<i class='arrow-sml' style='margin-top: 15px;'>$username + $favorte_count</i>
				<br />
				<!--i class='cdate-arr'>$shop_address</i-->
				</a>";
		}
		$out .=  "<div style='text-align:left;'><a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm'>".$item_titletwo.'  <b>'.$_SESSION['currency_symbol'].$item_price." </b> </a></div>";
		$out .=     '</div>';
		$out .=     '</div>';
		$out .=   '</li>';
	}	
}else{
	$out .= "<center>No Items Found</center>";
}
$output[] = $out;
$output[] = $followid;

echo json_encode($output);
			
			
