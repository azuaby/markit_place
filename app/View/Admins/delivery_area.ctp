<body class=""> 
  <!--<![endif]-->
     
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Delivery Charges Countries</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li><a href="<?php echo SITE_URL.'admin/deliverycharges/'; ?>">Delivery Charges Countries</a><span class="divider">/</span></li>
				<li class="active"><a href="<?php echo SITE_URL.'admin/deliveryarea/'; ?>">Add Area</a></li>
			</ul>
		</div>
	</div>

      <!-----Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Add Delivery Area</h2>
			</div>
			<div class="box-content">
    <?php
            echo "<div class='containerdiv'>";
            echo $this->Form->Create('delcharges',array('id'=>'Delchargeform'));
            ?>
            
                <label><?php echo __('Area');?></label>
				<div class="selectdiv" style="width: 280px; height: 28px; padding-top: 3px;">
				<select id="zone_name" name="zone_name" class="selectboxdiv" style="width: 280px ! important;">
					<option value=""><?php echo __('Select Area');?></option>
					<?php $selected = ''; 
							foreach ($arealist as $area) { 
					?>
					<option value="<?php echo $area['Area']['area'];?>" <?php echo $selected;?>><?php echo $area['Area']['area']; ?></option>
					<?php $selected = '';} ?>
				</select>
				</div>
            
            <?php
//		        echo $this->Form->input('zone_name',array('type'=>'text','label'=>'Zone name','id'=>'zone_name','class'=>'inputform1'));
		        echo $this->Form->input('regulr_chrge',array('type'=>'float','label'=>'Regular Delivery charge','id'=>'regulr_chrge', 'class'=>'inputform2'));
		        echo $this->Form->input('expres_chrge',array('type'=>'float','label'=>'Express Delivery charge','id'=>'expres_chrge', 'class'=>'inputform3'));
		        echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
        echo $this->Form->end();
	        echo "</div>";
    ?>
		    </div>
	    </div><!--/span-->
    </div><!--/row-->
						<!-----Commission------->	
</div>


