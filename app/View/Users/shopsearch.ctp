<div class="container">
		<div class="content">
			<div class="aside">
				<div class="navigation">
					<h1>All Categories</h1>
					<?php
						echo "<ul>";
						foreach($prnt_cat_data as $catsd){
							$cat_urls = $catsd['Category']['id'].'~'.$catsd['Category']['category_urlname'];
							echo "<li>";
								echo $this->Html->link($catsd['Category']['category_name'],array('controller'=>'/','action'=>'/browse/'.$cat_urls));
							echo "</li>";					
						}
						echo "</ul>";
					?>
				</div>	
				<div class="updates">
					<h1>Get Updates Daily</h1>
					<div class="subscribe_box">
						<p>Get gift ideas, editors' picks &amp; fresh trends in your inbox. </p>
						<form>
							<input type="text" class="subscribe_field" />
							<input type="button" name="subscribe" value="Subscribe" class="search-btn" style="margin-left:10px;">
						</form>
					</div>
				</div>
				<div class="more-shop">
					<div class="navigation">
						<h1>More Ways to <?php echo __('Shop'); ?></h1>						
						<ul>
							<li><a href="<?php echo SITE_URL; ?>categories/search">Categories</a></li>
							<li><a href="#">Gift Cards</a></li>
							<li><a href="<?php echo SITE_URL; ?>color">Colors</a></li>
							<li><a href="#">Treasury</a></li>
							<li><a href="#"><?php echo __('Shop'); ?> Local</a></li>
							<li><?php echo "<a href='".SITE_URL."search/shops'>";echo __('Shop'); echo __('Search'); ?></a></li>
							<li><?php echo "<a href='".SITE_URL."search/people'>"; echo __('People'); echo __('Search'); ?></a></li>
							<li><a href="#">Prototypes</a></li>
						</ul>
					</div>
				</div>
			</div>
			
				
			
			
			<div class="right_steps">
			<div class="products">
				<div class="featured">
					
						<?php
						///echo $this->Time->format('F jS, Y h:i A', '2011-08-22 11:53:00');
						echo $this->Form->create('shopsrch', array('type'=>'post','url' => array('controller' => '/', 'action' => '/search/shops/')));
					?>
					<input type="text" placeholder="Search shops" value="" class="text" name="search_shop">
					<?php
						echo $this->Form->submit('Search',array('div'=>false));
						echo $this->Form->end();
					?>
				</div>
			
			
				<div class="products-listsw">
					<div class="products-listsw_sub">
					<?php
						if(!empty($shop_details)){
							foreach($shop_details as $itms){
								$itm_id = $itms['Shop']['shop_name'];
								$item_title = $itms['Shop']['shop_title'];
								$user_image_name = $itms['User']['profile_image'];
								
								echo '<div class="featured-list-sub">';
								echo '<div class="titleer">';
									echo $this->Html->link($itms['Shop']['shop_name'],array('controller'=>'/','action'=>'/shop/'.$itms['Shop']['shop_name']));
								echo '</div>';
									 echo '<div class="image-bg">';
									
										echo "<a href='".SITE_URL."shop/".$itm_id."/' alt='".$item_title."'>";
											if(!empty($user_image_name)){
												echo "<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_image_name."' alt='".$item_title."' width='25px' height='25px' />";
										 	}else{
										 		echo "<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' alt='".$item_title."' width='25px' height='25px' />";
										 	}
									echo "</a></div>"; 
									
									$l=0;
									echo '<div class="image-bgd">';
										 foreach($itms['Item'] as $key=>$items_dtls){
										$item_idd = $itms['Item'][$key]['id'];
										$item_ttl = $itms['Item'][$key]['item_title'];
										$l++;
											$count = 0;
											if($l<5){ 
											
											foreach($img_dtls as $img_dtel){
											
											if($img_dtel['Photo']['item_id']==$item_idd and $count<1){
											
												echo "<a href='".SITE_URL."listing/".$item_idd."/".$item_ttl."' alt='".$item_title."'>";
													if(!empty($user_image_name)){
														echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$img_dtel['Photo']['image_name']."' width='50px' height='50px' /> &nbsp";
												 	}else{
												 		echo "<img src='".$_SESSION['media_url']."media/items/thumb70/usrimg.jpg' alt='".$item_title."' width='50px' height='50px' />";
												 	}
											echo "</a>";
												$count++;
												}
												}
											
											}
										}	
										echo '</div>';
									
								echo '</div>';
							}	
						}else{
							echo "<center>No Items Found</center>";
						}
					?>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	</div>
	</div>
				
				<?php
				//if($pagecount > 0){						
				
						//echo "<pre>"; print_r($this->Paginator); die;
						//echo "<pre>"; print_r($this->passedArgs); die;
						$nextPage = $this->Paginator->params->paging['Shop']['nextPage'];
						$prevPage = $this->Paginator->params->paging['Shop']['prevPage'];
						if(!empty($nextPage) || !empty($prevPage)){
							echo "<div id='photopagination' class='pagination' style='float: right; position: relative; right: 200px;'>";
								echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/search/shops/'),$this->passedArgs)));	
								echo $this->Paginator->prev('<<', array('class' => 'pPrevPg'), null);
								echo $this->Paginator->numbers(array('class' => 'numberspages', 'separator' => ''));
								echo $this->Paginator->next('>>', array('class' => 'pNextPg'), null);
							//echo "<pre>";print_r($this->Paginator->params);
											echo "</div>";
						}
				//	}
				?>	
				
				
<style>
.products-listsw{
	clear:both;
	float:left;
	width:576px;
}
.products-listsw_sub{
	clear:both;
	float:left;
	width:576px;
}

.featured-list-sub{
	float:left;
	height:65px;
}

.image-bgd {
  background-color:#FFFFFF;
  border-bottom-left-radius:3px;
  border-bottom-right-radius:3px;
  border-top-left-radius:3px;
  border-top-right-radius:3px;
  float:left;
  height:51px;
  margin-left:6px;
  margin-top:6px;
  width:250px;
}

</style>
