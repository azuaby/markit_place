<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('Dispute As Seller'); ?></h2>
        <div class="figure-row" style=" padding: 9px 12px 18px;">
		<?php foreach($messagedisp as $ky=>$msg){ $msro = $msg['order_id']; }?>
		<div class="markshiporderidsma"><?php echo __('Order ID');?>: <?php echo $msro; ?><?php $orderdet['Dispute']['resolvestatus']; ?></div>
        	<div class='container' style='padding:0px;'>
		<br/><br/>
		
	<div class="sellercommandarea">
	<?php if($orderdet['Dispute']['resolvestatus']!='Resolved') {?>
	<div class="sellerimg">
        			<?php 
        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
							if(!empty($merchantModel['User']['profile_image'])){
								//echo $buyerModel['User']['profile_image'];
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							echo '</a>'; ?>
        			</div>
        			<div class="sellercommandcont">
        			<!-- 	<p class="username">
        				
        					<?php
        					//echo $_SESSION['first_name']; ?>
        				</p> -->
        				
        				<?php echo $this->Form->create('Dispute', array( 'id'=>'disputeform','onsubmit'=>'return rlyadmsg()')); ?>
        				  <textarea name="data[Dispute][msg]" id="message" class="merchantcommand" rows="2" cols="15"></textarea>
        		
        				 <?php
			echo $this->Form->submit(__('send '),array('class'=>'sellerpostcomntbtn','div'=>false, 'name'=>'selconver','style'=>'margin-right: 0px;'));
		echo $this->Form->end();
?>    		 
  	
        				<div class="postcommenterror" id="alert" style="float:left; font-size: 12px; margin: -16px 0 0 0px;"></div>
        			</div><?php }?></div>
        			
        			
			<div class="prvconvcont">
		<div class="prvconvhead"><?php echo __('Previous Messages');?>: </div>
		<div class="prvcmntcont">
		<?php if (!empty($messagedisp)){
        					$cmntcontnr = 'style="text-align: right;"';
        					$usrimg = 'style="float: right;"';
        					$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
        					
        				?>
		<?php
					//echo "<pre>";print_r($itematas);
					
					//if(count($_GET)==0){
						if(!empty($messagedisp)){
						foreach($messagedisp as $key=>$msg){
							if ($key < 10) {
					?>
					<?php 
					$msrc = $msg['commented_by'];
					$msrd=date('d,M Y',$msg['date']);
					$msrm = $msg['message'];
					$msro = $msg['order_id'];
					//$ro = $msg['msid'];
						 ?>
						<!--  <div class="cmntcontnr"  style="text-align: right; width:750px;margin: 0 13px 32px -59px;border-radius: 4px;margin-bottom: 15px;">
						
						 <div class="usrimg"  style="float: right;">-->
						 <div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">
						 <?php if ($msrc == 'Buyer') {?>
		        			<?php 
		        			
		        				echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
									if(!empty($buyerModel['User']['profile_image'])){
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									}
									
									echo '</a>'; ?>
		        			</div>
					<!-- <div class="cmntdetails" style="margin: 0px 0px 0px 0px;width: 614px; border-radius: 2px;">
					<p class="usrname"  style="float: right; margin-right: 0px; margin-left: 20px;">-->
					<div class="cmntdetails">
		        				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">
					<?php echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';?>
					<?php echo $buyerModel['User']['first_name'];?></p><?php echo '</a>';?><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
				<?php }elseif ($msrc == 'Seller') {?>	
					</div></div>
					
					<!-- <div class="cmntcontnr" style=" margin-left: 51px;margin-bottom: 15px;width:700px;">
        					<div class="usrimg">-->
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
					<!-- <div class="cmntdetails" style="margin: 0px 0px 0px 0px;width: 616px; border-radius: 2px;" >-->
					<div class="cmntdetails">
					<p class="usrname"><?php echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';?>
					<?php echo $merchantModel['User']['first_name'];?><?php echo '</a>';?></p><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
				
					
					
					<?php }else {?>	
					</div></div>
					
					<!-- <div class="cmntcontnr" style="text-align: right;margin: 0 0px 32px -59px;border-radius: 4px;margin-bottom: 15px;">
        					<div class="usrimg" style="float: right;">-->
        				<div class="cmntcontnr" style="text-align: right;">
        					<div class="usrimg" style="float: right;">
						
		        			<?php 
		        			
		        				//echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
									//if(!empty($merchantModel['User']['profile_image'])){
									//echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									//}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									//}
									
									//echo '</a>'; ?>
		        			</div>
					<!-- <div class="cmntdetails" style="margin: 0px 0px 0px 0px;width: 614px; border-radius: 2px;">
					<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">-->
					<div class="cmntdetails">
		        				<p class="usrname" style="float: right; margin-right: 0px; margin-left: 20px;">
					<a href="#"><?php echo $msrc;?></a></p><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
					
				<?php }?>	
					</div>
					
					</div>
					
						
					<?php
					}
					}
					}
		
					//}
					?>
		</div>
		<?php if (count($messagedisp) > 9) {?>
        					<div class="loadmorecomment" style="font-size: 12px;" onclick="loadmorecomment('<?php echo $msro ?>')">
        						<?php echo __('Load More');?>
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php } }else{
        					echo "<div class='noordercmnt' style='text-align:center;'>"?><?php echo __('No Conversation Found');echo "</div>";
        					echo "</div>";
        				}?>
	</div>
	
		
			<input type="hidden" id="hiddenorderid" value="<?php echo $orderdet['Dispute']['userid']; ?>" />
        	<input type="hidden" id="hiddenbuyerid" value="<?php echo $orderdet['Dispute']['selid']; ?>" />
        	<input type="hidden" id="hiddenmerchantid" value="<?php echo $orderdet['Dispute']['uorderid']; ?>" />
        	<input type="hidden" id="hiddenliid" value="<?php echo $orderdet['Dispute']['disid']; ?>" />
        	
		
		
 </div>
     
		</div>	
	</div>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" class="current" ><?php echo __('Disputes'); ?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>purchases"  ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
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
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>
<script type="text/javascript">
	var crntcommentcnt = '<?php echo count($messagedisp); ?>';
	var order_id = '<?php echo $msro; ?>';
	//alert (order_id);
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 5;
	var baseurl = getBaseURL();

	$(document).ready(function(){
		getcurrentcmnt();
	});
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
		//alert (order_id);
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getsellercmnt',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'order_id': order_id, 'contact': 'buyer', },
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

	function loadmorecomment(mid){
		//alert(mid);
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorecommentseller',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','order_id':mid},
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
				        $('.loadmorecomment').html('No More Disputes');
					}
				}
			});
		}
	}
</script>
<style>
        			.merchantcommandss{
        			
        			width:630px;
        			}
        			.sub{
        			-moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #4882BC;
    background-image: linear-gradient(to top, #4882BC, #518BC5);
    border-color: #396C9D #396C9D #2F5A83;
    border-image: none;
    border-radius: 2px;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px rgba(0, 0, 0, 0.11), 0 1px rgba(175, 207, 236, 0.1) inset;
    color: #FFFFFF;
    float: right;
    font-size: 12px;
    font-weight: bold;
    height: 31px;
    line-height: 1em;
    margin-bottom: 8px;
    margin-left: 9px;
    margin-right: 18px;
    padding: 0 12px;
    text-align: center;
    text-decoration: none;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
    }
    .pmsg{
    color: #7C7C7C;
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 12px;
    margin: 0 0 24px 0px;
    }
    
  .markshiporderidsma{
    float: left;
    
    font-size:12px;
    font-weight: bold;
    }
        			</style>
        			<script>
        			function rlyadmsg(){
        				var data = $('#rlyadmsg1').serialize();
        				var message=$('#message').val();
        				if(message == ''){
        					$("#alert").show();
        					
        					$('#alert').text('Enter the Text');
        					
        					return false;
        				}

        				$('#rlyadmsg1').submit();
        				
        			}
        			</script>
