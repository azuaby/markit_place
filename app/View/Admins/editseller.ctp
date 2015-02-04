<body class=""> 
  <!--<![endif]-->
      
    
<div class="content">

 			<div class="box span12">
				<div class="box-header">
					<h2>Edit Seller</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li><a href="<?php echo SITE_URL.'admin/manage/sellers'; ?>">Manage Seller</a> <span class="divider">/</span></li>
						<li class="active">Edit Seller</li>
			        </ul>
				</div>
			</div>
    
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Edit Seller</h2>
					</div>
					
						
				
					<div class="box-content">   
<div class="btn-toolbar">
    <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
    <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
  <div class="btn-group">
  </div>
</div>
   			<?php

	echo "<div class='containerdiv'>";
		echo $this->Form->Create('merchant',array('url'=>array('controller'=>'admins','action'=>'editseller/'.$shopModel['Shop']['id']), 'id'=>'sellerchk','onsubmit'=>'return sellersignupfrm()'));
		  			
			echo "<div id='forms'>";
			
		
				
				echo "<div class='input-group'>";
					echo "<span class='bills additem-label'>Brand</span></br>";
					
					echo "<input type='text' id='brand_name' name ='brand_name' class='input-xlarge brand_name' maxlength='180' value='".$shopModel['Shop']['shop_name']."'>";
				echo '<div class="brand_name-error adminitemerror" style="color:red"></div></div>';
				
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Full Name</label>";
					echo $this->Form->input('merchant_name',array('type'=>'text','label'=>false,'id'=>'merchant_name','class'=>'input-xlarge merchant_name','value'=>$shopModel['Shop']['shop_title']));
		
					
				echo '<div class="merchant_name-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Paypal Id</label>";
					echo $this->Form->input('paypalId',array('type'=>'text','label'=>false,'id'=>'paypalId','class'=>'input-xlarge paypalId','value'=>$shopModel['Shop']['paypal_id']));
		
					
				echo '<div class="paypalId-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Phone Number</label>";
					echo $this->Form->input('person_phone_number',array('type'=>'text','label'=>false,'id'=>'person_phone_number','class'=>'input-xlarge person_phone_number','value'=>$shopModel['Shop']['phone_no']));
		
					
				echo '<div class="person_phone_number-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Office Address</label>";
					echo $this->Form->input('officeaddress',array('type'=>'textarea','label'=>false,'id'=>'officeaddress','class'=>'input-xlarge officeaddress','value'=>$shopModel['Shop']['shop_address']));
		
					
				echo '<div class="officeaddress-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Latitude</label>";
					echo $this->Form->input('bankaccountno',array('type'=>'text','label'=>false,'id'=>'latid','class'=>'input-xlarge bankaccountno','value'=>$shopModel['Shop']['shop_latitude']));
		
					
				echo '<div class="latid-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<label>Longitude</label>";
					echo $this->Form->input('mpowerid',array('type'=>'text','label'=>false,'id'=>'longid','class'=>'input-xlarge mpowerid','value'=>$shopModel['Shop']['shop_longitude']));
		
					
				echo '<div class="longid-error adminitemerror" style="color:red"></div></div>';
				
				
			?>
	<input type="hidden" name="status" value="<?php echo $shopModel['Shop']['seller_status']; ?>" />
			<?php
				echo "<div id='alert' style='color:red;margin-top:15px;'></div>";
			echo "</div>";
			echo $this->Form->submit('Submit',array('class'=>'btn btn-primary reg_btn'));
			echo "<div class='form-error' style='color:red;'></div>";
		echo $this->Form->end();
	echo "</div>";
?>
<style>
	
.show_hid{
	display:none;
}

</style>
   			
   			
   	 </div>
      
  </div>

</div>
