<?php
	App::uses('AppModel', 'Model');
	class News extends AppModel {
		public $name = 'News';
		
	/* 	public function beforeSave($options = array()) {
			// parent::beforeSave();
			// echo "<pre>";print_r($options);die;
			$Const_arr = $this->data['News'];
			// echo "<pre>";print_r($Const_arr);die;
			$this->data['News']['id'] = $Const_arr['id'];
			foreach($Const_arr as $kes=>$cnsts){
				// echo "<pre>";print_r($kes);
				// echo "<pre>";print_r($cnsts);die;
					$this->data['News'][$kes] = $cnsts;
				
			}
			$this->data['News']['created_on'] = date("Y-m-d H:i:s");
			// echo "<pre>";print_r($this->data['News']);die;
			return true;
		} */
		
	}