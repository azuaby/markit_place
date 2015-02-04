<script>
	$(document).ready(function(){
		//alert($.browser.msie);
		if ($.browser.msie) {
			$('.placeholder').each(function(){
			//$('input[placeholder]').each(function(){
			   
				var input = $(this);       
			   
				$(input).val(input.attr('placeholder'));
					   
				$(input).focus(function(){
					 if (input.val() == input.attr('placeholder')) {
						 input.val('');
					 }
				});
			   
				$(input).blur(function(){
					if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.val(input.attr('placeholder'));
					}
				});
			});
		}
    });
</script>
   <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
		.show_hid{
			display:none;
		}
		.invisible {
		    visibility: hidden;
		}
		.inactive
		{
		display:none;
		}        
    </style>
  <body class=""> 
  <!--<![endif]-->
    
  
    
    
<div class="content">
    
     			<div class="box span12">
				<div class="box-header">
					<h2>Edit Item</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li><a href="<?php echo SITE_URL.'admin/manage/items/'; ?>">Manage Item</a> <span class="divider">/</span></li>
						<li class="active">Edit Item</li>
			        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Edit Item</h2>
					</div>
					
						
				
					<div class="box-content">   

<div class="btn-toolbar">
    <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
    <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
  <div class="btn-group">
  </div>
</div>
   			<?php
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = $_SESSION['media_server_username'];
@$password = $_SESSION['media_server_password'];
@$hostname = $_SESSION['media_host_name'];
	//$whomade = array('Idid' => 'I did','memberofmyshop' => 'A member of my shop','cmpnyorperson' => 'Another company or person');
	
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Item',array('url'=>array('controller'=>'admins','action'=>'editItem/'.$itemId),'id'=>'itemform','onsubmit'=>'return validate()'));
			
			echo "<div id='forms'>";
			
		?>
			<div class="sect">
                <div class="section-inner aboutitm clear">                                
			
					<div id="categories" class="input-group clear">
						<div id="categories-container" class="clear">
							<label>Category</label>
			<?php
							$catarr = array();
							foreach($cat_datas as $cats){
								$catarr[$cats['Category']['id']] = $cats['Category']['category_name'];
							}
							echo "<div id='categ-container-1' class='select-group' style='float:left;'>";
							echo $this->Form->input('category_id',array('type'=>'select','options'=>$catarr,'label'=>'What is it?','id'=>'cate_id','class'=>'inputform','empty'=>'Select a Category','default'=>$item['Item']['category_id']));			
							echo "</div>";
			
			if (!empty($superSub_datas)){ ?>
			<div id='categ-container-2' class='select-group ' style='float:left;margin-left:20px;'>
			<?php
								foreach ($superSub_datas as $superSub){
									$superSubarr[$superSub['Category']['id']] = $superSub['Category']['category_name'];
								}
								echo $this->Form->input('supersubcat',array('type'=>'select','options'=>$superSubarr,'label'=>'What type? <span class="optional">optional</span>','id'=>'categ-selectbx-2','class'=>'inputform','empty'=>'Select a Category','default'=>$item['Item']['super_catid']));			
			echo "</div>";					
			}else {	?>
							<div id='categ-container-2' class='select-group inactive ' style='float:left;margin-left:20px;'>
								<label class="invisible">What type? <span class="optional">optional</span> </label>
								<select name="data['Item']['supersubcat']" id="categ-selectbx-2">
								</select>
							</div>
			<?php } 
			if (!empty($Sub_datas)){ ?>
			<div id='categ-container-3' class='select-group ' style='float:left;margin-left:20px;'>
			<?php
								foreach ($Sub_datas as $Sub_data){
									$Subarr[$Sub_data['Category']['id']] = $Sub_data['Category']['category_name'];
								}
								echo $this->Form->input('subcat',array('type'=>'select','options'=>$Subarr,'label'=>'What type? <span class="optional">optional</span>','id'=>'categ-selectbx-3','class'=>'inputform','empty'=>'Select a Category','default'=>$item['Item']['sub_catid']));			
			echo "</div>";					
			}else {	?>
							<div id='categ-container-3' class='select-group inactive ' style='float:left;margin-left:20px;'>
								<label class="invisible">What type? <span class="optional">optional</span> </label>
								<select name="data['Item']['subcat']" id="categ-selectbx-3">
								</select>
							</div>
			<?php } ?>			
						</div>
					</div>
			<?php
				echo '<br clear="all" /><div class="cat-error adminitemerror" style="color:red"></div>';
					$image_computer = '';
					echo "<div class='input_wrap_popup' style='with:98% !important;float:left;'>";
						echo "<label>Upload Photos:</label>";
						for($i=0;$i<5;$i++){
							if(isset($item['Photo'][$i])){
								$image = $media."media/items/thumb150/".$item['Photo'][$i]['image_name'];
								$show = "display:block;";
								$imgName = $item['Photo'][$i]['image_name'];
								
								echo "<div class='img_upld' style='width:20% !important;float:left;'>";
								echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$image."'>";
								echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;display:none;"></iframe>';												
								echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$imgName,'name'=>'data[image][]'));
								echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='".$show."margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
								echo "</div>";
								echo "</div>";
							}else{
								$image = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
								$show = "display:none;";
								$imgName = "";
								
								echo "<div class='img_upld' style='width:20% !important;float:left;'>";
								echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$image."'>";
								echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';												
								echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$imgName,'name'=>'data[image][]'));
								echo "</br><a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='".$show."margin-top: -15px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
								echo "</div>";
								echo "</div>";
							}
							
						}
					echo "</div>";
					
				echo "<br clear='all' /><div class='photo-error adminitemerror' style='color:red'></div><br clear='all' />";
				
				echo "<div class='input-group'>";
				echo "<span class='bills additem-label'>Video Url </span>";
					
				echo "<input type='text' id='video' name ='data[Item][item_video]' class='input-xlarge itemvideo' maxlength='180' value='".$item['Item']['videourrl']."' placeholder='YouTube Url or YouTube video id' style='color:#555555! important;'>";
				echo '<div class="video-error adminitemerror" style="color:red"></div></div>';
				
				echo "<br clear='all' />";
				
				echo "<div class='input-group'>";
					echo "<span class='bills additem-label'>Item Title</span>";
					
					echo "<input type='text' id='title' name ='data[Item][item_title]' class='input-xlarge itemtitle' maxlength='180' value='".$item['Item']['item_title']."'>";
				echo '<div class="title-error adminitemerror" style="color:red"></div></div>';
				
				
				echo "<br clear='all' />";
					echo "<span class='bills additem-label'>Item Color </span>";
					echo '<select id="detectmethod" onchange="detect_method()" name="data[colormethod]">';
					if($item['Item']['item_color_method']=='0')
					{
						echo '<option value="auto" selected>Auto Detection</option>
						<option value="manual">Choose Manually</option>';
					}
					else if($item['Item']['item_color_method']=='1')
					{
						echo '<option value="auto">Auto Detection</option>
						<option value="manual" selected>Choose Manually</option>';
					}
					echo '</select>';	
				echo "<br clear='all' />";
				if($item['Item']['item_color_method']=='1')
				{	
					echo '<div id="manual_select">';
					echo "<span class='bills additem-label'>Select Color </span>";			
					echo '<select id="item_color_manual" name="itemcolor[]" multiple="multiple" style="height: 90px;margin-bottom: 10px;" >';
						foreach($color_datas as $colors){
							$item_colors = $item['Item']['item_color'];
							$itemcolors = json_decode($item_colors,true);
							if(in_array($colors['Color']['color_name'],$itemcolors))
							echo "<option value='".$colors['Color']['color_name']."' selected>".$colors['Color']['color_name']."</option>";
							else
							echo "<option value='".$colors['Color']['color_name']."'>".$colors['Color']['color_name']."</option>";
						}
					echo '</select>';		
					echo '</div>';
					echo '<div class="color-error adminitemerror" style="color:red"></div>';
								echo "<br clear='all' />";				
				}
					echo '<div id="manual_select" style="display:none;">';
					echo "<span class='bills additem-label'>Select Color </span>";			
					echo '<select id="item_color_manual" name="itemcolor[]" multiple="multiple" style="height: 90px;margin-bottom: 10px;" >';
					$i = 0;
						foreach($color_datas as $colors){
							$item_colors = $item['Item']['item_color'];
							$itemcolors = json_decode($item_colors,true);
							if($itemcolors[$i]==$colors['Color']['color_name'])
							echo "<option value='".$colors['Color']['color_name']."' selected>".$colors['Color']['color_name']."</option>";
							else
							echo "<option value='".$colors['Color']['color_name']."'>".$colors['Color']['color_name']."</option>";
							$i++;
						}
					echo '</select>';		
					echo '</div>';
					echo '<div class="color-error adminitemerror" style="color:red"></div>';
								echo "<br clear='all' />";					
				echo "<div class='input-group'>";
					echo "<label>Item Description</label>";
					echo $this->Form->input('item_description',array('type'=>'textarea','label'=>false,'id'=>'description','class'=>'input-xlarge','value'=>$item['Item']['item_description']));
		
					
				echo '<div class="description-error adminitemerror" style="color:red"></div></div>';
				
				
			?>
			<div class="input-group clear" id="occasion">
					<label>Gender <span class="sub-title">Which gender the item for ?</span></label>
					<?php 
					if($item['Item']['occasion'] == 0) {
					?>
						<select name="property[occasion]">
							<option value="0" selected>Male</option>
							<option value="1">Female</option>
						</select>
					<?php 
					}else {
					?>
						<select name="property[occasion]">
							<option value="0" >Male</option>
							<option value="1" selected>Female</option>
						</select>
					<?php } ?>
                    <!--<a class="overlay-trigger" href="" rel="#occasion-help">Why only one occasion?</a>-->
				</div></div><br/>
			<div data-variation="property[recipient]" class="input-group clear" id="recipient">
						<label>Relationship <span class="sub-title">To whom is it for?<span class="optional">choose multiple by pressing ctrl</span></span>
						</label>
						<select name="recipient[]" multiple="multiple" >
							<?php
							$receipent = json_decode($item['Item']['recipient'],true);
							$select = "";
							foreach($rcpnt_datas as $rcpnt){
								if(in_array($rcpnt['Recipient']['id'],$receipent)){
									$select = "selected";
								}
								echo "<option value='".$rcpnt['Recipient']['id']."' ".$select.">".$rcpnt['Recipient']['recipient_name']."</option>";
								$select = "";
							}
							?>
						</select>
						<!--<a class="overlay-trigger" href="" rel="#recipient-help">What if my item is for everyone?</a>-->
					</div>
			<br/>
			<div class=""  style = "float: none;border-bottom: 0 none;">
                <div class="section-inner clear">
					<div class="input-group clear input-group-error" id="item-price">
						<label>
							Price
						</label>
						<span class="price-input">
							<span>$</span>
							<input type="text" value="<?php echo $item['Item']['price'] ?>" class="input-xlarge money text text-small" id="price" name="listing[price]"  maxlength = "5">
							<span>USD</span>
						</span><p class="inline-message inline-error"></p>
						

						<input type="hidden" value="on" name="non_taxable">
						<div class="price-error adminitemerror" style="color:red"></div>
					</div>								
					<br clear='all' />
					<div class="input-group clear" id="item-quantity">
						<label>Quantity</label>
						<input type="text" value="<?php echo $item['Item']['quantity'] ?>" maxlength="3" class="input-xlarge text text-small" id="quantity" name="listing[quantity]">
						<div class="qty-error adminitemerror" style="color:red"></div>
					</div>   
				</div>
			</div>
		<br/>
		
	<!-- Size Options -->
	<?php

	echo "<div class='input-group'>";
		echo "<label>Options for sizes Shoes or T-shirts(optional)</label>";
		echo $this->Form->input('item_size_options',array('type'=>'textarea','label'=>false,'id'=>'size_options','class'=>'inputform','value'=>$item['Item']['size_options']));
		echo "<span class='sub-title'>Must enter the details separate comma's(,)<span>";
	echo "</div>";
	?>
		
			<div class="input-group clear" id="shipping">
    <h4>Shipping</h4>
    <div class="shipping-settings">
	  <!-- SHIPPING PROFILES-->
	  
	  <?php 
	  $process = $item['Item']['processing_time'];
	  ?>
	  <!-- PROCESSING TIME -->
		<div class="clear" id="processing-options">
				<label>Processing time</label>
				<select id="processing-time-id" name="processing_time_id">
					<option value="">Ready to ship in...</option>
					<optgroup label="----------------------------"></optgroup>
					<?php
					if ($process == '1d'){
						echo '<option selected value="1d">1 business day</option>';
					}else{
						echo '<option value="1d">1 business day</option>';
					}
					if ($process == '2d'){
						echo '<option selected value="2d">1-2 business days</option>';
					}else{
						echo '<option value="2d">1-2 business days</option>';
					}
					
					if ($process == '3d'){
						echo '<option selected value="3d">1-3 business days</option>';
					}else{
						echo '<option value="3d">1-3 business days</option>';
					}
					
					if ($process == '4d'){
						echo '<option selected value="4d">3-5 business days</option>';
					}else{
						echo '<option value="4d">3-5 business days</option>';
					}
					
					if ($process == '2ww'){
						echo '<option selected value="2ww">1-2 weeks</option>';
					}else{
						echo '<option value="2ww">1-2 weeks</option>';
					}
					
					if ($process == '3w'){
						echo '<option selected value="3w">2-3 weeks</option>';
					}else{
						echo '<option value="3w">2-3 weeks</option>';
					}
					
					if ($process == '4w'){
						echo '<option selected value="4w">3-4 weeks</option>';
					}else{
						echo '<option value="4w">3-4 weeks</option>';
					}
					
					if ($process == '6w'){
						echo '<option selected selected value="6w">4-6 weeks</option>';
					}else{
						echo '<option value="6w">4-6 weeks</option>';
					}
					
					if ($process == '8w'){
						echo '<option selected value="8w">6-8 weeks</option>';
					}else{
						echo '<option value="8w">6-8 weeks</option>';
					}
					
					if ($process == 'custom'){
						//echo '<option selected value="custom">Custom range</option>';
					}else{
						//echo '<option value="custom">Custom range</option>';
					} ?>
				</select>
			<div class="proc-error adminitemerror" style="color:red"></div>
			<div class="custom-range" id="processing-time-days" style="display:none;">
				<select name="processing_min">
					<option>From...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				<span class="range-divider">&mdash;</span>
				<select name="processing_max">
					<option>To...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>

				<input type="radio" value="D" name="processing_time_units" id="business-days" checked="checked">
				<span for="business-days">business days</span>
				<input type="radio" value="W" name="processing_time_units" id="weeks">
				<span for="weeks">weeks</span>
			</div>

		</div>
	
	<!-- SHIPS FROM -->
	<input type="hidden" value="'.$cntryid[$cntry_code].'" id="origin_country_id">
	<div class=" shipping-origin-select shipping-origin-select-noprofiles">
		<label>Ships from</label>
		<select name="ship_from_country" id="selct_lctn_bxs">
			<option value="">Select a location...</option>
			<?php
				foreach($cntry as $cnty){
					if($item['Item']['ship_from_country'] == $cnty['Country']['id']){
					echo "<option value='".$cnty['Country']['id']."' selected>".$cnty['Country']['country']."</option>";
					}else{
					echo "<option value='".$cnty['Country']['id']."' >".$cnty['Country']['country']."</option>";
					}
				}
			?>

		</select>
					<span class="shippingcountryerror" style="color:red"></span>
		
	</div>
	<div class="shipfrom-error adminitemerror" style="color:red"></div>
	
	
	
  <!-- SHIPPING RATES -->
  <div style="" class="set-shipping-rates">
        <table class="tablesorter table table-striped table-bordered table-condensed" id="shpng_div">
		   <thead>
              <tr>
                  <th class="ship-to">Ships to</th>
                  <th>Cost</th>
                  <th colspan="2">Remove</th>
              </tr>
           </thead>
           <tbody> 
           <?php
           $everyWhere = 0;
           foreach ($item['Shiping'] as $shiping) {
           	if ($shiping['country_id'] == 0){ ?>
				<tr class="new-shipping-location E">       
					<td id="E">         
						<div class="input-group-location">     
							<span>Everywhere else</span>     
							     
							<input type="hidden" value="true" name="everywhere_shipping[enabled]">
						</div>         
						<div class="regions-box"></div>       
					</td>      
					<td>           
						<div class="input-group input-group-price price-input primary-shipping-price">               
							$               
							<input type="text" value="<?php echo $shiping['primary_cost'];?>" id="shippingPrice" class="money text text-small input-small" name="everywhere_shipping[1][primary]">            
						</div>       
					</td>      
    
					<td class="input-group-close">       
						<div class="shippingClose input-group input-group-price price-input primary-shipping-price shippingClose">
							<a class="remove" href="javascript:void(0)" id="E"><i class="icon-trash"></i></a>
						</div> 
					</td>  
				</tr>   
			<?php $everyWhere = 1; }else { ?>
				<tr class="new-shipping-location <?php echo $shiping['country_id']; ?>">       
					<td id="<?php echo $shiping['country_id']; ?>">        
						<div class="input-group-location"><?php echo $countryName[$shiping['country_id']]; ?></div>         
						<div class="regions-box"></div>       
					</td>       
					<td>          
						<div class="input-group input-group-price price-input primary-shipping-price"> 
							$               
							<input type="text" value="<?php echo $shiping['primary_cost'];?>" id="shippingPrice" class="money text text-small input-small" name="country_shipping[<?php echo $shiping['country_id']; ?>][0][primary]">            
						</div>       
					</td>     
					      
					<td class="input-group-close">       
						<div class="shippingClose input-group input-group-price price-input primary-shipping-price">
							<a class="remove" href="javascript:void(0)" id="<?php echo $shiping['country_id']; ?>"><i class="icon-trash"></i></a>
						</div> 
					</td>  
				</tr>
			<?php } } 
			if ($everyWhere != 1) { ?>
				<tr class="new-shipping-location E">       
					<td id="E">         
						<div class="input-group-location">     
							<span>Everywhere else</span>     
							     
							<input type="hidden" value="true" name="everywhere_shipping[enabled]">
						</div>         
						<div class="regions-box"></div>       
					</td>      
					<td>           
						<div class="input-group input-group-price price-input primary-shipping-price">               
							$               
							<input type="text" value="" id="shippingPrice" class="money text text-small input-small" name="everywhere_shipping[1][primary]">            
						</div>       
					</td>      
    
					<td class="input-group-close">       
						<div class="input-group input-group-price price-input primary-shipping-price shippingClose">
							<a class="remove" href="javascript:void(0)" id="E"><i class="icon-trash"></i></a>
						</div> 
					</td>  
				</tr>
			<?php }
			?>
			</tbody>
		 </table>
			<!--<span class="button-medium button-medium-grey" id="add_shipping_location"><span><input type="button" value="Add location"></span></span>-->
		</div>
	</div></div>
	<input type="hidden" id="incrmt_val" value="3" />
	<input type="hidden" id="addlocntn" value="2" />
			<?php
				echo "<div id='alert' style='color:red;margin-top:15px;'></div>";
			echo "</div>";
			echo $this->Form->submit('Submit',array('class'=>'btn btn-primary reg_btn'));
			echo "<div class='form-error' style='color:red;'></div>";
		echo $this->Form->end();
	echo "</div>";
?>
</div></div>

   			
   			
   	 </div>
      
  </div>

</div>
