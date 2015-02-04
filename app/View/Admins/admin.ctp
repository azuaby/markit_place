
 <div class="content">
			<div class="box span12">
				<div class="box-header">
					<h2>Dashboard</h2>
					<div style="margin:5px;text-align:right;">
						<span class="stats">
							<a href="<?php echo SITE_URL.'admin/specialdelivery/'; ?>" style="text-decoration:none;color:#ffffff;"><span class="label label-info"><?php echo $disable_special_del; ?></span>Items Waiting For Delivery Charge</a>
							<a href="<?php echo SITE_URL.'admin/manage/nonapproved_sellers/'; ?>" style="text-decoration:none;color:#ffffff;"><span class="label label-info"><?php echo $disable_sellers; ?></span> Seller Approval Waiting</a>
							<a href="<?php echo SITE_URL.'admin/manage/nonapproved_items/'; ?>" style="text-decoration:none;color:#ffffff;"><span class="label label-info"><?php echo $disbleitems; ?></span>  Items Waiting For Sale</a>
						</span>
					</div>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
						<li><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
						<li class="active">Dashboard</li>
					</ul>
				</div>
			</div>
         
</div>






                    

<div class="row-fluid">

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert"> x </button>
        <strong>Welcome:</strong> Admin!
    </div>



						

						<?php $total_admin_commission = round($total_admin_commission); ?>
						 <div class="row-fluid">
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<i class="icon-user blue"></i>
					<span class="title">Users</span>
					<span class="value"><?php echo $total_usrs; ?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<i class="icon-user green"></i>
					<span class="title">Active Users</span>
					<span class="value"><?php echo $enbleusrs; ?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
					<i class="icon-plus pink"></i>
					<span class="title">Total Items</span>
					<span class="value"><?php echo $total_items; ?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf box" ontablet="span6" ondesktop="span3">
					<i class="icon-money red"></i>
					<span class="title">Listed merchandize value</span>
					<span class="value">$<?php echo $total_merchandize_value; ?></span>
				</div>				
				</div>
				 <div class="row-fluid">
				<div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
					<i class="icon-money orange"></i>
					<span class="title">Complete Transactions</span>
					<span class="value">$<?php echo $total_complete_payment; ?></span>
				</div>
				<div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
					<i class="icon-money yellow"></i>
					<span class="title">Total Revenue</span>
					<span class="value">$<?php echo $total_admin_commission; ?></span>
				</div>				
				<div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
					<i class="icon-shopping-cart blue"></i>
					<span class="title">New Orders Today</span>
					<span class="value"><?php echo $today_new_orders_count; ?></span>
				</div>	
				<div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
					<i class="icon-truck pink"></i>
					<span class="title">Delivered Orders Today</span>
					<span class="value"><?php echo $today_delivered_orders_count; ?></span>
				</div>				
			</div>	
						<div style="with:98% ! important;">
						<div style="width:70%;float:left;">
								<!-----User table------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Users</h2>
						<div class="box-icon">
							
							<span class="label label-warning">+10</span>
						</div>
					</div>
					<div class="box-content">
						<table class="table">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
              
              <?php 
              //echo "<pre>";print_r($user_datas);die; 
              
              foreach($user_datas as $users){       ?>
	            <tr>
                  <td><?php echo $users['User']['first_name']; ?></td>
                  <td><?php echo $users['User']['last_name']; ?></td>
                  <td><?php echo $users['User']['username']; ?></td>
                </tr>
                
                <?php } ?>
              
              </tbody>

            </table>     
             <p><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL.'admin/user/management/'; ?>">More...</a></p> 
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----User table------->	
						</div>
						<div style="width:28%;float:right;">
						
						
						<!------Send push notification------->
						<div class="box blue span12 noMarginLeft">
							<div class="box-header">																
									<h2>Send Push Notification</h2>
							</div>
							<div class="box-content">
														 <?php 
						            echo "<div class='input-group'>";
						            echo "<label>Message</label>";
						            echo $this->Form->input('message',array('type'=>'textarea','label'=>false,'id'=>'message','class'=>'input-xlarge','value'=>'','style'=>'width:250px !important; height:100px;'));
						            
						           	echo '<div class="message-error adminitemerror" style="color:#982525"></div></div>';
						           	
						           	echo '<input type="button" class="btn btn-primary" value="Send" onclick="sendpushnot();">';
						          						           	
						           	echo '<div class="message-success adminitemerror" style="color:#259825;display:inline-block;"></div>';
						            
						            ?>
						            <div class="pushnotloader" style="display:inline-block;">
						        		<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading" style="width:20px;display:none;"/>
						        	</div>
							</div>	
						</div>
						<!------------Send push notification------->	
						</div></div>

            </table>
         
        </div>
    </div>


</div>



                    
            </div>
        </div>
    </div>

    <style>
    
</style>


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
        setTimeout(function(){$('.alert').fadeOut();}, 2000); 
    </script>

  </body>
</html>

