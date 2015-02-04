<?php 
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = @$_SESSION['media_server_username'];
@$password = @$_SESSION['media_server_password']; 
@$hostname = $_SESSION['media_host_name'];

?>
<div id="container-wrapper">
	<div class="container livefeeds-container">
		<div class="recentactivity-container">
			<div class='hashtagwhofollow-head'>
				<?php echo __('Recent Activities'); ?>
			</div>
			<div class='recentactivities trending-hashtags'>
		<?php if (!empty($recentactivity)){
				echo "<ul class='recentlist'>"; 
				foreach ($recentactivity as $recent){
					$type = $recent['Log']['type'];
					$activityUser = $recent['Log']['userid'];
					$image = json_decode($recent['Log']['image'],true);
					$ldate = $recent['Log']['cdate'];
					$activityTime = UrlfriendlyComponent::aty_time_diff($ldate);
					switch($type){
						case 'follow':
							$message = 'Followed '.$userDetails[$activityUser]['User']['first_name'];
							break;
						case 'comment':
							$message = 'Commented on item';
							$imagelink = "<a href='".$image['item']['link']."'>
									<img src='".SITE_URL."media/items/thumb70/".$image['item']['image']."' />
									</a>";
							break;
						case 'favorite':
							$message = $fantacy.' an item';
							$imagelink = "<a href='".$image['item']['link']."'>
									<img src='".SITE_URL."media/items/thumb70/".$image['item']['image']."' />
									</a>";
							break;
						case 'sellermessage':
							$message = "Posted a seller message";
							break;
						case 'status':
							$message = "Posted a status";
							break;
						case 'orderstatus':
							$message = "Updated a order status";
							break;
					}
		?>
			<li><?php echo $message."<span class='activity-on'>$activityTime</span>"; ?></li>
		<?php 
				}
				echo "</ul>";
		}else{ 
			echo "<span class='no-recentactivity'>No Recent Activity</span>";
		}?>
		</div>
	</div>
	<div class="livefeed-container">
		<div class="status-updater">
			<div class="status-header">
				Post a Status
				<div class="post-status-loader">
					<img src='<?php echo SITE_URL; ?>images/loading_blue.gif' alt='Loading...' />
				</div>
				<!-- <p class='post-info'>use @ to mention someone and # to mention topic</p> -->
			</div>
			<div class="status-main">
				<div class="status-editor-container">
					<textarea id="status-textarea" class="status-editor" placeholder="Upload a image or Write something....." maxlength='301'></textarea>
				</div>
				<div class="statusimage-container" id='statusimg-cont'>
					<?php 
					echo "<img id='show_url'  style='margin-left: 10px; height: 80px;' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'>";
					echo "<a href='javascript:void(0);' id='removeimg' class='status-remove' onclick='removestatusimg(\" 1 \")'> ";
					echo "x"; echo "</a>"; 
					?>
				</div>
				<div class="status-action">
					<div class="leftaction">
						<?php 
						echo "<div class='input-group'>";
						echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'statusupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="46px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;"></iframe>';
						echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'image'));
						echo "</div>";
						echo "<div class='statusimg-loading' id='statusimg-load'><img src='".SITE_URL."img/loading.gif' alt='Loading...' /></div>";
						echo "</div>";
						?>
					</div>
					<div class="rightaction">
						<div class='statuspost-error'></div>
						<button type="submit" class="btn-blue-post"  onclick ="return poststatus();" id="statussave"><?php echo __('Post');?></button>
					</div>
				</div>
			</div>
		</div>
		<div class="feeds-container">
			<?php if (!empty($loguserdetails)){ ?>
			<ol class='feeds-ol'>
			<?php foreach ($loguserdetails as $log){ 
					$logId = $log['Log']['id'];
					$type = $log['Log']['type'];
					$feedImages = json_decode($log['Log']['image'],true);
					$notifymsg = $log['Log']['notifymessage'];
					$feedMessage = $log['Log']['message'];
					$ldate = $log['Log']['cdate'];
					$pastTime = UrlfriendlyComponent::txt_time_diff($ldate);
					$logUserid = $log['Log']['userid'];
					if (empty($feedImages['user']['link']))
						$feedImages['user']['link'] = 'javascript:void(0);';
				?>
				<li class='feed<?php echo $logId; ?>'>
					<div class='mainfeed-cont'>
						<div class='feed-title'>
							<div class='feeduser-details'>
								<a href='<?php echo $feedImages['user']['link']; ?>' >
									<img src='<?php echo SITE_URL.'media/avatars/thumb150/'.
											$feedImages['user']['image']; ?>' />
								</a>
								<div class='feed-notify'>
									<?php $notifymsg = explode('-___-', $notifymsg); 
										foreach($notifymsg as $nmsg){
											echo __($nmsg);
										}
									?>
								</div>
								<div class='feed-pasthour'>
									<?php echo $pastTime; ?>
								</div>
								<?php 
								if ($type == 'status' && $userid == $logUserid){
									echo "<span class='deletepost glyphicons delete' onclick='deletepost(".$logId.")'></span>";
								}
								?>
							</div>
						</div>
						<?php if (isset($feedImages['item']) || isset($feedImages['status'])){ ?>
						<div class='feed-content'>
							<?php if (isset($feedImages['item'])){ ?>
								<a href='<?php echo $feedImages['item']['link']; ?>' >
									<div class='feed-image' style='background-image:url("<?php echo SITE_URL.
											'media/items/original/'.$feedImages['item']['image']; ?>")'>
									</div>
								</a>
							<?php }elseif(isset($feedImages['status'])){ ?>
								<div class='feed-status-image'>
									<img src='<?php echo SITE_URL.
									'media/status/original/'.$feedImages['status']['image']; ?>' />
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<?php if(!empty($feedMessage)){ ?>
					<div class='feed-message'>
						<?php echo $feedMessage; ?>
					</div>
					<?php 
						if ($type == 'status'){
							$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
							$atuserPattern = '/<span[^<>]*?[^<>]*?>(.@?)<\/span>/';
							$hashPattern = '/<span[^<>]*?[^<>]*?>(.*#)<\/span>/';
							$withoutAnchortag = preg_replace($pattern, '$1', $feedMessage);
							$withoutAtuserspan = preg_replace($atuserPattern, '$1', $withoutAnchortag);
							$withoutHashspan = preg_replace($hashPattern, '$1', $withoutAtuserspan);
							echo "<div class='status".$logId." deletestatus'>".$withoutHashspan."</div>";
						}
					}else{
						echo "<div style='padding:0 0 3px'></div>";
					} ?>
				</li>
			<?php } ?>
			</ol>
			<div id="infscr-loading" style="display:none;text-align:center; padding: 10px 0px;">
				<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
			</div>
			<?php }else{
				echo "<div class='livefeed-empty'>Follow Popular persons to get feeds</div>";
			} ?>
		</div>	
	</div>
	<div class='whofollow-container'>
			<div class='hashtagwhofollow-head'>
				<?php echo __('Who to follow'); ?>
			</div>
			<div class='hashtagwhofollow-content'>
			<?php if(!empty($people_details)){ ?>
				<ol class='whofollow-list'>
					<?php 
					$followlistId = '';
					foreach ($people_details as $key => $people){
						echo "<li class='whouser".$people["User"]["id"]." list".$key."'>";
							echo "<div class='whotofollow'>";
							echo " <a href='".SITE_URL."people/".$people["User"]["username_url"]."' title='".$people["User"]["username"]."'>";
								echo "<div class='whotofollow-img'>";
									if(!empty($people["User"]["profile_image"])){
										echo "<img style='margin-right: 2px;$roundProfile' src='".$_SESSION['media_url']."media/avatars/thumb70/".$people["User"]["profile_image"]."' />";
									}else{
										echo "<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."' />";
									}
								echo "</div>";
								echo "<div class='whotofollow-info'>";
									//echo '<a href = "'.SITE_URL.'people/'.$people["User"]["username_url"].'" class = "username" title = "'.$people["User"]["username"].'">'
									echo "<p class='user'>".$people["User"]["username"]."</p>
											<p class='username'>@".$people["User"]["username_url"].'</p>';
									//</a>';
								echo "</div>";
							echo "</a>";
								echo "<div class='whotofollow-btn'>";
									echo "<span class='follow'   id='foll".$people['User']['id']."'>";
										echo '<button type="button" id="follow_btn'.$people['User']['id'].'" 
												class="btnblu" onclick="hashtagfollow('.$people['User']['id'].','.$key.')">';
											echo '<span class="foll'.$people['User']['id'].'" >';
												echo __('Follow'); 
											echo '</span>';
										echo '</button>';
									echo "</span>";
								echo "</div>";
							echo '</div>';
						echo "</li>";
						if ($followlistId == ''){
							$followlistId = $people["User"]["id"];
						}else{
							$followlistId .= ",".$people["User"]["id"];
						}
					} ?>
				</ol>
				<?php 
			}else{
				echo "<div class='whotofollowerror'>No more suggestions</div>";
			}
				if(empty($userid) || !isset($userid) || $userid == 0){
					echo "<input type='hidden' id='gstid' value='0' />";
				}else{
					echo "<input type='hidden' id='gstid' value='".$userid."' />";
				} ?>
				<input type="hidden" id="followuserlist" value="<?php echo $followlistId; ?>" />
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
var sIndex = 15, limit = 15, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();
$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
	    $(".LoaderImage").css("display", "block");

	    $.ajax({
	      url: baseurl+'getmorefeeds/livefeeds?startIndex=' + sIndex,
	      type: "GET",
		  dataType: 'html',
	      beforeSend: function () {
				$('#infscr-loading').show();
			},
	      success: function (result) {
	      	$('#infscr-loading').hide();
	      	var out = result.toString();
	      	if($.trim(out)=='')
	      	$(window).unbind('scroll');		
	      	else if (out != 'false') {//When data is not available
	        	$('.feeds-ol').append(result);
	        }else {
	            isDataAvailable = false;
			}
	        sIndex = sIndex + limit;
	        isPreviousEventComplete = true;
	      }
	    });

	  }
	 }
});

$(window).scroll(function() {
	if($(this).scrollTop() > 23) {
		$('.recentactivity-container').addClass('fixed');
		$('.livefeed-container').addClass('fixed');
		$('.whofollow-container').addClass('fixed');
	} else {
		$('.whofollow-container').removeClass('fixed');
		$('.livefeed-container').removeClass('fixed');
		$('.recentactivity-container').removeClass('fixed');
	}
});
</script>
<script src="<?php echo SITE_URL."/js/textarea_autogrow.js"; ?>" type="text/javascript" />