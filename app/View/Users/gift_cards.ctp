<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> <?php echo __('Gift Card');?></h2>
        <div class="figure-row" style="padding: 36px 34px 18px;">
       
		
			<?php
			if (!empty($giftcarddets) || !empty($giftcarddets_recv)) { 
			?>
			
			<table class="myorderslist" >
			<colgroup>
			<col width="150">
			<col width="150">
			<col width="150">
			<col width="150">
			<col width="150">
			<col width="150">
			</colgroup>
				<thead>	
					<tr>
					<th><?php echo __('Sender');?></th>
					<th><?php echo __('Receiver');?></th>
					<th><?php echo __('Date');?></th>
					<th><?php echo __('Total Amount');?></th>
					<th><?php echo __('Avl.Amount');?></th>
					<th><?php echo __('Key');?></th>
					<th><?php echo __('Status');?></th>
					</tr>
				</thead>
			<tbody>
			<?php 
			if (!empty($giftcarddets_recv)) {
				?>
							
									<?php
									foreach($giftcarddets_recv as $ky=>$gif){ 
									?>
									
									<tr class="bordremi">
										<td ><?php echo $gif['User']['username']; ?></td>
										<td><?php echo $gif['Giftcard']['reciptent_name']; ?></td>
										<td><?php echo $day=date('m/d/Y',$gif['Giftcard']['cdate']); ?></td>
										<td><?php echo $gif['Giftcard']['amount']; ?></td>
										<td><?php echo $gif['Giftcard']['avail_amount']; ?></td>
										<td><?php echo $gif['Giftcard']['giftcard_key']; ?></td>
										<td><?php echo "Received"; ?></td>
										
									</tr>
									<?php
									}
									}
									
			foreach($giftcarddets as $ky=>$gif){ 
			?>
			
			<tr class="bordremi">
				<td ><?php echo $gif['User']['username']; ?></td>
				<td><?php echo $gif['Giftcard']['reciptent_name']; ?></td>
				<td><?php echo $day=date('m/d/Y',$gif['Giftcard']['cdate']); ?></td>
				<td><?php echo $gif['Giftcard']['amount']; ?></td>
				<td><?php echo $gif['Giftcard']['avail_amount']; ?></td>
				<td><?php echo $gif['Giftcard']['giftcard_key']; ?></td>
				<td><?php echo "Sent"; ?></td>
				
			</tr>
			<?php
			}
			
			
			
			
			
			}else {
				echo '<div style="text-align:center;color:#ff0000;font-size:20px;">'?>
						<?php echo __('Your haven\'t received any gift cards yet.');echo '</div>';
						echo '<div style="text-align:center;font-size:14px;"><a  href="'.SITE_URL.'create/giftcard"  >'?><?php echo __('Send Gift Card');echo '</a> Or <a  href="'.SITE_URL.'create/giftcard"  >'?><?php echo __('Redeem a Gift Card');echo '</a></div>';
			}  ?>
			
			
			
			
</tbody>
</table>
			
		</div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo ('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo ('Password');?></a></dd>
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
           		 <dd><a href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a class="current"  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
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
