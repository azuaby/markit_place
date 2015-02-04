<div class="recntlyaddedcontainer widgetcontainer">
		<div class="headerborder"></div>
		<?php 
		if ($mostcommentedwidgettype == 'regular'){
			$type = 'widgetimgcont';
		}else{
			$type = 'darkwidgetcont';
		}
		?>
		<div class="recntlyhead widgethead">
			<div class="subhead">Most Commented</div>
			<div class="seemore">
				<a href="<?php echo SITE_URL?>viewmore/commented" title="View More">View More</a>
			</div>
		</div>
		<div class="recntlycnt <?php echo $type; ?>">
			<ul>
			<?php foreach($mostcommentedModel as $mostcommented) { ?>
				<li>
					<a href="<?php echo SITE_URL."listing/".$mostcommented['Item']['id']."/".$mostcommented['Item']['item_title_url']; ?>"
							title="<?php echo $mostcommented['Item']['item_title'];?>">
					<div class="itmcnt">
						<div class="itmimg" style="background: url('<?php echo $_SESSION['media_url'].'media/items/thumb350/'.$mostcommented['Photo'][0]['image_name'];?>') no-repeat scroll 50% center / cover  rgba(0, 0, 0, 0);">
						<p class="itmtitle"><?php echo $mostcommented['Item']['item_title'];?></p>
						</div>
						<div class="itmcaption">
							<p class="itmtitle"><?php echo $mostcommented['Item']['item_title'];?></p>
							<div class="moreinfo">
							<p class="fantacycount"><?php echo $mostcommented['Item']['comment_count']." Comment(s)";?></p>
							<p class="itmprice"><?php echo $_SESSION['currency_symbol'].round($mostcommented['Item']['price'] * $_SESSION['currency_value'], 2);?></p>
							</div>
						</div>
					</div>
					</a>
				</li>
			<?php  } ?>
			</ul>
		</div>
	</div>