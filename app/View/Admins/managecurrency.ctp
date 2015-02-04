<body class=""> 
  <!--<![endif]-->
    
 <div class="content">
 
  			<div class="box span12">
				<div class="box-header">
					<h2>Currency</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
   	<li class="active">Manage Currency</li>
			        </ul>
				</div>
			</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Currency</h2>
					</div>
					
						
				
					<div class="box-content">   
    
   <a href="<?php echo SITE_URL.'admin/add/currency/'; ?>" ><button class="btn btn-primary"><i class="icon-plus"></i> Add Currency </button></a>
  
<?php //echo $this->Html->link('Download all data(csv)',array('controller'=>'admins','action'=>'download'), array('target'=>'_blank','style'=>'font-size: 14px;')); ?>

<div id="loading_img" style="display:none;text-align:center;">
<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
</div>

  

<?php	
	echo "<div class='containerdiv'>";
		//echo "<div class='addctdivs'>";
			//echo $this->Html->link('Add Category',array('controller'=>'/','action'=>'/admin/add/category/'),array('class'=>'btn btn-success'));
		//echo "</div>";
		echo "<h3>Currency View:</h3>";
		echo "<div id='searchite'>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th>Id</th>";					
					echo "<th>Currency Code</th>";
					echo "<th>Currency Name</th>";
					//echo "<th>Recipient</th>";
					//echo "<th>Occasion</th>";
					echo "<th>Currency Symbol</th>";
					echo "<th>Rate</th>";
					//echo "<th>Created</th>";
					//echo "<th>Mark Featured</th>";
					echo "<th>Status</th>";
					echo "<th>Delete</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($getcurrencyval)){
					foreach($getcurrencyval as $key=>$temp){
					if ($temp['Forexrate']['status'] == "enable") {
						$buttonLabel = "Disable";
						$color = "btn-success";
					} else {
						$buttonLabel = "Enable";
						$color = "btn-warning";
					}
						$id = $temp['Forexrate']['id'];
						$currency_code = $temp['Forexrate']['currency_code'];
						$currency_name = $temp['Forexrate']['currency_name'];
						$currency_symbol = $temp['Forexrate']['currency_symbol'];
						$price = $temp['Forexrate']['price'];
						
						//echo "<tr id='item".$item_id."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							//echo "<td>".$this->Html->link($Item_name,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
						echo $this->Form->Create('forexrate',array('url'=>array('controller'=>'/','action'=>'/admin/edit/currency/'.$temp['Forexrate']['id']),'id'=>'Categoryform'));

							echo "<td>".$id."</td>";
							echo "<td>".$currency_code."</td>";
							echo "<td>".$currency_name."</td>";
							
							echo "<td>".$currency_symbol."</td>";
							//echo "<td>".$price."</td>";
							
							
							if ($temp['Forexrate']['price'] != 1){
								echo  '<td>'.$this->Form->input(''.$temp['Forexrate']['currency_code'].'',array('type'=>'text','class'=>'inputform','label' => '', 'value'=>$temp['Forexrate']['price'])).'</td>';
							}else{
								echo  '<td>'.$this->Form->input(''.$temp['Forexrate']['currency_code'].'',array('type'=>'text','class'=>'inputform', 'disabled','label' => '', 'value'=>$temp['Forexrate']['price'])).'</td>';
							}
					
			if($price == '1')
			{
			$color = "btn-default";
			echo "<td > <span id='status".$id."'>";
			echo "<button class='btn btn-inverse'>Default</button>";
			echo "</span></td>";
			echo "<td>&nbsp</td>";				
							
			}
			else
			{
			echo "<td > <span id='status".$id."'>";
			echo "<button class='btn ".$color."' onclick='return changeCurrencyStatus(".$id.",\"".$temp['Forexrate']['status']."\")'>".$buttonLabel."</button>";
			echo "</span></td>";
			echo '<td>
				 <a onclick = "deleteCurrency('.$id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></span></a></td>';
			}
			
				
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
//echo "<button class='btn ".$color."'>Save</button>";

echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
echo $this->Form->end();

	
	
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Forexrate']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Forexrate']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/currency/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
		
		
		
		
	echo "</div>";
		
	echo "</div>";
?>
     </div></div></div>
    
        </div>
    </div>
</div>
    


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>
