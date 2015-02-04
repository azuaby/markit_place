	<style>
	.unread{
		float:left;
		color:green;
	}
	</style>
	
	
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
				    
				   //echo "<pre>"; print_r($msgdat_unread);die;
				    if(isset($msgdata)){
				    	
                    	foreach ($msgdata as $key=>$value):
                    	$unread = '';
                    	if(!empty($msgdat_unread) && in_array($value['Conversation']['con_id'],$msgdat_unread)){
                    	$unread = 'unread';
                    	}	
                    	echo "<div class='".$unread."'>";
                       		echo "<a href='".SITE_URL."readmsg/".$value['Conversation']['con_id']."' class='sss' >".$value['User']['username']."&nbsp;&nbsp;&nbsp;"; 
               				echo $value['Conversation']['subject']."&nbsp;&nbsp;&nbsp;";
               				echo $value['Conversation']['message']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>"; 
               				//$dat = date('Y-m-d  H:i:s',$value['Conversation']['created']);
               				$dat_and_time = UrlfriendlyComponent::txt_time_diff($value['Conversation']['created']);
               				echo $msgcountdata[$value['Conversation']['con_id']]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               				echo $dat_and_time;
               				
               				?>
               				</div>
               				<hr/>
						  	</br>
						    </br clear='all'>
	                    <?php
	                    
	                    endforeach;
	                    }else{
	                    echo "No Message....";
	                    }
	                    
	                    ?>		
				</div>
			
			</div>
		</div>
		
		
		
		</div>
	</div>
