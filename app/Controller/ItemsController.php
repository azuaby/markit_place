<?php
	App::uses('AppController', 'Controller');
	
	class ItemsController extends AppController{
		public $names =  'Items';
		public $uses = array('Item','Comment');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler','ColorCompare');
		public $helpers = array('Form','Html');
		
		
		function change_item_status ($itemId,$status) {
				
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Shop');
			$this->loadModel('Item');
			$this->loadModel('User');
			global $setngs;
			global $loguser;
			
			$prefix = $this->Item->tablePrefix;
			
			
			if ($status == 'publish') {
				$this->Item->query("UPDATE ".$prefix."items SET status='draft' WHERE id = ".$itemId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = "<button class='btn btn-success' style='font-size:11px;width:60px;' onclick='changeItemStatus(".$itemId.",\"draft\");'>Publish</button>";
			}else {
				$this->Item->query("UPDATE ".$prefix."items SET status='publish' WHERE id = ".$itemId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = "<button class='btn btn-warning' style='font-size:11px;width:60px;' onclick='changeItemStatus(".$itemId.",\"publish\");'>Draft</button>";

				$item_user = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemId)));
				$user_id = $item_user[0]['Item']['user_id'];
				$item_title = $item_user[0]['Item']['item_title'];
				$item_url = $item_user[0]['Item']['item_title_url'];
				
			$email_address = $this->User->find("all",array("conditions"=>array('User.id'=>$user_id)));
			$emailaddress = $email_address[0]['User']['email'];			
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
		$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Your product #".$itemId." was approved by ".$setngs[0]['Sitesetting']['site_name'];
		$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
		$this->Email->sendAs = "html";
		$this->Email->template = 'productapproved';		
		$this->set('name', $name);
		$this->set('urlname', $urlname);
		$this->set('email', $emailaddress);
		//$username = $loguser[0]['User']['username'];
		$this->set('username',$email_address[0]['User']['first_name']);
		$this->set('sender',$sender);
		$this->set('item_title',$item_title);
		$this->set('item_url',$item_url);
		$this->set('itemId',$itemId);
		$this->set('access_url',SITE_URL."login");
		
		$this->Email->send();		
			}
			$userModel = $this->Item->findByid($itemId);
			$userId = $userModel['Item']['user_id'];
			$itemcount = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userId,'Item.status'=>'publish')));
			$this->Shop->updateAll(array('item_count' => "'$itemcount'"), array('user_id' => $userId));
			
			echo $result;
		}

		
		function delete_item_admin ($itemId = null) {
			
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Photo');
			$this->loadModel('Shiping');
			$this->loadModel('Itemfav');
			$this->loadModel('Comment');
			$this->loadModel('Log');
			$this->loadModel('Shop');
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('Wantownit');
			
				
			/* if (is_dir(WEBROOT_PATH.'media')) {
				echo "got it";
				echo unlink(dirname('http://hitasoft.com/primemo/').'fo.ctp');
				die();
			}else {
				echo "unknown ".BASE_PATH." ".SITE_URL;die();
			} */
			
			if($itemId != null) {				
				$fileName = $this->Photo->find('all',array('conditions'=>array('item_id'=>$itemId)));
				$original = true;$thumb70 = true;$thumb150 = true;$thumb350 = true;
				if ($_SESSION['media_url'] == SITE_URL) {
					foreach ($fileName as $name) {
						$fname = $name['Photo']['image_name'];
						if ($original == true && $thumb70 == true && $thumb150 == true && $thumb350 == true ) {
							$original = unlink(WEBROOT_PATH.'media/items/original/'.$fname);
							$thumb70 = unlink(WEBROOT_PATH.'media/items/thumb70/'.$fname);
							$thumb150 = unlink(WEBROOT_PATH.'media/items/thumb150/'.$fname);
							$thumb350 = unlink(WEBROOT_PATH.'media/items/thumb350/'.$fname);
						} else {
							echo 'false';
							return;
						}
					}
				}else {
					foreach ($fileName as $name) {
						$fname = $name['Photo']['image_name'];
						if ($original == true && $thumb70 == true && $thumb150 == true && $thumb350 == true ) {
							$original = unlink(WEBROOT_PATH.'media/items/original/'.$fname);
							$thumb70 = unlink(WEBROOT_PATH.'media/items/thumb70/'.$fname);
							$thumb150 = unlink(WEBROOT_PATH.'media/items/thumb150/'.$fname);
							$thumb350 = unlink(WEBROOT_PATH.'media/items/thumb350/'.$fname);
						} else {
							echo 'false';
							//return;
						}
					}
				}
				/* $this->Item->delete($itemId);
				$this->Photo->deleteAll(array('item_id' => $itemId), false);
				$this->Shiping->deleteAll(array('item_id' => $itemId), false);
				$this->Itemfav->deleteAll(array('item_id' => $itemId), false);
				$this->Comment->deleteAll(array('item_id' => $itemId), false);
				$this->Log->deleteAll(array('Log.notification_id' => $itemId,'Log.type' => 'additem'));
				 */
				
				$prefix = $this->Item->tablePrefix;
				$this->Item->query("DELETE FROM ".$prefix."items WHERE id = $itemId");
				$this->Photo->query("DELETE FROM ".$prefix."photos WHERE item_id = $itemId");
				$this->Shiping->query("DELETE FROM ".$prefix."shipings WHERE item_id = $itemId");
				$this->Itemfav->query("DELETE FROM ".$prefix."itemfavs WHERE item_id = $itemId");
				$this->Comment->query("DELETE FROM ".$prefix."comments WHERE item_id = $itemId");
				$this->Log->query("DELETE FROM ".$prefix."logs WHERE notification_id = $itemId");
				$this->Wantownit->deleteAll(array('itemid' => $itemId));
				
				$itemcount = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userId,'Item.status'=>'publish')));
				$this->Shop->updateAll(array('item_count' => "'$itemcount'"), array('user_id' => $userId));
				
				$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array('itemid'=>
						$itemId)));
				foreach ($contactsellerModel as $contactseller){
					$csid = $contactseller['Contactseller']['id'];
					$this->Contactseller->deleteAll(array('id' => $csid));
					//$this->Contactseller->query("DELETE FROM ".$prefix."contactsellers WHERE id = $csid");
					$this->Contactsellermsg->deleteAll(array('contactsellerid' => $csid));
					//$this->Contactsellermsg->query("DELETE FROM ".$prefix."contactsellermsgs WHERE contactsellerid = $csid");
				}
				
				echo 'true';
			}
		}
		
		function adminitemview($id=null,$nme=null){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Admin Item View');
			$nme = $this->Urlfriendly->utils_makeUrlFriendly($nme);
			$this->layout = 'adminitmvwlayout';
			$this->set('title_for_layout',' - '.ucwords($nme));
				
			global $setngs;
			global $loguser;
			global $siteChanges;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Country');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('User');
			$this->loadModel('Category');
			$this->loadModel('Itemlist');
			$this->loadModel('Photo');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			$this->loadModel('Wantownit');
			$this->loadModel('Fashionuser');
				
			$followcnt = $this->Follower->followcnt($userid);
			if(!empty($followcnt)){
				foreach($followcnt as $flcnt){
					$flwngusrids[] = $flcnt['Follower']['user_id'];
				}
			}
			$this->set('followcnt',$followcnt);
			
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
				
				
			if(empty($id)){
				$this->Session->setFlash('You url is not valid one');
				$this->redirect('/');
			}
				
			$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id)));
			if(empty($item_datas)){
				$this->Session->setFlash('The item you are searching is not found.');
				$this->redirect('/');
			}
		
			$wantOwnModel = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'want')));
			$wantIt = 0;
			if ($wantOwnModel > 0){
				$wantIt = 1;
			}
			$ownIt = 0;
			$wantOwnModel = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'own')));
			if ($wantOwnModel > 0){
				$ownIt = 1;
			}
			$this->set('wantIt',$wantIt);
			$this->set('ownIt',$ownIt);
				
			$current_page_userid = $item_datas[0]['User']['id'];
			$item_all=$this->Item->find('all',array('conditions'=>array('Item.user_id'=>$current_page_userid),'limit'=>12,'order'=>array('Item.id'=>'desc')));
			if(isset($userid)){
				$usershipping = $this->User->findByid($userid);
				$usershippingid = $usershipping['User']['defaultshipping'];
					
				$cntry_code = $this->Shippingaddresses->findByshippingid($usershippingid);
				$cntry_code = $cntry_code['Shippingaddresses']['countrycode'];
			}else{
				$cntry_code = '';
				$usershipping = '';
			}
				
			$commentss_item = $this->Comment->find('all',array('conditions'=>array('Comment.item_id'=>$id),'order'=>array('Comment.id'=>'desc'),'group'=>array('Comment.id')));
				
			$itemfavs = $this->Itemfav->find('all',array('conditions'=>array('item_id'=>$id)));
			
			foreach ($itemfavs as $i => $row)
			{
				$itemusr[]=$row['Itemfav']['user_id'];
					
			}
				
			$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$itemusr),'order'=>array('User.id'=>'desc')));
				
			foreach($people_details as $ppl_dtl){
				$user_id = $ppl_dtl['User']['id'];
				$ppl_dtda = array();
				foreach($ppl_dtl['Itemfav'] as $favkey => $ppl_dt){
					$ppl_dtda[] = $ppl_dt['item_id'];
				}
				$pho_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda),'order'=>array('Item.id'=>'desc')));
					
				foreach($pho_datas as $key=>$ppl_dt1){
					$itemIdses= $ppl_dt1['Item']['id'];
					$itemnames = $ppl_dt1['Item']['item_title'];
					$itemnamesUrl = $ppl_dt1['Item']['item_title_url'];
					$photimgName = $ppl_dt1['Photo'][0]['image_name'];
		
					if ($key < 10){
						$allitemdatta[$user_id][$key]['Itemidd'] = $itemIdses;
						$allitemdatta[$user_id][$key]['item_title'] = $itemnames;
						$allitemdatta[$user_id][$key]['item_title_url'] = $itemnamesUrl;
						$allitemdatta[$user_id][$key]['image_name'] = $photimgName;
					}else {
						break;
					}
						
				}
			}
			$FashionuserDet =  $this->Fashionuser->find('all',array('conditions'=>array('Fashionuser.itemId'=>$id,'Fashionuser.status'=>'Yes'),'order'=>array('Fashionuser.id'=>'desc')));
			$this->set('FashionuserDet',$FashionuserDet);
		
			$this->set('allitemdatta',$allitemdatta);
			$this->set('people_details',$people_details);
		
				
			$this->set('item_all',$item_all);
			$this->set('item_datas',$item_datas[0]);
			$this->set('loguser',$loguser);
			$this->set('userid',$userid);
			$this->set('cntry_code',$cntry_code);
			$this->set('commentss_item',$commentss_item);
		
			$this->set('usershipping',$usershipping);
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('setngs',$setngs);
				
		}
		
		function manage_items(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Item Management');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->Item->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/site/setting');
			}
			
			$searchkywrd = $this->passedArgs['serchkeywrd'];
			if($searchkywrd)
			$this->paginate =  array('conditions'=>array('Item.status'=>'publish','OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%')),'limit'=>'10','order'=>array('Item.id'=>'asc'));
			else			
			$this->paginate =  array('conditions'=>array('Item.status'=>'publish'),'limit'=>10,'order'=>array('modified_on'=>'desc'));
			
			
			$item_datas = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
			
			//$item_datas = $this->Item->find('all');
			
			$this->set('item_datas',$item_datas);
			$this->set('pagecount',$pagecount);
		}
		
			function nonapproved_items(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Item Management');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->Item->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/site/setting');
			}
			
			$searchkywrd = $this->passedArgs['serchkeywrd'];
			if($searchkywrd)
			$this->paginate =  array('conditions'=>array('Item.status'=>'draft','OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%')),'limit'=>'10','order'=>array('Item.id'=>'asc'));
			else			
			$this->paginate =  array('conditions'=>array('Item.status'=>'draft'),'limit'=>10,'order'=>array('modified_on'=>'desc'));
			
			
			$item_datas = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
			
			//$item_datas = $this->Item->find('all');
			
			$this->set('item_datas',$item_datas);
			$this->set('pagecount',$pagecount);
		}		

		function manage_affiliate(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Item Management');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->Item->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/site/setting');
			}
			
			$searchkywrd = $this->passedArgs['serchkeywrd'];
			if($searchkywrd)
			$this->paginate =  array('conditions'=>array('OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%')),'limit'=>'10','order'=>array('Item.id'=>'asc'));
			else			
			$this->paginate =  array('conditions'=>array('Item.status'=>'things'),'limit'=>10,'order'=>array('modified_on'=>'desc'));
			
			
			$item_datas = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
			
			//$item_datas = $this->Item->find('all');
			
			$this->set('item_datas',$item_datas);
			$this->set('pagecount',$pagecount);
		}


		function create_item($additemid = NULL){
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','- Add');
	   	 	//$this->layout = 'frontlayout';
			global $loguser;
			$this->loadModel('Shop');
			
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('User');
			$user_status_val = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
			$user_status = $user_status_val['User']['user_status'];
			
			if($user_status=="disable")
			{
				
				$this->Session->setFlash(__('Your account has been disabled please contact our support'), 'default', array(), 'bad');
				$this->redirect($this->Auth->logout());
				$this->redirect('/login');
				
			}			
			
			$this->loadModel('Color');
			$color_datas = $this->Color->find('all');
			$this->set('color_datas',$color_datas);
			
			$userid = $loguser[0]['User']['id'];
			//$merchant_chk = $this->Shop->find('all',array('conditions'=>array('paypal_id <>'=>'','user_id'=>$userid)));
			$merchant_chk = $this->Shop->find('first',array('conditions'=>array('user_id'=>$userid)));
			
			//echo "<pre>";print_r($merchant_chk);die;
			if($merchant_chk['Shop']['seller_status'] == 1){
				$this->loadModel('Category');
				//$this->loadModel('Style');
				$this->loadModel('Country');
				//$this->loadModel('Occasion');
				$this->loadModel('Recipient');
				$cat_datas = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				//$style_datas = $this->Style->find('all',array('order'=>array('style_name'=>'asc')));
				$country_datas = $this->Country->find('all',array('order'=>array('country'=>'asc')));
				$rcpnt_datas = $this->Recipient->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('recipient_name'=>'asc')));
				//$occsn_datas = $this->Occasion->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('occasion_name'=>'asc')));
				if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
				{
				  $ip=$_SERVER['HTTP_CLIENT_IP'];
				}
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
				{
				  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else
				{
				  $ip=$_SERVER['REMOTE_ADDR'];
				}
				// for localhostip address is not get correctly.  so am hard coded here 
				//$IPDetail = $this->countryCityFromIP($ip);
				//$IPDetail = $this->countryCityFromIP('117.242.24.21');
				//echo "<pre>";print_r($IPDetail);die;
				//$country =  $IPDetail['country']; //country of that IP address
				//$city =  $IPDetail['city']; //outputs the IP detail of the city
				//$cntry_code =  $IPDetail['country_code']; //outputs the IP detail of the country code
				$country =  'India';
				$city =  'Chennai';
				$cntry_code = 'IN';
				foreach($country_datas as $cntry){
					$cntrynme[$cntry['Country']['code']] = $cntry['Country']['country'];
					$cntryid[$cntry['Country']['code']] = $cntry['Country']['id'];
				}
				// die;
				// echo "<pre>";print_R($cat_datas);die;
				
				
				$findfromitem = $this->Item->find('all',array('conditions'=>array('Item.id'=>$additemid)));
				
				//for commision details -sathish //
				$this->loadModel('Commission');
				
				$commisionrate=$this->Commission->find('all',array('conditions'=>array('Commission.active' => '1')));
	      
	     //   echo "<pre>";print_r($commisionrate);die;
	        	
				$this->set('commisionrate',$commisionrate);
				//for commision details  ended -sathish //
				$this->set('findfromitem',$findfromitem[0]);
				$this->set('cat_datas',$cat_datas);
				//$this->set('style_datas',$style_datas);
				$this->set('country_datas',$country_datas);
				$this->set('cntry_code',$cntry_code);
				$this->set('country',$country);
				$this->set('cntrynme',$cntrynme);
				$this->set('cntryid',$cntryid);
				$this->set('rcpnt_datas',$rcpnt_datas);
				//$this->set('occsn_datas',$occsn_datas);
			}else if($merchant_chk['Shop']['paypal_id'] == ''){
				$this->redirect('/sellersignup/');
			}else{	
				$this->Session->setFlash('Admin Approval Pending', 'default', array(), 'good');
				$this->redirect('/');	
			}
		}
		
		function saveitems($addedtheitemid = NULL){
			$this->loadModel('Shop');
			$this->loadModel('Shiping');
			$this->loadModel('Photo');
			$this->loadModel('User');
			// die;
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			if(isset($addedtheitemid)){
				$findfromitem = $this->Item->find('all',array('conditions'=>array('Item.id'=>$addedtheitemid,'Item.user_id'=>$userid)));
				
				$imgName = $_SESSION['media_url'].'media/items/original/'.$findfromitem[0]['Photo'][0]['image_name'];
				$result = ColorCompareComponent::compare(5, $imgName);
				
				
				
				$shpcnt = $this->Shop->find('all',array('conditions'=>array('user_id'=>$userid)));
				if(!empty($shpcnt)){
					$shop_id = $shpcnt[0]['Shop']['id'];
				}else{
					$this->request->data['Shop']['user_id'] = $userid;
					$this->Shop->save($this->request->data);
					$shop_id = $this->Shop->getLastInsertID();
				}
				
				//$last_id = $this->request->data['Item']['id'] = $addedtheitemid;					
				$this->request->data['Item']['user_id'] = $userid;
				$this->request->data['Item']['shop_id'] = $shop_id;
				$title = $this->request->data['Item']['item_title'] = $this->request->data['Item']['item_title'];
				$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
				$this->request->data['Item']['item_description'] = $this->request->data['Item']['item_description'];
				$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
				
			
				if(!empty($this->request->data['recipient'])){
					$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
				}else{
					$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
				}
				$this->request->data['Item']['videourrl'] = $this->request->data['listing']['videourrl'];
				$this->request->data['Item']['price'] = $this->request->data['listing']['price'];
				$this->request->data['Item']['quantity'] = $this->request->data['listing']['quantity'];
				$this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
				$this->request->data['Item']['category_id'] = $this->request->data['Item']['category_id'];
				$this->request->data['Item']['super_catid'] = $this->request->data['\'Item\'']['\'supersubcat\''];
				$this->request->data['Item']['sub_catid'] = $this->request->data['\'Item\'']['\'subcat\''];
				$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
				$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
				if($processing_time_id == 'custom'){
					$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
					$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
					$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
				}
				$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
				$this->request->data['Item']['status'] = 'draft';
				$this->request->data['Item']['item_color'] = json_encode($result);
				$this->Item->save($this->request->data);
				$last_id = $this->Item->getLastInsertID();
				
				
					
					if(!empty($findfromitem[0]['Photo'][0]['image_name'])){
						$this->request->data['Photo']['item_id'] = $last_id;
						$this->request->data['Photo']['image_name'] = $findfromitem[0]['Photo'][0]['image_name'];
						$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
						// echo "<pre>";print_r($this->request->data['Photo']);die;
						$this->Photo->save($this->request->data);
					}
				
				
				
				if(!empty($_REQUEST['country_shipping'])){
					foreach($_REQUEST['country_shipping'] as $kys=>$shpngcntry){
						// echo "<pre>";print_r($kys);
						// echo "<pre>";print_r($shpngcntry);
						foreach($shpngcntry as $shps){
							$this->Shiping->create();
				
							$this->request->data['Shiping']['item_id'] = $last_id;
							$this->request->data['Shiping']['country_id'] = $kys;
							$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
							//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
							$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
				
							$this->Shiping->save($this->request->data);
						}
					}
				}
				if(!empty($_REQUEST['everywhere_shipping'])){
					$this->Shiping->create();
				
					$this->request->data['Shiping']['item_id'] = $last_id;
					$this->request->data['Shiping']['country_id'] = 0;
					$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
					//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
					$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
				
					$this->Shiping->save($this->request->data);
				}
				
				
				$logdetails = $this->logs('additem',$last_id,$userid,'0');
				
				$this->Session->setFlash('Item added successfully, waiting for admin approval', 'default', array(), 'good');
				//$this->redirect($this->referer());
				
				
				
				$this->redirect('/create/item/');
				
				
				//echo "<pre>";print_r($findfromitem);die;
			}	
			
			
			//echo "<pre>";print_r($this->request->data);die;
			for($i=0;$i<1;$i++){
				if(!empty($this->request->data['image'][$i])){
					$imgName = $_SESSION['media_url'].'media/items/original/'.$this->request->data['image'][$i];
					$result = ColorCompareComponent::compare(5, $imgName);
				}
			}
			//echo "<pre>";print_r($result);die;
			
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
			$title = $this->request->data['Item']['item_title'] = $this->request->data['Item']['item_title'];
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $this->request->data['Item']['item_description'];
			//$this->request->data['Item']['shop_sec'] = $this->request->data['Item']['shop_sec'];
			//$this->request->data['Item']['recipient'] = $this->request->data['property']['recipient'];
			$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
			$this->request->data['Item']['start'] = $this->request->data['start_date']; 
			$this->request->data['Item']['end'] = $this->request->data['end_date'];
			$this->request->data['Item']['tax'] = $this->request->data['tax'];
			
			if(!empty($this->request->data['recipient'])){
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}else{
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}
			/*if(!empty($this->request->data['styles'])){
				$this->request->data['Item']['style'] = implode(',',$this->request->data['styles']);
			}else{	
				$this->request->data['Item']['style'] = $this->request->data['Item']['styles'];
			}	
			if(!empty($this->request->data['tags'])){
				$this->request->data['Item']['tags'] = implode(',',$this->request->data['tags']);
			}else{
				$this->request->data['Item']['tags'] = '';
			}	
			if(!empty($this->request->data['metrl'])){
				$this->request->data['Item']['materials'] = implode(',',$this->request->data['metrl']);
			}else{	
				$this->request->data['Item']['materials'] = '';listing[videourrl]
			}	*/
			$this->request->data['Item']['videourrl'] = $this->request->data['listing']['videourrl'];
			$this->request->data['Item']['price'] = $this->request->data['listing']['price'];
			$this->request->data['Item']['quantity'] = $this->request->data['listing']['quantity'];
			$sizeOption = $this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$sizeQty = 0;
			if ($sizeOption != ''){
				$sizeOption = explode(",",$sizeOption);
				foreach ($sizeOption as $size){
					$singleSize = explode("=", $size);
					$sizeQty += $singleSize[1];
				}
				$this->request->data['Item']['quantity'] = $sizeQty;
			}
			$this->request->data['Item']['category_id'] = $this->request->data['Item']['category_id'];
			$this->request->data['Item']['super_catid'] = $this->request->data['\'Item\'']['\'supersubcat\''];
			$this->request->data['Item']['sub_catid'] = $this->request->data['\'Item\'']['\'subcat\''];
			//$this->request->data['Item']['item_made_it'] = $this->request->data['property']['whomade'];
			//$this->request->data['Item']['item_for_what'] = $this->request->data['property']['issupply'];
			//$this->request->data['Item']['item_when_make'] = $this->request->data['property']['whenmade'];
			// $this->request->data['Item']['variation_propty_1'] = $this->request->data['Item'][''];
			// $this->request->data['Item']['scale_size_1'] = $this->request->data['Item'][''];
			// $this->request->data['Item']['offer_options_1'] = $this->request->data['Item'][''];
			// $this->request->data['Item']['variation_propty_2'] = $this->request->data['Item'][''];
			// $this->request->data['Item']['scale_size_2'] = $this->request->data['Item'][''];
			// $this->request->data['Item']['offer_options_2'] = $this->request->data['Item'][''];
			$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
			$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
			if($processing_time_id == 'custom'){
				$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
				$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
				$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
			}	
			
			if(empty($this->request->data['itemcolor']))
			{
				$result = json_encode($result);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '0';
			}
			else
			{
				$result = json_encode($this->request->data['itemcolor']);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '1';
			}
			$this->request->data['Item']['delivery_type'] = $this->request->data['deltype'];

			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");			
			$this->request->data['Item']['status'] = 'draft';			
			
			$this->request->data['Item']['end'] = $this->request->data['Item']['end'];
			$this->request->data['Item']['tax'] = $this->request->data['tax'];
			//echo "<pre>";print_r($this->request->data['Item']['tax'] );die;
			
			$this->Item->save($this->request->data);
			
			$last_id = $this->Item->getLastInsertID();
			
			for($i=0;$i<5;$i++){
				$this->Photo->create();
				// echo $this->request->data['image'][$i];
				if(!empty($this->request->data['image'][$i])){
					$this->request->data['Photo']['item_id'] = $last_id;
					$this->request->data['Photo']['image_name'] = $this->request->data['image'][$i];
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					// echo "<pre>";print_r($this->request->data['Photo']);die;
					$this->Photo->save($this->request->data);
				}
			}	
			// die;
			if(!empty($_REQUEST['country_shipping'])){
				foreach($_REQUEST['country_shipping'] as $kys=>$shpngcntry){
					// echo "<pre>";print_r($kys);
					// echo "<pre>";print_r($shpngcntry);
					foreach($shpngcntry as $shps){
						$this->Shiping->create();
						
						$this->request->data['Shiping']['item_id'] = $last_id;
						$this->request->data['Shiping']['country_id'] = $kys;
						$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
						//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
						$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
						
						$this->Shiping->save($this->request->data);
					}	
				}
			}	
			if(!empty($_REQUEST['everywhere_shipping'])){
				$this->Shiping->create();
				
				$this->request->data['Shiping']['item_id'] = $last_id;
				$this->request->data['Shiping']['country_id'] = 0;
				$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
				//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
				$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
				
				$this->Shiping->save($this->request->data);
			}
			
			
			$logdetails = $this->logs('additem',$last_id,$userid,'0');
			
			//$email_address = $this->User->find("all",array("conditions"=>array('User.username'=>'Admin')));
			$emailaddress = $setngs[0]['Sitesetting']['notification_email'];	
			
			$item_name = $this->Item->find('all',array('conditions'=>array('Item.id'=>$last_id)));
			$itemname = $item_name[0]['Item']['item_title'];	
			$quantity = $item_name[0]['Item']['quantity'];
			$itemprice = $item_name[0]['Item']['price'];
			$sizeoptions = $item_name[0]['Item']['size_options'];
			
			$username = $loguser[0]['User']['username'];
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
		$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Item Approval Request";
		$this->Email->from = $setngs[0]['Sitesetting']['noreply_email'];
		$this->Email->sendAs = "html";
		$this->Email->template = 'newitemadded';		
		$this->set('username', $username);
		$this->set('urlname', $urlname);
		$this->set('email', $emailaddress);
		$this->set('itemname',$itemname);
		$this->set('quantity',$quantity);
		$this->set('itemprice',$itemprice);
		$this->set('sizeoptions',$sizeoptions);
		$this->set('sender',$sender);
		$this->set('access_url',SITE_URL."login");
		
		$this->Email->send(); 			
			
			
			$this->Session->setFlash('Item added successfully, waiting for admin approval', 'default', array(), 'good');
			$this->redirect($this->referer());
			
		}
		
		function countryCityFromIP($ipAddr)
		{
			//function to find country and city from IP address
			//Developed by Roshan Bhattarai http://roshanbh.com.np

			//verify the IP address for the
			ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
			$ipDetail=array(); //initialize a blank array

			//get the XML result from hostip.info
			
			//echo $ip=$_SERVER['REMOTE_ADDR'];die;
			
			//http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=117.242.24.21
			
			//http://api.hostip.info/?ip=
					
			//echo "http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=".$ipAddr;
			$xml = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=".$ipAddr);

			//get the city name inside the node <gml:name> and </gml:name>
			
			$extract_ip = $pieces = explode(";", $xml);
			
			//print_r($extract_ip);die;
			
			
			//preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);

			//assing the city name to the array
			//print_r($match);die;
			
			$ipDetail['city'] = $extract_ip['6']; 
			

			//get the country name inside the node <countryName> and </countryName>
			//preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);

			//assign the country name to the $ipDetail array
			$ipDetail['country']=$extract_ip[4];

			//get the country name inside the node <countryName> and </countryName>
			//preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
			$ipDetail['country_code']=$extract_ip[3]; 
			
			//assing the country code to array

			//return the array containing city, country and country code
			return $ipDetail;
			

		}
		
		function getsizeqty() {
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$itemId = $_POST['id'];
			$seltsize = $_POST['size'];
			
			$itemModel = $this->Item->find('first',array('conditions'=>array('Item.id'=>$itemId)));
			
			$sizeqty = $itemModel['Item']['size_options'];
			$sizes = explode(',', $sizeqty);
			foreach($sizes as $key => $size){
				$qty = explode('=', $size);
				if ($qty[0] == $seltsize){
					for($i = 1; $i <= $qty[1]; $i++ ){
						echo '<option value="'.$i.'">'.$i.'</option>';
							}
					return;
				}
			}
		}
		
		
		/* the detail page of the single item */
		function listings($id=null,$nme=null,$usrid=null){
			$nme = $this->Urlfriendly->utils_makeUrlFriendly($nme);
			$this->layout = 'frontlayout';
			$this->set('title_for_layout',' - '.ucwords($nme));
			
			global $setngs;
			global $loguser;
			global $siteChanges;
			//print_r($loguser);
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Country');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('User');
			//$this->loadModel('Itemfav');
			//$this->loadModel('Shopfav');
			$this->loadModel('Category');
			$this->loadModel('Itemlist');
			$this->loadModel('Photo');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			$this->loadModel('Wantownit');
			$this->loadModel('Fashionuser');
			$this->loadModel('Contactseller');
			$this->loadModel('Sitequeries');
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'product')));
			$this->set('banner_datas',$banner_datas);
			
			
			$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
					'contact_seller')));
			
			$csqueries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
			/* $itemgroupuserModel = $this->Item->find('all',array('order'=>array('Item.user_id DESC')));
			$prevUserId = 0;$mercount = 0;$meritemcount = 0;
			foreach ($itemgroupuserModel as $itemModel){
				if ($prevUserId != $itemModel['Item']['user_id']) {
					$prevUserId = $itemModel['Item']['user_id'];
					$itemUsers[$mercount]['userid'] = $prevUserId;
					$prevcount = $mercount;
					$mercount ++;$meritemcount = 0;
				}
				$itemUsers[$prevcount]['items'][$meritemcount]['itemid'] = $itemModel['Item']['id'];
				$meritemcount ++;
			}
			echo "<pre>";print_r($itemUsers);die; */
			
			$followcnt = $this->Follower->followcnt($userid);
			if(!empty($followcnt)){
				foreach($followcnt as $flcnt){
					$flwngusrids[] = $flcnt['Follower']['user_id'];
				}
			}
			$this->set('followcnt',$followcnt);
			//echo "<pre>";print_r($followcnt);	die;
		
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			
			$contactsellerModel = $this->Contactseller->find('first',array('conditions'=>array('itemid'=>$id,'buyerid'=>$userid)));
			
			if(empty($id) || empty($nme)){
				$this->Session->setFlash('Url is not valid');
				$this->redirect('/');
			}
			
			if($usrid != $userid) {
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id,'Item.item_title_url'=>$nme,'Item.status <>'=>'draft')));
			}
			else {
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id,'Item.item_title_url'=>$nme)));
			}
			if(empty($item_datas)){
				$this->Session->setFlash('The item you are searching was not found.');
				$this->redirect('/');
			}
			
			$categoryID = $item_datas[0]['Item']['category_id'];
			
			$moreFromCategory = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$categoryID,'Item.status'=>'publish','Item.id <>'=>$id),'order' => 'rand()','limit'=>3));
		
			$wantOwnModel = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'want')));
			$wantIt = 0;
			if ($wantOwnModel > 0){
				$wantIt = 1;
			}
			$ownIt = 0;
			$wantOwnModel = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'own')));
			if ($wantOwnModel > 0){
				$ownIt = 1;
			}
			$this->set('wantIt',$wantIt);
			$this->set('ownIt',$ownIt);
			
			$current_page_userid = $item_datas[0]['User']['id'];
			$item_all=$this->Item->find('all',array('conditions'=>array('Item.user_id'=>$current_page_userid,'Item.status <>'=>'draft'),'limit'=>12,'order'=>array('Item.id'=>'desc')));
			if(isset($userid)){
				$usershipping = $this->User->findByid($userid);
				$usershippingid = $usershipping['User']['defaultshipping'];
			
				$cntry_code = $this->Shippingaddresses->findByshippingid($usershippingid);
				$cntry_code = $cntry_code['Shippingaddresses']['countrycode'];
			}else{
				$cntry_code = '';
				$usershipping = '';
			}
			$cntry_datas = $this->Country->find('all');
			//foreach($cntry_datas as $cntry){
			//$cntryname[$cntry['Country']['id']] = $cntry['Country']['country'];
			//$cntryid[$cntry['Country']['code']] = $cntry['Country']['id'];
			//}
			
			//$itemfavs = $this->Itemfav->find('count',array('conditions'=>array('item_id'=>$id,'user_id'=>$loguser[0]['User']['id'])));
			//$shopfavs = $this->Shopfav->find('count',array('conditions'=>array('shop_id'=>$item_datas[0]['Shop']['id'],'user_id'=>$loguser[0]['User']['id'])));
			
			
			$commentss_item = $this->Comment->find('all',array('conditions'=>array('Comment.item_id'=>$id),'order'=>array('Comment.id'=>'desc'),'group'=>array('Comment.id')));
			//echo "<pre>";print_r($commentss_item);die;
			
			
			$itemfavs = $this->Itemfav->find('all',array('conditions'=>array('item_id'=>$id)));
			//$shopfavs = $this->Shopfav->find('count',array('conditions'=>array('shop_id'=>$item_datas[0]['Shop']['id'],'user_id'=>$loguser[0]['User']['id'])));
				
				
				
			foreach ($itemfavs as $i => $row)
			{				
				$itemusr[]=$row['Itemfav']['user_id'];
					
			}
			
			$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$itemusr),'order'=>array('User.id'=>'desc')));
			 	
			foreach($people_details as $ppl_dtl){
				$user_id = $ppl_dtl['User']['id'];
				$ppl_dtda = array();
				foreach($ppl_dtl['Itemfav'] as $favkey => $ppl_dt){
					$ppl_dtda[] = $ppl_dt['item_id'];
				}
				$pho_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda),'order'=>array('Item.id'=>'desc')));
				//echo "<pre>";print_r($pho_datas);	die;
					
				foreach($pho_datas as $key=>$ppl_dt1){
					$itemIdses= $ppl_dt1['Item']['id'];
					$itemnames = $ppl_dt1['Item']['item_title'];
					$itemnamesUrl = $ppl_dt1['Item']['item_title_url'];
					$photimgName = $ppl_dt1['Photo'][0]['image_name'];
						
					if ($key < 10){
						$allitemdatta[$user_id][$key]['Itemidd'] = $itemIdses;
						$allitemdatta[$user_id][$key]['item_title'] = $itemnames;
						$allitemdatta[$user_id][$key]['item_title_url'] = $itemnamesUrl;
						$allitemdatta[$user_id][$key]['image_name'] = $photimgName;
						//$alldatta = $ppl_dt1[$user_id][$key][$itemIdses];
					}else {
						break;
					}
							
				}
			}  
			
			$possibleCountry = array();
			foreach ($item_datas[0]['Shiping'] as $shipping){
				$possibleCountry[] = $shipping['country_id'];
			}

			//echo "<pre>";print_r($allitemdatta);die;
			$FashionuserDet =  $this->Fashionuser->find('all',array('conditions'=>array('Fashionuser.itemId'=>$id,'Fashionuser.status'=>'Yes'),'order'=>array('Fashionuser.id'=>'desc')));
			//echo "<pre>";print_r($FashionuserDet);die;
			$this->set('FashionuserDet',$FashionuserDet);
						
			$this->set('allitemdatta',$allitemdatta);
			$this->set('people_details',$people_details);
				
			
			//echo "<pre>";print_r($item_datas[0]);die;
			// echo "<pre>";print_r($FashionuserDet);die;
			$this->set('item_all',$item_all);
			$this->set('contry_datas',$cntry_datas);
			$this->set('item_datas',$item_datas[0]);
			$this->set('moreFromCategory',$moreFromCategory);
			//$this->set('cntryname',$commentss_item);
			$this->set('loguser',$loguser);
			$this->set('userid',$userid);
			//$this->set('itemfavs',$itemfavs);
			//$this->set('shopfavs',$shopfavs);
			$this->set('cntry_code',$cntry_code);
			//$this->set('cntryid',$cntryid);
			$this->set('commentss_item',$commentss_item);
			$this->set('contactsellerModel',$contactsellerModel);
		
			$this->set('usershipping',$usershipping);
			$this->set('possibleCountry',$possibleCountry);
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('setngs',$setngs);
			$this->set('csqueries',$csqueries);
			
		}
		
		function featureditem(){
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
				
			$status = $_POST['status'];
			$itemid = $_POST['itemid'];
			$this->loadModel('Item');
			//echo $featureditemid;die;
			$favitem = $this->Item->updateAll(array('Item.featured' =>$status), array('Item.id' => $itemid));
			
			//$itemuser = $this->Item->findById($featureditemid);
			
			
		//echo"<pre>";print_r($setngs);die;
			
			
			die;
				
		}
		
		
		function gift_card(){
			$this->layout = 'default';
			global $loguser;
		}
		
		/* add fav items */
		function addfavitems(){
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			$itemid = $_REQUEST['itemid'];
			$this->loadModel('Itemfav');
			
			$itemfavs = $this->Itemfav->find('count',array('conditions'=>array('item_id'=>$itemid,'user_id'=>$userid)));
			if($itemfavs > 0){
				echo "error";
			}else{
				$this->request->data['Itemfav']['user_id'] = $userid;
				$this->request->data['Itemfav']['item_id'] = $itemid;
				$this->Itemfav->save($this->request->data);
			
				echo 0;
			}
			die;
			
		}
		
		/* add fav shops */
		function addfavshops(){
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			$shopid = $_REQUEST['shopid'];
			$this->loadModel('Shopfav');
			
			$shopfavs = $this->Shopfav->find('count',array('conditions'=>array('shop_id'=>$shopid,'user_id'=>$userid)));
			if($shopfavs > 0){
				echo "error";
			}else{
				$this->request->data['Shopfav']['user_id'] = $userid;
				$this->request->data['Shopfav']['shop_id'] = $shopid;
				$this->Shopfav->save($this->request->data);
				echo 0;
			}	
			die;
			
		}
		
		/* tags and materials function */
		function tags_mtrls($name = null){
			$this->layout = 'default';
			
			if($_REQUEST['ref'] == 'sel_tags'){
				$this->set('title_for_layout','Tag '.$name);
			}else{
				$this->set('title_for_layout','Material '.$name);
			}
			global $loguser;
			$item_datas = array();
			
			$userid = $loguser[0]['User']['id'];
			
			if(empty($name)){
				$this->Session->setFlash('You url is not valid one');
				$this->redirect('/');
			}
			if($_REQUEST['ref'] == 'sel_tags'){
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.tags like'=>"%".$name."%")));
			}else{
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.materials like'=>"%".$name."%")));
			}
			
			// echo "<pre>";print_r($item_datas);die;
			
			$this->set('ref',$_REQUEST['ref']);
			$this->set('item_datas',$item_datas);
			$this->set('name',$name);
			
		}
		
		
		
		function addcomments(){
			//$userid = $loguser[0]['User']['id'];
			$this->autoRender=false;
			
			$userid = $_REQUEST['userid'];	
			$itemid = $_REQUEST['itemid'];	
			$commentss = $_REQUEST['commentss'];
			global $setngs;
			global $loguser;
			$logusername = $loguser[0]['User']['first_name'];
			$this->request->data['Comment']['user_id'] = $userid;
			$this->request->data['Comment']['item_id'] = $itemid;
			$this->request->data['Comment']['comments'] = $commentss;
			$this->request->data['Comment']['created_on'] = date("Y-m-d H:i:s");
			$this->Comment->save($this->request->data);
			$comment_id = $this->Comment->getLastInsertID();
			
			$this->loadModel('Item');
			$getuserIdd = $this->Item->findById($itemid);
			$ItemaddUserid = $getuserIdd['Item']['user_id'];
			if (!empty($getuserIdd['User']['push_notifications'])){
				$pushSettings = json_decode($getuserIdd['User']['push_notifications'],true);
				if ($pushSettings['frends_cmnts_push'] == 1){
					$logdetails = $this->logs('comment',$comment_id,$userid,'0');
					
					App::import('Controller', 'Users');
					$Users = new UsersController;
					$this->loadModel('Userdevice');
					if ($ItemaddUserid != $userid){
						$userddett = $this->Userdevice->findAllByUser_id($ItemaddUserid);
						//echo "<pre>";print_r($userddett);die;
						foreach ($userddett as $userd) {
							$deviceTToken = $userd['Userdevice']['deviceToken'];
							$badge = $userd['Userdevice']['badge'];
							$badge +=1;
							$this->Userdevice->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
							if(isset($deviceTToken)){
								$messages = $logusername." is commented on your item : ".urldecode($_REQUEST['comment']);
								//$messages = $logusername." est commenté votre article : ".$commentss;
								$Users->pushnot($deviceTToken,$messages,$badge);
							}
						}
					}
				}
			}
			
			$cmntCount = $this->Comment->find('count',array('recursive'=>'-1','conditions'=>array('Comment.item_id'=>$itemid)));
			$this->Item->updateAll(array('comment_count' => "'$cmntCount'"), array('Item.id' => $itemid));

			$emailaddress = $getuserIdd['User']['email'];
			$comment_status = $getuserIdd['User']['someone_cmnt_ur_things'];
			if($comment_status==1)
			{
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
				$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Someone commented on your product";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'addcomment';		
				$this->set('name', $getuserIdd['User']['first_name']);
				$this->set('comments', $_REQUEST['commentss']);
				$this->set('email', $emailaddress);
				$this->set('username',$logusername);
				$this->set('itemid',$itemid);
				$this->set('itemname',$getuserIdd['Item']['item_title']);
				$this->set('itemurl',$getuserIdd['Item']['item_title_url']);
				$this->set('access_url',SITE_URL."login");
				
				$this->Email->send();  
			}	
			
			echo $this->Comment->getLastInsertID();
			
		
				
		}
		
		
		function deletecomments(){
			$cmtid = $_REQUEST['addid'];
			$this->loadModel('Comment');
			$this->loadModel('Log');		
				
			$itemid = $_REQUEST['itemid'];
			$prefix = $this->Comment->tablePrefix;
			$this->Comment->deleteAll(array('Comment.id' => $cmtid));
			//$this->Log->deleteAll(array('Log.notification_id' => $cmtid,'Log.type' => 'comment'));
			$this->Log->query("DELETE FROM ".$prefix."logs WHERE notification_id = $cmtid and type='comment'");
			
			$cmntCount = $this->Comment->find('count',array('recursive'=>'-1','conditions'=>array('Comment.item_id'=>$itemid)));
			$this->Item->updateAll(array('comment_count' => "'$cmntCount'"), array('Item.id' => $itemid));
			echo "1";
			die;
		}

		 function wantit(){
			global $loguser;
			$this->layout = 'ajax';
			$this->autoRender = false;
			$userid = $loguser[0]['User']['id'];
		 	$itemid = $_POST['id'];
		 	
		 	$this->loadModel('Wantownit');
		 	
		 	$wantOwnModel = $this->Wantownit->find('first',array('conditions'=>array('userid'=>$userid,'itemid'=>$itemid,'type'=>'want')));
		 	if (count($wantOwnModel) > 0){
		 		$this->Wantownit->deleteAll(array('id' => $wantOwnModel['Wantownit']['id']));
		 		echo '0';
		 	}else{
		 		$OwnModel = $this->Wantownit->find('first',array('conditions'=>array('userid'=>$userid,'itemid'=>$itemid,'type'=>'own')));
		 		if (count($OwnModel) > 0){
		 		$this->Wantownit->deleteAll(array('id' => $OwnModel['Wantownit']['id']));
		 		}
		 		$this->Wantownit->create();
		 		$this->request->data['Wantownit']['userid'] = $userid;
		 		$this->request->data['Wantownit']['itemid'] = $itemid;
		 		$this->request->data['Wantownit']['type'] = 'want';
		 		$this->Wantownit->save($this->request->data);
		 		echo '1';
		 	}
		 	
		 } 

		 function ownit(){
			global $loguser;
			$this->layout = 'ajax';
			$this->autoRender = false;
			$userid = $loguser[0]['User']['id'];
		 	$itemid = $_POST['id'];
		 	
		 	$this->loadModel('Wantownit');
		 	
		 	$wantOwnModel = $this->Wantownit->find('first',array('conditions'=>array('userid'=>$userid,'itemid'=>$itemid,'type'=>'own')));
		 	if (count($wantOwnModel) > 0){
		 		$this->Wantownit->deleteAll(array('id' => $wantOwnModel['Wantownit']['id']));
		 		echo '0';
		 	}else{
		 		$wantModel = $this->Wantownit->find('first',array('conditions'=>array('userid'=>$userid,'itemid'=>$itemid,'type'=>'want')));
		 		if (count($wantModel) > 0){
		 		$this->Wantownit->deleteAll(array('id' => $wantModel['Wantownit']['id']));
		 		}
		 		$this->Wantownit->create();
		 		$this->request->data['Wantownit']['userid'] = $userid;
		 		$this->request->data['Wantownit']['itemid'] = $itemid;
		 		$this->request->data['Wantownit']['type'] = 'own';
		 		$this->Wantownit->save($this->request->data);
		 		echo '1';
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
				echo true;
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
				echo true;
			}
		}
		 
		 function customviewmore($viewMoreType){
			global $loguser;
			global $setngs;
			global $siteChanges;
			$this->layout = 'frontlayout';
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
		 				
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$itemStatus['Item.status <>'] = 'draft';
			}else{
				$itemStatus['Item.status'] ='publish';
			}
			
			switch($viewMoreType){
				case 'recent':
					$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
							'order'=>'Item.id DESC','limit'=>'20'));
					$this->set('pagetitle','Recently Added');
					break;
				case 'popular':
					$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
							'order'=>'Item.fav_count DESC','limit'=>'20'));
					$this->set('pagetitle','Most Popular');
					break;
				case 'commented':
					$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
							'order'=>'Item.comment_count DESC','limit'=>'20'));
					$this->set('pagetitle','Most Commented');
					break;
				case 'featured':
					$itemStatus['Item.featured'] ='1';
					$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
							'order'=>'Item.id DESC','limit'=>'20'));
					$this->set('pagetitle','Featured');
					break;
			}
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_data',$itemModel);
			$this->set('userid',$userid);
			$this->set('loguser',$loguser);
			$this->set('items_list_data',$items_list_data);
			$this->set('setngs',$setngs);
			$this->set('viewType',$viewMoreType);
		 }
		 
		 function getviewmore(){
		 	global $username;
		 	global $user_level;
		 	global $loguser;
		 	global $setngs;
		 	global $siteChanges;
		 	$startIndex = $_GET['startIndex'];
		 	$offset = $_GET['offset'];
		 	$viewMoreType = $_GET['viewmoretype'];
		 		
		 	$roundProf = "";
		 	if ($siteChanges['profile_image_view'] == "round") {
		 		$roundProf = "border-radius:40px;";
		 	}
		 	$userid = $loguser[0]['User']['id'];
		 	
		 	if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
		 		$itemStatus['Item.status <>'] = 'draft';
		 	}else{
		 		$itemStatus['Item.status'] ='publish';
		 	}
		 		
		 	switch($viewMoreType){
		 		case 'recent':
		 			$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
		 				'order'=>'Item.id DESC','limit'=>$offset,'offset'=>$startIndex));
		 			break;
		 		case 'popular':
		 			$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
		 				'order'=>'Item.fav_count DESC','limit'=>$offset,'offset'=>$startIndex));
		 			break;
		 		case 'commented':
		 			$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
		 				'order'=>'Item.comment_count DESC','limit'=>$offset,'offset'=>$startIndex));
		 			break;
		 		case 'featured':
		 			$itemStatus['Item.featured'] ='1';
		 			$itemModel = $this->Item->find('all',array('conditions'=>$itemStatus,
		 					'order'=>'Item.id DESC','limit'=>$offset,'offset'=>$startIndex));
		 			break;
		 	}
			$this->set('items_data',$itemModel);
			$this->set('roundProf',$roundProf);
		 	
		 }
		
/// sathish for delete addded item ////
		function deleteadditem(){
			$itemId = $_REQUEST['addid'];
		
			$this->loadModel('Photo');
			$this->loadModel('Shiping');
			$this->loadModel('Itemfav');
			$this->loadModel('Comment');
			$this->loadModel('Log');
			$this->loadModel('Shop');
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('Wantownit');
			
				
			/* if (is_dir(WEBROOT_PATH.'media')) {
				echo "got it";
				echo unlink(dirname('http://hitasoft.com/primemo/').'fo.ctp');
				die();
			}else {
				echo "unknown ".BASE_PATH." ".SITE_URL;die();
			} */
			
			if($itemId != null) {				
				$fileName = $this->Photo->find('all',array('conditions'=>array('item_id'=>$itemId)));
				$original = true;$thumb70 = true;$thumb150 = true;$thumb350 = true;
				if ($_SESSION['media_url'] == SITE_URL) {
					foreach ($fileName as $name) {
						$fname = $name['Photo']['image_name'];
						if ($original == true && $thumb70 == true && $thumb150 == true && $thumb350 == true ) {
							$original = unlink(WEBROOT_PATH.'media/items/original/'.$fname);
							$thumb70 = unlink(WEBROOT_PATH.'media/items/thumb70/'.$fname);
							$thumb150 = unlink(WEBROOT_PATH.'media/items/thumb150/'.$fname);
							$thumb350 = unlink(WEBROOT_PATH.'media/items/thumb350/'.$fname);
						} else {
							echo 'false';
							return;
						}
					}
				}else {
					foreach ($fileName as $name) {
						$fname = $name['Photo']['image_name'];
						if ($original == true && $thumb70 == true && $thumb150 == true && $thumb350 == true ) {
							$original = unlink(WEBROOT_PATH.'media/items/original/'.$fname);
							$thumb70 = unlink(WEBROOT_PATH.'media/items/thumb70/'.$fname);
							$thumb150 = unlink(WEBROOT_PATH.'media/items/thumb150/'.$fname);
							$thumb350 = unlink(WEBROOT_PATH.'media/items/thumb350/'.$fname);
						} else {
							echo 'false';
							//return;
						}
					}
				}
				/* $this->Item->delete($itemId);
				$this->Photo->deleteAll(array('item_id' => $itemId), false);
				$this->Shiping->deleteAll(array('item_id' => $itemId), false);
				$this->Itemfav->deleteAll(array('item_id' => $itemId), false);
				$this->Comment->deleteAll(array('item_id' => $itemId), false);
				$this->Log->deleteAll(array('Log.notification_id' => $itemId,'Log.type' => 'additem'));
				 */
				
				$prefix = $this->Item->tablePrefix;
				$this->Item->query("DELETE FROM ".$prefix."items WHERE id = $itemId");
				$this->Photo->query("DELETE FROM ".$prefix."photos WHERE item_id = $itemId");
				$this->Shiping->query("DELETE FROM ".$prefix."shipings WHERE item_id = $itemId");
				$this->Itemfav->query("DELETE FROM ".$prefix."itemfavs WHERE item_id = $itemId");
				$this->Comment->query("DELETE FROM ".$prefix."comments WHERE item_id = $itemId");
				$this->Log->query("DELETE FROM ".$prefix."logs WHERE notification_id = $itemId");
				$this->Wantownit->deleteAll(array('itemid' => $itemId));
				
				$itemcount = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userId,'Item.status'=>'publish')));
				$this->Shop->updateAll(array('item_count' => "'$itemcount'"), array('user_id' => $userId));
				
				$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array('itemid'=>
						$itemId)));
				foreach ($contactsellerModel as $contactseller){
					$csid = $contactseller['Contactseller']['id'];
					$this->Contactseller->deleteAll(array('id' => $csid));
					//$this->Contactseller->query("DELETE FROM ".$prefix."contactsellers WHERE id = $csid");
					$this->Contactsellermsg->deleteAll(array('contactsellerid' => $csid));
					//$this->Contactsellermsg->query("DELETE FROM ".$prefix."contactsellermsgs WHERE contactsellerid = $csid");
				}
			}
				
			die;
		}
/// sathish ended the delete added item ///		
		function editcommentsave(){
			
			$cmtid = $_REQUEST['cmtid'];	
			$cmntval = $_REQUEST['cmntval'];
			//echo 	$cmntval;
			$this->request->data['Comment']['id'] = $cmtid;
			echo $this->request->data['Comment']['comments'] = $cmntval;
			$this->Comment->save($this->request->data);
			die;
		}
		
		
		
		public function viewitemdesc($itemId = null) {
			//echo "$itemId";die;
			$this->loadModel('Item');
			$item_datas = $this->Item->findById($itemId);
			$this->set('item_datas',$item_datas);
		}
		
		
		public function logs($type=NULL,$itemId=NULL,$userId=NULL,$followId=NULL) {
		
			//cho $type;die;
			$this->loadModel('Log');
			$this->request->data['Log']['type'] = $type;
			$this->request->data['Log']['notification_id'] = $itemId;
			$this->request->data['Log']['user_id'] = $userId;
			$this->request->data['Log']['follow_id'] = $followId;
			//$this->request->data['Log']['follower_id'] = $follwersId;
			$this->request->data['Log']['cdate'] = time();
		
			//echo "<pre>";print_r($this->request->data);die;
		
			$this->Log->save($this->request->data);
		
			return true;
				
		}
		
		
		
		
		public function create_giftcard() {
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'frontlayout';
			$this->set('title_for_layout',' - Gift Card');
			global $loguser;
			global $siteChanges;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Giftcard');
			$this->loadModel('Sitesetting');
			$userId = $loguser[0]['User']['id'];
			
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'giftcard')));
			$this->set('banner_datas',$banner_datas);			
			
			if(!empty($this->request->data)){
				$this->Giftcard->create();
				$this->request->data['Giftcard']['user_id'] = $userId;
				$this->request->data['Giftcard']['reciptent_name'] = $this->request->data['recipient_name'];
				$this->request->data['Giftcard']['reciptent_email'] = $this->request->data['recipient_email'];
				$this->request->data['Giftcard']['message'] = $this->request->data['message'];
				$this->request->data['Giftcard']['amount'] = $this->request->data['giftamt'];
				$this->request->data['Giftcard']['avail_amount'] = $this->request->data['giftamt'];
				$this->request->data['Giftcard']['status'] = 'Pending';
				$this->request->data['Giftcard']['cdate'] = time();
				$this->Giftcard->save($this->request->data);
				$this->redirect('/cart/');
			}else{
				$this->loadModel('Comment');
				
				$commentss_item = $this->Comment->find('all',array('conditions'=>array('Comment.item_id'=>0),'order'=>array('Comment.id'=>'desc'),'group'=>array('Comment.id')));
					
				$giftDetails = $this->Sitesetting->find('first');
			
				$this->set('item_datas',json_decode($giftDetails['Sitesetting']['giftcard'],true));
			
				if(isset($userId)){
					$usershipping = $this->User->findByid($userId);
				}else{
					$usershipping = '';
				}
				
				
				
				$this->set('roundProf',$siteChanges['profile_image_view']);
				$this->set('userid',$userId);
				$this->set('commentss_item',$commentss_item);
				$this->set('usershipping',$usershipping);
			}
		}
		
		
		function ggdelete($id){
			$this->layout = 'ajax';
			$this->autoRender = false;
			global $loguser;
			$this->loadModel('Groupgiftuserdetail');
			
			$this->Groupgiftuserdetail->deleteAll(array('Groupgiftuserdetail.id' => $id), false);
		}
		
		
		
		function ggusersave(){
			$this->layout = 'ajax';
			$this->autoRender = false;
			global $loguser;
			$this->loadModel('Groupgiftuserdetail');
			$this->loadModel('Item');
			$name = $_GET['name'];
			$recipient = $_GET['recipient'];
			$address1 = $_GET['address1'];
			$address2 = $_GET['address2'];
			$country = $_GET['country'];
			$state = $_GET['state'];
			$city = $_GET['city'];
			$zipcode = $_GET['zipcode'];
			$telephone = $_GET['telephone'];
			$image = $_GET['image'];
			$item_id = $_GET['item_id'];
			$size = $_GET['size'];
			$quantity = $_GET['qty'];
			$lastestidgg = $_GET['lastestidgg'];
			$userId = $loguser[0]['User']['id'];
				
			$this->request->data['Groupgiftuserdetail']['user_id'] = $userId;
			$this->request->data['Groupgiftuserdetail']['item_id'] = $item_id;
			$this->request->data['Groupgiftuserdetail']['recipient'] = $recipient;
			$this->request->data['Groupgiftuserdetail']['name'] = $name;
			$this->request->data['Groupgiftuserdetail']['address1'] = $address1;
			$this->request->data['Groupgiftuserdetail']['address2'] = $address2;
			$this->request->data['Groupgiftuserdetail']['country'] = $country;
			$this->request->data['Groupgiftuserdetail']['state'] = $state;
			$this->request->data['Groupgiftuserdetail']['city'] = $city;
			$this->request->data['Groupgiftuserdetail']['zipcode'] = $zipcode;
			$this->request->data['Groupgiftuserdetail']['telephone'] = $telephone;
			$this->request->data['Groupgiftuserdetail']['image'] = $image;
			$this->request->data['Groupgiftuserdetail']['c_date'] = time();
			$this->request->data['Groupgiftuserdetail']['status'] = 'Active';
			//$this->request->data['Giftcard']['cdate'] = time();
			if ($lastestidgg == '' || empty($lastestidgg)){
				$this->Groupgiftuserdetail->save($this->request->data);
				$lasttId = $this->Groupgiftuserdetail->getLastInsertID();
			}else{
				$this->request->data['Groupgiftuserdetail']['id'] = $lastestidgg;
				$this->Groupgiftuserdetail->save($this->request->data);
				$lasttId = $lastestidgg;
			}
			//echo $lasttId;die;
			$item_datas = $this->Item->findById($item_id);
				
			foreach($item_datas['Shiping'] as $shpng){
				$shpngs[$shpng['country_id']] = $shpng['primary_cost'];
			}
				
			if (isset($shpngs[$country])) {
				$shipping_amt = $shpngs[$country];
			}else if(isset($shpngs[0])){
				$shipping_amt = $shpngs[0];
			}
				
			//echo "<pre>";print_r($shpngs);
			//echo "<pre>";print_r($item_datas['Item']['price']);
			//echo "<pre>";print_r($shipping_amt);die;
				
			$this->request->data['Groupgiftuserdetail']['id'] = $lasttId;
			$this->request->data['Groupgiftuserdetail']['itemcost'] = $item_datas['Item']['price'];
			if ($size != 'null'){
				$this->request->data['Groupgiftuserdetail']['itemsize'] = $size;
			}else{
				$this->request->data['Groupgiftuserdetail']['itemsize'] = '';
			}
			$this->request->data['Groupgiftuserdetail']['itemquantity'] = $quantity;
			$this->request->data['Groupgiftuserdetail']['shipcost'] = $shipping_amt;
			$totals_amt = ($item_datas['Item']['price'] * $quantity) + $shipping_amt;
			$this->request->data['Groupgiftuserdetail']['total_amt'] = $totals_amt;
			$this->request->data['Groupgiftuserdetail']['balance_amt'] = $totals_amt;
			$this->Groupgiftuserdetail->save($this->request->data);
				
				
				
			//$shippin_amtt = $shipping_amt + $totals_amt;
			echo $lasttId.','.$shipping_amt.','.($item_datas['Item']['price'] * $quantity).','.$totals_amt;
				
			die;
				
		}
		
		
		function groupgiftreason() {
			$this->layout = 'ajax';
			$this->autoRender = false;
			$this->loadModel('Groupgiftuserdetail');
				
			$title = $_GET['title'];
			$description = $_GET['description'];
			$notes = $_GET['notes'];
			$lastestidgg = $_GET['lastestidgg'];
				
			$this->request->data['Groupgiftuserdetail']['id'] = $lastestidgg;
			$this->request->data['Groupgiftuserdetail']['title'] = $title;
			$this->request->data['Groupgiftuserdetail']['description'] = $description;
			$this->request->data['Groupgiftuserdetail']['notes'] = $notes;
			$this->Groupgiftuserdetail->save($this->request->data);
			//$lasttId = $this->Groupgiftuserdetail->getLastInsertID();
				
		}
		
		function groupgifts() {
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'frontlayout';
			$this->set('title_for_layout',' - Group Gift');
		
		}
		
		function gglists() {
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'frontlayout';
			$this->set('title_for_layout',' - Group Gift');
			$this->loadModel('Groupgiftuserdetail');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$gglistsData = $this->Groupgiftuserdetail->find('all',array('conditions'=>array('user_id'=>$userid),'order'=>array('Groupgiftuserdetail.id'=>'desc')));
			//echo "<pre>";print_r($gglistsData);die;
		
			$this->set('gglistdatas',$gglistsData);
		}
		
		function gifts($id=NULL) {
			//if(!$this->isauthenticated())
				//$this->redirect('/');
			$this->layout = 'frontlayout';
			$this->set('title_for_layout',' - Group Gift');
			
			$this->loadModel('Groupgiftuserdetail');
			$this->loadModel('Groupgiftpayamt');
			$this->loadModel('Country');
			$this->loadModel('Item');
			$this->loadModel('User');
			global $loguser;
			global $siteChanges;
			//print_r($loguser);
			//$userid = $loguser[0]['User']['id'];
			if (!isset($loguser) || empty($loguser)){
				$this->set('currentUser', 0);
			}else{
				$this->set('currentUser', $loguser[0]['User']['id']);
			}
			$items_list_data = $this->Groupgiftuserdetail->findById($id);
			
			
			$ggAmtDatas = $this->Groupgiftpayamt->find('all',array('conditions'=>array('ggid'=>$id)));
			//echo "<pre>";print_r($ggAmtDatas);die;
			//$paidamt = array();
			foreach($ggAmtDatas as $ggAmtData){
				$paidamt += $ggAmtData['Groupgiftpayamt']['amount'];
				$paidUserId[] = $ggAmtData['Groupgiftpayamt']['paiduser_id'];
			}
			//echo count($paidUserId);die;
			//echo "<pre>";print_r($items_list_data);die;
			if(empty($items_list_data)){
				$this->redirect('/');
			}
			$ItemId = $items_list_data['Groupgiftuserdetail']['item_id'];
			$userId = $items_list_data['Groupgiftuserdetail']['user_id'];
			$countryId = $items_list_data['Groupgiftuserdetail']['country'];
				
			$countrys_list_data = $this->Country->findById($countryId);
			
			$item_datas = $this->Item->findById($ItemId);
				
			$createuserDetails = $this->User->findById($userId);
			
		
			$this->set('item_datas',$item_datas);
			$this->set('createuserDetails',$createuserDetails);
			$this->set('items_list_data',$items_list_data);
			$this->set('countrys_list_data',$countrys_list_data);
			$this->set('paidamt',$paidamt);
			$this->set('paidUserId',$paidUserId);
			$this->set('ggAmtDatas',$ggAmtDatas);
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('fbapp_id',FB_ID);
			$this->set('fbtitle',SITE_NAME." Group Gift Share");
			$this->set('fbdescription',"Contribution Request from your friend");
			$this->set('fbtype',"photo");
			$this->set('fburl',SITE_URL."gifts/".$items_list_data['Groupgiftuserdetail']['id']);
			$this->set('fbimage',$_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name']);
		
		}
		
		function ggcronjob() {
			$this->layout = 'ajax';
			$this->autoRender = false;
			$this->loadModel('Groupgiftuserdetail');
			$this->loadModel('Groupgiftpayamt');
			$this->loadModel('User');
			$this->loadModel('Userinvitecredit');
			$gglistsDatas = $this->Groupgiftuserdetail->find('all',array('conditions'=>array('status'=>'Active')));
			
			foreach($gglistsDatas as $gglistsData){
				$cdategg = $gglistsData['Groupgiftuserdetail']['c_date'];
				$ggId = $gglistsData['Groupgiftuserdetail']['id'];
				$ggEnddate = $cdategg + 604800;
				
				
				if($ggEnddate < time()){
					$ggPaidUser = $this->Groupgiftpayamt->find('all',array('conditions'=>array('ggid'=>$ggId)));
					foreach($ggPaidUser as $ggrefund ){
						$amount = $ggrefund['Groupgiftpayamt']['amount'];
						$userId = $ggrefund['Groupgiftpayamt']['paiduser_id'];
						$userDetals = $this->User->findById($userId);
						$creAmount = $userDetals['User']['credit_total'];
						$creAmount  = $creAmount + $amount;
						$this->User->updateAll(array('User.credit_total' =>"'$creAmount'"), array('User.id' => $userId));
						
						$this->Userinvitecredit->create();
						$this->request->data['Userinvitecredit']['user_id'] = '0';
						$this->request->data['Userinvitecredit']['invited_friend'] = $userId;
						$this->request->data['Userinvitecredit']['credit_amount'] = $amount;
						$this->request->data['Userinvitecredit']['status'] = "NotUsed";
						$this->request->data['Userinvitecredit']['cdate'] = time();
						$this->Userinvitecredit->save($this->request->data);
					
					}
					
				$this->Groupgiftuserdetail->updateAll(array('Groupgiftuserdetail.status' =>"'Expired'"), array('Groupgiftuserdetail.id' => $ggId));
						
				}
			}
		
		}
		
		
		function editselleritem($id){
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','Edit Item');
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Item');
			$this->loadModel('USer');
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Country');
			$this->loadModel('Recipient');
			
			$this->loadModel('Color');
			$color_datas = $this->Color->find('all');
			$this->set('color_datas',$color_datas);						
				
			if (isset($this->request->data['Item'])){
				//echo "<pre>";print_r($this->request->data);die;
		
				$itemModel = $this->Item->findByid($id);
		
				//print_r($itemModel);die;
		
				$this->request->data['Item']['id'] = $id;
				$this->loadModel('Shop');
				$this->loadModel('Item');
				for($i=0;$i<1;$i++){
					if(!empty($this->request->data['image'][$i])){
						$imgName = $_SESSION['media_url'].'media/items/original/'.$this->request->data['image'][$i];
						$result = ColorCompareComponent::compare(5, $imgName);
					}
				}
					
				$this->request->data['Item']['user_id'] = $itemModel['User']['id'];
				$this->request->data['Item']['shop_id'] = $itemModel['Shop']['id'];
				$title = $this->request->data['Item']['item_title'] = $this->request->data['Item']['item_title'];
				$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
				$this->request->data['Item']['item_description'] = $this->request->data['Item']['item_description'];
				$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
				$this->request->data['Item']['delivery_type'] = $this->request->data['deltype'];
					
				if(!empty($this->request->data['recipient'])){
					$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
				}else{
					$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
				}
				
				$this->request->data['Item']['videourrl'] = $this->request->data['listing']['videourrl'];
				
				$this->request->data['Item']['price'] = $this->request->data['listing']['price'];
				$this->request->data['Item']['quantity'] = $this->request->data['listing']['quantity'];
				$sizeOption = $this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
				$sizeQty = 0;
				if ($sizeOption != ''){
					$sizeOption = explode(",",$sizeOption);
					foreach ($sizeOption as $size){
						$singleSize = explode("=", $size);
						$sizeQty += $singleSize[1];
					}
					$this->request->data['Item']['quantity'] = $sizeQty;
				}
				$this->request->data['Item']['category_id'] = $this->request->data['Item']['category_id'];
				$this->request->data['Item']['super_catid'] = $this->request->data['Item']['supersubcat'];
				$this->request->data['Item']['sub_catid'] = $this->request->data['Item']['subcat'];
				$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
				$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
				if($processing_time_id == 'custom'){
					$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
					$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
					$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
				}
				
			$color_method = $this->request->data['colormethod'];
			if($color_method=="auto")
			{
				$result = json_encode($result);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '0';
			}
			else
			{
				$result = json_encode($this->request->data['itemcolor']);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '1';
			}						
				
				$this->request->data['Item']['modified_on'] = date("Y-m-d H:i:s");
				$this->request->data['Item']['status'] = 'draft';
				//$this->request->data['Item']['item_color'] = json_encode($result);
					
				//echo "<pre>";print_r($this->request->data['Item']);die;
					
				$this->Item->save($this->request->data);
					
				$last_id = $id;
					
				$this->loadModel('Photo');
				$count = 0;
				foreach ($itemModel['Photo'] as $photo){
					if(!empty($this->request->data['image'][$count])){
						$imageName = $photo['image_name'];
						if ($imageName == $this->request->data['image'][$count]){
							$count += 1;
						}else {
							$this->request->data['Photo']['image_name'] = $this->request->data['image'][$count];
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->request->data['Photo']['id'] = $photo['id'];
							$this->Photo->save($this->request->data);
							$count += 1;
						}
					}elseif($this->request->data['image'][$count] == ""){
						$this->Photo->deleteAll(array('id' => $photo['id']), false);
						$count += 1;
					}
				}
				for($i=$count;$i<5;$i++){
					$this->Photo->create();
					// echo $this->request->data['image'][$i];
					if(!empty($this->request->data['image'][$i])){
						$this->request->data['Photo']['item_id'] = $last_id;
						$this->request->data['Photo']['image_name'] = $this->request->data['image'][$i];
						$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
						// echo "<pre>";print_r($this->request->data['Photo']);die;
						$this->Photo->save($this->request->data);
					}
				}
					
					
				$this->loadModel('Shiping');
				if(!empty($_REQUEST['country_shipping'])){
					foreach($_REQUEST['country_shipping'] as $kys=>$shpngcntry){
						// echo "<pre>";print_r($kys);
						// echo "<pre>";print_r($shpngcntry);
						foreach($shpngcntry as $shps){
							//echo "<pre>";print_r($shps);
							$shipModel = $this->Shiping->find('all',array('conditions'=>array('Shiping.country_id'=>$kys,'Shiping.item_id'=>$last_id)));
								
							$primaryCost = $shps['primary'];
							if (empty($shipModel) && $primaryCost != '') {
								$this->Shiping->create();
								$this->request->data['Shiping']['item_id'] = $last_id;
								$this->request->data['Shiping']['country_id'] = $kys;
								$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
								//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
								$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
								$this->Shiping->save($this->request->data);
								$updatedCountryId[] = $kys;
							}elseif($shipModel[0]['Shiping']['country_id'] != 0 && $primaryCost != '') {
								if ($shps['primary'] != $shipModel[0]['Shiping']['primary_cost']){
									$this->request->data['Shiping']['id'] = $shipModel[0]['Shiping']['id'];
									$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
									$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
									$this->Shiping->save($this->request->data);
								}
								$updatedCountryId[] = $kys;
							}
						}
					}
				}
		
				if(!empty($_REQUEST['everywhere_shipping'])){
					$primaryCost = $_REQUEST['everywhere_shipping'][1]['primary'];
					$shipModel = $this->Shiping->find('all',array('conditions'=>array('Shiping.country_id'=>'0','Shiping.item_id'=>$last_id)));
					//echo "<pre>";print_r($shipModel[0]);
					if(empty($shipModel) && $primaryCost != ''){
						$this->Shiping->create();
						$this->request->data['Shiping']['item_id'] = $last_id;
						$this->request->data['Shiping']['country_id'] = 0;
						$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
						//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
						$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
		
						$this->Shiping->save($this->request->data);
						$updatedCountryId[] = 0;
					}else{
						//echo $primaryCost;die;
						$newCost = $_REQUEST['everywhere_shipping'][1]['primary'];
						$oldCost = $shipModel[0]['Shiping']['primary_cost'];
						if ($newCost != $oldCost && $primaryCost != ''){
							$this->request->data['Shiping']['id'] = $shipModel[0]['Shiping']['id'];
							$this->request->data['Shiping']['country_id'] = 0;
							$this->request->data['Shiping']['primary_cost'] = $newCost;
							$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
							$this->Shiping->save($this->request->data);
						}
						$updatedCountryId[] = 0;
					}
				}
		
				if (count($updatedCountryId) > 0){
					$shipModel = $this->Shiping->find('all',array(
							'conditions'=>array(
									'Shiping.item_id'=>$last_id,
									'NOT' => array(
											'Shiping.country_id' => $updatedCountryId
									)
							)
					));
						
					if(!empty($shipModel)){
						foreach($shipModel as $ship){
							$this->Shiping->deleteAll(array('id' => $ship['Shiping']['id']), false);
						}
					}
				}
		
				//$email_address = $this->User->find("all",array("conditions"=>array('User.username'=>'Admin')));
				$emailaddress = $setngs[0]['Sitesetting']['notification_email'];	
				
				$user_name = $this->User->find('all',array('conditions'=>array('User.id'=>$userid)));
				$username = $user_name[0]['User']['username'];	
				
				$item_name = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id)));
				$itemname = $item_name[0]['Item']['item_title'];	
				$quantity = $item_name[0]['Item']['quantity'];
				$itemprice = $item_name[0]['Item']['price'];
				$sizeoptions = $item_name[0]['Item']['size_options'];	
					
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
				$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Item Approval Request";
				$this->Email->from = $setngs[0]['Sitesetting']['noreply_email'];
				$this->Email->sendAs = "html";
				$this->Email->template = 'edititemadded';		
				$this->set('name', $name);
				$this->set('urlname', $urlname);
				$this->set('email', $emailaddress);
				$this->set('username',$username);
				$this->set('itemname',$itemname);
				$this->set('quantity',$quantity);
				$this->set('itemprice',$itemprice);
				$this->set('sizeoptions',$sizeoptions);		
				$this->set('access_url',SITE_URL."login");
				
				$this->Email->send();    		
					
				$this->redirect('/');
			}
				
			$itemModel = $this->Item->findByid($id);
			$cat_datas = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			$superSub_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>$itemModel['Item']['category_id'],'category_sub_parent'=>0)));
			$Sub_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>$itemModel['Item']['category_id'],'category_sub_parent'=>$itemModel['Item']['super_catid'])));
			$rcpnt_datas = $this->Recipient->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('recipient_name'=>'asc')));
				
			foreach ($itemModel['Shiping'] as $ship){
				$shipingId[]  = $ship['country_id'];
				$cntryid = $ship['country_id'];
			}
			$countries = $this->Country->find('all');
			$CountryModel = $this->Country->find('all',array('conditions'=>array('id'=>$shipingId)));
			//$country_datas = $this->Country->find('all',array('order'=>array('country'=>'asc')));
			
			foreach($CountryModel as $country){
				$countryName[$country['Country']['id']] = $country['Country']['country'];
			}
				
			$this->set('item',$itemModel);
			$this->set('cat_datas',$cat_datas);
			$this->set('superSub_datas',$superSub_data);
			$this->set('Sub_datas',$Sub_data);
			$this->set('rcpnt_datas',$rcpnt_datas);
			$this->set('countryName',$countryName);
			$this->set('cntry',$countries);
			$this->set('cntryid',$cntryid);
			$this->set('itemId',$id);
		}
		
		function contactsellersubject(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Manage Subjects');
			$this->loadModel('Sitequeries');
			
			$subject_data = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
					'contact_seller')));
			
			//$item_datas = $this->Item->find('all');
			
			$this->set('subject_data',$subject_data);
			$this->set('pagecount',$pagecount);
		}
		
		function addcssubject($id = NULL){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->set('title_for_layout','Add Subject');
			$this->loadModel('Sitequeries');
			
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'contact_seller')));
				if (!empty($sitequeriesModel)){
					$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
					if ($id == NULL){
						$queries[] = $this->request->data['cssubject']['Subject'];
					}else{
						$queries[$id] = $this->request->data['cssubject']['Subject'];
					}
					$this->request->data['Sitequeries']['id'] = $sitequeriesModel['Sitequeries']['id'];
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}else{
					$queries[] = $this->request->data['cssubject']['Subject'];
					$this->request->data['Sitequeries']['type'] = 'contact_seller';
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}
				$this->Sitequeries->save($this->request->data);
			
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/manage/contactsellersubject');
			}
			
			if ($id != NULL){
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'contact_seller')));
				$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
				
				$this->set('query',$queries[$id]);
			}else{
				$this->set('query','');
			}
			$this->set('id',$id);
				
		}
		
		function deletecssubject($id){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->loadModel('Sitequeries');
			$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
					'contact_seller')));
			$csqueries = array();
			if (!empty($sitequeriesModel)){
				$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
				foreach ($queries as $qkey => $query){
					if ($id != $qkey){
						$csqueries[] = $query;
					}
				}
				$this->request->data['Sitequeries']['id'] = $sitequeriesModel['Sitequeries']['id'];
				$this->request->data['Sitequeries']['queries'] = json_encode($csqueries);
				$this->Sitequeries->save($this->request->data);
				$this->Session->setFlash('Deleted Successfully');
			}else{
				$this->Session->setFlash('Subject Not Found');
			}
			$this->redirect('/admin/manage/contactsellersubject');
		}
		
		function contacteditem(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->set('title_for_layout','Item Chat Management');
			$this->loadModel('Contactseller');
			
			//$contactsellerModel = $this->Contactseller->find('all',array('group' => array('itemid'),
					//'order'=>'lastmodified DESC', 'limit'=>'5'));
				
			$this->paginate =  array('fields'=>array('count(itemid) as count,id,itemid,sellername,subject,itemname'),
					'limit'=>10, 'group' => array('itemid'));
				
				
			$item_datas = $this->paginate('Contactseller');
			$pagecount = $this->params['paging']['Contactseller']['count'];
				
			//echo "<pre>";print_r($item_datas);
			
			$this->set('item_datas',$item_datas);
			$this->set('pagecount',$pagecount);
		}
		
		function itemconversation($itemid){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->set('title_for_layout','Item Conversation');
			$this->loadModel('Contactseller');
				
			$this->paginate =  array('conditions'=>array('itemid'=>$itemid),'limit'=>10,'order'=>array(
					'id'=>'desc'));
				
				
			$contactsellerModel = $this->paginate('Contactseller');
			$pagecount = $this->params['paging']['Contactseller']['count'];
				
			//$item_datas = $this->Item->find('all');
				
			$this->set('contactsellerModel',$contactsellerModel);
			$this->set('pagecount',$pagecount);
		}
		
		function itemuserconversation($csid,$itemid){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Item Conversation');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('Contactseller');
			
			$contactsellerModel = $this->Contactseller->findByid($csid);
			$csmessageModel = $this->Contactsellermsg->find('all',array('conditions'=>array(
					'contactsellerid'=>$csid)));
			
			$this->set('csid',$csid);
			$this->set('itemid',$itemid);
			$this->set('csmessageModel',$csmessageModel);
			$this->set('contactsellerModel',$contactsellerModel);
		}
		
		function deletecsconversation($csid, $itemid){
			if(!$this->isauthenticated())
				$this->redirect('/');
			
			global $setngs;
			global $loguser;
			$this->autoLayout = false;
			$this->autoRender = false;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			
			$this->Contactseller->deleteAll(array('id' => $csid));
			$this->Contactsellermsg->deleteAll(array('contactsellerid' => $csid));
			
			$this->Session->setFlash('Conversation Deleted');
			$this->redirect('/admin/itemconversation/'.$itemid);
		}
		
		function searchmsg(){
			if(!$this->isauthenticated())
				$this->redirect('/');
			
			global $setngs;
			global $loguser;
			$this->autoLayout = false;
			$this->autoRender = false;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('User');
			$searchKey = $_POST['searchkey'];
			
			/* $contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array(
					'OR' => array(array('merchantid' => $userid),array('buyerid' => $userid)),
					'OR' => array(array('subject LIKE' => $searchKey."%"),array('itemname LIKE' => $searchKey."%"),
							array('buyername LIKE' => $searchKey."%"),array('sellername LIKE' => $searchKey."%"))),
					'order'=>'lastmodified DESC', 'limit'=>'5')); */
			$contactsellerModel = $this->Contactseller->find('all',array('fields'=>array('id'),
					'conditions'=>array('OR' => array(array('merchantid' => $userid),array('buyerid' => 
					$userid))), 'order'=>'lastmodified DESC'));
			foreach($contactsellerModel as $contactseller){
				$searchId[] = $contactseller['Contactseller']['id'];
			}
			$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array(
					'id'=>$searchId,
					'OR' => array(array('subject LIKE' => $searchKey."%"),array('itemname LIKE' => $searchKey."%"),
							array('buyername LIKE' => $searchKey."%"),array('sellername LIKE' => $searchKey."%"))),
					'order'=>'lastmodified DESC', 'limit'=>'10'));
			//echo "<pre>";print_r($contactsellerModel);
			$messageModel = array();
			$messageUnread = array();
			foreach ($contactsellerModel as $cskey => $contactseller){
				$csId = $contactseller['Contactseller']['id'];
				$sellerId = $contactseller['Contactseller']['merchantid'];
				$buyerId = $contactseller['Contactseller']['buyerid'];
				$sellerModel = $this->User->findByid($sellerId);
				$buyerModel = $this->User->findByid($buyerId);
					
				$messageModel[$cskey]['csid'] = $csId;
				$messageModel[$cskey]['subject'] = $contactseller['Contactseller']['subject'];
				$messageModel[$cskey]['item'] = $contactseller['Contactseller']['itemname'];
				$messageModel[$cskey]['itemurl'] = $this->Urlfriendly->utils_makeUrlFriendly($contactseller['Contactseller']['itemname']);
				$messageModel[$cskey]['itemid'] = $contactseller['Contactseller']['itemid'];
				if ($contactseller['Contactseller']['lastsent'] == 'buyer'){
					$messageModel[$cskey]['from'] = $buyerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $sellerModel['User']['first_name'];
				}else{
					$messageModel[$cskey]['from'] = $sellerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $buyerModel['User']['first_name'];
				}
					
				if ($buyerId == $userid && $contactseller['Contactseller']['buyerread'] == '1'){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}elseif ($contactseller['Contactseller']['sellerread'] == '1' && $sellerId == $userid){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}else{
					$messageModel[$cskey]['unread'] = 0;
				}
			}
			$offset = 0;
			$this->set('offset',$offset);
			$this->set('messageModel',$messageModel);
			$this->set('messageUnread',$messageUnread);
			$this->render('getmoremessage');
		}
		
		function messages(){
			if(!$this->isauthenticated())
				$this->redirect('/');
			
			global $setngs;
			global $loguser;
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','Messages');
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('User');
			
			$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array(
					'OR' => array(array('merchantid' => $userid),array('buyerid' => $userid))),
					'order'=>'lastmodified DESC', 'limit'=>'10'));
			$messageModel = array();
			$messageUnread = array();
			foreach ($contactsellerModel as $cskey => $contactseller){
				$csId = $contactseller['Contactseller']['id'];
				$sellerId = $contactseller['Contactseller']['merchantid'];
				$buyerId = $contactseller['Contactseller']['buyerid'];
				$sellerModel = $this->User->findByid($sellerId);
				$buyerModel = $this->User->findByid($buyerId);
				
				$messageModel[$cskey]['csid'] = $csId;
				$messageModel[$cskey]['subject'] = $contactseller['Contactseller']['subject'];
				$messageModel[$cskey]['item'] = $contactseller['Contactseller']['itemname'];
				$messageModel[$cskey]['itemurl'] = $this->Urlfriendly->utils_makeUrlFriendly($contactseller['Contactseller']['itemname']);
				$messageModel[$cskey]['itemid'] = $contactseller['Contactseller']['itemid'];
				if ($contactseller['Contactseller']['lastsent'] == 'buyer'){
					$messageModel[$cskey]['from'] = $buyerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $sellerModel['User']['first_name'];
				}else{
					$messageModel[$cskey]['from'] = $sellerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $buyerModel['User']['first_name'];
				}
				
				if ($buyerId == $userid && $contactseller['Contactseller']['buyerread'] == '1'){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}elseif ($contactseller['Contactseller']['sellerread'] == '1' && $sellerId == $userid){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}else{
					$messageModel[$cskey]['unread'] = 0;
				}
			}
				$count = count($messageModel);
				
			//echo "<pre>";print_r($messageModel);die;
			$this->set('messageModel',$messageModel);
			$this->set('messageUnread',$messageUnread);
			$this->set('counts',$count);
		}
		
		function getmoremessage(){
			$this->autoLayout = false;
			global $setngs;
			global $siteChanges;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$offset = $_POST['offset'];
			$searchKey = $_POST['searchkey'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('User');
			
			if ($searchKey == ''){
				$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array(
						'OR' => array(array('merchantid' => $userid),array('buyerid' => $userid))),
						'order'=>'lastmodified DESC', 'offset'=>$offset, 'limit'=>'10'));
			}else{
				$contactsellerModel = $this->Contactseller->find('all',array('conditions'=>array(
						'OR' => array(array('merchantid' => $userid),array('buyerid' => $userid)),
						'OR' => array(array('subject LIKE' => $searchKey."%"),array('itemname LIKE' => $searchKey."%"),
								array('buyername LIKE' => $searchKey."%"),array('sellername LIKE' => $searchKey."%"))),
						'order'=>'lastmodified DESC', 'offset'=>$offset, 'limit'=>'10'));
			}
			$messageModel = array();
			$messageUnread = array();
			foreach ($contactsellerModel as $cskey => $contactseller){
				$csId = $contactseller['Contactseller']['id'];
				$sellerId = $contactseller['Contactseller']['merchantid'];
				$buyerId = $contactseller['Contactseller']['buyerid'];
				$sellerModel = $this->User->findByid($sellerId);
				$buyerModel = $this->User->findByid($buyerId);
			
				$messageModel[$cskey]['csid'] = $csId;
				$messageModel[$cskey]['subject'] = $contactseller['Contactseller']['subject'];
				$messageModel[$cskey]['item'] = $contactseller['Contactseller']['itemname'];
				$messageModel[$cskey]['itemurl'] = $this->Urlfriendly->utils_makeUrlFriendly($contactseller['Contactseller']['itemname']);
				$messageModel[$cskey]['itemid'] = $contactseller['Contactseller']['itemid'];
				if ($contactseller['Contactseller']['lastsent'] == 'buyer'){
					$messageModel[$cskey]['from'] = $buyerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $sellerModel['User']['first_name'];
				}else{
					$messageModel[$cskey]['from'] = $sellerModel['User']['first_name'];
					$messageModel[$cskey]['to'] = $buyerModel['User']['first_name'];
				}
			
				if ($buyerId == $userid && $contactseller['Contactseller']['buyerread'] == '1'){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}elseif ($contactseller['Contactseller']['sellerread'] == '1' && $sellerId == $userid){
					$messageModel[$cskey]['unread'] = 1;
					$messageUnread[] = $cskey;
				}else{
					$messageModel[$cskey]['unread'] = 0;
				}
			}
			//echo "<pre>";print_r($messageModel);die;
			$this->set('offset',$offset);
			$this->set('messageModel',$messageModel);
			$this->set('messageUnread',$messageUnread);
		}
		
		function viewmessage($id){
			if(!$this->isauthenticated())
				$this->redirect('/');
			
			global $setngs;
			global $siteChanges;
			global $loguser;
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','Messages');
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('User');
			
			$contactsellerModel = $this->Contactseller->findByid($id);
			if(empty($contactsellerModel)){
				$this->Session->setFlash('No Conversation Found');
				$this->redirect('/messages/');
			}
			$csmessageModel = $this->Contactsellermsg->find('all',array('conditions'=>array(
					'contactsellerid'=>$id), 'order'=>'id DESC', 'limit'=>6));
			if ($contactsellerModel['Contactseller']['buyerid'] == $userid){
				$buyerModel = $this->User->findByid($contactsellerModel['Contactseller']['merchantid']);
				$merchantModel = $this->User->findByid($contactsellerModel['Contactseller']['buyerid']);
				$currentUser = "buyer";
				if ($contactsellerModel['Contactseller']['buyerread'] == 1){
					$_SESSION['userMessageCount'] = $_SESSION['userMessageCount'] - 1;
				}
				
				$this->request->data['Contactseller']['buyerread'] = 0;
			}else{
				$buyerModel = $this->User->findByid($contactsellerModel['Contactseller']['buyerid']);
				$merchantModel = $this->User->findByid($contactsellerModel['Contactseller']['merchantid']);
				$currentUser = "seller";
				if ($contactsellerModel['Contactseller']['sellerread'] == 1){
					$_SESSION['userMessageCount'] = $_SESSION['userMessageCount'] - 1;
				}
				
				$this->request->data['Contactseller']['sellerread'] = 0;
			}
			$this->request->data['Contactseller']['id'] = $id;
			$this->Contactseller->save($this->request->data);
			
			$itemDetails['item'] = $contactsellerModel['Contactseller']['itemname'];
			$itemDetails['itemurl'] = $this->Urlfriendly->utils_makeUrlFriendly($contactsellerModel['Contactseller']['itemname']);
			$itemDetails['itemid'] = $contactsellerModel['Contactseller']['itemid'];
			
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('contactsellerModel',$contactsellerModel);
			$this->set('csmessageModel',$csmessageModel);
			$this->set('buyerModel',$buyerModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('itemDetails',$itemDetails);
			$this->set('currentUser',$currentUser);
		}
		
		function getmoreviewmessage(){
			$this->autoLayout = false;
			global $setngs;
			global $siteChanges;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			$this->loadModel('User');
			
			$offset = $_POST['offset'];
			$currentUser = $_POST['contact'];
			$csid = $_POST['csid'];
			
			$contactsellerModel = $this->Contactseller->findByid($csid);
			$csmessageModel = $this->Contactsellermsg->find('all',array('conditions'=>array(
					'contactsellerid'=>$csid), 'order'=>'id DESC', 'offset'=>$offset, 'limit'=>5));
			if ($contactsellerModel['Contactseller']['buyerid'] == $userid){
				$buyerModel = $this->User->findByid($contactsellerModel['Contactseller']['merchantid']);
				$merchantModel = $this->User->findByid($contactsellerModel['Contactseller']['buyerid']);
			}else{
				$buyerModel = $this->User->findByid($contactsellerModel['Contactseller']['buyerid']);
				$merchantModel = $this->User->findByid($contactsellerModel['Contactseller']['merchantid']);
			}
				
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('contactsellerModel',$contactsellerModel);
			$this->set('csmessageModel',$csmessageModel);
			$this->set('buyerModel',$buyerModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('currentUser',$currentUser);
		}
		
		function replymessage(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			global $setngs;	
			global $loguser;		

			$csId = $_POST['csid'];
			$merchantId = $_POST['merchantId'];
			$buyerId = $_POST['buyerId'];
			$sender = $_POST['sender'];
			$message = $_POST['message'];
			$username = $_POST['username'];
			$usrurl = $_POST['usrurl'];
			$usrimg = $_POST['usrimg'];
			$roundProfile = $_POST['roundprofile'];
			$timenow = time();
						
			$this->request->data['Contactseller']['lastsent'] = $sender;
			if ($sender == 'buyer'){
				$this->request->data['Contactseller']['sellerread'] = 1;
			}else{
				$this->request->data['Contactseller']['buyerread'] = 1;
			}
			$this->request->data['Contactseller']['lastmodified'] = time();
			$this->request->data['Contactseller']['id'] = $csId;
			$this->Contactseller->save($this->request->data);
			
			$this->request->data['Contactsellermsg']['contactsellerid'] = $csId;
			$this->request->data['Contactsellermsg']['message'] = $message;
			$this->request->data['Contactsellermsg']['sentby'] = $sender;
			$this->request->data['Contactsellermsg']['createdat'] = $timenow;
			$this->Contactsellermsg->save($this->request->data);
			
			echo '<div class="cmntcontnr">
			<div class="usrimg">
			<a href="'.SITE_URL.'people/'.$usrurl.'" class="url">';
			if(!empty($usrimg)){
				echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$usrimg.'" alt="" class="photo" style="'.$roundProfile.'">';
			}else{
				echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
			}
				
			echo '</a>
        			</div>
        			<div class="cmntdetails">
        				<p class="usrname">
        					<a href="'.SITE_URL.'people/'.$usrurl.'" class="url">'; 
        						echo $username; 
        					echo '</a>
        				</p>
        				<p class="cmntdate">'.date('d,M Y',$timenow).'</p>
        				<p class="comment">'.$message.'</p>
		        			</div>
        				</div>';
        				
			$email_address = $this->User->find("all",array("conditions"=>array('User.id'=>$buyerId)));
			$emailaddress = $email_address[0]['User']['email'];
			$name = $email_address[0]['User']['first_name'];			
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
		$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – You have got a message";
		$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
		$this->Email->sendAs = "html";
		$this->Email->template = 'contactseller';		
		$this->set('name', $name);
		$this->set('urlname', $urlname);
		$this->set('email', $emailaddress);
		$username = $loguser[0]['User']['username'];
		$this->set('username',$username);
		$this->set('sender',$sender);
		$this->set('message',$message);
		$this->set('access_url',SITE_URL."login");
		
		$this->Email->send();        				
        				
		}
		
		function sendmessage(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Contactseller');
			$this->loadModel('Contactsellermsg');
			global $setngs;
			$itemId = $_POST['itemId'];
			$merchantId = $_POST['merchantId'];
			$buyerId = $_POST['buyerId'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$itemName = $_POST['itemName'];
			$username = $_POST['username'];
			$sellername = $_POST['sellername'];
			$sender = $_POST['sender'];
			$timenow = time();
			
			$this->request->data['Contactseller']['itemid'] = $itemId;
			$this->request->data['Contactseller']['merchantid'] = $merchantId;
			$this->request->data['Contactseller']['buyerid'] = $buyerId;
			$this->request->data['Contactseller']['subject'] = $subject;
			$this->request->data['Contactseller']['itemname'] = $itemName;
			$this->request->data['Contactseller']['buyername'] = $username;
			$this->request->data['Contactseller']['sellername'] = $sellername;
			$this->request->data['Contactseller']['lastsent'] = $sender;
			if ($sender == 'buyer'){
				$this->request->data['Contactseller']['sellerread'] = 1;
				$this->request->data['Contactseller']['buyerread'] = 0;
			}else{
				$this->request->data['Contactseller']['sellerread'] = 0;
				$this->request->data['Contactseller']['buyerread'] = 1;
			}
			$this->request->data['Contactseller']['lastmodified'] = $timenow;
			$this->Contactseller->save($this->request->data);
			
			$lastInserId = $this->Contactseller->getLastInsertID();
			
			$this->request->data['Contactsellermsg']['contactsellerid'] = $lastInserId;
			$this->request->data['Contactsellermsg']['message'] = $message;
			$this->request->data['Contactsellermsg']['sentby'] = $sender;
			$this->request->data['Contactsellermsg']['createdat'] = $timenow;
			$this->Contactsellermsg->save($this->request->data);
			
			App::import('Controller', 'Users');
			$Users = new UsersController;
			$this->loadModel('Userdevice');
			$logusername = $username;
			$userddett = $this->Userdevice->find('all',array('conditions'=>array('user_id'=>$merchantId)));
			//echo "<pre>";print_r($userddett);die;
			foreach($userddett as $userdet){
				$deviceTToken = $userdet['Userdevice']['deviceToken'];
				$badge = $userdet['Userdevice']['badge'];
				$badge +=1;
				$this->Userdevice->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
				if(isset($deviceTToken)){
					$messages = $logusername." sent a query on your product ".$itemName;
					$Users->pushnot($deviceTToken,$messages,$badge);
				}
			}
			
			$result[] = 'success';
			$result[] = '<a href="'.SITE_URL.'viewmessage/'.$lastInserId.'"><i class="glyphicons comments"></i>Contact Seller</a>';
			
			echo json_encode($result);
			
			$email_address = $this->User->find("all",array("conditions"=>array('User.id'=>$merchantId)));
			$emailaddress = $email_address[0]['User']['email'];
			$name = $email_address[0]['User']['first_name'];
			
			
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
		$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – You have got a message";
		$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
		$this->Email->sendAs = "html";
		$this->Email->template = 'contactseller';		
		$this->set('name', $name);
		$this->set('urlname', $urlname);
		$this->set('email', $emailaddress);
		$this->set('username',$username);
		$this->set('message',$message);
		$this->set('access_url',SITE_URL."login");
		
		$this->Email->send();

			
		}
		
		
	}	

