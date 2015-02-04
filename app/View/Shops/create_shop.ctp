<?php
	echo "<div class='containerdiv'>";
		echo "<br clear='all' />";
		echo $this->Form->Create('Shop',array('url'=>array('controller'=>'/','action'=>'/your/shops'),'id'=>'shopform'));

			if(empty($shop_dats)){
				$shopnme = '';
			}else{
				$shopnme = $shop_dats['Shop']['shop_name'];
			}
			
			echo "<div id='forms'>";
				echo $this->Form->input('shop_name',array('type'=>'text','label'=>'Shop Name','id'=>'text_box_id','class'=>'inputform','value'=>$shopnme));			
				echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$userid));			
				echo "<br clear='all' />";
			
			echo "</div>";
			echo $this->Form->submit('Submit');
		echo $this->Form->end();
	echo "</div>";
?>