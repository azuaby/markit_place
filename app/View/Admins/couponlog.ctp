<body class=""> 
  <!--<![endif]-->
  
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Coupon Logs</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'admin/managecoupon'; ?>">Coupon</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'couponlog'; ?>">Coupon Logs</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>

			<!-----Logs Coupons------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Coupon Logs</h2>
						
					</div>
					<div class="box-content">

				
	
			
<?php
echo "<br clear='all' />";
		echo "<div class='addctdivs'>";
			//echo $this->Html->link('Add Coupon',array('controller'=>'/','action'=>'/admin/addcoupon'),array('class'=>'btn btn-success'));
		echo "</div>";


	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
						
				echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="cursor:pointer;">S.No</th>';
								echo '<th style="cursor:pointer;">Coupon Code</th>';
								echo '<th style="cursor:pointer;">Username</th>';
								echo '<th style="cursor:pointer;">Order Id</th>';
								echo '<th style="cursor:pointer;">Order Status</th>';
								echo '<th style="cursor:pointer;">Date</th>';
								echo '<th style="cursor:pointer;">View</th>';
							echo '</tr>';
							echo '<tbody>';
							$i = 1;
								foreach($getlogcouponval as $key=>$user_det){
		
									$id=$user_det['Logcoupon']['id'];

									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceNo">'.$i.'</td>';
										foreach($coupon_values as $coupons)
										{
											if($coupons['Coupon']['id']==$user_det['Logcoupon']['coupon_id'])
											{
												$couponcode = $coupons['Coupon']['couponcode'];
											}
										}

																						
										echo '<td class="invoiceNo">'.$couponcode.'</td>';
										echo '<td class="invoiceNo">'.$user_det['User']['username'].'</td>';
										$day=date('m/d/Y',$user_det['Logcoupon']['cdate']);
										foreach($order_det as $orderdetails)
										{
											if($orderdetails['Orders']['coupon_id']==$user_det['Logcoupon']['coupon_id'] && $orderdetails['Orders']['userid']==$user_det['Logcoupon']['user_id'] && $orderdetails['Orders']['orderdate']==$user_det['Logcoupon']['cdate'])
											{
												$orderId = $orderdetails['Orders']['orderid'];
												$orderStatus = $orderdetails['Orders']['status'];
												if($orderStatus=="")
												$orderStatus = "Pending";
												else
												$orderStatus = $orderdetails['Orders']['status'];
											}
										}										
										echo '<td class="orderId">'.$orderId.'</td>';
										echo '<td class="orderStatus">'.$orderStatus.'</td>';
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td>
									<a class="viewitem" href="'.SITE_URL.'viewCoupon/'.$orderId.'" ><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a></td>';
										$i++;
									
										
								}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Logcoupon']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Logcoupon']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/couponlog/'),$this->passedArgs)));	
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
?>		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Logs Coupons------->	
			
		

   			
   	 </div>
      
  </div>

</div>

