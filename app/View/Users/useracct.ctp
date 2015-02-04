<?php
	echo "<h1>Creating Agent/Customer</h1>";
	echo $this->Form->create('users',array('url'=>array('controller'=>'/','action'=>'/user_account'),'id'=>'useraccount'));
		echo $this->Form->input('username',array('type'=>'text','id'=>'name','class'=>'inputform'));
		echo $this->Form->input('email',array('type'=>'text','id'=>'emailid','class'=>'inputform'));
		
		$type = array('agent'=>'Agent','normal'=>'Normal');
		echo $this->Form->input('user_level',array('options'=>$type,'empty'=>'--Select--','id'=>'types','label'=>'User Level'));
		echo $this->Form->submit('Submit');
	echo $this->Form->end();
?>