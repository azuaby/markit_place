<?php

	App::uses('AppModel', 'Model');
	class Comment extends AppModel {
	
		public $belongsTo = array(
				'User' => array(
						'className'  => 'User',
						'foreignKey' => 'user_id'),
				'Item' => array (
						'className' => 'Item',
						'foreignKey' => 'item_id')/* ,
				'Photo' => array(
						'className'    => 'Photo',
						'foreignKey' => '',
						'conditions'   => 'Photo.item_id = Comment.item_id'
				) */
		);
		 
		public $hasOne = array(
				'Photo' => array(
						'className'    => 'Photo',
						'foreignKey' => '',
						'conditions'   => 'Comment.item_id = Photo.item_id',
						'limit'   => '1'
						//'dependent'    => true
				)
		);
		
		
		
		
	}
