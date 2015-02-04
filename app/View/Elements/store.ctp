<?php
	
	echo "<div class='sub_menus'>";
		echo '<ul>';
			//echo "<li>";
				//echo '<a href="'.SITE_URL.'admin/site/setting">General Settings</a>';
			//echo "</li>";
			echo "<li>";
				if($title_for_layout == 'Category Management'){
					echo '<a href="'.SITE_URL.'admin/view/category" class="btn btn-primary">Category Management</a>';
				}else{
					echo '<a href="'.SITE_URL.'admin/view/category">Category Management</a>';
				}
			echo "</li>";
			echo "<li>";
				if($title_for_layout == 'Item Management'){
					echo '<a href="'.SITE_URL.'admin/manage/items" class="btn btn-primary">Manage Items</a>';
				}else{
					echo '<a href="'.SITE_URL.'admin/manage/items">Manage Items</a>';
				}
			echo "</li>";
			echo "<li>";
				if($title_for_layout == 'Sales History'){
					echo '<a href="#" class="btn btn-primary">Sales History</a>';
				}else{
					echo '<a href="#">Sales History</a>';
				}
			echo "</li>";
		echo "</ul>";
	echo "</div>";	
?>