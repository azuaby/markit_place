<?php 
if (!empty($messageModel)){
	$tid = $offset;
	/* foreach ($messageUnread as $unread){
		$message = $messageModel[$unread];
		$csId = $message['csid'];
		$item = $message['item'];
		$itemid = $message['itemid'];
		$itemurl = $message['itemurl'];
		$tid++;
		echo "<tr class='msgunread'>
			<td>".$tid."</td>
			<td>".$message['from']."</td>
			<td>".$message['to']."</td>
			<td><a href='".SITE_URL.'listing/'.$itemid.'/'.$itemurl."'>".$item."</a></td>
			<td>".$message['subject']."</td>
			<td><a href='".SITE_URL.'viewmessage/'.$csId."'>View</a></td>
		</tr>";
	} */
        		
	foreach($messageModel as $ky=>$message){
		$csId = $message['csid'];
		$item = $message['item'];
		$itemid = $message['itemid'];
		$itemurl = $message['itemurl'];
		$bold = '';
		if ($message['unread'] == 1)
			$bold = "class='msgunread'";
		//if (!in_array($ky, $messageUnread)) {
			$tid++;
			echo '<tr '.$bold.' >
				<td>'.$tid.'</td>
				<td>'.$message['from'].'</td>
				<td>'.$message['to'].'</td>
				<td><a href="'.SITE_URL.'listing/'.$itemid.'/'.$itemurl.'">'.$item.'</a></td>
				<td>'.$message['subject'].'</td>
				<td><a href="'.SITE_URL.'viewmessage/'.$csId.'">View</a></td>
			</tr>';
		
		//}
	}
}else{
	echo "false";
}