<body class=""> 
  <!--<![endif]-->
     
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Manage modules</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Manage modules</li>
					</ul>
				</div>
			</div>
 

	<!-----Manage Modules------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Manage Modules</h2>
						
					</div>
					<div class="box-content">

	<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Managemodule',array('url'=>array('controller'=>'/','action'=>'/admin/module/setting')));
			
			echo "<div id='forms'>";
				echo $this->Form->input('id',array('type'=>'hidden','class'=>'inputform','value'=>$modeule_datas['Managemodule']['id']));
				
				if(empty($modeule_datas['Managemodule']['display_banner'])){
					$status = 'no';
				}else{
					$status = $modeule_datas['Managemodule']['display_banner'];
				}
				
				
				
				
				
				if($modeule_datas['Managemodule']['display_banner']=="yes")
				echo '<legend>Display Banner</legend>
				<label for="display_bannerYes">
					<input type="radio" checked="checked" value="yes" class="inputform status" id="display_bannerYes" name="data[Managemodule][display_banner]">
					Yes
				</label>
				<label for="display_bannerNo">
					<input type="radio" value="no" class="inputform status" id="display_bannerNo" name="data[Managemodule][display_banner]">
					No
				</label>';
				else
				echo '<legend>Display Banner</legend>
				<label for="display_bannerYes">
					<input type="radio" value="yes" class="inputform status" id="display_bannerYes" name="data[Managemodule][display_banner]">
					Yes
				</label>
				<label for="display_bannerNo">
					<input type="radio" checked="checked" value="no" class="inputform status" id="display_bannerNo" name="data[Managemodule][display_banner]">
					No
				</label>';
				
				//echo $this->Form->input('display_banner',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Display Banners','id'=>'display_banner','class'=>'inputform status','default'=>$status));
				
				if(empty($modeule_datas['Managemodule']['site_maintenance_mode'])){
					$mode = 'no';
				}else{
					$mode = $modeule_datas['Managemodule']['site_maintenance_mode'];
				}
				if($modeule_datas['Managemodule']['site_maintenance_mode']=="yes")
				echo '<legend>Site Maintenance Mode</legend>
				<label>
					<input type="radio" checked="checked" value="yes" class="inputform status" id="display_bannerYes" name="data[Managemodule][site_maintenance_mode]">
					Yes
				</label>
				<label>
					<input type="radio" value="no" class="inputform status" id="display_bannerNo" name="data[Managemodule][site_maintenance_mode]">
					No
				</label>';
				else
				echo '<legend>Site Maintenance Mode</legend>
				<label>
					<input type="radio" value="yes" class="inputform status" id="display_bannerYes" name="data[Managemodule][site_maintenance_mode]">
					Yes
				</label>
				<label>
					<input type="radio" checked="checked" value="no" class="inputform status" id="display_bannerNo" name="data[Managemodule][site_maintenance_mode]">
					No
				</label>';
				
				//echo $this->Form->input('site_maintenance_mode',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Turn on site maintenance mode','id'=>'display_banner','class'=>'inputform status','default'=>$mode));
				
				echo $this->Form->input('maintenance_text',array('type'=>'text','label'=>'Text to be displayed when site is under maintenance','id'=>'maintenance_text','class'=>'inputform','value'=>$modeule_datas['Managemodule']['maintenance_text']));
				
				
				
			echo $this->Form->submit('Update',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Manage Modules------->	



   </div></div></div>
     

