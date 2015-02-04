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
					    <li class="active">Manage Seller Chat</li>
					</ul>
				</div>
			</div>


    
<div class="btn-toolbar">
   
</div> 



						<!-----Contacted Users------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Contacted Users</h2>
						
					</div>
					<div class="box-content">

<?php	
	echo "<div class='containerdiv'>";
		//echo "<div class='addctdivs'>";
			//echo $this->Html->link('Add Category',array('controller'=>'/','action'=>'/admin/add/category/'),array('class'=>'btn btn-success'));
		//echo "</div>";

		echo "<div id='searchite'>";
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";
					echo "<th>Id</th>";					
					echo "<th>Item Name</th>";
					echo "<th>Seller Name</th>";
					echo "<th>Chats</th>";
					echo "<th>Action</th>";
				echo "</tr>";
				echo '<tbody>';
				if(!empty($item_datas)){
					foreach($item_datas as $key=>$temp){
						$csid = $temp['Contactseller']['id'];
						$item_id = $temp['Contactseller']['itemid'];
						$itemName = $temp['Contactseller']['itemname'];
						$userName = $temp['Contactseller']['sellername'];
						$chatCount = $temp[0]['count'];
						echo "<tr id='cs".$csid."'>";
							echo "<td>".$csid."</td>";
							echo "<td style='word-break:break-all;'><a href='".SITE_URL.'adminitemview/'.$item_id."' title='View Item' target='_blank'>".$itemName."</a></td>";
							echo "<td>".$userName."</td>";
							echo "<td>".$chatCount." Chat(s)</td>";
							echo '<td>
							<a href="'.SITE_URL.'admin/itemconversation/'.$item_id.'" style="cursor:pointer;">Users List</a>
							</td>';
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
		$nextPage = $this->Paginator->params->paging['Dispute']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Dispute']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/contacteditem'),$this->passedArgs)));	
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
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Contacted Users------->	


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
