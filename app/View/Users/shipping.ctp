<div class="container set_area" style="width:940px;">
	<div id="content">
		<h2 class="ptit"><?php echo __('Shipping Address');?></h2>

		<div class=" section shipping">
			<?php if (count($shippingModel) > 0 ) { ?> 
			<span><?php echo __('Your Saved Shipping Addresses');?></span>
			<div class="chart-wrap">
				
				<table class="chart">
				<thead>
					<tr>
						<th><?php echo __('Default');?></th>
						<th><?php echo __('Nickname');?></th>
						<th><?php echo __('Address');?></th>
						<th><?php echo __('Phone');?></th>
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
						<td><a class="remove_ dall default<?php echo $shippingid.'"'.$shippingstyle; ?> href="#" onclick='shippingdefault("<?php echo $shippingid; ?>")' ><?php echo __('Default');?></a></td>
						<td style="width:115px;max-width:110px;overflow:hidden;word-wrap: break-word;"><b><?php echo $nick; ?></b></td>
						<td style="width:250px;">
							<div class="shipaddrcont" style="width: 250px;overflow:hidden;">
								<?php echo $fullname."<br>".$address1."<br>".$city." ".$state." ".$zip."<br>".$country; ?>
							</div>
						</td>
						<td><?php echo $phone; ?></td>
						<td class="btns">
							<img class="loading<?php echo $shippingid; ?>" src = "<php echo SITE_URL; ?>images/loading_blue.gif" style="display:none;"/>
							<a class="edit_<?php echo $shippingid; ?>" href="#" onclick='shippingEdit("<?php echo $shippingid; ?>")' ><?php echo __('Edit');?></a> / 
							<a class="remove_<?php echo $shippingid; ?>" href="#" onclick='shippingRemove("<?php echo $shippingid; ?>")' ><?php echo __('Remove');?></a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
	</div>
<?php } else { ?>
<div class=" shipping no-data">
			
			<span class="icon"><i class="ic-ship"></i></span>
			<p><?php echo __('You haven’t added any shipping address yet');?>.</p>
			</div>

<?php } ?>
	</div>
    </div>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password')?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" class="current" ><?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><?php echo __('Add Shipping');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __ ('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><?php  echo __('Information'); ?></a></dd>
	           	<dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
	        </dl>
		</div>
			<!-- <footer id="footer">
				<a href="https://twitter.com/fantasyHitasoft" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
</div>	

<style>
li{
	font-weight:normal;
}

</style>