<?php
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
		echo "<div class='container' style='width:940px;'>";
		echo "<div class='wrapper-content order'>";
		echo "<div id='content'>";
		echo "<div class='cart-list' style='padding:0px 20px;width:900px;'>";
		echo "<h2 class='totalYouHave'>"?><?php echo __('You have');echo " ".$total_itms." "?><?php echo __('Items in your Cart'); echo"</h2>";
		//echo "<pre>";print_r($itm_datas);die;
		$count = 1;
		$item_price = 0;
		$item_price2 = 0;
		$shipping = 0;
		$total_price = 0;
		$item_id = array();
		$item_id2 = array();
				
		echo '<span id="gfremoved" style="display:none;color:#00FF00;">';echo __('Item removed successfully');echo '</span>';

		if(!empty($giftcarduseradded)){
			foreach($giftcarduseradded as $ke=>$itm){
				$gift_title = $giftcarditemDetails['title'];
				$gift_image = $giftcarditemDetails['image'];
				if ($count == 1) {
					echo '<div id="giftcartids'.$itm['Giftcard']['id'].'">';
					echo '<p class="cart-list-from">';
					echo '<div class="cart-payment-wrap cart-note">
					<span class="cart-payment-top"><b></b></span>
					<div class="table-cart-wrap">
					<table class="table-cart">
					<thead>
					<tr>
					<th colspan="2" class="product">';echo __('Product');echo '</th>
					<th>';//echo __('Price'); 
					echo '</th>
					<th>';//echo __('Quantity'); 
					echo '</th>
					<th>';echo __('Total'); echo '</th>
					</tr>
					</thead>
					<tbody>';
				}
				echo '<tr class="first">
				<td rowspan="2" class="thumnail">';
				echo "<a href='".SITE_URL."create/giftcard/'>
					<img src='".$_SESSION['media_url']."media/items/thumb150/".$gift_image."' />
					</a>";
				echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removegiftcart(".$itm['Giftcard']['id'].")'> " ?><?php echo __('Remove'); echo "</a>
				</td>
				<td class='title'>";
				echo $this->Html->link($gift_title,array('controller'=>'/','action'=>'create/giftcard/'))."<br />";
				echo "</td>";
				echo '<td class="price">';//.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].
				echo '</td>';
				echo '<td class="quantity" style="padding-top:12px;font-size:12px;">';
				//echo '1';
				echo '</td><td class="total">'.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].'</td>
				</tr>
				<tr>
				<td class="optional" colspan="4">
				<span>
				</span>';
				?>
			    <ul class='optional-list'>
				    <li><span class='option-tit'><?php echo __('Name');?>: </span>
					    <span class='option-txt'>
						    <?php echo $itm['Giftcard']['reciptent_name']; ?>
					    </span>
				    </li>
	                <li>
	                	<span class='option-tit'><?php echo __('Email');?>: </span>
					    <span class='option-txt'>
						    <?php echo $itm['Giftcard']['reciptent_email']; ?>
					    </span>
				    </li>
				    <li>
					    <span class='option-tit'><?php echo __('Message');?>: </span>
					
					    <div class='option-txt' style="word-wrap: break-word; height:43px; text-overflow:ellipsis; overflow:hidden; width:330px;">
						    <?php echo $itm['Giftcard']['message']; ?>
					    </div>
				    </li>
                </ul>
			    </td> 
			    </tr>
			    <?php 
				echo '</tbody></table></div>';
				echo '<div class="cart-payment" id="merchant-cart-payment">
				<span class="bg-cart-payment"></span>';
				echo '<dl class="cart-payment-order">
				<dt>';echo __('Order');echo '</dt>
				<dd>
				<ul>';
				echo '<li class="first">
				<span class="order-payment-type">';echo __('Item total');echo '</span>
				<span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].'</b> '.$_SESSION['default_currency_code'].'</span>
				</li>';
				echo '<li>
				<span class="order-payment-type">';echo __('Shipping'); echo '</span>
				<span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$shipping.'</b> '.$_SESSION['default_currency_code'].'</span>
				</li>';
				echo '<li>
				<span class="order-payment-type">';echo __('Discount');echo '</span>
				<span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].'0</b> '.$_SESSION['default_currency_code'].'</span>
				</li>';
				echo '<li class="total"  id = "Creditamnt_totals">
				<div class="coup_one" >
				<span class="order-payment-type"><b>';echo __('Total'); echo '</b></span>
				<span class="order-payment-usd"><b>'.$_SESSION['default_currency_symbol'].$itm['Giftcard']['amount'].'</b> '.$_SESSION['default_currency_code'].'</span>
				</div>
				</li>
				</ul>
				</dd>';
				echo '</dl>'; ?>
				<input type="button" class="btn button<?php echo $itm['Giftcard']['id']; ?>" id="button-submit-merchant"  value="Checkout with Paypal" onclick="giftcardcheckout('<?php echo $itm['Giftcard']['id']; ?>')"/>
		    	<div class="PLoader<?php echo $itm['Giftcard']['id']; ?> checkoutloading"><img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Processing......"></div>
				</div>
				</div>
				</div>
				<?php	
			}
		}
		$item_id = array();
		$shipping_amt = array();
		//echo '<div id="shop'.$itm['Shop']['id'].'">';
		if (!empty($itm_datas)){
			echo '<div id="shop">';
			echo '<p class="cart-list-from">';
			//echo __('Order from');
			//echo '<b> <a href = "'.SITE_URL.'people/'.$itm['User']['username_url'].'">
			//Merchant '.SITE_NAME.'</a> </b> </p>';
			//echo ' <b> '.SITE_NAME.'</b> </p>';
			echo '<div class="cart-payment-wrap cart-note">
			<span class="cart-payment-top"><b></b></span>
			<div class="table-cart-wrap">
			<table class="table-cart">
			<thead>
			<tr>
			<th colspan="2" class="product">'?><?php echo __('Product'); echo '</th>
			<th>';echo __('Price'); echo '</th>
			<th>';echo __('Quantity'); echo '</th>
			<th>';echo __('Total'); echo '</th>
			</tr>
			</thead>
			<tbody>';
			foreach($itm_datas as $ke=>$itm){
			    if($itm['Item']['delivery_type'] == 'regular'){
				//if ($count == 1) {
				$item_user_id = $itm['User']['id'];
				$item_id[] = $itm['Item']['id'];
				echo '<tr class="first">
				<td rowspan="2" class="thumnail">';
				echo "<a href='".SITE_URL."listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>
				<div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
				</a>";
				//<img src='".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."' />
				//</a>";
			   ////echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>";
				echo "</td>
				<td class='title'>";
				
				$titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
				echo $this->Html->link($titttle,array('controller'=>'/','action'=>'/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
				echo "</td>";
				$unitPriceConvert = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
				echo '<td class="price">'.$_SESSION['currency_symbol'].$unitPriceConvert.'</td>';
				echo '<td class="quantity" style="padding-top:12px;font-size:13px;">';
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
						echo '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;" >';
						echo "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
						$selected = '';
						for($i=1;$i<=$sizeQty;$i++){
							if ($quantity[$itm['Item']['id']] == $i) {
								$selectedquan = $i;
								$selected = 'selected';
							}
							echo "<option ".$selected." value='".$i."'>".$i."</option>";
							$selected = '';
						}
						echo "</select><div class='out' >".$selectedquan."</div>";
						echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
						echo "</div>";
					}else{
						echo "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
						$disable = "disabled";
						$soldOut = 1;
					}
				}else{
				    if ($itm['Item']['quantity'] > 0){
					    echo '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;" >';
					    echo "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
					    $selected = '';
					    for($i=1;$i<=$itm['Item']['quantity'];$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selectedquan = $i;
							    $selected = 'selected';
						    }
						    echo "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    echo "</select><div class='out' >".$selectedquan."</div>";
					    echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
					    echo "</div>";
				    }else{
					    echo "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }
			}
			/* } else {
				echo $quantity[$itm['Item']['id']];
			} */
			if($itm['Item']['delivery_type'] == 'regular'){
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
		    //echo "<pre>";print_r($commiItemTotalPrice);
	            echo '</td><td class="total">'.$_SESSION['currency_symbol'].$item_total.'</td>
                </tr>
                <tr>
                <td class="optional" colspan="4">
                <span>
                </span>';
	            $process_time =  $itm['Item']['processing_time'];
	            ?>
			    <ul class='optional-list'>
	            <!--li><span class='option-tit'>Option:</span>
		        <span class='option-txt'>	</span></li-->
			    <?php 
			    if (!empty($size[$itm['Item']['id']])){ ?>
				    <li>
				    <span class='option-tit' style ="padding:13px 0px 7px 0px;">Size: <?php echo $size[$itm['Item']['id']]; ?></span>
				    </li>
				    <?php 
			    }else{ ?>
				    <li>
				    <span class='option-tit' style ="padding:13px 0px 7px 0px;"><?php echo __('Size');?>: N/A</span>
				    </li>	
				    <?php 
			    } ?>
			    <li>
			    <span class='option-tit' style='position: relative; bottom: 10px;' ><?php echo __('Shipping');?>:</span>
			    <span class='option-txt'  style='position: relative; bottom: 10px;' >
			    <?php
			    if (isset($shpngs[$shipping_method_id]) || isset($shpngs[0])) {
				    if($process_time == '1d'){
					    echo __('One business day');
	                }elseif($process_time == '2d'){
		                echo __('Two business days');
	                }elseif($process_time == '3d'){
		                echo __('Three business days');
	                }elseif($process_time == '4d'){
		                echo __('Four business days');
	                }elseif($process_time == '2ww'){
		                echo __('One-Two weeks');
	                }elseif($process_time == '3w'){
		                echo __('Two-Three weeks');
	                }elseif($process_time == '4w'){
		                echo __('Three-Four weeks');
	                }elseif($process_time == '6w'){
		                echo __('Four-Six weeks');
	                }elseif($process_time == '8w'){
		                echo __('Six-Eight weeks');
	                }
                }else {
	                echo "<div style='color:red;'>";echo __('Cannot Ship this Product to your Location');echo "</div>";
                }
                ?></span>
                </li>
                <li>
	            <span class='option-tit' style='position: relative; bottom: 12px;'><?php echo __('Seller');?>:</span>
	            <?php
	            echo '<a href="'.SITE_URL.'people/'.$itm['User']['username_url'].'" class="add_addr" style="position: relative; bottom: 12px;">';echo $itm['User']['username']; echo '</a>';
	            ?>
			    </li>    
                <li>
			    <?php  echo "<a href='#' class='remove_item ' style='position: relative; bottom: 15px;' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>"; ?>
			    </li>
			    </ul>    
		        </td>
	            </tr>
	            <?php 
            }
        }
        //if ($itm_group[$itm['Item']['shop_id']] == $count) {
        
        foreach($itm_datas as $ke=>$itm){
			    if($itm['Item']['delivery_type'] !== 'regular'){
			        $count_ids = 1;
			    }
        }
        
 		echo '</tbody></table>';?>
        <?php
        
		echo '<table class="table-cart">';
		if($count_ids == 1){
		    echo'<thead>
			    <tr>
			    <th colspan="2" class="product">'?><?php echo __('Special Delivery Pending Orders*'); echo '</th>
			    </tr>
			    </thead>';
		}
		echo'<tbody>';
			foreach($itm_datas as $ke=>$itm){
			    if($itm['Item']['delivery_type'] !== 'regular'){
				    //if ($count == 1) {
				    $item_user_id = $itm['User']['id'];
				    foreach($car_spl_ids as $cart_spl_id){
				        if($cart_spl_id['Cart']['item_id'] == $itm['Item']['id'] && $cart_spl_id['Cart']['shipping_status'] !== 'disable'){
						    $item_id[] = $itm['Item']['id'];
				        }
				    }
				    echo '<tr class="first">
				    <td rowspan="2" class="thumnail">';
				    echo "<a href='".SITE_URL."listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>
				    <div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
				    </a>";
				    //<img src='".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."' />
				    //</a>";
			       ////echo "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>";
				    echo "</td>
				    <td class='title'>";
				
				    $titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
				    echo $this->Html->link($titttle,array('controller'=>'/','action'=>'/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
				    echo "</td>";
				    $unitPriceConvert = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
				    echo '<td class="price">'.$_SESSION['currency_symbol'].$unitPriceConvert.'</td>';
				    echo '<td class="quantity" style="padding-top:12px;font-size:13px;">';
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
						    echo '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;" >';
						    echo "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
						    $selected = '';
						    for($i=1;$i<=$sizeQty;$i++){
							    if ($quantity[$itm['Item']['id']] == $i) {
								    $selectedquan = $i;
								    $selected = 'selected';
							    }
							    echo "<option ".$selected." value='".$i."'>".$i."</option>";
							    $selected = '';
						    }
						    echo "</select><div class='out' >".$selectedquan."</div>";
						    echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
						    echo "</div>";
					    }else{
						    echo "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
						    $disable = "disabled";
						    $soldOut = 1;
					    }
				    }else{
				    if ($itm['Item']['quantity'] > 0){
					    echo '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;" >';
					    echo "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
					    $selected = '';
					    for($i=1;$i<=$itm['Item']['quantity'];$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selectedquan = $i;
							    $selected = 'selected';
						    }
						    echo "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    echo "</select><div class='out' >".$selectedquan."</div>";
					    echo "<img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
					    echo "</div>";
				    }else{
					    echo "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }
			}
			/* } else {
				echo $quantity[$itm['Item']['id']];
			} */
			if($itm['Item']['delivery_type'] !== 'regular'){
			    $shpngs = '';
			    foreach($itm['Shiping'] as $shpng){
				    $shpngs[$shpng['country_id']] = round($shpng['primary_cost'] * $_SESSION['currency_value'], 2);
			    }
			    $item_total = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			    if ($quantity[$itm['Item']['id']] != 1) {
				    $item_total = $item_total * $quantity[$itm['Item']['id']];
			    }	
			    $item_price2 = $item_price2 + $item_total;
			    //print_r($shpngs);
			    if (isset($shpngs[$shipping_method_id])) {	
			        $shipping = $shipping + $shpngs[$shipping_method_id];
			        $shipping_amt[] = $shpngs[$shipping_method_id];
/*			        $total_price = $total_price + $item_total + $shpngs[$shipping_method_id];*/
		        }else if(isset($shpngs[0])){
			        $shipping = $shipping + $shpngs[0];
			        $shipping_amt[] = $shpngs[0];
/*			        $total_price = $total_price + $item_total + $shpngs[0];*/
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
		    //echo "<pre>";print_r($commiItemTotalPrice);
	            echo '</td><td class="total">'.$_SESSION['currency_symbol'].$item_total.'</td>

                </tr>
                <tr>
                <td class="optional" colspan="4">
                <span>

                </span>';
	            $process_time =  $itm['Item']['processing_time'];
	            ?>
			    <ul class='optional-list'>
	            <!--li><span class='option-tit'>Option:</span>

		        <span class='option-txt'>	</span></li-->
			    <?php 
			    if (!empty($size[$itm['Item']['id']])){ ?>
				    <li>
				    <span class='option-tit' style ="padding:13px 0px 7px 0px;">Size: <?php echo $size[$itm['Item']['id']]; ?></span>
				    </li>
				    <?php 
			    }else{ ?>
				    <li>
				    <span class='option-tit' style ="padding:13px 0px 7px 0px;"><?php echo __('Size');?>: N/A</span>
				    </li>	
				    <?php 
			    } ?>
			    <li>
			    <span class='option-tit' style='position: relative; bottom: 10px;' ><?php echo __('Shipping');?>:</span>
			    <span class='option-txt'  style='position: relative; bottom: 10px;' >
			    <?php
			    if (isset($shpngs[$shipping_method_id]) || isset($shpngs[0])) {
				    if($process_time == '1d'){
					    echo __('One business day');
	                }elseif($process_time == '2d'){
		                echo __('Two business days');
	                }elseif($process_time == '3d'){
		                echo __('Three business days');
	                }elseif($process_time == '4d'){
		                echo __('Four business days');
	                }elseif($process_time == '2ww'){
		                echo __('One-Two weeks');
	                }elseif($process_time == '3w'){
		                echo __('Two-Three weeks');
	                }elseif($process_time == '4w'){
		                echo __('Three-Four weeks');
	                }elseif($process_time == '6w'){
		                echo __('Four-Six weeks');
	                }elseif($process_time == '8w'){
		                echo __('Six-Eight weeks');
	                }
                }else {
	                echo "<div style='color:red;'>";echo __('Cannot Ship this Product to your Location');echo "</div>";
                }
                ?></span>
                </li>
                <li>
	            <span class='option-tit' style='position: relative; bottom: 12px;'><?php echo __('Seller');?>:</span>
	            <?php
	            echo '<a href="'.SITE_URL.'people/'.$itm['User']['username_url'].'" class="add_addr" style="position: relative; bottom: 12px;">';echo $itm['User']['username']; echo '</a>';
	            ?>
			    </li>    
                <li>
			    <?php  echo "<a href='#' class='remove_item ' style='position: relative; bottom: 15px;' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> ";echo __('Remove'); echo "</a>"; ?>
			    </li>
			    </ul>    
		        </td>
	            </tr>
	            <?php 
            }
        }
        //if ($itm_group[$itm['Item']['shop_id']] == $count) {
 		echo '</tbody>';
 		
		echo '</table>
		</div>';
		$item_id = json_encode($item_id);
		$item_id = str_replace("\""," ",$item_id); 
		echo '<div class="cart-payment" id="merchant-cart-payment">
	    <span class="bg-cart-payment"></span>
	    <dl style="border-bottom: 1px solid #D4D6DF;">
    	<span style="float:left;width:250px;">'?><?php echo __('Coupon codes:'); echo '</span>
		<input type="text" id="couponcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="'?><?php echo __('Have a coupon code?');echo '" />
   		<input id="button-submit-merchant" class="applybtncoupon" type="button" onclick="checkcoupon(\''.$item_user_id.'\',\''.$userid.'\',\''.$itm['Shop']['id'].'\')" style="width: 90px;" value="'?><?php echo __('Apply');echo '">
    	<span id="couponsemp" style="display:none;color:#FF0000;">'?><?php echo __('Coupon code is empty');echo '</span>
    	<span id="couponsnotvalid" style="display:none;color:#FF0000;">'?><?php echo __('Coupon code is Not valid'); echo '</span>
    	<span id="couponsExpired" style="display:none;color:#FF0000;">'?><?php echo __('Coupon code is Expired'); echo '</span>
    	<span id="couponsUsed" style="display:none;color:#FF0000;">'?><?php echo __('Coupon Used Already'); echo '</span>
    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">'?><?php echo __('Coupon code not valid for this Merchant'); echo '</span>
    	<div id="loadingimgs" style="display:none;text-align:center;">
		    <img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
	    </div>
    	</dl>
    	<dl style="border-bottom: 1px solid #D4D6DF;">
    	<span style="float:left;width:250px;">';echo __('Gift Card codes');echo ':</span>
    	<input type="text" id="giftcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="'?><?php echo __('Have a Gift Card code?');echo '" />
   		<input id="button-submit-merchant" class="applybtncoupon" type="button" onclick="Checkgiftcard(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')" style="width: 90px;" value="'?><?php echo __('Apply');echo '">
    	<span id="giftcodesemp" style="display:none;color:#FF0000;">'?><?php echo __('Gift Card code is empty'); echo '</span>
    	<span id="giftcodesnotvalid" style="display:none;color:#FF0000;"> '?><?php echo __('Gift Card code is Not valid'); echo '</span>
    	<span id="couponsExpired" style="display:none;color:#FF0000;">'?><?php echo __('Gift Card code is Expired');echo '</span>
    	<span id="couponsntvalidsmer" style="display:none;color:#FF0000;">'?><?php echo __('Gift Card code not valid for this Merchant'); echo '</span>
    	<div id="loadingimgsforgf" style="display:none;text-align:center;">
		    <img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
	    </div>
        </dl>
    	<dl class="cart-payment-ship ship-addr-'.$item_user_id.'">
      	<dt>'; echo __('Ship to');echo '<div class="shipchload shipchload'.$item_user_id.'"><img src="'.SITE_URL.'images/loading.gif" alt="Loading" /> </div> </dt>
      	<dd>';
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
		    echo '<select id="address-cart" class="select-shipping-addr  selectcartboxdiv" name="shipping_addr" onchange="cartshipping(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')" style="width: 259px ! important;">';
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
	        echo '</select> 
	        <div class="out" >'.$selectedShipping.'</div>
	        </div>
	        <div style="padding-top: 6px;">'?><?php echo __('Selected Address:');echo '</div>
	        <div class="default_addr'.$item_user_id.'" style="font-size: 13px;word-wrap: break-word;padding-right: 8px;"><div class="addnam">'.$fullname.'</div>'.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br /><div class="addphne">'.$phone.'</div>
	        </div>';
	        echo '<a href="javascript:void(0);" class="delete_addr  delete_addr'.$item_user_id.'" onclick=\'CartshippingRemove("'.$usershippingdefault.'","'.$item_user_id.'","'.$itm['Shop']['id'].'")\'>';echo __('Delete this address'); echo '</a>
	        |
	        <a href="'.SITE_URL.'addshipping" class="add_addr">';echo __('Add new address'); echo '</a>';
            }else{
            	echo '<a href="'.SITE_URL.'addshipping" class="add_addr">';echo __('Add new address'); echo '</a>';
            }
            $total_price = $item_price + $charg;
		    echo '</dd>
		    </dl>
        	<dl class="cart-payment-order">
            <dt>';echo __('Order');echo '</dt>
            <dd>
            <ul>';
            echo '<li class="first">
            <span class="order-payment-type">';echo __('Item total');echo '</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$item_price.
            '</b> '.$_SESSION['currency_code'].'</span>
            </li>';
            echo '<li>
            <span class="order-payment-type">';echo __('Shipping'); echo '</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$charg.
            '</b> '.$_SESSION['currency_code'].'</span>
            </li>';
            echo '<li>
            <span class="order-payment-type">'?><?php echo __('Discount'); echo '</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].'0</b> '.$_SESSION['currency_code'].'</span>
            </li>';
            echo '<li style="display:none;" id = "Creditamnt'.$item_user_id.'" >
            <span class="order-payment-type">'?><?php echo __('Credits'); echo '</span> <span class="order-payment-usd"><b>'
            .$_SESSION['currency_symbol'].'</b><b id = "availablee_credits">
            </b> '.$_SESSION['currency_code'].'</span></li>';
            /* if($available_bal!==''){
            $total_priceamt = $total_price - $available_bal;
            } */
            echo '<li class="total" style="display:none;" id = "Creditamnt_total'.$item_user_id.'">
            <div class="coup_one" style="display:block;">
            <span class="order-payment-type"><b>';echo __('Total'); echo '</b></span>
            <span class="order-payment-usd">'.$_SESSION['currency_symbol'].
            '<b id = "total_credits'.$item_user_id.'">'.$total_priceamt.
            '</b> '.$_SESSION['currency_code'].'</span>
            </div>
            </li>';
            echo '<li class="total"  id = "Creditamnt_totals'.$item_user_id.'">
            <div class="coup_one" style="display:block;">
            <span class="order-payment-type"><b>';echo __('Total'); echo '</b></span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$total_price.
            '</b> '.$_SESSION['currency_code'].'</span>
            </div>
            </li>
            </ul>
            </dd>';
            $item_id = json_encode($item_id);

	        $item_id = str_replace("\""," ",$item_id); 
	        $shipping_amt = json_encode($shipping_amt);
	        $shipping_amt = str_replace("\""," ",$shipping_amt);    
            echo '</dl>';
            if($available_bal > 0){
			    echo '<span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onclick="usecreditamount('.$item_user_id.','.$userid.')" >'?><?php echo __('Use Credit Amount'); echo '</a></span>';
            }else{
			    echo '<span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onclick="alertusecreditamount('.$item_user_id.','.$userid.')">'?><?php echo __('Use Credit Amount'); echo '</a></span>';
		    }
		    //echo '<span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onclick="usecreditamount('.$item_user_id.','.$userid.')" >'?><?php //echo __('Use Credit Amount'); echo '</a></span>';
		    ?>
      		<input type="hidden" id="totalitemcost<?php echo $item_user_id; ?>" value="<?php echo $item_price; ?>" />
		    <input type="hidden" id="totalshipp<?php echo $item_user_id; ?>" value="<?php echo $shipping; ?>" />
        	<input type="button" <?php echo $disable; ?> class="btn button<?php echo $item_user_id; ?>" id="button-submit-merchant"  value="<?php echo __('Checkout with Paypal');?>" onclick="checkout('<?php echo $item_id."', '".$item_user_id."', '".$shipping_amt;?>')"/>
        	<div class="adaptiveLoader<?php echo $item_user_id; ?> checkoutloading"><img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Processing......"></div>
        	<?php 
        	if ($disable != '' && $soldOut == 0){
        		echo "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>"?><?php echo __('Please Remove the Product that cannot be Shipped to your Location or Give a Different Address to make a Checkout');echo "</div>";
        		$disable = '';
        	}else if ($disable != '' && $soldOut == 1){
        		echo "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>"?><?php echo __('Please Remove the Product which is sold out to make a Checkout');echo "</div>";
        		$disable = '';
        		$soldOut = 0;
        	}
        	?>
		    </div>
		    </div>
		    <?php		
		    $count = 1;
		    $item_price = 0;
		    $shipping = 0;
		    $total_price = 0;//} else {$count ++;echo "</div>";
		    //}
		    //}
		    echo "</div>";	
	    }	
	    echo '<div id="paypalfom"></div>';
    }else{
	    echo "<div class='container' style='width:940px;'>";
	    echo '<div class="wrapper-content sale empty">
		    <div id="content"  style="padding: 25px; width: 890px;">
			    <!-- <h2 class="add-tit">Shopping Cart</h2>-->
			    <div style="border-bottom: none;" class="empty-alert">
				    <p><b>'?><?php echo __('Your Shopping Cart is Empty');echo '</b></p>
				    <p>'?><?php echo __('Don’t miss out on awesome sales right here on Trend. Let’s fill that cart, shall we?');echo '</p>
			    </div>
			
		    </div>
	    </div>';
    }	
?>

<!-- popups -->
<div id="popup_container">
<!-- add_to_list overlay -->
<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
	<div class="default" style="padding-bottom:25px;">
		<p class="ltit"><?php echo __('Using Credit amount');?></p>
		<button type="button" class="ly-close" id="btn-browses"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<div class="fancyd-item">
		
			<?php echo __('Your credit amount');?>: <?php if($available_bal > 0){ echo $available_bal; ?>
			<?php //else{ echo "0"; } ?>
			<br />
			
			<?php echo __('Maximum credit you can use for this purchase');?> <?php echo $commiItemTotalPrice; ?>
			<br />
			<?php echo __('Enter amount');?>:<input type="text" name = "creadit_amount" id="userentercreditamt" />
			<button id="usercreditamntchek" class="btn"><?php echo __('Save');?></button>
			<?php } 
			else
			{?>
			<?php echo __('Your credit amount is empty');?>
			<button id="usercreditamntchek" class="btn"><?php echo __('Ok');?></button>
			<?php } ?>
		</div>
		
	</div>
</div>
</div>
<!-- /popups -->
	
<script>
var couajax=0;
var creditamnts=0;
</script>
