<body class=""> 
  <!--<![endif]-->
      
<div class="content">
    
    
    			<div class="box span12">
				<div class="box-header">
					<h2>Commission</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li class="active"><a href="<?php echo SITE_URL.'admin/viewcommission/'; ?>">Commision</a><span class="divider">/</span></li>
						<li><a href="<?php echo SITE_URL.'admin/commission/'; ?>">Add Commision</a></li>
					</ul>
				</div>
			</div>
<div class="header">
   <h1 class="page-title"></h1>
</div>
    




                    
<div class="btn-toolbar">
    <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
    <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
  <div class="btn-group">
  </div>
</div>



      
      
      
      <!-----Edit Commission------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Add Commission</h2>
						
					</div>
					<div class="box-content">

				
		<?php
   			echo $this->Form->create('commision', array( 'onsubmit' => 'commisionRange();'), array('url' => array('controller' => '/', 'action' => '/admin/editcommission/'.$getcommivalues['Commission']['id'])));
			?>
			<div class="control-group">
			<label>Apply to<span style="color:red;"> *</span></label>
			<label><select name="applyto" class="span3">
				<!--option value="1">User</option-->
				<option value="Seller">Seller</option>
				</select></label>
			</div>
			
			<label for="reduction_amount">Commission Type<span style="color:red;"> *</span></label>
			<?php //echo $getcommivalues['Commission']['type']; ?>
				<div class="control-group">
				<label> <select name="commission_type" class="span3" , id="commission_type">
				<?php 
				
				if($getcommivalues['Commission']['type']=='%'){
				echo "<option value='%'  selected= 'selected' >%</option>";
				echo '<option value="$">$</option>'; 
				}elseif($getcommivalues['Commission']['type']=='$'){
				echo "<option value='%' >%</option>";
				echo '<option value="'.$_SESSION['currency_symbol'].'"  selected= "selected" >'.$_SESSION['currency_symbol'].'</option>'; 
				}
				?>
					</select>
				</label>
				</div>
			
			<label>Min Range <span class=""> eg(10, 10.50)</span></label>
			<input type="text" id="minrange" name="start_range" value="<?php echo $getcommivalues['Commission']['min_value']; ?>" class="span3"  />
			<label>Max Range <span class=""> eg(10, 10.50)</span></label>
			<input type="text" id="maxrange" name="end_range" value="<?php echo $getcommivalues['Commission']['max_value']; ?>" class="span3"  />
		
			<label>Commission Details</label>
			<input type="text" name="commissionDetails" value="<?php echo $getcommivalues['Commission']['commission_details']; ?>" class="span3"  /><label></label>
			
			<label>Commission Amount in <span class="currency_symbol"></span><span style="color:red;"> *</span></label>
			<input type="text" name="commission_amount" id="commission" maxlength="3" value="<?php echo $getcommivalues['Commission']['amount']; ?>" class="span3"  />			<label></label>
		

	
		<input class="btn btn-primary reg_btn" type="submit" value="Save"/>
	  
</form>
   			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Edit Commission------->	
      
      
      
      
   		
   			
   			
   	 </div>
      
  </div>

</div>

