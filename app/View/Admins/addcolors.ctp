<body class=""> 
  <!--<![endif]-->
     
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Color</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/manage/colors'; ?>">Color</a> <span class="divider">/</span></li>
            <li class="active">Add Color</li>
			        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Add Color</h2>
					</div>
					
						
				
					<div class="box-content">   

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('Color',array('url'=>array('controller'=>'/','action'=>'/admin/add/colors'),'id'=>'Categoryform','onsubmit'=>'return addcolorform()'));
		
			echo $this->Form->input('colorname',array('type'=>'text','maxlength'=>'20','label'=>'Color Name:','id'=>'Color_name','class'=>'inputform'));
			?>
			RGB Range:<br clear="all" />
			<input type="text" maxlength="3" name="rgbval1" style="width:60px !important;">
			<input type="text" maxlength="3" name="rgbval2" style="width:60px !important;">
			<input type="text" maxlength="3" name="rgbval3" style="width:60px !important;">
			<br clear="all" />
			<?php
			echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>


</div>

</div>

</div>



<style>
	
.show_hid{
	display:none;
}
</style>
