<?php

	App::uses('AppModel', 'Model');
	class Follower extends AppModel {
	
		
		public function flwrscnt($userid = null){
			return $this->find('all',array('conditions'=>array('Follower.user_id'=>$userid),'fields'=>array('count(Follower.user_id) as totl_flwrscnt,Follower.user_id,Follower.follow_user_id'),'group'=>array('Follower.follow_user_id')));
		}
		
		public function followcnt($userid = null){
			return $this->find('all',array('conditions'=>array('follow_user_id'=>$userid),'group'=>array('user_id')));
		}
		
		public function flwrscntlimit($userid = null, $offset, $limit){
			return $this->find('all',array('conditions'=>array('Follower.user_id'=>$userid),'fields'=>array('Follower.user_id,Follower.follow_user_id'),'group'=>array('Follower.follow_user_id'), 'offset'=>$offset, 'limit'=>$limit));
		}
		
		public function followcntlimit($userid = null, $offset, $limit){
			return $this->find('all',array('conditions'=>array('follow_user_id'=>$userid),'group'=>array('user_id'), 'offset'=>$offset, 'limit'=>$limit));
		}
		
		public function indivflwrscnt($userid = null){
			return $this->find('all',array('conditions'=>array('Follower.user_id'=>$userid),'fields'=>array('count(Follower.user_id) as totl_flwrscnt'),'group'=>array('Follower.user_id')));
		}
		
	}
?>