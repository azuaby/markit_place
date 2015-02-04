<?php
	echo "<div class='sub_menus'>";
		echo '<ul>';
			echo "<li>";
				if($title_for_layout == 'Site Management'){
					echo '<a href="'.SITE_URL.'admin/site/setting" class="btn btn-primary">Site Management</a>';
				}else{
					echo '<a href="'.SITE_URL.'admin/site/setting">Site Management</a>';
				}	
			echo "</li>";
			echo "<li>";
				if($title_for_layout == 'Module Setting'){
					echo '<a href="'.SITE_URL.'admin/module/setting" class="btn btn-primary">Manage Modules</a>';
				}else{	
					echo '<a href="'.SITE_URL.'admin/module/setting">Manage Modules</a>';
				}	
			echo "</li>";
			echo "<li>";
				if($title_for_layout == 'Goolge Analystics'){
					echo '<a href="'.SITE_URL.'admin/google/code" class="btn btn-primary">Google Analytics</a>';
				}else{	
					echo '<a href="'.SITE_URL.'admin/google/code">Google Analytics</a>';
				}	
			echo "</li>";
		echo "</ul>";
	echo "</div>";	
?>