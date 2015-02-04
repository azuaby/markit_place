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
            <li class="active">Get Contacts List</li>
			        </ul>
				</div>
			</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Get Contacts List</h2>
					</div>
					
					
					<div class="box-content">  

<?php
	
	echo "<div class='containerdiv'>";
	echo 'Group Id : <select><option value="1">1</option></select>';
	echo '<br />';
	echo '<button onclick="get_contacts_list()" class="btn btn-primary">Get Contacts</button>';
	echo '<br /><br />';
	echo '<div id="emailslist"></div>';
	echo $emails;
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
