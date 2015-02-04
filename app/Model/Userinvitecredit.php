<?php

	App::uses('AppModel', 'Model');
	class Userinvitecredit extends AppModel {
		public $name = 'Userinvitecredit';
	
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user_id')
		);
		
		
	}

