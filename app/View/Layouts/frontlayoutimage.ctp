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

$cakeDescription = __d('cake_dev', $setngs[0]['Sitesetting']['site_name'].' - '.$setngs[0]['Sitesetting']['site_title']);
?>
<!DOCTYPE html>
<html>
<head>

<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		$params=$this->params;
		$controller=$params['controller'];
		$action=$params['action'];
		
	echo $this->Html->meta('icon');
	
	//echo $this->Html->css('cake.generic');
	
	
	
	echo $this->Html->meta('keywords',$setngs[0]['Sitesetting']['meta_key']);
	if (isset($fbdescription)){
		echo '<meta property="og:description" content="'.$fbdescription.'"/>';
	}else{
		echo $this->Html->meta('description',$setngs[0]['Sitesetting']['meta_desc']);
	}
	if (isset($fbapp_id)){
		echo '<meta property="fb:app_id" content="'.$fbapp_id.'"/>';
	}
	if (isset($fbtitle)){
		echo '<meta property="og:title" content="'.$fbtitle.'"/>';
	}
	if (isset($fbtype)){
		echo '<meta property="og:type" content="'.$fbtype.'"/>';
	}
	if (isset($fburl)){
		echo '<meta property="og:url" content="'.$fburl.'"/>';
	}
	if (isset($fbimage)){
		echo '<meta property="og:image" content="'.$fbimage.'"/>';
	}
	echo '<meta property="og:site_name" content="'.$setngs[0]['Sitesetting']['site_name'].'"/>';
	
	
	echo $this->Html->css('glyphicons');
	echo $this->Html->css('fancyclone');
	echo $this->Html->css('mid');
	//echo $this->Html->css('bootstrap');
	echo $this->Html->css('override');
	echo $this->Html->css('basic');
	//echo $this->Html->css('gallery');
	//echo $this->Html->css('lightbox2.6');
	//echo $this->Html->css('1');
	


	
	//echo $this->Html->script('jquery.min');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery.ui');
	echo $this->Html->script('jquery.catalog');
	//echo $this->Html->script('jquery.selectbox');
	//echo $this->Html->script('jquery.main');
	//echo $this->Html->script('jquery.opacityrollover');
	//echo $this->Html->script('jquery.gallery');
	//echo $this->Html->script('jquery.history');
	echo $this->Html->script('front');
	echo $this->Html->script('customScript');
	//echo $this->Html->script('lightbox-2.6.min');




	?>
	<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>  -->
	<?php 
	//echo $this->Html->script('googlemap');
	
	
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	
	?>
</head>

<?php 
echo $this->element('headerwith');
?>
</html>
