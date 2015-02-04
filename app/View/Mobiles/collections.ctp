
<?php
error_reporting(0);
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

		<div class="wrapper-content profile-content">
		<?php 
					//echo "<pre>";print_r($itematas);
					//print_r($itematas);
					
						$selectedTab = 'fantacy';
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
						echo '<div style="height:200px">';
						echo '<center style="font-size:23px;margin-top:100px;">No items found</center>';
						echo '<center style="font-size:14px;"> Add something favorite</li> </center> ';
						echo '</div>';
					}
					
		
		
		?>		
		
		

		
			
		
			
			<div id="infscr-loading" style="display:none;text-align:center;">
				<!--img alt="Loading..." src="<?php echo SITE_URL; ?>img/loading.gif"-->
			</div>
	
	
	
	<?php 
	if(empty($userid)){
		echo "<input type='hidden' id='gstid' value='0' />";
	}else{
		echo "<input type='hidden' id='gstid' value='".$userid."' />";
	}
	echo "<input type='hidden' id='selectedtab' value='".$selectedTab."' />";
		
		?>
		
		
		<!--footer id="footer">
		<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
		<hr>
		<ul class="footer-nav">
			<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
			<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
			<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
		</ul-->
		<!-- / footer-nav -->
	<!--/footer-->
		
		
					
		</div>
		
	</div>
		
		
		
<?php		
				
echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
	
?>
		

	


<script type="text/javascript">
var sIndex = <?php echo $startIndex; ?>, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();var selectedtab = $('#selectedtab').val();
window.onscroll = (function (event)  {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
		var baseurl = getBaseURL()+"mobile/getmoreprofile";
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
			        $('.profile-content').append(responce).trigger('create');
		      	}else if (selectedtab == 'fantacy') {
			        $('.profile-content').append(responce).trigger('create');
		      	}else if (selectedtab == 'ownit') {
			        $('.profile-content').append(responce).trigger('create');
		      	}else if (selectedtab == 'wantit') {
			        $('.profile-content').append(responce).trigger('create');
		      	}else if (selectedtab == 'lists') {
			        $('.stream').append(responce.trigger('create'));
		      	}else if (selectedtab == 'followers') {
			        $('.stream').append(responce).trigger('create');
		      	}else if (selectedtab == 'following') {
			        $('.stream').append(responce).trigger('create');
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
