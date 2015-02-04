<body class=""> 
  <!--<![endif]-->
    
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Tax Rates</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/tax_rates'; ?>">Tax Rates</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/add/tax'; ?>">Add Tax</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>
			<?php
  		echo "<div class='btn-toolbar'>";
		echo '<a href="'.SITE_URL.'admin/add/tax" class="btn btn-primary"><i class="icon-plus"></i> Add Tax</a>';
		echo "</div>";
		?>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Tax Rates</h2>
					</div>
					
						
				
					<div class="box-content"> 
		
<?php



	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
						
				echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
						echo '<th>S.No</th>';
						echo '<th>Country Name</th>';
						echo '<th>Tax Name</th>';
						echo '<th>Percentage (%) </th>';
						echo '<th>Status</th>';
						echo '<th>Action</th>';
						echo '</thead>';
						echo '<tbody>';
						$i = 0;
						if(!empty($taxrates))
						{
							foreach($taxrates as $taxes)
							{
								$tax_id = $taxes['Tax']['id'];
								$i++;
								echo '<tr id="del_'.$tax_id.'">';
								echo '<td>'.$i.'</td>';
								echo '<td>'.$taxes['Tax']['countryname'].'</td>';
								echo '<td>'.$taxes['Tax']['taxname'].'</td>';
								echo '<td>'.$taxes['Tax']['percentage'].'</td>';
								echo '<td>'.$taxes['Tax']['status'].'</td>';
								echo '<td>
								<a href="'.SITE_URL.'admin/edit/tax/'.$taxes['Tax']['id'].'"><span class="btn btn-info"><i class="icon-edit"></i></span></a>
								<a href="#" onclick="delete_tax('.$tax_id.')"><span class="btn btn-danger"><i class="icon-trash"></i></span></a>
								</td>';
								echo '</tr>';
							}
						}
						else
						{
							echo '<tr><td colspan="6" align="center">No taxes found</td></tr>';
						}
						echo '</tbody>';
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

