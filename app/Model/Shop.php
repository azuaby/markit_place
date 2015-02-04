<?php

	App::uses('AppModel', 'Model');
	class Shop extends AppModel {
	
		/* function beforeValidate()
    {
		// echo "<pre>";print_r($this->data);die;
        // MySQL Unique Constraint Checks
        $unique_check = array(
            'shop_name' => $this->data[$this->name]["shop_name"],
			'id <>'=>$this->data[$this->name]["id"]
        );
		// var_dump($this->isUnique($unique_check));die;

        if (!$this->isUnique($unique_check))
            $this->invalidate('unique');
    } */
	
		public $belongsTo = array(
			'User' => array(
				'className'     => 'User',
				'foreignKey'    => 'user_id',
				'order'         => 'User.id asc'
			)
		);
		
		public $hasMany = array(
			'Item' => array(
				'className'     => 'Item',
				'foreignKey'    => 'shop_id',
				'conditions'   => 'Item.status LIKE "publish" OR Item.status LIKE ""',
				'order'         => 'Item.id DESC',
				'limit'			=> '10'
			)
		);
	}
?>