<?php ?>
<div id="container-wrapper" class="sign" style="padding:0px;">
    <div class="container signin update2">
	<div class="wrapper-content">
	    <h2><?php echo __('Sign in to '); echo $setngs[0]['Sitesetting']['site_name']; ?></h2>
	   <div class="sns-login">
		<!--h3 class="stit">Connect with a social network or <a href="#" class="more">other social networks<i class="arrow" style="display:none;"></i></a></h3-->
         <ul class="sns-major">
                    
		    <li><a href="<?php echo SITE_URL.'loginwith/Facebook'; ?>" > <button class="btn-f fb facebook"> <b>Facebook</b></button></a></li>
		    <li><a href="<?php echo SITE_URL.'loginwith/Google'; ?>" > <button class="btn-g google"><b>Google</b></button></a></li>
		    <li><a href="<?php echo SITE_URL.'loginwithtwitter/Twitter'; ?>" ><button class="btn-t tw twitter"> <b>Twitter</b></button></a></li>
                    
		</ul>
	
               
            </div>	
            
           
            <?php echo $this->Form->create('login',array('url'=>array('controller'=>'/','action'=>'/login'),'id'=>'loginform','class'=>'frm clearfix','onsubmit'=>'return validsigninfrm()')); ?>
            
		<fieldset class="frm" style="width:426px;margin-top: 6px;">
		    <!--h3 class="stit">Sign in with your email address</h3-->
		   
            <p style="display:inline;"><label class="labforup" style="width:400px;margin-top:2px;margin-bottom:8px;"><?php echo __('Email Address');?><div id='alert_em' style='color:red;float:right;margin-top:-30px;height:0px;'></div></label>
			<input type="text" id="username" style="margin-top:-800px;"name="email" placeholder="" value="<?php echo $userName ?>"/></p>
			<?php echo "<div id='alert_pass' style='color:red;float:right;height:0px'></div>"; ?>
		    <p><label class="label"><?php echo __('Password');?><span class="error-label" >Please check your password</span></label>
			<input type="password" id="password" name="password" placeholder="" value="<?php echo $password ?>"/></p>
                    
                   
		   
		    <p class="btn-area" style="margin-top:10px;"><button type="submit" class="btns-blue-embo btn-signin" style="float:right;"><?php echo __('Sign In'); ?></button>
			<a href="<?php echo SITE_URL.'forgotpassword'; ?>" style="float:right; margin:9px 12px 0px 0px;"><?php echo __('Forgot password?'); ?></a></p>
			 <p class="btn-area" style="margin-top:-35px;"><input type=checkbox name="Remember"><?php echo __('Remember me'); ?></p> 
		
		</fieldset>
            </form>
            
            
	</div>
	
	
	
	
	
	<!--
	
	<div class="login-button-div"> 
		<a href="<?php echo SITE_URL.'loginwith/Facebook'; ?>" class="zocial facebook"><?php echo __('Login'); ?> with Facebook</a> 
		<a href="<?php echo SITE_URL.'loginwithtwitter/Twitter'; ?>" class="zocial twitter"><?php echo __('Login'); ?> with Twitter</a>
		<a href="<?php echo SITE_URL.'loginwith/Google'; ?>" class="zocial twitter"><?php echo __('Login'); ?> with Google</a> 
	</div> 
	
	-->
	
	
    </div>
</div>
<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
