<?php 
 if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
 	echo $this->Form->create('frmPayPal1', array('url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal'));
 }elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
 	echo $this->Form->create('frmPayPal1', array('url' => 'https://www.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal')); 
 } 	
?>
 <?php //echo $this->Form->create('frmPayPal1', array('url' => 'https://www.paypal.com/cgi-bin/webscr','type' => 'post','id'=>'paypal')); ?>
 
 <!--input type="hidden" name="business" value="<?php echo $shopModel['Shop']['paypal_id']; ?>"/ -->
  <input type="hidden" name="business" value="<?php echo $mercahnt_email; ?>"/>
			<input type="hidden" name="cmd" value="_xclick" /> 
<input type="hidden" name="upload" value="1">
			<input type="hidden" name="no_note" value="1" />
			<input type="hidden" name="lc" value="UK" />
			<input type="hidden" name="currency_code" value="<?php echo $currency; ?>" />
			<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
			<input type="hidden" name="first_name" value="<?php echo $merchname; ?>"  />
			<?php
			echo '<input type="hidden" class="price" name="amount" value="'.$price.'" id="price">';
			echo $this->Form->input('item_name', array('type' => 'hidden','name'=>'item_name', 'value'=>'Amount pay to merchant','id'=>'item_name'));
			
			echo $this->Form->input('cancel_return', array('type' => 'hidden','name'=>'cancel_return', 'value'=>''.SITE_URL.'payment-cancelled','id'=>'toc'));
			echo $this->Form->input('item_number', array('type' => 'hidden','name'=>'item_number', 'value'=>$orderid, 'id'=>'item_number'));
			echo $this->Form->input('return', array('type' => 'hidden','name'=>'return', 'value'=>''.SITE_URL.'payadminurl','id'=>'toc'));?>
			
 			<!--input type="hidden" name="notify_url" value="<?php echo SITE_URL.'paypal/ipnprocess/'; ?>"/>
			<input type="submit" class="btn btn-success ckout" value="Checkout with Paypal"/>-->
		</form> 
