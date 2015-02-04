<?php echo $this->element('emailHeader'); ?>  
				<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family: Georgia, serif; background: #fff;" bgcolor="#ffffff">
			      <tr>
			        <td width="14" style="font-size: 0px;" bgcolor="#ffffff">&nbsp;</td>
					<td width="100%" valign="top" align="left" bgcolor="#ffffff"style="font-family: Georgia, serif; background: #fff;">
						<table cellpadding="0" cellspacing="0" border="0"  style="color: #333333; font: normal 13px Arial; margin: 0; padding: 0;" width="100%" class="content">
						<!-- <tr>
							<td style="padding: 25px 0 5px; border-bottom: 2px solid #d2b49b;font-family: Georgia, serif; "  valign="top" align="center">
								<h3 style="color:#767676; font-weight: normal; margin: 0; padding: 0; font-style: italic; line-height: 13px; font-size: 13px;">~ <currentmonthname> <currentday>, <currentyear> ~</h3>
							</td>
						</tr> -->
						<tr>
							<td style="padding: 18px 0 0;" align="left">			
								<h2 style=" font-weight: normal; margin: 0; padding: 0 0 12px; font-style: inherit; line-height: 30px; font-size: 25px; font-family: Trebuchet MS; border-bottom: 1px solid #333333; ">There is an order placed in your account  - The order ID is #<?php echo $orderId; ?>.</h2>
							</td>
						</tr>
						
							<tr>
								<td style="padding: 15px 0;"  valign="top">
									<p style='margin-bottom: 10px'>
										Hi <?php echo $custom; ?>,
									</p>
									<p style='margin-bottom: 10px'>
										Congratulations!
									</p>
									<p style='margin-bottom: 10px'>
										There is an order placed in your profile. This email confirms that 
										the same order has been processed and recommend you to proceed with 
										the shipping of this order.
									</p>
									<p style='margin-bottom: 10px'>
										Buyer: <a href='<?php echo SITE_URL.'people/'.$buyernameurl; ?>' title='<?php echo $buyername; ?>' ><?php echo $buyername; ?></a>
									</p>
									<p style='margin-bottom: 10px'>
										Order ID: #<?php echo $orderId; ?>
										<br>
										Order Date: <?php echo date('j-M-Y'); ?>
									</p>
									<p style='margin-bottom: 10px'>
										<table width="100%" class='order-details-table' style='border-spacing: 0;border-collapse: collapse;border: none;'>
										  <tr>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Item</th>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Quantity</th>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Size</th>
										  </tr>
										  <?php foreach($itemname as $key=>$item){ ?>
										  <tr>
										
											<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'><?php echo $item; ?></td>
											<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'><?php echo $tot_quantity[$key]; ?></td>
											<?php if ($sizeopt[$key] == '0') { ?>
												<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'> -- </td>
											<?php }else { ?>
												<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'><?php echo $sizeopt[$key]; ?></td>
											<?php } ?>
										
										  </tr>
										  <?php } ?>
										</table>
									</p>
									<p style='margin-bottom: 10px'>
										<b>Ship to:</b>
										<br clear="all" /><br />
										<?php echo $usershipping_addr['Shippingaddresses']['name']; ?><br />
										<?php echo $usershipping_addr['Shippingaddresses']['address1']; ?><br />
										<?php if ($usershipping_addr['Shippingaddresses']['address2'] != ""){echo $usershipping_addr['Shippingaddresses']['address2']."<br />";} ?>
										<?php echo $usershipping_addr['Shippingaddresses']['city']." - ".$usershipping_addr['Shippingaddresses']['zipcode']; ?><br />
										<?php echo $usershipping_addr['Shippingaddresses']['state']; ?><br />
										<?php echo $usershipping_addr['Shippingaddresses']['country']; ?><br />
										<?php echo "Ph.: ".$usershipping_addr['Shippingaddresses']['phone']; ?><br />
									</p>
									<p style='margin-bottom: 10px;font-size:16px;'>
										Total: <b><?php echo $totalcost." ".$currencyCode; ?></b>
									</p>
									<p style='margin-bottom: 10px'>
										You have options to confirm this order and mark is as processing. 
										You can also add the shipping details and tracking details to this 
										order from “My Sales” under your profile account.
									</p>
									<p style='margin-bottom: 10px'>
										Happy selling !!!
									</p>
								</td>
							</tr>			
							
							<tr>
								<td style="padding: 15px 0"  valign="top">
									<p style="color: #333333; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 14px;font-family: Arial; ">
										Regards,
										<br />
										<b><?php echo $setngs[0]['Sitesetting']['site_name'].' Team'; ?>.</b>
									</p>
									<br>
								</td>
							</tr>
						</table>	
					</td>
					<td width="16" bgcolor="#ffffff" style="font-size: 0px;font-family: Georgia, serif; background: #fff;">&nbsp;</td>
			      </tr>
				</table><!-- body -->
				  <?php echo $this->element('emailFooter'); ?>  
		  	</td>
		</tr>
    </table>
  </body>
</html>