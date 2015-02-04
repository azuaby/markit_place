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
        <h2 class="ptit"><?php echo __('Message'); ?></h2>
        <div class="markshippedcontent">
        	<div class="markshiphead">Subject: <?php echo $contactsellerModel['Contactseller']['subject']; ?></div>
        	<div class="markshiporderid">Item: <a href="<?php echo SITE_URL.'listing/'.$itemDetails['itemid'].'/'.$itemDetails['itemurl']; ?>"><?php echo $itemDetails['item']; ?></a></div>
        	</br>
        	<div class="contactbuyer">
        		<div class="sellercommandarea">
        			<div class="sellerimg">
        			<?php 
        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
							if(!empty($merchantModel['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							echo '</a>'; ?>
        			</div>
        			<div class="sellercommandcont">
        				<!-- <p class="username">
        					<?php 
        					echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
        					echo $merchantModel['User']['first_name'].'</a>'; ?>
        				</p> -->
        				<textarea id="mercntcmnd" class="merchantcommand" rows="2" cols="15"></textarea>
        				<button class="sellerpostcomntbtn" onclick="return postmessage('<?php echo $currentUser; ?>');" style="margin-right: 0px;">Send</button>
        				<div class="postcommentloader">
        					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." />
        				</div>
        				<div class="postcommenterror"></div>
        			</div>
        		</div>
        		<div class="prvconvcont">
        			<div class="prvconvhead">Previous Messages: </div>
        			<div class="prvcmntcont">
        				<?php if (!empty($csmessageModel)){
        					$cmntcontnr = 'style="text-align: right;"';
        					$usrimg = 'style="float: right;"';
        					$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
        					foreach ($csmessageModel as $key => $csmessage) {
        						if ($key < 5) {
        							if ($csmessage['Contactsellermsg']['sentby'] == $currentUser) {
        				?>
        				<div class="cmntcontnr">
        					<div class="usrimg">
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
		        				<p class="usrname">
		        					<?php echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">'; 
		        						echo $merchantModel['User']['first_name']; 
		        					echo '</a>'; ?>
		        				</p>
		        				<p class="cmntdate"><?php echo date('d,M Y',$csmessage['Contactsellermsg']['createdat'])?></p>
		        				<p class="comment"><?php echo $csmessage['Contactsellermsg']['message']; ?></p>
		        			</div>
        				</div>
        				<?php }else{?>
        				<div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">
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
		        				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">
		        					<?php echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">'; 
		        						echo $buyerModel['User']['first_name']; 
		        					echo '</a>'; ?>
		        				</p>
		        				<p class="cmntdate"><?php echo date('d,M Y',$csmessage['Contactsellermsg']['createdat'])?></p>
		        				<p class="comment"><?php echo $csmessage['Contactsellermsg']['message']; ?></p>
		        			</div>
        				</div>
        				<?php }
        						}
        					} 
        					echo "</div>";
        					if (count($csmessageModel) > 5) {?>
        					<div class="loadmorecomment" onclick="loadmorecomment('<?php echo $contactsellerModel['Contactseller']['id']; ?>')">
        						Load more message
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php } }else{
        					echo "<div class='noordercmnt' style='text-align:center;'>No Conversation Found</div>";
        					echo "</div>";
        				}?>
        		</div>
        	</div>
        	<input type="hidden" id="hiddencsid" value="<?php echo $contactsellerModel['Contactseller']['id']; ?>" />
        	<input type="hidden" id="hiddenbuyerid" value="<?php echo $buyerModel['User']['id']; ?>" />
        	<input type="hidden" id="hiddenmerchantid" value="<?php echo $merchantModel['User']['id']; ?>" />
        	<input type="hidden" id="hiddenusrname" value="<?php echo $merchantModel['User']['first_name']; ?>" />
        	<input type="hidden" id="hiddenusrimg" value="<?php echo $merchantModel['User']['profile_image']; ?>" />
        	<input type="hidden" id="hiddenusrurl" value="<?php echo $merchantModel['User']['username_url']; ?>" />
        	<input type="hidden" id="hiddenroundprofile" value="<?php echo $roundProfile; ?>" />
        </div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt>ACCOUNT</dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > Profile</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > Password</a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i>Add Shipping</a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt>SHARING</dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> Credits</a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> Referrals</a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> Gift card</a></dd>
	        </dl>
		</div>
				<footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				<!-- / footer-nav -->
			</footer>
			
</div>	
<script type="text/javascript">
    var currentUser = '<?php echo $currentUser; ?>';
	var crntcommentcnt = '<?php echo count($csmessageModel); ?>';
	var csid = '<?php echo $contactsellerModel['Contactseller']['id']; ?>';
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 5;
	var baseurl = getBaseURL();

	function loadmorecomment(oid){
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmoreviewmessage',
				type: 'POST',
				dataType: 'html',
				data: {'offset': loadmorecmntcnt,'contact':currentUser,'csid':csid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce != 'false'){
				        $('.prvcmntcont').append(responce);
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