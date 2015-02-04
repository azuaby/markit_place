<?php

	App::uses('AppModel', 'Model');
	class Cart extends AppModel {
	
			/* function beforeValidate()
		{
			// echo "<pre>";print_r($this->data);die;
			// MySQL Unique Constraint Checks
			$unique_check = array(
				'item_id' => $this->data[$this->name]["item_id"],
				'user_id'=>$this->data[$this->name]["user_id"],
				'payment_status'=>'progress'
			);
			// var_dump($this->isUnique($unique_check));die;

			if (!$this->isUnique($unique_check))
				$this->invalidate('unique');
		} */
		
		
		function totitms($userid){
			return $this->find('count',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress')));
		}
		
		function getTopCart($userid){
			return $this->find('all',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress'),'limit'=>'4','order'=>array("id"=>"desc")));
		}
	
	}
?>