<body class=""> 
  <!--<![endif]-->
    
    <?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>


    


 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Dispute</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li class="active">Dispute</li>
					</ul>
				</div>
			</div>

	
						<!-----Dispute Management------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Dispute Management</h2>
						
					</div>
					<div class="box-content">

				
	 <?php	
	echo "<div class='containerdiv'>";
	echo "<br clear='all' />";
		
		
		echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
			echo '<thead>';
				echo "<tr >";
					//echo "<th>".$this->Form->input('',array('type'=>'checkbox'))."</th>";

					echo "<th style='cursor:pointer;'>Order ID</th>";
					echo "<th style='cursor:pointer;'>User Name</th>";
					echo "<th style='cursor:pointer;'>Seller Name</th>";
					echo "<th style='cursor:pointer;'>Problem</th>";
					echo "<th style='cursor:pointer;'>Current Status</th>";
					echo "<th style='cursor:pointer;'>Change Status</th>";
					echo "<th style='cursor:pointer;'>Action</th>";



					
				echo "</tr>";
				echo '<tbody>';
				if(!empty($order_data)){
					foreach($order_data as $orders){
					//print_r($orders);
						/*$disid = $temp['Dispute']['disid'];
						$uid = $temp['Dispute']['userid'];
						$uoid = $temp['Dispute']['uorderid'];
						$ona = $temp['Dispute']['uorderstatus'];
						$uorplm = $temp['Dispute']['uorderplm'];
						$uomsg = $temp['Dispute']['uordermsg'];
						$una = $temp['Dispute']['uname'];
						$uem = $temp['Dispute']['uemail'];
						$sn = $temp['Dispute']['sname'];
						$sem = $temp['Dispute']['semail'];
						$sid = $temp['Dispute']['selid'];
						$status = $temp['Dispute']['status'];
						//$resostatus = $temp['Dispute']['resolvestatus'];
						echo "<tr id='scatgys".$disid."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							echo "<td>".$uoid."</td>";
							echo "<td>".$una."</td>";
							echo "<td>".$sn."</td>";
							echo "<td>".$uorplm."</td>";
							//echo "<td>".$resostatus."</td>";*/
							//echo $orders['datas'][0]['Order']['status'];
						$id = $orders['id'];
						$disid = $orders['disid'];
						$uname = $orders['uname'];
						$sname = $orders['sname'];
						$pbm = $orders['pbm'];	 
						echo "<tr id='scatgys".$disid."'>";
							//echo "<td>".$this->Form->input('',array('type'=>'checkbox'))."</td>";
							echo "<td>".$id."</td>";
							echo "<td>".$uname."</td>";
							echo "<td>".$sname."</td>";
							echo "<td>".$pbm."</td>";
							
							echo "<td class='status".$id."'>";
							if($orders['datas'][0]['Order']['status'] == ''){
									echo "Pending";
							}else{
								echo $orders['datas'][0]['Order']['status'];
							}

							echo "</td>";	
							
							echo "<td>";
							
						?>
						<form name="search_form" id="search_form">  
						
						<?php 
							if($orders['datas'][0]['Order']['status'] == ''){
								$options = array('Pending' => 'Pending', 'Processing' => 'Processing','Shipped' => 'Shipped', 'Delivered' => 'Delivered');
								echo $this->Form->input(''.$id.'', array( 'type' => 'select','label' => '' ,'class' =>'resolvestatus'.$id.'','onchange'=> "disputestatus('$id');",'options' => $options,'selected' => 'Pending'));
							}else{
                                $options = array('Pending' => 'Pending', 'Processing' => 'Processing','Shipped' => 'Shipped', 'Delivered' => 'Delivered'); 
                                echo $this->Form->input(''.$id.'', array( 'type' => 'select','label' => '' ,'class' =>'resolvestatus'.$id.'','onchange'=> "disputestatus('$id');",'options' => $options,'selected' => $orders['datas'][0]['Order']['status'])); 
                                //echo $ajax->submit('update', array('url'=>array('controller'=>'deals', 'action'=>'cart'), 'update' =>'shoppingcart')); 
							}  
                              //  echo $this->Form->end(); ?>
                              </form>  
                                <?php 
						echo "</td>";
						
						echo '<td><a href="'.SITE_URL.'admin/user/view_dispute/'.$disid.'"><span class="btn btn-success"><i class="icon-zoom-in"></i></span></a>';
						//echo "<td><span class='btn btn-success'>";
						//echo $this->Html->link('',array('controller'=>'/','action'=>'/admin/user/view_dispute/'.$disid),array('class'=>'icon-zoom-in'));
						//echo '</span>';
						echo '<a><span class="btn btn-danger"><i class="icon-trash" style="cursor:pointer;" onclick="deletedisp('.$disid.')"></i></span></a> ';
						
						echo "</td>";
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
				echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/user/dispute/'),$this->passedArgs)));
				echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
				echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
				echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
				echo "</div>";
			}
		}
		
		
		
		
		
	echo "</div>";
?>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Dispute Management------->	
   		

</div>
</div>



<script type="text/javascript">
function disputestatus(uoid){
	if (confirm("Are you sure you want to Change this Dispute? ")) {
	var BaseURL=getBaseURL();
	var selector = '.resolvestatus'+uoid;
	var status = '.status'+uoid;
	var resolvestatus = $(selector).val();
	//var uoid = $('#uoid :selected').val();
	//var status = $(select).val();
	
	$(status).html(resolvestatus);
	
	$.ajax({
	      url: BaseURL+"dispstatus",
	      type: "post",
	      data : { 'uoid': uoid, 'resolvestatus': resolvestatus},
	      
		 
	});
	return true;
	}return false;
}




</script>
