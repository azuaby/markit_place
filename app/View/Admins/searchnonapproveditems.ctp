<?php 
echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
echo '<thead>';
echo "<tr >";
//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
echo "<th style='cursor:pointer;'>Id</th>";
echo "<th style='cursor:pointer;'>Item title</th>";
echo "<th style='cursor:pointer;'>Price</th>";
echo "<th style='cursor:pointer;'>Quantity</th>";
echo "<th style='cursor:pointer;'>Size Options</th>";
echo "<th style='cursor:pointer;'>Created</th>";
echo "<th style='cursor:pointer;'>Mark Featured</th>";
echo "<th style='cursor:pointer;'>Status</th>";
echo "<th style='cursor:pointer;'>View/Edit/Delete</th>";
echo "</tr>";
echo '<tbody>';
if(!empty($item_datas)){
	foreach($item_datas as $key=>$temp){
		if ($temp['Item']['status'] == "draft") {
			$buttonLabel = "Publish";
			$color = "btn-success";
		} else {
			$buttonLabel = "Draft";
			$color = "btn-warning";
		}
		$item_id = $temp['Item']['id'];
		$item_title = $temp['Item']['item_title'];
		$item_description = $temp['Item']['item_description'];
		$recipient = $temp['Item']['recipient'];
		$quantity = $temp['Item']['quantity'];
		$quantity_sold = $temp['Item']['quantity_sold'];
		$price = $temp['Item']['price'];
		$fav_count = $temp['Item']['fav_count'];
		$cateIdd = $temp['Item']['category_id'];
		echo "<tr id='item".$item_id."'>";
		echo "<td>".$item_id."</td>";
		echo "<td style='max-width: 200px;word-break: break-all;text-overflow: ellipsis;'>".$item_title."</td>";
		echo "<td>".$price."</td>";
		echo "<td>".$quantity."</td>";
		echo "<td style='max-width: 200px;word-break: break-all;text-overflow: ellipsis;'>".$size_options."</td>";	
		echo "<td>".date("m/d/Y",strtotime($temp['Item']['created_on']))."</td>";
		if ($temp['Item']['featured'] == 0){
			echo "<td><div class='checker'><span><input type='checkbox' name='featured' id='featured".$item_id."' onchange='markfeature(\"$item_id\")' /></span></div></td>";
		}else{
			echo "<td><div class='checker'><span><input type='checkbox' name='featured' id='featured".$item_id."' checked='checked' onchange='markfeature(\"$item_id\")' /></span></div></td>";
		}
		echo "<td > <span id='status".$item_id."'>";
		echo "<button class='btn ".$color."' style='font-size:11px;width:60px;' onclick='changeItemStatus(".$item_id.",\"".$temp['Item']['status']."\");'>".$buttonLabel."</button>";
			
		echo "</span></td>";
		echo '<td>
		<a class="viewitem" href="'.SITE_URL.'adminitemview/'.$item_id.'" target="_blank"><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a>
      	 <a href="'.SITE_URL.'admin/edititem/'.$item_id.'" style="cursor:pointer;"><span class="btn btn-info"><i class="icon-edit"></i></span></a>
		 <a onclick = "deleteItem('.$item_id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></i></a></td>';
		echo "</tr>";
	}
}else{
	echo "<tr><td colspan='9' align='center'>";
	echo "No record Found";
	echo "</td></tr>";
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
		echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/nonapproved_items/'),$this->passedArgs)));
		echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
		echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
		echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
		echo '<ul>';
		echo "</div>";
	}
}




echo "</div>";
?>
