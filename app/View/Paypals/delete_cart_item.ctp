<?php 
$soldOut = 0;
$disable = '';
	//echo "<pre>";print_r($getgiftcardValue);die;
	if (isset($itm_datas) && count($itm_datas) > 0 ) {
		$message = '';
		$count = 1;
		$item_price = 0;
		$shipping = 0;
		$total_price = 0;
		$item_price2 = 0;
		$shipping2 = 0;
		$total_price2 = 0;
		$discount = 0;
		$discount2 = 0;
		$c_item_tot = 0;
		$item_id = array();
		$shipping_amt = array();
		//$message = $message . "  " . '<div id="shop"><p class="cart-list-from">
		//Order from <b> '.SITE_NAME.' </b> </p>';
		$message = $message . "  " . '<div class="cart-payment-wrap cart-note">
		<span class="cart-payment-top"><b></b></span>
		<div class="table-cart-wrap">
		<table class="table-cart">
		<thead>
		<tr>
		<th colspan="2" class="product">Product</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		</tr>
		</thead>
		<tbody>';
		foreach($itm_datas as $ke=>$itm){
			if($itm['Item']['delivery_type'] == 'regular'){
			    $item_user_id = $itm['User']['id'];
			    /* if ($count == 1) {
			    $item_id = array();
			    $shipping_amt = array();
			    $item_user_id = $itm['User']['id'];
			    $message = $message . "  " . '<p class="cart-list-from">
					    Order from <b> <a href = "'.SITE_URL.'people/'.$itm['User']['username_url'].'">
					    Merchant '.$itm['Shop']['shop_name'].'</a> </b> </p>';
			    $message = $message . "  " . '<p class="cart-list-from">
					    Order from <b> Merchant '.SITE_NAME.' </b> </p>';
			    $message = $message . "  " . '<div class="cart-payment-wrap cart-note">
			    <span class="cart-payment-top"><b></b></span>
			    <div class="table-cart-wrap">
			    <table class="table-cart">
			    <thead>
			    <tr>
			      <th colspan="2" class="product">Product</th>
			      <th>Price</th>
			      <th>Quantity</th>
			      <th>Total</th>
			    </tr>
		          </thead>
		          <tbody>';
			    } */
			    $item_id[] = $itm['Item']['id'];
			    $message = $message . "  " . '<tr class="first">
			    <td rowspan="2" class="thumnail">';
			    $message = $message . "  " . "<a href='".SITE_URL."listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>
			    <div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
			    </a>";
			    //<img src='".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."' />
			    //</a>";
			    //$message = $message . "  " . "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> Remove</a>";
			    $message = $message . "  " . "</td>
			    <td class='title'>";
			    //$titttle = $itm['Item']['item_title'];
			    $titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
			    $message = $message . "  " . $this->Html->link($titttle,array('controller'=>'/','action'=>'/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
			    $message = $message . "  " . "</td>";
			    $itemprice = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			    $message = $message . "  " . '<td class="price">'.$_SESSION['currency_symbol'].$itemprice.'</td>';
			    $message = $message . "  " . '<td class="quantity" style="padding-top:12px;font-size:13px;">';
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
				    $message = $message . " ". '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">';
				    $message = $message . "  " .  "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
				    $selected = '';
					    for($i=1;$i<=$sizeQty;$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selected = 'selected';
							    $selectedquan = $i;
						    }
						    $message = $message . "  " .  "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    $message = $message . "  " . "</select><div class='out' >".$selectedquan."</div>";
					    $message = $message . "  " . "</div><img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
				    }else{
					    $message = $message . "  " . "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }else{
				    if ($itm['Item']['quantity'] > 0){
      					$message = $message . " ". '<div class="selectdiv" style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">';
					    $message = $message . "  " . "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
					    $selected = '';
					    for($i=1;$i<=$itm['Item']['quantity'];$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selected = 'selected';
							    $selectedquan = $i;
						    }
						    $message = $message . "  " . "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    $message = $message . "  " . "</select><div class='out' >".$selectedquan."</div>";
					    $message = $message . "  " . "</div><img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
				    }else{
					    $message = $message . "  " . "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }
			    /* } else {
				    $message = $message . "  " . $quantity[$itm['Item']['id']];
			    } */
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
    ////			    $total_price = $total_price + $item_total + $shpngs[$shipping_method_id];
                        $total_price = $total_price + $item_total;
	            }else if(isset($shpngs[0])){
		            $shipping = $shipping + $shpngs[0];
		            $shipping_amt[] = $shpngs[0];
    ////			    $total_price = $total_price + $item_total + $shpngs[0];
                        $total_price = $total_price + $item_total;
	            }else {
		            $disable = "disabled";
	            }

			    //echo $total_price;
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
			    $message = $message . "  " . '</td><td class="total">'.$_SESSION['currency_symbol'].$item_total.'</td>
                </tr>
                <tr>
                <td class="optional" colspan="4">
                <span>
                </span>';
			    $message = $message . "  " . '<ul class="optional-list">';
			    if (!empty($size[$itm['Item']['id']])){
				    $message = $message . "  " . "<li>
				    <span class='option-tit' style ='padding:13px 0px 7px 0px;'>Size: ".$size[$itm['Item']['id']]." </span>
				    </li>";
			    }else{
				    $message = $message . "  " . "<li>
				    <span class='option-tit' style ='padding:13px 0px 7px 0px;'>Size: N/A </span>
				    </li>";
			    }
			    $process_time =  $itm['Item']['processing_time'];
                $message = $message . "  " .  "<li><span class='option-tit'  style='position: relative; bottom: 10px;' >Shipping:</span>
			    <span class='option-txt'  style='position: relative; bottom: 10px;' >";
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
			
			    $message = $message ." 
                <li>
			    <span class='option-tit' style='position: relative; bottom: 12px;'>Seller:</span>
			    <a href='".SITE_URL.'people/'.$itm['User']['username_url']."' class='add_addr' style='position: relative; bottom: 12px;'>".$itm['User']['username'].'</a>
			    </li>';
                $message = $message . "  " . "<li><a href='#' class='remove_item' style='position: relative; bottom: 15px;' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> Remove</a></li>";
                $message = $message . " " .'</ul>';
                $message = $message . " " .'</td></tr>';
			    //if ($itm_group[$itm['Item']['shop_id']] == $count) {
		    }
		}
		$message = $message . "  " . '</tbody>
		</table>';
		
        foreach($itm_datas as $ke=>$itm){
			    if($itm['Item']['delivery_type'] !== 'regular'){
			        $count_ids = 1;
			    }
        }
		
		$message = $message . "  " . '<table class="table-cart">';
		if($count_ids == 1){
		$message = $message . "  " . '<thead>
		<tr>
		<th colspan="2" class="product">Special Delivery Pending Orders*</th>
		</tr>
		</thead>';
		}
		$message = $message . "  " . '<tbody>';
		foreach($itm_datas as $ke=>$itm){
			if($itm['Item']['delivery_type'] !== 'regular'){
			    $item_user_id = $itm['User']['id'];
			    /* if ($count == 1) {
			    $item_id = array();
			    $shipping_amt = array();
			    $item_user_id = $itm['User']['id'];
			    $message = $message . "  " . '<p class="cart-list-from">
					    Order from <b> <a href = "'.SITE_URL.'people/'.$itm['User']['username_url'].'">
					    Merchant '.$itm['Shop']['shop_name'].'</a> </b> </p>';
			    $message = $message . "  " . '<p class="cart-list-from">
					    Order from <b> Merchant '.SITE_NAME.' </b> </p>';
			    $message = $message . "  " . '<div class="cart-payment-wrap cart-note">
			    <span class="cart-payment-top"><b></b></span>
			    <div class="table-cart-wrap">
			    <table class="table-cart">
			    <thead>
			    <tr>
			      <th colspan="2" class="product">Product</th>
			      <th>Price</th>
			      <th>Quantity</th>
			      <th>Total</th>
			    </tr>
		          </thead>
		          <tbody>';
			    } */
			    foreach($car_spl_ids as $cart_spl_id){
			        if($cart_spl_id['Cart']['item_id'] == $itm['Item']['id'] && $cart_spl_id['Cart']['shipping_status'] !== 'disable'){
					    $item_id[] = $itm['Item']['id'];
			        }
			    }
			    $message = $message . "  " . '<tr class="first">
			    <td rowspan="2" class="thumnail">';
			    $message = $message . "  " . "<a href='".SITE_URL."listing/".$itm['Item']['id']."/".$itm['Item']['item_title_url']." '>
			    <div style=\"background-image:url('".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."');\"></div>
			    </a>";
			    //<img src='".$_SESSION['media_url']."media/items/thumb150/".$itm['Photo'][0]['image_name']."' />
			    //</a>";
			    //$message = $message . "  " . "<a href='#' class='remove_item glyphicons circle_minus' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> Remove</a>";
			    $message = $message . "  " . "</td>
			    <td class='title'>";
			    //$titttle = $itm['Item']['item_title'];
			    $titttle = UrlfriendlyComponent::limit_char($itm['Item']['item_title'],30);
			    $message = $message . "  " . $this->Html->link($titttle,array('controller'=>'/','action'=>'/listing/'.$itm['Item']['id'].'/'.$itm['Item']['item_title_url']))."<br />";
			    $message = $message . "  " . "</td>";
			    $itemprice = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			    $message = $message . "  " . '<td class="price">'.$_SESSION['currency_symbol'].$itemprice.'</td>';
			    $message = $message . "  " . '<td class="quantity" style="padding-top:12px;font-size:13px;">';
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
				    $message = $message . " ". '<div class="selectdiv"  style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">';
				    $message = $message . "  " .  "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."'name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
				    $selected = '';
					    for($i=1;$i<=$sizeQty;$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selected = 'selected';
							    $selectedquan = $i;
						    }
						    $message = $message . "  " .  "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    $message = $message . "  " . "</select><div class='out' >".$selectedquan."</div>";
					    $message = $message . "  " . "</div><img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
				    }else{
					    $message = $message . "  " . "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }else{
				    if ($itm['Item']['quantity'] > 0){
      					$message = $message . " ". '<div class="selectdiv" style="margin: 0px auto; padding-left: 4px; text-align: left; width: 60px;">';
					    $message = $message . "  " . "<select class='selectquantity selectboxdiv qnty".$itm['Item']['id']."' name='quantity' onchange='selectChange(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'>";
					    $selected = '';
					    for($i=1;$i<=$itm['Item']['quantity'];$i++){
						    if ($quantity[$itm['Item']['id']] == $i) {
							    $selected = 'selected';
							    $selectedquan = $i;
						    }
						    $message = $message . "  " . "<option ".$selected." value='".$i."'>".$i."</option>";
						    $selected = '';
					    }
					    $message = $message . "  " . "</select><div class='out' >".$selectedquan."</div>";
					    $message = $message . "  " . "</div><img class='selectLoad".$itm['Item']['id']."' src='".SITE_URL."images/loading_blue.gif' alt='Loading...' style='display:none;'/></div>";
				    }else{
					    $message = $message . "  " . "<span style='color:#FF0000;font-weight:bold;'>Sold Out</span>";
					    $disable = "disabled";
					    $soldOut = 1;
				    }
			    }
			    /* } else {
				    $message = $message . "  " . $quantity[$itm['Item']['id']];
			    } */
			    $shpngs = '';
			    foreach($itm['Shiping'] as $shpng){
				    $shpngs[$shpng['country_id']] = round($shpng['primary_cost'] * $_SESSION['currency_value'], 2);
			    }

    			$item_total2 = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
        		if ($quantity[$itm['Item']['id']] != 1) {
        			$item_total2 = $item_total2 * $quantity[$itm['Item']['id']];
        		}	
	            $item_price2 = $item_price2 + $item_total2;
		
		        //print_r($shpngs);
		        if (isset($shpngs[$shipping_method_id])) {	
		            $shipping2 = $shipping2 + $shpngs[$shipping_method_id];
		            $shipping_amt[] = $shpngs[$shipping_method_id];
    ////			    $total_price = $total_price + $item_total + $shpngs[$shipping_method_id];
                        $total_price2 = $total_price2 + $item_total2;
	            }else if(isset($shpngs[0])){
		            $shipping2 = $shipping2 + $shpngs[0];
		            $shipping_amt[] = $shpngs[0];
    ////			    $total_price = $total_price + $item_total + $shpngs[0];
                        $total_price2 = $total_price2 + $item_total2;
	            }else {
		            $disable = "disabled";
	            }

			    //echo $total_price;
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
			    $message = $message . "  " . '</td><td class="total">'.$_SESSION['currency_symbol'].$item_total2.'</td>
                </tr>
                <tr>
                <td class="optional" colspan="4">
                <span>
                </span>';
			    $message = $message . "  " . '<ul class="optional-list">';
			    if (!empty($size[$itm['Item']['id']])){
				    $message = $message . "  " . "<li>
				    <span class='option-tit' style ='padding:13px 0px 7px 0px;'>Size: ".$size[$itm['Item']['id']]." </span>
				    </li>";
			    }else{
				    $message = $message . "  " . "<li>
				    <span class='option-tit' style ='padding:13px 0px 7px 0px;'>Size: N/A </span>
				    </li>";
			    }
			    $process_time =  $itm['Item']['processing_time'];
                $message = $message . "  " .  "<li><span class='option-tit'  style='position: relative; bottom: 10px;' >Shipping:</span>
			    <span class='option-txt'  style='position: relative; bottom: 10px;' >";
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
			
			    $message = $message ." 
                <li>
			    <span class='option-tit' style='position: relative; bottom: 12px;'>Seller:</span>
			    <a href='".SITE_URL.'people/'.$itm['User']['username_url']."' class='add_addr' style='position: relative; bottom: 12px;'>".$itm['User']['username'].'</a>
			    </li>';
                $message = $message . "  " . "<li><a href='#' class='remove_item' style='position: relative; bottom: 15px;' onclick='removecart(".$itm['Item']['id'].",".$userid.",".$itm['Shop']['id'].",".$item_user_id.")'> Remove</a></li>";
                $message = $message . " " .'</ul>';
                $message = $message . " " .'</td></tr>';
			    //if ($itm_group[$itm['Item']['shop_id']] == $count) {
		    }
		}
		$message = $message . "  " . '</tbody>
		</table>
		
		</div>';
		$message = $message . "  " . '<div class="cart-payment" id="merchant-cart-payment">
        <span class="bg-cart-payment"></span>
        <dl style="border-bottom: 1px solid #D4D6DF;">
        <span style="float:left;width:250px;">Coupon codes:</span>
        <input type="text" id="couponcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="Have a coupon code?" />
        <input id="button-submit-merchant" class="applybtncoupon" type="button" onclick="checkcoupon(\''.$item_user_id.'\',\''.$itm['User']['id'].'\',\''.$itm['Shop']['id'].'\')" style="width: 90px; " value="Apply">
        <span id="couponsemp" style="display:none;color:#FF0000;">Coupon code is empty</span>
        <span id="couponsnotvalid" style="display:none;color:#FF0000;">Coupon code is Not valid</span>
        <span id="couponsExpired" style="display:none;color:#FF0000;">Coupon code is Expired</span>
        <span id="couponsUsed" style="display:none;color:#FF0000;">Coupon Used Already</span>
        <span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Coupon code not valid for this Merchant</span>
        <div id="loadingimgs" style="display:none;text-align:center;">
	        <img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
        </div>
        </dl>

        <dl style="border-bottom: 1px solid #D4D6DF;">
        <span style="float:left;width:250px;">Gift Card codes:</span>
        <input type="text" id="giftcode" style="width: 160px; height: 15px; padding: 7px 2px;"  placeholder="Have a Gift Card code?" />
        <input id="button-submit-merchant" class="applybtncoupon" type="button" onclick="Checkgiftcard(\''.$item_user_id.'\')" style="width: 90px;" value="Apply">
        <span id="giftcodesemp" style="display:none;color:#FF0000;">Gift Card code is empty</span>
        <span id="giftcodesnotvalid" style="display:none;color:#FF0000;">Gift Card code is Not valid</span>
        <span id="couponsExpired" style="display:none;color:#FF0000;">Gift Card code is Expired</span>
        <span id="couponsntvalidsmer" style="display:none;color:#FF0000;">Gift Card code not valid for this Merchant</span>
        <div id="loadingimgsforgf" style="display:none;text-align:center;">
	        <img alt="loadingimgs..." src="'.SITE_URL.'images/loading_blue.gif">
        </div>
        </dl>
        <dl class="cart-payment-ship ship-addr-'.$item_user_id.'">
        <span class="bg-cart-payment"></span>
        <dt>Ship to <div class="shipchload shipchload'.$item_user_id.'"><img src="'.SITE_URL.'images/loading.gif" alt="Loading" /> </div></dt>
        <dd>';
	    if (count($usershipping) > 0) {
	        $message = $message . "  " . '<div class="selectcartdiv  addressstyledremove">';
		    $message = $message . "  " . '<select id="address-cart" class="select-shipping-addr selectcartboxdiv" name="shipping_addr" onchange="cartshipping(\''.$item_user_id.'\',\''.$itm['Shop']['id'].'\')" style="width: 259px ! important;">';
			foreach ($usershipping as $usership) {
				$shipid = $usership['Tempaddresses']['shippingid'];
				$nick = $usership['Tempaddresses']['nickname'];
				if ($usershippingdefault == $shipid) {
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

			$message = $message . "  " . '</select><div class="out" >'.$selectedShipping.'</div></div>
			<div style="padding-top: 6px;"> Selected Address: </div>
			<div class="default_addr'.$item_user_id.'" style="font-size: 13px;word-wrap: break-word;padding-right: 8px;"><div class="addnam">'.$fullname.'</div>
			  '.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br /><div class="addphne">'.$phone.'</div>
			</div>';
			$message = $message . "  " . '<a href="javascript:void(0);" class="delete_addr delete_addr'.$item_user_id.'" onclick=\'CartshippingRemove("'.$usershippingdefault.'","'.$item_user_id.'","'.$itm['Shop']['id'].'")\'>Delete this address</a>
			|
			<a href="'.SITE_URL.'addshipping" class="add_addr">Add new address</a>';
		}else{
		     $message = $message . "  " . '<a href="'.SITE_URL.'addshipping" class="add_addr">Add new address</a>';
		}
		$total_price = $item_price + $charg;
		$message = $message . "  " . '</dd>
        </dl>
        <dl class="cart-payment-order">';
        if(!empty($total_price)){
        $message = $message . "  " . '<dt></dt>
            <dd>
            <ul>';
//		    $total_price2 = $total_price2 + $charg;
            $message = $message . "  " . '<dt>Order</dt>
            <dd>
            <ul>';
            $message = $message . "  " . '<li class="first">
            <span class="order-payment-type">Item total</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$item_price.
            '</b> '.$_SESSION['currency_code'].'</span></li>';
            $message = $message . "  " . '<li>
            <span class="order-payment-type">Shipping</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$charg.
            '</b> '.$_SESSION['currency_code'].'</span></li>';
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
                    $message = $message . "  " . '<li>
                    <span class="order-payment-type">Discount</span>
                    <span class="order-payment-usd"><b>'.$discount.'%</b> </span>
                    </li>';
                }
                if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
                    $message = $message . "  " . '<li>
                    <span class="order-payment-type">Discount</span>
                    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$discount.
                    '</b> '.$_SESSION['currency_code'].'</span>
                    </li>';
                }
            }else{
                $message = $message . "  " . '<li>
                <span class="order-payment-type">Discount</span>
                <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].'0</b> '.$_SESSION['currency_code'].
                '</span>
                </li>';
            }	
		    $message = $message . '<input type="hidden" id="tototcostt" value="'.$total_price.'" />';
		    //if(isset($getgiftcardValue) && ($item_price >= $getgiftcardValue['Giftcard']['avail_amount'])){
		    //$getgiftcardValue = $getgiftcardValue * $_SESSION['currency_value'];
		    if(isset($getgiftcardValue)){
			    $getgiftcardValue['Giftcard']['avail_amount'] = round($getgiftcardValue['Giftcard']['avail_amount'] * $_SESSION['currency_value'], 2);
			    $message = $message . "  " . '<li>
		     	<span class="order-payment-type">Giftcard Amount</span>
		     	<span class="order-payment-usd"><b> - '.$_SESSION['currency_symbol'].$getgiftcardValue['Giftcard']['avail_amount'].
		     	'</b> '.$_SESSION['currency_code'].'</span></li>';
		     	$total_price = $total_price- $getgiftcardValue['Giftcard']['avail_amount'];
		     }/* else{
		     	$message = $message . "  " . '<li>
		     	<span class="order-payment-type">Giftcard Amount</span>
		     	<span class="order-payment-usd"><b>Not valid for this product</b></span>
		     	</li>';
		     } */
		    $message = $message . "  " . '<li style="display:none;" id = "Creditamnt'.$item_user_id.'" >
		    <span class="order-payment-type">Credits</span> <span class="order-payment-usd"><b>'.
		    $_SESSION['currency_symbol'].'</b><b id = "availablee_credits"></b> '.
		    $_SESSION['currency_code'].'</span></li>';
		    $message = $message . "  " . '<li class="total" style="display:none;" id = "Creditamnt_total'.$item_user_id.'">
		    <div class="coup_one" style="display:block;">
		    <span class="order-payment-type"><b>Total</b></span>
		    <span class="order-payment-usd">'.$_SESSION['currency_symbol'].'<b id = "total_credits'.
		    $item_user_id.'">'.$total_priceamt.'</b> '.$_SESSION['currency_code'].'</span>
		    </div>
		    </li>';
		    /* 
		
		    if($available_bal!==''){
			    $total_priceamt = $total_price - $available_bal;
		    } */
		    if(isset($getgiftcardValue) && $total_price <= 0){
			    $message = $message . "  " . '<li class="total"  id = "Creditamnt_totals'.$item_user_id.'">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].' 0 </b> '.$_SESSION['currency_code'].'</span>
			    </li>';	
		    }else{
			    $message = $message . "  " . '<li class="total"  id = "Creditamnt_totals'.$item_user_id.'">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$total_price.'
			    </b> '.$_SESSION['currency_code'].'</span>
			    </li>';
		    }
		    $message = $message . "  " . '</ul></dd>';
		}
        if(!empty($total_price2)){
//		    $total_price2 = $total_price2 + $charg;
            $message = $message . "  " . '<dt>Order two</dt>
            <dd>
            <ul>';
            $message = $message . "  " . '<li class="first">
            <span class="order-payment-type">Item total</span>
            <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$item_price2.
            '</b> '.$_SESSION['currency_code'].'</span></li>';
            $message = $message . "  " . '<li>
            <span class="order-payment-type">Shipping</span>
            <span class="order-payment-usd"><b>Waiting for admin quote</b></span></li>';
            if(isset($getcouponvalue)){
                if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
                    $discount2 = $getcouponvalue['Coupon']['discount_amount'];
                    $calDiscount = $item_price2 * ($discount2 / 100);
                    if (isset($shpngs[$shipping_method_id])) {
	                    $total_price2 -= $calDiscount;
                    }else if(isset($shpngs[0])){
	                    $total_price2 -= $calDiscount;
                    }else {
	                    $total_price2 = 0;
	                    $disable = "disabled";
                    }
                }
                if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
                    $discount2 = round($getcouponvalue['Coupon']['discount_amount'] * $_SESSION['currency_value'], 2);
                    if (isset($shpngs[$shipping_method_id])) {
	                    $total_price2 = $total_price2 - $discount2;
                    }else if(isset($shpngs[0])){
	                    $total_price2 = $total_price2 - $discount2;
                    }else {
	                    $total_price2 = 0;
	                    $disable = "disabled";
                    }
                }
            }
            if(isset($getcouponvalue)){
                if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
                    $message = $message . "  " . '<li>
                    <span class="order-payment-type">Discount</span>
                    <span class="order-payment-usd"><b>'.$discount2.'%</b> </span>
                    </li>';
                }
                if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
                    $message = $message . "  " . '<li>
                    <span class="order-payment-type">Discount</span>
                    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].$discount2.
                    '</b> '.$_SESSION['currency_code'].'</span>
                    </li>';
                }
            }else{
                $message = $message . "  " . '<li>
                <span class="order-payment-type">Discount</span>
                <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].'0</b> '.$_SESSION['currency_code'].
                '</span>
                </li>';
            }	
		    $message = $message . '<input type="hidden" id="tototcostt" value="'.$total_price2.'" />';
		    //if(isset($getgiftcardValue) && ($item_price >= $getgiftcardValue['Giftcard']['avail_amount'])){
		    //$getgiftcardValue = $getgiftcardValue * $_SESSION['currency_value'];
		    if(isset($getgiftcardValue)){
			    $getgiftcardValue['Giftcard']['avail_amount'] = round($getgiftcardValue['Giftcard']['avail_amount'] * $_SESSION['currency_value'], 2);
			    $message = $message . "  " . '<li>
		     	<span class="order-payment-type">Giftcard Amount</span>
		     	<span class="order-payment-usd"><b> - '.$_SESSION['currency_symbol'].$getgiftcardValue['Giftcard']['avail_amount'].
		     	'</b> '.$_SESSION['currency_code'].'</span></li>';
		     	$total_price2 = $total_price2 - $getgiftcardValue['Giftcard']['avail_amount'];
		     }/* else{
		     	$message = $message . "  " . '<li>
		     	<span class="order-payment-type">Giftcard Amount</span>
		     	<span class="order-payment-usd"><b>Not valid for this product</b></span>
		     	</li>';
		     } */
		    $message = $message . "  " . '<li style="display:none;" id = "Creditamnt'.$item_user_id.'" >
		    <span class="order-payment-type">Credits</span> <span class="order-payment-usd"><b>'.
		    $_SESSION['currency_symbol'].'</b><b id = "availablee_credits"></b> '.
		    $_SESSION['currency_code'].'</span></li>';
		    $message = $message . "  " . '<li class="total" style="display:none;" id = "Creditamnt_total'.$item_user_id.'">
		    <div class="coup_one" style="display:block;">
		    <span class="order-payment-type"><b>Total</b></span>
		    <span class="order-payment-usd">'.$_SESSION['currency_symbol'].'<b id = "total_credits'.
		    $item_user_id.'">'.$total_priceamt.'</b> '.$_SESSION['currency_code'].'</span>
		    </div>
		    </li>';
		    /* 
		
		    if($available_bal!==''){
			    $total_priceamt = $total_price - $available_bal;
		    } */
		    if(isset($getgiftcardValue) && $total_price2 <= 0){
			    $message = $message . "  " . '<li class="total"  id = "Creditamnt_totals'.$item_user_id.'">
			    <span class="order-payment-type"><b>Totalaaaaaa</b></span>
			    <span class="order-payment-usd"><b>'.$_SESSION['currency_symbol'].' 0 </b> '.$_SESSION['currency_code'].'</span>
			    </li>';	
		    }else{
			    $message = $message . "  " . '<li class="total"  id = "Creditamnt_totals'.$item_user_id.'">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>Pending</b></span>
			    </li>';
		    }
		    $message = $message . "  " . '</ul></dd>';
		}

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

			    $message = $message . "  " . $item_id;	
		$item_id = str_replace("\""," ",$item_id); 
		$shipping_amt = json_encode($shipping_amt);
		$shipping_amt = str_replace("\""," ",$shipping_amt);  
		if(!isset($getgiftcardValue) && empty($getcouponvalue)){
	    	//$message = $message . "  " . '</dl><span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onClick="usecreditamount('.$item_user_id.','.$userid.')">Use Credit Amount </a></span>';
			if($available_bal > 0){
		 		$message = $message . "  " . '</dl><span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onClick="usecreditamount('.$item_user_id.','.$userid.')">Use Credit Amount </a></span>';
		 	}else{
		 		$message = $message . "  " . '</dl><span class="usecreditcart"><a id="usecreditamount'.$item_user_id.'" onClick="alertusecreditamount('.$item_user_id.','.$userid.')">Use Credit Amount </a></span>';
		 	}
		}
		if(isset($getgiftcardValue) && $total_price <= 0){
			$message = $message . "  " . '<input type="button" class="btn button'.$item_user_id.'" id="button-submit-merchant" '.$disable.' value="Buy Now" onclick="giftcardusebuynow(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')"/>';
   		}else{
			$message = $message . "  " . '<input type="button" class="btn button'.$item_user_id.'" id="button-submit-merchant" '.$disable.' value="Checkout with Paypal" onclick="checkout(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')"/>';
		}
		if(isset($getcouponvalue) && !empty($getcouponvalue)){
			$message = $message . "  " . "<br /><a href='' class='remove_item' > Remove the Coupon discount amount </a>";
		}
		if(isset($getgiftcardValue)){
	    	$message = $message . "  " . "<br /><a href='' class='remove_item' > Remove the Giftcard discount amount </a>";
	    }
	    if(isset($getgiftcardValue) && $total_price <= 0){
	    	//$message = $message . "  " . '<input type="button" class="btn button'.$item_user_id.'" id="button-submit-merchant" '.$disable.' value="Buy Now" onclick="giftcardusebuynow(\''.$item_id.'\',\''.$item_user_id.'\',\''.$shipping_amt.'\')"/>';
	    	$balanceGiftAmnt = (-1*$total_price) / $_SESSION['currency_value'];
	    	$balanceGiftAmnt = round($balanceGiftAmnt, 2);
	    	$message = $message . " <div style='font-size:12px;'>Note: After this order your gift card balance will be: <b>" .$balanceGiftAmnt."</b> USD amount";
	    }
		$message = $message . "  " . '<div class="adaptiveLoader'.$item_user_id.' checkoutloading"><img src="'.SITE_URL.'images/loading.gif" alt"Processing......"></div>';
		if ($disable != '' && $soldOut == 0){
    		$message = $message . "  " . "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product that cannot be Shipped to your Location or Give a Different Address to make a Checkout</div>";
    		$disable = '';
    	}else if ($disable != '' && $soldOut == 1){
    		$message = $message . "  " . "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product which is sold out to make a Checkout</div>";
    		$disable = '';
    		$soldOut = 0;
    	}else if ($disable != '' && $charg2 == NULL){
    		$message = $message . "  " . "<div style='color:red;font-size:12px;font-weight:bold;padding:2px 15px;'>Please Remove the Product which is sold out to make a Checkout</div>";
    		$disable = '';
    	}
		$message = $message . "  " . '</div>';
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
		<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
		<div class="default">
		<p class="ltit">Using Credit amount</p>
		<button type="button" class="ly-close" id="btn-browses"><img src="'.SITE_URL.'images/closebt.png" ></button>
		<div class="fancyd-item">Your credit amount: '.$available_bal.'<br />Maximum credit you can use for this purchase : '.$commiItemTotalPrice.'<br />Enter amount:<input type="text" name = "creadit_amount" id="userentercreditamt" />
		<button id="usercreditamntchek" class="btn">Save</button>
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

