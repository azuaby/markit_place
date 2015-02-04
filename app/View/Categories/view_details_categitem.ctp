<?php	
	echo "<div class='container'>";
?>
	<div class="browse-header inner clear" id="feed-new-nav">
		<div class="col col4">
			<div class="clear" id="feed-header-nav">
				<div id="feed-breadcrumb"></div>
			<?php
				$caturls = str_replace('-',' ',$caturl);
				if(empty($ref)){
					echo '<h1><span id="feed-header"><span>';
						echo $this->Html->link($caturls,array('controller'=>'/','action'=>'/browse/'.$ids));
					echo '</span></span></h1>';
				}else{
					echo "<span>";
						echo $this->Html->link($caturls,array('controller'=>'/','action'=>'/browse/'.$ids));
					echo "</span>";
					if(!empty($subctnme)){
						echo '<span class="slash"> / </span>';
						echo "<span>";
							echo $this->Html->link($sprctnme,array('controller'=>'/','action'=>'/browse/'.$ids.'/'.$sprctnme.'?ref=super_sub_cat_titles'));
						echo "</span>";
					}
					echo "<br clear='all' />";
					echo '<h1><span id="feed-header"><span>';
						if(!empty($subctnme)){
							echo $this->Html->link($subctnme,array('controller'=>'/','action'=>'/browse/'.$ids.'/'.$sprctnme.'/'.$subctnme.'?ref=sub_cat_titles'));
						}else{
							echo $this->Html->link($sprctnme,array('controller'=>'/','action'=>'/browse/'.$ids.'/'.$sprctnme.'?ref=super_sub_cat_titles'));
						}
					echo '</span></span></h1>';
				}
				
			?>	
			</div>
	  
			<div class="browse-share">
			<!--  
				<ul class="share-tools">
					<li class="share2-vert twitter">
							
				
					<a target="_blank" href="/share?network=_twitter&amp;url=http%3A%2F%2Fwww.etsy.com%2Fbrowse%2Fkids-category%3Futm_source%3DTwitter%26utm_medium%3DPageTools%26utm_campaign%3DShare&amp;title=Kids+-+Etsy" class="etsy-tweet"><span class="twitter-icon"></span><span class="label">Tweet</span></a>
					</li>

					<li class="share2-vert last">
							
				  
					<fb:like ref="like_button" show_faces="false" layout="button_count" scrolling="no" height="25" data-width="120" href="http://www.etsy.com/browse/kids-category" id="share1-fb-like"></fb:like>
					<script type="text/javascript">
						Etsy.loader.require('common/etsy.facebook.20130403195227', function() {
							var log = function(button_name) {
								return function() {
									var loggerArgs = {
										'php_event_name': 'share_facebook',
										'source': 'browse',
										'button_name': button_name
									};
									if ("http://www.etsy.com/browse/kids-category".length &gt; 0){
										loggerArgs['post_to_page'] = 'http://www.etsy.com/browse/kids-category';
									}
									Etsy.EventLogger.logEvent(loggerArgs);
								};
							};

							Etsy.Facebook.load(function(success){
												Etsy.Facebook.eventSubscribe('edge.create', log('like'));
									Etsy.Facebook.eventSubscribe('message.send', log('send'));
								
								
																Etsy.Facebook.eventSubscribe('xfbml.render', function() {
										var fbif = $('#share2-fb-like iframe.fb_ltr');
										fbif.height(25);
									});
										});

						});
					</script>        </li>
						</ul>
				-->
			</div>            
		</div>	
		<?php
			$subcatnmes = array();
			if(!empty($super_cat_datas)){
			// echo "<pre>";print_r($super_cat_datas);
				if(empty($ref)){
					foreach($super_cat_datas as $subs){
						//echo "<pre>";print_R($subs);
						$subcatnmes[$subs['Category']['id']] = $subs['Category']['category_urlname'];
						$catnmes[$subs['Category']['id']] = $subs['Category']['category_name'];
					}
				}else{	
					foreach($super_cat_datas as $subs){
						$subcatnmes[$subs['id']] = $subs['category_urlname'];
						$catnmes[$subs['id']] = $subs['category_name'];
					}
				}	
			}
			echo "<div class='browse-nav'>";
				if(!empty($catdatas)){
					echo '<ul class="col col2 nav-col nav-col1">';
						foreach($catdatas as $tpcats){
							if(!empty($sprctnme)){
								$caturlnames = $tpcats['Category']['category_urlname'];
								$catnmess = $tpcats['Category']['category_name'];
								$rdct_url = 'browse/'.$ids.'/'.$sprctnme.'/'.$caturlnames.'?ref=sub_cat_titles';
							
							}else{
								$caturlnames = $tpcats['Category']['category_urlname'];
								$catnmess = $tpcats['Category']['category_name'];
								$rdct_url = 'browse/'.$ids.'/'.$caturlnames.'?ref=super_sub_cat_titles';
							}
							echo "<li>";								
								echo $this->Html->link($tpcats['Category']['category_name'],array('controller'=>'/','action'=>$rdct_url));
							echo "</li>";
						}
					echo "</ul>";
				}	
			echo "</div>";
		?>
			
	</div>
	<div class="content content-wraps">
		<div class="cntr_outer">
			<div id="containerdivcntnt" class="clearfix">
				<?php
					if(!empty($item_datas)){
						
						if(empty($ref)){
							echo "<ul>";
								foreach($item_datas as $itemss){
									if(!empty($subcatnmes[$itemss['Item']['sub_catid']])){
										$catnmess = $catnmes[$itemss['Item']['sub_catid']];
									}else if(!empty($subcatnmes[$itemss['Item']['super_catid']])){
										$catnmess = $catnmes[$itemss['Item']['super_catid']];
									}else{
										$catnmess = $catnmes[$itemss['Item']['category_id']];
									}
									
									if(!empty($subcatnmes[$itemss['Item']['super_catid']])){
										$caturlnames = $subcatnmes[$itemss['Item']['super_catid']];
										$catnmess = $catnmes[$itemss['Item']['super_catid']];
										$rdct_url = 'browse/'.$ids.'/'.$caturlnames.'?ref=super_sub_cat_titles';
									}else{
										$caturlnames = $subcatnmes[$itemss['Item']['category_id']];
										$catnmess = $catnmes[$itemss['Item']['category_id']];
										$rdct_url = 'listings/'.$ids;
									}
									echo '<li class="box photo col3">';
										echo "<div class='poster-outer'>";
											echo '<div class="poster-inner">';
												echo '<a href="'.SITE_URL.$rdct_url.'" title="'.$itemss['Item']['item_title'].'">';
													echo '<img src="'.$_SESSION['media_url'].'media/items/thumb350/'.$itemss['Photo'][0]['image_name'].'" alt="'.$itemss['Item']['item_title'].'" />';
												echo '</a>';
												if(empty($itemss['Shop']['shop_name'])){
													echo '<a class="credit" href="'.SITE_URL.$rdct_url.'">'.$itemss['User']['username'].'</a>';
												}else{
													echo '<a class="credit" href="'.SITE_URL.$rdct_url.'">'.$itemss['Shop']['shop_name'].'</a>';
												}
											echo "</div>";
											echo '<div class="poster-title">';
												echo '<a title="'.$catnmess.'" href="'.SITE_URL.$rdct_url.'">';
													echo $catnmess;
													echo '<span class="rsquo"> >></span>';
												echo '</a>';
											echo "</div>";
										echo "</div>";
									echo '</li>';
								}
							echo "</ul>";
						}else{
							foreach($item_datas as $key=>$itemss){
								$id = $itemss['Item']['id'];
								$item_title = $itemss['Item']['item_title'];
								$item_title_url = $itemss['Item']['item_title_url'];
								$price = round($itemss['Item']['price'] * $_SESSION['currency_value'], 2);
								$imgnme = $itemss['Photo'][0]['image_name'];
								$imagePath = $_SESSION['media_url'].'media/items/thumb350/'.$imgnme;

								//list($oldWidth, $height, $type, $attr) = getimagesize($imagePath); 
								//echo $height;die;
								echo '<div class="box photo col3">';
									echo '<div class="listing-wrap">';
										echo '<div id="'.$id.'" class="listing item listing-card">';
											echo '<a title="'.$item_title.'" href="'.SITE_URL.'listing/'.$id.'/'.$item_title_url.'" class="image-wrap listing-overlay-trigger">';
													echo '<img src="'.$imagePath.'">';
											echo '</a>';
											echo '<div class="listing-hover">';
												echo '<div class="listing-giftcard-icon hidden"></div>';
												echo '<div class="title">';
													echo $this->Html->link($item_title,array('controller'=>'/','action'=>'/listing/'.$id.'/'.$item_title_url),array('title'=>$item_title));
												echo '</div>';
												echo '<span class="listing-price">'.$_SESSION['currency_symbol'].$price.'<span class="currency-code"> '.$_SESSION['currency_code'].'</span></span>';
												if(empty($itemss['Shop']['shop_name'])){
													echo '<span class="shopname">'.$this->Html->link($itemss['User']['username'],array('controller'=>'/','action'=>'shop/'.$itemss['User']['username'].'?ref=br_shop_'.($key+1))).'</span>';
												}else{
													echo '<span class="shopname">'.$this->Html->link($itemss['Shop']['shop_name'],array('controller'=>'/','action'=>'shop/'.$itemss['Shop']['shop_name'].'?ref=br_shop_'.($key+1))).'</span>';
												}
											echo '</div>';
											echo '<div data-downtime-overlay-type="favorite" data-href="/homepage/listing/122614810/heart/" title="Add item to favorites" class="button-favorite  inline-overlay-trigger casanova-action ">&nbsp;</div> ';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}						
					}					
				?>
			</div> <!-- #container -->
		</div> 
	</div> 
	<?php
	echo "</div>";
?>

<script>
  $(function(){

    var $container = $('#containerdivcntnt');
  
    $container.imagesLoaded( function(){
      $container.masonry({
        itemSelector : '.box'
      });
    });
  
  });
</script>
