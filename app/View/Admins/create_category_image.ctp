<body class=""> 
  <!--<![endif]-->
     
   
   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Category Image</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/view/category'; ?>">Category</a> <span class="divider">/</span></li>
            <li class="active">Add Category Image</li>
        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Add Category Image</h2>
					</div>
					
						
				
					<div class="box-content">   
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
<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Category_image',array('url'=>array('controller'=>'/','action'=>'/admin/add/category_image'),'id'=>'Categoryform'));
			if(!empty($mainsec)){
				foreach($mainsec as $main_sec){ 
					$options2[$main_sec['Category']['id']] =  $main_sec['Category']['category_name'];
				}
			}else{
				$options2 = '';
			}
			echo $this->Form->input('categories', array('options' => $options2,'empty' => '-- Select Main Category --','id'=>'mainsec','class'=>'inputform catchnge','onchange'=>'cat_img(this.value)'));
			
			
			echo '<label> Campaign Image </label>';
			
			echo "<div id='divview1' style='display:none;width:100%;float:left'>";
			$i = 100;
			echo "<div class='img_upld' style='float:left;width:120px'>";
			echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'>";
			echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 5px;position: relative;"></iframe>';
			echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
			echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn btn_blue' style='display: none; margin-bottoom: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
			echo "</div>";
			echo "</div>";
			echo "</div> ";
			
			echo "<div id='forms' style='width:100%;float:left'>";
			$i = 1000;
			echo "<div class='img_upld' style='float:left;width:120px'>";
			echo "<img id='show_url_".$i."'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image'>";
			echo '<div class="venueimg"><iframe class="image_iframe" id="frame_'.$i.'" name="frame'.$i.'" src="'.$this->webroot.'imageupload.php?image='.$i.'&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 5px;position: relative;"></iframe>';
			echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_'.$i, 'class'=> 'fullwidth','class'=>'celeb_name','value'=>'','name'=>'data[image][]'));
			echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn btn_blue' style='display: none; margin-bottoom: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
			echo "</div>";
			echo "</div>";
			echo "</div> ";
			
			echo '<span id="campimage_err" style="font-size:14px;color:red;"></span>';
			//echo "<a href='javascript:void(0);' onclick='addform();' class='show_hid'>Add another Sub category</a>";
			//echo "<a href='javascript:void(0);' onclick='deleteform()' style='display:none;' class='deletfrm'>Delete</a>";
			echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-success reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>


</div>

</div>

</div>



<style>
	
.show_hid{
	display:none;
}
</style>
