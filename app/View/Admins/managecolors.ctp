<body class=""> 
  <!--<![endif]-->
    
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Colors</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/manage/colors'; ?>">Color</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/add/colors'; ?>">Add Colors</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Colors</h2>
					</div>
					
						
				
					<div class="box-content"> 
		
<?php
		echo "<div class='addctdivs'>";
			echo $this->Html->link('Add Color',array('controller'=>'/','action'=>'/admin/add/colors'),array('class'=>'btn btn-primary'));
		echo "</div>";
		echo "<br clear='all' />";


	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
						
				echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>Id</th>';
								echo '<th>Color Name</th>';
								echo '<th>RGB</th>';
								echo '<th>Date</th>';
								echo '<th>Action</th>';
							echo '</tr>';
							echo '<tbody>';
								foreach($getcolorval as $key=>$user_det){
									$id=$user_det['Color']['id'];
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceId">'.$user_det['Color']['id'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Color']['color_name'].'</td>';
										echo '<td class="invoiceNo">RGB('.$user_det['Color']['rgb'].')</td>';
										$day=date('m/d/Y',$user_det['Color']['cdate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td>'; ?>
										<a href="<?php echo SITE_URL.'admin/edit/color/'.$id;?> "><span class="btn btn-info"><i class="icon-edit"></i></span></a>	
		  								<a href="#" onclick='deletecolor("<?php echo $id; ?>")'><span class="btn btn-danger"><i class="icon-trash"></i></span></a>
		  							
		  							<?php	//echo "    <span class='btn btn-danger' onclick='pricedelete(".$id.")'>Delete</span>";
								
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Color']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Color']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/colors/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
			
					
					
		echo "</div>";
	echo "</div>";
	echo "</div>";
?>
   			
   	 </div>
      
  </div>

</div>

