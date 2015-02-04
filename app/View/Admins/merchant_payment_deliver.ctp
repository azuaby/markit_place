<body class=""> 
  <!--<![endif]-->
  
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Merchant Payment</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li class="active">Payments</li>
			        </ul>
				</div>
			</div>
 

  
						<!-----Merchant payment------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Merchant Payment</h2>
					</div>
					
						
				
					<div class="box-content">
					<ul class="nav tab-menu nav-tabs">
      <li><a href="<?php echo SITE_URL; ?>admin/merchant_payment/">New Orders</a></li>
      <li><a href="<?php echo SITE_URL; ?>admin/merchant_payment_ship/" >Shipped</a></li>      
      <li class="active"><a href="#" >Delivered</a></li>
      <li><a href="<?php echo SITE_URL; ?>admin/merchant_payment_paid/" >Approved</a></li>
						</ul>

	  
<?php

echo '<button value="show" class="btn btn-primary" onclick="show_export()">Export Orders to CSV</button>';
echo '<br />';
echo 'Search : <input type="text" id="ordersearchval"  style="margin-top:7px;"> 
<input type="text" id="sdate" class="input datepicker" placeholder="Start Date" style="margin-top:7px;color:#555555! important;">
<input type="text" id="edate" class="input datepicker" placeholder="End Date" style="margin-top:7px;color:#555555! important;">
<button class="btn btn-primary" onclick="deliver_order_search()" style="vertical-align:inherit;">Search</button>';
	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
		/*echo "<div class='row-fluid'>";
			//echo $this->element('admin_menu');          ,'onkeyup'=>'search_func(usersrchSrch);'
			echo "<div class='span10'>";
				echo "<div class='srchdiv'>";
					echo $this->Form->Create('usersrch',array('url'=>array('controller'=>'/','action'=>'/admin/user/management'),'id'=>'sectionform'));
						echo $this->Form->input('srch', array('type' =>'text','placeholder'=>'search by username','value'=>$srcs,'label'=>false,'class'=>'celebname_sel','style'=>'float:left;','div'=>false,'onkeyup' => "search_func();"));
						echo "<div class='btnsubmt'>";
							//echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-success'));
						echo "</div>";	
					echo $this->Form->end();	
				echo "</div>";
				echo "<br claer='all'/>";
				echo "<br claer='all'/>";*/
				
				echo "<div id='userdata'>";
if($sval!="")
{
	echo "Search results for : ".$sval;
			echo '<br>';
			echo '<a href="'.SITE_URL.'admin/merchant_payment_deliver/" style="text-decoration:underline;color:blue"><b><i>Clear Search Results</i></b></a>';	
	echo '<br /><br />';	
}				
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="cursor:pointer;">Order no.</th>';
								echo '<th style="cursor:pointer;">Merchant name</th>';
								echo '<th style="cursor:pointer;">Shipped Status</th>';
								echo '<th style="cursor:pointer;">Delivered Date</th>';
								echo '<th style="cursor:pointer;">Amount</th>';
								echo '<th style="cursor:pointer;">Except Commission</th>';
								echo '<th style="cursor:pointer;">Currency</th>';
								echo '<th style="cursor:pointer;">Status</th>';
								echo '<th style="cursor:pointer;">Payment</th>';
								echo '<th style="cursor:pointer;">View</th>';
							echo '</tr>';
							echo '<tbody>';
							if(!empty($getitemuser))
							{								
								foreach($getitemuser as $key=>$user_det){
									$amount = 0;
									$id=$user_det['Orders']['orderid'];
									//echo $order_status;
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceId">'.$user_det['Orders']['orderid'].'</td>';
										echo '<td class="invoiceNo">'.$usernames[$user_det['Orders']['merchant_id']].'</td>';
										echo '<td class="invoiceStatus">'.$order_status[$id].'</td>';
										$day=date('m/d/Y',$user_det['Orders']['status_date']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td class="invoicePayMthd">'.$order_totalcost_ognl[$id].'</td>';
										if($order_totalcost[$id]==''){
											$amount = $order_totalcost_ognl[$id];											
										}else{
											$amount = $order_totalcost[$id];
											//$amount += $order_totalcostShipping_ognl[$id];
										}
										
										echo '<td class="invoicePayMthd">'.$amount.'</td>';
										
										echo '<td class="invoiceId">'.$order_currency[$id].'</td>';
										echo '<td class="invoiceId">Pending</td>';
										echo '<td>'; 
										?>
											<input type="hidden" id="currency<?php echo $id; ?>" value="<?php echo $order_currency[$id]; ?>" />
											<input type="button" class="btn btn-success" style="width: auto; margin-bottom: 12px; font-size: 11px;"  value="Approve" onclick="checkouttomer('<?php echo $usernames[$user_det['Orders']['merchant_id']]."', '".$amount."', '".$user_det['Orders']['orderid'];?>')"/>
		  								
										<?php 
											echo '<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
										echo '<td>
									<a class="viewitem" href="'.SITE_URL.'viewDeliver/'.$id.'" ><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a></td>';
									echo '</tr>';
								}
							}
							else
							{
								echo '<tr><td colspan="10" align="center">No Results Found</td></tr>';
							}															
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Orders']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Orders']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/merchant_payment_deliver/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
			
					

	echo "</div>";
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Merchant payment------->	
  
  
  
  
  

  

<div id="invoice-popup-overlay1">
	<div class="invoice-popup">
	<div id="userdata" class="invoice-datas">
	<button class="btn btn-danger inv-close" onclick="close_button()" style="width: 90px; margin: 14px 6px 0px; font-size: 11px;float:right;">Back</button>
	
<?php
echo '<table>';
echo $this->Form->Create('Orders',array('url'=>array('controller'=>'/','action'=>'/admin/merchant_payment_export')));
echo '<tr><td>';
echo $this->Form->input('orderdate',array('label'=>'Start date:', 'name'=>'start','class'=>'input datepicker','type'=>'text','id'=>'deal-start'));
echo '</td>';
echo '<td>';
echo $this->Form->input('orderdate',array('label'=>'End date:', 'name'=>'end','class'=>'input datepicker','type'=>'text','id'=>'deal-end'));
echo '</td><td>';

echo $this->Form->input('status',array('name'=>'status','type' => 'select', 
    'options' => array('Paid'=>'Paid','Delivered' => 'Delivered', 'Shipped' => 'Shipped','Processing' => 'Processing' ,'' => 'Pending')) );
    echo '</td><td>';
echo $this->Form->submit('Export',array('onclick'=>'close_button()','div'=>false,'class'=>'btn btn-primary reg_btn','style'=>'margin-top:13px;'));
echo '</td></tr>';
echo $this->Form->end();
echo '</table>';
?>
	
	</div>
</div>

</div>

</div>



<style>
/**************Invoice Popup ************/


#invoice-popup-overlay1 {
	background: none repeat scroll 0 0 rgba(31, 33, 36, 0.898);
    display: none;
    height: 100%;
    left: 0;
    opacity: 0;
    overflow: scroll;
    padding: 0 24px 24px 0;
    position: fixed;
    top: 0;
    transition: opacity 0.2s ease 0s;
    width: 100%;
    z-index: 12;
}

#invoice-popup-overlay1 div.invoice-popup {
	width: 800px;
	margin: 92px auto;
}

#invoice-popup-overlay1 .invoice-popup div#userdata {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 25px 25px 100px;
}
</style>