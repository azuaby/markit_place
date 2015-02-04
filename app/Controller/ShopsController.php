<?php
	App::uses('AppController', 'Controller');
	
	class ShopsController extends AppController{
		public $names =  'Shops';
		public $uses = array('Shop');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
		public $helpers = array('Form','Html');
		public $layout = 'default';
		
		function create_shop($name = null){
			global $loguser;
			
			$shop_dats = array();
			// $this->loadModel('User');
			$userid = $loguser[0]['User']['id'];
			// echo "<pre>";print_r($loguser);die;
			$shop_dats = $this->Shop->findByUserId($userid);
			
			// echo "<pre>";print_r($shops);die;
			$this->set('shop_dats',$shop_dats);
			$this->set('userid',$userid);

			if(!empty($this->request->data)){
				$shpexst = $this->Shop->findByUserId($userid);
				if(!empty($shpexst)){
					$this->request->data['Shop']['id'] = $shpexst['Shop']['id'];
				}
				// echo "<pre>";print_r($this->request->data);die;
				$result = $this->Shop->save($this->request->data);
				$shpnme = $this->request->data['Shop']['shop_name'];
				if($result){
					$this->Session->setFlash('Shop Added');
					$this->redirect('/shop/'.$shpnme);
				}else{
					$this->Session->setFlash('Shop name already exists');
				}
			}
		}
		
		function create_shop_details($name = null){
			global $loguser,$setngs;
			// echo "<pre>";print_R($setngs);die;
			$this->set('title_for_layout',$setngs[0]['Sitesetting']['site_title']);
			
			$shopdats = $this->Shop->findByUserId($loguser[0]['User']['id']);
			
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->request->data['Shop']['id'] = $shopdats['Shop']['id'];
				$this->request->data['Shop']['user_id'] = $loguser[0]['User']['id'];
				$this->request->data['Shop']['shop_name'] = $shopdats['Shop']['shop_name'];
				$this->request->data['Shop']['shop_title'] = $this->request->data['Shop']['shop_title'];
				$this->request->data['Shop']['shop_banner'] = $_REQUEST['image'];
				$this->request->data['Shop']['shop_announcement'] = $this->request->data['Shop']['shop_announcement'];
				$this->request->data['Shop']['shop_message'] = $this->request->data['Shop']['shop_message'];
				// echo "<pre>";print_R($this->request->data['Shop']);die;
				$res = $this->Shop->save($this->request->data);
				// var_dump($res);
				$this->redirect(array('controller'=>'/','action'=>'/shop/'.$name));
				
				// die;
			}
			
			$this->set('shopdats',$shopdats);
			$this->set('name',$name);
		}
		
		function viewshops($name = null){
			global $loguser;
			$this->loadModel('User');
			$this->loadModel('Item');
			$shop_dats = array();
			$userid = $loguser[0]['User']['id'];
			$shop_dats = $this->Shop->findByShopName($name);
			
			if(empty($shop_dats)){
				$usrdts = $this->User->findByUsername($name);
				$shop_dats = $this->Shop->findByUserId($usrdts['User']['id']);
			}else{
				$usrdts = $this->User->findById($shop_dats['User']['id']);
			}
			// print_r($usrdts);
			// echo "<pre>";print_r($shop_dats);die;
			
			if(empty($shop_dats['Shop']['shop_title'])){
				$this->set('title_for_layout','Shop By '.$name);
			}else{
				$this->set('title_for_layout',$shop_dats['Shop']['shop_title'].' By '.$name);
			}
			$ordr = "Item.id DESC";
			$order = 'custom';
			if (!empty($_REQUEST['order'])) {
				$order = $_REQUEST['order'];
				switch ($order) {
					case 'custom':
						$ordr = "Item.id DESC";
						break;
					case 'Most Recent':
						$ordr = "Item.created_on DESC";
						break;
					case 'Lowest Price':
						$ordr = "Item.price";
						break;
					case 'Highest Price':
						$ordr = "Item.price DESC";
						break;
				}
			}
			if(!empty($_REQUEST['search_query'])){
				$this->paginate = array('conditions'=>array('Item.item_title like'=>$_REQUEST['search_query']."%",'Item.user_id'=>$usrdts['User']['id']),'limit'=>10,'order'=>$ordr);
				$item_dats = $this->paginate('Item');

			}else{
			
			// $item_dats = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$userid)));
				$this->paginate = array('conditions'=>array('Item.user_id'=>$usrdts['User']['id']),'limit'=>10,'order'=>$ordr);
				$item_dats = $this->paginate('Item');
			}
			
			$this->loadModel('Follower');
			
			// $this->Follower->find('all',array('conditions'=>));
			/* Followers count --> other user foolowed me */
			$flwrscnt = $this->Follower->flwrscnt($usrdts['User']['id']);
			
			// echo "<pre>";print_r($followcnt);die;
			// echo "<pre>";print_r($flwrscnt);die;
			$flwrusrids = array();
			$totl_flwrs = 0;
			if(!empty($flwrscnt)){
				foreach($flwrscnt as $flws){
					$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					$flwrusrids[$flws['Follower']['follow_user_id']] = $flws['Follower']['follow_user_id'];
				}
				
			}	
			$shopfavs = $this->User->Shopfav->find('count',array('conditions'=>array('shop_id'=>$shop_dats['Shop']['id'],'user_id'=>$loguser[0]['User']['id'])));
			// print_r($shopfavs);
			$this->set('shopfavs',$shopfavs);
			$this->set('flwrusrids',$flwrusrids);
			
			$this->set('totl_flwrs',$totl_flwrs);
			$this->set('flwrscnt',$flwrscnt);
			
			// echo "<pre>";print_r($item_dats);die;
			// echo "<pre>";print_r($shop_dats);die;
			// echo "<pre>";print_r($usrdts);die;
			
			$this->set('shop_dats',$shop_dats);
			$this->set('usrdts',$usrdts);
			$this->set('loguser',$loguser);
			$this->set('userid',$userid);
			$this->set('item_dats',$item_dats);
			$this->set('name',$name);
			$this->set('orderby',$order);
		}
		
		/* add policies */
		function policies($name = null){
			global $loguser,$setngs;
			// echo "<pre>";print_R($setngs);die;
			$this->set('title_for_layout','Shop Policies');
			
			$shopdats = $this->Shop->findByUserId($loguser[0]['User']['id']);
			
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$this->request->data['Shop']['id'] = $shopdats['Shop']['id'];
				$this->request->data['Shop']['user_id'] = $loguser[0]['User']['id'];
				$this->request->data['Shop']['shop_name'] = $shopdats['Shop']['shop_name'];
				$this->request->data['Shop']['welcome_message'] = $this->request->data['Shop']['welcome_msg'];
				$this->request->data['Shop']['payment_policy'] = $this->request->data['Shop']['pymnt_plcy'];
				$this->request->data['Shop']['shipping_policy'] = $this->request->data['Shop']['shpng_plcy'];
				$this->request->data['Shop']['refund_policy'] = $this->request->data['Shop']['rfnd_plcy'];
				$this->request->data['Shop']['additional_info'] = $this->request->data['Shop']['add_info'];
				$this->request->data['Shop']['seller_info'] = $this->request->data['Shop']['seller_info'];
				// echo "<pre>";print_R($this->request->data['Shop']);die;
				$res = $this->Shop->save($this->request->data);
				// var_dump($res);
				$this->redirect(array('controller'=>'/','action'=>'/shop/'.$name));
				
				// die;
			}
			
			$this->set('shopdats',$shopdats);
			$this->set('name',$name);
		}
		
	}	
?>