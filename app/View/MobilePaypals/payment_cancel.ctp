<?php
	/* echo "<div class='container'>";
		echo "<div class='content content-wrap-inner clear'>";
			echo "<div class='wraper-full'>";
				echo "<div class='wraper-inner'>";
					echo "<center>Ypur Payment was Cancelled , please Try again</center>";	
					echo "<br clear='all' /><br />";
					echo "<center>".$this->Html->link('Contiue Shopping',array('controller'=>'/','action'=>'/'),array('class'=>'btn btn-success'))."</center>";
				echo "</div>";
			echo "</div>";
		echo "</div>";		
	echo "</div>";	 */
?>

<?php
	echo "<div class='container' align='center'>";
		echo "<div class='wrapper-content '>";
				echo "<div class='payment-success'>";
					//echo "<img class='paysuccessimg' src='".SITE_URL."/images/paymentsuccess.png' alt='success' />";
					echo "<p>Something went worng!</p>";
					echo "<p><span style='color:#B53A4A;'>Your payment was Cancelled, please try again</span>.</p>";
					//echo "<p style='font-size:13px;'>You will receive a Email shortly form ".$setngs[0]['Sitesetting']['site_name']."</p>";	
					
					echo "<center>".$this->Html->link('Contiue Shopping',array('controller'=>'/','action'=>'/'),array('class'=>'btn btn-success','data-ajax'=>'false'))."</center>";
				echo "</div>";
		echo "</div>";		
	echo "</div>";		
	
?>
