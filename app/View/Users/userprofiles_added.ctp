<?php 
if(session_id() == '') {
session_start();
}
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
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  
  });
  </script> 

<body>

<div class="container wider" style="top: 0px;width:960px;">
		<div class="wrapper-content right-sidebar" style="background:none;margin-bottom: -5px;">
			<div id="content">
				<div class="figure-row first sepProduView">
					<div class="figure-product figure-640 big text-left">

				<a title="<?php echo $item_datas['Item']['item_title']; ?>" id="img_id<?php echo $item_datas['Item']['id']; ?>"  href="#">	
				<figure>
					<span class="wrapper-fig-image" style="text-align: center;">
						<img id="fullimgtag" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>">
					</span>                            
                    <figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption>
						    
                </figure>
               </a>
			<!-- <a title="<?php echo $item_datas['Item']['item_title']; ?>" href="#">
				<figure><span class="fig-image"><img id="fullimgtag" height="550" width="570" alt="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>"></span>
				<figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption></figure>
			</a> -->
			
			<br class="hidden">
						
						<p>by <a class="username" href="<?php echo SITE_URL."people/".$item_datas['User']['username_url']; ?>"><?php echo $item_datas['User']['username']; ?></a> + <?php echo $item_datas['Item']['fav_count']; ?> others
						</p><br class="hidden">
						
			<?php
				//echo $item_datas['Itemfav'][0]['user_id'];die;
		
				foreach($item_datas['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				
//				if(isset($item_datas['Itemfav'][0]['user_id']) &&  in_array($item_datas['Item']['id'],$usecoun)){
//				echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" ><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//				}else{
//				echo  '<a class="button fantacy" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" ><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//				}	
				
				if(isset($$item_datas['Itemfav'][0]['user_id']) &&  in_array($item_datas['Item']['id'],$usecoun)){
		        echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
                echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                echo '<input type="hidden" value="'.$item_datas['Item']['id'].'" name="listing_id">';
                echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
		        echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "share_post('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
		        }else{
		        echo  '<a class="button fantacy" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
                echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                echo '<input type="hidden" value="'.$item_datas['Item']['id'].'" name="listing_id">';
                echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
		        echo  '<a class="button fantacy" onclick = "share_post('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
		        }
				
				//echo"<pre>";print_r($setngs);
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
			//	echo "<pre>";echo ".$setngs[0]['Sitesetting']['liked_btn_cmnt']";die;
				?>		
			<?php 
						$itemcolor = $item_datas['Item']['item_color'];
						$itemidse = $item_datas['Item']['id'];
						$itemcolor = json_decode($itemcolor,true);
						?>
						<?php echo '<a href="#"  onclick = "itemcou('.$itemidse.');" >';?><div class="shareebtn"><i class="glyphicons list"></i> Add to list</div></a>
							
						<a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="color"><div class="shareebtn"><i class="glyphicons brush"></i>Similar colors</div></a>
						
						<?php echo '<a href="#"  onclick = "share_post('.$itemidse.');"  >';?><div class="shareebtn" ><i class="glyphicons share"></i>Share</div></a>
						
			</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->
				<?php if(($item_datas['Item']['status'] != 'things')){ ?>
			<section class="comments comments-list comments-list-new figure-row sepProduView">
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
						//echo "<pre>";print_r($cmnt);
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
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; width: 540px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;">';
							//echo $cmnt['Comment']['comments'];
							echo preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							
							echo '</textarea><button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >Save comment</button></p>';
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
					<label class="hidden">Comment:</label>
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
					
					
					echo '<textarea id="comment_msg" maxlength="180" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value);"  autocomplete="off" placeholder="Write a comment..."  i_id="'.$item_datas['Item']['id'].'" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; width: 536px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
					endif; 
					echo '<div class="comment-autocomplete" style="display: none;">';
					echo '<ul class="usersearch">';
					
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
					 <?if (isset($userid) ) : ?>
					<div class="btns-post">
						<small>Use @ to mention someone</small>
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post"  onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave">Post comment</button>
						<div class="post-loading"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
  					<?php endif; ?> 
					</section>
					<?php } ?>
					
				<?php 
				$item_title = $item_datas['Item']['item_title'];
				$item_price = $item_datas['Item']['price'];
				$favorte_count = $item_datas['Item']['fav_count'];
				$username = $item_datas['User']['username'];
				
				echo '<span id="figcaption_titles'.$item_datas['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo '<span id="price_vals'.$item_datas['Item']['id'].'" price_val="'.$item_price.'" ></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$item_datas['Item']['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span class="fav_count" id="fav_count'.$item_datas['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></span>';

				?>		
					
			<div id="links"></div>	
			
			
			<div id="recent" style="height: auto; margin-bottom: 60px;" class="wrapper-content right-sidebar">
		
		
				<div class="heading"><span style="margin-left: 10px; font-weight: bold;">Recently <?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt']; ?> By</span></div>
						
			<?php //if(($item_datas['Item']['status'] != 'things')){ ?>
		
			<div class="find-people">
				<div class="select-list">
		<ul class="stream">
			
			 	<?php 
				if(!empty($people_details)){
				
					//echo "<pre>";print_r($people_details_for_following);die;
					foreach($people_details as $key => $ppls){
						
						echo "<li class='stream-item'  style='padding: 0px; width: 575px; margin: 10px 14px;'>";
						echo "<div class='peopleheaders'>";
					//	echo "<pre>";print_r($people_details_for_following);die;
					$user_nam = $ppls['User']['username'];
					$user_nam_url = $ppls['User']['username_url'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 
					
			       if(!empty($user_imges)){
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 5px; position: absolute;'>$user_nam</strong></a>";
					}else{
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 5px; position: absolute;'>$user_nam</strong></a>";
					}
					 
				
				
				foreach($followcnt as $flcnt){
					$flwrcntid[] = $flcnt['Follower']['user_id'];
				}
				if($userid != $ppls['User']['id']){						
						if(!in_array($ppls['User']['id'],$flwrcntid)){
							$flw = true;
						}else{
							$flw = false;
						}
					
					if($flw){
					echo "<span class='follow' id='foll".$ppls['User']['id']."'>";
					echo '<button type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" >Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" >Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
				} 
					 
					 
				
				echo '</div>';
				echo '<div class="things">';
				
				if(!empty($ppls['Itemfav'])){
				foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
					$count_im = 0;
					
					foreach($pho_datas as $key=>$val){
						$itemnnamee = $val[0]['Item']['item_title_url'];
						$imggNamee = $val[0]['Photo'][0]['image_name'];
						if(!empty($val)){
						if($itemid == $key){
							echo "<a href='".SITE_URL."listing/".$itemid."/".$itemnnamee."' >";
								echo "<img src='".$_SESSION['media_url']."media/items/thumb150/".$imggNamee."' style='max-width:150px;max-height:150px' title='".$itemnnamee."'/> &nbsp";
						 	
							echo "</a>";
						}
						
						}
					
						$count_im++;
					}		
						
					}
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:14px;"> No Items Found </center> ';
						echo '</div>';
					}
					
					echo '</div>';
					echo '</li>';
						}
				
				}else{
					echo '<div style="height:200px">';
					echo '<center style="font-size:23px;margin-top:100px;"> No one like this</center>';
					echo '</div>';
				}
				?>
			
				</ul>
				</div></div>
				<?php //} ?>	
			</div>
			
	</div>
<!-- / content -->

			<?php if(($item_datas['Item']['status'] == 'things')){ ?>
			
			<aside id="sidebar" style="background:none;" >
				<section class="thing-section gift-section">
                <?php 
				$itemcolor = $item_datas['Item']['item_color'];
				$itemidse = $item_datas['Item']['id'];
				$itemcolor = json_decode($itemcolor,true);
				
				
				
				?>
				
				
				<div class="figure-row first sepProduView ">
					<ul class="thing-info">
						<li>
							<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>"  ><button class="buyitbttn" value=""><i class="ic-cart"></i>Buy It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
						</li>				
						<?php /* <li>
								<?php echo '<img src="'.SITE_URL.'images/addtolist.png"> <a href="#"  onclick = "itemcou('.$itemidse.');" >Add to list</a>'; ?>
						</li>				
						<li>
								<?php echo '<img src="'.SITE_URL.'images/share.png"> <a href="#"  onclick = "share_post('.$itemidse.');"  >Share</a>'; ?>
						</li>
						<li>
								<img src="<?php echo SITE_URL; ?>images/colors.png" > <a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="color">Find similar colors</a>
						</li>
						
						if(isset($usershipping['User']['featureditemid']) && $usershipping['User']['featureditemid'] == $item_datas['Item']['id']){ ?>
						<li >
								<img src="<?php echo SITE_URL; ?>images/featured.png" id="change_img"> <a href="#" class="featuredon">Featured on my profile</a>
						</li>
						<?php }else{ ?>
						<li >
								<img src="<?php echo SITE_URL; ?>images/featureonmypro.png" id="change_img"> <a href="#" class="featuredon">Feature on my profile</a>
						</li>		
						<?php } */ ?>
						
						<li>
							<a href="<?php echo  SITE_URL.'sellersignup/'.$item_datas['Item']['id']; ?>"  ><button class="sellitbttn"><i class="ic-cart"></i>Sell It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/sellitem.png"> <a href="'.SITE_URL.'sellersignup/'.$item_datas['Item']['id'].'"  >Sell it</a>'; ?>
						</li>
						
					</ul>
					</div>
				
				<?php
					echo "</div>";
					if(!empty($loguser)){
						echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
						echo "<input type='hidden' id='featureditemid' value='".$item_datas['Item']['id']."' />";
					}else{
						echo "<input type='hidden' id='loguserid' value='0' />";
					}
					
					echo '<input type="hidden" id="listingid" value="'.$item_datas['Item']['id'].'" />';
					echo '<input type="hidden" id="shopid" value="'.$item_datas['Shop']['id'].'" />';
					echo '<input type="hidden" id="lastestidgg" value="" />';
					echo '<input type="hidden" id="totitemshipcost" value="" />';
					echo '<input type="hidden" id="recepietName" value="" />';
					echo '<input type="hidden" id="recepietcity" value="" />';
					?>
					
				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
			
			<?php }else{ ?>
						<aside id="sidebar" style="background:none;" >
				<section class="thing-section gift-section">
				
				
				
				
				
				
					<div class="itemAddedUserDetails  figure-row first sepProduView ">
						<?php 
						if(!empty($item_datas["User"]["profile_image"])){
							echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 10px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
						}else{
							echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 10px;' /></a>";
						
						}
						
						if($userid != $item_datas['User']['id']){
							
							foreach($followcnt as $flcnt){
								$flwrcntid[] = $flcnt['Follower']['user_id'];
									
							}
							//echo "<pre>";print_r($flwrcntid);die;
							if($userid != $item_datas['User']['id']){
								if(!in_array($item_datas['User']['id'],$flwrcntid)){
									$flw = true;
								}else{
									$flw = false;
								}
							
							
								if($flw){
							
									if(empty($item_datas['User']['id'])){
										echo "<input type='hidden' id='gstid' value='0' />";
									}else{
										echo "<input type='hidden' id='gstid' value='".$userid."' />";
											
										echo "<span class='follow'   id='foll".$item_datas['User']['id']."'>";
										echo '<button type="button" id="follow_btn'.$item_datas['User']['id'].'" class="btnblu" onclick="getfollows('.$item_datas['User']['id'].')">';
										echo '<span class="foll'.$item_datas['User']['id'].'" >Follow</span>';
										echo '</button>';
										echo "</span>";
							
									}
								}else{
									echo "<span class='follow' id='unfoll".$item_datas['User']['id']."'>";
									echo '<button type="button" id="unfollow_btn'.$item_datas['User']['id'].'" class="greebtn" onclick="deletefollows('.$item_datas['User']['id'].')">';
									echo '<span class="unfoll'.$item_datas['User']['id'].'" >Following</span>';
									echo '</button>';
									echo "</span>";
								}
								echo '<span id="changebtn'.$item_datas['User']['id'].'" ></span>';
							
							}
							
						}	
						
					echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','style' => 'position: relative; bottom: 29px;','title' => $item_datas["User"]["username"]));
				?>
						
						
						
							<p class="prices" style="font-size:10px;">
							<strong class="price">$<?php echo $item_datas['Item']['price']; ?></strong> USD<br>
							<input type="hidden" id="price" value="<?php echo $item_datas['Item']['price']; ?>">	
							</p>
							
							<div class="option-area">
								
								<label for="quantity">Quantity</label>
								<span class="input-number" style="display: inline-block; position: relative;">
									 <?php if($item_datas['Item']['quantity']<=0){
									 			echo "Sold Out";
									 		}else{
									 			echo "Only ".$item_datas['Item']['quantity']." available ";
									 		}
									  ?>
									
									
								</span>
							</div>
							
							<?php
								$optionsval = explode(',',$item_datas['Item']['size_options']);
								if($item_datas['Shop']['user_id'] != $userid && $item_datas['Item']['quantity'] > 0){
									echo '<div class="formcartlistiongs">';
									echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays')));
							?>
								<input type="hidden" value="<?php echo $cntry_code; ?>" name="shipping_method_id">
								<input type="hidden" value="<?php echo $item_datas['Item']['id']; ?>" name="listing_id">
								<input type="hidden" value="1" name="quantity">
									
								<?php
									if(!empty($item_datas['Item']['size_options'])){
								?>
								<select style="width: 200px; margin: 0px 10px 10px;" name='size_opt'>
								<option value=" ">Select Size</option>
									<?php 
									
										foreach($optionsval as $val){
											if(!empty($val)){
												$vall1 = explode('=',$val);
											if(!empty($vall1[0]) && $vall1[1] > 0)
									  		echo '<option value="'.$vall1[0].'">'.$vall1[0].'</option>';
											}
									 	}
								 	 ?>
								</select> 
								<?php
									}
								?>
						
								<?php 
									//print_r(explode(',',$item_datas['Item']['size_options']));die;
									if(empty($item_datas['Item']['start'])){
									if(($item_datas['Item']['quantity'] > 0) && ($item_datas['Item']['status']=='publish')){ ?>
											
										<button type="submit" class="greencart add_to_cart" value="Add to Cart"><i class="ic-cart"></i><strong>Add to Cart</strong></button>
									<div id="ggift"> Create Group Gift </div>
									
									<?php	}  ?>
					<!-- <button class="greencart add_to_cart soldout hidden"><i class="ic-cart"></i><strong>Sold Out</strong></button> -->
				
								</form>
						</div>
							
						<?php }  } ?>
						
						
					</div>
					
				
				
				
					<div class="figure-row first sepProduView ">
	                    <h1 style="margin: 3px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
	
						<div class="thing-description" >
							
							<p style="font-size:15px;">  <?php 
									echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
									//echo str_word_count($item_datas['Item']['item_description'], 0);
									//if(strlen($item_datas['Item']['item_description']) > 15){
									if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
										echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
									}
								  ?></p>
							
						</div>
					<ul class="figure-list after">
						<?php
							if(!empty($item_datas['Photo'][1])){
								foreach($item_datas['Photo'] as $phts){
									//echo "<pre>";print_r($phts);
									echo '<li class="proimgovrlay"><a class="smlght" href="#" data-img-src="'. $_SESSION['media_url'].'media/items/original/'.$phts['image_name'].'" style="background-image:url(\''.$_SESSION['media_url'].'media/items/thumb70/'.$phts['image_name'].'\')"></a>
											<img src="'. $_SESSION['media_url'].'media/items/original/'.$phts['image_name'].'" style="display:none;" /></li>';
									
								}
							}
							if(!empty($item_datas['Item']['videourrl'])){
								//foreach($item_datas['Photo'] as $phts){
									//echo "<pre>";print_r($phts);
								$submitID = $item_datas['Item']['videourrl'];
								
								if (strpos($submitID, '/') === false) {
									$videoID = $submitID;
								}else {
									preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
									if (isset($matches[1]))
									{
										$videoID = $matches[1];
									}else {
										$videoID = '';
									}
								}
								//echo $videoID;die;	
									echo '<li class="proimgovrlay">
									<a  href="javascript:void(0);" onclick="showvideourll(\''.$videoID.'\');"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
									</li>';
										
								//}
							}
							
						?>
					</ul>
				
				</div>
							
															
				<div id="morefrom" class="wrapper-content right-sidebar">
				<div class='name'>
				<?php
				if(!empty($item_datas["User"]["profile_image"])){
					echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 10px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
				}else{
					echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 10px;' /></a>";
				
				}
				
				echo "<div class='more_from'>More from <br clear='all'>";
				echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				echo "</div>";
				
				
				
				?>
				</div>	
				<div class='item'>
				<?php
					if(!empty($item_all)){
					foreach($item_all as $key => $itm){
									$itm_name = $itm['Photo'][0]['image_name']; 
									$id=$itm['Item']['id'];
				                   $title=$itm['Item']['item_title_url'];
				                	//echo SITE_URL.'listing/'.$id.'/'.$title;						
										echo "<a href='".SITE_URL."listing/".$id."/".$title."' >";
				   echo '<img class="fullimgtag" alt="'.$itm['Item']['item_title'].'"  title="'.$itm['Item']['item_title'].'" height="70" width="70" style="padding-left:10px;"  src="'.$_SESSION['media_url'].'media/items/thumb70/'.$itm_name.'" >';	
					echo"</a>";				
								}		
								}
								
								
								//echo "<pre>";print_r($people_details);die;
								?>
					</div>
			</div>
				<?php
					echo "</div>";
					if(!empty($loguser)){
						echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
						echo "<input type='hidden' id='featureditemid' value='".$item_datas['Item']['id']."' />";
					}else{
						echo "<input type='hidden' id='loguserid' value='0' />";
					}
					
					echo '<input type="hidden" id="listingid" value="'.$item_datas['Item']['id'].'" />';
					echo '<input type="hidden" id="shopid" value="'.$item_datas['Shop']['id'].'" />';
					echo '<input type="hidden" id="lastestidgg" value="" />';
					echo '<input type="hidden" id="totitemshipcost" value="" />';
					echo '<input type="hidden" id="recepietName" value="" />';
					echo '<input type="hidden" id="recepietcity" value="" />';
?>

				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
			
			
			
			 <?php	}	?>
			
			
		<!-- / wrapper-content -->
	</div>
	
		
	
<!-- popups -->
<div id="popup_container">
<!-- add_to_list overlay -->
<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
	<div class="default">
		<p class="ltit">Add to List</p>
		<button type="button" class="ly-close" id="btn-browses"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image"><img id ='selectimgs' src=""></div>
			</div>
			<div class="item-categories">
				<form class="categorycls" id="categorycls">
					<fieldset class="list-categories"><div class="list-box"><ul>
					<?php 
					//echo "<pre>";print_r($items_list_data);die;
					foreach($items_list_data as $list_item){
						//$user_c_item_list[] = $list_item['Itemlist']['lists'];
						echo '<li><input type="checkbox" name="category_items[]" value="'.$list_item['Itemlist']['lists'].'" />'.$list_item['Itemlist']['lists'].'</br></li>';
                	
					}
					
					foreach($prnt_cat_data as $main_cat){
						echo '<li><input type="checkbox" name="category_items[]" value="'.$main_cat['Category']['category_name'].'" />'.$main_cat['Category']['category_name'].'</br></li>';
                	}
					echo '<div class="appen_div" ></div>';
					?>
					
					</ul></div></fieldset></form>
					<fieldset class="new-list">
						<i class="ic-plus"></i>
						<input type="text" name="list_name" id="new-create-list" maxlength="40" placeholder="Create New List">
						<button type="submit" id="list_createid" class="btn-create">Create</button>
					</fieldset>
				<!--/form-->
			</div>
		</div>
		<div class="btn-area">
				<button type="button" class="btn-add-to-list btn-done" id="btn-doneid">Done</button>
				<!--button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button-->
				<a href="#" class="btn_set" style="float: right;"><span >Settings</span><div class="fancysettings"></div></a>
				<div class="set-dropdown">
					<ul>
						<li><a href="#" class="btn-unfancy">UnMarkit</a></li>
					</ul>
					
				</div>
			</div>
			<input type="hidden" id="passedFromItemId" value="" />
	</div>
	<div class="create-list" style="display:none">
		<p class="ltit">Create New List</p>
		<button class="close cancel" title="Close" ><i class="ic-del-black"></i></button>
		<form loid="">
		<fieldset>
			<div class="frm">
				<p><b class="stit">Title</b> <input type="text" name="list_name" class="right" placeholder="Enter a title"></p>
				
			</div>
			<div class="frm">
				<p>
					<b class="stit">Category</b>
					<select name="category_id" id="categories-for-new-list" class="right">
						<option value="0">Select category</option>
					</select>
				</p>
			</div>
			
			<div class="frm">
				<b class="stit">Contributors</b>
				<div class="right">
					<p>
						<input type="text" id="create-list-find-user" placeholder="Username or email address">
						<button class="btn-invite">Invite</button>
						<div class="comment-autocomplete">
							<ul>
								<script type="fancy/template">
									<li><img src="##image_url##" class="photo"><span class="username">##username##</span><span class="name">(##fullname##)</span></li>
								</script>
							</ul>
						</div>
						<input type="hidden" name="collaborators" id="create-list-collaborators" value="">
					</p>
					<ul class="user-list">
						<li>
							<img src="" alt="">
							<span class="left"><b></b></span>
							<span class="right">Creator</span>
						</li>
						<script type="fancy/template" id="tpl-invite-user-list">
							<li data-id="##id##"><img src="##image_url##"><span class="left"><b>##fullname##</b>##username##</span><span class="right"><a href="#"><i class="ic-del"></i><span class="hidden">Delete</span></a></span></li>
						</script>
					</ul>
				</div>
			</div>
		</fieldset>
		<div class="btn-area">
			<button type="submit" class="btn-create">Create list</button>
			<button type="button" class="cancel">Cancel</button>
		</div>
		</form>
	</div>
</div>
<!-- /add_to_list overlay -->


<!--share-social-->
<div id="share-social" class="popup ly-title share-new"  style="margin-left: 414px; display: none; margin-top: 100px; opacity: 1;">
	 
	<p class="ltit">
		<span class="share-thing">Share This Thing</span>
	</p>
	<div class="fig">
		<span class="thum"  style="width:100px;height:100px" ><img id="thum_img" src=""></span>
		<div class="fig-info">
			<span class="figcaption" id="figcaption_title_popup" > </span>
			<span class="username" ><b>$<span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
			<h4>dsasas</h4><p class="from">qq</p>
		</div>
		
		
		
		
		
	</div>
	<div class="share-via">
		<ul class="less">
		
		
			
			<li><a style="float: left;margin-left: 5px;" class='facebook' href='' alt='Share this on facebook'  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google plus" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
			
			
			
			
			
			<!--
			<li><a  href="http://www.facebook.com/sharer.php?s=100&p[title]='titlesssss'&p[summary]=' + encodeURIComponent('description here') + '&p[url]=' + encodeURIComponent('http://www.nufc.com') + '&p[images][0]='http://cf1.thingd.com/default/179335694966068439_d27b575231de.jpeg.small.jpeg')" >Fb Share</a> </li>
			
			-->
			
			
			
			
		</ul>
		<a href="#" class="show"><i class="arrow"></i></a>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->



<div class="popup create-group-gifts">
    <h2 class="tit">Create a Group Gift</h2>
    <ol class="step step1">
	<li class="fst">Choose Recipient <span></span></li>
	<li class="scd">Personalize <span></span></li>
	<li class="trd">Ask for Contributions</li>
    </ol>
   
    <div class="chept recipient">
	<ul class="tab">
	    <li><a href="#" class="current add">Enter manually</a></li>
	    <!-- li><a href="#" class="pick">Pick a friend</a></li -->
	</ul>
	<?php /* ?>
	<div class="pick-friends"  style="display: none; margin-top: 10px;">
	    <div class="tab1">
			<fieldset class="search-friends">
				<span class="icon ic-search"></span>
				<input type="text" placeholder="Search friends" class="search-social-friends"/>
				<ul class="user-list">
				</ul>
			</fieldset>
			<!-- dl class="friends-list gg-friends current connect">
				<dt>
				<a href="#">
					<span><span class="icon"></span> <b>Google+ friends </b> <small></small></span>
				</a>
				<span id="connect-google" style="display:none"><span></span></span>
				</dt>
				<dd>
				<ul>
				</ul>
				<span class="loading"></span>
				<div class="no-data">
				    <b>Cannot find your friends</b>
				    Please go to <a href="https://plus.google.com/apps" target="_blank">Google+ Apps</a> and check your friends visible in 'Advanced connection settings' for Fancy.
				</div>
				</dd>
			</dl-->
			<dl class="friends-list fb-friends">
				<dt>
				<a href="#" id="fbconn">
					<span><span class="icon"></span> <b>Facebook friends</b> <small></small></span>
				</a>
				</dt>
				<dd>
				<ul>
				
				
					<!-- >li class="select-friends">
						<a data-image_url="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/573921_100000658927801_1012991208_n.jpg" data-type="facebook" data-html_url="/saravana235" data-username="saravana235" data-id="100000658927801" data-fullname="Saravana Kumar" href="#">
						<em class="img-wrap">
						<img class="photo" style="background-image:url('https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/573921_100000658927801_1012991208_n.jpg');float:left;width:180px;height:180px;" >
						<span class="line"></span>
						</em>
						<b class="username">Saravana Kumar</b>
						<span class="date">Birthday 23 May</span>
						</a>
					</li-->
					
				
				</ul>
				<span class="loading"></span>
				<div class="no-data" style="display:none;">
				    <b>Cannot find your friends</b>
				</div>
				</dd>
			</dl>
			<div class="btn-area">
				<span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'groupgifts'; ?>">How it works</a></span>
			</div>
	    </div>
	    
	</div>
	
	<?php */ ?>
	<div class="add-friends">
	    <div class="scroll suggest-u">
			<h4>Suggested friends</h4>
			<dl class="event-day">
				<dd><ul></ul></dd>
			</dl>
	    </div>
	    <?php	//echo $this->Form->Create('ggusersave',array('url'=>array('controller'=>'/','action'=>'/'),'onsubmit'=>'return validggusersave()')); ?>
  		<form onsubmit="return validggusersave();">
		<div class="frm">
		    <input type="hidden" name="uid" value=""/>
		    <p>
			<label class="label">Recipient</label>
			<input type="text" class="text search-fancy-users" name="recipient" id="recipient" placeholder="Enter a username or an email address" />
		    <br /><span id='recipient_name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Recipient Name </span>
		    </p>
		    
		    <ul class="user-list">
		    </ul>
		    <p>
			<label class="label">Full Name</label>
			<input type="text" name="name" id="name" class="text"/>
			<br /><span id='name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Full Name </span>
		    </p>
		    
		    <p>
			<label class="label">Address</label>
			<input type="text" class="text add1" name="address1" id="address1" placeholder="Address Line 1" />
			<br /><span id='address1_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Address1 </span>
		     </p> 
		     
			 <p>
			<label class="label">Address2</label>
			<input type="text" class="text add2" name="address2" id="address2" placeholder="Address Line 2" />
		    <br /><span id='address2_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Address2 </span>
		    </p>
		    
		    <p>
			<label class="label">Country</label>
			<select  name="countrygg" id="countrygg" style="width:260px;" >
				<option value="">Select Country</option>
				<?php foreach ($contry_datas as $country) {	?>
				<option value="<?php echo $country['Country']['id'];?>"><?php echo $country['Country']['country']; ?></option>
				<?php } ?>
			</select>
			<br /><span id='country_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Select The Country </span>
		    </p>
		    
		    <p class="state">
				<label class="label">State</label>
				<input type="text" class="text add2" name="stategg" id="stategg" placeholder="State" />
			 	<br /><span id='state_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the State </span>
		    </p>
		     
		    <p>
				<label class="label">City</label>
				<input type="text" class="text city" name="citygg" id="citygg" placeholder="e.g. New York" />
				<br /><span id='city_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the City </span>
		     </p>
			
			<p>
			<label class="label">Zipcode</label>
			<input type="text" class="text zip" name="zipcodegg" id="zipcodegg" placeholder="ZIP Code" maxlength="6"/>
		    <br /><span id='zipcode_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Zipcode </span>
		    </p>		
		    
		    <p>
			<label class="label">Telephone</label>
			<input type="text" class="text" name="telephonegg" id="telephonegg" placeholder="10 digits, no dashes"  maxlength="11"/>
		    <br /><span id='telephone_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> Enter the Telephone number </span>
		    </p>
		   
		    <div class="photo">
			<img src="" style="display:none" />
			<input type="file" id="recipient-image" name="upload-file" class="hidden">
			<?php 
			
				/* if(empty($item_datas['User']['profile_image'])){
					$image_computer = '';
				 }else{
					$image_computer = $item_datas['User']['profile_image'];
				} */
			
				$image_computer = 'usrimg.jpg';
				echo "<div class='input-group'>";
					if($image_computer!='usrimg.jpg'){
						echo "<img id='show_url'  style='width: 70px; height: 70px; border: 1px solid rgb(221, 221, 221); padding: 5px; margin-left: 23px; margin-top: 20px;".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/".$image_computer."'>";
					}else{
						echo "<img id='show_url'  style='width: 70px; height: 70px; border: 1px solid rgb(221, 221, 221); padding: 5px; margin-left: 23px; margin-top: 20px;".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'>";
					}
					echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'userupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="width: 125px; margin-left: 6px;"></iframe>';												
					echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
						if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' style='margin-left: 14px;' class='btn' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left: 14px;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
					echo "</div>";
					
				echo "</div>";
			
			echo "<br clear='all' />";
			
				?>
			
			
			<!-- button type="button" class="btn-upload" onclick="add()"><span class="icon"></span>Upload Photo</button-->
		    </div>
		</div>
		<div class="btn-area">
		    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'groupgifts'; ?>">How it works</a></span>
		    <button type="button" class="btns-white btn-cancel" id="gglistdone">Cancel</button>
		    <button type="submit" class="btns-blue-embo btn-continue">Continue</button>
		</div>
	    </form>
	</div>
    </div>
    <div class="chept personalize" style="display:none;">

	<h3>Fill in details for group gift</h3>
	<div class="gifts-thing">
	    <figure><img id="listingitemids" src="" /></figure>
	    <figcaption></figcaption>
	    <p class="description"></p>
	    <div class="price">
		<span class="goal" onmouseover="$(this).parents('.price').find('.total').show();" onmouseout="$(this).parents('.price').find('.total').hide();">Goal Total</span>
		<b>$<span class="total_price" style="float:none" id="totalscosts" ></span> <small>USD</small></b>
		<ul class="total">
		    <li><span>Item total</span> <b>$<span class="subtotal_price" id="totalscosts2" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Shipping</span> <b>$<span class="shipping_cost" id="shipscosts" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Tax</span> <b>$<span class="sales_tax" style="float:none">0</span><small>USD</small></b></li>
		</ul>
	    </div>
	</div>
	<div class="frm">
	    <p>
		<label class="label">Title</label>
		<input type="text" class="text" id="ggift-title" placeholder="Ex. Jenny’s birthday present" />
		 </p>
	    <p>
		<label class="label">Description</label>
		<textarea type="text" class="text" id="ggift-description" placeholder="Ex. Lets celebrate Jenny and give her an amazing gift!"></textarea>
	    </p>
	    <p class="cmt">Use your group gift description to share more about who you’re raising contributions for and why.</p>
        <p><label class="label">Note</label>
        <input type="text" class="text" id="ggift-note" placeholder="You can leave a personalized note to merchant here." /></p>
	</div>
	<div class="btn-area">
	    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'groupgifts'; ?>">How it works</a></span>
	    <!-- button type="button" class="btns-white btn-back"  id="gglistdone">Go Back</button-->
	    <button type="button" class="btns-blue-embo btn-continue" id="createggift" onclick="createggift()">Create Group Gift</button>
	</div>
    </div>
   
    <div class="chept summary" style="display:none;">
	<div class="share" style="margin:0 72px;text-align:center;">
	    <p><b>Ask your friends to contribute</b></p>
	    <ul>
		
		<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
		<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"     onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
		<li><a style="float: left;margin-left: 5px;" class='google'  href=" alt="Share this on Google+" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  		<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"         onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 		<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 		<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
	
	    </ul>
    </div>
	<h3>Group gift summary</h3>
	<div class="gift">
	    <div class="gift-total">
		<h4>Group Gift Total</h4>
		<ul>
		    <li><span>Item total</span> <b>$<span class="subtotal_price" id="totalscosts3" style="float:none"> </span> <small>USD</small></b></li>
		    <li><span>Shipping</span> <b>$<span class="shipping_cost" id="shipscosts1" style="float:none"></span> <small>USD</small></b></li>
		    <li><span>Tax</span> <b>$<span class="sales_tax" style="float:none"></span>0 <small>USD</small></b></li>
		    <li class="total"><span>Goal Total</span> <b>$<span class="total_price" id="totalscosts1" style="float:none"></span> <small>USD</small></b></li>
		</ul>
	    </div>
	    <p class="gift-title"  id="Usergifttitle" ><b></b></p>
	    <p class="gift-description" id="Usergiftdescription"></p>
	    <span class="line"></span><figure><img id="listingitemids1" src="" /></figure>
	    <div class="gift-to">
		
		<?php
		/*
		 * 
		 * 
		 * 
		<!-- img src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg'; ?>" class="avatar" / -->
		 * echo $image_computer;
		if($image_computer!='usrimg.jpg'){
			echo "<img  class='avatar' src='".$_SESSION['media_url']."media/avatars/thumb70/".$image_computer."'>";
		}else{
			echo "<img class='avatar' src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg'>";
		}*/
		?>
		
		
		<small>Gift to</small><br />
		<b id="UsergiftNamee" > </b><br />
		<span id="Usergiftcity" > <span>
	    </div>
	</div>
	<div class="btn-area">
	    <span class="notify"><i class="icon"></i> This group gift will be valid for 7 days.</span>
	    <button class="btns-blue-embo btn-continue" id="gglistdone">Done</button>
	</div>
    </div>
</div>


<!--share-social-->
<div id="videourrls" class="popup ly-title share-new"  style="opacity: 1; display: none; width: 645px; margin-left: 318px; margin-top: 75px;">
	 
	<p class="ltit">
		<span >Video</span>
	</p>
	<div class="share-via">
		<?php 
			echo "<div id=\"ytvply\">
					<object width=\"644\" height=\"362\"><param name=\"movie\" value=\"https://www.youtube.com/v/" .$videoID. "?version=3&rel=0&modestbranding=1\"></param>
					<param name=\"allowFullScreen\" value=\"true\"></param>
					<param name=\"allowscriptaccess\" value=\"always\">
					<param name=\"allownetworking\" value=\"internal\"></param>
					<embed src=\"https://www.youtube.com/v/" .$videoID. "?version=3&rel=0&modestbranding=1&hl=en_US\" type=\"application/x-shockwave-flash\" width=\"644\" height=\"362\" allowscriptaccess=\"always\" allowfullscreen=\"true\" allownetworking=\"internal\">
					</embed>
					</object>
					</div>" ;
		?>
	</div>
		
	<button type="button" class="ly-close" title="Close" id="btn_close_share"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	
	
</div>
<!--/share-social-->

</div>
<!-- /popups -->
	
	
	
	
	<script>
	
var comment_status = true;

	$('#btn_close_share').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});
		$('#share-social').hide();
		$('.share-thing').hide();
		
    });

	 $('#btn-browses').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});	
    });


 $(document).keyup(function(e) { 
   if (e.keyCode == 27) { 
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
    }
});

 $(document).click(function() {
	    $('.comment-autocomplete').css("display", "none");
	});	

	$('#invoice-popup-overlay').live ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
	});
</script>
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>
<style>
.wrap {
    position: relative;
}

.wrap a {
    position: absolute;
    top: 0;
    left: 5px;
}

.wrap textarea {
    padding-top: 20px;
}
</style>

<script>
$(function() {
    $( "#datepicker" ).datepicker();
});
</script>
<style>
	
.show_hid{
	display:none;
	}
#ui-datepicker-div {
width:165px;
background-color:#c6c6c6;
border-radius:4px 4px 4px 4px;

}
.ui-datepicker-header{
background-color:#dddddd;
}
.ui-datepicker-prev{
padding-right:70px;

}
.ui-datepicker-title{
margin-top:0px;
}
.ui-datepicker-calendar th {
  border:6px  solid white;
  border-spacing: 5px 10px;
  }

 .ui-datepicker { font-size: 12pt !important; }
</style>
<script>
var invajax=0;
</script>

<script>/*
$(window).load(function(){
if(!empty($item_datas['Item']['start'])){
$(".greencart add_to_cart").hide();
}
});



$(window).scroll(function(){
	 // $('#sidebar11').toggleClass('scrolling', $(window).scrollTop() > $('#activity').offset().top);
	  //can be rewritten long form as:
	  var scrollPosition, headerOffset, isScrolling;
	  scrollPosition = $(window).scrollTop();
	  headerOffset = $('#content').offset().top;
	  headerOffset -=48;
	  isScrolling = scrollPosition > headerOffset;
	  $('#listforadd').toggleClass('scrolling', isScrolling);
	});
	    


$("#datepicker").click(function(){
	$("#datepick").hide;
	start=$("#dickpicker").val();
$("#datepick").val(start);
});
*/
</script>
