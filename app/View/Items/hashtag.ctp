<?php
$roundProfile = "";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:150px;";
}
?>
<div id="container-wrapper">
	<div class="container hashtag-container">
		<div class='trending-container'>
			<div class='hashtagtrending-head'>
				<?php echo __('Trending Now'); ?>
			</div>
			<div class="trending-hashtags">
				<ol class="trending-hashtagslist">
				<?php foreach ($trendingHashtags as $trendingNow){ ?>
					<li>
						<a href="<?php echo SITE_URL."hashtag/".$trendingNow['Hashtag']['hashtag']; ?>"
							title="<?php echo $trendingNow['Hashtag']['hashtag']; ?>" class="trendingnowlink">
							<?php echo "#".$trendingNow['Hashtag']['hashtag']; ?>
						</a>
					</li>
				<?php } ?>
				</ol>
			</div>
		</div>
		<div class='mainhash-container'>
			<div class='hashtagmainhash-head'>
				<?php echo __('Results for'); ?> <span class="hashtagname-head"><?php echo "#".$tagName; ?></span>
			</div>
			<div class='hashtagmainhash-head hashhead-hide'>
				<?php echo __('Results for'); ?> <span class="hashtagname-head"><?php echo "#".$tagName; ?></span>
			</div>
			<div class="hashtagcomment-container">
			<?php 
			if (!empty($commentModel)){ ?>
				<ol class='hashtagcomment-list'>
				<?php 
				foreach($commentModel as $comment){ 
					$itemId = $comment['Item']['id'];
					$itemname = $comment['Item']['item_title'];
					$itemurl = $comment['Item']['item_title_url'];
					$userComment = $comment['Comment']['comments'];
					$username = $comment['User']['first_name'];
					$atusername = $comment['User']['username'];
					$usernameUrl = $comment['User']['username_url'];
					$profileImage = $comment['User']['profile_image'];
					if ($profileImage == "")
						$profileImage = "usrimg.jpg";
				?>
					<li>
						<div class="comment-container">
							<div class="comment-image">
								<a href="<?php echo SITE_URL."people/".$usernameUrl; ?>" 
										title="<?php echo $username; ?>">
								<img alt="<?php echo $username; ?>" src="<?php echo $_SESSION['media_url'].
									'media/avatars/thumb70/'.$profileImage; ?>">
								</a>
							</div>
							<div class="comment-content">
								<p class="comment-username">
									<a href="<?php echo SITE_URL."people/".$usernameUrl; ?>" 
										title="<?php echo $username; ?>">
										<?php echo $username; ?>
										<span class='anchoratuser'><?php echo "@".$usernameUrl; ?></span>
									</a>
								</p>
								<p class="comment-itemlink">
									Commented On: 
									<?php if (!empty($itemname)){ ?>
									<a href="<?php echo SITE_URL."listing/".$itemId."/".$itemurl; ?>" 
										title="<?php echo $itemname; ?>">
										<?php echo $itemname; ?>
									</a>
									<?php }else{
										echo "Status";
									}?>
								</p>
								<p class="comment-data">
									<?php echo $userComment; ?>
								</p>
							</div>
						</div>
					</li>
				<?php 
					$userComment = '';
					$username = '';
					$usernameUrl = '';
					$profileImage = '';
				} ?>
				</ol>
				<div id="infscr-loading" style="display:none;text-align:center; padding: 10px 0px;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			<?php 
			}else{
				echo "<div class='hashtagempty'>No Comments found</div>";
				echo "<div class='hashempty'>Try some <span class='hashatcolor' style='font-size:16px;'>#tag</span> from Trending Now</div>";
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

<script type="text/javascript">
var sIndex = 10, limit = 10, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();
$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
	    $(".LoaderImage").css("display", "block");

	    $.ajax({
	      url: baseurl+'getmorehashtag/<?php echo $tagName; ?>?startIndex=' + sIndex,
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
	        	$('.hashtagcomment-list').append(result);
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
		$('.trending-container').addClass('fixed');
		$('.mainhash-container').addClass('fixed');
		$('.whofollow-container').addClass('fixed');
	} else {
		$('.whofollow-container').removeClass('fixed');
		$('.mainhash-container').removeClass('fixed')
		$('.trending-container').removeClass('fixed');
	}
	if($(this).scrollTop() > 66) {
		$('.hashhead-hide').show();
		$('.hashtagmainhash-head').addClass('fixed');
		$('.hashhead-hide').removeClass('fixed');
	} else {
		$('.hashhead-hide').hide();
		$('.hashtagmainhash-head').removeClass('fixed');
	}
});
</script>