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
			<li><a sub-menu="help" href="<?php echo SITE_URL; ?>mobileapps"><?php echo __('Mobile');?></a></li>
			<li><a class="current"sub-menu="resources" href="<?php echo SITE_URL; ?>addto"><?php echo __('Resources'); ?></a></li>
			<li><a sub-menu="help" href="<?php echo SITE_URL; ?>help"><?php echo __('Help');?></a></li>
		</ul>
	</div>
	<div class="snb">
		<div style="display:block" class="inner help">
			<p class="hidden"><?php echo __('Help');?></p>
			<ul>
				<li><a class="current" href="<?php echo SITE_URL; ?>addto"><?php echo __('Bookmarklet');?></a></li>
				<!--li><a href="<?php echo SITE_URL; ?>help/contact">Contact</a></li>
				<li><a href="<?php echo SITE_URL; ?>help/copyright_policy"><?php echo __('Copyright Policy'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_of_sale"><?php echo __('Terms of Sale'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of Service'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/terms_merchant"><?php echo __('Terms and Conditions of Merchant Sale'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy'); ?></a></li-->
			</ul>
		</div>
	</div>
</div>
<div class="wrapper help">
	<div class="container faq">
		<h2 class="ptit">
			<?php echo __('Resources');?> /
			<b><?php echo __('Add to ').$setngs[0]['Sitesetting']['site_name'];?></b>
		</h2>
		<div id="content" style="min-height: 89px;">
			<div class="intro">
				<h3><?php echo __('Add to ').$setngs[0]['Sitesetting']['site_name'];?></h3>
				<p>
					<?php echo __('Be a part of the ');
					echo $setngs[0]['Sitesetting']['site_name'];
					echo __(' community and add your favorite things.');?>
				</p>
			</div>
			<div class="faq-chept">
				<h4 id="fantasy" class="stit">"<?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt'].'" ';echo __('Button');?></h4></br>
				
				
				<div style="background: none repeat scroll 0 0 #F0F3F6;border-top: 1px solid #E2E8ED;color: #373D48;display: inline-block;font-size: 16px;line-height: 67px;margin-bottom: 28px;min-width: 602px;padding: 0 14px;">
					<a class="fantacydbtn"	href="javascript:(function(){_my_script=document.createElement('SCRIPT');_my_script.type='text/javascript';_my_script.src='<?php echo SITE_URL; ?>script.js?';document.getElementsByTagName('head')[0].appendChild(_my_script);})();"><?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt']; ?></a>Drag this
					<b><?php echo __('button');?></b>
					<?php echo __('into your Bookmarks Bar');?>
				</div>
				
				<p>
				<strong><?php echo __('The bookmarklet lets you save things and products from any site to your own ').$setngs[0]['Sitesetting']['site_name'].__(' catalog.');?></strong>
				</p>
				<p class="chrome" style="display: none;"><?php echo __('To install the ');
				echo '"'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'"';echo __(' bookmarklet in Chrome, follow these steps:')?></p>
				<p class="firefox"><?php __('To install the ');
				echo '"'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'"';echo __(' bookmarklet in Firefox, follow these steps:');?></p>
			</div>
			<ol>
			
			<li>
				<span class="no"><?php echo __('1');?></span>
				<strong><?php echo __('Drag bookmarklet');?></strong>
				<?php echo __('Drag the blue');?>
				<b><?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt'];?></b>
				<?php echo __('button above to your Bookmarks bar.');?>
			</li>
			<li>
				<span class="no"><?php echo __('2');?></span>
				<strong><?php echo __('You’re finished');?></strong>
				<?php echo __('When you are browsing a webpage, click');?>
				<b><?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt'];?></b>
				<?php echo __('to add things to your personal catalog.');?>
			</li>
			</ol>
			
			
			
	</div>
</div>