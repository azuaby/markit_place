<body>
<script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> 
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
		echo $this->Form->Create('Item',array('url'=>array('controller'=>'/','action'=>'/mobile/saveitems/'.$findfromitem['Item']['id']),'id'=>'itemform','data-ajax'=>'false'));
			
			echo "<div id='forms'>";
			//echo "<pre>";print_R($findfromitem);die;
			
		?>
			<div class="sect">
	<?php //echo "<div class='form-head'><p>List an Item</p></div>"; ?>
                <div class="section-inner clear">                                
					<section class="merchant" style="margin: 0 auto;">
						<div class="ui-body ui-body-a">
						<b>Category</b>
							<dd>
							<label for=""  class="label" style="font-size:13px;">Category</label>
							<?php
							$catarr = array();
                      
							foreach($cat_datas as $cats){
								$catarr[$cats['Category']['id']] = $cats['Category']['category_name'];
							}
							echo "<div id='categ-container-1' class='select-group selectdiv' style='margin-right: 10px;font-size:13px;'>";
							echo $this->Form->input('category_id',array('type'=>'select','options'=>$catarr,'label'=>'','id'=>'cate_id','class'=>'inputform selectboxdiv','empty'=>'Select a Category', 'div' => false));			
							echo '<div class="out" style="display:none;">Select a Category</div>';
							echo "</div>";
							?>
														
							<div id='categ-container-2' class='select-group inactive selectdiv' style='margin-right: 10px;display:none;'>
								<select name="data['Item']['supersubcat']" id="categ-selectbx-2" class="selectboxdiv">
								</select>	<div class="out" style="display:none;">Select a Category</div>
							</div>
							
							<div id='categ-container-3' class='select-group inactive selectdiv' style='margin-right: 10px;display:none;'>
								<select name="data['Item']['subcat']" id="categ-selectbx-3" class="selectboxdiv">
								</select>
								<div class="out" style="display:none;">Select a Category</div>
							</div>
							
							</dd>
						</div>
							
							
							
							
						<br />	
				<div class="ui-body ui-body-a">
				<b>Image Upload</b>
					<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Upload Photos:');  ?></label>
							
					<?php	
					if(!isset($findfromitem)){
							$image_computer = '';
							echo "<div class='input_wrap_popup'>";
								echo "<span class='bills additem-label'>";
								 //echo __('Upload Photos:'); 
								 echo "</span>";
								for($i=0;$i<5;$i++){
									echo "<div class='img_upld' style='float:left;'>";
										echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'>";
										echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 5px;position: relative;"></iframe>';												
											echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
											echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn btn_blue' style='display: none; margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
										echo "</div>";
									echo "</div>";
								}
							echo "</div>";
						
						
					}else{
							$image_computer = '';
							echo "<div class='input_wrap_popup'>";
								//echo "<span class='bills additem-label'>Uploaded Photos:</span>";
									echo "<div class='img_upld'  style='float:left;'>";
										echo "<img id='show_ur'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$media.'media/items/thumb350/'.$findfromitem['Photo'][0]['image_name']."'>";
										echo '<div class="venueimg"><iframe class="image_iframe" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';												
											//echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
											//echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
										echo "</div>";
									echo "</div>";
							echo "</div>";
						
					}
						echo "<br clear='all' /><br clear='all' />";
				?>		
					</dd>
					
					
					<b>Video</b>
					<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Video Url:');  ?></label>
					<input type="text" value="" class="input_price money text-small" id="videourrll" name="listing[videourrl]" placeholder='YouTube Url or YouTube video id'>
					
					</dd>
					
					
					
				</div>
		<br />
			<div class="ui-body ui-body-a">
				<b>General informations</b>
				<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Item Title');  ?></label>				
					<?php echo "<input type='text' id='title' name ='data[Item][item_title]' class='inputform' maxlength='180' value='".$findfromitem['Item']['item_title']."'>";
					?>
				</dd>
					
				<dd style="height:auto;overflow:hidden;">
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Item Description');  ?></label>					
					<?php 
						echo $this->Form->input('item_description',array('type'=>'textarea','label'=>false,'id'=>'description','class'=>'inputform','value'=>$findfromitem['Item']['item_description']));
					?>
				</dd>
					
				<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Price');  ?></label>		
					
					<input type="text" value="" class="input_price money text-small" id="price" name="listing[price]" placeholder='<?php echo $_SESSION['default_currency_symbol']; ?>' maxlength = "6">
					<span><?php echo $_SESSION['default_currency_code']; ?> <a  onclick="commisiondetails()">commision details</a></span>
				</dd>
				
				<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Quantity');  ?></label>		
					<input type="text" value="1" maxlength="3" class="input_quantity text-small" id="quantity" name="listing[quantity]">
				</dd>
				
			</div>
		
		<br />
		
			<div class="ui-body ui-body-a">
				<b>More Informations</b>
				<dd style="height:auto;overflow:hidden;">
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Which gender the item for ?');  ?></label>				
						<div class="selectdiv ">
						<select name="property[occasion]" class="selectboxdiv" style="margin-bottom: 10px;">
							<option value="0">Male</option>
							<option value="1">Female</option>
						</select>		
						<div class="out" style="display:none;">Select gender</div>
						</div>			
				</dd>
				
				<dd>	
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Relationship'); ?></label>				
						<select name="recipient[]" multiple="multiple">
							<?php
							foreach($rcpnt_datas as $rcpnt){
								echo "<option value='".$rcpnt['Recipient']['id']."'>".$rcpnt['Recipient']['recipient_name']."</option>";
							}
							?>
						</select>
						<span style='font-size:11px;'><?php echo __('To whom is it for?'); ?><span class="optional"><?php echo __('choose multiple by pressing ctrl'); ?></span></span>
				
				</dd>
				<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Shipping'); ?></label>
						<div class="selectdiv ">
						<select id="processing-time-id" name="processing_time_id" style="margin-bottom: 10px;" class="selectboxdiv">
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
							<!-- <option value="custom">Custom range</option> -->
						</select>		
						<div class="out" style="display:none;"><?php echo __('Ready to ship in...'); ?></div>
						</div>			
				</dd>
				<dd>
				<div class="custom-range" id="processing-time-days" style="display:none;">
				<label for=""  class="label"><?php echo __('Custom range'); ?></label>
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
				</dd>
					
				
				
			</div>	
			
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
		<br />
			<div class="ui-body ui-body-a">
				<b>Product sizes</b>
				<dd style="height:auto;overflow:hidden;">
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Options for sizes'); echo __('Shoes or T-shirts(optional)');  ?></label>
					<span style='font-size:11px;'>Must enter the details separate comma's(,) Example:M=4,L=6,XL=10 </span><br />	
					<?php	
									
						echo $this->Form->input('item_size_options',array('type'=>'textarea','label'=>false,'id'=>'size_options','class'=>'inputform'));
						echo "";
						?>
				</dd>
				
			</div><br />
		
			<div class="ui-body ui-body-a">
				<b>Shipping countries</b>
				<dd>
					<label for=""  class="label" style="font-size:13px;"><?php echo __('Ships to'); ?></label>
					<div class="selectdiv ">
						<select name="ship_from_country" id="selct_lctn_bxs" class="selectboxdiv">
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
							
						<div class="out" style="display:none;"><?php echo __('Select a location...'); ?></div>
						</div>
						
					<span class="shippingcountryerror"></span>
				</dd>
			</div>
	
	
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
  
  
  
			<br />
			<div class="ui-body ui-body-a">
				<b><?php echo __('Ships Details'); ?></b>
				
					<!-- <label for=""  class="label" style="font-size:13px;"><?php echo __('Ships to'); ?>:</label> -->
  
  
					  <div style="" class="set-shipping-rates">
					        <table class="shipping-rates msm" id="shpng_div" width="100%">
							   <thead>
					              <tr align="left">
					             <th style="font-size:15px;"><?php echo __('Ships to'); ?></th>
					                  <th style="font-size:15px;"><dd>Cost</dd></th>
					                  <th style="font-size:15px;"><dd>Remove</dd></th>
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
												<label></label>               
												<?php echo $_SESSION['default_currency_symbol']; ?><input type="text" value="" class="money text text-small" name="country_shipping[<?php echo $cntryid[$cntry_code]; ?>][0][primary]">            
											</div>       
										</td>     
										      
										<td>       
											<div class="input-group input-group-price price-input primary-shipping-price">
												<a style="font-size: 0.000001px;" href="javascript:void(0)" id="<?php echo $cntryid[$cntry_code]; ?>"><span class="glyphicons "> </span></a>
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
														<p style="font-size:13px;">Sets the shipping costs for EVERY country not covered by country specific shipping costs. This is optional. </p>    
															<span class="tt-arrow"></span>         
													</div>     
												</div>     
												<input type="hidden" value="true" name="everywhere_shipping[enabled]">
											</div>         
											<div class="regions-box"></div>       
										</td>      
										<td>           
											<div class="input-group input-group-price price-input primary-shipping-price">               
												<label><?php echo $_SESSION['default_currency_symbol']; ?></label>               
												<input type="text" value="" class="money text text-small" name="everywhere_shipping[1][primary]">            
											</div>       
										</td>      
					    
										<td class="input-group-close">       
											<div class="input-group input-group-price price-input primary-shipping-price">
												<a class="remove" href="javascript:void(0)" id="E"><span  class="glyphicons bin"></span></a>
											</div> 
										</td>  
									</tr>   
								
								</tbody>
							 </table>
								<!--<span class="button-medium button-medium-grey" id="add_shipping_location"><span><input type="button" value="Add location"></span></span>-->
							</div>
		
	</div>
	
	
	
	
	
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
        tinymce.init({selector:'#description'});
</script>
<script>
var invajax=0;
</script>

