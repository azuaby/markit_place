<div class="container set_area" style="width:940px;">
    <div id="content"  style="float:right;">
        <h2 class="ptit"><?php echo __('My Orders'); ?></h2>
        <div class="markshippedcontent">
        	<div class="markshiphead"><?php echo __('Order Details');?></div>
        	<div class="buyerviewshipaddr buyerviewleft">
	        	<div class="buyermarkshiporderid buyerorderheadul">
	        		<span class="orderdetlshead"><?php echo __('Order Number');?>: </span>
	        		<?php echo $orderModel['Orders']['orderid']; ?>
	        	</div>
	        	<div class="sellerdtls buyerorderheadul">
	        		<span class="orderdetlshead"><?php echo __('Seller');?>: </span>
					<span class="username">
	        			<?php 
	        			echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
	        			echo $merchantModel['User']['first_name'].'</a>'; ?>
	        		</span>
	        		<span class="usernameat">
	        			<?php echo "(@".$merchantModel['User']['username'].")";?>
	        		</span>
	        		<?php 
	        		if ($orderModel['Orders']['status'] == 'Delivered'){
	        		?>
	        		<span class="contactseller" onclick="contactseller('<?php echo $orderModel['Orders']['orderid']; ?>');"><?php echo __('See Conversation');?></span>
	        		<?php
	        		}
	        		else
	        		{
	        		?>
	        		<span class="contactseller" onclick="contactseller('<?php echo $orderModel['Orders']['orderid']; ?>');"><?php echo __('Contact Seller');?></span>
	        		<?php
	        		}
	        		?>
	        	</div>
	        	<div class="buyermarkshiporderid buyerorderheadul">
	        		<span class="orderdetlshead"><?php echo __('Order Date');?>: </span>
	        		<?php echo date('d, M Y',$orderModel['Orders']['orderdate']); ?>
	        		<?php if(empty($orderModel['Orders']['status_date'])) { }else{?>
	        		<span class="orderdetlshead" style="float: right;"><?php echo __('Deliver Date');?>: 
	        		<b><?php echo date('d, M Y',$orderModel['Orders']['deliver_date']); } ?></b></span>
	        	</div>
	        	<div class="buyermarkshiporderid buyerorderheadul">
	        		<span class="orderdetlshead"><?php echo __('Total Amount Paid');?>: </span>
	        		<?php echo $currencySymbol.$orderModel['Orders']['totalcost']." ".$currencyCode; ?>
	        	</div>
	        </div>
        	<div class="buyerviewshipaddr buyerviewright">
        		<p class="buyerviewaddrhead"><?php echo __('Shipping Address');?>: </p>
        		<div class="buyerviewshipdetails">
        			<?php echo $userModel['User']['first_name']; ?></br>
        			<?php 
        			echo $shippingModel['Shippingaddresses']['address1'].",</br>";
        			if (!empty($shippingModel['Shippingaddresses']['address2'])){
        				echo $shippingModel['Shippingaddresses']['address2'].",</br>";
        			}
        			echo $shippingModel['Shippingaddresses']['city']." - ".$shippingModel['Shippingaddresses']['zipcode'].",</br>";
        			echo $shippingModel['Shippingaddresses']['state'].",</br>";
        			echo $shippingModel['Shippingaddresses']['country'].",</br>";
        			echo "Ph.: ".$shippingModel['Shippingaddresses']['phone'].".</br>";
        			?>
        		</div>
        	</div>
        	</br>
        	<div class="buyermarkshipstatus"><?php echo __('Status');?>: 
        	<?php 
        	if ($orderModel['Orders']['status'] != '' && $orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>".$orderModel['Orders']['status']."</span>";
			}elseif ($orderModel['Orders']['status'] != 'Paid'){
				echo "<span class='markshipstatusrslt'>Pending</span>";
			}else {
				echo "<span class='markshipstatusrslt'>Delivered</span>";
			}?>
        	</div>
        	<div class="buyerviewshipaddr">
        		<p class="buyerviewaddrhead"><?php echo __('Tracking Details');?>: </p>
        	<?php if (!empty($trackingModel)) {?>
        		<div class="buyerviewshipdetails">
        			<div class="trackdtlscont">
	        			<div class="tracklabel"><?php echo __('Shipment Date');?>:</div>
	        			<div class="trackdtls">
	        				<?php echo date('d,M Y',$trackingModel['Trackingdetails']['shippingdate']);?>
	        			</div>
        			</div>
        			<div class="trackdtlscont">
	        			<div class="tracklabel"><?php echo __('Tracking Id');?>:</div>
	        			<div class="trackdtls">
	        				<?php echo $trackingModel['Trackingdetails']['trackingid'];?>
	        			</div>
        			</div>
        			<div class="trackdtlscont">
	        			<div class="tracklabel"><?php echo __('Logestic Name');?>:</div>
	        			<div class="trackdtls">
	        				<?php echo $trackingModel['Trackingdetails']['couriername'];?>
	        			</div>
        			</div>
        			<div class="trackdtlscont">
	        			<div class="tracklabel"><?php echo __('Shipment Service');?>:</div>
	        			<div class="trackdtls">
	        				<?php echo $trackingModel['Trackingdetails']['courierservice'];?>
	        			</div>
        			</div>
        			<div class="trackdtlscont">
	        			<div class="tracklabel"><?php echo __('Additional Notes');?>:</div>
	        			<div class="trackdtls">
	        				<?php echo $trackingModel['Trackingdetails']['notes'];?>
	        			</div>
        			</div>
        		</div>
        	<?php }else{
        		echo "<div class='trackempty'>"?><?php echo __('Not yet updated');echo "</div>";
        		
        	} ?>
        	</div>
        	
        	</br></br>
        	<!-- <div class="buyerviewsellerdtls">
        		<div class="sellerdtlshead">Seller</div>
        		<div class="sellerimgdtls">
        			<?php 
        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
						if(!empty($merchantModel['User']['profile_image'])){
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$merchantModel['User']['profile_image'].'" alt="" class="photo" style="'.$roundProfile.'">';
						}else{
						echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
						}
						
						echo '</a>'; ?>
        		</div>
        		<div class="sellerdtls">
					<p class="username">
        			<?php 
        				echo '<a href="'.SITE_URL.'people/'.$merchantModel['User']['username_url'].'" class="url">';
        				echo $merchantModel['User']['first_name'].'</a>'; ?>
        			</p>
        			<p class="usernameat">
        				<?php echo "@".$merchantModel['User']['username'];?>
        			</p>
        			<p class="contactseller" onclick="contactseller('<?php echo $orderModel['Orders']['orderid']; ?>');">Contact Seller<i class="glyphicons chat"></i></p>
        		</div>
        	</div> -->
        	<div class="orderitemdtls">
        		<div class="orderitemhead"><?php echo __('Product Details');?></div>
        		<table class="orderitemcont">
        			<thead>
        				<tr>
	        				<th><?php echo __('Item Details');?></th>
	        				<th><?php echo __('Item Price');?></th>
	        				<th><?php echo __('Shipping Price');?></th>
	        				<th><?php echo __('Total Price');?></th>
	        			</tr>
        			</thead>
        			<tbody>
        			<?php 
        			$totalShipping = 0;$totalitemprice = 0;$grandtotal = 0;
        			foreach ($itemModle as $item){
        				$totalprice = $item['itemprice'] + $item['shippingprice'];
        				$totalShipping += $item['shippingprice'];
        				$totalitemprice += $item['itemprice'];
        				$grandtotal += $totalprice;
        			?>
        				<tr>
        					<td class="prodtdtlstd">
        						<div class="prodtitmimg">
        							<a href = "<?php echo $_SESSION['media_url'].$item['itemurl']; ?>" title = "<?php echo $item['itemname']; ?>">
        								<img src="<?php echo $_SESSION['media_url'].'media/items/thumb70/'.$item['itemimage']; ?>" alt="<?php echo $item['itemname']; ?>" />
        							</a>
        						</div>
        						<div class="prodtitmdts">
        							<p class="proditmnamep">
        								<a class="prodtitmname" href = "<?php echo $_SESSION['media_url'].$item['itemurl']; ?>" title = "<?php echo $item['itemname']; ?>">
        								<?php echo $item['itemname']; ?>
        								</a>
        							</p>
        							<p class="proditmqty"><?php echo __('Qty');?>: <?php echo $item['itemquantity'];?></p>
        							<?php if (!empty($item['itemsize'])){ ?>
        							<p class="prodtitmsize"><?php echo __('Size');?>: <?php echo $item['itemsize']; ?></p>
        							<?php } ?>
        							<p class="prodtitmprice"><?php echo __('Unit Price');?>: <?php echo $currencySymbol.$item['itemunitprice']; ?></p>
        						</div>
        					</td>
        					<td><?php echo $currencySymbol.$item['itemprice']; ?></td>
        					<td><?php echo $currencySymbol.$item['shippingprice']; ?></td>
        					<td><?php echo $currencySymbol.$totalprice; ?></td>
        				</tr>
        			<?php }?>
        				<tr>
        					<td style="text-align: center;font-weight: bold;"> <?php echo __('Total');?> </td>
        					<td><?php echo $currencySymbol.$totalitemprice; ?></td>
        					<td><?php echo $currencySymbol.$totalShipping; ?></td>
        					<td><?php echo $currencySymbol.$grandtotal; ?></td>
        				</tr>
        			</tbody>
        		</table>
        	</div>
        	<input type="hidden" id="hiddenorderid" value="<?php echo $orderModel['Orders']['orderid']; ?>" />
        	<input type="hidden" id="hiddenbuyeremail" value="<?php echo $userModel['User']['email']; ?>" />
        	<input type="hidden" id="hiddenbuyername" value="<?php echo $userModel['User']['first_name']; ?>" />
        </div>	
	</div>
	<div id="sidebar">
			<dl class="set_menu">
				<dt><?php echo __('ACCOUNT');?></dt>
				<dd><a href="<?php echo SITE_URL; ?>settings"  > <?php echo __('Profile');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>password" > <?php echo __('Password');?></a></dd>
				<dd><a href="<?php echo SITE_URL; ?>notifications" > <?php echo __('Notifications'); ?></a></dd>
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
	            <dd><a href="<?php echo SITE_URL; ?>purchases" class="current" ><i class="ic-ship current"></i><?php  echo __('My Orders'); ?></a></dd>
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
           		 <dd><a  href="<?php echo SITE_URL; ?>credits" ><i class="ic-pur"></i> <?php echo __('Credits');?></a></dd>
       			 <dd><a  href="<?php echo SITE_URL; ?>referrals" ><i class="ic-pur"></i> <?php echo __('Referrals');?></a></dd>
     			 <dd><a  href="<?php echo SITE_URL; ?>gift_cards" ><i class="ic-pur"></i> <?php echo __('Gift card');?></a></dd>
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
