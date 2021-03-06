<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('My Sales'); ?></h2> 
        <div class="figure-row" style="padding: 20px 34px 18px;">
        <div class="markshiphead" style="font-size:14px; margin-bottom: 14px;">
        	<?php echo __('My Sales');?>
        	<span class="myordertimeline"> (<?php echo __('From one month range');?>)</span>
        	<div class="viewoldorder"><a href="<?php echo SITE_URL;?>oldorders" title="view old orders"><?php echo __('View old orders');?></a></div>
        </div>
         <div class="prvcmntcont"> 
		<?php
			if (count($orderDetails) > 0) { ?>
        	<table class="myorderslist">
        		<thead>
        			<tr>
	        			<th>#<?php echo __('Order');?></th>
	        			<th class="producttd"><?php echo __('Products');?></th>
	        			<th><?php echo __('Total');?></th>
	        			<th><?php echo __('Sale Date');?></th>
	        			<th><?php echo __('Status');?></th>
	        			<th><?php echo __('Options');?></th>
	        		</tr>
        		</thead>
        		<tbody>
        			<?php 
        			//if(count($_GET)==0){
        				if(!empty($orderDetails)){
				foreach($orderDetails as $ky=>$orderDetail){
					if ($ky < 10) {
				
					$orderid = $orderDetail['orderid'];
					$usid = $loguser[0]['User']['id'];
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
						<?php 
							if ($orderDetail['status'] != '' && $orderDetail['status'] != 'Pending' && $orderDetail['status'] != 'Paid' && $orderDetail['status'] != 'Delivered'){
								$orderStatusCurrent = $orderDetail['status'];
								$statusColor = "#25A525";
							}elseif ($orderDetail['status'] != 'Paid' && $orderDetail['status'] != 'Delivered'){
								$orderStatusCurrent = "Pending";
								$statusColor = "#A52525";
							}else {
								$orderStatusCurrent = "Delivered";
								$statusColor = "#2525A5";
							}?>
						<td class="status<?php echo $orderid; ?>" style="width: 70px;color:<?php echo $statusColor; ?>;"><?php 
							echo $orderStatusCurrent;
							?></td>
						<td>
							<div class="moreactionmyord">
								<span class="moreactions" style="cursor: pointer;" onclick="openmenu('<?php echo $orderid; ?>');">
								<?php echo __('More Actions'); ?><i class="glyphicons chevron-right headarrdwn"></i>
								</span>
								<div class="moreactionlistmyord moreactionlistmyord<?php echo $orderid; ?>">
									<ul>
										<?php if ($orderDetail['status'] == '' || $orderDetail['status'] == 'Pending') {?>
										<li class="moreactionsli Processing<?php echo $orderid; ?>" onclick="markprocess('<?php echo $orderid; ?>','Processing')"><?php echo __('Mark Process');?>
											<img class="process-loader-<?php echo $orderid; ?>" src="<?php echo SITE_URL; ?>images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">
										</li>
										<?php }
											if ($orderDetail['status'] == '' || $orderDetail['status'] == 'Pending' || $orderDetail['status'] == 'Processing') {
										?>
										<li class="moreactionsli Shipped<?php echo $orderid; ?>" onclick="markprocess('<?php echo $orderid; ?>','Shipped')"><?php echo __('Mark Shipped');?></li>
										<?php } 
											if ($orderDetail['status'] != 'Delivered' && $orderDetail['status'] != 'Paid') {
										?>
										<li class="moreactionsli" onclick="markprocess('<?php echo $orderid; ?>','Track')"><?php echo __('Add Tracking');?></li>
										<?php } ?>
										<li class="moreactionsli" onclick="showInvoicePopup('<?php echo $orderid; ?>')"><?php echo __('View invoice');?>
											<img class="inv-loader-<?php echo $orderid; ?>" src="<?php echo SITE_URL; ?>images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">
										</li>
										<li class="moreactionsli" onclick="markprocess('<?php echo $orderid; ?>','ContactBuyer')"><?php echo __('Contact Buyer');?></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
							
				<?php
				} }?>
        		</tbody>
        	</table>
        	<?php 
			}//}
			?></div>
			<?php if (count($orderDetails) > 9) {?>
        					<div class="loadmorecomment" style="margin: 19px 0 0;font-size:12px;font-weight:bold;" onclick="loadmorecommentoldorders('<?php echo $usid ?>')">
        						<?php echo __('Load More');?>
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php }} else{
        					echo "<div class='noordercmnt' style='text-align:center;'>" ?><?php echo __('No Orders Found');echo "</div>";
        					echo "</div>";
        				} ?>
		</div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i><?php echo __('Add Shipping');?></a></dd>
	            
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders"   class="current"><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
	        </dl>
		</div>
				<!-- <footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
			
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

<script type="text/javascript">
	var crntcommentcnt = '<?php echo count($orderDetails); ?>';
	var order_id = '<?php echo $usid; ?>';
	//alert (order_id);
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 10;
	var baseurl = getBaseURL();

	
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
		//alert ($usid);
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getrecentorder',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'userid': order_id, 'contact': 'buyer', },
				success: function(responce){
					if (responce) {
						var output = eval(responce);
						crntcommentcnt = output[0];
						var previousmsg = $('.prvcmntcont').html();
					    var currentmsg = output[1] + previousmsg;
				        $('.prvcmntcont').html(currentmsg);
				        cmntupdate = 1;
					}else{
						cmntupdate = 1;
					}
				}
			});
		//}
		console.log('Calling recursive function');
	}
	
	setInterval(getcurrentcmnt, 500000);

	function loadmorecommentoldorders(upid){
		//alert(uid);
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorerecentorder',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','userid':upid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce){
						var output = eval(responce);
				        $('.prvcmntcont').append(output[1]);
				        loadmoreajax = 1;
						loadmorecmntcnt += 10;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No more Orders');
					}
				}
			});
		}
	}

	
	
</script>
