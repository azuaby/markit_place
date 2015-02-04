<body class=""> 
  <!--<![endif]-->
      
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Site Management</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Site Management</li>
					</ul>
				</div>
			</div>
 
 

<?php 
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
$username = @$_SESSION['media_server_username'];
$password = @$_SESSION['media_server_password'];
@$hostname = $_SESSION['media_host_name']; 
?>




						<!-----Site settings------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Site Management</h2>
						
					</div>
					<div class="box-content">

				
	
			
	<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Sitesetting',array('url'=>array('controller'=>'/','action'=>'/admin/site/setting'),'id'=>'siteform'));
			
			echo "<div id='forms'>";
				echo $this->Form->input('site_name',array('type'=>'text','label'=>'Site Name','id'=>'site_name','class'=>'inputform','value'=>$site_datas['Sitesetting']['site_name']));			
				echo $this->Form->input('id',array('type'=>'hidden','label'=>'Site Name','id'=>'id','class'=>'inputform','value'=>$site_datas['Sitesetting']['id']));			

				
				echo $this->Form->input('site_title',array('type'=>'text','label'=>'Site Title','id'=>'site_title','class'=>'inputform','value'=>$site_datas['Sitesetting']['site_title']));
				
				
				if($siteChanges['profile_image_view']=="square")
				echo '<fieldset>
					<legend>Profile Image Style</legend>
					<label for="profile_image_styleSquare">
						<input type="radio" checked="checked" value="square" class="inputform profile_image_style" id="profile_image_styleSquare" name="profile_image_style">
						Square
					</label>
					<label for="profile_image_styleRound">
						<input type="radio" value="round" class="inputform profile_image_style" id="profile_image_styleRound" name="profile_image_style">
						Round
					</label>
					</fieldset>';
				else
				echo '<fieldset>
					<legend>Profile Image Style</legend>
					<label for="profile_image_styleSquare">
						<input type="radio" value="square" class="inputform profile_image_style" id="profile_image_styleSquare" name="profile_image_style">
						Square
					</label>
					<label for="profile_image_styleRound">
						<input type="radio" checked="checked" value="round" class="inputform profile_image_style" id="profile_image_styleRound" name="profile_image_style">
						Round
					</label>
					</fieldset>';
				
		
				
				//echo $this->Form->input('welcome_email',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'legend'=>'Welcome Email for New User','id'=>'welcome_email','class'=>'inputform welcome_email','default'=>$site_datas['Sitesetting']['welcome_email']));
				
				//echo $this->Form->input('profile_image_style',array('type'=>'radio','options'=>array('square'=>'Square','round'=>'Round'),'label'=>'How the Profile Images should be view','id'=>'profile_image_style','class'=>'inputform profile_image_style','name'=>'profile_image_style','default'=>$siteChanges['profile_image_view']));
				
				
				if($site_datas['Sitesetting']['affiliate_enb']=="enable")
				echo '<fieldset>
				<legend>Affiliate System</legend>
				<label for="affiliatepgmEnable">
					<input type="radio" checked="checked" value="enable" class="inputform profile_image_style" id="affiliatepgmEnable" name="affiliate_enb">
					enable
				</label>
				<label for="affiliatepgmDisable">
					<input type="radio" value="disable" class="inputform profile_image_style" id="affiliatepgmDisable" name="affiliate_enb">
					disable
				</label>
				</fieldset>';
				else
				echo '<fieldset>
				<legend>Affiliate System</legend>
				<label for="affiliatepgmEnable">
					<input type="radio" value="enable" class="inputform profile_image_style" id="affiliatepgmEnable" name="affiliate_enb">
					enable
				</label>
				<label for="affiliatepgmDisable">
					<input type="radio" checked="checked" value="disable" class="inputform profile_image_style" id="affiliatepgmDisable" name="affiliate_enb">
					disable
				</label>
				</fieldset>';
				
				//echo $this->Form->input('affiliate_system',array('type'=>'radio','options'=>array('enable'=>'enable','disable'=>'disable'),'label'=>'Select affiliate system','id'=>'affiliatepgm','class'=>'inputform profile_image_style','name'=>'affiliate_enb','default'=>$site_datas['Sitesetting']['affiliate_enb']));
				
				if($site_datas['Sitesetting']['welcome_email']=="yes")
				echo '<fieldset>
				<legend>Welcome Email</legend>
				<label for="welcome_emailYes">
					<input type="radio" checked="checked" value="yes" class="inputform welcome_email" id="welcome_emailYes" name="data[Sitesetting][welcome_email]">
					Yes
				</label>
				<label for="welcome_emailNo">
					<input type="radio" value="no" class="inputform welcome_email" id="welcome_emailNo" name="data[Sitesetting][welcome_email]">
					No
				</label>
				</fieldset>';
				else
				echo '<fieldset>
				<legend>Welcome Email</legend>
				<label for="welcome_emailYes">
					<input type="radio" value="yes" class="inputform welcome_email" id="welcome_emailYes" name="data[Sitesetting][welcome_email]">
					Yes
				</label>
				<label for="welcome_emailNo">
					<input type="radio" checked="checked" value="no" class="inputform welcome_email" id="welcome_emailNo" name="data[Sitesetting][welcome_email]">
					No
				</label>
				</fieldset>';
				
				//echo $this->Form->input('welcome_email',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Send welcome mail for newly signed up users','id'=>'welcome_email','class'=>'inputform welcome_email','default'=>$site_datas['Sitesetting']['welcome_email']));
				
				if($site_datas['Sitesetting']['signup_active']=="yes")
				echo '<fieldset>
				<legend>Signup Active</legend>
				<label for="signup_activeYes">
					<input type="radio" checked="checked" value="yes" class="inputform signup_active" id="signup_activeYes" name="data[Sitesetting][signup_active]">
					Yes
				</label>
				<label for="signup_activeNo">
					<input type="radio" value="no" class="inputform signup_active" id="signup_activeNo" name="data[Sitesetting][signup_active]">
					No
				</label>
				</fieldset>';
				else
				echo '<fieldset>
				<legend>Signup Active</legend>
				<label for="signup_activeYes">
					<input type="radio" value="yes" class="inputform signup_active" id="signup_activeYes" name="data[Sitesetting][signup_active]">
					Yes
				</label>
				<label for="signup_activeNo">
					<input type="radio" checked="checked" value="no" class="inputform signup_active" id="signup_activeNo" name="data[Sitesetting][signup_active]">
					No
				</label>
				</fieldset>';
				
				//echo $this->Form->input('signup_active',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Auto activate members on signing up','id'=>'signup_active','class'=>'inputform signup_active','default'=>$site_datas['Sitesetting']['signup_active']));
				
				
				
				echo "<br clear='all' />";
				
				echo "Like Button logo:";
				//$site_datas['Sitesetting']['site_likebtn_logo']='';
				echo "<div class='input-group'>";
						echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'adminlikebtnadd.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 16px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_like', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$site_datas['Sitesetting']['site_likebtn_logo'],'name'=>'site_likebtn_logo'));
							if(!empty($site_datas['Sitesetting']['site_likebtn_logo'])){  echo "<a href='javascript:void(0);' id='removeimg_like' style='display: inline; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg_like(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }else{echo "<a href='javascript:void(0);' id='removeimg_like' style='display: none; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg_like(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }
						echo "</div>";
						if(!empty($site_datas['Sitesetting']['site_likebtn_logo'])){
						echo "<img id='show_url_like'  style='float: left;margin-left: 10px;width: 40px;height:40px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."images/logo/".$site_datas['Sitesetting']['site_likebtn_logo']."'>";
						}else{
						echo "<img id='show_url_like'  style='float: left;margin-left: 10px;width: 40px;height:40px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."images/fantacylike.png'>";
						}
				echo "</div>";
				echo "<br clear='all' />";
					
				
				
				
				
				echo "Site Logo:";
				//$site_datas['Sitesetting']['site_logo']='';
				echo "<div class='input-group'>";
						echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'admin_update.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&sitelogo=sitelogo&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 16px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$site_datas['Sitesetting']['site_logo'],'name'=>'site_logo'));
							if(!empty($site_datas['Sitesetting']['site_logo'])){  echo "<a href='javascript:void(0);' id='removeimg'' style='display: inline; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' style='display: none; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }
						echo "</div>";
						if(!empty($site_datas['Sitesetting']['site_logo'])){
						echo "<img id='show_url'  style='float: left;margin-left: 10px;width: 100px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."images/logo/".$site_datas['Sitesetting']['site_logo']."'>";
						}else{
						echo "<img id='show_url'  style='float: left;margin-left: 10px;width: 100px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."images/logo.png'>";
						}
				echo "</div>";
				echo "<br clear='all' />";
				
			

			// saravana pandian
			
				//$site_datas['Sitesetting']['site_likebtn_logo']='';
				echo "Favicon:";
				echo "<div class='favicon'>";
						echo '<div class="favimg"><iframe class="image_fav" id="fav" name="fav" src="'.$this->webroot.'adminfavupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 16px;"></iframe>';												
							//echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_fav', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$site_datas['Sitesetting']['site_likebtn_logo'],'name'=>'site_likebtn_logo'));
							 echo "<a href='javascript:void(0);' id='removeimg_fav' style='display: inline; margin-top: 5px; float: left;height:auto;overflow:hiddden;' onclick='removeusrimg_fav(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; 
							//}else{echo "<a href='javascript:void(0);' id='removeimg_like' style='display: none; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg_like(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }
						echo "</div>";
						
						echo "<img id='show_url_fav'  style='float: left;margin-left: 10px;width: 40px;height:40px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."favicon.ico'>";
						
				echo "</div>";
				echo "<br clear='all' />";
					
				
				
				
				
				
				//$site_datas['Sitesetting']['site_logo']='';
				echo "Default User Profile Image:";
				echo "<div class='usrimg'>";
						echo '<div class="usrimg"><iframe class="image_usr" id="usr" name="usr" src="'.$this->webroot.'adminupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&sitelogo=sitelogo&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 16px;"></iframe>';												
							//echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_usr', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$site_datas['Sitesetting']['site_logo'],'name'=>'site_logo'));
							 echo "<a href='javascript:void(0);' id='removeimg_usr' style='display: inline; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg_usr(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; 
							//}else{echo "<a href='javascript:void(0);' id='removeimg' style='display: none; margin-top: 5px; float: left;height:auto;overflow:hidden;' onclick='removeusrimg(\" 1 \")'><span class='btn btn-danger'><i class='icon-trash'></i></span></a>"; }
						echo "</div>";
						

						echo "<img id='show_url_usr'  style='float: left;margin-left: 10px;width: 100px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;background-color:#000000;' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'>";

						
				echo "</div>";

				echo "<br clear='all' />";
				

		
				

//				echo $this->Form->input('like_btn_cmnt',array('type'=>'text','label'=>'Like button letters(Example Like it)','id'=>'support_email','class'=>'inputform','value'=>$site_datas['Sitesetting']['like_btn_cmnt']));
				
				
//				echo $this->Form->input('liked_btn_cmnt',array('type'=>'text','label'=>'Liked button letters(Example Liked)','id'=>'support_email','class'=>'inputform','value'=>$site_datas['Sitesetting']['liked_btn_cmnt']));
				
				
				echo $this->Form->input('credit_amount',array('type'=>'text','label'=>'User Credit Amount','id'=>'credit_amount','class'=>'inputform','value'=>$siteChanges['credit_amount']));
				
				
				/******** Footer content ***********/
				
				echo '<label>Footer Content (Left) </label>';
				echo '<textarea rows="5" cols="100" name="data[Sitesetting][footer_left]">'.$site_datas['Sitesetting']['footer_left'].'</textarea>';
				echo '<label>Footer Content (Right) </label>';
				echo '<textarea rows="5" cols="100" name="data[Sitesetting][footer_right]">'.$site_datas['Sitesetting']['footer_right'].'</textarea>';				
				
				if($site_datas['Sitesetting']['footer_active']=="yes")
					echo '<fieldset>
					<legend>Footer Active</legend>
					<label for="footer_activeYes">
						<input type="radio" checked="checked" value="yes" class="inputform footer_active" id="footer_activeYes" name="data[Sitesetting][footer_active]">
						Yes
					</label>
					<label for="footer_activeNo">
						<input type="radio" value="no" class="inputform footer_active" id="footer_activeNo" name="data[Sitesetting][footer_active]">
						No
					</label>
					</fieldset>';
				else				
					echo '<fieldset>
					<legend>Footer Active</legend>
					<label for="footer_activeYes">
						<input type="radio" value="yes" class="inputform footer_active" id="footer_activeYes" name="data[Sitesetting][footer_active]">
						Yes
					</label>
					<label for="footer_activeNo">
						<input type="radio" checked="checked" value="no" class="inputform footer_active" id="footer_activeNo" name="data[Sitesetting][footer_active]">
						No
					</label>
					</fieldset>';	
				
				/******** Footer content ***********/	
				
			echo "</div>";
			echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Site settings------->	



<style>
	
.show_hid{
	display:none;
}
</style>
<script>
function removeusrimg_like(val){
	$('#image_computer_like').val('');
	$('#show_url_like').attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg_like').hide();
}
function removeusrimg(val){
	$('#image_computer').val('');
	$('#show_url').attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg').hide();
}

function removeusrimg_fav(val){
	//$('#image_computer_fav').val('');
	$('#show_url_fav').attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg_fav').hide();
}
function removeusrimg_usr(val){
	//$('#image_computer_usr').val('');
	$('#show_url_usr').attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg_usr').hide();
}
</script>


   </div></div></div>
     

    
        </div>
    </div>
</div>
    


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>
