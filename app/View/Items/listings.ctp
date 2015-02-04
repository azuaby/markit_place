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

<body>

<div class="container wider" style="top: 0px;width:960px;">
		<div class="wrapper-content right-sidebar" style="background:none;margin-bottom: -5px;">
			<div id="content">
				<div class="figure-row first sepProduView" style="margin-left: -26px;">
					<div class="figure-product figure-640 big text-left">

				<figure>
					<span class="wrapper-fig-image" style="text-align: center; background: #FBFCFC; margin-bottom: 12px;">
						<img id="fullimgtag" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>">
					</span>  
					
					<div id="img_id<?php echo $item_datas['Item']['id']; ?>" style="display: none;">
						<img style="display: none;" alt="<?php echo $item_datas['Item']['item_title'];?>" title="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>">
					</div>  
						
					<!-- <div class="thing-section">
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
											<div class="videooverlaydiv"></div>
										<a  href="javascript:void(0);" onclick="showvideourll(\''.$videoID.'\');"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
										</li>';
											
									//}
								}
								
							?>
						</ul>           
					</div>    -->          
                    <figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption>
						    
                </figure>
               </a>
			<!-- <a title="<?php echo $item_datas['Item']['item_title']; ?>" href="#">
				<figure><span class="fig-image"><img id="fullimgtag" height="550" width="570" alt="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>"></span>
				<figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption></figure>
			</a> -->
			
			<br class="hidden">
						
						<p><?php echo __('by');?> <a class="username" href="<?php echo SITE_URL."people/".$item_datas['User']['username_url']; ?>"><?php echo $item_datas['User']['username']; ?></a> + <?php echo $item_datas['Item']['fav_count']; ?> <?php echo __('others');?>
						</p><br class="hidden">
						
			<?php
				//echo $item_datas['Itemfav'][0]['user_id'];die;
		
				foreach($item_datas['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				
//				if(isset($usecoun) &&  in_array($item_datas['Item']['id'],$usecoun)){
//				echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" ><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//				}else{
//				echo  '<a class="button fantacy" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" ><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$item_datas['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//				}	
				//echo"<pre>";print_r($setngs);
				
				if(isset($usecoun) &&  in_array($item_datas['Item']['id'],$usecoun)){
				echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
				echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                echo '<input type="hidden" value="'.$item_datas['Item']['id'].'" name="listing_id">';
                echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                echo '<button type="submit" class="button fantacyd edit" style="margin-left: -22px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
				echo  '<a class="button fantacyd edit" iteid="'.$item_datas['Item']['id'].'" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$item_datas['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
				}else{
				echo  '<a class="button fantacy" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
				echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                echo '<input type="hidden" value="'.$item_datas['Item']['id'].'" name="listing_id">';
                echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                echo '<button type="submit" class="button fantacyd edit" style="margin-left: -22px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
				echo  '<a class="button fantacy" onclick = "itemcou('.$item_datas['Item']['id'].');"  id="dd'.$item_datas['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$item_datas['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
				}
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'" />';
			//	echo "<pre>";echo ".$setngs[0]['Sitesetting']['liked_btn_cmnt']";die;
				?>		
			<?php 
						$itemcolor = $item_datas['Item']['item_color'];
						$itemidse = $item_datas['Item']['id'];
						$itemcolor = json_decode($itemcolor,true);
						?>
						<?php echo '<a href="javascript:void(0);"  onclick = "itemcou('.$itemidse.');" >';?><div class="shareebtn"><i class="prolisticon"></i><?php echo __('Add to list');?> </div></a>
							
						<a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="color"><div class="shareebtn"><i class="morecolorbuttonicon"></i><?php echo __('Similar colors');?></div></a>
						
						<?php echo '<a href="javascript:void(0);"  onclick = "share_post('.$itemidse.');"  >';?><div class="shareebtn" ><i class="proshareicon"></i><?php echo __('Share');?></div></a>
						<a href="#" onclick = "userpro(<?php echo $itemidse; ?>);"  class="color"><div class="shareebtn"><i class="glyphicons camera" style="margin-top: -6px; padding: 0px 5px 0px 0px;"></i> <?php echo __('Upload fashion');?> </div></a>
			</div>
					<!-- / figure-product figure-640 -->
					
					
					
					
					
					
					<?php //if(($item_datas['Item']['status'] != 'things')){ ?>
			<section class="comments comments-list comments-list-new commandseprate">
	            		<ol>
	            		<?php if (count($commentss_item) > 2) { ?>
	            		<div class='head' style="padding-bottom:5px;">
					<a  id="show_all" onclick="show_comment()" > View all <?php echo(count($commentss_item));?> <?php echo __('comments');?></a>
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
							$atuserPattern = '/<span[^<>]*?[^<>]*?>(.@?)<\/span>/';
							$hashPattern = '/<span[^<>]*?[^<>]*?>(.*#)<\/span>/';
							echo '</a></span>';
							echo '<span class="vcard cmntusername" style="position: relative;"><a href="'.SITE_URL.'people/'.$cmnt['User']['username_url'].'" class="url">';
							echo '<span class="fn nickname">'.$cmnt['User']['username'].'</span></a></span>';
							echo '<p class="c-text" id="txt1'.$cmnt['Comment']['id'].'" style="display:none;"><textarea id="txt1val'.$cmnt['Comment']['id'].'" maxlength="180" style="overflow: auto; resize: none; height: 50px; width: 540px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;"   onkeyup="ajaxuserautoc(this.value,\'txt1val'.$cmnt['Comment']['id'].'\',\'comment-autocomplete'.$cmnt['Comment']['id'].'\');">';
							//echo $cmnt['Comment']['comments'];
							$withoutAnchortag = preg_replace($pattern, '$1', $cmnt['Comment']['comments']);
							$withoutAtuserspan = preg_replace($atuserPattern, '$1', $withoutAnchortag);
							$withoutHashspan = preg_replace($hashPattern, '$1', $withoutAtuserspan);
							echo $withoutHashspan;
							
							echo '</textarea> <button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('.$cmnt['Comment']['id'].')" >'?><?php echo __('Save comment');echo '</button></p>';
							echo '<div class="comment-autocomplete comment-autocomplete'.$cmnt['Comment']['id'].'" style="display: none;left:43px;width:548px;">';
							echo '<ul class="usersearch">';
								
							echo '</ul>';
							echo '</div>';
							echo '<p id="oritext'.$cmnt['Comment']['id'].'" style="margin-top:-10px;">'.$cmnt['Comment']['comments'].'</p>';
							echo '<div id="oritextvalafedit'.$cmnt['Comment']['id'].'"></div>';
							echo '<p class="c-reply" >';
							
								if($cmnt['Comment']['user_id']==$userid){
									echo '<button class="edit-comment" onclick = "return editcmnt('.$cmnt['Comment']['id'].')" >'?><?php echo __('Edit');echo '</button><span class="bar"></span>';
									echo '<button class="delete-comment" onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >'?><?php echo __('Delete');echo '</button>';
								}
							echo '</p>';
							
	                    
						echo '</li>';
						
							
					}
					
					?>
					</div>
					
					
					<div id="sa"></div>
				</ol>
					<label class="hidden"><?php echo __('Comment');?>:</label>
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
					
					
					echo '<textarea id="comment_msg" maxlength="180" cols="50" rows="1" class=""   onkeyup="ajaxuserautoc(this.value, \'comment_msg\',\'comment-autocompleteN\');"  autocomplete="off" placeholder="Write a comment..."  i_id="'.$item_datas['Item']['id'].'" style="margin-left: 10px; overflow: auto; resize: none; height: 50px; width: 536px; padding: 5px 0px 0px 10px; border: 1px solid #DCDCDC;"></textarea>';
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
					<div class="btns-post">
						<small><?php echo __('Use @ to mention someone');?></small>
						<span class="button-wrapper" >
						<button type="submit" class="btn-blue-post"  onclick ="return cmntsubmit('<?php echo $roundProfileFlag; ?> ');" id="commentssave"><?php echo __('Post comment');?></button>
						<div class="post-loading"><img src="<?php echo SITE_URL; ?>images/loading.gif"></div>
						</span>
					</div>
  					<?php endif; ?> 
					</section>
					<?php //} ?>
				</div>
				<!-- / figure-row -->
				<?php /* 
					<div class="figure-row sepProduView" >
				
					<div class='item'>
					<?php
					if(!empty($FashionuserDet)){
						foreach($FashionuserDet as $key => $Fasdet){
							$img_name = $Fasdet['Fashionuser']['userimage']; 
							$id=$Fasdet['Fashionuser']['id'];
		                  	$usernamUrl=$Fasdet['User']['username_url'];
		                  	$usernam=$Fasdet['User']['username'];
		                	//echo SITE_URL.'listing/'.$id.'/'.$title;						
							//echo "<a href='".SITE_URL."people/".$usernamUrl."' >";
							echo "<a href='javascript:void(0);' title='$usernam'>";
					  		echo '<img class="fullimgtag" height="70" width="70" style="padding-left:10px;"  src="'.$_SESSION['media_url'].'media/avatars/thumb150/'.$img_name.'" >';	
							echo"</a>";				
						}		
					}else{
						echo "Be the first person to add fashion";
					}
					?>
					</div>			
				</div>
				 */ ?>
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
					
			<div id="links"></div>	
			
			<?php if (!empty($moreFromCategory)){ ?>
			<div class="morefromcategory" >
			
				<div class="heading"><span style="margin-left: 10px; font-weight: bold;"><?php echo __('Other things you might');?> <?php echo $setngs[0]['Sitesetting']['like_btn_cmnt']; ?></span></div>
				
				<div class="morefromcategorycontent">
					<ol class="stream">
	                    <?php 
	                    //echo '<pre>';print_r($moreFromCategory);
	                    foreach ($moreFromCategory as $itms) { 
	                    	$itm_id = $itms['Item']['id'];
							$item_title_url = $itms['Item']['item_title_url'];
							$item_title = $itms['Item']['item_title'];
							$image_name = $itms['Photo'][0]['image_name'];
							$price = $itms['Item']['price'];
							$user_id = $itms['Item']['user_id'];
							$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
							
							$item_title = UrlfriendlyComponent::limit_char($item_title,12);
					
							if(isset($itms['Photo'][0])){
								$image_name = $itms['Photo'][0]['image_name'];
							}
							$username_url = $itms['User']['profile_image'];
							if($username_url == ''){
								$username_url = 'usrimg.jpg';
							}
							$username = $itms['User']['username'];
							
							$username_url_ori = $itms['User']['username_url'];
							$favorte_count = $itms['Item']['fav_count'];
	                    
							echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'">';
							
							echo  '<div class="figure-product-new mini">';
							echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
							//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
							echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='display:none;' >";
							echo "<figure>";
							echo '<span class="back"></span>';
							$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
							echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
							//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
							echo "</figure>";
							echo  '</a>';
							
							echo  '<em class="figure-detail">';
							echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
							<img style='width: 35px; height: 35px; position: relative; top: 10px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
							<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 28px; left: 42px;'>$username + $favorte_count</i>
							</a>";
							echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="position: relative; top: 10px; left: 7px;" >'.$item_title.'</span>';
							echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="position: relative; top: 10px; left: 7px;"><b> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
							//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
							echo  '</em>';
							
							echo '<ul class="function">';
							echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
							echo '</ul>';
							
							foreach($itms['Itemfav'] as $useritemfav){
								if($useritemfav['user_id'] == $userid ){
									$usecoun[] = $useritemfav['item_id'];
								}
							}
							//echo "usecoun :<pre>";print_r($usecoun);
//							if(isset($usecoun) &&  in_array($itm_id,$usecoun)){
//							echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//							}else{
//							echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//							}
							
                            if(isset($usecoun) &&  in_array($itm_id,$usecoun)){
		                    echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
                            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
                            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -22px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
		                    echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
		                    }else{
		                    echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
                            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
                            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
                            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
		                    echo  '<a class="button fantacy" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
		                    }
							
							echo  '</div>';
							echo  '</li>';
					 	}?>
					</ol>
				</div>
			</div>
			<?php } ?>
			
			<div id="recent" style="height: auto; margin-bottom: 60px;" class="wrapper-content right-sidebar">
		
		
				<div class="heading"><span style="margin-left: 10px; font-weight: bold;"><?php echo __('Recently');?> <?php echo $setngs[0]['Sitesetting']['liked_btn_cmnt']; ?> <?php echo __('By');?></span></div>
						
			<?php //if(($item_datas['Item']['status'] != 'things')){ ?>
		
			<div class="find-people">
				<div class="select-list">
		<ul class="stream">
			
			 	<?php 
			 	
			 	//echo "<pre>";print_r($people_details);die;
			 	
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
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 5px; position: absolute;'>$user_first</strong></a>";
					}else{
						echo "<a href='".SITE_URL."people/".$user_nam_url."' style='float:none;' class='url'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' class='photo' style='height: 40px; width: 40px; padding: 7px;".$roundProf."' /><strong class='nickname' style='top: 5px; position: absolute;'>$user_first</strong></a>";
					}
				echo '<span class="usernameMention" style="left: 0px; bottom: 17px;">@'. $user_nam_url .'</span>';
					 
				
				
				foreach($followcnt as $flcnt){
					$flwrcntid[] = $flcnt['Follower']['user_id'];
				}
				if($userid != $ppls['User']['id']){						
					if(isset($flwrcntid) && in_array($ppls['User']['id'],$flwrcntid)){
						$flw = false;
					}else{
						$flw = true;
					}
						
					
					if($flw){
					echo "<span class='follow' id='mainfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" >'?><?php echo __('Follow'); echo '</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='mainunfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" >'?><?php echo __('Following'); echo '</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="mainchangebtn'.$ppls['User']['id'].'" ></span>';
				} 
					 
				
				echo '</div>';
				echo '<div class="things">';
				
				if(!empty($allitemdatta)){
					$useruid = $ppls['User']['id'];
					//echo "<pre>";print_r($allitemdatta[$ppls['User']['id']]);die;
					foreach($allitemdatta[$useruid] as $key=>$img_dtel){
						$itemid = $img_dtel['Itemidd'];
						$itemnnamee = $img_dtel['item_title'];
						$itemnnameeUrl = $img_dtel['item_title_url'];
						$imggNamee = $img_dtel['image_name'];
						echo "<a href='".SITE_URL."listing/".$itemid."/".$itemnnameeUrl."' >";
							//echo "<img src='".$_SESSION['media_url']."media/items/thumb150/".$imggNamee."' style='max-width:150px;max-height:150px' title='".$itemnnamee."'/> &nbsp";
						echo "<div style='background:url(\"".$_SESSION['media_url']."media/items/thumb150/".$imggNamee."\") no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);width:70px;height:70px;'></div>";
						echo "</a>";
					}
					
					
					}else{
						echo '<div style="height:200px">';
						echo '<center style="font-size:14px;">'?><?php echo __('No Items Found');echo '</center> ';
						echo '</div>';
					}
					
					echo '</div>';
					echo '</li>';
						}
				
				}else{
					echo '<div style="height:200px">';
					echo '<center style="font-size:14px;margin-top:100px;">' ?> <?php echo __('Be the first one to like this..'); '</center>';
					echo '</div>';
				}
				?>
			
				</ul>
				</div></div>
				<?php //} ?>	
			</div>
			
	</div>
<!-- / content -->

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
						<li>
							<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>"  ><button class="buyitbttn" value=""><i class="ic-cart"></i>Buy It</button></a>
								<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
						</li>						
						<li>
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
						<?php 
						if(!empty($item_datas["User"]["profile_image"])){
							echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 2px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
						}else{
							echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 2px;' /></a>";
						
						}
						
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
										echo '<button type="button" id="follow_btn'.$item_datas['User']['id'].'" class="btnblu" onclick="getfollows('.$item_datas['User']['id'].')">';
										echo '<span class="foll'.$item_datas['User']['id'].'" >' ?> <?php echo __('Follow'); echo '</span>';
										echo '</button>';
										echo "</span>";
							
									}
								}else{
									echo "<span class='follow' id='unfoll".$item_datas['User']['id']."'>";
									echo '<button type="button" id="unfollow_btn'.$item_datas['User']['id'].'" class="greebtn" onclick="deletefollows('.$item_datas['User']['id'].')">';
									echo '<span class="unfoll'.$item_datas['User']['id'].'" >' ?> <?php echo __('Following');echo '</span>';
									echo '</button>';
									echo "</span>";
								}
								echo '<span id="changebtn'.$item_datas['User']['id'].'" ></span>';
							
							}
							
						}	
						
					//echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				?>
				<a href = "<?php echo SITE_URL.'people/'.$item_datas["User"]["username_url"]; ?>" class = 'username' title = '<?php echo $item_datas["User"]["username"]; ?>'>
				<?php echo $item_datas["User"]["username"];?><br clear='all'/><span class="usernameMention"><?php echo "@".$item_datas["User"]["username_url"] ?></span>
				</a>
						
						
						<?php if ($item_datas['Item']['price'] != 0 &&$item_datas['Item']['price'] != '') { 
							$convertPrice = round($item_datas['Item']['price'] * $_SESSION['currency_value'], 2);
						?>
							<p class="prices" style="font-size:12px;">
							<strong class="price"><?php echo $_SESSION['currency_symbol'].$convertPrice; ?></strong> <?php echo $_SESSION['currency_code']; ?><br>
							<input type="hidden" id="price" value="<?php echo $item_datas['Item']['price']; ?>">	
							</p>
							<?php } ?>
							<?php if(($item_datas['Item']['status'] == 'things')){ ?>
								<h1 style="border: medium none; margin: 8px 0px 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
									
									<div class="thing-description" >
										
										<p style="font-size: 15px; padding: 0px 0px 20px;">  <?php 
												echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
												//echo str_word_count($item_datas['Item']['item_description'], 0);
												//if(strlen($item_datas['Item']['item_description']) > 15){
												if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
													echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">'?><?php echo __('more');echo '</a>';
												}
											  ?></p>
										
									</div>
									<ul class="thing-info">	
									<li>
										<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>" target="_blank" ><button class="buyitbttn" value=""><?php echo __('Buy It');?></button></a>
											<?php //echo '<img src="'.SITE_URL.'images/info.png"> <a href="'.$item_datas['Item']['bm_redircturl'].'"  >Buy it</a>'; ?>
									</li>				
								</ul>
				
							</div>
							<div class="figure-row first sepProduView " style="padding:0px;">
			                    <h1 style="margin: 0px; padding: 10px; background: #F6F7F8;border-radius: 4px 4px 0 0" ><?php echo ('Actions');?></h1>
			
								<?php 
										$wanticon = 'pushpin'; $wanttext = 'I want it';
										$ownicon = 'lock'; $owntext = 'I own it';
										if ($wantIt == 1){
											$wanticon = 'circle_ok'; $wanttext = 'You want it';
										}
										if ($ownIt == 1){
											$ownicon = 'circle_ok'; $owntext = 'You own it';
										}
							?>
								<ul class="thing-info" style="padding: 0px 10px 10px;">		
									<li>
										<a href="<?php echo  $item_datas['Item']['bm_redircturl']; ?>" class="moreinfo" target="_blank"><i class="glyphicons circle_info"></i><?php echo __('More info');?></a>
									</li>						
									<li>
										<a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="simlarclr" ><i class="glyphicons tint"></i><?php  echo __('Similar Color');?></a>
									</li>		
									<li>
										<a href="javascript:void(0);" class="wantit" onclick="wantit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $wanticon; ?>"></i><?php echo $wanttext; ?></a>
										<div class="wantitload" style="display:none; float: right; width: 190px;">
											<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
										</div>
									</li>						
									<li>
										<a href="javascript:void(0);" class="ownit" onclick="ownit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $ownicon; ?>"></i><?php echo $owntext; ?></a>
										<div class="ownitload" style="display:none; float: right; width: 190px;">
											<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
										</div>
									</li>						
									<li>
										<a href="<?php echo  SITE_URL.'create/item/'.$item_datas['Item']['id']; ?>"  ><i class="glyphicons tags"></i><?php echo __('Sell It');?></a>
											<?php //echo '<img src="'.SITE_URL.'images/sellitem.png"> <a href="'.SITE_URL.'sellersignup/'.$item_datas['Item']['id'].'"  >Sell it</a>'; ?>
									</li>				
								</ul>
							
							</div>
								<?php }else{ ?>
							
							<div class="option-area">
								
								<label for="quantity" style="display: inline-block; font-size: 14px;"><?php echo __('Quantity:');?> </label>
								<span class="input-number" style="display: inline-block; position: relative;color:#717171;">
									 <?php if($item_datas['Item']['quantity']<=0){
									 			echo __('Sold Out');
									 		}else{
									 			echo __('Only') ." ". $item_datas['Item']['quantity']." ". __('available');
									 		}
									  ?>
									
									
								</span>
								<?php 
								$process_time = $item_datas['Item']['processing_time'];
									if($process_time == '1d'){
										$process_time = __('One business day');
									}elseif($process_time == '2d'){
										$process_time = __('Two business days');
									}elseif($process_time == '3d'){
										$process_time = __('Three business days');
									}elseif($process_time == '4d'){
										$process_time = __('Four business days');
									}elseif($process_time == '2ww'){
										$process_time = __('One-Two weeks');
									}elseif($process_time == '3w'){
										$process_time = __('Two-Three weeks');
									}elseif($process_time == '4w'){
										$process_time = __('Three-Four weeks');
									}elseif($process_time == '6w'){
										$process_time = __('Four-Six weeks');
									}elseif($process_time == '8w'){
										$process_time = __('Six-Eight weeks');
									}
								?>
								<br clear="all" />
								<div class="shippingTime">
									<img src="<?php echo SITE_URL; ?>images/shippingicon.gif" alt="Shipping: " />
									<span class="shipperiod"><?php echo $process_time; ?></span>
								</div>
							</div>
							
							<?php
								$optionsval = explode(',',$item_datas['Item']['size_options']);
								
								$shpng_datas = $item_datas['Shiping'];
								$usr_data = $usershipping['User']['countrycode'];
                                $count_c = 0;

								foreach($shpng_datas as $shpng_data){
								    if($shpng_data['country_id'] == $usr_data || $shpng_data['country_id'] == "0"){
								        $count_c++;
								    }
								}
								
								if($item_datas['Shop']['user_id'] != $userid && $item_datas['Item']['quantity'] > 0 && $count_c !== 0){
									echo '<div class="formcartlistiongs">';
									echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcarts();'));
							?>
								<input type="hidden" value="<?php echo $cntry_code; ?>" name="shipping_method_id">
								<input type="hidden" value="<?php echo $item_datas['Item']['id']; ?>" name="listing_id">
								<input type="hidden" value="<?php echo $item_datas['User']['id']; ?>" name="itemuserid" id="itemuserid">
								
								<?php
									if(!empty($item_datas['Item']['size_options'])){
								?>
								<input type="hidden" value="1" name="sizeset" id="sizeset">
								<div class="qtysizdiv">
								<div class="selsizediv">
								
								<span class="Quantity"><?php echo __('Select Size');?></span><br clear="all" />
								<div class="selectdiv" style="width: 150px !important;float:left;" >
								    <select class="selectboxdiv" style="width: 150px !important; margin: 0px 0px 10px;" name='size_opt' id="size_opt" onchange="itemlistingloadqty('<?php echo $item_datas['Item']['id']; ?>')">
								        <option value=""><?php echo __('Select Size');?></option>
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
									<div class="out" style="width: 188px !important;" ><?php echo __('Select Size');?></div>
								</div>
								
								<div class="sizeqtyloader">
									<img src="<?php echo SITE_URL; ?>images/loading.gif" />
								</div>
								</div>
								
								<div class="selqtydiv sizeqtydiv" style="width:135px;overflow:hidden;text-overflow:ellipsis">
								<span class="Quantity"><?php echo __('Select Quantity');?></span><br clear="all" />
								
								<div class="selectdiv" style="width: 133px !important;" >
								    <select class="selectboxdiv" style="width: 133px !important;  margin-right: 2px ! important;" name='quantity' id="qty_opts">
								        <?php
											$qty = $item_datas['Item']['quantity'];
										for($i = 1; $i <= $qty; $i++ ){
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
								    </select>
								    <div class="out" style="width: 133px !important;" >1</div>
								</div>
								</div>
								
								</div>
								<?php
									}else{ ?>
								
								<input type="hidden" value="0" name="sizeset" id="sizeset">
								<span class="Quantity"><?php echo __('Select Quantity');?></span><br clear="all" />
								
								<div class="selectdiv" style="width: 293px !important;" >
								    <select class="selectboxdiv" style="width: 293px !important; margin: 0px 0px 10px;" name='quantity' id="qty_opts">
								        <option value=""><?php echo __('Select Quantity');?></option>
										<?php
											$qty = $item_datas['Item']['quantity'];
										for($i = 1; $i <= $qty; $i++ ){
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
								    </select>
								    <div class="out" style="width: 293px !important;" ><?php echo __('Select Quantity');?></div>
								</div>
									<?php
											
									}
								
									//print_r(explode(',',$item_datas['Item']['size_options']));die;
									if(empty($item_datas['Item']['start'])){
									if(($item_datas['Item']['quantity'] > 0) && ($item_datas['Item']['status']=='publish')){ ?>
											<div id="ggift"> <?php echo __('Create Group Gift');?></div>
											<div class="giftorbuy">-<?php echo __('OR');?>-</div>
										<button type="submit" class="greencart add_to_cart" value="Add to Cart"><?php echo __('Add to Cart');?></button>
									<div class="addcarterror"></div>
									
									<?php	}  ?>
					<!-- <button class="greencart add_to_cart soldout hidden"><i class="ic-cart"></i><strong>Sold Out</strong></button> -->
				
								</form>
						</div>
							
						<?php }  } ?>
						
						
					</div>
					
				
				
				
					<div class="figure-row first sepProduView ">
	                    <h1 style="margin: 0px;" ><?php echo $item_datas['Item']['item_title']; ?></h1>
	
						<div class="thing-description" >
							
							<p style="font-size:15px;">  <?php 
									echo $item_datas['Item']['item_description'];
									///echo UrlfriendlyComponent::limit_text($item_datas['Item']['item_description'],15);
									//echo str_word_count($item_datas['Item']['item_description'], 0);
									//if(strlen($item_datas['Item']['item_description']) > 15){
									/* if (str_word_count($item_datas['Item']['item_description'], 0) > 15) {
										echo '<a href="#" onclick="showdescription(\''.$item_datas['Item']['id'].'\')">more</a>';
									} */
								  ?></p>
						</div>
						<?php if (strlen($item_datas['Item']['item_description']) > 135) { ?>
							<div class="more-enable">
								<a href="javascript:void(0);" id="full-description"><?php echo __('more');?></a>
							</div>
							<?php } ?>
						<!-- <div class="productimginfo">
							<div class="description">
								<div class="less">
									<p><?php echo $item_datas['Item']['item_description'];?></p>
								</div>
								<a href="#" class="more" onclick="$('div.description > div').removeClass('less');$(this).hide().next().show();return false">(More)</a>
								<a href="#" class="less" style="display:none" onclick="$('div.description > div').addClass('less');$(this).hide().prev().show();return false">(Less)</a>
							</div>
						</div> -->
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
									<div class="videooverlaydiv" onclick="showvideourll(\''.$videoID.'\');"></div>
									<a  href="javascript:void(0);" onclick="showvideourll(\''.$videoID.'\');"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
									</li>';
										
								//}
							}
							
						?>
					</ul>
				
				</div>
				<div class="figure-row first sepProduView " style="padding:0px;">
	                    <h1 style="margin: 0px; padding: 10px; background: #F6F7F8;border-radius: 4px 4px 0 0" ><?php echo __('Actions');?></h1>
	
						<?php 
								$wanticon = 'pushpin'; $wanttext =  __('I want it');
								$ownicon = 'lock'; $owntext = __('I own it');
								if ($wantIt == 1){
									$wanticon = 'circle_ok'; $wanttext = __('You want it');
								}
								if ($ownIt == 1){
									$ownicon = 'circle_ok'; $owntext = __('You own it');
								}
					?>
						<ul class="thing-info" style="padding: 0px 10px 10px;">			
							<li>
								<a href="javascript:void(0);" class="wantit" onclick="wantit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $wanticon; ?>"></i><?php echo $wanttext; ?></a>
								<div class="wantitload" style="display:none; float: right; width: 190px;">
									<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
								</div>
							</li>						
							<li>
								<a href="javascript:void(0);" class="ownit" onclick="ownit('<?php echo $item_datas['Item']['id']; ?>')" ><i class="glyphicons <?php echo $ownicon; ?>"></i><?php echo $owntext; ?></a>
								<div class="ownitload" style="display:none; float: right; width: 190px;">
									<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." style="vertical-align: middle; width: 14px;"/>
								</div>
							</li>	
							<li>
								<a href="<?php echo SITE_URL.'color/'.ucwords(strtolower($itemcolor[0])); ?>" class="simlarclr" ><i class="glyphicons tint"></i><?php echo __('Similar Color');?></a>
							</li>	
							<?php if ($item_datas['User']['id'] != $userid){ ?>					
							<li class="contactsellerli">
								<?php if (empty($contactsellerModel)){ ?>
								<a href="javascript:void(0);" onclick="showcontactform();"><i class="glyphicons comments"></i><?php echo __('Contact Seller');?></a>
								<?php }else{ ?>
								<a href="<?php echo SITE_URL.'viewmessage/'.$contactsellerModel['Contactseller']['id'];?>"><i class="glyphicons comments"></i><?php echo __('Contact Seller');?></a>
								<?php } ?>
							</li>
							<?php } ?>				
						</ul>
					
					</div>
			<?php } ?>
							
			
			
			
			<div class="figure-row first sepProduView contributions" style="padding:0px;">
				<h1 class="stiteg"><?php echo __('Users who own this');?> <!-- a href='javascript:void(0);' id='slideshowUserview' title='Slideshow'><i class="glyphicons show_big_thumbnails" style="padding: 0px; float: right;"></i></a--></h1>
						
				<div style="padding: 6px 4px; margin: 0 6px;">
					<div class='item' style="margin: 0px;">
					<?php
										
					if(!empty($FashionuserDet)){
						foreach($FashionuserDet as $key => $Fasdet){
							$img_name = $Fasdet['Fashionuser']['userimage']; 
							$id=$Fasdet['Fashionuser']['id'];
		                  	$usernamUrl=$Fasdet['User']['username_url'];
		                  	$usernam=$Fasdet['User']['username'];
							
		                  	$img = $_SESSION['media_url']."media/avatars/thumb150/".$img_name;
		                  	$img_ori = $_SESSION['media_url']."media/avatars/original/".$img_name;
		                  	
		                  	//echo '<div style="background:url(\''.$_SESSION['media_url'].'media/avatars/thumb150/'.$img_name.'\') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);width:65px;height:65px;"> </div>';
		                  	
		                  	echo '<a onclick="show_fashion_image()" data-lightbox="roadtrip">';
		                  	echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width:65px;height:65px;margin: 2px 3px 5px 0;"></span>';
		                  	echo '</a>';
						}
					}else{
						echo __('Be the first person to add fashion photo');
						?>
						
				<?php 	} ?>
	
				<a href="#" onclick = "userpro(<?php echo $itemidse; ?>);" style="display: inline-block; width: 280px; text-align: center;" ><i class="glyphicons camera" style="margin-top: -6px; padding: 0px 5px 0px 0px;"></i><?php echo __('Upload fashion');?></a>
				
					</div>	
				</div>
				
				<div class="notify"  style="display: inline-block; padding: 2px; margin: 0 6px;">
						<?php echo __('You can upload your photos taken when using this product. It will be approved by the seller to make it public');?>.
				</div>
				
			</div>			
					
					
					
					
					
						
						
						
						
																	
			<div id="morefrom" class="wrapper-content right-sidebar">
				<div class='name'>
				<?php
				if(!empty($item_datas["User"]["profile_image"])){
					echo " <a href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'    class='vcard'><img style='margin-right: 10px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$item_all[0]["User"]["profile_image"]."' /></a>";
				}else{
					echo " <a class='imagebor' href='".SITE_URL."people/".$item_datas["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 10px;' /></a>";
				
				}
				
				echo "<div class='more_from'>"?><?php echo __('More from'); echo "<br clear='all'/>";
				echo $this->Html->link($item_datas["User"]["username"],array('controller'=>'/','action'=>'/people/'.$item_datas["User"]["username_url"]), array('class' => 'username','title' => $item_datas["User"]["username"]));
				//echo '<span class="usernameMention" style="right: 97px; bottom: -17px;">@'.$item_datas["User"]["username_url"].'</span>';
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
				   //echo '<img class="fullimgtag" alt="'.$itm['Item']['item_title'].'"  title="'.$itm['Item']['item_title'].'" height="70" width="70" style="padding-left:10px;"  src="'.$_SESSION['media_url'].'media/items/thumb70/'.$itm_name.'" >';	
					echo '<div style="background:url(\''.$_SESSION['media_url'].'media/items/thumb150/'.$itm_name.'\') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);width:70px;height:70px;"> </div>';
				   echo"</a>";				
								}		
								}
								
								
								//echo "<pre>";print_r($people_details);die;
								?>
					</div>
			</div>
			
			<?php if ($loguser[0]['User']['id'] != $item_datas['User']['id']){ ?>
				<div class="reportitem">
				<?php 
				$reportedUsers = json_decode($item_datas['Item']['report_flag'], true);
				if (in_array($loguser[0]['User']['id'], $reportedUsers)){ ?>
					<p id="unreportflag">
						<?php echo __('Undo reporting');?>
						<img class='reportloader' src='<?php echo SITE_URL?>images/loading.gif' alt='loading...' />
					</p>
				<?php }else{ ?>
					<p id="reportflag">
						<?php echo __('Report inappropriate');?>
						<img class='reportloader' src='<?php echo SITE_URL?>images/loading.gif' alt='loading...' />
					</p>
				<?php } ?>
				</div>
			<?php } 
			if($managemoduleModel['Managemodule']['display_banner']=="yes")
			{			
				if($banner_datas['Banner']['status']=='Active')
				{
					echo '<div style="left:-24px;position:relative;">';
					echo $banner_datas['Banner']['html_source'];
					echo '</div>';
				}
			}
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



<!------ Upload Fashion image --------->

<div id="upload_fashion_image" style="display:none;" class="popup ly-title update add-to-list">
	<div class="default">
		<p class="ltit"><?php echo __('User Fashion');?></p>
		<button type="button" class="ly-close" id="btn-browses"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<div class="fancyd-item">
			<div class="image-wrapper" style="margin-top:30px;">
				<div class="item-image"><center><img src="<?php echo $img_ori; ?>" style="width:220px;height:220px;"></center></div>
			</div>
		</div>
	</div>
</div>
<!------ Upload Fashion image --------->


<!-- add_to_list overlay -->
<div id="add-to-list-new"  style="display:none;" class="popup ly-title update add-to-list">
	<div class="default">
		<p class="ltit"><?php echo __('Add to List');?></p>
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
						<button type="submit" id="list_createid" class="btn-create"><?php echo __('Create');?></button>
					</fieldset>
				<!--/form-->
			</div>
		</div>
		<div class="btn-area">
				<button type="button" class="btn-add-to-list btn-done" id="btn-doneid"><?php echo __('Done');?></button>
				<!--button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button-->
				<a href="#" class="btn_set" style="float: right;"><span ><?php echo __('Settings');?></span><div class="fancysettings"></div></a>
				<div class="set-dropdown">
					<ul>
						<li><a href="#" class="btn-unfancy"><?php echo __('unfantacy');?></a></li>
					</ul>
					
				</div>
			</div><br />
			<input type="hidden" id="passedFromItemId" value="" />
	</div>
	<div class="create-list" style="display:none">
		<p class="ltit"><?php echo __('Create New List');?></p>
		<button class="close cancel" title="Close" ><i class="ic-del-black"></i></button>
		<form loid="">
		<fieldset>
			<div class="frm">
				<p><b class="stit"><?php echo __('Title');?></b> <input type="text" name="list_name" class="right" placeholder="Enter a title"></p>
				
			</div>
			<div class="frm">
				<p>
					<b class="stit"><?php echo __('Category');?></b>
					<select name="category_id" id="categories-for-new-list" class="right">
						<option value="0"><?php echo __('Select category');?></option>
					</select>
				</p>
			</div>
			
			<div class="frm">
				<b class="stit"><?php echo __('Contributors');?></b>
				<div class="right">
					<p>
						<input type="text" id="create-list-find-user" placeholder="Username or email address">
						<button class="btn-invite"><?php echo ('Invite');?></button>
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
							<span class="right"><?php echo __('Creator');?></span>
						</li>
						<script type="fancy/template" id="tpl-invite-user-list">
							<li data-id="##id##"><img src="##image_url##"><span class="left"><b>##fullname##</b>##username##</span><span class="right"><a href="#"><i class="ic-del"></i><span class="hidden">Delete</span></a></span></li>
						</script>
					</ul>
				</div>
			</div>
		</fieldset>
		<div class="btn-area">
			<button type="submit" class="btn-create"><?php echo __('Create list');?></button>
			<button type="button" class="cancel"><?php echo __('Cancel');?></button>
		</div>
		</form>
	</div>
</div>
<!-- /add_to_list overlay -->


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
													echo '<div class="image-title"><a href="'.SITE_URL.$usernameUURL.'">'.$username.'</a></div>';
													//echo '<div class="image-desc"><span class="username"><em><i>  by &nbsp;&nbsp;  </i><a href="'.SITE_URL.$username.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span></div>';
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
<div id="share-social" class="popup ly-title share-new"  style="margin-left: 414px; display: none; margin-top: 100px; opacity: 1;">
	 
	<p class="ltit">
		<span class="share-thing"><?php echo __('Share This Thing');?></span>
	</p>
	<div class="fig">
		<span class="thum"  style="width:100px;height:100px" ><img id="thum_img" src=""></span>
		<div class="fig-info">
			<span class="figcaption" id="figcaption_title_popup" > </span>
			<span class="username" ><b><?php echo $_SESSION['currency_symbol']; ?><span id="username_popup" ></span></b>, By  <span id="usernames_popup" ></span> + <span id="fav_countsvv" ></span>&nbsp; Others</span>
			<h4>dsasas</h4><p class="from">qq</p>
		</div>
	</div>
	<div class="share-via">
		<ul class="less">
			<li><a style="float: left;margin-left: 5px;" class='facebook' href='' alt='Share this on facebook'  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a style="float: left;margin-left: 5px;" class='google'  href="" alt="Share this on Google plus" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  			<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"   onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 			<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 			<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
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
    <h2 class="tit"><?php echo __('Create a Group Gift');?></h2>
    <ol class="step step1">
	<li class="fst"><?php echo __('Choose Recipient');?> <span></span></li>
	<li class="scd"><?php echo __('Personalize');?> <span></span></li>
	<li class="trd"><?php echo __('Ask for Contributions');?></li>
    </ol>
   
    <div class="chept recipient">
	<ul class="tab">
	    <li><a href="#" class="current add"><?php echo __('Enter manually');?></a></li>
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
			<label class="label"><?php echo __('Recipient');?></label>
			<input type="text" class="text search-fancy-users" name="recipient" id="recipient" placeholder="Enter a username or an email address" />
		    <br /><span id='recipient_name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Recipient Name');?> </span>
		    </p>
		    
		    <ul class="user-list">
		    </ul>
		    <p>
			<label class="label"><?php echo __('Full Name');?></label>
			<input type="text" name="name" id="name" class="text"/>
			<br /><span id='name_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Full Name');?> </span>
		    </p>
		    
		    <p>
			<label class="label"><?php echo __('Address');?></label>
			<input type="text" class="text add1" name="address1" id="address1" placeholder="Address Line 1" />
			<br /><span id='address1_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Address1');?> </span>
		     </p> 
		     
			 <p>
			<label class="label"><?php echo __('Address2');?></label>
			<input type="text" class="text add2" name="address2" id="address2" placeholder="Address Line 2" />
		    <br /><span id='address2_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Address2');?> </span>
		    </p>
		    
		    <p>
			<label class="label"><?php echo __('Country');?></label>
			<select  name="countrygg" id="countrygg" style="width:260px;" >
				<option value=""><?php echo __('Select Country');?></option>
				<?php
				if (in_array(0, $possibleCountry)){
					foreach ($contry_datas as $country) {	?>
						<option value="<?php echo $country['Country']['id'];?>"><?php echo $country['Country']['country']; ?></option>
				<?php }
				}else{
					foreach ($contry_datas as $country) {	
						if (in_array($country['Country']['id'], $possibleCountry)) { ?>
						<option value="<?php echo $country['Country']['id'];?>"><?php echo $country['Country']['country']; ?></option>
				<?php } }
				} ?>
			</select>
			<br /><span class='text' style='color:#FF0000;margin-left:135px;font-size:12px;'><?php echo __('Product can be shipped only to the listed countries');?>.</span>
		    <br /><span id='country_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Select The Country');?> </span>
		    </p>
		    
		    <p class="state">
				<label class="label"><?php echo __('State');?></label>
				<input type="text" class="text add2" name="stategg" id="stategg" placeholder="State" />
			 	<br /><span id='state_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the State');?> </span>
		    </p>
		     
		    <p>
				<label class="label"><?php echo __('City');?></label>
				<input type="text" class="text city" name="citygg" id="citygg" placeholder="e.g. New York" />
				<br /><span id='city_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the City');?> </span>
		     </p>
			
			<p>
			<label class="label"><?php echo __('Zipcode');?></label>
			<input type="text" class="text zip" name="zipcodegg" id="zipcodegg" placeholder="ZIP Code" maxlength="6"/>
		    <br /><span id='zipcode_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Zipcode');?> </span>
		    </p>		
		    
		    <p>
			<label class="label"><?php echo __('Telephone');?></label>
			<input type="text" class="text" name="telephonegg" id="telephonegg" placeholder="10 digits, no dashes"  maxlength="11"/>
		    <br /><span id='telephone_err' class='text' style='display:none;color:#FF0000;margin-left:135px;font-size:12px;'> <?php echo __('Enter the Telephone number');?> </span>
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
		    <span class="help">
		    <span class="glyphicons circle_question_mark" style="padding:0;height:20px;margin-top: -16px;"></span> 
		    <a href="<?php echo SITE_URL.'groupgifts'; ?>"><?php echo __('How it works');?></a></span>
		    <button type="button" class="btns-white btn-cancel" id="gglistcancel"><?php echo __('Cancel');?></button>
		    <button type="submit" class="btns-blue-embo btn-continue"><?php echo __('Continue');?></button>
		</div>
	    </form>
	</div>
    </div>
    <div class="chept personalize" style="display:none;">

	<h3><?php echo __('Fill in details for group gift');?></h3>
	<div class="gifts-thing">
	    <figure><img id="listingitemids" src="" /></figure>
	    <figcaption></figcaption>
	    <p class="description"></p>
	    <div class="price">
		<span class="goal" onmouseover="$(this).parents('.price').find('.total').show();" onmouseout="$(this).parents('.price').find('.total').hide();"><?php echo __('Goal Total');?></span>
		<b><?php echo $_SESSION['default_currency_symbol']; ?><span class="total_price" style="float:none" id="totalscosts" ></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b>
		<ul class="total">
		    <li><span><?php echo __('Item total');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="subtotal_price" id="totalscosts2" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span><?php echo __('Shipping');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="shipping_cost" id="shipscosts" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span><?php echo __('Tax');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="sales_tax" style="float:none">0</span><small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		</ul>
	    </div>
	</div>
	<div class="frm">
	    <p>
		<label class="label"><?php echo __('Title');?></label>
		<input type="text" class="text" id="ggift-title" placeholder="Ex. Jenny’s birthday present" />
		<span id='title_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> <?php echo __('Enter the Title');?> </span>
		 </p>
	    <p>
		<label class="label"><?php echo __('Description');?></label>
		<textarea type="text" class="text" id="ggift-description" placeholder="Ex. Lets celebrate Jenny and give her an amazing gift!"></textarea>
		<span id='description_err' class='text' style='display:none;color:#FF0000;margin-left:112px;font-size:13px;'> <?php echo __('Enter the Description');?> </span>
	    </p>
	    <p class="cmt"><?php echo __('Use your group gift description to share more about who you’re raising contributions for and why');?>.</p>
        <p><label class="label"><?php echo __('Note');?></label>
        <input type="text" class="text" id="ggift-note" placeholder="You can leave a personalized note to merchant here." /></p>
	</div>
	<div class="btn-area">
	    <span class="help"> <span class="glyphicons circle_question_mark" style="padding:0;height:20px;margin-top: -16px;"></span> 
		    <a href="<?php echo SITE_URL.'groupgifts'; ?>"><?php echo __('How it works');?></a></span>
	    <button type="button" class="btns-white btn-back"  id="ggstep1">Go Back</button>
	    <button type="button" class="btns-blue-embo btn-continue" id="createggift" onclick="createggift()"><?php echo __('Create Group Gift');?></button>
	</div>
    </div>
   
    <div class="chept summary" style="display:none;">
	<div class="share" style="margin:0 72px;text-align:center;">
	    <p><b><?php echo __('Ask your friends to contribute');?></b></p>
	    <ul>
		
		<li><a style="float: left;margin-left: 5px;" class='facebook' href="" alt="Share this on facebook"    onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
		<li><a style="float: left;margin-left: 5px;" class='twitter' href="" alt="Share this on twitter"     onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
		<li><a style="float: left;margin-left: 5px;" class='google'  href=" alt="Share this on Google+" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
  		<li><a style="float: left;margin-left: 5px;" class='linkedin' href="" alt="Share this on linkedin"         onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
 		<li><a style="float: left;margin-left: 5px;" class='stumbleupon' href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
 		<li><a style="margin-left: 5px;"class='tumblr' href=""  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
	
	    </ul>
    </div>
	<h3><?php echo __('Group gift summary');?></h3>
	<div class="gift">
	    <div class="gift-total">
		<h4><?php echo __('Group Gift Total');?></h4>
		<ul>
		    <li><span><?php echo __('Item total');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="subtotal_price" id="totalscosts3" style="float:none"> </span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span><?php echo __('Shipping');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="shipping_cost" id="shipscosts1" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li><span><?php echo __('Tax');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="sales_tax" style="float:none"></span>0 <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		    <li class="total"><span><?php echo __('Goal Total');?></span> <b><?php echo $_SESSION['default_currency_symbol']; ?><span class="total_price" id="totalscosts1" style="float:none"></span> <small><?php echo $_SESSION['default_currency_code']; ?></small></b></li>
		</ul>
	    </div>
	    <p class="gift-title"  id="Usergifttitle" ><b></b></p>
	    <!-- <p class="gift-description" id="Usergiftdescription"></p> -->
	    <span class="line"></span><figure><img id="listingitemids1" src="" /></figure>
	    <div class="gift-to">
		
		
		<small><?php echo __('Gift to');?></small><br />
		<b id="UsergiftNamee" > </b><br />
		<span id="Usergiftcity" > <span>
	    </div>
	</div>
	<div class="btn-area">
	    <span class="notify">
	    <i class="glyphicons circle_exclamation_mark" style="height:20px;padding:0;margin-top: -14px;"></i>
	    <?php echo __('This group gift will be valid for 7 days.');?></span>
	    <button class="btns-blue-embo btn-continue" id="gglistdone"><?php echo __('Done');?></button>
	</div>
    </div>
</div>


<!--share-social-->
<div id="videourrls" class="popup ly-title share-new"  style="opacity: 1; display: none; width: 645px; margin-left: 318px; margin-top: 75px;">
	 
	<p class="ltit">
		<span ><?php echo __('Video');?></span>
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





		<!-- show profile -->
<div id="showprofile"  style="width:350px;" class="popup ly-title update add-to-list">

	<div class="default">
		<p class="ltit"><?php echo __('Add Your Fashion on this product');?></p>
		<button type="button" class="ly-close" id="btn-browses" style="margin-top:0px;"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
		<?php	echo $this->Form->Create('update',array('url'=>array('controller'=>'/','action'=>'/update'))); ?>
  		
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
				echo '<div class="imageerror" style="color:red; margin-left:72px;"></div>';
				echo "<div class='input-group' style='margin-top:10px;margin-left:10px;display:inline;text-align: center;'>";
						 
						echo '<div class="venueimg" style="padding-left:-100px;height:35px;margin-right:6px;"><iframe class="image_iframe" id="frame"  style="padding-left:24px;" name="frame" src="'.$this->webroot.'userproduct.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="171px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left; margin-left: 90px;"></iframe>';												
							echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
							if(!empty($image_computer)){  echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='margin-left:180px; margin-top: -45px;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }else{echo "<a href='javascript:void(0);' id='removeimg' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeusrimg(\" 1 \")'>Remove</a>"; }
						echo "</div>";
						
					?>
					</div>
					<hr size=2>
				
				
				<div class="btn-area" style="float: right; margin-top: 10px; margin-right: 56px;position:relative;">
					<button class="btn-save" id="save_profile_image" onclick="change(<?php echo $itemidsed; ?>)" ><?php echo __('Save Fashion');?></button>
					<span class="checking" style="display:none" ><i class="ic-loading"></i></span>
					<div id="loadingimgg" style="width: 15px; height: 15px; display: none; position: absolute; right: 10px; top: 7px;">
						<img src="<?php echo SITE_URL; ?>images/loading.gif" style="width:15px; height:15px;">
					</div>
				</fieldset>
				</div>
			

</form>
</div>
</div>
</div>
<!--  show profile -->
	
<!-- Contact Seller -->
<?php echo $this->element('contactsellerpopup'); ?>

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


<script>
var invajax=0;

</script>
