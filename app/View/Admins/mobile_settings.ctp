<body class=""> 
  <!--<![endif]-->
 
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Mobile Apps Settings</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	
			            <li class="active">Mobile Apps Settings</li>
			        </ul>
				</div>
			</div>
 



	<!-----Mobile Apps Settings------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Mobile Apps Settings</h2>
						
					</div>
					<div class="box-content">

			<div class='containerdiv'>
		
		<?php	
		echo $this->Form->Create('mobile',array('url'=>array('controller'=>'/',
				'action'=>'/admin/mobile/settings')));
		?>
				<ul>Default Language</ul>
				<ul><select name="language" id="lang">
       				<option value=""><?php echo "Select Language";?></option>
				<?php 
				$languages = $_SESSION['language_settings']['languages'];
				foreach($languages as $key => $language ){
					if($mobile_lang['language']==$language)
					{
				?>
				<option value="<?php echo $language;?>" selected><?php echo $key;?></option>
				<?php
				}
				else
				{
				?>
				 <option value="<?php echo $language;?>"><?php echo $key;?></option>
				<?php 
				}
				}
				?> </select>				
				</ul>
			
		<ul><?php echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
		echo $this->Form->end();
	?></ul>
	</div>		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Mobile Apps Settings------->	

	



</div>

</div>

</div>




<style>
	
.show_hid{
	display:none;
}
</style>
