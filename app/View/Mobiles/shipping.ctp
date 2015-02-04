<div class="container set_area">
	<div id="content" class="ui-body ui-body-a" style="font-size:13px;border-radius:5px;">
	<table width="100%"><thead><tr><th align="left">
		<span class="ptit" style="font-size:15px;">Shipping Address</span><?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?></th></tr></thead><tbody><tr><td colspan="2"><hr></td></tr><tr><td>
	
		<div class=" section shipping">
			<?php if (count($shippingModel) > 0 ) { ?> 
			<span>Your Saved Shipping Addresses</span></td></tr></tbody></table>
			<div class="chart-wrap">
				
				<table class="chart" width="100%">
				<thead>
					<tr>
					
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php //print_r($shippingModel);
					foreach ($shippingModel as $shipping) {
					$shippingstyle = '';
					$shippingid = $shipping['Tempaddresses']['shippingid'];
					$nick = $shipping['Tempaddresses']['nickname'];
					$fullname = $shipping['Tempaddresses']['name'];
					$address1 = $shipping['Tempaddresses']['address1'];
					$address2 = $shipping['Tempaddresses']['address2'];
					$city = $shipping['Tempaddresses']['city'];
					$state = $shipping['Tempaddresses']['state'];
					$country = $shipping['Tempaddresses']['country'];
					$zip = $shipping['Tempaddresses']['zipcode'];
					$phone = $shipping['Tempaddresses']['phone'];?>		
					<tr class="shipping<?php echo $shippingid; ?>">
					<?php $shippingstyle = '';
					if ($usershipping == $shippingid) {
						$shippingstyle = 'style="display:none;"';}
					 ?>
						<td class="remove_ dall default<?php echo $shippingid.'"'.$shippingstyle; ?>>Default</td><td><a class="remove_ dall default<?php echo $shippingid.'"'.$shippingstyle; ?> href="#" onclick='shippingdefault("<?php echo $shippingid; ?>")' >Default</a></td></tr>
						<tr class="shipping<?php echo $shippingid; ?>"><td>Nickname</td><td><b><?php echo $nick; ?></b></td></tr>
						<tr class="shipping<?php echo $shippingid; ?>"><td>Address</td><td><?php echo $fullname."<br>".$address1."<br>".$city." ".$state." ".$zip."<br>".$country; ?></td></tr>
						<tr class="shipping<?php echo $shippingid; ?>"><td>Phone</td><td><?php echo $phone; ?></td></tr>
						<tr class="shipping<?php echo $shippingid; ?>"><td class="btns" colspan="2">
						<div data-role="controlgroup" data-type="horizontal">
							<img class="loading<?php echo $shippingid; ?>" src = "<php echo SITE_URL; ?>images/loading_blue.gif" style="display:none;"/>
							<button data-role="button" class="edit_<?php echo $shippingid; ?>" onclick='shippingEdit("<?php echo $shippingid; ?>")' >Edit</button>
							<button data-role="button" class="remove_<?php echo $shippingid; ?>" onclick='shippingRemove("<?php echo $shippingid; ?>")' > Remove</button>
							</div>
						</td>
					</tr>
					<tr class="shipping<?php echo $shippingid; ?>"><td colspan="2"><hr></td></tr>
				<?php } ?>
				</tbody>
				</table>
	</div>
<?php } else { ?>
<div class=" shipping no-data">
			
			<span class="icon"><i class="ic-ship"></i></span>
			<p>You haven't added any shipping address yet.</p>
			</div>

<?php } ?>
	</div>
    </div>
	
	<div id="sidebar" style="display:none;">
			<dl class="set_menu">
				<dt>ACCOUNT</dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > Profile</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > Password</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" class="current" ><?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" >Add Shipping</a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __ ('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><?php  echo __('Information'); ?></a></dd>
	           	<dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i>My Sales</a></dd>
	        </dl>
			<dl class="set_menu">
				<dt>SHARING</dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> Credits</a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> Referrals</a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> Gift card</a></dd>
	        </dl>
		</div>
			<!--footer id="footer">
			<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
			<hr>
			<ul class="footer-nav">
				<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
				<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
				<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
			</ul>
			
		</footer-->	
</div>	

<style>
li{
	font-weight:normal;
}

</style>
