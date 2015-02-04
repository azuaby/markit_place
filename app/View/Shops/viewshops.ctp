<?php
	echo "<div class='container'>";
		echo "<div class='content content-wrap-inner clear'>";
			echo "<div class='secondarys v2'>";
				echo "<div class='v2'>";
			?>
					<div class="section" id="shop-owner">
						<h3>Shop Owner</h3>
						<?php
							if($usrdts['User']['id'] == $userid){
								echo $this->Html->link('Edit Profile',array('controller'=>'/','action'=>'/manage/profile/'.$usrdts['User']['username_url']));
							}
						?>
						<ul>						
							<li class="user clear">
								<div class="">
									<a href="<?php echo SITE_URL; ?>people/<?php echo $usrdts['User']['username_url']; ?>?ref=owner_profile">
										<?php
										if(empty($usrdts['User']['profile_image'])){
										?>
										<img width="75" height="75" src="<?php echo SITE_URL;?>avatars/original/usrimg.jpg">
										<?php }else{ ?>
										<img width="75" height="75" src="<?php echo SITE_URL;?>avatars/thumb70/<?php echo $usrdts['User']['profile_image']; ?>">
										<?php } ?>
									</a>
								</div>

								<div class="shop-info clear">
									<div class="">
										<a class="username" href="<?php echo SITE_URL; ?>people/<?php echo $usrdts['User']['username_url']; ?>?ref=owner_profile">
											<?php
												echo $usrdts['User']['username'];
											?>
										</a>
									</div>

									<div class="location">
										<?php
											if(!empty($usrdts['User']['location'])){
											echo $usrdts['User']['location'];
											}
										?>
									</div>
								</div>
								<!--
								<div class="contact clear">
									<a href="http://www.etsy.com/conversations/new?with_id=15124789&amp;ref=owner_contact_leftnav" data-convo_source="shop_convo_from_seller_info" data-to_user_display_name="    Julie
										from MoonlightShimmer
										" data-to_user_id="15124789" data-to_username="MoonlightShimmer" class="button-medium convo-overlay-trigger inline-overlay-trigger contact-action" rel="#convo-overlay">
											Contact
									</a>
								</div>
								-->
							</li>

							<li class="favourites">
								<?php
									echo '<li>'.$this->Html->link('Favourites',array('controller'=>'/','action'=>'/people/'.$name.'/favourites')).'</li>';
								?>
							</li>

							<li class="circles">
								<a href="<?php echo SITE_URL; ?>people/<?php echo $usrdts['User']['username_url']; ?>/followers">
									Followers: <?php echo $totl_flwrs; ?>
								</a>
							</li>
						<!--
							<li class="feedback">
								<a href="<?php echo SITE_URL; ?>people/MoonlightShimmer/feedback?ref=owner_feedback_leftnav">
									Feedback:
									<span id="feedback-data">126, 100% pos.</span>
								</a>
							</li>
						-->	
						</ul>
					</div>
					
					<div class="section" id="shop-info">
						<h3>Shop Info </h3>
						<ul>
							<li class="shopname">
								<?php if(empty($shop_dats['Shop']['shop_name'])){
										echo '<a href="'.SITE_URL.'shop/'.$usrdts['User']['username'].'"><span></span>'.$usrdts['User']['username'].'</a>';
									}else{
										echo '<a href="'.SITE_URL.'shop/'.$shop_dats['Shop']['shop_name'].'"><span></span>'.$shop_dats['Shop']['shop_name'].'</a>';
									}
									
									if(!empty($shop_dats['Shop']['created_on'])){
								?>	
								<div class="join-date">
									<?php echo date('d F,Y',strtotime($shop_dats['Shop']['created_on'])); ?>
								</div>
								<?php } ?>
							</li>
							<li class="about">
								<?php
									if(!empty($shop_dats['User']['about'])){
										//echo $this->Html->link('About',array('controller'=>'/','action'=>));
									}
								?>
							</li>
							<li class="policies">
								<?php
									if(!empty($shop_dats['User']['payment_policy']) && !empty($shop_dats['User']['shipping_policy']) && ($usrdts['User']['id'] == $userid)){
										echo $this->Html->link('Policies',array('controller'=>'/','action'=>'/shop/'.$name.'/policy'));
										echo $this->Html->link('Edit Policies',array('controller'=>'/','action'=>'/policies/'.$name));
									}else{
										echo $this->Html->link('Policies',array('controller'=>'/','action'=>'/policies/'.$name));
									}
								?>
							</li>	
							<li class="sales">
								<a href="/shop/MoonlightShimmer/sold?ref=shopinfo_sales_leftnav"> 
									106 sales
								</a>
							</li>
											
							<li class="admirers">
								<a href="http://www.etsy.com/shop/MoonlightShimmer/favoriters?ref=shopinfo_favorites_leftnav">
									1000 admirers
								</a>
							</li>
						</ul>
					</div>
					
					<div class="section" id="shop-tools">
						<h3>Actions</h3>
						<ul>
							<li class="fave text-link clear" id="favorite-seller">
								<div class="button-fave-container">
								<?php
								if($usrdts['User']['id'] != $userid){ 
									if($shopfavs <= 0){
										$clsa = 'shop-favorite';
										$shptxt = 'Add shop to favourites';
									}else{
										$clsa = '';
										$shptxt = 'Shop added to favourites';
									}
								?>	
									<button type="button" id="shop-favorite" class="inline-overlay-trigger favorite-shop-action <?php echo $clsa; ?>"><span class="label"><?php echo $shptxt; ?></span></button>
								<?php
								}								
								?>	
								</div>
							</li>
							
							<li id="hearts-me">
								<a href="/shop/MoonlightShimmer/favoriters?ref=actions_favorited_leftnav">
								<span class="icon"></span><span class="label">See who favourites this</span></a>
							</li>
							<?php if($usrdts['User']['id'] != $userid){  ?>
							<li id="item-reporter">
								<div id="reporter-link-container">
									<a href="#">Report this shop to Etsy</a>
								</div>
								
								<div id="reporter-complete-container">
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
			<?php
				echo "</div>";
			echo "</div>";
		?>
			
			<div class="primarys">
				<div class="shop-identity-section sis">
					<div class="banner">
						<div id="shop_banner">
							<?php
							if(!empty($shop_dats['Shop']['shop_banner'])){
							echo '<a href="'.SITE_URL.'shop/'.$shop_dats['Shop']['shop_name'].'">';
								echo '<img width="760" height="100" src="'.SITE_URL.'shopsimg/thumb760/'.$shop_dats['Shop']['shop_banner'].'">';
							echo '</a>';
							}
							?>
						</div>
					</div>
				</div>
				
				<div class="info clear ">
					<div class="clear">
						<table>
							<tbody><tr class="with-fb with-tw">
								<td class="name-title">
									<h1 class="shop-name">
										<?php
											if(!empty($shop_dats['Shop']['shop_name'])){
										?>	
											<a href="<?php echo SITE_URL; ?>shop/<?php echo $shop_dats['Shop']['shop_name']; ?>">														
												<span class="shopname wrap ">
													<?php echo $shop_dats['Shop']['shop_name']; ?>
												</span>
											</a>
										<?php
										}else{
										?>
											<a href="<?php echo SITE_URL; ?>shop/<?php echo $usrdts['User']['username_url']; ?>">														
												<span class="shopname wrap ">
													<?php echo $usrdts['User']['username']; ?>
												</span>
											</a>
										<?php
										}										
										 if($usrdts['User']['id'] == $userid){
											echo $this->Html->link('Edit',array('controller'=>'/','action'=>'your/shops/name'),array('class'=>'inline-edit-link'));
										} ?>
									</h1>
									
									<h2 class="shop-title">
										<?php
										if(!empty($shop_dats['Shop']['shop_title'])){
											echo $shop_dats['Shop']['shop_title'];
										}
										if($shop_dats['Shop']['user_id'] == $userid){
											if(!empty($shop_dats['Shop']['shop_name'])){
											echo $this->Html->link('Edit',array('controller'=>'/','action'=>'your-shop-details/'.$shop_dats['Shop']['shop_name']),array('class'=>'inline-edit-link'));
											}else{
											echo $this->Html->link('Add Shop Details',array('controller'=>'/','action'=>'your-shop-details/'.$shop_dats['User']['username_url']),array('class'=>'inline-edit-link'));
											}
										} 
										?>
									</h2>
								</td>
							
								<!--
								<td class="actions">
									<fb:like ref="like_button" show_faces="false" layout="button_count" scrolling="no" height="25" data-width="90" href="http://www.facebook.com/madebymanos" id="share1-fb-like" fb-xfbml-state="rendered" class="fb_edge_widget_with_comment fb_iframe_widget"><span style="height: 20px; width: 74px;"><iframe scrolling="no" id="f3d92cbe0681b0a" name="f1b6e07d4211cc" style="border: medium none; overflow: hidden; height: 20px; width: 74px;" title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php?api_key=89186614300&amp;locale=en_US&amp;sdk=joey&amp;ref=like_button&amp;channel_url=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D22%23cb%3Df5c2095f2fdc2%26origin%3Dhttp%253A%252F%252Fwww.etsy.com%252Ff9a08d706ebc24%26domain%3Dwww.etsy.com%26relation%3Dparent.parent&amp;href=http%3A%2F%2Fwww.facebook.com%2Fmadebymanos&amp;node_type=link&amp;width=90&amp;layout=button_count&amp;colorscheme=light&amp;show_faces=false&amp;extended_social_context=false"></iframe></span></fb:like>
								</td>
							
								<td class="actions">												
									<div data-share-from="shop" class="twitter-follow">
										<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1366232305.html#_=1366336962183&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=manoskalamenios&amp;show_count=true&amp;show_screen_name=false&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 160px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe>
									</div>
								</td>
								-->
							</tr>
						</tbody></table>
					</div>
				</div>
				
				<div class="announcement">
					<span class="arrow"></span>
					<?php
					if(!empty($shop_dats['Shop']['shop_announcement'])){							
						echo '<a class="overlay-nonmodal-trigger popup" rel="shop-announcement-overlay" id="shop-announcement-clickable" href="#">';
							echo $shop_dats['Shop']['shop_announcement'];	
							echo "&nbsp;&nbsp;&nbsp;&nbsp;<span>read more</span>";																
						echo '</a>';
					}
					?>
				</div>		
				
				
				<div class="popupbox3 overlay" id="shop-announcement-overlay">
					<div id="intabdiv3">

						<div class="overlay-header">
							<h2>soap's Shop Announcement</h2>
						</div>
						<div class="overlay-body">
							<?php
								echo $shop_dats['Shop']['shop_announcement'];																
							?>
						</div>
						<div class="overlay-footer">
							<div class="primary-actions">
								<a class="button-medium close" href="#"><span>Close</span></a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="sort_header clear" id="listings-header">

					<?php
						if(!empty($shop_dats['Shop']['shop_name'])){
							$shpnme_url = $shop_dats['Shop']['shop_name']; 
						}else{
							$shpnme_url = $usrdts['User']['username_url']; 
						}
						echo $this->Form->create('shopsrch', array('type'=>'get','url' => array('controller' => '/', 'action' => '/shop/'.$shpnme_url)));
					?>
						<input type="text" placeholder="Search in this shop" value="" class="text" name="search_query">
						<input type="hidden" value="custom" name="order">
						<input type="hidden" value="gallery" name="view_type">
						<?php
						echo $this->Form->submit('Search',array('div'=>false));
						
						echo $this->Form->end();
					?>

					<div class="sort-controls">
						<div class="sort-options">
							<label>
								Sort by:
							</label>
							<div class="dropdown">
							<?php switch ($orderby) {
									case 'custom':
										echo '<a class="dropdown-selected dropdown-toggle" role="button" data-toggle="dropdown" href="#">Custom<b class="caret"></b></a>';
										break;
									case 'Most Recent':
										echo '<a class="dropdown-selected dropdown-toggle" role="button" data-toggle="dropdown" href="#">Most Recent<b class="caret"></b></a>';
										break;
									case 'Lowest Price':
										echo '<a class="dropdown-selected dropdown-toggle" role="button" data-toggle="dropdown" href="#">Lowest Price<b class="caret"></b></a>';
										break;
									case 'Highest Price':
										echo '<a class="dropdown-selected dropdown-toggle" role="button" data-toggle="dropdown" href="#">Highest Price<b class="caret"></b></a>';
										break;
								} ?>
							<!--<a class="dropdown-selected dropdown-toggle" role="button" data-toggle="dropdown" href="#">Custom<b class="caret"></b></a>	
							<div class="dropdown-selected">
									<span>Custom</span>
								</div>-->
								<ul class="dropdown-options dropdown-menu" role="menu" aria-labelledby="dLabel">
									<!--<span class="pointer"></span>-->
									<li>
										<a class="order_button  selected" data-order="custom" href="<?php echo SITE_URL; ?>shop/<?php echo $name; ?>?ref=seller_info&amp;order=custom&amp;page=1">
											<span>Custom</span></a></li>
									<li>
										<a class="order_button " data-order="Most Recent" href="<?php echo SITE_URL; ?>shop/<?php echo $name; ?>?ref=seller_info&amp;order=Most Recent&amp;page=1">
											<span>Most Recent</span></a></li>
									<li>
										<a class="order_button " data-order="Lowest Price" href="<?php echo SITE_URL; ?>shop/<?php echo $name; ?>?ref=seller_info&amp;order=Lowest Price&amp;page=1">
											<span>Lowest Price</span></a></li>
									<li class="last">
										<a class="order_button " data-order="Highest Price" href="<?php echo SITE_URL; ?>shop/<?php echo $name; ?>?ref=seller_info&amp;order=Highest Price&amp;page=1">
										<span>Highest Price</span></a></li>
								</ul>
							</div>
						</div>
					<!--
						<ul class="view-options">
							<li class="gallery">
								<a data-type="gallery" title="Gallery view" class="view_type_button selected" href="http://www.etsy.com/shop/jeremymiranda?ref=seller_info&amp;view_type=gallery"><span>
									Gallery
								</span></a>

							</li>
							<li class="list">
							<a title="List view" data-type="list" class="view_type_button " href="http://www.etsy.com/shop/jeremymiranda?ref=seller_info&amp;view_type=list"><span>
							List</span></a>
							</li>
						</ul>
					-->	
					</div>
				</div>
				<!--<div id="featured-listings-header">Items from </div>-->
				<div id="listing-wrapper" class="clear">
					<?php if(!empty($item_dats)){ ?>
						<ul class="clear listings">
							<?php
							foreach($item_dats as $ky=>$itemsd){
							?>
								<li class="listing-card" id="lid<?php echo $itemsd['Item']['id']; ?>">    
									<a title="<?php echo $itemsd['Item']['item_title']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active" class="listing-thumb">
										<img width="170" height="135" alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo SITE_URL;?>photos/thumb150/<?php echo $itemsd['Photo'][0]['image_name']; ?>">
									</a>					
									<div class="listing-detail ">
										<div class="listing-title">
											<div class="listing-giftcard-icon hidden"></div>							
												<a title="<?php echo $itemsd['Item']['item_title']; ?>" class="title" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active">
													<?php echo $itemsd['Item']['item_title']; ?>
												</a>
												<div class="listing-maker">
													<?php
													if(!empty($itemsd['Shop']['shop_name'])){
														$shpnme = $itemsd['Shop']['shop_name']; 
														$shpnme_url = $itemsd['Shop']['shop_name']; 
													}else{
														$shpnme = $itemsd['User']['username']; 
														$shpnme_url = $itemsd['User']['username_url']; 
													}
													echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/shops/'.$shpnme_url));
													?>
												</div>
											</div>
											<div class="listing-price" style="width:auto;top:0;">
												<span class="currency-symbol">$</span><span class="currency-value"><?php echo $itemsd['Item']['price'];?></span> <span class="currency-code">USD</span>
											</div>
										</div>
										<div class="hide-link">
											<!--<a href="https://www.etsy.com/signin?from_page=http%3A%2F%2Fwww.etsy.com%2Fshop%2Fjeremymiranda%3Fref%3Dseller_info" title="Add item to favourites" data-downtime-overlay-type="favorite" class="button-favorite listing-favorite inline-overlay-trigger casanova-action"><span>favourite</span></a>-->
										</div>
									
								</li>
							<?php
							}
							?>	
						</ul>
					<?php
					}else{
						echo "<div class='not_found_cls'>";
							echo "<center>No items found for your search</center>";
						echo "</div>";
					}
					?>
				</div>
			</div>
<?php		
		echo "</div>";
	echo "</div>";
	
	if(!empty($loguser)){
		echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
	}else{
		echo "<input type='hidden' id='loguserid' value='0' />";
	}
	
	echo '<input type="hidden" id="shopid" value="'.$shop_dats['Shop']['id'].'" />';
?>

<div id="fade"></div>


<script>
	$(document).ready(function() {
  		$('.dropdown-toggle').dropdown();
		// Here we will write a function when link click under class popup      
		$('a.popup').click(function() {
		  
		  
			// Here we will describe a variable popupid which gets the
			// rel attribute from the clicked link      
			var popupid = $(this).attr('rel');
			  
			  
			// Now we need to popup the marked which belongs to the rel attribute
			// Suppose the rel attribute of click link is popuprel then here in below code
			// #popuprel will fadein
			$('#' + popupid).show();
			  
			  
			// append div with id fade into the bottom of body tag
			// and we allready styled it in our step 2 : CSS
			$('body').append('<div id="fade"></div>');
			$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
			  
			  
			// Now here we need to have our popup box in center of
			// webpage when its fadein. so we add 10px to height and width
			var popuptopmargin = ($('#' + popupid).height() + 10) / 2;
			var popupleftmargin = ($('#' + popupid).width() + 10) / 2;
			  
		  
		// Then using .css function style our popup box for center allignment
			$('#' + popupid).css({
				'margin-top' : -popuptopmargin,
				'margin-left' : -popupleftmargin
			});
		});
	});

</script>
