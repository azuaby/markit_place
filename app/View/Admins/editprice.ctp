<body class=""> 
  <!--<![endif]-->
      
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Price Range</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/manage/price'; ?>">Price</a> <span class="divider">/</span></li>
            <li class="active">Add Price</li>
			        </ul>
				</div>
			</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Edit Price</h2>
					</div>
					
						
				
					<div class="box-content">  

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('pricerange',array('url'=>array('controller'=>'/','action'=>'/admin/edit/price/'.$getpriceval['Price']['id']),'id'=>'Categoryform','onsubmit'=>'editPrice_range();'));
			//echo "<pre>";print_r($getpriceval['Price']['to']);die;
			echo $this->Form->input('from',array('type'=>'text','label'=>'Price Range From','id'=>'Category_name','class'=>'inputform1','value'=>$getpriceval['Price']['from']));
			echo $this->Form->input('to',array('type'=>'text','label'=>'Price Range To','id'=>'Category_name','class'=>'inputform2','value'=>$getpriceval['Price']['to']));
			
			
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
