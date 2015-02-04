<body class=""> 
  <!--<![endif]-->

   
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Category</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					   	<li class="active">Category</li>
			        </ul>
				</div>
			</div>
			
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Category</h2>
						
					</div>
					<div class="box-content">

<?php	
	echo "<div class='containerdiv'>";
		echo "<div class='addctdivs'>";
			echo $this->Html->link('Add Category',array('controller'=>'/','action'=>'/admin/add/category/'),array('class'=>'btn btn-primary'));
		echo "</div>";
		echo "<h3>Category View:</h3>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th>Category Name</th>";
					echo "<th>Category Parent</th>";
					echo "<th>Category Sub Parent</th>";
					echo "<th>Category Variant type</th>";
					echo "<th>Category Sub Variant</th>";
					echo "<th>Category Delivery type</th>";
					//echo "<th>Modification Date</th>";
					echo "<th>Delete/edit icon</th>";
					echo "<th>Created Date</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($main_catdata)){
					foreach($main_catdata as $suprs){
						$mnscns[$suprs['Category']['id']] = $suprs['Category']['category_name'];
						$cat_urlnme[$suprs['Category']['id']] = $suprs['Category']['category_urlname'];
					}
					//echo "<pre>";print_r($super_sub_catdata);die;
					foreach($super_sub_catdata as $key=>$temp){
						$secid = $temp['Category']['id'];
						$sec_parent = $temp['Category']['category_parent'];
						$sub_sec_parent = $temp['Category']['category_sub_parent'];
						
						$vsec_parent = $temp['Category']['category_vrintype'];
						$vsub_sec_parent = $temp['Category']['category_sub_vrintype'];

						$vdel_type = $temp['Category']['category_del_type'];
						$category_name = $temp['Category']['category_name'];
						$category_urlname = $temp['Category']['category_urlname'];
						echo "<tr id='catgy".$secid."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							echo "<td>".$this->Html->link($category_name,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							if(!empty($mnscns[$sec_parent])){
								//echo "<td>".$mnscns[$sec_parent]."</td>";
								echo "<td>".$this->Html->link($mnscns[$sec_parent],array('controller'=>'/','action'=>'/admin/edit/category/'.$sec_parent.'~'.$cat_urlnme[$sec_parent]))."</td>";
							}else{
								echo "<td>-</td>";
							}
							if(!empty($mnscns[$sub_sec_parent])){
								//echo "<td>".$mnscns[$sub_sec_parent]."</td>";
								echo "<td>".$this->Html->link($mnscns[$sub_sec_parent],array('controller'=>'/','action'=>'/admin/edit/category/'.$sub_sec_parent.'~'.$cat_urlnme[$sub_sec_parent]))."</td>";
							}else{
								echo "<td>-</td>";
							}
							
							if(!empty($vsec_parent)){
								//echo "<td>".$mnscns[$vsec_parent]."</td>";
								echo "<td>".$this->Html->link($vsec_parent,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							}else{
								echo "<td>-</td>";
							}
							if(!empty($vsub_sec_parent)){
								//echo "<td>".$mnscns[$vsub_sec_parent]."</td>";
								echo "<td>".$this->Html->link($vsub_sec_parent,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							}else{
								echo "<td>-</td>";
							}
							echo "<td>".$vdel_type."</td>";
							
							echo "<td>".date("m/d/Y",strtotime($temp['Category']['created_at']))."</td>";
							//echo "<td>".date("m/d/Y",strtotime($temp['Category']['modified_at']))."</td>";
						?>
							<td> <a href="<?php echo SITE_URL.'admin/edit/category/'.$secid.'~'.$category_urlname;?>"> <span class='btn btn-danger'><i class='icon-edit'></i></span></a></td>

							<?php
							echo "<td> <a onclick='deleteCategory(".$secid.");'> <span class='btn btn-danger'><i class='icon-trash'></i></span></td>";
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
		$nextPage = $this->Paginator->params->paging['Category']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Category']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/view/category/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
		
		
		
	echo "</div>";
?>
</div>

</div>

</div>
</div>
</div>
