 <?php echo "<div id='userdata'>";
	    echo 'Search results for : <b>'.$srcs.'</b>';
	    echo '<br /><br />';
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed">';
						echo '<thead>';
						?>
						
    
        <?php 
        echo '<tr>';
	        if (isset($search)){
	        	echo '<th>#</th>';
	        }
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
      	if(!empty($userdet))
      	{
  			foreach($userdet as $user_det){
				$id=$user_det['User']['id'];
				if($user_det['User']['user_level']=='god')
				{
					$style = "font-weight:bold;color:#0040FF;";
				}
				else
				{
					$style = "";
				}
				echo '<tr id="del_'.$id.'" style="'.$style.'">';
					if (isset($search)){
						echo '<td><input type="checkbox" value="'.$id.'" name="user'.$id.'" class="inactiveuser"/></td>';
					}
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
		}
		else
		{
			echo '<tr><td colspan="5" align="center">No Results Found</td></tr>';
		}
        ?>
        
      </tbody>
      
      
      
      
    </table>
    <?php if (isset($search)){ ?>
    <div class='deleteselectbtn' style='text-align:right;'>
    	<a href="javascript:deleteinactiveselected();" >
    		<button class="btn btn-primary">
    			Delete Selected
    			<img class='deleteselectload' src='<?php echo SITE_URL.'images/loading.gif'?>' style="width: 18px; display: none;" />
    		</button>
    	</a>
    </div>
    <?php } ?>
<?php
	
	if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['User']['nextPage'];
		$prevPage = $this->Paginator->params->paging['User']['prevPage'];
		$this->passedArgs['serchkeywrd']=$srcs;
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/manage/nonapproved_users/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
		echo "<input type='hidden' value='".$pagecount."' class='inactivecnt' />";
	}else{
		echo "<input type='hidden' value='0' class='inactivecnt' />";
	}
?>