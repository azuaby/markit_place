<div class="ui-body ui-body-a">
<div id="container-wrapper">
<div class="container set_area">
<div class="wrapper-content wider fancy-right-sidebar">
	<div class="notifiycl"><?php echo __('Notifications'); ?></div>
			
		<ul class="notify-list">
			
            
            <?php           
            $keyses = 0;
          if(!empty($getLogvalues)){
					foreach($loguserdetails as $key=>$logg){					
									 
						
						
						if($decoded_value->frends_cmnts_push == '1'){
						if($logg['Log']['type'] == 'comment'){
							
						if($getLogvalues[$key]['User']['profile_image']!=''){
							$imagess = $getLogvalues[$key]['User']['profile_image'];
						}else{
							$imagess = 'usrimg.jpg';
						}
						//echo "<pre>";print_r($getLogvalues[$key]);die;
          ?>
      	
			        <span class="notification-item">
			        <table data-role="table" class="ui-responsive">
              		          <thead>
              		          <tr><th></th></tr>
              		          <tr><th></th></tr>
              		          </thead>
              		          <tbody>
              		          <tr><td>
			            <a href="<?php echo SITE_URL.'listing/'.$getLogvalues[$key]['Item']['id'].'/'.$getLogvalues[$key]['Item']['item_title_url']; ?> "><img src="<?php echo SITE_URL.'media/items/thumb350/'.$getLogvalues[$key]['Photo']['image_name']; ?>" style="float: right;" class="u"></a>
			            <a href="<?php echo SITE_URL.$getLogvalues[$key]['User']['username_url']; ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" class="avartar"></a>
			            </td><td>
			           <span class="title"><a href="<?php echo SITE_URL."people/".$getLogvalues[$key]['User']['username_url']; ?>" class="users"><?php echo $getLogvalues[$key]['User']['username']; ?></a>  <?php echo __('Commented on');?> 
			                
			                <a href="<?php echo SITE_URL.'listing/'.$getLogvalues[$key]['Item']['id'].'/'.$getLogvalues[$key]['Item']['item_title_url']; ?>"><?php echo $getLogvalues[$key]['Item']['item_title']; ?></a>.
			                 </span>
			                 
			                 <span class="cmt"><?php echo $getLogvalues[$key]['Comment']['comments']; ?></span>
         			 	     <span class="activity-reply">
								<?php 
									$ldate = $logg['Log']['cdate'];
									echo '<br /><br /><small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>
							</span>
			                 </td></tr>
			                 </tbody>
			                 </table>
			               
			        </span>
			        
            
            <?php 		}
            }  
           
            if($decoded_value->frends_flw_push == '1'){
             if($logg['Log']['type'] == 'additem'){
             	
             	if($getLogvalues[$key]['User']['profile_image']!=''){
             		$imagess = $getLogvalues[$key]['User']['profile_image'];
             	}else{
             		$imagess = 'usrimg.jpg';
             	}
             	
			//	echo "<pre>";print_r($getLogvalues[$key]);die;
          ?>
          	
				        <span class="notification-item">
				        <table data-role="table" class="ui-responsive">
              		          <thead>
              		          <tr><th></th></tr>
              		          <tr><th></th></tr>
              		          </thead>
              		          <tbody>
              		          <tr><td>
				            <a href="<?php echo SITE_URL.'listing/'.$getLogvalues[$key]['Item']['id'].'/'.$getLogvalues[$key]['Item']['item_title_url']; ?> "><img src="<?php echo SITE_URL.'media/items/thumb350/'.$getLogvalues[$key]['Photo'][0]['image_name']; ?>" style="float: right;" class="u"></a>
				            <a href="<?php echo SITE_URL.$getLogvalues[$key]['User']['username_url']; ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" class="avartar"></a>
				            </td><td>
				           <span class="title"><a href="<?php echo SITE_URL."people/".$getLogvalues[$key]['User']['username_url']; ?>" class="users"><?php echo $getLogvalues[$key]['User']['username']; ?></a>  <?php echo __('Added item');?> 
				                
				                <a href="<?php echo SITE_URL.'listing/'.$getLogvalues[$key]['Item']['id'].'/'.$getLogvalues[$key]['Item']['item_title_url']; ?>"><?php echo $getLogvalues[$key]['Item']['item_title']; ?></a>.
				                 </span>
				                 
				                 <span class="cmt"><?php echo $getLogvalues[$key]['Comment']['comments']; ?></span>
			             			   <span class="activity-reply">
										<?php 
									$ldate = $logg['Log']['cdate'];
									echo '<br /><br /><small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
								?>
										</span>
				  					 
				  				
				                 </td></tr></tbody></table>
				               
				        </span>
            
            
            <?php
             }  

 } 



               if($logg['Log']['type'] == 'follow'   && $userid == $logg['Log']['follow_id']){
//echo "<pre>";print_r($getLogvalues[$keyses]);die;
              			if($getLogvalues[$keyses]['User']['profile_image']!=''){
              				$imagess = $getLogvalues[$keyses]['User']['profile_image'];
              			}else{
              				$imagess = 'usrimg.jpg';
              			}
              			?>
              		              							
              		      <span class="notification-item">
              		          <div class="u" style="float: right; height: 100px; width: 100px;"></div>
              		          <table data-role="table" class="ui-responsive">
              		          <thead>
              		          <tr><th></th></tr>
              		          <tr><th></th></tr>
              		          </thead>
              		          <tbody>
              		          <tr><td>
              		         <a href="<?php echo SITE_URL.$getLogvalues[$keyses]['User']['username_url']; ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" class="avartar"></a>
              		         </td><td>
              		           
              		           <span class="title"><a href="<?php echo SITE_URL."people/".$getLogvalues[$keyses]['User']['username_url']; ?>" class="users"><?php echo $getLogvalues[$keyses]['User']['username']; ?></a>  Is Following you.
              		           </span>
              		           <span class="cmt"><?php echo $logg['Log']['seller_message']; ?></span>
              		           <span class="activity-reply">
              		          <?php 
									$ldate = $logg['Log']['cdate'];
									echo '<br /><br /><small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small></p>';
								?>
              		            </span>
              		           </td></tr>
              		           </tbody>
              		           </table>
              		        </span>
              		        
              		      <table data-role="table" class="ui-responsive">
      
    
              		            							
              		     <?php  
                           $keyses++;		
              		  }




              
              if($logg['Log']['type'] == 'sellermessage'){              		
              		
              	if($getLogvalues[$key]['User']['profile_image']!=''){
              		$imagess = $getLogvalues[$key]['User']['profile_image'];
              	}else{
              		$imagess = 'usrimg.jpg';
              	}
              	?>
              							
              							
        		<span class="notification-item">
        		<table data-role="table" class="ui-responsive">
              		          <thead>
              		          <tr><th></th></tr>
              		          <tr><th></th></tr>
              		          </thead>
              		          <tbody>
              		          <tr><td>
              		<div class="u" style="float: right; height: 100px; width: 100px;"></div>
              		<a href="<?php echo SITE_URL.$getLogvalues[$key]['User']['username_url']; ?>"><img src="<?php echo SITE_URL.'media/avatars/thumb70/'.$imagess; ?>" class="avartar"></a>
              		</td><td>
              		<span class="title"><a href="<?php echo SITE_URL."people/".$getLogvalues[$key]['User']['username_url']; ?>" class="users"><?php echo $getLogvalues[$key]['User']['username']; ?></a>  <?php echo __('Posted a message');?> 
              		</span>
              		<span class="cmt"><?php echo $logg['Log']['seller_message']; ?></span>
                    <span class="activity-reply">
              		<?php 
									$ldate = $logg['Log']['cdate'];
									echo '<br /><br /><small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($ldate).'</small>';
									
								?>
              		</span>
              		</td></tr></tbody></table>
              		 
              	</span>
              	
              	
              							
              	<?php   			
              		}    

                   
              		


         
              
               }
                            
            
               
               }else{
               		echo "<span class='notification-item'> No recent activities found from your friends </span>";
               }
            ?>
            
            
		
		</ul>
           
	</div>
		
</div>
</div>
</div>
 </div>