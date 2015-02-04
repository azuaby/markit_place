<body class=""> 
  <!--<![endif]-->
      
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Social Settings</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Social Settings</li>
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
						<h2>Social Settings</h2>
						
					</div>
					<div class="box-content">

				
	
			
	<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Socialsetting',array('url'=>array('controller'=>'/','action'=>'/admin/social/setting')));
			echo "<div id='forms'>";
			
			echo '<label>Facebook Id</label>';
			echo '<input type="text" name="data[Sitesetting][fb_id]" value="'.$site_datas['Sitesetting']['fb_id'].'">';
			echo '<label>Facebook Secret Code</label>';
			echo '<input type="text" name="data[Sitesetting][fb_secret]" value="'.$site_datas['Sitesetting']['fb_secret'].'">';
			echo '<label>Google Id</label>';
			echo '<input type="text" name="data[Sitesetting][google_id]" value="'.$site_datas['Sitesetting']['google_id'].'">';
			echo '<label>Google Secret Code</label>';
			echo '<input type="text" name="data[Sitesetting][google_secret]" value="'.$site_datas['Sitesetting']['google_secret'].'">';
			echo '<label>Twitter Id</label>';
			echo '<input type="text" name="data[Sitesetting][twitter_id]" value="'.$site_datas['Sitesetting']['twitter_id'].'">';
			echo '<label>Twitter Secret Code</label>';
			echo '<input type="text" name="data[Sitesetting][twitter_secret]" value="'.$site_datas['Sitesetting']['twitter_secret'].'">';
			echo '<label>Gmail Client Id</label>';
			echo '<input type="text" name="data[Sitesetting][gmail_client_id]" value="'.$site_datas['Sitesetting']['gmail_client_id'].'">';
			echo '<label>Gmail Client Secret Code</label>';
			echo '<input type="text" name="data[Sitesetting][gmail_client_secret]" value="'.$site_datas['Sitesetting']['gmail_client_secret'].'">';	
					
				
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
