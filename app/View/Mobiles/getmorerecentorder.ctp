
<?php 
$message = '';
if (!empty($orderDetails)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach($orderDetails as $ky=>$orderDetail){
				if ($ky < 10) {
					$orderid = $orderDetail['orderid'];
					$usid = $loguser[0]['User']['id'];
					$message.= '<div class="ui-body ui-body-a" style="background:#CECECE;">';
					$message.= '<b>'.date('M d,Y h:i ',$orderDetail['saledate']).'</b>';
					$message.= '<br />';
					$message.= 'Order : '.$orderid;
					$message.= '</div>';$message.= '<br />';
					$message.= '<div class="ui-body ui-body-a" style="border-radius:5px;" onclick="loadsalesdetails('.$orderid.')">';
					
					$message.= '<table style="width:100%;">';
					$message.= '<tbody>';
					foreach ($orderDetail['orderitems'] as $orderItem){
					$message.= '<tr><td style="width:80px;">';
					$message.= '<img src="'.$orderItem['itemimage'].'"></td>';
					$message.= '<td><table><tr><td><b>'.$orderItem['itemname'].'</b></td></tr>';
					$message.= '<tr><td>Units : '.$orderItem['quantity'].'</td></tr>';
					
							if ($orderDetail['status'] != '' && $orderDetail['status'] != 'Paid'){
								$orderstatus = $orderDetail['status'];
							}elseif ($orderDetail['status'] != 'Paid'){
								$orderstatus = "Pending";
							}else {
								$orderstatus =  "Delivered";
							}					
					
					$message.= '<tr><td>Status : '.$orderstatus.'</td></tr>';
					$message.= '<tr><td>Price : '.$orderItem['cSymbol'].$orderItem['price'].'</td></tr>';
					$message.= '</table>';
					$message.= '</tr>';
					}
					$message.= '</tbody></table>';
					$message.= '</div>';$message.= '<br />';
					}
		}
	$result[] = $latestcount;
	$result[] = $message;
	$output = json_encode($result);
	echo $output;	
}else{
	echo "false";
}




