
<div id="container-wrapper" style="background-color:#FFFFFF;font-size:13px;">
<div style="margin:20px;">
	<div align='center' style='margin-top:-15px;'> <b style="position:relative;top:15px;font-size:15px;">Sign in Using</b> </div>



	<fieldset class="ui-grid-b">
			<br ><br/><center><a data-ajax="false" href="<?php echo SITE_URL.'loginwith/Facebook'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/facebook.png'; ?>">
			</a>
			<a data-ajax="false" href="<?php echo SITE_URL.'loginwith/Google'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/google.png'; ?>">
			</a>
			<a data-ajax="false" href="<?php echo SITE_URL.'loginwithtwitter/Twitter'; ?>" class="ui-link" style="text-decoration:none;">
				<img src="<?php echo SITE_URL.'images/menu/twitter.png'; ?>">
			</a></center>
	</fieldset>



		<div align='center'> 
	<h4 style="font-size:15px;">Already a user? <?php echo __('Sign in to '); echo $setngs[0]['Sitesetting']['site_name']; ?></h4>
	</div>
               
          
            
           
            <?php echo $this->Form->create('login',array('url'=>array('controller'=>'/','action'=>'/mobile/login'),'id'=>'loginform','data-ajax'=>'false','onsubmit'=>'return validsigninfrm()')); ?>
            
		
		    <!--h3 class="stit">Sign in with your email address</h3-->
		   
            <div>
            	<p style="display:inline;"><label style="width:400px;margin-top:2px;margin-bottom:8px;font-size:13px;"><br /><div id='alert_em' style='color:red;float:right;margin-top:-30px;height:0px;'></div></label></p>
            </div>
            <div>
				<p style="display:inline;"><input type="text" class="ui-input-text ui-body-b" id="username" name="email" placeholder="Username" value="<?php echo $userName ?>"/></p>
			</div>
			<div>
				<?php echo "<div id='alert_pass' style='color:red;float:right;height:0px'></div>"; ?>
			</div>
			<div>
		    	<p><label style="font-size:13px;"><span class="error-label" style="display:none;">Please check your password</span></label>
		    </div>
		   <div>
				<input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password ?>"/></p>
			</div>
                    
                   
		    <div>
		    	<button type="submit" data-mini="true" style="background-color:#1DAEE3;text-shadow:none;"><font color="#FFFFFF"><?php echo __('Sign In'); ?></font></button>
		    </div>
		    <div>
				<a data-ajax="false" href="<?php echo SITE_URL.'mobile/forgotpassword'; ?>" style="text-decoration:none;color:#7F7F7F;"><?php echo __('Forgot password?'); ?></a>
			</div><br />
			
		    <div>
				<center><a data-ajax="false" href="<?php echo SITE_URL.'mobile/signup'; ?>" style="text-decoration:none;color:#7F7F7F;"><?php echo __('Get started? Create Markit Account'); ?></a></center>
			</div>		<br />	
			<!--div>
			 	<input type=checkbox name="Remember"><?php echo __('Remember me '); ?>
			</div-->
			

			<script type="text/javascript">
var OSName="unknown OS";
if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) OSName="Windows 8";
if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) OSName="Windows 7";
if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) OSName="Windows Vista";
if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) OSName="Windows XP";
if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) OSName="Windows 2000";
if (window.navigator.userAgent.indexOf("Mac")!=-1) OSName="Mac/iOS";
if (window.navigator.userAgent.indexOf("X11")!=-1) OSName="UNIX";
if (window.navigator.userAgent.indexOf("Linux")!=-1) OSName="Linux";
//alert('Your OS: '+OSName);




var mobileOS;    // will either be iOS, Android or unknown
var mobileOSver; // this is a string, use Number(mobileOSver) to convert


  var ua = navigator.userAgent;
  var uaindex;

  // determine OS
  if ( ua.match(/iPad/i) || ua.match(/iPhone/i) )
  {
    mobileOS = 'iOS';
    uaindex  = ua.indexOf( 'OS ' );
  }
  else if ( ua.match(/Android/i) )
  {
    mobileOS = 'Android';
    uaindex  = ua.indexOf( 'Android ' );
  }
  else
  {
    mobileOS = 'unknown';
  }

  // determine version
  if ( mobileOS === 'iOS'  &&  uaindex > -1 )
  {
    mobileOSver = ua.substr( uaindex + 3, 3 ).replace( '_', '.' );
  }
  else if ( mobileOS === 'Android'  &&  uaindex > -1 )
  {
    mobileOSver = ua.substr( uaindex + 8, 3 );
  }
  else
  {
    mobileOSver = 'unknown';
  }
//alert( mobileOS+"ty"+mobileOSver);


if(mobileOS == 'iOS')
{
disp = '<center><a href="https://itunes.apple.com/us/app" target="_blank" title="Markit for iPhone" class="playstorelink"><div class="appstore"></div></a></center>';
}
else if(mobileOS == 'Android')
{
disp = '<center><a href="https://play.google.com/store/apps/" target="_blank" title="Markit for Android" class="playstorelink"><div class="googlestore"></div></a></center>';
}
document.write(disp);


</script>
<style>
.appstore {
    background: url("../images/appstore.gif") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: inline-block;
    height: 65px;
    width: 178px;
}

.googlestore {
    background: url("../images/googleplay.gif") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: inline-block;
    height: 65px;
    width: 178px;
}
</style>            
            
	</div>
	
	
	
	
	
</div>
	
	

<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
