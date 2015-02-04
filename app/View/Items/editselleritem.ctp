<body>
<!-- <script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>  -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>tinymce/tinymce.min.js"></script>
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
		echo $this->Form->Create('Item',array('url'=>array('controller'=>'/','action'=>'/editselleritem/'.$item['Item']['id']),'id'=>'itemform'));
			
			echo "<div id='forms'>";
			//echo "<pre>";print_R($findfromitem);die;
			
		?>
			<div class="sect">
	<?php //echo "<div class='form-head'><p>List an Item</p></div>"; ?>
                <div class="section-inner clear">                                
					<section class="merchant" style="width:950px;margin: 0 auto;">
						<dl>
						<dt>Category</dt>
							<dd>
							<label for=""  class="label">Category</label>
							<?php
							$catarr = array();
                      
							foreach($cat_datas as $cats){
								$catarr[$cats['Category']['id']] = $cats['Category']['category_name'];
							}
							
							if($item['Item']['category_id']!=''){
								$categoryy = $catarr[$item['Item']['category_id']];
							}else{
								$categoryy = "Select Category";
							}
							
							echo "<div id='categ-container-1' class='select-group selectdiv' style='margin-right: 10px;'>";
							echo $this->Form->input('category_id',array('type'=>'select','options'=>$catarr,'label'=>'','id'=>'cate_id','class'=>'inputform selectboxdiv','empty'=>'Select a Category', 'div' => false , 'default'=>$item['Item']['category_id']));			
							echo '<div class="out" >'.$categoryy.'</div>';
							echo "</div>";
							?>
							
							<?php 	
							if (!empty($superSub_datas)){ ?>
							<div id='categ-container-2' class='select-group '>
							<?php
							$superSubarr  = array();
								foreach ($superSub_datas as $superSub){
									$superSubarr[$superSub['Category']['id']] = $superSub['Category']['category_name'];
								}
									
								if($item['Item']['super_catid']!=''){
									$subcategoryy = $superSubarr[$item['Item']['super_catid']];
								}else{
									$subcategoryy = "Select Category";
								}
								
								
								echo "<div id='categ-container-2' class='select-group selectdiv' style='margin-right: 10px;'>";
								echo $this->Form->input('supersubcat',array('type'=>'select','options'=>$superSubarr,'label'=>'','id'=>'categ-selectbx-2','class'=>'inputform selectboxdiv','empty'=>'Select a Category', 'div' => false ,'default'=>$item['Item']['super_catid']));			
								echo '<div class="out" >'.$subcategoryy.'</div>';
								echo "</div>";		
								
								echo "</div>";
							}else {	?>
								<div id='categ-container-2' class='select-group inactive selectdiv' style='margin-right: 10px;display:none;'>
									<select name="data['Item']['supersubcat']" id="categ-selectbx-2" class="selectboxdiv">
									</select>	
									<div class="out" >Select a Category</div>
								</div>
							<?php } ?>
							
							
									<?php 
									//echo "<pre>";print_r($Sub_datas);die;
									
									if (!empty($Sub_datas)){ ?>
									<div id='categ-container-3' class='select-group'>
									<?php
									$Subarr = array();
										foreach ($Sub_datas as $Sub_data){
											$Subarr[$Sub_data['Category']['id']] = $Sub_data['Category']['category_name'];
										}
										
										if($item['Item']['sub_catid']!=''){
											$subcategoryyy = $Subarr[$item['Item']['sub_catid']];
										}else{
											$subcategoryyy = "Select Category";
										}
										
										
										echo "<div id='categ-container-3' class='select-group selectdiv' style='margin-right: 10px;'>";
										echo $this->Form->input('subcat',array('type'=>'select','options'=>$Subarr,'label'=>'','id'=>'categ-selectbx-3','class'=>'inputform selectboxdiv','empty'=>'Select a Category', 'div' => false ,'default'=>$item['Item']['sub_catid']));			
										echo '<div class="out" >'.$subcategoryyy.'</div>';
										echo "</div>";
									echo "</div>";		
									}else {	?>	
									<div id='categ-container-3' class='select-group inactive selectdiv' style='margin-right: 10px;display:none;'>
									<select name="data['Item']['subcat']" id="categ-selectbx-3" class="selectboxdiv">
									</select>
									<div class="out" >Select a Category</div>
								</div>
								<?php } ?>
								
							</dd>
						</dl>
							
							
							
							
							
				<dl>
				<dt>Image Upload</dt>
					<dd>
					<label for=""  class="label"><?php echo __('Upload Photos:');  ?></label>
							
					<?php	
					
					$image_computer = '';
					for($i=0;$i<5;$i++){
						if(isset($item['Photo'][$i])){
							$image = $media."media/items/thumb150/".$item['Photo'][$i]['image_name'];
							$show = "display:block;";
							$imgName = $item['Photo'][$i]['image_name'];
							echo "<div class='input_wrap_popup'>";
							echo "<div class='img_upld' style='float:left;'>";
							echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$image."'>";
							echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$imgName,'name'=>'data[image][]'));
							echo "</br><a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='".$show."margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}else{
							$image = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
							$show = "display:none;";
							$imgName = "";
							echo "<div class='input_wrap_popup'>";
							echo "<div class='img_upld' style='float:left;'>";
							echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$image."'>";
							echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$imgName,'name'=>'data[image][]'));
							echo "</br><a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='".$show."margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
						
					}
					
						echo "<br clear='all' /><br clear='all' />";
				?>		
					</dd>
					
					
					<dt>Video</dt>
					<dd>
					<label for=""  class="label"><?php echo __('Video Url:');  ?></label>
					<input type="text" class="input_price money text-small" id="videourrll" name="listing[videourrl]" value='<?php echo $item['Item']['videourrl']; ?>' placeholder='YouTube Url or YouTube video id'>
					
					</dd>
					
					
					
				</dl>
		
			<dl>
				<dt>General informations</dt>
				<dd>
					<label for=""  class="label"><?php echo __('Item Title');  ?></label>				
					<?php echo "<input type='text' id='title' name ='data[Item][item_title]' class='inputform' maxlength='180' value='".$item['Item']['item_title']."'>";
					?>
				</dd>
<?php					echo "<dd><label for=''  class='label'>Item Color </label>";
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
					echo '</dd>';
				echo "<br clear='all' />";
				if($item['Item']['item_color_method']=='1')
				{	
					echo '<dd>';
					echo '<div id="manual_select">';
					echo "<label for=''  class='label'>Select Color </label>";			
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
					echo '</dd>';
					echo '<div class="color-error adminitemerror" style="color:red"></div>';
								echo "<br clear='all' />";				
				}
					echo '<dd>';
					echo '<div id="manual_select" style="display:none;">';
					echo "<label for=''  class='label'>Select Color </label>";			
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
					echo '</dd>';
					echo '<div class="color-error adminitemerror" style="color:red"></div>';
								echo "<br clear='all' />";					
		?>			
				<dd>
					<label for=""  class="label"><?php echo __('Item Description');  ?></label>					
					<?php 
						echo $this->Form->input('item_description',array('type'=>'textarea','label'=>false,'id'=>'description','class'=>'inputform','value'=>$item['Item']['item_description']));
					?>
				</dd>
					
				<dd>
					<label for=""  class="label"><?php echo __('Price');  ?></label>		
					
					<input type="text"  class="input_price money text-small" id="price" name="listing[price]" placeholder='<?php echo $_SESSION['default_currency_symbol']; ?>' maxlength = "6" value="<?php echo $item['Item']['price']; ?>" >
					<!-- <span><?php echo $_SESSION['default_currency_code']; ?> <a  onclick="commisiondetails()">commision details</a></span> -->
				</dd>
				
				<dd>
					<label for=""  class="label"><?php echo __('Quantity');  ?></label>		
					<input type="text"  maxlength="3" class="input_quantity text-small" id="quantity" name="listing[quantity]" value="<?php echo $item['Item']['quantity']; ?>" >
				</dd>
				
			</dl>
		
		
		
			<dl>
				<dt>More Informations</dt>
				<dd>
				<?php 
				if($item['Item']['occasion'] == 0) {
					$gendd = 'Male';
				}elseif($item['Item']['occasion'] == 1){
					$gendd = 'Female';					
				}else{
					$gendd = 'Select gender';									
				}
				
				?>
				
				
					<label for=""  class="label"><?php echo __('Which gender the item for ?');  ?></label>				
						<div class="selectdiv " style="float: left; width: 172px;">
						<select name="property[occasion]" class="selectboxdiv" style="margin-bottom: 10px;">
							<?php if($item['Item']['occasion'] == 0) { ?>
							<option value="0" selected>Male</option>
							<?php }else{ ?>
							<option value="0">Male</option>
							<?php } ?>
							
							<?php if($item['Item']['occasion'] == 1) { ?>
							<option value="1" selected>Female</option>
							<?php }else{ ?>
							<option value="1">Female</option>
							<?php } ?>
							
							
						</select>		
						<div class="out" ><?php echo $gendd; ?></div>
						</div>			
				</dd>
				
				<dd>	
					<label for=""  class="label"><?php echo __('Relationship'); ?></label>				
						<select name="recipient[]" multiple="multiple" style="height: 90px;margin-bottom: 10px;" >
							<?php
							$receipent = json_decode($item['Item']['recipient'],true);
							//$select = "";							
							
							foreach($rcpnt_datas as $rcpnt){
								if(in_array($rcpnt['Recipient']['id'],$receipent)){
									//$select = "selected";
									
									echo "<option value='".$rcpnt['Recipient']['id']."' selected >".$rcpnt['Recipient']['recipient_name']."</option>";
								}else{
									
									echo "<option value='".$rcpnt['Recipient']['id']."' >".$rcpnt['Recipient']['recipient_name']."</option>";
								}							
								
							}
							?>
						</select>
						<span style='font-size:11px;'><?php echo __('To whom is it for?'); ?><span class="optional"><?php echo __('choose multiple by pressing ctrl'); ?></span></span>
				
				</dd>
				
				
				  <?php 
				  $process = $item['Item']['processing_time'];
				  ?>
				<dd>
					<label for=""  class="label"><?php echo __('Shipping'); ?></label>
						<div class="selectdiv " style="float: left; width: 172px;">
						<select id="processing_time" name="processing_time_id" style="margin-bottom: 10px;" class="selectboxdiv">
							<option value="">Ready to ship in...</option>
							<optgroup label="----------------------------"></optgroup>
							<?php
							$readyfrship = 'Ready to ship in...';
							if ($process == '1d'){
							$readyfrship = '1 business day';
								echo '<option selected value="1d">1 business day</option>';
							}else{
								echo '<option value="1d">1 business day</option>';
							}
							if ($process == '2d'){
							$readyfrship = '1-2 business day';
								echo '<option selected value="2d">1-2 business days</option>';
							}else{
								echo '<option value="2d">1-2 business days</option>';
							}
							
							if ($process == '3d'){
							$readyfrship = '1-3 business day';
								echo '<option selected value="3d">1-3 business days</option>';
							}else{
								echo '<option value="3d">1-3 business days</option>';
							}
							
							if ($process == '4d'){
							$readyfrship = '3-5 business day';
								echo '<option selected value="4d">3-5 business days</option>';
							}else{
								echo '<option value="4d">3-5 business days</option>';
							}
							
							if ($process == '2ww'){
							$readyfrship = '1-2 weeks';
								echo '<option selected value="2ww">1-2 weeks</option>';
							}else{
								echo '<option value="2ww">1-2 weeks</option>';
							}
							
							if ($process == '3w'){
							$readyfrship = '2-3 weeks';
								echo '<option selected value="3w">2-3 weeks</option>';
							}else{
								echo '<option value="3w">2-3 weeks</option>';
							}
							
							if ($process == '4w'){
							$readyfrship = '3-4 weeks';
								echo '<option selected value="4w">3-4 weeks</option>';
							}else{
								echo '<option value="4w">3-4 weeks</option>';
							}
							
							if ($process == '6w'){
							$readyfrship = '4-6 weeks';
								echo '<option selected selected value="6w">4-6 weeks</option>';
							}else{
								echo '<option value="6w">4-6 weeks</option>';
							}
							
							if ($process == '8w'){
							$readyfrship = '6-8 weeks';
								echo '<option selected value="8w">6-8 weeks</option>';
							}else{
								echo '<option value="8w">6-8 weeks</option>';
							}
							?>
							<!-- <option value="custom">Custom range</option> -->
						</select>		
						
						<div class="out" ><?php echo $readyfrship; ?></div>
						</div>			
				</dd>
				
				
			</dl>	
			
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
		
		
		
		
	<!-- Size Options -->
		
			<dl>
				<dt>Product sizes</dt>
				<dd>
					<label for=""  class="label"><?php echo __('Options for sizes'); echo __('Shoes or T-shirts(optional)');  ?></label>	
					<?php	echo "<span style='font-size:11px;'>Must enter the details separate comma's(,) Example:M=4,L=6,XL=10 </span>";
									
						echo $this->Form->input('item_size_options',array('type'=>'textarea','label'=>false,'id'=>'size_options','class'=>'inputform','value'=>$item['Item']['size_options']));
						?>
				</dd>
			</dl>
		
			<dl>
				<dt>Shipping countries</dt>
				<dd>
					<label for=""  class="label"><?php echo __('Ships to'); ?></label>
					<div class="selectdiv " style="float: left; width: 172px;">
						<select name="ship_from_country" id="selct_lctn_bxs" class="selectboxdiv">
							<option value="">Select a location...</option>
							<?php
								foreach($cntry as $cnty){
									if($item['Item']['ship_from_country'] == $cnty['Country']['id']){
										if($cnty['Country']['country']!=''){
											$countryNName = $cnty['Country']['country'];
										}else{
											$countryNName = 'Select a location...';											
										}
									echo "<option value='".$cnty['Country']['id']."' selected>".$cnty['Country']['country']."</option>";
									}else{
									echo "<option value='".$cnty['Country']['id']."' >".$cnty['Country']['country']."</option>";
									}
								}
							?>
				
						</select>					
							
						<div class="out" ><?php echo $countryNName; ?></div>
						</div>
						
					<span class="shippingcountryerror"></span>
				</dd>
				<dd>
				
				<?php 
				if($item['Item']['delivery_type'] == 'regular') {
					$deldd = 'Regular';
				}elseif($item['Item']['delivery_type'] == 'special'){
					$deldd = 'Special';					
				}else{
					$deldd = 'Select Delivery type';									
				}
				?>
				
					<label for=""  class="label"><?php echo __('Delivery type'); ?></label>
					<div class="selectdiv" style="float: left; width: 172px;">
                        <select name="deltype" class="selectboxdiv" id="deltype">			
                            <option value="regular">Regular</option>		
                            <option value="special">Special</option>
                        </select>
						<div class="out" ><?php echo $deldd; ?></div>
					</div>
				</dd>
			</dl>
	
	
	<!-- SHIPPING DESTINATION SELECT -->
	  <div id="new-shipping-select" class="clear" style="display:none;">
		  <select class="new-shipping-select">
			 <option value="">Select a location...</option>
			 <optgroup class="everywhere" label="----------------">
				 <option value="E">Everywhere else</option>
			 </optgroup>
			
		  </select>
	  </div>
  <!-- SHIPPING RATES -->
  
  
  
			<dl>
				<dt><?php echo __('Ships Details'); ?></dt>
				<dd>
					<!-- <label for=""  class="label"><?php echo __('Ships to'); ?>:</label> -->
  
					  
										   <!-- SHIPPING RATES -->
					  <div style="" class="set-shipping-rates">
					        <table class="shipping-rates msm" id="shpng_div">
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
												<?php echo $_SESSION['default_currency_symbol']; ?>               
												<input type="text" value="<?php echo $shiping['primary_cost'];?>" class="money text text-small input-small" name="everywhere_shipping[1][primary]">            
											</div>       
										</td>      
					    
										<td class="input-group-close">       
											<div class="shippingClose input-group input-group-price price-input primary-shipping-price shippingClose">
												<a class="remove" href="javascript:void(0)" id="E">
													<span class="glyphicons bin"> </span>
												</a>
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
												<?php echo $_SESSION['default_currency_symbol']; ?>               
												<input type="text" value="<?php echo $shiping['primary_cost'];?>" class="money text text-small input-small" name="country_shipping[<?php echo $shiping['country_id']; ?>][0][primary]">            
											</div>       
										</td>     
										      
										<td class="input-group-close">       
											<div class="shippingClose input-group input-group-price price-input primary-shipping-price">
											<?php if ($shiping['country_id'] != 100){ ?>
												<a class="remove" href="javascript:void(0)" id="<?php echo $shiping['country_id']; ?>">
													<span class="glyphicons bin"> </span>
												</a>
											<?php }else{ ?>
												<a href="javascript:void(0)" id="<?php echo $shiping['country_id']; ?>">
													<span class="glyphicons "> </span>
												</a>
											<?php } ?>
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
												<?php echo $_SESSION['default_currency_symbol']; ?>               
												<input type="text" value="" class="money text text-small input-small" name="everywhere_shipping[1][primary]">            
											</div>       
										</td>      
					    
										<td class="input-group-close">       
											<div class="input-group input-group-price price-input primary-shipping-price shippingClose">
												<a class="remove" href="javascript:void(0)" id="E">
													<span class="glyphicons bin"> </span>
												</a>
											</div> 
										</td>  
									</tr>
								<?php }
								?>
								</tbody>
							 </table>
								<!--<span class="button-medium button-medium-grey" id="add_shipping_location"><span><input type="button" value="Add location"></span></span>-->
							</div>
				</dd>	</dl>
	
	
	
	
	
</section>
	
	</div>
	<input type='hidden' id="default_currency_symbol" value="<?php echo $_SESSION['default_currency_symbol']; ?>" />
	<input type="hidden" id="incrmt_val" value="3" />
	<input type="hidden" id="addlocntn" value="2" />
			<?php
				echo "<div id='alert' style='color:red;margin-top:15px;text-align: center;'></div>";
			echo "</div>";
			echo $this->Form->submit('Submit',array('class'=>'btn-save','style'=>'margin: 10px 60px;'));
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
				<tr style="border:none;color:#000;border-bottom: 1px solid #dcddcd;border-top: 1px solid #dcdcdc;">
				<th style="border:none;width: 110px;">Price</th>
				<th style="border:none;width: 100px;">Commission</th>
				<th style="border:none;width: 56px;text-align:center;">Type</th>
				<th style="border:none;text-align:center;"> Description</th>
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
					echo "<tr><td style='border:none;'>".$min."-".$max."</td><td style='border:none;text-align:center;'>".$amount."</td><td style='border:none;text-align:center;'> ".$type."</td><td style='border:none;'> ".$des."</td>";
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
.input.textarea {
    float: left;
    margin-bottom: 10px;
    width: 580px;
}
</style>

<script>setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);</script>
<script>
        tinymce.init({selector:'#description',
            plugins: [
                      "advlist autolink lists link image charmap print preview anchor",
                      "searchreplace visualblocks code fullscreen",
                      "insertdatetime table contextmenu paste"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
         });
</script>
<script>
var invajax=0;
</script>

