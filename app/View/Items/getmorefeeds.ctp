<?php
if($result == "livefeeds") {
	$result = "livefeeds";
} else {
	$result = "notification";

}
if (!empty($loguserdetails)){ 
	$append = '';
	if (isset($newstatus)){
		$append = ' addedli stli" style="display:none;" ';
	}else{
		$append = '';
	}
	$output = '';
	foreach ($loguserdetails as $log){ 
		$logId = $log['Log']['id'];
		$type = $log['Log']['type'];
		$feedImages = json_decode($log['Log']['image'],true);
		$notifymsg = $log['Log']['notifymessage'];
		$feedMessage = $log['Log']['message'];
		$ldate = $log['Log']['cdate'];
		$pastTime = UrlfriendlyComponent::txt_time_diff($ldate);
		$logUserid = $log['Log']['userid'];
	
	$output .= '<li class="feed'.$logId.$append.'" id="'.$result.'">';
		$output .= "<div class='mainfeed-cont'>";
			$output .= "<div class='feed-title'>";
				$output .= "<div class='feeduser-details'>";
					$output .= "<a href='".$feedImages['user']['link']."' >";
						$output .= "<img src='".SITE_URL.'media/avatars/thumb150/'.
								$feedImages['user']['image']."' />";
					$output .= "</a>";
					$output .= "<div class='feed-notify'>";
						$notifymsg = explode('-___-', $notifymsg); 
							foreach($notifymsg as $nmsg){
								$output .= __($nmsg);
							}
					$output .= "</div>";
					$output .= "<div class='feed-pasthour'>";
						$output .= $pastTime;
					$output .= "</div>";
					if ($type == 'status' && $userid == $logUserid){
						$output .= "<span class='deletepost glyphicons delete' onclick='deletepost(".$logId.")'></span>";
					}
				$output .= "</div>";
			$output .= "</div>";
			if (isset($feedImages['item']) || isset($feedImages['status'])){
			$output .= "<div class='feed-content'>";
				if (isset($feedImages['item'])){
					$output .= "<a href='".$feedImages['item']['link']."' >";
						$output .= "<div id='".$result."' class='feed-image' style='background-image:url(\"".SITE_URL.
								'media/items/original/'.$feedImages['item']['image']."\")'>";
						$output .= "</div>";
					$output .= "</a>";
				}elseif(isset($feedImages['status'])){
					$output .= "<div class='feed-status-image'>";
						$output .= "<img src='".SITE_URL.
						'media/status/original/'.$feedImages['status']['image']."' />";
					$output .= "</div>";
				}
			$output .= "</div>";
			}
			$output .= "</div>";
			if(!empty($feedMessage)){
				if($result == "livefeeds") {
					$output .= "<div class='feed-message'>";
				}
				else {
					$output .= "<div class='feed-message' style='width:730px;'>";
				}
				$output .= $feedMessage;
				$output .= "</div>";
				if ($type == 'status'){
					$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
					$atuserPattern = '/<span[^<>]*?[^<>]*?>(.@?)<\/span>/';
					$hashPattern = '/<span[^<>]*?[^<>]*?>(.*#)<\/span>/';
					$withoutAnchortag = preg_replace($pattern, '$1', $feedMessage);
					$withoutAtuserspan = preg_replace($atuserPattern, '$1', $withoutAnchortag);
					$withoutHashspan = preg_replace($hashPattern, '$1', $withoutAtuserspan);
					$output .= "<div class='status".$logId." deletestatus'>".$withoutHashspan."</div>";
				}
			}else{
			$output .= "<div style='padding:0 0 3px'></div>";
		}
	$output .= "</li>";
	}
	echo $output; 
}else{
	//echo "false";
}
