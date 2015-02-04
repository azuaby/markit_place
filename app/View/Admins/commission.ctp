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
						<h2>Add Commission</h2>
						
					</div>
					<div class="box-content">


			
				<?php
   			echo $this->Form->create('commision', array( 'onsubmit' => 'return commisionRange();'));
			?>
			<div class="control-group">
			<label>Apply to</label>
			<label><select name="applyto" class="span3">
				<!--option value="1">User</option-->
				<option value="Seller">Seller</option>
				</select></label>
			</div>
			
			<label for="reduction_amount">Commission Type</label>
			<?php //echo $getcommivalues['Commission']['type']; ?>
				<div class="control-group">
				<label> <select name="commission_type" class="span3" id="commission_type">
				
				<option value='%'>%</option>
					<option value="<?php echo $_SESSION['currency_symbol']; ?>"><?php echo $_SESSION['currency_symbol']; ?></option>
					</select>
				</label>
				</div>
			
			<label>Min Range in <span class="">  </span></label>
			<input type="text" name="start_range" value="" id="minrange" class="span3"   />
			<label>Max Range in <span class=""> </span></label>
			<input type="text" name="end_range" value="" id="maxrange" class="span3"  />
			<label>Commission Amount in <span class="currency_symbol"></span></label>
			<input type="text" maxlength='3' name="commission_amount" value="" class="span3"  id="commission" />	
		
			<label>Commission Details</label>
			
			<textarea rows="5" cols="20" name="commissionDetails" value="" class="spa"></textarea><label></label>
			
	<!--span style="color:red;"> *</span-->
		<input class="btn btn-primary reg_btn" type="submit" value="Save"/>
	  
</form>
   			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Commission------->	
      
   			
   			
   			
   	 </div>
      
  </div>

</div>

