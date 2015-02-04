<?php 
if ($layout == 'default'){
	echo $this->element('defaulthome');
}else{
	echo $this->element('customhome');
}