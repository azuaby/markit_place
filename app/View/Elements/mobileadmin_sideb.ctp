<style>
.sidebar-nav ul li ul
{
	background:rgb(37,37,37);
}

.nav-tabs.nav-stacked > li.active > a, .nav-tabs.nav-stacked > li > ul > li.active > a {
    background: none repeat scroll 0 0 #10638B;
}

</style>

<div id="sidebar-left" class="span2" style="">
				
				<!--div class="row-fluid actions">
													
					<input type="text" class="search span12" placeholder="..." />
				
				</div-->	
				<?php
				echo '<span style="color:#FFFFFF;">';
				$menu_array = json_decode($admin_menus,true);
				echo '<span>';
				if($user_level=="god" && $admin_menus=="")
				{
				 ?> 
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-dashboard"></i>
					<span class="hidden-tablet">Dashboard</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-user"></i>
					<span class="hidden-tablet">User Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'addmember/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add User</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/user/management/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_users/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'inactivemembers/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>						
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-money"></i>
					<span class="hidden-tablet">Payment</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/pgsetup/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Payment Gateway</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_ship/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_deliver/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_paid/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>												
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/specialdelivery/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Special Delivery</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/viewcommission/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Commission Setup</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/delivery_area/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Commission Setup</span>
						</a>						
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliverycharges/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Delivery Charges Countries</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliveryarea/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Delivery Charges Countries</span>
						</a>						
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/payments/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Invoices</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-key"></i>
					<span class="hidden-tablet">Coupons</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addcoupon/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add coupon</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/managecoupon/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage coupon</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'couponlog'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Coupon Logs</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-gift"></i>
					<span class="hidden-tablet">Gift Card</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'giftcard/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Gift Card</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'giftcardlog/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Logs</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-briefcase"></i>
					<span class="hidden-tablet">Store Preferences</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/allowcountries'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Allowed Countries</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/allowcountries'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Country</span>
						</a>						
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliverycountries'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Delivery Countries</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/countries'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Country</span>
						</a>						
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/view/category'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Category</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/category'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Category</span>
						</a>						
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/items'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Items</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_items/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Items</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'additem/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Item</span>
						</a>	
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/item/upload'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Import</span>
						</a>							
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/affiliate'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Shared Items</span>
						</a>
					</li>					
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/price'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Prices</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/price'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Price</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/colors'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Colors</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/colors'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Color</span>
						</a>						
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/currency/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Currency</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/currency/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Currency</span>
						</a>						
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/sellers'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Sellers</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_sellers/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Pending seller approval</span>
						</a>						
					</li>	
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-group"></i>
					<span class="hidden-tablet">Disputes</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/problemlist'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">User Options</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/dispquestion'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Dispute</span>
						</a>						
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/user/dispute'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Dispute</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-comments"></i>
					<span class="hidden-tablet">Messages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/contacteditem'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Seller Chat</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/contactsellersubject'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Subjects</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addcssubject'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Subjects</span>
						</a>						
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-globe"></i>
					<span class="hidden-tablet">Site Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/site/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Site Management</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/media/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Media Management</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/mail/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Email Management</span>
						</a>
					</li>			
					<!--li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/landingpage'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Landing Page</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/widgets'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Widgets</span>
						</a>
					</li-->
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/mobile/settings'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Mobile Apps Settings</span>
						</a>
					</li>
					<!--li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/social/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Social Settings</span>
						</a>						
					</li-->	
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-envelope"></i>
					<span class="hidden-tablet">Newsletter</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addnews'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Contacts</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/newsletter'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Send Newsletter</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/get_contacts'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Get Contacts List</span>
						</a>
					</li>																			
				</ul>	
			</li>			
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-filter"></i>
					<span class="hidden-tablet">General Settings</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/module/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Modules</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/google/code'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Google Analytics</span>
						</a>
					</li>								
				</ul>	
			</li>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-film"></i>
					<span class="hidden-tablet">Banner Settings</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>

						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/banner'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Banners</span>
						</a>
					</li>	
					<!--<li>

						<a data-ajax="false" href="<?php echo SITE_URL.'admin/view/banner'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Banners</span>
						</a>
					</li>-->								
				</ul>	
			</li>
			<!--li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-tint"></i>
					<span class="hidden-tablet">News Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/news'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add News</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/view/news'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage News</span>
						</a>
					</li>								
				</ul>	
			</li-->
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-exclamation-sign"></i>
					<span class="hidden-tablet">Error Pages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'err404'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">404 page</span>
						</a>
					</li>	
				</ul>	
			</li>	
			
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-legal"></i>
					<span class="hidden-tablet">Help Pages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
            		<li>
            			<a href="<?php echo SITE_URL.'admin/faq'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Faq</span>
            			</a>
            		</li>
            		<li>
            			<a href="<?php echo SITE_URL.'admin/contact'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Contact</span>
        				</a>
        			</li>
	    			<li>
	    				<a href="<?php echo SITE_URL.'admin/terms_sale'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	    					<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms of Sale</span>
	    				</a>
	    			</li>
            		<li>
            			<a href="<?php echo SITE_URL.'admin/terms_service'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms of Service</span>
            			</a>
            		</li>
	    			<li>
	    				<a href="<?php echo SITE_URL.'admin/privacy'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	    					<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Privacy Policy</span>
	    				</a>
	    			</li>
            		<li>
            			<a href="<?php echo SITE_URL.'admin/terms_merchant'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms and Conditions</span>
            			</a>
            		</li>
	   				<li>
	   					<a href="<?php echo SITE_URL.'admin/copyright'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	   						<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Copyright Policy</span>
	   					</a>
	   				</li>
				</ul>	
			</li>					
			</ul>
				</div>
				
				<!---- Moderate Users ------------>
				<?php
				}
				else if($user_level=="god" && $menu_array=="Home")
				{
				?>
					<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">	
						<li>
							<a href="#" class="dropmenu" style="font-weight:normal;">
								<i class="icon-dashboard"></i>
								<span class="hidden-tablet">Dashboard</span> 
								<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
							</a>
							<ul>
								<li>
									<a data-ajax="false" href="<?php echo SITE_URL.'admin'; ?>" class="submenu" style="font-weight:normal;">
										<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
									</a>
									<a data-ajax="false" href="<?php echo SITE_URL.'admin/'; ?>" class="submenu" style="font-weight:normal;display:none;">
										<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
									</a>
								</li>								
							</ul>	
						</li>		
					</ul>
				</div>
				<?php							
				}
				else
				{
				?>
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
	<?php
		if(in_array('Home',$menu_array))
		{	
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-dashboard"></i>
					<span class="hidden-tablet">Dashboard</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Home</span>
						</a>
					</li>								
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Add User',$menu_array) || in_array('Manage User',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-user"></i>
					<span class="hidden-tablet">User Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Add User',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'addmember/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add User</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage User',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/user/management/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_users/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'inactivemembers/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage user</span>
						</a>						
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Payment Gateway',$menu_array) || in_array('Orders',$menu_array) || in_array('Commission Setup',$menu_array) || in_array('Invoices',$menu_array) || in_array('Delivery Charges Countries',$menu_array) || in_array('Special Delivery',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-money"></i>
					<span class="hidden-tablet">Payment</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Payment Gateway',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/pgsetup/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Payment Gateway</span>
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Orders',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_ship/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_deliver/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/merchant_payment_paid/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Orders</span>
						</a>												
					</li>
			<?php
				}
			?>
			
			<?php
				if(in_array('Special Delivery',$menu_array))
				{
			?>				
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/specialdelivery/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Special Delivery</span>
						</a>
					</li>	
			<?php
				}
			?>
			
			<?php
				if(in_array('Commission Setup',$menu_array))
				{
			?>				
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/viewcommission/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Commission Setup</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/commission/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Commission Setup</span>
						</a>						
					</li>	
			<?php
				}
			?>
			
			<?php
				if(in_array('Delivery Charges Countries',$menu_array))
				{
			?>				
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliverycharges/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Delivery Charges Countries/span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliveryarea/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Delivery Charges Countries</span>
						</a>						
					</li>	
			<?php
				}
			?>
			
			<?php
				if(in_array('Invoices',$menu_array))
				{
			?>				
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/payments/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Invoices</span>
						</a>
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Add Coupon',$menu_array) || in_array('Manage Coupon',$menu_array) || in_array('Logs Coupon',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-key"></i>
					<span class="hidden-tablet">Coupons</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Add Coupon',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addcoupon/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add coupon</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Coupon',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/managecoupon/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage coupon</span>
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Logs Coupon',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'couponlog'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Logs Coupon</span>
						</a>
					</li>
			<?php
				}
			?>								
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Add Gift Card',$menu_array) || in_array('Logs',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-gift"></i>
					<span class="hidden-tablet">Gift Card</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Add Gift Card',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'giftcard/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Gift Card</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Logs',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'giftcardlog/'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Logs</span>
						</a>
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Manage Allowed Countries',$menu_array) || in_array('Manage Delivery Countries',$menu_array) || in_array('Manage Category',$menu_array) || in_array('Manage Items',$menu_array) || in_array('Manage Shared Items',$menu_array) || in_array('Manage Prices',$menu_array) || in_array('Manage Colors',$menu_array) || in_array('Manage Currency',$menu_array) || in_array('Manage Sellers',$menu_array))
		{
	?>			
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-briefcase"></i>
					<span class="hidden-tablet">Store Preferences</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Manage Allowed Countries',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/allowcountries'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Allowed Countries</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/allowcountries'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Country</span>
						</a>						
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Delivery Countries',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/deliverycountries'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Delivery Countries</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/countries'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Country</span>
						</a>						
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Category',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/view/category'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Category</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/category'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Category</span>
						</a>						
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Items',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/items'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Items</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_items/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Items</span>
						</a>						
						<a data-ajax="false" href="<?php echo SITE_URL.'additem/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Item</span>
						</a>		
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Shared Items',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/affiliate'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Shared Items</span>
						</a>
					</li>					
			<?php
				}
			?>
			<?php
				if(in_array('Manage Prices',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/price'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Prices</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/price'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Price</span>
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Manage Colors',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/colors'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Colors</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/colors'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Color</span>
						</a>						
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Manage Currency',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/currency'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Currency</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/currency/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Currency</span>
						</a>						
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Manage Sellers',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/sellers'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Sellers</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/nonapproved_sellers/'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Pending seller approval</span>
						</a>							
					</li>		
			<?php
				}
			?>		
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('User Options',$menu_array) || in_array('Manage Dispute',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-group"></i>
					<span class="hidden-tablet">Disputes</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('User Options',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/problemlist'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">User Options</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/dispquestion'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Dispute</span>
						</a>						
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Manage Dispute',$menu_array))
				{
			?>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/user/dispute'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Dispute</span>
						</a>
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Manage Seller Chat',$menu_array) || in_array('Manage Subjects',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-comments"></i>
					<span class="hidden-tablet">Messages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Manage Seller Chat',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/contacteditem'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Seller Chat</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Manage Subjects',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/contactsellersubject'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Subjects</span>
						</a>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addcssubject'; ?>" class="submenu" style="font-weight:normal;display:none;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Subjects</span>
						</a>						
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Site Management',$menu_array) || in_array('Media Management',$menu_array) || in_array('Email Management',$menu_array) || in_array('Mobile Apps Settings',$menu_array) || in_array('Social Settings',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-globe"></i>
					<span class="hidden-tablet">Site Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Site Management',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/site/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Site Management</span>
						</a>
					</li>
			<?php
				}
			?>	
			<?php
				if(in_array('Media Management',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/media/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Media Management</span>
						</a>
					</li>
			<?php
				}
			?>	
			<?php
				if(in_array('Email Management',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/mail/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Email Management</span>
						</a>
					</li>	
			<?php
				}
			?>	
					<!--li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/landingpage'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Landing Page</span>
						</a>
					</li>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/manage/widgets'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Widgets</span>
						</a>
					</li-->
			<?php
				if(in_array('Mobile Apps Settings',$menu_array))
				{
			?>					
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/mobile/settings'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Mobile Apps Settings</span>
						</a>
					</li>
			<?php
				}
			?>	
			<?php
				if(in_array('Social Settings',$menu_array))
				{
			?>					
					<!--li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/social/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Social Settings</span>
						</a>
					</li-->
			<?php
				}
			?>				
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Add Contacts',$menu_array) || in_array('Send Newsletter',$menu_array) || in_array('Get Contacts List',$menu_array))
		{ 
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-envelope"></i>
					<span class="hidden-tablet">Newsletter</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Add Contacts',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/addnews'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add Contacts</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Send Newsletter',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/newsletter'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Send Newsletter</span>
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(in_array('Get Contacts List',$menu_array))
				{
			?>				
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/get_contacts'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Get Contacts List</span>
						</a>
					</li>	
			<?php
				}
			?>																		
				</ul>	
			</li>	
	<?php
		}
	?>	
	<?php
		if(in_array('Manage Modules',$menu_array) || in_array('Google Analytics',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-filter"></i>
					<span class="hidden-tablet">General Settings</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Manage Modules',$menu_array))
				{
			?>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/module/setting'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage Modules</span>
						</a>
					</li>	
			<?php
				}
			?>
			<?php
				if(in_array('Google Analytics',$menu_array))
				{
			?>			
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/google/code'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Google Analytics</span>
						</a>
					</li>	
			<?php
				}
			?>							
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Banners',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-film"></i>
					<span class="hidden-tablet">Banner Settings</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/banner'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Banners</span>
						</a>
					</li>
				</ul>	
			</li>
	<?php
		}
	?>
			<!--li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-tint"></i>
					<span class="hidden-tablet">News Management</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/add/news'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Add News</span>
						</a>
					</li>	
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'admin/view/news'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Manage News</span>
						</a>
					</li>								
				</ul>	
			</li-->
	<?php
		if(in_array('404 page',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-exclamation-sign"></i>
					<span class="hidden-tablet">Error Pages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
					<li>
						<a data-ajax="false" href="<?php echo SITE_URL.'err404'; ?>" class="submenu" style="font-weight:normal;">
							<span class="hidden-tablet" style="margin-left:0px;font-size:13px">404 page</span>
						</a>
					</li>	
				</ul>	
			</li>
	<?php
		}
	?>
	<?php
		if(in_array('Faq',$menu_array) || in_array('Contact',$menu_array) || in_array('Terms of Sale',$menu_array) || in_array('Terms of Service',$menu_array) || in_array('Privacy Policy',$menu_array) || in_array('Terms and Conditions',$menu_array) || in_array('Copyright Policy',$menu_array))
		{
	?>
			<li>
				<a href="#" class="dropmenu" style="font-weight:normal;">
					<i class="icon-legal"></i>
					<span class="hidden-tablet">Help Pages</span> 
					<span class="label" style="background:none;color:#FFFFFF;font-size:12px;"><i class="icon-chevron-down"></i></span>
				</a>
				<ul>
			<?php
				if(in_array('Faq',$menu_array))
				{
			?>				
            		<li>
            			<a href="<?php echo SITE_URL.'admin/faq'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Faq</span>
            			</a>
            		</li>
            <?php
            	}
            ?>
			<?php
				if(in_array('Contact',$menu_array))
				{
			?>	            
            		<li>
            			<a href="<?php echo SITE_URL.'admin/contact'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Contact</span>
        				</a>
        			</li>
            <?php
            	}
            ?>        			
			<?php
				if(in_array('Terms of Sale',$menu_array))
				{
			?>	        			
	    			<li>
	    				<a href="<?php echo SITE_URL.'admin/terms_sale'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	    					<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms of Sale</span>
	    				</a>
	    			</li>
            <?php
            	}
            ?>	    			
			<?php
				if(in_array('Terms of Service',$menu_array))
				{
			?>		    			
            		<li>
            			<a href="<?php echo SITE_URL.'admin/terms_service'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms of Service</span>
            			</a>
            		</li>
            <?php
            	}
            ?>            		
			<?php
				if(in_array('Privacy Policy',$menu_array))
				{
			?>	            		
	    			<li>
	    				<a href="<?php echo SITE_URL.'admin/privacy'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	    					<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Privacy Policy</span>
	    				</a>
	    			</li>
            <?php
            	}
            ?>	    			
			<?php
				if(in_array('Terms and Conditions',$menu_array))
				{
			?>		    			
            		<li>
            			<a href="<?php echo SITE_URL.'admin/terms_merchant'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
            				<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Terms and Conditions</span>
            			</a>
            		</li>
            <?php
            	}
            ?>            		
			<?php
				if(in_array('Copyright Policy',$menu_array))
				{
			?>	            		
	   				<li>
	   					<a href="<?php echo SITE_URL.'admin/copyright'; ?>" data-ajax="false" class="submenu" style="font-weight:normal;">
	   						<span class="hidden-tablet" style="margin-left:0px;font-size:13px">Copyright Policy</span>
	   					</a>
	   				</li>
            <?php
            	}
            ?>	   				
				</ul>	
			</li>		
	<?php
		}
	?>			
			</ul>
				</div>
				<?php
				}
				?>
			</div>
