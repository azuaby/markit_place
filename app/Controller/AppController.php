<?php
if(session_id() == '') {
session_start();
}
 $config['Settings'] = Configure::read('Settings');
 define('SITE_URL',$config['Settings']['SITE_URL']);
 define('SITE_NAME',$config['Settings']['SITE_TITLE']);
 define('FB_ID',$config['Settings']['FB_ID']);
 define('FB_SECRET',$config['Settings']['FB_SECRET']);
 define('GOOGLE_ID',$config['Settings']['GOOGLE_ID']);
 define('GOOGLE_SECRET',$config['Settings']['GOOGLE_SECRET']);
 define('TWITTER_ID',$config['Settings']['TWITTER_ID']);
 define('TWITTER_SECRET',$config['Settings']['TWITTER_SECRET']);
 define('GMAIL_CLIENT_SECRET',$config['Settings']['GMAIL_CLIENT_SECRET']);
 define('GMAIL_CLIENT_ID',$config['Settings']['GMAIL_CLIENT_ID']);
 //define('CONTACT',$config['Settings']['CONTACT']);
	//echo "<pre>";print_r($config['Settings']); die;
class AppController extends Controller{
	public $components = array('Auth');
	public $helpers = array('Form','Html' => array('className' => 'MyHtml'));
	
	function beforeFilter(){
		global $loguser;
		global $username;
		global $siteChanges;
		global $paypalAdaptive;
		global $user_level,$setngs,$price,$colors,$parent_categori;
		global $googlecode;
		parent::beforeFilter();		
		$this->Auth->loginAction = array('controller' => '/', 'action' => '/login');
		$this->Auth->logoutRedirect = array('controller' => '/', 'action' => '/');
		$this->Auth->authenticate = array(AuthComponent::ALL => array('fields' => array('username' => 'email','password' => 'password'),'userModel' => 'Users.User'), 'Form');  // Regardless of this line auth login will run correctly
		
		if ($this->params['controller'] == 'api') {
			$this->Auth->allow();
		}
		if ($this->params['controller'] == 'fantasyhelps') {
			$this->Auth->allow();
		}
		if ($this->params['controller'] == 'mobilefantasyhelps') {
			$this->Auth->allow();
		}	
		$this->Auth->allow('login','signup','verification','index','userprofiles','viewshops','listings','show_color','show_price','showByCategory','getMorePosts','ipnprocess',
		'getmorepricecolor','getItemByCategory','ajaxSearch','captcha','forgotpassword','showByRelation','getItemByRelation','faq','contact','item_comments','changePassword','userDetails',
		'copyrights','termsofsale','termsofservice','termsofmerchant','privacy','loginwith','loginwithtwitter','changecurrency','downimage','sitemaintenance',
		'getviewmore','customviewmore','orderstatus','getsizeqty','searches','getmoregallery','viewitemdesc','followersList','getmoreprofile',
		'followingList','twittlogin_save','item_favorited','custupdate','merupdate','custupdatend','testing','bookmarklet',
		'adaptiveipnprocess','additemusingurl','giftcardipnIpn','ggipn','ggcronjob','nearme','getMorenearme','gifts');
		
		$loguser = $this->Auth->user();
		$userid = $loguser[0]['User']['id'];
		$username = $loguser[0]['User']['username'];
		$first_name = $loguser[0]['User']['first_name'];
		$username_url = $loguser[0]['User']['username_url'];
		$user_level = $loguser[0]['User']['user_level'];
		$profile_image = $loguser[0]['User']['profile_image'];
		$admin_menus = $loguser[0]['User']['admin_menus'];
		$this->set('loguser',$loguser);
		$this->set('username',$username);
		$this->set('username_url',$username_url);
		$this->set('user_level',$user_level);
		$this->set('first_name',$first_name);
		$this->set('profile_image',$profile_image);	
		$this->set('admin_menus',$admin_menus);	
				
		$this->loadModel('Sitesetting');
		$this->loadModel('Cart');
		$this->loadModel('Price');
		$this->loadModel('Color');
		$this->loadModel('Category');
		$this->loadModel('Forexrate');
		$this->loadModel('Managemodule');
		//$this->loadModel('Log');
		$this->loadModel('User');
		$this->loadModel('Item');
		$this->loadModel('Googlecode');
		$this->loadModel('Contactseller');
		$this->loadModel('Help');
		
		$managemoduleModel = $this->Managemodule->find('first');
		$this->set('managemoduleModel',$managemoduleModel);
		$params=$this->params;
		$action=$params['action'];
		
		if ($this->params['controller'] != 'api') {
 			$this->_setLanguage();
		}
		if ($action != 'sitemaintenance' && $action != 'login'){
			if (!$this->isauthenticated() || $user_level != 'god'){
				//echo $action;die;
				if ($managemoduleModel['Managemodule']['site_maintenance_mode'] == 'yes'){
					$this->redirect('/sitemaintenance');
				}
			}
		}
		
		$messageCount = $this->Contactseller->find('count',array('conditions'=>array(
				'OR' => array(array('merchantid' => $userid, 'sellerread' => 1),array(
						'buyerid' => $userid, 'buyerread' => 1)))));
		$_SESSION['userMessageCount'] = $messageCount;
		if (!isset($_SESSION['language_settings'])){
			$languageJson = file_get_contents(SITE_URL.'language_settings.json');
			$_SESSION['language_settings'] = json_decode($languageJson, true);
			$defaultLanguage = $_SESSION['language_settings']['settings']['default'];
			Configure::write('Config.language', $defaultLanguage);
		}else{
			Configure::write('Config.language', $_SESSION['language_settings']['settings']['default']);
		}
		
		if (!isset($_SESSION['currency_value'])){
			$forexrateModel = $this->Forexrate->find('first', array('conditions'=>array('price'=>'1')));
			$_SESSION['currency_symbol'] = $forexrateModel['Forexrate']['currency_symbol'];
			$_SESSION['currency_value'] = $forexrateModel['Forexrate']['price'];
			$_SESSION['currency_code'] = $forexrateModel['Forexrate']['currency_code'];
			$_SESSION['default_currency_code'] = $forexrateModel['Forexrate']['currency_code'];
			$_SESSION['default_currency_symbol'] = $forexrateModel['Forexrate']['currency_symbol'];
		}
		$setngs = $this->Sitesetting->find('all');
		$price = $this->Price->find('all');
		$forexrateModel = $this->Forexrate->find('all',array('conditions'=>array('status'=>'enable')));
		$colors = $this->Color->find('all');
		$UserDetailss = $this->User->findById($userid);
		$this->set('UserDetailss',$UserDetailss);
		$parent_categori = $this->Category->find('all',array('conditions'=>array('category_parent'=>0)));
		//
		$googlecode = $this->Googlecode->find('all');
		$this->loadModel('Giftcard');
			
		$giftcarduseradded = $this->Giftcard->find('all',array('conditions'=>array('Giftcard.user_id'=>$userid,'Giftcard.status'=>'Pending'),'order'=>'Giftcard.id DESC'));

		$terms = $this->Help->find('all');
			foreach($terms as $term) {
				$conditions = $term['Help']['sub_termsofMerchant'];
				$error_code = $term['Help']['err_code'];
			}
		$this->set('condition', $conditions);
		$this->set('error_code',$error_code);
			
		if(!empty($giftcarduseradded)){
			$giftcarditemDetails = json_decode($setngs[0]['Sitesetting']['giftcard'],true);
			//echo "<pre>";print_r($giftcarduseradded);die;
			$this->set('giftcarditemDetails',$giftcarditemDetails);
			$this->set('giftcarduseradded',$giftcarduseradded);
			$this->set('countgiftcarduseradded',count($giftcarduseradded));
				
				
		}
		
		if(!empty($userid)){		
			//$total_itms = $this->Cart->totitms($userid);
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress')));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
					$size[$crt['Cart']['item_id']] = $crt['Cart']['size_options'];
				}
				$this->set('quantity',$quantity);
				$this->set('size',$size);
			
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids,'Item.status'=>'publish')));
				$total_itms = count($itm_datas);			
			}
			$this->set('total_itms',$total_itms);
		}
		
		$this->set('price',$price);
		$this->set('colors',$colors);
		$this->set('forexrateModel',$forexrateModel);
		$this->set('parent_categori',$parent_categori);
		$this->set('googlecode',$googlecode);
		$this->set('media_url',$setngs[0]['Sitesetting']['media_url']);
		$this->set('setngs',$setngs);
		
		$siteChanges = $setngs[0]['Sitesetting']['site_changes'];
		$siteChanges = json_decode($siteChanges,true);
		$paypalAdaptive = $setngs[0]['Sitesetting']['paypaladaptive'];
		$paypalAdaptive = json_decode($paypalAdaptive,true);
		$this->set('siteChanges',$siteChanges);
		
		$_SESSION['site_url'] = SITE_URL;
		$_SESSION['media_url'] = SITE_URL;
		if (!empty($setngs[0]['Sitesetting']['media_url'])) {
			$_SESSION['media_host_name'] = $setngs[0]['Sitesetting']['media_server_hostname'];
			$_SESSION['media_url'] = $setngs[0]['Sitesetting']['media_url'];
			$_SESSION['media_server_username'] = $setngs[0]['Sitesetting']['media_server_username'];
			$_SESSION['media_server_password'] = $setngs[0]['Sitesetting']['media_server_password'];
		}
		// print_r($_SESSION['clone_crte']);
		
			
	}
	
	function isauthenticated(){
		$user =  $this->Auth->user();
		if(!empty($user))
			return true;
		else
			return false;
	}
	function isauthorized(){
		$user =  $this->Auth->user();
		if ($user[0]['User']['user_level'] == 'god')
			return true;
		else
			return false;
	}
	
	function isauthorizedpersn(){
		$user =  $this->Auth->user();
		if ($user[0]['User']['user_level'] == 'god' || $user[0]['User']['user_level'] == 'shop'){
			return true;
		}else{
			return false;
		}	
	}
	
	
	function _setLanguage() {
		//if the cookie was previously set, and Config.language has not been set
		//write the Config.language with the value from the Cookie
		//echo $this->Cookie->read('lang');
		if (isset($this->Cookie) && $this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
			$this->Session->write('Config.language', $this->Cookie->read('lang'));
		}
		//if the user clicked the language URL
		else if (isset($this->params['language']) &&
				($this->params['language'] !=  $this->Session->read('Config.language'))
		) {
			//then update the value in Session and the one in Cookie
			$this->Session->write('Config.language', $this->params['language']);
			$this->Cookie->write('lang', $this->params['language'], false, '20 days');
		}
	}   
	
}
