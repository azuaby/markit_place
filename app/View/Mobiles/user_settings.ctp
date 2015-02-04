<?php 
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = @$_SESSION['media_server_username'];
@$password = @$_SESSION['media_server_password']; 
@$hostname = $_SESSION['media_host_name'];

$roundProfile = "border-radius:3px;";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:50px;";
}
?>
<div class="container set_area">
		
        <div id="content">
		
		
	
		<?php	echo $this->Form->Create('settings',array('url'=>array('controller'=>'/','action'=>'/mobile/user_settings'))); ?>
  		
		<div class="section">
		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
			<b style="font-size:15px;">Profile</b>
			 <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
		<hr>
			
			<fieldset class="frm">
            <div class="frm_noti">
				<b><?php echo __('Full Name'); ?></b>
				<input id="name" name="setting-fullname" type="text" value="<?php echo $usr_datas['User']['first_name']; ?>" class="text"/>
				<?php echo __('Your real name, so your friends can find you');?><br />
				<b><?php echo __('Username'); ?></b>
				<input type="text" value="<?php echo $usr_datas['User']['username']; ?>" disabled="true" style="cursor:not-allowed;opacity:0.4;"/>
				<b><?php echo __('Website'); ?></b>
				<input id="website" name="website" type="text" value="<?php echo $usr_datas['User']['website']; ?>" class="text" />
				
				
				<b><?php echo __('Location'); ?></b>
				<input id="loc" name="city" type="text" value="<?php echo $usr_datas['User']['city']; ?>" class="text" placeholder="e.g. New York, NY"/>
				
				<b>Twitter</b>
				<input id="twitter" name="twitter_email" type="text" value="<?php echo $usr_datas['User']['twitter']; ?>" class="text" />
				
				<b><?php echo __('Birthday'); ?></b>
				<div class="selectdiv">
				<select id="birthday_year" name="setting-birthday-year" class="selectboxdiv">
                    <option value="0">Year</option>
                    <?php 
                    $dates = explode("-", $usr_datas['User']['birthday']);
                    for($i=2013;$i>1900;$i--){
                    if($dates[0] == $i){ 
                    	echo '<option value="'.$i.'"  selected="" >'.$i.'</option>';
                    }else{                 
                    	echo '<option value="'.$i.'"  >'.$i.'</option>';
                    	}
                    }
                    ?>
                    
                </select><div class="out" style="display:none;"><?php echo __('Year'); ?></div>
				</div>
				
				<div class="selectdiv">
				<select id="birthday_month" name="setting-birthday-month" class="selectboxdiv">
                    <option value="0">Month</option>
                    <?php for($i=1;$i<13;$i++){
                    if($dates[1] == $i){ 
                    	echo '<option value="'.$i.'"  selected="" >'.$i.'</option>';
                    }else{                 
                    	echo '<option value="'.$i.'"  >'.$i.'</option>';
                    }
                    }
                    ?>
                    
                </select>
                <div class="out" style="display:none;"><?php echo __('Month'); ?></div>
				</div>
                
                <div class="selectdiv">
				<select id="birthday_day" name="setting-birthday-day"  class="selectboxdiv">
                    <option value="0">Day</option>
                    
                   <?php for($i=1;$i<32;$i++){
                   if($dates[2] == $i){ 
                    	echo '<option value="'.$i.'"  selected="" >'.$i.'</option>';
                    }else{                 
                    	echo '<option value="'.$i.'"  >'.$i.'</option>';
                    }
                    }
                    ?>
                    
                </select><div class="out" style="display:none;"><?php echo __('Day'); ?></div>
				</div>
				<br />
				
				
				<?php  echo __('We will send you a surprise on your birthday!'); ?>
				
				<b><?php echo __('About'); ?></b>
				<?php $strleng = 180-strlen($usr_datas['User']['about']); ?>
				<textarea class="text" id="bio" name="setting-bio" maxlength="180"><?php echo $usr_datas['User']['about']; ?></textarea>
				<b class="byte"><input size=3 value=<?php echo $strleng; ?> id=text_num></b> <?php  echo __('Write something about yourself'); ?>
				<span id="biodata_tex"></span>



        </div>
			</fieldset>
		</div><br />
		
		<div class="section">
			<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;"><b style="font-size:15px;"><?php  echo __('Account'); ?></b>
			<hr>
			<fieldset class="frm">
            <div class="frm_noti">
				<b>Email</b>
				<input id="email" name="setting-email" type="text" value="<?php echo $usr_datas['User']['email']; ?>" class="text" disabled />
				<?php  echo __('Email will not be publicly displayed '); ?><br />
				
				
				<?php $agebtween = $usr_datas['User']['age_between']; ?>
				<b><?php echo __('Age'); ?></b>
				<div class="selectdiv">
				<select name="agebtwen" id="agebtwen"  class="selectboxdiv">
					<option value="none">I'd rather not say</option>
					<option value="0" <?php if($agebtween == '0'){ echo "selected";}else{ echo "";} ?> >13 to 17</option>
					<option value="1" <?php if($agebtween == '1'){ echo "selected";}else{ echo "";} ?> >18 to 24</option>
					<option value="2" <?php if($agebtween == '2'){ echo "selected";}else{ echo "";} ?> >25 to 34</option>
					<option value="3" <?php if($agebtween == '3'){ echo "selected";}else{ echo "";} ?> >35 to 44</option>
					<option value="4" <?php if($agebtween == '4'){ echo "selected";}else{ echo "";} ?> >45 to 54</option>
					<option value="5" <?php if($agebtween == '5'){ echo "selected";}else{ echo "";} ?> >55+</option>
				</select>
				<div class="out" style="display:none;"><?php echo __('I\'d rather not say'); ?></div>
				</div>
				
				

				<b><?php echo __('Gender'); ?></b>
				<table width="100%" height="100%"><thead><tr><th></th><th></th></tr></thead><tbody>
				<?php if($usr_datas['User']['gender'] == 'male'){ ?>
				<tr style="height:30px;"><td><input type="radio" name="gender" value="male" id="gender1" checked style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Male'); ?></span></td></tr>
				<?php }else{ ?>
					<tr style="height:30px;"><td><input type="radio" name="gender" value="male" id="gender1" style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Male'); ?></span></td></tr>
				<?php  } if($usr_datas['User']['gender'] == 'female'){ ?>
					<tr style="height:30px;"><td><input type="radio" name="gender" value="female" id="gender2" checked style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Female'); ?></span></td></tr>
				<?php }else{ ?>
					<tr style="height:30px;"><td><input type="radio" name="gender" value="female" id="gender2" style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Female'); ?></span></td></tr>
				<?php  }  ?>
				<?php if($usr_datas['User']['gender'] == null){ ?>
				<tr style="height:30px;"><td><input type="radio" name="gender" value="none" id="gender3" checked style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Unspecified'); ?></span></td></tr>
				<?php }else{ ?>
				<tr style="height:30px;"><td><input type="radio" name="gender" value="none" id="gender3" style="margin-top:-14px;" /></td><td><span style="font-size:13px;margin-left:20px;"><?php echo __('Unspecified'); ?></span></td></tr>
				<?php  }  ?>
				</tbody></table>
        </div>
			</fieldset>
		</div><br />
		<div class="section photo">
			<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;"><b style="font-size:15px;"><?php echo __('Photo'); ?> </b>
			<hr>
			
			<fieldset class="frm">
			
				<?php 
				
				if(empty($usr_datas['User']['profile_image'])){
					$image_computer = '';
				}else{
					$image_computer = $usr_datas['User']['profile_image'];
				}
				if(!empty($image_computer)){
						echo "<center><img id='show_url'  style='margin-left: 10px;width: 70px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/".$image_computer."'></center>";
						}else{
						echo "<center><img id='show_url'  style='margin-left: 10px;width: 70px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'></center>";
						}
				echo "<div class='input-group'>";
						echo '<div class="venueimg" align="center"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'userupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="margin-left: 10px;"></iframe><br />';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
							if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='display: none;text-decoration:none; margin-top: 7px; float: left;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='display: none;text-decoration:none; margin-top: 5px; float: left;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
						echo "</div>";
						
				echo "</div>";
			
			echo "<br clear='all' />";
			
				?>
			
			</fieldset>
		
		
		<div class="btn-area">
			<button class="btn-save" id="save_account" style="background:#5690BB;color:#FFFFFF;text-shadow:none;"><?php echo __('Save Profile'); ?></button>
			<span class="checking" style="display:none"><i class="ic-loading"></i></span>
			<?php echo '<a id="close_account" onclick="deactiateac('.$loguser[0]['User']['id'].');" style="float: right;margin: 1px 24px -1px 0; background: none repeat scroll 0 0 transparent;color: #92969C;font-size: 13px;line-height: 32px;text-decoration: none;">';?>
			<?php echo __('Deactivate my account');?>
			<?php echo'</a>'; ?>
			</div>	
		</div></div>
		</form>
	</div>


				
	
			
</div>	

<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
