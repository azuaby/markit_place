<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $name = 'Pages';
	public $helpers = array('Form','Html');
	public $uses = array('Item','Photo'); 
	public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
	public function home() {
		global $username;
		global $user_level;
		$this->set('username',$username);
		$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order' => array('Item.id DESC')));
		$this->set('items_data',$items_data);
	}
	
	
	public function source() {
	
	
	}
	
	 public function testing() {
	 	$this->loadModel('Groupgiftpayamt');
	 	
	 	$userDET = $this->Groupgiftpayamt->find('all',array('conditions'=>array('Groupgiftpayamt.ggid'=>1)));

	 	
	 	foreach($userDET as $userss){
	 		$emailss[] = $userss['User']['email'];
	 	}
	 	echo "<pre>";print_r($emailss);die;
	 	
	} 
	
	
	
	
	public function FetchPage($path)
	{
		$file = fopen($path, "r");
	
		if (!$file)
		{
			exit("The was a connection error!");
		}
	
		$data = '';
	
		while (!feof($file))
		{
			// Extract the data from the file / url    <image><url><![CDATA[{$sImage}]]></url><title><![CDATA[{$sRSSTitle}]]></title><link><![CDATA[{$sMainLink}]]></link></image>
	
			$data .= fgets($file, 1024);
		}
		return $data;
	}
	
	
}
