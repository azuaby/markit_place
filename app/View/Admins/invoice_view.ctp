	<?php
	
	$shippingAddress = '<b>'.$shippingModel['Shippingaddresses']['name']."</b>,</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['address1'].",</br>";
	if ($shippingModel['Shippingaddresses']['address2'] != '')
	$shippingAddress .= $shippingModel['Shippingaddresses']['address2'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['state'].",</br>";
	$shippingAddress .= $shippingModel['Shippingaddresses']['country'].",</br>";
	$shippingAddress .= "Phone no. :".$shippingModel['Shippingaddresses']['phone'];
	echo "<div id='userdata' style='margin-left:10px;' class='invoice_datas'>";
	echo '<span class="inv-print glyphicons print" style="padding: 0px; font-size: 11px;cursor:pointer;left:610px;top:13px;"></span>';
	echo '<button id="btn_close" class="btn btn-danger inv-close" style="width: 90px; margin: 14px 6px 0px; font-size: 11px;float:right;">Back</button>';
	//echo '<p class="inv-close glyphicons remove_2"></p>';
	echo "<h2 class='inv-head'>Order #".$invoiceModel['Invoices']['invoiceno']." on ".date('m/d/Y',$invoiceModel['Invoices']['invoicedate'])."</h2>";
	echo '<hr>';
	echo "<p class='pay-status'>Payment Method : ".$invoiceModel['Invoices']['paymentmethod']."</p>";
	echo "<p class='pay-status'>Payment Status : ".$invoiceModel['Invoices']['invoicestatus']."</p>";
	echo '<div class="inv-clear"></div>';
	echo '<hr>';
	echo '<span class="pay-status">Payment to</span></br>';
	echo '<span class="pay-to"><b>'.$sellerModel['Users']['first_name'].'</b></span></br>';
	echo '<span class="pay-status">Email : '.$sellerModel['Users']['email']."</span>";
	echo '<div class="inv-clear"></div>';
	echo '<hr>';
	echo '<div class="buyerdiv" style="height:auto;overflow:hidden;">';
	echo '<div class="buyerper" style="width:40%;float:left;">';
	echo '<span class="pay-status">Buyer Details</span></br>';
	echo '<span class="pay-to"><b>'.$userModel['Users']['first_name'].'</b></span></br>';
	echo '<span class="pay-status">Email : '.$userModel['Users']['email']."</span>";
	echo '</div>';
	echo '<div class="inv-shipping" style="width:40%;float:left;">';
	echo '<span class="pay-status">Shipping Address</span></br>';
	echo $shippingAddress;
	echo '</div>';
	echo '</div><hr>';
	
	echo '<div class="inv-clear"></div>';
	
	
	
	$totalprice = 0;
	$shipping = 0;
	$disCouunts = 0;
	echo "<table class='tablesorter table table-striped table-bordered table-condensed'> <thead>
			<th>Sl no.</th>
			<th>Item Name</th>
			<th>Item Quantity</th>
			<th>Item Unitprice</th>
			<th>Total Price</th>
			<th>Shipping fee</th></thead>";
	foreach($orderItemModel as $key => $orderItem) {
		$count = $key + 1;
		echo "<tr><td>".$count."</td>";
		echo "<td>".$orderItem['Order_items']['itemname']."</td>";
		echo "<td>".$orderItem['Order_items']['itemquantity']."</td>";
		echo "<td>".$orderItem['Order_items']['itemunitprice']."</td>";
		echo "<td>".$orderItem['Order_items']['itemprice']."</td>";
		echo "<td>".$orderItem['Order_items']['shippingprice']."</td></tr>";
		$totalprice = $totalprice + $orderItem['Order_items']['itemprice'];
		$shipping = $shipping + $orderItem['Order_items']['shippingprice'];
		$disCouunts = $disCouunts + $orderItem['Order_items']['discountAmount'];
		$discountType = $orderItem['Order_items']['discountType'];
		$tott = $totalprice;
		
	}
	echo  "</table>";
	
	 		/* if(!empty($getcouponvalue)){
			 	if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
			 		$discount = $getcouponvalue['Coupon']['discount_amount'];
			 		$discount = $totalprice * ($discount / 100);
			 		$totalprice -= $discount;
			 		
			 	}
			 	if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
			 		$discount = $getcouponvalue['Coupon']['discount_amount'];
			 		$totalprice = $totalprice - $discount;
			 		
			 	}
			 
			 } */
	
	
	$gtotal = $tott + $shipping;
	
	//$orderCurrency = $orderDetails['Orders']['currency'];
	
	echo '<div class="inv-tot" style="float:right;">';
	echo "<p class='gtotal'>Item Total: ".$tott." ".$orderCurrency."</p>";
	/* if(!empty($getcouponvalue)){
		echo "<p class='gtotal'>Coupon Discount: $".$discount."</p>";
	} */
	if(!empty($disCouunts)){
		echo "<p class='gtotal'> ".$discountType.": ".$disCouunts." ".$orderCurrency."</p>";
		$gtotal -=$disCouunts; 
	}
	echo "<p class='gtotal'>Shipping Fee: ".$shipping." ".$orderCurrency."</p>";
	echo "<p class='gtotal'>Grand Total: ".$gtotal." ".$orderCurrency."</p>";
	echo "</div></div>";
