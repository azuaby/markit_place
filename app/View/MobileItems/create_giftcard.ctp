<?php
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = @$_SESSION['media_server_username'];
@$password = @$_SESSION['media_server_password'];
@$hostname = $_SESSION['media_host_name'];

$roundProfile = "";
$roundProfileFlag = 0;
if ($roundProf == "round")  {
	$roundProfile = "border-radius:40px;";
	$roundProfileFlag = 1;
}



?>
<div class="container wider" style="top: 0px;">
		<div class="wrapper-content right-sidebar" style="background:none;">
			<div id="content" class="ui-body ui-body-a">
				<div class="figure-row first  sepProduView">
				
						<div class="figure-product figure-640 big">
					

						<a title="<?php echo $item_datas['title']; ?>"  href="#">	
						<figure>
							<span class="wrapper-fig-image">
								<span class="fig-image" ><img id="fullimgtag" alt="" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['image'];?>"></span>
							</span>                            
		                    <center><figcaption style="margin: 15px 0px; text-decoration: none;"><?php echo $item_datas['title']; ?></figcaption></center>
								    
		                </figure>
		               </a>
						</div>
			
			
					<!-- / figure-product figure-640 -->
					
					
					
			<section class="comments comments-list comments-list-new commandseprate">
	            		<ol>
	            		<?php if (count($commentss_item) > 2) { ?>
	            		<div class='head' style="padding-bottom:5px;">
					<a  id="show_all" onclick="show_comment()" > View all <?php echo(count($commentss_item));?> comments</a>
					<a  id="hide_all" onclick="hided_comment()" style="display:none;" > Hide comments</a>
					</div>
					<?php } ?>
					
					<?php 
					//echo "<pre>"; print_r(count($commentss_item));
					if(count($commentss_item) == 0 && $userid ==''){
						
						echo "There is no comment yet for this product";
						
					} 
					
					//<div id="all" style="display:none;">?>
				
					
					<div id="few">
					
					
					
					
					<?php 
					//echo "<pre>";print_r($commentss_item);die;
					$cmntflag = 1;
					
					foreach ($commentss_item as $key => $cmnt){
						//echo "<pre>";print_r($cmnt);die;
						if($key > 1 && $cmntflag == 1) {
							echo '</div><div id="all" style="display:none;">';
							$cmntflag = 0;
						}
						echo '<table width="100%">
					<thead><tr><th></th></tr></thead>
					<tbody><tr><td width="5%">';
						echo '<span class="comment delecmt_'.$cmnt['Comment']['id'].'" commid="'.$cmnt['Comment']['id'].'" >';
							echo '<a class="milestone" id="'.$cmnt['Comment']['id'].'"></a>';
							echo '<span class="vcard"><a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							if(!empty($cmnt['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$cmnt['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
							echo '</a></span>';
							echo '</td><td>';
							echo '<span class="vcard cmntusername" style="position: relative;"><a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							echo '<span class="fn nickname">'.$cmnt['User']['username'].'</span></a></span>';
							
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;"   onkeyup="ajaxuserautoc(this.value,\'txt1val'.$cmnt['Comment']['id'].'\',\'comment-autocomplete'.$cmnt['Comment']['id'].'\');">';
							//echo $cmnt['Comment']['comments'];
							echo preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							
							echo '</textarea> <button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >Save comment</button></p>';
							echo '<div class="comment-autocomplete comment-autocomplete'.$cmnt['Comment']['id'].'" style="display: none;left:43px;">';
							echo '<ul class="usersearch">';
								
							echo '</ul>';
							echo '</div>';
							echo '<br /><span id="oritext'.$cmnt['Comment']['id'].'" style="margin-top:-10px;">'.$cmnt['Comment']['comments'].'</span>';
							echo '<div id="oritextvalafedit'.$cmnt['Comment']['id'].'"></div>';
							
							echo '<p class="c-reply" >';
							
								if($cmnt['Comment']['user_id']==$userid){
									echo '<button class="edit-comment" onclick = "return editcmnt('.$cmnt['Comment']['id'].')" >Edit</button><span class="bar"></span>';
									echo '<button class="delete-comment" onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >Delete</button>';
								}
							echo '</p>';
							
	                    
						echo '</span></td></tr>';
						
						echo '</tbody></table>';	
					}
					
					
					?>
					
					</div>
					
					<table width="100%" id="sat">
					<thead><tr><th></th></tr></thead>
					<tbody>
					
					</tbody></table>
					<table width="100%">
					<thead><tr><th></th></tr></thead>
					<tbody><tr><td colspan="2">
					<div id="sa"></div>
				</ol>
					<label class="hidden">Comment:</label>
					</td></tr>
					<tr><td width="5%">
					<span class="vcard">
					<?php 
					//echo "<pre>";print_r($item_datas);die;

					 if (isset($userid) ) :
					echo '<a href="'.SITE_URL.'people/'.$loguser[0]['User']['username'].'" class="url">';
					
					if(!empty($usershipping['User']['profile_image'])){
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$usershipping['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
					}else{
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
					}
					
					
					
					
					echo '</td><td>';
					echo '<textarea id="comment_msg" maxlength="1000" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value, \'comment_msg\',\'comment-autocompleteN\');"  autocomplete="off" placeholder="Write a comment..."  i_id="0" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
					endif; 
					echo '</td></tr>';
					
					echo '<tr><td colspan="2">';
					echo '<div class="comment-autocomplete comment-autocompleteN" style="display: none;">';
					echo '<ul class="usersearch">';
					
					echo '</ul>';
					echo '</div>';
							
					
					echo '<input type="hidden" value="0" id="itemid" />';
					echo '<input type="hidden" value="'.$userid.'" id="userid" />';
					echo '<input type="hidden" value="'.$userid.'" id="loguser_id" />';
					if(!empty($usershipping['User']['profile_image'])){
					echo '<input type="hidden" value="'.$usershipping['User']['profile_image'].'" id="userimges" />';
					}else{
						echo '<input type="hidden" value="usrimg.jpg" id="userimges" />';
					}
					
					echo '<input type="hidden" value="'.$loguser[0]['User']['username'].'" id="usernames" />';
					
					?>
					 <?php if (isset($userid) ) : ?>
					 
					 <tr><td align='right' colspan='2'>
					<div class="btns-post">
						<small>Use @ to mention someone</small>
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post"  onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave">Post comment</button>
						<div class="post-loading" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
					</td></tr></tbody></table>
  					<?php endif; ?> 
					</section>
						
			
				</div>
				<!-- / figure-row -->
		
				
					
	</div>
<!-- / content -->

			<div class="ui-body ui-body-a">
			<aside id="sidebar" style="background: none;">
				<section class="thing-section gift-section">
					<div class="itemAddedUserDetails figure-row first sepProduView ">
               		 <p style="font-size: 20px; font-weight: bold;"><?php echo $item_datas['title']; ?></p>
						<div class="description">
							<?php echo $item_datas['description']; ?>
						</div>
							<?php 
   								echo $this->Form->Create('Item',array('url'=>array('controller'=>'items','action'=>'create_giftcard'),'onsubmit'=>'return giftcardchk()'));
   							?> 				
						<div class="giftform">
							<fieldset class="sale-item-input">
								
								<label>Value</label>
									<!-- <span class="trick-select value">
										<a class="selectBox" tabindex="0">
										<span class="selectBox-arrow"></span>
										</a>
										<?php $amount = explode(",",$item_datas['amounts']); 
										//print_r($amntt);die;
										?>
											<select id="gift-value" name="giftamt" style="">
											<?php for($i=0;$i<count($amount);$i++){
												echo '<option value="'.$amount[$i].'">'.$_SESSION['default_currency_symbol'].$amount[$i].'</option>';
											}?>
											</select>
											</span> -->
								<div class="selectdiv" >
								    <select class="selectboxdiv"id="gift-value" name="giftamt" style="margin: 0px 0px 10px;">
								        <option value="">Select Value</option>
									<?php for($i=0;$i<count($amount);$i++){
											echo '<option value="'.$amount[$i].'">'.$_SESSION['default_currency_symbol'].$amount[$i].'</option>';
										}?>
									</select> 
									<div class="out" >Select Value</div>
								</div>
											<p></p>
												<p>
												<label>To</label>
												<input id="recipName" class="text" type="text" placeholder="Recipient’s name" name="recipient_name" >
												<span id="recipNameErr" style="display:none;color:#FF0000;"><br />Please Enter the Recipient’s name</span>
												</p>
												<p>
												<label>Recipent’s email address</label>
												<input id="recipEmail" class="text" type="text" name="recipient_email" >
												<span id="recipEmailErr" style="display:none;color:#FF0000;"><br />Please Enter the Recipient’s Email</span>
												<span id="recipEmailErrv" style="display:none;color:#FF0000;"><br />Please Enter the Valid Recipient’s Email</span>
												</p>
												<p>
												<label>Personal message</label>
												<textarea id="message" class="text" name="message" ></textarea>
												<span id="messageErr" style="display:none;color:#FF0000;"><br />Please Enter Message</span>
												</p>
											<button class="greencart add_to_cart" data-role="button" data-mini="true" style="background-color:#81C540;" value="Add to Cart" type="submit" style="margin:6px 0;">
											Add to Cart
											</button>
							</fieldset>
					</div>
					<?php
						echo $this->Form->end();
					?>
					</div>
					</div>
					</div>
				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			</div>
			<!-- / sidebar -->
			
			
		
			
			
	</div>
		<!-- / wrapper-content -->
	</div>
	
<script>
	var comment_status = true;
</script>