<?php 
if(session_id() == '') {
	session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = $_SESSION['media_server_username'];
@$password = $_SESSION['media_server_password'];
@$hostname = $_SESSION['media_host_name'];
?>
<body class=""> 
  <!--<![endif]-->
     
   
   
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Gift Card</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li class="active">Gift Card</li>
			        </ul>
				</div>
			</div>

  		<!-----Gift Card------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Gift Card</h2>
						
					</div>
					<div class="box-content">

	 <?php 
   echo $this->Form->Create('Item',array('url'=>array('controller'=>'admins','action'=>'/giftcard/'),'onsubmit'=>'return ccc()'));
   
   ?>          
             
                  <div class="form_grid_12">
                    <label class="field_title" for="title">Title <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="title" value="<?php echo $giftDetails['title']; ?>" id="title" type="text" tabindex="1" class="required large tipTop" title="Please enter the title"/>
                    </div>
                  </div>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description <span class="req">*</span></label>
                    <div class="form_input">
                      <textarea name="description" id="description"  tabindex="2" style="width:370px;" class="required small tipTop" title="Please enter the description"><?php echo $giftDetails['description']; ?></textarea>
                    </div>
                  </div>
                  <label class="field_title" for="gift_image">Image</label>
                  <?php 
                  $i=1;
        	echo "<div class='img_upld'>";
        	if(!empty($giftDetails['image'])){
        		$image = $giftDetails['image'];
        		echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".SITE_URL.'media/items/thumb150/'.$image."'>";
        	}else{
        		$image='';
        		echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'>";
        	}
        	
        	echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'"  frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';
        	echo "<input type='hidden' id='image_computer_$i' class= 'celeb_name' value='$image' name='data[image]'>";
        	echo '<a href="javascript:void(0);" id="removeimg_'.$i.'" class="remove-btns" onclick="removeimg('.$i.')" style="display:none;"><i class="icon-trash"></i></a>';
        	echo "</div>";
        	echo "</div>";
        
                  
                  ?>
                  <br clear="all" />
                  
                  
                  <!--  div class="form_grid_12">
                    <label class="field_title" for="gift_image">Image</label>
                    <div class="form_input">
                      <input name="gift_image" id="gift_image" type="file" tabindex="5" class="large tipTop" title="Please select the giftcard image"/>
                    </div>
                    <div class="form_input"><img src="http://pleasureriver.com/images/giftcards/d342fa6bce0de522e7ae8f3ab672a279.png" width="100px"/></div>
                  </div-->
                  <div class="form_grid_12">
                    <label class="field_title" for="amounts">Amounts<span class="req">*</span></label>
                    <div class="form_input">
                      
                      <textarea name="amounts" id="tags_Amt"  tabindex="2" style="width:370px;" class="required tags tipTop" title="Please enter the Amount"><?php echo $giftDetails['amounts']; ?></textarea>
                   
                      <span class=" label_intro">Example : 10,20,30</span>
                    </div>
                  </div>
                  <!-- div class="form_grid_12">
                    <label class="field_title" for="default_amount">Default Amount<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="default_amount" id="default_amount" type="text" value="100" tabindex="7" class="required large tipTop" title="Please enter the default amount"/>
                    </div>
                  </div-->
                  <div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn btn-primary" tabindex="15"><span>Submit</span></button>
				</div>
			</div>
                  </div>
          
			</div>
			
		<?php
		echo $this->Form->end();
		?>		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Gift Card------->	
  		
  



