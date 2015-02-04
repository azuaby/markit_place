<?php 
echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
echo '<thead>';
echo "<tr >";
//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
echo '<th>Seller Name</th>';
echo '<th>Brand Name</th>';
echo '<th>Email</th>';
//echo '<th>Bank Acc. No.</th>';
echo '<th>Phone No.</th>';
echo '<th>Status</th>';
echo '<th>Edit</th>';
echo "</tr>";
echo '<tbody>';
if(!empty($shop_datas)){
	foreach($shop_datas as $user_det){
				$id=$user_det['Shop']['id'];
				echo '<tr id="del_'.$id.'">';
					echo '<td>'.$user_det['User']['first_name'].'</td>';
					echo '<td>'.$user_det['Shop']['shop_name'].'</td>';
					echo '<td>'.$user_det['Shop']['paypal_id'].'</td>';
					//echo '<td>'.$user_det['Shop']['bank_account_no'].'</td>';
					echo '<td>'.$user_det['Shop']['phone_no'].'</td>';
					echo '<td id="status'.$id.'">';
					if ($user_det['Shop']['seller_status'] == 1) {
						echo '<button class="btn btn-warning" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$id.',\''.$user_det['Shop']['seller_status'].'\')">Disable</button></td>';
					} else {
						echo '<button class="btn btn-success" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$id.',\''.$user_det['Shop']['seller_status'].'\')">Enable</button></td>';
					}
				echo '<td>
      					<a href="'.SITE_URL.'admin/editseller/'.$id.'" style="cursor:pointer;"><span class="btn btn-info"><i class="icon-edit"></i></span></a>';
				echo '</tr>';
			}
}else{
	echo "<tr>";
	echo "<td colspan='6' align='center'>No record Found</td>";
	echo "</tr>";
}
echo '</tbody>';
echo '</thead>';
echo '</table>';


if($pagecount > 0){
	$nextPage = $this->Paginator->params->paging['Shop']['nextPage'];
	$prevPage = $this->Paginator->params->paging['Shop']['prevPage'];
	$this->passedArgs['searchval'] = $searchkywrd;
	if(!empty($nextPage) || !empty($prevPage)){
		echo "<div  class='pagination pagination-centered'>";
		echo '<ul>';
		echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/nonapproved_sellers/'),$this->passedArgs)));
		echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
		echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
		echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
		echo '<ul>';
		echo "</div>";
	}
}




echo "</div>";
?>
