<?php 
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = @$_SESSION['media_server_username'];
@$password = @$_SESSION['media_server_password']; 
@$hostname = $_SESSION['media_host_name'];

$roundProfile = "";
$roundProfileFlag = 0;
if ($roundProf == "round")  {
	$roundProfile = "border-radius:40px;";
	$roundProfileFlag = 1;
}
?>
<style type="text/css">
.wrapper-content {
	padding-top: 50px;
}
</style>
  <script>
  $(function() {
    //$( "#datepicker" ).datepicker();
  
  });
  </script> 

<body>

<div class="container wider" style="top: 0px;width:960px;">
		<div class="wrapper-content right-sidebar" style="background:none;margin-bottom: -5px;">
			<div id="content">
				<div class="figure-row first sepProduView" style="margin-left: -26px;">
					<div class="figure-product figure-640 big text-left">

				<a title="<?php echo $item_datas['Item']['item_title']; ?>" id="img_id<?php echo $item_datas['Item']['id']; ?>"  href="#">	
				<figure>
					<span class="wrapper-fig-image" style="text-align: center; background: #FBFCFC; margin-bottom: 12px;">
						<img id="fullimgtag" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>">
					</span>                            
                    <figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption>
						    
                </figure>
               </a>
			<!-- <a title="<?php echo $item_datas['Item']['item_title']; ?>" href="#">
				<figure><span class="fig-image"><img id="fullimgtag" height="550" width="570" alt="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>"></span>
				<figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption></figure>
			</a> -->
			
			<br class="hidden">
						
						<p>by <a class="username" href="<?php echo SITE_URL; ?>"><?php echo $item_datas['User']['username']; ?></a> + <?php echo $item_datas['Item']['fav_count']; ?> others
						</p><br class="hidden">
						
			<?php
				//echo $item_datas['Itemfav'][0]['user_id'];die;
		
				foreach($item_datas['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
					
				//echo"<pre>";print_r($setngs);
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
			//	echo "<pre>";echo ".$setngs[0]['Sitesetting']['liked_btn_cmnt']";die;
				?>		
			<?php 
						$itemcolor = $item_datas['Item']['item_color'];
						$itemidse = $item_datas['Item']['id'];
						$itemcolor = json_decode($itemcolor,true);
						?>
			</div>
					<!-- / figure-product figure-640 -->
					
					
		
				</div>
				<!-- / figure-row -->
		
				<?php 
				$item_title = $item_datas['Item']['item_title'];
				$item_price = $item_datas['Item']['price'];
				$favorte_count = $item_datas['Item']['fav_count'];
				$username = $item_datas['User']['username'];
				
				echo '<span id="figcaption_titles'.$item_datas['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo '<span id="price_vals'.$item_datas['Item']['id'].'" price_val="'.$item_price.'" ></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$item_datas['Item']['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span class="fav_count" id="fav_count'.$item_datas['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></span>';

				?>		
					
			<div id="links"></div>	
			
	</div>
<!-- / content -->

			<?php if(($item_datas['Item']['status'] != '')){ ?>
			
			<aside id="sidebar" style="background:none;" >
				<section class="thing-section gift-section">
                <?php 
				$itemcolor = $item_datas['Item']['item_color'];
				$itemidse = $item_datas['Item']['id'];
				$itemcolor = json_decode($itemcolor,true);
				
				
				
				?>
				
				<?php /* if(($item_datas['Item']['status'] == 'things')){ ?>
				<div class="figure-row first sepProduView ">
					<ul class="thing-info">
						<li>
							<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>"  ><button class="buyitbttn" value=""><i class="ic-cart"></i>Buy It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
						</li>						
						<li>
							<a href="<?php echo  SITE_URL.'sellersignup/'.$item_datas['Item']['id']; ?>"  ><button class="sellitbttn"><i class="ic-cart"></i>Sell It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/sellitem.png"> <a href="'.SITE_URL.'sellersignup/'.$item_datas['Item']['id'].'"  >Sell it</a>'; ?>
						</li>
					</ul>
				</div>
					<?php } */ ?>
				
				<?php
					if(!empty($loguser)){
						echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
						echo "<input type='hidden' id='featureditemid' value='".$item_datas['Item']['id']."' />";
					}else{
						echo "<input type='hidden' id='loguserid' value='0' />";
					}
					
					echo '<input type="hidden" id="listingid" value="'.$item_datas['Item']['id'].'" />';
					echo '<input type="hidden" id="shopid" value="'.$item_datas['Shop']['id'].'" />';
					echo '<input type="hidden" id="lastestidgg" value="" />';
					echo '<input type="hidden" id="totitemshipcost" value="" />';
					echo '<input type="hidden" id="recepietName" value="" />';
					echo '<input type="hidden" id="recepietcity" value="" />';
					?>
			
				
				
				
				
					<div class="itemAddedUserDetails  figure-row first sepProduView ">
						<?php 
						if(!empty($item_datas["User"]["profile_image"])){
							echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 8px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
						}else{
							echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 8px;' /></a>";
						
						}
						
						if($userid != $item_datas['User']['id']){
							
							foreach($followcnt as $flcnt){
								$flwrcntid[] = $flcnt['Follower']['user_id'];
									
							}
							//echo "<pre>";print_r($flwrcntid);die;
							if($userid != $item_datas['User']['id']){
								if(isset($flwrcntid) && in_array($item_datas['User']['id'],$flwrcntid)){
									$flw = false;
								}else{
									$flw = true;
								}
							
							
								if($flw){
							
									if(empty($item_datas['User']['id'])){
										echo "<input type='hidden' id='gstid' value='0' />";
									}else{
										echo "<input type='hidden' id='gstid' value='".$userid."' />";
									}
								}
								echo '<span id="changebtn'.$item_datas['User']['id'].'" ></span>';
							
							}
							
						}	
						
					//echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				?>
				<a href = "<?php echo SITE_URL; ?>" class = 'username' title = '<?php echo $item_datas["User"]["username"]; ?>'>
				<?php echo $item_datas["User"]["username"];?><br clear='all'/><span class="usernameMention"><?php echo "@".$item_datas["User"]["username_url"] ?></span>
				</a>
						
						
						<?php if ($item_datas['Item']['price'] != 0 &&$item_datas['Item']['price'] != '') {?>
							<p class="prices" style="font-size:12px;">
							<strong class="price">$<?php echo $item_datas['Item']['price']; ?></strong> USD<br>
							<input type="hidden" id="price" value="<?php echo $item_datas['Item']['price']; ?>">	
							</p>
							<?php } ?>
							<?php if(($item_datas['Item']['status'] == 'things')){ ?>
								<h1 style="border: medium none; margin: 8px 0px 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
									
									<div class="thing-description" >
										
										<p style="font-size: 15px; padding: 0px 0px 20px;">  <?php 
												echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
												//echo str_word_count($item_datas['Item']['item_description'], 0);
												//if(strlen($item_datas['Item']['item_description']) > 15){
												if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
													echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
												}
											  ?></p>
										
									</div>
									<ul class="thing-info">	
									<li>
										<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>" target="_blank" ><button class="buyitbttn" value="">Buy It</button></a>
											<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
									</li>				
								</ul>
				
							</div>
							<div class="figure-row first sepProduView " style="padding:0px;">
			                    <h1 style="margin: 0px; padding: 10px; background: #F6F7F8;border-radius: 4px 4px 0 0" >Actions</h1>
			
								<?php 
										$wanticon = 'pushpin'; $wanttext = 'I want it';
										$ownicon = 'lock'; $owntext = 'I own it';
										if ($wantIt == 1){
											$wanticon = 'circle_ok'; $wanttext = 'You want it';
										}
										if ($ownIt == 1){
											$ownicon = 'circle_ok'; $owntext = 'You own it';
										}
							?>
								<ul class="thing-info" style="padding: 0px 10px 10px;">		
									<li>
										<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>" class="moreinfo" target="_blank"><i class="glyphicons circle_info"></i>More info</a>
									</li>						
									<li>
										<a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="simlarclr" ><i class="glyphicons tint"></i>Similar Color</a>
									</li>		
									<li>
										<a href="javascript:void(0);" class="wantit" onclick="wantit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $wanticon; ?>"></i><?php echo $wanttext; ?></a>
										<div class="wantitload" style="display:none; float: right; width: 190px;">
											<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
										</div>
									</li>						
									<li>
										<a href="javascript:void(0);" class="ownit" onclick="ownit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $ownicon; ?>"></i><?php echo $owntext; ?></a>
										<div class="ownitload" style="display:none; float: right; width: 190px;">
											<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
										</div>
									</li>						
									<li>
										<a href="<?php echo  SITE_URL.'create/item/'.$item_datas['Item']['id']; ?>"  ><i class="glyphicons tags"></i>Sell It</a>
											<?php //echo '<img src="'.SITE_URL.'images/sellitem.png"> <a href="'.SITE_URL.'sellersignup/'.$item_datas['Item']['id'].'"  >Sell it</a>'; ?>
									</li>				
								</ul>
							
							</div>
								<?php }else{ ?>
							
							<div class="option-area">
								
								<label for="quantity" style="display: inline-block; font-size: 14px;">Quantity: </label>
								<span class="input-number" style="display: inline-block; position: relative;color:#717171;">
									 <?php if($item_datas['Item']['quantity']<=0){
									 			echo "Sold Out";
									 		}else{
									 			echo "Only ".$item_datas['Item']['quantity']." available ";
									 		}
									  ?>
									
									
								</span>
								<?php 
								$process_time = $item_datas['Item']['processing_time'];
									if($process_time == '1d'){
										$process_time = "One business day";
									}elseif($process_time == '2d'){
										$process_time = "Two business days";
									}elseif($process_time == '3d'){
										$process_time = "Three business days";
									}elseif($process_time == '4d'){
										$process_time = "Four business days";
									}elseif($process_time == '2ww'){
										$process_time = "One-Two week business days";
									}elseif($process_time == '3w'){
										$process_time = "Two-Three week business days";
									}elseif($process_time == '4w'){
										$process_time = "Three-Four week business days";
									}elseif($process_time == '6w'){
										$process_time = "Four-Six week business days";
									}elseif($process_time == '8w'){
										$process_time = "Six-Eight week business days";
									}
								?>
								<br clear="all" />
								<div class="shippingTime">
									<img src="<?php echo SITE_URL; ?>images/shippingicon.gif" alt="Shipping: " />
									<span class="shipperiod"><?php echo $process_time; ?></span>
								</div>
							</div>
					</div>
					
				
				
				
					<div class="figure-row first sepProduView ">
	                    <h1 style="margin: 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
	
						<div class="thing-description" >
							
							<p style="font-size:15px;">  <?php 
									echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
									//echo str_word_count($item_datas['Item']['item_description'], 0);
									//if(strlen($item_datas['Item']['item_description']) > 15){
									if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
										echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
									}
								  ?></p>
							
						</div>
					<ul class="figure-list after">
						<?php
							if(!empty($item_datas['Photo'][1])){
								foreach($item_datas['Photo'] as $phts){
									//echo "<pre>";print_r($phts);
									echo '<li class="proimgovrlay"><a class="smlght" href="#" data-img-src="'. $_SESSION['media_url'].'media/items/original/'.$phts['image_name'].'" style="background-image:url(\''.$_SESSION['media_url'].'media/items/thumb70/'.$phts['image_name'].'\')"></a>
											<img src="'. $_SESSION['media_url'].'media/items/original/'.$phts['image_name'].'" style="display:none;" /></li>';
									
								}
							}
							if(!empty($item_datas['Item']['videourrl'])){
								//foreach($item_datas['Photo'] as $phts){
									//echo "<pre>";print_r($phts);
								$submitID = $item_datas['Item']['videourrl'];
								
								if (strpos($submitID, '/') === false) {
									$videoID = $submitID;
								}else {
									preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
									if (isset($matches[1]))
									{
										$videoID = $matches[1];
									}else {
										$videoID = '';
									}
								}
								//echo $videoID;die;	
									echo '<li class="proimgovrlay">
									<a  href="javascript:void(0);" onclick="showvideourll(\''.$videoID.'\');"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
									</li>';
										
								//}
							}
							
						?>
					</ul>
				
				</div>
						<?php } ?>							
				
				<?php
					echo "</div>";
					if(!empty($loguser)){
						echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
						echo "<input type='hidden' id='featureditemid' value='".$item_datas['Item']['id']."' />";
					}else{
						echo "<input type='hidden' id='loguserid' value='0' />";
					}
					
					echo '<input type="hidden" id="listingid" value="'.$item_datas['Item']['id'].'" />';
					echo '<input type="hidden" id="shopid" value="'.$item_datas['Shop']['id'].'" />';
					echo '<input type="hidden" id="lastestidgg" value="" />';
					echo '<input type="hidden" id="totitemshipcost" value="" />';
					echo '<input type="hidden" id="recepietName" value="" />';
					echo '<input type="hidden" id="recepietcity" value="" />';
?>

				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
			
			
			
			 <?php	}	?>
			
			
		<!-- / wrapper-content -->
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
						<li><a href="#" class="btn-unfancy">unfantacy</a></li>
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
									if(!empty($FashionuserDet)){
										foreach($FashionuserDet as $key=>$itms){
											$username = $itms['User']['username'];
											$usernameUURL = $itms['User']['username_url'];
											$favorte_count = $itms['Fashionuser']['fav_count'];
											$fId = $itms['Fashionuser']['id'];
											$itemTitle = $itms['Fashionuser']['item_title_url'];
											$image_name = $itms['Fashionuser']['userimage'];
											echo '<li>';
												echo '<a class="thumb" href="'.$_SESSION['media_url'].'media/avatars/original/'.$image_name.'" title="'.$username.'">';
													echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$image_name.'" alt="'.$username.'" width="75px" height="75px"/>';
												echo '</a>';
												echo '<div class="caption">';
													echo '<div class="image-title"><a href="'.SITE_URL.$usernameUURL.'">'.$username.'</a></div>';
													//echo '<div class="image-desc"><span class="username"><em><i>  by &nbsp;&nbsp;  </i><a href="'.SITE_URL.$username.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span></div>';
												echo '</div>';
											echo '</li>';
											
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
<div id="share-social" class="popup ly-title share-new"  style="margin-left: 414px; display: none; margin-top: 100px; opacity: 1;">
	 
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
		
		
			
			<li><a style="float: left;margin-left: 5px;" class='facebook' href='' alt='Share this on facebook'  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google plus" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
			
			
			
			
			
			<!--
			<li><a  href="http://www.facebook.com/sharer.php?s=100&p[title]='titlesssss'&p[summary]=' + encodeURIComponent('description here') + '&p[url]=' + encodeURIComponent('http://www.nufc.com') + '&p[images][0]='http://cf1.thingd.com/default/179335694966068439_d27b575231de.jpeg.small.jpeg')" >Fb Share</a> </li>
			
			-->
			
			
			
			
		</ul>
		<a href="#" class="show"><i class="arrow"></i></a>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->



<div class="popup create-group-gifts">
    <h2 class="tit">Create a Group Gift</h2>
    <ol class="step step1">
	<li class="fst">Choose Recipient <span></span></li>
	<li class="scd">Personalize <span></span></li>
	<li class="trd">Ask for Contributions</li>
    </ol>
   
    <div class="chept recipient">
	<ul class="tab">
	    <li><a href="#" class="current add">Enter manually</a></li>
	    <!-- li><a href="#" class="pick">Pick a friend</a></li -->
	</ul>
	
	<div class="add-friends">
	    <!-- <div class="scroll suggest-u">
			<h4>Suggested friends</h4>
			<dl class="event-day">
				<dd><ul></ul></dd>
			</dl>
	    </div> -->
	    <?php	//echo $this->Form->Create('ggusersave',array('url'=>array('controller'=>'/','action'=>'/'),'onsubmit'=>'return validggusersave()')); ?>
  		<form onsubmit="return validggusersave();">
		<div class="frm">
		    <input type="hidden" name="uid" value=""/>
		    <p>
			<label class="label">Recipient</label>
			<input type="text" class="text search-fancy-users" name="recipient" id="recipient" placeholder="Enter a username or an email address" />
		    <br /><span id='recipient_name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Recipient Name </span>
		    </p>
		    
		    <ul class="user-list">
		    </ul>
		    <p>
			<label class="label">Full Name</label>
			<input type="text" name="name" id="name" class="text"/>
			<br /><span id='name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Full Name </span>
		    </p>
		    
		    <p>
			<label class="label">Address</label>
			<input type="text" class="text add1" name="address1" id="address1" placeholder="Address Line 1" />
			<br /><span id='address1_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Address1 </span>
		     </p> 
		     
			 <p>
			<label class="label">Address2</label>
			<input type="text" class="text add2" name="address2" id="address2" placeholder="Address Line 2" />
		    <br /><span id='address2_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Address2 </span>
		    </p>
		    
		    <p>
			<label class="label">Country</label>
			<select  name="countrygg" id="countrygg" style="width:260px;" >
				<option value="">Select Country</option>
				<?php foreach ($contry_datas as $country) {	?>
				<option value="<?php echo $country['Country']['id'];?>"><?php echo $country['Country']['country']; ?></option>
				<?php } ?>
			</select>
			<br /><span id='country_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Select The Country </span>
		    </p>
		    
		    <p class="state">
				<label class="label">State</label>
				<input type="text" class="text add2" name="stategg" id="stategg" placeholder="State" />
			 	<br /><span id='state_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the State </span>
		    </p>
		     
		    <p>
				<label class="label">City</label>
				<input type="text" class="text city" name="citygg" id="citygg" placeholder="e.g. New York" />
				<br /><span id='city_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the City </span>
		     </p>
			
			<p>
			<label class="label">Zipcode</label>
			<input type="text" class="text zip" name="zipcodegg" id="zipcodegg" placeholder="ZIP Code" maxlength="6"/>
		    <br /><span id='zipcode_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Zipcode </span>
		    </p>		
		    
		    <p>
			<label class="label">Telephone</label>
			<input type="text" class="text" name="telephonegg" id="telephonegg" placeholder="10 digits, no dashes"  maxlength="11"/>
		    <br /><span id='telephone_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Telephone number </span>
		    </p>
		   
		    <div class="photo">
			<img src="" style="display:none" />
			<input type="file" id="recipient-image" name="upload-file" class="hidden">
			<?php 
			
				/* if(empty($item_datas['User']['profile_image'])){
					$image_computer = '';
				 }else{
					$image_computer = $item_datas['User']['profile_image'];
				} */
			
				$image_computer = 'usrimg.jpg';
				echo "<div class='input-group'>";
					if($image_computer!='usrimg.jpg'){
						echo "<img id='show_url'  style='width: 70px; height: 70px; border: 1px solid rgb(221, 221, 221); padding: 5px; margin-left: 23px; margin-top: 20px;".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/".$image_computer."'>";
					}else{
						echo "<img id='show_url'  style='width: 70px; height: 70px; border: 1px solid rgb(221, 221, 221); padding: 5px; margin-left: 23px; margin-top: 20px;".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'>";
					}
					echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'userupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="width: 125px; margin-left: 6px;"></iframe>';												
					echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
						if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' style='margin-left: 14px;display:none;' class='btn' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left: 14px;display:none;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
					echo "</div>";
					
				echo "</div>";
			
			echo "<br clear='all' />";
			
				?>
			
			
			<!-- button type="button" class="btn-upload" onclick="add()"><span class="icon"></span>Upload Photo</button-->
		    </div>
		</div>
		<div class="btn-area">
		    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'groupgifts'; ?>">How it works</a></span>
		    <button type="button" class="btns-white btn-cancel" id="gglistdone">Cancel</button>
		    <button type="submit" class="btns-blue-embo btn-continue">Continue</button>
		</div>
	    </form>
	</div>
    </div>
    <div class="chept personalize" style="display:none;">

	<h3>Fill in details for group gift</h3>
	<div class="gifts-thing">
	    <figure><img id="listingitemids" src="" /></figure>
	    <figcaption></figcaption>
	    <p class="description"></p>
	    <div class="price">
		<span class="goal" onmouseover="$(this).parents('.price').find('.total').show();" onmouseout="$(this).parents('.price').find('.total').hide();">Goal Total</span>
		<b>$<span class="total_price" style="float:none" id="totalscosts" ></span> <small>USD</small></b>
		<ul class="total">
		    <li><span>Item total</span> <b>$<span class="subtotal_price" id="totalscosts2" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Shipping</span> <b>$<span class="shipping_cost" id="shipscosts" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Tax</span> <b>$<span class="sales_tax" style="float:none">0</span><small>USD</small></b></li>
		</ul>
	    </div>
	</div>
	<div class="frm">
	    <p>
		<label class="label">Title</label>
		<input type="text" class="text" id="ggift-title" placeholder="Ex. Jenny’s birthday present" />
		<span id='title_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> Enter the Title </span>
		 </p>
	    <p>
		<label class="label">Description</label>
		<textarea type="text" class="text" id="ggift-description" placeholder="Ex. Lets celebrate Jenny and give her an amazing gift!"></textarea>
		<span id='description_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> Enter the Description </span>
	    </p>
	    <p class="cmt">Use your group gift description to share more about who you’re raising contributions for and why.</p>
        <p><label class="label">Note</label>
        <input type="text" class="text" id="ggift-note" placeholder="You can leave a personalized note to merchant here." /></p>
	</div>
	<div class="btn-area">
	    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'groupgifts'; ?>">How it works</a></span>
	    <!-- button type="button" class="btns-white btn-back"  id="gglistdone">Go Back</button-->
	    <button type="button" class="btns-blue-embo btn-continue" id="createggift" onclick="createggift()">Create Group Gift</button>
	</div>
    </div>
   
    <div class="chept summary" style="display:none;">
	<div class="share" style="margin:0 72px;text-align:center;">
	    <p><b>Ask your friends to contribute</b></p>
	    <ul>
		
		<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
		<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"     onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
		<li><a style="float: left;margin-left: 5px;" class='google'  href=" alt="Share this on Google+" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  		<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"         onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 		<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 		<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
	
	    </ul>
    </div>
	<h3>Group gift summary</h3>
	<div class="gift">
	    <div class="gift-total">
		<h4>Group Gift Total</h4>
		<ul>
		    <li><span>Item total</span> <b>$<span class="subtotal_price" id="totalscosts3" style="float:none"> </span> <small>USD</small></b></li>
		    <li><span>Shipping</span> <b>$<span class="shipping_cost" id="shipscosts1" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Tax</span> <b>$<span class="sales_tax" style="float:none"></span>0 <small>USD</small></b></li>
		    <li class="total"><span>Goal Total</span> <b>$<span class="total_price" id="totalscosts1" style="float:none"></span> <small>USD</small></b></li>
		</ul>
	    </div>
	    <p class="gift-title"  id="Usergifttitle" ><b></b></p>
	    <p class="gift-description" id="Usergiftdescription"></p>
	    <span class="line"></span><figure><img id="listingitemids1" src="" /></figure>
	    <div class="gift-to">
		
		
		<small>Gift to</small><br />
		<b id="UsergiftNamee" > </b><br />
		<span id="Usergiftcity" > <span>
	    </div>
	</div>
	<div class="btn-area">
	    <span class="notify"><i class="icon"></i> This group gift will be valid for 7 days.</span>
	    <button class="btns-blue-embo btn-continue" id="gglistdone">Done</button>
	</div>
    </div>
</div>


<!--share-social-->
<div id="videourrls" class="popup ly-title share-new"  style="opacity: 1; display: none; width: 645px; margin-left: 318px; margin-top: 75px;">
	 
	<p class="ltit">
		<span >Video</span>
	</p>
	<div class="share-via">
		<?php 
			echo "<div id=\"ytvply\">
					<object width=\"644\" height=\"362\"><param name=\"movie\" value=\"https://www.youtube.com/v/" .$videoID. "?version=3&rel=0&modestbranding=1\"></param>
					<param name=\"allowFullScreen\" value=\"true\"></param>
					<param name=\"allowscriptaccess\" value=\"always\">
					<param name=\"allownetworking\" value=\"internal\"></param>
					<embed src=\"https://www.youtube.com/v/" .$videoID. "?version=3&rel=0&modestbranding=1&hl=en_US\" type=\"application/x-shockwave-flash\" width=\"644\" height=\"362\" allowscriptaccess=\"always\" allowfullscreen=\"true\" allownetworking=\"internal\">
					</embed>
					</object>
					</div>" ;
		?>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->





		<!-- show profile -->
<div id="showprofile"  style="width:350px;" class="popup ly-title update add-to-list">

	<div class="default">
		<p class="ltit">Add Your Fashion on this product</p>
		<button type="button" class="ly-close" id="btn-browses" style="margin-top:0px;"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<?php	echo $this->Form->Create('update',array('url'=>array('controller'=>'/','action'=>'/update'))); ?>
  		
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image">
				<fieldset>
			
				<?php 
					echo '<table border=200>';
					echo "<img id='show_Userurl'  style='float: left;margin-left: 40px;margin-top: 20px;margin-bottom: 50px;width: 220px;height:220px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb350/usrimg.jpg'>";
					echo '</table>';
				?>
					</fieldset>
						</div>
			</div>
			<div class="section photo" style="margin-top:-30px;">
			<h3 class="stit"></h3>
			<fieldset class="frm">
			
				<?php 
				$itemidsed = $item_datas['Item']['id'];
				if(empty($usr_datas['User']['profile_image'])){
					$image_computer = '';
				}else{
					$image_computer = $usr_datas['User']['profile_image'];
				}
				if(session_id() == '') {
					session_start();
				}
				$site = $_SESSION['site_url'];
				$media = $_SESSION['media_url'];
				@$username = @$_SESSION['media_server_username'];
				@$password = @$_SESSION['media_server_password']; 
				@$hostname = $_SESSION['media_host_name'];
				//$site = "http://localhost:9002/fancy/";
				echo "<div class='input-group' style='margin-top:10px;margin-left:10px;display:inline;text-align: center;'>";
						 
						echo '<div class="venueimg" style="padding-left:-100px;height:35px;"><iframe class="image_iframe" id="frame"  style="padding-left:30px;" name="frame" src="'.$this->webroot.'userproduct.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 90px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
							if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left:180px; margin-top: -45px;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
						echo "</div>";
						
					?>
					</div>
					<hr size=2>
				<div id="loadingimgg" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
				<div class="btn-area" style="float: right; margin-top: 10px; margin-right: 82px;">
				<button class="btn-save" id="save_profile_image" onclick="change(<?php echo $itemidsed; ?>)" >Save Fashion</button>
				<span class="checking" style="display:none" ><i class="ic-loading"></i></span>

				</fieldset>
				</div>
			

</form>
</div>
</div>
</div>
<!--  show profile -->
	
</div>
<!-- /popups -->
	
	
	
	
	<script>
	
var comment_status = true;

	$('#btn_close_share').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});
		$('#share-social').hide();
		$('.share-thing').hide();
		
    });

	 $('#btn-browses').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});	
    });


 $(document).keyup(function(e) { 
   if (e.keyCode == 27) { 
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
    }
});

 $(document).click(function() {
	    $('.comment-autocomplete').css("display", "none");
	});	

	$('#invoice-popup-overlay').live ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
	});
</script>
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>


<script>
var invajax=0;

</script>