<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('My Sales'); ?></h2> 
        <div class="figure-row" style="padding: 20px 34px 18px;">
        <div class="markshiphead" style="font-size:14px; margin-bottom: 14px;">
        	My Sales
        	<span class="myordertimeline"> (From one month range)</span>
        	<div class="viewoldorder"><a href="<?php echo SITE_URL;?>oldorders" title="view old orders">View old orders</a></div>
        </div>
		<?php
			if (count($orderDetails) > 0) { ?>
        	<table class="myorderslist">
        		<thead>
        			<tr>
	        			<th>#Order</th>
	        			<th class="producttd">Products</th>
	        			<th>Total</th>
	        			<th>Sale Date</th>
	        			<th>Status</th>
	        			<th>Options</th>
	        		</tr>
        		</thead>
        		<tbody>
        			<?php 
				foreach($orderDetails as $ky=>$orderDetail){
					$orderid = $orderDetail['orderid'];
						?>
					<tr>
						<td><?php echo $orderid; ?></td>
						<?php 
						echo "<td class='producttd'>";
						foreach ($orderDetail['orderitems'] as $orderItem){
							echo "<div class='myorderpro'><div class='myorderproitm'>".$orderItem['quantity']." x ".$orderItem['itemname']."</div>
								<div class='myorderpropri'>".$orderItem['cSymbol'].$orderItem['price']."</div></div>";
						}
						echo "</td>";?>
						<td style="text-align:right;"><?php echo $orderItem['cSymbol'].$orderDetail['price'] ?></td>
						<td><?php echo date('d/m/Y',$orderDetail['saledate']); ?></td>
						<td class="status<?php echo $orderid; ?>" style="width: 70px;"><?php 
							if ($orderDetail['status'] != ''){
								echo $orderDetail['status'];
							}else{
								echo "Pending";
							}?></td>
						<td>
							<div class="moreactionmyord">
								<span class="moreactions" style="cursor: pointer;" onclick="openmenu('<?php echo $orderid; ?>');">
								<?php echo "More Actions" ?><i class="glyphicons chevron-right headarrdwn"></i>
								</span>
								<div class="moreactionlistmyord moreactionlistmyord<?php echo $orderid; ?>">
									<ul>
										<?php if ($orderDetail['status'] == '') {?>
										<li class="moreactionsli Processing<?php echo $orderid; ?>" onclick="markprocess('<?php echo $orderid; ?>','Processing')">Mark Process
											<img class="process-loader-<?php echo $orderid; ?>" src="<?php echo SITE_URL; ?>images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">
										</li>
										<?php }
											if ($orderDetail['status'] == '' || $orderDetail['status'] == 'Processing') {
										?>
										<li class="moreactionsli Shipped<?php echo $orderid; ?>" onclick="markprocess('<?php echo $orderid; ?>','Shipped')">Mark Shipped</li>
										<?php } 
											if ($orderDetail['status'] != 'Delivered') {
										?>
										<li class="moreactionsli" onclick="markprocess('<?php echo $orderid; ?>','Track')">Add Tracking</li>
										<?php } ?>
										<li class="moreactionsli" onclick="showInvoicePopup('<?php echo $orderid; ?>')">View invoice
											<img class="inv-loader-<?php echo $orderid; ?>" src="<?php echo SITE_URL; ?>images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">
										</li>
										<li class="moreactionsli" onclick="markprocess('<?php echo $orderid; ?>','ContactBuyer')">Contact Buyer</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
							
				<?php
				} ?>
        		</tbody>
        	</table>
        	<?php 
			}else {
				echo '<div style="text-align:center;color:#ff0000;font-size:14px;">
						Recently no orders have been placed for you</div>';
			} ?>
		</div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt>ACCOUNT</dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > Profile</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > Password</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i>Add Shipping</a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" class="current" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt>SHARING</dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> Credits</a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> Referrals</a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> Gift card</a></dd>
	        </dl>
		</div>
				<footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				<!-- / footer-nav -->
			</footer>
			
</div>	
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jQuery.print.js"></script>
<script>
var lastmenuid = 0;
$('.inv-close').live ('click',function(){
	$('#invoice-popup-overlay').hide();
	$('#invoice-popup-overlay').css("opacity", "0");
});
$('.inv-print').live('click',function(){
	$("#userdata").print();
	return (false);
});

$(document).click(function(event) {
	  var target = $(event.target);

	  if (!target.hasClass('moreactions') && !target.hasClass('moreactionsli') && !target.hasClass('headarrdwn')) {
	    $('.moreactionlistmyord').hide();
	  }
});

function openmenu(oid) {
	if (lastmenuid != 0 && lastmenuid != oid){
		$('.moreactionlistmyord'+lastmenuid).slideUp('fast');
	}
	lastmenuid = oid;
	$('.moreactionlistmyord'+oid).slideToggle('fast');
}
</script>