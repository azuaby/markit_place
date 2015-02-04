<?php
	App::uses('AppModel', 'Model');
	class Banner extends AppModel {
		public $name = 'Banner';
		
		/* public function beforeSave($options = array()) {
			// parent::beforeSave();
			// echo "<pre>";print_r($options);die;
			$Const_arr = $this->data['Banner'];
			// echo "<pre>";print_r($Const_arr);die;
			$this->data['Banner']['id'] = $Const_arr['id'];
			foreach($Const_arr as $kes=>$cnsts){
				// echo "<pre>";print_r($kes);
				// echo "<pre>";print_r($cnsts);die;
					$this->data['Banner'][$kes] = $cnsts;
				
			}
			$this->data['Banner']['created_at'] = date("Y-m-d H:i:s");
			// echo "<pre>";print_r($this->data['Banner']);die;
			return true;
		} */
		
	}
