<?php
	echo "<div class='container'>";
		echo "<div class='content content-wrap-inner clear'>";
			
			?>
			<div class='tg_mtrl_div'>
				<div class='tag_hedng'>
					<?php if($ref == 'sel_tags'){ ?>
					<h4>Items for Tags <span style="color:#18B5E2;"><?php echo str_replace('_',' ',$name); ?></span></h4>
					<?php }else{ ?>
					<h4>Items for Materials <span style="color:#18B5E2;"><?php echo str_replace('_',' ',$name); ?></span></h4>
					<?php } ?>
				</div>
				<br clear="all" /><br />
				<div id="listing-wrapper" class="clear">
					<?php if(!empty($item_datas)){ ?>
						<ul class="clear listings">
							<?php
							foreach($item_datas as $ky=>$itemsd){
							?>
								<li class="listing-card" id="lid<?php echo $itemsd['Item']['id']; ?>">    
									<a title="<?php echo $itemsd['Item']['item_title']; ?>" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active" class="listing-thumb">
										<img width="170" height="135" alt="<?php echo $itemsd['Item']['item_title']; ?>" src="<?php echo $_SESSION['media_url'];?>media/items/thumb150/<?php echo $itemsd['Photo'][0]['image_name']; ?>">
									</a>					
									<div class="listing-detail ">
										<div class="listing-title">
											<div class="listing-giftcard-icon hidden"></div>							
												<a title="<?php echo $itemsd['Item']['item_title']; ?>" class="title" href="<?php echo SITE_URL;?>listing/<?php echo $itemsd['Item']['id']; ?>/<?php echo $itemsd['Item']['item_title_url']; ?>?ref=shop_home_active">
													<?php echo $itemsd['Item']['item_title']; ?>
												</a>
												<div class="listing-maker">
													<?php
													if(!empty($itemsd['Shop']['shop_name'])){
														$shpnme = $itemsd['Shop']['shop_name']; 
														$shpnme_url = $itemsd['Shop']['shop_name']; 
													}else{
														$shpnme = $itemsd['User']['username']; 
														$shpnme_url = $itemsd['User']['username_url']; 
													}
													echo $this->Html->link($shpnme,array('controller'=>'/','action'=>'/shops/'.$shpnme_url));
													?>
												</div>
											</div>
											<div class="listing-price">
												<span class="currency-symbol">$</span><span class="currency-value"><?php echo $itemsd['Item']['price'];?></span> <span class="currency-code">USD</span>
											</div>
										</div>
										<div class="hide-link">
											<!--<a href="https://www.etsy.com/signin?from_page=http%3A%2F%2Fwww.etsy.com%2Fshop%2Fjeremymiranda%3Fref%3Dseller_info" title="Add item to favourites" data-downtime-overlay-type="favorite" class="button-favorite listing-favorite inline-overlay-trigger casanova-action"><span>favourite</span></a>-->
										</div>
									</div>
								</li>
							<?php
							}
							?>	
						</ul>
					<?php
					}else{
						echo "<br clear='all' /><br clear='all' /><br clear='all' /><br /><br />";
						echo "<div class='not_found_cls'>";
							echo "<center><h3>No items found for your search</h3></center>";
						echo "</div>";
					}
					?>
				</div>
			</div>
<?php		
		echo "</div>";
	echo "</div>";
	
	if(!empty($loguser)){
		echo "<input type='hidden' id='loguserid' value='".$loguser[0]['User']['id']."' />";
	}else{
		echo "<input type='hidden' id='loguserid' value='0' />";
	}
	
?>

<div id="fade"></div>


<script>
	$(document).ready(function() {
  
		// Here we will write a function when link click under class popup      
		$('a.popup').click(function() {
		  
		  
			// Here we will describe a variable popupid which gets the
			// rel attribute from the clicked link      
			var popupid = $(this).attr('rel');
			  
			  
			// Now we need to popup the marked which belongs to the rel attribute
			// Suppose the rel attribute of click link is popuprel then here in below code
			// #popuprel will fadein
			$('#' + popupid).show();
			  
			  
			// append div with id fade into the bottom of body tag
			// and we allready styled it in our step 2 : CSS
			$('body').append('<div id="fade"></div>');
			$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
			  
			  
			// Now here we need to have our popup box in center of
			// webpage when its fadein. so we add 10px to height and width
			var popuptopmargin = ($('#' + popupid).height() + 10) / 2;
			var popupleftmargin = ($('#' + popupid).width() + 10) / 2;
			  
		  
		// Then using .css function style our popup box for center allignment
			$('#' + popupid).css({
				'margin-top' : -popuptopmargin,
				'margin-left' : -popupleftmargin
			});
		});
	});

</script>