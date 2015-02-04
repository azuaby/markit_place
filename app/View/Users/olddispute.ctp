<style>
 .messageview {
    overflow: auto;
   
    width:673px;!important;
    background: -moz-linear-gradient(center top , #F4F4F4, #FFFFFF) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    color: #000000;
    font-size: 12px;
    margin-bottom: 10px;
    padding: 0 10px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-seri;
    font-size: 13px;
    line-height: 2;
    height: 70px;
 	text-align: left;
 </style>
<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('Dispute Management'); ?></h2>
        <div class="figure-row" style="padding: 20px 12px 18px;">
        
        <div class="markshiporderid"><span class="orderdetlshead">Order Number: </span><span style="font-size: 12px;
    font-weight: bold;"> <?php echo $orderid;?></span></div>
        	<div class="markshipstatus" style="margin: 0 -46px 0 0;"><span class="orderdetlshead">Seller: </span>  
        	<span class="first" style="color: #2A5F95;
    font-size: 12px;
    font-weight: bold;
    text-decoration: none;
    text-transform: capitalize;" >
	        			<?php 
	        			echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="first">';
	        			echo $merchantModel['User']['first_name'].'</a>'; ?>
	        		</span>
        	 <?php //echo $merchantModel['User']['email'];?> 	</div></br><br/>
		<?php echo $this->Form->create('Dispute', array( 'id'=>'disputeform','onsubmit'=>'return disputesendform()')); ?>
        	
        		<div class="input" width="50px">
      		
    <label style=" color: #393D4D;display: block;font-size: 13px;padding: 9px 0;font-weight: bold; margin: 0 0 -8px;">What's the Problem :<?php echo "<div id='alertName' style='color:red;float:right;height:0px; padding: 3px 175px 0 0;
}'></div>"; ?>
   <div style="margin: -24px 0 0 141px;"> <select name="data[Dispute][plm]" id="problem">
        <option value="">choose one</option>
        <?php foreach($displm as $key=>$temp){
				$plmdi = $temp['Dispplm']['problem'];
				
			?>
        <option value="<?php echo $plmdi;?>"><?php echo $plmdi;?></option>
        <?php }?>
    </select></div></label>
    
</div>
 


   <label style=" color: #393D4D;display: block;font-size: 13px;padding: 9px 0;font-weight: bold;">Message :</label>
 
    <textarea name="data[Dispute][msg]" id="message" class="messageview" ></textarea>

<?php echo "<div id='alertNamemsg' style='color:red;float:right;height:0px; padding: 9px 130px 0 0;'></div>"; ?>
<div style="padding: 8px 0 6px 593px;">
    <?php
				
			echo $this->Form->submit('Submit',array('class'=>'btn btn-success reg_btn'));
			
		echo $this->Form->end();
	
?>   

 </div>
     
		</div>	
	</div>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt>ACCOUNT</dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > Profile</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > Password</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/"  class="current">Disputes</a></dd>
				<dd><a href="<?php echo SITE_URL; ?>messages" > 
					<?php echo __('Messages'); ?> 
					<div class="msgcnt"><span><?php echo $_SESSION['userMessageCount']; ?></span></div></a></dd>
			</dl>
			<dl class="set_menu">
				<dt><?php echo __('Shop'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>purchases" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i>Add Shipping</a></dd>
	            
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>orders" ><i class="ic-ship current"></i><?php echo __('My Sales'); ?></a></dd>
	        </dl>
	        
			<dl class="set_menu">
				<dt>SHARING</dt>
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> Credits</a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> Referrals</a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> Gift card</a></dd>
	        </dl>
		</div>
				<footer id="footer">
				<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
				<hr>
				<ul class="footer-nav">
					<li><a href="<?php echo SITE_URL.'help'; ?>">Help</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a></li>
					<li><a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a></li>
				</ul>
				<!-- / footer-nav -->
			</footer>
			
</div>	
<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>
<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jQuery.print.js"></script>
<script>
var lastmenuid = 0;
$('.inv-close').live ('click',function(){
	$('#invoice-popup-overlay').hide();
	$('#invoice-popup-overlay').css("opacity", "0");
});
$('.inv-print').live('click',function(){
	$("#userdata").print();
	return (false);
});

$(document).click(function(event) {
	  var target = $(event.target);

	  if (!target.hasClass('moreactions') && !target.hasClass('moreactionsli') && !target.hasClass('headarrdwn')) {
	    $('.moreactionlistmyord').hide();
	  }
});

function openmenu(oid) {
	if (lastmenuid != 0 && lastmenuid != oid){
		$('.moreactionlistmyord'+lastmenuid).slideUp('fast');
	}
	lastmenuid = oid;
	$('.moreactionlistmyord'+oid).slideToggle('fast');
}
</script>
