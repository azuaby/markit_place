<div class="container set_area">
        <div id="content">
        <div class="ui-body ui-body-a">
        <h3 class="ptit"><?php echo __('My Sales'); ?></h3> 
        </div>
        <div class="figure-row">
        <div class="ui-body ui-body-a">
	        <div class="markshiphead" style="font-size:14px; margin-bottom: 14px;">
	        	My Sales
	        	<span class="myordertimeline"> (From one month range)</span>
	        	<div class="viewoldorder"><a data-ajax="false" href="<?php echo SITE_URL;?>mobile/oldorders" title="view old orders">View old orders</a></div>
	        </div>
        </div>
         <div class="prvcmntcont"> 
         <div class="ui-body ui-body-a">
         <div style="with:98%!important;padding:15px;height:45px;">
				<div style="width:10%;float:left;text-align:center;">Order</div>
				<div style="width:30%;float:left;text-align:center;">Product</div>
				<div style="width:10%;float:left;text-align:center;">Total</div>
				<div style="width:14%;float:left;text-align:center;">Sale Date</div>
				<div style="width:14%;float:left;text-align:center;">Status</div>
				<div style="width:20%;float:left;text-align:center;">Options</div>
			</div>
		<?php
			if (count($orderDetails) > 0) { ?>
        	
        			<?php 
        			//if(count($_GET)==0){
        				if(!empty($orderDetails)){
				foreach($orderDetails as $ky=>$orderDetail){
					if ($ky < 10) {
				
					$orderid = $orderDetail['orderid'];
					$usid = $loguser[0]['User']['id'];
						?>
					<div style="with:98%!important;padding:15px;height:45px;">
						<div style="width:10%;float:left;text-align:center;"><?php echo $orderid; ?></div>
						<?php 
						echo '<div style="width:30%;float:left;text-align:center;" class="producttd">';
						foreach ($orderDetail['orderitems'] as $orderItem){
							echo "<div class='myorderpro'><div class='myorderproitm'>".$orderItem['quantity']." x ".$orderItem['itemname']."</div>
								<div class='myorderpropri'>".$orderItem['cSymbol'].$orderItem['price']."</div></div>";
						}
						echo "</div>";?>
						<div style="width:10%;float:left;text-align:center;"><?php echo $orderItem['cSymbol'].$orderDetail['price'] ?></div>
						<div style="width:14%;float:left;text-align:center;"><?php echo date('d/m/Y',$orderDetail['saledate']); ?></div>
						<div style="width:14%;float:left;text-align:center;" class="status<?php echo $orderid; ?>"><?php 
							if ($orderDetail['status'] != ''){
								echo $orderDetail['status'];
							}else{
								echo "Pending";
							}?></div>
						<div style="width:20%;float:left;text-align:center;">
							<div class="moreactionmyord">
								<span class="moreactions" style="cursor: pointer;" onclick="openmenu('<?php echo $orderid; ?>');">
								<?php echo "More Actions" ?><i class="glyphicons chevron-right headarrdwn"></i>
								</span>
								<div class="moreactionlistmyord moreactionlistmyord<?php echo $orderid; ?>" style="display:none;">
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
							<!--- JQM div---->
						</div>
					</div>
					<!---- JQM div ---->
							
				<?php
				} }?>
        	
        	<?php 
			}//}
			?></div>
			<?php if (count($orderDetail) > 10) {?>
        					<div class="loadmorecomment" style="margin: 19px 0 0;font-size:12px;font-weight:bold;" onclick="loadmorecommentoldorders('<?php echo $usid ?>')">
        						Load More
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php }} else{
        					echo "<div class='noordercmnt' style='text-align:center;'>No Orders Found</div>";
        					echo "</div>";
        				} ?>
		</div>	
	</div>
	</div>
			
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
				        $('.loadmorecomment').html('No more comments');
					}
				}
			});
		}
	}

	
	
</script>
