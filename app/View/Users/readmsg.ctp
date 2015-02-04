<div class="containerdiv">
		<div class="content">
		<div class="aside">
				<div class="navigation">
					<h1>Conversations</h1>
					<?php
					echo "<ul>";
						echo "<li>";
								echo $this->Html->link('Compose Message',array('controller'=>'/','action'=>'/composemsg'));
							echo "</li>";
							echo "<li>";
								echo $this->Html->link('All Conversations',array('controller'=>'/users','action'=>'/conversation'));
							echo "</li>";
												
						echo "</ul>";
					?>
				</div>		
		</div>	
<div class="products">
		<div class="products-list">
				         </br>
                       </br clear='all'>
				    <?php 
				   //echo "<pre>";print_r($conver_msg);die;
				    if(isset($conver_msg)){
                    	foreach ($conver_msg as $key=>$value):
                       		//echo "<a href='".SITE_URL."readmsg/".$value['Conversation']['con_id']."'>";
               				//echo $value['Conversation']['user1']."&nbsp;&nbsp;&nbsp;"; 
               				echo $value['User']['username']." : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
               				echo $value['Conversation']['subject']."&nbsp;&nbsp;&nbsp;";
               				echo $value['Conversation']['message']."&nbsp;&nbsp;&nbsp;"; 
               				//echo date_diff(date('Y-m-d',$value['Conversation']['created']),today)."&nbsp;&nbsp;&nbsp; ";
               				//$dat = date('Y-m-d  H:i:s',$value['Conversation']['created']);
               				//$dat_and_time = UrlfriendlyComponent::txt_time_diff($dat,date("Y-m-d H:i:s"));
               				$dat_and_time = UrlfriendlyComponent::txt_time_diff($value['Conversation']['created']);
               				echo $dat_and_time."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               				?>
               				<hr/>
						  	</br>
						    </br clear='all'>
	                    <?php
	                    endforeach;
	                    $con_id = count($conver_msg);
	                	$con_id-=1;
	                    }else{
	                    echo "No Message....";
	                    }
	                    ?>
<?php
   echo $this->Form->Create('replymsg',array('url'=>array('controller'=>'/','action'=>'/readmsg/'.$conver_id)));
				
		echo $this->Form->input('message',array('type'=>'textarea','label'=>'Reply','id'=>'html_source','class'=>'inputform'));
		echo $this->Form->input('user2val',array('type'=>'hidden','value'=>$conver_msg[$con_id]['Conversation']['user1']));
		echo "<br clear='all' />";
				
		echo $this->Form->submit('Reply');
	echo $this->Form->end();
   ?>
   	
   		</div>
	</div>
</div>
</div>
</div>
