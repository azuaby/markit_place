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
								<h2 style=" font-weight: normal; margin: 0; padding: 0 0 12px; font-style: inherit; line-height: 30px; font-size: 25px; font-family: Trebuchet MS; border-bottom: 1px solid #333333; ">
									There is a dispute in your order ID #<?php echo $gor; ?> from 
									<?php echo $buyerfirstname; ?> .
								</h2>
							</td>
						</tr>
						
							<tr>
								<td style="padding: 15px 0;"  valign="top">
									<p style='margin-bottom: 10px'>
										Hello <?php echo $sellerfirstname; ?>,
									</p>
									<p style='margin-bottom: 10px'>
										This email is to notify that there is a dispute raised on your order #<?php echo $gor; ?> by <?php echo $buyerfirstname;?>
										We would like you to take this dispute on high priority and start communicating with the buyer to get this problem sorted out as soon as possible.
									</p>
									<p style='margin-bottom: 10px'>
									Your dispute reference number is: #<?php echo $gli; ?> 
									</p>
									<p style='margin-bottom: 10px'>
										The final decision will be made by the administrators of Markit based on the communication between the buyer and seller and the same cannot can not be changed.
									</p>
									<p style='margin-bottom: 10px'>
										You can keep tracking the status of the disputes in your profile settings in the website. We will also keep you notified to your email address if there is any response from the buyer.
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