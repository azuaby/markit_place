<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
		<?php	echo $this->Form->Create('password',array('url'=>array('controller'=>'/','action'=>'/password'), 'id'=>'passchk','onsubmit'=>'return passwordconfirm()')); ?>
  		
		<h2 class="ptit"><?php echo __('Change Password'); ?> </h2>
		<div class="section password">
			<fieldset class="frm">
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;'></div>"; ?>
				<label><?php  echo __('Existing Password');?></label>
				<input type="password" name = "epassword" id="exispass" maxlength = "32" />
				<small class="comment"><?php echo __('New password,');echo __('at least 6 characters');?></small>
				<label><?php echo __('New Password'); ?></label>
				<input type="password" name = "password" id="passw" maxlength = "32" />
				<small class="comment"><?php  echo __('New password,');echo __('at least 6 characters'); ?></small>
				<label><?php  echo __('Confirm Password'); ?></label>
				<input type="password" name = "cpassword"  id="confirmpass" maxlength = "32"/>
				<small class="comment"><?php echo __('Confirm your new password'); ?></small>
			</fieldset>
		</div>
		<div class="btn-area">
			<button class="btn-save" id="save_password" disabled="true"><?php  echo __('Change Password'); ?></button>
		</div>
		</form>
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" class="current" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i><?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i><?php echo __('Add Shipping<');?>/a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i><?php  echo __('Information'); ?></a></dd>
	           	<dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php  echo __('My Sales'); ?></a></dd>
	        </dl>
	        
	        
	        <dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card')?></a></dd>
	        </dl>
			
		</div>
				<!-- <footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
			
</div>	
