<body class=""> 
  <!--<![endif]-->
      
   
   
<div class="content">
<div class="box span12">
	<div class="box-header">
		<h2>Delivery Charges</h2>
	</div>
	<div class="box-content" style="margin-bottom:-20px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL.'admin/manage/price'; ?>">Price</a> <span class="divider">/</span></li>
            <li class="active">Delivery Charges Countries</li>
        </ul>
	</div>
</div>
<div class="row-fluid">		
	<div class="box span12">
		<div class="box-header" data-original-title="">
			<h2>Edit Delivery Charges</h2>
		</div>
		<div class="box-content">  
        <?php
	    echo "<div class='containerdiv'>";
		    echo $this->Form->Create('delcharges',array('url'=>array('controller'=>'/','action'=>'/admin/edit/delcharge/'.$getchargeval['Deliverycharge']['id']),'id'=>'Delchargeform'));

                echo $this->Form->input('zone_name',array('type'=>'text','label'=>'Zone name','id'=>'zone_name','class'=>'inputform1','value'=>$getchargeval['Deliverycharge']['name']));
                echo $this->Form->input('regulr_chrge',array('type'=>'float','label'=>'Regular Delivery charge','id'=>'regulr_chrge', 'class'=>'inputform2','value'=>$getchargeval['Deliverycharge']['regulr_chrge']));
                echo $this->Form->input('expres_chrge',array('type'=>'float','label'=>'Express Delivery charge','id'=>'expres_chrge', 'class'=>'inputform3','value'=>$getchargeval['Deliverycharge']['expres_chrge']));

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
