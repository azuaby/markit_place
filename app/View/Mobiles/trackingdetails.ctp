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
        	<div class="ui-body ui-body-a" style="font-size:14px;">
        		<p class="trakinglabel">
        			<?php echo __('Shipment Date');?>: &nbsp;&nbsp;
        		</p>
        		<div class="trackinginput">
        			<input type="text" data-role="date" name="shipmentdate" id="shipmentdate" value="<?php echo date('m/d/Y',$shipmentDate); ?>" style="width: 244px;"/>
        			<div class="shipmentdateerror error" style="color:red;font-size:14px;"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Shipping Method');?>: 
        		</p>
        		<div class="trackinginput">
        			<input type="text" name="couriername" id="couriername" value="<?php echo $couriername; ?>" placeholder="Enter the Courier"/>
        			<input type="text" name="courierservice" id="courierservice" value="<?php echo $courierservice; ?>" placeholder="Shipping Service"/>
        			<div class="couriernameerror error" style="color:red;font-size:14px;"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Tracking Id');?>: 
        		</p>
        		<div class="trackinginput">
        			<input type="text" name="trackingid" id="trackingid" value="<?php echo $trackid; ?>"/>
        			<div class="trackingiderror error" style="color:red;font-size:14px;"></div>
        		</div>
        		<p class="trakinglabel">
        			<?php echo __('Additional Notes');?>: 
        		</p>
        		<div class="trackinginput">
        			<textarea rows="10" cols="15" id="notes"><?php echo $notes; ?></textarea>
        		</div>
        		<div class="markshipbtn">
        			<div class="updatetrackingloader">
        				<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="display:none;"/>
        			</div>
        			<button class="markshippedbtn" onclick="return addtracking();" style="background:#4A84BE;color:#ffffff;text-shadow:none;"><?php echo $title; ?></button>
        			<a href="<?php echo SITE_URL; ?>mobile/orders" data-ajax="false" style="text-decoration:none;">
        				<button class="markshippedbtn" style="margin-right:0;background:#4A84BE;color:#ffffff;text-shadow:none;"><?php echo __('Cancel');?></button>
        			</a>
        		</div>
        	</div>
        	<input type="hidden" id="hiddenorderid" value="<?php echo $orderModel['Orders']['orderid']; ?>" />
        	<input type="hidden" id="hiddenbuyeremail" value="<?php echo $userModel['User']['email']; ?>" />
        	<input type="hidden" id="hiddenbuyername" value="<?php echo $userModel['User']['first_name']; ?>" />
        	<?php 
        	if (!empty($orderModel['Orders']['status'])){
        		//echo $orderModel['Orders']['status']; 
        		echo '<input type="hidden" id="hiddenorderstatus" value="'.$orderModel['Orders']['status'].'" />';
        	}else{
        		echo "Pending";
        		echo '<input type="hidden" id="hiddenorderstatus" value="Pending" />';
        	}
        	?>  
        	
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
        			//echo $buyershipaddr;
        			echo '<input type="hidden" id="hiddenbuyeraddress" value="'.$buyershipaddr.'" />';
        			?>
	</div>

			
<script type="text/javascript">
$(document).ready(function(){
	var dateToday = new Date() ;
	$("#shipmentdate").datepicker({minDate:  dateToday });
});
</script>
