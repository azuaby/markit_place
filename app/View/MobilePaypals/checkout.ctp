<?php 
 if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
 	echo $this->Form->create('frmPayPal1', array('url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal'));
 }elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
 	echo $this->Form->create('frmPayPal1', array('url' => 'https://www.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal')); 
 } 	
?>
 <?php //echo $this->Form->create('frmPayPal1', array('url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal')); ?>
 <?php //echo $this->Form->create('frmPayPal1', array('url' => 'https://www.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal')); ?>
 
  <?php 
 	if(!empty($getcouponvalue)){
		$coupon_id = $getcouponvalue['Coupon']['id'];
	}else{
		$coupon_id = 0;
	}
	
	if(!empty($getgiftcardValue)){
		$giftCardId = $getgiftcardValue['Giftcard']['id'];
	}else{
		$giftCardId = 0;
	}
	
	if(!empty($userEnterCreditAmt)){
		$userEnterCreditAmt = $userEnterCreditAmt;
	}else{
		$userEnterCreditAmt = 0;
	}
 ?>
 
 <!--input type="hidden" name="business" value="<?php echo $shopModel['Shop']['paypal_id']; ?>"/ -->
  <input type="hidden" name="business" value="<?php echo $setngs[0]['Sitesetting']['paypal_id']; ?>"/>
			<input type="hidden" name="cmd" value="_cart" /> 
<input type="hidden" name="upload" value="1">
			<input type="hidden" name="no_note" value="1" />
			<input type="hidden" name="lc" value="UK" />
			<input type="hidden" name="currency_code" value="<?php echo $_SESSION['currency_code']; ?>" />
			<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
			<input type="hidden" name="first_name" value="<?php echo $itm_datas[0]['User']['first_name']; ?>"  />
			<input type="hidden" name="last_name" value="<?php echo $itm_datas[0]['User']['last_name']; ?>"  />
			<?php foreach($itm_datas as $key => $itm){
			$count = $key + 1;
			
			$sizeoption[$itm['Item']['id']] = $size_options[$key];
			$price = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			$shipping = $shipamt[$key];// * $_SESSION['currency_value'];
			
			//echo $this->Form->input('rm', array('type' => 'hidden','name'=>'rm', 'value'=>'2','id'=>'toc1_'.$itm['Item']['id']));
			echo $this->Form->input('item_name', array('type' => 'hidden','name'=>'item_name_'.$count, 'value'=>$itm['Item']['item_title'],'id'=>'item_name'.$itm['Item']['id']));
			echo $this->Form->input('quantity', array('type' => 'hidden','name'=>'quantity_'.$count,'value'=>$quantity[$itm['Item']['id']],'id'=>'quantity_'.$itm['Item']['id']));
			//echo $this->Form->input('length', array('type' => 'hidden','name'=>'length_'.$count,'value'=>$itm['Item']['user_id'],'id'=>'length_'.$itm['Item']['id']));
			echo $this->Form->input('item_number', array('type' => 'hidden','name'=>'item_number_'.$count, 'value'=>$itm['Item']['id'],'id'=>'item_number_'.$itm['Item']['id']));
			echo $this->Form->input('shipping', array('type' => 'hidden','name'=>'shipping_'.$count, 'value'=>$shipping,'id'=>'shipping_'.$itm['Item']['id']));
			echo "<input type='hidden' class='price' name='amount_".$count."' value='".$price."' id='price_".$price."'>";
			//echo $this->Form->input('discount_amount', array('type' => 'hidden','name'=>'discount_amount', 'value'=>'2'));
			//echo '<input type="hidden" name="discount_amount_cart"  value="'.$discount.'">';
			//echo '<input type="hidden" name="discount_rate_cart"  value="'.$discount.'">';
			//echo "<input type='hidden' name='on".$key."' value='".$size_options[$key]."' id='on".$key."'>";
	
			
			
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
			
			
			
		}
	
	$sizeoption = json_encode($sizeoption);
			//$sizeoptions = json_encode($sizeoption);
			//echo $sizeoption;die;
			
			echo "<input type='hidden' name='custom' value='".$useremail."-_-".$shippingid."-_-".$coupon_id."-_-".$userEnterCreditAmt."-_-".$giftCardId."-_-".$sizeoption."-_-".$commiItemTotalPrice."'  />";
	
	if(isset($getgiftcardValue)){
		echo '<input type="hidden" name="discount_amount_cart"  value="'.round($getgiftcardValue['Giftcard']['avail_amount'] * $_SESSION['currency_value'], 2).'">';
	
	}
	if(!empty($userEnterCreditAmt)){
		echo '<input type="hidden" name="discount_amount_cart"  value="'.$userEnterCreditAmt.'">';
	}
	
		
	if(isset($getcouponvalue)){
		if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
			$discount = $getcouponvalue['Coupon']['discount_amount'];
			echo '<input type="hidden" name="discount_rate_cart"  value="'.$discount.'">';
			//echo '<input type="hidden" name="discount_rate_cart"  value="10">';
				
		}
		if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
			$discount = $getcouponvalue['Coupon']['discount_amount'];
			//echo '<input type="hidden" name="discount_amount_cart"  value="5">';
			echo '<input type="hidden" name="discount_amount_cart"  value="'.$discount.'">';
				
	
		}
			
	}
			
	
		echo $this->Form->input('cancel_return', array('type' => 'hidden','name'=>'cancel_return', 'value'=>''.SITE_URL.'mobile/payment-cancelled','id'=>'toc'));
		echo $this->Form->input('return', array('type' => 'hidden','name'=>'return', 'value'=>''.SITE_URL.'mobile/payment-successful','id'=>'toc'));?>
			
 			<input type="hidden" name="notify_url" value="<?php echo SITE_URL.'mobile/paypal/ipnprocess/'; ?>"/>
 			<!-- <input type="hidden" name="notify_url" value="http://dev.hitasoft.com/new/success.php"/> -->
			<!--<input type="submit" class="btn btn-success ckout" value="Checkout with Paypal"/>   http://dev.hitasoft.com/test/executeIpn.php-->
		</form> 
