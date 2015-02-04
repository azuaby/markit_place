<body class=""> 
  <!--<![endif]-->
     
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Coupon</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'admin/managecoupon'; ?>">Coupon</a> <span class="divider">/</span></li>
			            <li class="active">Add Coupon</li>
			        </ul>
				</div>
			</div>

   
<!-----Edit Coupon------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Coupon</h2>
						
					</div>
					<div class="box-content">

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('Coupon',array('url'=>array('controller'=>'/','action'=>'/editcoupon/'.$getcouponval['Coupon']['id'].'/'.$getcouponval['Coupon']['couponcode']),'id'=>'couponform'));
		
			echo $this->Form->input('code',array('type'=>'text','maxlength'=>'20','label'=>'Coupon code:','id'=>'couponcodes','class'=>'inputform','disabled','value'=>$getcouponval['Coupon']['couponcode']));
			echo '<div id="loading_img" style="display:none;">';
				echo '<img alt="Loading..." src="'.SITE_URL.'images/loading_blue.gif">';
			echo '</div>';
			//echo '<a id="generate_coupon" href="#" class="btn reg_btn">Generate coupons</a>';
			echo $this->Form->input('range',array('type'=>'text','maxlength'=>'20','label'=>'Coupon Usage Count:','id'=>'couponrange','class'=>'inputform','value'=>$getcouponval['Coupon']['validrange']));
			echo $this->Form->input('fromdate',array('type'=>'text','maxlength'=>'20','label'=>'Start date:','id'=>'deal-start','class'=>'input datepicker','value'=>$getcouponval['Coupon']['validfromdate']));
			echo $this->Form->input('enddate',array('type'=>'text','maxlength'=>'20','label'=>'Expire date:','id'=>'deal-end','class'=>'input datepicker','value'=>$getcouponval['Coupon']['validtodate']));
			/* echo "Discount type:";
			echo '<br clear="all" />';
			echo '<select name="dis_type" class="coupontype" >';
					echo '<option value=""> select</option>';
				if($getcouponval['Coupon']['coupontype'] == 'percent'){
					echo '<option value="percent" selected="selected">%</option>';
				}else{
					echo '<option value="percent" selected="selected">%</option>';
				}if($getcouponval['Coupon']['coupontype'] == 'fixed'){
					echo '<option value="fixed" selected="selected">$</option>';
				}else{
					echo '<option value="fixed">$</option>';
				}
			echo '</select>'; */
			echo $this->Form->input('coupontype',array('type'=>'hidden','name'=>'dis_type','value'=>'percent','class'=>'coupontype'));
			//echo $this->Form->input('amount',array('type'=>'text','maxlength'=>'20','label'=>'Discount amount:','class'=>'inputform','value'=>$getcouponval['Coupon']['discount_amount']));
			
			echo '<label>Discount percentage(%): <span class="currency_symbol"></span></label>';
			echo "<input type='text' maxlength='3' name='data[Coupon][amount]' id='amountss' value='".$getcouponval['Coupon']['discount_amount']."'>";
			echo '<br clear="all" />';
			echo "<input type='hidden' value='0' name='select_merchant' id='select_merchant'>";
				
			
			/* echo '<select name="select_merchant" id="select_merchant" >';
			if($getcouponval['Coupon']['select_merchant'] == '0'){
				echo '<option value="0" selected="selected">Apply Coupon to All product</option>';
			}else{
				echo '<option value="0">Apply Coupon to All product</option>';
			}
			if($getcouponval['Coupon']['select_merchant'] == '1'){
				echo '<option value="1" selected="selected">Apply Coupon to Select Merchant</option>';
			}else{
				echo '<option value="1">Apply Coupon to Select Merchant</option>';
			}
			echo '</select>	'; */
			
			echo '<br clear="all" />';
			?>
			<div id="invoice-popup-overlayss" style="display:none;">
			<div class="invoice-popup">
			<div id="merchantdetails_all">
			<table >
			<tr>
			<td>
			<?php 
			
			$merchnt_id[] = json_decode($getcouponval['Coupon']['merchant_ids']);
			
			
				//print_r($merchnt_id);die;
			
			foreach($getmerchant_name as $shopname){
				//echo $shopname['Shop']['user_id'];
				//print_r($merchnt_id);
				if(in_array($shopname['Shop']['user_id'],$merchnt_id[0])){
					//$select = "selected";
					echo '<span style=" margin-top: 10px; ">';
					echo "<input type='checkbox' name='merchant_id[]' value='".$shopname['Shop']['user_id']."' checked='checked' >";
					echo $shopname['Shop']['shop_name']."<br />";
					echo '</span>';
				}else{
					//$select = "";
					echo '<span style=" margin-top: 10px; ">';
					echo "<input type='checkbox' name='merchant_id[]' value='".$shopname['Shop']['user_id']."'  >";
					echo $shopname['Shop']['shop_name']."<br />";
					echo '</span>';
				}
				
			}
			echo '<a id="save_merchant" href="#" class="btn reg_btn">Save</a>';
			?>
			</td>
			</tr>			
			</table>
			</div>
			</div>
			</div>
			
			
			
			
			
			<?php
			echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Edit Coupon------->	





</div>

</div>

</div>


<style>
	
.show_hid{
	display:none;
}
</style>
<script>
var invajax=0;
