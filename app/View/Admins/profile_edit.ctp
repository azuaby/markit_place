<?php
	echo $this->Form->Create('profile',array('url'=>array('controller'=>'/','action'=>'/profile/edit/'.$userdata['User']['id']),'id'=>'profileform'));
		
		echo $this->Form->input('edituser',array('type'=>'text','label'=>'User Name','id'=>'edituser','class'=>'inputform','value'=>$userdata['User']['username']));
		
		echo $this->Form->input('editemail',array('type'=>'text','label'=>'Email','id'=>'editemail','class'=>'inputform','value'=>$userdata['User']['email']));
		echo "<br clear='all'/><br/>";
		echo "<label>Do you want to change the password</label>";
		echo $this->Form->radio('changepass',array( 'yes'=>'Yes', 'no'=>'No'),array('default'=>'no','fieldset'=>false,'label'=>false,'legend'=>false,'class'=>'changepass','style'=>'float:none;'));
		
		echo "<br/><br/>";
		echo "<label class='pass1' style='display:none;'>Password</label>";
		echo $this->Form->input('editpassword',array('type'=>'password','label'=>false,'id'=>'editpassword','class'=>'inputform','style'=>'display:none;'));
		echo "<br/>";
		
		/* echo $this->Form->input('editaddress',array('type'=>'text','id'=>'editaddress','class'=>'inputform','label'=>'Address'));
		echo $this->Form->input('editcounty',array('type'=>'text','id'=>'editcounty','class'=>'inputform','label'=>'County'));
		echo $this->Form->input('editphoneno',array('type'=>'text','id'=>'editphoneno','class'=>'inputform','label'=>'Phone number'));
		echo $this->Form->input('editwebsite',array('type'=>'text','id'=>'editwebsite','class'=>'inputform','label'=>'Website')); */
		
		echo $this->Form->submit('Submit');
	echo $this->Form->end();
?>