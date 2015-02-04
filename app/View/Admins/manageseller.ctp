<body class=""> 
  <!--<![endif]-->
   


<div class="content">
     
      			<div class="box span12">
				<div class="box-header">
					<h2>Seller</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Manage Seller</li>
			        </ul>
				</div>
			</div>
     
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Seller</h2>
					</div>
					
						
				
					<div class="box-content">   
            
				
						<ul class="nav tab-menu nav-tabs">
      <li class="active"><a href="#" >Approved Sellers</a></li>
      <li><a href="<?php echo SITE_URL; ?>admin/manage/nonapproved_sellers/" >Pending Seller Approval</a></li>      
						</ul>            
            
    <!--a href="<?php //echo SITE_URL.'addmember/'; ?>" ><button class="btn btn-primary"><i class="icon-plus"></i> New User</button></a>
    <button class="btn">Import</button>
    <button class="btn">Export</button-->
  	<label  style="display: inline;margin-right: 10px;" >Search</label>
	<input type="text" name="search" style="color:#555555! important;margin-top:7px;" id="serchkeywrd" />
	<input type="button" id="srchSeller" name="submit" value="Search" class="btn btn-primary" style="margin: 0px 10px 10px; border-radius: inherit;vertical-align:inherit;" />
	<?php //echo $this->Html->link('Download all data(csv)',array('controller'=>'admins','action'=>'download'), array('target'=>'_blank','style'=>'font-size: 14px;')); ?>
	
	<div id="loading_img" style="display:none;text-align:center;">
	<img src="<?php echo SITE_URL; ?>images/loading_blue.gif" alt="Loading...">
	</div>
    <?php echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
						?>
						
    
        <?php 
        echo '<tr>';
			echo '<th>Seller Name</th>';
			echo '<th>Brand Name</th>';
			echo '<th>Email</th>';
			//echo '<th>Bank Acc. No.</th>';
			echo '<th>Phone No.</th>';
			echo '<th>Status</th>';
			echo '<th>Edit</th>';
		echo '</tr>'; 
		?>
		
      </thead>
      <tbody>
      <?php
  			foreach($sellerModel as $user_det){
				$id=$user_det['Shop']['id'];
				echo '<tr id="del_'.$id.'">';
					echo '<td>'.$user_det['User']['first_name'].'</td>';
					echo '<td>'.$user_det['Shop']['shop_name'].'</td>';
					echo '<td>'.$user_det['Shop']['paypal_id'].'</td>';
					//echo '<td>'.$user_det['Shop']['bank_account_no'].'</td>';
					echo '<td>'.$user_det['Shop']['phone_no'].'</td>';
					echo '<td id="status'.$id.'">';
					if ($user_det['Shop']['seller_status'] == 1) {
						echo '<button class="btn btn-warning" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$id.',\''.$user_det['Shop']['seller_status'].'\')">Disable</button></td>';
					} else {
						echo '<button class="btn btn-success" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$id.',\''.$user_det['Shop']['seller_status'].'\')">Enable</button></td>';
					}
				echo '<td>
      					<a href="'.SITE_URL.'admin/editseller/'.$id.'" style="cursor:pointer;"><span class="btn btn-info"><i class="icon-edit"></i></span></a>';
				echo '</tr>';
			}
        ?>
        
      </tbody>
      
      
      
      
    </table>
<?php
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Shop']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Shop']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/sellers/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
?>
      

    </div>
    </div>
   </div></div>                 
            
    


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>
