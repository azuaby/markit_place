<?php 
if(isset($users_data)) {
$category = '';
	
	$category = $category. " " .'<div style="margin:0px 415px 0px 30px; font-size:14px; color:cadetblue; position:relative;">&nbsp</div>';
	$category = $category. " " .'<div style="margin:0px 415px 0px 30px; font-size:14px; color:cadetblue; position:relative;">Suggested for you</div>';
	
	
	 foreach($users_data as $data) {
	$counts = $data['count'];
	foreach($data['users'] as $userData) {
	$username = $userData['User']['username'];
	$profile_image = $userData['User']['profile_image'];
	$id = $userData['User']['id'];
	//$item_image = $userData['Photo'][0]['image_name'];
	//echo $name;	
	
	
	
	$category = $category. " " .'<div style="margin-bottom:8px;">';
	
	$category = $category. " " .'<div style="left:-230px;top: 10px; position: relative; height:80px;">';
	if($profile_image != null) {
	$category = $category. " " .'<img src="'.SITE_URL.'media/avatars/thumb70/'.$profile_image.'" class="wiz-profimage" ></br>';
	}
	else {
	$category = $category. " " .'<img src="'.SITE_URL.'media/avatars/thumb70/usrimg.jpg" class="wiz-profimage" ></br>';
	}
	$category = $category. " " .'</div>';

	$category = $category. " " .'<div style="margin:-74px 0px 0px 0px;">';
	$category = $category. " " .'<div class="wiz-usrname">';
	$category = $category. " " . ucwords($username); 
	$category = $category. " " .'</div></br>';
	$category = $category. " " .'<div class="wiz-things">';
	$category = $category. " " . $counts." things";
	$category = $category. " " .'</div></br>';
	$category = $category. " " .'<div class="wiz-folow">';
	foreach($followcnt as $flcnt){	
		$flwrcntid[] = $flcnt['Follower']['user_id'];
			
		}
		
			if($userid != $id){						
				if(!in_array($id,$flwrcntid)){
					$flw = true;
				}else{
					$flw = false;
				}
			
			if($flw){
				
				$category = $category. " " .'<span class="follow-wiz" id="foll'.$id.'" style="float:left; margin-left:112px;">';
				$category = $category. " " .'<button type="button" class="follow_btn'.$id.'"  style="margin:0px 53px 0px 0px; width:74px; height:27px;" id="verif_follow" onclick="addfollows('.$id.')">';
				$category = $category. " " .'<span class="foll'.$id.'"  >Follow</span>';
					
				$category = $category. " " .'</button>';
				$category = $category. " " .'</span>';
				}else{
				$category = $category. " " .'<span class="follow-wiz" id="unfoll'.$id.'" style="float:left; margin-left:112px;">';
				$category = $category. " " .'<button type="button" class="unfollow_btn'.$id.'" id="verif_following"  style="margin:0px 53px 0px 0px; width:74px; height:27px;" onclick="delfollows('.$id.')">';
				$category = $category. " " .'<span class="unfoll'.$id.'"  >Following</span>';
					
				$category = $category. " " .'</button>';
				$category = $category. " " .'</span>';
			}	
		$category = $category. " " .'<span id="changebtn'.$id.'" ></span>';	
		}	
	
	$category = $category. " " .'</div></br>';
	$category = $category. " " .'</div>';
	
	$category = $category. " " .'<div class="wiz-image">';
	foreach($data['datas'] as $userItem) {
	$img = $_SESSION['media_url']."media/items/thumb150/".$userItem['Photo'][0]['image_name'];
	$category = $category. " " .'<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 80px; height: 80px; margin-right:6px;"></span>';
	
	}
	$category = $category. " " .'</div>';
	
	
	
		}
	$category = $category. " " .'</div>';
	
	}
	
	
	
	

	

	echo $category;
	
	
}else{
	echo "false";
}		
				
	
