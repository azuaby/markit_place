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
			<li><a sub-menu="resources" href="<?php echo SITE_URL; ?>addto"><?php echo __('Resources'); ?></a></li>
			<li><a class="current" sub-menu="help" href="<?php echo SITE_URL; ?>help"><?php echo __('Help');?></a></li>
		</ul>
	</div>
	<div class="snb">
		<div style="display:block" class="inner help">
			<p class="hidden"><?php echo __('Help');?></p>
			<ul>
				<li><a href="<?php echo SITE_URL; ?>help/faq"><?php echo __('FAQ');?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/contact"><?php echo __('Contact');?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/copyright_policy"><?php echo __('Copyright Policy'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_of_sale"><?php echo __('Terms of Sale'); ?></a></li>
				<li><a class="current" href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of Service'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/terms_merchant"><?php echo __('Terms and Conditions of Merchant Sale'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="wrapper help">
	<div class="container faq">
		<h2 class="ptit">
			<?php echo __('Help');?> /
			<b><?php echo __('Terms of Service'); ?></b>
		</h2>
		<div id="content" style="min-height: 89px;">
			<div class="intro">
				<h3><?php echo __('Terms of Service'); ?></h3>
				<p>
					<!--<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat.');?>-->
					<!---a href="<?php echo SITE_URL; ?>help/contact">contact us.</a--->
					<?php echo $main; ?>
				</p>
			</div>
			<div class="faq-chept">
				<div >
					<div >
					<?php echo __('Terms of Service'); ?>
					<p>
					<?php echo $sub; ?>
					</p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
