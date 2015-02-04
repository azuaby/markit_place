



	
<?php
$roundProf = "";
if(!empty($items_data)){
			
			foreach($items_data as $key=>$itms){
				$usercmntcount='';
				$itm_id = $itms['Item']['id'];
				$user_id = $itms['Item']['user_id'];
				$item_title_url = $itms['Item']['item_title_url'];
				$item_title = $itms['Item']['item_title'];
				$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
				
				if(isset($itms['Photo'][0])){
					$image_name = $itms['Photo'][0]['image_name'];
				}
				$username_url = $itms['User']['profile_image'];
				$username = $itms['User']['username'];
				
				$username_url_ori = $itms['User']['username_url'];
				$favorte_count = $itms['Item']['fav_count'];
				$shop_address = $itms['Shop']['shop_address'];
				
				$item_titletwo = UrlfriendlyComponent::limit_char($item_title,10);
				
				echo  '<li imgid="'.$image_name.'" style="list-style-type:none;">'; 
				
				echo "<table border='0' width='100%' class='ui-btn ui-btn-inline ui-corner-all ui-responsive' style='cursor:default;background-color:#FFFFFF'><tr><td align='left' width='50%'>";
				
				$mediaul = trim($_SESSION['media_url']);
				$border = "";
				list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
				list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
				
				echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' id='img_id".$itms['Item']['id']."'>";
				
				if ($height_ori < 640){
					$border = "border-radius:0;";
				}
				
			if(!empty($username_url)){
					
					echo  "<a href='".SITE_URL."people/".$username_url_ori."'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
					<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."'>".$item_titletwo."  </a><br />
					<i style='margin-top: 17px;margin-left:70px;'>$username</i>
				
						
					</a>";
					//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
				}else{
					
					echo  "<a href='".SITE_URL."people/".$username_url_ori."'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."'>
					<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."'>".$item_titletwo."  </a><br />
					<i style='margin-top: 17px;margin-left:70px;'>$username</i>
				
					</a>";
					}
					
					
					
					echo "</a>";
					echo "</td><td align='right' width='50%'>";
					echo "<b>$".$item_price."</b>";
					echo "</td></tr><tr><td colspan='2' align='center'>";
				
				
				echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#F9F9F9;' data-height=".$height." data-width=".$width.">";
				
				echo  '<span id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
			
				echo "</td></tr><tr><td align='left'>";
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="ui-btn ui-btn-inline ui-mini-smaller" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img border="1" src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: -4px;"></span><span style="margin-left:4px;" class="itemdd'.$itms['Item']['id'].'"> '.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span></a>';
				}else{
				echo  '<a class="ui-btn ui-btn-inline ui-mini-smaller" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: -4px;"></span><span style="margin-left:4px;"> '.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span></a>';
				}
				echo "</td>
				
				<td align='right'>
						<a href='' class='ui-btn ui-btn-inline ui-mini-smaller' style='cursor:default;background-color:#FFFFFF'>
				<img src='../images/menu/icon-comment.png'>
						<a href='' class='ui-btn ui-btn-inline' style='cursor:default;background-color:#FFFFFF'>
				<img src='../images/menu/icon-dotlist.png'></a>
				<a href='' class='ui-btn ui-btn-inline' style='cursor:default;background-color:#FFFFFF'>
				<img src='../images/menu/icon-addtocart.png'></a>

			

				</td>
				</tr>
				</table>";
				
				
				
				
				
				
					
				
				
				
				
					
				
					
	
			echo  '</li>';
			}	
			}else{
				echo "<center>No Items Found</center>";
			}
						
?>
