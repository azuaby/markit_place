<body class=""> 
  <!--<![endif]-->




<div class="content">
        
			<div class="box span12">
				<div class="box-header">
					<h2>Users</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
    					<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    					<li class="active">Users</li>
					</ul>
				</div>
			</div>

	
 
					<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Users</h2>
						
						
					</div>
					<div class="box-content">
						<ul class="nav tab-menu nav-tabs">
      <li class="active"><a href="#" >Approved Users</a></li>
      <li><a href="<?php echo SITE_URL; ?>admin/manage/nonapproved_users/" >Pending User Approval</a></li>      
						</ul>     					
    <div style="width:98% !important;height:auto;overflow:hidden;margin-top:-7px;margin-bottom:-20px;">
    <div style="width:70%;float:left;">
		<div class="btn-toolbar">
	    <a href="<?php echo SITE_URL.'addmember/'; ?>" ><button class="btn btn-primary"><i class="icon-plus"></i> New User</button></a>
	    <a href="<?php echo SITE_URL.'inactivemembers/'; ?>" style='margin-left: 10px;' ><button class="btn btn-primary">View Inactive Users</button></a>
	    <!--button class="btn">Import</button>
	    <button class="btn">Export</button-->
	    <br clear="all" />
	    </div>
	   </div>
	   <div style="width:28%;float:right;">
  <div class="btn-group" style="margin-top:4px;">
  <label>Search:
  <?php 
  echo "<input type='text' style='background:#ffffff;border:1px solid;color:#555555! important;margin-top:7px;' name='searchfield' id='usersrchSrch' onkeyup='search_func();'>";
  ?>
  </label>
  
  
</div>
</div></div><br />
    
    <?php echo "<div id='userdata'>";
    if($srcs!="")
    {
	    echo 'Search results for : <b>'.$srcs.'</b>';
	    echo '<br /><br />';
   	}
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
						?>
						
    
        <?php 
        echo '<tr>';
			echo '<th>User Name</th>';
			//echo '<th>City</th>';
			echo '<th>Email</th>';
			echo '<th>Registered On</th>';
			echo '<th>Status</th>';
			echo '<th>Action</th>';
		echo '</tr>'; 
		?>
		
      </thead>
      <tbody>
      <?php
  			foreach($userdet as $user_det){
				$id=$user_det['User']['id'];
				if($user_det['User']['user_level']=='god' && $user_det['User']['admin_menus']=='')
				{
					$style = "font-weight:bold;color:#0040FF;";
				}
				else if($user_det['User']['user_level']=='god' && $user_det['User']['admin_menus']!='')
				{
					$style = "font-weight:bold;";
				}
				else
				{
					$style = "";
				}
				echo '<tr id="del_'.$id.'" style="'.$style.'">';
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

<?php
	
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['User']['nextPage'];
		$prevPage = $this->Paginator->params->paging['User']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/user/management/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => ''), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => '','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => ''), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
?>   
    
    </div></div></div>    </div>    
    </div>
    </div>    


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>



				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
