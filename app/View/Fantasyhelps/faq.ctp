<?php ?>
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
				<li><a class="current" href="<?php echo SITE_URL; ?>help/faq"><?php echo __('FAQ');?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/contact"><?php echo __('Contact');?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/copyright_policy"><?php echo __('Copyright Policy'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_of_sale"><?php echo __('Terms of Sale'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of Service'); ?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/terms_merchant"><?php echo __('Terms and Conditions of Merchant Sale');?></a></li>
				<li><a "="" href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="wrapper help">
	<div class="container faq">
		<h2 class="ptit">
			<?php echo __('Help');?> /
			<b><?php  echo __('FAQ') ;?></b>
		</h2>
		<div id="content" style="min-height: 89px;">
			<div class="intro">
				<h3><?php echo __('Frequently Asked Questions') ;?></h3>
				<p>
					<!--<?php echo __('This is a short list of our most frequently asked questions. For more information about Markit, or if you need support, please');?>-->
					<?php echo $main; ?>
					<!--<a href="<?php echo SITE_URL; ?>help/contact"><?php echo __('contact us');?>.</a>-->
				</p>
			</div>
			<div class="faq-chept">
				<!--<h4 id="fantasy" class="stit"><?php echo __('Markit');?></h4></br>
				<div class="faq-label">
					<div style="cursor:pointer" onclick="$('.WIF').toggle();">
					<?php echo __('What is Markit ?');?>
					<p class="WIF" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HTS').toggle();">
					<?php echo __('How to signup for Markit ?');?>
					<p class="HTS" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HTF').toggle();">
					<?php echo __('How to Markit an item ?');?>
					<p class="HTF" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HTVI').toggle();">
					<?php echo __('How to view items you have Markit');?>'d  ?
					<p class="HTVI" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HCEL').toggle();">
					<?php echo __('How to create and edit lists ?');?>
					<p class="HCEL" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.FF').toggle();">
					<?php echo __('Follow Markit ?');?>
					<p class="FF" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<?php echo $fantacy; ?>
				</div>-->
				<?php echo $sub; ?>
			</div>
			<!--<div class="faq-chept">
				<h4 id="profile" class="stit"><?php echo __('Profile & Account');?></h4></br>
				<div class="faq-label">
					<!--<div style="cursor:pointer" onclick="$('.HCPP').toggle();">
					<?php echo __('How to change your profile picture ?');?>
					<p class="HCPP" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HCEA').toggle();">
					<?php echo __('How to change your email address ?');?>
					<p class="HCEA" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HCYU').toggle();">
					<?php echo __('How to change your username ?');?>
					<p class="HCYU" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HRYP').toggle();">
					<?php echo __('How to reset your password  ?');?>
					<p class="HRYP" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.HYPP').toggle();">
					<?php echo __('How to make your profile private ?');?>
					<p class="HYPP" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<div style="cursor:pointer" onclick="$('.DFF').toggle();">
					<?php echo __('How to deactivate your Markit account ?');?>
					<p class="DFF" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<?php echo $profile; ?>
				</div>
			</div>
			<div class="faq-chept">
				<h4 id="profile" class="stit"><?php echo __('Merchants');?></h4></br>
				<div class="faq-label">
					<!--<div style="cursor:pointer" onclick="$('.HBFS').toggle();">
					<?php echo __('How to become a Markit seller ?');?>
					<p class="HBFS" style="display:none;">
						<?php echo __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
						sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
						erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
						tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');?>
					</p>
					</div>
					<?php echo $merchant; ?>
				</div>
			</div>-->
		</div>
	</div>
</div>
