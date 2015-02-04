<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('Referrals');?></h2>
        <div class="figure-row" style="padding: 14px 36px 34px 18px;">
        <div class="referalcount">
        	<span class="invtot"><?php echo __('Invited');?>: <?php echo $invitCount; ?></span>
        	<span class="jontot"><?php echo __('Joined');?>: <?php echo $joinedCount; ?></span>
        </div>
        	<h3><?php echo __('Referral Status');?></h3>
       <?php
			if (count($invited_friend) > 0) {
			
			?>
       
        <table class="myorderslist" >
			<colgroup>
			<col width="250">
			<col width="145">
			<col width="100">
			<col width="90">
			<col width="110">
			</colgroup>
				<thead>	
					<tr>
					<th><?php echo __('Username');?></th>
					<th><?php echo __('Invited');?></th>
					<!--th>Via</th-->
					<th><?php echo __('Status');?></th>
					</tr>
				</thead>
			<tbody>
        
        
		<?php foreach($invited_friend as $ky=>$invite){ ?>
									
				<tr class="bordremi">
				<td ><?php echo $invite['Userinvite']['invited_email']; ?></td>
				<td><?php echo $day=date('m/d/Y',$invite['Userinvite']['invited_date']); ?></td>
				<!--td>Email</td-->
				<td>
				<?php 
				if($invite['Userinvite']['status'] == 'Joined'){
					echo '<span style="color:#00FF00;">'.$invite['Userinvite']['status'].'</span>';
				}else{
					echo '<span style="color:#FF0000;">'.$invite['Userinvite']['status'].'</span>';
				}
				 ?>
				</td>
				<!--td class="link">
				<a class="resend-email" email="" href="#">Resend Invitation</a>
				</td-->
				</tr>
		<?php
				}
			}else {
				echo '<div style="text-align:center;color:#ff0000;font-size:20px;">'?>
					<?php echo __('You havn’t invited anyone yet.');echo '</div>';
						echo '<div style="text-align:center;font-size:14px;"><a  href="'.SITE_URL.'invite_friends"  >'?><?php echo __('Invite friends');'</a></div>';
				echo "</div>";
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
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a class="current"  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
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
