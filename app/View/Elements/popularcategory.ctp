<div class="topsellercontainer widgetcontainer">
		<div class="headerborder"></div>
		<div class="topsellerhead widgethead">
			<div class="subhead">Most Popular Categories</div>
		</div>
		<div class="poplrcatcnt widgetimgcont">
			<ul>
			<?php foreach($popcatarr as $popcat){?>
				<li>
					<div class="catcnt">
						<div class="cattitle">
							<?php echo $popcat['catname'];?>
						</div>
						<div class="catitm">
						<?php foreach($popcat['catitemModel'] as $itemModel) {
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
							<a href="<?php echo SITE_URL."shop/".$popcat['catnameurl']; ?>" >
								View More
							</a>
							<p class="prodctcnt">
								<?php echo $popcat['catcount'];?> Products
							</p>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>