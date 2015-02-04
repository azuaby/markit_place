<?php
	App::uses('AppController', 'Controller');
	
	class MobileItemsController extends AppController{
		public $names =  'Items';
		public $uses = array('Item','Comment');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler','ColorCompare');
		public $helpers = array('Form','Html');
		
		
		function change_item_status ($itemId,$status) {
				
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Shop');
			
			$prefix = $this->Item->tablePrefix;
			
			
			if ($status == 'publish') {
				$this->Item->query("UPDATE ".$prefix."items SET status='draft' WHERE id = ".$itemId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = "<button class='btn btn-success' onclick='changeItemStatus(".$itemId.",\"draft\");'>Publish</button>";
			}else {
				$this->Item->query("UPDATE ".$prefix."items SET status='publish' WHERE id = ".$itemId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = "<button class='btn btn-warning' onclick='changeItemStatus(".$itemId.",\"publish\");'>Draft</button>";
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
				
				$itemcount = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userId,'Item.status'=>'publish')));
				$this->Shop->updateAll(array('item_count' => "'$itemcount'"), array('user_id' => $userId));
				
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
			$this->layout = 'mobileadminlayout';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/mobile/');
				
			$this->set('title_for_layout','Item Management');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->Item->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/site/setting');
			}
			
			$this->paginate =  array('conditions'=>array('Item.status <>'=>'things'),'limit'=>10,'order'=>array('id'=>'desc'));
			
			
			$item_datas = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
			
			//$item_datas = $this->Item->find('all');
			
			$this->set('item_datas',$item_datas);
			$this->set('pagecount',$pagecount);
		}
		
		function create_item($additemid = NULL){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Add');
	   	 	//$this->layout = 'frontlayout';
			global $loguser;
			$this->loadModel('Shop');
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
				
				$commisionrate=$this->Commission->find('all');
	      
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
			// die;
			global $loguser;
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
				
				
				
				$this->redirect('/mobile/create/item/');
				
				
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
			$this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
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
			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");			
			$this->request->data['Item']['status'] = 'draft';			
			$this->request->data['Item']['item_color'] = json_encode($result);
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
		function listings($id=null,$nme=null){
			$nme = $this->Urlfriendly->utils_makeUrlFriendly($nme);
			$this->layout = 'mobilelayout';
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
			
			
			if(empty($id) || empty($nme)){
				$this->Session->setFlash('You url is not valid one');
				$this->redirect('/');
			}
			
			$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id,'Item.item_title_url'=>$nme,'Item.status <>'=>'draft')));
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
			//$this->set('cntryname',$commentss_item);
			$this->set('loguser',$loguser);
			$this->set('userid',$userid);
			//$this->set('itemfavs',$itemfavs);
			//$this->set('shopfavs',$shopfavs);
			$this->set('cntry_code',$cntry_code);
			//$this->set('cntryid',$cntryid);
			$this->set('commentss_item',$commentss_item);
		
			$this->set('usershipping',$usershipping);
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->set('setngs',$setngs);
			
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
			$this->layout = 'mobilelayout';
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
			$this->layout = 'mobilelayout';
			
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
			//global $loguser;
			//$userid = $loguser[0]['User']['id'];
			$this->autoRender=false;
			
				
			$userid = $_REQUEST['userid'];	
			$itemid = $_REQUEST['itemid'];	
			$commentss = $_REQUEST['commentss'];
		
			$this->request->data['Comment']['user_id'] = $userid;
			$this->request->data['Comment']['item_id'] = $itemid;
			$this->request->data['Comment']['comments'] = $commentss;
			$this->request->data['Comment']['created_on'] = date("Y-m-d H:i:s");
			$this->Comment->save($this->request->data);
			$comment_id = $this->Comment->getLastInsertID();
			$logdetails = $this->logs('comment',$comment_id,$userid,'0');
			
			$cmntCount = $this->Comment->find('count',array('recursive'=>'-1','conditions'=>array('Comment.item_id'=>$itemid)));
			$this->Item->updateAll(array('comment_count' => "'$cmntCount'"), array('Item.id' => $itemid));
			
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
			$this->layout = 'mobilelayout';
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
			$addid = $_REQUEST['addid'];
		
			//$this->loadModel('Item');
		
			$this->Item->deleteAll(array('Item.id' => $addid));
				
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
				$this->redirect('/mobile/');
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout',' - Gift Card');
			global $loguser;
			global $siteChanges;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Giftcard');
			$this->loadModel('Sitesetting');
			$userId = $loguser[0]['User']['id'];
			
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
			$this->Groupgiftuserdetail->save($this->request->data);
			$lasttId = $this->Groupgiftuserdetail->getLastInsertID();
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
			$this->request->data['Groupgiftuserdetail']['shipcost'] = $shipping_amt;
			$totals_amt = $item_datas['Item']['price'] + $shipping_amt;
			$this->request->data['Groupgiftuserdetail']['total_amt'] = $totals_amt;
			$this->request->data['Groupgiftuserdetail']['balance_amt'] = $totals_amt;
			$this->Groupgiftuserdetail->save($this->request->data);
				
				
				
			$shippin_amtt = $shipping_amt + $item_datas['Item']['price'];
			echo $lasttId.','.$shipping_amt.','.$item_datas['Item']['price'].','.$shippin_amtt;
				
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
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout',' - Group Gift');
		
		}
		
		function gglists() {
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout',' - Group Gift');
			$this->loadModel('Groupgiftuserdetail');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$gglistsData = $this->Groupgiftuserdetail->find('all',array('conditions'=>array('user_id'=>$userid),'order'=>array('Groupgiftuserdetail.id'=>'desc')));
			//echo "<pre>";print_r($gglistsData);die;
		
			$this->set('gglistdatas',$gglistsData);
		}
		
		function gifts($id=NULL) {
			if(!$this->isauthenticated())
				$this->redirect('/');
			$this->layout = 'mobilelayout';
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
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','Edit Item');
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Item');
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Country');
			$this->loadModel('Recipient');
				
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
				$this->request->data['Item']['super_catid'] = $this->request->data['Item']['supersubcat'];
				$this->request->data['Item']['sub_catid'] = $this->request->data['Item']['subcat'];
				$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
				$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
				if($processing_time_id == 'custom'){
					$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
					$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
					$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
				}
				$this->request->data['Item']['modified_on'] = date("Y-m-d H:i:s");
				$this->request->data['Item']['status'] = 'draft';
				$this->request->data['Item']['item_color'] = json_encode($result);
					
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
		
		
	}	

