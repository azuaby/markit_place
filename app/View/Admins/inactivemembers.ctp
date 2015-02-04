<body class=""> 
  <!--<![endif]-->




<div class="content">
        
    			<div class="box span12">
				<div class="box-header">
					<h2>Inactive Users</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo SITE_URL."admin/user/management/"; ?>">Users</a> <span class="divider">/</span></li>
    <li class="active">Inactive Users</li>
			        </ul>
				</div>
			</div>          
        
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Contacted Users</h2>
						
					</div>
					<div class="box-content">
<div class="btn-toolbar">
	<span style='font-size:14px;vertical-align:middle;' class='deleterecordcnt'><?php echo $pagecount." record(s) found"; ?></span>
    <a href="javascript:deleteinactiveusers();" style='margin-left: 10px;' ><button class="btn btn-primary">Delete All</button></a>
    <!--button class="btn">Import</button>
    <button class="btn">Export</button-->
    <br clear="all" />
    </div>
<div class="btn-group">
  <table><tr><td>
  <label>Search:</label>
  </td><td>
  <?php 
  echo "<input type='text' name='searchfield' id='usersrchSrch' placeholder='' style='color:#555555! important;' onkeyup='inactive_search_func();' />";
  
  ?>
  </td><td>
  <select onChange='inactive_search_func()' class='inactivedays'>
  	<option value='10'>10 days</option>
  	<option value='20'>20 days</option>
  	<option value='30' selected>30 days</option>
  </select>
  </td></tr></table>
  
</div>
    
    <?php echo "<div id='userdata'>";
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
						?>
						
    
        <?php 
        echo '<tr>';
			echo '<th>#</th>';
			echo '<th>User Name</th>';
			//echo '<th>City</th>';
			echo '<th>Email</th>';
			echo '<th>Registered on</th>';
			echo '<th>Status</th>';
			echo '<th>Action</th>';
		echo '</tr>'; 
		?>
		
      </thead>
      <tbody>
      <?php
  			foreach($userdet as $user_det){
				$id=$user_det['User']['id'];
				echo '<tr id="del_'.$id.'">';
					echo '<td><input type="checkbox" value="'.$id.'" name="user'.$id.'" class="inactiveuser"/></td>';
					echo '<td>'.$user_det['User']['username'].'</td>';
					//echo '<td>'.$user_det['User']['city'].'</td>';
					echo '<td>'.$user_det['User']['email'].'</td>';
					$day=date('d M ,Y  H:i:s',strtotime($user_det['User']['created_at']));
					echo '<td>'.$day.'</td>';
					echo '<td id="status'.$id.'">';
					if ($user_det['User']['user_status'] == 'enable') {
						echo '<button class="btn btn-warning" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeUserStatus('.$id.',\''.$user_det['User']['user_status'].'\')">Disable</button></td>';
					} else {
						echo '<button class="btn btn-success" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeUserStatus('.$id.',\''.$user_det['User']['user_status'].'\')">Enable</button></td>';
					}
					echo '<td>
					<a href="'.SITE_URL.'admin/edit/user/'.$id.'"><span class="btn btn-info"><i class="icon-edit"></i></span></a>
					<a onclick="deleteusrlists('.$id.')"><span class="btn btn-danger"><i class="icon-trash" style="cursor:pointer;"></i></span></a> </td>';
				echo '</tr>';
			}
        ?>
        
      </tbody>
      
      
      
      
    </table>
    
    <input type='hidden' value='<?php echo $pagecount; ?>' class='inactivecnt' />
    <div class='deleteselectbtn' style='text-align:right;'>
    	<a href="javascript:deleteinactiveselected();" >
    		<button class="btn btn-primary">
    			Delete Selected
    			<img class='deleteselectload' src='<?php echo SITE_URL.'images/loading.gif'?>' style="width: 18px; display: none;" />
    		</button>
    	</a>
    </div>
    <b>Note : </b>This page shows all the users who registered with "<?php echo SITE_NAME; ?>" and not yet activated.
<?php
	
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['User']['nextPage'];
		$prevPage = $this->Paginator->params->paging['User']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination' style='float: right; position: relative; right: 200px;'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/inactivemembers/'),$this->passedArgs)));	
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
                   </div>
                   </div> 
            
    


    <script type="text/javascript">
    	var oldperiod = 30;
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>



				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
