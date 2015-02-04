<?php
App::uses('AppController', 'Controller');

class MobileFantasyhelpsController extends AppController{
	public $names =  'Fantasyhelps';
	public $uses = array('Item','Comment');
	public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
	public $helpers = array('Form','Html');

	public function mobileapps(){
		$this->layout = "mobilelayout";
	}
}