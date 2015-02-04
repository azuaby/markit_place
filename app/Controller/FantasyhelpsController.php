<?php
App::uses('AppController', 'Controller');

class FantasyhelpsController extends AppController{
	public $names =  'Fantasyhelps';
	public $uses = array('Item','Comment');
	public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
	public $helpers = array('Form','Html');
	
	public function faq() {
		$this->layout = "helplayout";

		
		$this->loadModel('Help');
		$faq = $this->Help->find('all');
			foreach($faq as $faq) {
				$main = $faq['Help']['main_faq'];
				$sub = $faq['Help']['sub_faq'];
				
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			}
	}
	
	public function contact() {
		global $loguser;
		global $setngs;
		global $siteChanges;
		$this->layout = "helplayout";
		$this->loadModel('Users');
		$this->loadModel('Help');
	
		$contact = $this->Help->find('all');
			foreach($contact as $contacts) {
				$address = $contacts['Help']['contact'];
			}
		$this->set('contact',$address);
		
		if(!empty($this->request->data)){
			$name = $this->request->data['contact_name'];
			$email = $this->request->data['contact_email'];
			$topic = $this->request->data['topic'];
			$order = $this->request->data['contact_order'];
			$userAccount = $this->request->data['contact_user'];
			$message = $this->request->data['contact_message'];
			
			if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
				$this->Email->smtpOptions = array(
					'port' => $setngs[0]['Sitesetting']['smtp_port'],
					'timeout' => '30',
					'host' => 'ssl://smtp.gmail.com',
					'username' => $setngs[0]['Sitesetting']['noreply_email'],
					'password' => $setngs[0]['Sitesetting']['noreply_password']);
		
				$this->Email->delivery = 'smtp';
			}
			$this->Email->to = $setngs[0]['Sitesetting']['support_email'];
			$this->Email->subject = "Enquiry from a user";
			$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
			$this->Email->sendAs = "html";
			$this->Email->template = 'contact_mails';
			$this->set('name', $name);
			$this->set('userAccount', $userAccount);
			$this->set('topic', $topic);
			$this->set('order',$order);
			$this->set('message',$message);
			$this->set('email',$email);
			
			$this->Email->send();
			echo "<script> alert('Thanks!');</script>";
		}
	}
	
	public function copyrights(){
		$this->layout = "helplayout";
		$this->loadModel('Help');
		$copyright = $this->Help->find('all');
			foreach($copyright as $copyrights) {
				$main = $copyrights['Help']['main_copyright'];
				$sub = $copyrights['Help']['sub_copyright'];
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			}
		
	}
	
	public function termsofsale(){
		$this->layout = "helplayout";
		
		$this->loadModel('Help');
		$termsofsale = $this->Help->find('all');
			foreach($termsofsale as $termsofsales) {
				$main = $termsofsales['Help']['main_termsofSale'];
				$sub = $termsofsales['Help']['sub_termsofSale'];
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			}
	}
	
	public function termsofservice(){
		$this->layout = "helplayout";

		
		$this->loadModel('Help');
		$termsofservice = $this->Help->find('all');
			foreach($termsofservice as $termsofservices) {
				$main = $termsofservices['Help']['main_termsofService'];
				$sub = $termsofservices['Help']['sub_termsofService'];
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			}
	}
	
	public function termsofmerchant(){
		$this->layout = "helplayout";

		$this->loadModel('Help');
		$termsofmerchant = $this->Help->find('all');
			foreach($termsofmerchant as $termsofmerchants) {
				$main = $termsofmerchants['Help']['main_termsofMerchant'];
				$sub = $termsofmerchants['Help']['sub_termsofMerchant'];
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			}
	}
	
	public function privacy(){
		$this->layout = "helplayout";

		$this->loadModel('Help');
		$privacy = $this->Help->find('all');
			foreach($privacy as $privacy) {
				$main = $privacy['Help']['main_privacy'];
				$sub = $privacy['Help']['sub_privacy'];
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			}
	}
	public function addto(){
		$this->layout = "helplayout";
	}
	public function mobile(){
		$this->layout = "helplayout";
	}
}
