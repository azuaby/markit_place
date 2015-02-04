
<?php 
$message = '';
if (!empty($messagesel)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach ($messagesel as $key=>$msg) {
		if ($msg['Disputes']['userid'] == $userid) {
			$v="View";
			$dot="...";
			$position=8;
			$msdi = substr($msrm, 0, $position);
			
			//$message .=  '<table class="myorderslist" style="width: 690px;">';
			//$message .=  '<tbody>';
			$message .=  '<tr>';
			$message .=  '<td style="width: 180px;text-align:left; padding: 0 0 0 17px;height:40px;">'.$msg['Disputes']['uorderstatus'].'</td>';
			$message .=  ' <td style="width:80px;text-align:left;padding: 0 0 0 21px;height:40px;">'.$msg['Disputes']['uorderid'].'</td>';
			$message .=  '<td style="width:150px;text-align:left;padding: 0 0 0 20px;height:40px;">'.$msg['Disputes']['uorderplm'].'</td>';
			$message .=  ' <td style="width:180px;text-align:left;padding: 0 0 0 10px;height:40px;">'.substr($msg['Disputes']['uordermsg'], 0 , $position).$dot.'</td>';
			$message .=  '<td style="width:100px;text-align:left;padding: 0 0 0 23px;height:40px;">'.'<a href="'.SITE_URL.'disputemessage/'.$msg['Disputes']['uorderid'].'" class="url">';
			$message .=  $v; 
			$message .=  '</a>'.'</td>';
			$message .=  '</tr>';
			//$message .=  '</tbody>';
			//$message .=  '</table>';
			
			
			
		    
        }
	}
	$result[] = $latestcount;
	$result[] = $message;
	$output = json_encode($result);
	echo $output;	
}else{
	echo "false";
}

