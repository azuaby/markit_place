<body class=""> 
  <!--<![endif]-->
 
    
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Gift Card Logs</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
			           	<li><a href="<?php echo SITE_URL.'giftcard'; ?>">Gift Cards</a> <span class="divider">/</span></li>
			        </ul>
				</div>
			</div>

        <!-----Gift Card Logs------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Gift Card Logs</h2>
						
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
								echo '<th style="cursor:pointer;">Receiver name</th>';
								echo '<th style="cursor:pointer;">Email</th>';
								echo '<th style="cursor:pointer;">Sender name</th>';
								echo '<th style="cursor:pointer;">Amount</th>';
								echo '<th style="cursor:pointer;">Date</th>';
								echo '<th style="cursor:pointer;">Usage</th>';
							echo '</tr>';
							echo '<tbody>';
							$i = 1;
								foreach($giftcardlogval as $key=>$user_det){
									$id=$user_det['Giftcard']['id'];
									echo '<tr id="del_'.$id.'">';
										echo '<td class="invoiceNo">'.$i.'</td>';
										echo '<td class="invoiceNo">'.$user_det['Giftcard']['reciptent_name'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Giftcard']['reciptent_email'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['User']['username'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Giftcard']['amount'].'</td>';
										$day=date('m/d/Y',$user_det['Giftcard']['cdate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td><a href="'.SITE_URL.'giftcardorders/'.$user_det['Giftcard']['id'].'">View</a></td>';
										$i++;
										
								}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
			echo '<div id="paypalfom"></div>';
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Giftcard']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Giftcard']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/giftcardlog/'),$this->passedArgs)));	
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
						<!-----Gift Card Logs------->	
        


   			
   	 </div>
      
  </div>

</div>

