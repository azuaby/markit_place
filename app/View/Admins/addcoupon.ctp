
<body class=""> 
  <!--<![endif]-->
     
   
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Coupons</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a data-ajax="false" href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a data-ajax="false" href="<?php echo SITE_URL.'admin/managecoupon'; ?>">Coupon</a> <span class="divider">/</span></li>
			            <li class="active">Add Coupon</li>
			        </ul>
				</div>
			</div>
 
 

            
  
					<!-----Add Coupon------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Coupons</h2>
						
					</div>
					<div class="box-content">

		<?php
	echo "<div class='containerdiv'>";

		echo $this->Form->Create('Coupon',array('url'=>array('controller'=>'/','action'=>'/admin/addcoupon'),'id'=>'couponform'));
		
			echo $this->Form->input('code',array('type'=>'text','maxlength'=>'20','label'=>'Coupon code:','id'=>'couponcodes','class'=>'inputform'));
			echo '<div id="loading_img" style="display:none;">';
				echo '<img alt="Loading..." src="'.SITE_URL.'images/loading_blue.gif">';
			echo '</div>';
			echo '<a id="generate_coupon" href="#"><input type="button" class="btn btn-primary" value="Generate coupons"></a>';
			echo $this->Form->input('range',array('type'=>'text','maxlength'=>'20','label'=>'Coupon Usage Count:','id'=>'couponrange','class'=>'inputform'));
			echo $this->Form->input('fromdate',array('type'=>'text','maxlength'=>'20','label'=>'Start date:','id'=>'deal-start','class'=>'input datepicker','onclick'=>'disabledates()'));
			echo $this->Form->input('enddate',array('type'=>'text','maxlength'=>'20','label'=>'Expire date:','id'=>'deal-end','class'=>'input datepicker','onclick'=>'disabledates()'));
			//echo "Discount type:";
			//echo '<br clear="all" />';
			/* echo '<select name="dis_type" class="coupontype" id="coupontype">';			
				echo '<option value="">select</option>';		
				echo '<option value="percent">%</option>';
				echo '<option value="fixed">$</option>';
			echo '</select>'; */
			echo $this->Form->input('coupontype',array('type'=>'hidden','name'=>'dis_type','value'=>'percent','class'=>'coupontype'));
			//echo $this->Form->input('amount',array('type'=>'text','maxlength'=>'20','label'=>'Discount amount:','class'=>'inputform'));
			echo '<label>Discount percentage(%): <span class="currency_symbol"></span></label>';
			echo "<input type='text' maxlength='3' name='data[Coupon][amount]' id='amountss'>";
				
			echo "<input type='hidden' value='0' name='select_merchant' id='select_merchant'>";
			//echo '<select name="select_merchant" id="select_merchant" >';
				//echo '<option value="0">Apply Coupon to All product</option>';
				//echo '<option value="1">Apply Coupon to Select Merchant</option>';
			//echo '</select>	';
			
			echo '<br clear="all" />';
			?>
			<div id="invoice-popup-overlayss" style="display:none;">
			<div class="invoice-popup">
			<div id="merchantdetails_all">
			<table >
			<tr>
			<td>
			<?php foreach($getmerchant_name as $shopname){
				echo '<span style=" margin-top: 10px; ">';
					echo "<input type='checkbox' name='merchant_id[]' value='".$shopname['Shop']['user_id']."' >";
					echo $shopname['Shop']['shop_name']."<br />";
				echo '</span>';
			}
			
			
			
			echo '<a id="save_merchant" href="#"><input type="button"  class="btn btn-primary" value="Save"></a>';
			
			?>
			</td>
			</tr>			
			</table>
			</div>
			</div>
			</div>
			<?php
			echo '<input type="checkbox" name="data[onetimeuse]">Restrict to one time use for one user';
			echo '<br />';
			echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Add Coupon------->	
			





</div>




<style>
	
.show_hid{
	display:none;
}
</style>
<script>
var invajax=0;
</script>
