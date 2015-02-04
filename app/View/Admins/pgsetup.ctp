<body class=""> 
  <!--<![endif]-->
     
   
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Payment Gateway</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li class="active">Payment Gateway</li>
					</ul>
				</div>
			</div>
			
  
  
  			<!-----Paypal------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Paypal</h2>
						
					</div>
					<div class="box-content">

					<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('PaypalGateway',array('url'=>array('controller'=>'/','action'=>'/admin/pgsetup')));
				
			//	echo "<pre>";print_r($paystatus);die;
				//echo $paystatus['Sitesetting']['type'];
				//echo $paystatus['Sitesetting']['paypal_id'];die;
				
			$disableApi = '';
			if(count($paypalAdaptive) == 0){
				$status = 'paypalnormal';
			}else{
				$status = $paypalAdaptive['paymentMode'];
			}
			if ($status == 'paypalnormal')
				$disableApi = 'disabled';
			//echo $disableApi;
			
			if($paypalAdaptive['paymentMode']=="paypaladaptive")
			{
			echo '
				<legend>
					Paypal Payment Mode
				</legend>
				<label style="background:#FFFFFF;border:none;">
				<input type="radio" data-role="none" value="paypalnormal" onchange="paypalactive();" id="PaypalmodePaypalnormal" name="data[PaypalGateway][paypal_payment_mode]">
					Paypal Normal
					</label>
					<!--<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="paypaladaptive" checked="checked" onchange="paypalactive();" id="PaypalmodePaypaladaptive" name="data[PaypalGateway][paypal_payment_mode]">
					Paypal Adaptive
					</label>-->
			';
			}
			else if($paypalAdaptive['paymentMode']=="paypalnormal")
			{
			echo '
				<legend>
					Paypal Payment Mode
				</legend>
				<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="paypalnormal" checked="checked" onchange="paypalactive();" id="PaypalmodePaypalnormal" name="data[PaypalGateway][paypal_payment_mode]">
					Paypal Normal
					</label>
					<!--<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="paypaladaptive" onchange="paypalactive();" id="PaypalmodePaypaladaptive" name="data[PaypalGateway][paypal_payment_mode]">
					Paypal Adaptive
					</label>-->
			';
			}
			//echo $this->Form->input('paypal_payment_mode',array('type'=>'radio','id'=>'paypalmode','onchange'=>'paypalactive();','options'=>array('paypalnormal'=>'Paypal Normal','paypaladaptive'=>'Paypal Adaptive'),'label'=>'Type','default'=>$status));
			echo "<br clear='all' />";
				
			if(empty($paystatus['Sitesetting']['payment_type'])){
				$status = 'sandbox';
			}else{
				$status = $paystatus['Sitesetting']['payment_type'];
			}
			if($paystatus['Sitesetting']['payment_type']=="sandbox")
			{
			echo '
	
			<legend>
				Type
			</legend>
			<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="paypal" id="PaypalGatewayTypePaypal" name="data[PaypalGateway][type]">
				Paypal(Live)
			</label>
			<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="sandbox" checked="checked" id="PaypalGatewayTypeSandbox" name="data[PaypalGateway][type]">
				Sandbox(Test)
			</label>';
			}
			else if($paystatus['Sitesetting']['payment_type']=="paypal")
			{
			echo '
	
			<legend>
				Type
			</legend>
			<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="paypal" checked="checked" id="PaypalGatewayTypePaypal" name="data[PaypalGateway][type]">
				Paypal(Live)
			</label>
			<label style="background:#FFFFFF;border:none;">
				<input type="radio" value="sandbox" id="PaypalGatewayTypeSandbox" name="data[PaypalGateway][type]">
				Sandbox(Test)
			</label>';
			}
			//echo $this->Form->input('type',array('type'=>'radio','options'=>array('paypal'=>'Paypal(Live)','sandbox'=>'Sandbox(Test)'),'label'=>'Type','default'=>$status));
			echo "<br clear='all' />";
			
			echo $this->Form->input('paypal_id',array('type'=>'text','label'=>'Paypal Email Id:','id'=>'paypal_id','class'=>'input','data-role'=>'none','value'=>$paystatus['Sitesetting']['paypal_id']));
			echo "<br clear='all' />";
			
			/*echo $this->Form->input('paypal_api_userid',array('type'=>'text','label'=>'Paypal API User Id:',$disableApi=>'true','id'=>'paypal_api_userid','class'=>'disabled','data-role'=>'none','value'=>$paypalAdaptive['apiUserId']));
			echo "<br clear='all' />";
			
			echo $this->Form->input('paypal_api_password',array('type'=>'text','label'=>'Paypal API Password:',$disableApi=>'true','id'=>'paypal_api_password','class'=>'input disabled','data-role'=>'none','value'=>$paypalAdaptive['apiPassword']));
			echo "<br clear='all' />";
			
			echo $this->Form->input('paypal_api_signature',array('type'=>'text','label'=>'Paypal API Signature:',$disableApi=>'true','id'=>'paypal_api_signature','class'=>'input disabled','data-role'=>'none','value'=>$paypalAdaptive['apiSignature']));
			echo "<br clear='all' />";
			
			echo $this->Form->input('paypal_application_id',array('type'=>'text','label'=>'Paypal Application Id:',$disableApi=>'true','id'=>'paypal_application_id','class'=>'input disabled','data-role'=>'none','value'=>$paypalAdaptive['apiApplicationId']));
			echo "<br clear='all' />";*/
			
			echo $this->Form->submit('Update',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Paypal------->	
  
</div></div>
