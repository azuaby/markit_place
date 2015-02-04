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
				<li><a href="<?php echo SITE_URL; ?>help/faq"><?php echo __('FAQ'); ?></a></li>
				<li><a class="current" href="<?php echo SITE_URL; ?>help/contact"><?php echo __('Contact');?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/copyright_policy"><?php echo __('Copyright Policy'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_of_sale"><?php echo __('Terms of Sale'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_service"><?php echo __('Terms of Service'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/terms_merchant"><?php echo __('Terms and Conditions of Merchant Sale'); ?></a></li>
				<li><a href="<?php echo SITE_URL; ?>help/privacy"><?php echo __('Privacy'); ?></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="wrapper help">
	<div class="container contact">
		<h2 class="ptit">
			<?php echo __('Help');?> /
			<b><?php echo __('Contact');?></b>
		</h2>
		<div id="content" style="min-height: 89px;">
			<div class="intro">
				<h3><?php echo __('Contact Us');?></h3>
				<p>
					<?php echo __('Feel free to contact us with service questions, business proposals or media inquiries.');?>
					<a href="javascript:void(0);"><?php echo __('contact us.');?></a>
				</p>
			</div>
			<div class="sidebar">
				<div>
					<span><?php echo __('Contact Address');?></span>
					<!--<p>
					<?php echo __('Markit, Inc.');?>
					<br>
					<?php echo __('354 Royals Road,');?>
					<br>
					<?php echo __('Canada,');?>
					<br>
					<?php echo __('CN 165214');?>
					</p>-->
					<?php echo $contact; ?>

				</div>
			</div>	
			<div class="contact-frm">
				<h4>
				<?php echo __('Email Markit Support');?>
				<small><?php echo __('We'.'ll get back to you as soon as possible.');?></small>
				</h4>
				<?php	echo $this->Form->Create('notifi',array('url'=>array('controller'=>'Fantasyhelps','action'=>'/contact'),'class'=>'contact_')); ?>
  		
				<!--form class="contact_"-->		
				<fieldset>
					<p>
						<label><?php echo __('Your Name');?></label>
						<input class="input-text name" type="text" value="" name="contact_name">
					</p>
					<p>
						<label><?php echo __('Your Email Address');?></label>
						<input class="input-text email" type="text" value="" name="contact_email">
					</p>
					<p>
						<label><?php echo __('Select a topic');?></label>
						<select class="select-round topic valid" name="topic" style="text-indent: 0px;padding-top:5px;border:1px solid #f0f0f0;">
							<option value="User account"><?php echo __('User account');?></option>
							<option value="Forgot my password"><?php echo __('Forgot my password');?></option>
							<option value="Order Inquiry"><?php echo __('Order Inquiry');?></option>
							<option value="Payment Issues"><?php echo __('Payment Issues');?></option>
							<option value="Returns and Refunds"><?php echo __('Returns and Refunds');?></option>
							<option value="Markit Site Features"><?php echo __('Markit Site Features');?></option>
							<option value="Markit Mobile Features"><?php echo __('Markit Mobile Features');?></option>
							<option value="Partnership Opportunities"><?php echo __('Partnership Opportunities');?></option>
							<option value="Copyright Issue"><?php echo __('Copyright Issue');?></option>
						</select>
					</p>
					<p>
						<label><?php echo __('Order Number');?></label>
						<input class="input-text order" type="text" placeholder="If applicable" name="contact_order">
					</p>	
					<p>
						<label><?php echo __('User Account');?></label>
						<input class="input-text user" type="text" value="" name="contact_user">
					</p>
					<p>
						<label><?php echo __('Message');?></label>
						<textarea class="input-text description" name="contact_message"></textarea>
					</p>
					<button class="btn-submit" type="submit" onclick="return helpcontact()"><?php echo __('Submit');?></button>
					<div class="contact-error"></div>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
