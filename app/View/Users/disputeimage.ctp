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



 $exte=$img['Dispcons']['imagedisputes'];
//echo "<img id='show_url'  style='float: left;margin-left: 0px; border: 1px solid rgb(221, 221, 221); padding: 5px; ".$roundProfile."' src='".$_SESSION['media_url']."dispute/".$exte."'>";
?>
<style type="text/css">
.wrapper-content {
	padding-top: 50px;
}
</style>
              
                
<div class="container wider" style="top: 0px;width:960px;">
		<div class="wrapper-content right-sidebar" style="background:none;margin-bottom: -5px;">
			<div id="content" style="margin:0px 0px 0px 162px;">
				<div class="figure-row first sepProduView" style="margin-left: -26px;">
					<div class="figure-product figure-640 big text-left">

			
				<figure>
					<span class="wrapper-fig-image" style="text-align: center; background: #FBFCFC; margin-bottom: 12px;">
						<img id="fullimgtag" alt="<?php echo $exte;?>" title="<?php echo $exte;?>" src="<?php echo $_SESSION['media_url'].'dispute/'.$exte;?>">
					</span>                            
                 
						    
                </figure>
               </a>
		
		
			</div>
					<!-- / figure-product figure-640 -->
					
						
			
		
				</div>
				<div id="links"></div>	
		
	</div>
<!-- / content 
	<aside id="sidebar" style="background:none;" >
				<section class="thing-section gift-section">
		
				
			<div class="itemAddedUserDetails  figure-row first sepProduView ">
						<?php if($img['Dispcons']['commented_by'] == 'Buyer'){?>
							<?php 
							
							
		        			
 if(!empty($imgsenusid["User"]["profile_image"])){
								echo " <a href='".SITE_URL."people/".$imgsenusid["User"]["username_url"]."'    class='vcard'><img style='margin-right: 8px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$imgsenusid['User']['profile_image']."' /></a>";
							}else{
								echo " <a class='imagebor' href='".SITE_URL."people/".$imgsenusid["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 8px;' /></a>";
							
							}
 								 }else{
 								 	
 								 	if(!empty($imgsenseid["User"]["profile_image"])){
 								 		echo " <a href='".SITE_URL."people/".$imgsenseid["User"]["username_url"]."'    class='vcard'><img style='margin-right: 8px;$roundProfile width:40px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$imgsenseid['User']['profile_image']."' /></a>";
 								 	}else{
 								 		echo " <a class='imagebor' href='".SITE_URL."people/".$imgsenseid["User"]["username_url"]."'  ><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProfile."width:40px;margin-right: 8px;' /></a>";
 								 			
 								 	}
 								 								
								
							}?>
							<?php if($img['Dispcons']['commented_by'] == 'Buyer'){?>
							<a href = "<?php echo SITE_URL; ?>" class = 'username' title = '<?php echo $imgsenusid["User"]["username"]; ?>'>
				<?php echo $imgsenusid["User"]["username"];?><br clear='all'/><span class="usernameMention"><?php echo "@".$imgsenusid["User"]["username_url"] ?></span>
				</a><?php }else{?>
				<a href = "<?php echo SITE_URL; ?>" class = 'username' title = '<?php echo $imgsenseid["User"]["username"]; ?>'>
				<?php echo $imgsenseid["User"]["username"];?><br clear='all'/><span class="usernameMention"><?php echo "@".$imgsenseid["User"]["username_url"] ?></span>
				<?php }?>
							
						
			<?php if($img['Dispcons']['commented_by'] == 'Buyer'){?>
				
				
				<div class="option-area" style="margin: -20px 0 0px;">
								
								<label for="quantity" style="display: inline-block; font-size: 14px;font-weight:bold;color:#373D48;">Message: </label>
								<span class="" style="display: inline-block; position: relative;color:#717171;font-size: 12px;">
									 <?php echo $img['Dispcons']['message']; ?>
									
									
								</span>				
						
					</div>
					<?php }else{?>
					<div class="option-area" style=" margin: 8px 0 -30px;">
								
								<label for="quantity" style="display: inline-block; font-size: 14px;font-weight:bold;color:#373D48;">Message: </label>
								<span class="" style="display: inline-block; position: relative;color:#717171;font-size: 12px;">
									 <?php echo $img['Dispcons']['message']; ?>
									
									
								</span>				
						
					</div><?php }?>
			

				</section>
				<!-- / thing-section -->
				<hr>
			</aside> 
			<!-- / sidebar -->
			
		
			
		<!-- / wrapper-content -->
	</div>
                