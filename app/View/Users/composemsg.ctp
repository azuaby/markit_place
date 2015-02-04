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
		<h1>New Personnal Message</h1>
<?php
   echo $this->Form->Create('conversionmsg',array('url'=>array('controller'=>'/','action'=>'/composemsg')));
		echo $this->Form->input('username',array('type'=>'text','label'=>'Recipient','id'=>'banner_name','class'=>'inputform'));
		echo "<br clear='all' />";
				
		echo $this->Form->input('subject',array('type'=>'text','label'=>'Subject','id'=>'banner_name','class'=>'inputform'));
		echo "<br clear='all' />";
				
		echo $this->Form->input('message',array('type'=>'textarea','label'=>'Message','id'=>'html_source','class'=>'inputform'));
		echo "<br clear='all' />";
				
		echo $this->Form->submit('Submit');
	echo $this->Form->end();
   ?>
   	
   		</div>
	</div>
</div>
</div>
</div>
