<?php
if(session_id() == '') {
session_start();
}
$site = $_SESSION['site_url'];
$media = $_SESSION['media_url'];
@$username = @$_SESSION['media_server_username'];
@$password = @$_SESSION['media_server_password']; 
@$hostname = $_SESSION['media_host_name'];

$roundProfile = "border-radius:3px;";
if ($roundProf == 'round') {
	$roundProfile = "border-radius:50px;";
}
	echo "<div class='info-and-appearance'>";
		echo "<div class='content-wrap-inner clear'>";
			echo "<div class='shop-rail has-shop-preview-bt clear'>";
				echo "<br clear='all' />";
				echo $this->Form->Create('User',array('url'=>array('controller'=>'/','action'=>'/manage/profile/'.$name),'id'=>'shopinfoform'));
					echo "<div class='section section-alt'>";
						echo "<div id='forms'> <div class='abt-item'>";
							//echo $this->Form->input('username',array('type'=>'text','label'=>'Your name','id'=>'username','class'=>'inputform','value'=>$name));			
							//echo "<br clear='all' />";
							if(empty($usr_datas['User']['profile_image'])){
								$image_computer = '';
							}else{
								$image_computer = $usr_datas['User']['profile_image'];
							}
				
							echo "<div class='input-group'>";
								echo "<span class='bills' style='width: 121px; float: left;'>"; echo __('Shop'); echo " Banner:</span>";
									echo '<div class="venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'userupload.php?media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="100px" width="160px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;"></iframe>';												
										echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
										//echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeimg($i)'>Remove</a>";
									echo "</div>";
									if(!empty($image_computer)){
									echo "<img id='show_url'  style='float: left;width: 70px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$image_computer."'>";
									}else{
									echo "<img id='show_url'  style='float: left;width: 70px;height:70px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$_SESSION['media_url']."media/avatars/original/usrimg.jpg'>";
									}
							echo "</div>";
							echo "<br clear='all' />";
							
							echo $this->Form->input('city',array('type'=>'text','label'=>'City','id'=>'city','class'=>'inputform','value'=>$usr_datas['User']['location']));
							echo "<br clear='all' />";
							
							echo $this->Form->input('about',array('type'=>'textarea','label'=>'About','id'=>'about','class'=>'inputform','value'=>$usr_datas['User']['about']));
							echo "<span style='margin-left:121px;'>Tell people about yourself</span>";
							echo "<br clear='all' />";
						
						echo "</div>";
					echo "</div></div>";
					echo $this->Form->submit('Submit');
				echo $this->Form->end();
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>
