<table cellspacing='0' align='center' width='700px' height='515px' cellpadding='0' width='100%'  style='font-family:arial,sans-serif;'>
	<tbody style='padding:5px;float: left;'>
		<tr height=40>
			<td>
				<table height='70' style='width: 100%;float: left;' >
					<tbody>
						
						<tr style="background: #F1F1F1;float: left;height: 20px;width: 100%;">
							<td style='float: left;padding-left: 10px;'>
								<?php //echo ucwords($setngs[0]['Sitesetting']['site_name']); ?>
							</br>
																	
									<div    style="clear:both; float:left;">
										<?php
											if(!empty($items_data)){
												foreach($items_data as $itms){
													
													$itm_id = $itms[0]['Item']['id'];
													$item_title_url = $itms[0]['Item']['item_title_url'];
													$item_title = $itms[0]['Item']['item_title'];
													if(!empty($itms[0]['Photo'])){
														$image_name = $itms[0]['Photo'][0]['image_name'];
													}
													
													echo '<div style="border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-top-left-radius:5px;border-top-right-radius:5px;float:left;height:145px;margin-right:15px;margin-top:15px;width:160px;">';
														echo '<div style="background-color:#FFFFFF; border-bottom-left-radius:3px;border-bottom-right-radius:3px;border-top-left-radius:3px;border-top-right-radius:3px;float:left;height:100px;margin-left:6px;margin-top:6px;width:148px;">';
															echo "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."' style='color:#0088CC;text-decoration:none;'>";
															echo "<img src='".$_SESSION['media_url']."media/items/thumb150/".$image_name."' alt='".$item_title."' width='148px' height='100px' />";
														echo "</a></div>";
														echo '<div style="float:left; margin-left:6px;margin-top:4px; overflow:hidden;width:84px;">';
														//echo '<div style="color:#18B5E2;float:left;font-size:9px;font-weight:bold;text-transform:capitalize;white-space:nowrap;">';
														echo '<a href="'.SITE_URL.'listing/'.$itm_id.'/'.$item_title_url.'" style="color:#18B5E2;float:left;font-size:9px;font-weight:bold;text-transform:capitalize;white-space:nowrap;text-decoration:none;" target="_blank">'; echo  $item_title; echo '</a>';
														
														//echo $this->Html->link($item_title,array('controller'=>'/','action'=>'/listing/'.$itm_id.'/'.$item_title_url));
														//echo '</div>';
															echo '<p>';
															//echo '<div style="color:#18B5E2;float:left;font-size:10px;font-weight:normal !important;text-transform:capitalize;white-space:nowrap;">';
																if(!empty($itms[0]['Shop']['shop_name'])){
																
																	//echo $this->Html->link($itms[0]['Shop']['shop_name'],array('controller'=>'/','action'=>'/shop/'.$itms[0]['Shop']['shop_name']));
																
																echo '<a href="'.SITE_URL.'shop/'.$itms[0]['Shop']['shop_name'].'" style="color:#18B5E2;float:left;font-size:9px;font-weight:bold;text-transform:capitalize;white-space:nowrap;text-decoration:none;" target="_blank">'; echo  $itms[0]['Shop']['shop_name']; echo '</a>';
																
																}else{
																	//echo $this->Html->link($itms[0]['User']['username'],array('controller'=>'/','action'=>'/shop/'.$itms[0]['User']['username_url']));
																	echo '<a href="'.SITE_URL.'shop/'.$itms[0]['User']['username_url'].'" style="color:#18B5E2;float:left;font-size:9px;font-weight:bold;text-transform:capitalize;white-space:nowrap;text-decoration:none;" target="_blank">'; echo  $itms[0]['User']['username']; echo '</a>';
																}
																//echo '</div>';
															echo '</p>';
														echo '</div>';
														echo '<div class="listing-price" style="float:left;width: 64px; color:#18B5E2;float:left;font-size:11px;font-weight:bold;margin:1px 0 0;text-align:center;">';
															echo '<span class="currency-symbol">$&nbsp;</span><span class="currency-value">'.$itms[0]['Item']['price'].'</span> <span class="currency-codes">&nbsp;GHC</span>';
														echo '</div>';
													echo '</div>';
												
												}
											}else{
												echo "<center>No Items Found</center>";
											}
										?>
										
									</div>
						</tr>
					</tbody>						
				</table>
			</td>
		</tr>
		
	</tbody>
</table>
<?php
	//print_r(SITE_URL);
	//die;
?>	