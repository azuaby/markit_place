<?php
	echo "<div class='container'>";
		echo "<div class='wrapper-content '>";
				echo "<div class='payment-success'>";
					echo "<img class='paysuccessimg' src='".SITE_URL."/images/paymentsuccess.png' alt='success' />";
					echo "<p>Thank's for your purchase!</p>";
					echo "<p><span>Your payment was successful</span>.</p>";
					echo "<p style='font-size:13px;'>You will receive a Email shortly form ".$setngs[0]['Sitesetting']['site_name']."</p>";	
					
					echo "<center>".$this->Html->link('Contiue Shopping',array('controller'=>'/','action'=>'/'),array('class'=>'btn btn-success'))."</center>";
				echo "</div>";
		echo "</div>";		
	echo "</div>";		
	
?>
	