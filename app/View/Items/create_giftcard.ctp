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
<div class="container wider" style="top: 0px;width:940px;">
		<div class="wrapper-content right-sidebar" style="background:none;">
			<div id="content">
				<div class="figure-row first  sepProduView">
					<div class="figure-product figure-640 big">

				<a title="<?php echo $item_datas['title']; ?>"  href="#">	
				<figure>
					<span class="wrapper-fig-image">
						<span class="fig-image" ><img id="fullimgtag" width="600" alt="" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['image'];?>"></span>
					</span>                            
                    <figcaption style="margin: 15px 0px; text-decoration: none;"><?php echo $item_datas['title']; ?></figcaption>
						    
                </figure>
               </a>
			<!-- <a title="<?php echo $item_datas['title']; ?>" href="#">
				<figure><span class="fig-image"><img id="fullimgtag" height="550" width="570" alt="<?php echo $item_datas['title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['image'];?>"></span>
				<figcaption><?php echo $item_datas['title']; ?></figcaption></figure>
			</a> -->
			
			
			</div>
					<!-- / figure-product figure-640 -->
					
					
					
			<section class="comments comments-list comments-list-new commandseprate">
	            		<ol>
	            		<?php if (count($commentss_item) > 2) { ?>
	            		<div class='head' style="padding-bottom:5px;">
					<a  id="show_all" onclick="show_comment()" > <?php echo __('View all');?> <?php echo(count($commentss_item));?> <?php echo __('comments');?></a>
					<a  id="hide_all" onclick="hided_comment()" style="display:none;" > <?php echo __('Hide comments');?></a>
					</div>
					<?php } ?>
					
					<?php 
					//echo "<pre>"; print_r(count($commentss_item));
					if(count($commentss_item) == 0 && $userid ==''){
						
						echo __('There is no comment yet for this product');
						
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
						echo '<li class="comment delecmt_'.$cmnt['Comment']['id'].'" commid="'.$cmnt['Comment']['id'].'" >';
							echo '<a class="milestone" id="'.$cmnt['Comment']['id'].'"></a>';
							echo '<span class="vcard"><a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							if(!empty($cmnt['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$cmnt['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
							echo '</a></span>';
							echo '<span class="vcard cmntusername" style="position: relative;"><a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							echo '<span class="fn nickname">'.$cmnt['User']['username'].'</span></a></span>';
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; width: 540px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;"   onkeyup="ajaxuserautoc(this.value,\'txt1val'.$cmnt['Comment']['id'].'\',\'comment-autocomplete'.$cmnt['Comment']['id'].'\');">';
							//echo $cmnt['Comment']['comments'];
							echo preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							
							echo '</textarea> <button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >Save comment</button></p>';
							echo '<div class="comment-autocomplete comment-autocomplete'.$cmnt['Comment']['id'].'" style="display: none;left:43px;width:548px;">';
							echo '<ul class="usersearch">';
								
							echo '</ul>';
							echo '</div>';
							echo '<p id="oritext'.$cmnt['Comment']['id'].'" style="margin-top:-10px;">'.$cmnt['Comment']['comments'].'</p>';
							echo '<div id="oritextvalafedit'.$cmnt['Comment']['id'].'"></div>';
							echo '<p class="c-reply" >';
							
								if($cmnt['Comment']['user_id']==$userid){
									echo '<button class="edit-comment" onclick = "return editcmnt('.$cmnt['Comment']['id'].')" >Edit</button><span class="bar"></span>';
									echo '<button class="delete-comment" onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >Delete</button>';
								}
							echo '</p>';
							
	                    
						echo '</li>';
						
							
					}
					
					?>
					</div>
					
					
					<div id="sa"></div>
				</ol>
					<label class="hidden"><?php echo __('Comment:');?></label>
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
					
					
					echo '<span class="fn nickname">"'.$loguser[0]['User']['username'].'"</span></a></span>';
					
					
					echo '<textarea id="comment_msg" maxlength="180" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value, \'comment_msg\',\'comment-autocompleteN\');"  autocomplete="off" placeholder="Write a comment..."  i_id="0" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; width: 536px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
					endif; 
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
					<div class="btns-post">
						<small><?php echo __('Use @ to mention someone');?></small>
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post"  onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave"><?php echo __('Post comment');?></button>
						<div class="post-loading"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
  					<?php endif; ?> 
					</section>
						
			
				</div>
				<!-- / figure-row -->
		
				
					
	</div>
<!-- / content -->

			
			<aside id="sidebar" style="background: none;">
				<section class="thing-section gift-section">
					<div class="itemAddedUserDetails figure-row first sepProduView ">
               		 <p style="font-size: 20px; font-weight: bold; height: 21px; overflow: hidden; line-height:33px;margin-top:-8px; margin-bottom:2px; text-overflow: ellipsis; white-space: nowrap;"><?php echo $item_datas['title']; ?></p>
						<div class="description" style="word-wrap: break-word; width:266px;">
							<?php echo $item_datas['description']; ?>
						</div>
							<?php 
   								echo $this->Form->Create('Item',array('url'=>array('controller'=>'items','action'=>'create_giftcard'),'onsubmit'=>'return giftcardchk()'));
   							?> 				
						<div class="giftform">
							<fieldset class="sale-item-input">
								
								<label><?php echo __('Value');?></label>
									<!-- <span class="trick-select value">
										<a class="selectBox" tabindex="0">
										<span class="selectBox-arrow"></span>
										</a>
										<?php $amount = explode(",",$item_datas['amounts']); 
										//print_r($amntt);die;
										?>
											<select id="gift-value" name="giftamt" style="width: 200px;">
											<?php for($i=0;$i<count($amount);$i++){
												echo '<option value="'.$amount[$i].'">'.$_SESSION['default_currency_symbol'].$amount[$i].'</option>';
											}?>
											</select>
											</span> -->
								<div class="selectdiv" style="width: 290px !important;" >
								    <select class="selectboxdiv"id="gift-value" name="giftamt" style="width: 290px !important; margin: 0px 0px 10px;">
								        <option value=""><?php echo __('Select Value');?></option>
									<?php for($i=0;$i<count($amount);$i++){
											echo '<option value="'.$amount[$i].'">'.$_SESSION['default_currency_symbol'].$amount[$i].'</option>';
										}?>
									</select> 
									<div class="out" style="width: 290px !important;" ><?php echo __('Select Value');?></div>
								</div>
											<p></p>
												<p>
												<label><?php echo __('To');?></label>
												<input id="recipName" class="text" type="text" placeholder="Recipient’s name" name="recipient_name" style="width: 275px;">
												<span id="recipNameErr" style="display:none;color:#FF0000;"><br /><?php echo __('Please Enter the Recipient’s name');?></span>
												</p>
												<p>
												<label><?php echo __('Recipent’s email address');?></label>
												<input id="recipEmail" class="text" type="text" name="recipient_email" style="width: 275px;">
												<span id="recipEmailErr" style="display:none;color:#FF0000;"><br /><?php echo __('Please Enter the Recipient’s Email');?></span>
												<span id="recipEmailErrv" style="display:none;color:#FF0000;"><br /><?php echo __('Please Enter the Valid Recipient’s Email');?></span>
												</p>
												<p>
												<label><?php echo __('Personal message');?></label>
												<textarea id="message" class="text" name="message" style="width: 275px;"></textarea>
												<span id="messageErr" style="display:none;color:#FF0000;"><br /><?php echo __('Please Enter Message');?></span>
												</p>
											<button class="greencart add_to_cart" value="Add to Cart" type="submit" style="margin:6px 0;">
											<?php echo __('Add to Cart');?>
											</button>
							</fieldset>
					</div>
					<?php
						echo $this->Form->end();
					?>
					</div><br />
					<?php
					if($managemoduleModel['Managemodule']['display_banner']=="yes")
					{
						if($banner_datas['Banner']['status']=='Active')
						{
							echo '<div style="left:-24px;position:relative;">';
							echo $banner_datas['Banner']['html_source'];
							echo '</div>';
						}
					}
					?>					
					</div>
					</div>
				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
			
			
		
			
			
	</div>
		<!-- / wrapper-content -->
	</div>
	
<script>
	var comment_status = true;
</script>
