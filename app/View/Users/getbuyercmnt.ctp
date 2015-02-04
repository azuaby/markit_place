<?php 
$message = '';
if (!empty($messagedisp)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach($messagedisp as $key=>$msg){
		if ($msg['Dispcons']['commented_by'] == 'Buyer') {
			$message .= ' <div class="cmntcontnr">
        					<div class="usrimg">';
			$message .=  '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
			if(!empty($merchantModel['User']['profile_image'])){
				$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
			}else{
				$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
			}
									
			$message .=  '</a></div><div class="cmntdetails"><p class="usrname">';
		    $message .=  '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">'; 
		    $message .=  $merchantModel['User']['first_name']; 
		    $message .=  '</a></p><p class="cmntdate">'.date('d,M Y',$msg['Dispcons']['date']).'</p>
		        	<p class="comment">'.$msg['Dispcons']['message'].'</p></div></div>';
        }elseif ($msg['Dispcons']['commented_by'] == 'Seller') {
        	$message .=  '<div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">';
        			
        	$message .=  '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
			if(!empty($buyerModel['User']['profile_image'])){
				$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
			}else{
				$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
			}
							
			$message .=  '</a></div><div class="cmntdetails">
				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">';
        	$message .=  '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">'; 
        	$message .=  $buyerModel['User']['first_name']; 
        	$message .=  '</a></p>
		        	<p class="cmntdate">'.date('d,M Y',$msg['Dispcons']['date']).'</p>
		        	<p class="comment">'.$msg['Dispcons']['message'].'</p>
		    	</div>
        	</div>'; 
		}else{
        	$message .=  '<div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">';
        			
        	//$message .=  '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
			//if(!empty($buyerModel['User']['profile_image'])){
				//$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
			//}else{
				$message .=  '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
			//}
							
			$message .=  '</a></div><div class="cmntdetails">
				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">';
        	$message .=  '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">'; 
        	$message .=  $msg['Dispcons']['commented_by']; 
        	$message .=  '</a></p>
		        	<p class="cmntdate">'.date('d,M Y',$msg['Dispcons']['date']).'</p>
		        	<p class="comment">'.$msg['Dispcons']['message'].'</p>
		    	</div></div>
        	</div>'; 
		}
	}
	$result[] = $latestcount;
	$result[] = $message;
	$output = json_encode($result);
	echo $output;	
}else{
	echo "false";
}

