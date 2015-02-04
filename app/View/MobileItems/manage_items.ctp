<body class=""> 
  <!--<![endif]-->

   
   
   
   
 <div class="content">
 <div class="ui-body ui-body-a">
 
     <h4 class="page-title">Product</h4>

  </div>
   <div class="ui-body ui-body-a">
<ul class="breadcrumb">
    <li><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL.'mobile/'; ?>">Home</a> <span class="divider">/</span></li>
   	<li class="active">Manage Product</li>
</ul>
</div><br />
  <div class="ui-body ui-body-a">
<div class="container-fluid">
    <div class="row-fluid">
    
<div class="btn-toolbar">
  
   <div class="">
    <a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL.'mobile/additem/'; ?>" >
	  <input type="button" value="+ Add Item" class="btn btn-primary">
	  </a>
  <div style="with:98% ! important;height:auto;overflow:hidden;">
  	
	 
	
	<div style="width:49%;float:left;text-align:center;">
  
  <label  style="display: inline;margin-right: 10px;">Search by Date:</label>
<input type="text" name="startDate" placeholder="Start Date" style="margin-right: 10px;" id="deal-start"/>

<input type="text" name="endDate" placeholder="End Date" style="margin-right: 10px;"  id="deal-end"/>
</div>
<div style="width:49%;float:right;">
<label  style="display: inline;margin-right: 10px;" >Search by keyword</label>
<input type="text" name="search" placeholder="Search your Keyword"  id="serchkeywrd" />
<input type="button" id="srchItms" name="submit" value="Search" class="btn btn-primary" style="margin: 0px 10px 10px; border-radius: inherit;" />
</div></div>
<?php //echo $this->Html->link('Download all data(csv)',array('controller'=>'admins','action'=>'download'), array('target'=>'_blank','style'=>'font-size: 14px;')); ?>

<div id="loading_img" style="display:none;text-align:center;">
<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
</div>

  
  
  
  
  </div>
</div> 

<div class="">
   
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      
      
      
      
      						<!-----Item table------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Items View:</h2>
						
					</div>
					<div class="box-content">
					<?php
						echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th style='width:5%;'>Id</th>";					
					echo "<th>Item title</th>";
					echo "<th>Item description</th>";
					//echo "<th>Recipient</th>";
					//echo "<th>Occasion</th>";
					echo "<th style='width:5%;'>Price</th>";
					echo "<th style='width:5%;'>Quantity</th>";
					echo "<th style='width:5%;'>Created</th>";
					echo "<th style='width:5%;'>Mark Featured</th>";
					echo "<th style='width:7%;'>Status</th>";
					echo "<th style='width:15%;'>View/Edit/Delete</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($item_datas)){
					foreach($item_datas as $key=>$temp){
					if ($temp['Item']['status'] == "draft") {
						$buttonLabel = "Publish";
						$color = "label label-success";
					} else {
						$buttonLabel = "Draft";
						$color = "label";
					}
						$item_id = $temp['Item']['id'];
						$item_title = $temp['Item']['item_title'];
						$item_description = $temp['Item']['item_description'];
						//$recipient = $temp['Item']['recipient'];
						$recipient = $temp['Item']['id'];
						$occasion = $temp['Item']['occasion'];
						$price = $temp['Item']['price'];
						$quantity = $temp['Item']['quantity'];
						echo "<tr id='item".$item_id."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							//echo "<td>".$this->Html->link($Item_name,array('controller'=>'/','action'=>'/admin/edit/category/'.$secid.'~'.$category_urlname))."</td>";
							
							echo "<td>".$item_id."</td>";
							echo "<td>".$item_title."</td>";
							echo "<td>".$item_description."</td>";
							//echo "<td>".$recipient."</td>";
							//echo "<td>".$occasion."</td>";
							echo "<td>".$price."</td>";
							echo "<td>".$quantity."</td>";
							
							echo "<td>".date("m/d/Y",strtotime($temp['Item']['created_on']))."</td>";
							if ($temp['Item']['featured'] == 0){
								echo "<td><input type='checkbox' name='featured' id='featured".$item_id."' onchange='markfeature(\"$item_id\")' /></td>";
							}else{
								echo "<td><input type='checkbox' name='featured' id='featured".$item_id."' checked='checked' onchange='markfeature(\"$item_id\")' /></td>";
							}
							echo "<td > <span id='status".$item_id."'>";
								echo "<input type='button' class='".$color."' onclick='changeItemStatus(".$item_id.",\"".$temp['Item']['status']."\");' value='".$buttonLabel."'>";
		
							
							echo "</span></td>";
							echo '<td>
									<a data-ajax="false" class="viewitem" href="'.SITE_URL.'mobile/adminitemview/'.$item_id.'" target="_blank"><span class="btn btn-success"><i class="icon-zoom-in "></i> </span></a>
      								<a data-ajax="false" href="'.SITE_URL.'mobile/admin/edititem/'.$item_id.'" style="cursor:pointer;"><span class="btn btn-info"><i class="icon-edit "></i></span> </a>
      			 					<a onclick = "deleteItem('.$item_id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash "></i></span> </a></td>';
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
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/mobile/admin/manage/items/'),$this->passedArgs),'data-ajax'=>'false'));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
	?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Item table------->	
      
      
      


     </div></div></div>
     
 <footer>
    <hr>
	<!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
    <p class="pull-right">A <a href="#" target="_blank">Markit Social eCommerce</a> by <a href="http://simplit.co" target="_blank">Simpl!t Co.</a></p>
	&copy; <?PHP echo date("Y").' <a href="#" target="_blank">'.$setngs[0]['Sitesetting']['site_name'].'</a>';?>
</footer>
    
        </div>
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
