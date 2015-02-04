<?php
	App::uses('AppModel', 'Model');
	class Review extends AppModel {
		public $name = 'Review';
		
		public $belongsTo = array(
			'User' => array(
				'className'  => 'User',
				'foreignKey' => 'userid',
			)
		); 
		

		/* public $hasMany = array(
			'Item' => array(
				'className'     => 'Item',
				'foreignKey'    => 'category_id',
				'order'         => 'Item.created_on asc'
			)
		);  */
		 
		
		/* public function beforeSave($options = array()) {
			// parent::beforeSave();
			// echo "<pre>";print_r($options);die;
			// echo "<pre>";print_r($this->data);die;
			if(empty($this->data['Category']['sections'])){
				$this->data['Category']['section_parent'] = 0;
			}else{
				$this->data['Category']['section_parent'] = $this->data['Category']['sections'];
			}
			$this->data['Category']['created_by'] = $options['fields']['user_id'];
			// echo "<pre>";print_r($this->data['Category']);die;
			return true;
		} */
		
	
	}
	
	
?>