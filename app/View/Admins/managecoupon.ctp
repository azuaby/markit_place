<body class=""> 
  <!--<![endif]-->
   
   
   
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Coupons</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a data-ajax="false" href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a data-ajax="false"  href="<?php echo SITE_URL.'admin/managecoupon'; ?>">Coupon</a> <span class="divider">/</span></li>
			           	<li><a data-ajax="false"  href="<?php echo SITE_URL.'admin/addcoupon'; ?>">Add Coupon</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>

				<!-----Manage Coupon------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Coupons</h2>
						
					</div>
					<div class="box-content">

						<?php
		echo "<div class='addctdivs' style='color:#ffffff;'>";

			//echo $this->Html->link('Add Coupon',array('controller'=>'/','action'=>'/admin/addcoupon'),array('class'=>'btn btn-success'));
		echo "</div>";
		


	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
								echo '<a data-ajax="false"  href="'.SITE_URL.'admin/addcoupon"><input type="button" class="btn btn-primary" value="Add Coupon"></a>';echo "<br /><br />";
				echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="cursor:pointer;">S.No</th>';
								echo '<th style="cursor:pointer;">Coupon code</th>';
								echo '<th style="cursor:pointer;">Type</th>';
								echo '<th style="cursor:pointer;">Total coupon</th>';
								echo '<th style="cursor:pointer;">Remaining</th>';
								echo '<th style="cursor:pointer;">Amount</th>';
								echo '<th style="cursor:pointer;">Start date</th>';
								echo '<th style="cursor:pointer;">Expire Date</th>';
								echo '<th style="cursor:pointer;">Created Date</th>';
								echo '<th style="cursor:pointer;">Valid all product</th>';
								echo '<th style="cursor:pointer;">Action</th>';
							echo '</tr>';
							echo '<tbody>';
							$i++;
								foreach($getcouponval as $key=>$user_det){
									$id=$user_det['Coupon']['id'];
									$couponcode=$user_det['Coupon']['couponcode'];
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceId">'.$i.'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['couponcode'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['coupontype'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['totalrange'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['validrange'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['discount_amount'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['validfromdate'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Coupon']['validtodate'].'</td>';
										$day=date('m/d/Y',$user_det['Coupon']['cdate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										$i++;
									
										if($user_det['Coupon']['select_merchant'] == '0'){
											echo '<td class="invoiceId">Yes</td>';
										}else{
											echo '<td class="invoiceId">No</td>';
										}
										?>
										<td>
										<a data-ajax="false"  href="<?php echo SITE_URL.'editcoupon/'.$id.'/'.$couponcode;?> "><span class="btn btn-info"><i class="icon-edit"></i></span></a>
		  								<a href="#" onclick='deletecoupon("<?php echo $id; ?>")'><span class="btn btn-danger"><i class="icon-trash"></i></span></a>
		  							
		  							<?php	
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Coupon']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Coupon']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/managecoupon/'),$this->passedArgs),'data-ajax'=>'false'));	
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
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Manage Coupon------->	
		

  
</div>

