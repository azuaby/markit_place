

<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */




$cakeDescription = __d('cake_dev', $setngs[0]['Sitesetting']['site_name']);
$userid = $loguser[0]['User']['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8" />
	
	<meta name="description" content="" />
	
	<meta name="keyword" content="" />
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- end: Mobile Specific -->
	
		<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
	


	<title>
		
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
		<?php echo $username ?>
	</title>

	<?php $MOB_URL = "http://localhost/fantacy/mobile/"; ?>
	<?php
	
	
	$params=$this->params;
		$controller=$params['controller'];
		$action=$params['action'];
	
	echo $this->Html->meta('icon');


		
	

	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('bootstrap-responsive.min');
	echo $this->Html->css('style.min');
	echo $this->Html->css('style-responsive.min');
	echo $this->Html->css('retina');
	
	//echo $this->Html->script('jquery.min');
	//echo $this->Html->script('mobileanekart');
		
				
		echo $this->Html->script('adminjs/jquery-1.10.2.min');
        echo $this->Html->script('adminjs/jquery-migrate-1.2.1.min.js');	
		echo $this->Html->script('adminjs/jquery-ui-1.10.3.custom.min.js');	
		echo $this->Html->script('adminjs/jquery.ui.touch-punch.js');	
		echo $this->Html->script('adminjs/modernizr.js');	
		echo $this->Html->script('adminjs/bootstrap.min.js');	
		echo $this->Html->script('adminjs/jquery.cookie.js');	
		echo $this->Html->script('adminjs/fullcalendar.min.js');
		echo $this->Html->script('adminjs/jquery.dataTables.min.js');
		echo $this->Html->script('adminjs/excanvas.js');
		echo $this->Html->script('adminjs/jquery.flot.js');
		echo $this->Html->script('adminjs/jquery.flot.pie.js');
		echo $this->Html->script('adminjs/jquery.flot.stack.js');
		echo $this->Html->script('adminjs/jquery.flot.resize.min.js');
		echo $this->Html->script('adminjs/jquery.flot.time.js');		
		echo $this->Html->script('adminjs/jquery.chosen.min.js');	
		echo $this->Html->script('adminjs/jquery.uniform.min.js');		
		echo $this->Html->script('adminjs/jquery.cleditor.min.js');	
		echo $this->Html->script('adminjs/jquery.noty.js');	
		echo $this->Html->script('adminjs/jquery.elfinder.min.js');	
		echo $this->Html->script('adminjs/jquery.raty.min.js');	
		echo $this->Html->script('adminjs/jquery.iphone.toggle.js');	
		echo $this->Html->script('adminjs/jquery.uploadify-3.1.min.js');	
		echo $this->Html->script('adminjs/jquery.gritter.min.js');	
		echo $this->Html->script('adminjs/jquery.imagesloaded.js');	
		echo $this->Html->script('adminjs/jquery.masonry.min.js');	
		echo $this->Html->script('adminjs/jquery.knob.modified.js');	
		echo $this->Html->script('adminjs/jquery.sparkline.min.js');	
		echo $this->Html->script('adminjs/counter.min.js');	
		echo $this->Html->script('adminjs/raphael.2.1.0.min.js');
		echo $this->Html->script('adminjs/justgage.1.0.1.min.js');	
		echo $this->Html->script('adminjs/jquery.autosize.min.js');	
		echo $this->Html->script('adminjs/retina.js');
		echo $this->Html->script('adminjs/jquery.placeholder.min.js');
		echo $this->Html->script('adminjs/wizard.min.js');
		echo $this->Html->script('adminjs/core.min.js');	
		echo $this->Html->script('adminjs/charts.min.js');	
		echo $this->Html->script('adminjs/custom.min.js');
		
		echo $this->Html->script('jquery.tablesorter');
		echo $this->Html->script('anekart');
	
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');

	
	?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.message
{
	background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #468847;
    margin-bottom:10px;
}
#content
{
min-height:759px !important;
}
.dropmenu
{
	font-weight:bold !important;
	font-size:13px;
}
</style>
</head>

<body>

		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a id="main-menu-toggle" class="hidden-phone open" style=""><i class="icon-reorder"></i></a>		
				<div class="row-fluid">
				<a class="brand span2" href="<?php echo SITE_URL; ?>" style=""><span><?php echo $setngs[0]['Sitesetting']['site_name']; ?></span></a>
				</div>		
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">	
	
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
								<div class="avatar"><i class="icon-user"></i></div>
								<div class="user">
									<span class="hello">Admin</span>
								</div>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
									
								</li>
								<li><a href="<?php echo SITE_URL.'addadminsettings'; ?>"><i class="icon-cog"></i> Settings</a></li>
								<li><a href="<?php echo SITE_URL.'logout'; ?>"><i class="icon-off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php echo $this->element("mobileadmin_sideb"); ?>
			<!-- end: Main Menu -->
			
			
			<!-------- Start Content-------->
			<div class="total">
				<div id="content" class="span10">
				<?php
echo '<div align="center">'.$this->Session->flash().'</div>';
?>
				
				<?php echo $this->fetch('content'); ?>
						
			</div>
			</div>
			<!-------- End Content-------->
				</div><!--/fluid-row-->
				
				
				<div class="clearfix"></div>
		

		

	</div><!--/.fluid-container-->

		<footer>
			<p>
				 <hr>
	<p class="pull-right">A <a href="#" target="_blank">Markit Social eCommerce</a> by <a style="text-decoration:none;" data-ajax="false" href="http://simplit.co" target="_blank">Simpl!t Co.</a></p>
	&copy; <?PHP echo date("Y").' <a href="#" target="_blank">'.$setngs[0]['Sitesetting']['site_name'].'</a>';?>
			</p>

		</footer>
	

	
</body>
   
</html>
