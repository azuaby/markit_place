<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
<table>
				<tr><td>
	        		<span class="orderdetlshead"><?php echo __('Order Number');?> </span>
	        		</td><td> :
	        		<?php echo $orderModel['Orders']['orderid']; ?>
	        	</td></tr>
	        	<tr><td>
	        		<span class="orderdetlshead"><?php echo __('Status');?> </span>
	        		</td><td> :
        	<?php 
        	if ($orderModel['Orders']['status'] != '' && $orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>".$orderModel['Orders']['status']."</span>";
			}elseif ($orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>Pending</span>";
			}else {
				echo "<span class='markshipstatusrslt'>Delivered</span>";
			}?>
	        	</td></tr>	        	
	        	<tr><td>
	        		<span class="orderdetlshead"><?php echo __('Buyer');?> </span>
	        		</td><td> : 
					<span class="username">
	        			<?php 
	        			echo '<a href="'.SITE_URL.'people/'.$userModel['User']['username_url'].'" class="url">';
	        			echo $userModel['User']['first_name'].'</a>'; ?>
	        		</span>
	        		<span class="usernameat">
	        			<?php echo "(@".$userModel['User']['username'].")";?>
	        		</span>
	        	</td></tr>
	        	<tr><td>
	        		<span class="orderdetlshead"><?php echo __('Order Date');?> </span>
	        		</td><td> :
	        		<?php echo date('d, M Y',$orderModel['Orders']['orderdate']); ?>
	        	</td></tr>
	        		<?php if($orderModel['Orders']['status'] != "Delivered") { }else{?>
	        		<tr><td><span class="orderdetlshead"><?php echo __('Deliver Date');?>
	        		</td><td> :
	        		<b><?php echo date('d, M Y',$orderModel['Orders']['deliver_date']); } ?></b></span>
	        	</td></tr>
	        	
	        	<tr><td>
	        		<span class="orderdetlshead"><?php echo __('Total Amount Paid');?> </span>
	        		</td><td> :
	        		<?php echo $orderModel['Orders']['totalcost']." ".$currencyCode; ?>
	        	</td></tr>
	        	
</table>
</div><br />
<div class="ui-body ui-body-a" style="background:#CECECE;"><b>Items in your order</b></div>
<div class="ui-body ui-body-a" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;font-size:13px;">
<table style="width:100%;">
        			<?php 
        			$totalShipping = 0;$totalitemprice = 0;$grandtotal = 0;
        			/*if($orderModel['Orders']['tax'])
        				$tax = $orderModel['Orders']['tax'];
        				else
        				$tax = 0;*/
        			foreach ($itemModle as $item){
        			echo '<tr>';
        				$totalprice = $item['itemprice'] + $item['shippingprice'];
        				$totalShipping += $item['shippingprice'];
        				$totalitemprice += $item['itemprice'];
					$disCouunts = $disCouunts + $item['discountAmount'];
					$tax+= $item['tax'];
					$discountType = $item['discountType'];        				
        				$taxtotal +=($item['itemprice'] * $tax) / 100; 
        				$grandtotal += $totalprice;
        				
?>

<td style="width:80px;">
		<a href = "<?php echo $_SESSION['media_url'].$item['itemurl']; ?>" title = "<?php echo $item['itemname']; ?>">
			<img src="<?php echo $_SESSION['media_url'].'media/items/thumb70/'.$item['itemimage']; ?>" alt="<?php echo $item['itemname']; ?>" />
		</a>	
</td>
<td>
	<table>
		<tr><td><?php echo '<b>'.$item['itemname'].'</b>'; ?></td></tr>
		<tr><td>Quantity : <?php echo $item['itemquantity']; ?></td></tr>
		<tr><td>Price : <?php echo $item['itemprice']; ?></td></tr>
		<tr><td>Shipping Cost : <?php echo $item['shippingprice']; ?></td></tr>
	</table>
</td>
</tr>
<?php
}
?>
</table>
</div>
<br />
<div class="ui-body ui-body-a" style="background:#CECECE;"><b>Shipping Address</b></div>
<div class="ui-body ui-body-a" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;font-size:13px;">
        		<div class="buyerviewshipdetails" style="overflow: hidden;word-wrap: break-word;">
        			<?php echo '<b>'.$userModel['User']['first_name'].'</b>'; ?></br>
        			<?php 
        			echo $shippingModel['Shippingaddresses']['address1'].",</br>";
        			if (!empty($shippingModel['Shippingaddresses']['address2'])){
        				echo $shippingModel['Shippingaddresses']['address2'].",</br>";
        			}
        			echo $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
        			echo $shippingModel['Shippingaddresses']['state'].",</br>";
        			echo $shippingModel['Shippingaddresses']['country'].",</br>";
        			echo "Ph.: ".$shippingModel['Shippingaddresses']['phone'].".</br>";
        			?>
        		</div>
</div>
<br />
<div class="ui-body ui-body-a" style="background:#CECECE;"><b>Tracking Details</b></div>
<div class="ui-body ui-body-a" style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;font-size:13px;">
        	<?php if (!empty($trackingModel)) {?>
        		<div class="buyerviewshipdetails">
        			<table>
        			<tr>
	        			<td><b>Shipment Date</b></td>
	        			<td><b> : 
	        				<?php echo date('d,M Y',$trackingModel['Trackingdetails']['shippingdate']);?>
	        			</b></td>
        			</tr>
        			<tr>
	        			<td>Tracking ID</td>
	        			<td> : 
	        				<?php echo $trackingModel['Trackingdetails']['trackingid'];?>
	        			</td>
        			</tr>
        			<tr>
	        			<td>Logestic Name</td>
	        			<td> : 
	        				<?php echo $trackingModel['Trackingdetails']['couriername'];?>
	        			</td>
        			</tr>
        			<tr>
	        			<td>Shipment Service</td>
	        			<td> : 
	        				<?php echo $trackingModel['Trackingdetails']['courierservice'];?>
	        			</td>
        			</tr>
        			<tr>
	        			<td>Additional Notes</td>
	        			<td> : 
	        				<?php echo $trackingModel['Trackingdetails']['notes'];?>
	        			</td>
        			</tr>
        			</table>
        		</div>
        	<?php }else{
        		echo "<div class='trackempty'>"?><?php echo __('Not yet updated');echo "</div>";
        		
        	} ?>
</div>
<?php 
if($orderModel['Orders']['status']!="Delivered" && $orderModel['Orders']['status']!="Paid")
{
echo '<button type="button" onclick="markprocess(\''.$orderModel['Orders']['orderid'].'\',\'Track\')" style="background:#4A84BE;color:#ffffff;text-shadow:none;">Add Tracking Details</button>';
echo '<img class="buyerst-loader-'.$orderModel['Orders']['orderid'].'" src="'.SITE_URL.'images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">';
/*	echo '<li class="moreactionsli buyerstatusmarker<?php echo $orderModel['Orders']['orderid']; ?>" >Mark Received
		
	</li>';*/
}
if($orderModel['Orders']['status']!="Delivered" && $orderModel['Orders']['status']!="Paid" && $orderModel['Orders']['status']!="Shipped" && $orderModel['Orders']['status']!="Processing")
{
echo '<button type="button" onclick="markprocess(\''.$orderModel['Orders']['orderid'].'\',\'Processing\')" style="background:#4A84BE;color:#ffffff;text-shadow:none;">Mark as Processing</button>';
echo '<img class="process-loader-'.$orderModel['Orders']['orderid'].'" src="'.SITE_URL.'images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">';

}
?>
