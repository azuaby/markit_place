
<?php 
$message = '';
if (!empty($messagebuyer)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach ($messagebuyer as $key=>$msgbuy) {
		if ($msgbuy['Disputes']['selid'] == $userid) {
			$v="View";
			$position=8;
			$msdi = substr($msrm, 0, $position);
			//$message .=  '<div class="Table">';
			$dot="...";
			$message .=  '<tr>';
			$message .=  ' <td style="width: 180px;text-align:left; padding: 0 0 0 15px">'.$msgbuy['Disputes']['uorderstatus'].'</td>';
			$message .=  '<td style="width:80px;text-align:left;padding: 0 0 0 22px;">'.$msgbuy['Disputes']['uorderid'].'</td>';
			$message .=  ' <td style="width:150px;text-align:left;padding: 0 0 0 19px;">'.$msgbuy['Disputes']['uorderplm'].'</td>';
			$message .=  '<td style="width:180px;text-align:left;">'.substr($msgbuy['Disputes']['uordermsg'], 0 , $position).$dot.'</td>';
			$message .=  ' <td style="width:100px;text-align:left;">  '.'<a href="'.SITE_URL.'disputemessage/'.$msgbuy['Disputes']['uorderid'].'" class="url">';
			$message .=  $v; 
			$message .=  '</a>'.'</td>';
			$message .=  '</tr>';
			//$message .=  '</div>';
			
			
			
		    
        }
	}
	$result[] = $latestcount;
	$result[] = $message;
	$output = json_encode($result);
	echo $output;	
}else{
	echo "false";
}

