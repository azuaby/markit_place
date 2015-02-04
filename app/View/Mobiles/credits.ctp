<div class="container set_area">
        <div id="content">
        <div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <b class="ui-li-heading" style="font-size:15px;"><?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> Credits</b>
        <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
        <hr>
        <div class="figure-row">
       <?php
			if (count($invite_credits) > 0) {
			echo '<h4 class="ui-li-heading">Available Credits</h4>';
			
			
			if($available_bal > 0){
				$available_bal = $available_bal;
			}else{
				$available_bal = 0;
			}
			
			echo '<div style="text-align:center;font-size:30px;color:#00B500;">'.$_SESSION['default_currency_symbol']." ".$available_bal.' '.$_SESSION['default_currency_code'].'</div>';//$invite_credits
			echo '<br /></div>';
			echo '<hr>';
			echo '<h4 style="text-align:center;">Credit Summary</h4>';
			echo '<p style="text-align:center;font-size:13px;">'.ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])).' Credits can be applied on your purchases during checkout.</p>';
			echo '<hr>';
			
			echo '<h4> Total Amount: </h4>';
			echo '<p style="font-size:13px;">'.$_SESSION['default_currency_symbol']." ".$invite_credits.'.00 </p>';
			echo '<hr>';
			
			
			
			
			echo '<h4>Credit History</h4>';
			
			?>
			
			<table class="myorderslist" width="100%" border="1" cellpadding="10" cellspacing="0">
			<colgroup>
			<col width="250">
			<col width="250">
			<col width="250">
			</colgroup>
				<thead>	
					<tr>
					<th align="left">Username</th>
					<th align="left">Date</th>
					<th align="left">Amount</th>
					</tr>
				</thead>
			<tbody>
			<?php
			foreach($creditamt_user as $ky=>$usrr){ 
			?>
			
			<tr class="bordremi">
				<td ><?php if($usrr['Userinvitecredit']['user_id']=='0'){
						echo "From group gift";
				}else{
					echo $usrr['User']['username'];				
				} ?></td>
				<td><?php echo $day=date('m/d/Y',$usrr['Userinvitecredit']['cdate']); ?></td>
				<td><?php echo $usrr['Userinvitecredit']['credit_amount']; ?></td>
				
			</tr>
			<?php
			}
			echo '</tbody></table>';
			}else {
			echo '';
				echo '<br /><div style="text-align:center;color:#ff0000;font-size:20px;">
						Your Credit amount is empty.</div><br />';
						echo '<div style="text-align:center;font-size:14px;">Earn more credits by <a data-ajax="false" href="'.SITE_URL.'mobile/invite_friends"  >Invite friends</a></div>';
						echo '</div>';
			} ?>
			

		
		
	</div>

			

