<?php if($total_itms > 0) { ?>
	<table>
		<thead>
			<th>Description</th>
			<th>Qty</th>
			<th style="padding-left:10px;">Price</th>
		</thead>
		<tbody>		
		<?php
		if(!empty($giftcarduseradded)){
			foreach ($giftcarduseradded as $giftcart){
				$gift_title = $giftcarditemDetails['title'];
				$gift_image = $giftcarditemDetails['image'];
		?>
			<tr>
				<td class="tdfirst">
					<img src="<?php echo SITE_URL; ?>media/items/thumb70/<?php echo $gift_image;?>">
					<div class="item-title"><a href="<?php echo SITE_URL; ?>create/giftcard"><?php echo $gift_title; ?><br/><?php echo $giftcart['Giftcard']['reciptent_name'];?></a></div>
				</td>
				<td>
					<span class="cart-drop-qty"><?php echo '1';?></span>
				</td>
				<td>
					<span class="price"><?php echo $_SESSION['default_currency_symbol'].$giftcart['Giftcard']['amount'];?></span>
				</td>
			</tr>
		<?php } } ?>
		<?php
		if(isset($cartModel)){
			foreach ($cartModel as $cart){

		?>
		<tr>
			<td class="tdfirst">
				<img src="<?php echo SITE_URL; ?>media/items/thumb70/<?php echo $cart['image'];?>">
				<div class="item-title"><a href="<?php echo SITE_URL."listing/".$cart['itemid']."/".$cart['titleurl']; ?>" ><?php echo $cart['title']; ?></a></div>
			</td>
			<td>
				<span class="cart-drop-qty"><?php echo $cart['quantity'];?></span>
			</td>
			<td>
				<span class="price"><?php echo $_SESSION['currency_symbol']; echo round($cart['price'] * $_SESSION['currency_value'], 2);?></span>
			</td>
		</tr>
		<?php } } ?>	
		</tbody>
	</table>
<div class="cart-proceed"><a href="<?php echo SITE_URL; ?>cart">Proceed to Checkout</a></div>
<?php }else{ ?>
<div class="cart-empty">Cart Empty</div>
<?php } ?>
