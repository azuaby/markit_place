<?php
$roundProfile = "";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:150px;";
}
?>

<div class="container invite-new" style="width:960px;">
					<?php
				if($managemoduleModel['Managemodule']['display_banner']=="yes")
				{					
					if($banner_datas['Banner']['status']=='Active')
					{					
						echo '<div>';
						echo $banner_datas['Banner']['html_source'];
						echo '</div>';
					}
				}
					?>	
<div class="wrapper-content find-people">



    <div class='wrapper-content'>

    
    <h2><?php echo __('Find People');?> 
    <br/>
    <small><?php echo __('Follow people to discover new things.');?></small> </h2>
    </div>
    <div id="sidebar" style="float:none;">
		<ul class="find-type">
	        <!--li><a href="<?php echo SITE_URL; ?>search/people"><span class="ff-sns icon"></span> Social Networks</a></li-->
	        <li><a href="<?php echo SITE_URL; ?>search/people?picks">
	        <?php //echo"<img src='".$_SESSION['media_url']."images/men.jpg' class='img' style='padding-left:0px;width:30px;height:25px;' alt='X' />";?>
	        
	        <span class="ff-picks icon glyphicons group"></span> <?php echo $setngs[0]['Sitesetting']['like_btn_cmnt']; ?> <?php echo __('Users');?></a></li>
	        <!--li><a href="<?php echo SITE_URL; ?>search/people?brands">
	        
	        <span class="ff-brand icon"></span> Featured Brands</a></li-->
	        <li><a href="<?php echo SITE_URL; ?>search/people?similar" >
	          <?php //echo"<img src='".$_SESSION['media_url']."images/men.jpg' class='img' style='padding-left:0px;width:30px;height:25px;' alt='X' />";?>
	        
	        <span class="ff-similar icon glyphicons group"></span> <?php echo __('Similar Users');?></a></li>
    	</ul>
    	<div class="peplesrch">
	    	<fieldset class="find-keyword">
	        <span class="icon ic-search glyphicons search"></span>
	        
	        <?php
				echo $this->Form->create('peoplesrch', array('type'=>'post','url' => array('controller' => '/', 'action' => '/search/people/')));
			?>
			<input type="text" placeholder="<?php echo __('Search for Peoples');?>" value="" class="search-keyword" name="search_people">
			 
			 </fieldset>
			<?php
				echo $this->Form->submit(__('Search'),array('div'=>false,'class'=>'searchbtn'));
				echo $this->Form->end();
			?>
		</div>
		
        </div>
        <?php
       if(count($_GET)==1){
        
        ?>
        
    	<div id="content"  style="padding: 0px; width: auto; min-width:960px;">
			<div class="result-contents search-result">
			<?php if(!empty($username_val)){ ?>
		    <h3 style='padding:16px 24px 0px 0px; text-align:center;'><b><?php echo __('Search results for');?> <?php echo $username_val; ?></b></h3>
		    <input type="hidden" value="<?php echo $username_val; ?>" id="entered_name">
		 	<?php }else{ ?>   		 	
		    <input type="hidden" value="" id="entered_name">
		    <?php } ?>
		   <div class="select-list">
		   <!--<div class="tab">
		   <a href="" class="current">54 People</a>
		   </div>
		   button class="btns-blue-embo btn-findall">Follow All</button-->
		   <ul class="stream">
	       
            <?php
			if(!empty($people_details)){
				foreach($people_details as $key => $ppls){
				//if(!empty($ppls['Itemfav'])){
					//echo "<pre>";print_r($ppls);
					$user_nam = $ppls['User']['username'];
					$user_nam_url = $ppls['User']['username_url'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 

            echo "<li class='stream-item' style='width: 450px;'>"; 

           

             echo "<div class='peopleheaders'>"; 
			if(!empty($user_imges)){
				echo " <a href='".SITE_URL."people/".$user_nam_url."'  title='".$user_nam."'   class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}else{
				echo " <a href='".SITE_URL."people/".$user_nam_url."' title='".$user_nam."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}
			echo $this->Html->link($user_first,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'username','title' => $user_nam,'style'=>'position: absolute; top: 10px; left: 55px;'));
			echo $this->Html->link("@".$user_nam_url,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'nick','title' => $user_nam,'style'=>'position: absolute; left: 55px; top: 27px;'));
			
			
			
			?>
			
			<?php
			
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
						echo '<span class="foll'.$ppls['User']['id'].'" >'?> <?php echo __('Follow'); echo '</span>';
					echo '</button>';
				echo "</span>";
				}else{
				echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
				echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
					echo '<span class="unfoll'.$ppls['User']['id'].'" >' ?><?php echo __('Following'); echo '</span>';
				echo '</button>';
				echo "</span>";
				}				
				echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
			}
			?>
			</div>
			<!--<a href="#" class="follow-user-link" uid="" >Follow</a>-->
            <span class="things">
             <?php 
               // echo "<pre>";print_r($ppls['Itemfav']);die;
                foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
						$count=0;
						foreach($pho_datas as $key=>$val){
							if(!empty($val) and $count<4){
							if($itemid == $key){
							//echo "<pre>";print_r($val);
								echo "<a href='".SITE_URL."listing/".$itemid."/".$val[0]['Item']['item_title_url']."'   title='".$val[0]['Item']['item_title_url']."' >";
								if(!empty($val)){
									echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$val[0]['Photo'][0]['image_name']."' width='50px' height='50px' /> &nbsp";
							 	}
								echo "</a>";
							}
							$count++;
							}
						}			
					}
					echo ' </span></li>';
                }
               
            
			  }else{
			  	echo '<div style="height:200px">';
			  	echo '<center style="font-size:23px;margin-top:100px;padding:0px 24px 0px 0px;">'?><?php echo __('No body  found');echo '</center>';
			  	echo '<center style="font-size:14px;padding:0px 24px 0px 0px;">'?><?php echo __('Search something related');echo '</center> ';
			  	echo '</div>';
			  
			  }
			  
			 ?>
               
                
        
		</ul>
		<div id="peplesrchload" style="display:none;text-align:center;">
			<!-- <img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif"> -->
		</div>
				
    </div>
    
    
    <?php } ?>	
    		
    		
    		
    		<?php
        if(isset($_REQUEST['picks'])){
        
        ?>
        
    	<div id="content" style="padding: 0px; width: auto; min-width:960px;">
    		<dt class="pickhead"><?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> Picks
        	<br />
       		 <?php echo __('Follow top contributors from topics you’re interested in.');?></dt>
			<div class="result-contents search-result">
			<?php if(!empty($username_val)){ ?>
		    <h3 style='padding:16px 24px 0px 0px; text-align:center;'><b>Search results for <?php echo $username_val; ?></b></h3>
		    <input type="hidden" value="<?php echo $username_val; ?>" id="entered_name">
		 	<?php }else{ ?>   		 	
		    <input type="hidden" value="" id="entered_name">
		    <?php } ?>
		   <div class="select-list">
		   <!--<div class="tab">
		   <a href="" class="current">54 People</a>
		   </div>
		   button class="btns-blue-embo btn-findall">Follow All</button-->
		   <ul class="stream">
	       
            <?php
			if(!empty($people_details)){
				foreach($people_details as $key => $ppls){
				//if(!empty($ppls['Itemfav'])){
					//echo "<pre>";print_r($ppls);
					$user_nam = $ppls['User']['username'];
					$user_nam_url = $ppls['User']['username_url'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 
            echo "<li class='stream-item'  style='padding:0;width: 450px;'>"; 
             echo "<div class='peopleheaders'>"; 
			if(!empty($user_imges)){
				echo " <a href='".SITE_URL."people/".$user_nam_url."'  title='".$user_nam."'   class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}else{
				echo " <a href='".SITE_URL."people/".$user_nam_url."' title='".$user_nam."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}
			echo $this->Html->link($user_first,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'username','title' => $user_nam,'style'=>'position: absolute; top: 10px; left: 55px;'));
			echo $this->Html->link("@".$user_nam_url,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'nick','title' => $user_nam,'style'=>'position: absolute; top: 27px; left: 55px;'));
			?>
			
			<?php
			
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
				echo '<type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
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
			?>
			</div>
			<!--<a href="#" class="follow-user-link" uid="" >Follow</a>-->
            <span class="things">
             <?php 
               // echo "<pre>";print_r($ppls['Itemfav']);die;
                foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
						$count=0;
						foreach($pho_datas as $key=>$val){
							if(!empty($val) and $count<4){
							if($itemid == $key){
							//echo "<pre>";print_r($val);
								echo "<a href='".SITE_URL."listing/".$itemid."/".$val[0]['Item']['item_title_url']."'   title='".$val[0]['Item']['item_title_url']."' >";
								if(!empty($val)){
									echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$val[0]['Photo'][0]['image_name']."' width='50px' height='50px' /> &nbsp";
							 	}
								echo "</a>";
							}
							$count++;
							}
						}			
					}
                
                }
               
            
			  }else{
			  
			  
			  }
			  
			 ?>
               
                
         </span></li>
		</ul>
		<div id="peplesrchload" style="display:none;text-align:center;">
			<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
		</div>		
    </div>
    
    
    <?php } ?>	
    
    
    
    
    
    
    
    
    
    
    
    <?php
        if(isset($_REQUEST['similar'])){
        
        ?>
        
    	<div id="content"  style="height: 100%; overflow: hidden; padding: 0px; width: auto; min-width:960px;">
    		<dt class="pickhead"><?php echo __('Similar Users');?> 
        	<br />
       		 <?php echo __('Find people with similar taste as yourself.');?></dt>
			<div class="result-contents search-result">
			<?php if(!empty($username_val)){ ?>
		    <h3 style='padding:16px 24px 0px 0px; text-align:center;'><b><?php echo __('Search results for');?> <?php echo $username_val; ?></b></h3>
		    <input type="hidden" value="<?php echo $username_val; ?>" id="entered_name">
		 	<?php }else{ ?>   		 	
		    <input type="hidden" value="" id="entered_name">
		    <?php } ?>
		   <div class="select-list">
		   <ul class="stream">
	       
            <?php
           // echo "<pre>";print_r($similaruser_details);die;
            
			if(!empty($similaruser_details)){
				foreach($similaruser_details as $key => $ppls){
				//if(!empty($ppls['Itemfav'])){
					//echo "<pre>";print_r($ppls);
					$user_nam = $ppls['User']['username'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image']; 
					$user_nam_url = $ppls['User']['username_url'];
            echo "<li class='stream-item'  style='padding:0;width: 450px;'>"; 
             echo "<div class='peopleheaders'>"; 
			if(!empty($user_imges)){
				echo " <a href='".SITE_URL."people/".$user_nam_url."'  title='".$user_nam."'   class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}else{
				echo " <a href='".SITE_URL."people/".$user_nam_url."' title='".$user_nam."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='height: 40px; width: 40px; padding: 7px;".$roundProfile."' /></a>";
			}
			echo $this->Html->link($user_first,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'username','title' => $user_nam,'style'=>'position: absolute; top: 10px; left: 55px;'));
			echo $this->Html->link("@".$user_nam_url,array('controller'=>'/','action'=>'/people/'.$user_nam_url), array('class' => 'nick','title' => $user_nam,'style'=>'position: absolute; top: 27px; left: 55px;'));
			?>
			
			<?php
			
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
			?>
			</div>
			<!--<a href="#" class="follow-user-link" uid="" >Follow</a>-->
            <span class="things">
             <?php 
               // echo "<pre>";print_r($ppls['Itemfav']);die;
                foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
						$count=0;
						foreach($allitem_id_img as $key=>$val){
							if(!empty($val) and $count<4){
							if($itemid == $key){
							//echo "<pre>";print_r($val);
								echo "<a href='".SITE_URL."listing/".$itemid."/".$val[0]['Item']['item_title_url']."'   title='".$val[0]['Item']['item_title_url']."' >";
								if(!empty($val)){
									echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$val[0]['Photo'][0]['image_name']."' width='50px' height='50px' /> &nbsp";
							 	}
								echo "</a>";
							}
							$count++;
							}
						}			
					}
                
                }
               
            
			  }else{
			  
			  
			  }
			  
			 ?>
               
                
         </span></li>
		</ul>
		<div id="peplesrchload" style="display:none;text-align:center;">
			<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
		</div>
				
    </div>
    
    
    <?php } ?>	
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
</div>




</div>

<footer id="footer">
		<!-- <a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a> -->
		<hr>
		<ul class="footer-nav">
			<li><a href="<?php //echo SITE_URL.'help'; ?>"><!-- Help --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/contact"><!-- Contact --></a></li>
			<li><a href="<?php //echo SITE_URL.'help'; ?>/terms_service"><!-- Terms --></a></li>
		</ul>
		<!-- / footer-nav -->
	</footer>



	<!-- / container -->
</div>

   
    <?php
        if(!isset($_REQUEST['similar'])){
        
        ?>


<script>

var entered_names = document.getElementById('entered_name').value;
if(entered_names){
var entered_names = entered_names;
}else{
var entered_names = '';
}


var sIndex = 21, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();
	
$(window).scroll(function () {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7) {
  if (isPreviousEventComplete && isDataAvailable) {
    isPreviousEventComplete = false;
    $(".LoaderImage").css("display", "block");

    $.ajax({
      type: "GET",
      url: baseurl+'findusers?startIndex=' + sIndex + '&offset=' + offSet + '&enteredname=' + entered_names + '',
      beforeSend: function () {
			$('#peplesrchload').show();
		},
	  dataType: 'html',
      success: function (result) {
      	$('#infscr-loading').hide();
      	var out = result.toString();
      	if (out != 'false') {
        	$(".stream").append(result);
        }else {        	
            isDataAvailable = false;
		}
        sIndex = sIndex + offSet;
        isPreviousEventComplete = true;
      }
    });

  }
 }
 });
</script>

<?php } ?>


<style>
.searchbtn{
	background: none repeat scroll 0 0 #F2F3F4;
    border-left: 1px solid #DCDCDC;
    color: #665F5F !important;
    cursor: pointer;
    display: block;
    float: right;
    font-size: 15px;
    font-weight: bold;
    padding: 8px 0;
    text-align: center;
    width: 100px;
    line-height: 1.5;
}
.headhone{
    border-bottom: 1px solid #ECEEF4;
    font-size: 27px;
    padding: 24px 38px 14px;
}
</style>
