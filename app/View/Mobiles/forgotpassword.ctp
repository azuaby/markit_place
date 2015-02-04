
<div id="container-wrapper" class="sign" style="padding:0px;">
    <div class="container signin update2">
	<div class="wrapper-content">
	<div class="ui-body ui-body-a">
	    <h3>Forgot Password</h3>
	    </div>
	 
            <?php echo $this->Form->create('login',array('url'=>array('controller'=>'/','action'=>'/mobile/forgotpassword'),'onsubmit'=>'return validforgot()','data-ajax'=>'false')); ?>
            
		<fieldset class="frm" style="margin-top: 6px;">
		<div class="ui-body ui-body-a">
		    <h3>Forgot your password? Enter your email address to reset it.</h3>
		    </div>
		    <div class="ui-body ui-body-a">
                    <b>Email Address<span class="error-label" style="display:none;">Please check your username</span></b>
					<input type="text" id="username" name="email" placeholder="" />
		   	<p class="btn-area"><button type="submit" class="btns-blue-embo btn-signin" style="background:#1DAEE3;color:#FFFFFF">Reset Password</button>
		   	<div class='addshiperror' style="color:red;padding-top:4px;"></div>
			</p>
			</div>
		</fieldset>
		
            </form>
	</div>
	
    </div>
</div>
<style>

</style>