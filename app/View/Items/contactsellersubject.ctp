<body class=""> 
  <!--<![endif]-->
    
   
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Contact Seller Subjects</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					   	<li class="active">Contact Seller Subjects</li>
					</ul>
				</div>
			</div>
 



						<!-----Contact Seller Subjects------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Contact Seller Subjects</h2>
						
					</div>
					<div class="box-content">

				
	<?php	
	echo "<div class='containerdiv'>";
		echo "<br clear='all' />";
		echo "<div class='addctdivs'>";
			echo $this->Html->link('+ Add Subject',array('controller'=>'/','action'=>'/admin/addcssubject/'),array('class'=>'btn btn-primary'));
		echo "</div>";
		//echo "<h3>Contact Seller Subjects:</h3>";
		echo "</br>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th style='cursor:pointer;'>Subject</th>";
					echo "<th style='cursor:pointer;'>Edit/Delete</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($subject_data)){
					$subjects = json_decode($subject_data['Sitequeries']['queries'], true);
					foreach($subjects as $key=>$subject){
						echo "<tr id='subject".$key."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							echo "<td>".$subject."</td>";
							
							echo "<td> 
							<a href='".SITE_URL."admin/addcssubject/".$key."' title='Edit'><span class='btn btn-info'><i class='icon-edit'></i></span></a>
							<a href='".SITE_URL."admin/deletecssubject/".$key."' title='Delete'><span class='btn btn-danger'> <i class='icon-trash' style='cursor:pointer;'></i></span> </a>
							</td>";
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
		$nextPage = $this->Paginator->params->paging['Sitequeries']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Sitequeries']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/contactsellersubject/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
		
		
		
	echo "</div>";
?>		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Contact Seller Subjects------->	



</div>

</div>
</div>

