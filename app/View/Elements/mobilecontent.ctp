<?php $MOB_URL = "".SITE_URL."mobile/"; ?>
<div data-role='panel' id='myPanel' style='background-color:#25292c;' data-dismissible='false' data-position-fixed="true"> 

	<div style="background-color:#1f2326;with:98% !important;height:75px;" data-role="none">
		<div style="float:left;width:27%;height:50px;">
			<?php 
				echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url_ori."'>
						<img src='".SITE_URL."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."width:50px;height:50px;margin:10px;'></a>
		</div>
		<div style='float:left;width:40%;'>					
			<a href='#' data-ajax='false'
			style='text-decoration:none;text-shadow:none;float:left;font-size:18px;color:#FFFFFF;'>
			<p style='margin-top:10px;'>
			Guest<br />
			</p></a>";
	?>
		</div>
	</div>
	
	
	
	<table style="margin:10px;">
		<tr>
			<td width="30%">
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-home.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Home
					</p>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a data-ajax='false' data-role='none' href='<?php echo $MOB_URL; ?>shop/browse' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-store.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>shop/browse' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Shop
					</p>
				</a>
			</td>
		</tr>
		<!--tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>recomendations/browse' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-coffee.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>recomendations/browse' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Recommended
					</p>
				</a>
			</td>
		</tr-->
		<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>login' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-enter.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>login' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Sign In
					</p>
				</a>
			</td>
		</tr>	
		<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>mobileapps' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/appicon.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>mobileapps' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Apps
					</p>
				</a>
			</td>
		</tr>			
	</table>
	

</div> 
 
