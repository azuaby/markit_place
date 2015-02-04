<?php
	App::uses('AppModel', 'Model');
	class Managemodule extends AppModel {
		public $name = 'Managemodule';
		
		public function beforeSave($options = array()) {
			// parent::beforeSave();
			// echo "<pre>";print_r($options);die;
			$Const_arr = $this->data['Managemodule'];
			// echo "<pre>";print_r($Const_arr);die;
			$this->data['Managemodule']['id'] = $Const_arr['id'];
			foreach($Const_arr as $kes=>$cnsts){
				// echo "<pre>";print_r($kes);
				// echo "<pre>";print_r($cnsts);die;
					$this->data['Managemodule'][$kes] = $cnsts;
				
			}
			// echo "<pre>";print_r($this->data['Managemodule']);die;
			return true;
		}
		
	}
?>	