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
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		
		
		
		echo $this->Html->css('mid');
		echo $this->Html->css('fancyhelp');
		echo $this->Html->css('fancyclone');
		
		echo $this->Html->script('front');
		//echo $this->Html->script('jquery-1.3.2');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery.ui');
		echo $this->Html->script('jquery.catalog');
		echo $this->Html->script('jquery.selectbox');
		echo $this->Html->script('jquery.main');
		echo $this->Html->script('jquery.timeline');
		echo $this->Html->script('customScript');
		echo $this->Html->script('calen');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
</head>
<?php 
echo $this->element('help_header');
?>
</html>
