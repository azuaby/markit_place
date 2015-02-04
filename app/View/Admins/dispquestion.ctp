<body class=""> 
  <!--<![endif]-->
     


 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Dispute Problem List</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'admin/manage/problemlist'; ?>">Problem List</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'admin/add/dispquestion'; ?>">Create Problem Question</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>
 

						<!-----Dispute Problem List------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Dispute Problem List</h2>
						
					</div>
					<div class="box-content">

				
	
	  
    <?php //echo $this->Form->create('Dispplm', array( 'id'=>'rlyadmsg1','onsubmit'=>'return rlyadmsg()')); ?>
    <?php echo $this->Form->Create('Dispplm',array('url'=>array('controller'=>'/','action'=>'/admin/add/dispquestion/'.$id),'id'=>'rlyadmsg1','onsubmit'=>'return rlyadmsg();'));?>
    
    <div class="input">
    <input type="text" name="data[Dispplm][plm]" id="message" value="<?php echo $query;?>">
 </div>
 <?php echo "<div class='doalert' style='color:red;float:right;height:0px;padding:5px 725px 0px 0px;'></div>"; ?>
  <?php
			echo $this->Form->submit('Save',array('class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Dispute Problem List------->	
    
  

</div>


<script type="text/javascript">
function rlyadmsg(){
	$('.doalert').html('');
	var plm = $('#message').val();

	if (plm == ''){
		$('.doalert').html('Pls Enter The Text');
		return false;
	}else{
		return true;
	}
}
</script>
