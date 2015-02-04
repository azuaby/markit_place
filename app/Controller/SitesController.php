<?php
	App::uses('AppController', 'Controller');
	
	class SitesController extends AppController{
		public $names =  'Sites';
		public $uses = array('Sitesetting');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler','FileUpload','ColorCompare');
		public $helpers = array('Form','Html');
		public $layout = 'admin';
		
		
		function sitesetng(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Site Management');
				
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				//echo $this->request->data['site_logo']; die;
				//echo $this->request->data['site_likebtn_logo'];die;$this->request->data['affiliate_enb'];
				$this->request->data['Sitesetting']['affiliate_enb'] = $this->request->data['affiliate_enb'];
				$this->request->data['Sitesetting']['site_logo'] = $this->request->data['site_logo'];
				$this->request->data['Sitesetting']['site_likebtn_logo'] = $this->request->data['site_likebtn_logo'];
				$profile_image_style = $this->request->data['profile_image_style'];
				$credit_amount = $this->request->data['Sitesetting']['credit_amount'];
				$siteChanges['profile_image_view'] = $profile_image_style;
				$siteChanges['credit_amount'] = $credit_amount;
				$siteChanges = json_encode($siteChanges);
				$this->request->data['Sitesetting']['site_changes'] = $siteChanges;
				if(empty($this->request->data['site_logo'])){
					$this->request->data['Sitesetting']['site_logo'] = 'logo.png';
				}
				if(empty($this->request->data['site_likebtn_logo'])){
					$this->request->data['Sitesetting']['site_likebtn_logo'] = 'fantacylike.png';
				}
				
				$this->request->data['Sitesetting']['footer_left'] = $this->request->data['Sitesetting']['footer_left'];
				$this->request->data['Sitesetting']['footer_right'] = $this->request->data['Sitesetting']['footer_right'];				
				
				$this->Sitesetting->save($this->request->data);
				
				$this->Session->setFlash('Saved successfully');
				$this->redirect('/admin/site/setting');
			}
			
			$site_datas = $this->Sitesetting->find('all');
			
			$siteChanges = $site_datas[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			//echo "<pre>";print_r($siteChanges);die;
			
			$this->set('site_datas',$site_datas[0]);
			$this->set('siteChanges',$siteChanges);
		}

		function mediasetng(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Site Management');
				
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				
				$this->request->data['Sitesetting']['id'] = '1';
				$this->request->data['Sitesetting']['media_url'] = $this->request->data['Sitesetting']['media_url'];
				$this->request->data['Sitesetting']['media_server_hostname'] = $this->request->data['Sitesetting']['media_server_hostname'];
				$this->request->data['Sitesetting']['media_server_username'] = $this->request->data['Sitesetting']['media_server_username'];
				$this->request->data['Sitesetting']['media_server_password'] = $this->request->data['Sitesetting']['media_server_password'];
				$this->request->data['Sitesetting']['meta_key'] = $this->request->data['Sitesetting']['meta_key'];
				$this->request->data['Sitesetting']['meta_desc'] = $this->request->data['Sitesetting']['meta_desc'];
				
				$this->Sitesetting->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/media/setting');
			}
			
			$site_datas = $this->Sitesetting->find('all');
			
			$siteChanges = $site_datas[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			//echo "<pre>";print_r($siteChanges);die;
			
			$this->set('site_datas',$site_datas[0]);
			$this->set('siteChanges',$siteChanges);
		}

		function mailsetng(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Site Management');
				
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				
				$this->request->data['Sitesetting']['id'] = '1';
				$this->request->data['Sitesetting']['notification_email'] = $this->request->data['Sitesetting']['notification_email'];
				$this->request->data['Sitesetting']['support_email'] = $this->request->data['Sitesetting']['support_email'];
				$this->request->data['Sitesetting']['noreply_name'] = $this->request->data['Sitesetting']['noreply_name'];
				$this->request->data['Sitesetting']['noreply_email'] = $this->request->data['Sitesetting']['noreply_email'];
				$this->request->data['Sitesetting']['noreply_password'] = $this->request->data['Sitesetting']['noreply_password'];
				$this->request->data['Sitesetting']['gmail_smtp'] = $this->request->data['Sitesetting']['gmail_smtp'];
				$this->request->data['Sitesetting']['smtp_port'] = $this->request->data['Sitesetting']['smtp_port'];
				
				$this->Sitesetting->save($this->request->data);
				
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/mail/setting');
			}
			
			$site_datas = $this->Sitesetting->find('all');
			
			$siteChanges = $site_datas[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			//echo "<pre>";print_r($siteChanges);die;
			
			$this->set('site_datas',$site_datas[0]);
			$this->set('siteChanges',$siteChanges);
		}
		
		/* module settings */
		function manage_modules(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->loadModel('Managemodule');
				
			$this->set('title_for_layout','Module Setting');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				
				$this->Managemodule->save($this->request->data);
				
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/module/setting');
			}
			
			$modeule_datas = $this->Managemodule->find('all');
			
			$this->set('modeule_datas',$modeule_datas[0]);
		}
		
		function landingpage() {
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->loadModel('Homepagesettings');
			
			$this->set('title_for_layout','Manage Landing Page');
				
			$homepageModel = $this->Homepagesettings->find('first');
				
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				$sliderproperty = $homepageModel['Homepagesettings']['properties'];
				$sliderproperty = json_decode($sliderproperty,true);
				$layout =  $this->request->data['Managelandingpage']['Layout'];
				$widgets =  $this->request->data['Managelandingpage']['widgets'];
				$sliders = $this->request->data['Managelandingpage']['sliders'];
				$sliderproperty['sliderheight'] = $this->request->data['Managelandingpage']['Slider Height'];
				$sliderproperty['sliderbg'] = $this->request->data['Managelandingpage']['Slider Background Color'];
				$sliderproperty = json_encode($sliderproperty);
				if ($sliders <= 0){
					$this->Session->setFlash('Select atleast one slider Image');
					$this->redirect('/admin/manage/landingpage');
				}
			
				$this->request->data['Homepagesettings']['layout'] = $layout;
				$this->request->data['Homepagesettings']['widgets'] = $widgets;
				$this->request->data['Homepagesettings']['properties'] = $sliderproperty;
				
				if (!empty($homepageModel)){
					$this->request->data['Homepagesettings']['id'] = $homepageModel['Homepagesettings']['id'];
				}
				$this->Homepagesettings->save($this->request->data);
					
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/manage/landingpage');
			}
			
			$this->set('homepageModel',$homepageModel);
		}
		
		function managewidgets() {
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->loadModel('Homepagesettings');
			
			$this->set('title_for_layout','Manage Widgets');
				
			$homepageModel = $this->Homepagesettings->find('first');
			
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				$sliderproperty = $homepageModel['Homepagesettings']['properties'];
				$widgets = $homepageModel['Homepagesettings']['widgets'];
				$sliderproperty = json_decode($sliderproperty,true);
				$widgets = explode('(,)', $widgets);
				foreach($widgets as $widget){
					//if ($widget != 'Most Popular Categories' && $widget != 'Top Stores'){
					if ($widget != 'Most Popular Categories'){
						$widgettypelabel = $widget."type";
						$widgetitmlabel = $widget.'itmcount';
						if ($widget != 'Top Stores') {
							$type = $this->request->data['Managewidget'][$widgettypelabel];
						}else{
							$type = 'regular';
						}
						$itmcnt = $this->request->data['Managewidget'][$widgetitmlabel];
						$sliderproperty['widgets'][$widget]['widgettype'] = $type;
						$sliderproperty['widgets'][$widget]['widgetitmcnt'] = $itmcnt;
					}
				}
				$sliderproperty = json_encode($sliderproperty);
				
				$this->request->data['Homepagesettings']['properties'] = $sliderproperty;
			
				if (!empty($homepageModel)){
					$this->request->data['Homepagesettings']['id'] = $homepageModel['Homepagesettings']['id'];
				}
				$this->Homepagesettings->save($this->request->data);
					
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/manage/widgets');
			}
				
			$this->set('homepageModel',$homepageModel);
		}
		
		function changecurrency ($currency){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Forexrate');
			
			$forexrateModel = $this->Forexrate->find('first',
					array('conditions'=>array('currency_code'=>$currency)));
			$_SESSION['currency_symbol'] = $forexrateModel['Forexrate']['currency_symbol'];
			$_SESSION['currency_value'] = $forexrateModel['Forexrate']['price'];
			$_SESSION['currency_code'] = $forexrateModel['Forexrate']['currency_code'];
			$this->redirect($this->referer());
		}
		
		function addslider($id = NULL){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->loadModel('Homepagesettings');
			
			$homepageModel = $this->Homepagesettings->find('first');
			$sliderImage = '';$sliders = '';
			$sliderLink = '';$sliderEffect = 'fade';
			$pagetitle = 'Add Slider';
			$sliders = array();
			$slidercount = 0;
			if (!empty($homepageModel['Homepagesettings']['slider'])) {
				$sliders = json_decode($homepageModel['Homepagesettings']['slider'], true);
				$slidercount = count($sliders);
			}
			if (!empty($homepageModel) && $id != NULL){
				$id -= 1;
				//echo "<pre>";print_R($sliders);
				$sliderImage = $sliders[$id]['image'];
				$sliderLink = $sliders[$id]['link'];
				$sliderEffect = $sliders[$id]['effect'];
				//echo $sliderImage." ";echo $sliderLink;die;
				$pagetitle = 'Edit Slider';
			}
			
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);
				//echo "<pre>";print_R($sliders);die;
				//$slidercount = 1;
				if($this->request->data['addslider']['editid'] != ''){
					$slidercount = $this->request->data['addslider']['editid'];
				}
				$sliders[$slidercount]['image'] = $this->request->data['image'][0];
				$sliders[$slidercount]['link'] = $this->request->data['addslider']['sliderurl'];
				$sliders[$slidercount]['effect'] = $this->request->data['addslider']['slidereffect'];
				//echo "<pre>";print_R($sliders);die;
				$sliderData = json_encode($sliders);
				$this->request->data['Homepagesettings']['slider'] = $sliderData;
				if (!empty($homepageModel)){
					$this->request->data['Homepagesettings']['id'] = $homepageModel['Homepagesettings']['id'];
				}
				$this->Homepagesettings->save($this->request->data);
			
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/manage/landingpage');
			}
			
			$this->set('title_for_layout',$pagetitle);
			
			$this->set('sliderImage',$sliderImage);
			$this->set('sliderLink',$sliderLink);
			$this->set('sliderEffect',$sliderEffect);
			$this->set('pagetitle',$pagetitle);
			$this->set('editid',$id);
			$this->set('homepageModel',$homepageModel);
		}
		
		function deleteslider($id){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->loadModel('Homepagesettings');
				
			$homepageModel = $this->Homepagesettings->find('first');
			$sliders = array();
			$newsliders = array();
			$sliders = json_decode($homepageModel['Homepagesettings']['slider'], true);
			if (!empty($homepageModel)){
				$id -= 1;
				$newcount = 0;
				//echo "<pre>";print_R($sliders);
				foreach($sliders as $key=>$slider){
					if ($key != $id){
						$newsliders[$newcount]['image'] = $slider['image'];
						$newsliders[$newcount]['link'] = $slider['link'];
						$newcount++;
					}
				}
				$sliderData = json_encode($newsliders);
				
				$this->request->data['Homepagesettings']['slider'] = $sliderData;
				$this->request->data['Homepagesettings']['id'] = $homepageModel['Homepagesettings']['id'];
				$this->Homepagesettings->save($this->request->data);
				$this->redirect('/admin/manage/landingpage');
			}
		}
	
		function sitemaintenance (){
			$this->loadModel('Managemodule');
			$managemoduleModel = $this->Managemodule->find('first');
			//echo "Sitemode: ".$siteMode;
			if ($managemoduleModel['Managemodule']['site_maintenance_mode'] == 'no'){
				$this->redirect('/');
			}
			$this->layout = 'error';
			$this->set('title_for_layout','Site Maintenance');
			
			$this->set('adminmessage',$managemoduleModel['Managemodule']['maintenance_text']);
		}
		
		function socialsetng()
		{
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Site Management');	
			if(!empty($this->request->data))
			{
				$this->request->data['Sitesetting']['id'] = '1';
				$this->request->data['Sitesetting']['fb_id'] = $this->request->data['Sitesetting']['fb_id'];
				$this->request->data['Sitesetting']['fb_secret'] = $this->request->data['Sitesetting']['fb_secret'];
				$this->request->data['Sitesetting']['google_id'] = $this->request->data['Sitesetting']['google_id'];
				$this->request->data['Sitesetting']['google_secret'] = $this->request->data['Sitesetting']['google_secret'];
				$this->request->data['Sitesetting']['twitter_id'] = $this->request->data['Sitesetting']['twitter_id'];
				$this->request->data['Sitesetting']['twitter_secret'] = $this->request->data['Sitesetting']['twitter_secret'];
				$this->request->data['Sitesetting']['gmail_client_id'] = $this->request->data['Sitesetting']['gmail_client_id'];
				$this->request->data['Sitesetting']['gmail_client_secret'] = $this->request->data['Sitesetting']['gmail_client_secret'];
				
				$this->Sitesetting->save($this->request->data);
				
				$this->Session->setFlash('Saved successfully');
				$this->redirect('/admin/social/setting');
				
			}		
			$site_datas = $this->Sitesetting->find('first');
			$this->set('site_datas',$site_datas);
			
		}
		
		function sendpushnot(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$messages = $_REQUEST['messages'];
			
			if($this->isauthorized()){
				App::import('Controller', 'Users');
				$Users = new UsersController;
				$this->loadModel('Userdevice');
				$userddett = $this->Userdevice->find('all');
				//echo "<pre>";print_r($userddett);die;
				foreach ($userddett as $userd) {
					$deviceTToken = $userd['Userdevice']['deviceToken'];
					$badge = $userd['Userdevice']['badge'];
					$badge +=1;
					$this->Userdevice->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
					if(isset($deviceTToken)){
						$Users->pushnot($deviceTToken,$messages,$badge);
					}
				}
				echo "Successfully Sent";
			}
		}
		
		function updatecounts(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Comment');
			$this->loadModel('Shop');
			$this->loadModel('Follower');
			
			$itemModel = $this->Item->find('all');
			foreach($itemModel as $item){
				$itemid = $item['Item']['id'];
				$cmntcount = count($item['Comment']);
				$this->request->data['Item']['id'] = $itemid;
				$this->request->data['Item']['comment_count'] = $cmntcount;
				$this->Item->save($this->request->data);
			}
			$shopModel = $this->Shop->find('all',array('conditions'=>array('User.user_level <>'=>'god','Shop.paypal_id <>'=>'')));
			
			foreach ($shopModel as $shop){
				$userid = $shop['Shop']['user_id'];
				$itemcnt = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$userid,'Item.status'=>'publish')));
				
				$flwrscnt = $this->Follower->flwrscnt($userid);
				$totl_flwrs = 0;
				if(!empty($flwrscnt)){
					foreach($flwrscnt as $flws){
						$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					}
					$totl_flwrs -= 1;
				}
				$this->Shop->updateAll(array('follow_count' => "'$totl_flwrs'",'item_count' => "'$itemcnt'"), array('user_id' => $userid));
				
			}
			echo "Details Updated";
		}
		
		function downimage(){
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$this->loadModel('Itempicture');
			$this->loadModel('Picture');
			$this->loadModel('Photo');
			
			$itempictureModel = $this->Itempicture->find('all');
			$itempic = array();
			foreach($itempictureModel as $itempicture){
				$pictureModel = $this->Picture->find('first',array('conditions'=>array('id'=>$itempicture['Itempicture']['picture'])));
				$picturl = explode('.jpg',$pictureModel['Picture']['picture']);
				$pict = $picturl[0].'-638x.jpg';
				$itempic[$itempicture['Itempicture']['item']][] = "http://fav.sg/uploads/cache".$pict;
			}
			foreach ($itempic as $pickey => $picurl){
				foreach ($picurl as $pics){
					$this->Photo->create();
					$image_save_name = time().'.jpg';
					$this->FileUpload->upload($pics,$image_save_name,"item");
					$this->request->data['Photo']['item_id'] = $pickey;
					$this->request->data['Photo']['image_name'] = $image_save_name;
					$this->Photo->save($this->request->data);
				}
			}
			echo "<pre>";print_r($itempic);die;
		}
		function updateurl (){
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('User');
			
			$userModel = $this->User->find('all');
			$users = array();
			foreach($userModel as $user){
				$username = $user['User']['username'];
				$this->User->create();
				$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
				$this->request->data['User']['id'] = $user['User']['id'];
				$this->User->save($this->request->data);
			}
			//$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
			$itemModel = $this->Item->find('all');
			$items = array();
			foreach($itemModel as $item){
				$username = $item['Item']['item_title'];
				$imgName = $_SESSION['media_url'].'media/items/original/'.$item['Photo'][0]['image_name'];
				$result = ColorCompareComponent::compare(5, $imgName);
				$process_time = $item['Item']['processing_time'];
				if($process_time == '1'){
					$process = '1d';
				}elseif($process_time == '1 working day'){
					$process = '1d';
				}elseif($process_time == '2 days'){
					$process = '2d';
				}elseif($process_time == '3'){
					$process = '3d';
				}elseif($process_time == '3-5 business days'){
					$process = '4d';
				}elseif($process_time == '4'){
					$process = '4d';
				}elseif($process_time == '5 days'){
					$process = '4d';
				}elseif($process_time == '5'){
					$process = '4d';
				}
				$this->Item->create();
				$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
				$this->request->data['Item']['status'] = 'publish';
				$this->request->data['Item']['processing_time'] = $process;
				$this->request->data['Item']['item_color'] = json_encode($result);
				$this->request->data['Item']['id'] = $item['Item']['id'];
				$this->Item->save($this->request->data);
			}
		}
	}
