<?php if($total_itms > 0) { ?>
	<table>
		<thead>
			
			<th style="text-align: center; padding:0px 0px 0px 22px;" class="desc"><?php echo __('Description');?></th>
			<th class="qty" style="padding:0px 0px 0px 2px;"><?php echo __('Qty');?></th>
			<th class="price" style="padding:0px 0px 0px 10px;"><?php echo __('Price');?></th>
		</thead>
		<tbody>		
		<?php
		if(!empty($giftcarduseradded)){
			foreach ($giftcarduseradded as $giftcart){
				$gift_title = $giftcarditemDetails['title'];
				$gift_image = $giftcarditemDetails['image'];
		?>
			<tr>
				<td class="tdfirst" style="padding:10px;">
					<img src="<?php echo SITE_URL; ?>media/items/thumb70/<?php echo $gift_image;?>">
					<div class="item-title"><a href="<?php echo SITE_URL; ?>create/giftcard"><?php echo $gift_title; ?><br/><?php echo $giftcart['Giftcard']['reciptent_name'];?></a></div>
				</td>
				<td>
					<span class="cart-drop-qty"><?php echo '1';?></span>
				</td>
				<td>
					<span  class="price"><?php echo $_SESSION['default_currency_symbol'].$giftcart['Giftcard']['amount'];?></span>
				</td>
			</tr>
		<?php } } ?>
		<?php
		if(isset($cartModel)){
			foreach ($cartModel as $cart){

		?>
		<tr>
			<td class="tdfirst">
				<!-- <img src="<?php echo SITE_URL; ?>media/items/thumb70/<?php echo $cart['image'];?>"> -->
				  <?php 
			echo "<div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb70/".$cart['image']."');  background-position: 50% center; background-repeat: no-repeat; background-size: cover; height: 70px; width: 70px; margin-top:4px; display: inline-block;\"></div>"; 
				?>
				<a style="color: #595959; float: right; font-size: 12px; line-height: 16px; margin-left:11px; margin-top: 4px;    padding: 0; width: 110px;" href="<?php echo SITE_URL."listing/".$cart['itemid']."/".$cart['titleurl']; ?>" ><?php echo $cart['title']; ?></a>
			</td>
			<td>
				<span class="cart-drop-qty"><?php echo $cart['quantity'];?></span>
			</td>
			<td >
				<span style="float:left; padding:0px 0px 0px 27px;"  class="price"><?php echo $_SESSION['currency_symbol']; echo round($cart['price'] * $_SESSION['currency_value'], 2);?></span>
			</td>
		</tr>
		<?php } } ?>	
		</tbody>
	</table>
<div class="cart-proceed"><a href="<?php echo SITE_URL; ?>cart"><?php echo __('Proceed to Checkout');?></a></div>
<?php }else{ ?>
<div class="cart-empty"><?php echo __('Cart Empty');?></div>
<?php } ?>
