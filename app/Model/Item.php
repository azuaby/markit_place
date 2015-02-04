<?php
	App::uses('AppModel', 'Model');
	class Item extends AppModel {
		public $name = 'Item';
		
		
		public $hasMany = array(
			'Photo' => array (
				'className' => 'Photo',
				'foreignKey' => 'item_id'
			),'Shiping' => array (
				'className' => 'Shiping',
				'foreignKey' => 'item_id'
			),'Itemfav' => array (
				'className' => 'Itemfav',
				'foreignKey' => 'item_id'
			),'Comment' => array (
				'className' => 'Comment',
				'foreignKey' => 'item_id'
			),'Log' => array (
				'className' => 'Log',
				'foreignKey' => 'notification_id'
			)
		); 
		
		 public $belongsTo = array(
			'User' => array(
				'className'  => 'User',
				'foreignKey' => 'user_id',
				'order'      => 'User.id asc'
			) ,'Shop' => array(
				'className'  => 'Shop',
				'foreignKey' => 'shop_id',
				'order'      => 'Shop.id asc'
			) 
		); 
		
		
		function itemtotl_cnt($userid = null){
			return $this->find('count',array('conditions'=>array('Item.user_id'=>$userid),'group'=>array('Item.user_id')));
		}
	}	
