<?php 
          if(!empty($logedvalues)){
          	//echo "<pre>";print_r($logedvalues);die;
          	$i = 0;
          	$keyses = 0;
					foreach($userlogd as $key=>$logg){
						//echo "<pre>";print_r($logedvalues);die;
						if($decoded_value->frends_cmnts_push == '1'){
						if($logg['Log']['type'] == 'comment'){
							$i++;
						if($logedvalues[$key]['User']['profile_image']!=''){
							$imagess = $logedvalues[$key]['User']['profile_image'];
						}else{
							$imagess = 'usrimg.jpg';
						}
						$logedvalues[$key]['Item']['item_title'] = UrlfriendlyComponent::limit_char($logedvalues[$key]['Item']['item_title'],10);
					
						$logedvalues[$key]['Comment']['comments'] =UrlfriendlyComponent::limit_char($logedvalues[$key]['Comment']['comments'],25);
					
						// substr(($logedvalues[$key]['Comment']['comments']), 0, 4); 
						
						//	echo "<pre>";print_r($getLogvalues[$key]);die;
          ?>
      	
			        <li class="" style="width:330px;height:40px;padding-left:10px;">
			            <a href="<?php echo SITE_URL.'listing/'.$logedvalues[$key]['Item']['id'].'/'.$logedvalues[$key]['Item']['item_title_url']; ?> "><img src="<?php echo SITE_URL.'media/items/thumb70/'.$logedvalues[$key]['Photo']['image_name']; ?>" style="float: right;height:30px;width:30px;" class="u"></a>
			            <a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url']; ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" style="float: left;height:30px;width:30px;" class="avartar"></a>
			        <p class="right" style="float:left;padding-left:5px;line-height: 15px;"><span class="title"><a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url']; ?>" class=""><?php echo $logedvalues[$key]['User']['username']; ?></a>  <?php echo __('Commented on'); ?> <br />
			               
			                <a href="<?php echo SITE_URL.'listing/'.$logedvalues[$key]['Item']['id'].'/'.$logedvalues[$key]['Item']['item_title_url']; ?>"><?php echo $logedvalues[$key]['Item']['item_title']; ?></a>.
			                 </span>
			                 
			                 <span class="cmt"><?php echo $logedvalues[$key]['Comment']['comments']; ?></span>
         			 	     <span class="activity-reply">
								<?php 
									$ldate = $logg['Log']['cdate'];
									echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>
							</span>
			                 
			               </p>
			        </li>
            <?php    }}
            		if($decoded_value->frends_flw_push == '1'){
            	
             	if($logg['Log']['type'] == 'additem'){
             		$i++;
             	if($logedvalues[$key]['User']['profile_image']!=''){
             		$imagess = $logedvalues[$key]['User']['profile_image'];
             	}else{
             		$imagess = 'usrimg.jpg';
             	}
             	$logedvalues[$key]['Item']['item_title'] = UrlfriendlyComponent::limit_char($logedvalues[$key]['Item']['item_title'],25);
				//echo "<pre>";print_r($logedvalues[$key]);die;
          ?>
          	
				      <li class="" style="width:330px;height:40px;padding-left:10px;">
				            <a href="<?php echo SITE_URL.'listing/'.$logedvalues[$key]['Item']['id'].'/'.$logedvalues[$key]['Item']['item_title_url']; ?> "><img src="<?php echo SITE_URL.'media/items/thumb70/'.$logedvalues[$key]['Photo'][0]['image_name']; ?>" style="float: right;height:30px;width:30px;" class="u"></a>
				            <a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url'];  ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" style="float: left;height:30px;width:30px;" class="avartar"></a>
				            <p class="right" style="float:left;padding-left:5px;line-height: 15px;"><span class="title"><a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url']; ?>" class="users"><?php echo $logedvalues[$key]['User']['username']; ?></a>  <?php echo __('Item added'); ?> 
				                <br /> 
				                <a href="<?php echo SITE_URL.'listing/'.$logedvalues[$key]['Item']['id'].'/'.$logedvalues[$key]['Item']['item_title_url']; ?>"><?php echo $logedvalues[$key]['Item']['item_title']; ?></a>.
				                 </span>
				                 
				                 <span class="cmt"><?php echo $logedvalues[$key]['Comment']['comments']; ?></span>
			             			   <span class="activity-reply">
										<?php 
									$ldate = $logg['Log']['cdate'];
									echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>
										</span>
				  					 
  			<?php    }
            		}
            		
            		if($logg['Log']['type'] == 'sellermessage'){
             		$i++;
            		
            			if($logedvalues[$key]['User']['profile_image']!=''){
            				$imagess = $logedvalues[$key]['User']['profile_image'];
            			}else{
            				$imagess = 'usrimg.jpg';
            			}
            			?>
            		              							
            		     <li style="width:330px;height:40px;padding-left:10px;">
            		       <div class="u" style="float: right; height: 40px; width: 40px;"></div>
            		       <a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url'];  ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" style="float: left;height:30px;width:30px;" class="avartar"></a>
			               <p class="right" style="float:left;padding-left:5px;line-height: 15px;">
            		       <span class="title"><a href="<?php echo SITE_URL.$logedvalues[$key]['User']['username_url']; ?>" class="users"><?php echo $logedvalues[$key]['User']['username']; ?></a>  <?php echo __('Posted a message'); ?> :
            		       </span><br /> 
            		       <a href="<?php echo SITE_URL.'push_notifications'; ?>"><span class="cmt"><?php echo UrlfriendlyComponent::limit_char($logg['Log']['seller_message'],25); ?></span></a>
            		       <span class="activity-reply">
            		       <?php 
									$ldate = $logg['Log']['cdate'];
									echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>
            		       </span>
            		       </p>
            		    </li>
            		     <?php   			
            		  }
            		  
            		  
            		  if($logg['Log']['type'] == 'follow' && $userid == $logg['Log']['follow_id'] ){
            		  	$i++;
            		  
            		  	if($logedvalues[$keyses]['User']['profile_image']!=''){
            		  		$imagess = $logedvalues[$keyses]['User']['profile_image'];
            		  	}else{
            		  		$imagess = 'usrimg.jpg';
            		  	}
            		  	?>
            		              		              							
            		              		     <li style="width:330px;height:40px;padding-left:10px;">
            		              		       <div class="u" style="float: right; height: 40px; width: 40px;"></div>
            		              		       <a href="<?php echo SITE_URL.$logedvalues[$keyses]['User']['username_url'];  ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" style="float: left;height:30px;width:30px;" class="avartar"></a>
            		  			               <p class="right" style="float:left;padding-left:5px;line-height: 15px;">
            		              		       <span class="title"><a href="<?php echo SITE_URL.$logedvalues[$keyses]['User']['username_url']; ?>" class="users"><?php echo $logedvalues[$keyses]['User']['username']; ?></a>  <?php echo __('is following you'); ?> 
            		              		       </span><br /> 
            		              		       <span class="activity-reply">
            		              		       <?php 
									$ldate = $logg['Log']['cdate'];
									echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>	              		       
            		              		       </span>
            		              		       </p>
            		              		    </li>
            		              		     <?php   			
            		              		     $keyses++;
            		              		  }
            		
            		
            		
            		if ($i == 4) break;
				}
         	 }
          
         	 ?>	
  		<?php 	
if(!empty($logedvalues)){
	echo '<li style="width:330px;height:40px;padding-left:10px;"><a class="more" href="'.SITE_URL.'push_notifications">'; echo __('See all notifications'); echo '</a></li>';
}else{
	echo '<li style="width:330px;height:40px;padding-left:10px;"><a class="more" href="'.SITE_URL.'push_notifications">'; echo __('No recent activities found from your friends'); echo '</a></li>';
}?>