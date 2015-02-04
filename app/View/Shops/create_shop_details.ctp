<?php
	echo "<div class='info-and-appearance'>";
		echo "<div class='content-wrap-inner clear'>";
			echo "<div class='shop-rail has-shop-preview-bt clear'>";
				echo "<br clear='all' />";
				echo $this->Form->Create('Shop',array('url'=>array('controller'=>'/','action'=>'/your-shop-details/'.$name),'id'=>'shopinfoform'));
					echo "<div class='section section-alt'>";
						echo "<div id='forms'> <div class='abt-shop'>";
							echo $this->Form->input('shop_title',array('type'=>'text','label'=>'Shop Title','id'=>'shop_title','class'=>'inputform','value'=>$shopdats['Shop']['shop_title']));			
							echo "<br clear='all' />";
							if(empty($shopdats['Shop']['shop_banner'])){
								$image_computer = '';
							}else{
								$image_computer = $shopdats['Shop']['shop_banner'];
							}
				
							echo "<div class='input-group'>";
								echo "<span class='bills' style='width: 121px; float: left;'>Shop Banner:</span><br clear='all' />";
									echo '<div class="venueimg-shop venueimg"><iframe class="image_iframe" id="frame" name="frame" src="'.$this->webroot.'upload.php" frameborder="0" height="50px" width="760px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 0px;position: relative;"></iframe>';												
										echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$image_computer,'name'=>'image'));
										//echo "<a href='javascript:void(0);' id='removeimg_".$i."' class='btn' style='display: none; margin-top: 5px; float: left;' onclick='removeimg(".$i.")'>Remove</a>";
									echo "</div>";
									if(!empty($image_computer)){
									echo "<img id='show_url'  style='float: left;width: 760px;height:100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$media_url."shopsimg/thumb760/".$image_computer."'>";
									}else{
									echo "<img id='show_url'  style='float: left;width: 760px;height:100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src=''>";
									}
							echo "</div>";
							echo "<br clear='all' />";
							
							echo $this->Form->input('shop_announcement',array('type'=>'textarea','label'=>'Shop Announcement','id'=>'shop_announcement','class'=>'inputform','value'=>$shopdats['Shop']['shop_announcement']));			
							echo "<br clear='all' />";
							
							echo $this->Form->input('shop_message',array('type'=>'textarea','label'=>'Message to Buyers','id'=>'shop_message','class'=>'inputform','value'=>$shopdats['Shop']['shop_message']));			
							echo "<br clear='all' />";
						
						echo "</div>";
					echo "</div> </div>";
					echo $this->Form->submit('Submit');
				echo $this->Form->end();
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>
