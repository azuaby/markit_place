<?php 
if (!empty($csmessageModel)){
	$cmntcontnr = 'style="text-align: right;"';
	$usrimg = 'style="float: right;"';
	$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
	foreach ($csmessageModel as $key => $csmessage) {
		if ($csmessage['Contactsellermsg']['sentby'] == $currentUser) {
			echo '<div class="cmntcontnr">
					<div class="usrimg">
		        			<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
						if(!empty($merchantModel['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
						}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
						}
							
						echo '</a>
					</div>
					<div class="cmntdetails">
						<p class="usrname">';
							echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">'; 
								echo $merchantModel['User']['first_name']; 
							echo '</a>
						</p>
						<p class="cmntdate">'.date('d,M Y',$csmessage['Contactsellermsg']['createdat']).'</p>
    	    			<p class="comment">'.$csmessage['Contactsellermsg']['message'].'</p>
			  		</div>
				</div>';
		}else{
        		echo '<div class="cmntcontnr" style="text-align: right;">
        				<div class="usrimg" style="float: right;">
        					<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
							if(!empty($buyerModel['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							echo '</a>
        			</div>
        			<div class="cmntdetails">
        				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">
        					<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">'; 
        						echo $buyerModel['User']['first_name']; 
        					echo '</a>
        				</p>
        				<p class="cmntdate">'.date('d,M Y',$csmessage['Contactsellermsg']['createdat']).'</p>
        				<p class="comment">'.$csmessage['Contactsellermsg']['message'].'</p>
		        			</div>
        				</div>';
		}
	} 
}else{
	echo "false";
}