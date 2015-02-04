<?php
error_reporting(0);
$roundProfile = "";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:150px;";
}
?>
<body>
<div id="container-wrapper">

	<div class="container shop" style="width:940px">
	<div style="margin: 0px auto;">
		<input type="hidden" id="searcheduser" value="<?php echo "$searchWord";?>" ><h1 class="showprihead" style="font-size:16px;">Search results for:<?php echo $searchWord;?>
		<a href="#" style="float: right; " onclick="usrcall(event)">People</a>
		<a href="#" style="float: right; margin-right: 32px;" onclick="thingcall(event)"">Things</a>
		<!-- <a href="#" style="padding-left:5em" onclick="itmcall(event)" class="lists">Lists</a> -->
			</h1>
	</div>
	<?php 
	$roundProf = "";
	if ($profileImgStyle == "round") {
		$roundProf = "border-radius:40px;";	
	}
	if(!isset($userid))
	{ ?>
	
	
	<?php } ?>	
		<div style="margin: 0px auto;width:980px;" >
			
				
		<div id="user" style="display:none;margin-top:30px; width: 960px;" >
	  <?php
			if(!empty($userDetails)){
                     	echo "<ol style='background: #fff;border-radius:5px 5px 0 0;padding-bottom:26px;'>";
				foreach($userDetails as $key => $user){
					//$user_nam = $user['User']['username']; 
					$user_nam = UrlfriendlyComponent::limit_char($user['User']['username'],10);
						
				$user_nam_url = $user['User']['username_url'];
					$user_imges = $user['User']['profile_image'];
                     	echo "<li style='width: 297px;display: inline-block;padding: 8px 8px 0px;'>";echo "<span>";
                     	if(!empty($user_imges)){
							echo " <a href='".SITE_URL."people/".$user_nam_url."'  title='".$user_nam."'   class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' style='".$roundProfile."width:70px;height:70px;' /><span class='shadow'></span></a>";
						}else{
							echo " <a href='".SITE_URL."people/".$user_nam_url."' title='".$user_nam."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:70px;height:70px;' /><span class='shadow'></span></a>";
						}
                  		echo "</span>";echo"<span style='margin-left: 12px;'>";
                     	
                     	echo $this->Html->link($user_nam,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'username','title' => $user_nam));
                     	echo "</span>";echo "</li>";
                     		
                     	}
                     	echo "</ol>";
			}
				if(empty($userDetails)){
				echo '<center style="padding: 5px 0px 0px 0px; font-size:147%; ">No People Found</center>';
				echo '<center style="font-style:normal; padding:8px;">Try Another Keyword</center>';
				}
			?></div> 

		  <div id="thing">
			<ol id="deal-listing">
		 <?php
		  
		  
		if(!empty($itemDetails)){
			
			foreach($itemDetails as $key=>$itms){
				//echo "<pre>";print_r($itms);die;
				$itm_id = $itms['Item']['id'];
				$user_id = $itms['Item']['user_id'];
				$item_title_url = $itms['Item']['item_title_url'];
				$item_title = $itms['Item']['item_title'];
				$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
				$user_id = $itms['Item']['user_id'];
				
				$item_title = UrlfriendlyComponent::limit_text($item_title,1);
				
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
				
				
				if(isset($itms['Photo'][0]['image_name'])){
					$image_name = $itms['Photo'][0]['image_name'];
				}
					
			
				echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'">';
						
						echo  '<div class="figure-product-new mini boxradius" >';
						echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
						//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
						
						echo "<figure>";
						echo '<span class="back"></span>';
						$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
						echo '<div class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; width: 207px; height: 207px;"></div>';
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
						
						/* echo '<ul class="function">';
						echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
						echo '</ul>';
						
						foreach($itms['Itemfav'] as $useritemfav){
							if($useritemfav['user_id'] == $userid ){
								$usecoun[] = $useritemfav['item_id'];
							}
						}
						if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
						echo  '<a class="button fantacy edit" style = "background-color:#84C069;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  style = "background-color:#6EAA53;border-color: #4A9528;"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
						}else{
						echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
						} */
						
						echo  '</div>';
						echo  '</li>';
			
			
				
			 }	
			}else{
				echo '<center style="padding: 5px 0px 0px 0px; font-size:147%; margin-top:30px;">No Items Found</center>';
				echo '<center style="font-style:normal; padding:8px;">Try Another Keyword</center>';
			}
		?>
	
			
		</ol>
		</div>
				<div id="itemlists" style="display:none"  >
<ul class="list" > 
Listings<h1> </h1> 
	  <?php
	  if(!empty($itemlistDetails)){
				foreach($itemlistDetails as $key => $user){
					$item_list = $user['Itemlist']['lists']; 
				 $userid=$user['Itemlist']['user_id']; 
				
			
				//echo '<a href="user_lists/"."$user_nam".$userid."'>'. echo ($item_list).</a>';
		echo"<ul>";
			echo " <a href='".SITE_URL."user_lists/"."$item_list/$userid'>";
		echo $item_list;
		echo"</a>";
		echo"</ul>"	;
                 
                     	
                	  	
				}
				}
			?> 
			</ul>
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
			<span class="figcaption" id="figcaption_title_popup" > </span>
			<span class="username" ><b>$<span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
			<h4>dsasas</h4><p class="from">qq</p>
		</div>
		
		
		
		
		
	</div>
	<div class="share-via">
		<ul class="less">
		
		
			
			<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"  title="Facebook"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   title="Twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google+"  title="Google +" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"      title="Linkedin"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" title="Stumbleupon"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a style="margin-left: 5px;"class='tumblr' href=""  title="Tumblr" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
			
			
			
			
			
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


