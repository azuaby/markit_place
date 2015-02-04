<?php
	echo "<div class='sub_menus'>";
		echo '<ul>';
			echo "<li>";
				if($title_for_layout == 'AddUser Management'){
					echo '<a href="'.SITE_URL.'addmember" class="btn btn-primary">Add Member</a>';
				}else{	
					echo '<a href="'.SITE_URL.'addmember">Add Member</a>';
				}
			echo "</li>"; 		
		echo "</ul>";
?>
