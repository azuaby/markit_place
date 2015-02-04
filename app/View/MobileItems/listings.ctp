<style>
	.imgsize {
		
	    width: 200px;
		height: 200px;
margin-top:25px;
	}
@media only screen and (max-width : 600px) {

	.imgsize {
		
	    width: 150px;
		height: 150px;
margin-top:20px;
	}

@media only screen and (max-width : 480px) {

	.imgsize {
		
	    width: 70px;
		height: 70px;
margin-top:15px;
	}
#follid
{
left:10px;
top:5px;
position:relative;
}
#unfollid
{
left:10px;
top:5px;
position:relative;
}
.wid
{
height:30px;
width:30px;
}
</style>

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
    //$( "#datepicker" ).datepicker();
  
  });
  </script>
  <style>
  .box
  {
       background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 5px;
    box-shadow: 0 0 1px #000000, 1px 1px 5px #000000;
    font-size: 20px;
    
    margin: 10px;
   
    }

    </style> 

<body>

<div class="container wider" style="top: 0px;">
		<div class="wrapper-content right-sidebar" style="background:none;margin-bottom: -5px;">
			<div id="content">
				<div class="figure-row first sepProduView">
					<div class="figure-product figure-640 big text-left">
					<div class="ui-body ui-body-a" style="border-radius:5px;">
					

					
					
					
			<div style="with:98%!important;margin-left:-5px;height:45px;">
				<div style="width:98%;float:left;">
															<?php 
						if(!empty($item_datas["User"]["profile_image"])){
							echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 2px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
						}else{
							echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 2px;' /></a>";
						
						}
						
						
						
					//echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				?>
				<a data-ajax="false" style="text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:50px;top: -43px;font-weight: bold ! important;color: #373D48;font-size:15px;" title="<?php echo $item_datas['Item']['item_title']; ?>" id="img_id<?php echo $item_datas['Item']['id']; ?>"  href="#">
				<img style="display:none;" id="fullimgtag" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/thumb70/'.$item_datas['Photo'][0]['image_name'];?>">
				<div><?php echo UrlfriendlyComponent::limit_char($item_datas['Item']['item_title'],25); ?></div>
				
				</a>
				<a style="text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative;top:-48px;left:50px;font-weight:normal!important;color:#979797!important;" data-ajax="false" href="<?php echo SITE_URL."mobile/people/".$item_datas['User']['username_url']; ?>">
				<span >@<?php echo $item_datas['User']['username']; ?></span>
				</a>
				<img style="display:none;" id="fullimgtag" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/thumb70/'.$item_datas['Photo'][0]['image_name'];?>">
				
				</div>
				</div>
				<div style="with:98% !important;">
				<a data-role="none" title="<?php echo $item_datas['Item']['item_title']; ?>" id="img_id<?php echo $item_datas['Item']['id']; ?>"  href="#">	
				
		                          
                    
				<span class="wrapper-fig-image" style="text-align: center; background: #FBFCFC; ">
				<center><img id="fullimgtag" style="position:relative;top:-30px;" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>"></center>
					</span>
					       
               
               </a>
               </div>
		
			
			
						
						
						
				
			<?php
				//echo $item_datas['Itemfav'][0]['user_id'];die;
		
				foreach($item_datas['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				echo '<div style="margin-top:-45px;">
				<div style="width:28%;float:left;height:30px;">';
				if(isset($usecoun) &&  in_array($item_datas['Item']['id'],$usecoun)){
				echo  '<a class="button fantacyd edit" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou1('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" >
     <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacydbtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$item_datas['Item']['id'].'" >
    <img id="im'.$item_datas['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacyd.png" style="margin: -1px;margin-left:-8px;"></span>
    <span style="margin-left:2px;top:-1px;position:relative;color:#188EE6;" class="itemdd'.$item_datas['Item']['id'].'" id="faval'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span></span></a>
    ';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" >
     <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$item_datas['Item']['id'].'">
    <img id="im'.$item_datas['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacy.png" style="margin:-1px;margin-left:-8px;"></span>
    <span style="margin-left:2px;top:-1px;position:relative;" class="itemdd'.$item_datas['Item']['id'].'" id="faval'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span></span></a>
    ';
				}	
				
				
				echo '</div> <div style="width:70%;float:left;text-align:right;margin-top:25px;">';
				?>
<?php
				$comment_count = 0;
				foreach($item_datas['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];		
					$comment_count++;		
				}
?>
							<?php 
						$itemcolor = $item_datas['Item']['item_color'];
						$itemidse = $item_datas['Item']['id'];
						$itemcolor = json_decode($itemcolor,true);
						//$comment_count = $item_datas['Item']['comment_count'];
						?>
						<?php
				echo '<a data-ajax="false" href="'.SITE_URL.'mobile/comments/'.$itemidse.'"><span style="position: relative;float: right;margin-left:4px;" class="comment">
				<div style="width:auto;border:1px solid #D5D9DC;border-radius:5px;height:26px; !important;float:left;">
				<img src="'.SITE_URL.'images/menu/chat.png" style="margin-top:5px;">
				 <span style="color:#707070!important;margin-right:4px;top:-2px;position:relative;">'.$comment_count.'</span></div></span></a>';
				 ?>
						<?php
						echo '<a data-role="none" class="wid" style="height:30px;width:30px;display:inline-block;position:relative;text-decoration:none;" href="#share-social" data-rel="popup" data-position-to="window" onclick = "share_post('.$itemidse.');"  >
							<img src="'.SITE_URL.'images/menu/share.png">
						</a>';
						?>
					<?php
					echo '<a data-role="none" class="wid" style="height:30px;width:30px;display:inline-block;position:relative;text-decoration:none;" href="#add-to-list-new" data-rel="popup" data-role="none" data-position-to="window" onclick = "itemcou('.$itemidse.');" >
						<img src="'.SITE_URL.'images/menu/addtolist.png">
						</a>';
						?> 
						
						<!--a style="text-decoration:none;" href="<?php echo SITE_URL.'mobile/color/'.ucwords(strtolower($itemcolor[0])); ?>" class="color">
							<img src="<?php echo SITE_URL; ?>images/menu/similarcolor.png">
						</a-->  
				
				
				
				
				</div></div>
				<?php
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
				?>
				</div>
				<br />
				
				<div class="ui-body ui-body-a" style="display:none;">
				
				<?php //if(($item_datas['Item']['status'] != 'things')){ ?>
			<section class="comments comments-list comments-list-new commandseprate">
	            		
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
						echo '<li class="comment delecmt_'.$cmnt['Comment']['id'].'" commid="'.$cmnt['Comment']['id'].'" style="list-style:none;">';
							echo '<a class="milestone" id="'.$cmnt['Comment']['id'].'"></a>';
							echo '<div style="with:98%!important;padding:5px;height:auto;overflow: hidden;">
							<div style="width:6%;float:left;">';
							echo '<span class="vcard">';
							echo '<a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							if(!empty($cmnt['User']['profile_image'])){
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$cmnt['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
							}else{
							echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
							}
							
							$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
							echo '</a></span></div><div style="width:92%;float:left;text-align:left;">';
							echo '<span class="vcard cmntusername" style="position: relative;"><a style="text-decoration:none;" href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							echo '<span class="fn nickname">'.$cmnt['User']['username'].'</span></a></span>';
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; width: 540px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;"   onkeyup="ajaxuserautoc(this.value,\'txt1val'.$cmnt['Comment']['id'].'\',\'comment-autocomplete'.$cmnt['Comment']['id'].'\');">';
							//echo $cmnt['Comment']['comments'];
							echo preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							
							echo '</textarea> <button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >Save comment</button></p>';
							echo '<div class="comment-autocomplete comment-autocomplete'.$cmnt['Comment']['id'].'" style="display: none;left:43px;width:548px;">';
							echo '<ul class="usersearch">';
								
							echo '</ul>';
							echo '</div>';
							echo '<p id="oritext'.$cmnt['Comment']['id'].'" style="margin-top:0px;">'.$cmnt['Comment']['comments'].'</p>';
							 echo '</div></div><br/>';
							echo '<div id="oritextvalafedit'.$cmnt['Comment']['id'].'"></div>';
							
							echo '<div class="c-reply" >';
							
								if($cmnt['Comment']['user_id']==$userid){
									echo '<button class="edit-comment" onclick = "return editcmnt('.$cmnt['Comment']['id'].')" >Edit</button><span class="bar"></span>';
									echo '<button class="delete-comment" onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >Delete</button>';
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
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$item_datas['Item']['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span class="fav_count" id="fav_count'.$item_datas['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></span>';

				?>
					
					<div id="sa"></div>
				
					<label class="hidden">Comment:</label>
					<div style="with:98%!important;padding:5px;height:auto;overflow: hidden;">
				<div style="width:5%;float:left;">
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
					
					echo '</a></span>';	
					echo '</div><div style="width:93%;float:left;text-align:right;">';
					//echo '<span class="fn nickname">"'.$loguser[0]['User']['username'].'"</span></a></span>';
					
					
					echo '<textarea id="comment_msg" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value, \'comment_msg\',\'comment-autocompleteN\');"  autocomplete="off" placeholder="Write a comment..."  i_id="'.$item_datas['Item']['id'].'" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
					echo '</div></div>';
					endif; 
					echo '<div class="comment-autocomplete comment-autocompleteN" style="display: none;">';
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
					 <?php if (isset($userid) ) : ?>
					<br /><div class="btns-post">
						<small>Use @ to mention someone</small>
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post"  onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave">Post comment</button>
						<div class="post-loading" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
  					<?php endif; ?> 
					</section>
				
				</div>
				
				
				
				
				

					
				
					<!---- Demo and Action------>
					<div class="ui-body ui-body-a" style="border-radius:5px;">
			<?php if(($item_datas['Item']['status'] != '')){ ?>
			
			<aside id="sidebar" style="background:none;" >
				<section class="thing-section gift-section">
                <?php 
				$itemcolor = $item_datas['Item']['item_color'];
				$itemidse = $item_datas['Item']['id'];
				$itemcolor = json_decode($itemcolor,true);
				
				
				
				?>
				
				<?php /* if(($item_datas['Item']['status'] == 'things')){ ?>
				<div class="figure-row first sepProduView ">
					<ul class="thing-info">
						<li style="list-style;none;">
							<a style="text-decoration:none;" href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>"  ><button class="buyitbttn" value="" style="background:#81C540;color:#FFFFFF;text-shadow:none;"><i class="ic-cart"></i>Buy It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
						</li>						
						<li style="list-style;none;">
							<a href="<?php echo  SITE_URL.'sellersignup/'.$item_datas['Item']['id']; ?>"  ><button class="sellitbttn"><i class="ic-cart"></i>Sell It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/sellitem.png"> <a href="'.SITE_URL.'sellersignup/'.$item_datas['Item']['id'].'"  >Sell it</a>'; ?>
						</li>
					</ul>
				</div>
					<?php } */ ?>
				
				<?php
					if(!empty($loguser)){
						echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
						echo "<input type='hidden' id='featureditemid' value='".$item_datas['Item']['id']."' />";
					}else{
						echo "<input type='hidden' id='loguserid' value='0' />";
					}
					
					echo '<input type="hidden" id="listingid" value="'.$item_datas['Item']['id'].'" />';
					echo '<input type="hidden" id="shopid" value="'.$item_datas['Shop']['id'].'" />';
					echo '<input type="hidden" id="merchantid" value="'.$item_datas['User']['id'].'" />';
					echo '<input type="hidden" id="merchantname" value="'.$item_datas['User']['username'].'" />';
					echo '<input type="hidden" id="itemname" value="'.$item_datas['Item']['item_title'].'" />';
					echo '<input type="hidden" id="lastestidgg" value="" />';
					echo '<input type="hidden" id="totitemshipcost" value="" />';
					echo '<input type="hidden" id="recepietName" value="" />';
					echo '<input type="hidden" id="recepietcity" value="" />';
					?>
			
				
				
				
				
					<div class="itemAddedUserDetails  figure-row first sepProduView ">
	<?php if(($item_datas['Item']['status'] == 'things')){ ?>
								<h1 style="border: medium none; margin: 8px 0px 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
									
									<div class="thing-description" >
										
										<span style="font-size: 15px;">  <?php 
												echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
												//echo str_word_count($item_datas['Item']['item_description'], 0);
												//if(strlen($item_datas['Item']['item_description']) > 15){
												if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
													echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
												}
											  ?></span>
										
					
						
									</div>
</div>
									<div id="showdes"></div>
									
															
						<?php if ($item_datas['Item']['price'] != 0 &&$item_datas['Item']['price'] != '') { 
							$convertPrice = round($item_datas['Item']['price'] * $_SESSION['currency_value'], 2);
						?>
							<p class="prices" style="font-size:24px;display:inline;">
							<strong class="price"><?php echo $_SESSION['currency_symbol'].$convertPrice; ?></strong><span style="font-size:12px;"> <?php echo $_SESSION['currency_code']; ?></span><br>
							<input type="hidden" id="price" value="<?php echo $item_datas['Item']['price']; ?>">	
							</p>
							<?php } ?>
										<!--?php
						if($userid != $item_datas['User']['id']){
							
							foreach($followcnt as $flcnt){
								$flwrcntid[] = $flcnt['Follower']['user_id'];
									
							}
							//echo "<pre>";print_r($flwrcntid);die;
							if($userid != $item_datas['User']['id']){
								if(isset($flwrcntid) && in_array($item_datas['User']['id'],$flwrcntid)){
									$flw = false;
								}else{
									$flw = true;
								}
							
							
								if($flw){
							
									if(empty($item_datas['User']['id'])){
										echo "<input type='hidden' id='gstid' value='0' />";
									}else{
										echo "<input type='hidden' id='gstid' value='".$userid."' />";
											
										echo "<span class='follow' style='left:5px;top:5px;position:relative;'  id='foll".$item_datas['User']['id']."'>";
										echo '<button type="button" id="follow_btn'.$item_datas['User']['id'].'" class="btnblu" onclick="getfollows('.$item_datas['User']['id'].')" style="width:100px;height:35px;text-shadow:none;">';
										echo '<span class="foll'.$item_datas['User']['id'].'" style="font-size:13px;position:relative;top:-5px;" >Follow</span>';
										echo '</button>';
										echo "</span>";
							
									}
								}else{
									echo "<span class='follow' style='left:5px;top:5px;position:relative;' id='unfoll".$item_datas['User']['id']."'>";
									echo '<button type="button" id="unfollow_btn'.$item_datas['User']['id'].'" class="greebtn" onclick="deletefollows('.$item_datas['User']['id'].')" style="width:100px;height:35px;background:#339EF0;color:#FFFFFF;text-shadow:none;">';
									echo '<span class="unfoll'.$item_datas['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Following</span>';
									echo '</button>';
									echo "</span>";
								}
								echo '<span id="changebtn'.$item_datas['User']['id'].'" ></span>';
							
							}
							
						}	
						?-->

									<span class="thing-info">	
									<li style="list-style:none;">
										<a style="text-decoration:none;" href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>" target="_blank" ><button class="buyitbttn" value="" style="background:#81C540;color:#FFFFFF;text-shadow:none;">Buy It</button></a>
											<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
									</li>				
								</span>
				
							</div></div>
								<?php }else{ ?>
							
							<div class="option-area">
							
							
												<div class="figure-row first sepProduView ">
	                    <h1 style="margin: 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
	
						<div class="thing-description" >
							
							<span style="font-size:15px;">  <?php 
									//echo $item_datas['Item']['item_description'];
									echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
									//echo str_word_count($item_datas['Item']['item_description'], 0);
									//if(strlen($item_datas['Item']['item_description']) > 15){
									if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
										echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
									} 
								  ?></span>	
						</div></div>
								<div id="showdes"></div>
															
						<?php if ($item_datas['Item']['price'] != 0 &&$item_datas['Item']['price'] != '') { 
							$convertPrice = round($item_datas['Item']['price'] * $_SESSION['currency_value'], 2);
						?>
							<p class="prices" style="font-size:24px;display:inline;">
							<strong class="price"><?php echo $_SESSION['currency_symbol'].$convertPrice; ?></strong> <span style="font-size:12px;"><?php echo $_SESSION['currency_code']; ?></span><br>
							<input type="hidden" id="price" value="<?php echo $item_datas['Item']['price']; ?>">	
							</p>
							<?php } ?>

								<!--?php
						if($userid != $item_datas['User']['id']){
							
							foreach($followcnt as $flcnt){
								$flwrcntid[] = $flcnt['Follower']['user_id'];
									
							}
							//echo "<pre>";print_r($flwrcntid);die;
							if($userid != $item_datas['User']['id']){
								if(isset($flwrcntid) && in_array($item_datas['User']['id'],$flwrcntid)){
									$flw = false;
								}else{
									$flw = true;
								}
							
							
								if($flw){
							
									if(empty($item_datas['User']['id'])){
										echo "<input type='hidden' id='gstid' value='0' />";
									}else{
										echo "<input type='hidden' id='gstid' value='".$userid."' />";
											
										echo "<span class='follow'   id='foll".$item_datas['User']['id']."'>";
										echo '<button type="button" id="follow_btn'.$item_datas['User']['id'].'" class="btnblu" onclick="getfollows('.$item_datas['User']['id'].')" style="width:100px;height:35px;text-shadow:none;">';
										echo '<span class="foll'.$item_datas['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Follow</span>';
										echo '</button>';
										echo "</span>";
							
									}
								}else{
									echo "<span class='follow' id='unfoll".$item_datas['User']['id']."'>";
									echo '<button type="button" id="unfollow_btn'.$item_datas['User']['id'].'" class="greebtn" onclick="deletefollows('.$item_datas['User']['id'].')" style="width:100px;height:35px;background:#339EF0;color:#FFFFFF;text-shadow:none;">';
									echo '<span class="unfoll'.$item_datas['User']['id'].'" style="font-size:13px;position:relative;top:-5px;">Following</span>';
									echo '</button>';
									echo "</span>";
								}
								echo '<span id="changebtn'.$item_datas['User']['id'].'" ></span>';
							
							}
							
						}	
						?-->
								<label for="quantity" style="display: inline-block; font-size: 14px;font-weight:bold;">Quantity: </label>
								<span class="input-number" style="display: inline-block; position: relative;color:#717171;font-size:13px;">
									 <?php if($item_datas['Item']['quantity']<=0){
									 			echo "Sold Out";
									 		}else{
									 			echo "Only ".$item_datas['Item']['quantity']." available ";
									 		}
									  ?>
									
									
								</span>
								<?php 
								$process_time = $item_datas['Item']['processing_time'];
									if($process_time == '1d'){
										$process_time = "One business day";
									}elseif($process_time == '2d'){
										$process_time = "Two business days";
									}elseif($process_time == '3d'){
										$process_time = "Three business days";
									}elseif($process_time == '4d'){
										$process_time = "Four business days";
									}elseif($process_time == '2ww'){
										$process_time = "One-Two weeks";
									}elseif($process_time == '3w'){
										$process_time = "Two-Three weeks";
									}elseif($process_time == '4w'){
										$process_time = "Three-Four weeks";
									}elseif($process_time == '6w'){
										$process_time = "Four-Six weeks";
									}elseif($process_time == '8w'){
										$process_time = "Six-Eight weeks";
									}
								?>
								<br clear="all" />
								<div class="shippingTime"> 
								<?php if($item_datas['Item']['quantity']>0){
								?>
									<img src="<?php echo SITE_URL; ?>images/shippingicon.gif" alt="Shipping: " />
									<?php
									}
									?>
									
									<span class="shipperiod" style="position:relative;top:-2px;font-size:13px;"><?php echo $process_time; ?></span>
								</div>
							</div>
							
							<?php
								$optionsval = explode(',',$item_datas['Item']['size_options']);
								if($item_datas['Shop']['user_id'] != $userid && $item_datas['Item']['quantity'] > 0){
									echo '<div class="formcartlistiongs">';
									echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/mobile/pays'), 'onsubmit' => 'return validateaddcart();','data-ajax'=>'false'));
							?>
								<input type="hidden" value="<?php echo $cntry_code; ?>" name="shipping_method_id">
								<input type="hidden" value="<?php echo $item_datas['Item']['id']; ?>" name="listing_id">
									
								<?php
									if(!empty($item_datas['Item']['size_options'])){
								?>
								<input type="hidden" value="1" name="sizeset" id="sizeset">
								<div class="qtysizdiv">
								<div class="selsizediv">
								
								<span class="Quantity" style="font-size:13px;">Select Size</span><br clear="all" />
								<div class="selectdiv" style="height:auto;overflow:hidden;" >
								    <select class="selectboxdiv" style="margin: 0px 0px 10px;font-size:13px;" name='size_opt' id="size_opt" onchange="itemlistingloadqty('<?php echo $item_datas['Item']['id']; ?>')">
								        <option value="" style="font-size:13px;">Select Size</option>
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
									<div class="out" style="width: 188px !important;display:none;" >Select Size</div>
								</div>
								
								<div class="sizeqtyloader" style="display:none;">
									<img src="<?php echo SITE_URL; ?>images/loading.gif" />
								</div>
								</div>
								
								<div class="selqtydiv sizeqtydiv">
								<span class="Quantity" style="font-size:13px;">Select Quantity</span><br clear="all" />
								
								<div class="selectdiv" style="height:auto;overflow;hidden;" >
								    <select class="selectboxdiv" style="margin-right: 2px ! important;font-size:13px;" name='quantity' id="qty_opt">
								        <?php
											$qty = $item_datas['Item']['quantity'];
										for($i = 1; $i <= $qty; $i++ ){
											if($i==1)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
											else
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
								    </select>
								    <div class="out" style="width: 90px !important;display:none;" >1</div>
								</div>
								</div>
								
								</div>
								<?php
									}else{ ?>
								
								<input type="hidden" value="0" name="sizeset" id="sizeset"><br />
								
								<span class="Quantity" style="font-size:13px;">Select Quantity</span><br clear="all" />
								
								<div class="selectdiv" style="height:auto;overflow;hidden;" >
								    <select class="selectboxdiv" style="margin: 0px 0px 10px;font-size:13px;" name='quantity' id="qty_opt">
								        <option value="1" style="font-size:13px;">1</option>
										<?php
											$qty = $item_datas['Item']['quantity'];
										for($i = 2; $i <= $qty; $i++ ){
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
								    </select>
								    <div class="out" style="width: 293px !important;display:none;" >Select Quantity</div>
								</div>
									<?php
											
									}
								
									//print_r(explode(',',$item_datas['Item']['size_options']));die;
									if(empty($item_datas['Item']['start'])){
									if(($item_datas['Item']['quantity'] > 0) && ($item_datas['Item']['status']=='publish')){ ?>
											<!--div id="ggift"> Create Group Gift </div>
											<div class="giftorbuy">-OR-</div-->
										<button type="submit" style="background:#81C540;font-color;#FFFFFF !important;font-weight:normal !important;" class="greencart add_to_cart" value="Add to Cart">
										<font color=#FFFFFF>Add to Cart</font></button>
									<div class="addcarterror"></div>
									
									<?php	}  ?>
					<!-- <button class="greencart add_to_cart soldout hidden"><i class="ic-cart"></i><strong>Sold Out</strong></button> -->
				
								</form>
						</div>
							
						<?php }  } ?>
						
						
					</div>
					
				
				
				

					
						<!--?php if (strlen($item_datas['Item']['item_description']) > 135) { ?-->
							<!--div class="more-enable">
								<a href="javascript:void(0);" id="full-description">more</a>
							</div-->
							<!--?php } ?-->
						<!--div class="productimginfo">
							<div class="description">
								<div class="less">
									<p style="display:inline;"><?php echo $item_datas['Item']['item_description'];?></p>
								</div>
								<a href="#" class="more" onclick="$('div.description > div').removeClass('less');$(this).hide().next().show();return false">(More)</a>
								<a href="#" class="less" style="display:none" onclick="$('div.description > div').addClass('less');$(this).hide().prev().show();return false">(Less)</a>
							</div>
						</div--> 
					<ul class="figure-list after" style="display:none;">
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
				
				</div></div>
			<?php } ?>
							
			
			
			
					
					
					
					
					
						
						
						
						
				<br /><div class="ui-body ui-body-a" style="border-radius:5px 5px 0px 0px;background:#F2F2F2;text-align:center;">										
			
				
										<?php
						echo "<b>You may also like</b> ";
				//echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/mobile/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				//echo '<span class="usernameMention" style="right: 97px; bottom: -17px;">@'.$item_datas["User"]["username_url"].'</span>';
				echo "</div>";
				?>
				
					<div class="ui-body ui-body-a" style="border-radius:0px 0px 5px 5px;">
				
				<?php
				
					if(!empty($item_all)){
						$index = 1;
						echo '<table style="width:100%;text-align:center;margin-top:-5px;margin-bottom:15px;"><thead><tr><th colspan="3"></th></tr></thead><tbody><tr>';
$cnt = 1;
					foreach($item_all as $key => $itm){
if($cnt<=9)
{
				
				echo '<td>';
									$itm_name = $itm['Photo'][0]['image_name']; 
									$id=$itm['Item']['id'];
				                   $title=$itm['Item']['item_title_url'];
				                	//echo SITE_URL.'listing/'.$id.'/'.$title;						
										echo "<center><a data-ajax='false' href='".SITE_URL."mobile/listing/".$id."/".$title."' data-role='none' style='border:none;background-color:#FFFFFF;'>";
				   	
					echo '<div class="imgsize" style="background:url(\''.$_SESSION['media_url'].'media/items/thumb150/'.$itm_name.'\') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);"> </div>';

				   echo"</a></center></td>";
				   if($index%3==0)
				   echo '</tr><tr>';
				   $index++;
$cnt++;
}
				   
								}
								echo '</tr></tbody></table>';
								}
								
								
								
								?>
					
			</div>
			</div>
			<div class="reportitem">
			<?php 
			$reportedUsers = json_decode($item_datas['Item']['report_flag'], true);
			if (in_array($loguser[0]['User']['id'], $reportedUsers)){ ?>
				<p id="unreportflag" style="color:#979797;font-size:15px;">
					<img src="<?php echo SITE_URL; ?>images/menu/flag.png"><span style="margin-left:8px;">Undo reporting</span>
					<img class='reportloader' style='display:none;' src='<?php echo SITE_URL?>images/loading.gif' alt='loading...' />
				</p>
			<?php }else{ ?>
				<p id="reportflag" style="color:#979797;font-size:15px;">
					<img src="<?php echo SITE_URL; ?>images/menu/flag.png"><span style="margin-left:8px;">Report as inappropriate</span>
					<img class='reportloader' style='display:none;' src='<?php echo SITE_URL?>images/loading.gif' alt='loading...' />
				</p>
			<?php } ?>
			</div>
				<?php
				//	echo "</div>";
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
				
			</aside>
			<!-- / sidebar -->
			
			
			
			 <?php	}	?>
			 
					<!--------Demo and Action------>
					
					
				
		
						
			
			
		<!-- / wrapper-content -->
	</div>
	</div>
		
	
<!-- popups -->
<div id="popup_container" style="display:none;">



<!-- slideshow_box -->
 <section id="slideshow-box" tabindex="0">
	<header>
		<div class="container">
			<a href="<?php echo SITE_URL; ?>" class="slideHeader">
				<img src="<?php echo SITE_URL.'images/logo.png'; ?>" style="width: 130px; margin-top: -4px; margin-left: -1px;">
			</a>
			<div class="controller">
				<a href="#" id="btn-browse" title="close" style="color:#fff;font-weight:bold;">x
				<!--<img src="<?php echo SITE_URL; ?>images/gclose.png"/>-->
				</a>
			</div>
		</div>
	</header>
	<div class="container contant">
		<div id="gallery" class="content">
					
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
						<div id="caption" class="caption-container"></div>
					</div>

					<div id="controls" class="controls"></div>
				</div>

				<!-- Start Advanced Gallery Html Containers -->				
				<div class="navigation-container">
					<div id="thumbs" class="navigation">
						<a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
					
						<ul class="thumbs noscript">
							<?php
									if(!empty($FashionuserDet)){
										foreach($FashionuserDet as $key=>$itms){
											$username = $itms['User']['username'];
											$usernameUURL = $itms['User']['username_url'];
											$favorte_count = $itms['Fashionuser']['fav_count'];
											$fId = $itms['Fashionuser']['id'];
											$itemTitle = $itms['Fashionuser']['item_title_url'];
											$image_name = $itms['Fashionuser']['userimage'];
											echo '<li>';
												echo '<a class="thumb" href="'.$_SESSION['media_url'].'media/avatars/original/'.$image_name.'" title="'.$username.'">';
													echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$image_name.'" alt="'.$username.'" width="75px" height="75px"/>';
												echo '</a>';
												echo '<div class="caption">';
													echo '<div class="image-title"><a href="'.SITE_URL.'mobile/'.$usernameUURL.'">'.$username.'</a></div>';
													//echo '<div class="image-desc"><span class="username"><em><i>  by &nbsp;&nbsp;  </i><a href="'.SITE_URL.'mobile/'.$username.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span></div>';
												echo '</div>';
											echo '</li>';
											
										}
									}
							?>
							
						</ul>
						<a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
					</div>
					
				</div>
				<!--<div class="content">
					<div class="slideshow-container" style="position:relative;">
						<div id="controls" class="controls"></div>
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container">
						<div class="photo-index"></div>
					</div>
				</div>-->
					
				<!-- End Gallery Html Containers -->
				<div style="clear: both;"></div>
	</div>
	
</section>
<!-- /slideshow_box -->


<!--share-social-->
<div id="share-social" class="popup ly-title share-new" data-role="popup" style="width:auto;margin:25px;">
	 <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<p class="ltit">
		<div class="ui-body ui-body-a" style="margin:10px;background:#F2F2F2;text-align:center;">
		<span class="share-thing"><b>Share This Thing</b></span></div>
	</p>
	<div style="margin:10px;margin-top:-10px;" class="ui-body ui-body-a">
	<div class="fig">
		<span class="thum"  style="width:100px;height:auto;overflow:hidden;" ><img id="thum_img" src=""></span>
		<div class="fig-info">
			<span class="figcaption" id="figcaption_title_popup" > </span>
			<span class="username" ><b><?php echo $_SESSION['currency_symbol']; ?><span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
			<h4 style="display:none;">dsasas</h4><p class="from" style="display:none;">qq</p>
		</div>
		
		
		
		
		
	</div>
	<div class="share-via" style="margin:25px;">
		
		
		
			
			<a style="float: left;" class='facebook' href='' alt='Share this on facebook'  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> 
			<a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a>
			<a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google plus" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a>
  			<a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a>
 			<a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a>
 			<a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a>
			
			
			
			
			
			<!--
			<li><a  href="http://www.facebook.com/sharer.php?s=100&p[title]='titlesssss'&p[summary]=' + encodeURIComponent('description here') + '&p[url]=' + encodeURIComponent('http://www.nufc.com') + '&p[images][0]='http://cf1.thingd.com/default/179335694966068439_d27b575231de.jpeg.small.jpeg')" >Fb Share</a> </li>
			
			-->
			
			
			
			
		
		<a href="#" class="show"><i class="arrow"></i></a>
	</div>
		
	
	
	
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
	
	<div class="add-friends">
	    <!-- <div class="scroll suggest-u">
			<h4>Suggested friends</h4>
			<dl class="event-day">
				<dd><ul></ul></dd>
			</dl>
	    </div> -->
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
						if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' style='margin-left: 14px;display:none;' class='btn' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left: 14px;display:none;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
					echo "</div>";
					
				echo "</div>";
			
			echo "<br clear='all' />";
			
				?>
			
			
			<!-- button type="button" class="btn-upload" onclick="add()"><span class="icon"></span>Upload Photo</button-->
		    </div>
		</div>
		<div class="btn-area">
		    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'mobile/groupgifts'; ?>">How it works</a></span>
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
		<b><?php echo $_SESSION['default_currency_symbol']; ?><span class="total_price" style="float:none" id="totalscosts" ></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b>
		<ul class="total">
		    <li><span>Item total</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="subtotal_price" id="totalscosts2" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span>Shipping</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="shipping_cost" id="shipscosts" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span>Tax</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="sales_tax" style="float:none">0</span><small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		</ul>
	    </div>
	</div>
	<div class="frm">
	    <p>
		<label class="label">Title</label>
		<input type="text" class="text" id="ggift-title" placeholder="Ex. Jenny’s birthday present" />
		<span id='title_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> Enter the Title </span>
		 </p>
	    <p>
		<label class="label">Description</label>
		<textarea type="text" class="text" id="ggift-description" placeholder="Ex. Lets celebrate Jenny and give her an amazing gift!"></textarea>
		<span id='description_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> Enter the Description </span>
	    </p>
	    <p class="cmt">Use your group gift description to share more about who you’re raising contributions for and why.</p>
        <p><label class="label">Note</label>
        <input type="text" class="text" id="ggift-note" placeholder="You can leave a personalized note to merchant here." /></p>
	</div>
	<div class="btn-area">
	    <span class="help"><span class="icon"></span> <a href="<?php echo SITE_URL.'mobile/groupgifts'; ?>">How it works</a></span>
	    <!-- button type="button" class="btns-white btn-back"  id="gglistdone">Go Back</button-->
	    <button type="button" class="btns-blue-embo btn-continue" id="createggift" onclick="createggift()">Create Group Gift</button>
	</div>
    </div>
   
    <div class="chept summary" style="display:none;">
	<div class="share" style="margin:0 72px;text-align:center;">
	    <p><b>Ask your friends to contribute</b></p>
	    <ul>
		
		<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
		<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"     onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
		<li><a style="float: left;margin-left: 5px;" class='google'  href=" alt="Share this on Google+" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  		<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"         onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 		<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 		<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
	
	    </ul>
    </div>
	<h3>Group gift summary</h3>
	<div class="gift">
	    <div class="gift-total">
		<h4>Group Gift Total</h4>
		<ul>
		    <li><span>Item total</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="subtotal_price" id="totalscosts3" style="float:none"> </span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span>Shipping</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="shipping_cost" id="shipscosts1" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span>Tax</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="sales_tax" style="float:none"></span>0 <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li class="total"><span>Goal Total</span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="total_price" id="totalscosts1" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		</ul>
	    </div>
	    <p class="gift-title"  id="Usergifttitle" ><b></b></p>
	    <p class="gift-description" id="Usergiftdescription"></p>
	    <span class="line"></span><figure><img id="listingitemids1" src="" /></figure>
	    <div class="gift-to">
		
		
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



<!-- add_to_list overlay -->

<div id="add-to-list-new" data-role="popup" class="popup ly-title update add-to-list">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
<div style="margin:10px;background:#F2F2F2;text-align:center;" class="ui-body ui-body-a">
 
	
			<b>Add to List</b></div><div class="ui-body ui-body-a" style="margin:10px;margin-top:-10px;">
		
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image" align="center"><img id ='selectimgs' src=""></div>
			</div>
			<div class="item-categories">
				<form class="categorycls" id="categorycls">
					<fieldset class="list-categories"><div class="list-box">
					<?php 
					//echo "<pre>";print_r($items_list_data);die;
					foreach($items_list_data as $list_item){
						//$user_c_item_list[] = $list_item['Itemlist']['lists'];
						echo '<li style="list-style:none;"><input type="checkbox" name="category_items[]" value="'.$list_item['Itemlist']['lists'].'" style="margin:0px;"/><span style="margin-left:30px;">'.$list_item['Itemlist']['lists'].'</span></br></li>';
                	
					}
					
					foreach($prnt_cat_data as $main_cat){
						echo '<li style="list-style:none;"><input type="checkbox" name="category_items[]" value="'.$main_cat['Category']['category_name'].'" style="margin:0px;"/><span style="margin-left:30px;">'.$main_cat['Category']['category_name'].'</span></br></li>';
                	}
					echo '<div class="appen_div" ></div>';
					?>
					
					</div></fieldset></form>
					<fieldset class="new-list">
						<i class="ic-plus"></i>
						<input type="text" name="list_name" id="new-create-list" maxlength="40" placeholder="Create New List">
						<button type="submit" id="list_createid" class="btn-create">Create</button>
					</fieldset>
				<!--/form-->
			</div>
		</div>
		<div class="btn-area">
				<button type="button" class="btn-add-to-list btn-done" id="btn-doneid" style="background:#5690BB;color:#FFFFFF;text-shadow:none;">Done</button>
				<!--button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button-->
				<a href="#" class="btn_set" style="float: right;display:none;"><span >Settings</span><div class="fancysettings"></div></a>
			
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
									<li><img src="##image_url##" class="photo"><span class="username">##username##</span></li>
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
</div>
<!-- /add_to_list overlay -->

		<!-- show profile -->
<div id="showprofile" data-role="popup" style="width:350px;" class="popup ly-title update add-to-list">
 <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div class="default">
		<p class="ltit">Add Your Fashion on this product</p>
		
	
  		
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image">
				<fieldset>
			
				<?php 
					echo '<table border=200>';
					echo "<img id='show_Userurl'  style='float: left;margin-left: 40px;margin-top: 20px;margin-bottom: 50px;width: 220px;height:220px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb350/usrimg.jpg'>";
					echo '</table>';
				?>
					</fieldset>
						</div>
			</div>
			<div class="section photo" style="margin-top:-30px;">
			<h3 class="stit"></h3>
			<fieldset class="frm">
			
				<?php 
				$itemidsed = $item_datas['Item']['id'];
				if(empty($usr_datas['User']['profile_image'])){
					$image_computer = '';
				}else{
					$image_computer = $usr_datas['User']['profile_image'];
				}
				if(session_id() == '') {
					session_start();
				}
				$site = $_SESSION['site_url'];
				$media = $_SESSION['media_url'];
				@$username = @$_SESSION['media_server_username'];
				@$password = @$_SESSION['media_server_password']; 
				@$hostname = $_SESSION['media_host_name'];
				//$site = "http://localhost:9002/fancy/";
				echo "<div class='input-group' style='margin-top:10px;margin-left:10px;display:inline;text-align: center;'>";
						 
						echo '<div class="venueimg" style="padding-left:-100px;height:35px;"><iframe class="image_iframe" id="frame"  style="padding-left:30px;" name="frame" src="'.$this->webroot.'userproduct.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="130px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 90px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
							if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left:180px; margin-top: -45px;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
						echo "</div>";
						
					?>
					</div>
					<hr size=2>
				<div id="loadingimgg" style="display:none;"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
				<div class="btn-area" style="float: right; margin-top: 10px; margin-right: 45px;">
				<button class="btn-save" id="save_profile_image" onclick="change(<?php echo $itemidsed; ?>)" >Save Fashion</button>
				<span class="checking" style="display:none" ><i class="ic-loading"></i></span>

				</fieldset>
				</div>
			

</form>
</div>
</div>
</div>
<!--  show profile -->
	
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

	$('#invoice-popup-overlay').on ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
	});
</script>
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>


<script>
var invajax=0;

</script>


