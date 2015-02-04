<body class=""> 
  <!--<![endif]-->
      
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Newsletter</h2>
				</div>
				<div class="box-content">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
            <li class="active">Add News</li>
			        </ul>
				</div>
			</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Add News</h2>
					</div>
					
					<?php
						
						foreach($users as $key=>$email) {
						$emails[] = $email['User']['email'];
						
					}
					
						
					?>
					
					<div class="box-content">  

<?php
	
	echo "<div class='containerdiv'>";
	echo '<span id="listemail"></span>';
	/*echo $this->Form->input('email',array('type'=>'select','options'=>$emails,'label'=>'','id'=>'email','class'=>'inputform selectboxdiv','empty'=>'Select a Email' ));
	echo "<input type='hidden' value=$count id='count'>";	
	for($i=0; $i<$count; $i++) {
			
		echo "<input type='hidden' value=$emails[$i] id='check".$i."'>";

	}
	echo '<input type="checkbox" id="selectAll" name="all" ">';
	echo "Select All Emails";
	echo "<div style='margin-top:15px;' >";
	echo '<button class="btn btn-primary" onclick="addcontacts()" >Add</button>';
	echo "</div>";
	echo '<div class="pushnotloader" style="display:inline-block;">'; ?>
	<img id="loading_image" src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" style="width:20px;display:none;margin:0px 0px -7px 5px;"/>
       	<?php echo '</div>';*/
	echo "</div>";
?>


</div>

</div>

</div>
<script>
$(document).ready(function(){
get_contacts_list_email();
});
</script>


<style>
	
.show_hid{
	display:none;
}
</style>
