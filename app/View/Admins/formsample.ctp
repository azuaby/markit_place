<?php
	echo "<div class='leftside' style='float:left;width:500px;'>";
		echo $this->Form->create('sample',array('url'=>array('controller'=>'/','action'=>'/formsample'),'id'=>'sample'));
			echo $this->Form->input('username',array('type'=>'text','id'=>'names','class'=>'inputform'));
			echo $this->Form->input('email',array('type'=>'text','id'=>'emailid','class'=>'inputform'));
			echo $this->Form->submit('Submit');
		echo $this->Form->end();
	echo "</div>";
	echo "<div class='rightside' style='float:right;'>";
		echo "<div class='uname'>Enter your Username</div>";
		echo "<div class='emails'>Enter your email address</div>";
	echo "</div>";
?>