<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
<div id="container-wrapper" class="sign" style="padding:0px;">
    <div class="container signin update2">
	<div class="wrapper-content">
	
	
	<!--a href="javascript:(function(){
  _my_script=document.createElement('SCRIPT');
  _my_script.type='text/javascript';
  _my_script.src='http://fancyclone.net/dev/script.js?';
  document.getElementsByTagName('head')[0].appendChild(_my_script);
})();">Drag this button into your bookmark</a--->
	
	
	
	    <h3><?php echo __('Join')." "; echo $setngs[0]['Sitesetting']['site_name']." "; echo __('today');?> </h3>
<div align='center' style='margin-top:-15px;'> <h4 style="position:relative;top:15px;font-size:15px;">Sign in Using</h4> </div>
	   <div class="sns-login">
			<!--h3 class="stit">Connect with a social network or <a href="#" class="more">other social networks<i class="arrow" style="display:none;"></i></a></h3-->
			     
			                
	<fieldset class="ui-grid-b">
			<br/><center><a data-ajax="false" href="<?php echo SITE_URL.'loginwith/Facebook'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/facebook.png'; ?>">
			</a>
			<a data-ajax="false" href="<?php echo SITE_URL.'loginwith/Google'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/google.png'; ?>">
			</a>
			<a data-ajax="false" href="<?php echo SITE_URL.'loginwithtwitter/Twitter'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/twitter.png'; ?>">
			</a></center>
	</fieldset>
			</div>	
         
          
          
          
         <?php echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/mobile/signup'), 'id'=>'signupform','data-ajax'=>'false','onsubmit'=>'return signform()')); ?>
			  
                <fieldset class="frm email-frm" style="margin-top: 6px;">
                    <!--h3 class="stit" style="padding-bottom:0px;"><?php echo __('Sign Up'); ?> with your email address</h3-->
                   	
                   
                    <?php echo __('Full Name'); ?>	<?php echo "<div id='alertName' style='color:red;float:right;height:0px;'></div>"; ?>
                    <input type="text" id="fullname" name="data[signup][firstname]" placeholder="" />
                   
                   
                    <?php echo __('Username');?>	<?php echo "<div id='alertUname' style='color:red;float:right;height:0px;'></div>"; ?>
                    <input type="text" id="username" name="data[signup][username]" maxlength="26" placeholder="" onkeyup="$(this).parents('.email-frm ').find('.url b').text($(this).val())" />
                    <small class="url">Your <?php echo $site_na; ?> page: <?php echo $siteurl; ?><b>USERNAME</b></small>
                  <br />
                  	
                    <?php echo __('Email Address'); ?><?php echo "<div id='alertEmail' style='color:red;float:right;height:0px;'></div>"; ?>
                    <input type="text" id="email" name="data[signup][email]"  />
                  
                   
                    <?php echo __('Password'); ?> <?php echo "<div id='alertPass' style='color:red;float:right;height:0px;'></div>"; ?>
                    <input type="password" id="password" name="data[signup][password]" placeholder="Minimum 6 characters" />
                   	
                   	<?php
                  		//echo $this->Html->image('captcha.jpg', array('style' => 'padding: 0.5%;'));
                  		//echo '<img src="'.SITE_URL.'captcha/" style ="padding: 0.5%;" />';
   						//echo $this->Form->input('Type the text');
   					?>
   					
   					<?php if(!empty($refferrer_user_id)){ ?>
   					<input type='hidden' name='refferid' value='<?php echo $refferrer_user_id; ?>'>
   					<?php } ?>
   					
   					<p class="btn-area"><button class="btns-blue-embo sign" style="background:#1DAEE3;color:#FFFFFF;text-shadow:none;">Create my account</button></p>
                    	 </fieldset>
                     
                    
                     
                
          </form>
            

	</div>
                
    </div>
</div>
</div>
<style>
.labforup{
float:left;color: #585B62;display: block;font-size: 13px;font-weight: bold;padding: 0 0 7px;
}
</style>
<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
