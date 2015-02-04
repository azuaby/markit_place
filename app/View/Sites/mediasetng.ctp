<body class=""> 
  <!--<![endif]-->
      
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Media Management</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Media Management</li>
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
						<h2>Media Management</h2>
						
					</div>
					<div class="box-content">

				
	
			
	<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Sitesetting',array('url'=>array('controller'=>'/','action'=>'/admin/media/setting'),'id'=>'mediaform'));
			
			echo "<div id='forms'>";
				
				echo $this->Form->input('media_url',array('type'=>'text','label'=>'Media URL','id'=>'media_url','class'=>'inputform','value'=>$site_datas['Sitesetting']['media_url']));
				echo '<span style="font-size: 12px; opacity: 0.7;"><b style="color: red;">Note:</b> Instead of giving a Url like this <b style="color:red;">(http://dev.example.com/default/)</b><br>Give it as 
							<b style="color:green;">(http://example.com/dev/default/)</b><br><br></span>';
				echo $this->Form->input('media_server_hostname',array('type'=>'text','label'=>'Media server Host Name','id'=>'media_server_hostname','class'=>'inputform','value'=>$site_datas['Sitesetting']['media_server_hostname']));
				
				echo $this->Form->input('media_server_username',array('type'=>'text','label'=>'Media server ftp Username','id'=>'media_server_username','class'=>'inputform','value'=>$site_datas['Sitesetting']['media_server_username']));
				
				echo $this->Form->input('media_server_password',array('type'=>'password','label'=>'Media server ftp Password','id'=>'media_server_password','class'=>'inputform','value'=>$site_datas['Sitesetting']['media_server_password']));
				
				echo $this->Form->input('meta_key',array('type'=>'text','label'=>'Html Meta Keyword','id'=>'meta_key','class'=>'inputform','value'=>$site_datas['Sitesetting']['meta_key']));
				
				echo $this->Form->input('meta_desc',array('type'=>'text','label'=>'Html Meta Description','id'=>'meta_desc','class'=>'inputform','value'=>$site_datas['Sitesetting']['meta_desc']));
				
				
				
				
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
