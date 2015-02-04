
<div id="container-wrapper" class="sign" style="padding:0px;">
    <div class="container signin update2">
	<div class="wrapper-content">
	    <h2><?php echo __('Forgot Password');?></h2>
	 
            <?php echo $this->Form->create('login',array('url'=>array('controller'=>'/','action'=>'/forgotpassword'),'onsubmit'=>'return validforgot()')); ?>
            
		<fieldset class="frm" style="width:426px;margin-top: 6px;">
		    <h3 class="stit"><?php echo __('Forgot your password? Enter your email address to reset it.');?></h3>
                    <p><label class="labforup" style="float:left;"><?php echo __('Email Address');?><span class="error-label" ><?php echo __('Please check your username');?></span></label>
					<input type="text" id="username" name="email" placeholder="" /></p>
		   	<p class="btn-area"><button type="submit" class="btns-blue-embo btn-signin"><?php echo __('Reset Password');?></button>
		   	<div class='addshiperror' style="color:red;padding-top:4px;"></div>
			</p>
		</fieldset>
            </form>
	</div>
	
    </div>
</div>
<style>
h2{ padding-bottom:0px; line-height: 0px; }
.labforup{
float:left;color: #585B62;display: block;font-size: 13px;font-weight: bold;padding: 0 0 7px;
}
.stit {
    float: left;
    padding-bottom: 0px;   
    padding-left: 0px;
}
</style>