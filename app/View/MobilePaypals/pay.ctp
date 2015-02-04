
<?php
error_reporting(0);
$disable = '';
$soldOut = 0;
  	if ($usershippingdefault == 0)  {
  		$usershippingdefault = $usershipping[0]['Tempaddresses']['shippingid'];
  	}
  	if ($shipping_method_id == '') {
  		$shipping_method_id = $usershipping[0]['Tempaddresses']['countrycode'];
  	}
	if($total_itms > 0 || $giftcarduseradded >0){
		
		
		if(!empty($giftcarduseradded)){
			$total_itms += $countgiftcarduseradded;
		}else{
			$total_itms = $total_itms;
		}
		
		echo "<div class='container' style='margin-top:-15px;'>";
		echo "<div class='wrapper-content order'>";
		echo "<div id='content'>";
		echo "<div class='cart-list' style=''>";
			//echo "<h2>You have ".$total_itms." Items in your Cart</h2>";
				//echo "<pre>";print_r($itm_datas);die;
				$count = 1;
				$item_price = 0;
				$shipping = 0;
				$total_price = 0;
				$item_id = array();
				
		echo '<span id="gfremoved" style="display:none;color:#00FF00;">';echo __('Item removed successfully');echo '</span>';
					
		
		if(!empty($giftcarduseradded)){
				
			foreach($giftcarduseradded as $ke=>$itm){
			
			
				$gift_title = $giftcarditemDetails['title'];
				$gift_image = $giftcarditemDetails['image'];
				if ($count == 1) {
					echo '<br><div id="giftcartids'.$itm['Giftcard']['id'].'" class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">';
					echo '<p class="cart-list-from">';
					
					
					echo '<div class="cart-payment-wrap cart-note">
					<span class="cart-payment-top"><b></b></span>
					<div class="table-cart-wrap">';

				}
				
				echo '<div style="with:98% !important;">';
				echo "<a data-ajax='false' href='".SITE_URL."mobile/create/giftcard/'>
					<img src='".$_SESSION['media_url']."media/items/thumb150/".$gift_image."' />
					</a>";
					//echo '</div><div style="width:58% !important;float:left;">';
				echo '<a data-ajax="false" href="create/giftcard/" style="text-decoration:none;color;#000000;position:relative;top:-130px;left:10px;">'.$gift_title.'</a>';
				//echo $this->Html->link($gift_title,array('controller'=>'/','action'=>'create/giftcard/'))."";
				 

				//echo $_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'];

				
					//echo '1';
				
						
					
			//echo $_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'];
			?>
			
				<li style="list-style:none;top:-130px;left:195px;position:relative;"><span class='option-tit'>Name: </span>
					<span class='option-txt'>
						<?php echo $itm['Giftcard']['reciptent_name']; ?>
					</span>
				</li>
	            <li style="list-style:none;top:-130px;left:195px;position:relative;">
	            	<span class='option-tit'>Email: </span>
					<span class='option-txt'>
						<?php echo $itm['Giftcard']['reciptent_email']; ?>
					</span>
				</li>
				<li style="list-style:none;top:-130px;left:195px;position:relative;">
					<span class='option-tit'>Message: </span>
					<span class='option-txt'>
						<?php echo $itm['Giftcard']['message']; ?>
					</span>
				</li>
          
			
			
			<?php 
			echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removegiftcart(".$itm['Giftcard']['id'].")' style='margin-left:-50px;top:-130px;left:195px;position:relative;'> Remove</a>";
				echo '</div></div></div>';
				  echo '<div class="cart-payment" id="merchant-cart-payment" style="margin-top:-65px;">
				    <span class="bg-cart-payment"></span>';
				      
				     echo '<dl class="cart-payment-order">
				      <dt>';echo __('<b>Order</b>');echo '</dt>
				      
					';
					echo '<table width="100%"><thead><tr><th></th><th></th></tr></thead>
					<tbody><tr><td>';
					  echo '<li class="first" style="list-style:none;">
					    <span class="order-payment-type">';echo __('Item total');echo '</span></td><td>
					    <span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].'</b> '.$_SESSION['default_currency_code'].'</span>
					  </li>';
					  echo '</td></tr><tr><td>';
					 echo '<li style="list-style:none;">
					    <span class="order-payment-type">';echo __('Shipping'); echo '</span></td><td>
					    <span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$shipping.'</b> '.$_SESSION['default_currency_code'].'</span>
					  </li>';
					   echo '</td></tr><tr><td>';
					  echo '<li style="list-style:none;">
					    <span class="order-payment-type">Discount</span></td><td>
					    <span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].'0</b> '.$_SESSION['default_currency_code'].'</span>
					  </li>';
					   echo '</td></tr><tr><td>';
					  echo '<li class="total"  id = "Creditamnt_totals" style="list-style:none;">
					  	<div class="coup_one" >
					    	<span class="order-payment-type"><b>';echo __('Total'); echo '</b></span></td><td>
					    	<span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].'</b> '.$_SESSION['default_currency_code'].'</span>
						</div>
					  </li>
				      ';
				      echo '</td></tr></table>';
					   
				    echo '</dl>'; ?>
					<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;font-size:12px;" class="btn button<?php echo $itm['Giftcard']['id']; ?>" id="button-submit-merchant" onclick="giftcardcheckout('<?php echo $itm['Giftcard']['id']; ?>')">
					Checkout with Paypal</button>
		    		<div class="PLoader<?php echo $itm['Giftcard']['id']; ?> checkoutloading" style="display:none"><img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Processing......"></div>
		    	
							  
							</div>
							</div>
								<?php	}		}
								
					$item_id = array();
					$shipping_amt = array();
					//echo '<div id="shop'.$itm['Shop']['id'].'">';
					echo '<div>';
					echo '<div id="shop">';
					
					//echo ' <b> '.SITE_NAME.'</b> </p>';
					echo '<div class="cart-payment-wrap cart-note">
					<span class="cart-payment-top"><b></b></span>
					<div class="table-cart-wrap">
					
					<!--div data-role="controlgroup" data-type="horizontal" width="100%">
					<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:400px;">Product Image</span>
					<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:400px;">Product Name</span>
					<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:150px;">';echo __('Price'); echo '</span>
					<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:175px;">';echo __('Total'); echo '</span>
					<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:175px;">';echo __('Quantity'); echo '</span>
					</div-->
					';
				
				
					foreach($itm_datas as $ke=>$itm){
					echo '<p class="cart-list-from">';
					
					
					
					
					echo '<div class="ui-body ui-body-a" style="font-size:14px;border-radius:5px;">';
					echo __('Order from');
	
					echo '<b> <a data-ajax="false" href = "'.SITE_URL.'mobile/people/'.$itm['User']['username_url'].'" style="text-decoration:none;">
					'.$itm['User']['username'].'</a> </b> </p>';
					echo '<div>';
						//if ($count == 1) {
						$item_user_id = $itm['User']['id'];
						
						
						
					$item_id[] = $itm['Item']['id'];
					echo '
					
					';
									//echo '<div style="with:98% !important;height:auto;overflow:hidden;font-size:12px;">';
					//echo '<div style="width:28% !important;float:left;">';
					echo '<table style="width:100%;font-size:12px;"><thead><tr><th colspan="2"></th></tr></thead><tbody><tr><td style="width:75px;">';
					   echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>";
						   //<div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
							
						   echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$itm['Photo'][0]['image_name']."' style='width:70px;height:70px;'/>";
						   echo "</a>";
						  // echo '</div><div style="width:70% !important;float:left;">';
					   ///echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>";
					   echo '</td><td>';
					   $titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
					  //echo $this->Html->link($titttle,array('controller'=>'/','action'=>'mobile/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
					  echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '
					  style='text-decoration:none;color: #373D48;font-size:14px;position:relative;top:-12px;'>".$titttle."</a>";
					  if (!empty($size[$itm['Item']['id']]))
					  echo "<br /><span class='option-tit' style='position:relative;top:-10px;'>Size : ".$size[$itm['Item']['id']]."</span>";
					  else  
					  echo "<br /><span class='option-tit' style='position:relative;top:-10px;'>Size : N/A</span>";
					  echo '</td></tr></table>';
					   echo '</div>';
					  
					  $unitPriceConvert = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
					  //echo '<span class="ui-btn" style="border:none;background-color:#FFFFFF;width:150px;">'.$_SESSION['currency_symbol'].$unitPriceConvert.'</span>';
					  
					  			$shpngs = '';
			  foreach($itm['Shiping'] as $shpng){
					$shpngs[$shpng['country_id']] = round($shpng['primary_cost'] * $_SESSION['currency_value'], 2);
				}
				
					$item_total = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
					if ($quantity[$itm['Item']['id']] != 1) {
						$item_total = $item_total * $quantity[$itm['Item']['id']];
					}	
					$item_price = $item_price + $item_total;
					//print_r($shpngs);
				if (isset($shpngs[$shipping_method_id])) {	
					$shipping = $shipping + $shpngs[$shipping_method_id];
					$shipping_amt[] = $shpngs[$shipping_method_id];
					$total_price = $total_price + $item_total + $shpngs[$shipping_method_id];
				}else if(isset($shpngs[0])){
					$shipping = $shipping + $shpngs[0];
					$shipping_amt[] = $shpngs[0];
					$total_price = $total_price + $item_total + $shpngs[0];
				}else {
					$disable = "disabled";
				}
				
				$commiItemPrice = $itm['Item']['price'];
				
				foreach($commiDetails as $commi){
					$min_val = $commi['Commission']['min_value'];
					$max_val =  $commi['Commission']['max_value'];
					if($commiItemPrice>=$min_val && $commiItemPrice<=$max_val){
						if($commi['Commission']['type'] == '%'){
							//echo (floatval($pay['Orders']['totalcost'])/100)*$commi['Commission']['amount'];
							//die;
							$amount = (floatval($commiItemPrice)/100)*$commi['Commission']['amount'];
							//$amount = $commiItemPrice - $dis;
							//$amount = $commi['Commission']['amount'];
							$amount = $quantity[$itm['Item']['id']]*$amount;
							$amount = round($amount * $_SESSION['currency_value'], 2);
							$commiItemTotalPrice +=$amount; 
				
						}else{
							//$order_totalcost = $commiItemPrice-$commi['Commission']['amount'];
							$amount = $commi['Commission']['amount'];
							$amount = $quantity[$itm['Item']['id']]*$amount;
							$amount = round($amount * $_SESSION['currency_value'], 2);
							$commiItemTotalPrice +=$amount;
						}
						
					}
					
				}
				
					echo '<table style="font-size:13px;margin-top:-10px;">
					<thead><tr><thead>
					<th style="width:70px;"></th>
					<th style="width:250px;"></th></thead></tr>';
					 // echo $_SESSION['currency_symbol'].$item_total;
					  //if($itm['Item']['quantity'] > 0){
  					if (!empty($size[$itm['Item']['id']])){
  						$optionsval = explode(',',$itm['Item']['size_options']);
  						foreach($optionsval as $val){
  							if(!empty($val)){
  								$vall1 = explode('=',$val);
  								if(!empty($vall1[0]) && $vall1[0] == $size[$itm['Item']['id']])
  									$sizeQty = $vall1[1];
  							}
  						}

  						if ($sizeQty > 0){
  							//echo '<span class="selectdiv "  style="margin: 0px auto; padding-left: 4px; text-align: left; " >';
	  						echo "<tr><td><b>Quantity:</b></td><td><select style='float:left;' id='qnty".$itm['Item']['id']."' class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
	  						$selected = '';
	  						for($i=1;$i<=$sizeQty;$i++){
	  							if ($quantity[$itm['Item']['id']] == $i) {
	  								$selectedquan = $i;
	  								$selected = 'selected';
	  							}
	  							echo "<option ".$selected." value='".$i."'>".$i."</option>";
	  							$selected = '';
	  						}
							echo "</select><span class='out' style='display:none;'>".$selectedquan."</span>";
							echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
							echo "</span></td></tr>";
  						}else{
  							echo "<tr><td colspan='2'><span style='color:#FF0000;font-weight:bold;'>Sold Out</span></td></tr>";
  							$disable = "disabled";
  							$soldOut = 1;
  						}
  					}else{
  						if ($itm['Item']['quantity'] > 0){
	  						//echo '<span class="selectdiv" style="margin: 0px auto; padding-left: 4px; text-align: left;" >';
							echo "<tr><td><b>Quantity:</b></td><td><select style='float:left;' id='qnty".$itm['Item']['id']."' class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
							$selected = '';
								for($i=1;$i<=$itm['Item']['quantity'];$i++){
									if ($quantity[$itm['Item']['id']] == $i) {
										$selectedquan = $i;
										$selected = 'selected';
									}
									echo "<option ".$selected." value='".$i."'>".$i."</option>";
									$selected = '';
								}
							echo "</select><span class='out' style='display:none;'>".$selectedquan."</span>";
							echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
							echo "</span></td></tr>";
  						}else{
  							echo "<tr><td colspan='2'><span style='color:#FF0000;font-weight:bold;'>Sold Out</span></td></tr>";
  							$disable = "disabled";
  							$soldOut = 1;
  						}
  					}
					/* } else {
						echo $quantity[$itm['Item']['id']];
					} */

				
			  echo '';
			   $process_time =  $itm['Item']['processing_time'];
			  
			   ?>
			 
			      
			      <!--li><span class='option-tit'>Option:</span>
				<span class='option-txt'>	</span></li-->
					<?php if (!empty($size[$itm['Item']['id']])){ ?>
				<!--li>
					<span class='option-tit'>Size: <?php echo $size[$itm['Item']['id']]; ?></span>
				</li-->
					<?php }else{ ?>
				<!--li>
					<span class='option-tit'>Size: N/A</span>
				</li-->	
					<?php } ?>
					
			   <tr><td><?php echo __('<b>Shipping:</b>');?></td><td>
				<?php
				if (isset($shpngs[$shipping_method_id]) || isset($shpngs[0])) {
					if($process_time == '1d'){
						echo "One business day";
					}elseif($process_time == '2d'){
						echo "Two business days";
					}elseif($process_time == '3d'){
						echo "Three business days";
					}elseif($process_time == '4d'){
						echo "Four business days";
					}elseif($process_time == '2ww'){
						echo "One-Two week business days";
					}elseif($process_time == '3w'){
						echo "Two-Three week business days";
					}elseif($process_time == '4w'){
						echo "Three-Four week business days";
					}elseif($process_time == '6w'){
						echo "Four-Six week business days";
					}elseif($process_time == '8w'){
						echo "Six-Eight week business days";
					}
				}else {
					echo "<div style='color:red;'>";echo __('Cannot Ship this Product to your Location');echo "</div>";
				}
				?>
				
                   </td></tr></table>           
                              <br />
			  
			    <div style='with:98% !important;font-size:13px;'>
			    <div style='width:49% !important;float:left;text-align:center;'>
			    <?php  echo "<a data-ajax='false' style='text-decoration:none;' href='#' class='remove_item ' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>"; ?>
			   	</div><div style='width:49% !important;float:left;text-align:center;'>Price : <b style='font-size:15px;'><?php echo $_SESSION['currency_symbol'].$item_total; ?></b></div></div>
			   
			    
			  </span> 
			</div>
			<?php 
					
			}
			//if ($itm_group[$itm['Item']['shop_id']] == $count) {
		     echo '
		    
		    

		  </div></div><br /><div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">';
		  echo '<dl class="cart-payment-ship ship-addr-'.$item_user_id.'">
		      <dt>'; 
		     // echo "<pre>";print_r(count($usershipping));die;
		      //echo count($usershipping);
		      ?>
		      <?php 
			//echo $commiItemTotalPrice;
		      $available_bal = round($available_bal * $_SESSION['currency_value'], 2);
			if($commiItemTotalPrice > $available_bal){
				$commiItemTotalPrice = $available_bal;
			}
			?>
		     <input type='hidden' id='shipping_addre' value='<?php echo count($usershipping); ?>' />
	   		 <input type="hidden" id="coupon_idhide"  />
	   		 <input type="hidden" id="ca<?php echo $item_user_id; ?>"  value="<?php echo $commiItemTotalPrice; ?>" />
		     <input type="hidden" id="giftcard_idhide" >
			 
		     
		     <?php  if (count($usershipping) > 0) {
		    echo "<div class='styled selectcartdiv addressstyledremove'>";
		    echo '<table>';
		echo '<tr><td style="width:50px;">Ship to</td><td style="width:200px;"><select id="address-cart" class="select-shipping-addr  selectcartboxdiv" name="shipping_addr" onchange="cartshipping(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')" >';
			  foreach ($usershipping as $usership) {
					  $shipid = $usership['Tempaddresses']['shippingid'];
					  $nick = $usership['Tempaddresses']['nickname'];
					  if ($usershippingdefault == $shipid) {				  	
					  	$selectedShipping = $nick;
					  	echo '<option selected value="'.$shipid.'">'.$nick.'</option>';
					  	$fullname = $usership['Tempaddresses']['name'];
					  	$address1 = $usership['Tempaddresses']['address1'];
						$address2 = $usership['Tempaddresses']['address2'];
						$city = $usership['Tempaddresses']['city'];
						$state = $usership['Tempaddresses']['state'];
						$country = $usership['Tempaddresses']['country'];
						$zip = $usership['Tempaddresses']['zipcode'];
						$phone = $usership['Tempaddresses']['phone'];
				  }else{
				  	echo '<option value="'.$shipid.'">'.$nick.'</option>';
				  }
			  }
			  
			    echo '</select> </td></tr>';
			    echo '<div class="shipchload shipchload'.$item_user_id.'" style="display:none;"><img src="'.SITE_URL.'images/loading.gif" alt="Loading" /> </div>';
			    echo '<div class="out" style="display:none;">'.$selectedShipping.'</div>
			     </div>
			     </table>
			<div style="padding-top: 6px;"> Selected Address: </div>
			
			<div class="default_addr'.$item_user_id.'" style="font-size: 13px;"><div class="addnam"><b>'.$fullname.'</b></div>
			  '.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br /><div class="addphne">'.$phone.'</div>
			  	
			</div><br />';
			echo '<div style="with:98% !important;">
			<div style="width:48% !important;float:left;text-align:center;">
			';
			echo '<a style="text-decoration:none;" href="javascript:void(0);" class="delete_addr  delete_addr'.$item_user_id.'" onclick=\'CartshippingRemove("'.$usershippingdefault.'","'.$item_user_id.'","'.$itm['Shop']['id'].'")\'>';echo __('Delete this address'); echo '</a>
			</div><div style="width:2% !important;float:left;text-align:center;">|</div>
			<div style="width:48% !important;float:left;text-align:center;">
			<a data-ajax="false" style="text-decoration:none;" href="'.SITE_URL.'mobile/addshipping" class="add_addr">';echo __('Add new address'); echo '</a>';
		     }else{
		     echo '<a data-ajax="false" style="text-decoration:none;" href="'.SITE_URL.'mobile/addshipping" class="add_addr">';echo __('Add new address'); echo '</a>';
		    }
		     echo '</div></div>
			</dl></div>';
		  
		echo '<br />';
	         $item_id = json_encode($item_id);
			$item_id = str_replace("\""," ",$item_id); 
		  echo '<div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;"><div class="cart-payment" id="merchant-cart-payment">
		    <span class="bg-cart-payment"></span>
		    <dl>Coupon codes:
		    	<span style="float:left;width:250px;"></span>
		    	<input type="text" id="couponcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="Have a coupon code?" />
		   		<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;" id="button-submit-merchant" class="applybtncoupon" onclick="checkcoupon(\''.$item_user_id.'\',\''.$userid.'\',\''.$itm['Shop']['id'].'\')" >Apply</button>
		    	<span id="couponsemp" style="display:none;color:#FF0000;">Coupon code is empty</span>
		    	<span id="couponsnotvalid" style="display:none;color:#FF0000;">Coupon code is Not valid</span>
		    	<span id="couponsExpired" style="display:none;color:#FF0000;">Coupon code is Expired</span>
		    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Coupon code not valid for this Merchant</span>
		    	<div id="loadingimgs" style="display:none;text-align:center;">
					<img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
				</div>
		    
		    </dl>
		    
		    
		    <dl>Gift Card codes:
		    	<!--span style="float:left;width:250px;">';echo __('');echo ':</span-->
		    	<input type="text" id="giftcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="Have a Gift Card code?" />
		   		<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;" id="button-submit-merchant" class="applybtncoupon" onclick="Checkgiftcard(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')" >Apply</button>
		    	<span id="giftcodesemp" style="display:none;color:#FF0000;">Gift Card code is empty</span>
		    	<span id="giftcodesnotvalid" style="display:none;color:#FF0000;">Gift Card code is Not valid</span>
		    	<span id="couponsExpired" style="display:none;color:#FF0000;">Gift Card code is Expired</span>
		    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Gift Card code not valid for this Merchant</span>
		    	<div id="loadingimgsforgf" style="display:none;text-align:center;">
					<img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
				</div>
		    	
		    </dl>
		    
		    
		    
		    
		    
		    </div></div>
		    <dl class="cart-payment-order">
		    <div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">
		    <table width="100%"><thead><tr>
		     <th colspan="2" align="left"> <dt>';echo __('Order');echo '</dt></th></tr><tbody>
		     <tr><td align="left">
		      
			';
			  echo '<li class="first" style="list-style:none;">
			    <span class="order-payment-type">';echo __('Item total');echo '</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$item_price.
			    '</b> '.$_SESSION['currency_code'].'</span>
			  </li></td></tr>';
			  echo '<tr><td>';
			 echo '<li style="list-style:none;">
			    <span class="order-payment-type">';echo __('Shipping'); echo '</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$shipping.
			    '</b> '.$_SESSION['currency_code'].'</span>
			  </li></td></tr>';
			  echo '<tr style="display:none;"><td>';
			  
			  echo '<li style="list-style:none;">
			    <span class="order-payment-type">Discount</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].'0</b> '.$_SESSION['currency_code'].'</span>
			  </li></td></tr>';
			  
			  
			   echo '<tr id = "Creditamnt'.$item_user_id.'" style="display:none;"><td><li style="list-style:none;">
			   <span class="order-payment-type">Credits</span></td><td align="right"> <span class="order-payment-usd"><b>'
			   .$_SESSION['currency_symbol'].'</b><b id = "availablee_credits">
			   </b> '.$_SESSION['currency_code'].'</span></li></td></tr>';
			   
			   
			   /* if($available_bal!==''){
			   	$total_priceamt = $total_price - $available_bal;
			   } */
			  
			   
			   
			   echo '<tr id = "Creditamnt_total'.$item_user_id.'" style="display:none;"><td><li class="total" style="list-style:none;">
			   <div class="coup_one" style="display:block;">
			   <span class="order-payment-type"><b>';echo __('Total'); echo '</b></span></td><td align="right">
			   <span class="order-payment-usd">'.$_SESSION['currency_symbol'].
			   '<b id = "total_credits'.$item_user_id.'">'.$total_priceamt.
			   '</b> '.$_SESSION['currency_code'].'</span>
			   </div>
			   </li></td></tr>';
			   
			   
			   echo '<tr id = "Creditamnt_totals'.$item_user_id.'"><td>';
			   
			   
			  echo '<li class="total" style="list-style:none;">
			  	<div class="coup_one" style="display:block;">
			    	<span class="order-payment-type"><b>';echo __('Total'); echo '</b></span></td><td align="right">
			    	<span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$total_price.
			    	'</b> '.$_SESSION['currency_code'].'</span>
				</div>
			  </li></td></tr></tbody></table></span>
			
		     ';
			  
	         $item_id = json_encode($item_id);
			$item_id = str_replace("\""," ",$item_id); 
			$shipping_amt = json_encode($shipping_amt);
			 $shipping_amt = str_replace("\""," ",$shipping_amt);    
		    echo '</dl>';
		    
			    if($available_bal > 0){
			    	echo '<span class="usecreditcart"><a href="#add-to-list-new" data-rel="popup" data-position-to="window" id="usecreditamount'.$item_user_id.'" style="font-size:13px;" >'?><?php echo __('Use Credit Amount'); echo '</a></span>';
			    }else{
			    	echo '<span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" style="font-size:13px;text-decoration:none;"  onclick="alertusecreditamount('.$item_user_id.','.$userid.')">'?><?php echo __('Use Credit Amount'); echo '</a></span>';
			    }
			    //echo '<span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onclick="usecreditamount('.$item_user_id.','.$userid.')" >'?><?php //echo __('Use Credit Amount'); echo '</a></span>';
		  ?>
		  		 <input type="hidden" id="totalitemcost<?php echo $item_user_id; ?>" value="<?php echo $item_price; ?>" />
	   		<input type="hidden" id="totalshipp<?php echo $item_user_id; ?>" value="<?php echo $shipping; ?>" />
		    	<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;font-size:12px;" <?php echo $disable; ?> class="btn button<?php echo $item_user_id; ?>" id="button-submit-merchant" onclick="checkout('<?php echo $item_id."', '".$item_user_id."', '".$shipping_amt;?>')">
		    	Checkout with Paypal</button>
		    	<div class="adaptiveLoader<?php echo $item_user_id; ?> checkoutloading" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Processing......"></div>
		    	<?php 
		    	if ($disable != '' && $soldOut == 0){
		    		echo "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product that cannot be Shipped to your Location or Give a Different Address to make a Checkout</div>";
		    		$disable = '';
		    	}else if ($disable != '' && $soldOut == 1){
		    		echo "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product which is sold out to make a Checkout</div>";
		    		$disable = '';
		    		$soldOut = 0;
		    	}
		    	?>
		  </div>
		</div></div>
			<?php		
						$count = 1;
						$item_price = 0;
						$shipping = 0;
						$total_price = 0;//} else {$count ++;echo "</div>";
						
						//}
					//}
			
			echo '<div id="paypalfom"></div>';			
		echo "</div>";		
	}else{
		echo "<div class='container' style='width:940px;'>";
		echo '<div class="wrapper-content sale empty">
			<div id="content"  style="padding: 25px; width: 890px;">
				<h2 class="add-tit">Shopping Cart</h2>
				<div style="border-bottom: none;" class="empty-alert">
					<p><b>Your Shopping Cart is Empty</b></p>
					<p>Don\'t miss out on awesome sales right here on Trend. Let\'s fill that cart, shall we?</p>
				</div>
				
			</div>
		</div>';
	}	

	echo '</div></div>';
	
	?>

<!-- popups -->
<div id="popup_container">
<!-- add_to_list overlay -->
<div id="add-to-list-new" data-role="popup" class="popup ly-title update add-to-list">
<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<div class="default" style="padding-bottom:25px;font-size:14px;">
<div class="ui-body ui-body-a" style="background:#F4F4F4;">
		<h3 class="ltit"><?php echo __('Using Credit amount');?></h3>
		</div><div class="ui-body ui-body-a">
		<div class="fancyd-item">
		
			<?php echo __('Your credit amount');?>: <?php if($available_bal > 0){ echo $available_bal; ?>
			<?php //else{ echo "0"; } ?>
			<br />
			
			<?php echo __('Maximum credit you can use for this purchase');?> <?php echo $commiItemTotalPrice; ?>
			<br /><br />
			<?php echo __('Enter amount');?>:<input type="text" id="userentercreditamt" /><br />
			<?php echo '<button id="usercreditamntchek" class="btn" style="background:#3A83C0;text-shadow:none;" onclick="usecreditamount('.$item_user_id.','.$userid.')">'; ?><span style="color:#FFFFFF;"><?php echo __('Save');?></span></button>
			<?php } 
			else
			{?>
			<?php echo __('Your credit amount is empty');?>
			<button id="usercreditamntchek" class="btn"><?php echo __('Ok');?></button>
			<?php } ?>
		</div>
		
	</div></div>
</div>
</div>
<!-- /popups -->	

	
<script>
var couajax=0;
var creditamnts=0;
</script>
