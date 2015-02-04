<body>
	<div id="content" style="box-shadow:none;padding:0;">
	
		<?php echo $this->Session->flash(); 
		echo $this->Session->flash('good');
		echo $this->Session->flash('bad');?>
	
		<?php echo $this->fetch('content'); ?>
	</div>
	<div id="footer-container">
		<span class="website">Markit Social eCommerce</span>
		<span class="poweredby">    
			Powered by <a href="http://www.simplit.co" target="_blank">Simpl!t Co.</a>
		</span>
	</div>
	<script type="text/javascript">
		$(window).scroll(function () {
			if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.09) {
				$('#header').addClass('fixed');
			}
			if ($(window).scrollTop() <= ($(document).height() - $(window).height())*0.09) {
				$('#header').removeClass('fixed');
			}
		});
	</script>
</body>
<?php 
echo "<pre>";print_r($googlecode[0]['Googlecode']['google_code']);
 ?>
