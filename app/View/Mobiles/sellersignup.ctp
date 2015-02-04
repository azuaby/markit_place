<style>
.note{
background: -moz-linear-gradient(center top , #FFFFFF, #FFFFFF) repeat-x scroll 0 0 #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
    color: #D9573B;
    margin: 0 0 20px 0px;
   padding: 10px 5px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    text-align: center;
    width: 100%;
    font-size:13px;
}

</style>
<?php
?>
<div id="container-wrapper">
<!--div class="note"><?php echo $NoteMsg;?></div-->
<div class="container set_area" style="top: 45px;">

<div class="wrapper-content wider fancy-right-sidebar">
	
	<section class="merchant">
	<?php	echo $this->Form->Create('merchant',array('url'=>array('controller'=>'/','action'=>'/mobile/sellersignup/'.$additemid), 'id'=>'sellerchk','data-ajax'=>'false','onsubmit'=>'return sellersignupfrm()')); ?>
  		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
			<b style="font-size:15px;">Merchant Information</b>
			<?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
			<hr>
            <b for=""  class="label">Brand</b>
                <input type="text" name="brand_name" id="brand_name" value="<?php echo $shopdetails['Shop']['shop_name']; ?>" />
            
			<b for="" class="label">Full Name</b>
				<input type="text" name ="merchant_name" id="merchant_name"  value="<?php echo $shopdetails['Shop']['shop_title']; ?>"/>
				<!--p class="required"><span></span>This field is required</p-->
			
			
			<b for="" class="label">Phone Number</b>
				<input type="text" name="person_phone_number" id="person_phone_number" value="<?php echo $shopdetails['Shop']['phone_no']; ?>" />
			
		</div><br />
		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
			<b style="font-size:15px;">Bank Information</b><br><br/>
			<b for="" class="label">Paypal Id</b>
				<input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" />
				<p class="required"><span></span>Please enable PDT, to get payment success from admin</p>
			
        </div><br />
		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
			<b style="font-size:15px;">Seller Address</b><br ><br />
			<b for="" class="label">Address</b>
				<input class="input-xlarge" type="text" style="border-radius:0;" id="googleaddress" name="address" value="<?php if($shopdetails['Shop']['shop_address'] != ""){ echo $shopdetails['Shop']['shop_address'];}?>" placeholder="123 Street, City State/Country">
				<input class="btn btn-primary mapsubmit" type="button" value="Go" onclick="showAddress(); return false;">
			
			<b for="" class="label">Latitude</b>
				<input type="text" id="latbox" name="latitude" value="<?php echo $shopdetails['Shop']['shop_latitude']; ?>" />
				<!-- <input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" /> -->
			
			<b for="" class="label">Longitude</b>
				<input type="text" id="lonbox" name="longitude" value="<?php echo $shopdetails['Shop']['shop_longitude']; ?>" />
				<!-- <input type="text" name ="paypalId"  id="paypalid" value="<?php echo $shopdetails['Shop']['paypal_id']; ?>" /> -->
			
			
        </div><br />
		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
			<dt>To find the latitude and longitude of a point <strong>Click</strong> on the map, <strong>Drag</strong> the marker, or enter the...</dt>
		 	
			<div id="wrapper" style="margin:5px"><div id="map" style="width: 100%; height: 450px;"></div></div>
      		
        </div><br />
        <div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <?php
        if($shopdetails['Shop']['paypal_id'] == '')
        	{
        	?>
        	<div class="btn-area">
			<button class="btn-green" id="sign-up" style="float:left;margin-right:6px;background:#5690BB;color:#FFFFFF;text-shadow:none;" > Complete <?php echo __('Sign Up');yes ?></button>
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;padding:6px;'></div>"; ?>
			<input type="hidden" name="status" value="<?php echo $shopdetails['Shop']['seller_status']; ?>" />
		</div>
			<?php
			}
		else
			{
			?>
			<div class="btn-area">
			<button class="btn-green" id="sign-up" style="float:left;margin-right:6px;background:#5690BB;color:#FFFFFF;text-shadow:none;" >  <?php echo __('Update');yes ?></button>
			<?php echo "<div id='alert' class='alert alert-error' style='color:red;padding:6px;'></div>"; ?>
			<input type="hidden" name="status" value="<?php echo $shopdetails['Shop']['seller_status']; ?>" />
		</div>
			<?php
			}
			?>
			</div>
	</section>

	
	</form> 
</div>	
</div>			
		
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
