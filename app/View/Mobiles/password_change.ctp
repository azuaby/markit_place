<div class="container set_area">
        <div id="content">
		<?php	echo $this->Form->Create('password',array('url'=>array('controller'=>'/','action'=>'/mobile/password'), 'id'=>'passchk','onsubmit'=>'return passwordconfirm()')); ?>
  		<div class="ui-body ui-body-a" style="font-size:13px;border-radius:5px;">
		<b style="font-size:15px;"><?php echo __('Change Password'); ?> </b>
		<?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
		<hr>
		<div class="section password">
			<fieldset class="frm">
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;'></div>"; ?>
		
				<b><?php  echo __('Existing Password');?></b>
				<input type="password" name = "epassword" id="exispass" maxlength = "32" />
				New password, at least 6 characters
				<br /><br />
				<b><?php echo __('New Password'); ?></b>
				<input type="password" name = "password" id="passw" maxlength = "32" />
				<?php  echo __('New password, at least 6 characters'); ?><br />
				<br />
				<b><?php  echo __('Confirm Password'); ?></b>
				<input type="password" name = "cpassword"  id="confirmpass" maxlength = "32"/>
				<?php echo __('Confirm your new password '); ?></div>
			</fieldset>
		<br />
		<div class="btn-area">
		
			<button class="btn-save" id="save_password" style="background:#5690BB;color:#FFFFFF;text-shadow:none;"><?php  echo __('Change Password'); ?></button>
			</div>
</div>
		</form>
	</div>
	

			
</div>	
