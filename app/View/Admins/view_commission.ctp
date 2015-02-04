<body class=""> 
  <!--<![endif]-->
  
    
   
   
    
<div class="content">


			<div class="box span12">
				<div class="box-header">
					<h2>Commission</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
						<li><a  href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li class="active"><a  href="<?php echo SITE_URL.'admin/viewcommission/'; ?>">Commision</a></li>
					</ul>
				</div>
			</div>
    




                    
<div class="btn-toolbar">
    <a  href="<?php echo SITE_URL.'admin/commission/'; ?>" ><input type="button" class="btn btn-primary" value="+ Add Commision"></a>
    <!--button class="btn">Import</button>
    <button class="btn">Export</button-->
  <div class="btn-group">
  </div>
</div>

	<!-----View Commission------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Commission</h2>
						
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
								echo '<th style="cursor:pointer;">Apply to</th>';
								echo '<th style="cursor:pointer;">Commission type</th>';
								echo '<th style="cursor:pointer;">Amount</th>';
								echo '<th style="cursor:pointer;">Min value</th>';
								echo '<th style="cursor:pointer;">Max value</th>';
								echo '<th style="cursor:pointer;">Date</th>';
								echo '<th style="cursor:pointer;">Details</th>';
								echo '<th style="cursor:pointer;">Status</th>';
								echo '<th style="cursor:pointer;width:10%;">Action</th>';
							echo '</tr>';
							echo '<tbody>';
								foreach($getcommivalue as $key=>$user_det){
									$id=$user_det['Commission']['id'];
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceId">'.$user_det['Commission']['id'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Commission']['applyto'].'</td>';
										echo '<td class="invoiceStatus">'.$user_det['Commission']['type'].'</td>';
										if($user_det['Commission']['type'] == '%'){
										echo '<td class="invoiceStatus">'.$user_det['Commission']['amount'].'%</td>';
										}else{
										echo '<td class="invoiceStatus">'.$_SESSION['currency_symbol'].$user_det['Commission']['amount'].'</td>';
										}
										echo '<td class="invoiceStatus" style="word-break:break-all;">'.$user_det['Commission']['min_value'].'</td>';
										echo '<td class="invoiceStatus" style="word-break:break-all;">'.$user_det['Commission']['max_value'].'</td>';
										$day=date('m/d/Y',$user_det['Commission']['cdate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td class="invoiceNo" style=" width: 30%;word-break: break-all;">'.$user_det['Commission']['commission_details'].'</td>';
										echo '<td>'; ?>
										<?php if($user_det['Commission']['active']=='0'){ ?>
		  								<a  href="<?php echo SITE_URL.'admin/activatecommission/dact@'.$id;?> "><input type="button" class="btn btn-success" style="width:75px; margin-bottom: 12px; font-size: 11px;"  value="Active" /></a>
		  								<?php }else{ ?>
		  								<a  href="<?php echo SITE_URL.'admin/activatecommission/act@'.$id;?> "><input type="button" class="btn btn-warning" style="width:75px; margin-bottom: 12px; font-size: 11px;"  value="Activated" /></a>
										<?php } ?>
										<?php 	
											echo '<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
										echo '<td>'; ?>
										<a  href="<?php echo SITE_URL.'admin/editcommission/'.$id;?> "><span class="btn btn-info"><i class="icon-edit" ></i></span></a>
										
										<?php echo '<a onclick = "deletecommision('.$id.');" role="button" data-toggle="modal" style="cursor:pointer;"><span class="btn btn-danger"><i class="icon-trash"></i></span></a>'; ?>
		  								<?php 	
											echo '<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Commission']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Commission']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/viewcommission/'),$this->passedArgs)));	
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
						<!-----View Commission------->	



   			
   			

   			
   	 </div>
      
  </div>
</div>


