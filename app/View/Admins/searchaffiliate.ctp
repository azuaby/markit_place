<?php 
echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
echo '<thead>';
echo "<tr >";
//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
echo "<th>Id</th>";
echo "<th>Item title</th>";
echo "<th>Item description</th>";
echo "<th>Price</th>";

echo "<th>Created</th>";
echo "<th>Item url</th>";

echo "<th>View/Delete</th>";
echo "</tr>";
echo '<tbody>';
if(!empty($item_datas)){
	foreach($item_datas as $key=>$temp){
		
		$item_id = $temp['Item']['id'];
		$item_title = $temp['Item']['item_title'];
		$item_description = $temp['Item']['item_description'];
		$recipient = $temp['Item']['recipient'];
		$quantity = $temp['Item']['quantity'];
		$quantity_sold = $temp['Item']['quantity_sold'];
		$price = $temp['Item']['price'];
		$redirect = $temp['Item']['bm_redircturl'];
		$fav_count = $temp['Item']['fav_count'];
		$cateIdd = $temp['Item']['category_id'];
		echo "<tr id='item".$item_id."'>";
		echo "<td>".$item_id."</td>";
		echo "<td>".$item_title."</td>";
		echo "<td style='max-width: 300px;word-wrap: break-all;text-overflow: ellipsis;'>".$item_description."</td>";
		echo "<td>".$price."</td>";
		///echo "<td>".$quantity."</td>";
			
		echo "<td>".date("m/d/Y",strtotime($temp['Item']['created_on']))."</td>";
		
		echo "<td style='max-width: 500px;word-wrap: break-all;text-overflow: ellipsis;'><a style='color:#333333;' href='".$redirect."' target='_blank'>".$redirect."</td>";
		echo '<td>
		<a class="viewitem" href="'.SITE_URL.'adminitemview/'.$item_id.'" target="_blank"><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a>
    
		 <a onclick = "deleteItem('.$item_id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></span></a></td>';
		echo "</tr>";
	}
}else{
	echo "<tr>";
	echo "No record Found";
	echo "</tr>";
}
echo '</tbody>';
echo '</thead>';
echo '</table>';


if($pagecount > 0){
	$nextPage = $this->Paginator->params->paging['Item']['nextPage'];
	$prevPage = $this->Paginator->params->paging['Item']['prevPage'];
	$this->passedArgs['serchkeywrd']=$searchkywrd;
	if(!empty($nextPage) || !empty($prevPage)){
		echo "<div  class='pagination pagination-centered'>";
		echo '<ul>';
		echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/items/'),$this->passedArgs)));
		echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
		echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
		echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
		echo '<ul>';
		echo "</div>";
	}
}




echo "</div>";
?>
