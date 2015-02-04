<?php 
$roundProfile = "";
$roundProfileFlag = 0;
if ($roundProf == "round")  {
	$roundProfile = "border-radius:40px;";
	$roundProfileFlag = 1;
}
?>
<div class="container set_area" style="width:940px;">
    <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('My Orders'); ?></h2>
        <div class="markshippedcontent">
        	<div class="markshiphead"><?php echo __('Conversation with seller');?> (<?php echo $sellerName; ?>)</div>
        	<div class="markshiporderid"><?php echo __('Order ID');?>: <?php echo $orderModel['Orders']['orderid']; ?></div>
        	<div class="markshipstatus"><?php echo __('Status');?>: 
        	<?php 
        	if ($orderModel['Orders']['status'] != '' && $orderModel['Orders']['status'] != 'Paid'){
				echo $orderModel['Orders']['status'];
			}elseif ($orderModel['Orders']['status'] != 'Paid'){
				echo "Pending";
			}else {
				echo "Delivered";
			}?>
        	</div></br>
        	<div class="contactbuyer">
        	<?php if ($orderModel['Orders']['status'] != 'Delivered' && $orderModel['Orders']['status'] != 'Paid'){ ?>
        		<div class="sellercommandarea">
        			<div class="sellerimg">
        			<?php 
        				echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
							if(!empty($buyerModel['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							echo '</a>'; ?>
        			</div>
        			<div class="sellercommandcont">
        				<!-- <p class="username">
        					<?php 
        					echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
        					echo $buyerModel['User']['first_name'].'</a>'; ?>
        				</p> -->
        				<textarea id="mercntcmnd" class="merchantcommand" rows="2" cols="15"></textarea>
        				<button class="sellerpostcomntbtn" onclick="return postorderbuyercomment();" style="margin-right: 0px;"><?php echo __('Send');?></button>
        				<div class="postcommentloader">
        					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." />
        				</div>
        				<div class="postcommenterror"></div>
        			</div>
        		</div>
        		<?php } ?>
        		<div class="prvconvcont">
        			<div class="prvconvhead"><?php echo __('Previous Messages');?>: </div>
        			<div class="prvcmntcont">
        				<?php if (!empty($ordercommentsModel)){
        					$cmntcontnr = 'style="text-align: right;"';
        					$usrimg = 'style="float: right;"';
        					$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
        					foreach ($ordercommentsModel as $key => $ordercomment) {
        						if ($key < 5) {
        							if ($ordercomment['Ordercomments']['commentedby'] != 'seller') {
        				?>
        				<div class="cmntcontnr">
        					<div class="usrimg">
		        			<?php 
		        				echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
									if(!empty($buyerModel['User']['profile_image'])){
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									}
									
									echo '</a>'; ?>
		        			</div>
		        			<div class="cmntdetails">
		        				<p class="usrname">
		        					<?php echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">'; 
		        						echo $buyerModel['User']['first_name']; 
		        					echo '</a>'; ?>
		        				</p>
		        				<p class="cmntdate"><?php echo date('d,M Y',$ordercomment['Ordercomments']['createddate'])?></p>
		        				<p class="comment"><?php echo $ordercomment['Ordercomments']['comment']?></p>
		        			</div>
        				</div>
        				<?php }else{?>
        				<div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">
		        			<?php 
		        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
									if(!empty($merchantModel['User']['profile_image'])){
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									}
									
									echo '</a>'; ?>
		        			</div>
		        			<div class="cmntdetails">
		        				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">
		        					<?php echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">'; 
		        						echo $merchantModel['User']['first_name']; 
		        					echo '</a>'; ?>
		        				</p>
		        				<p class="cmntdate"><?php echo date('d,M Y',$ordercomment['Ordercomments']['createddate'])?></p>
		        				<p class="comment"><?php echo $ordercomment['Ordercomments']['comment']?></p>
		        			</div>
        				</div>
        				<?php }
        						}
        					} 
        					echo "</div>";
        					if (count($ordercommentsModel) > 5) {?>
        					<div class="loadmorecomment" onclick="loadmorecomment('<?php echo $orderModel['Orders']['orderid']; ?>')">
        						<?php echo __('Load more comment');?>
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php } }else{
        					echo "<div class='noordercmnt' style='text-align:center;'>"?><?php echo __('No Conversation Found');echo "</div>";
        					echo "</div>";
        				}?>
        		</div>
        	</div>
        	<input type="hidden" id="hiddenorderid" value="<?php echo $orderModel['Orders']['orderid']; ?>" />
        	<input type="hidden" id="hiddenbuyerid" value="<?php echo $buyerModel['User']['id']; ?>" />
        	<input type="hidden" id="hiddenmerchantid" value="<?php echo $merchantModel['User']['id']; ?>" />
        	<input type="hidden" id="hiddenusrname" value="<?php echo $buyerModel['User']['first_name']; ?>" />
        	<input type="hidden" id="hiddenusrimg" value="<?php echo $buyerModel['User']['profile_image']; ?>" />
        	<input type="hidden" id="hiddenusrurl" value="<?php echo $buyerModel['User']['username_url']; ?>" />
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
	            <dd><a href="<?php echo SITE_URL; ?>purchases" class="current" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
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
	var crntcommentcnt = '<?php echo count($ordercommentsModel); ?>';
	var orderid = '<?php echo $orderModel['Orders']['orderid']; ?>';
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 5;
	var baseurl = getBaseURL();

	$(document).ready(function(){
		getcurrentcmnt();
	});
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getrecentcmnt',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'orderid': orderid, 'contact': 'buyer', },
				success: function(responce){
					if (responce) {
						var output = eval(responce);
						crntcommentcnt = output[0];
						var previousmsg = $('.prvcmntcont').html();
					    var currentmsg = output[1] + previousmsg;
				        $('.prvcmntcont').html(currentmsg);
				        cmntupdate = 1;
					}else{
						cmntupdate = 1;
					}
				}
			});
		//}
		console.log('Calling recursive function');
	}
	
	setInterval(getcurrentcmnt, 5000);

	function loadmorecomment(oid){
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorecomment',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','orderid':oid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce){
						var output = eval(responce);
				        $('.prvcmntcont').append(output[1]);
				        loadmoreajax = 1;
						loadmorecmntcnt += 5;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No more comments');
					}
				}
			});
		}
	}
</script>