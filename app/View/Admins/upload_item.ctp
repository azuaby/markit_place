<body class=""> 
  <!--<![endif]-->
     
   
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Upload the Item</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
<li><a href="<?php echo SITE_URL.'admin/manage/items/'; ?>">Manage Item</a> <span class="divider">/</span></li>
           	
            <li class="active">Upload the Item</li>
			        </ul>
				</div>
			</div>
					<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Upload the Item</h2>
					</div>
					
						
				
					<div class="box-content">  

	
	<div class='containerdiv'>
		
		<?php	
		echo $this->Form->create('Pages', array('type' => 'file'));

		echo $this->Form->input('file',array( 'type' => 'file'));


		 echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
		echo $this->Form->end();
	?></ul>
	</div>


</div>

</div>

</div>



<style>
	
.show_hid{
	display:none;
}
</style>
