<div class="topsellercontainer widgetcontainer">
		<div class="headerborder"></div>
		<div class="topsellerhead widgethead">
			<div class="subhead">Top Sellers</div>
		</div>
		<div class="topsellercnt widgetimgcont">
			<ul>
			<?php foreach ($shopsdet as $shopdata){
					$username_url = $shopdata['username_url'];
					$username = $shopdata['username'];
					$username_url_ori = $shopdata['username_url_ori'];
			?>
				<li>
					<div class="catcnt">
						<div class="cattitle">
							<?php echo $username;?>
						</div>
						<div class="catitm">
						<?php foreach($shopdata['itemModel'] as $itemModel) {
							//echo '<img src="'.$_SESSION['media_url'].'media/items/thumb350/'.$itemModel['Photo'][0]['image_name'].'"/>';
							?>
							<a href="<?php echo SITE_URL."listing/".$itemModel['Item']['id']."/".$itemModel['Item']['item_title_url']; ?>"
							title="<?php echo $itemModel['Item']['item_title'];?>">
							<div class="itm" style="background: url('<?php echo $_SESSION['media_url'].'media/items/thumb150/'.$itemModel['Photo'][0]['image_name'];?>') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);">
							</div>
							</a>
						<?php } ?>
						</div>
						<div class="catcapt">
							<a href="<?php echo SITE_URL."people/".$username_url_ori."?added"; ?>" >
								View More
							</a>
							<p class="prodctcnt">
								<?php echo $shopdata['item_count'];?> Products
							</p>
						</div>
					</div>
				</li>
			<?php }?>
			</ul>
		</div>
	</div>