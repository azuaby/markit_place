<?php
	App::uses('AppModel', 'Model');
	class Groupgiftuserdetail extends AppModel {
		public $name = 'Groupgiftuserdetail';
		
		public $belongsTo = array(
				'User' => array(
						'className'     => 'User',
						'foreignKey'    => 'user_id',
						'order'         => 'User.id asc'
				)
		);
		
	}
