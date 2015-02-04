<div id="container-wrapper" class="sign" >
    <div class="container signin update2">
	<div class="wrapper-content">
	    <h2> <?php echo __('Join')." ";echo $setngs[0]['Sitesetting']['site_name']." ";echo __('today'); ?> </h2>
	    <h6><?php echo __('Sign Up'); ?> with Twitter</h6>
	   <!-- <div class="sns-login"> -->
			<!--h3 class="stit">Connect with a social network or <a href="#" class="more">other social networks<i class="arrow" style="display:none;"></i></a></h3-->
         <!--<ul class="sns-major">
                 <li><button class="btn-f fb facebook"><span class="icon ic-fb"><i></i></span> <b>Facebook</b></button></li>
  				 <li><button class="btn-g google" id="fancy-g-signin" next="/"><span class="icon ic-gg"><i></i></span> <b>Google</b></button></li>
				 <li><button class="btn-t tw twitter"><span class="icon ic-tw"><i></i></span> <b>Twitter</b></button></li>
			</ul>
			</div>	
          -->
         <?php echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/twittlogin_save'), 'id'=>'signupform','onsubmit'=>'return signformfortwit()')); ?>
			  
                <fieldset class="frm email-frm" style="width:426px;margin-top: 6px;">
                    <!--h3 class="stit" style="padding-bottom:0px;"><?php echo __('Sign Up'); ?> with your email address</h3-->
                    <label class="labforup">Full Name<span class="error-label" id="error-fullname"></span></label>
                    <input type="text" id="fullname" name="data[signup][firstname]" placeholder="" />
                    <label class="labforup">Username<span class="error-label" id="error-username"></span></label>
                    <input type="text" id="username" name="data[signup][username]" placeholder="" onkeyup="$(this).parents('.email-frm ').find('.url b').text($(this).val())" />
                    <small class="url">Your <?php echo $setngs[0]['Sitesetting']['site_name']; ?> page: <?php echo SITE_URL; ?>people/<b>USERNAME</b></small>
                   <label class="labforup">Email Address<span class="error-label" id="error-email"></span></label>
                    <input type="text" id="email" name="data[signup][email]"  />
                 
   					<p class="btn-area"><button class="btns-blue-embo sign">Create my account</button></p>
                     </fieldset>
                     
                     
                    <input type="hidden" name="twitlogin" value="<?php echo $user_profile->identifier; ?>">
                    <input type="hidden" name="twitphoto" value="<?php echo $user_profile->photoURL; ?>"> 
                
          </form>
            
	<?php echo "<div id='alert'  style='display:none;'></div>"; ?>
	</div>
                
    </div>
</div>
<style>
.labforup{
float:left;color: #585B62;display: block;font-size: 13px;font-weight: bold;padding: 0 0 7px;
}
</style>