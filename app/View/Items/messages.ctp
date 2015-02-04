
<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('Messages'); ?></h2> 
        <div class="figure-row" style="padding: 20px 34px 18px;">
        <div class="markshiphead" style="font-size:14px; margin-bottom: 14px; display: inline-block;">
        	<?php echo __('Contact Seller Conversations');?>
        </div>
	<?php if($counts > 9) { ?>
        <div class="messagefilter">
        	<input type="text" value="" id="searchkey" />
        	<button class="msgbtn" onclick="searchmsg();"><?php echo __('Search');?></button>
        </div>
        <div class="msgsearchload">
        	<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...." />
        </div>
		<?php 
		}
			if (!empty($messageModel)) { ?>
        	<table class="myorderslist">
        		<thead>
        			<tr>
	        			<th>#</th>
	        			<th><?php echo __('From');?></th>
	        			<th><?php echo __('To');?></th>
	        			<th><?php echo __('Item');?></th>
	        			<th><?php echo __('Subject');?></th>
	        			<th><?php echo __('Action');?></th>
	        		</tr>
        		</thead>
        		<tbody class="mymessagebody">
        			<?php 
        			$tid = 0;
        		/* foreach ($messageUnread as $unread){
					$message = $messageModel[$unread];
					$csId = $message['csid'];
					$item = $message['item'];
					$itemid = $message['itemid'];
					$itemurl = $message['itemurl'];
					$tid++;
					if ($tid < 11){
					?>
					<tr class='msgunread'>
						<td><?php echo $tid; ?></td>
						<td><?php echo $message['from']; ?></td>
						<td><?php echo $message['to']; ?></td>
						<td><a href="<?php echo SITE_URL.'listing/'.$itemid.'/'.$itemurl; ?>"><?php echo $item; ?></a></td>
						<td><?php echo $message['subject']; ?></td>
						<td><a href="<?php echo SITE_URL.'viewmessage/'.$csId; ?>">View</a></td>
					</tr>
				<?php
					}
        		} */
        		
				foreach($messageModel as $ky=>$message){
					$csId = $message['csid'];
					$item = $message['item'];
					$itemid = $message['itemid'];
					$itemurl = $message['itemurl'];
					$bold = '';
					if ($message['unread'] == 1)
						$bold = "class='msgunread'";
					//if (!in_array($ky, $messageUnread)) {
						$tid++;
						if ($tid < 11){
						?>
						<tr <?php echo $bold; ?> >
							<td><?php echo $tid; ?></td>
							<td><?php echo $message['from']; ?></td>
							<td><?php echo $message['to']; ?></td>
							<td><a href="<?php echo SITE_URL.'listing/'.$itemid.'/'.$itemurl; ?>"><?php echo $item; ?></a></td>
							<td><?php echo $message['subject']; ?></td>
							<td><a href="<?php echo SITE_URL.'viewmessage/'.$csId; ?>">View</a></td>
						</tr>
							
				<?php
						}
					//}
				} ?>
        		</tbody>
        	</table>
        	<?php 
        		if (count($messageModel) > 9) {?>
        			<div class="loadmorecomment" onclick="loadmorecomment()" style="margin-top: 6px;">
        				<?php echo __('Load more message');?>
        				<div class="morecommentloader">
        					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        				</div>
        			</div>
        	<?php }
			}else {
				echo '<div style="text-align:center;color:#ff0000;font-size:14px;">'?>
						<?php echo __('Message Box Empty');echo '</div>';
			} ?>
			<div class="message-error" style="display:none;"></div>
		</div>	
		<input type="hidden" id="savesearchkey" value=""/>
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo ('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" class="current" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i><?php echo __('Add Shipping');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
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
<script type="text/javascript">
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 10;
	var baseurl = getBaseURL();

	function loadmorecomment(){
		if (loadmoreajax == 1 && loadmore == 1){
			var searchkey = $('#savesearchkey').val();
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmoremessage',
				type: 'POST',
				dataType: 'html',
				data: {'offset': loadmorecmntcnt, 'searchkey': searchkey},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce != 'false'){
				        $('.myorderslist').append(responce);
				        loadmoreajax = 1;
						loadmorecmntcnt += 5;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No more messages');
					}
				}
			});
		}
	}
</script>
