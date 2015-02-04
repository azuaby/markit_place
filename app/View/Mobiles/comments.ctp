
<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
				<div style="float:right;"><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL.'mobile/listing/'.$item_datas['Item']['id'].'/'.$item_datas['Item']['item_title_url'];?>">Back</a></div>
				<?php //if(($item_datas['Item']['status'] != 'things')){ ?>
			<section class="comments comments-list comments-list-new commandseprate">
	            		
	            		<?php if (count($commentss_item) > 2) { ?>
	            		<div class='head' style="padding-bottom:5px;font-size:15px;">
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
						//echo "<pre>";print_r($cmnt);
						if($key > 1 && $cmntflag == 1) {
							echo '</div><div id="all" style="display:none;">';
							$cmntflag = 0;
						}
						echo '<li class="comment delecmt_'.$cmnt['Comment']['id'].'" commid="'.$cmnt['Comment']['id'].'" style="list-style:none;">';
							echo '<a class="milestone" id="'.$cmnt['Comment']['id'].'"></a>';
							echo '<table style="width:100%;"><thead><tr><th colspan="2"></th></tr></thead><tbody><tr><td style="width:45px;">';
							echo '<span class="vcard">';
							echo '<a data-ajax="false" href="'.SITE_URL.'mobile/people/'.$cmnt['User']['username_url'].'" class="url">';
							if(!empty($cmnt['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$cmnt['User']['profile_image'].'" alt="" class="photo" style="width:40px;height:40px;'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="width:40px;height:40px;'.$roundProfile.'">';
							}
							
							$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
							echo '</a></span>';
							echo '</td><td>';
							echo '<span class="vcard cmntusername" style="position: relative;top:5px;"><a data-ajax="false" style="text-decoration:none;" href="'.SITE_URL.'mobile/people/'.$cmnt['User']['username_url'].'" class="url">';
							echo '<span class="fn nickname">'.$cmnt['User']['username'].'</span></a></span>';
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; padding: 5px 0px 0px 10px;float:right;"   onkeyup="ajaxuserautoc(this.value,\'txt1val'.$cmnt['Comment']['id'].'\',\'comment-autocomplete'.$cmnt['Comment']['id'].'\');">';
							//echo $cmnt['Comment']['comments'];
							echo preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							
							echo '</textarea> <button style="background:#5690BB;text-shadow:none;color:#FFFFFF;margin-top:70px;" class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >Save comment</button></p>';
							echo '<div class="comment-autocomplete comment-autocomplete'.$cmnt['Comment']['id'].'" style="display: none;left:43px;width:548px;">';
							echo '<ul class="usersearch" data-role="listview" data-inset="true">';
								
							echo '</ul>';
							echo '</div>';
							echo '<p id="oritext'.$cmnt['Comment']['id'].'" style="margin-top:5px;">'.$cmnt['Comment']['comments'].'</p>';
							
							echo '<div id="oritextvalafedit'.$cmnt['Comment']['id'].'"></div>';
							echo '</td></tr></table>';
							echo '<div class="c-reply" >';
							
								if($cmnt['Comment']['user_id']==$userid){
									echo '<button class="edit-comment" style="background:#5690BB;text-shadow:none;color:#FFFFFF;" onclick = "return editcmnt('.$cmnt['Comment']['id'].')" >Edit</button><span class="bar"></span>';
									echo '<button class="delete-comment" style="background:#5690BB;text-shadow:none;color:#FFFFFF;" onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >Delete</button>';
								}
							echo '</div>';
							
	                   
						echo '</li>';
						
							
					}
					
					?>
					</div>
					<?php 
				$item_title = $item_datas['Item']['item_title'];
				$item_price = round($item_datas['Item']['price'] * $_SESSION['currency_value'], 2);
				$favorte_count = $item_datas['Item']['fav_count'];
				$username = $item_datas['User']['username'];
				
				echo '<span id="figcaption_titles'.$item_datas['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo '<span id="price_vals'.$item_datas['Item']['id'].'" price_val="'.$item_price.'" ></span>';
				echo '<a data-ajax="false" href="'.SITE_URL."mobile/people/".$username.'"  id="user_n'.$item_datas['Item']['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span class="fav_count" id="fav_count'.$item_datas['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></span>';

				?>
					
					<div id="sa"></div>
				
					<label class="hidden" style="font-size:15px;"><b>Comment:</b></label>
					<table style="width:100%;"><thead><tr><th colspan="2"></th></tr></thead><tbody><tr><td style="width:40px;">
					<span class="vcard">
					<?php 
					//echo "<pre>";print_r($item_datas);die;

					 if (isset($userid) ) :
					echo '<a data-ajax="false" href="'.SITE_URL.'mobile/people/'.$loguser[0]['User']['username'].'" class="url">';
					
					if(!empty($usershipping['User']['profile_image'])){
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$usershipping['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'width:40px;height:40px;">';
					}else{
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'width:40px;height:40px;">';
					}
					
					echo '</a></span>';	
					
					//echo '<span class="fn nickname">"'.$loguser[0]['User']['username'].'"</span></a></span>';
					echo '</td><td>';
					
					echo '<textarea id="comment_msg" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value, \'comment_msg\',\'comment-autocompleteN\');"  autocomplete="off" placeholder="Write a comment..."  i_id="'.$item_datas['Item']['id'].'" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
					echo '</td></tr></table>';
					endif; 
					echo '<div class="comment-autocomplete comment-autocompleteN" style="display: none;">';
					echo '<ul class="usersearch" data-role="listview" data-inset="true">';
					
					echo '</ul>';
					echo '</div>';
							
					
					echo '<input type="hidden" value="'.$item_datas['Item']['id'].'" id="itemid" />';
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
					<br /><div class="btns-post">
						Use @ to mention someone
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post" style="background:#5690BB;text-shadow:none;color:#FFFFFF;" onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave">Post comment</button>
						<div class="post-loading" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
  					<?php endif; ?> 
					</section>
				
				</div>
				
