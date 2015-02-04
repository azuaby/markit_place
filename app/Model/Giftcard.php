<?php
	App::uses('AppModel', 'Model');
	class Giftcard extends AppModel {
		public $name = 'Giftcard';
		
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user_id')
		);
		
	}
