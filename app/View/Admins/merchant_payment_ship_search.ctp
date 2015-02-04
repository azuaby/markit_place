
  
<?php

				echo "<div id='userdata'>";
			echo "Search results for : ".$sval;
			echo '<br>';
			echo '<a href="'.SITE_URL.'admin/merchant_payment_ship/" style="text-decoration:underline;color:blue"><b><i>Clear Search Results</i></b></a>';		
			echo '<br /><br />';				
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>Order no.</th>';
								echo '<th>Merchant name</th>';
								echo '<th>Shipped Status</th>';
								echo '<th>Delivered Date</th>';
								echo '<th>Currency</th>';
								echo '<th>Amount</th>';
							echo '</tr>';
							echo '<tbody>';
							if(!empty($getitemuser))
							{								
								foreach($getitemuser as $key=>$user_det){
									$id=$user_det['Orders']['orderid'];
									//echo $order_status;
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceId">'.$user_det['Orders']['orderid'].'</td>';
										echo '<td class="invoiceNo">'.$usernames[$user_det['Orders']['merchant_id']].'</td>';
										echo '<td class="invoiceStatus">'.$order_status[$id].'</td>';
										$day=date('m/d/Y',$user_det['Orders']['status_date']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td class="invoiceId">'.$order_currency[$id].'</td>';
										echo '<td class="invoicePayMthd">'.$order_totalcost_ognl[$id].'</td>';
										//echo '<td class="invoicePayMthd">'.$order_totalcost[$key].'</td>';
										
										//echo '<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
									echo '</tr>';
								}
							}
							else
							{
								echo '<tr><td colspan="6" align="center">No Results Found</td></tr>';
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
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/merchant_payment_ship/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
			
?>
