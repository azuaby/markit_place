<body class=""> 
  <!--<![endif]-->
     
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Delivery Countries</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li><a href="<?php echo SITE_URL.'admin/deliverycountries/'; ?>">Delivery Countries</a><span class="divider">/</span></li>
				<li class="active"><a href="<?php echo SITE_URL.'admin/add/countries/'; ?>">Add Country</a></li>
			</ul>
		</div>
	</div>

    <div class="btn-toolbar">
        <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
        <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
      <div class="btn-group">
      </div>
    </div>

      <!-----Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Add Delivery Country</h2>
			</div>
			<div class="box-content">
    <?php
            echo "<div class='containerdiv'>";
            echo $this->Form->Create('delcountry',array('id'=>'Delcountryform'));
            ?>
            
                <label><?php echo __('Country');?></label>
				<div class="selectdiv" style="width: 280px; height: 28px; padding-top: 3px;">
				<select id="dcountry" name="dcountry" class="selectboxdiv" style="width: 280px ! important;">
					<option value=""><?php echo __('Select Country');?></option>
					<?php $selected = ''; 
							foreach ($countrylist as $country) { 
								if (isset($usr_datas)  && $country['Country']['country'] == $usr_datas['Deliverycountries']['dcountry'])
									$selected = 'selected';
					?>
					<option value="<?php echo $country['Country']['id'];?>" <?php echo $selected;?>><?php echo $country['Country']['country']; ?></option>
					<?php $selected = '';} ?>
				</select><div class="out" ><?php echo $usr_datas['Deliverycountries']['dcountry']; ?></div>
				</div>
            
            
            <?php

		        echo $this->Form->input('darea',array('type'=>'text','label'=>'Areas','id'=>'darea', 'class'=>'inputform2'));
		        echo $this->Form->input('dcurrency',array('type'=>'text','label'=>'Select country currency','id'=>'dcurrency', 'class'=>'inputform3'));
		        echo $this->Form->input('dzone',array('type'=>'text','label'=>'Delivery charge Zone','id'=>'dzone', 'class'=>'inputform4'));
		        echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
        echo $this->Form->end();
	        echo "</div>";
    ?>
		    </div>
	    </div><!--/span-->
    </div><!--/row-->
						<!-----Commission------->	
</div>


