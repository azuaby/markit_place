<body class=""> 
  <!--<![endif]-->
   
   
   
 <div class="content">
 			<div class="box span12">
				<div class="box-header">
					<h2>Product</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					   	<li class="active">Manage Shared Items</li>
			        </ul>
				</div>
			</div>
  
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Shared Items</h2>
					</div>
					
						
				
					<div class="box-content">    
  <label  style="display: inline;margin-right: 10px;">Search by Date:</label>
<input type="text" class="input datepicker" name="startDate" placeholder="Start Date" style="width: 100px;margin-right: 10px;color:#555555! important;margin-top:7px;" id="deal-start"/>

<input type="text" class="input datepicker" name="endDate" placeholder="End Date" style="width: 100px;margin-right: 10px;color:#555555! important;margin-top:7px;"  id="deal-end"/>
<label  style="display: inline;margin-right: 10px;" >Search by keyword</label>
<input type="text" name="search" placeholder="Search your Keyword" style="color:#555555! important;margin-top:7px;" id="serchkeywrd" />
<input type="button" id="srchAffiliate" name="submit" value="Search" class="btn btn-primary" style="margin: 0px 10px 10px; border-radius: inherit;vertical-align:inherit;" />
<?php //echo $this->Html->link('Download all data(csv)',array('controller'=>'admins','action'=>'download'), array('target'=>'_blank','style'=>'font-size: 14px;')); ?>

<div id="loading_img" style="display:none;text-align:center;">
<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
</div>

  
  
  

<?php	
		echo "<div id='searchite'>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th>Id</th>";					
					echo "<th>Item title</th>";
					echo "<th>Item description</th>";
					//echo "<th>Recipient</th>";
					
					
					
					//echo "<th>Occasion</th>";
					echo "<th>Price</th>";
					//echo "<th>Quantity</th>";
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
						//$recipient = $temp['Item']['recipient'];
						$recipient = $temp['Item']['id'];
						$occasion = $temp['Item']['occasion'];
						$price = $temp['Item']['price'];
						$redirect = $temp['Item']['bm_redircturl'];
						echo "<tr id='item".$item_id."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							//echo "<td>".$this->Html->link($Item_name,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							
							echo "<td>".$item_id."</td>";
							echo "<td>".$item_title."</td>";
							echo "<td style='max-width: 300px;word-break: break-all;text-overflow: ellipsis;'>".$item_description."</td>";
							//echo "<td>".$recipient."</td>";
							//echo "<td>".$occasion."</td>";
							echo "<td>".$price."</td>";
							//echo "<td>".$quantity."</td>";
							
							echo "<td>".date("m/d/Y",strtotime($temp['Item']['created_on']))."</td>";

							echo "<td style='display: inline-block;max-width: 300px;word-break: break-all;text-overflow: ellipsis;'><a style='color:#333333;' href='".$redirect."' target='_blank'>".$redirect."</td>";
							
							echo '<td style="min-width:100px;">
									<a class="viewitem" href="'.SITE_URL.'adminitemview/'.$item_id.'" target="_blank"><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a>
      								
      			 					<a onclick = "deleteItem('.$item_id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></span></a></td>';
						echo "</tr>";
					}
				}else{
					echo "<tr><td colspan='8' align='center'>";
						echo "No record Found";
					echo "</td></tr>";
				}
				echo '</tbody>';
			echo '</thead>';
		echo '</table>';
		
	
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Item']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Item']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/affiliate/'),$this->passedArgs)));	
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
