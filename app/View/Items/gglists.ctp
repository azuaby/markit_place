<div class="container set_area" style="width:940px;">
	<div id="content">
		<h2 class="ptit" style="padding: 1px 0px 0px 10px;"><?php echo __('Group Gift Lists');?></h2>

		<div class=" section shipping">
			<?php if (count($gglistdatas) > 0 ) { ?> 
			<h3><?php echo __('Group Gift History');?></h3>
			<div class="chart-wrap">
				
				<table class="chart">
				<thead>
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Contribution');?></th>
						<th><?php echo __('Start date');?></th>
						<th><?php echo __('End date');?></th>
						<th><?php echo __('Status');?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php //print_r($shippingModel);
					foreach ($gglistdatas as $ggdata) {
					$ggid = $ggdata['Groupgiftuserdetail']['id'];
					$fullname = $ggdata['Groupgiftuserdetail']['name'];
					$address1 = $ggdata['Groupgiftuserdetail']['address1'];
					$address2 = $ggdata['Groupgiftuserdetail']['address2'];
					$city = $ggdata['Groupgiftuserdetail']['city'];
					$state = $ggdata['Groupgiftuserdetail']['state'];
					$country = $ggdata['Groupgiftuserdetail']['country'];
					$zip = $ggdata['Groupgiftuserdetail']['zipcode'];
					$datefirst = $ggdata['Groupgiftuserdetail']['c_date'];
					$datelast = $ggdata['Groupgiftuserdetail']['c_date'] + 604800;
					$fday=date("F j, Y, g:i a",$datefirst);
					$lday=date("F j, Y, g:i a",$datelast);
					$statuss = $ggdata['Groupgiftuserdetail']['status'];
					$amount = $ggdata['Groupgiftuserdetail']['total_amt'];
					$balance_amt = $ggdata['Groupgiftuserdetail']['balance_amt'];
					
					?>
					<tr class="shipping<?php echo $ggid; ?>">
						<td><b><a href="<?php echo SITE_URL; ?>gifts/<?php echo $ggid; ?>"><?php echo $fullname; ?></a></b></td>
						<td><?php //echo $statuss; 
						echo $_SESSION['default_currency_symbol'].($amount-$balance_amt).'/ '.$_SESSION['default_currency_symbol'].$amount;
						?></td>
						<!-- td><?php echo $fullname."<br>".$address1."<br>".$city." ".$state." ".$zip."<br>".$country; ?></td-->
						<td ><?php echo $fday; ?></td>
						<td ><?php echo $lday; ?></td>
						<td><?php if($statuss !='Active' && $statuss !='Completed'){ ?>
						<?php echo "<span style='color:#f00'>"?><?php echo __('Cancelled');echo "</span>"; ?>
						<?php }elseif($statuss == 'Completed'){
							echo "<span style='color:#0f0'>"?><?php echo __('Completed');echo "</span>";
						}elseif($datelast < time()){							
							echo "<span style='color:#f00'>"?><?php echo __('Expired');echo "</span>";
						}elseif($statuss == 'Active'){							
							echo "<span style='color:#3333df'>"?><?php echo __('Active');echo "</span>";
						}
							?></td>
						
					</tr>
				<?php } ?>
				</tbody>
				</table>
	</div>
<?php } else { ?>
<div class=" shipping no-data">
			
			<span class="icon"><i class="ic-ship"></i></span>
			<p><?php echo __('You haven’t created Group Gift yet.');?></p>
			</div>

<?php } ?>
	</div>
    </div>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute"><?php echo __('Disputes'); ?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><?php echo __('Add Shipping');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>group-gift-lists" class="current" ><?php echo __('Group Gifts'); ?></a></dd>
	           
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __ ('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><?php  echo __('Information'); ?></a></dd>
		    <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
	        </dl>
		</div>
			<footer id="footer">
		<!-- <a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a> -->
		<hr>
		<ul class="footer-nav">
			<li><a href="<?php //echo SITE_URL.'help'; ?>"><!-- Help --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/contact"><!-- Contact --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/terms_service"><!-- Terms --></a></li>
		</ul>
		<!-- / footer-nav -->
	</footer>
</div>	

<style>
li{
	font-weight:normal;
}

</style>
