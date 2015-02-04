<?php echo '<dt>Ship to</dt>
		      <dd>';
		      if (count($shippingmodel) > 0) {
		    echo "<div class='addressstyled'>";
		echo '<select id="address-cart'.$merid.'" class="select-address select-shipping-addr" name="shipping_addr" onchange="cartshipping(\''.$merid.'\')">';
			  
			  foreach ($shippingmodel as $usership) {
			  $shipid = $usership['Shippingaddresses']['shippingid'];
			  $nick = $usership['Shippingaddresses']['nickname'];
			  if ($shippingid == $shipid) {
			  	echo '<option selected value="'.$shipid.'">'.$nick.'</option>';
			  	$fullname = $usership['Shippingaddresses']['name'];
			  	$address1 = $usership['Shippingaddresses']['address1'];
				$address2 = $usership['Shippingaddresses']['address2'];
				$city = $usership['Shippingaddresses']['city'];
				$state = $usership['Shippingaddresses']['state'];
				$country = $usership['Shippingaddresses']['country'];
				$zip = $usership['Shippingaddresses']['zipcode'];
				$phone = $usership['Shippingaddresses']['phone'];
			  }else{
			  	echo '<option value="'.$shipid.'">'.$nick.'</option>';
			  }
			  }
			    echo '</select></div>
			
			<p class="default_addr">'.$fullname.'<br />
			  '.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br />'.$phone.'
			  	
			</p>';
			
			echo '<a href="#" class="delete_addr" onclick=\'shippingRemove("'.$shippingid.'")\'>Delete this address</a>
			
			<a href="'.SITE_URL.'addshipping" class="add_addr">Add new shipping address</a>';
		     }else{
		     echo '<a href="'.SITE_URL.'addshipping" class="add_addr">Add new shipping address</a>';
		    }
		     echo '</dd>';