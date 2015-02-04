<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> <?php echo __('Credits');?></h2>
        <div class="figure-row" style="padding: 36px 34px 18px;">
       <?php
			if (count($invite_credits) > 0) {
			echo '<div style="text-align:center;font-size:20px;">'?><?php echo __('Available Credits');echo '</div>';
			echo '<br />';
			
			if($available_bal > 0){
				$available_bal = $available_bal;
			}else{
				$available_bal = 0;
			}
			
			echo '<div style="text-align:center;font-size:30px;color:#00B500;">'.$_SESSION['default_currency_symbol']." ".$available_bal.' '.$_SESSION['default_currency_code'].'</div>';//$invite_credits
			echo '<br />';
			
			echo '<h3 style="text-align:center;">'?><?php echo __('Credit Summary'); echo '</h3>';
			echo '<p style="text-align:center;">'.ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])).' Credits can be applied on your purchases during checkout.</p>';
			echo '<br />';
			
			echo '<h3>'?><?php echo __('Total Amount:'); echo '</h3>';
			echo '<p>'.$_SESSION['default_currency_symbol']." ".$invite_credits.'.00 </p>';
			echo '<br />';
			
			
			
			
			echo '<div style="font-size:14px;">' ?> <?php echo __('Credit History');echo '</div>';
			
			?>
			
			<table class="myorderslist"  >
			<colgroup>
			<col width="250">
			<col width="250">
			<col width="250">
			</colgroup>
				<thead>	
					<tr>
					<th><?php echo __('Username');?></th>
					<th><?php echo __('Date');?></th>
					<th><?php echo __('Amount');?></th>
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
			}else {
				echo '<div style="text-align:center;color:#ff0000;font-size:20px;">'?>
						<?php echo __('Your Credit amount is empty.');echo '</div>';
						echo '<div style="text-align:center;font-size:14px;">'?><?php echo __('Earn more credits by'); echo '<a  href="'.SITE_URL.'invite_friends"  >'?><?php echo __('Invite friends');echo '</a></div>';
			} ?>
			
</tbody>
</table>
			
		</div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
			<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php echo __('My Orders');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i><?php echo __('Add Shipping');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __('MERCHANT');?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php echo __('Information');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales');?></a></dd>
	        </dl>
	        
	        <dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a class="current" href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
	        </dl>
			
		</div>
				<!-- <footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
			
</div>	
