<?php
	App::uses('AppModel', 'Model');
	class Groupgiftpayamt extends AppModel {
		public $name = 'Groupgiftpayamt';
		
		public $belongsTo = array(
				'User' => array(
						'className'     => 'User',
						'foreignKey'    => 'paiduser_id',
						'order'         => 'User.id asc'
				)
		);
		
	}
