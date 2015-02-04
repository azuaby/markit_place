<?php
$roundProfile = "";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:150px;";
}
$output = "";
if (!empty($commentModel)){
	foreach($commentModel as $comment){
		$itemId = $comment['Item']['id'];
		$itemname = $comment['Item']['item_title'];
		$itemurl = $comment['Item']['item_title_url'];
		$userComment = $comment['Comment']['comments'];
		$username = $comment['User']['first_name'];
		$usernameUrl = $comment['User']['username_url'];
		$profileImage = $comment['User']['profile_image'];
		if ($profileImage == "")
			$profileImage = "usrimg.jpg";
		$output .= "<li>";
			$output .= '<div class="comment-container">';
				$output .= '<div class="comment-image">';
					$output .= '<a href="'."people/".$usernameUrl.'" title="'.$username.'">';
					$output .= '<img alt="'.$username.'" src="'.$_SESSION['media_url'].
						'media/avatars/thumb70/'.$profileImage.'">';
					$output .= '</a>';
				$output .= '</div>';
				$output .= '<div class="comment-content">';
					$output .= '<p class="comment-username">';
						$output .= '<a href="'.SITE_URL."people/".$usernameUrl.'" title="'.$username.'">';
							$output .= $username;
							$output .= "<span class='anchoratuser'>@".$usernameUrl."</span>";
						$output .= '</a>';
					$output .= '</p>';
					$output .= '<p class="comment-itemlink">';
						$output .= 'Commented On:';
						if (!empty($itemname)){
							$output .= '<a href="'.SITE_URL."listing/".$itemId."/".$itemurl.'" title="'.$itemname.'">';
								$output .= $itemname;
							$output .= '</a>';
						}else{
							$output .= 'Status';
						}
					$output .= '</p>';
					$output .= '<p class="comment-data">';
						$output .= $userComment;
					$output .= '</p>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</li>';
	}
}else{
	//$output = "false";
}
echo $output;