					<?php foreach ($shopsdet as $shopdatas){  //print_r($shopdatas);
							$shop_name = $shopdatas['shop_name'];
							$shop_name_url = $shopdatas['shop_name_url'];
							$shop_img = $shopdatas['shop_image'];
							$merchant_name = $shopdatas['merchant_name'];
							$item_count = $shopdatas['item_count'];
							$shop_id = $shopdatas['user_id'];	
							$follow_count = $shopdatas['follow_count'];	
							$follow_shop = $shopdatas['follow_shop'];
							//echo $follow_shop;						
					?>
					<div id="store_div">
						<div class="header">
							<div class="store_img">
								<?php 
								if(!empty($shop_img)){
									echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/".$shop_img."'  />";
								}else{
									echo "<img  src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' />";
								}
								?>
								<span> <a href="<?php echo SITE_URL; ?>stores/<?php echo $shop_id; ?>/<?php echo $shop_name_url; ?>"> <?php echo $shop_name; ?> </a> <br/> 
									<span style="font-size:12px;margin:-3px 0px"> By <?php echo $merchant_name; ?> </span>
								</span>
							</div>	
							<!-- <div class="shop_follow">	
								<a onclick="shop_follow(<?php echo $item_id;?>)" class="folower"> Follow </a>
							</div>	
							<div class="shop_unfollow" style="display:none">	
								<a onclick="shop_unfollow(<?php echo $item_id;?>)" class="unfolower"> Following </a>
							</div> -->	
							<?php
							//echo $loguser[0]['User']['id']; echo $shop_id;
							if($shop_id != $loguser[0]['User']['id']){ 
								if($follow_shop == '0'){
									echo "<span class='follow' id='foll".$shop_id."'>";
									echo '<button style="margin-top:13px;" type="button" id="follow_btn'.$shop_id.'" class="btnblu" onclick="shop_follow('.$shop_id.')">';
									echo '<span class="foll'.$shop_id.'" >Follow</span>';
									echo '</button>';
									echo "</span>";
								}else{
									echo "<span class='follow' id='unfoll".$shop_id."'>";
									echo '<button type="button" style="margin-top:13px;" id="unfollow_btn'.$shop_id.'" class="greebtn" onclick="shop_unfollow('.$shop_id.')">';
									echo '<span class="unfoll'.$shop_id.'" >Following</span>';
									echo '</button>';
									echo "</span>";
								}
								echo '<span id="changebtn'.$shop_id.'" ></span>';
							} 
							?>
						</div>
						<div class="store_item">
							<?php foreach($shopdatas['itemModel'] as $itemModel) { //print_r($itemModel); ?>
								<a href="<?php echo SITE_URL."listing/".$itemModel['Item']['id']."/".$itemModel['Item']['item_title_url']; ?>"
								title="<?php echo $itemModel['Item']['item_title'];?>">
								<div class="itm" style="background: url('<?php echo $_SESSION['media_url'].'media/items/thumb150/'.$itemModel['Photo'][0]['image_name'];?>') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);">
								</div>
								</a>
							<?php } ?> 
							
						</div>
						<div style="float:left;width:92%;padding:0px 14px">
								<p style="float:left"> <a href="<?php echo SITE_URL; ?>stores/<?php echo $shop_id; ?>/<?php echo $shop_name_url; ?>" >
									View More
								</a> </p>
								<p style="float:right;text-align:right" >
									<?php echo count($shopdatas['itemcount']);?> Products
								</p>
						</div>
					</div>
					<?php } //} ?>