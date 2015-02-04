<body class=""> 
  <!--<![endif]-->
    
<script type="text/javascript" src="<?php echo SITE_URL; ?>tinymce/tinymce.min.js"></script>

   
   
   
   
 <div class="content">
 
   			<div class="box span12">
				<div class="box-header">
					<h2>Update the Contact Address</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	
            <li class="active">Contact Address</li>
			        </ul>
				</div>
			</div>




						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Contacted Users</h2>
						
					</div>
					<div class="box-content">

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('contact');
		
		echo $this->Form->input('contact',array('type'=>'textarea','label'=>false,'id'=>'description','class'=>'inputform','value'=>$contact));
			
		echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-success reg_btn' ));
		echo $this->Form->end();
	echo "</div>";
?>
</div></div>

</div>

</div>

</div>



<style>
	
.show_hid{
	display:none;
}
</style>
<script>
        tinymce.init({selector:'#description',
            plugins: [
                      "advlist autolink lists link image charmap print preview anchor",
                      "searchreplace visualblocks code fullscreen",
                      "insertdatetime table contextmenu paste"],
                      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
                  });
</script>
