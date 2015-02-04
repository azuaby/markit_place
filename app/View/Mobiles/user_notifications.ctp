<div class="container set_area">
		
        <div id="content">
		<?php	echo $this->Form->Create('notifi',array('url'=>array('controller'=>'/','action'=>'/mobile/notifications'))); ?>
  		<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
        <b style="font-size:15px;"><?php echo __('Notifications'); ?></b>
        <?php echo '<a data-ajax="false" href = "'.SITE_URL.'mobile/settings" style="text-decoration:none;float:right;">Back</a>'; ?>  
       <hr>
        <div class="section">
            <h3 class="stit">Email</h3>
            <fieldset class="frm">
            <div class="frm_noti">
                <b><?php  echo __('Email settings') ;?> </b>
                
                	<input type="hidden" value="off" name="somone_flw" />
                	<?php if($usr_datas['User']['someone_follow']=='1'){ ?>
                		<li  style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="somone_flw" id="following"  checked = "checked" value=NULL />
</td><td>
<label style="font-size:13px;"><?php  echo __('When someone follows you'); ?></label>
</td></tr></table>
</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="somone_flw" id="following"  value=NULL />
</td><td>
<label style="font-size:13px;"><?php  echo __('When someone follows you'); ?></label>
</td></tr></table>
</li>
                	<?php } ?>
                   	<?php if($usr_datas['User']['someone_cmnt_ur_things']=='1'){ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="somone_cmnts" checked = "checked" value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When someone comments on a thing you added'); ?></label>
</td></tr></table>
</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="somone_cmnts"   value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When someone comments on a thing you added'); ?></label>
</td></tr></table>
</li>
                	<?php } ?>                	                    
               
               	</div>
               
            </fieldset>
            	</div>
      <hr>
        <div class="section">
            <h3 class="stit"><?php echo __('Notifications'); ?></h3>
            <fieldset class="frm">
            <div class="frm_noti">
                <b><?php echo __('Web and push settings'); ?> </b>
               
               	<br /><br />
               	
               	<b><?php echo __('Friends activity'); ?> </b>
                
                	<?php 
                	$decoded_value = json_decode($usr_datas['User']['push_notifications']);
                	if($decoded_value->frends_flw_push=='1'){ ?>
                		<li  style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="frends_flw_push" id="following"  checked = "checked" value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When a friend add the items'); ?></label>
</td></tr></table>
</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="frends_flw_push" id="following"  value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When a friend add the items'); ?></label>
</td></tr></table>
</li>
                	<?php } ?>                	
                	<?php if($decoded_value->frends_cmnts_push=='1'){ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="frends_cmnts_push" checked = "checked" value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When a friend posts a comment') ;?></label>
</td></tr></table>
</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="frends_cmnts_push"   value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('When a friend posts a comment');?></label>
</td></tr></table>
</li>
                	<?php } ?>          	
                	
                    
               
               	
               	
               	
               	
        </div>
            </fieldset>
        </div>
       <hr>
        <div class="section">
            <h3 class="stit">Updates</h3>
            <fieldset class="frm">
            <div class="frm_noti">
               <b> <?php echo __('Updates from Markit'); ?></b>
               
	                <input type="hidden" value="off" name="news_abt" />
                  	 <?php if($usr_datas['User']['subs']=='1'){ ?>
                		  <li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="news_abt" value=NULL checked = "checked" />
</td><td>
<label style="font-size:13px;"><?php echo __('Send news about Markit'); ?></label>
</td></tr></table>
</li>
                	<?php }else{ ?>
                			  <li style="font-size: 13px;list-style:none;">
<table style="width:100%;"><tr><td style="width:10%;">
<input type="checkbox" data-role="none" style="margin-top: 0px;" name="news_abt" value=NULL />
</td><td>
<label style="font-size:13px;"><?php echo __('Send news about Fantasy');?></label>
</td></tr></table>
</li>
                	<?php } ?>
                   
                   
               
        </div>
            </fieldset>
        </div>
      <br />
        <div class="btn-area">
            <button class="btn-save" id="save_notifications" style="background:#5690BB;color:#FFFFFF;text-shadow:none;"><?php echo __('Save Changes');?></button>
        </div>
        </div>
        </form>
    </div>
	
		


</div>	

<style>
li{
	font-weight:normal;
}

</style>
<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>
