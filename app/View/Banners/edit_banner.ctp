<body class=""> 
  <!--<![endif]-->
   
<div class="content">

			<div class="box span12">
				<div class="box-header">
					<h2>Banner</h2>
				</div>
				<div class="box-content">
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li><a href="<?php echo SITE_URL.'admin/view/banner'; ?>">Banner</a> <span class="divider">/</span></li>
						<li class="active">Edit Banner</li>
					</ul>
				</div>
			</div>

	<!-----Banner------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Banner view</h2>
						
					</div>
					<div class="box-content">
<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Banner',array('url'=>array('controller'=>'/','action'=>'/admin/edit/banner/'.$id),'id'=>'bannerform'));
			
		
				echo "<div id='forms'>";
					echo '<table><tr><td>';
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name','value'=>$baners_data["Banner"]["banner_name"]));
					echo '</td>';
					echo '</tr><tr><td>';
					echo 'Html Source:';echo '<br/>';
					echo '<textarea rows="7" cols="10" name="data[html_source]">'.$baners_data['Banner']['html_source'].'</textarea>';
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type" value="'.$baners_data['Banner']['banner_type'].'">';
					if($baners_data['Banner']['status']=="Active")
						echo '<legend>Status</legend>
						<label>
							<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status]">
							Active
						</label>
						<label>
							<input type="radio" value="Inactive" class="inputform status" id="statusInactive" name="data[status]">
							De-active
						</label>';
					else						
						echo '<legend>Status</legend>
						<label>
							<input type="radio" value="Active" class="inputform status" id="statusActive" name="data[status]">
							Active
						</label>
						<label>
							<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status]">
							De-active
						</label>';
				echo "</div>";
				echo '<br />';
			
				
			echo $this->Form->submit('Submit',array('class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Banner------->	

   			
   			


 </div>
      
  </div>

</div>

