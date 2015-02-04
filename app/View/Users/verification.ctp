<!-- popups -->
<div id="popup_container" class="headpopupp" style="display: block; opacity: 0.85;">

<div class="popup create-group-gifts" id="WelcomePop" style="display: block; margin-top: 40px;">
    <h2 class="tit"> WELCOME TO FANTACY </h2>
     <div class="cheptp1" style="text-align: center;">
		<img src="<?php echo SITE_URL; ?>images/welcome-banner.PNG" style="width: 400px; height: 380px;">
		<div style="font-weight: bold; font-size: 18px;" > Welcome to Markit !!! </div>
		<div style="font-weight: normal; font-size: 13px;"> Thanks for activating your account.Exciting shopping experience is awaitng for you. </div>
		<div style="border-bottom: 1px solid rgb(235, 236, 239); padding: 3px 7px 10px;"></div>
		
		<div style="margin-left: 760px; margin-top: 10px; padding-bottom: 10px;"><a href="javascript:void(0);" onclick="openselectcate();" class="btns-blue-embo">Next</a></div>
	</div>	
    
</div>

<div class="popup create-group-gifts" id="selecttCate" style="display: none; margin-top: 40px;">
    <h2 class="tit"> Tell us what you love </h2>
     <div class="cheptp2" style="margin-left: 10px; height: 350px; overflow-y: scroll;">
     		
     			
		<?php 	foreach($allitemdatta as $key=>$allitemimg){	?>
			<div class="seleectccate" id="seleectccate<?php echo $allitemimg['parentCatId']; ?>" onclick="seleectccate(<?php echo $allitemimg['parentCatId']; ?>);">
			<div><?php echo $allitemimg['category_name']; ?></div>
		<?php 	foreach($allitemimg['image_name'] as $allitm){ ?>
		<?php //echo $allitm['image_name']; ?>
				<div class="seleectccate-inside">
					<img src="<?php echo SITE_URL; ?>media/items/thumb150/<?php echo $allitm; ?>" style="margin: 5px; height: 80px; width: 80px;">
				</div>			
		<?php } ?>
			</div>
		<?php } ?>	
		<input type="hidden" value="" class="allcatevalues" />		
	</div>	
		
		<div style="border-bottom: 1px solid rgb(235, 236, 239); padding: 3px 7px 10px;"></div>
		
		<div style="margin-left: 760px; margin-top: 10px; padding-bottom: 10px;"><div id='loaddsusId' style='display:none;'><img src='<?php echo SITE_URL; ?>images/loading.gif'></div><a href="javascript:void(0);" id="sbmtcategg" class="btns-blue-embo">Next</a></div>
	
</div>


<div class="popup create-group-gifts" id="WelcomePop3" style="display: none; margin-top: 40px;">
    <h2 class="tit"> Markit the things you like </h2>
     <div class="shop cheptp3" style="margin-left: 10px; height: 350px; overflow-y: scroll; text-align: center; width: auto ! important;">
     		
     			
		<?php 	/* foreach($allitemdatta as $key=>$allitemimg){	?>
			
		<?php 	foreach($allitemimg['image_name'] as $allitm){ ?>
		<?php //echo $allitm['image_name']; ?>
				<div class="seleectccate-inside">
					<img src="<?php echo SITE_URL; ?>media/items/thumb350/<?php echo $allitm; ?>" style="margin: 5px; height: 200px; width: 200px;">
				</div>			
		<?php } ?>
		<?php } */ ?>	
		
		<ol class="stream">
                    <?php foreach ($itemvalforfant as $itms) { 
                    	$itm_id = $itms['Item']['id'];
						$item_title_url = $itms['Item']['item_title_url'];
						$item_title = $itms['Item']['item_title'];
						$image_name = $itms['Photo'][0]['image_name'];
						$price = $itms['Item']['price'];
						$user_id = $itms['Item']['user_id'];
						$item_price = $itms['Item']['price'];
						
						$item_title = UrlfriendlyComponent::limit_char($item_title,12);
				
						if(isset($itms['Photo'][0])){
							$image_name = $itms['Photo'][0]['image_name'];
						}
						$username_url = $itms['User']['profile_image'];
						if($username_url == ''){
							$username_url = 'usrimg.jpg';
						}
						$username = $itms['User']['username'];
						
						$username_url_ori = $itms['User']['username_url'];
						$favorte_count = $itms['Item']['fav_count'];
                    
						echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" style="margin: 10px 15px;">';
						
						echo  '<div class="figure-product-new mini" style="padding: 0px;">';
						echo  "<a href='javascript:void(0);' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
						//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
						echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='display:none;' >";
						echo "<figure>";
						echo '<span class="back"></span>';
						$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
						echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
						//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
						echo "</figure>";
						echo  '</a>';
						
						/* echo  '<em class="figure-detail">';
						echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
						<img style='width: 35px; height: 35px; position: relative; top: 10px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
						<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 28px; left: 42px;'>$username + $favorte_count</i>
						</a>";
						echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="position: relative; top: 10px; left: 7px;" >'.$item_title.'</span>';
						echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="position: relative; top: 10px; left: 7px;"><b> $'.$item_price.' </b> </span>';
						//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
						echo  '</em>'; */
						
						/* echo '<ul class="function">';
						echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
						echo '</ul>'; */
						
						foreach($itms['Itemfav'] as $useritemfav){
							if($useritemfav['user_id'] == $userid ){
								$usecoun[] = $useritemfav['item_id'];
							}
						}
						if(isset($usecoun) &&  in_array($itm_id,$usecoun)){
						echo  '<a class="button fantacy edit" style="margin: 10px; top: 75px; left: 9%;background-color:#84C069;" iteid="'.$itms['Item']['id'].'" onclick = "itemlikefirsttime('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  style = "background-color:#6EAA53;border-color: #4A9528;"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
						}else{
						echo  '<a class="button fantacy" style="margin: 10px; top: 75px; left: 9%;" onclick = "itemlikefirsttime('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
						}
						
						echo  '</div>';
						echo  '</li>';
				 } ?>
			</ol>
		
		
		
				
	</div>	
		
		<div style="border-bottom: 1px solid rgb(235, 236, 239); padding: 3px 7px 10px;"></div>
		
		<div style="margin-left: 760px; margin-top: 10px; padding-bottom: 10px;"><div id='loaddsusId' style='display:none;'><img src='<?php echo SITE_URL; ?>images/loading.gif'></div><a href="javascript:void(0);" id="sbmtcategg3" onclick="afterfirstlike();" class="btns-blue-embo">Next</a></div>
	
    
</div>



<div class="popup create-group-gifts" id="WelcomePopup4" style="display: none; margin-top: 40px;">
    <h2 class="tit"> Follow fantacy people </h2>
     <div class="cheptp4" style="margin-left: 10px; height: 350px; overflow-y: scroll; text-align: center; width: auto ! important;">
     		
		Follow people		
				
	</div>	
		
		<div style="border-bottom: 1px solid rgb(235, 236, 239); padding: 3px 7px 10px;"></div>
		
		<div style="margin-left: 760px; margin-top: 10px; padding-bottom: 10px;"><div id='loaddsusId' style='display:none;'><img src='<?php echo SITE_URL; ?>images/loading.gif'></div><a href="javascript:void(0);" id="sbmtcategg4" class="btns-blue-embo">Next</a></div>
	
    
</div>



<div class="popup create-group-gifts" id="WelcomePopup5" style="display: none; margin-top: 40px;">
    <h2 class="tit"> Almost done </h2>
     <div class="cheptp5" style="margin-left: 10px; height: 350px; overflow-y: scroll; text-align: center; width: auto ! important;">
     		
					<div style="padding-bottom: 10px; margin-top: 175px;"><div id='loaddsusId' style='display:none;'><img src='<?php echo SITE_URL; ?>images/loading.gif'></div><a href="javascript:void(0);" id="sbmtcategg5" class="btns-blue-embo">Finish</a></div>
				
	</div>	
		
		<div style="border-bottom: 1px solid rgb(235, 236, 239); padding: 3px 7px 10px;"></div>
		

	
    
</div>





	
</div>
<!-- /popups -->

	<?php
if(!empty($loguser)){
	echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
}else{
	echo "<input type='hidden' id='loguserid' value='0' />";
}
echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';

?>