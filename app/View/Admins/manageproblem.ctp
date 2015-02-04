<body class=""> 
  <!--<![endif]-->
    
    


    

 <div class="content">
         			<div class="box span12">
				<div class="box-header">
         <h2>Dispute Problem List</h2>
      </div>
      		<div class="box-content" style="margin-bottom:-20px;">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/manage/problemlist'; ?>">Problem List</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/add/dispquestion'; ?>">Create Problem Question</a> <span class="divider">/</span></li>
        </ul>
        </div>
        </div>
   

		
		<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Maanage Problem</h2>
						
					</div>
					<div class="box-content">

<?php	
	echo "<div class='containerdiv'>";
		echo "<br clear='all' />";
		echo "<div class='addctdivs'>";
			echo $this->Html->link('Add Problem Definition',array('controller'=>'/','action'=>'/admin/add/dispquestion/'),array('class'=>'btn btn-primary'));
		echo "</div>";
		//echo "<h3>Contact Seller Subjects:</h3>";
		echo "</br>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					
					echo "<th>Problem</th>";
					echo "<th>Edit/Delete</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($subject_data)){
					$subjects = json_decode($subject_data['Sitequeries']['queries'], true);
					foreach($subjects as $key=>$subject){
						echo "<tr id='subject".$key."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							echo "<td style='max-width: 600px;overflow: hidden;text-overflow: ellipsis;word-break:break-all;'>".$subject."</td>";
							
							echo "<td> 
							<a href='".SITE_URL."admin/add/dispquestion/".$key."' title='Edit'><span class='btn btn-info'><i class='icon-edit'></i></span></a>
							<a onclick='return confirm(\"Are You Sure Delete This Text?\");' href='".SITE_URL."/delete_disp_plm_admin/".$key."' title='Delete'> <span class='btn btn-danger'><i class='icon-trash'></i></span> </a>
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
			echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/problemlist/'),$this->passedArgs)));	
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
				</div><!--/span-->
			
			</div><!--/row-->
   	 </div>
      
  </div>

</div>

