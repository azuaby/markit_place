<div class="container set_area" style="width:940px;">
				
    <div id="content">
		<?php	echo $this->Form->Create('notifi',array('url'=>array('controller'=>'/','action'=>'/addshipping'),'onsubmit'=>'return validaddship()')); ?>
  		
        <h2 class="ptit"><?php echo __('Add Shipping Address');?></h2>      
        <div class="section" style="padding:0;">
			<fieldset class="frm" style="padding:0px 25px 18px">
			<dl>
			<dd style="float:left;width:320px;">
				<label><?php echo __('Full Name');?> :
				<?php echo "<div id='alert_em' style='color:red;display:inline;padding-left:6em;height:0px;'></div>"; ?>
				</label>
				<input id="fullname" name="fullname" type="text" maxlength='50' value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['name']; } ?>"/>
				<label><?php echo __('Nick Name');?>:
				<?php echo "<div id='alert_nick' style='color:red;display:inline;padding-left:6em;height:0px;'></div>"; ?>
				</label>
				<input id="nick" type="text" name="nickname" maxlength='20' value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['nickname']; } ?>" placeholder="<?php echo __('e.g. Home, Work');?>"/>
				
				
				<label><?php echo __('Country');?>
				<?php echo "<div id='alert_cntry' style='color:red;display:inline;padding-left:7em;height:0px;'></div>"; ?></label>
				<div id="cntry-container" class="selectdiv" style="width: 280px; height: 28px; padding-top: 3px;">
				<select id="shipping_countrys" name="cntry" class="selectboxdiv" style="width: 280px ! important;">
					<option value=""><?php echo __('Select Country');?></option>
					<?php $selected = ''; 
							foreach ($countrylist as $country) { 
								if (isset($usr_datas)  && $country['Allowedcountries']['country'] == $usr_datas['Tempaddresses']['country'])
									$selected = 'selected';
					?>
					<option value="<?php echo $country['Allowedcountries']['id'];?>" <?php echo $selected;?>><?php echo $country['Allowedcountries']['country']; ?></option>
					<?php $selected = '';} ?>
				</select><div class="out" ><?php echo $usr_datas['Tempaddresses']['country']; ?></div>
				</div>
				
				<?php
				if($usr_datas['Tempaddresses']['state'] !== 0){
				    foreach($statelist as $state){
				        if($state['State']['id'] == $usr_datas['Tempaddresses']['state']){
				            $state_id = $state['State']['id'];
				            $state_name = $state['State']['state'];
				        }
				    }
				}
				if($usr_datas['Tempaddresses']['city'] !== 0){
					foreach ($arealist as $area) {
						if($area['Area']['id'] == $usr_datas['Tempaddresses']['city']){
							$area_id = $area['Area']['id'];
							$area_name = $area['Area']['area'];
						}
					}
				}
				?>

				<label for=""  class="label">State<div id='alert_state' style='color:red;display:inline;padding-left:7em;height:0px;'></div></label>
				<div id='shpng_state-container' class='selectdiv' style='width: 280px; height: 28px; padding-top: 3px;'>
					<select name="state" id="shpng_state-selectbx" class="selectboxdiv" style= 'width: 280px ! important;'>
						<option value="<?php echo $state_id;?>" <?php echo $selected;?>><?php echo $state_name; ?></option>
					</select>	
					<?php echo '<div class="out">'.$state_name.'</div>';?>
				</div>


				<label for=""  class="label">Area<div id='alert_area' style='color:red;display:inline;padding-left:7em;height:0px;'></div></label>
				<div id='shpng_area-container' class='selectdiv' style='width: 280px; height: 28px; padding-top: 3px;'>
					<select name="area" id="shpng_area-selectbx" class="selectboxdiv" style= 'width: 280px ! important;'>
						<option value="<?php echo $area_id;?>" <?php echo $selected;?>><?php echo $area_name; ?></option>
					</select>
					<?php echo '<div class="out">'.$area_name.'</div>';?>
				</div>

				<label><?php echo __('Make this as Default');?></label>
				<input type="checkbox" name="setdefault" /><span style="bottom: 2px; font-size: 12px; position: relative; padding-left: 3px;"><?php echo __('Default Address');?></span>
			</dd>
			<dd style="float:right;width:320px;">
				<label><?php echo __('Address');?>1:
				<?php echo "<div id='alert_add1' style='color:red;display:inline;padding-left:7em;height:0px;'></div>"; ?>
				</label>
				<input id="add1" name="address1" type="text" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['address1']; } ?>"/>
				<label><?php echo __('Address');?>2:</label>
				<input type="text" name="address2" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['address2']; } ?>"/>
<!--				<label><?php echo __('City');?>:
				<?php echo "<div id='alert_city' style='color:red;display:inline;padding-left:12em;height:0px;'></div>"; ?>
				</label>
				<input id="city" type="text" name="city" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['city']; } ?>"/>-->
				<label><?php echo __('Zipcode');?>: 
				<?php echo "<div id='alert_zip' style='color:red;display:inline;padding-left:10em;height:0px;'></div>"; ?>
				</label>
				<input id="zip" type="text" name="zipcode" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['zipcode']; } ?>"/>
				<label><?php echo __('Phone No');?>:
				<?php echo "<div id='alert_ph' style='color:red;display:inline;padding-left:7em;height:0px;'></div>"; ?>
				</label>
				<input id="phne" type="text" name="phone" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['phone']; } ?>"/>
			</dd>
			</dl>
        <input name="shippingId" type="hidden" type="text" value="<?php if(isset($usr_datas)) { echo $usr_datas['Tempaddresses']['shippingid']; }else{echo '0';} ?>"/>
        <div class="btn-area" style="float:none;padding:0px;position:relative;height:64px;">
			<button class="btn-save" id="save_account" style="float:left;margin-right:10px;"><?php echo __('Save');?></button>
		
			<span class="checking" style="display:none"><i class="ic-loading"></i></span>
			<a href="<?php echo SITE_URL; ?>shipping" style="color:black;line-height:34px;"><?php echo __('Cancel');?></a>
		</div>
			</fieldset>
		</div>
        </form>
    </div>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php echo __('My Orders');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><?php echo __('Shipping');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" class="current" ><?php echo __('Add Shipping');?></a></dd>
	           	
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __('MERCHANT');?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><?php echo __('Information');?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales');?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
	        </dl>
		</div>		
			<!-- <footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
</div>	
