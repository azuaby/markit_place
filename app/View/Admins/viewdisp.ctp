<?php ?>
<body class="" > 
  <!--<![endif]-->
     
 <div class="content" >
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Dispute</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
						<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li class="active">Dispute</li>
					</ul>
				</div>
			</div>

 

						<!-----Dispute Details------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Dispute Details</h2>
						
					</div>
					<div class="box-content">

           
  
		

				



   
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
   		<table width="700px;">
   		<tr><td style="text-align:left;padding:0px;"></td><td style="padding:18px 14px 8px 13px;float:right;">

   	<?php $disp['Dispute']['resolvestatus'];?>	
   	<?php if($disp['Dispute']['resolvestatus']=='Paid' or $disp['Dispute']['resolvestatus']=='Processing' or $disp['Dispute']['resolvestatus']=='Pending' or $disp['Dispute']['resolvestatus']=='Delivered') {?>
   		<?php echo $this->Form->create('Dispute'); ?>
        				 <?php
			echo $this->Form->submit('Resolve Now',array('class'=>'btn btn-success reg_btn', 'name'=>'resolve'));
		echo $this->Form->end();
?>   <?php } else { }?> 
   		</td></tr></table>
   		
   		<table id="myTable" class="tablesorter table table-striped table-bordered" style="width: 689px;">
   		<tr><td style="font-size:13px;font-weight:bold;width:250px;" >Order Number</td><td style="padding: 9px 11px 4px 6px;"><?php echo $disp['Dispute']['uorderid']; ?></h3></td></tr>
   		<tr><td style="font-size:13px;font-weight:bold;width:250px;">Seller</td><td style="padding: 9px 11px 4px 6px;"><?php echo $disp['Dispute']['semail']; ?></td> </tr>
   		<tr><td style="font-size:13px;font-weight:bold;width:250px;">Order Date</td> <td style="padding: 9px 11px 4px 6px;"><?php echo date('d, M Y',$orderModel['Orders']['orderdate']); ?> </td></tr>
   		<tr><td style="font-size:13px;font-weight:bold;width:250px;">Total Amount Paid</td><td style="padding: 20px 11px 3px 4px;"><?php echo "$".$orderModel['Orders']['totalcost']." ".$currencyCode; ?></td></tr>
   		<tr><td style="font-size:13px;font-weight:bold;width:250px;">Status</td><td style="padding: 20px 11px 3px 4px;"><?php 
        	if ($orderModel['Orders']['status'] != '' && $orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>".$orderModel['Orders']['status']."</span>";
			}elseif ($orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>Pending</span>";
			}else {
				echo "<span class='markshipstatusrslt'>Delivered</span>";
			}?></td></tr>
			<tr><td style="font-size:13px;font-weight:bold;width:250px;">Shipping Address</td><td style="padding: 20px 11px 3px 4px;"><?php echo $userModel['User']['first_name']; ?></br>
        			<?php 
				echo $shippingModel['Shippingaddresses']['name'].",</br>";
        			echo $shippingModel['Shippingaddresses']['address1'].",</br>";
        			if (!empty($shippingModel['Shippingaddresses']['address2'])){
        				echo $shippingModel['Shippingaddresses']['address2'].",</br>";
        			}
        			echo $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
        			echo $shippingModel['Shippingaddresses']['state'].",</br>";
        			echo $shippingModel['Shippingaddresses']['country'].",</br>";
        			echo "Ph.: ".$shippingModel['Shippingaddresses']['phone'].".</br>";
        			?></tr>
        			<tr><td style="font-size:13px;font-weight:bold;width:250px;"><h3>What's the problem</h3></td><td style="padding: 20px 11px 3px 4px;" ><?php echo $disp['Dispute']['uorderplm']; ?></td></tr>
        			<tr><td style="font-size:13px;font-weight:bold;width:250px;">Message</td><td><?php echo $disp['Dispute']['uordermsg']; ?></td></tr>
        			<?php if($disp['Dispute']['resolvestatus']=='Paid' or $disp['Dispute']['resolvestatus']=='Processing' or $disp['Dispute']['resolvestatus']=='Pending' or $disp['Dispute']['resolvestatus']=='Delivered') {?></table>
        			<script>
        			function rlyadmsg(){
        				var data = $('#rlyadmsg1').serialize();
        				var message=$('#message').val();
        				if(message == ''){
        					$("#alert").show();
        					
        					$('#alert').text('Enter the Text');
        					
        					return false;
        				}

        				$('#rlyadmsg1').submit();
        				
        			}
        			</script>
        			<table style="width:86%;">
   	<tr><td style="font-size:13px;font-weight:bold;text-align:left;padding:9px 0px 0px 0px;">Reply Message</td></tr><tr><td style="padding: 9px 0px 0px 0px;text-align:left;">
 	
 	<?php echo $this->Form->create('Dispcon', array( 'id'=>'rlyadmsg1','onsubmit'=>'return rlyadmsg()')); ?>
    <div class="input">
    
  <textarea name="data[Dispcon][msg]" id="message" class="merchantcommandss"></textarea><?php echo "<div id='alert' style='color:red;float:left;height:0px;padding: 20px 0 0 540px;font-size:12px;font-weight:bold;'></div>"; ?></div></td></tr>
 <tr><td style="padding:0px 0px 0px 489px;text-align:center;"> <?php
			echo $this->Form->submit('Send',array('class'=>'btn btn-success reg_btn'));
		echo $this->Form->end();
	
?>
 </td></tr> <?php } else {  }?> </table>
<div class="prvconvcont">
		<div class="prvconvhead" style="font-size:12px;font-weight:bold;">Previous Messages: </div>
		<div class="prvcmntcont">
		<?php if (!empty($messagedisp)){
        					$cmntcontnr = 'style="text-align: right;"';
        					$usrimg = 'style="float: right;"';
        					$usrname = 'style="float: right; margin-right: 0px; margin-left: 20px;"';
        					
        				?>
		<?php
					//echo "<pre>";print_r($itematas);
					
					//if(count($_GET)==0){
						if(!empty($messagedisp)){
						foreach($messagedisp as $key=>$msg){
							if ($key < 10) {
					?>
					<?php 
					$msrc = $msg['commented_by'];
					$msrd=date('d,M Y',$msg['date']);
					$msrm = $msg['message'];
					$msro = $msg['order_id'];
					//$ro = $msg['msid'];
						 ?>
						 <div class="cmntcontnr">
						 <div class="usrimg">
						 <?php if ($msrc == 'Buyer') {?>
		        			<?php 
		        			
		        				echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';
									if(!empty($buyerModel['User']['profile_image'])){
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$buyerModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									}
									
									echo '</a>'; ?>
		        			</div>
					<div class="cmntdetails" style="margin: 0px 0px 20px 0px;">
					<p class="usrname"><?php echo '<a href="'.SITE_URL.'people/'.$buyerModel['User']['username_url'].'" class="url">';?>
					<?php echo $buyerModel['User']['first_name'];?></p><?php echo '</a>';?><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
				<?php }elseif ($msrc == 'Seller') {?>	
					</div>
					
					<div class="cmntcontnr"">
        					<div class="usrimg">
						
		        			<?php 
		        			
		        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
									if(!empty($merchantModel['User']['profile_image'])){
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									}
									
									echo '</a>'; ?>
		        			</div>
					<div class="cmntdetails"">
					<p class="usrname"><?php echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';?>
					<?php echo $merchantModel['User']['first_name'];?><?php echo '</a>';?></p><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
				
					</div>
					
					<?php }else {?>	
					</div>
					
					<div class="cmntcontnr" >
        					<div class="usrimg" >
						
		        			<?php 
		        			
		        				//echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
									//if(!empty($merchantModel['User']['profile_image'])){
									//echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
									//}else{
									echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
									//}
									
									//echo '</a>'; ?>
		        			</div>
					<div class="cmntdetails">
					<p class="usrname"><a href="#"><?php echo $msrc;?></a></p><p class="cmntdate"><?php echo $msrd;?></p>
					<p class="comment"><?php echo $msrm; ?></p>
					</div>
				<?php }?>	
					</div>
					
					</div>
					
						
					<?php
					}
					}
					}
		
					//}?>
		</div>
		<?php if (count($messagedisp) > 9) {?>
        					<div class="loadmorecomment" onclick="loadmorecomment('<?php echo $msro ?>')">
        						Load more
        						<div class="morecommentloader">
        							<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" />
        						</div>
        					</div>
        			<?php } }else{
        					echo "<div class='noordercmnt' style='text-align:center;'>No Conversation Found</div>";
        					echo "</div>";
        				}?>
	</div>
		</div>	 		</div>			
					
	
        <style>
        
        
       .loadmorecomment {
    background-color: #F2F2F2;
    border-radius: 4px;
    cursor: pointer;
    padding: 5px 0;
    text-align: center;
}
.prvcmntcont {
	-webkit-transition: all 1s ease-in-out;
	-moz-transition: all 1s ease-in-out;
	-o-transition: all 1s ease-in-out;
	transition: all 1s ease-in-out;
}
.morecommentloader {
    display: inline-block;
    left: 8px;
    position: relative;
    top: 2px;
}
.morecommentloader img {
    width: 16px;
    display: none;
}
.prvconvhead {
    margin-bottom: 12px;
    color: #7C7C7C;
    font-size: 16px;
    font-weight: bold;
}
.prvconvcont {
    margin-left: 10px;
}

.postcommentloader img {
    padding-top: 22%;
    width: 20px;
}
.postcommentloader {
    float: right;
    width: 30px;
    display: none;
}
.postcommenterror {
    color: #DF2525;
    float: right;
    padding-top: 1%;
}
.cmntdate {
    color: #7F7F7F;
}

.usrimg {
    display: inline-block;
    float: left;
    width: 50px;
}
.usrimg .photo {
    width: 40px;
    border-radius: 4px;
}
.cmntdetails {
    display: inline-block;
    width:64.5%;
    border: 1px solid rgba(0, 0, 0, 0.15);
    padding: 5px 10px;
}
.cmntcontnr {
    margin-bottom: 22px;
    
}
.cmntdetails .usrname {
    float: left;
    margin-right: 20px;
    text-transform: capitalize;
}
.cmntdetails .usrname a {
    color: #2A5F95;
    text-decoration: none;
    font-weight: bold;
}
.comment {
    white-space: normal;
    word-wrap: break-word;
    margin:0px 0px -6px 1px;
}
p {
    font-size: 13px;
    font-style: normal;
    line-height: 18px;
    padding: 0 0 10px;
}
.cmntdate {
    color: #7F7F7F;
}
.cmntdetails .usrname {
    float: left;
    margin-right: 20px;
    text-transform: capitalize;
}
.cmntdetails .usrname a {
    color: #2A5F95;
    text-decoration: none;
    font-weight: bold;
}
.comment {
    white-space: normal;
    word-wrap: break-word;
}
.prvconvhead {
    margin-bottom: 12px;
    color: #7C7C7C;
    font-size: 16px;
    font-weight: bold;
}
.prvconvcont {
    margin-left: 10px;
}

.merchantcommandss{
        			
        			width:675px;
        			}


.sellerdtls {
    //display: inline-block;
    //margin-left: 10px;
    font-size: 12px;
}
.sellerdtls .username a {
    color: #2A5F95;
    font-size: 12px;
    font-weight: bold;
    text-decoration: none;
    text-transform: capitalize;
}
.buyerorderheadul{
	border-bottom: 1px solid rgba(0,0,0,0.2);
	padding-top: 4%;
}
.sellerdtls .username {
    padding-bottom: 0;
}
.sellerdtls .usernameat {
    //color: #9D9D9D;
    //font-weight: bold;
    padding: 0;
}
.orderdetlshead {
    font-size: 12px;
    font-weight: normal;
}
.buyermarkshiporderid{
    font-size: 12px;
    font-weight: bold;
}
.buyerorderheadul{
	border-bottom: 1px solid rgba(0,0,0,0.2);
	padding-top: 4%;
}
.orderdetlshead {
    font-size: 12px;
    font-weight: normal;
}
.buyerviewshipaddr{
	margin-right: 3%;
    margin-top: 12px;
    width: 55%;
}
.buyerviewright {
    border-left: 1px solid rgba(0, 0, 0, 0.17);
    display: inline-block;
    margin-right: 10px;
    padding-left: 25px;
    width: 36%;
}
.buyerviewaddrhead {
    //color: #7C7C7C;
    font-size: 14px;
    //font-weight: bold;
}
.buyerviewshipdetails {
    font-size: 14px;
    color: #2D2D2D;
}
.buyermarkshipstatus{
    padding: 10px 0 0;
    font-size: 14px;
}

</style>
       
       

</div>

	</table></div>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Dispute Details------->	
   		
</div>
</div>



</div>

<script type="text/javascript">
	var crntcommentcnt = '<?php echo count($messagedisp); ?>';
	var order_id = '<?php echo $msro; ?>';
	//alert (order_id);
	var cmntupdate = 1, loadmoreajax = 1, loadmore = 1, loadmorecmntcnt = 10;
	var baseurl = getBaseURL();

	$(document).ready(function(){
		getcurrentcmnt();
	});
	
	function getcurrentcmnt(){
		//if (cmntupdate == 1){
		//alert (order_id);
			cmntupdate = 0;
			$.ajax({
				url: baseurl+'getadmin',
				type: 'POST',
				dataType: 'json',
				data: {'currentcont': crntcommentcnt, 'order_id': order_id, 'contact': 'buyer', },
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
	
	setInterval(getcurrentcmnt, 5000);

	function loadmorecomment(mid){
		//alert(mid);
		if (loadmoreajax == 1 && loadmore == 1){
			loadmoreajax = 0;
			$.ajax({
				url: baseurl+'getmorecommentadmin',
				type: 'POST',
				dataType: 'json',
				data: {'offset': loadmorecmntcnt,'contact':'buyer','order_id':mid},
				beforeSend: function(){
					$('.morecommentloader img').show();
				},
				success: function(responce){
					$('.morecommentloader img').hide();
					if (responce){
						var output = eval(responce);
				        $('.prvcmntcont').append(output[1]);
				        loadmoreajax = 1;
						loadmorecmntcnt += 10;
					}else{
						loadmore = 0;
				        loadmoreajax = 1;
				        $('.loadmorecomment').html('No more comments');
					}
				}
			});
		}
	}
</script>
