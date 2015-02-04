<div class="container set_area">
        <div id="content">
        <div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <b class="ptit" style="font-size:15px;">Referrals</b>
        <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>
        <hr>
        <div class="figure-row">
       
        <div class="referalcount">
        	<span class="invtot"><b>Invited :</b> <?php echo $invitCount; ?></span>
        	<span class="jontot"><b>Joined :</b> <?php echo $joinedCount; ?></span>
        </div>
      
        	<h4>Referral Status</h4>
        	</div><hr>
       <?php
			if (count($invited_friend) > 0) {
			
			?>
       
      
        
        
		<?php foreach($invited_friend as $ky=>$invite){ ?>
									
				
				<div style="font-size:13px;"><b>User Name :</b> 
				<?php echo $invite['Userinvite']['invited_email']; ?></div><br />
				<div style="font-size:13px;"><b>Invited :</b> <?php echo $day=date('m/d/Y',$invite['Userinvite']['invited_date']); ?></div><br />
				<div style="font-size:13px;"><b>Status :</b>
				<?php 
				if($invite['Userinvite']['status'] == 'Joined'){
					echo '<span style="color:#00FF00;">'.$invite['Userinvite']['status'].'</span>';
				}else{
					echo '<span style="color:#FF0000;">'.$invite['Userinvite']['status'].'</span>';
				}
				echo '<hr>';
				 ?>
				
			
				</div>
		<?php
				}
				
			}else {
				
				echo '<div style="text-align:center;color:#ff0000;font-size:20px;">
						You haven\'t invited anyone yet.</div>';
						echo '<div style="text-align:center;font-size:14px;"><a  href="'.SITE_URL.'mobile/invite_friends"  >Invite friends</a></div>';
						echo '</div>';
						echo '<hr>';
			} ?>
			
			
			

			
		</div>	
	</div>
	
			
</div>	
