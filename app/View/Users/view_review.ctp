<?php
				foreach($reviews_added as $reviews)
				{
				
					
					$prof_img = $reviews['User']['profile_image'];
					$usrname = $reviews["User"]["first_name"];
					$usrname_url = $reviews["User"]["username_url"];
					$rating = $reviews['Review']['ratings'];
					echo '<div style="float:left; width:20%!important;height:auto;overflow:hidden;">';
					echo '<img src="'.SITE_URL.'media/avatars/thumb70/'.$prof_img.'" width="35px" height="35px" style="margin: -20px 5px;border-radius:10px;">';
					echo '<a title="" class="username" href="'.SITE_URL.'people/'.$usrname_url.'">
					'.$usrname.'</a><br clear="all"><span class="usernameMention">@'.$usrname_url.'</span><br />';
					for($i=1;$i<=5;$i++)
					{
					if($i<=$rating)
						echo '<i class="static-rating active"></i>';
						//echo '<input name="star2" type="radio" class="star {split:2}" checked="checked"/>';
					else
						echo '<i class="static-rating"></i>';
						//echo '<input name="star2" type="radio" class="star {split:2}" disabled="disabled"/>';
					}
					echo "<br /><br />".date('Y-m-d',strtotime($reviews['Review']['date']));
					echo '</div>';
					echo '<div style="float:right;width:80%!important;height:auto;overflow:hidden;">'.$reviews['Review']['reviews'].'</div><br /><br /><br /><br /><br /><br />';				
				}
				?>