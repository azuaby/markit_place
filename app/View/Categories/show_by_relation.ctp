<?php
?><div class="container shop" style="width:940px;">
<div class="wrapper-content list shopcont">

					<?php
				if($managemoduleModel['Managemodule']['display_banner']=="yes")
				{					
					if($banner_datas['Banner']['status']=='Active')
					{					
						echo '<div>';
						echo $banner_datas['Banner']['html_source'];
						echo '</div>';
					}
				}
					?>		

			<ul class="breadcrumbs">
				<li><a href="<?php echo SITE_URL; ?>recomendations/browse" class="shop-home"><?php echo __('Recommendations');?></a></li>
		<?php	$currentUrl = "recomendations/browse";
			 if ($categoryData != null) { ?>		
                <li class='last'>/ <a href='<?php echo SITE_URL."recomendations/".$categoryData['Category']['category_urlname']; ?>'><?php echo $categoryData['Category']['category_name']; ?></a></li>
		<?php 
			
			$categoryName = $categoryData['Category']['category_urlname'];
			$currentUrl = "recomendations/".$categoryName;
			if ($subCatName != null) { ?>
		<?php	$currentUrl = $currentUrl."/".$subCatName;
				} }?>
			</ul>
			<div class="sns-right">
                
			</div>
			<div id="content" style="box-shadow:none">
				<div class="search-frm">
					<div class="search">
						<div class = "styled selectdiv">
						<select class="shop-select sub-category selectboxdiv" onchange="loadRecomend()">
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
							<div class="out" ><?php echo __($selectData);?></div>
						</div>
						<div class = "styled selectdiv">
						<select class="shop-select price-range selectboxdiv" onchange="loadRecomend()">
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
							<div class="out" ><?php echo __('Any Price');?></div>
						</div>
						<div class = "styled selectdiv">
						<select class="shop-select relation-filter selectboxdiv" onchange="loadRecomend()">
							<option value="" selected><?php  echo __('Any Relationship'); ?></option>
						<?php
							$count = 1;
							foreach ($relationList as $key => $value) {
								
									echo '<option value="'.$count.'"  >';echo __($value['Recipients']['recipient_name']);echo '</option>';
								$count += 1;
							} ?>
                        </select>
                        	<div class="out" ><?php echo __('Any Relationship');?></div>
						</div>
						<div class = "styled selectdiv">
                        <select class="shop-select sort-by-gender selectboxdiv" onchange="loadRecomend()">
                            <option value=""><?php echo __('Any Gender');?></option>
                            <option value="0"><?php echo __('Male');?></option>
                            <option value="1"><?php echo __('Female');?></option>
                        </select>
                        	<div class="out" ><?php echo __('Any Gender');?></div>
						</div>
					</div>
				</div>
				<div class="itemLoader" style="display:none;">
					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading....">
				</div>
				<ol class="stream">
                    <?php foreach ($item as $itms) { 
                    	$itm_id = $itms['Item']['id'];
						$user_id = $itms['Item']['user_id'];
						$item_title_url = $itms['Item']['item_title_url'];
						$item_title = $itms['Item']['item_title'];
						$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
						
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
					
						$user_id = $itms['Item']['user_id'];
						$item_price = $itms['Item']['price'];
				
                    
						echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'">';
						
						echo  '<div class="figure-product-new mini">';
						echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
						//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
						
						echo "<figure>";
						echo '<span class="back"></span>';
						$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
						echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
						//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
						echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='display:none;' >";
						echo "</figure>";
						echo  '</a>';
						echo  '<em class="figure-detail">';
						echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
						<img style='width: 35px; height: 35px; position: relative; top: 10px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
						<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 28px; left: 42px;'>$username + $favorte_count</i>
						</a>";
						echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="position: relative; top: 10px; left: 7px;" >'.$item_title.'</span>';
						echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="position: relative; top: 10px; left: 7px;"><b> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
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
//						if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
//						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//						}else{
//						echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//						}
						
						if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
		                echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
	                    echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
                        echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                        echo '<button type="submit" class="button fantacyd edit" style="margin-left: -22px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
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
				 } ?>
				</ol>
                <input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
                <input type="hidden" value="<?php echo $currentUrl; ?>" id="currentCatPath">
                
                <div id="infscr-loading" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			</div>
	</div>

<!-- popups -->
<div id="popup_container">
<!-- add_to_list overlay -->
<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
	<div class="default">
		<p class="ltit"><?php echo __('Add to List');?></p>
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
						<button type="submit" id="list_createid" class="btn-create"><?php echo __('Create');?></button>
					</fieldset>
				<!--/form-->
			</div>
		</div>
		<div class="btn-area">
				<button type="button" class="btn-add-to-list btn-done" id="btn-doneid"><?php echo __('Done');?></button>
				<!--button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button-->
				<a href="#" class="btn_set" style="float: right;"><span ><?php echo __('Settings');?></span><div class="fancysettings"></div></a>
				<div class="set-dropdown">
					<ul>
						<li><a href="#" class="btn-unfancy"><?php echo __('UnMarkit');?></a></li>
					</ul>
				</div>
			</div>
			<input type="hidden" id="passedFromItemId" value="" />
	</div>
	<div class="create-list" style="display:none">
		<p class="ltit"><?php echo __('Create New List');?></p>
		<button class="close cancel" title="Close" ><i class="ic-del-black"></i></button>
		<form loid="">
		<fieldset>
			<div class="frm">
				<p><b class="stit"><?php echo __('Title');?></b> <input type="text" name="list_name" class="right" placeholder="Enter a title"></p>
				
			</div>
			<div class="frm">
				<p>
					<b class="stit"><?php echo __('Category');?></b>
					<select name="category_id" id="categories-for-new-list" class="right">
						<option value="0"><?php echo __('Select category');?></option>
					</select>
				</p>
			</div>
			
			<div class="frm">
				<b class="stit"><?php echo __('Contributors');?></b>
				<div class="right">
					<p>
						<input type="text" id="create-list-find-user" placeholder="Username or email address">
						<button class="btn-invite"><?php echo __('Invite');?></button>
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
							<span class="right"><?php echo __('Creator');?></span>
						</li>
						<script type="fancy/template" id="tpl-invite-user-list">
							<li data-id="##id##"><img src="##image_url##"><span class="left"><b>##fullname##</b>##username##</span><span class="right"><a href="#"><i class="ic-del"></i><span class="hidden">Delete</span></a></span></li>
						</script>
					</ul>
				</div>
			</div>
		</fieldset>
		<div class="btn-area">
			<button type="submit" class="btn-create"><?php echo __('Create list');?></button>
			<button type="button" class="cancel"><?php echo __('Cancel');?></button>
		</div>
		</form>
	</div>
</div>
<!-- /add_to_list overlay -->

<!--share-social-->
<div id="share-social" class="popup ly-title share-new"  style="margin-top: 5px; margin-left: 414px; opacity: 1; display: none;">
	 
	<p class="ltit">
		<span class="share-thing"><?php echo __('Share This Thing');?></span>
	</p>
	<div class="fig">
		<span class="thum"  style="width:100px;height:100px" ><img id="thum_img" src=""></span>
		<div class="fig-info">
			<span class="figcaption" id="figcaption_title_popup" > </span>
			<span class="username" ><b>$<span id="username_popup" ></span></b>, <?php echo __('By');?>  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; <?php echo __('Others');?></span>
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
	    var selectedCategory = $('.sub-category').val();
		if (selectedCategory == '') {
			selectedCategory = $('#currentCatPath').val();
		}
		var priceRange = $('.price-range').val();
		var relation = $('.relation-filter').val();
		var gender = $('.sort-by-gender').val();
		var baseurl = getBaseURL()+"categories/getItemByRelation";
		var categoryId = $('#hiddencatvalue').val();

	    $.ajax({
	      type: "POST",
	      url: baseurl+'?startIndex=' + sIndex + '&offset=' + offSet,
	      data: {price : priceRange, relation:relation, category:selectedCategory, catids:categoryId, gender:gender},
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
