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
            <li class="active">Newsletter</li>
			        </ul>
				</div>
			</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Newsletter</h2>
					</div>
					
					
				
					<div class="box-content">  

<?php
	echo "<div class='containerdiv'>"; ?>
	
				<label>Subject</label>
				<input type="text"  name="commission_amount" value="" class="span3"  id="subject" />	
		
			<label>Message</label>
			
			<textarea style="width:220px;"  rows="5" cols="20" name="commissionDetails" id="message" value="" class="spa"></textarea><label></label>
	<?php
	echo '<button class="btn btn-primary" onclick="sendnewsletter()">Send</button>';
	echo '<div class="pushnotloader" style="display:inline-block;">'; ?>
	<img id="loading_image" src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" style="width:20px;display:none;margin:0px 0px -7px 5px;"/>
       	<?php echo '</div>';
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
