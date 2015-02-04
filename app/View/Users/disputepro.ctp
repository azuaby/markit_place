<style type="text/css">
    .Table
    {
        display: table;
    }
    .Title
    {
        display: table-caption;
        text-align: center;
        font-weight: bold;
        font-size: larger;
         color: #5F5F5F;
        
    
    }
    .Heading
    {
       
        font-weight: bold;
        margin: 13px;
        padding:0px 0px 0px 0px;
        background-color: #F6F6F6;
        widht:1000px;
        
        
        
    }
    .Row
    {
        
        margin: 0;
        text-align:left;
        padding: 0 0 0 9px;
        display: table-row; border: 1px solid #000;
    }
    .Cellact
    {
        display: table-cell;
        width:50px;
        border-width: thin;
        padding:5px;
        margin:0px;
        align:right;
         display: table-row; border: 1px solid #000;
    }
    
     .Cellpro
    {
        display: table-cell;
        width:250px;
        border-width: thin;
        padding:5px 4px 0 0px;
        margin:0px;
        align:right;
    }
     .Cellorder
    {
        display: table-cell;
        table-boder:1px;
        width:150px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
        align:right;
    }
    
    .Cellplm
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
        align:right;
    }
     .Cellmsg
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
        align:right;
    }
    
     .Cellactr
    {
        display: table-cell;
        width:80px;
        border-width: thin;
        padding:5px;
        margin:0px;
        text-align:left;
        
    }
    
     .Cellpror
    {
        display: table-cell;
        width:250px;
        border-width: thin;
        padding:5px 5px 0 13px;
        margin:0px;
        text-align:left;
        
    }
     .Cellorderr
    {
        display: table-cell;
        table-boder:1px;
        width:150px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
       text-align:left;
    }
    
    .Cellplmr
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
       text-align:left;
    }
     .Cellmsgr
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
        text-align:left;
    }
    
    
    
    
     .Cellactrs
    {
        display: table-cell;
        width:50px;
        border-width: thin;
        padding:5px;
        margin:0px;
        text-align:left;
        
    }
    
     .Cellprors
    {
        display: table-cell;
        width:250px;
        border-width: thin;
        padding:5px 0 0 13px;
        margin:0px;
        text-align:left;
        
    }
     .Cellorderrs
    {
        display: table-cell;
        table-boder:1px;
        width:150px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
       text-align:left;
    }
    
    .Cellplmrs
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding:5px 0 0 0px;
        margin:0px;
       text-align:left;
    }
     .Cellmsgrs
    {
        display: table-cell;
        table-boder:1px;
        width:400px;
        border-width: thin;
        padding: 5px 0 0 26px;
        margin:0px;
        text-align:left;
    }
    
    
    
    .send{
    border-width:bold;
    color:red;
    }
    .receive{
    border-width:bold;
    color:blue;
    }
    .feedsandtrentss > .active > a, .feedsandtrentss > .active > a:hover {
    background-color: #F6F6F6;
    cursor: default;
    

}
    .myfeedsse{
	   float: left;
}
.myfeedsse a {    
    border: medium none;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    color: #393D4D !important;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    margin: 0 10px -2px 12px;
    padding: 0 13px 5px 11px;
    text-align: center;
    text-decoration: none;
    text-transform: none;
}
.myfeedsse a:hover{	
	background-color: #F6F6F6;
}
    
</style>


<div class="container set_area" style="width:940px;">
        <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('Dispute Management'); ?></h2>
        <div class="figure-row" style="padding: 9px 0px 0;">
		
        	<div class='container' style='padding:0px;'>
		<?php 
		$selectedTab = '';
		echo '<div>';
		
		echo '<ul class="feedsandtrentss">';
		if(isset($_REQUEST['buyer'])){
		
			echo '<li class="active myfeedsse">';
		}else{
			echo '<li class="myfeedsse">';
		}
		echo "<a href='".SITE_URL.'dispute/'.$_SESSION['first_name']."?buyer' > " ?> <?php echo __('Send');echo "</a>";
		echo '</li>';

			
				//if(count($_GET)==0){
					//echo '<li class="active myfeedsse">';
				//}else{
				//	echo '<li class="myfeedsse">';
				//}
				//echo "<a  href='".SITE_URL.'dispute/'.$_SESSION['first_name']."?buyer' >   </a>";
					
				//echo '</li>';
				if(isset($_REQUEST['seller'])){
					
					echo '<li class="active myfeedsse">';
				}else{
					echo '<li class="myfeedsse">';
				}
				echo "<a href='".SITE_URL.'dispute/'.$_SESSION['first_name']."?seller' > " ?> <?php echo __('Receive'); echo "</a>";
				echo '</li>';
			echo '</ul>';
		
		?>
		
	
		
		<div class="wrapper-content">
		
		
		
		
		<div class="prvcmntcont" style="width: 715px;"> 
		<!-- <table class="myorderslist" style="width: 690px;">
        		<thead>
        			<tr>
	        			<td style="width: 180px;font-size:13px;font-weight:bold;">Product Name</td>
	        			<td style="width:80px;font-size:13px;font-weight:bold;">Order Id</td>
	        			<td style="width:150px;font-size:13px;font-weight:bold;">Order Problem</td>
	        			<td style="width:180px;font-size:13px;font-weight:bold;">Message</td>
	        			<td style="width:100px;font-size:13px;font-weight:bold;">Actions</td>
	        		</tr>
        		</thead>
        		</table> -->
		
		<?php
				 
		if(isset($_REQUEST['buyer'])){
		$selectedTab = 'buyer';
				 
				 
				 if (!empty($messagesel)){
					
					//if(count($_GET)==0){?>
				
					<table class="myorderslist" style="width: 690px;">
					<thead>
	        			<tr>
		        			<td style="font-size: 15px;font-weight:bold;" ><?php echo __('Product Name');?></td>
		        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Order Id');?></td>
		        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Order Problem');?></td>
		        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Message');?></td>
		        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Actions');?></td>
		        		</tr>
        			</thead>
					<tbody class="myorderlisttbody">
					<?php 
						//if(!empty($messagesel)){						
							
						foreach($messagesel as $key=>$msg){
							if ($key < 10) {
						
					?>
					<?php 
					$msrc = $msg['uorderstatus'];
					$msrd=$msg['uorderplm'];
					$msrm = $msg['uordermsg'];
					$position=20;
					$msdi = substr($msrm, 0, $position);
					$msro = $msg['uorderid'];
					$usid = $loguser[0]['User']['id'];
						 ?>
						 	
		<tr>	
		
   

                      <?php $dot="..."?>
        
          <td style="width: 180px;text-align:left; padding: 0 0 0 17px;height:40px;">  <?php echo $msrc;?></td>
       
           <td style="width:80px;text-align:left;padding: 0 0 0 21px;height:40px;"> <?php echo $msro;?></td>
        
           <td style="max-width:150px;text-align:left;padding: 0 0 0 10px;height:40px;word-wrap: break-word;"><?php echo $msrd;?></td>
       
            <td style="width:180px;text-align:left;padding:0 0 0 10px;height:40px;"><?php echo $msdi . $dot;?></td>
        
            
       <td style="width:100px;text-align:left;padding:0 0 0 10px;height:40px;">  <a href="<?php echo SITE_URL; ?>disputemessage/<?php echo $msro;?>" class="first" style="padding: 0 0 0 13px;"><i class="ic-pur"></i> <?php  echo __('View'); ?></a>
     </td>   
   
</tr>
				<?php }} ?>	 </tbody> 	</table>
				
			
				
				
				<?php if (count($messagesel) > 10) {?>
        					<div class="loadmorecomment" style="font-size: 12px;font-weight: bold; margin: 25px 10px 0 12px;" onclick="loadmorecomment('<?php echo $usid ?>')">
        						<?php echo __('Load More');?>
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php } //}
        			?>
								
					<?php 
					}	else{
        					echo "<div class='noordercmnt' style='text-align:center;font-size:12px;margin: 0 12px;
    padding: 31px 0 29px;border: 1px solid #F6F6F6;border-radius:2px;color: #FF0000;'>" ?> <?php echo __('No Conversation Found');echo "</div>";
        					
        				} 
		} //}
					?></div>
        				
        				
        				
      		
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
        				
		<?php if(isset($_REQUEST['seller'])){ $selectedTab = 'seller';?>
		
		
		 <div class="find-people">
		
		 <div class="select-list">
		 	<div class="prvcmntcontseller"> 
		 	
		
		 <?php 
		
		 //if(count($_GET)!=0){ 
		 
		 if(!empty($messagebuyer)) {	?>
		 <table class="myorderslist" style="width: 690px;margin: 0 0 0 13px;">
		 	<thead>
        			<tr>
	        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Product Name');?></td>
	        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Order Id');?></td>
	        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Order Problem');?></td>
	        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Message');?></td>
	        			<td style="font-size: 15px;font-weight:bold;"><?php echo __('Actions');?></td>
	        		</tr>
        	</thead>
		 <tbody class="myorderlisttbodyseller">
		 <?php 
		 
		foreach($messagebuyer as $ky=>$msgbuy){
			if ($ky < 10) {
					?>
		
					
					<?php 
					$msrcbuy = $msgbuy['uorderstatus'];
					$msrdbuy=$msgbuy['uorderplm'];
					$msrmbuy = $msgbuy['uordermsg'];
					$positione=20;
					$msdie = substr($msrmbuy, 0, $positione);
					$msrobuy = $msgbuy['uorderid'];
					$usid = $loguser[0]['User']['id'];
					
						 ?>
	<?php $dot="..."?>
					
				<tr>
      
        <td style="width: 180px;text-align:left; padding: 0 0 0 15px;"><?php echo $msrcbuy;?></td>
    
           <td style="width:80px;text-align:left;padding: 0 0 0 22px;"><?php echo $msrobuy;?></td>
        
           <td style="max-width:150px;text-align:left;padding: 0 0 0 19px;word-wrap: break-word;"> <?php echo $msrdbuy;?></td>
       
         <td style="width:180px;text-align:left;padding:0 0 0 10px;"> <?php echo $msdie . $dot;?></td>
       
         <td style="width:100px;text-align:left;padding:0 0 0 10px;">  
            <a href="<?php echo SITE_URL; ?>disputeBuyer/<?php echo $msrobuy;?>" style="padding: 0 0 0 13px;"><i class="ic-pur"></i> <?php  echo __('View'); ?></a>
      </td>  
    
</tr>
			
					
						
					
		<?php }}?>			
			</table>	
			<?php if (count($messagebuyer) > 9) {?>
        					<div class="loadmorecomment" style="font-size: 12px;font-weight: bold; margin: 25px 10px 0 12px;" onclick="sellercomment('<?php echo $usid ?>')">
        						<?php echo __('Load More');?>
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        						
        					</div><?php } echo "</div>"; }else{
        					echo "<div class='noordercmnt' style='text-align:center;font-size:12px;margin: 0 12px;
    padding: 31px 0 29px;border: 1px solid #F6F6F6;border-radius:2px;color: #FF0000;'> " ?><?php echo __('No Conversation Found');echo "</div>";
        					echo "</div>";
        					}	//}?>
			
			
			
	</div>
	
	
	
	
	
	
	
        					
        					<?php }?>	
		
		
		
		</div>
		
		
		</div>
		
 </div>
     
		</div>	
	</div>
	<?php if(isset($_REQUEST['seller'])){ ?>
	</div>
	
	<?php } ?>
	
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>dispute/<?php echo $_SESSION['first_name'];?>?buyer" class="current"><?php echo __('Disputes'); ?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>purchases"  ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>shipping" ><i class="ic-pur"></i> <?php echo __('Shipping'); ?></a></dd>
	            <dd><a href="<?php echo SITE_URL; ?>addshipping" ><i class="ic-ship current"></i><?php echo __('Add Shipping');?></a></dd>
	            
	        </dl>
			<dl class="set_menu">
				<dt><?php  echo __('MERCHANT'); ?></dt>
	            <dd><a href="<?php echo SITE_URL; ?>sellersignup" ><i class="ic-pur"></i> <?php  echo __('Information'); ?></a></dd>
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

<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>
</div>

<script type="text/javascript">
	var crntcommentcnt = '<?php echo count($messagesel); ?>';
	var order_id = '<?php echo $usid; ?>';
	//alert (order_id);
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 10;
	var baseurl = getBaseURL();

	
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
		//alert ($usid);
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getrecentdispallbuyer',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'userid': order_id, 'contact': 'buyer', },
				success: function(responce){
					if (responce) {
						var output = eval(responce);
						crntcommentcnt = output[0];
						var previousmsg = $('.prvcmntcont').html();
					    var currentmsg = output[1] + previousmsg;
				        $('.prvcmntcont').html(currentmsg);
				        cmntupdate = 1;
					}else{
						cmntupdate = 1;
					}
				}
			});
		//}
		console.log('Calling recursive function');
	}
	
	setInterval(getcurrentcmnt, 5000000);

	function loadmorecomment(uid){
		//alert(uid);
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorecommentview',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','userid':uid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce){
						var output = eval(responce);
				        $('.myorderlisttbody').append(output[1]);
				        loadmoreajax = 1;
						loadmorecmntcnt += 10;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No More Disputes');
					}
				}
			});
		}
	}

	
	
</script>


<script type="text/javascript">
	var crntcommentcnt = '<?php echo count($messagebuyer); ?>';
	var order_id = '<?php echo $usid; ?>';
	//alert (order_id);
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 10;
	var baseurl = getBaseURL();

	
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
		//alert ($usid);
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getrecentdispallseller',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'selid': order_id, 'contact': 'buyer', },
				success: function(responce){
					if (responce) {
						var output = eval(responce);
						crntcommentcnt = output[0];
						var previousmsg = $('.prvcmntcontseller').html();
					    var currentmsg = output[1] + previousmsg;
				        $('.prvcmntcontseller').html(currentmsg);
				        cmntupdate = 1;
					}else{
						cmntupdate = 1;
					}
				}
			});
		//}
		console.log('Calling recursive function');
	}
	
	setInterval(getcurrentcmnt, 5000000);

	function sellercomment(sid){
		//alert(uid);
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorecommentviewseller',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','selid':sid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce){
						var output = eval(responce);
				        $('.myorderlisttbodyseller').append(output[1]);
				        loadmoreajax = 1;
						loadmorecmntcnt += 10;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No More Disputes');
					}
				}
			});
		}
	}

	
	
</script>