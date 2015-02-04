<body class="fantacygrid">
 

	
	
	
	
	
		
		
		
		<div id="content" style="box-shadow:none;">
		<div id="flashmsg">
			<?php echo $this->Session->flash(); 
			echo $this->Session->flash('good');
			echo $this->Session->flash('bad');?>
		</div>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="backtotop"><?php echo __('Scroll to Top'); ?></div>
	<?php //echo $this->element('sql_dump'); ?>
	
	
	<script>
	var	url_status=true;
	var item_save = true;
	var pushnoii = true;
	var cartnoii = true;
	</script>
	
	
	<!--Start of Zopim Live Chat Script
	<!--script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?1S5DrbCtlRSufVcPziI3FA3qLdYM6UqT';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script-->
	<!--End of Zopim Live Chat Script-->
	
	
	<div id="footer-container">
		<span class="website">
			<?php echo __('Powered by'); ?> <a href="http://simplit.co" target="_blank">Simplit Services Co.</a>
		</span>
		<span class="poweredby">
			Markit Beta - Social Ecommerce (<?php echo date('mdy',time()); ?>)
		</span>
	</div>
	
</body>
<?php 
echo "<pre>";print_r($googlecode[0]['Googlecode']['google_code']);
 ?>

