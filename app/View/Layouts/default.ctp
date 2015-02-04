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

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');

$cakeDescription = __d('cake_dev', $setngs[0]['Sitesetting']['site_name']);
?>
<!DOCTYPE html> 
<html>
<head>
	<?php //echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		$params=$this->params;
		$controller=$params['controller'];
		$action=$params['action'];
		echo $this->Html->meta('icon');

		echo $this->Html->css('front');
		echo $this->Html->css('bootstrap');
		if($action != 'view_details_categitem'){
			echo $this->Html->css('selectbx');
		}
		
		echo $this->Html->css('mid');
	echo $this->Html->css('glyphicons');
		//echo $this->Html->css('selectlist');
		
		echo $this->Html->css('fancyclone');
			echo $this->Html->css('datepicker');
			
		//echo $this->Html->script('jquery-1.8.1.min');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('anekart');
		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('bootstrap-dropdown');
		echo $this->Html->script('jquery.selectlist');
		echo $this->Html->script('customScript');
		//echo $this->Html->script('lightbox');
		echo $this->Html->script('front');
		echo $this->Html->script('jquery.main');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery.ui');
	?>
	<!--<script src="<?php echo SITE_URL; ?>js/jquery.min.js"></script>-->
</head>
<body>
<?php 
echo $this->element('header');
?>

</html>
