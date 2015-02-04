<?php
	App::uses('AppController', 'Controller');
	
	class BannersController extends AppController{
		public $names =  'Banner';
		public $uses = array('Banner');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
		public $helpers = array('Form','Html');
		public $layout = 'admin';
		
		
		/*function view_banner(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Banner Management');
			if(!empty($this->request->data))
			{
				for($i=1;$i<=5;$i++)
				{
					if(!empty($this->request->data['banner_name'.$i]))
					{
						$banner_type = $this->request->data['banner_type'.$i];
						$banner_count = $this->Banner->find('count',array('conditions'=>array('Banner.banner_type'=>$banner_type)));
						$banner_name = $this->request->data['banner_name'.$i];			
						$this->request->data['Banner']['banner_name'] = $this->request->data['banner_name'.$i];
						$this->request->data['Banner']['html_source'] = $this->request->data['html_source'.$i];
						$this->request->data['Banner']['banner_type'] = $this->request->data['banner_type'.$i];
						$this->request->data['Banner']['status'] = $this->request->data['status'.$i];
						if($banner_count>0)
						{
							$this->Session->setFlash('Banner Type Already Exists');
						}
						else
						{
							$banner_exists = $this->Banner->find('first',array('conditions'=>'Banner.id'=>$i)));
							$this->Banner->updateAll(array('Banner.banner_name'=>"'$bannername'",'Banner.html_source'=>"'$htmlsource'",'Banner.banner_type'=>"'$bannertype'",'Banner.status'=>"'$status'"),array('Banner.id'=>$i));
							$this->Session->setFlash('Banner saved successfully');
						}
					}
				}
				$this->redirect('/admin/view/banner');
			}
		
		}*/
		
		function add_banner(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			$prefix = $this->Banner->tablePrefix;	
			$this->set('title_for_layout','Banner Management');
			$this->loadModel('Banner');
			if(!empty($this->request->data))
			{
				//echo "<pre>"; print_r($this->request->data()); die;
				for($i=1;$i<=5;$i++)
				{
					if(!empty($this->request->data['banner_name'.$i]))
					{
						$banner_type = $this->request->data['banner_type'.$i];
						$banner_count = $this->Banner->find('count',array('conditions'=>array('Banner.banner_type'=>$banner_type)));
						if($banner_count>0) {
						
						$type = $this->request->data['banner_type'.$i];
						$name = $this->request->data['banner_name'.$i];
						$source = $this->request->data['html_source'.$i];
						$status = $this->request->data['status'.$i];
						
						
						$this->Banner->updateAll(array('Banner.banner_name' => "'$name'",'Banner.html_source' => "'$source'",'Banner.status' => "'$status'"), array('Banner.banner_type' => $type));
						
						} else {
						$banner_name = $this->request->data['banner_name'.$i];			
						$this->request->data['Banner']['banner_name'] = $this->request->data['banner_name'.$i];
						$this->request->data['Banner']['html_source'] = $this->request->data['html_source'.$i];
						$this->request->data['Banner']['banner_type'] = $this->request->data['banner_type'.$i];
						$this->request->data['Banner']['status'] = $this->request->data['status'.$i];
						}
							$this->Banner->saveAll($this->request->data);
							$this->Session->setFlash('Banner saved successfully');
					}
				}
				$this->redirect('/admin/add/banner');
			}
			$giftcard = $this->Banner->find('all', array('conditions'=>array('Banner.banner_type'=>'giftcard')));
			foreach($giftcard as $gift) {
					$name = $gift['Banner']['banner_name'];
					$source = $gift['Banner']['html_source'];
					$status = $gift['Banner']['status'];
				$this->set('giftName',$name);
				$this->set('giftSource',$source);
				$this->set('giftStatus',$status);
			}
			$product = $this->Banner->find('all', array('conditions'=>array('Banner.banner_type'=>'product')));
			foreach($product as $product) {
					$name = $product['Banner']['banner_name'];
					$source = $product['Banner']['html_source'];
					$status = $product['Banner']['status'];
				$this->set('productName',$name);
				$this->set('productSource',$source);
				$this->set('productStatus',$status);
			}
			$shop = $this->Banner->find('all', array('conditions'=>array('Banner.banner_type'=>'shop')));
			foreach($shop as $shop) {
					$name = $shop['Banner']['banner_name'];
					$source = $shop['Banner']['html_source'];
					$status = $shop['Banner']['status'];
				
				$this->set('shopName',$name);
				$this->set('shopSource',$source);
				$this->set('shopStatus',$status);
			}
			$find = $this->Banner->find('all', array('conditions'=>array('Banner.banner_type'=>'findfriends')));
			foreach($find as $find) {
					$name = $find['Banner']['banner_name'];
					$source = $find['Banner']['html_source'];
					$status = $find['Banner']['status'];
				$this->set('findName',$name);
				$this->set('findSource',$source);
				$this->set('findStatus',$status);
			}
			$invite = $this->Banner->find('all', array('conditions'=>array('Banner.banner_type'=>'invitefriends')));
			foreach($invite as $invite) {
					$name = $invite['Banner']['banner_name'];
					$source = $invite['Banner']['html_source'];
					$status = $invite['Banner']['status'];
				$this->set('inviteName',$name);
				$this->set('inviteSource',$source);
				$this->set('inviteStatus',$status);
			}
		}
		
		function edit_banner($id=null){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			if(empty($id)){
				$this->redirect('/');
			}	
				
			$this->set('title_for_layout','Banner Management');
			
			$baners_data = $this->Banner->findById($id);
			
			$this->set('baners_data',$baners_data);
			$this->set('id',$id);
			
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				// $this->request->data['Banner']['id']
				$bannername = $this->request->data['banner_name'];
				$htmlsource = $this->request->data['html_source'];
				$bannertype = $this->request->data['banner_type'];
				$status = $this->request->data['status'];
				$this->Banner->updateAll(array('Banner.banner_name'=>"'$bannername'",'Banner.html_source'=>"'$htmlsource'",'Banner.banner_type'=>"'$bannertype'",'Banner.status'=>"'$status'"),array('Banner.id'=>$id));
				$this->Session->setFlash('Banner Updated Successfully');
				$this->redirect('/admin/view/banner');
			}
		
		}
		
		public function bannerdeletes(){
			$this->set('title_for_layout','Banner Management');
			
			$this->loadModel('Banner');
			$id = $_REQUEST['id'];
			$prefix = $this->Banner->tablePrefix;
				
			$this->Banner->query("delete from ".$prefix."banners where id=".$id." ");
			
			
			//$this->Banner->delete($id);
			echo 0;
			die;
		}
		
		
		public function googleanlay(){
			$this->loadModel('Googlecode');
			$this->set('title_for_layout','Goolge Analystics');
			
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$google_datas = $this->Googlecode->find('all');
			
			$this->set('google_datas',$google_datas[0]);
			
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				
				$this->request->data['Googlecode']['id'] = $this->request->data['Googlecode']['id'];
				$this->request->data['Googlecode']['google_code'] = $this->request->data['Googlecode']['google_code'];
				$this->request->data['Googlecode']['status'] = $this->request->data['Googlecode']['status'];
				$this->Googlecode->save($this->request->data);
				$this->Session->setFlash('saved successfully');
				$this->redirect('/admin/google/code');
			}
		}
		
	}	
?>
