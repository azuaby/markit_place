<?php
	App::uses('AppController', 'Controller');
	
	class ApiController extends AppController{
		public $names =  'Api';
		public $uses = array('User','Item','Comment');
		public $components = array('Email','Auth','Session','Cookie','FileUpload','Urlfriendly','RequestHandler','ColorCompare');
		public $helpers = array('Form','Html');
		
		function login(){
			$this->autoLayout = false;
			$this->autoRender = false;
		
			$email = $_POST['email'];
			$password = $_POST['password'];
			$deviceToken = $_POST['deviceToken'];
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
	
			if((!empty($email)) && (!empty($password))){
				$pass = $this->Auth->password($password);
				
				$userExist = $this->User->find('count',array('conditions'=>array('email'=>$email)));
				
				if ($userExist == 0) {
					echo '{"status":"false","message":"User does not Exist"}';
					return;
				}
				
				$userdata = $this->User->find('all',array('conditions'=>array('email'=>$email,'password'=>$pass)));
	
				if(!empty($userdata)){
	
					if ($userdata[0]['User']['activation'] == 1) {
						if ($userdata[0]['User']['user_status'] == 'enable') {
							if($this->Auth->login($userdata)){
								$cookie['email'] = $email;
								$cookie['pass'] = $pass;
								$this->Cookie->write('User',$cookie,true,'+2 weeks');
								$this->request->data['User']['id'] = $userdata[0]['User']['id'];
								$this->request->data['User']['last_login'] = date('Y-m-d H:i:s');
								$this->User->save($this->request->data);
								$userId = $userdata[0]['User']['id'];
								$userName = $userdata[0]['User']['username_url'];
								$fullname = $userdata[0]['User']['first_name'];
								$imageName = $userdata[0]['User']['profile_image'];
								
								if(isset($deviceToken)){
									$mode = 0;
									if(isset($_POST['devicemode'])){
										$mode = 1;
									}
									$this->loadModel('Userdevice');
									$userdeviceDet = $this->Userdevice->find('all',array('conditions'=>array('deviceToken'=>$deviceToken)));
									
									if(!empty($userdeviceDet)){
										$devicetokentab = $userdeviceDet[0]['Userdevice']['deviceToken'];
				                        if (isset($_POST['devicetype'])){
					                        $this->Userdevice->updateAll(array('Userdevice.user_id' => $userId, 'Userdevice.type' => $_POST['devicetype'], 'Userdevice.mode' => $mode), array('Userdevice.deviceToken' => $devicetokentab));
				                        }else{
											$this->Userdevice->updateAll(array('Userdevice.user_id' => $userId, 'Userdevice.mode' => $mode), array('Userdevice.deviceToken' => $devicetokentab));
				                        }
									}else{
										$this->request->data['Userdevice']['user_id'] = $userId;
										$this->request->data['Userdevice']['deviceToken'] = $deviceToken;
										$this->request->data['Userdevice']['mode'] = $mode;
										if (isset($_POST['devicetype'])){
										     $this->request->data['Userdevice']['type'] = $_POST['devicetype'];
										}
										$this->request->data['Userdevice']['cdate'] = time();
										$this->Userdevice->save($this->request->data);
									}
								}								
								
								if ($imageName == ''){
									$imageName = "usrimg.jpg";
								}
								$fullImageName = $img_path.'media/avatars/thumb150/'.$imageName;
								$this->loadModel('Cart');
								$cartModel = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
								echo '{"status":"true","userid":"'.$userId.'","username":"'.$userName.'","photo":"'.$fullImageName.'","cartcount":"'.count($cartModel).'","fullname":"'.$fullname.'"}';
							}
						} else {
							echo '{"status":"false","message":"Your account has been disbled please contact our support"}';
						}
					} else {
						echo '{"status":"false","message":"Please activate your account by the email sent to you"}';
					}
				}else{
					echo '{"status":"false","message":"Please enter correct email and password"}';
				}
			}
		}
		
		function signup () {
			$this->layout = 'ajax';
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Sitesetting');
			$setngs = $this->Sitesetting->find('all');
			
			$username = $_POST['username'];
			$firstname = $_POST['fullname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$deviceToken = $_POST['deviceToken'];
			
			$nmecounts = $this->User->find('count',array('conditions'=>array('username'=>$username)));
			$emlcounts = $this->User->find('count',array('conditions'=>array('email'=>$email)));
			
			if($nmecounts > 0){
				echo '{"status":"false","message":"Username already exists"}';
			}else if($emlcounts > 0){
				echo '{"status":"false","message":"Email already exists"}';
			}else {
					$name=$this->request->data['User']['username'] = $username;
					$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
					$this->request->data['User']['first_name'] = $firstname;
					$emailaddress = $this->request->data['User']['email'] = $email;
					$this->request->data['User']['password'] = $this->Auth->password($password);
					$this->request->data['User']['user_level'] = 'normal';
					$this->request->data['User']['user_status'] = 'enable';
					$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
					$uniquecode = $this->Urlfriendly->get_uniquecode(8);
					$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
					$this->User->save($this->request->data);
					$userid = $this->User->getLastInsertID();
					
					$this->loadModel('Shop');
					$this->request->data['Shop']['user_id'] = $userid;
					$this->Shop->save($this->request->data);
					
					if(isset($deviceToken)){
						$mode = 0;
						if(isset($_POST['devicemode'])){
							$mode = 1;
						}
						$this->loadModel('Userdevice');
						$userdeviceDet = $this->Userdevice->find('all',array('conditions'=>array('deviceToken'=>$deviceToken)));
							
						if(!empty($userdeviceDet)){
							$devicetokentab = $userdeviceDet[0]['Userdevice']['deviceToken'];
							if (isset($_POST['devicetype'])){
								$this->Userdevice->updateAll(array('Userdevice.user_id' => $userid, 'Userdevice.type' => $_POST['devicetype'], 'Userdevice.mode' => $mode), array('Userdevice.deviceToken' => $devicetokentab));
							}else{
							        $this->Userdevice->updateAll(array('Userdevice.user_id' => $userid, 'Userdevice.mode' => $mode), array('Userdevice.deviceToken' => $devicetokentab));
							}
						}else{
							$this->request->data['Userdevice']['user_id'] = $userid;
							$this->request->data['Userdevice']['deviceToken'] = $deviceToken;
							$this->request->data['Userdevice']['mode'] = $mode;
							if (isset($_POST['devicetype'])){
								$this->request->data['Userdevice']['type'] = $_POST['devicetype'];
							}
							$this->request->data['Userdevice']['cdate'] = time();
							$this->Userdevice->save($this->request->data);
						}
					}
					
					if ($setngs[0]['Sitesetting']['signup_active'] == 'yes') {
						if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
							$this->Email->smtpOptions = array(
								'port' => $setngs[0]['Sitesetting']['smtp_port'],
								'timeout' => '30',
								'host' => 'ssl://smtp.gmail.com',
								'username' => $setngs[0]['Sitesetting']['noreply_email'],
								'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
							$this->Email->delivery = 'smtp';
						}
						$this->Email->to = $emailaddress;
						$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Welcome, please verify your new account";
						$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
						$this->Email->sendAs = "html";
						$this->Email->template = 'userlogin';
						$this->set('name', $firstname);
						$this->set('urlname', $urlname);
						$this->set('email', $emailaddress);
						$this->set('siteurl',SITE_URL);
						$this->set('setngs',$setngs);
						$emailid = base64_encode($emailaddress);
						$pass = base64_encode($password);
						$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key."~".$pass);
					
						$this->Email->send();
							
						echo '{"status":"true","message":"An email was sent to your mail box, please activate your account and login."}';
					}else{
						echo '{"status":"true","message":"Your account has been created, please login to your account."}';
					}
				}
		}
		
		
	function home () {
			global $setngs;
			$this->layout = false;
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			$this->loadModel ('User');
			$favitems_ids = array();
			$items_data = array();
			$limit = 10;
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}
			
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$affliate['status <>'] = 'draft';
			}else{
				$affliate['status'] = 'publish';
			}
			if (isset($_GET['userId'])) {
				$userModel = $this->User->findByid($_GET['userId']);
				$userApiDetails = $userModel['User']['user_api_details'];
				if ($userApiDetails != "") {
					$userApiDetails = json_decode($userApiDetails,true);
					if(isset($userApiDetails['Timeline']['Following']) && $userApiDetails['Timeline']['Following'] == "true") {
						$_GET['type'] = "following";
					}else if(isset($userApiDetails['Timeline']['IncludingMe']) && $userApiDetails['Timeline']['IncludingMe'] == 'false') {
						$_GET['type'] = "IncludingMe";
					}
				}
			}
			
			if(isset($_GET['userId']) && isset($_GET['type']) && $_GET['type'] == "following"){
			 	$userId = $_GET['userId'];
			 	$following = $this->Follower->findAllByfollow_user_id($userId);
			 	//echo "<pre>";print_r($following);die;
			 	if(count($following) > 0){
			 		foreach ($following as $follow) {
			 			$followingId[] = $follow['Follower']['user_id'];
			 		}
					$affliate['Item.user_id'] = $followingId;
				 	//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				 	if(isset($_GET['offset'])){
				 		$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
				 	}else{
				 		$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				 	}
			 	}else {
				 	if (empty($items_data)) {
				 		echo '{"status":"false","message":"Data Not Found"}';
				 		die;;
				 	}
			 	}
			 	
			 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
			 	if(count($items_fav_data) > 0){
			 	foreach($items_fav_data as $favitems){
			 		//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
			 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
			 	}
			 	}else{
			 		$favitems_ids = array();
			 	}
				
			}elseif(isset($_GET['userId']) && isset($_GET['type']) && $_GET['type'] == "IncludingMe") {
				$userId = $_GET['userId'];
			 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
			 	if(count($items_fav_data) > 0){
			 	foreach($items_fav_data as $favitems){
			 		//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
			 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
			 	}
			 	}else{
			 		$favitems_ids = array();
			 	}
			 	//echo "<pre>";print_r($favitems_ids);die;
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				if(isset($_GET['offset'])){
					$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				
				}
			}elseif(isset($_GET['userId'])) {
				$userId = $_GET['userId'];
			 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
			 	if(count($items_fav_data) > 0){
			 	foreach($items_fav_data as $favitems){
			 		//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
			 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
			 	}
			 	}else{
			 		$favitems_ids = array();
			 	}
				$affliate['Item.user_id <>'] = $userId;
			 	//echo "<pre>";print_r($favitems_ids);die;
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				if(isset($_GET['offset'])){
					$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
				
				}
			}elseif(isset($_GET['userAdded'])) {
				$userId = $_GET['userAdded'];	
				$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
				if(count($items_fav_data) > 0){
					foreach($items_fav_data as $favitems){
						//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
						$favitems_ids[] = $favitems['Itemfav']['item_id'];
					}
				}else{
					$favitems_ids = array();
				}			
			 	if(isset($_GET['offset'])){
			 		$items_data = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$userId),'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
			 	}else{
			 		$items_data = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$userId),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			 	}
			}elseif(isset($_GET['itemId'])){
				$ItemId = $_GET['itemId'];
				$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
				if(count($items_fav_data) > 0){
					foreach($items_fav_data as $favitems){
						//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
						$favitems_ids[] = $favitems['Itemfav']['item_id'];
					}
				}else{
					$favitems_ids = array();
				}
				$items_data = $this->Item->find('all',array('conditions'=>array('Item.id'=>$ItemId)));
				if($items_data[0]['Item']['status'] == 'draft'){
					echo '{"status":"false","result":"Waiting for admin approval"}'; die;
				}
			}else{
			 	if(isset($_GET['offset'])){
			 		$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
			 	}else{
					$items_data = $this->Item->find('all',array('conditions'=>$affliate,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			 		
			 	}
			$favitems_ids=null;
			//$this->redirect('/api/login/');
			} 
			 	//echo "<pre>";print_r($items_data);die;
			if(empty($items_data)){
				echo '{"status":"false","result":"No data found"}'; die;
			}else{
				if (isset($_GET['type'])) {
					$resultArray = $this->convertJsonHome($items_data,$favitems_ids,$_GET['type'],$userId);
				}else {
					$resultArray = $this->convertJsonHome($items_data,$favitems_ids,0,$userId);
				}
				//echo '{"status":"'.$resultArray.'"}';die;
				//echo "<pre>";print_r($resultArray);die;
				echo '{"status":"true","currency":"'.$_SESSION['default_currency_symbol'].'",
					"fantacyd":"'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'",
					"fantacy":"'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'","result":'.$resultArray.'}';
				die;
			}
			
		}
		
		
		public function  convertJsonHome ($items_data,$favitems_ids=null,$type=null,$userId=null) {
			
			$resultArray = array();
			$resultArray['type'] = "Everything";
			if ($type != null)
				$resultArray['type'] = $type;
			$resultArray['items'] = array();
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			//echo "<pre>";print_r($items_data);
			foreach ($items_data as $key => $listitem) {
				//echo "<pre>";print_r($favitems_ids);
				$reportUsers = '';
				$process_time = $listitem['Item']['processing_time'];
				if($process_time == '1d'){
					$process_time = "One business day";
				}elseif($process_time == '2d'){
					$process_time = "Two business days";
				}elseif($process_time == '3d'){
					$process_time = "Three business days";
				}elseif($process_time == '4d'){
					$process_time = "Four business days";
				}elseif($process_time == '2ww'){
					$process_time = "One-Two weeks";
				}elseif($process_time == '3w'){
					$process_time = "Two-Three weeks";
				}elseif($process_time == '4w'){
					$process_time = "Three-Four weeks";
				}elseif($process_time == '6w'){
					$process_time = "Four-Six weeks";
				}elseif($process_time == '8w'){
					$process_time = "Six-Eight weeks";
				}
				if (!empty($listitem['Item']['report_flag'])){
					$reportUsers = json_decode($listitem['Item']['report_flag'], true);
				}
				$resultArray['items'][$key]['id'] = $listitem['Item']['id'];
				$resultArray['items'][$key]['item_title'] = $listitem['Item']['item_title'];
				$resultArray['items'][$key]['product_url'] = SITE_URL.'listing/'.$listitem['Item']['id'].'/'.$listitem['Item']['item_title_url'];
				$resultArray['items'][$key]['item_description'] = $listitem['Item']['item_description'];
				$resultArray['items'][$key]['shipping_time'] = $process_time;
				$resultArray['items'][$key]['price'] = $listitem['Item']['price'];
				$resultArray['items'][$key]['quantity'] = $listitem['Item']['quantity'];
				$resultArray['items'][$key]['size'] = "";
				if (empty($listitem['Item']['size_options'])) {
					$resultArray['items'][$key]['size'] = "";
				}else{
					$sizes = explode(',',$listitem['Item']['size_options']);
					foreach ($sizes as $sqkey => $size){
						$sizeqty = explode('=',$size);
						if (count($sizeqty) > 1){
							$resultArray['items'][$key]['size'][$sqkey]['name'] = $sizeqty['0'];
							$resultArray['items'][$key]['size'][$sqkey]['qty'] = $sizeqty[1];
						}
					}
				}
				$resultArray['items'][$key]['flagusers'] = $reportUsers;
				$resultArray['items'][$key]['userId'] = $listitem['User']['id'];
				$resultArray['items'][$key]['sellername'] = $listitem['User']['username_url'];
				$resultArray['items'][$key]['shop_address'] = $listitem['Shop']['shop_address'];
				//$resultArray['items'][$key]['created_on'] = $listitem['Item']['created_on'];
				$resultArray['items'][$key]['favorites'] = $listitem['Item']['fav_count'];
				$resultArray['items'][$key]['commentcount'] = count($listitem['Comment']);
				$resultArray['items'][$key]['fashioncount'] = count($listitem['Fashionuser']);
				
				
				if($listitem['Item']['status']=='things'){
					$resultArray['items'][$key]['buy_type'] = "affiliate";
				}else if($listitem['Item']['status']=='publish'){
					$resultArray['items'][$key]['buy_type'] = "buy";
				}
				
				$resultArray['items'][$key]['affiliate_link'] = $listitem['Item']['bm_redircturl'];
				
				if($listitem['Item']['status']=='publish'){
					$resultArray['items'][$key]['approve'] = TRUE;
				}else{
					$resultArray['items'][$key]['approve'] = False;
				}
				$imageName = $listitem['User']['profile_image'];
				if ($imageName == ''){
					$imageName = "usrimg.jpg";
				}	
				
				if(isset($favitems_ids) && in_array($listitem['Item']['id'],$favitems_ids)){
					$resultArray['items'][$key]['liked'] = 'Yes';
				}else{
					$resultArray['items'][$key]['liked'] = 'No';
				}
				$resultArray['items'][$key]['photos'] = array();
				$itemCount = 0;
				foreach ($listitem['Photo'] as $keys=>$photo) {
					if ($listitem['Item']['id'] == $photo['item_id']) {
						if($keys==0){
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_70'] = $img_path.'media/items/thumb70/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_70'] = $img_path.'media/avatars/thumb70/'.$imageName;
						}else{
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_70'] =  $img_path.'media/items/thumb70/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_70'] = $img_path.'media/avatars/thumb70/'.$imageName;
						}
		
						if($keys==0){
							$image = $img_path.'media/items/thumb350/'.$photo['image_name'];
							list($width, $height) = getimagesize($image);
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_350'] = $img_path.'media/items/thumb350/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_350'] = $img_path.'media/avatars/thumb350/'.$imageName;
							$resultArray['items'][$key]['photos'][$itemCount]['height'] = $height;
							$resultArray['items'][$key]['photos'][$itemCount]['width'] = $width;
						}else{
							$image = $img_path.'media/items/thumb350/'.$photo['image_name'];
							list($width, $height) = getimagesize($image);
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_350'] = $img_path.'media/items/thumb350/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_350'] = $img_path.'media/avatars/thumb350/'.$imageName;
							$resultArray['items'][$key]['photos'][$itemCount]['height'] = $height;
							$resultArray['items'][$key]['photos'][$itemCount]['width'] = $width;
						}
		
						if($keys==0){
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_original'] = $img_path.'media/items/original/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_original'] = $img_path.'media/avatars/original/'.$imageName;
						}else{
							$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_original'] = $img_path.'media/items/original/'.$photo['image_name'];
							$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_original'] = $img_path.'media/avatars/original/'.$imageName;
						}
		
		
						$itemCount += 1;
					}
				}
				$resultArray['items'][$key]['comments'] = array();
				$cmntCount = 0;
				foreach ($listitem['Comment'] as $keys_c=>$cmnt) {
					if ($listitem['Item']['id'] == $cmnt['item_id']) {
						$resultArray['items'][$key]['comments'][$cmntCount]['comment_id'] = $cmnt['id'];
		
						$resultArray['items'][$key]['comments'][$cmntCount]['comment'] = urldecode($cmnt['comments']);;
						$resultArray['items'][$key]['comments'][$cmntCount]['user_id'] = $cmnt['user_id'];
						$user_data = $this->User->findById($cmnt['user_id']);
						if(count($user_data) > 0){
							$username = $user_data['User']['username_url'];
							$profile_image = $user_data['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['items'][$key]['comments'][$cmntCount]['user_img'] = $img_path.'media/avatars/thumb70/'.$user_img;
							$resultArray['items'][$key]['comments'][$cmntCount]['username'] = $username;
						}else{
							$resultArray['items'][$key]['comments'][$cmntCount]['user_img'] = $img_path.'media/avatars/thumb70/usrimg.jpg';
							$resultArray['items'][$key]['comments'][$cmntCount]['username'] = Null;
						}
						$cmntCount += 1;
					}
				}
				
				
				//echo "<pre>";print_r($listitem['Fashionuser']);die;
				
				$resultArray['items'][$key]['fashionuser'] = array();
				$fashionCount = 0;
				foreach ($listitem['Fashionuser'] as $keys_c=>$fash) {
						$resultArray['items'][$key]['fashionuser'][$fashionCount]['fId'] = $fash['id'];
						$userimage = $fash['userimage'];
						$resultArray['items'][$key]['fashionuser'][$fashionCount]['user_img'] = $img_path.'media/avatars/thumb150/'.$userimage;
						$fashionCount += 1;
				}
				
				
				
				$resultArray['items'][$key]['likedusers'] = array();
				$cmntCountfav = 0;
				foreach ($listitem['Itemfav'] as $itemfav) {
					if ($listitem['Item']['id'] == $itemfav['item_id']) {
						$resultArray['items'][$key]['likedusers'][$cmntCountfav]['itemId'] = $itemfav['item_id'];
						$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_id'] = $itemfav['user_id'];
						$user_data = $this->User->findById($itemfav['user_id']);
						if(count($user_data) > 0){
							$usererrId = $user_data['User']['id'];
							$username = $user_data['User']['username_url'];
							$fullName = $user_data['User']['first_name'];
							$profile_image = $user_data['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
													
							//$followModel = $this->Follower->findAllByuser_id($userId);
							$followModel1 = $this->Follower->findAllByfollow_user_id($userId);
								
							if (count($followModel1) > 0) {							
								foreach ($followModel1 as $follower1) {
									$followers_list[] = $follower1['Follower']['user_id'];
								}								
								if(in_array($usererrId, $followers_list)){
									$resultArray['items'][$key]['likedusers'][$cmntCountfav]['status'] = 'unfollow';
								}else{
									$resultArray['items'][$key]['likedusers'][$cmntCountfav]['status'] = 'follow';
								}
							}else{
								$resultArray['items'][$key]['likedusers'][$cmntCountfav]['status'] = 'follow';
							}
														
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_img'] = $img_path.'media/avatars/thumb70/'.$user_img;
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['username'] = $username;
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['fullName'] = $fullName;
						}else{
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_img'] = $img_path.'media/avatars/thumb70/usrimg.jpg';
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['username'] = Null;
						}
						$cmntCountfav += 1;
					}
				}
				
				
				
			}
			//echo "<pre>";print_r(($resultArray));die;
			return json_encode($resultArray);
		}
		
		public function getatuser($searchWord = null){
			$this->autoRender = FALSE;
			$this->layout = FALSE;
			$this->loadModel('User');
				
			if ($searchWord != null){
				$userModel = $this->User->find('all',array('conditions'=>array(
						'username like'=>$searchWord.'%', 'user_level <>'=>'god'),'limit'=>5));
				$userContent = array();
				if (!empty($userModel)){
					foreach($userModel as $userkey => $user){
						$usernameURL = $user['User']['username_url'];
						$userImage = $user['User']['profile_image'];
						if(empty($userImage)){
							$userImage = "usrimg.jpg";
						}
						$userImage = $_SESSION['media_url']."media/avatars/thumb70/".$userImage;
						$userContent[$userkey]['username'] = $usernameURL;
						$userContent[$userkey]['userimage'] = $userImage;
					}
					$resultArray = json_encode($userContent);
					echo '{"status":"true","result":'.$resultArray.'}';
				}else{
					echo '{"status":"false","message":"No match found"}';
				}
			}else{
				echo '{"status":"false","message":"Search word is Empty"}';
			}
		}
		
			
		public function item_comments (){
			$this->layout = FALSE;
			$this->loadModel('Comment');
			$this->autoRender = false;
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			if (isset($_GET)) {
				$userId = $_GET['userId'];
				$itemId = $_GET['itemId'];
				$comment = $_GET['comment'];
				
				preg_match_all( '/@([\S]*?)(?=\s)/', $comment, $atmatch );
				//echo "<pre>"; print_r($match);
				if (!empty($atmatch)){
					foreach($atmatch[1] as $atuser){
						$comment = str_replace('@'.$atuser." ",'<span class="hashatcolor">@</span><a href="'.SITE_URL.'people/'.$atuser.'">'.$atuser.'</a> ',$comment);
					}
				}
				
				$this->request->data['Comment']['user_id'] = $userId;
				$this->request->data['Comment']['item_id'] = $itemId;
				$this->request->data['Comment']['comments'] = $comment;
				$this->Comment->save($this->request->data);
				$id = $this->Comment->getLastInsertID();
				$userModel = $this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
				$path = $img_path."media/avatars/thumb70/";
				$username = $userModel['User']['username_url'];
				if (!empty($userModel['User']["profile_image"])) {
					$path .= $userModel['User']['profile_image'];
				}else {
					$path .= 'usrimg.jpg';
				}
				$commentEncoded = urldecode($_GET['comment']);
				
				App::import('Controller', 'Users');
				$Users = new UsersController;
				$this->loadModel('Userdevice');
				$this->loadModel('Item');
				$this->loadModel('User');
				$usernamedetails = $this->User->findById($userId);
				$loginusername = $usernamedetails['User']['username'];
				$getuserIdd = $this->Item->findById($itemId);
				$ItemaddUserid = $getuserIdd['Item']['user_id'];
				$userddett = $this->Userdevice->findByUser_id($ItemaddUserid);
				//echo "<pre>";print_r($userddett);die;
				$deviceTToken = $userddett['Userdevice']['deviceToken'];
				if(isset($deviceTToken)){
					$messages = $loginusername." is commented on your item : ".$commentEncoded;
					$Users->pushnot($deviceTToken,$messages);
				}
				
				
				
				echo '{"status":"true","comment_id":"'.$id.'","comment":"'.$commentEncoded.'","user_id":"'.$userId.'","user_img":"'.$path.'","username":"'.$username.'"}';
			}else {
				echo '{"status":"false","message":"Get Empty"}';
			}
		}
		
		
		public function item_like (){
			$this->layout = FALSE;
			$this->loadModel('Itemfav');
			$this->loadModel('Item');
			$this->autoRender = false;
			
			if (isset($_GET)) {
				$userId = $_GET['userId'];
				$itemId = $_GET['itemId'];
				
				$ItemfavModel = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itemId)));
				
				$userdatasall = $this->Item->findById($itemId);
				//echo "<pre>";print_r($userdatasall);die;
				
				if(!empty($ItemfavModel)){
					$this->Itemfav->deleteAll(array('user_id' => $userId,'item_id'=>$itemId), false);
					
					$favcountss = $userdatasall['Item']['fav_count'];
					$favcounts = $favcountss -1;
					$this->request->data['Item']['id'] = $itemId;
					$this->request->data['Item']['fav_count'] = $favcounts;
					$this->Item->save($this->request->data);
					
					echo '{"status":"true","message":"Item Unliked"}';
				}else {
					$favcountss = $userdatasall['Item']['fav_count'];
					$favcounts = $favcountss + 1;
					$this->request->data['Item']['id'] = $itemId;
					$this->request->data['Item']['fav_count'] = $favcounts;
					$this->Item->save($this->request->data);
					
					
					$this->Itemfav->create();
					$this->request->data['Itemfav']['user_id'] = $userId;
					$this->request->data['Itemfav']['item_id'] = $itemId;
					$this->request->data['Itemfav']['created_on'] = date('Y-m-d H:i:s');
					$this->Itemfav->save($this->request->data);
					
					if ($userId != $userdatasall['Item']['user_id']) {
						App::import('Controller', 'Users');
						$Users = new UsersController;
						$this->loadModel('Userdevice');
						$this->loadModel('User');
						$usernamedetails = $this->User->findByid($userId);
						$getuserIdd = $this->Item->findById($itemId);
						$logusername = $usernamedetails['User']['username'];
						$ItemaddUserid = $getuserIdd['Item']['user_id'];
						$userddett = $this->Userdevice->find('all',array('conditions'=>array('user_id'=>$ItemaddUserid)));
						//echo "<pre>";print_r($userddett);die;
						foreach($userddett as $userdet){
							$deviceTToken = $userdet['Userdevice']['deviceToken'];
							$badge = $userdet['Userdevice']['badge'];
							$badge +=1;
							$this->Userdevice->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
							if(isset($deviceTToken)){
								$messages = $logusername." Liked your item ".$getuserIdd['Item']['item_title'];
								$Users->pushnot($deviceTToken,$messages,$badge);
							}
						}
					}
					
					
					echo '{"status":"true","message":"Item Liked"}';
				} 
		}
		}
		
		
		
		public function item_favorited(){
			$this->layout = false;
			$this->loadModel('Itemfav');
			$favitems_ids = array();
			$items_data = array();
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			if(isset($_GET['userId'])){
			 	$userId = $_GET['userId'];
			 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId),  
			 			'order'=>array('id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
			 	//echo "<pre>";print_r($items_fav_data);die;
			 	
			 	if(count($items_fav_data) > 0){
			 	foreach($items_fav_data as $favitems){
			 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
			 	}
			 	}else{
			 		$favitems_ids = array();
			 	}
			 	//echo "<pre>";print_r($items_fav_data);die;
			 	
			 	$items_data = $this->Item->find('all',array('conditions'=>array('Item.id'=>$favitems_ids)));
			 	//echo "<pre>";print_r($items_data);die;
			 	
			 	if (isset($_GET['favuserid'])){
			 		$loggedUserFav = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$_GET['favuserid']),
			 				'order'=>array('id'=>'desc')));
			 		if(count($loggedUserFav) > 0){
			 			foreach($loggedUserFav as $logfavitems){
			 				$loggedUserFav_ids[] = $logfavitems['Itemfav']['item_id'];
			 			}
			 		}else{
			 			$loggedUserFav_ids = array();
			 		}
			 	}
			}
			$resultArray = $this->itemfavjson($items_data,$favitems_ids,$loggedUserFav_ids);
			echo '{"status":"true","result":'.$resultArray.'}'; die;
		}
		
		
		
		public function  itemfavjson ($items_data,$favitems_ids=null,$loggedUserFav_ids=null) {
		
			$resultArray = array();
			$resultArray['items'] = array();
			$resultArray['loggedUserFavIds'] = $loggedUserFav_ids;
		
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
		
			foreach ($items_data as $key => $listitem) {
				//echo "<pre>";print_r($favitems_ids);
				if(isset($favitems_ids) && in_array($listitem['Item']['id'],$favitems_ids)){
					$process_time = $listitem['Item']['processing_time'];
					if($process_time == '1d'){
						$process_time = "One business day";
					}elseif($process_time == '2d'){
						$process_time = "Two business days";
					}elseif($process_time == '3d'){
						$process_time = "Three business days";
					}elseif($process_time == '4d'){
						$process_time = "Four business days";
					}elseif($process_time == '2ww'){
						$process_time = "One-Two weeks";
					}elseif($process_time == '3w'){
						$process_time = "Two-Three weeks";
					}elseif($process_time == '4w'){
						$process_time = "Three-Four weeks";
					}elseif($process_time == '6w'){
						$process_time = "Four-Six weeks";
					}elseif($process_time == '8w'){
						$process_time = "Six-Eight weeks";
					}
					$resultArray['items'][$key]['id'] = $listitem['Item']['id'];
					$resultArray['items'][$key]['item_title'] = $listitem['Item']['item_title'];
					$resultArray['items'][$key]['item_description'] = $listitem['Item']['item_description'];
					$resultArray['items'][$key]['product_url'] = SITE_URL.'listing/'.$listitem['Item']['id'].'/'.$listitem['Item']['item_title_url'];
					$resultArray['items'][$key]['shipping_time'] = $process_time;
					$resultArray['items'][$key]['userId'] = $listitem['User']['id'];
					$resultArray['items'][$key]['sellername'] = $listitem['User']['username_url'];
					$resultArray['items'][$key]['shop_address'] = $listitem['Shop']['shop_address'];
					$resultArray['items'][$key]['price'] = $listitem['Item']['price'];
					$resultArray['items'][$key]['quantity'] = $listitem['Item']['quantity'];
					$resultArray['items'][$key]['size'] = "";
					if (empty($listitem['Item']['size_options'])) {
						$resultArray['items'][$key]['size'] = "";
					}else{
						$sizes = explode(',',$listitem['Item']['size_options']);
						foreach ($sizes as $sqkey => $size){
							$sizeqty = explode('=',$size);
							if (count($sizeqty) > 1){
								$resultArray['items'][$key]['size'][$sqkey]['name'] = $sizeqty['0'];
								$resultArray['items'][$key]['size'][$sqkey]['qty'] = $sizeqty[1];
							}
						}
					}
					$resultArray['items'][$key]['flagusers'] = $reportUsers;
					$resultArray['items'][$key]['userId'] = $listitem['User']['id'];
					$resultArray['items'][$key]['sellername'] = $listitem['User']['username_url'];
					$resultArray['items'][$key]['shop_address'] = $listitem['Shop']['shop_address'];
					//$resultArray['items'][$key]['created_on'] = $listitem['Item']['created_on'];
					$resultArray['items'][$key]['favorites'] = $listitem['Item']['fav_count'];
					$resultArray['items'][$key]['commentcount'] = count($listitem['Comment']);
					$resultArray['items'][$key]['fashioncount'] = count($listitem['Fashionuser']);
					
					if($listitem['Item']['status']=='things'){
						$resultArray['items'][$key]['buy_type'] = "affiliate";
					}else if($listitem['Item']['status']=='publish'){
						$resultArray['items'][$key]['buy_type'] = "buy";
					}
					
					$resultArray['items'][$key]['affiliate_link'] = $listitem['Item']['bm_redircturl'];
					
					if($listitem['Item']['status']=='publish'){
						$resultArray['items'][$key]['approve'] = TRUE;
					}else{
						$resultArray['items'][$key]['approve'] = False;
					}
					
					$imageName = $listitem['User']['profile_image'];
					if ($imageName == ''){
						$imageName = "usrimg.jpg";
					}
					/* if(isset($favitems_ids) && in_array($listitem['Item']['id'],$favitems_ids)){
						$resultArray['items'][$key]['liked'] = 'Yes';
					} */
					if(isset($favitems_ids) && in_array($listitem['Item']['id'],$favitems_ids)){
						$resultArray['items'][$key]['liked'] = 'Yes';
					}else{
						$resultArray['items'][$key]['liked'] = 'No';
					}
					
					
					$resultArray['items'][$key]['photos'] = array();
					$itemCount = 0;
					foreach ($listitem['Photo'] as $keys=>$photo) {
						if ($listitem['Item']['id'] == $photo['item_id']) {
							if($keys==0){							
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_70'] = $img_path.'media/items/thumb70/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_70'] = $img_path.'media/avatars/thumb70/'.$imageName;
							}else{							
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_70'] =  $img_path.'media/items/thumb70/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_70'] = $img_path.'media/avatars/thumb70/'.$imageName;
							}
			
							if($keys==0){
								$image = $img_path.'media/items/thumb350/'.$photo['image_name'];
								list($width, $height) = getimagesize($image);
								$resultArray['items'][$key]['photos'][$itemCount]['height'] = $height;
								$resultArray['items'][$key]['photos'][$itemCount]['width'] = $width;
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_350'] = $img_path.'media/items/thumb350/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_350'] = $img_path.'media/avatars/thumb350/'.$imageName;
							}else{
								$image = $img_path.'media/items/thumb350/'.$photo['image_name'];
								list($width, $height) = getimagesize($image);
								$resultArray['items'][$key]['photos'][$itemCount]['height'] = $height;
								$resultArray['items'][$key]['photos'][$itemCount]['width'] = $width;
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_350'] = $img_path.'media/items/thumb350/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_350'] = $img_path.'media/avatars/thumb350/'.$imageName;
							}
			
							if($keys==0){
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_original'] = $img_path.'media/items/original/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_original'] = $img_path.'media/avatars/original/'.$imageName;
							}else{
								$resultArray['items'][$key]['photos'][$itemCount]['item_url_main_original'] = $img_path.'media/items/original/'.$photo['image_name'];
								$resultArray['items'][$key]['photos'][$itemCount]['user_url_main_original'] = $img_path.'media/avatars/original/'.$imageName;
							}
			
			
							$itemCount += 1;
						}
					}
					$resultArray['items'][$key]['comments'] = array();
					$cmntCount = 0;
					
					foreach ($listitem['Comment'] as $keys_c=>$cmnt) {
						$user_data = $this->User->findById($cmnt['user_id']);
						if (count($user_data) > 0) {
							if ($listitem['Item']['id'] == $cmnt['item_id']) {
								$resultArray['items'][$key]['comments'][$cmntCount]['comment_id'] = $cmnt['id'];
				
								$resultArray['items'][$key]['comments'][$cmntCount]['comment'] = $cmnt['comments'];//$this->Urlfriendly->utils_makeUrlFriendly($cmnt['comments']);;
								$resultArray['items'][$key]['comments'][$cmntCount]['user_id'] = $cmnt['user_id'];
								
								if(count($user_data) > 0){
									$username = $user_data['User']['username_url'];
									$profile_image = $user_data['User']['profile_image'];
									if(!empty($profile_image)){
										$user_img = $profile_image;
									}else{
										$user_img = 'usrimg.jpg';
									}
									$resultArray['items'][$key]['comments'][$cmntCount]['user_img'] = $img_path.'media/avatars/thumb70/'.$user_img;
									$resultArray['items'][$key]['comments'][$cmntCount]['username'] = $username;
								}
								$cmntCount += 1;
							}
						}
					}
					
					$resultArray['items'][$key]['fashionuser'] = array();
					$fashionCount = 0;
					foreach ($listitem['Fashionuser'] as $keys_c=>$fash) {
						$resultArray['items'][$key]['fashionuser'][$fashionCount]['fId'] = $fash['id'];
						$userimage = $fash['userimage'];
						$resultArray['items'][$key]['fashionuser'][$fashionCount]['user_img'] = $img_path.'media/avatars/thumb150/'.$userimage;
						$fashionCount += 1;
					}
					
					
					
					$resultArray['items'][$key]['likedusers'] = array();
					$cmntCountfav = 0;
					foreach ($listitem['Itemfav'] as $itemfav) {
						if ($listitem['Item']['id'] == $itemfav['item_id']) {
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['itemId'] = $itemfav['item_id'];
							$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_id'] = $itemfav['user_id'];
							$user_data = $this->User->findById($itemfav['user_id']);
							if(count($user_data) > 0){
								$username = $user_data['User']['username_url'];
								$profile_image = $user_data['User']['profile_image'];
								if(!empty($profile_image)){
									$user_img = $profile_image;
								}else{
									$user_img = 'usrimg.jpg';
								}
								$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_img'] = $img_path.'media/avatars/thumb70/'.$user_img;
								$resultArray['items'][$key]['likedusers'][$cmntCountfav]['username'] = $username;
							}else{
								$resultArray['items'][$key]['likedusers'][$cmntCountfav]['user_img'] = $img_path.'media/avatars/thumb70/usrimg.jpg';
								$resultArray['items'][$key]['likedusers'][$cmntCountfav]['username'] = Null;
							}
							$cmntCountfav += 1;
						}
					}	
		
				}		
			}
			//echo "<pre>";print_r(($resultArray));die;
			return json_encode($resultArray);
		}
		
		
		public function changePassword () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$oldPassword = $_POST['oldPassword'];
			$newPassword = $_POST['newPassword'];
			$userId = $_POST['userId'];
			$userModel = $this->User->findByid($userId);
			$encryptOld = $this->Auth->password($oldPassword);
			if ($encryptOld == $userModel['User']['password']) {
				$encryptNew = $this->Auth->password($newPassword);
				$this->request->data['User']['id'] = $userId;
				$this->request->data['User']['password'] = $encryptNew;
				$this->User->save($this->request->data);
				echo '{"status":"true","message":"Password Changed Successfully"}';
			}else {
				echo '{"status":"false","message":"Old Password Incorrect"}';
			}
		}
		
		public function userDetails() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('User');
			$this->loadModel('Follower');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Item');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			if (isset($_GET['userId'])){
				$userId = $_GET['userId'];
				$userModel = $this->User->findByid($userId);
			}elseif (isset($_GET['userName'])){
				$userName = $_GET['userName'];
				$userModel = $this->User->findByusername($userName);
				$userId = $userModel['User']['id'];
			}
			if (count($userModel) == 0) {
				echo '{"status":"false","message":"User Not Exist"}';
			}
			$userName = $userModel['User']['username_url'];
			$fullName = $userModel['User']['first_name'];
			$shop_address = $userModel['Shop']['shop_address'];
			$shop_latitude = $userModel['Shop']['shop_latitude'];
			$shop_longitude = $userModel['Shop']['shop_longitude'];
			$imageName = $userModel['User']['profile_image'];
			$credits = 0;
			if (!empty($userModel['User']['credit_total'])){
				$credits = $userModel['User']['credit_total'];
			}
			if ($imageName == ''){
				$imageName = 'usrimg.jpg';
			}
			$aboutUser = $userModel['User']['about'];
			
			$followModel = $this->Follower->findAllByuser_id($userId);
			//echo "<pre>";print_r($followModel);
			foreach ($followModel as $follow) {
				$userFollowerId[] = $follow['Follower']['follow_user_id'];
			}
			//echo "<pre>";print_r($userFollowerId);
			
			$userFollowing = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$userFollowerId)));
			$followerCount = count($userFollowing);
			
			//echo "<pre>";print_r($userFollowing);die;
			$followModel = $this->Follower->findAllByfollow_user_id($userId);
			foreach ($followModel as $follow) {
				$userFollowingId[] = $follow['Follower']['user_id'];
			}
			$userFollowing = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$userFollowingId)));
			$followingCount = count($userFollowing);
			
			$ItemfavModel = $this->Itemfav->findAllByuser_id($userId);
			foreach ($ItemfavModel as $itemfav) {
				$favItem[] = $itemfav['Itemfav']['item_id'];
			}
			$itemFavorited = count($favItem);
				
			$itemAddedCount = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userId)));
			//echo $item_datas;die;
			
			$itemlistCount = $this->Itemlist->find('count',array('conditions'=>array('user_id'=>$userId)));
			
			$similarUsers = $this->Itemfav->find('all',array('conditions'=>array('item_id'=>$favItem,'user_id <>'=>$userId)));
			foreach ($similarUsers as $similar) {
				$favUserId = $similar['Itemfav']['user_id'];
				if(isset($favUser[$favUserId])){
					$favUser[$favUserId] += 1;
				}else {
					$favUser[$favUserId] = 1;
				}
			}
			arsort($favUser);
			foreach ($favUser as $key => $value) {
				$similarUser[] = $key;
				if(count($similarUser) > 10) {
					break;
				}
			}
			$favUserModel = $this->User->find('all',array('conditions'=>array('User.id'=>$similarUser)));
			//echo "<pre>";print_r($favUserModel);die;
			$resultArray['userId'] = $userId;
			$resultArray['userName'] = $userName;
			$resultArray['fullName'] = $fullName;
			$resultArray['shop_address'] = $shop_address;
			$resultArray['shop_latitude'] = $shop_latitude;
			$resultArray['shop_longitude'] = $shop_longitude;
			$resultArray['about'] = $aboutUser;
			$resultArray['imageName'] = array();
			$resultArray['imageName']['thumb70'] = $img_path.'media/avatars/thumb70/'.$imageName;
			$resultArray['imageName']['thumb150'] = $img_path.'media/avatars/thumb150/'.$imageName;
			$resultArray['following'] = $followingCount;
			$resultArray['followers'] = $followerCount;
			$resultArray['itemfavorited'] = $itemFavorited;
			$resultArray['itemAddedCount'] = $itemAddedCount;
			$resultArray['itemlistCount'] = $itemlistCount;
			$resultArray['credits'] = $credits;
			$resultArray['similarUser'] = array();
			foreach ($favUserModel as $key => $value) {
				$resultArray['similarUser'][$key]['userId'] = $value['User']['id'];
				$resultArray['similarUser'][$key]['userName'] = $value['User']['username_url'];
				$resultArray['similarUser'][$key]['firstName'] = $value['User']['first_name'];
				$userImage = $value['User']['profile_image'];
				if ($userImage == '') {
					$userImage = 'usrimg.jpg';
				}
				$resultArray['similarUser'][$key]['profileImage'] = $img_path.'media/avatars/thumb70/'.$userImage;;
				$resultArray['similarUser'][$key]['about'] = $value['User']['about'];
			}
			$resultArray = json_encode($resultArray);
			echo '{"status":"true","result":'.$resultArray.'}';
		}
		
		public function followersList() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$userId = $_GET['userId'];
			$this->loadModel ('User');
			$this->loadModel('Follower');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			
			//$followModel = $this->Follower->findAllByuser_id($userId);
			$followModel = $this->Follower->find('all',array('conditions'=>array('user_id'=>$userId),
					'offset'=>$offset,'limit'=>$limit));
			$followModel1 = $this->Follower->findAllByfollow_user_id($userId);
			
			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['follow_user_id'];
				}
				
				foreach ($followModel1 as $follower1) {
					$followers_list[] = $follower1['Follower']['user_id'];
				}
				//echo "<pre>";print_r($followers);die;
				$userModel = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god',
						'User.activation <>'=>'0','User.id'=>$followers)));
				
				
				//echo "<pre>";print_r($followers_list);die;
				
				$resultArray['followers'] = array();
				foreach ($userModel as $key => $value) {
					$resultArray['followers'][$key]['userId'] = $value['User']['id'];
					$resultArray['followers'][$key]['userName'] = $value['User']['username_url'];
					$resultArray['followers'][$key]['firstName'] = $value['User']['first_name'];
					if(in_array($value['User']['id'], $followers_list)){
						$resultArray['followers'][$key]['status'] = 'unfollow';
					}else{
						$resultArray['followers'][$key]['status'] = 'follow';						
					}
					
					$imageName = $value['User']['profile_image'];
					if ($imageName == ''){
						$imageName = "usrimg.jpg";
					}
					$resultArray['followers'][$key]['profileImage'] = $img_path.'media/avatars/thumb350/'.$imageName;
				}
				//echo "<pre>";print_r($resultArray);die;
				$resultArray = json_encode($resultArray);
				echo '{"status":"true","result":'.$resultArray.'}';
			} else {
				echo '{"status":"false","message":"You have no Followers"}';
			}
			
		}
		
		public function followingList() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$userId = $_GET['userId'];
			$this->loadModel ('User');
			$this->loadModel('Follower');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
				
			//$followModel = $this->Follower->findAllByfollow_user_id($userId);
			$followModel = $this->Follower->find('all',array('conditions'=>array('follow_user_id'=>$userId),
					'offset'=>$offset,'limit'=>$limit));

			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['user_id'];
				}
				$userModel = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god',
						'User.activation <>'=>'0','User.id'=>$followers)));
				
				$resultArray['following'] = array();
				foreach ($userModel as $key => $value) {
					$resultArray['following'][$key]['userId'] = $value['User']['id'];
					$resultArray['following'][$key]['userName'] = $value['User']['username_url'];
					$resultArray['following'][$key]['firstName'] = $value['User']['first_name'];
					$resultArray['following'][$key]['status'] = 'unfollow';	
					$imageName = $value['User']['profile_image'];
					if ($imageName == ''){
						$imageName = "usrimg.jpg";
					}
					$resultArray['following'][$key]['profileImage'] = $img_path.'media/avatars/thumb350/'.$imageName;
				}
				
				//echo "<pre>";print_r($resultArray);die;
				
				$resultArray = json_encode($resultArray);
				echo '{"status":"true","result":'.$resultArray.'}';
			} else {
				echo '{"status":"false","message":"You are not Following any one"}';
			}
		}
		
		public function followingidList() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$userId = $_GET['userId'];
			$this->loadModel ('User');
			$this->loadModel('Follower');
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
		
			$followModel = $this->Follower->findAllByfollow_user_id($userId);
		
			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['user_id'];
				}
				$userModel = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$followers)));
		
				$resultArray['following'] = array();
				foreach ($userModel as $key => $value) {
					$resultArray['following'][$key]['userId'] = $value['User']['id'];
					//$resultArray['following'][$key]['userName'] = $value['User']['username_url'];
					//$resultArray['following'][$key]['firstName'] = $value['User']['first_name'];
					//$resultArray['following'][$key]['status'] = 'unfollow';
					//$imageName = $value['User']['profile_image'];
					/* if ($imageName == ''){
						$imageName = "usrimg.jpg";
					} */
					//$resultArray['following'][$key]['profileImage'] = $img_path.'media/avatars/thumb150/'.$imageName;
				}
		
				//echo "<pre>";print_r($resultArray);die;
		
				$resultArray = json_encode($resultArray);
				echo '{"status":"true","result":'.$resultArray.'}';
			} else {
				echo '{"status":"false","message":"You are not Following any one"}';
			}
		}
		
		
		
		public function updateSettings() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$userId = $_GET['userId'];
			$this->loadModel ('User');
		}
		
		public function loginWithSocial () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('User');
			
			$type = $_GET['type'];
			$socialId = $_GET['id'];
			$socialFirstName = urldecode($_GET['firstName']);
			$socialLastName = urldecode($_GET['lastName']);
			$socialEmail = $_GET['email'];
			if ($socialLastName != '') {
				$socialFirstName .= " ".$socialLastName;
			}
			$status = false;
			$userName = "";
			$photo = "";
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
				
			if (isset($_GET['imageUrl'])){
				$imageurl = str_replace("http", "http://", $_GET['imageUrl']);
				$imageName = $socialId.".jpg";
				//echo $imageName;die;
				$this->FileUpload->upload($imageurl,$imageName);
			}else {
				$imageName = '';
			}
			
			switch ($type) {
				case "facebook" :
					$userModel = $this->User->find('all',array('conditions'=>array('email'=>$socialEmail)));
					if (count($userModel) > 0) {
						$user_api_details = json_decode($userModel[0]['User']['user_api_details'],true);
						$userid = $userModel[0]['User']['id'];
						$userName = $userModel[0]['User']['first_name'];
						if ($userModel[0]['User']['profile_image'] != "") {
							$photo = $userModel[0]['User']['profile_image'];
						}else{
							$this->request->data['User']['profile_image'] = $imageName;
							$photo = $imageName;
						}
						if (!empty($user_api_details)) {
							$user_api_details['socialLoginDetails']['facebookName'] = $socialFirstName;
						}else {
							$user_api_details['socialLoginDetails']['facebookName'] = $socialFirstName;
						}
						$user_api_details = json_encode($user_api_details);
						$this->request->data['User']['facebook_id'] = $socialId;
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['id'] = $userModel[0]['User']['id'];
							
						$this->User->save($this->request->data);
						$status = true;
					}else {
						$user_api_details['socialLoginDetails']['facebookName'] = $socialFirstName;
						$user_api_details = json_encode($user_api_details);
						$userName = $socialFirstName;
						
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['facebook_id'] = $socialId;
						$this->request->data['User']['username'] = $socialFirstName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($socialFirstName);
						$this->request->data['User']['first_name'] = $socialFirstName;
						$this->request->data['User']['email'] = $socialEmail;
							
						$this->request->data['User']['user_level'] = 'normal';
						$this->request->data['User']['user_status'] = 'enable';
						$this->request->data['User']['login_type'] = 'facebook';
						$this->request->data['User']['activation'] = '1';
						$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
						$this->request->data['User']['profile_image'] = $imageName;
						$uniquecode = $this->Urlfriendly->get_uniquecode(8);
						$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
						$this->User->save($this->request->data);
						$userid = $this->User->getLastInsertID();
							
						$this->loadModel('Shop');
						$this->request->data['Shop']['user_id'] = $userid;
						$this->Shop->save($this->request->data);
						$userName = str_replace(" ", "", $userName);
						$userName .= $userid;
						$this->request->data['User']['username'] = $userName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($userName);
						$this->request->data['User']['id'] = $userid;
						$this->User->save($this->request->data);
						$photo = $imageName;
						$status = true;
					}
					break;
				case "twitter" :
					$userModel = $this->User->find('all',array('conditions'=>array('twitter_id'=>$socialId)));
					if (count($userModel) > 0) {
						$user_api_details = json_decode($userModel[0]['User']['user_api_details'],true);
						$userid = $userModel[0]['User']['id'];
						$userName = $userModel[0]['User']['first_name'];
						$socialFirstName = $userModel[0]['User']['first_name'];
						if ($userModel[0]['User']['profile_image'] != "") {
							$photo = $userModel[0]['User']['profile_image'];
						}else{
							$this->request->data['User']['profile_image'] = $imageName;
							$photo = $imageName;
						}
						if (!empty($user_api_details)) {
							$user_api_details['socialLoginDetails']['twitterUserName'] = $socialFirstName;
						}else {
							$user_api_details['socialLoginDetails']['twitterUserName'] = $socialFirstName;
						}
						$user_api_details = json_encode($user_api_details);
						$this->request->data['User']['twitter_id'] = $socialId;
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['id'] = $userModel[0]['User']['id'];
							
						$this->User->save($this->request->data);
						$status = true;
					}else {
						$user_api_details['socialLoginDetails']['twitterUserName'] = $socialFirstName;
						$user_api_details = json_encode($user_api_details);
						$userName = $socialFirstName;
						
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['twitter_id'] = $socialId;
						$this->request->data['User']['username'] = $socialFirstName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($socialFirstName);
						$this->request->data['User']['first_name'] = $socialFirstName;
						$this->request->data['User']['email'] = $socialEmail;
							
						$this->request->data['User']['user_level'] = 'normal';
						$this->request->data['User']['user_status'] = 'enable';
						$this->request->data['User']['login_type'] = 'twitter';
						$this->request->data['User']['activation'] = '1';
						$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
						$this->request->data['User']['profile_image'] = $imageName;
						$uniquecode = $this->Urlfriendly->get_uniquecode(8);
						$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
						$this->User->save($this->request->data);
						$userid = $this->User->getLastInsertID();
							
						$this->loadModel('Shop');
						$this->request->data['Shop']['user_id'] = $userid;
						$this->Shop->save($this->request->data);
						$userName = str_replace(" ", "", $userName);
						$userName .= $userid;
						$this->request->data['User']['username'] = $userName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($userName);
						$this->request->data['User']['id'] = $userid;
						$this->User->save($this->request->data);
						$photo = $imageName;
						$status = true;
					}
					break;
				case "google" :
					$userModel = $this->User->find('all',array('conditions'=>array('email'=>$socialEmail)));
					if (count($userModel) > 0) {
						$user_api_details = json_decode($userModel[0]['User']['user_api_details'],true);
						$userid = $userModel[0]['User']['id'];
						$userName = $userModel[0]['User']['first_name'];
						if ($userModel[0]['User']['profile_image'] != "") {
							$photo = $userModel[0]['User']['profile_image'];
						}else{
							$this->request->data['User']['profile_image'] = $imageName;
							$photo = $imageName;
						}
						if (!empty($user_api_details)) {
							$user_api_details['socialLoginDetails']['googleEmail'] = $socialFirstName;
						}else {
							$user_api_details['socialLoginDetails']['googleEmail'] = $socialFirstName;
						}
						$user_api_details = json_encode($user_api_details);
						$this->request->data['User']['google_id'] = $socialId;
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['id'] = $userModel[0]['User']['id'];
							
						$this->User->save($this->request->data);
						$status = true;
					}else {
						$user_api_details['socialLoginDetails']['googleEmail'] = $socialFirstName;
						$user_api_details = json_encode($user_api_details);
						$userName = $socialFirstName;
						
						$this->request->data['User']['user_api_details'] = $user_api_details;
						$this->request->data['User']['google_id'] = $socialId;
						$this->request->data['User']['username'] = $socialFirstName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($socialFirstName);
						$this->request->data['User']['first_name'] = $socialFirstName;
						$this->request->data['User']['email'] = $socialEmail;
							
						$this->request->data['User']['user_level'] = 'normal';
						$this->request->data['User']['user_status'] = 'enable';
						$this->request->data['User']['login_type'] = 'google';
						$this->request->data['User']['activation'] = '1';
						$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
						$this->request->data['User']['profile_image'] = $imageName;
						$uniquecode = $this->Urlfriendly->get_uniquecode(8);
						$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
						$this->User->save($this->request->data);
						$userid = $this->User->getLastInsertID();
							
						$this->loadModel('Shop');
						$this->request->data['Shop']['user_id'] = $userid;
						$this->Shop->save($this->request->data);
						$userName = str_replace(" ", "", $userName);
						$userName .= $userid;
						$this->request->data['User']['username'] = $userName;
						$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($userName);
						$this->request->data['User']['id'] = $userid;
						$this->User->save($this->request->data);
						$photo = $imageName;
						$status = true;
					}
					break;
			}
			if ($status == 'true') {
				if (isset($_GET['deviceToken'])){
					$deviceToken = $_GET['deviceToken'];
					$userId = $userid;
					$this->loadModel ('Userdevice');
						
					$userdeviceDet = $this->Userdevice->find('all',array('conditions'=>array('deviceToken'=>$deviceToken)));
						
					if(!empty($userdeviceDet)){
						$devicetokentab = $userdeviceDet[0]['Userdevice']['deviceToken'];
						if (isset($_POST['devicetype'])){
							$this->Userdevice->updateAll(array('Userdevice.user_id' => $userId, 'Userdevice.type' => $_POST['devicetype']), array('Userdevice.deviceToken' => $devicetokentab));
						}else{
							$this->Userdevice->updateAll(array('Userdevice.user_id' => $userId), array('Userdevice.deviceToken' => $devicetokentab));
						}
					}else{
						$this->request->data['Userdevice']['user_id'] = $userId;
						$this->request->data['Userdevice']['deviceToken'] = $deviceToken;
						if (isset($_POST['devicetype'])){
							$this->request->data['Userdevice']['type'] = $_POST['devicetype'];
						}
						$this->request->data['Userdevice']['cdate'] = time();
						$this->Userdevice->save($this->request->data);
					}
				}
				
				$responce['userId'] = $userid;
				$responce['userName'] = $userName;
				$responce['fullName'] = $socialFirstName;
				if ($photo == "") {
					$photo = "usrimg.jpg";
				}
				$responce['photo'] = $img_path.'media/avatars/thumb150/'.$photo;
				$resultArray = json_encode($responce);
				echo '{"status":"true","result":'.$resultArray.'}';
			}else {
				echo '{"status":"false","message":"Unable to save the data now"}';
			}
		}
		
		public function setSettings() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('User');
			$userid = $_GET['userId'];
			$parentCat = $_GET['type'];
			//$subCat = $_GET['subType'];
			if (isset($_GET['action']))
				$action = $_GET['action'];
			
			$userModel = $this->User->findByid($userid);
			$userApiDetails = $userModel['User']['user_api_details'];
			if ($userApiDetails != "")
				$userApiDetails = json_decode($userApiDetails,true);
			switch ($parentCat){
				case 1 :
					$parentCat = "Timeline";
					$subCat = "Everything";
					$altCat = "Following";
					break;
				case 2 :
					$parentCat = "Timeline";
					$subCat = "Following";
					$altCat = "Everything";
					break;
				case 3 :
					$status = 0;
					if($action == "true") {
						$status = 1;
					}
					$this->User->updateAll(array('someone_follow' => $status), array('User.id' => $userid));
					break;
				case 4 :
					$status = 0;
					if($action == "true") {
						$status = 1;
					}
					$this->User->updateAll(array('someone_cmnt_ur_things' => $status), array('User.id' => $userid));
					break;
				case 5 :
					$status = 0;
					if($action == "true") {
						$status = 1;
					}
					$this->User->updateAll(array('your_thing_featured' => $status), array('User.id' => $userid));
					break;
				case 6 :
					$userApiDetails['socialLoginDetails']['facebookName'] = "";
					$userApiDetails = json_encode($userApiDetails);
					$userApiDetails = "'".$userApiDetails."'";
					$this->User->updateAll(array('facebook_id' => NULL,"user_api_details" => $userApiDetails), array('User.id' => $userid));
					break;
				case 7 :
					$userApiDetails['socialLoginDetails']['twitterUserName'] = "";
					$userApiDetails = json_encode($userApiDetails);
					$userApiDetails = "'".$userApiDetails."'";
					$this->User->updateAll(array('twitter_id' => NULL,"user_api_details" => $userApiDetails), array('User.id' => $userid));
					break;
				case 8 :
					$userApiDetails['socialLoginDetails']['googleEmail'] = "";
					$userApiDetails = json_encode($userApiDetails);
					$userApiDetails = "'".$userApiDetails."'";
					$this->User->updateAll(array('google_id' => NULL,"user_api_details" => $userApiDetails), array('User.id' => $userid));
					break;
				case 9 :
					$parentCat = "Timeline";
					$subCat = "IncludingMe";
					break;
			}
			if ($parentCat == "Timeline"){
				$userApiDetails['Timeline'][$subCat] = $action;
				if ($subCat != "IncludingMe"){
					$userApiDetails['Timeline'][$altCat] = 'true';
					if ($action == 'true'){
						$userApiDetails['Timeline'][$altCat] = 'false';
					}
				}
				$userApiDetails = json_encode($userApiDetails);
				$userApiDetails = "'".$userApiDetails."'";
				$this->User->updateAll(array('user_api_details' => $userApiDetails), array('User.id' => $userid));
			}
			
			echo '{"status":"true","result":"Settings Updated"}';
		}
		
		public function getSettings() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('User');
			$userid = $_GET['userId'];
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$userModel = $this->User->findById($userid);
			
			if (count($userModel) > 0){
				$result['userName'] = $userModel['User']['first_name'];
				$imageName = "usrimg.jpg";
				if ($userModel['User']['profile_image'] != "")
					$imageName = $userModel['User']['profile_image'];
				$result['userImage'] = $img_path.'media/avatars/thumb150/'.$imageName;
				
				if($userModel['User']['credit_total']==''){
					$creditss = "No credits";
				}else{					
					$creditss = $userModel['User']['credit_total'];
				}
				$result['creditAmount'] = $creditss;			
				
				$user_api_details = json_decode($userModel['User']['user_api_details'],true);
				if (isset($user_api_details['socialLoginDetails'])) {
					$social['facebookName'] = NULL;
					if(!empty($user_api_details['socialLoginDetails']['facebookName'])){
						$social['facebookName'] = $user_api_details['socialLoginDetails']['facebookName'];
					}
					$social['twitterUserName'] = NULL;
					if(!empty($user_api_details['socialLoginDetails']['twitterUserName'])){
						$social['twitterUserName'] = $user_api_details['socialLoginDetails']['twitterUserName'];
					}
					$social['googleEmail'] = NULL;
					if(!empty($user_api_details['socialLoginDetails']['googleEmail'])){
						$social['googleEmail'] = $user_api_details['socialLoginDetails']['googleEmail'];
					}
					$result['userSocialLogins'] = $social;
				}
				if (isset($user_api_details['Timeline'])) {
					if(!isset($user_api_details['Timeline']['Everything'])){
						$user_api_details['Timeline']['Everything'] = false;
					}
					if(!isset($user_api_details['Timeline']['Following'])){
						$user_api_details['Timeline']['Following'] = false;
					}
					if(!isset($user_api_details['Timeline']['IncludingMe'])){
						$user_api_details['Timeline']['IncludingMe'] = false;
					}
					$result['userTimeLineDetails'] = $user_api_details['Timeline'];
				}else {
					$timeLine["everyThing"] = TRUE;	
					$timeLine["followUser"] = FALSE;
					$timeLine["includingMe"] = FALSE;
					$result['userTimeLineDetails'] = $timeLine;
				}
				$result['someoneFollow'] = FALSE;
				if ($userModel['User']['someone_follow'] == 1) {
					$result['someoneFollow'] = TRUE;
				}
				$result['someoneShows'] = FALSE;
				if ($userModel['User']['someone_show'] == 1) {
					$result['someoneShows'] = TRUE;
				}
				$result['someoneComment'] = FALSE;
				if ($userModel['User']['someone_cmnt_ur_things'] == 1) {
					$result['someoneComment'] = TRUE;
				}
				$result['someoneFeatured'] = FALSE;
				if ($userModel['User']['your_thing_featured'] == 1) {
					$result['someoneFeatured'] = TRUE;
				}
				$result['someoneMentions'] = FALSE;
				if ($userModel['User']['someone_mention_u'] == 1) {
					$result['someoneMentions'] = TRUE;
				}
				$resultArray = json_encode($result);
				echo '{"status":"true","result":'.$resultArray.'}';
			}else {
				echo '{"status":"false","message":"User Not Found"}';
			}
		}
		
		public function searchItem() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			$searchText = $_GET['keyword'];
			$favitems_ids = array();
			$items_data = array();
			$limit = 10;
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}
			if(isset($_GET['userId'])) {
				$userId = $_GET['userId'];
				$searchCondition = array('status'=>'publish','Item.item_title like'=>"%".$searchText."%");
				$userModel = $this->User->findByid($_GET['userId']);
				$userApiDetails = $userModel['User']['user_api_details'];
				if ($userApiDetails != "") {
					$userApiDetails = json_decode($userApiDetails,true);
					if(isset($userApiDetails['Timeline']['IncludingMe']) && $userApiDetails['Timeline']['IncludingMe'] == 'false') {
						$searchCondition['Item.user_id <>'] = $userId;
					}
				}
			 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
			 	if(count($items_fav_data) > 0){
				 	foreach($items_fav_data as $favitems){
				 		//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
				 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
				 	}
			 	}else{
			 		$favitems_ids = array();
			 	}
			 	//echo "<pre>";print_r($favitems_ids);die;
			 	if (isset($_GET['offset'])){
			 		$items_data = $this->Item->find('all',array('conditions'=>$searchCondition,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
			 	}else {
					$items_data = $this->Item->find('all',array('conditions'=>$searchCondition,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			 	}
			}
			 else{
			 	if (isset($_GET['offset'])){
			 		$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.item_title like'=>"%".$searchText."%"),'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
			 	}else {
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.item_title like'=>"%".$searchText."%"),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			 	}
			$favitems_ids=null;
			//$this->redirect('/api/login/');
			}
			if (count($items_data) > 0) {
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids);
				echo '{"status":"true","result":'.$resultArray.'}';
			}else{
				echo '{"status":"false","message":"No Data Found"}';
			}
		}
		
		public function shop () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('Category');
			$this->loadModel ('Color');
			$this->loadModel ('Price');
			$resultarray = array();
			$resultarray['Category'] = array();
			$resultarray['Category']['parent'] = array();
			
			$CategoryModel= $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
			if (count($CategoryModel) > 0) {
				for ($i=0;$i<count($CategoryModel);$i++) {
					$resultarray['Category']['parent'][$i] = array();
					$categoryId = $CategoryModel[$i]['Category']['id'];
					$resultarray['Category']['parent'][$i]['id'] = $categoryId;
					$resultarray['Category']['parent'][$i]['name'] = $CategoryModel[$i]['Category']['category_name'];
					$resultarray['Category']['parent'][$i]['subcategory'] = array();
					$subcategoryModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>'0')));
					if (count($subcategoryModel) > 0) {
						for ($j=0;$j<count($subcategoryModel);$j++) {
							$subcatid = $subcategoryModel[$j]['Category']['id'];
							$subname = $subcategoryModel[$j]['Category']['category_name'];
							$resultarray['Category']['parent'][$i]['subcategory'][$j] =array();
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['id'] = $subcatid;
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['name'] = $subname;
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'] = array();
							$subcatModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>$subcatid)));
							if (count($subcatModel) > 0) {
								for ($k=0;$k < count($subcatModel);$k++) {
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k] = array();
									$subsubid = $subcatModel[$k]['Category']['id'];
									$subsubname = $subcatModel[$k]['Category']['category_name'];
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k]['id'] = $subsubid;
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k]['name'] = $subsubname;
								}
							}
						}
					}
				}
				$resultarray['Color'] = array();
				$colorModel = $this->Color->find('all');
				if (count($colorModel) > 0) {
					for ($i=0;$i<count($colorModel);$i++) {
						$resultarray['Color'][$i] = array();
						$resultarray['Color'][$i]['code'] = $colorModel[$i]['Color']['color_hex'];
						$resultarray['Color'][$i]['color'] = $colorModel[$i]['Color']['color_name'];
						$resultarray['Color'][$i]['colorRGB'] = $colorModel[$i]['Color']['rgb'];
					}
				}
				$resultarray['Price'] = array();
				$priceModel = $this->Price->find('all');
				if (count($priceModel) > 0) {
					for ($i=0;$i<count($priceModel);$i++) {
						$from = $priceModel[$i]['Price']['from'];
						$to = $priceModel[$i]['Price']['to'];
						if ($to != '') {
							$price = $from."-".$to;
						}else {
							$price = $from."+";
						}
						$resultarray['Price'][$i] = $price;
					}
				}
				$resultarray = json_encode($resultarray);
				echo '{"status":"true","result":'.$resultarray.'}';
			}else {
				echo '{"status":"false","message":"Error"}';
			}
		}
		
		public function shopsearch () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			
			$condition = array();
			$condition['conditions'] = array();
			$condition['conditions']['status'] = 'publish';
			if (isset($_GET['category']) && isset($_GET['superCat']) && isset($_GET['subCat'])) {
				$condition['conditions']['Item.sub_catid'] = $_GET['subCat'];
			}else if(isset($_GET['category']) && isset($_GET['superCat']) && !isset($_GET['subCat'])){
				$condition['conditions']['Item.super_catid'] = $_GET['superCat'];
			}else if(isset($_GET['category']) && !isset($_GET['superCat']) && !isset($_GET['subCat'])) {
				$condition['conditions']['Item.category_id'] = $_GET['category'];
			}
			if (isset($_GET['priceMin'])) {
				$condition['conditions']['Item.price >='] = $_GET['priceMin'];
			}
			if (isset($_GET['priceMax'])) {
				$condition['conditions']['Item.price <='] = $_GET['priceMax'];
			}
			if (isset($_GET['color'])) {
				$condition['conditions']['Item.item_color LIKE'] = '%'.$_GET['color'].'%';
			}
			$condition['limit'] = 10;
			if (isset($_GET['limit'])) {
				$condition['limit'] = $_GET['limit'];
			}
			if (isset($_GET['offset'])) {
				$condition['offset'] = $_GET['offset'];
			}
			
			$condition['order'] = array();
			if (isset ($_GET['sorting'])) {
				switch (urldecode($_GET['sorting'])) {
					case "ASC" :
						$condition['order']['Item.price'] = 'ASC';
						break;
					case "DESC" :
						$condition['order']['Item.price'] = 'DESC';
						break;
					case "Oldest first" :
						$condition['order']['Item.id'] = 'ASC';
						break;
					case "Newest first" :
						$condition['order']['Item.id'] = 'DESC';
						break;
					default:
						$condition['order']['Item.id'] = 'DESC';
				}
			}else {
				$condition['order']['Item.id'] = 'DESC';
			}
			
			if(isset($_GET['userId'])) {
				$userId = $_GET['userId'];
				$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
				if(count($items_fav_data) > 0){
					foreach($items_fav_data as $favitems){
						//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
						$favitems_ids[] = $favitems['Itemfav']['item_id'];
					}
				}else{
					$favitems_ids = array();
				}
				$items_data = $this->Item->find('all',$condition);
					
			}
			else{
				$items_data = $this->Item->find('all',$condition);		
				$favitems_ids=null;
			}
			//echo "<pre>";print_r($items_data);die;
			if(empty($items_data)){
				echo '{"status":"false","result":"No data found"}';
			}else{
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids);
				//echo '{"status":"'.$resultArray.'"}';die;
				//echo "<pre>";print_r($resultArray);die;
				echo '{"status":"true","result":'.$resultArray.'}';
			}
			
		}
		
		public function userCollections (){
			$userId = $_GET['userId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel ('Follower');
			
			$itemModel = $this->Item->find('all',array('conditions' => array('Item.user_id'=>$userId,'Item.status'=>'publish')));

			$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
			if(count($items_fav_data) > 0){
				foreach($items_fav_data as $favitems){
					//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
					$favitems_ids[] = $favitems['Itemfav']['item_id'];
				}
			}else{
				$favitems_ids = array();
			}
			
			if(empty($itemModel)){
				echo '{"status":"false","result":"You didnt added any item yet"}';
			}else{
				$result = $this->convertJsonHome($itemModel,$favitems_ids);
				echo '{"status":"true","result":'.$result.'}';
			}
		}
		
		public function myOrders (){
			$recent = $_GET['recent'];
			$userid = $_GET['userId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('User');
			$this->loadModel('Forexrate');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Trackingdetails');
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
				
			$forexrateModel = $this->Forexrate->find('all');
			$currencySymbol = array();
			foreach($forexrateModel as $forexrate){
				$cCode = $forexrate['Forexrate']['currency_code'];
				$cSymbol = $forexrate['Forexrate']['currency_symbol'];
				$currencySymbol[$cCode] = $cSymbol;
			}
			
			if ($recent == 1){
				$timeline = strtotime('-1 month');
				$ordersModel = $this->Orders->find('all',array('conditions'=>array('userid'=>$userid,
						'orderdate >'=>$timeline),'order'=>array('orderid'=>'desc'),'offset'=>$offset,
						'limit'=>$limit));
			}else{
				$timeline = strtotime('-1 month');
				$ordersModel = $this->Orders->find('all',array('conditions'=>array('userid'=>$userid,
						'orderdate <' =>$timeline),	'order'=>array('orderid'=>'desc'),'offset'=>$offset,
						'limit'=>$limit));
			}
			$orderid = array();
			$shippingId = array();
			foreach ($ordersModel as $value) {
				$orderid[] = $value['Orders']['orderid'];
				$merchantid[] = $value['Orders']['merchant_id'];
				if(!in_array($value['Orders']['shippingaddress'],$shippingId)){
					$shippingId[] = $value['Orders']['shippingaddress'];
				}
			}
			if (count($shippingId) > 0){
				$shippingModel = $this->Shippingaddresses->find('all',array('conditions'=>array(
						'shippingid'=>$shippingId)));
				foreach($shippingModel as $shipping){
					$id = $shipping['Shippingaddresses']['shippingid'];
					$shippingAddress[$id]['name'] = $shipping['Shippingaddresses']['name'];
					$shippingAddress[$id]['nickname'] = $shipping['Shippingaddresses']['nickname'];
					$shippingAddress[$id]['country'] = $shipping['Shippingaddresses']['country'];
					$shippingAddress[$id]['state'] = $shipping['Shippingaddresses']['state'];
					$shippingAddress[$id]['address1'] = $shipping['Shippingaddresses']['address1'];
					$shippingAddress[$id]['address2'] = $shipping['Shippingaddresses']['address2'];
					$shippingAddress[$id]['city'] = $shipping['Shippingaddresses']['city'];
					$shippingAddress[$id]['zipcode'] = $shipping['Shippingaddresses']['zipcode'];
					$shippingAddress[$id]['phone'] = $shipping['Shippingaddresses']['phone'];
					$shippingAddress[$id]['countrycode'] = $shipping['Shippingaddresses']['countrycode'];
				}
			}
			//echo "<pre>";print_r($trackingModel);die;
			
			if(count($orderid) > 0) {
				$trackingModel = $this->Trackingdetails->find('all',array('conditions'=>array(
									'orderid'=>$orderid)));
				//echo "<pre>";print_r($trackingModel);die;
				if (!empty($trackingModel)){
					foreach ($trackingModel as $track){
						$id = $track['Trackingdetails']['orderid'];
						$Trackingdetails[$id]['id'] = $track['Trackingdetails']['id'];
						$Trackingdetails[$id]['shippingdate'] = $track['Trackingdetails']['shippingdate'];
						$Trackingdetails[$id]['couriername'] = $track['Trackingdetails']['couriername'];
						$Trackingdetails[$id]['courierservice'] = $track['Trackingdetails']['courierservice'];
						$Trackingdetails[$id]['trackingid'] = $track['Trackingdetails']['trackingid'];
						$Trackingdetails[$id]['notes'] = $track['Trackingdetails']['notes'];
					}
				}
				$merchantModel = $this->User->findAllById($merchantid);
				$merchantArray = array();
				foreach($merchantModel as $merchant){
					$mUser = $merchant['User']['id'];
					$merchantArray[$mUser] = $merchant;
				}
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemid = array();
				foreach ($orderitemModel as $value) {
					$orid = $value['Order_items']['orderid'];
					if (!isset($oritmkey[$orid])){
						$oritmkey[$orid] = 0;
					}
					$itemid[] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemid'] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemname'] = $value['Order_items']['itemname'];
					$orderitems[$orid][$oritmkey[$orid]]['itemtotal'] = $value['Order_items']['itemprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemsunitprice'] = $value['Order_items']['itemunitprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemssize'] = $value['Order_items']['item_size'];
					$orderitems[$orid][$oritmkey[$orid]]['quantity'] = $value['Order_items']['itemquantity'];
					$oritmkey[$orid]++;
				}
				if (count($itemid) > 0) {
				 $itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid)));
				}
				foreach($itemModel as $item) {
					$itemArray[$item['Item']['id']] = $item['Photo'];
				}
			}
			//print_r($itemArray);die;
			$orderDetails = array();
			foreach ($ordersModel as $key => $orders){
				$orderid = $orders['Orders']['orderid'];
				$orderShip = $orders['Orders']['shippingaddress'];
				$orderCurny = $orders['Orders']['currency'];
				$orderMerchant = $orders['Orders']['merchant_id'];
				$orderDetails[$key]['orderid'] = $orders['Orders']['orderid'];
				$orderDetails[$key]['price'] = $orders['Orders']['totalcost'];
				$orderDetails[$key]['shippingCost'] = $orders['Orders']['totalCostshipp'];
				$orderDetails[$key]['saledate'] = $orders['Orders']['orderdate'];
				$orderDetails[$key]['status'] = $orders['Orders']['status'];
				$orderDetails[$key]['shippingaddress'] = $shippingAddress[$orderShip];
				$orderDetails[$key]['trackingdetails'] = $Trackingdetails[$orderid];
				$orderDetails[$key]['merchantname'] = $merchantArray[$orderMerchant]['User']['username'];
				$orderDetails[$key]['merchantid'] = $orderMerchant;
				$orderDetails[$key]['merchantimage'] = $_SESSION['media_url'].'media/avatars/thumb350/'.$merchantArray[$orderMerchant]['User']['profile_image'];
				if (empty($merchantArray[$orderMerchant]['User']['profile_image'])){
					$orderDetails[$key]['merchantimage'] = $_SESSION['media_url'].'media/avatars/thumb350/usrimg.jpg';
				} 
				$itemkey = 0;
				foreach ($orderitems[$orderid] as $orderkey => $orderitem) {
					$itemid = $orderitems[$orderid][$orderkey]['itemid'];
					$itemImage = $_SESSION['media_url'].'media/items/thumb350/'.$itemArray[$itemid][0]['image_name'];
					
					$orderDetails[$key]['orderitems'][$itemkey]['itemimage'] = $itemImage;
					$orderDetails[$key]['orderitems'][$itemkey]['itemname'] = $orderitems[$orderid][$orderkey]['itemname'];
					$orderDetails[$key]['orderitems'][$itemkey]['quantity'] = $orderitems[$orderid][$orderkey]['quantity'];
					$orderDetails[$key]['orderitems'][$itemkey]['price'] = $orderitems[$orderid][$orderkey]['itemtotal'];
					$orderDetails[$key]['orderitems'][$itemkey]['unitprice'] = $orderitems[$orderid][$orderkey]['itemsunitprice'];
					$orderDetails[$key]['orderitems'][$itemkey]['size'] = $orderitems[$orderid][$orderkey]['itemssize'];
					$orderDetails[$key]['orderitems'][$itemkey]['cSymbol'] = $currencySymbol[$orderCurny];
					$itemkey++;
				}
			}
			//echo "<pre>";print_r($orderitems);die;
			//$this->set('orderDetails',$orderDetails);
			$result = json_encode($orderDetails);
			echo '{"status":"true","result":'.$result.'}';
		}
		
		public function mysales(){
			$userid = $_GET['userId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('User');
			$this->loadModel('Forexrate');
			$this->loadModel('Shippingaddresses');
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			
			$forexrateModel = $this->Forexrate->find('all');
			$currencySymbol = array();
			foreach($forexrateModel as $forexrate){
				$cCode = $forexrate['Forexrate']['currency_code'];
				$cSymbol = $forexrate['Forexrate']['currency_symbol'];
				$currencySymbol[$cCode] = $cSymbol;
			}
			
			$ordersModel = $this->Orders->find('all',array('conditions'=>array('merchant_id'=>$userid),
					'order'=>array('orderid'=>'desc'),'offset'=>$offset,'limit'=>$limit));
			$orderid = array();
			foreach ($ordersModel as $value) {
				$orderid[] = $value['Orders']['orderid'];
				$merchantid[] = $value['Orders']['userid'];
				if(!in_array($value['Orders']['shippingaddress'],$shippingId)){
					$shippingId[] = $value['Orders']['shippingaddress'];
				}
			}
			if (count($shippingId) > 0){
				$shippingModel = $this->Shippingaddresses->find('all',array('conditions'=>array(
						'shippingid'=>$shippingId)));
				foreach($shippingModel as $shipping){
					$id = $shipping['Shippingaddresses']['shippingid'];
					$shippingAddress[$id]['name'] = $shipping['Shippingaddresses']['name'];
					$shippingAddress[$id]['nickname'] = $shipping['Shippingaddresses']['nickname'];
					$shippingAddress[$id]['country'] = $shipping['Shippingaddresses']['country'];
					$shippingAddress[$id]['state'] = $shipping['Shippingaddresses']['state'];
					$shippingAddress[$id]['address1'] = $shipping['Shippingaddresses']['address1'];
					$shippingAddress[$id]['address2'] = $shipping['Shippingaddresses']['address2'];
					$shippingAddress[$id]['city'] = $shipping['Shippingaddresses']['city'];
					$shippingAddress[$id]['zipcode'] = $shipping['Shippingaddresses']['zipcode'];
					$shippingAddress[$id]['phone'] = $shipping['Shippingaddresses']['phone'];
					$shippingAddress[$id]['countrycode'] = $shipping['Shippingaddresses']['countrycode'];
				}
			}
			if(count($orderid) > 0) {
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemid = array();
				foreach ($orderitemModel as $value) {
					$orid = $value['Order_items']['orderid'];
					if (!isset($oritmkey[$orid])){
						$oritmkey[$orid] = 0;
					}
					$itemid[] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemid'] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemname'] = $value['Order_items']['itemname'];
					$orderitems[$orid][$oritmkey[$orid]]['itemtotal'] = $value['Order_items']['itemprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemsunitprice'] = $value['Order_items']['itemunitprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemssize'] = $value['Order_items']['item_size'];
					$orderitems[$orid][$oritmkey[$orid]]['quantity'] = $value['Order_items']['itemquantity'];
					$oritmkey[$orid]++;
				}
				$merchantModel = $this->User->findAllById($merchantid);
				$merchantArray = array();
				foreach($merchantModel as $merchant){
					$mUser = $merchant['User']['id'];
					$merchantArray[$mUser] = $merchant;
				}
				if (count($itemid) > 0) {
				 $itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid)));
				}
				foreach($itemModel as $item) {
					$itemArray[$item['Item']['id']] = $item['Photo'];
				}
			}
			$orderDetails = array();
			foreach ($ordersModel as $key => $orders){
				$orderid = $orders['Orders']['orderid'];
				$orderShip = $orders['Orders']['shippingaddress'];
				$orderCurny = $orders['Orders']['currency'];
				$orderMerchant = $orders['Orders']['userid'];
				$orderDetails[$key]['orderid'] = $orders['Orders']['orderid'];
				$orderDetails[$key]['price'] = $orders['Orders']['totalcost'];
				$orderDetails[$key]['shippingCost'] = $orders['Orders']['totalCostshipp'];
				$orderDetails[$key]['saledate'] = $orders['Orders']['orderdate'];
				$orderDetails[$key]['status'] = $orders['Orders']['status'];
				$orderDetails[$key]['shippingaddress'] = $shippingAddress[$orderShip];
				$orderDetails[$key]['buyername'] = $merchantArray[$orderMerchant]['User']['username'];
				$orderDetails[$key]['buyerid'] = $orderMerchant;
				$orderDetails[$key]['buyerimage'] = $_SESSION['media_url'].'media/avatars/thumb350/'.$merchantArray[$orderMerchant]['User']['profile_image'];
				if (empty($merchantArray[$orderMerchant]['User']['profile_image'])){
					$orderDetails[$key]['buyerimage'] = $_SESSION['media_url'].'media/avatars/thumb350/usrimg.jpg';
				} 
				$itemkey = 0;
				foreach ($orderitems[$orderid] as $orderkey => $orderitem) {
					$itemid = $orderitems[$orderid][$orderkey]['itemid'];
					$itemImage = $_SESSION['media_url'].'media/items/thumb350/'.$itemArray[$itemid][0]['image_name'];
					
					$orderDetails[$key]['orderitems'][$itemkey]['itemimage'] = $itemImage;
					$orderDetails[$key]['orderitems'][$itemkey]['itemname'] = $orderitems[$orderid][$orderkey]['itemname'];
					$orderDetails[$key]['orderitems'][$itemkey]['quantity'] = $orderitems[$orderid][$orderkey]['quantity'];
					$orderDetails[$key]['orderitems'][$itemkey]['price'] = $orderitems[$orderid][$orderkey]['itemtotal'];
					$orderDetails[$key]['orderitems'][$itemkey]['unitprice'] = $orderitems[$orderid][$orderkey]['itemsunitprice'];
					$orderDetails[$key]['orderitems'][$itemkey]['size'] = $orderitems[$orderid][$orderkey]['itemssize'];
					$orderDetails[$key]['orderitems'][$itemkey]['cSymbol'] = $currencySymbol[$orderCurny];
					$itemkey++;
				}
			}
			//echo "<pre>";print_r($orderitems);die;
			//$this->set('orderDetails',$orderDetails);
			$result = json_encode($orderDetails);
			echo '{"status":"true","result":'.$result.'}';
		}
		
		function orderstatus(){
			global $setngs;
			$this->autoLayout = false;
			$this->autoRender = false;
			$orderid = $_POST['orderid'];
			$status = $_POST['chstatus'];
			$this->loadModel('Orders');
				
			if ($status == 'Processing') {
				$statusDate = time();
				//$this->Orders->updateAll(array('merchant_id' => $user_id, 'totalcost' => $totalcost), array('orderid' => $orderId));
				$this->Orders->updateAll(array('status' => "'$status'", 'status_date' => "'$statusDate'"), array('orderid' => $orderid));
				
				echo '{"status":"true","result":"Status changed to Processing"}';
			}elseif($status == 'Delivered') {
				$statusDate = time();
				//$this->Orders->updateAll(array('merchant_id' => $user_id, 'totalcost' => $totalcost), array('orderid' => $orderId));
				$this->Orders->updateAll(array('status' => "'$status'", 'status_date' => "'$statusDate'"), array('orderid' => $orderid));
				
				echo '{"status":"true","result":"Status changed to Delivered"}';
			}elseif($status == 'Shipped'){
				$this->loadModel('Orders');
				$this->loadModel('Order_items');
				$this->loadModel('Shippingaddresses');
				$this->loadModel('User');
				$subject = $_POST['subject'];
				$message = $_POST['message'];
				
				$orderModel = $this->Orders->findByOrderid($orderid);
				$loguser = $this->User->findById($orderModel['Orders']['merchant_id']);
				$buyerModel = $this->User->findById($orderModel['Orders']['userid']);
				$buyeremail = $buyerModel['User']['email'];//$_POST['buyeremail'];
				$usernameforcust = $buyerModel['User']['first_name'];//$_POST['buyername'];
				$usershipping_addr = $this->Shippingaddresses->findByShippingid($orderModel['Orders']['shippingaddress']);
				
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemmailids = array();$itemname = array();
				$totquantity = array();$custmrsizeopt = array();
				foreach ($orderitemModel as $value) {
					$itemmailids[] = $value['Order_items']['itemid'];
					$itemname[] = $value['Order_items']['itemname'];
					if (!empty($value['Order_items']['item_size'])) {
						$custmrsizeopt[] = $value['Order_items']['item_size'];
					}else{
						$custmrsizeopt[] = '0';
					}
					$totquantity[] = $value['Order_items']['itemquantity'];
				}
		
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $buyeremail;
				$this->Email->subject = $subject;
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'markedshipped';
				$this->set('custom',$usernameforcust);
				$this->set('message',$message);
				//$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('itemid',$itemmailids);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$custmrsizeopt);
				$this->set('orderId',$orderid);
				$this->set('orderdate',$orderModel['Orders']['orderdate']);
				$this->set('usershipping_addr',$usershipping_addr);
				$this->set('totalcost',$orderModel['Orders']['totalcost']);
				$this->set('currencyCode',$orderModel['Orders']['currency']);
				/* $emailidcust = base64_encode($custom[0]);
				 $orderIdcust = base64_encode($orderId);
				$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
				$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust); */
				$this->Email->send();
				
				$this->Orders->updateAll(array('status' => "'Shipped'"), array('orderid' => $orderid));
				
				echo '{"status":"true","result":"Status changed to Shipped"}';
			}elseif($status == 'Track'){
				$this->loadModel('Orders');
				$this->loadModel('Shippingaddresses');
				$this->loadModel('Trackingdetails');
				$this->loadModel('Order_items');
				$this->loadModel('User');
				$orderid = $_POST['orderid'];
					
				$orderModel = $this->Orders->findByOrderid($orderid);
				$loguser = $this->User->findById($orderModel['Orders']['merchant_id']);
				$buyerModel = $this->User->findById($orderModel['Orders']['userid']);
				$buyeremail = $buyerModel['User']['email'];//$_POST['buyeremail'];
				$usernameforcust = $buyerModel['User']['first_name'];//$_POST['buyername'];
				$shipppingId = $orderModel['Orders']['shippingaddress'];
				$shippingModel = $this->Shippingaddresses->findByshippingid($shipppingId);
				$buyershipaddr = '';
				$buyershipaddr .= $shippingModel['Shippingaddresses']['address1'].",</br>";
				if (!empty($shippingModel['Shippingaddresses']['address2'])){
					$buyershipaddr .= $shippingModel['Shippingaddresses']['address2'].",</br>";
				}
				$buyershipaddr .= $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
				$buyershipaddr .= $shippingModel['Shippingaddresses']['state'].",</br>";
				$buyershipaddr .= $shippingModel['Shippingaddresses']['country'].",</br>";
				$buyershipaddr .= "Ph.: ".$shippingModel['Shippingaddresses']['phone'].".</br>";
				$subject = "Tracking Order Details";
				$message = "Your tracking order details for the listed item as below";
					
				$this->request->data['Trackingdetails']['orderid'] = $_POST['orderid'];
				$this->request->data['Trackingdetails']['status'] = $orderModel['Orders']['status'];
				$this->request->data['Trackingdetails']['merchantid'] = $loguser['User']['id'];
				$this->request->data['Trackingdetails']['buyername'] = $usernameforcust;
				$this->request->data['Trackingdetails']['buyeraddress'] = $buyershipaddr;
				$this->request->data['Trackingdetails']['shippingdate'] = $_POST['shippingdate'];
				$this->request->data['Trackingdetails']['couriername'] = $_POST['couriername'];
				$this->request->data['Trackingdetails']['courierservice'] = $_POST['courierservice'];
				$this->request->data['Trackingdetails']['trackingid'] = $_POST['trackid'];
				$this->request->data['Trackingdetails']['notes'] = $_POST['notes'];
				if ($_POST['id'] != 0){
					$this->request->data['Trackingdetails']['id'] = $_POST['id'];
					$subject = "Updated Tracking Order Details";
					$message = "Your updated tracking order details for the listed item as below";
				}
				$this->Trackingdetails->save($this->request->data);
				$usershipping_addr = $this->Shippingaddresses->findByShippingid($orderModel['Orders']['shippingaddress']);
					
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$_POST['orderid'])));
				$itemmailids = array();$itemname = array();
				$totquantity = array();$custmrsizeopt = array();
				foreach ($orderitemModel as $value) {
					$itemmailids[] = $value['Order_items']['itemid'];
					$itemname[] = $value['Order_items']['itemname'];
					if (!empty($value['Order_items']['item_size'])) {
						$custmrsizeopt[] = $value['Order_items']['item_size'];
					}else{
						$custmrsizeopt[] = '0';
					}
					$totquantity[] = $value['Order_items']['itemquantity'];
				}
		
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $buyeremail;
				$this->Email->subject = SITE_NAME." – Shipping details for order #$orderid.";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'trackdetailsmail';
				$this->set('custom',$usernameforcust);
				$this->set('message',$message);
				$this->set('shippingdate',$_POST['shippingdate']);
				$this->set('trackingid',$_POST['trackid']);
				$this->set('courierservice',$_POST['courierservice']);
				$this->set('couriername',$_POST['couriername']);
				$this->set('notes',$_POST['notes']);
				//$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('itemid',$itemmailids);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$custmrsizeopt);
				$this->set('orderId',$orderid);
				$this->set('orderdate',$orderModel['Orders']['orderdate']);
				$this->set('usershipping_addr',$usershipping_addr);
				$this->set('totalcost',$orderModel['Orders']['totalcost']);
				$this->set('currencyCode',$orderModel['Orders']['currency']);
				$this->Email->send();
					
				$this->Orders->updateAll(array('status' => "'Shipped'"), array('orderid' => $_POST['orderid']));
				
				echo '{"status":"true","result":"Tracking Details Updated"}';
			}
		}
		
		public function gettrackdetails(){
			global $setngs;
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Trackingdetails');
			$orderid = $_POST['orderid'];
			
			$trackingModel = $this->Trackingdetails->findByorderid($orderid);
			
			if (!empty($trackingModel)){
				$Trackingdetails['id'] = $trackingModel['Trackingdetails']['id'];
				$Trackingdetails['shippingdate'] = $trackingModel['Trackingdetails']['shippingdate'];
				$Trackingdetails['couriername'] = $trackingModel['Trackingdetails']['couriername'];
				$Trackingdetails['courierservice'] = $trackingModel['Trackingdetails']['courierservice'];
				$Trackingdetails['trackingid'] = $trackingModel['Trackingdetails']['trackingid'];
				$Trackingdetails['notes'] = $trackingModel['Trackingdetails']['notes'];
				
				$result = json_encode($Trackingdetails);
				echo '{"status":"true","result":'.$result.'}';
			}else{
				echo '{"status":"false","result":"No Tracking Details Found"}';
			}
		}
		
		public function addToCart() {
			$this->autoLayout = FALSE;
			$this->autoRender = false;
			$this->loadModel('Cart');
			$userId = $_GET['userId'];
			$itemId = $_GET['itemId'];
			$quantity = 1;
			if (isset($_GET['quantity'])) {
				$quantity = $_GET['quantity'];
			}
			$size = $_GET['size'];
			$cartModel = $this->Cart->find('first',array('conditions'=>array('user_id'=>$userId,
							'item_id'=>$itemId,'payment_status'=>'progress','size_options'=>$size)));
			if(empty($cartModel)) {
				$this->request->data['Cart']['user_id'] = $userId;
				$this->request->data['Cart']['item_id'] = $itemId;
				$this->request->data['Cart']['payment_status'] = 'progress';
				$this->request->data['Cart']['created_at'] = date('Y-m-d H:s:m',time());
				$this->request->data['Cart']['modified_at'] = date('Y-m-d H:s:m',time());
				$this->request->data['Cart']['quantity'] = $quantity;
				$this->request->data['Cart']['size_options'] = $size;
				
				if($this->Cart->save($this->request->data)) {
					echo '{"status":"true","message":"Item added to cart"}';
				}else{
					echo '{"status":"false","message":"Item cannot be add to Cart"}';
				}
			}else{
				echo '{"status":"false","message":"Item already in cart"}';
			}
		}
		
		public function myCart (){
			$userId = $_GET['userId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Cart');
			$this->loadModel('Item');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$cartModel = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			if(empty($cartModel)) {
				echo '{"status":"false","message":"Cart Empty"}';
				return;
			}
			foreach($cartModel as $cart){
				$itemIds[] = $cart['Cart']['item_id'];
			}
			
			$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemIds)));
			$merchant = array();
			$shopId = array();
			foreach ($itemModel as $item) {
				if(!isset($merchant[$item['Shop']['id']])){
					$shopId[] = $item['Shop']['id'];
					$merchant[$item['Shop']['id']] = array();
					$merchant[$item['Shop']['id']]['name'] = $item['User']['username_url'];
					$merchant[$item['Shop']['id']]['id'] = $item['User']['id'];
					$count[$item['Shop']['id']] = 1;
				}
				$merchant[$item['Shop']['id']]['images'][$count[$item['Shop']['id']]] = array();
				$merchant[$item['Shop']['id']]['images'][$count[$item['Shop']['id']]]['itemId'] = $item['Item']['id'];
				$path = $img_path."media/items/thumb350/".$item['Photo']['0']['image_name'];
				$merchant[$item['Shop']['id']]['images'][$count[$item['Shop']['id']]]['url'] = $path;
				$count[$item['Shop']['id']] += 1;
			}
			$resultArray['data'] = array();
			$resultcount = 0;
			foreach ($merchant as $key=>$mer){
				$resultArray['data'][$resultcount]['merchantName'] = $mer['name'];
				$resultArray['data'][$resultcount]['merchantId'] = $mer['id'];
				$resultArray['data'][$resultcount]['images'] = array();
				$innercount = 0;
				foreach($mer['images'] as $imkey=>$image){
					$resultArray['data'][$resultcount]['images'][$innercount]['id'] = $image['itemId'];
					$resultArray['data'][$resultcount]['images'][$innercount]['url'] = $image['url'];
					$innercount += 1;
				}
				$resultcount += 1;
			}
			$resultArray = json_encode($resultArray);
			echo '{"status":"true","result":'.$resultArray.'}';
		}
		
		public function getCartDetails(){
			$userId = $_GET['userId'];
			$itemIds = explode(',', $_GET['itemId']);
			$merchantId = $_GET['merchantId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Item');
			$this->loadModel('Cart');
			$this->loadModel('Tempaddresses');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$userModel = $this->User->findByid($userId);
			if (!isset($_GET['shippingId'])){
				$defaultAddress = $userModel['User']['defaultshipping'];
			}else{
				$defaultAddress = $_GET['shippingId'];
			}
			$shippingModel = $this->Tempaddresses->findByshippingid($defaultAddress);
			$countryCode = $shippingModel['Tempaddresses']['countrycode'];
			$itemarray['items'] = array();
			$count = 0;
			$shipping = 0;
			$grandTotal = 0;
			$itemAllow = 0;
			foreach($itemIds as $itemid){
				$cartModel = $this->Cart->find('first',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itemid,'payment_status'=>'progress')));
				$item = $this->Item->findByid($itemid);
				$shipFlag = 0;
				$elsewhere = 0;$elsewherPrice = 0;
				
				foreach ($item['Shiping'] as $ship){
					if($ship['country_id'] == $countryCode && $shipFlag == 0){
						$shipping += $ship['primary_cost'];
						$itemAllow = 1;
						$shipFlag = 1;
					}elseif($ship['country_id'] == 0 && $shipFlag == 0){
						$elsewherPrice = $ship['primary_cost'];
						$elsewhere = 1;
					}
				}
				if($elsewhere == 1 && $shipFlag == 0){
					$shipping += $elsewherPrice;
					$itemAllow = 1;
				}elseif($shipFlag == 0){
					$itemAllow = 0;
				}
				$itemarray['items'][$count]['itemId'] = $item['Item']['id'];
				$itemarray['items'][$count]['itemName'] = $item['Item']['item_title'];
				$path = $img_path."media/items/thumb350/".$item['Photo']['0']['image_name'];
				$itemarray['items'][$count]['itemUrl'] = $path;
				$itemarray['items'][$count]['itemPrice'] = $item['Item']['price'];
				$itemarray['items'][$count]['itemCount'] = $cartModel['Cart']['quantity'];
				$itemarray['items'][$count]['itemSize'] = $cartModel['Cart']['size_options'];
				$itemarray['items'][$count]['itemTotalCount'] = $item['Item']['quantity'];
				$itemarray['items'][$count]['itemApprove'] = $itemAllow;
				$grandTotal += $itemarray['items'][$count]['itemPrice'] * $cartModel['Cart']['quantity'];
				$count += 1;
			}
			$merchantModel = $this->User->findByid($merchantId);
			$resultArray['items'] = array();
			$resultArray['items']['MerchantName'] = $merchantModel['User']['username_url'];
			$resultArray['items']['MerchantId'] = $merchantModel['User']['id'];
			$resultArray['items']['shipping'] = $shipping;
			$resultArray['items']['totalCost'] = $grandTotal;
			$resultArray['items']['grandTotal'] = $grandTotal + $shipping;
			$resultArray['items']['products'] = $itemarray['items'];
			$resultArray = json_encode($resultArray);
			echo '{"status":"true","result":'.$resultArray.'}';
		}
		
		public function removeCartItem (){
			$userId = $_GET['userId'];
			$itemId = $_GET['itemId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Cart');
			
			$status = $this->Cart->deleteAll(array('user_id' => $userId,'item_id' => $itemId));
			
			if($status){
				echo '{"status":"true","message":"Deleted"}'; 
			}else{
				echo '{"status":"false","message":"Cannot be Deleted"}';
			}
			
		}
		
		public function changeCartQuantity() {
			$this->autoLayout = false;
			$this->autoRender = FALSE;
			$userId = $_GET['userId'];
			$itemId = $_GET['itemId'];
			$quantity = $_GET['quantity'];
			$this->loadModel('Cart');
			$this->loadModel('Item');
			
			$itemModel = $this->Item->findByid($itemId);
			$availableQty = $itemModel['Item']['quantity'];
			if($availableQty < $quantity){
				echo '{"status":"false","message":"Requested Quantity Not Available"}';
				return;
			}
			
			$cartModel = $this->Cart->find('first',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itemId,'payment_status'=>'progress')));
			if(!empty($cartModel)){
				$this->request->data['Cart']['id'] = $cartModel['Cart']['id'];
				$this->request->data['Cart']['quantity'] = $quantity;
				if($this->Cart->save($this->request->data)){
					echo '{"status":"true","message":"Quantity Updated"}';
				}else{
					echo '{"status":"false","message":"Unable to Update the Quantity Now"}';
				}
			}else{
				echo '{"status":"false","message":"Item Cannot be Found in Cart"}';
			}
		}
		
		public function addShippingAdddress() {
			$this->autoLayout = false;
			$this->autoRender = FALSE;
			$shippingId = 0;
			if (isset($_GET['shippingId'])){
				$shippingId = $_GET['shippingId'];
			}
			$userId = $_GET['userId'];
			$fullName = $_GET['fullName'];
			$nickName = $_GET['nickName'];
			$countryId = $_GET['countryId'];
			$countryName = $_GET['countryName'];
			$state = $_GET['state'];
			$address1 = $_GET['address1'];
			$address2 = $_GET['address2'];
			$city = $_GET['city'];
			$zipCode = $_GET['zipCode'];
			$phoneNo = $_GET['phoneNo'];
			$default = $_GET['default'];
			$this->loadModel('Tempaddresses');
			//$this->loadModel('Shippingaddresses');
			$this->loadModel('User');
				
			if ($shippingId == 0){
				$shippingModel = $this->Tempaddresses->find('all',array('conditions'=>array('nickname'=>$nickName)));
			}else{
				$shippingModel = $this->Tempaddresses->find('all',array('conditions'=>array('nickname'=>$nickName,'shippingid <>'=> $shippingId)));
			}
			
			if (isset($shippingModel) && !empty($shippingModel)){
				echo '{"status":"false","message":"Already a Shipping Address with this Nick Name Exist"}';
				return;
			}else{
				$outputValue = 'Added';
				if ($shippingId != 0){
					$this->request->data['Tempaddresses']['shippingid'] = $shippingId;
					$outputValue = 'Updated';
				}
				$this->request->data['Tempaddresses']['userid'] = $userId;
				$this->request->data['Tempaddresses']['name'] = $fullName;
				$this->request->data['Tempaddresses']['nickname'] = $nickName;
				$this->request->data['Tempaddresses']['country'] = $countryName;
				$this->request->data['Tempaddresses']['state'] = $state;
				$this->request->data['Tempaddresses']['address1'] = $address1;
				$this->request->data['Tempaddresses']['address2'] = $address2;
				$this->request->data['Tempaddresses']['city'] = $city;
				$this->request->data['Tempaddresses']['zipcode'] = $zipCode;
				$this->request->data['Tempaddresses']['phone'] = $phoneNo;
				$this->request->data['Tempaddresses']['countrycode'] = $countryId;
				$this->Tempaddresses->save($this->request->data);
				if ($shippingId == 0){
					$shippingId =  $this->Tempaddresses->getLastInsertID();
				}
				if($default == 1) {
					$this->request->data['User']['id'] = $userId;
					$this->request->data['User']['defaultshipping'] = $shippingId;
					$this->User->save($this->request->data);
					$this->request->data['Tempaddresses']['shippingid'] = $shippingId;
					$output = json_encode($this->request->data['Tempaddresses']);
				}else{
					$userModel = $this->User->findByid($userId);
					$defaultAddress = $userModel['User']['defaultshipping'];
					$shipping = $this->Tempaddresses->find('first',array('conditions'=>array('shippingid'=>$shippingId)));
					$shippingAddress['shippingid'] = $shipping['Tempaddresses']['shippingid'];
					$shippingAddress['nickname'] = $shipping['Tempaddresses']['nickname'];
					$shippingAddress['name'] = $shipping['Tempaddresses']['name'];
					$shippingAddress['country'] = $shipping['Tempaddresses']['country'];
					$shippingAddress['state'] = $shipping['Tempaddresses']['state'];
					$shippingAddress['address1'] = $shipping['Tempaddresses']['address1'];
					$shippingAddress['address2'] = $shipping['Tempaddresses']['address2'];
					$shippingAddress['city'] = $shipping['Tempaddresses']['city'];
					$shippingAddress['zipcode'] = $shipping['Tempaddresses']['zipcode'];
					$shippingAddress['phone'] = $shipping['Tempaddresses']['phone'];
					$shippingAddress['countrycode'] = $shipping['Tempaddresses']['countrycode'];
					$output = json_encode($shippingAddress);
				}
				//echo '{"status":"true","result":"Shipping Address '.$outputValue.' Successfully"}';
				echo '{"status":"true","result":'.$output.'}';
				return;
			}
		}
		
		public function getShippingAddress(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$userId = $_GET["userId"];
			$this->loadModel('Tempaddresses');
			
			$userModel = $this->findUser($userId);
			$defaultShipping = $userModel['User']['defaultshipping'];
			$shippingModel = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userId)));
			
			if (!empty($shippingModel)){
				$shippingAddress = array();
				foreach ($shippingModel as $skey => $shipping){
					$shippingAddress[$skey]['shippingid'] = $shipping['Tempaddresses']['shippingid'];
					$shippingAddress[$skey]['nickname'] = $shipping['Tempaddresses']['nickname'];
					$shippingAddress[$skey]['name'] = $shipping['Tempaddresses']['name'];
					$shippingAddress[$skey]['country'] = $shipping['Tempaddresses']['country'];
					$shippingAddress[$skey]['state'] = $shipping['Tempaddresses']['state'];
					$shippingAddress[$skey]['address1'] = $shipping['Tempaddresses']['address1'];
					$shippingAddress[$skey]['address2'] = $shipping['Tempaddresses']['address2'];
					$shippingAddress[$skey]['city'] = $shipping['Tempaddresses']['city'];
					$shippingAddress[$skey]['zipcode'] = $shipping['Tempaddresses']['zipcode'];
					$shippingAddress[$skey]['phone'] = $shipping['Tempaddresses']['phone'];
					$shippingAddress[$skey]['countrycode'] = $shipping['Tempaddresses']['countrycode'];
					$shippingAddress[$skey]['default'] = 0;
					if ($defaultShipping == $shipping['Tempaddresses']['shippingid']){
						$shippingAddress[$skey]['default'] = 1;
					}
				}
				$resultArray = json_encode($shippingAddress);
				echo '{"status":"true","result":'.$resultArray.'}';
				return;
			}else{
				echo '{"status":"false","message":"Yet no shipping address added"}';
				return;
			}
		}
		
		public function cartCommissionPross (){
			$userId = $_GET["userId"];
			$merchantId = $_GET['merchantId'];
			$defaultShipping = $_GET['shippingId'];
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Commission');
			$this->loadModel('Cart');
			$this->loadModel('Shop');
			$this->loadModel('Tempaddresses');
			$shipping = 0;
			
			$userModel = $this->findUser($userId);
			//$defaultShipping = $userModel['User']['defaultshipping'];
			if ($defaultShipping == 0){
				$shippingModel = $this->Tempaddresses->find('first',array('conditions'=>array('userid'=>$userId)));
				if (empty($shippingModel)){
					echo '{"status":"false","message":"There is no Shipping address defined for your account"}';
					return;
				}
				$defaultShipping = $shippingModel['Tempaddresses']['shippingid'];
				$countryCode = $shippingModel['Tempaddresses']['countrycode'];
			}else {
				$shippingModel = $this->Tempaddresses->findByshippingid($defaultShipping);
				$countryCode = $shippingModel['Tempaddresses']['countrycode'];
			}
			$cartModel = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			foreach ($cartModel as $cart){
				$quantity[$cart['Cart']['item_id']] = $cart['Cart']['quantity'];
				$itemIds[] = $cart['Cart']['item_id'];
			}
			
			$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemIds,'Item.user_id'=>$merchantId)));
						
			$shopModel = $this->Shop->findByuser_id($itemModel[0]['Item']['user_id']);
			
			$adminItem = array();
			$sellerItem = array();
			$adminCommission = 0;
			$sellerAmount = 0;
			$commissionModel = $this->Commission->find('all',array('conditions'=>array('active'=>'1')));
			foreach($itemModel as $key => $item) {
				$itemPrice = $item['Item']['price'];
				$itemTotal = $itemPrice * $quantity[$item['Item']['id']];
				$shipFlag = 0;
				
				/* foreach ($item['Shiping'] as $ship){
					if($ship['country_id'] == $countryCode && $shipFlag == 0){
						$shipping += $ship['primary_cost'];
						$itemShip = $ship['primary_cost'];
						$shipFlag = 1;
					}elseif($ship['country_id'] == 0 && $shipFlag == 0){
						$shipping += $ship['primary_cost'];
						$itemShip = $ship['primary_cost'];
						$shipFlag = 1;
					}
				} */
				
				foreach ($item['Shiping'] as $ship){
					if($ship['country_id'] == $countryCode && $shipFlag == 0){
						$shipping += $ship['primary_cost'];
						$itemShip = $ship['primary_cost'];
						$shipFlag = 1;
					}elseif($ship['country_id'] == 0 && $shipFlag == 0){
						$elsewherPrice = $ship['primary_cost'];
						$elsewhere = 1;
					}
				}
				if($elsewhere == 1 && $shipFlag == 0){
					$shipping += $elsewherPrice;
					$itemShip = $elsewherPrice;
					$itemAllow = 1;
				}elseif($shipFlag == 0){
					$itemAllow = 0;
				}
				
				foreach($commissionModel as $commission) {
					$min_value = floatval($commission['Commission']['min_value']);
					$max_value = floatval($commission['Commission']['max_value']);
					if ($min_value <= $itemTotal && $max_value >= $itemTotal) {
						$commissionType = $commission['Commission']['type'];
						$commissionPrice = floatval($commission['Commission']['amount']);
					}
				}
				//echo "commissionType".$commissionType;die;
				if ($commissionType == '$') {
					$sellerPrice = floatval($itemTotal) - $commissionPrice;
					$adminPrice = $commissionPrice;
					$adminCommission += $adminPrice;
					$sellerAmount += $sellerPrice;
				}else {
					$adminPrice = floatval($itemTotal) / $commissionPrice;
					$sellerPrice = floatval($itemTotal) - $adminPrice;
					$adminCommission += $adminPrice;
					$sellerAmount += $sellerPrice;
				}
				$adminItem[] = array(
						"name" => $item['Item']['item_title'],
						"price" => round($adminPrice,2),
						"itemPrice" => $itemPrice,
						"itemShip" => $itemShip,
						"itemCount" => $quantity[$item['Item']['id']],
						"identifier" => $item['Item']['id']
				);
				$sellerItem[] = array(
						"name" => $item['Item']['item_title'],
						"price" => round($sellerPrice,2),
						"itemPrice" => $itemPrice,
						"itemShip" => $itemShip,
						"itemCount" => $quantity[$item['Item']['id']],
						"identifier" => $item['Item']['id']
				);
			}
			$setngs = $this->Sitesetting->find('all');
			//$sellerAmount += $shipping;
			$useremail = $userModel['User']['email'];
			
			$resultArray = array();
			//$resultArray['ipnUrl'] = SITE_URL.'paypal/adaptiveipnprocess/';
			$resultArray['ipnUrl'] = 'http://dev.hitasoft.com/new/success.php';
			$resultArray['memo'] = $useremail."-_-".$defaultShipping."-_-0";
			$resultArray['receiptent'] = array();
			$resultArray['receiptent'][0]['adminEmail'] = $setngs[0]['Sitesetting']['paypal_id'];
			$resultArray['receiptent'][0]['adminAmount'] = round($adminCommission,2);
			$resultArray['receiptent'][0]['adminInvoice'] = array();
			$count = 0;
			foreach($adminItem as $admin){
				$resultArray['receiptent'][0]['adminInvoice'][$count] = $admin;
				$count += 1;
			}
			
			$resultArray['receiptent'][1]['sellerEmail'] = $shopModel['Shop']['paypal_id'];
			$resultArray['receiptent'][1]['sellerAmount'] = round($sellerAmount,2);
			$resultArray['receiptent'][1]['sellerInvoice'] = array();
			$count = 0;
			foreach($sellerItem as $seller){
				$resultArray['receiptent'][1]['sellerInvoice'][$count] = $seller;
				$count += 1;
			}
			$resultArray['currencyCode'] = $_SESSION['default_currency_code'];//"USD";
			$resultArray['shipping'] = $shipping;
			$resultArray = json_encode($resultArray);
			echo '{"status":"true","result":'.$resultArray.'}';
		}
		
		public function mobileIpnProcess(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$payKey = $_POST['payKey'];
			$custom = $_POST['custom'];
			global $setngs;
			
			if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
				$paypalurl = "https://sandbox.paypal.com/webscr?cmd=_ap-payment&paykey=";
				$apiurl = "https://svcs.sandbox.paypal.com/AdaptivePayments/";
			}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
				$paypalurl = "https://www.paypal.com/webscr?cmd=_ap-payment&paykey=";
				$apiurl = "https://svcs.paypal.com/AdaptivePayments/";
			}
				$requestEnvelope = array(
						'errorLanguage' =>"en_US",
						"detailLevel" => "ReturnAll"
				);
				$packet = array(
						"requestEnvelope" => $requestEnvelope,
						"payKey" => $payKey
				);
				
				while(1){
					$result = $this->adaptiveCall($apiurl, $packet, "GetPaymentOptions");
					$resultCount = count($result);
					if($resultCount > 0)
						break;
				}
				
				print_r($result);
				
				$totalCost = 0;
				foreach ($result['receiverOptions']['0']['invoiceData']['item'] as $key => $item) {
					$totalCost += $item['itemPrice'] * $item['itemCount'];
					$cartItemPrice[$key+1] = $item['itemPrice'] * $item['itemCount'];
					$cartItemUnitPrice[$key+1] = $item['itemPrice'];
					$cartItemQuantity[$key+1] = $item['itemCount'];
					$cartItemId[$key+1] = $item['identifier'];
					$cartItemName[$key+1] = $item['name'];
				}
				$cartCount = count($result['receiverOptions']['0']['invoiceData']['item']);
				
				
		}
		
		function adaptiveCall ($apiurl, $data, $action) {
			global $paypalAdaptive;
				
			$header = array(
					"X-PAYPAL-SECURITY-USERID : ".$paypalAdaptive['apiUserId'],
					"X-PAYPAL-SECURITY-PASSWORD : ".$paypalAdaptive['apiPassword'],
					"X-PAYPAL-SECURITY-SIGNATURE : ".$paypalAdaptive['apiSignature'],
					"X-PAYPAL-APPLICATION-ID : ".$paypalAdaptive['apiApplicationId'],
					"X-PAYPAL-REQUEST-DATA-FORMAT : JSON",
					"X-PAYPAL-RESPONSE-DATA-FORMAT : JSON"
			);
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiurl.$action);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		
			return json_decode(curl_exec($ch),true);
		}
		
		public function findUser($id){
			$this->loadModel('User');
			$userModel = $this->User->findByid($id);
			return $userModel;
		}
		
	public function itemList () {
			if(isset($_GET['userId'])){
				$this->autoLayout = false;
				$this->autoRender = false;
				$this->loadModel('Itemlist');
				$this->loadModel('Category');
				$userId = $_GET['userId'];
				$itemId = $_GET['itemId'];
				
				$itemListModel = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userId)));
				$result = array();
				$key = 0;
				if (!empty($itemListModel)) {
					foreach ($itemListModel as $key => $itemList) {
						$result[$key]['listId'] = $itemList['Itemlist']['id'];
						$result[$key]['listName'] = $itemList['Itemlist']['lists'];
						$result[$key]['type'] = 1;
						$items = json_decode($itemList['Itemlist']['list_item_id'],true);
						if (!empty($items) && in_array($itemId, $items)){
							$result[$key]['checked'] = 1;
						}else{
							$result[$key]['checked'] = 0;
						}
						if ($itemList['Itemlist']['user_create_list'] == 0){
							$userDefineList[] = $itemList['Itemlist']['lists'];
						}
					}
					$key = $key + 1;
				}
				if (!empty($userDefineList)) {
					$categoryModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0','NOT'=>array('category_name'=>$userDefineList))));
				}else{
					$categoryModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
				}
				foreach ($categoryModel as $itemList) {
					$result[$key]['listId'] = '';//$itemList['Category']['id'];
					$result[$key]['listName'] = $itemList['Category']['category_name'];
					$result[$key]['type'] = 0;
					$result[$key]['checked'] = 0;
					$key = $key + 1;
				}
				$responce = json_encode($result);
				echo '{"status":"true","result":'.$responce.'}';
			}else{
				echo '{"status":"false","message":"Please Login"}';
			}
		}
		
		public function  addItemToList () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			$userId = $_GET['userId'];
			$listIdArray = explode(',', $_GET['listId']);
			$itemId = $_GET['itemId'];
			$listNameArray = explode(',', $_GET['listName']);
			$typeArray = explode(',', $_GET['type']);
			$error = 0;
			//print_r($listIdArray);print_r($listNameArray);print_r($typeArray);die;
			foreach ($listNameArray as $key=>$list){
				if($error == 1){
					echo '{"status":"false","result":"Unable to process data now"}';
					return;
				}
				$type = $typeArray[$key];
				$listName = $listNameArray[$key];
				if ($listIdArray[$key] == '') {
					$listId = $listIdArray[$key];
					$itemListModel = $this->Itemlist->find('first',array('conditions'=>array('id'=>$listId)));
					$jsonItemList = json_decode($itemListModel['Itemlist']['list_item_id'],true);
					$inArray = in_array($itemId, $jsonItemList);
					if(!$inArray){
						$jsonItemList[] = $itemId;
						$jsonItemList = json_encode($jsonItemList);
						//$this->Itemlist->updateAll(array('list_item_id' => $jsonItemList), array('Itemlist.id' => $listId));
						$this->request->data['Itemlist']['list_item_id'] = $jsonItemList;
						$this->request->data['Itemlist']['id'] = $listId;
						if(!$this->Itemlist->save($this->request->data)){
							$error = 1;
						}
					}
				}else{
					$categoryModel = $this->Category->find('first',array('conditions'=>array('category_name LIKE'=>$listName,'category_parent'=>0,'category_sub_parent'=>0)));
					$cattype=1;
					if (!empty($categoryModel)){
						$cattype = 0;
					}
					$jsonItemList[] = $itemId;
					$jsonItemList = json_encode($jsonItemList);
					$this->request->data['Itemlist']['user_id'] = $userId;
					$this->request->data['Itemlist']['lists'] = $listName;
					$this->request->data['Itemlist']['list_item_id'] = $jsonItemList;
					$this->request->data['Itemlist']['user_create_list'] = $cattype;
					$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s',time());
					if($this->Itemlist->save($this->request->data)){
						$error = 1;
					}
				}
			}
			return '{"status":"true","result":"Item added to List"}';
		}
		
		public function  addItemToListHome () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			if (isset($_POST['listData'])){
				$listData = json_decode($_POST['listData'],true);
			}else{
				echo '{"status":"false","result":"List Empty"}';
			}
			$userId = $listData['userId'];
			$itemId = $listData['itemId'];
			$error = 0;
			//print_r($listIdArray);print_r($listNameArray);print_r($typeArray);die;
			foreach ($listData['list'] as $key=>$list){
				$listId = $list['listId'];
				$listName = $list['listName'];
				$listStatus = $list['listStatus'];
				$jsonItemList = '';
				if($error == 1){
					echo '{"status":"false","result":"Unable to process data now"}';
					return;
				}
				if ($listId != '') {
					$itemListModel = $this->Itemlist->find('first',array('conditions'=>array('id'=>$listId)));
					if (empty($itemListModel)){
						$listId = '';
					}
				}
				if ($listId != '') {
					$jsonItemList = json_decode($itemListModel['Itemlist']['list_item_id'],true);
					if ($listStatus == 'true'){
						$inArray = in_array($itemId, $jsonItemList);
						if(!$inArray){
							$jsonItemList[] = $itemId;
							$jsonItemList = json_encode($jsonItemList);
							//$this->Itemlist->updateAll(array('list_item_id' => $jsonItemList), array('Itemlist.id' => $listId));
							$this->request->data['Itemlist']['list_item_id'] = $jsonItemList;
							$this->request->data['Itemlist']['id'] = $listId;
							if(!$this->Itemlist->save($this->request->data)){
								$error = 1;
							}
						}
					}else{
						$updatedList = array();
						$inArray = in_array($itemId, $jsonItemList);
						if($inArray){
							foreach ($jsonItemList as $jsonItem){
								if ($jsonItem != $itemId)
									$updatedList[] = $jsonItem;
							}
							if(isset($updatedList) && !empty($updatedList)){
							//$this->Itemlist->updateAll(array('list_item_id' => $jsonItemList), array('Itemlist.id' => $listId));
								$updatedList = json_encode($updatedList);
								$this->request->data['Itemlist']['list_item_id'] = $updatedList;
								$this->request->data['Itemlist']['id'] = $listId;
								if(!$this->Itemlist->save($this->request->data)){
									$error = 1;
								}
							}else{
								$this->Itemlist->deleteAll(array('id' => $listId), false);
							}
						}
					}
				}else{
					if ($listStatus == 'true'){
						$categoryModel = $this->Category->find('first',array('conditions'=>array('category_name LIKE'=>$listName,'category_parent'=>0,'category_sub_parent'=>0)));
						$cattype=1;
						if (!empty($categoryModel)){
							$cattype = 0;
						}
						$jsonItemList = '';
						$jsonItemList = array();
						$jsonItemList[] = $itemId;
						$jsonItemList = json_encode($jsonItemList);
						$this->Itemlist->create();
						$this->request->data['Itemlist']['user_id'] = $userId;
						$this->request->data['Itemlist']['lists'] = $listName;
						$this->request->data['Itemlist']['list_item_id'] = $jsonItemList;
						$this->request->data['Itemlist']['user_create_list'] = $cattype;
						$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s',time());
						if(!$this->Itemlist->save($this->request->data)){
							$error = 1;
						}
					}
				}
			}
			return '{"status":"true","result":" Item added to list"}';
		}
		
		public function getListItems() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Itemlist');
			$this->loadModel('Photo');
			$this->loadModel('Item');
			$userId = $_GET['userId'];
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$itemlistModel = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userId), 
					'offset'=>$offset,'limit'=>$limit));
			
			if(empty($itemlistModel)){
				echo '{"status":"false","message":"List Empty"}';
			}else{
				$result['list'] = array();
				
				foreach ($itemlistModel as $key => $itemlist){
					$result['list'][$key]['listId'] = $itemlist['Itemlist']['id'];
					$result['list'][$key]['listName'] = $itemlist['Itemlist']['lists'];
					$result['list'][$key]['listItem'] = array();
					$itemJson = json_decode($itemlist['Itemlist']['list_item_id'],true);
					foreach ($itemJson as $cnt => $value){
						$itemlistModel = $this->Item->findById($value);
						//$photoModel = $this->Photo->find('first',array('conditions'=>array('item_id'=>$value)));
						//print_r($photoModel);die;
						if(!empty($itemlistModel)){
							$result['list'][$key]['listItem'][]['imageUrl'] = $img_path."media/items/thumb350/".$itemlistModel['Photo'][0]['image_name'];
						}
					}
				}
				$result = json_encode($result);
				echo '{"status":"true","result":'.$result.'}';
			}
		}
		
		public function getlistitemdetails (){
			$userId = $_GET['userId'];
			$listId = $_GET['listId'];
			$this->autoRender = false;
			$this->autoLayout = false;
			$this->loadModel('Itemlist');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			
			$itemListModel = $this->Itemlist->findById($listId);
			
			if (!empty($itemListModel)){
				$itemids = json_decode($itemListModel['Itemlist']['list_item_id'],true);
				for ($i=$offset; $i<$limit; $i++){
					$itemidLimited[] = $itemids[$i];
				}
				$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemidLimited)));
				$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
				if(count($items_fav_data) > 0){
					foreach($items_fav_data as $favitems){
						//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
						$favitems_ids[] = $favitems['Itemfav']['item_id'];
					}
				}else{
					$favitems_ids = array();
				}
				$resultArray = $this->convertJsonHome($itemModel,$favitems_ids);
				echo '{"status":"true","result":'.$resultArray.'}';
				//echo "$offset $limit <pre>";print_R($itemids);print_R($itemModel);
			}
		}
		
		public function slideshow() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			
			$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>10,'order'=>array('Item.id'=>'desc')));
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			foreach ($items_data as $key => $listitem) {
				//echo "<pre>";print_r($favitems_ids);
			
				//$resultArray['items'][$key]['photos'] = array();
				$itemCount = 0;
				foreach ($listitem['Photo'] as $keys=>$photo) {
					if ($listitem['Item']['id'] == $photo['item_id']) {
						if($keys==0){
							$resultArray[$key]['item_url_main_150'] = $img_path.'media/items/thumb150/'.$photo['image_name'];
						}else{
							$resultArray[$key]['item_url_main_150'] =  $img_path.'media/items/thumb150/'.$photo['image_name'];
						}
			
			
			
						$itemCount += 1;
					}
				}
				
			}
			//echo "<pre>";print_r(($resultArray));die;
			//return json_encode($resultArray);
			
			echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
		}
		
		
		
		
		
		public function findfriends() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Follower');
			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$userId = $_GET['userId'];
				
			$userNameKey = $_GET['username'];
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
			
			$followModel = $this->Follower->findAllByfollow_user_id($userId);
			
			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['user_id'];
				}
			}	
			
			//echo "<pre>";print_r($followers);die;	
			if(isset($userNameKey)){
				$items_data = $this->User->find('all',array('conditions'=>array('User.username LIKE '=> 
						$userNameKey."%",'User.activation'=>1,'User.user_status'=>'enable', 
						'User.user_level <>'=>'god','User.id <>'=>$userId),'order'=> 
						array('User.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
			}else{
				$items_data = $this->User->find('all',array('conditions'=>array('User.activation'=>1,
						'User.user_status'=>'enable','User.user_level <>'=>'god','User.id <>'=>$userId),
						'order'=>array('User.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
			}
				
			foreach ($items_data as $key => $listitem) {
				$resultArray[$key]['UserId'] = $listitem['User']['id'];
				if(in_array($listitem['User']['id'], $followers)){
					$resultArray[$key]['status'] = 'Unfollow';
				}else{
					$resultArray[$key]['status'] = 'follow';					
				}
				$resultArray[$key]['userName'] = $listitem['User']['username_url'];
				$resultArray[$key]['fullName'] = $listitem['User']['first_name'];
				$imageName = $listitem['User']['profile_image'];
				if ($imageName == ''){
					$imageName = "usrimg.jpg";
				}
				$resultArray[$key]['imageName'] = $img_path.'media/avatars/thumb350/'.$imageName;
				
			}
			
			//echo "<pre>";print_r($resultArray);die;
			if(isset($resultArray)){
				echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
			}else{
				echo '{"status":"false","message":"No data found"}'; die;
			}
		}
		
		
		public function findplaces() {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Follower');
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			
			$userId = $_GET['userId'];
			$userNameKey = $_GET['place'];
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
				
			$followModel = $this->Follower->findAllByfollow_user_id($userId);
				
			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['user_id'];
				}
			}				
			
			if(isset($userNameKey)){
			//echo "<pre>";print_r($userNameKey);die;
				//$items_data = $this->User->find('all',array('conditions'=>array('Shop.shop_address LIKE '=>"%".$userNameKey."%",'User.activation'=>1,'User.user_status'=>'enable','User.user_level <>'=>'god'),'order'=>array('User.id'=>'desc')));
				$items_data = $this->User->find('all',array('conditions'=>array(
						'OR' => array('User.username LIKE' => "%".$userNameKey."%",
								'Shop.shop_address LIKE '=>"%".$userNameKey."%"),
						'Shop.shop_latitude <>'=>'','Shop.shop_longitude <>'=>'','User.activation'=>1,
						'User.user_status'=>'enable','User.user_level <>'=>'god','User.id <>'=>$userId),
						'order'=>array('User.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
				//echo "<pre>";print_r($items_data);die;		
			
			}else{
				$items_data = $this->User->find('all',array('conditions'=>array('Shop.shop_latitude <>'=>'',
						'Shop.shop_longitude <>'=>'','User.activation'=>1,'User.user_status'=>'enable',
						'User.user_level <>'=>'god','User.id <>'=>$userId),'order'=>array('User.id'=>'desc'),
						'offset'=>$offset,'limit'=>$limit));
			}
		
			foreach ($items_data as $key => $listitem) {
				$resultArray[$key]['UserId'] = $listitem['User']['id'];
				if(in_array($listitem['User']['id'], $followers)){
					$resultArray[$key]['status'] = 'Unfollow';
				}else{
					$resultArray[$key]['status'] = 'follow';
				}
				$resultArray[$key]['userName'] = $listitem['User']['username_url'];
				$resultArray[$key]['fullName'] = $listitem['User']['first_name'];
				$resultArray[$key]['place'] = $listitem['Shop']['shop_address'];
				$imageName = $listitem['User']['profile_image'];
				if ($imageName == ''){
					$imageName = "usrimg.jpg";
				}
				$resultArray[$key]['imageName'] = $img_path.'media/avatars/thumb150/'.$imageName;
		
			}
				
			//echo "<pre>";print_r($resultArray);die;
			if(isset($resultArray)){
				echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
			}else{
				echo '{"status":"false","message":"No data found"}'; die;
			}
		}
		
		
	function followUser(){
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$logusrid = $_GET['userId'];
			$userid = $_GET['followId'];
			$this->loadModel('Follower');
			$flwalrdy = $this->Follower->find('count',array('conditions'=>array('user_id'=>$userid,'follow_user_id'=>$logusrid)));
			//echo "<pre>";print_r($flwalrdy);die;
				
			if($flwalrdy > 0){
				echo '{"status":"false","message":"User Already Following"}';
			}else{
				$this->request->data['Follower']['user_id'] = $userid;
				$this->request->data['Follower']['follow_user_id'] = $logusrid;
				$this->Follower->save($this->request->data);
		
				App::import('Controller', 'Users');
				
				$Users = new UsersController;
				
				$logdetails = $Users->logs('follow','0',$logusrid,$userid);
				
				
				$this->loadModel('User');
				$this->loadModel('Userdevice');
				$usernamedetails = $this->User->findById($logusrid);
				$loginusername = $usernamedetails['User']['username'];
				$userddett = $this->Userdevice->findByUser_id($userid);
				//echo "<pre>";print_r($userddett);die;
				$deviceTToken = $userddett['Userdevice']['deviceToken'];
				if(isset($deviceTToken)){
					$messages = $loginusername." is following you";
					$Users->pushnot($deviceTToken,$messages);
				}
		
				echo '{"status":"true","result":"Successfully Followed"}';
			}
		}
		
		
		
		function unfollowUser(){
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$logusrid = $_GET['userId'];
			$userid = $_GET['followId'];
			$this->loadModel('Follower');
			$this->loadModel('Log');
			$flwalrdy = $this->Follower->find('count',array('conditions'=>array('user_id'=>$userid,'follow_user_id'=>$logusrid)));
			//echo "<pre>";print_r($flwalrdy);die;
			//echo $flwalrdy;die;
			if($flwalrdy > 0){
				$this->Follower->deleteAll(array('user_id' => $userid,'follow_user_id' => $logusrid));
				$this->Log->deleteAll(array('Log.type' => 'follow','Log.user_id' => $logusrid,'Log.follow_id' => $userid));
				echo '{"status":"true","result":"Successfully Unfollowed"}';
			}else{
				echo '{"status":"false","message":"User Already Not Following"}';
			}
		}
		
		function nearme () {
			$this->layout = false;
			$this->loadModel('Item');
			$this->loadModel ('User');
			$this->loadModel ('Shop');
			$this->loadModel ('Follower');
			$this->loadModel ('Itemfav');
			$favitems_ids = array();
			$items_data = array();
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}else{
				$limit = 10;
			}
				
			if (isset($_GET['distance'])) {
				$Distance = $_GET['distance'];
			}
				
			$lat = $_GET['lat'];
			$lng = $_GET['long'];
			if(isset($distance)){
				$Distance = $Distance * 0.1 / 11;
			}else{
				$Distance = 25 * 0.1 / 11;
			}
		
			//echo $kilometer;die;
			//$Distance = $kilometer; // Range in degrees (0.1 degrees is close to 11km)
			$LatN = $lat + $Distance;
			$LatS = $lat - $Distance;
			$LonE = $lng + $Distance;
			$LonW = $lng - $Distance;
				
			$nearme = $this->Shop->find('all',array('conditions'=>array('Shop.shop_latitude BETWEEN ? AND ?' => array($LatS,$LatN) , 'Shop.shop_longitude BETWEEN ? AND ?' => array($LonW,$LonE))));
				
			foreach($nearme as $n){
				foreach($n['Item'] as $itmms)
					$itemid[] = $itmms['id'];
			}
			$searchCondition = array('status'=>'publish','Item.id'=>$itemid);
			if (isset($_GET['userId'])){
				$userId = $_GET['userId'];
				$userModel = $this->User->findByid($_GET['userId']);
				$userApiDetails = $userModel['User']['user_api_details'];
				if ($userApiDetails != "") {
					$userApiDetails = json_decode($userApiDetails,true);
					if(isset($userApiDetails['Timeline']['IncludingMe']) && $userApiDetails['Timeline']['IncludingMe'] == 'true') {
						$searchCondition['Item.user_id <>'] = $userId;
					}
				}
				$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
				if(count($items_fav_data) > 0){
					foreach($items_fav_data as $favitems){
						//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
						$favitems_ids[] = $favitems['Itemfav']['item_id'];
					}
				}else{
					$favitems_ids = array();
				}
			}
			if(isset($_GET['offset'])){
				$items_data = $this->Item->find('all',array('conditions'=>$searchCondition,'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.id'=>'desc')));
			}else{
				$items_data = $this->Item->find('all',array('conditions'=>$searchCondition,'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			}
			if(empty($items_data)){
				echo '{"status":"false","result":"No data found"}'; die;
			}else{
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids);	
				//echo '{"status":"'.$resultArray.'"}';die;
				//echo "<pre>";print_r($resultArray);die;
				echo '{"status":"true","result":'.$resultArray.'}'; die;
			}
		
		}
		
		
		
		function pushnotifications(){			
			
			$userid = $_GET['userId'];
			
			$offset = 0;
			$limit = 10;
			if (isset($_GET['offset'])){
				$offset = $_GET['offset'];
			}
			if (isset($_GET['limit'])){
				$limit = $_GET['limit'];
			}
				
			$this->loadModel('Item');
			$this->loadModel('Comment');
			$this->loadModel('Follower');
			$this->loadModel('Log');
			$this->loadModel('User');				
			$flwrscnt = $this->Follower->findAllByfollow_user_id($userid);		
			
			foreach($flwrscnt as $flwr){					
				$flwruserid[] = $flwr['Follower']['user_id'];					
			}
			
			$loguserdetails = $this->Log->find('all',array('conditions' =>array('Log.user_id' =>$flwruserid)
					,'order'=>array('Log.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
			
			$resultArray['notifications'] = array();
			$key = 0;
			foreach($loguserdetails as $log){
				$not_type[$log['Log']['id']] = $log['Log']['type'];
				$notific_id[$log['Log']['id']] = $log['Log']['notification_id'];
				//$Log_cdate[$log['Log']['id']] = $log['Log']['cdate'];
				if(SITE_URL == $_SESSION['media_url']){
					$img_path = trim($_SESSION['media_url']);
				}else {
					$img_path = trim("http://".$_SESSION['media_url'].'/');
				}
					//echo $log['Log']['type']." <br />";
					if($log['Log']['type'] == 'comment'){
							$getLogvalues = $this->Comment->findById($log['Log']['notification_id']);
							$resultArray['notifications'][$key]['type'] = 'Comment';
							$resultArray['notifications'][$key]['userId'] = $getLogvalues['User']['id'];
							$resultArray['notifications'][$key]['itemId'] = $getLogvalues['Item']['id'];
							$resultArray['notifications'][$key]['username'] = $getLogvalues['User']['username_url'];
							$resultArray['notifications'][$key]['comments'] = $getLogvalues['Comment']['comments'];
							$resultArray['notifications'][$key]['title'] = $getLogvalues['Item']['item_title'];
							$resultArray['notifications'][$key]['dayAndTime'] = $log['Log']['cdate'];
							
							$profile_image = $getLogvalues['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['notifications'][$key]['userimage'] =  $img_path.'media/avatars/thumb70/'.$user_img;
								
								//echo "<pre>";print_r($getLogvalues);
								
								if ($getLogvalues['Item']['id'] == $getLogvalues['Photo']['item_id']) {
									if($getLogvalues['Photo']['image_name'] !=''){
										$resultArray['notifications'][$key]['item_url_main_70'] = $img_path.'media/items/thumb70/'.$getLogvalues['Photo']['image_name'];
									}else{
										$resultArray['notifications'][$key]['item_url_main_70'] =  null;
									}
								}
							
						$key++;
						} 
						
						
					 if($log['Log']['type'] == 'favorite'){
							//echo "<br />fv".$log['Log']['id'];
							$getLogvalues =  $this->Item->findById($log['Log']['notification_id']);
							//echo "<pre>";print_r($getLogvalues);
							$resultArray['notifications'][$key]['type'] = 'Favorite';
							$resultArray['notifications'][$key]['userId'] = $getLogvalues['User']['id'];
							$resultArray['notifications'][$key]['itemId'] = $getLogvalues['Item']['id'];
							$resultArray['notifications'][$key]['username'] = $getLogvalues['User']['username_url'];
							$resultArray['notifications'][$key]['title'] = $getLogvalues['Item']['item_title'];
							$resultArray['notifications'][$key]['dayAndTime'] = $log['Log']['cdate'];
							$profile_image = $getLogvalues['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['notifications'][$key]['userimage'] =  $img_path.'media/avatars/thumb70/'.$user_img;
								if($getLogvalues['Photo'][0]['image_name'] !=''){
									$resultArray['notifications'][$key]['item_url_main_70'] = $img_path.'media/items/thumb70/'.$getLogvalues['Photo'][0]['image_name'];
								}else{
									$resultArray['notifications'][$key]['item_url_main_70'] =  null;
								}
							
							$key++;
						} 

						if($log['Log']['type'] == 'additem'){
							//echo "<br />add".$log['Log']['id'];
							//print_r($getLogvalues);print_r($log);
							$getLogvalues = $this->Item->findById($log['Log']['notification_id']);
							$resultArray['notifications'][$key]['type'] = 'additem';
							$resultArray['notifications'][$key]['userId'] = $getLogvalues['User']['id'];
							$resultArray['notifications'][$key]['itemId'] = $getLogvalues['Item']['id'];
							$resultArray['notifications'][$key]['username'] = $getLogvalues['User']['username_url'];
							$resultArray['notifications'][$key]['title'] = $getLogvalues['Item']['item_title'];
							$resultArray['notifications'][$key]['dayAndTime'] = $log['Log']['cdate'];
							$profile_image = $getLogvalues['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['notifications'][$key]['userimage'] =  $img_path.'media/avatars/thumb70/'.$user_img;
								if($getLogvalues['Photo'][0]['image_name'] !=''){
									$resultArray['notifications'][$key]['item_url_main_70'] = $img_path.'media/items/thumb70/'.$getLogvalues['Photo'][0]['image_name'];
								}else{
									$resultArray['notifications'][$key]['item_url_main_70'] =  null;
								}
							$key++;
						}
					
						if($log['Log']['type'] == 'follow'){
							//echo "<br />flw".$log['Log']['id'].$log['Log']['type'];
							$getLogvalues = $this->User->findById($log['Log']['user_id']);
							//echo "<pre>";print_r($getLogvalues);die;
							//print_r($getLogvalues);print_r($log);
							$resultArray['notifications'][$key]['type'] = 'Follow';
							$resultArray['notifications'][$key]['userId'] = $getLogvalues['User']['id'];
							$resultArray['notifications'][$key]['username'] = $getLogvalues['User']['username_url'];
							$resultArray['notifications'][$key]['dayAndTime'] = $log['Log']['cdate'];
							$profile_image = $getLogvalues['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['notifications'][$key]['userimage'] =  $img_path.'media/avatars/thumb70/'.$user_img;
							
							$key++;
						}  
						
						
						if($log['Log']['type'] == 'sellermessage'){
							//echo "<br />flw".$log['Log']['id'].$log['Log']['type'];
							$getLogvalues = $this->User->findById($log['Log']['user_id']);
							//echo "<pre>";print_r($getLogvalues);die;
							//print_r($getLogvalues);print_r($log);
							$resultArray['notifications'][$key]['type'] = 'Sellernews';
							$resultArray['notifications'][$key]['userId'] = $getLogvalues['User']['id'];
							$resultArray['notifications'][$key]['username'] = $getLogvalues['User']['username_url'];
							$resultArray['notifications'][$key]['seller_message'] = $log['Log']['seller_message'];
							$resultArray['notifications'][$key]['dayAndTime'] = $log['Log']['cdate'];
							$profile_image = $getLogvalues['User']['profile_image'];
							if(!empty($profile_image)){
								$user_img = $profile_image;
							}else{
								$user_img = 'usrimg.jpg';
							}
							$resultArray['notifications'][$key]['userimage'] =  $img_path.'media/avatars/thumb70/'.$user_img;
								
							$key++;
						}
						
						
						
				}
				
				//echo "<pre>";print_r(($resultArray));die;
			if(empty($resultArray['notifications'])){
				echo '{"status":"false","result":"No data found"}'; die;
			}else{
				//echo "<pre>";print_r(($resultArray));die;
				echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
			}
			 
		}
		
		
		
		
		
		
		function moreinfos(){
			$userid = $_GET['userId'];
			$this->loadModel('Shop');
			$this->loadModel('Shopcomment');
			$this->loadModel('Shopuserphoto');
			$shp = $this->Shop->findByUser_id($userid);
			//secho "<pre>";print_r(($shp));die;			
			$resultArray = array();
			$resultArray['sellers'] = array();			
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
				$key = 0;
				
				$imageNamesell = $shp['User']['profile_image'];
				if ($imageNamesell == ''){
					$imageNamesell = "usrimg.jpg";
				}
				$fullImageNameSeller = $img_path.'media/avatars/thumb350/'.$imageNamesell;
				
				list($width, $height) = getimagesize($fullImageNameSeller);
				
				$resultArray['sellers'][$key]['Name'] = $shp['Shop']['shop_name'];
				$resultArray['sellers'][$key]['descriptions'] = $shp['Shop']['descriptions'];
				$resultArray['sellers'][$key]['shop_address'] = $shp['Shop']['shop_address'];
				$resultArray['sellers'][$key]['phone_no'] = $shp['Shop']['phone_no'];
				$resultArray['sellers'][$key]['open_time'] = $shp['Shop']['open_time'];
				$resultArray['sellers'][$key]['fb_acc'] = $shp['Shop']['fb_acc'];
				$resultArray['sellers'][$key]['twt_acc'] = $shp['Shop']['twt_acc'];
				$resultArray['sellers'][$key]['websites'] = $shp['Shop']['websites'];
				$resultArray['sellers'][$key]['sellerimage'] = $fullImageNameSeller;
				$resultArray['sellers'][$key]['width'] = $width;
				$resultArray['sellers'][$key]['height'] = $height;
				if(isset($usr_datas['Shop']['payment_type'])){
					$jsnval= json_decode($usr_datas['Shop']['payment_type']);
					if($jsnval->seller_card==1){
						$resultArray['sellers'][$key]['Card'] = 'Available';
					}else{
						$resultArray['sellers'][$key]['Card'] = 'Not Available';
					}
					if($jsnval->seller_cheque==1){
						$resultArray['sellers'][$key]['Cheque'] = 'Available';
					}else{
						$resultArray['sellers'][$key]['Cheque'] = 'Not Available';
					}
					if($jsnval->seller_cash==1){
						$resultArray['sellers'][$key]['Cash'] = 'Available';
					}else{
						$resultArray['sellers'][$key]['Cash'] = 'Not Available';
					}
				}
				$resultArray['sellers'][$key]['shop_latitude'] = $shp['Shop']['shop_latitude'];
				$resultArray['sellers'][$key]['shop_longitude'] = $shp['Shop']['shop_longitude'];
						
				
				$resultArray['sellers'][$key]['shopcomments'] = array();
				$shopcmnnts = $this->Shopcomment->shopcommmentss($userid);
				foreach($shopcmnnts as $key1=>$shcnt){
					if(!empty($shcnt)){
						$imageName = $shcnt['User']['profile_image'];
						if ($imageName == ''){
							$imageName = "usrimg.jpg";
						}
						$fullImageName = $img_path.'media/avatars/thumb150/'.$imageName;
						$resultArray['sellers'][$key]['shopcomments'][$key1]['user_id'] = $userid;
						$resultArray['sellers'][$key]['shopcomments'][$key1]['username'] = $shcnt['User']['username'];
						$resultArray['sellers'][$key]['shopcomments'][$key1]['user_image'] = $fullImageName;
						$resultArray['sellers'][$key]['shopcomments'][$key1]['comments'] = $shcnt['Shopcomment']['comments'];
					}else{
						$resultArray['sellers'][$key]['shopcomments'] = 'null';
					}
				}
				
				
				
				$shopuserphotos = $this->Shopuserphoto->find('all',array('conditions'=>array('Shopuserphoto.shop_id'=>$userid,'Shopuserphoto.status'=>'Yes')));
				//echo "<pre>";print_r($shopuserphotos);die;
				$resultArray['sellers'][$key]['shopPhotoUser'] = array();
				$shopphotocnt = 0;
				foreach ($shopuserphotos as $shoppto) {
					$resultArray['sellers'][$key]['shopPhotoUser'][$shopphotocnt]['sId'] = $shoppto['Shopuserphoto']['id'];
					$resultArray['sellers'][$key]['shopPhotoUser'][$shopphotocnt]['userId'] = $shoppto['User']['id'];
					$resultArray['sellers'][$key]['shopPhotoUser'][$shopphotocnt]['userName'] = $shoppto['User']['username'];
					$userimage = $shoppto['Shopuserphoto']['userimage'];
					if($userimage == ''){
						$userimage = 'usrimg.jpg';
					}
					$resultArray['sellers'][$key]['shopPhotoUser'][$shopphotocnt]['user_img'] = $img_path.'media/avatars/thumb150/'.$userimage;
					$shopphotocnt += 1;
				}
				
				
				
				
			if(empty($resultArray['sellers'])){
				echo '{"status":"false","result":"No data found"}'; die;
			}else{
				//echo "<pre>";print_r(($resultArray));die;
				echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
			}
		
		}
		
		
		
		
		public function productbeforeadd(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel ('Category');
			$this->loadModel ('Recipient');
			$this->loadModel ('Country');
			$resultarray = array();
			$resultarray['Category'] = array();
			$resultarray['Category']['parent'] = array();
				
			$CategoryModel= $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
			if (count($CategoryModel) > 0) {
				for ($i=0;$i<count($CategoryModel);$i++) {
					$resultarray['Category']['parent'][$i] = array();
					$categoryId = $CategoryModel[$i]['Category']['id'];
					$resultarray['Category']['parent'][$i]['id'] = $categoryId;
					$resultarray['Category']['parent'][$i]['name'] = $CategoryModel[$i]['Category']['category_name'];
					$resultarray['Category']['parent'][$i]['subcategory'] = array();
					$subcategoryModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>'0')));
					if (count($subcategoryModel) > 0) {
						for ($j=0;$j<count($subcategoryModel);$j++) {
							$subcatid = $subcategoryModel[$j]['Category']['id'];
							$subname = $subcategoryModel[$j]['Category']['category_name'];
							$resultarray['Category']['parent'][$i]['subcategory'][$j] =array();
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['id'] = $subcatid;
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['name'] = $subname;
							$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'] = array();
							$subcatModel = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>$subcatid)));
							if (count($subcatModel) > 0) {
								for ($k=0;$k < count($subcatModel);$k++) {
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k] = array();
									$subsubid = $subcatModel[$k]['Category']['id'];
									$subsubname = $subcatModel[$k]['Category']['category_name'];
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k]['id'] = $subsubid;
									$resultarray['Category']['parent'][$i]['subcategory'][$j]['subcategory'][$k]['name'] = $subsubname;
								}
							}
						}
					}
				}
				
				$resultarray['relationShip'] = array();
				$colorModel = $this->Recipient->find('all');
				if (count($colorModel) > 0) {
					for ($i=0;$i<count($colorModel);$i++) {
						$resultarray['relationShip'][$i] = array();
						$resultarray['relationShip'][$i]['id'] = $colorModel[$i]['Recipient']['id'];
						$resultarray['relationShip'][$i]['relationShipName'] = $colorModel[$i]['Recipient']['recipient_name'];
					}
				}
				
				$resultarray['Country'] = array();
				$colorModel = $this->Country->find('all');
				if (count($colorModel) > 0) {
					for ($i=0;$i<count($colorModel);$i++) {
						$resultarray['Country'][$i] = array();
						$resultarray['Country'][$i]['id'] = $colorModel[$i]['Country']['id'];
						$resultarray['Country'][$i]['code'] = $colorModel[$i]['Country']['code'];
						$resultarray['Country'][$i]['CountryName'] = $colorModel[$i]['Country']['country'];
					}
				}
				 
				
				$resultarray['gender'] = array();				
				$resultarray['gender'][0]['id'] = '0';
				$resultarray['gender'][0]['Name'] = 'Male';
				$resultarray['gender'][1]['id'] = '1';
				$resultarray['gender'][1]['Name'] = 'Female';
							
				$resultarray['shipDeliveryTime'] = array();			
				$resultarray['shipDeliveryTime'][0]['id'] = '1d';
				$resultarray['shipDeliveryTime'][0]['Time'] = '1 business day';
				$resultarray['shipDeliveryTime'][1]['id'] = '2d';
				$resultarray['shipDeliveryTime'][1]['Time'] = '1-2 business days';
				$resultarray['shipDeliveryTime'][2]['id'] = '3d';
				$resultarray['shipDeliveryTime'][2]['Time'] = '1-3 business days';
				$resultarray['shipDeliveryTime'][3]['id'] = '4d';
				$resultarray['shipDeliveryTime'][3]['Time'] = '3-5 business days';
				$resultarray['shipDeliveryTime'][4]['id'] = '2ww';
				$resultarray['shipDeliveryTime'][4]['Time'] = '1-2 weeks';
				$resultarray['shipDeliveryTime'][5]['id'] = '3w';
				$resultarray['shipDeliveryTime'][5]['Time'] = '2-3 weeks';
				$resultarray['shipDeliveryTime'][6]['id'] = '4w';
				$resultarray['shipDeliveryTime'][6]['Time'] = '3-4 weeks';
				$resultarray['shipDeliveryTime'][7]['id'] = '6w';
				$resultarray['shipDeliveryTime'][7]['Time'] = '4-6 weeks';
				$resultarray['shipDeliveryTime'][8]['id'] = '8w';
				$resultarray['shipDeliveryTime'][8]['Time'] = '6-8 weeks';
				
				
				
				$resultarray = json_encode($resultarray);
				echo '{"status":"true","result":'.$resultarray.'}';
			}else {
				echo '{"status":"false","message":"Error"}';
			}
			
		}
		
		
		
		
		
		public function addproduct(){
			
			$this->loadModel('Shop');
			$this->loadModel('Shiping');
			$this->loadModel('Photo');
			$this->loadModel('Item');	
			
			$userid = $_REQUEST['userId'];
			$imageName = $_REQUEST['imageName'];
			$itemName = $_REQUEST['itemName'];
			$itemDescription = $_REQUEST['itemDescription'];
			$itemPrice = $_REQUEST['itemPrice'];
			$itemQuantity = $_REQUEST['itemQuantity'];
			$categoryId = $_REQUEST['categoryId'];
			$superCatId = $_REQUEST['superCatId'];
			$subCatId = $_REQUEST['subCatId'];
			$relationShip[] = $_REQUEST['relationShip'];
			$gender = $_REQUEST['gender'];
			$countryId = $_REQUEST['countryId'];
			$shipingCost = $_REQUEST['shipingCost'];
			$businessDays = $_REQUEST['businessDays'];
			$everyWhereCost = $_REQUEST['everyWhereCost'];
			
			if(!empty($imageName)){
				$imgName = $_SESSION['media_url'].'media/items/original/'.$imageName;
				$result = ColorCompareComponent::compare(5, $imgName);
			}
				
			$shpcnt = $this->Shop->find('all',array('conditions'=>array('user_id'=>$userid)));
			if(!empty($shpcnt)){
				$shop_id = $shpcnt[0]['Shop']['id'];
			}else{
				$this->request->data['Shop']['user_id'] = $userid;
				$this->Shop->save($this->request->data);
				$shop_id = $this->Shop->getLastInsertID();
			}
				
			$this->request->data['Item']['user_id'] = $userid;
			$this->request->data['Item']['shop_id'] = $shop_id;
			$title = $this->request->data['Item']['item_title'] = $itemName;
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $itemDescription;
			$this->request->data['Item']['occasion'] = $gender;			
			$this->request->data['Item']['recipient'] = json_encode($relationShip);			
			$this->request->data['Item']['price'] = $itemPrice;
			$this->request->data['Item']['quantity'] = $itemQuantity;
			$this->request->data['Item']['category_id'] = $categoryId;
			$this->request->data['Item']['super_catid'] = $superCatId;
			$this->request->data['Item']['sub_catid'] = $subCatId;			
			$this->request->data['Item']['processing_time'] = $businessDays;
			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
			$this->request->data['Item']['status'] = 'draft';
			$this->request->data['Item']['item_color'] = json_encode($result);				
			$this->Item->save($this->request->data);
				
			$last_id = $this->Item->getLastInsertID();
				
			$this->Photo->create();
			if(!empty($imageName)){
				$this->request->data['Photo']['item_id'] = $last_id;
				$this->request->data['Photo']['image_name'] = $imageName;
				$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
				$this->Photo->save($this->request->data);
			}
			
			if(!empty($_REQUEST['country_shipping'])){
				$this->Shiping->create();			
				$this->request->data['Shiping']['item_id'] = $last_id;
				$this->request->data['Shiping']['country_id'] = $countryId;
				$this->request->data['Shiping']['primary_cost'] = $shipingCost;
				//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
				$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
				$this->Shiping->save($this->request->data);
			}
			
			if(!empty($_REQUEST['everywhere_shipping'])){
				$this->Shiping->create();			
				$this->request->data['Shiping']['item_id'] = $last_id;
				$this->request->data['Shiping']['country_id'] = 0;
				$this->request->data['Shiping']['primary_cost'] = $everyWhereCost;
				//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
				$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");			
				$this->Shiping->save($this->request->data);
			}
				
				
			App::import('Controller', 'Users');			
			$Users = new UsersController;			
			$logdetails = $Users->logs('additem',$last_id,$userid,'0');			
			
			if(empty($last_id)){
				echo '{"status":"false","result":"No data Added"}'; die;
			}else{
				//echo "<pre>";print_r(($resultArray));die;
				echo '{"status":"true","result":'.$last_id.'}'; die;
			}		
		}
		
		public function reportitem(){
			$this->layout = FALSE;
			$this->autoRender = FALSE;
			$this->loadModel('Item');
			
			if (isset($_GET['itemid']) && isset($_GET['userid'])){
				$itemId = $_GET['itemid'];
				$userId = $_GET['userid'];
				
				$itemModel = $this->Item->findByid($itemId);
				if (!empty($itemModel['Item']['report_flag'])){
					$reportFlag = json_decode($itemModel['Item']['report_flag'],true);
					if (count($reportFlag) == 4){
						$this->request->data['Item']['status'] = 'draft';
						$this->request->data['Item']['report_flag'] = '';
						$this->request->data['Item']['id'] = $itemId;
					}else{
						$reportFlag[] = $userId;
						$this->request->data['Item']['report_flag'] = json_encode($reportFlag);
						$this->request->data['Item']['id'] = $itemId;
					}
				}else{
					$reportFlag[] = $userId;
					$this->request->data['Item']['report_flag'] = json_encode($reportFlag);
					$this->request->data['Item']['id'] = $itemId;
				}
				$this->Item->save($this->request->data);
				echo '{"status":"true","result":"Item Reported Successfully"}';
			}else{
				echo '{"status":"false","result":"Item id and User id are Invalid"}';
			}
		}
		
		public function undoreportitem(){
			$this->layout = FALSE;
			$this->autoRender = FALSE;
			$this->loadModel('Item');
			
			if (isset($_GET['itemid']) && isset($_GET['userid'])){
				$itemId = $_GET['itemid'];
				$userId = $_GET['userid'];
				
				$itemModel = $this->Item->findByid($itemId);
				if (!empty($itemModel['Item']['report_flag'])){
					$reportFlag = json_decode($itemModel['Item']['report_flag'],true);
					$newreportflag = array();
					foreach ($reportFlag as $flag){
						if ($flag != $userId){
							$newreportflag[] = $flag;
						}
					}
					if (!empty($newreportflag)){
						$this->request->data['Item']['report_flag'] = json_encode($newreportflag);
						$this->request->data['Item']['id'] = $itemId;
					}else{
						$this->request->data['Item']['report_flag'] = '';
						$this->request->data['Item']['id'] = $itemId;
					}
				}
				$this->Item->save($this->request->data);
				echo '{"status":"true","result":"Item Unreported Successfully"}';
			}else{
				echo '{"status":"false","result":"Item id and User id are Invalid"}';
			}
		}
		
		public function addfashionuser(){
			
			$this->loadModel('Fashionuser');
			$userid = $_REQUEST['userId'];
			$imageName = $_REQUEST['imageName'];
			$itemId = $_REQUEST['itemId'];
			$this->request->data['Fashionuser']['user_id'] = $userid;
			$this->request->data['Fashionuser']['userimage'] = $imageName;
			$this->request->data['Fashionuser']['itemId'] = $itemId;
			$this->request->data['Fashionuser']['cdate'] = time();
			if(isset($userid) && isset($itemId) && isset($imageName)){
				$this->Fashionuser->save($this->request->data);
				echo '{"status":"true","result":"Fashion user added successfully"}'; die;
			}else{			
				echo '{"status":"false","result":"No data Added"}'; die;
			}
		}
		
		
		
		
		public function shop_comments (){
			$this->layout = FALSE;
			$this->loadModel('Shopcomment');
			$this->autoRender = false;
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}
			if (isset($_GET)) {
				$userId = $_GET['userId'];
				$sellerId = $_GET['sellerId'];
				$comment = $_GET['comment'];
				$this->request->data['Shopcomment']['user_id'] = $userId;
				$this->request->data['Shopcomment']['shop_id'] = $sellerId;
				$this->request->data['Shopcomment']['comments'] = $comment;
				$this->request->data['Shopcomment']['cdate'] = time();
				$this->Shopcomment->save($this->request->data);
				$id = $this->Shopcomment->getLastInsertID();
				$userModel = $this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
				$path = $img_path."media/avatars/thumb70/";
				$username = $userModel['User']['username_url'];
				if (!empty($userModel['User']["profile_image"])) {
					$path .= $userModel['User']['profile_image'];
				}else {
					$path .= 'usrimg.jpg';
				}
				$commentEncoded = urldecode($comment);
				echo '{"status":"true","comments":"'.$commentEncoded.'","user_id":"'.$userId.'","user_image":"'.$path.'","username":"'.$username.'"}';
			}else {
				echo '{"status":"false","message":"Get Empty"}';
			}
		}
		
		
		public function nearmeshop(){	
			$this->layout = false;
			$this->loadModel ('Shop');	
			$this->loadModel('Follower');
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}else{
				$limit = 10;
			}
			if (isset($_GET['offset'])) {
				$offset = $_GET['offset'];
			}else{
				$offset = 0;
			}
				
			if(SITE_URL == $_SESSION['media_url']){
				$img_path = $_SESSION['media_url'];
			}else {
				$img_path = "http://".$_SESSION['media_url'].'/';
			}		
			if (isset($_GET['distance'])) {
				$Distance = $_GET['distance'];
			}									
			$lat = $_GET['lat'];
			$lng = $_GET['long'];
			$logusrid = $_GET['userId'];
			if(isset($distance)){
				$Distance = $Distance * 0.1 / 11;
			}else{
				$Distance = 25 * 0.1 / 11;
			}			
			$LatN = $lat + $Distance;
			$LatS = $lat - $Distance;
			$LonE = $lng + $Distance;
			$LonW = $lng - $Distance;
			
			$nearme = $this->Shop->find('all',array('conditions'=>array(
					'Shop.shop_latitude BETWEEN ? AND ?' => array($LatS,$LatN) , 
					'Shop.shop_longitude BETWEEN ? AND ?' => array($LonW,$LonE),'User.id <>'=>$logusrid),
					'offset'=>$offset,'limit'=>$limit));
				
			
			$followModel = $this->Follower->findAllByfollow_user_id($logusrid);
			
			if (count($followModel) > 0) {
				foreach ($followModel as $follower) {
					$followers[] = $follower['Follower']['user_id'];
				}
			}
			
			//echo "<pre>";print_r($nearme);die;	
			
			foreach ($nearme as $key => $listitem) {
				$resultArray[$key]['UserId'] = $listitem['User']['id'];				
				$resultArray[$key]['userName'] = $listitem['User']['username_url'];
				$resultArray[$key]['fullName'] = $listitem['User']['first_name'];
				$resultArray[$key]['shopAddress'] = $listitem['Shop']['shop_address'];
				
				if(in_array($listitem['User']['id'], $followers)){
					$resultArray[$key]['status'] = 'Unfollow';
				}else{
					$resultArray[$key]['status'] = 'follow';
				}
				
				$imageName = $listitem['User']['profile_image'];
				if ($imageName == ''){
					$imageName = "usrimg.jpg";
				}
				$resultArray[$key]['imageName'] = $img_path.'media/avatars/thumb150/'.$imageName;
			
			}
				
			//echo "<pre>";print_r($resultArray);die;
			if(isset($resultArray)){
				echo '{"status":"true","result":'.json_encode($resultArray).'}'; die;
			}else{
				echo '{"status":"false","message":"No data found"}'; die;
			}
		}
		
		
		
		public function mostpopularitem(){			
			$this->layout = false;
			$this->loadModel ('Item');
			$this->loadModel('Follower');			
			$favitems_ids = array();
			$items_data = array();
			
			
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}else{
				$limit = 10;
			}			
			if(isset($_GET['offset'])){
				$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$limit,'offset'=>$_GET['offset'],'order'=>array('Item.fav_count'=>'desc')));
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.fav_count'=>'desc')));
			}else{
				$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$limit,'order'=>array('Item.fav_count'=>'desc')));
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.id'=>$itemid),'limit'=>$limit,'order'=>array('Item.id'=>'desc')));
			}
			if(empty($items_data)){
				echo '{"status":"false","result":"No data found"}'; die;
			}else{
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids);
				//echo '{"status":"'.$resultArray.'"}';die;
				//echo "<pre>";print_r($resultArray);die;
				echo '{"status":"true","result":'.$resultArray.'}'; die;
			}
		}
		
		
		public function addshopphotos(){
			$this->loadModel('Shopuserphoto');			
			$userid = $_REQUEST['userId'];
			$imageName = $_REQUEST['imageName'];
			$shoppid = $_REQUEST['shopId'];	
			$this->request->data['Shopuserphoto']['userimage'] = $imageName;
			$this->request->data['Shopuserphoto']['user_id'] = $userid;
			$this->request->data['Shopuserphoto']['shop_id'] = $shoppid;
			$this->request->data['Shopuserphoto']['cdate'] = time();
			$this->request->data['Shopuserphoto']['status'] = 'No';
			if(isset($userid) && isset($shoppid) && isset($imageName)){
				$this->Shopuserphoto->save($this->request->data);
				echo '{"status":"true","result":"Your Photo added in this shop successfully"}'; die;
			}else{
				echo '{"status":"false","result":"No data Added"}'; die;
			}
		}
		
		
		
		function userrseller(){
			$this->autoLayout = false;
			$this->autoRender = false;
		
			$logusrid = $_GET['userId'];
			$this->loadModel('Shop');
			$finduserrseller = $this->Shop->find('count',array('conditions'=>array('Shop.paypal_id <>'=>'','Shop.user_id'=>$logusrid)));
			//echo "<pre>";print_r($finduserrseller);die;
			//echo $flwalrdy;die;
			if($finduserrseller > 0){
				echo '{"status":"true","message":"Seller"}';
			}else{
				echo '{"status":"true","message":"User"}';
			}
		}
		
		function userimagechange(){
			$this->autoLayout = false;
			$this->autoRender = false;		
			$userId = $_POST['userId'];
			$userImg = $_POST['userImg'];
			
			$this->request->data['User']['id'] = $userId;
			$this->request->data['User']['profile_image'] = $userImg;
			if(isset($userId) && isset($userImg)){
				$this->User->save($this->request->data);
				echo '{"status":"true","result":"User photo added successfully"}'; die;
			}else{
				echo '{"status":"false","result":"No data Added"}'; die;
			}
		}
		
		
		
		
		
		function morecategoryitems () {
			$this->layout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel ('User');
			$this->loadModel('Follower');
			$favitems_ids = array();
			$items_data = array();
			$userId = $_GET['userId'];
			$limit = 10;
			if (isset($_GET['limit'])) {
				$limit = $_GET['limit'];
			}
			if (isset($_GET['offset'])) {
				$offset = $_GET['offset'];
			}else{
				$offset = 0;
			}
			$ItemId = $_GET['itemId'];
			if(isset($_GET['itemId'])){
				$items_dataCate = $this->Item->findById($ItemId);
				$cateIds = $items_dataCate['Item']['category_id'];
				$items_data = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$cateIds,'Item.status'=>'publish','Item.id <>'=>$ItemId),'order' => 'rand()','limit'=>$limit,'offset'=>$offset));
		
			}
		 	$items_fav_data = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$userId)));
		 	if(count($items_fav_data) > 0){
			 	foreach($items_fav_data as $favitems){
			 		//echo "<pre>";print_r($favitems['Itemfav']['item_id']);die;
			 		$favitems_ids[] = $favitems['Itemfav']['item_id'];
			 	}
		 	}else{
		 		$favitems_ids = array();
		 	}
			if(empty($items_data)){
				$items_data = $this->Item->find('all',array('conditions'=>array('Item.status'=>'publish','Item.id <>'=>$ItemId),'order' => array('Item.id'=>'desc'),'limit'=>$limit,'offset'=>$offset));
				//echo "<pre>";print_r($items_data);
				//echo '{"status":"false","result":"No data found"}'; die;
			}
			if (isset($_GET['type'])) {
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids,$_GET['type'],$userId);
			}else {
				$resultArray = $this->convertJsonHome($items_data,$favitems_ids,0,$userId);
			}
			echo '{"status":"true","result":'.$resultArray.'}'; die;
				
		}
		
		
		function badgereset(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$deviceTToken = $_REQUEST['deviceToken'];
			$this->loadModel('Userdevice');
			if(isset($deviceTToken)){
				$this->Userdevice->updateAll(array('badge' =>'0'), array('deviceToken' => $deviceTToken));
				echo '{"status":"true","result":"Badge reseted"}'; die;
			}else{
				echo '{"status":"false","result":"Badge not reseted"}'; die;
			}
		}
		
		function pushsignout(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$deviceTToken = $_REQUEST['deviceToken'];
			$this->loadModel('Userdevice');
			if(isset($deviceTToken)){
				$this->Userdevice->deleteAll(array('deviceToken'=>$deviceTToken), false);
				echo '{"status":"true","result":"Successfully removed"}'; die;
			}else{
				echo '{"status":"false","result":"user id or device id is wrong"}'; die;
			}
		}
		
		function adddeviceid (){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Userdevice');
			$deviceToken = $_POST['deviceToken'];
			$userId = $_POST['userid'];
			
			$userdeviceDet = $this->Userdevice->find('all',array('conditions'=>array('deviceToken'=>$deviceToken)));
									
			if(!empty($userdeviceDet)){
				$devicetokentab = $userdeviceDet[0]['Userdevice']['deviceToken'];
                if (isset($_POST['devicetype'])){
					$this->Userdevice->updateAll(array('Userdevice.user_id' => $userId, 'Userdevice.type' => $_POST['devicetype']), array('Userdevice.deviceToken' => $devicetokentab));
				}else{
					$this->Userdevice->updateAll(array('Userdevice.user_id' => $userId), array('Userdevice.deviceToken' => $devicetokentab));
				}
			}else{
				$this->request->data['Userdevice']['user_id'] = $userId;
				$this->request->data['Userdevice']['deviceToken'] = $deviceToken;
				if (isset($_POST['devicetype'])){
				     $this->request->data['Userdevice']['type'] = $_POST['devicetype'];
				}
				$this->request->data['Userdevice']['cdate'] = time();
				$this->Userdevice->save($this->request->data);
			}
		}
		
		function getlanguage (){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Sitesetting');
			$setngs = $this->Sitesetting->find('all');
			$mobileSettings = json_decode($setngs[0]['Sitesetting']['mobile_settings'], true);
			
			$language = $mobileSettings['language'];//$_GET['language'];
			
			$filepath = WEBROOT_PATH.$language.'.json';
			
			$languageContent = file_get_contents($filepath);
			
			echo $languageContent;
			
		}
		
}
	
