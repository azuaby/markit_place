<?php ?>
<div id="container-wrapper" class="sign" style="padding:0px;">
    <div class="container signin update2">
	<div class="wrapper-content">
	
	
	<!--a href="javascript:(function(){
  _my_script=document.createElement('SCRIPT');
  _my_script.type='text/javascript';
  _my_script.src='http://fancyclone.net/dev/script.js?';
  document.getElementsByTagName('head')[0].appendChild(_my_script);
})();">Drag this button into your bookmark</a--->
	
	
	
	    <h2><?php echo __('Join')." "; echo $setngs[0]['Sitesetting']['site_name']." "; echo __('today');?> </h2>
	   <div class="sns-login">
			<!--h3 class="stit">Connect with a social network or <a href="#" class="more">other social networks<i class="arrow" style="display:none;"></i></a></h3-->
			     <ul class="sns-major">
			                
				    <li><a href="<?php echo SITE_URL.'loginwith/Facebook'; ?>" > <button class="btn-f fb facebook"> <b>Facebook</b></button></a></li>
				    <li><a href="<?php echo SITE_URL.'loginwith/Google'; ?>" > <button class="btn-g google"><b>Google</b></button></a></li>
				    <li><a href="<?php echo SITE_URL.'loginwithtwitter/Twitter'; ?>" ><button class="btn-t tw twitter"> <b>Twitter</b></button></a></li>
			                
				</ul>
			</div>	
         
          
          
          
         <?php echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/signup'), 'id'=>'signupform','onsubmit'=>'return signform()')); ?>
			  
                <fieldset class="frm email-frm" style="width:426px;margin-top: 6px;">
                    <!--h3 class="stit" style="padding-bottom:0px;"><?php echo __('Sign Up'); ?> with your email address</h3-->
                   	
                   
                    <label class="labforup" style="width:420px;"><?php echo __('First Name'); ?>	<?php echo "<div id='alertFName' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="text" id="firstname" name="data[signup][firstname]" placeholder="" />
                   
                    <label class="labforup" style="width:420px;"><?php echo __('Last Name'); ?>	<?php echo "<div id='alertLName' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="text" id="lastname" name="data[signup][lastname]" placeholder="" />
                   
                    <label class="labforup" style="width:420px;"><?php echo __('Username');?>	<?php echo "<div id='alertUname' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="text" id="username" name="data[signup][username]" maxlength="26" placeholder="" onkeyup="$(this).parents('.email-frm ').find('.url b').text($(this).val())" />
                    <small class="url">Your <?php echo $site_na; ?> page: <?php echo $siteurl; ?>people/<b>USERNAME</b></small>

				    <label><?php echo __('Country');?>
				    <?php echo "<div id='alert_Cntry' style='color:red;float:right;height:0px;'></div>"; ?></label>
				    <div class="selectdiv" style="width: 420px; height: 28px; padding-top: 3px;">
				    <select id="countrys" name="cntry" class="selectboxdiv" style="width: 420px ! important;">
					    <option value=""><?php echo __('Select Country');?></option>
					    <?php $selected = ''; 
							    foreach ($countrylist as $country) { 
								    if (isset($usr_datas)  && $country['Country']['country'] == $usr_datas['User']['country'])
									    $selected = 'selected';
					    ?>
					    <option value="<?php echo $country['Country']['id'];?>" <?php echo $selected;?>><?php echo $country['Country']['country']; ?></option>
					    <?php $selected = '';} ?>
				    </select><div class="out" ><?php echo $usr_datas['User']['country']; ?></div>
				    </div>

                    <label class="labforup" style="width:420px;"><?php echo __('Email Address'); ?><?php echo "<div id='alertEmail' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="text" id="email" name="data[signup][email]"  />
                  
                   
                    <label class="labforup" style="width:420px;"><?php echo __('Password'); ?> <?php echo "<div id='alertPass' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="password" id="password" name="data[signup][password]" placeholder="<?php echo __('Minimum 6 characters');?>" />

                    <label class="labforup" style="width:420px;"><?php echo __('Confirm Password'); ?> <?php echo "<div id='alertrPass' style='color:red;float:right;height:0px;'></div>"; ?></label>
                    <input type="password" id="rpassword" name="data[signup][password]" placeholder="<?php echo __('Minimum 6 characters');?>" />

                   	
                   	<label class="labforup"> <?php echo __('Captcha');
                  		//echo $this->Html->image('captcha.jpg', array('style' => 'padding: 0.5%;'));
                  		//echo '<br><img src="'.SITE_URL.'captcha/" style ="padding: 0.5%;" />';
   						//echo $this->Form->input('Type the text');
                   		echo '<br>';
                   		$this->Captcha->render($captchaSettings);
   					?>
   					</label>
					
					
					
   					<?php if(!empty($refferrer_user_id)){ ?>
   					<input type='hidden' name='refferid' value='<?php echo $refferrer_user_id; ?>'>
   					<?php } ?>
   					
   					<p class="btn-area" style="float:right;"><button class="btns-blue-embo sign"><?php echo __('Create my account');?></button></p>
					<label class="labforup">
					<div style="width:450px;margin-top:-13px;">
					<span style="color:#1a1a1a; font-size:12px; font-weight:normal; "><?php echo "By clicking the “Create my account” you are agree that you have read and agree the "; ?> <?php echo $setngs[0]['Sitesetting']['site_name']; ?><?php echo "’s"; ?></span><a onclick="viewTerms()" style="color:blue; font-size:12px; font-weight:normal; "> <?php echo "“Terms and Conditions”"; ?></a>
					</div>
					</label>
                    	 </fieldset>
                     
                    
                     
                
          </form>
            

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
