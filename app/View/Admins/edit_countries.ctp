<body class=""> 
  <!--<![endif]-->
      
   
   
<div class="content">
<div class="box span12">
	<div class="box-header">
		<h2>Allowed Countries</h2>
	</div>
	<div class="box-content" style="margin-bottom:-20px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL.'admin/allowcountries'; ?>">Allowed Delivery Countries</a> <span class="divider">/</span></li>
            <li class="active">Manage Allowed Country</li>
        </ul>
	</div>
</div>
<div class="row-fluid">		
	<div class="box span12">
		<div class="box-header" data-original-title="">
			<h2>Edit Allowed Country</h2>
		</div>
		<div class="box-content">  
            <?php
	    echo "<div class='containerdiv'>";
		    echo $this->Form->Create('allowcountry',array('url'=>array('controller'=>'/','action'=>'/admin/edit/allowcountries/'.$getcntry['Allowedcountries']['id']),'id'=>'Alowcountryform'));

            ?>
                <label><?php echo __('Country');?></label>
				<div class="selectdiv" style="width: 280px; height: 28px; padding-top: 3px;">
				<select id="dcountry" name="dcountry" class="selectboxdiv" style="width: 280px ! important;">
					<option value=""><?php echo __('Select Country');?></option>
					<?php $selected = ''; 
							foreach ($countrylist as $country) { 
								if (isset($getcntry)  && $country['Country']['country'] == $getcntry['Allowedcountries']['country'])
									$selected = 'selected';
					?>
					<option value="<?php echo $country['Country']['id'];?>" <?php echo $selected;?>><?php echo $country['Country']['country']; ?></option>
					<?php $selected = '';} ?>
				</select>
				</div>
            
                <div style="margin-top: 10px;">
            <?php
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
