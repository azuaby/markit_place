
		<?php
	
	$shippingAddress = $shippingModel['Shippingaddresses']['name'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['address1'].",</br>";
	if ($shippingModel['Shippingaddresses']['address2'] != '')
	$shippingAddress .= $shippingModel['Shippingaddresses']['address2'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['state'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['country'].",</br>";
	$shippingAddress .= "Phone no. :".$shippingModel['Shippingaddresses']['phone'];
	echo "<div class='invoicetitletab'>
			<div class='invoiccetitlehead'>"?><?php echo __('Invoice');echo "</div>
			<div class='invoicetitleaction'>";
	echo '<p class="inv-print glyphicons print" style="padding: 0px; font-size: 11px;"></p>';
	echo '<p class="inv-close glyphicons remove_2"></p>';
	
	echo "</div></div>";
	echo "<div id='userdata' style='margin-left:10px;'>";
	//echo '<button class="btn btn-danger inv-close" style="width: 90px; margin: 14px 6px 0px; font-size: 11px;float:right;">Back</button>';
	echo "<h2 class='inv-head' style='background: #EFEFEF; font-size: 18px; padding: 6px 10px;'>"?>
			<?php echo __('Order');echo " #".$invoiceModel['Invoices']['invoiceno']." "?><?php echo __('on');echo " ".date('m/d/Y',$invoiceModel['Invoices']['invoicedate'])."</h2>";
	echo "<p class='pay-status' style='color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;'>"?><?php echo __('Payment Method');echo " : ".$invoiceModel['Invoices']['paymentmethod']."</p>";
	echo "<p class='pay-status' style='color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;'>"?><?php echo __('Payment Status');echo " : ".$invoiceModel['Invoices']['invoicestatus']."</p>";
	echo '<div class="inv-clear" style="border-bottom: 1px solid #DEDEDE; margin-bottom: 14px; padding-top: 14px;"></div>';
	
	echo '<span class="pay-status"  style="color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;">'?><?php echo __('Payment to');echo '</span></br>';
	echo '<span class="pay-to" style="font-size: 14px; font-weight: bold;">'.$sellerModel['Users']['first_name'].'</span></br>';
	echo '<span class="pay-status"  style="color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;">'?><?php echo __('Email');echo ' : '.$sellerModel['Users']['email']."</span>";
	echo '<div class="inv-clear" style="border-bottom: 1px solid #DEDEDE; margin-bottom: 14px; padding-top: 14px;"></div>';
	
	echo '<div class="buyerdiv">';
	echo '<div class="buyerper" style="display: inline-block; float: left; width: 50%;">';
	echo '<span class="pay-status"  style="color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;">'?><?php echo __('Buyer Details');echo '</span></br>';
	echo '<span class="pay-to" style="font-size: 14px; font-weight: bold;">'.$userModel['Users']['first_name'].'</span></br>';
	echo '<span class="pay-status"  style="color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;">'?><?php echo __('Email');echo ' : '.$userModel['Users']['email']."</span>";
	echo '</div>';
	echo '<div class="inv-shipping" style="display: inline-block; width: 50%;">';
	echo '<span class="pay-status"  style="color: #8D8D8D; font-size: 12px; margin-bottom: 0px; margin-top: 12px;">'?><?php echo __('Shipping Address');echo '</span></br>';
	echo $shippingAddress;
	echo '</div>';
	echo '</div>';
	echo '<div class="inv-clear" style="border-bottom: 1px solid #DEDEDE; margin-bottom: 14px; padding-top: 14px;"></div>';
	
	
	
	$totalprice = 0;
	$shipping = 0;
	echo "<table class='Item-details'> <thead style='background-color: #D3D3D3; color: #4D4D4D;'>
			<th style='font-size: 14px;'>"?><?php echo __('Sl no');echo ".</th>
			<th style='font-size: 14px;'>"?><?php echo __('Item Name');echo "</th>
			<th style='font-size: 14px;'>"?><?php echo __('Item Quantity');echo "</th>
			<th style='font-size: 14px;'>"?><?php echo __('Item Unitprice');echo "</th>
			<th style='font-size: 14px;'>"?><?php echo __('Total Price');echo "</th>
			<th style='font-size: 14px;'>"?><?php echo __('Shipping fee');echo "</th></thead>";
	foreach($orderItemModel as $key => $orderItem) {
		$count = $key + 1;
		echo "<tr><td style='font-size: 14px; padding: 6px ; width: 145px;text-align:center;'>".$count."</td>";
		echo "<td style='font-size: 14px; padding: 6px; width: 145px;text-align:center;'>".$orderItem['Order_items']['itemname']."</td>";
		echo "<td style='font-size: 14px; padding: 6px; width: 145px;text-align:center;'>".$orderItem['Order_items']['itemquantity']."</td>";
		echo "<td style='font-size: 14px; padding: 6px; width: 145px;text-align:center;'>".$orderItem['Order_items']['itemunitprice']."</td>";
		echo "<td style='font-size: 14px; padding: 6px; width: 145px;text-align:center;'>".$orderItem['Order_items']['itemprice']."</td>";
		echo "<td style='font-size: 14px; padding: 6px; width: 145px;text-align:center;'>".$orderItem['Order_items']['shippingprice']."</td></tr>";
		$totalprice = $totalprice + $orderItem['Order_items']['itemprice'];
		$shipping = $shipping + $orderItem['Order_items']['shippingprice'];
		$tott = $totalprice + $shipping;
	}
	echo  "</table>";
	
	 		if(!empty($getcouponvalue)){
			 	if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
			 		$discount = $getcouponvalue['Coupon']['discount_amount'];
			 		$discount = $totalprice * ($discount / 100);
			 		$totalprice -= $discount;
			 		
			 	}
			 	if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
			 		$discount = $getcouponvalue['Coupon']['discount_amount'];
			 		$totalprice = $totalprice - $discount;
			 		
			 	}
			 
			 }
	
	
	$gtotal = $totalprice + $shipping;
	
	
	
	echo '<div class="inv-tot" style="text-align:right;">';
	echo "<p class='gtotal'>"?><?php echo __('Item Total');echo " : ".$totalprice." ".$currencyCode."</p>";
	if(!empty($getcouponvalue)){
		echo "<p class='gtotal'>"?><?php echo __('Coupon Discount');echo ": ".$discount." ".$currencyCode."</p>";
	}
	if(!empty($discount_amount)){
		echo "<p class='gtotal'>"?><?php echo __('Credit Discount');echo ": ".$discount_amount." ".$currencyCode."</p>";
		$gtotal -=$discount_amount; 
	}
	echo "<p class='gtotal'>"?><?php echo __('Shipping Fee');echo ": ".$shipping." ".$currencyCode."</p>";
	echo "<p class='gtotal'>"?><?php echo __('Grand Total');echo ": ".$gtotal." ".$currencyCode."</p>";
	echo "</div></div>";
	
	