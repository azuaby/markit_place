<?php 
$widgets = explode('(,)',$homepageModel['Homepagesettings']['widgets']);
$sliders = json_decode($homepageModel['Homepagesettings']['slider'], true);
$sliderProperty = json_decode($homepageModel['Homepagesettings']['properties'], true);
$sliderstyle = "style='height:".$sliderProperty['sliderheight'].";background-color:".$sliderProperty['sliderbg'].";'";
?>
<div class="submenucontainer" style="margin-top: -16px;">
	<ul>
		<?php
			foreach($parent_categori as $cate){
				echo '<li><a href="'.SITE_URL.'shop/'.$cate['Category']['category_urlname'].'">'; echo __($cate['Category']['category_name']); echo '</a></li>';
			}
		?>
		<!-- <li>WOMEN</li>
		<li>MEN</li>
		<li>BABY & FOOD</li>
		<li>ACCESSORIES</li>
		<li>DIGITAL</li>
		<li>LIVING & AUTOS</li>
		<li>BOOKS & MUSIC</li>
		<li>OTHERS</li>
		<li>RECOMMENDED SHOP</li>
		<li>QCLUB</li> -->
	</ul>
</div>
<div class="slidercontainer theme-default">
        <div id="slider" class="nivoSlider" <?php echo $sliderstyle; ?>>
        <?php foreach ($sliders as $skey => $slider){
        		if (!empty($slider['link'])){
        	?>
           <a href="<?php echo $slider['link']; ?>">
               <img src="<?php echo SITE_URL."images/slider/".$slider['image']; ?>" data-thumb="<?php echo SITE_URL."images/slider/".$slider['image']; ?>" alt="" data-transition="<?php echo $slider['effect']; ?>"/>
           </a>
           <?php }else { ?>
           <img src="<?php echo SITE_URL."images/slider/".$slider['image']; ?>" data-thumb="<?php echo SITE_URL."images/slider/".$slider['image']; ?>" alt="" data-transition="<?php echo $slider['effect']; ?>" />
           <?php } ?>
        <?php } ?>
        </div>
</div>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>
<?php foreach ($widgets as $widget){
	switch ($widget){
		case 'Recently Added':
			echo $this->element('recentlyadded');
			break;
		case 'Most Popular':
			echo $this->element('mostpopular');
			break;
		case 'Most Commented':
			echo $this->element('mostcommented');
			break;
		case 'Top Stores':
			echo $this->element('topstores');
			break;
		case 'Most Popular Categories':
			echo $this->element('popularcategory');
			break;
		case 'Featured Items':
			echo $this->element('featured');
			break;
	}
} ?>
