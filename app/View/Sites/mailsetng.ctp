<body class=""> 
  <!--<![endif]-->
      
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Email Management</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Email Management</li>
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
						<h2>Email Management</h2>
						
					</div>
					<div class="box-content">

				
	
			
	<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Sitesetting',array('url'=>array('controller'=>'/','action'=>'/admin/mail/setting'),'id'=>'mailform'));
			
			echo "<div id='forms'>";
				
				
				echo $this->Form->input('notification_email',array('type'=>'text','label'=>'E-mail(Used for notifications on sale, disputes and comments on items)','id'=>'notification_email','class'=>'inputform','value'=>$site_datas['Sitesetting']['notification_email']));
				
				echo $this->Form->input('support_email',array('type'=>'text','label'=>'Support e-mail(Text from contact us page will be sent to this mail id)','id'=>'support_email','class'=>'inputform','value'=>$site_datas['Sitesetting']['support_email']));
				
				echo $this->Form->input('noreply_name',array('type'=>'text','label'=>'Site no-reply name for e-mail','id'=>'noreply_name','class'=>'inputform','value'=>$site_datas['Sitesetting']['noreply_name']));
				
				echo $this->Form->input('noreply_email',array('type'=>'text','label'=>'Site no-reply e-mail','id'=>'noreply_email','class'=>'inputform','value'=>$site_datas['Sitesetting']['noreply_email']));
				echo $this->Form->input('noreply_password',array('type'=>'password','label'=>'Site no-reply e-mail password','id'=>'noreply_password','class'=>'inputform','value'=>$site_datas['Sitesetting']['noreply_password']));
				
		if($site_datas['Sitesetting']['gmail_smtp']=="enable")		
	echo '<fieldset>
	<legend>Gmail SMTP Gateway</legend>
		<label for="gmail_smtpEnable">
				<input type="radio" checked="checked" value="enable" class="inputform gmail_smtp" id="gmail_smtpEnable" name="data[Sitesetting][gmail_smtp]">
				Enable
			</label>
		<label for="gmail_smtpDisable">
				<input type="radio" value="disable" class="inputform gmail_smtp" id="gmail_smtpDisable" name="data[Sitesetting][gmail_smtp]">
				Disable
			</label>
	</fieldset>';	
	else
	echo '<fieldset>
	<legend>Gmail SMTP Gateway</legend>
		<label for="gmail_smtpEnable">
				<input type="radio" value="enable" class="inputform gmail_smtp" id="gmail_smtpEnable" name="data[Sitesetting][gmail_smtp]">
				Enable
			</label>
		<label for="gmail_smtpDisable">
				<input type="radio" checked="checked" value="disable" class="inputform gmail_smtp" id="gmail_smtpDisable" name="data[Sitesetting][gmail_smtp]">
				Disable
			</label>
	</fieldset>';			
				
				//echo $this->Form->input('gmail_smtp',array('type'=>'radio','options'=>array('enable'=>'enable','disable'=>'disable'),'legend'=>'Gmail SMTP Gateway','id'=>'gmail_smtp','class'=>'inputform gmail_smtp','default'=>$site_datas['Sitesetting']['gmail_smtp']));
				echo $this->Form->input('smtp_port',array('type'=>'text','label'=>'Gmail SMTP Port Number','id'=>'smtp_port','class'=>'inputform','value'=>$site_datas['Sitesetting']['smtp_port']));
				
				echo "<br clear='all' />";
				
				
				
				
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
