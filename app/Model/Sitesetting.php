<?php
	App::uses('AppModel', 'Model');
	class Sitesetting extends AppModel {
		public $name = 'Sitesetting';
		
		public function beforeSave($options = array()) {
			// parent::beforeSave();
			// echo "<pre>";print_r($options);die;
			$Const_arr = $this->data['Sitesetting'];
			// echo "<pre>";print_r($Const_arr);die;
			$this->data['Sitesetting']['id'] = $Const_arr['id'];
			foreach($Const_arr as $kes=>$cnsts){
				// echo "<pre>";print_r($kes);
				// echo "<pre>";print_r($cnsts);die;
					$this->data['Sitesetting'][$kes] = $cnsts;
				
			}
			$this->data['Sitesetting']['created_at'] = date("Y-m-d H:i:s");
			// echo "<pre>";print_r($this->data['Sitesetting']);die;
			return true;
		}
		
	}
?>