<body class=""> 
  <!--<![endif]-->
  
    
   
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Allowed Countries</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a  href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li class="active"><a  href="<?php echo SITE_URL.'admin/allowcountries/'; ?>">Allowed Delivery Countries</a></li>
			</ul>
		</div>
	</div>
    <div class="btn-toolbar">
        <a  href="<?php echo SITE_URL.'admin/add/allowcountries/'; ?>" ><input type="button" class="btn btn-primary" value="+ Add Country"></a>
        <!--button class="btn">Import</button>
        <button class="btn">Export</button-->
        <div class="btn-group"></div>
    </div>

	<!-----View Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Allowed Countries</h2>
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
				            echo '<th style="cursor:pointer;">Allowed countries</th>';
				            echo '<th style="cursor:pointer;width:10%;">Action</th>';
			             echo '</tr>';
			             echo '<tbody>';
			             foreach($getcntry as $key=>$country_det){
							 $id=$country_det['Allowedcountries']['id'];
							 echo '<tr id="alcntry_'.$id.'">';
								echo '<td>'.$country_det['Allowedcountries']['id'].'</td>';
								echo '<td>'.$country_det['Allowedcountries']['country'].'</td>';
								echo '<td>'; 
						?>
								<a href="<?php echo SITE_URL.'admin/edit/allowcountries/'.$id;?> "><span class="btn btn-info"><i class="icon-edit"></i></span></a>
  								<a href="#" onclick='alcntry_delete("<?php echo $id; ?>")'><span class="btn btn-danger"><i class="icon-trash"></i></span></a>
  							    <?php
						        echo '</td>';
							 echo '</tr>';
						}
						echo '</tbody>';
			         echo '</thead>';
				 echo '</table>';
	             echo '<div id="paypalfom"></div>';
                       if($pagecount > 0){						
                            $nextPage = $this->Paginator->params->paging['Allowedcountries']['nextPage'];
                            $prevPage = $this->Paginator->params->paging['Allowedcountries']['prevPage'];
                            if(!empty($nextPage) || !empty($prevPage)){
                          echo "<div  class='pagination pagination-centered'>";
                              echo '<ul>';
                              echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/allowcountries/'),$this->passedArgs)));	
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


