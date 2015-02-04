<?php
	echo "<div class='info-and-appearance'>";
		echo "<div class='content-wrap-inner clear'>";
			echo "<div class='shop-rail has-shop-preview-bt clear'>";
				echo "<br clear='all' />";
				echo $this->Form->Create('Shop',array('url'=>array('controller'=>'/','action'=>'/policies/'.$name)));
					echo "<div class='section section-alt'>";
					echo "<div class='form-head'><p>Shop Policies</p></div>";
						echo "<div id='forms'><div class='abt-item'>";
							echo $this->Form->input('welcome_msg',array('type'=>'textarea','label'=>'Welcome Message','id'=>'wlcme','class'=>'inputform','value'=>$shopdats['Shop']['welcome_message']));			
							echo "<br clear='all' />";
														
							echo $this->Form->input('pymnt_plcy',array('type'=>'textarea','label'=>'Payment Policy','id'=>'pymnt_plcy','class'=>'inputform','value'=>$shopdats['Shop']['payment_policy']));
							echo "<br clear='all' />";
							
							echo $this->Form->input('shpng_plcy',array('type'=>'textarea','label'=>'Shipping Policy','id'=>'shpng_plcy','class'=>'inputform','value'=>$shopdats['Shop']['shipping_policy']));
							//echo "<span>Tell people about yourself</span>";
							echo "<br clear='all' />";
							
							echo $this->Form->input('rfnd_plcy',array('type'=>'textarea','label'=>'Refund Policy','id'=>'rfnd_plcy','class'=>'inputform','value'=>$shopdats['Shop']['refund_policy']));
							//echo "<span>Tell people about yourself</span>";
							echo "<br clear='all' />";
							
							echo $this->Form->input('add_info',array('type'=>'textarea','label'=>'Additional Information','id'=>'add_info','class'=>'inputform','value'=>$shopdats['Shop']['additional_info']));
							//echo "<span>Tell people about yourself</span>";
							echo "<br clear='all' />";
							
							echo $this->Form->input('seller_info',array('type'=>'textarea','label'=>'Seller Info','id'=>'seller_info','class'=>'inputform','value'=>$shopdats['Shop']['seller_info']));
							//echo "<span>Tell people about yourself</span>";
							echo "<br clear='all' />";
							
							
						echo "</div></div>";
					echo "</div>";
					echo $this->Form->submit('Submit');
				echo $this->Form->end();
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>
