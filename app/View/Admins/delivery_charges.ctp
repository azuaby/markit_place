<body class=""> 
  <!--<![endif]-->
  
    
   
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Delivery Charges</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a  href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li class="active"><a  href="<?php echo SITE_URL.'admin/deliverycharges/'; ?>">Delivery Charges Countries</a></li>
			</ul>
		</div>
	</div>
    <div class="btn-toolbar">
        <a  href="<?php echo SITE_URL.'admin/deliveryarea/'; ?>" ><input type="button" class="btn btn-primary" value="+ Add Area"></a>
        <!--button class="btn">Import</button>
        <button class="btn">Export</button-->
        <div class="btn-group"></div>
    </div>

	<!-----View Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Delivery Charges</h2>
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
				            echo '<th style="cursor:pointer;">Zone name</th>';
				            echo '<th style="cursor:pointer;">Regular Delivery charge</th>';
				            echo '<th style="cursor:pointer;">Express Delivery charge</th>';
				            echo '<th style="cursor:pointer;width:10%;">Action</th>';
			             echo '</tr>';
			             echo '<tbody>';
			             foreach($getchargeval as $key=>$del_det){
							 $id=$del_det['Deliverycharge']['id'];
							 echo '<tr id="dchar_'.$id.'">';
								echo '<td>'.$del_det['Deliverycharge']['id'].'</td>';
								echo '<td>'.$del_det['Deliverycharge']['name'].'</td>';
								echo '<td>'.$del_det['Deliverycharge']['regulr_chrge'].'</td>';
								echo '<td>'.$del_det['Deliverycharge']['expres_chrge'].'</td>';
								echo '<td>'; 
						?>
								<a href="<?php echo SITE_URL.'admin/edit/delcharge/'.$id;?> "><span class="btn btn-info"><i class="icon-edit"></i></span></a>
  								<a href="#" onclick='areadelete("<?php echo $id; ?>")'><span class="btn btn-danger"><i class="icon-trash"></i></span></a>
  							    <?php
						        echo '<td>';
							 echo '</tr>';
						}
						echo '</tbody>';
			         echo '</thead>';
				 echo '</table>';
	             echo '<div id="paypalfom"></div>';
                       if($pagecount > 0){						
                            $nextPage = $this->Paginator->params->paging['Deliverycharge']['nextPage'];
                            $prevPage = $this->Paginator->params->paging['Deliverycharge']['prevPage'];
                            if(!empty($nextPage) || !empty($prevPage)){
                          echo "<div  class='pagination pagination-centered'>";
                              echo '<ul>';
                              echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/deliverycharges/'),$this->passedArgs)));	
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


