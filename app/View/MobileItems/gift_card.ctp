<?php	
	echo "<div class='container'>";
		echo '<div class="content">';
			echo '<div class="content-wrap-inner">';
				echo "</div class='row clear'>";
					echo "<div class='primary'>";
				?>	
					
					<div id="item-main">
						<div id="fullimage_link1"><a  class="overlay-nonmodal-trigger popup" target="_blank" href="#	">
							<img width="570" alt="<?php echo "Gift card";?>" src="<?php echo SITE_URL.'photos/original/giftcard.jpg';?>">
						</a></div>
						<div class="sml_imgs">
							<?php
								if(!empty($item_datas['Photo'][1])){
									foreach($item_datas['Photo'] as $phts){
										//echo "<pre>";print_r($phts);
										echo '<a class="smlght" rel="lightbox" href="'. SITE_URL.'photos/original/'.$phts['image_name'].'">';
											echo '<img width="70" height="70" alt="'.$item_datas['Item']['item_title'].'" src="'. SITE_URL.'photos/thumb70/'.$phts['image_name'].'">';
										echo '</a>';	
										
									}
								}	
								
							?>
						</div>
					</div>
					
					
					<div id="item-description">
						<div class="section-content ">
						  	<?php
								echo '<a href="'. SITE_URL.'giftcard/" data-convo_source="listing_convo_from_desc" >Gift Card. </a>';
							 ?>
						</div>
					</div>
					
					
				<?php	
					echo "</div>";
					echo "<div class='secondary'>";
					?>
						<?php 	echo $this->Form->create('giftcard',array('url'=>array('controller'=>'/','action'=>'/giftcard'))); ?>

						    <?php
						  
						    	echo $this->Form->input('Value', array('options' => array(1,2,3,4,5)));
						        echo $this->Form->input('Recipient name',array('limit'=>10));   //text
						        echo $this->Form->input('Recipient e-mail');   //text
						        //echo $this->Form->input('Recipient e-mail');   //day, month, year, hour, minute, meridian
						        echo $this->Form->input('Personal message');      //textarea
						    ?>
						
						<?php echo $this->Form->end('Add to cart'); 
							
					
					
					
					
					
					
					
					
					
				echo "</div>";
			echo '</div>';
		echo '</div>';
	echo "</div>";
	
?>
