<?php
?>


<div class="container shop">
<div class="wrapper-content list shopcont">
<div class="ui-body ui-body-a">
			<table width="100%"><thead><tr><th></th><th></th></tr></thead><tbody><tr><td>
				<a href="<?php echo SITE_URL; ?>mobile/recomendations/browse" class="shop-home">Recomendations</a>
		<?php	$currentUrl = "mobile/recomendations/browse";
			 if ($categoryData != null) { ?>		
                <span class='last'>/ <a href='<?php echo SITE_URL."mobile/recomendations/".$categoryData['Category']['category_urlname']; ?>'><?php echo $categoryData['Category']['category_name']; ?></a></span>
		<?php 
			
			$categoryName = $categoryData['Category']['category_urlname'];
			$currentUrl = "recomendations/".$categoryName;
			if ($subCatName != null) { ?>
		<?php	$currentUrl = $currentUrl."/".$subCatName;
				} }?>
				</td><td align='right'>
    <div align="right"><a href="#myPopup" data-rel="popup" data-position-to="window" class="ui-btn ui-btn-inline ui-corner-all">Filterlist</a></div>
    </td></tr></tbody></table>
		 </div><br />
   <div class="ui-body ui-body-a">
			<div class="sns-right">
                
			</div>
			<div id="content" style="box-shadow:none" align="center">
				<div class="search-frm">
					<div class="search">
					<div data-role="popup" id="myPopup" class="ui-content">
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
						<div class = "styled selectdiv">
						Category : 
						<select id="sub-category1" class="shop-select sub-category selectboxdiv">
					<?php 
						if ($categoryData != null) { 
							
							if ($subCatName != null) {
								$categoryName = $categoryName."/".$subCatName;
								echo '<option value="">'. ucwords($subCatName).'</option>';
								$selectData = ucwords($subCatName);
							}else {
								echo '<option value="">'. ucwords($categoryName).'</option>';
								$selectData = ucwords($categoryName);
							}
							foreach ($subCategory as $scat) { 
								$subCategoryUrl = $scat['Category']['category_urlname'];
								$subCategory = $scat['Category']['category_name'];
								echo '<option value="recomendations/'.$categoryName.'/'.$subCategoryUrl.'">&nbsp;&nbsp;'.$subCategory.'</option>';
							} 
						} else {
							$selectData = 'Any Category';
							echo '<option value="">'; echo __('Any Category'); echo '</option>';
							foreach ($subCategory as $scat) { 
								$subCategoryUrl = $scat['Category']['category_urlname'];
								$subCategory = $scat['Category']['category_name'];
								echo '<option value="recomendations/'.$subCategoryUrl.'">&nbsp;&nbsp;'.$subCategory.'</option>';
							}						
						}
					
					?>
						</select>
							<div class="out" style="display:none;"><?php echo __($selectData);?></div>
						</div>
						<div class = "styled selectdiv">
						Price : 
						<select id="price-range1" class="shop-select price-range selectboxdiv">
							<option value="-1" >Any Price</option>
							<?php 
							foreach($price_val as $pric){
								echo '<option value="'.$pric['Price']['from'].'-'.$pric['Price']['to'].'">'.$_SESSION['currency_symbol'].$pric['Price']['from'].'-'.$pric['Price']['to'].'</option>';
							}
							?>
							<!--option value="1-20" >$1-20</option>
							<option value="21-100" >$21-100</option>
							<option value="101-200" >$101-200</option>
							<option value="201-500" >$201-500</option>
							<option value="501" >$501+</option-->
						</select>
							<div class="out" style="display:none;"><?php echo __('Any Price');?></div>
						</div>
						<div class = "styled selectdiv">
						Relationship :
						<select id="relation-filter1" class="shop-select relation-filter selectboxdiv">
							<option value="" selected><?php  echo __('Any Relationship'); ?></option>
						<?php
							$count = 1;
							foreach ($relationList as $key => $value) {
								
									echo '<option value="'.$count.'"  >';echo __($value['Recipients']['recipient_name']);echo '</option>';
								$count += 1;
							} ?>
                        </select>
                        	<div class="out" style="display:none;"><?php echo __('Any Relationship');?></div>
						</div>
						<div class = "styled selectdiv">
						Gender : 
                        <select id="sort-by-gender1" class="shop-select sort-by-gender selectboxdiv">
                            <option value=""><?php echo __('Any Gender');?></option>
                            <option value="0"><?php echo __('Male');?></option>
                            <option value="1"><?php echo __('Female');?></option>
                        </select>
                        	<div class="out" style="display:none;"><?php echo __('Any Gender');?></div>
						</div>
							<button onclick="updaterecomend1()">Update</button>
					</div>
				
					</div>
				</div>
<div class="itemLoader" style="display:none;">
					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading....">
				</div>
		
		
			<ol class="stream" style="margin-left:-40px;"><?php
		  
		  /* 	if(!empty($items_data)){
			foreach($items_data as $key=>$itms){
			
			if(@isset($user_idss[$itms['Item']['user_id']])){
				$user_idss[$itms['Item']['user_id']] = $user_idss[$itms['Item']['user_id']]+1;
			}else{
				$user_idss[$itms['Item']['user_id']] = 1;
			}
			
			
			}
			//print_r($items_data);die;
			}
		   */
			//echo "<pre>";print_r($items_data);die;
		  
		if(!empty($item)){
			
			foreach($item as $key=>$itms){
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
				echo "<div class='ui-body ui-body-a' style='border-radius:5px;'>";
				echo  '<li imgid="'.$image_name.'"  class="big" style="list-style:none;margin-top:5px;">'; 
				
				
					echo "<div class='userimagesthirtyfive'>";
					//echo '<div style="with:98%!important;padding:5px;height:45px;"><div style="width:70%;float:left;">';
			if(!empty($username_url)){
					
					echo  "<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."width:50px;height:50px;'></a>
					<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>$username</i>
					<br />
						
					</a>";
					//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
				}else{
					
					echo  "<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."width:50px;height:50px;'></a>
					<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>$username</i>
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
				
				foreach($itms['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];					
				}
				echo '<div style="margin-top:-15px;">
				<div style="width:70%;float:left;height:20px;">';
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacydbtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:85px;height:15.5px;margin-top:4px;border-radius:5px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img border="1" src="'.SITE_URL.'images/logo/fantacylikes.png" style="margin: -4px;"></span> 
    <span style="margin-left:4px;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:85px;height:15.5px;margin-top:4px;border-radius:5px;"><span id="spandd'.$itms['Item']['id'].'">
    <img src="'.SITE_URL.'images/logo/fantacylikes.png" style="margin: -4px;"></span>
     <span style="margin-left:4px;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span>
     <input type="hidden" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'">
     </span></a>';
				}
				echo '</div> <div style="width:28%;float:left;text-align:right;">';
				echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				echo '<span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" style="margin-right:-5px;float:right;margin-top:20px;">
				<span style="position: relative;float: right;margin-top:5px;" class="comment"> <img src="'.SITE_URL.'images/menu/comment.png">
				<span style="top:13%;position:absolute;color:#707070!important;left:48%;">
				 '.$comment_count.'</span></span></span>';
				echo "</a>";
							
				echo  '</div>';
			echo  '</li></div><br />';
			}	
			}
		?>

		</ol>
                <input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
                <input type="hidden" value="<?php echo $currentUrl; ?>" id="currentCatPath">
                
                <div id="infscr-loading" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			</div>
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
		
		
			
			<li><a style="float: left;" class='facebook' href="" alt="Share this on facebook"  title="Facebook"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;" class='twitter' href="" alt="Share this on twitter"   title="Twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;" class='google'  href="" alt="Share this on Google+"  title="Google +" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;" class='linkedin' href="" alt="Share this on linkedin"      title="Linkedin"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;" class='stumbleupon' href="" title="Stumbleupon"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a class='tumblr' href=""  title="Tumblr" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
			
			
			
			
			
			<!--
			<li><a  href="http://www.facebook.com/sharer.php?s=100&p[title]='titlesssss'&p[summary]=' + encodeURIComponent('description here') + '&p[url]=' + encodeURIComponent('http://www.nufc.com') + '&p[images][0]='http://cf1.thingd.com/default/179335694966068439_d27b575231de.jpeg.small.jpeg')" >Fb Share</a> </li>
			
			-->
			
			
			
			
		</ul>
		<a href="#" class="show"><i class="arrow"></i></a>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->





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
<script type="text/javascript">
var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();
$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
		if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
	    var selectedCategory = $('#sub-category').val();
		if (selectedCategory == '') {
			selectedCategory = $('#currentCatPath').val();
		}
		selcat = selectedCategory.split("mobile/");
		var priceRange = $('#price-range').val();
		var relation = $('#relation-filter').val();
		var gender = $('#sort-by-gender').val();
		var baseurl = getBaseURL()+"mobilecategories/getItemByRelation";
		var categoryId = $('#hiddencatvalue').val();

	    $.ajax({
	      type: "POST",
	      url: baseurl+'?startIndex=' + sIndex + '&offset=' + offSet,
	      data: {price : priceRange, relation:relation, category:selcat[1], catids:categoryId, gender:gender},
	      beforeSend: function () {
	    	  $('#infscr-loading').show();
			},
		  dataType: 'html',
	      success: function (responce) {
	      	$('#infscr-loading').hide();
	      	var out = responce.toString();
	      	if (out != 'false') {//When data is not available
		        $('.stream').append(responce);
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
