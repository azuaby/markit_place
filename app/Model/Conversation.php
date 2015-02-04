<?php

	App::uses('AppModel', 'Model');
	class Conversation  extends AppModel {
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user1',
						'order'      => 'User.id asc'
				));
		
	}
?>