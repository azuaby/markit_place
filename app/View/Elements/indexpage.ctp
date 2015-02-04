<div id="content" >
	<ol class="stream" style="display:none;"><?php		

	if(isset($_SESSION['currency']) && $_SESSION['currency'] === 'EUR'){
		$dollar = 'E';
		$dollarSymbal = '€';
		$currencyCode = 'EUR';
	}else{
		$dollar = 'D';
		$dollarSymbal = '$';
		$currencyCode = 'USD';
	}
	
	
	if(!empty($items_data)){
		foreach($items_data as $key=>$itms){
			$usercmntcount='';
			$durationStatustimimg='';
			$itm_id = $itms['Item']['id'];
			$user_id = $itms['Item']['user_id'];
			$item_title_url = $itms['Item']['item_title_url'];
			$item_title = $itms['Item']['item_title'];
			//$item_price = $itms['Item']['price'];
			
			if(isset($itms['Photo'][0])){
				$image_name = $itms['Photo'][0]['image_name'];
			}
			$username_url = $itms['User']['profile_image'];
			$username = $itms['User']['username'];
			
			$username_url_ori = $itms['User']['username_url'];
			$favorte_count = $itms['Item']['fav_count'];
			$shop_address = $itms['Shop']['shop_address'];
			
			
			$quantity = $itms['Item']['quantity'];
			
			if(isset($_SESSION['currency']) && $_SESSION['currency'] === 'EUR'){
				$eruoAmount = $setngs[0]['Sitesetting']['euroamnt'];
				$buyingPrice = $eruoAmount * $itms['Item']['buyingPrice'];
				$beforePrice = $eruoAmount * $itms['Item']['beforePrice'];
				$afterPrice = $eruoAmount * $itms['Item']['afterPrice'];
			}else{			
				$buyingPrice = $itms['Item']['buyingPrice'];
				$beforePrice = $itms['Item']['beforePrice'];
				$afterPrice = $itms['Item']['afterPrice'];
				
			}
			
			$durationStatus = $itms['Item']['durationStatus'];
			$durationStatustimimg = $itms['Item']['durationStatustimimg'];
			$cdate = $itms['Item']['cdate'];
			
			$daylen = 60*60*24;
			$nowt = time();
			$tot = $nowt - $cdate;			
			$daydiffernt = round(($nowt-$cdate)/$daylen);			
			$daystatusremainings = $durationStatustimimg-$daydiffernt;
			
			if( $durationStatus == 'on' &&  $daystatusremainings > 0 ){
				$item_price = $beforePrice;
			}else{
				$item_price = $afterPrice;
			}
			
				
			//$cdate = $itms['Item']['created_on'];
			//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
			$item_titletwo = UrlfriendlyComponent::limit_char($item_title,20);
			
			echo  '<li imgid="'.$image_name.'"  class="big" >'; 
			echo  '<div class="figure-item">';		
			$mediaul = trim($_SESSION['media_url']);
			list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
			//list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
			//list($width, $height) = getimagesize($_SESSION['media_url']."media/items/thumb350/".$image_name);
			echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
			echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
			echo  '<span class="figure classic">';
			echo  '<em class="back"></em>';
			echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='background:#F9F9F9;'  >";
			echo  '</span>';
			echo  '<span class="figure vertical">';
			echo  '<em class="back"></em>';
			echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#F9F9F9;' data-height=".$height." data-width=".$width.">";
			echo  '</span>';
			echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
			echo  '</a>';
			echo  '<em class="figure-detail back">';
			echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
			echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"> </a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
			echo  '</em>';
			
			echo '<ul class="function">';
			echo '<li class="share shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><a href="javascript:void(0);" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share btnforlike  glyphicons share" style="padding: 3px 0px;" ><span class="shareimg123"></span></a></li>';
			//echo "<form action='".SITE_URL."pays' >";
			//echo '<span class="comment shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons comments btnforlike" style="padding: 3px 4px; width: auto;">'.$cmnt.'</span></span>';
			echo '<a href="javascript:void(0);" onclick = "addcarts('.$itm_id.');" ><span class="fantcyHeart heartli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons cart_in btnforlike" style="padding: 3px 4px; width: auto;"><input type="hidden" name="" value="1"/></span></span></a>';
			//echo "</form>";
			
			echo '</ul>';
			
			
			foreach($itms['Itemfav'] as $useritemfav){
				if($useritemfav['user_id'] == $userid ){
					$usecoun[] = $useritemfav['item_id'];
				}
			}
			
//			if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
//			echo  '<a class="button fantacy edit" style = "background-color:#84C069;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  style = "background-color:#6EAA53;border-color: #4A9528;"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//			}else{
//			echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//			}
			
			if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
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
			
			if( $durationStatus == 'on' &&  $daystatusremainings > 0 ){
			//echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
			echo "<div class='userv vcard'>";
			echo "<i class='glyphicons tag arrow-sml' style='left: 7px; margin-top: 17px; padding: 0px;'><b> $beforePrice </b> <del> $buyingPrice </del></i>";
			echo "<i title='".$quantity." Stocks Remaining' class='glyphicons cargo arrow-sml-right' style='padding: 0px; margin-top: 10px; right: 10px;'><b> $quantity </b></i><br />";
			echo "<i title='".$daystatusremainings." Days Remaining' class='glyphicons stopwatch arrow-sml-right' style='padding: 0px; margin-top: -8px; right: 55px;'><b> $daystatusremainings </b></i><br />";
			echo "</div>";
			//echo "</a>";
			}else{
			//echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
			echo "<div class='userv vcard'>";
			echo  "<i class='glyphicons tag arrow-sml' style='left: 7px; margin-top: 17px; padding: 0px;'> $afterPrice</i>";
				echo "<i title='".$quantity." Stocks Remaining' class='glyphicons cargo arrow-sml-right' style='right: 7px; margin-top: 17px; padding: 0px;'><b> $quantity </b></i><br />";
			echo "</div>";
			//echo  "</a>";
			} 
			
			echo  "<div style='text-align:left;'><a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm'>".$item_titletwo." </b> </a></div>";
				echo  '</div>';
			echo  '</div>';
			echo  '</li>';
			}	
			}else{
				echo "<center>No Items Found</center>";
			}
		?>

		</ol>
			
			<div id="infscr-loading" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			
				<div id="index-loading" style="display:none;line-height:34;text-align:center;min-height:600px;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>images/loading.gif">
					<!--span class="loading">Loading...</span-->
				</div>

		</div>
	</div>
	<!-- / container -->
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


<!-- slideshow_box -->
 <section id="slideshow-box" tabindex="0">
	<header>
		<div class="container">
			<a href="<?php echo SITE_URL; ?>" class="slideHeader">
				<img src="<?php echo SITE_URL.'images/logo.png'; ?>" style="width: 130px; margin-top: -4px; margin-left: -1px;">
			</a>
			<div class="controller">
				<a href="#" id="btn-browse" title="close" style="color:#fff;font-weight:bold;">x
				<!--<img src="<?php echo SITE_URL; ?>images/gclose.png"/>-->
				</a>
			</div>
		</div>
	</header>
	<div class="container contant">
		<div id="gallery" class="content">
					
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
						<div id="caption" class="caption-container"></div>
					</div>

					<div id="controls" class="controls"></div>
				</div>

				<!-- Start Advanced Gallery Html Containers -->				
				<div class="navigation-container">
					<div id="thumbs" class="navigation">
						<a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
					
						<ul class="thumbs noscript">
							<?php
									if(!empty($items_gallery)){
										foreach($items_gallery as $key=>$itms){
											$username = $itms['User']['username'];
											$favorte_count = $itms['Item']['fav_count'];
											$itemId = $itms['Item']['id'];
											$itemTitle = $itms['Item']['item_title_url'];
											if(isset($itms['Photo'][0])){
											$image_name = $itms['Photo'][0]['image_name'];
											echo '<li>';
								echo '<a class="thumb" href="'.$_SESSION['media_url'].'media/items/original/'.$image_name.'" title="'.$itms['Item']['item_title'].'">';
									echo '<img src="'.$_SESSION['media_url'].'media/items/thumb70/'.$image_name.'" alt="'.$itms['Item']['item_title'].'" width="75px" height="75px"/>';
									//echo '<span style="background: url(\''.$_SESSION['media_url'].'media/items/thumb70/'.$image_name.'\');width:75px; height:75px;float:left;" />';
								echo '</a>';
								echo '<div class="caption">';
									echo '<div class="image-title"><a href="'.SITE_URL.'listing/'.$itemId.'/'.$itemTitle.'">'.$itms['Item']['item_title'].'</a></div>';
									echo '<div class="image-desc"><span class="username"><em><i>  by &nbsp;&nbsp;  </i><a href="'.SITE_URL."people/".$username.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span></div>';
								echo '</div>';
							echo '</li>';
											
												
											}
										}
									}
							?>
							
						</ul>
						<a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
					</div>
					
				</div>
				<!--<div class="content">
					<div class="slideshow-container" style="position:relative;">
						<div id="controls" class="controls"></div>
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container">
						<div class="photo-index"></div>
					</div>
				</div>-->
					
				<!-- End Gallery Html Containers -->
				<div style="clear: both;"></div>
	</div>
	
</section>
<!-- /slideshow_box -->



<!--share-social-->
<div id="share-social" class="popup ly-title share-new"  style="margin-top: 100px; margin-left: 414px; opacity: 1; display: none;">
	 
	<p class="ltit">
		<span class="share-thing">Share This Thing</span>
	</p>
	<div class="fig">
		<span class="thum"  style="width:100px;height:100px" ><img id="thum_img" src=""></span>
		<div class="fig-info">
			<span class="figcaption"   style="font-size:20px;" id="figcaption_title_popup" > </span>
			<span class="username"  style="font-size:15px;"><b><?php echo $dollarSymbal; ?><span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
			<h4>dsasas</h4><p class="from">qq</p>
		</div>
		
	</div>
	<div class="share-via">
		<ul class="less">
			<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"  title="Facebook"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   title="Twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google+"  title="Google +" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"      title="Linkedin"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" title="Stumbleupon"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a style="margin-left: 5px;"class='tumblr' href=""  title="Tumblr" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
		</ul>
		<a href="#" class="show"><i class="arrow"></i></a>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->
</div>
<!-- /popups -->
