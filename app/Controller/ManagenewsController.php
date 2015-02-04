<?php
	App::uses('AppController', 'Controller');
	
	class ManagenewsController extends AppController{
		public $names =  'Managenews';
		public $uses = array('News');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
		public $helpers = array('Form','Html');
		public $layout = 'admin';
		
		
		function view_news(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','News Management');
			
			$news_data = $this->News->find('all',array('order'=>array('id'=>'desc')));
			
			$this->set('news_data',$news_data);
			
			// echo "<pre>";print_R($baners_data);die;
		
		}
		
		function add_news(){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','News Management');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				
				$this->request->data['News']['user_id'] = $loguser[0]['User']['id'];
				$this->News->save($this->request->data);
				$this->Session->setFlash('News saved successfully');
				$this->redirect('/admin/view/news');
			}
		
		}
		
		function edit_news($id=null){
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			if(empty($id)){
				$this->redirect('/');
			}	
				
			$this->set('title_for_layout','News Management');
			
			$news_data = $this->News->findById($id);
			
			$this->set('news_data',$news_data);
			$this->set('id',$id);
			
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				// $this->request->data['News']['id']
				$this->request->data['News']['user_id'] = $loguser[0]['User']['id'];
				$this->News->save($this->request->data);
				
				$this->Session->setFlash('News saved successfully');
				$this->redirect('/admin/view/news');
			}
		
		}
		
		public function newsdeletes(){
			
			$id = $_REQUEST['id'];
			$this->News->delete($id);
			echo 0;
			die;
		}
		
		
	public function getpushajax(){
			$this->layout = 'ajax';
			//$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Comment');
			$this->loadModel('Follower');
			$this->loadModel('Log');
			$this->loadModel('User');
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$flwrscnt = $this->Follower->findAllByfollow_user_id($userid);
			foreach($flwrscnt as $flwr){
				$flwruserid[] = $flwr['Follower']['user_id'];
			}
				
		
			/* if(!empty($flwruserid)){
				$userlogd = $this->Log->find('all',array('conditions' =>array('user_id' =>$flwruserid),'order'=>array('id'=>'desc')));
			} */
				if(empty($flwruserid)){
					$userlogd = $this->Log->find('all',array('conditions' =>array('OR' => array(array('user_id' =>$flwruserid),array('type' => 'follow'))),'order'=>array('id'=>'desc')));
				}else{
					$userlogd = $this->Log->find('all',array('conditions' =>array('user_id' =>$flwruserid),'order'=>array('id'=>'desc')));
				}
				
				
				
				$userDetails = $this->User->find('first',array('conditions' =>array('User.id' =>$userid)));
				$decoded_value = json_decode($userDetails['User']['push_notifications']);
		
				if(!empty($decoded_value)){
					foreach($userlogd as $log){
						$not_type[$log['Log']['id']] = $log['Log']['type'];
						$notific_id[$log['Log']['id']] = $log['Log']['notification_id'];
						if($decoded_value->frends_cmnts_push == '1'){
							if($log['Log']['type'] == 'comment'){
								$logedvalues[]= $itemdatasall = $this->Comment->findById($log['Log']['notification_id']);
							}
						}
						if($decoded_value->frends_flw_push == '1'){
							if($log['Log']['type'] == 'favorite'){
								$logedvalues[] = $itemdatasall = $this->Item->findById($log['Log']['notification_id']);
							}
							if($log['Log']['type'] == 'additem'){
								$logedvalues[] = $itemdatasall = $this->Item->findById($log['Log']['notification_id']);
							}
							/* if($log['Log']['type'] == 'follow'){
								$logedvalues[] = $itemdatasall = $this->User->findById($log['Log']['follow_id']);
							}*/
                                                         
                                                       /* if($log['Log']['type'] == 'follow'){
							   //echo $log['Log']['user_id'];
							   $logedvalues[] = $this->User->findById($log['Log']['user_id']);
							   //echo "<pre>";print_r($getLogvalues);
						        } */

                            if($log['Log']['type'] == 'sellermessage'){
								$logedvalues[] =  $this->User->findById($log['Log']['user_id']);
							}


						}

					 if($log['Log']['type'] == 'follow'  && $userid == $log['Log']['follow_id'] ){
			
                     	$getLogvalues1 = $this->Log->find('all',array('conditions'=>array('follow_id'=>$userid,'type'=>'follow')));
                     	foreach($getLogvalues1 as $getlogv){
                     		//echo "<pre>";print_r($getlogv);die;
                     		$userids = $getlogv['Log']['user_id'];
                     		$logedvalues[] = $this->User->findById($userids);
                     	}
						//$getLogvalues[] = $this->User->findById($log['Log']['user_id']);
                     
                     }          
							
					}
					$this->set('decoded_value',$decoded_value);
					$this->set('logedvalues',$logedvalues);
					$this->set('userlogd',$userlogd);
					$this->set('userid',$userid);
				}
			//}
		
		}
		
	}	
?>