<?php
	$params=$this->params;
	$controller=$params['controller'];
	$action=$params['action'];
		
	echo "<div class='sub_menus'>";
		echo '<ul>';
			echo "<li>";
				if($title_for_layout == 'Banner Management'){
					echo '<a href="'.SITE_URL.'admin/view/banner" class="btn btn-primary">Banner Management</a>';
				}else{	
					echo '<a href="'.SITE_URL.'admin/view/banner">Banner Management</a>';
				}
			echo "</li>";
			echo "<li>";
				if($title_for_layout == 'News Management'){
					echo '<a href="'.SITE_URL.'admin/view/news" class="btn btn-primary">News Management</a>';
				}else{	
					echo '<a href="'.SITE_URL.'admin/view/news">News Management</a>';
				}	
			echo "</li>";
		echo "</ul>";
	echo "</div>";
?>
