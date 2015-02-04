

						<?php

				
				echo "<div id='userdata'>";
					echo "Search results for : ".$sval;
			echo '<br>';
			echo '<a href="'.SITE_URL.'admin/payments/" style="text-decoration:underline;color:blue"><b><i>Clear Search Results</i></b></a>';		
	echo '<br /><br />';
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed" width="100%">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="cursor:pointer;">Order Id</th>';
								echo '<th style="cursor:pointer;">Invoice Id.</th>';
								echo '<th style="cursor:pointer;">Invoice No</th>';
								echo '<th style="cursor:pointer;">Invoice Date</th>';
								echo '<th style="cursor:pointer;">Invoice Status</th>';
								echo '<th style="cursor:pointer;">Payment Method</th>';
								echo '<th style="cursor:pointer;">View Invoice</th>';
							echo '</tr>';
							echo '<tbody>';
							if(!empty($userdet))
							{
								foreach($userdet as $user_det){
									$id=$user_det['Invoices']['invoiceid'];
									echo '<tr id="del_'.$id.'">';
									foreach($invoice_orders as $invoiceorders)
									{
										if($invoiceorders['Invoiceorders']['invoiceid']==$user_det['Invoices']['invoiceid'])
										{
											$invoice_order_id = $invoiceorders['Invoiceorders']['invoiceid'];
										}
									}
										echo '<td class="orderId">'.$invoice_order_id.'</td>';
										echo '<td class="invoiceId">'.$user_det['Invoices']['invoiceid'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Invoices']['invoiceno'].'</td>';
										$day=date('m/d/Y',$user_det['Invoices']['invoicedate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td class="invoiceStatus">'.$user_det['Invoices']['invoicestatus'].'</td>';
										echo '<td class="invoicePayMthd">'.$user_det['Invoices']['paymentmethod'].'</td>';
										echo '<td>
											<input type="button" class="btn btn-success" style="width:auto; margin-bottom: 12px; font-size: 11px;" onclick="showInvoicePopup(\''.$id.'\')" value="View">
											<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
									echo '</tr>';
								}
							}
							else
							{
								echo '<tr><td colspan="7" align="center">No Results Found</td></tr>';
							}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Invoices']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Invoices']['prevPage'];
		$this->passedArgs['searchval'] = $sval;
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/payments/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	

?>

  

  

<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>



</div>


<script>
$('#invoice-popup-overlay, .inv-close').live ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
	});
	

	
</script>
<style>
/**************Invoice Popup ************/


#invoice-popup-overlay {
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

#invoice-popup-overlay div.invoice-popup {
	width: 800px;
	margin: 92px auto;
}

#invoice-popup-overlay .invoice-popup div#userdata {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 25px 25px 100px;
}
</style>