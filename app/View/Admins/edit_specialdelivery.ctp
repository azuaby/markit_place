<body class=""> 
  <!--<![endif]-->
      
   
   
<div class="content">
<div class="box span12">
	<div class="box-header">
		<h2>Special Delivery</h2>
	</div>
	<div class="box-content" style="margin-bottom:-20px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL.'admin/specialdelivery/'; ?>">Special Delivery</a> <span class="divider">/</span></li>
            <li class="active">Edit Special Delivery</li>
        </ul>
	</div>
</div>
<div class="row-fluid">		
	<div class="box span12">
		<div class="box-header" data-original-title="">
			<h2>Edit Special Delivery</h2>
		</div>
		<div class="box-content">  
        <?php
	    echo "<div class='containerdiv'>";
		    echo $this->Form->Create('cart',array('url'=>array('controller'=>'/','action'=>'/admin/edit_specialdelivery/'.$getcharge['Cart']['id'])));

                echo $this->Form->input('user_id',array('type'=>'text','label'=>'User Id','id'=>'user_id', 'class'=>'inputform1','value'=>$user_name,'disabled'=>'disabled'));
                echo $this->Form->input('item_id',array('type'=>'text','label'=>'Item Id','id'=>'item_id', 'class'=>'inputform2','value'=>$item_name,'disabled'=>'disabled'));
                echo $this->Form->input('quantity',array('type'=>'text','label'=>'Quantity','id'=>'quantity', 'class'=>'inputform3','value'=>$getcharge['Cart']['quantity'],'disabled'=>'disabled'));
                echo $this->Form->input('size_options',array('type'=>'text','label'=>'Size Options','id'=>'size_options', 'class'=>'inputform4', 'value'=>$getcharge['Cart']['size_options'],'disabled'=>'disabled'));
                echo $this->Form->input('shipping_charg',array('type'=>'float','label'=>'Shipping Charges','id'=>'shipping_charg', 'class'=>'inputform5', 'value'=>$getcharge['Cart']['shipping_charg']));


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
