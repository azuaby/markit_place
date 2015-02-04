<body class=""> 
  <!--<![endif]-->
   
   
   
   
   
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Contact Seller Subjects</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li><a href="<?php echo SITE_URL.'admin/manage/contactsellersubject'; ?>">Contact Seller Subjects</a> <span class="divider">/</span></li>
					   	<li class="active">Add Subject</li>
					</ul>
				</div>
			</div>



						<!-----Contact Seller Subjects------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Contact Seller Subjects</h2>
						
					</div>
					<div class="box-content">

				
	
			<?php

echo "<div class='containerdiv'>";


	echo $this->Form->Create('cssubject',array('url'=>array('controller'=>'/','action'=>'/admin/addcssubject/'.$id),'id'=>'cssubjectform','onsubmit'=>'return validatesubject();'));
		
		echo $this->Form->input('Subject',array('type'=>'textarea','value'=>$query,'id'=>'cssubject','maxlength'=>'40'));
		
		//echo "<a href='javascript:void(0);' onclick='deleteform()' style='display:none;' class='deletfrm'>Delete</a>";
		echo $this->Form->submit('Submit',array('class'=>'btn btn-primary'));
		echo "<div class='cserror' style='color:red;'></div>";
	echo $this->Form->end();
?>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Contact Seller Subjects------->	




</div>

</div>
</div>

<script type="text/javascript">
function validatesubject(){
	$('.cserror').html('');
	var subject = $('#cssubject').val();

	if (subject == ''){
		$('.cserror').html('Subject cannot be empty');
		return false;
	}else if (subject == 'Others' || subject == 'others'){
		$('.cserror').html('Subject cannot be Others');
		return false;
	}else{
		return true;
	}
}
</script>
