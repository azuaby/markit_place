<body class=""> 
  <!--<![endif]-->
  
   
   
   
 <div class="content">
 
  
  			<div class="box span12">
				<div class="box-header">
					<h2>Currency</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/manage/currency'; ?>">Currency</a> <span class="divider">/</span></li>
            <li class="active">Add Currency</li>
			        </ul>
				</div>
			</div>
						
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Currency</h2>
					</div>
					
						
				
					<div class="box-content">  

<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('Forexrate',array('url'=>array('controller'=>'/','action'=>'/admin/add/currency'),'id'=>'Categoryform'));
		
			echo $this->Form->input('Currency Code',array('options' => array('Select Currency' => 'Select Currency','KWD' => 'KWD','SAR' => 'SAR','AUD' => 'AUD', 'BRL' => 'BRL', 'CAD' => 'CAD', 'CZK' => 'CZK', 'DKK' => 'DKK', 'EUR' => 'EUR', 'HKD' => 'HKD', 'HUF' => 'HUF', 'ILS' => 'ILS', 'JPY' => 'JPY', 'MYR' => 'MYR', 'MXN' => 'MXN', 'NOK' => 'NOK', 'NZD' => 'NZD', 'PHP' => 'PHP', 'PLN' => 'PLN', 'GBP' => 'GBP', 'RUB' => 'RUB', 'SGD' => 'SGD', 'SEK' => 'SEK', 'CHF' => 'CHF', 'TWD' => 'TWD', 'THB' => 'THB', 'TRY' => 'TRY', 'USD' => 'USD' ), 'id' => 'currency_code', 'onchange' => 'currencyCode();'));
				
			echo $this->Form->input('Currency Name',array('options' => array('Kuwaiti Dinnar' => 'Kuwaiti Dinnar','Saudi Riyal' => 'Saudi Riyal','Australian Dollar' => 'Australian Dollar', 'Brazilian Real' => 'Brazilian Real', 'Canadian Dollar' => 'Canadian Dollar', 'Czech Koruna' => 'Czech Koruna', 'Danish Krone' => 'Danish Krone', 'Euro' => 'Euro', 'Hong Kong Dollar' => 'Hong Kong Dollar', 'Hungarian Forint' => 'Hungarian Forint', 'Israeli New Sheqel' => 'Israeli New Sheqel', 'Japanese Yen' => 'Japanese Yen', 'Malaysian Ringgit' => 'Malaysian Ringgit', 'Mexican Peso' => 'Mexican Peso', 'Norwegian Krone' => 'Norwegian Krone', 'New Zealand Dollar' => 'New Zealand Dollar', 'Philippine Peso' => 'Philippine Peso', 'Polish Zloty' => 'Polish Zloty', 'Pound Sterling' => 'Pound Sterling', 'Russian Ruble' => 'Russian Ruble', 'Singapore Dollar' => 'Singapore Dollar', 'Swedish Krona' => 'Swedish Krona', 'Swiss Franc' => 'Swiss Franc', 'Taiwan New Dollar' => 'Taiwan New Dollar', 'Thai Baht' => 'Thai Baht', 'Turkish Lira' => 'Turkish Lira', 'U.S. Dollar' => 'U.S. Dollar' ), 'value' => ''.$_SESSION['curr'].'', 'type' => 'hidden'));
			
			//echo $this->Form->input('Currency Name', array('value' => ''.$currency_name['USD'].''));
			echo $this->Form->input('Currency Symbol', array('options' => array('K.D.' => 'K.D.','Riyal' => 'Riyal','$' => '$', 'R$' => 'R$', 'C$' => 'C$', 'Kč' => 'Kč', 'kr.' => 'kr.', '€' => '€', 'HK$' => 'HK$', 'Ft' => 'Ft', '₪' => '₪',  '£' => '£', 'RM' => 'RM', 'Mex$' => 'Mex$', 'kr' => 'kr', '₱' => '₱', 'zł' => 'zł', 'руб' => 'руб', 'CHF' => 'CHF', 'NT$' => 'NT$', '฿' => '฿', 'も' => 'も', '¥' => '¥'  ), 'value' => ''.$_SESSION['cur'].'', 'type' => 'hidden'));
			   
		
			
			echo $this->Form->input('Rate',array('type'=>'text','maxlength'=>'20','label'=>'Rate:','id'=>'currency_rate','class'=>'inputform'));
		
			echo $this->Form->input('Status', array('options' => array('enable' => 'Enable', 'disable' => 'Disable')));
			?>
			<?php
			echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
			echo $this->Form->end();
	echo "</div>";
?>


</div>

</div>

</div>



<style>
	
.show_hid{
	display:none;
}
</style>
