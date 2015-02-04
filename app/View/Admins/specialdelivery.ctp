<body class=""> 
  <!--<![endif]-->
  
    
   
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Special Delivery</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a  href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li class="active">Special Delivery</li>
			</ul>
		</div>
	</div>

	<!-----View Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Special Delivery</h2>
			</div>
			<div class="box-content">
						<?php
      echo "<div id='search_user1'>";
         echo "<div class='container-fluid'>";
             echo "<div id='userdata'>";
	             echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
		             echo '<thead>';
			             echo '<tr>';
				            echo '<th style="cursor:pointer;">Id</th>';
				            echo '<th style="cursor:pointer;">User Name</th>';
				            echo '<th style="cursor:pointer;">Item Name</th>';
				            echo '<th style="cursor:pointer;">Quantity</th>';
				            echo '<th style="cursor:pointer;">Size Options</th>';
				            echo '<th style="cursor:pointer;">Shipping Charges</th>';
				            echo '<th style="cursor:pointer;width:10%;">Edit</th>';
			             echo '</tr>';
			             echo '<tbody>';
			             foreach($getcharge as $key=>$shiping_char){
			                 if($shiping_char['Cart']['shipping_status'] == 'disable'){
							 $id=$shiping_char['Cart']['id'];
							 echo '<tr id="dcharg_'.$id.'">';
							    echo '<td>'.$shiping_char['Cart']['id'].'</td>';
							    foreach($users_info as $user_info){
							        if($user_info['id'] == $shiping_char['Cart']['user_id']){
							            $user_name = $user_info['first_name'];
								echo '<td>'.$user_name.'</td>';
								    break;
							        }
							    }
							    foreach($items_info as $item_info){
							        if($item_info['id'] == $shiping_char['Cart']['item_id']){
							            $item_name = $item_info['item_title'];
								echo '<td>'.$item_name.'</td>';
							        }
							    }
								echo '<td>'.$shiping_char['Cart']['quantity'].'</td>';
								echo '<td>'.$shiping_char['Cart']['size_options'].'</td>';
								echo '<td>'.$shiping_char['Cart']['shipping_charg'].'</td>';
								echo '<td>'; 
						?>
								<a href="<?php echo SITE_URL.'admin/edit_specialdelivery/'.$id;?> "><span class="btn btn-info"><i class="icon-edit"></i></span></a>
  							    <?php
						        echo '</td>';
							 echo '</tr>';
							 }
						}
						echo '</tbody>';
			         echo '</thead>';
				 echo '</table>';
	             echo '<div id="paypalfom"></div>';
                       if($pagecount > 0){						
                            $nextPage = $this->Paginator->params->paging['Cart']['nextPage'];
                            $prevPage = $this->Paginator->params->paging['Cart']['prevPage'];
                            if(!empty($nextPage) || !empty($prevPage)){
                          echo "<div  class='pagination pagination-centered'>";
                              echo '<ul>';
                              echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/specialdelivery/'),$this->passedArgs)));	
                                   echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
                                   echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
                                   echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
                             echo '<ul>';
                         echo "</div>";
                            }
                       }
				   echo "</div>";
		                       ?>
			   </div><!--/span-->
		   </div><!--/row-->
						<!-----View Commission------->	
        </div>
    </div>
</div>


