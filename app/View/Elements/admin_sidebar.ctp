
<?php
if($title_for_layout == 'create application')
{		

	echo '<div class="sidebar-menu">';
		echo ' <ul class="treeview" id="tree">';
			
			echo '<li class="collapsable"><div class="hitarea collapsable-hitarea"></div><a href="'.SITE_URL.'admin/user/management">User Management</a></li>';	
			echo '<li class="expandable"><div class="hitarea expandable-hitarea"></div><span>General Moderation</span>';
				echo '<ul style="display: none;background:none!important;">';
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/view/banner">Banner Management</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/view/news">News Management</a>';
					echo "</div></li>";
				echo "</ul>";
			echo '</li>';	
			
			echo '<li class="expandable">';
				echo '<div class="hitarea expandable-hitarea "></div><span>Payments</span>';
				echo '<ul style="display: none;background:none!important;">';
					echo "<li><div class='subclass'>";
						echo '<a href="#">Payment History</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="#">Manage Withdraw Request</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="#">Invoices</a>';
					echo "</div></li>";
				echo "</ul>";
			echo "</li>";
			
			echo '<li class="expandable">';
				echo '<div class="hitarea expandable-hitarea "></div><span>General Preferences</span>';
				echo '<ul style="display: none;background:none!important;">';
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/site/setting">Site Management</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/module/setting">Manage Modules</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/google/code">Google Analytics</a>';
					echo "</div></li>";
				echo "</ul>";
			echo "</li>";
			
			echo '<li class="expandable">';
				echo '<div class="hitarea expandable-hitarea "></div><span>Store Preferences</span>';
				echo '<ul style="display: none;background:none!important;">';
					//echo "<li><div class='subclass'>";
						//echo '<a href="'.SITE_URL.'admin/site/setting">General Settings</a>';
					//echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/view/category">Category Management</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="'.SITE_URL.'admin/manage/items">Manage Items</a>';
					echo "</div></li>";
					echo "<li><div class='subclass'>";
						echo '<a href="#">Sales History</a>';
					echo "</div></li>";
				echo "</ul>";
			echo "</li>";
			
			echo '<li class="collapsable"><div class="hitarea collapsable-hitarea"></div><a href="#">Payemnt Gateway Settings</a></li>';	
		echo "</ul>";	
	echo "</div>";
}
else
{
	echo '<ul class="sidebar-menu">';
		
		if($title_for_layout == 'Dashboard'){
			echo '<li class="active"><a href="'.SITE_URL.'admin">Dashboard</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin">Dashboard</a></li>';
		}
		
		if($title_for_layout == 'User Management'){			
			echo '<li class="active"><a href="'.SITE_URL.'admin/user/management">User Management</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin/user/management">User Management</a></li>';
		}
		
		if($title_for_layout == 'Banner Management' || $title_for_layout == 'News Management'){
			echo '<li class="active"><a href="'.SITE_URL.'admin/view/banner">General Moderation</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin/view/banner">General Moderation</a></li>';
		}
		
		if($title_for_layout == 'Payment Management'){
			echo '<li class="active"><a href="'.SITE_URL.'admin/payments">Payments</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin/payments">Payments</a></li>';
		}
		
		if($title_for_layout == 'Category Management' || $title_for_layout == 'Item Management'){
			echo '<li class="active"><a href="'.SITE_URL.'admin/view/category">Store Preferences</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin/view/category">Store Preferences</a></li>';
		}
		
		if($title_for_layout == 'Site Management' || $title_for_layout == 'Module Setting' || $title_for_layout == 'Goolge Analystics'){
			echo '<li class="active"><a href="'.SITE_URL.'admin/site/setting">General Preferences</a></li>';
		}else{
			echo '<li><a href="'.SITE_URL.'admin/site/setting">General Preferences</a></li>';
		}
	echo '</ul>';

}

?>
