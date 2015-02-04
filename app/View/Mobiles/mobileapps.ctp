<div id="header">
	<div class="inner">
		<h1 class="logo" style="margin: 0px; position: relative; width: 134px; top: 6px; right: 1px;">
			<a href="<?php echo SITE_URL; ?>">
			<?php //echo $setngs[0]['Sitesetting']['site_logo'];die; ?>
			<?php 
			if(!empty($setngs[0]['Sitesetting']['site_logo'])){
			echo '<img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_logo'].'" width="130px">';
			}else{
			echo '<img src="'.SITE_URL.'images/logo.png" width="130px">';
			}
			?>
			</a>
		</h1>
		<ul class="gnb">
			<!-- li><a sub-menu="whats" href="/about">About</a></li>
			<li><a sub-menu="business" href="/business">Business</a></li>
			<li><a sub-menu="mobile" href="/mobile">Mobile</a></li-->
			<li><a class="current" sub-menu="help" href="<?php echo SITE_URL; ?>mobileapps">Mobile</a></li>
			<li><a sub-menu="resources" href="<?php echo SITE_URL; ?>addto"><?php echo __('Resources'); ?></a></li>
			<li><a sub-menu="help" href="<?php echo SITE_URL; ?>help">Help</a></li>
		</ul>
	</div>
	<!-- <div class="snb">
		<div style="display:block" class="inner help">
			<p class="hidden">Help</p>
			<ul>
				<li><a class="current" href="<?php echo SITE_URL; ?>addto">Bookmarklet</a></li>
				<!--li><a href="<?php echo SITE_URL; ?>help/contact">Contact</a></li>
				<li><a href="<?php echo SITE_URL; ?>help/copyright_policy"><?php echo __('Copyright Policy'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_of_sale"><?php echo __('Terms of Sale'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of Service'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/terms_merchant"><?php echo __('Terms and Conditions of Merchant Sale'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy'); ?></a></li-->
			<!-- </ul>
		</div>
	</div> -->
</div>
<div class="wrapper mobile">
	<div class="container faq">
		<div id="content" style="min-height: 89px;box-shadow: none; padding: 0px 60px;">
			<div class="mobcontainer">
				<div class="mobimagecontainer alignleft">
					<img src="<?php echo SITE_URL; ?>images/iphone.gif" alt="iPhone" >
				</div>
				<div class="mobdescontainer" >
					<div class="mobdeshead">
						Markit for iPhone & iPad
						</br>
						<span class="mobdessubhead">
							Bring markit experience to all your iOS devices
						</span>
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							Add and view products
						</span>
						</br>
						Anyone can add and buy products form the apps
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							Instant notifications
						</span>
						</br>
						Push notification keeps you active and keeps you markitized
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							Everything you can do
						</span>
						</br>
						All the things are possible whatever you do in markit web
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							Simple checkout system
						</span>
						</br>
						Quickly you can make the payment for anything you like
					</div>
				</div>
				<a href="https://itunes.apple.com/us/app/" target="_blank" title="Markit for iPhone" class="playstorelink">
					<div class="appstore"></div>
				</a>
			</div>
			<div class="mobcontainer" style="padding: 60px 0px 10px;">
				<div class="mobimagecontainer alignright">
					<img src="<?php echo SITE_URL; ?>images/androidphone.gif" alt="Android Mobiles" >
				</div>
				<div class="mobdescontainer mobdescontainerleft" >
					<div class="mobdeshead">
						Markit for Android
						</br>
						<span class="mobdessubhead">
							Markit app for android smartphones and tablets
						</span>
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							All the same features of iOS app
						</span>
						</br>
						It support all the features you have in your iOS device app
					</div>
				</div>
				<a href="https://play.google.com/store/apps/" target="_blank" title="Markit for Android" class="playstorelink">
					<div class="googlestore"></div>
				</a>
			</div>
			<div class="mobcontainer mobcontainerlast alignleft">
				<div class="mobimagecontainer alignleft">
					<img src="<?php echo SITE_URL; ?>images/otherphone.png" alt="Other Mobiles" >
				</div>
				<div class="mobdescontainer" >
					<div class="mobdeshead">
						Markit for other devices
						</br>
						<span class="mobdessubhead">
							Responsive webapp for all other devices
						</span>
					</div>
					<div class="mobdescontent">
						<span class="mobdesconthead">
							Responsive mobile webapp
						</span>
						</br>
						Webapp built on jQuery for all other devices
					</div>
				</div>
			</div>
		</div>
	</div>
</div>