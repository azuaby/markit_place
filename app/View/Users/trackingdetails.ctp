<div class="container set_area" style="width:940px;">
    <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('My Sales'); ?></h2>
        <div class="markshippedcontent">
        	<?php 
	        	$shipmentDate = '';
	        	$trackid = '';
	        	$couriername = '';
	        	$courierservice = '';
	        	$notes = '';
        		if (!empty($trackingModel)){
        			$title = __('Edit Tracking Details');
        			echo '<input type="hidden" id="trackid" value="'.$trackingModel['Trackingdetails']['id'].'" />';
        			$shipmentDate = $trackingModel['Trackingdetails']['shippingdate'];
        			$trackid = $trackingModel['Trackingdetails']['trackingid'];
        			$couriername = $trackingModel['Trackingdetails']['couriername'];
        			$courierservice = $trackingModel['Trackingdetails']['courierservice'];
        			$notes = $trackingModel['Trackingdetails']['notes'];
        			
        		}else{
        			$title = __('Add Tracking Details');
        			echo '<input type="hidden" id="trackid" value="0" />';
        		}
        	?>
        	<div class="markshiphead"><?php echo $title; ?></div>
        	<div class="markshiporderid"><?php echo __('Order ID');?>: <?php echo $orderModel['Orders']['orderid']; ?></div>
        	<div class="markshipstatus"><?php echo __('Status');?>: 
        	<?php 
        	if (!empty($orderModel['Orders']['status'])){
        		echo $orderModel['Orders']['status']; 
        		echo '<input type="hidden" id="hiddenorderstatus" value="'.$orderModel['Orders']['status'].'" />';
        	}else{
        		echo "Pending";
        		echo '<input type="hidden" id="hiddenorderstatus" value="Pending" />';
        	}
        	?>
        	</div></br>
        	<div class="markshipbuyeraddr">
        		<p class="markshipbuyeraddrhead"><?php echo __('Buyer Details');?>: </p>
        		<div class="markshipbuyerdetails">
        			<p class="buyerdetaillabel"><?php echo __('Name');?>: </p><?php echo $userModel['User']['first_name']; ?></br>
        			<p class="buyerdetaillabel"><?php echo __('Address');?>:</p></br>
        			<?php 
        			$buyershipaddr = '';
        			$buyershipaddr .= $shippingModel['Shippingaddresses']['address1'].",</br>";
        			if (!empty($shippingModel['Shippingaddresses']['address2'])){
        				$buyershipaddr .= $shippingModel['Shippingaddresses']['address2'].",</br>";
        			}
        			$buyershipaddr .= $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
        			$buyershipaddr .= $shippingModel['Shippingaddresses']['state'].",</br>";
        			$buyershipaddr .= $shippingModel['Shippingaddresses']['country'].",</br>";
        			$buyershipaddr .= "Ph.: ".$shippingModel['Shippingaddresses']['phone'].".</br>";
        			echo $buyershipaddr;
        			echo '<input type="hidden" id="hiddenbuyeraddress" value="'.$buyershipaddr.'" />';
        			?>
        		</div>
        	</div></br>
        	<div class="markshipemailcont">
        		<p class="trakinglabel">
        			<?php echo __('Shipment Date');?>: &nbsp;&nbsp;
        		</p>
        		<div class="trackinginput">
        			<input type="text" name="shipmentdate" id="shipmentdate" value="<?php echo date('m/d/Y',$shipmentDate); ?>" style="width: 244px;"/>
        			<div class="shipmentdateerror error"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Shipping Method');?>: 
        		</p>
        		<div class="trackinginput">
        			<input type="text" name="couriername" id="couriername" value="<?php echo $couriername; ?>" style="width: 244px;" placeholder="Enter the Courier"/>
        			<input type="text" name="courierservice" id="courierservice" value="<?php echo $courierservice; ?>" style="width: 244px;float: right;" placeholder="Shipping Service"/>
        			<div class="couriernameerror error"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Tracking Id');?>: 
        		</p>
        		<div class="trackinginput">
        			<input type="text" name="trackingid" id="trackingid" value="<?php echo $trackid; ?>" style="width: 97.5%;"/>
        			<div class="trackingiderror error"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Additional Notes');?>: 
        		</p>
        		<div class="trackinginput">
        			<textarea rows="10" cols="15" id="notes" style="width: 97.5%;"><?php echo $notes; ?></textarea>
        		</div>
        		<div class="markshipbtn">
        			<div class="updatetrackingloader">
        				<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." />
        			</div>
        			<button class="markshippedbtn" onclick="return addtracking();"><?php echo $title; ?></button>
        			<a href="<?php echo SITE_URL; ?>orders">
        				<button class="markshippedbtn" style="margin-right:0;"><?php echo __('Cancel');?></button>
        			</a>
        		</div>
        	</div>
        	<input type="hidden" id="hiddenorderid" value="<?php echo $orderModel['Orders']['orderid']; ?>" />
        	<input type="hidden" id="hiddenbuyeremail" value="<?php echo $userModel['User']['email']; ?>" />
        	<input type="hidden" id="hiddenbuyername" value="<?php echo $userModel['User']['first_name']; ?>" />
        </div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer"><?php echo __('Disputes'); ?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>orders" class="current" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
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
<script type="text/javascript">
$(document).ready(function(){
	var dateToday = new Date() ;
	$("#shipmentdate").datepicker({minDate:  dateToday });
});
</script>
