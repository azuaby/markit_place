
<?php 
$message = '';
if (!empty($orderDetails)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach ($orderDetails as $ky=>$orderDetail) {
		if ($loguser[0]['User']['id'] == $userid) {
			$orderid=$orderDetail['Orders']['orderid'];
			$orderid = $orderDetail['orderid'];
			$da=date('d/m/Y',$orderDetail['saledate']);
			//$message .='<div class="figure-row" style="padding: 20px 34px 18px;">';
			$message .='<table class="myorderslist">';
			$message .= '<tbody>';
			$message .= '<tr>';
			$message .='<td style="width: 52px;">'.$orderid.'</td>';
			
			$message .='<td class="producttd" >';
			foreach ($orderDetail['orderitems'] as $key=>$orderItem){
				$message .= '<div class="myorderpro">'.'<div class="myorderproitm">'.$orderItem['quantity']." x ".$orderItem['itemname'].'</div>';
				$message .= '<div class="myorderpropri">'.$orderItem['cSymbol'].$orderItem['price'].'</div>'.'</div>';
			}
			$message .='</td>';
			$message .='<td style="text-align:right;width: 38px;">'. $orderItem['cSymbol'].$orderDetail['price'].'</td>';
			$message .='<td style="width:82px;">'. $da.'</td>';
			if ($orderDetail['status'] != '' && $orderDetail['status'] != 'Paid' && $orderDetail['status'] != 'Delivered'){
				$orderStatusCurrent = $orderDetail['status'];
				$statusColor = "#25A525";
			}elseif ($orderDetail['status'] != 'Paid' && $orderDetail['status'] != 'Delivered'){
				$orderStatusCurrent = "Pending";
				$statusColor = "#A52525";
			}else {
				$orderStatusCurrent = "Delivered";
				$statusColor = "#2525A5";
			}
			$message .='<td class="status.$orderid" style="width: 70px;color:'.$statusColor.';" >';
			$message .= $orderStatusCurrent;
			$message .='</td>';
			
			//echo "<td><button onclick=\"delete_purchase('" . $row['purch_id'] . "')\">Kill</button></td>";
			
			$message .='<td ">';
			$message .='<div class="moreactionmyord">';
			$orderid = $orderDetail['orderid'];
			$message .='<span class="moreactions" style="cursor: pointer;" onclick="openmenu(\''.$orderid.'\')" >';
			
			//echo '<div><span id="anything" onclick="updatePos(\''.$ratelink.'\')">Save</div>';
			$message .="More Actions".'<i class="glyphicons chevron-right headarrdwn">'.'</i>';
			$message .='</span>';
			$message .='<div class="moreactionlistmyord moreactionlistmyord'.$orderid.'" style="width: 142%;">';
			$message .='<ul>';
			if ($orderDetail['status'] == '') {
				$pro="Processing";
			$message .='<li class="moreactionsli Processing'.$orderid.'" onclick="markprocess(\''.$orderid.'\',\''.$pro.'\')">Mark Process';
			$message .='<img class="process-loader-'. $orderid.'" src="'. SITE_URL.' images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">';
			$message .='</li>';
			}	
			if ($orderDetail['status'] == '' || $orderDetail['status'] == 'Processing') {
				$shi="Shipped";
			$message .='<li class="moreactionsli Shipped'.$orderid.'" onclick="markprocess(\''.$orderid.'\',\''.$shi.'\')">Mark Shipped</li>';
					}
			if ($orderDetail['status'] != 'Delivered' && $orderDetail['status'] != 'Paid') { 
				$tr="Track";
			
			$message .='<li class="moreactionsli" onclick="markprocess(\''.$orderid.'\',\''.$tr.'\')">Add Tracking</li>';
			}
			$message .='<li class="moreactionsli" onclick="showInvoicePopup(\''.$orderid.'\')">View invoice';
			$message .='<img class="inv-loader-'. $orderid.'" src="'. SITE_URL.' images/loading.gif" style="display: none; float: right; width: 12px; padding-top: 6px;">';
			$message .='</li>';
			$con="ContactBuyer";
			$message .='<li class="moreactionsli" onclick="markprocess(\''.$orderid.'\',\''.$con.'\')">Contact Buyer</li>';
			$message .='</div>';
			$message .='</div>';
				
			$message .='</td>';
			$message .='</tr>';
			$message .= '</tbody>';
			$message .='</table>';
		    //$message .='</div>';
        }
	}
	$result[] = $latestcount;
	$result[] = $message;
	$output = json_encode($result);
	echo $output;	
}else{
	echo "false";
}




