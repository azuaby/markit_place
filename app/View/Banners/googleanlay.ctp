<body class=""> 
  <!--<![endif]-->
     
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Google Analytics</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Google Analytics</li>
					</ul>
				</div>
			</div>
 


    

	<!-----Google Analytics------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Google Analytics</h2>
						
					</div>
					<div class="box-content">

				
	
<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Googlecode',array('url'=>array('controller'=>'/','action'=>'/admin/google/code'),'id'=>'googleform'));
			
			echo "<div id='forms'>";
				echo $this->Form->input('id',array('type'=>'hidden','class'=>'inputform','value'=>$google_datas['Googlecode']['id']));
				
				//echo $this->Form->input('google_code',array('type'=>'textarea','label'=>'Google Analytics code','id'=>'google_code','class'=>'inputform','value'=>$google_datas['Googlecode']['google_code']));
				
				echo 'Google Analytics Code : ';echo '<br/>';
				echo '<textarea rows="2" cols="20" name="data[Googlecode][google_code]" id="google_code" class = "inputform">'.$google_datas['Googlecode']['google_code'].'</textarea>';
				
				
				if(empty($google_datas['Googlecode']['status'])){
					$status = 'no';
				}else{
					$status = $google_datas['Googlecode']['status'];
				}
				if($google_datas['Googlecode']['status']=="yes")
				echo '<legend>Active</legend>
				<label>
					<input type="radio" checked="checked" value="yes" class="inputform status" id="statusYes" name="data[Googlecode][status]">
					Yes
				</label>
				<label>
					<input type="radio" value="no" class="inputform status" id="statusNo" name="data[Googlecode][status]">
					No
				</label>';
				else
				echo '<legend>Active</legend>
				<label>
					<input type="radio" value="yes" class="inputform status" id="statusYes" name="data[Googlecode][status]">
					Yes
				</label>
				<label>
					<input type="radio" checked="checked" value="no" class="inputform status" id="statusNo" name="data[Googlecode][status]">
					No
				</label>';
				
				//echo $this->Form->input('status',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Enable google analytics','id'=>'status','class'=>'inputform status','default'=>$status));
				
			
				
			echo $this->Form->submit('Update',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Google Analytics------->	



 </div></div></div>
     

    
  </body>
</html>
