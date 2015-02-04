<?php
	App::uses('AppModel', 'Model');
	class Fashionuser extends AppModel {
		public $name = 'Fashionuser';
		
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user_id'),
				'Item' => array (
						'className' => 'Item',
						'foreignKey' => 'itemId')/* ,
				'Photo' => array(
						'className'    => 'Photo',
						'foreignKey' => '',
						'conditions'   => 'Photo.item_id = Fashionuser.itemId'
				) */
		);
		
	}