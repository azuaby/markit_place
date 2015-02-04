<body>
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
		echo $this->Form->Create('Item',array('url'=>array('controller'=>'/','action'=>'/saveitems/'.$findfromitem['Item']['id']),'id'=>'itemform'));
			
			echo "<div id='forms'>";
			//echo "<pre>";print_R($findfromitem);die;
			
		?>
			<div class="sect">
	<?php //echo "<div class='form-head'><p>List an Item</p></div>"; ?>
                <div class="section-inner aboutitm clear">                                
			
					<div id="categories" class="input-group clear">
						<div id="categories-container" class="clear">
							<span class="additem-label">Category</span>
			<?php
							$catarr = array();
                      
							foreach($cat_datas as $cats){
								$catarr[$cats['Category']['id']] = $cats['Category']['category_name'];
							}
							echo "<div id='categ-container-1' class='select-group'>";
							echo $this->Form->input('category_id',array('type'=>'select','options'=>$catarr,'label'=>'What is it?','id'=>'cate_id','class'=>'inputform','empty'=>'Select a Category'));			
							echo "</div>";
			?>
							<div id='categ-container-2' class='select-group inactive '>
								<h4 class="invisible">What type? <span class="optional">optional</span> </h4>
								<select name="data['Item']['supersubcat']" id="categ-selectbx-2">
								</select>
							</div>
							<div id='categ-container-3' class='select-group inactive '>
								<h4 class="invisible">What type? <span class="optional">optional</span> </h4>
								<select name="data['Item']['subcat']" id="categ-selectbx-3">
								</select>
							</div>
				
						</div>
					</div>
			<?php	
			if(!isset($findfromitem)){
				echo "<br clear='all' /><br clear='all' />";
					$image_computer = '';
					echo "<div class='input_wrap_popup'>";
						echo "<span class='bills additem-label'>";
						 echo __('Upload Photos:'); 
						 echo "</span>";
						for($i=0;$i<5;$i++){
							echo "<div class='img_upld'>";
								echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'>";
								echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';												
									echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
									echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
								echo "</div>";
							echo "</div>";
						}
					echo "</div>";
				
				
			}else{
					echo "<br clear='all' /><br clear='all' />";
					$image_computer = '';
					echo "<div class='input_wrap_popup'>";
						echo "<span class='bills additem-label'>Uploaded Photos:</span>";
							echo "<div class='img_upld'>";
								echo "<img id='show_ur'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$media.'media/items/thumb350/'.$findfromitem['Photo'][0]['image_name']."'>";
								echo '<div class="venueimg"><iframe class="image_iframe" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';												
									//echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
									//echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
								echo "</div>";
							echo "</div>";
					echo "</div>";
				
			}
				echo "<br clear='all' /><br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<span class='bills additem-label'>";
					echo __('Item Title');
					echo "</span>";
					
					echo "<input type='text' id='title' name ='data[Item][item_title]' class='inputform' maxlength='180' value='".$findfromitem['Item']['item_title']."'>";
				echo "</div>";
				
				
				//echo $this->Form->input('item_title',array('type'=>'text','id'=>'title','class'=>'inputform','maxlength'=>'180'));
				
				echo "<br clear='all' />";
				
				
				echo "<div class='input-group'>";
					echo "<span class='bills additem-label'>";
					echo __('Item Description');
					echo "</span>";
					
					echo $this->Form->input('item_description',array('type'=>'textarea','label'=>false,'id'=>'description','class'=>'inputform','value'=>$findfromitem['Item']['item_description']));
		
					//echo "<input type='textarea' name ='item_description' class='inputform' >";
				echo "</div>";
				
				
				//echo $this->Form->input('item_description',array('type'=>'textarea','label'=>'Description','id'=>'description','class'=>'inputform'));
		
				
			?>
			
			<div class="input-group clear" id="occasion">
					<span class='additem-label'>Gender</span>
					<div class="select-group">
						<h4><?php echo __('Which gender the item for ?'); ?></h4>
						<select name="property[occasion]">
							<option value="0">Male</option>
							<option value="1">Female</option>
						</select>
                    <!--<a class="overlay-trigger" href="" rel="#occasion-help">Why only one occasion?</a>-->
				</div></div><br/>
			<div data-variation="property[recipient]" class="input-group clear" id="recipient">
						<span class='additem-label'><?php echo __('Relationship'); ?></span>
					<div class="select-group">
						<h4><?php echo __('To whom is it for?'); ?><span class="optional"><?php echo __('choose multiple by pressing ctrl'); ?></span></h4>
						<select name="recipient[]" multiple="multiple" >
							<?php
							foreach($rcpnt_datas as $rcpnt){
								echo "<option value='".$rcpnt['Recipient']['id']."'>".$rcpnt['Recipient']['recipient_name']."</option>";
							}
							?>
						</select>
						<!--<a class="overlay-trigger" href="" rel="#recipient-help">What if my item is for everyone?</a>-->
					</div>
				</div>
			<br/>
			<div class="current"  style = "float: none;border-bottom: 0 none;">
                <div class="section-inner clear">
					<div class="input-group clear input-group-error" id="item-price">
						<span class='additem-label'>
							<?php  echo __('Price'); ?>
						</span>
						<span class="price-input">
							<span>$</span>
							<input type="text" value="" class="input_price money text text-small" id="price" name="listing[price]"  maxlength = "5">
							<span>USD       <a  onclick="commisiondetails()">commision details</a></span>
						</span><p class="inline-message inline-error"></p>
						

						<input type="hidden" value="on" name="non_taxable">
					</div>								
					<br clear='all' />
					<div class="input-group clear" id="item-quantity">
						<span class='additem-label'><?php echo __('Quantity'); ?></span>
						<span class="quantity-currency-spacer">$</span><!-- Don't remove this! It aligns the price and quantity fields-->
						<input type="text" value="1" maxlength="3" class="input_quantity text text-small" id="quantity" name="listing[quantity]">
					</div>   
				</div>
			</div>
		<br/>
		<!-- p style="font-size: 20px;decoration:none;"> Hotel <a  onclick="hotel_details()"><small>click here</small></a></p>
		<div style='display:none;' >
              
                <div class="section-inner clear">
					<div class="input-group clear input-group-error" >
						<span class='additem-label'>
							<?php echo __('start date'); ?>
						</span>
						<span class="price-input">
				
							<input type="text"  class="inputform" value="" id="datepicker" name="start_date"  onmouseover="date()">
				
						</span><p class="inline-message inline-error"></p>
			
						<input type="hidden" value="on" name="non_taxable">
					</div>								
					<br clear='all' />
					<div class="input-group clear" >
						<span class='additem-label'><?php echo __('End date'); ?></span>
						<span class="quantity-currency-spacer">$</span>
						<input type="text" value="" class="inputform" id="datepicked" name="end_date"  maxlength = "5" onmouseover="enddate()">
					</div>   
					<br clear='all' />
					<div class="input-group clear" >
						<span class='additem-label'><?php echo __('Tax'); ?></span>
						<span class="quantity-currency-spacer">$</span>
						<input type="text" value="" class="inputform" id="tax" name="tax" >
					</div>   
					
					
				</div>
			</div-->
		<br/>
			<div class="input-group clear" id="shipping">
    <span class='additem-label'><?php echo __('Shipping'); ?></span>
    <div class="shipping-settings">
	  <!-- SHIPPING PROFILES-->
	  
	  <!-- PROCESSING TIME -->
		<div class="clear" id="processing-options">
			<div class="select-group">
				<h4>Processing time</h4>
				<select id="processing-time-id" name="processing_time_id">
					<option value="">Ready to ship in...</option>
					<optgroup label="----------------------------"></optgroup>
					<option value="1d">1 business day</option>
					<option value="2d">1-2 business days</option>
					<option value="3d">1-3 business days</option>
					<option value="4d">3-5 business days</option>
					<option value="2ww">1-2 weeks</option>
					<option value="3w">2-3 weeks</option>
					<option value="4w">3-4 weeks</option>
					<option value="6w">4-6 weeks</option>
					<option value="8w">6-8 weeks</option>
					<option value="custom">Custom range</option>
				</select>
			</div>

			<div class="custom-range" id="processing-time-days">
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
				<label for="business-days">business days</label>
				<input type="radio" value="W" name="processing_time_units" id="weeks">
				<label for="weeks">weeks</label>
			</div>

		</div>
		
		
		
	<!-- Size Options -->
	<?php
	echo "<br clear='all' /><br clear='all' />";
	echo "<div class='input-group'>";
		echo "<span class='bills additem-label'>";
		echo __('Options for sizes');
		echo __('Shoes or T-shirts(optional)');
		echo "</span>";
		echo $this->Form->input('item_size_options',array('type'=>'textarea','label'=>false,'id'=>'size_options','class'=>'inputform'));
		echo "Must enter the details separate comma's(,) Example:M=4,L=6,XL=10";
	echo "</div>";
	?>
	
		
	
	<!-- SHIPS FROM -->
	<input type="hidden" value="'.$cntryid[$cntry_code].'" id="origin_country_id">
	<div class="select-group shipping-origin-select shipping-origin-select-noprofiles">
		<span class='additem-label'><?php echo __('Ships from'); ?></span>
		<select name="ship_from_country" id="selct_lctn_bxs">
			<option value="">Select a location...</option>
			<?php
				foreach($country_datas as $cnty){
					if($cntryid[$cntry_code] == $cnty['Country']['id']){
					echo "<option value='".$cnty['Country']['id']."' selected>".$cnty['Country']['country']."</option>";
					}else{
					echo "<option value='".$cnty['Country']['id']."' >".$cnty['Country']['country']."</option>";
					}
				}
			?>

		</select>
	</div>
	
	
	
	<!-- SHIPPING DESTINATION SELECT -->
	  <div id="new-shipping-select" class="input-group clear">
		  <select class="new-shipping-select">
			 <option value="">Select a location...</option>
			 <optgroup class="everywhere" label="----------------">
				 <option value="E">Everywhere else</option>
			 </optgroup>
			
		  </select>
	  </div>
  <!-- SHIPPING RATES -->
  <div style="" class="set-shipping-rates">
        <table class="shipping-rates msm" id="shpng_div">
		   <thead>
              <tr>
             <th class="ship-to" style="font-size:15px;"><center><?php echo __('Ships to'); ?></center></th>
                  <th style="font-size:15px;"><center>Cost</center></th>
                  <th colspan="2" style="font-size:15px;"><center>Remove</center></th>
              </tr>
           </thead>
           <tbody> 
				<tr class="new-shipping-location <?php echo $cntryid[$cntry_code]; ?>">       
					<td id="<?php echo $cntryid[$cntry_code]; ?>">        
						<div class="input-group-location"><?php echo $cntrynme[$cntry_code]; ?></div>         
						<div class="regions-box"></div>       
					</td>       
					<td>          
						<div class="input-group input-group-price price-input primary-shipping-price"> 
							<label>$</label>               
							<input type="text" value="" class="money text text-small" name="country_shipping[<?php echo $cntryid[$cntry_code]; ?>][0][primary]">            
						</div>       
					</td>     
					      
					<td>       
						<div class="input-group input-group-price price-input primary-shipping-price">
							<a style="font-size: 0.000001px;" href="javascript:void(0)" id="<?php echo $cntryid[$cntry_code]; ?>"><span>remove</span></a>
						</div> 
					</td>  
				</tr> 
				<tr class="new-shipping-location E">       
					<td id="E">         
						<div class="input-group-location">     
							<span>Everywhere else</span>     
							<a href="#" class="tt-trigger">?</a>     
							<div class="tt">         
								<div class="tt-inner">            
									<p>Sets the shipping costs for EVERY country not covered by country specific shipping costs. This is optional. </p>    
										<span class="tt-arrow"></span>         
								</div>     
							</div>     
							<input type="hidden" value="true" name="everywhere_shipping[enabled]">
						</div>         
						<div class="regions-box"></div>       
					</td>      
					<td>           
						<div class="input-group input-group-price price-input primary-shipping-price">               
							<label>$</label>               
							<input type="text" value="" class="money text text-small" name="everywhere_shipping[1][primary]">            
						</div>       
					</td>      
    
					<td class="input-group-close">       
						<div class="input-group input-group-price price-input primary-shipping-price">
							<a class="remove" href="javascript:void(0)" id="E"><span>remove</span></a>
						</div> 
					</td>  
				</tr>   
			
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
			echo $this->Form->submit('Submit');
		echo $this->Form->end();
	echo "</div>";
?>

<!-- sathish for commision popup -->

<!-- popups -->
<div id="popupcommision" style="display: none;">
	<div id="commisionrate" style="display: none;" class="popupsss ly-title update commisionrate">
		<div class="defaults" id="commisiondet">
		 <p id="parastyle" style="top: 3px;">Commission Details <a href="#" id="cornerdbutton"> <img alt='Close' src="<?php echo SITE_URL; ?>images/closebt.png"></a></p>
			<div id="details">
			<table id="tabledesign" style="border:none;">
			<thead>
				<tr style="border:none;">
				<th style="border:none;">Price</th>
				<th style="border:none;">Commission</th>
				<th style="border:none;">Type</th>
				<th style="border:none;"> Description</th>
				</tr style="border:none;">
		 </thead>
		<tbody>
			<?php 
			foreach($commisionrate as $val){
				$min=$val['Commission']['min_value'];
				$max=$val['Commission']['max_value'];
				$type=$val['Commission']['type'];
				$amount=$val['Commission']['amount'];
				$des=$val['Commission']['commission_details'];
					echo "<tr><td style='border:none;'>".$min."-".$max."</td><td style='border:none;'>".$amount."</td><td style='border:none;'> ".$type."</td><td style='border:none;'> ".$des."</td>";
					echo "</tr>";
			}	
?>
			</tbody>
			</table>
			</div>
			</div>
			</div>
			</div>
			<!-- /popups -->
<!-- sathish for commision popup  ended-->			
<style>
	
.show_hid{
	display:none;
}

 }
</style>




<script>

	
setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
<style>
	
.show_hid{
	display:none;
}
</style>
<script>
var invajax=0;
</script>

