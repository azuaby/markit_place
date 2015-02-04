<div class="container set_area">
        <div id="content">
        <div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <b class="ptit" style="font-size:15px;"><?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> Gift Card</b>
        <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
       <hr>
        <div class="figure-row"">
       
		
			<?php
			if (!empty($giftcarddets) || !empty($giftcarddets_recv)) { 
			?>
			
			
			<?php 
			if (!empty($giftcarddets_recv)) {
				?>
							
									<?php
									foreach($giftcarddets_recv as $ky=>$gif){ 
									?>
									
								
										<div style="font-size:15px;"><b>Sender :</b> <?php echo $gif['User']['username']; ?></div><br />
										<div style="font-size:15px;"><b>Receiver :</b> <?php echo $gif['Giftcard']['reciptent_name']; ?></div><br />
										<div style="font-size:15px;"><b>Date :</b> <?php echo $day=date('m/d/Y',$gif['Giftcard']['cdate']); ?></div><br />
										<div style="font-size:15px;"><b>Total Amount :</b> <?php echo $gif['Giftcard']['amount']; ?></div><br />
										<div style="font-size:15px;"><b>Avl.Amount :</b> <?php echo $gif['Giftcard']['avail_amount']; ?></div><br />
										<div style="font-size:15px;"><b>Key :</b> <?php echo $gif['Giftcard']['giftcard_key']; ?></div><br />
										<div style="font-size:15px;"><b>Status :</b> <?php echo "Received"; ?></div><hr>
										
									
									<?php
									}
									}
									
			foreach($giftcarddets as $ky=>$gif){ 
			?>
			
			
				<div style="font-size:15px;"><b>Sender :</b> <?php echo $gif['User']['username']; ?></div><br />
				<div style="font-size:15px;"><b>Receiver :</b> <?php echo $gif['Giftcard']['reciptent_name']; ?></div><br />
				<div style="font-size:15px;"><b>Date :</b> <?php echo $day=date('m/d/Y',$gif['Giftcard']['cdate']); ?></div><br />
				<div style="font-size:15px;"><b>Total Amount :</b> <?php echo $gif['Giftcard']['amount']; ?></div><br />
				<div style="font-size:15px;"><b>Avl.Amount :</b> <?php echo $gif['Giftcard']['avail_amount']; ?></div><br />
				<div style="font-size:15px;"><b>Key :</b> <?php echo $gif['Giftcard']['giftcard_key']; ?></div><br />
				<div style="font-size:15px;"><b>Status :</b> <?php echo "Sent"; ?></div><hr>
				
			
			<?php
			}
			
			
			
			
			
			}else {
			echo '';
				echo '<div style="text-align:center;color:#ff0000;font-size:20px;">
						Your haven\'t received any gift cards yet.</div>';
						echo '<div style="text-align:center;font-size:14px;"><a  href="'.SITE_URL.'mobile/create/giftcard"  >Send Gift Card</a> Or <a  href="'.SITE_URL.'mobile/create/giftcard"  >Redeem a Gift Card</a></div>';
						echo '</div>';	
			}  ?>
			
			
			
			

			
		</div>	
	</div>
	
			
</div>	
