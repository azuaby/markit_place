<body class=""> 
  <!--<![endif]-->
     
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Taxes</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/tax_rates'; ?>">Tax Rates</a> <span class="divider">/</span></li>
            <li class="active">Add Tax</li>
			        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Add Tax</h2>
					</div>
					
						
				
					<div class="box-content">   

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('Tax',array('url'=>array('controller'=>'/','action'=>'/admin/edit/tax/'.$tax_datas['Tax']['id']),'id'=>'Categoryform','onsubmit'=>'return addtaxform()'));
		?>
		<label>Country</label>
		<select name="countryid" id="selct_lctn_bxs">
			<option value="">Select a location...</option>
			<?php
				foreach($country_datas as $cnty){
					if($tax_datas['Tax']['countryid'] == $cnty['Country']['id']){
					echo "<option value='".$cnty['Country']['id']."' selected>".$cnty['Country']['country']."</option>";
					}else{
					echo "<option value='".$cnty['Country']['id']."' >".$cnty['Country']['country']."</option>";
					}
				}
			?>

		</select>		
			<?php
			echo $this->Form->input('taxname',array('type'=>'text','maxlength'=>'20','label'=>'Tax Name:','id'=>'tax_name','class'=>'inputform','value'=>$tax_datas['Tax']['taxname']));
			echo $this->Form->input('percentage',array('type'=>'text','maxlength'=>'20','label'=>'Percentage (%) :','id'=>'percentage','class'=>'inputform','value'=>$tax_datas['Tax']['percentage']));
			echo '<label>Status</label>';
			echo '<select name="status">';
			if($tax_datas['Tax']['status']=='enable')
			{
				echo '<option value="enable" selected>Enable</option>';
				echo '<option value="disable">Disable</option>';
			}
			else
			{
				echo '<option value="enable">Enable</option>';
				echo '<option value="disable" selected>Disable</option>';			
			}
			echo '</select>';
			echo '<br />';
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
