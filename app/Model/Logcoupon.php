<?php
	App::uses('AppModel', 'Model');
	class Logcoupon extends AppModel {
		public $name = 'Logcoupon';
		
		
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user_id'
			)
		);

	}
