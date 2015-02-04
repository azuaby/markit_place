<?php 
error_reporting(0);
$soldOut = 0;
$disable = '';
	//echo "<pre>";print_r($getgiftcardValue);die;

				if (isset($itm_datas) && count($itm_datas) > 0 ) {
				$message = '';
				$count = 1;
				$item_price = 0;
				$shipping = 0;
				$total_price = 0;
				$discount = 0;
				$c_item_tot = 0;
						$item_id = array();
						$shipping_amt = array();
						$message = $message . "  " . '<div id="shop" style="">';
						$message = $message . "  " . '<div class="cart-payment-wrap cart-note">
						<span class="cart-payment-top"><b></b></span>
						<div class="table-cart-wrap">';
					foreach($itm_datas as $ke=>$itm){
						$item_user_id = $itm['User']['id'];
$item_id[] = $itm['Item']['id'];
						$message = $message .'
						<br ><div class="ui-body ui-body-a" style="border-radius:5px;"><p class="cart-list-from" style="font-size:14px;">
								Order from <b> <a style="text-decoration:none;" data-ajax="false" href = "'.SITE_URL.'mobile/people/'.$itm['User']['username_url'].'">
								'.$itm['User']['username'].'</a> </b> </p>';
					
								//$message = $message . '<div style="with:98% !important;height:auto;overflow:hidden;font-size:12px;">';
					//$message = $message . '<div style="width:28% !important;float:left;">';
					$message = $message . '<table style="width:100%;font-size:12px;"><thead><tr><th colspan="2"></th></tr></thead><tbody><tr><td style="width:75px;">';
					   $message = $message . "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>";
						   //<div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
							
						   $message = $message . "<img src='".$_SESSION['media_url']."media/items/thumb70/".$itm['Photo'][0]['image_name']."' style='width:70px;height:70px;'/>";
						  $message = $message . "</a>";
						  // $message = $message . '</div><div style="width:70% !important;float:left;">';
					   ///echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>";
					  $message = $message . '</td><td>';
					   $titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
					  //echo $this->Html->link($titttle,array('controller'=>'/','action'=>'mobile/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
					  $message = $message . "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '
					  style='text-decoration:none;color: #373D48;font-size:14px;position:relative;top:-12px;'>".$titttle."</a>";
					  if (!empty($size[$itm['Item']['id']]))
					  $message = $message . "<br /><span class='option-tit' style='position:relative;top:-10px;'>Size : ".$size[$itm['Item']['id']]."</span>";
					  else  
					  $message = $message . "<br /><span class='option-tit' style='position:relative;top:-10px;'>Size : N/A</span>";
					  $message = $message . '</td></tr></tbody></table>';
					   //$message = $message .'</div>';
			    
			  $message = $message . "  " ;
			  $itemprice = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			  //$message = $message . "  " . '<td class="price">'.$_SESSION['currency_symbol'].$itemprice.'</td>';
			  
			  $shpngs = '';
			  foreach($itm['Shiping'] as $shpng){
					$shpngs[$shpng['country_id']] = round($shpng['primary_cost'] * $_SESSION['currency_value'], 2);
				}
				$item_total = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
					if ($quantity[$itm['Item']['id']] != 1) {
						$item_total = $item_total * $quantity[$itm['Item']['id']];
					}	
					$item_price = $item_price + $item_total;
				if (isset($shpngs[$shipping_method_id])) {
					$shipping = $shipping + $shpngs[$shipping_method_id];
					$shipping_amt[] = $shpngs[$shipping_method_id];
					$total_price = $total_price + $item_total + $shpngs[$shipping_method_id];
					//$c_item_tot = $item_total + $shpngs[$shipping_method_id];
				}else if(isset($shpngs[0])){
					$shipping = $shipping + $shpngs[0];
					$shipping_amt[] = $shpngs[0];
					$total_price = $total_price + $item_total + $shpngs[0];
					//$c_item_tot = $item_total + $shpngs[0];
				}else {
					$disable = "disabled";
				}
				
				
				
				$commiItemPrice = $itm['Item']['price'];
				
				foreach($commiDetails as $commi){
					$min_val = $commi['Commission']['min_value'];
					$max_val =  $commi['Commission']['max_value'];
					if($commiItemPrice>=$min_val && $commiItemPrice<=$max_val){
						if($commi['Commission']['type'] == '%'){
							$amount = (floatval($commiItemPrice)/100)*$commi['Commission']['amount'];
							$amount = $quantity[$itm['Item']['id']]*$amount;
							$amount = round($amount * $_SESSION['currency_value'], 2);
							$commiItemTotalPrice +=$amount;				
						}else{
							$amount = $commi['Commission']['amount'];
							$amount = $quantity[$itm['Item']['id']]*$amount;
							$amount = round($amount * $_SESSION['currency_value'], 2);
							$commiItemTotalPrice +=$amount;
						}
					}
				}
			 
			  $message = $message .'<table style="font-size:13px;margin-top:-10px;">
					<thead><tr><thead>
					<th style="width:70px;"></th>
					<th style="width:250px;"></th></thead></tr>';
			  //if($itm['Item']['quantity'] > 1){
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
  						//$message = $message . " ". '<div class="selectdiv" style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">	';
  						$message = $message . "  " .  "<tr><td><b>Quantity :</b></td><td><select id='qnty".$itm['Item']['id']."' class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
  						$selected = '';
  						for($i=1;$i<=$sizeQty;$i++){
  							if ($quantity[$itm['Item']['id']] == $i) {
  								$selected = 'selected';
  								$selectedquan = $i;
  							}
  							$message = $message . "  " .  "<option ".$selected." value='".$i."'>".$i."</option>";
  							$selected = '';
  						}
						$message = $message . "  " . "</select><div class='out' style='display:none;'>".$selectedquan."</div>";
  						$message = $message . "  " . "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div></td></tr>";
						}else{
  							$message = $message . "  " . "<tr><td colspan='2'><span style='color:#FF0000;font-weight:bold;'>Sold Out</span></td></tr>";
  							$disable = "disabled";
  							$soldOut = 1;
						}
  					}else{
  						if ($itm['Item']['quantity'] > 0){
		  					//$message = $message . " ". '<div class="selectdiv" style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">		  					';
							$message = $message . "  " . "<tr><td><b>Quantity :</b></td><td><select id='qnty".$itm['Item']['id']."' class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
								$selected = '';
									for($i=1;$i<=$itm['Item']['quantity'];$i++){
										if ($quantity[$itm['Item']['id']] == $i) {
											$selected = 'selected';
	  										$selectedquan = $i;
										}
										$message = $message . "  " . "<option ".$selected." value='".$i."'>".$i."</option>";
										$selected = '';
									}
								$message = $message . "  " . "</select><div class='out' style='display:none;'>".$selectedquan."</div>";
		  						$message = $message . "  " . "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div></td></tr>";
  						}else{
  							$message = $message . "  " . "<tr><td colspan='2'><span style='color:#FF0000;font-weight:bold;'>Sold Out</span></td></tr>";
  							$disable = "disabled";
  							$soldOut = 1;
  						}
  					}
					/* } else {
						$message = $message . "  " . $quantity[$itm['Item']['id']];
					} */
					
				
				
			  
			    
			    $message = $message . "  " . '';


			    $message = $message."<tr><td><span class='option-tit'  style='position: relative; bottom: 6px;' ><b>Shipping:</b></span></td><td>";
			   $process_time =  $itm['Item']['processing_time'];
               $message = $message . "  " .  "<li style='list-style:none;'>
				<span class='option-txt'  style='position: relative; bottom: 6px;' >";
				if (isset($shpngs[$shipping_method_id]) || isset($shpngs[0])) {
					if($process_time == '1d'){
						$message = $message . "  " .  "One business day";
					}elseif($process_time == '2d'){
						$message = $message . "  " .  "Two business days";
					}elseif($process_time == '3d'){
						$message = $message . "  " .  "Three business days";
					}elseif($process_time == '4d'){
						$message = $message . "  " .  "Four business days";
					}elseif($process_time == '2ww'){
						$message = $message . "  " .  "One-Two week business days";
					}elseif($process_time == '3w'){
						$message = $message . "  " .  "Two-Three week business days";
					}elseif($process_time == '4w'){
						$message = $message . "  " .  "Three-Four week business days";
					}elseif($process_time == '6w'){
						$message = $message . "  " .  "Four-Six week business days";
					}elseif($process_time == '8w'){
						$message = $message . "  " .  "Six-Eight week business days";
					}
				}else {
					$message = $message . "  " . "<div style='color:red;'>Cannot Ship this Product to your Location</div>";
				}
				         
				
				$message = $message . "  " . '</span></li>';
				$message = $message .'</td></tr></table><br />';
				$message = $message . " <div style='with:98% !important;font-size:13px;'>
			    <div style='width:49% !important;float:left;text-align:center;'>";
			     $message = $message . "  " . "<a href='#' style='text-decoration:none;' class='remove_item' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> Remove</a>";
                  $message = $message . " </div>
			    <div style='width:49% !important;float:left;text-align:center;'>";   
			     $message = $message ."<b style='font-size:15px;'>".$_SESSION['currency_symbol'].$item_total."</b>";
			     $message = $message .'</div></div>';
								              
          $message = $message . " " .'';
          
          
          
          
          $message = $message . '</div>';
          
			//if ($itm_group[$itm['Item']['shop_id']] == $count) {
					
					}
		     $message = $message . "  " . ' </div><br />
		   

		  </div></div></div>';
		  $message = $message.'<div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">
		  
		     <dl class="cart-payment-ship ship-addr-'.$item_user_id.'">
		     <span class="bg-cart-payment"></span>
		      <table>
		      <dd>';
		      if (count($usershipping) > 0) {
		      $message = $message . "  " . '<div class="selectcartdiv  addressstyledremove">';
		$message = $message . "  " . '<tr><td style="width:50px;">Ship to</td><td style="width:200px;"> <select id="address-cart" class="select-shipping-addr selectcartboxdiv" name="shipping_addr" onchange="cartshipping(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')">';
			  
			  foreach ($usershipping as $usership) {
			  $shipid = $usership['Tempaddresses']['shippingid'];
			  $nick = $usership['Tempaddresses']['nickname'];
			  if ($usershippingdefault == $shipid) {
$message = $message . $shipid;
			  	$selectedShipping = $nick;			  	
			  	$message = $message . "  " . '<option selected value="'.$shipid.'">'.$nick.'</option>';
			  	$fullname = $usership['Tempaddresses']['name'];
			  	$address1 = $usership['Tempaddresses']['address1'];
				$address2 = $usership['Tempaddresses']['address2'];
				$city = $usership['Tempaddresses']['city'];
				$state = $usership['Tempaddresses']['state'];
				$country = $usership['Tempaddresses']['country'];
				$zip = $usership['Tempaddresses']['zipcode'];
				$phone = $usership['Tempaddresses']['phone'];
				$count = 1;
			  }else{
			  	$message = $message . "  " . '<option value="'.$shipid.'">'.$nick.'</option>';
			  }
			  }
			   $message = $message . '';
			    $message = $message . "  " . '</select></td></tr>
			    <div class="shipchload shipchload'.$item_user_id.'" style="display:none;"><img src="'.SITE_URL.'images/loading.gif" alt="Loading" /> </div>
			    <div class="out" style="display:none;">'.$selectedShipping.'</div></div>
			    <div></table>
			<div> Selected Address: </div>
			<div class="default_addr'.$item_user_id.'" style="font-size: 13px;"><div class="addnam"><b>'.$fullname.'</b></div>
			  '.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br /><div class="addphne">'.$phone.'</div>
			  	
			</div>';
			$message = $message .'<br /><div style="with:98% !important;">
			<div style="width:48% !important;float:left;text-align:center;">';
			$message = $message . "  " . '<a href="javascript:void(0);" class="delete_addr delete_addr'.$item_user_id.'" onclick=\'CartshippingRemove("'.$usershippingdefault.'","'.$item_user_id.'","'.$itm['Shop']['id'].'")\'>Delete this address</a>
			</div><div style="width:2% !important;float:left;text-align:center;">|</div>
			<div style="width:48% !important;float:left;text-align:center;">
			
			<a data-ajax="false" href="'.SITE_URL.'mobile/addshipping" class="add_addr">Add new address</a>';
		     }else{
		     $message = $message . "  " . '<a data-ajax="false" href="'.SITE_URL.'mobile/addshipping" class="add_addr">Add new address</a>';
		    }
		     $message = $message . "  " . '</dd></div></div>
			</dl>
			</div></div><br />
			';
		
		 $message = $message . "  " . '<div class="cart-payment" id="merchant-cart-payment">
		    <span class="bg-cart-payment"></span>
		     <div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">
		     <dl>
		    	<span style="float:left;width:250px;">Coupon codes:</span><br />
		    	<input type="text" id="couponcode" style="width:1243px;height: 15px; padding: 7px 2px;"  placeholder="Have a coupon code?" />
		   		
		    	<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;" id="button-submit-merchant" onclick="checkcoupon(\''.$item_user_id.'\',\''.$itm['User']['id'].'\',\''.$itm['Shop']['id'].'\')">Apply</button>
		    	
		    	<span id="couponsemp" style="display:none;color:#FF0000;">Coupon code is empty</span>
		    	<span id="couponsnotvalid" style="display:none;color:#FF0000;">Coupon code is Not valid</span>
		    	<span id="couponsExpired" style="display:none;color:#FF0000;">Coupon code is Expired</span>
		    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Coupon code not valid for this Merchant</span>
		    	<div id="loadingimgs" style="display:none;text-align:center;">
					<img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
				</div>
		     </dl>
	
		    <dl>
		    	<span style="float:left;width:250px;">Gift Card codes:</span><br />
		    	<input type="text" id="giftcode" style="width:1243px;height: 15px; padding: 7px 2px;"  placeholder="Have a Gift Card code?" />
		   		<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;" id="button-submit-merchant" onclick="Checkgiftcard(\''.$item_user_id.'\')">Apply</button>
		    	<span id="giftcodesemp" style="display:none;color:#FF0000;">Gift Card code is empty</span>
		    	<span id="giftcodesnotvalid" style="display:none;color:#FF0000;">Gift Card code is Not valid</span>
		    	<span id="couponsExpired" style="display:none;color:#FF0000;">Gift Card code is Expired</span>
		    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Gift Card code not valid for this Merchant</span>
		    	<div id="loadingimgsforgf" style="display:none;text-align:center;">
					<img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
				</div>
		    
		    </dl>
		    
		    
		 
		    </div><br />
		    <div class="ui-body ui-body-a" style="font-size:12px;border-radius:5px;">
		    <table width="100%"><thead><tr><th colspan="2" align="left">
		      <dt>Order</dt></th></tr></thead><tbody>
		      
			';
			  $message = $message . "  " . '<tr><td><li class="first" style="list-style:none;">
			    <span class="order-payment-type">Item total</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$item_price.
			    '</b> '.$_SESSION['currency_code'].'</span></li></td></tr>';
			 $message = $message . "  " . '<tr><td><li style="list-style:none;">
			    <span class="order-payment-type">Shipping</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$shipping.
			    '</b> '.$_SESSION['currency_code'].'</span></li></td></tr>';
			 
			 
			 
			 
			 if(isset($getcouponvalue)){
			 	if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
			 		$discount = $getcouponvalue['Coupon']['discount_amount'];
			 		$calDiscount = $item_price * ($discount / 100);
			 		
			 		if (isset($shpngs[$shipping_method_id])) {
			 			$total_price -= $calDiscount;
			 		}else if(isset($shpngs[0])){
			 			$total_price -= $calDiscount;
			 		}else {
						$total_price = 0;
						$disable = "disabled";
					}
			 	}
			 	if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
			 		$discount = round($getcouponvalue['Coupon']['discount_amount'] * $_SESSION['currency_value'], 2);
			 		if (isset($shpngs[$shipping_method_id])) {
			 			$total_price = $total_price - $discount;
			 		}else if(isset($shpngs[0])){
			 			$total_price = $total_price - $discount;
					}else {
						$total_price = 0;
						$disable = "disabled";
					}
			 	}
			 
			 }
			 
			 if(isset($getcouponvalue)){
			 	if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
			 
			  $message = $message . "  " . '<tr><td><li style="list-style:none;">
			    <span class="order-payment-type">Discount</span></td><td align="right">
			    <span class="order-payment-usd"><b>%'.$discount.'</b> </span>
			  </li></td></tr>';
			  
			 	}
			 	if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
			 
			  $message = $message . "  " . '<tr><td><li style="list-style:none;">
			    <span class="order-payment-type">Discount</span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$discount.
			    '</b> '.$_SESSION['currency_code'].'</span>
			  </li></td></td>';
			  
			 	}
			 }/*else{
			 	$message = $message . "  " . '<tr><td><li style="list-style:none;">
			 	<span class="order-payment-type">Discount</span></td><td align="right">
			 	<span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].'0</b> '.$_SESSION['currency_code'].
			 	'</span>
			 	</li></td></tr>';
			 }*/	
			 $message = $message . '<input type="hidden" id="tototcostt" value="'.$total_price.'" />';
			 
			 	
			 //if(isset($getgiftcardValue) && ($item_price >= $getgiftcardValue['Giftcard']['avail_amount'])){
			 //$getgiftcardValue = $getgiftcardValue * $_SESSION['currency_value'];
			 if(isset($getgiftcardValue)){
			 	$getgiftcardValue['Giftcard']['avail_amount'] = round($getgiftcardValue['Giftcard']['avail_amount'] * $_SESSION['currency_value'], 2);
			 	$message = $message . "  " . '<tr><td><li style="list-style:none;">
			 	<span class="order-payment-type">Giftcard Amount</span></td><td align="right">
			 	<span class="order-payment-usd"><b> - '.$_SESSION['currency_symbol'].$getgiftcardValue['Giftcard']['avail_amount'].
			 	'</b> '.$_SESSION['currency_code'].'</span></li></td></tr>';
			 	$total_price = $total_price- $getgiftcardValue['Giftcard']['avail_amount'];
			 }/*else{
			 	$message = $message . "  " . '<tr><td><li style="list-style:none;">
			 	<span class="order-payment-type">Giftcard Amount</span></td><td align="right">
			 	<span class="order-payment-usd"><b>Not valid for this product</b></span>
			 	</li></td></tr>';
			 }*/
			 
			 
			 
			
			
			$message = $message . "  " . '<tr style="display:none;" id = "Creditamnt'.$item_user_id.'"><td><li style="list-style:none;">
						<span class="order-payment-type">Credits</span></td><td align="right"> <span class="order-payment-usd"><b>'.
						$_SESSION['currency_symbol'].'</b><b id = "availablee_credits"></b> '.
						$_SESSION['currency_code'].'</span></li></td></tr>';
			
			$message = $message . "  " . '<tr style="display:none;" id = "Creditamnt_total'.$item_user_id.'"><td><li class="total" style="list-style:none;">
			<div class="coup_one" style="display:block;">
			<span class="order-payment-type"><b>Total</b></span></td><td align="right">
			<span class="order-payment-usd">'.$_SESSION['currency_symbol'].'<b id = "total_credits'.
			$item_user_id.'">'.$total_priceamt.'</b> '.$_SESSION['currency_code'].'</span>
			</div>
			</li></td></tr>';
			
			
			
			/* 
			
			if($available_bal!==''){
				$total_priceamt = $total_price - $available_bal;
			} */
			
			if(isset($getgiftcardValue) && $total_price <= 0){
				$message = $message . "  " . '<tr id = "Creditamnt_totals'.$item_user_id.'"><td><li class="total" style="list-style:none;">
				<span class="order-payment-type"><b>Total</b></span></td><td align="right">
				<span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].' 0 </b> '.$_SESSION['currency_code'].'</span>
				</li></td></tr>';	
				}else{
			 $message = $message . "  " . '<tr id = "Creditamnt_totals'.$item_user_id.'"><td><li class="total" style="list-style:none;">
			    <span class="order-payment-type"><b>Total</b></span></td><td align="right">
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$total_price.'
			    </b> '.$_SESSION['currency_code'].'</span>
			  </li></td></tr>';
			}
			 $message = $message . "  " . '</tbody></table></div><br />';
			  
			  if(isset($getcouponvalue)){
			  	$message = $message . '<input type="hidden" id="coupon_idhide" value="'.$getcouponvalue['Coupon']['id'].'" />';
			  }else{
			  	$message = $message . '<input type="hidden" id="coupon_idhide" value="" />';
			  }
			  
			  if(isset($getgiftcardValue)){
			  	$message = $message . '<input type="hidden" id="giftcard_idhide" value="'.$getgiftcardValue['Giftcard']['id'].'" />';
			  }else{
			  	$message = $message . '<input type="hidden" id="giftcard_idhide" value="" />';
			  }
			  
			  $available_bal = round($available_bal * $_SESSION['currency_value'], 2);
			  if($commiItemTotalPrice > $available_bal){
			  	$commiItemTotalPrice = $available_bal;
			  }
			  $message = $message . '<input type="hidden" id="shipping_addre" value="'.count($usershipping).'" /><input type="hidden" id="ca'.$item_user_id.'"  value="'.$commiItemTotalPrice.'"  />';
	         $item_id = json_encode($item_id);
			$item_id = str_replace("\""," ",$item_id); 
			$shipping_amt = json_encode($shipping_amt);
			 $shipping_amt = str_replace("\""," ",$shipping_amt);  
			 
			 if(!isset($getgiftcardValue) && !isset($getcouponvalue)){
		    	//$message = $message . "  " . '</dl><span class="usecreditcart" style="display:none;"><input type="checkbox" id="usecreditamount'.$item_user_id.'" onChange="usecreditamount('.$item_user_id.','.$userid.')">Use Credit Amount </span>';
			 	if($available_bal > 0){
			 		$message = $message . "  " . '</dl><span class="usecreditcart"><a href="#add-to-list-new" data-rel="popup" data-position-to="window" id="usecreditamount'.$item_user_id.'" style="font-size:13px;text-decoration:none;">Use Credit Amount </a></span>';
			 	}else{
			 		$message = $message . "  " . '</dl><span class="usecreditcart"><a href="#add-to-list-new" data-rel="popup" data-position-to="window" id="usecreditamount'.$item_user_id.'" onClick="alertusecreditamount('.$item_user_id.','.$userid.')">Use Credit Amount </a></span>';
			 	}
			 }
			 
	   		if(isset($getgiftcardValue) && $total_price <= 0){
	   			$message = $message . "  " . '<button class="btn button'.$item_user_id.'" id="button-submit-merchant" '.$disable.' style="background:#3A83C0;color:#FFFFFF;text-shadow:none;font-size:15px;" onclick="giftcardusebuynow(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')">Buy Now</button>';
	   			
	   		}else{
		    	$message = $message . "  " . '<button style="background:#3A83C0;color:#FFFFFF;text-shadow:none;font-size:12px;" align="center" class="ui-btn" id="button-submit-merchant" '.$disable.' onclick="checkout(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')"">
		    	Checkout with Paypal</button>';
		    }
		    
		    if(isset($getcouponvalue) && !empty($getcouponvalue)){
		    	$message = $message . "  " . "<a data-ajax='false' href='".SITE_URL."mobile/cart' class='remove_item' style='color:#66b5d2;font-size:13px;text-decoration:none;' > Remove the Coupon discount amount </a>";
		    }
		    if(isset($getgiftcardValue)){
		    	$message = $message . "  " . "<a data-ajax='false' href='".SITE_URL."mobile/cart' class='remove_item' style='color:#66b5d2;font-size:13px;text-decoration:none;' > Remove the Giftcard discount amount </a>";
		    }
		    
		    if(isset($getgiftcardValue) && $total_price <= 0){
		    	//$message = $message . "  " . '<input type="button" class="btn button'.$item_user_id.'" id="button-submit-merchant" '.$disable.' value="Buy Now" onclick="giftcardusebuynow(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')"/>';
		    	$balanceGiftAmnt = (-1*$total_price) / $_SESSION['currency_value'];
		    	$balanceGiftAmnt = round($balanceGiftAmnt, 2);
		    	$message = $message . " <div style='font-size:12px;'>Note: After this order your gift card balance will be: <b>" .$balanceGiftAmnt."</b> USD amount";
		    }
		    
		    $message = $message . "  " . '<div class="adaptiveLoader'.$item_user_id.' checkoutloading" style="display:none;"><img src="'.SITE_URL.'images/loading.gif" alt"Processing......"></div>';
			if ($disable != '' && $soldOut == 0){
	    		$message = $message . "  " . "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product that cannot be Shipped to your Location or Give a Different Address to make a Checkout</div>";
	    		$disable = '';
	    	}else if ($disable != '' && $soldOut == 1){
	    		$message = $message . "  " . "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product which is sold out to make a Checkout</div>";
	    		$disable = '';
	    		$soldOut = 0;
	    	}
		  $message = $message . "  " . '</div>
		</div>';
		  
		   $message = $message . "  " . '<input type="hidden" id="totalitemcost'.$item_user_id.'" value="'.$item_price.'" /><input type="hidden" id="totalshipp'.$item_user_id.'" value="'.$shipping.'" />';
		  
		  
					
						$count = 1;
						$item_price = 0;
						$shipping = 0;
						$total_price = 0;
						$discount = 0;
						
			
			/* } else {$count ++;$message = $message . "  " . "</div>";
						
						}
					} */
			
					if($available_bal > 0){
						$available_bal = $available_bal;
					}else{ 
						$available_bal = 0;
					}
					
					$message = $message . "  " . '<div id="popup_container">
					<div id="add-to-list-new" data-role="popup" class="popup ly-title update add-to-list">
					<div class="default">
					<h3 class="ltit">Using Credit amount</h3>
					</div><div class="ui-body ui-body-a">
					<div class="fancyd-item">Your credit amount: '.$available_bal.'<br />Maximum credit you can use for this purchase : '.$commiItemTotalPrice.'<br />Enter amount:<input type="text" id="userentercreditamt" />
					<button id="usercreditamntchek" class="btn" style="background:#3A83C0;text-shadow:none;color:#FFFFFF;" onclick="usecreditamount('.$item_user_id.','.$userid.')">Save</button>
					</div>
					
					</div>
					</div>
					</div>';
					
					
					
		}else {
			$message = null;
			$output['url'] = SITE_URL;
			}
			$output[] = $message;
			$output[] = $total_itms;
			$output = json_encode($output);
			echo $output;
?>

