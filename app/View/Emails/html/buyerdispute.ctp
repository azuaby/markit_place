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
								<h2 style=" font-weight: normal; margin: 0; padding: 0 0 12px; font-style: inherit; line-height: 30px; font-size: 25px; font-family: Trebuchet MS; border-bottom: 1px solid #333333; "> Dispute has been successfully initiated - Order ID is #<?php echo $gor; ?>.
								</h2>
							</td>
						</tr>
						
							<tr>
								<td style="padding: 15px 0;"  valign="top">
									<p style='margin-bottom: 10px'>
										Hello <?php echo $buyerfirstname; ?>,
									</p>
									<p style='margin-bottom: 10px'>
										This email is to acknowledge receipt of your dispute raised on your 
										recent order #<?php echo $gor;?> from the seller 
										<a href='<?php echo SITE_URL.'people/'.$sellerurl; ?>' title="<?php echo $sellerfirstname; ?>">
											<?php echo $sellerfirstname; ?>
										</a>. The same notification has been sent to the seller email address and we are 
										expecting the favorable response from the seller.
									
									</p>
									<p style='margin-bottom: 10px'>
									Your dispute reference number is: #<?php echo $gli; ?>
									</p>
									<p style='margin-bottom: 10px'>
										We recommend you to explain the issues of your order clearly to the seller to take necessary action against this dispute.
									</p>
									<p style='margin-bottom: 10px'>
										The final decision will be made by the administrators of Markit based on the communication between the buyer and seller. The final decision made by Markit can not be changed
									
									</p>
									<p style='margin-bottom: 10px'>
										You can keep tracking the status of the disputes in your profile settings in the website. We will also keep you notified to your email address if there is any response from the seller.
									
									</p>
									<p style='margin-bottom: 10px;color:red;'>
										NOTE: If you fail to respond on any latest reply on any disputes in a certain time, there is a possibility of closing the dispute and resulting the dispute in favor of the other party. So, we recommend to act immediately on disputes.
									</p>
									<p style='margin-bottom: 10px;'>
										Thanks for your co-operations.
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
<?php //die; ?>