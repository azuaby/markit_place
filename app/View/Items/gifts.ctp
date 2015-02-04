<?php
$roundProfile = "";
$roundProfileFlag = 0;
if ($roundProf == "round")  {
	$roundProfile = "border-radius:30px;";
	$roundProfileFlag = 1;
}
?>
<body onload="hidecomment()">
<div class="container wider" style="top: 0px;width:960px;">
		<div class="wrapper-content right-sidebar" style="margin-bottom: 30px;background:none;">
			<div id="content">
				<div class="figure-row first sepProduView">
					<div class="figure-product figure-640 big">

				<a title="<?php echo $item_datas['Item']['item_title']; ?>" id="img_id<?php echo $item_datas['Item']['id']; ?>"  href="#">	
				<figure>
					<span class="wrapper-fig-image" style="text-align: center; background: #FBFCFC; margin-bottom: 12px;">
						<img id="fullimgtag" alt="" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>">
					</span>                            
                   	    
                </figure>
               </a>
			<!-- <a title="<?php echo $item_datas['Item']['item_title']; ?>" href="#">
				<figure><span class="fig-image"><img id="fullimgtag" height="550" width="570" alt="<?php echo $item_datas['Item']['item_title'];?>" src="<?php echo $_SESSION['media_url'].'media/items/original/'.$item_datas['Photo'][0]['image_name'];?>"></span>
				<figcaption><?php echo $item_datas['Item']['item_title']; ?></figcaption></figure>
			</a> -->
			
			
			<br class="hidden">
						
						
						
						
	<div class="ggsocialicon">
		<ul>
			<li><a class='facebook' href="http://www.facebook.com/sharer.php?s=100&p[title]=Contribution Request from your friend&p[url]=<?php echo SITE_URL."gifts/".$items_list_data['Groupgiftuserdetail']['id']; ?>&p[images][0]=<?php echo $_SESSION['media_url'].'media/items/thumb150/'.$item_datas['Photo'][0]['image_name'];?>" onclick="javascript:MyPopUpWinsocialggfb(this);return false;"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> </li>
			<li><a class='twitter' href="http://twitter.com/?status=" alt="Share this on twitter"     onclick="javascript:MyPopUpWinsocial(this);return false;"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a></li>
			<li><a class='google'  href="http://plus.google.com/share?url=" alt="Share this on Google+" onclick="javascript:MyPopUpWinsocial(this);return false;"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a></li>
	  		<li><a class='linkedin' href="http://www.linkedin.com/cws/share?url" alt="Share this on linkedin"         onclick="javascript:MyPopUpWinsocial(this);return false;" ><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a></li>
	 		<li><a class='stumbleupon' href="http://www.stumbleupon.com/submit?url=" onclick="javascript:MyPopUpWinsocial(this);return false;" target="_blank"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a></li>
	 		<li><a class='tumblr' href="http://www.tumblr.com/share/link?url="  onclick="javascript:MyPopUpWinsocial(this);return false;"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a></li>
		</ul>
	</div>							
						
			
			
			</div>
			<br / >
					<!-- / figure-product figure-640 -->
						<div class="gifts-summary">
							<h2>
							<?php echo $items_list_data['Groupgiftuserdetail']['title']; ?>
							<!-- <small>for <?php echo $items_list_data['Groupgiftuserdetail']['name']; ?></small> -->
							</h2>
							<p class="messagess"><?php echo $items_list_data['Groupgiftuserdetail']['description']; ?></p>
							
							<div class="respcreat">
								<div class="ggresp">
									<?php echo "Recipient";?>
									<div class="user">
									<?php 
									$ggimages = $items_list_data['Groupgiftuserdetail']['image'];
									if($ggimages !=''){ ?>
									<img class="photo" alt="User" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/'.$ggimages; ?>" >
									<?php }else{ ?>
									<img class="photo" alt="User" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg'; ?>" >
									<?php } ?>
									
									<b class="username"><?php echo $items_list_data['Groupgiftuserdetail']['name']; ?></b>
									
									<?php $lday=date("F j, Y ",$items_list_data['Groupgiftuserdetail']['c_date']); ?>
									
									
									<span class="date"><?php echo $lday; ?></span>
									</div>
								</div>
								<div class="ggcreator">
									<?php echo "Creator";?>
									<div class="user">
									<a href="<?php echo $_SESSION['media_url'].'people/'.$createuserDetails['User']['username_url']; ?>">
									<?php if(!empty($createuserDetails['User']['profile_image'])){ ?>
									<img class="photo" alt="User" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/'.$createuserDetails['User']['profile_image'];?>" >
									<?php }else{ ?>
									<img class="photo" alt="User" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg';?>" >
									<?php } ?>
									
									<b class="username"><?php echo $createuserDetails['User']['first_name'];?></b>
									</a>
									
									<?php $lday=date("F j, Y ",$items_list_data['Groupgiftuserdetail']['c_date']); ?>
									
									
									<span class="date"><?php echo $lday; ?></span>
									</div>
								</div>
							
							</div>
							
							
							
							<?php 
							$totContri = 0;
							if(!empty($ggAmtDatas)){	
								?>
								
							<div class="contrilisthead"><?php echo "Contributors";?></div>
							<div class="contrilist">
								<?php 
								foreach($ggAmtDatas as $ggdata){	
									?>
								<div class="contrilistcont">
									<div class="user">
									<a href="<?php echo $_SESSION['media_url'].'people/'.$ggdata['User']['username_url']; ?>">
									<?php if(!empty($ggdata['User']['profile_image'])){ ?>
									<img class="photo" alt="Userimg" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/'.$ggdata['User']['profile_image'];?>" >
									<?php }else{ ?>
									<img class="photo" alt="Userimg" src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg';?>" >
									<?php } ?>
									
									<b class="username"><?php echo $ggdata['User']['first_name'];?></b>
									</a>
									<?php $lday=date("F j, Y ",$ggdata['Groupgiftpayamt']['cdate']); ?>
									<span class="date"><?php echo $lday; ?></span>
									<div class="contripaidamt"><?php echo $_SESSION['currency_symbol'].$ggdata['Groupgiftpayamt']['amount']; ?></div>
									</div>
								</div>
								<?php 
								$totContri += $ggdata['Groupgiftpayamt']['amount'];
									} ?>
							</div>
									
							<?php }
								?>
							
						</div>
					
					
					
					
			
				</div>
				
					
				<?php 
				//$cost = $items_list_data['Groupgiftuserdetail']['itemcost'] + $items_list_data['Groupgiftuserdetail']['shipcost'] ;
				$cost = $items_list_data['Groupgiftuserdetail']['total_amt'];
				$remainContri = $cost - $totContri;
				echo '<input type="hidden" id="lastestidggs" value="'.$items_list_data['Groupgiftuserdetail']['id'].'" />';
				echo '<input type="hidden" id="costforitem" value="'.$cost.'" />';
				echo '<input type="hidden" id="itemidval" value="'.$item_datas['Item']['id'].'" />';
				echo '<input type="hidden" id="totalContribution" value="'.$totContri.'" />';
				echo '<input type="hidden" id="remainingContribution" value="'.$remainContri.'" />';
				$contributed = 0;
				if ($cost == $totContri){
					$contributed = 1;
				}
				
				?>		
					
		
	</div>
<!-- / content -->

			<aside id="sidebar" class="groupgiftview" style="background: none;">
			<div class=" figure-row first sepProduView recipient">
				<h1 class="stiteg"><?php echo __('Recipient');?></h1>
				
				<div class="reciver">
				<?php 
				$ggimages = $items_list_data['Groupgiftuserdetail']['image'];
				if($ggimages !=''){ ?>					
					<img src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/'.$ggimages; ?>" class="potot" alt="">
				<?php }else{ ?>
					<img src="<?php echo $_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg'; ?>" class="potot" alt="">					
				<?php } ?>
				
					<b class="username"><?php echo $items_list_data['Groupgiftuserdetail']['name']; ?></b>
					<?php $recepientday=date("F j, Y ",$items_list_data['Groupgiftuserdetail']['c_date']); ?>
					<small><?php echo $recepientday; ?></small>
					<div class="recipentaddr">
						<h2>Recipient Address: </h2>
						<?php echo $items_list_data['Groupgiftuserdetail']['address1']; ?>, 
						<?php echo $items_list_data['Groupgiftuserdetail']['address2']; ?><br>
						<?php echo $items_list_data['Groupgiftuserdetail']['city']; ?>, 
						<?php echo $items_list_data['Groupgiftuserdetail']['state']; ?><br>
						<?php echo $countrys_list_data['Country']['country']; ?>
					</div>
				</div>
				<!--div class="gate">
					<span class="icon gg"></span> <a href="#">Jonah Wellington</a>
				</div-->
				
				<div class="notify">
					<?php echo __('This group gift will be delivered after the successful contribution from everyone');?>.
				</div>
				
			</div>
			<div class="figure-row first sepProduView contributions">
				<h1 class="stiteg"><?php echo __('Contributions');?></h1>
				<div class="prize">
					<?php if($paidamt == ''){
						$paidamt = '0.00';
					}else{
						$paidamt = $paidamt;
					}
					
					?>
					<?php 
						$ggid = $items_list_data['Groupgiftuserdetail']['id'];
						$timeleft = time() - $items_list_data['Groupgiftuserdetail']['c_date'];
						$daysleft = round((($timeleft/24)/60)/60);
						
						if($daysleft >= 7){
							$disabled = 'disabled';
						}if ($contributed == 1){ 
							$disabled = 'disabled';
						}else{
							$disabled = '';
						}
						?>
					<?php echo $_SESSION['default_currency_symbol'].$paidamt; ?>/<?php echo $_SESSION['default_currency_symbol'].$items_list_data['Groupgiftuserdetail']['total_amt'] ; ?>
					<div>Pending: <?php echo $_SESSION['default_currency_symbol'].$remainContri; ?></div>
				</div>
				<?php 
					switch($items_list_data['Groupgiftuserdetail']['status']){
						case 'Expired':
							$color = 'color: #952525';
							$disabled = 'disabled';
							break;
						case 'Completed':
							$color = 'color: #252595';
							$disabled = 'disabled';
							break;
						case 'Active':
							$color = 'color: #259525';
							break;
					}
				?>				
				<div class="contristatus">
					<div class="contristatusdiv">
						<?php echo __('Status');?>: <span style="<?php echo $color; ?>"><?php echo $items_list_data['Groupgiftuserdetail']['status']; ?></span>
					</div>
					<div class="totcontri">
						<?php echo __('Total contributors');?>: <?php echo count($paidUserId);?> <?php echo __('people');?>
					</div>
				</div>
				<?php if ($items_list_data['Groupgiftuserdetail']['status'] == 'Active') {?>
				<div class="contripayment">					
					<span class="mincontri">Minimum contribution: <?php echo $_SESSION['default_currency_symbol']."5 ".$_SESSION['default_currency_code']; ?></span>
					<input type="text" id="ggamt" placeholder="Enter Amount" style="padding: 7px; margin: 4px 0px;" maxlength="6">
					<div id="loadingimgsforgf<?php echo $ggid; ?>" style="display:none;text-align:center;">
						<img alt="Processing" src="<?php echo SITE_URL; ?>images/loading_blue.gif">
					</div>
					<button class="contribubtn-green" <?php echo $disabled; ?> onclick="contributeChkOut(<?php echo $ggid; ?>, <?php echo $currentUser; ?>)"><?php echo __('Contribute');?></button>
					
				</div>
				<?php } ?>
				<div class="notify">
						<?php echo __('This group gift must receive all contributions by');?> <?php $finaldate = $items_list_data['Groupgiftuserdetail']['c_date'] + 604800;echo $lday=date("F j, Y ",$finaldate); ?> to be successful.
						</br><?php echo __('Unsuccessful gift will be refunded');?>.
				</div>
			</div>
			
			<div class="figure-row first sepProduView product-info">
				<h1 class="stiteg"><?php echo __('Product Info');?></h1>
				<div class="store-name"><figcaption><a href="<?php echo SITE_URL.'listing/'.$item_datas['Item']['id'].'/'.$item_datas['Item']['item_title_url']; ?>"><?php echo $item_datas['Item']['item_title'];?></a></figcaption>
				<?php echo __('Markit');?>'<?php echo __('d by');?> <?php echo $item_datas['Item']['fav_count'];?> people</div>
				
				<div class="productimginfo">
					<a href="<?php echo SITE_URL.'listing/'.$item_datas['Item']['id'].'/'.$item_datas['Item']['item_title_url']; ?>"><img src="<?php echo $_SESSION['media_url'].'media/items/thumb70/'.$item_datas['Photo'][0]['image_name'];?>" alt="<?php echo $item_datas['Item']['item_title'];?>" /></a>
					<div class="description">
						<div class="less">
							<p><?php echo $item_datas['Item']['item_description'];?></p>
						</div>
						<!-- <a href="#" class="more" onclick="$('div.description > div').removeClass('less');$(this).hide().next().show();return false">(More)</a>
						<a href="#" class="less" style="display:none" onclick="$('div.description > div').addClass('less');$(this).hide().prev().show();return false">(Less)</a> -->
					</div>
				</div>
			</div>
		</aside>
		<!-- / sidebar -->
			
			<div id = "ggpaypalfom" ></div>
	</div>
		<!-- / wrapper-content -->
	</div>
	
	