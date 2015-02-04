<div class="container set_area" style="width:940px;">
		
        <div id="content"  style="float:right;">
		<?php	echo $this->Form->Create('notifi',array('url'=>array('controller'=>'/','action'=>'/notifications'))); ?>
  		
        <h2 class="ptit"><?php echo __('Notifications'); ?></h2>      
        <div class="section">
            <h3 class="stit"><?php echo __('Email');?></h3>
            <fieldset class="frm">
            <div class="frm_noti">
                <label><?php  echo __('Email settings') ;?> </label>
                <ul> 
                	<input type="hidden" value="off" name="somone_flw" />
                	<?php if($usr_datas['User']['someone_follow']=='1'){ ?>
                		<li  style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_flw" id="following"  checked = "checked" value=NULL /><?php  echo __('When someone follows you'); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_flw" id="following"  value=NULL /><?php  echo __('When someone follows you'); ?></li>
                	<?php } ?>
                	<?php /* if($usr_datas['User']['someone_show']=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_shows"  checked = "checked" value=NULL />When someone shows you something on <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_shows"  value=NULL />When someone shows you something on <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?></li>
                	<?php } */ ?>
                	<?php if($usr_datas['User']['someone_cmnt_ur_things']=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_cmnts" checked = "checked" value=NULL /><?php echo __('When someone comments on a thing you added'); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_cmnts"   value=NULL /><?php echo __('When someone comments on a thing you added'); ?></li>
                	<?php } ?>
                	<?php /*if($usr_datas['User']['your_thing_featured']=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="things_featured"  checked = "checked" value=NULL /><?php echo __('When one of your things is featured'); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="things_featured"   value=NULL /><?php echo __('When one of your things is featured'); ?></li>
                	<?php } */ ?>
                	<?php /* if($usr_datas['User']['someone_mention_u']=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_mentions" checked = "checked" value=NULL />When someone mentions you</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_mentions"  value=NULL />When someone mentions you</li>
                	<?php } */ ?>
                    
               	</ul>
               	</div>
            </fieldset>
        </div>
        
        
        
        
        
        
        
        
        <div class="section">
            <h3 class="stit"><?php echo __('Notifications'); ?></h3>
            <fieldset class="frm">
            <div class="frm_noti">
                <label><?php echo __('Web and push settings'); ?> </label>
               	<!-- <label>Activity that involves you</label> -->
                <ul> 
                	<?php
                	$decoded_value = json_decode($usr_datas['User']['push_notifications']);
                	 if($decoded_value->frends_flw_push=='1'){ ?>
                		<li  style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="frends_flw_push" id="following"  checked = "checked" value=NULL /><?php echo __('When someone follows you'); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="frends_flw_push" id="following"  value=NULL /><?php echo __('When someone follows you'); ?></li>
                	<?php } ?>
                	<?php if($decoded_value->frends_cmnts_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="frends_cmnts_push" checked = "checked" value=NULL /><?php echo __('When someone comments on a thing you added') ;?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="frends_cmnts_push"   value=NULL /><?php echo __('When someone comments on a thing you added');?></li>
                	<?php } ?>
                	<?php /*
                	$decoded_value = json_decode($usr_datas['User']['push_notifications']);
                	
                	//echo "<pre>";print_r($decoded_value->somone_flw_push);die;
                	
                	if($decoded_value->somone_flw_push=='1'){ ?>
                		<li  style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_flw_push" id="following"  checked = "checked" value=NULL />When someone follows you</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_flw_push" id="following"  value=NULL />When someone follows you</li>
                	<?php } */ ?>
                	<?php /* if($decoded_value->somone_shows_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_shows_push"  checked = "checked" value=NULL />When someone shows you something on <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?></li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_shows_push"  value=NULL />When someone shows you something on <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?></li>
                	<?php } */ ?>
                	<?php /* if($decoded_value->somone_cmnts_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_cmnts_push" checked = "checked" value=NULL />When someone comments on a thing you <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?>'d</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_cmnts_push"   value=NULL />When someone comments on a thing you <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?>'d</li>
                	<?php } ?>
                	<?php if($decoded_value->things_featured_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="things_featured_push"  checked = "checked" value=NULL />When one of your things is featured</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="things_featured_push"   value=NULL />When one of your things is featured</li>
                	<?php } */?>
                	<?php /* if($decoded_value->somone_mentions_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_mentions_push" checked = "checked" value=NULL />When someone mentions you</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_mentions_push"  value=NULL />When someone mentions you</li>
                	<?php } */ ?>
                	
                	
                	<?php /* if($decoded_value->somone_promotions_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_promotions_push" checked = "checked" value=NULL />When you earn a promotion</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_promotions_push"  value=NULL />When you earn a promotion</li>
                	<?php } */ ?>
                	<?php /* if($decoded_value->somone_likes_ur_item_push=='1'){ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_likes_ur_item_push" checked = "checked" value=NULL />When someone Like's one of your things</li>
                	<?php }else{ ?>
                		<li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="somone_likes_ur_item_push"  value=NULL />When someone Like's one of your things</li>
                	<?php } */ ?>
                    
               	</ul>
               	
               	
               	
        </div>
            </fieldset>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="section">
            <h3 class="stit"><?php echo __('Updates');?></h3>
            <fieldset class="frm">
            <div class="frm_noti">
                <label><?php echo __('Updates from Markit'); ?></label>
                <ul>
	                <input type="hidden" value="off" name="news_abt" />
                  	 <?php if($usr_datas['User']['subs']=='1'){ ?>
                		  <li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="news_abt" value=NULL checked = "checked" /><?php echo __('Send news about Markit'); ?></li>
                	<?php }else{ ?>
                			  <li style="font-size: 13px;"><input type="checkbox" style="margin-right: 4px;" name="news_abt" value=NULL /><?php echo __('Send news about Fantasy');?></li>
                	<?php } ?>
                   
                   
                   
                </ul>
        </div>
            </fieldset>
        </div>
        <div class="btn-area">
            <button class="btn-save" id="save_notifications"><?php echo __('Save Changes');?></button>
        </div>
        </form>
    </div>
	
		<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" class="current"> <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" ><?php echo __('Disputes'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); 
					if($_SESSION['userMessageCount'] != 0){ ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div>
					<?php } ?>
					</a>
				</dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><?php echo __('Add Shipping');?></a></dd>
	        </dl>
			<dl class="set_menu">
				<dt><?php echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><?php  echo __('Information'); ?></a></dd>
	           	<dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
	        <dl class="set_menu">
				<dt><?php echo __('SHARING');?></dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo ('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo ('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo ('Gift card');?></a></dd>
	        </dl>
			
		</div>
			
						<!-- <footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				
			</footer> -->


</div>	

<style>
li{
	font-weight:normal;
}

</style>
<script>

setTimeout(function(){$('#flashmsg').fadeOut();}, 2000);

</script>