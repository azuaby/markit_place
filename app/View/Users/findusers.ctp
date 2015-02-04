if(!empty($people_details)){
					foreach($people_details as $key => $ppls){
						//if(!empty($ppls['Itemfav'])){
						//echo "<pre>";print_r($ppls);
						$user_nam = $ppls['User']['username'];
						$user_first = $ppls['User']['first_name'];
						$user_imges = $ppls['User']['profile_image'];
				
				
				
						echo "<li class='stream-item'>"; 
							if(!empty($user_imges)){
								echo " <a href='".SITE_URL."people/".$user_nam."' class='vcard'><img src='".SITE_URL."media/avatars/thumb70/".$user_imges."' /><span class='shadow'></span></a>";
							}else{
								echo " <a href='".SITE_URL."people/".$user_nam."' class='vcard'><img src='".SITE_URL."media/avatars/thumb70/usrimg.jpg' /><span class='shadow'></span></a>";
							}
							echo " <a href='".SITE_URL."people/".$user_nam."' class='username'>$user_first</a>";							
							echo " <a href='".SITE_URL."people/".$user_nam."' class='nick'>"@".$user_nam</a>";
							
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
									echo '<button type="button" id="follow_btn" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
									echo '<span class="foll'.$ppls['User']['id'].'" >Follow</span>';
									echo '</button>';
									echo "</span>";
									//echo '<a href="#"  class="btn btn-primary" onclick="getfollows('.$ppls['User']['id'].')"  >Follow</a>';
								}else{
									echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
									echo '<button type="button" id="unfollow_btn" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
									echo '<span class="unfoll'.$ppls['User']['id'].'" >Following</span>';
									echo '</button>';
									echo "</span>";
								}
							}
							echo '<span  class="things">';
							foreach($ppls['Itemfav'] as $key=>$img_dtel){
								$itemid = $img_dtel['item_id'];
								$count=0;
								foreach($pho_datas as $key=>$val){
									if(!empty($val) and $count<4){
										if($itemid == $key){
											//echo "<pre>";print_r($val);
											echo "<a href='".SITE_URL."listing/".$itemid."/".$val[0]['Item']['item_title']."' >";
											if(!empty($val)){
												echo "<img src='".SITE_URL."media/items/thumb70/".$val[0]['Photo'][0]['image_name']."' width='50px' height='50px' /> &nbsp";
											}else{
												echo "<img src='".SITE_URL."media/items/thumb70/usrimg.jpg'  width='50px' height='50px' />";
											}
											echo "</a>";
										}
										$count++;
									}
								}
							}
							
							
							
							
							
							
							
						echo "</span></li>";
					}
				}