<div class="recntlyaddedcontainer widgetcontainer">
		<div class="headerborder"></div>
		<?php 
		if ($featuredwidgettype == 'regular'){
			$type = 'widgetimgcont';
		}else{
			$type = 'darkwidgetcont';
		}
		?>
		<div class="recntlyhead widgethead">
			<div class="subhead">Featured</div>
			<div class="seemore">
				<a href="<?php echo SITE_URL?>viewmore/featured" title="View More">View More</a>
			</div>
		</div>
		<div class="recntlycnt <?php echo $type; ?>">
			<ul>
				<?php foreach ($featuredModel as $recentlyadded) {?>
				<li>
					<a href="<?php echo SITE_URL."listing/".$recentlyadded['Item']['id']."/".$recentlyadded['Item']['item_title_url']; ?>"
							title="<?php echo $recentlyadded['Item']['item_title'];?>">
					<div class="itmcnt">
						<div class="itmimg" style="background: url('<?php echo $_SESSION['media_url'].'media/items/thumb350/'.$recentlyadded['Photo'][0]['image_name'];?>') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);">
						<p class="itmtitle"><?php echo $recentlyadded['Item']['item_title'];?></p>
						</div>
						<div class="itmcaption">
							<p class="itmtitle"><?php echo $recentlyadded['Item']['item_title'];?></p>
							<div class="moreinfo">
							<p class="fantacycount"><?php echo $recentlyadded['Item']['fav_count']." ".$setngs[0]['Sitesetting']['liked_btn_cmnt'];?></p>
							<p class="itmprice"><?php echo $_SESSION['currency_symbol'].round($recentlyadded['Item']['price'] * $_SESSION['currency_value'], 2);?></p>
							</div>
						</div>
					</div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
