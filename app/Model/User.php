<?php

	App::uses('AppModel', 'Model');
	class User extends AppModel {
	
		public $hasMany = array(
			'Shopfav' => array(
				'className'  => 'Shopfav',
				'foreignKey' => 'user_id',
				'limit' => 10, 
			),'Itemfav' => array(
				'className'    => 'Itemfav',
				'foreignKey'    => 'user_id',
				'limit' => 10,
				'order'      => 'Itemfav.id desc'
			)
		); 
		
		public $hasOne = array(
			'Shop' => array(
				'className'    => 'Shop',
				'conditions'   => 'Shop.user_id = User.id',
				'dependent'    => true 
			)
		);
		
	}

