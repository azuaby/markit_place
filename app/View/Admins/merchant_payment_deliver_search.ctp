
<?php

				
				echo "<div id='userdata'>";
			echo "Search results for : ".$sval;
			echo '<br>';
			echo '<a href="'.SITE_URL.'admin/merchant_payment_deliver/" style="text-decoration:underline;color:blue"><b><i>Clear Search Results</i></b></a>';			
			echo '<br /><br />';				
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
									echo '</tr>';
								}
							}
							else
							{
								echo '<tr><td colspan="9" align="center">No Results Found</td></tr>';
							}									
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Orders']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Orders']['prevPage'];
		$this->passedArgs['searchval'] = $sval;
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
			

?>

