<body class="fantacygrid">
 <header id="header-new">
<div id="notification-bar" class="top after">
	</div>
		<?php
		//echo "<pre>";print_r($giftcardcrted);die;
			//echo "<pre>";print_r($loguser);die;
						//if(empty($loguser)){  ?>
		<div class="inner">
			<div id="navigation-test">
				<div class="menu-left">
					<h1 class="logo" style="margin: 0px; position: relative; width: 182px; top: 0px; right: 0px;">
						<a href="<?php echo SITE_URL; ?>">
						<?php //echo $setngs[0]['Sitesetting']['site_logo'];die; ?>
						<?php echo '<img src="'.SITE_URL.'images/pr.png">';
						if(!empty($setngs[0]['Sitesetting']['site_logo'])){
						echo '<img class="logo-img" src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_logo'].'" width="130px">';
						}else{
						echo '<img class="logo-img" src="'.SITE_URL.'images/logo.png" width="130px">';
						}
						
						 ?>
						</a></h1>
					
				</div>
				<?php  if(!empty($loguser)){  ?>
				<div class="centered" style="margin: 0 auto; width: 70%;min-width:391px;">
				<?php } else {?>
				<div class="centered" style="margin: 0 auto;width: 50%;min-width:390px;">
				<?php } ?>
					<ul class="fantaci-wrap">
						<li class="fantaci">
							<a href="<?php echo SITE_URL; ?>help" class="mn-gifts glyphicons " title="<?php echo __('Help');?>" ><?php echo __('About');?><i class="glyphicons chevron-right headarrdwn"></i></a>
							<div class="menu-contain-gift">
								<ul>
									<li class="">
									<a href="<?php echo SITE_URL; ?>help/contact"><?php echo __('Contact');echo " ".$setngs[0]['Sitesetting']['site_name'];?></a>
									</li>
									<li class="">
									<a href="<?php echo SITE_URL; ?>help/faq"><?php echo __('FAQ');?></a>
									</li> 
								</ul>
								<ul>
									<li class="">
									<a href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of service')?></a>
									</li>
									<li class="">
									<a href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy');?></a>
									</li> 
								</ul>
								<ul>
									<li class="">
									<a href="<?php echo SITE_URL; ?>mobileapps"><?php echo __('Mobile');?></a>
									</li> 
								</ul>
							</div>
						</li>
						<li class="fantaci">
							<a href="#" class="mn-gifts glyphicons " title="<?php echo __($_SESSION['currency_code']);?>" ><?php echo __($_SESSION['currency_code']);?><i class="glyphicons chevron-right headarrdwn"></i></a>
							<div class="menu-contain-gift">
								<?php $count = count($forexrateModel);
								if ($count > 6){ ?>
								<ul style="height:145px; overflow-y:scroll;">
								<?php 
									foreach ($forexrateModel as $forexrate){ ?>
									<li class="">
										<a href="<?php echo SITE_URL."changecurrency/".$forexrate['Forexrate']['currency_code']; ?>" > 
											<?php echo $forexrate['Forexrate']['currency_code']; ?>
										</a>
									</li>
								<?php } ?>
								</ul>
								<?php } 
								else { ?>
								<ul>
								<?php 
									foreach ($forexrateModel as $forexrate){ ?>
									<li class="">
										<a href="<?php echo SITE_URL."changecurrency/".$forexrate['Forexrate']['currency_code']; ?>" > 
											<?php echo $forexrate['Forexrate']['currency_code']; ?>
										</a>
									</li>
								<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</li>
						<?php if(empty($loguser)){  ?>
						<?php if ($_SESSION['language_settings']['settings']['multilingual'] == 'yes'){ ?>
						<li class="fantaci">
            	<?php echo $this->Html->link(' ', array('language'=>'eng'), array('class'=>'mn-signin  glyphicons globe_af','title'=>'Language'));  ?>
							<div class="menu-contain-gift">
								<ul>
								<?php 
								$languages = $_SESSION['language_settings']['languages'];
								foreach ($languages as $langkey => $language){
								?>
									<li class="">
										<a href="<?php echo SITE_URL.$language; ?>/users/index" ><?php echo $langkey; ?></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						<!-- <i class="ardown"></i> -->
						</li>
					    <?php } }?>
						<li class="fantaci">
							<!-- <a href="/gifts" class="mn-gifts">Gifts</a> -->
							<a href="<?php echo SITE_URL; ?>shop/browse/" class="mn-gifts glyphicons " style="width: auto ! important;" title="<?php echo __('Shop'); ?>"><?php echo __('Shop'); ?><i class="glyphicons chevron-right headarrdwn"></i></a>
							<div class="menu-contain-gift">
								<ul>
									<li class="">
									<a href="<?php echo SITE_URL; ?>create/giftcard"><?php echo __('Gift Cards'); ?></a>
									</li>
									<li class="">
									<a href="<?php echo SITE_URL; ?>groupgifts"><?php echo __('Group Gifts'); ?></a>
									</li>
									<li class="">
									<a href="<?php echo SITE_URL; ?>recomendations/browse"><?php echo __('Recommendations'); ?></a>
									</li>
								</ul>
								<ul>
									<li><a href="<?php echo SITE_URL; ?>price/"><?php echo __('By Price'); ?><div style="margin: -28px 0 0 107px;"><i class="glyphicons chevron-right subheadarrdwn" ></i></div></a>
										<div class="submenu-contain price-submenu">
											<ul>
											<?php 
										
											foreach($price as $pri){
												echo  '<li><a href="'.SITE_URL.'price/'.$pri['Price']['from'].'-'.$pri['Price']['to'].'">'.$_SESSION['currency_symbol'].$pri['Price']['from'].' - '.$pri['Price']['to'].' </a></li>';
											
											}
											?>
											</ul>
										</div>
									</li>
									<li><a href="<?php echo SITE_URL; ?>color/" class="color-red"><?php echo __('By color'); ?><div style="margin: -28px 0 0 107px;"><i class="glyphicons chevron-right subheadarrdwn" ></i></div></a>
										<div class="submenu-contain color-submenu">
											<ul class="palette">
												<?php
													foreach($colors as $clr){
														echo '<li><a href="'.SITE_URL.'color/'.$clr['Color']['color_name'].'"><i class="color '.$clr['Color']['color_name'].'" style="background-color:'.$clr['Color']['color_hex'].'!important;" ></i>';echo __($clr['Color']['color_name']); echo '</a></li>';
													}
												?>
											
											</ul>
										</div>
									</li>
									<li><a href="<?php echo SITE_URL; ?>shop/browse/"><?php echo __('By Category'); ?><div style="margin: -28px 0 0 107px;"><i class="glyphicons chevron-right subheadarrdwn"></i></div></a>
										<div class="submenu-contain category-submenu">
											<ul>
												<?php
													foreach($parent_categori as $cate){
														echo '<li><a href="'.SITE_URL.'shop/'.$cate['Category']['category_urlname'].'">'; echo __($cate['Category']['category_name']); echo '</a></li>';
													}
												?>
												
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
						
										                   
						 
						 
						 <li class="fantaci">
							<a href="#" onclick="getLatLong(50)" class="mn-gifts glyphicons " title="<?php echo __('Near Me');?>" ><?php echo __('Near Me');?><i class="glyphicons chevron-right headarrdwn"></i></a>
							<div class="menu-contain-gift">
								<ul>
									<li class="">
										<a href="#" onclick="getLatLong(1)" > 1 <?php echo __('KiloMeter');?></a>
									</li>
									<li class="">
										<a href="#" onclick="getLatLong(5)" > 5 <?php echo __('KiloMeters');?></a>
									</li>
									<li class="">
										<a href="#" onclick="getLatLong(10)" >10 <?php echo __('KiloMeters');?></a>
									</li>
									<li class="">
										<a href="#" onclick="getLatLong(50)" >50 <?php echo __('KiloMeters');?></a>
									</li>
									<li class="">
										<a href="#" onclick="getLatLong(100)" >100 <?php echo __('KiloMeters');?></a>
									</li>
									<li class="">
										<a href="<?php echo SITE_URL; ?>" ><?php echo __('All');?></a>
									</li>
								</ul>
								
							</div>
						</li>
						

						 
						<?php /* if(empty($loguser)){  ?>
						<li class="fantaci"><a href="<?php echo SITE_URL; ?>signup" class="mn-add glyphicons user_add " title="<?php echo __('Sign Up');?>"><!-- img src="<?php echo SITE_URL; ?>images/usrsignup.png" style="margin: 0px 0px -2px -5px;" --> <?php //echo __('Sign Up'); ?></a></li>
						<?php } */	?>	

					</ul>
				
				</div>
				
				
				
				<div class="right">
					<ul class="fantaci-wrap">
					<?php if(empty($loguser)){  ?>
					
						<li class="fantaci"><a href="<?php echo SITE_URL; ?>signup" class="mn-add glyphicons " title="<?php echo __('Sign Up');?>"><!-- img src="<?php echo SITE_URL; ?>images/usrsignup.png" style="margin: 0px 0px -2px -5px;" --> <?php echo __('Sign Up'); ?></a></li>
						
						<li class="fantaci"><a href="<?php echo SITE_URL; ?>login" class="mn-signin glyphicons " title="<?php echo __('Sign In');?>" ><?php echo __('Sign In'); ?></a></li>
					

					
					<?php
					}else{
					?>
					
					
					<?php  if(!empty($loguser)){  ?>
					<!--li class="fantaci"><a href="<?php echo SITE_URL; ?>create/item" class="mn-add">Add</a></li-->    
                        <li class="fantaci"><a href="#" onclick="itemadd()" class="mn-add" title="<?php echo __('Add'); ?>"><i class="glyphiconsheader plus" style="padding:0;"></i><?php echo __('Open your Store'); ?></a></li>   
                    <?php	}	?>	
					
	<!--    sathish for notification  -->
					<li class="notify fantaci " id="noti" onmouseover="shownoti()">
				<?php
			//echo "<pre>";print_r($logedvalues);die;
								echo '<a href="'.SITE_URL.'push_notifications" class="mn-gifts glyphicons bell " title="Notifications">';
								//echo '<img src="'.SITE_URL.'images/micnot.png" style="width: 20px; margin-top: 10px;" >'; 
								echo '</a>';
							echo '<div class="feed-notification" id="feed" style="display: none;width:350px;margin-left:-180px;height:auto;">';

							echo '<i class="arrow"></i>';
								echo '<h4>Notifications</h4>';
								echo '<div class="loading" style="display: none;">';
								echo '<i></i>';
								echo '</div>';
								echo '<ul>';
				?>			
						<div id="pushappend"></div>
						<?php 		
						
						
						//echo '<a class="more" href="'.SITE_URL.'push_notifications" style="margin-top:18px;">See all notifications</a>';
								echo '</div>';
								
							?>
					</li>		
					
						<!--   notification ended by sathish -->
					<li class="fantaci">
					<?php 
					$roundProf = "";
					if ($siteChanges['profile_image_view'] == "round") {
						$roundProf = "border-radius:10px;";
					}
					if(!empty($UserDetailss['User']['profile_image'])){
						$usrrrImg = $UserDetailss['User']['profile_image'];
					}else{
						$usrrrImg = 'usrimg.jpg';
					}	
					echo '<a href="'.SITE_URL.'people/'.$username_url.'" class="mn-gifts">'?><?php echo __('You '.$UserDetailss['User']['username']); echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$usrrrImg.'" width="35px" height="35px" style="margin: -14px 5px;'.$roundProf.'" /></a>'; 
					
					
					/* if(!empty($loguser[0]['User']['profile_image'])){
						echo '<a href="'.SITE_URL.'people/'.$username_url.'" class="mn-gifts">'.ucwords($loguser[0]['User']['first_name']).'<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$loguser[0]['User']['profile_image'].'" width="20px" height="20px" style="margin: -5px 5px;'.$roundProf.'" /></a>';
					}else{
						echo '<a href="'.SITE_URL.'people/'.$username_url.'" class="mn-gifts">'.ucwords($loguser[0]['User']['first_name']).'<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" width="20px" height="20px" style="margin: -5px 5px;'.$roundProf.'" /></a>';
					} */
					?>
							<?php //echo "<img class='photo' style='display:block;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$loguser[0]['User']['profile_image']."'  >"; ?>
							<?php //echo $this->Html->link(ucwords($username),array('controller'=>'/','action'=>'/people/'.$username_url),array('class'=>'mn-gifts')); ?>
							<div class="menu-contain-you">
								<ul>									
									<li><a href="<?php echo SITE_URL; ?>search/people"><?php echo __('Find Friends');?></a></li>
									<li><a href="<?php echo SITE_URL; ?>invite_friends"><?php Echo __('Invite Friends');?></a></li>
								</ul>
								
								<ul>
									<li><a href="<?php echo SITE_URL; ?>group-gift-lists"><?php echo __('Group Gift List');?></a></li>
								</ul>
								
								<ul>
									<li><a href="<?php echo SITE_URL; ?>purchases"><?php echo __('Track Orders');?></a></li>
									<li><a href="<?php echo SITE_URL; ?>settings"><?php echo __('Settings');?></a></li>
									<li><a href="<?php echo SITE_URL; ?>logout"><?php echo __('Sign out');?></a></li>
								</ul>
							</div>
						</li>	
					<li class="my-cart fantaci" onmouseover="showcarthov()">
					<?php if(!empty($giftcarduseradded)){
						$total_itms += $countgiftcarduseradded;
					}else{
						$total_itms = $total_itms;
					}
					?>
						<a href="<?php echo SITE_URL; ?>cart" class="mn-cart glyphicons shopping_cart"><!-- <span class="cart-icon"></span> -->
						<span class="blue totalItemsCart"  style="margin-right:6px;"><?php echo $total_itms; ?> <?php echo __('item');?>(s)</span></a>
						<div class="menu-contain-cart" id="cartmousehoverval">
							<div id="loading_imgcart" style="display:none;text-align:center;">
								<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
							</div>
						</div>
					</li>
						
						<?php } ?>
						<form action="" class="search">
					    <fieldset>
						    <input type="text" name="q" class="text" id="search-query" placeholder="<?php echo __('Search');?>" value="" autocomplete="off" onkeyup="indexSearch(event);">
						    <button type="button" class="btn-submit" onclick="indcall(event);"><?php echo __('Search');?></button>
						    <div class="feed-search">
							    <h4><?php echo __('Suggestions');?></h4>
							    <div class="loading"><i></i></div>
							    <ul class="thing">
							    </ul>
							    <ul class="user">
							    </ul>
							    <input type="button" value="<?php echo __('Search');?>" class="searchbttn" onclick="indcall(event);">
							    <!--<a href="#" class="more">See full search results</a>-->
						    </div>
					    </fieldset>
					    </form>
					</ul>
				</div>
			</div>
		</div>
		<!-- / inner -->
		
	</header>
	<!-- / header -->
		</div>
		









	
<!-- popups -->
<div id="popupforadditem" style="display:none;">
<!-- add_to_list overlay -->
<div id="itemaddid"  style="display:none;" class="popup ly-title update add-to-items">
	<div class="default">
		<p class="ltit" style="top: 3px;"><?php echo __('Add to');?> <?php echo $setngs[0]['Sitesetting']['site_name']; ?></p>
		<ul class="fromweb">
			<li>
				<a href="#">
				<span class="webupload" id="webupload"></span>
				<?php echo __('Web');?>
				</a>
			</li>
			<li>
				<a href="<?php echo SITE_URL; ?>create/item">
				<span class="deskupload"></span>
				<?php echo __('Upload');?>
				</a>
			</li>
			<li>
				<a href="mailto:info@simplit.co" >
				<span class="mailupload"></span>
				<?php echo __('Email');?>
				</a>
			</li>
		</ul>
	
	</div>
	<button class="ly-closebtnn" id ="closebtnn" title="Close">
		<img alt='Close' src="<?php echo SITE_URL; ?>images/closebt.png">
	</button>
</div>


<div id="termsConditions"  style="display:none;" class="popup ly-title update add-to-items">
	<div class="default">
		<p class="ltit" style="top: 3px;"><?php echo __('Terms and Conditions');?></p>
		<div class="fromweb">
			<div class="total_dl">
				<div class="dtit">
					<?php echo $condition;?>
					
				</div>
			</div>
		</div>
	</div>
	<button class="getimg" id="agree" style="margin:-36px 30px 0px 0px;float:right;"><?php echo __('Agree');?></button>
	<button class="redbtn"  id="disagree" style="margin:-36px 105px 0px 0px;float:right; color:red;"><?php echo __('Disagree');?></button>
		
</div>


<div id="itemurls"  style="display:none;" class="popup ly-title update add-to-items">
	<div class="default">
		<p class="ltit" style="top: 3px;"><?php echo __('Add from Web');?></p>
		<div class="fromweb">
			<p>
				<label style="margin-left: 10px;"><?php echo __('Enter an image link or a website address');?></label>
				<input class="text_url" id="text_url" type="text" placeholder="http://" value="" style="width: 550px; margin-left: 7px; margin-top: 10px;">
			</p>
			
		<div class="btns-area">
		<div id="loading_img" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>images/loading_blue.gif">
				</div>
			<button class="getimg" id="getimg"><?php echo __('Get Images');?></button>
			<a id="gobacktomain" href="#" style="padding-top: 25px; float: right; margin-right: 12px;"><?php echo __('Go Back');?></a>
		</div>
			
			
		</div>
	
	</div>
	<button class="ly-closebtnn" id ="closebtnn1" title="Close">
		<img alt='Close' src="<?php echo SITE_URL; ?>images/closebt.png">
	</button>
</div>



<div id="item_views"  style="display:none;" class="popup ly-title update add-to-items">
	<div class="default">
		<p class="ltit" style="top: 3px;"><?php echo __('Add from Web');?></p>
		<div class="fromweb">
			<div class="total_dl">
				<div class="dtit">
					<?php echo __('Thing Details');?>
					<small>(<?php echo __('Can be changed later');?>)</small>
				</div>
			
			
			
			<div class="dbodyim">
				<div class="imgbody">
				<div class="img_wrapp">
					<img class="images_orig" id="images_orig" src="">
				</div>
				<span class="controls" style="display: block;">
				<button class="prev" id="prev_img">
				<span class="leftarrow" ></span>
				</button>
				<button class="next"  id="next_img">
				<span class="rightarrow"></span>
				</button>
				<span class="cur_"> <span id="first_value"></span> <?php echo __('of');?> <span id="totlcnt"></span></span>
				</span>
				</div>
				<div class="frm">
				<label><?php echo __('Title');?> *</label>
				<input id="additem_title" class="input-text" type="text">
				<label><?php echo __('Price');?> *</label>
				<input id="additem_prices" class="input-text" type="text">
				<label><?php echo __('Web Link');?> *</label>
				<input id="givenlink" class="input-text" type="text" placeholder="http://">
					<label><?php echo __('Category');?> *</label>
					<select id="categoryname" class="selectboxforitemadd">
					<option value=""><?php echo __('Choose a category');?></option>
					
					
					<?php
						foreach($parent_categori as $cate){
							echo '<option value="'.$cate['Category']['id'].'">'.$cate['Category']['category_name'].'</option>';
						}
					?>
					
					
					</select>
				
				</div>
					<textarea id="additems_notes" placeholder="Say something about this" maxlength="200"></textarea>
			</div>
			
			<div class="btns-area">
		<div id="loading_img_save" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>images/loading_blue.gif">
				</div>
			<button class="getimg" id="saveimgs"><?php echo __('Save Details');?></button>
			<a id="gobacktomain1" href="#" style="padding-top: 25px; float: right; margin-right: 12px;"><?php echo __('Go Back');?></a>
		</div>
			
			
		</div>
	
		</div>
	</div>
	<button class="ly-closebtnn" id ="closebtnn2" title="Close">
		<img alt='Close' src="<?php echo SITE_URL; ?>images/closebt.png">
	</button>
</div>




</div>
<!-- /popups -->




	
	
	
	
	
		
		
		
		<div id="content" style="box-shadow:none;">
		<div id="flashmsg">
			<?php echo $this->Session->flash(); 
			echo $this->Session->flash('good');
			echo $this->Session->flash('bad');?>
		</div>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="backtotop"><?php echo __('Scroll to Top'); ?></div>
	<?php //echo $this->element('sql_dump'); ?>
	
	
	<script>
	var	url_status=true;
	var item_save = true;
	var pushnoii = true;
	var cartnoii = true;
	</script>
	
	
	<!--Start of Zopim Live Chat Script
	<!--script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?1S5DrbCtlRSufVcPziI3FA3qLdYM6UqT';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script-->
	<!--End of Zopim Live Chat Script-->
	
	
	<div id="footer-container">
		<span class="website">
			<?php
				if($setngs[0]['Sitesetting']['footer_active']=="yes")
				{
					echo stripslashes($setngs[0]['Sitesetting']['footer_left']);
				}
			?>
		</span>
		<span class="poweredby">
			<?php
				if($setngs[0]['Sitesetting']['footer_active']=="yes")
				{
					echo stripslashes($setngs[0]['Sitesetting']['footer_right']);
				}
			?>
		</span>
	</div>
	
</body>
<?php 
if($googlecode[0]['Googlecode']['status'] == 'yes') {
echo "<pre>";print_r($googlecode[0]['Googlecode']['google_code']);
}
 ?>
