<?php ?>
<style>
.note{
background: -moz-linear-gradient(center top , #FFFFFF, #FFFFFF) repeat-x scroll 0 0 #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
    color: #D9573B;
    margin: 0 0 -20px 205px;
   padding: 10px 5px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    text-align: center;
    width: 68%;
    font-size:13px;
}

</style>
<?php
?>
<div id="container-wrapper">
<?php if(!empty($NoteMsg)){?>
<div class="note">

<?php echo __($NoteMsg);?><?php }else {  }?></div>
<div class="container set_area" style="width:940px;top: 45px;">

<div class="wrapper-content wider fancy-right-sidebar">
	<section class="merchant">
	<?php	echo $this->Form->Create('merchant',array('url'=>array('controller'=>'/','action'=>'/sellersignup/'.$additemid), 'id'=>'sellerchk','onsubmit'=>'return sellersignupfrm()')); ?>
  		<dl>
			<dt><?php echo __('Merchant Information');?></dt>
			
            <dd><label for=""  class="label"><?php echo __('Brand');?></label>
                <input type="text" name="brand_name" id="brand_name" value="<?php echo $shopdetails['Shop']['shop_name']; ?>" />
            </dd>
			<dd><label for="" class="label"><?php echo __('Full Name');?></label>
				<input type="text" name ="merchant_name" id="merchant_name"  value="<?php echo $shopdetails['Shop']['shop_title']; ?>"/>
				<!--p class="required"><span></span>This field is required</p-->
			</dd>
			
			<dd><label for="" class="label"><?php echo __('Phone Number');?></label>
				<input type="text" name="person_phone_number" id="person_phone_number" value="<?php echo $shopdetails['Shop']['phone_no']; ?>" />
			</dd>
		</dl>
		<dl>
			<dt><?php echo __('Bank Information');?></dt>
			<dd><label for="" class="label"><?php echo __('Paypal Id');?></label>
				<input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" />
				<p class="required"><span></span><?php echo __('Please enable PDT, to get payment success from admin');?></p>
			</dd>
        </dl>
		<dl>
			<dt><?php echo __('Seller Address');?></dt>
			<dd style="width: 684px;"><label for="" class="label"><?php echo __('Address');?></label>
				<input class="input-xlarge" type="text" style="width:400px;border-radius:0;" id="googleaddress" name="address" value="<?php if($shopdetails['Shop']['shop_address'] != ""){ echo $shopdetails['Shop']['shop_address'];}?>" placeholder="<?php echo __('123 Street, City State/Country');?>" >
				<input class="btn btn-primary mapsubmit" type="button" value="<?php echo __('Go');?>" onclick="showAddress(); return false;">
			</dd>
			<dd><label for="" class="label"><?php echo __('Latitude');?></label>
				<input type="text" id="latbox" name="latitude" value="<?php echo $shopdetails['Shop']['shop_latitude']; ?>" />
				<!-- <input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" /> -->
			</dd>
			<dd><label for="" class="label"><?php echo __('Longitude');?></label>
				<input type="text" id="lonbox" name="longitude" value="<?php echo $shopdetails['Shop']['shop_longitude']; ?>" />
				<!-- <input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" /> -->
			</dd>
			
        </dl>
		<dl>
			<dt><?php echo __('To find the latitude and longitude of a point');?> <strong><?php echo __('Click');?></strong> <?php echo __('on the map');?>, <strong><?php echo __('Drag');?></strong> <?php echo __('the marker, or enter the');?>...</dt>
		 	<dd>
			<div id="wrapper" style="margin:5px"><div id="map" style="width: 850px; height: 450px;margin-left:50px;"></div></div>
      		</dd>
        </dl>
		
        <?php
        if($shopdetails['Shop']['paypal_id'] == '')
        	{
        	?>
		
        	<div class="btn-area">
			
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;padding:6px; margin-left:395px; '></div>"; ?>
			
			<button class="btn-green" id="sign-up" style="float:right;margin-right:6px;" > Complete <?php echo __('Sign Up');yes ?></button>
			
			<input type="hidden" name="status" value="<?php echo $shopdetails['Shop']['seller_status']; ?>" />
		<div style="margin:40px -186px 0px 0px; float:right; ">
			<span style="color:#1a1a1a; font-size:12px; font-weight:normal;"><?php echo "By clicking the “Complete Sign Up” you are agree that you have read and agree the "; ?> <?php echo $setngs[0]['Sitesetting']['site_name']; ?><?php echo "’s"; ?></span><a onclick="viewTerms()" style="color:blue; font-size:12px; font-weight:normal;"> <?php echo "“Terms and Conditions”"; ?></a>
			</div>
		</div>
		
			<?php
			}
		else
			{
			?>
			<div class="btn-area">
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;padding:6px; '></div>"; ?>
			
			<button class="btn-green" id="sign-up" style="float:left;margin-right:6px;" >  <?php echo __('Update');yes ?></button>
			
			<input type="hidden" name="status" value="<?php echo $shopdetails['Shop']['seller_status']; ?>" />
		</div>
			<?php
			}
			?>
	</section>
	<hr />
	</form> 
</div>	<!-- <footer id="footer">
				<a href="https://twitter.com/fantasyHitasoft" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->
</div>			
<?php 
$lat = 20.0;
if ($shopdetails['Shop']['shop_latitude'] != ''){
	$lat = $shopdetails['Shop']['shop_latitude'];
}
$long = -10.0;
if ($shopdetails['Shop']['shop_longitude'] != ''){
	$long = $shopdetails['Shop']['shop_longitude'];
}
?>		
</div>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo SITE_URL.'js/googlemap.js';?>"></script>  
<script>
setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);
//window.load = xz();
window.load = xz(<?php echo $lat.",".$long; ?>);
</script> 
