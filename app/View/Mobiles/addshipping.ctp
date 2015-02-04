<div class="container set_area">
		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <b style="font-size:15px;">Add Shipping Address</b>      
        <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
       <hr>
    <div id="content">
		<?php	echo $this->Form->Create('notifi',array('url'=>array('controller'=>'/','action'=>'/mobile/addshipping'),'onsubmit'=>'return validaddship()','data-ajax'=>'false')); ?>
  		
        <div class="section" style="padding:0;">
			<fieldset class="frm" style="">
			<dl>
			
				Full Name :
				<?php echo "<div id='alert_em' style='color:red;display:inline;padding-left:6em;height:0px;'></div>"; ?>
				
				<input id="fullname" name="fullname" type="text" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['name']; } ?>"/>
				Nick Name:
				<?php echo "<div id='alert_nick' style='color:red;display:inline;padding-left:6em;height:0px;'></div>"; ?>
				
				<input id="nick" type="text" name="nickname" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['nickname']; } ?>" placeholder="e.g. Home, Work"/>
								Address 1:
				<?php echo "<div id='alert_add1' style='color:red;display:inline;padding-left:7em;height:0px;'></div>"; ?>
				
				<input id="add1" name="address1" type="text" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['address1']; } ?>"/>
				Address 2
				<input type="text" name="address2" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['address2']; } ?>"/>
				City:
				<?php echo "<div id='alert_city' style='color:red;display:inline;padding-left:12em;height:0px;'></div>"; ?>
				
				<input id="city" type="text" name="city" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['city']; } ?>"/>
				Zip: 
				<?php echo "<div id='alert_zip' style='color:red;display:inline;padding-left:10em;height:0px;'></div>"; ?>
				
				<input id="zip" type="text" name="zipcode" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['zipcode']; } ?>"/>
				
				State:	
				<?php echo "<div id='alert_state' style='color:red;display:inline;padding-left:11em;height:0px;'></div>"; ?>
				
				<input id="state" type="text" name="state" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['state']; } ?>"/>
				Country:
				<?php echo "<div id='alert_country' style='color:red;display:inline;padding-left:8em;height:0px;'></div>"; ?>
				
				<!--input id="country" type="text" name="country" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['country']; } ?>" placeholder="e.g. New York, NY"/-->
				<div class="selectdiv" style=" padding-top: 3px;">
				<select id="countrys" name="country" class="selectboxdiv">
					<option value="">Select Country</option>
					<?php $selected = ''; 
							foreach ($countrylist as $country) { 
								if (isset($usr_datas)  && $country['Country']['country'] == $usr_datas['Tempaddresses']['country'])
									$selected = 'selected';
					?>
							<option value="<?php echo $country['Country']['id'];?>" <?php echo $selected;?>><?php echo $country['Country']['country']; ?></option>
					<?php $selected = '';} ?>
				</select><div class="out" style="display:none;">Select Country</div>
				</div>
				
				Make this as Default
				<input type="checkbox" name="setdefault" /><span style="bottom: 9px; font-size: 12px; position: relative; padding-left: 30px;">Default Address</span>
			
				<br />
				Phone No:
				<?php echo "<div id='alert_ph' style='color:red;display:inline;padding-left:7em;height:0px;'></div>"; ?>
				
				<input id="phne" type="text" name="phone" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['phone']; } ?>"/>
			
			</dl>
        <input name="shippingId" type="hidden" type="text" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['shippingid']; }else{echo '0';} ?>"/>
        <div class="btn-area" style="float:none;padding:0px;position:relative;height:64px;">
			<button class="btn-save" id="save_account" style="background:#5690BB;color:#FFFFFF;text-shadow:none;">Save</button>
			
		
			<span class="checking" style="display:none"><i class="ic-loading"></i></span>
			<a href="<?php echo SITE_URL; ?>mobile/shipping" style="text-decoration:none;">
			<button class="btn-save" style="background:#5690BB;color:#FFFFFF;text-shadow:none;">
			Cancel</button>
			</a>
		</div><br />
			</fieldset>
		</div>
        </form>
    </div>
	
	<div id="sidebar" style="display:none;">
			<dl class="set_menu">
				<dt>ACCOUNT</dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > Profile</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > Password</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i>My Orders</a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" >Shipping</a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" class="current" >Add Shipping</a></dd>
	           	
	        </dl>
			<dl class="set_menu">
				<dt>MERCHANT</dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" >Information</a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i>My Sales</a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt>SHARING</dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> Credits</a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> Referrals</a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> Gift card</a></dd>
	        </dl>
		</div>		
			<!--footer id="footer">
			<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
			<hr>
			<ul class="footer-nav">
				<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
				<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
				<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
			</ul>
			<!-- footer-nav -->
		</footer-->	
</div>	
