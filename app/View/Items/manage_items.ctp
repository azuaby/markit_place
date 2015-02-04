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
   	<li class="active">Manage Product</li>
			        </ul>
				</div>
			</div>
 
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Items</h2>
					</div>
					
						
				
					<div class="box-content">   
					
			<ul class="nav tab-menu nav-tabs">
      <li class="active"><a href="#" >Approved Items</a></li>
      <li><a href="<?php echo SITE_URL; ?>admin/manage/nonapproved_items/" >Pending Item Approval</a></li>      
						</ul>  
					
<div class="btn-toolbar">
   <a href="<?php echo SITE_URL.'additem/'; ?>" ><button class="btn btn-primary"><i class="icon-plus"></i> Add Item </button></a>
    <a href="<?php echo SITE_URL.'admin/item/upload'; ?>" ><button style="margin-left:10px;" class="btn btn-primary">Import </button></a>
   <br clear='all' />
   <br clear='all' />
   <div class="btn-group">
  <label  style="display: inline;margin-right: 10px;">Search by Date:</label>
<input type="text" class="input datepicker" name="startDate" placeholder="Start Date" style="width: 100px;margin-right: 10px;color:#555555! important;" id="deal-start"/>

<input type="text" class="input datepicker" name="endDate" placeholder="End Date" style="width: 100px;margin-right: 10px;color:#555555! important;"  id="deal-end"/>
<label  style="display: inline;margin-right: 10px;" >Search</label>
<input type="text" name="search" placeholder="Search"  id="serchkeywrd" style="color:#555555! important;"/>
<input type="button" id="srchItms" name="submit" value="Search" class="btn btn-primary" style="margin: 0px 10px 10px; border-radius: inherit;" />
<?php //echo $this->Html->link('Download all data(csv)',array('controller'=>'admins','action'=>'download'), array('target'=>'_blank','style'=>'font-size: 14px;')); ?>

<div id="loading_img" style="display:none;text-align:center;">
<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
</div>

  
  
  
  
  </div>
</div> 


<?php	

		//echo "<div class='addctdivs'>";
			//echo $this->Html->link('Add Category',array('controller'=>'/','action'=>'/admin/add/category/'),array('class'=>'btn btn-success'));
		//echo "</div>";
		echo "<h3>Items View:</h3>";
		echo "<div id='searchite'>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th style='cursor:pointer;'>Id</th>";					
					echo "<th style='cursor:pointer;'>Item title</th>";
					//echo "<th>Recipient</th>";
					
					
					
					//echo "<th>Occasion</th>";
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
						//$recipient = $temp['Item']['recipient'];
						$recipient = $temp['Item']['id'];
						$occasion = $temp['Item']['occasion'];
						$price = $temp['Item']['price'];
						$quantity = $temp['Item']['quantity'];
						$size_options = $temp['Item']['size_options'];
						echo "<tr id='item".$item_id."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							//echo "<td>".$this->Html->link($Item_name,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							
							echo "<td>".$item_id."</td>";
							echo "<td style='max-width: 200px;word-break: break-all;text-overflow: ellipsis;'>".$item_title."</td>";
							
							//echo "<td>".$recipient."</td>";
							//echo "<td>".$occasion."</td>";
							echo "<td>".$price."</td>";
							echo "<td>".$quantity."</td>";
							echo "<td style='max-width: 200px;word-break: break-all;text-overflow: ellipsis;'>".$size_options."</td>";
							echo "<td>".date("m/d/Y",strtotime($temp['Item']['created_on']))."</td>";
							if ($temp['Item']['featured'] == 0){
								echo "<td><input type='checkbox' name='featured' id='featured".$item_id."' onchange='markfeature(\"$item_id\")' /></td>";
							}else{
								echo "<td><input type='checkbox' name='featured' id='featured".$item_id."' checked='checked' onchange='markfeature(\"$item_id\")' /></td>";
							}
							echo "<td > <span id='status".$item_id."'>";
								echo "<button class='btn ".$color."' style='font-size:11px;width:60px;' onclick='changeItemStatus(".$item_id.",\"".$temp['Item']['status']."\");'>".$buttonLabel."</button>";
		
							
							echo "</span></td>";
							echo '<td>
									<a class="viewitem" href="'.SITE_URL.'adminitemview/'.$item_id.'" target="_blank"><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a>
      								 <a href="'.SITE_URL.'admin/edititem/'.$item_id.'" style="cursor:pointer;"><span class="btn btn-info"><i class="icon-edit"></i></span></a>
      			 					 <a onclick = "deleteItem('.$item_id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></span></a></td>';
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
