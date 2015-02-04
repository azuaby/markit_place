<?php $MOB_URL = "".SITE_URL."mobile/"; ?>
<div data-role='panel' id='myPanel' style='background-color:#25292c;' data-dismissible='false' data-position-fixed="true"> 

	<div style="background-color:#1f2326;with:98% !important;height:75px;" data-role="none">
		<div style="float:left;width:27%;height:50px;">
			<?php 
				echo  "<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url."'>
						<img src='".SITE_URL."media/avatars/thumb70/".$profile_image."' style='".$roundProf."width:50px;height:50px;margin:10px;'></a>
		</div>
		<div style='float:left;width:40%;'>					
			<a data-ajax='false' href='".SITE_URL."mobile/people/".$username_url."' 
			style='text-decoration:none;text-shadow:none;float:left;font-size:18px;color:#FFFFFF;'>
			<p style='margin-top:10px;'>
			$first_name<br />
			<font color='#7E7E7E' style='font-size:15px;'>@$username</font></p></a>";
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
						<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>collections' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/collection.png' style='margin-top:5px;'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>collections' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						My Collections
					</p>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>cart' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-cart.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>cart' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Cart
					</p>
				</a>
			</td>
		</tr>
						<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>settings' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-settings.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>settings' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Settings
					</p>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>logout' style='background-color:#25292c;border:none;'>
					<img src='<?php echo SITE_URL; ?>images/menu/icon-exit.png'>
				</a>
			</td>
			<td>
				<a data-ajax='false' href='<?php echo $MOB_URL; ?>logout' style='text-decoration:none;text-shadow:none;float:left;font-size:16px;color:#7E7E7E;'><br />
					<p style='margin-top:0px;'>
						Sign Out
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
 
	
