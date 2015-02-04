<body class=""> 
  <!--<![endif]-->
  
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Merchant Payment</h2>
				</div>
				<div class="box-content">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li class="active">Payments</li>
			        </ul>
				</div>
			</div>
 


  
						<!-----Export------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Export</h2>
					</div>
					
						
<div class="box-content">				
					
<?php

echo $this->Form->create('Orders');
echo $this->Form->input('orderdate',array('label'=>'Start date:', 'name'=>'start','class'=>'input datepicker','type'=>'text','onclick'=>'disabledates()','id'=>'deal-start'));
echo $this->Form->input('orderdate',array('label'=>'End date:', 'name'=>'end','class'=>'input datepicker','type'=>'text','onclick'=>'disabledates()','id'=>'deal-end'));

echo $this->Form->input('status',array('type' => 'select', 
    'options' => array('paid'=>'paid','delivered' => 'delivered', 'shipped' => 'shipped','processing' => 'processing' ,'' => 'pending')) );
echo $this->Form->submit('show',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
echo $this->Form->end();
?>
</div>
