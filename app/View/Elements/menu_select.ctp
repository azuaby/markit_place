<?php
$menu_list = json_decode($admin_menus_list,true);
//echo '<button id="btn_closes" onclick="menu_list()" class="btn btn-danger inv-close" style="width: 90px; margin: 14px 6px 0px; font-size: 11px;float:right;">Back</button>';
	echo '<div style="width:49% !important;float:left;">';
		echo '<h3>Dashboard</h3>';
		if(in_array('Home',$menu_list) || $menu_list=="Home")
		echo '<input type="checkbox" checked="checked" value="Home" name="chkbox">Home';
		else
		echo '<input type="checkbox" value="Home" name="chkbox">Home';
		echo '<br />';
		echo '<h3>User Management</h3>';
		if(in_array('Add User',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Add User" name="chkbox">Add User';
		else
		echo '<input type="checkbox" value="Add User" name="chkbox">Add User';
		echo '<br />';
		if(in_array('Manage User',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage User" name="chkbox">Manage User';
		else
		echo '<input type="checkbox" value="Manage User" name="chkbox">Manage User';
		echo '<br />';
		echo '<h3>Payment</h3>';
		if(in_array('Payment Gateway',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Payment Gateway" name="chkbox">Payment Gateway';
		else
		echo '<input type="checkbox" value="Payment Gateway" name="chkbox">Payment Gateway';
		echo '<br />';
		if(in_array('Orders',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Orders" name="chkbox">Orders';
		else
		echo '<input type="checkbox" value="Orders" name="chkbox">Orders';
		echo '<br />';
		if(in_array('Commission Setup',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Commission Setup" name="chkbox">Commission Setup';
		else
		echo '<input type="checkbox" value="Commission Setup" name="chkbox">Commission Setup';
		echo '<br />';
		if(in_array('Invoices',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Invoices" name="chkbox">Invoices';
		else
		echo '<input type="checkbox" value="Invoices" name="chkbox">Invoices';
		echo '<br />';
		echo '<h3>Coupons</h3>';
		if(in_array('Add Coupon',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Add Coupon" name="chkbox">Add Coupon';
		else
		echo '<input type="checkbox" value="Add Coupon" name="chkbox">Add Coupon';
		echo '<br />';
		if(in_array('Manange Coupon',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Coupon" name="chkbox">Manange Coupon';
		else
		echo '<input type="checkbox" value="Manage Coupon" name="chkbox">Manange Coupon';
		echo '<br />';
		if(in_array('Logs Coupon',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Logs Coupon" name="chkbox">Logs Coupon';
		else
		echo '<input type="checkbox" value="Logs Coupon" name="chkbox">Logs Coupon';
		echo '<br />';
		echo '<h3>Gift Card</h3>';
		if(in_array('Add Gift Card',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Add Gift Card" name="chkbox">Add Gift Card';
		else
		echo '<input type="checkbox" value="Add Gift Card" name="chkbox">Add Gift Card';
		echo '<br />';
		if(in_array('Logs',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Logs" name="chkbox">Logs';
		else
		echo '<input type="checkbox" value="Logs" name="chkbox">Logs';
		echo '<br />';
		echo '<h3>Store Preferences</h3>';
		if(in_array('Manage Category',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Category" name="chkbox">Manage Category';
		else
		echo '<input type="checkbox" value="Manage Category" name="chkbox">Manage Category';
		echo '<br />';
		if(in_array('Manage Items',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Items" name="chkbox">Manage Items';
		else
		echo '<input type="checkbox" value="Manage Items" name="chkbox">Manage Items';
		echo '<br />';
		if(in_array('Manage Shared Items',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Shared Items" name="chkbox">Manage Shared Items';
		else
		echo '<input type="checkbox" value="Manage Shared Items" name="chkbox">Manage Shared Items';
		echo '<br />';
		if(in_array('Manage Prices',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Prices" name="chkbox">Manage Prices';
		else
		echo '<input type="checkbox" value="Manage Prices" name="chkbox">Manage Prices';
		echo '<br />';
		if(in_array('Manage Colors',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Colors" name="chkbox">Manage Colors';
		else
		echo '<input type="checkbox" value="Manage Colors" name="chkbox">Manage Colors';
		echo '<br />';
		if(in_array('Manage Currency',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Currency" name="chkbox">Manage Currency';
		else
		echo '<input type="checkbox" value="Manage Currency" name="chkbox">Manage Currency';
		echo '<br />';
		if(in_array('Manage Sellers',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Sellers" name="chkbox">Manage Sellers';
		else
		echo '<input type="checkbox" value="Manage Sellers" name="chkbox">Manage Sellers';
		echo '<br />';
		echo '<h3>Disputes</h3>';
		if(in_array('User Options',$menu_list))
		echo '<input type="checkbox" checked="checked" value="User Options" name="chkbox">User Options';
		else
		echo '<input type="checkbox" value="User Options" name="chkbox">User Options';
		echo '<br />';
		if(in_array('Manage Dispute',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Dispute" name="chkbox">Manage Dispute';
		else
		echo '<input type="checkbox" value="Manage Dispute" name="chkbox">Manage Dispute';
		echo '<br />';
		echo '<br />';
		echo '<br />';echo '<br />';echo '<br />';echo '<br />';echo '<br />';
	echo '</div>';
	echo '<div style="width:49% !important;float:right;">';
		echo '<h3>Messages</h3>';
		if(in_array('Manage Seller Chat',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Seller Chat" name="chkbox">Manage Seller Chat';
		else
		echo '<input type="checkbox" value="Manage Seller Chat" name="chkbox">Manage Seller Chat';
		echo '<br />';
		if(in_array('Manage Subjects',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Subjects" name="chkbox">Manage Subjects';
		else
		echo '<input type="checkbox" value="Manage Subjects" name="chkbox">Manage Subjects';
		echo '<br />';
		echo '<h3>Site Management</h3>';
		if(in_array('Site Management',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Site Management" name="chkbox">Site Management';
		else
		echo '<input type="checkbox" value="Site Management" name="chkbox">Site Management';
		echo '<br />';
		if(in_array('Media Management',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Media Management" name="chkbox">Media Management';
		else
		echo '<input type="checkbox" value="Media Management" name="chkbox">Media Management';
		echo '<br />';
		if(in_array('Email Management',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Email Management" name="chkbox">Email Management';
		else
		echo '<input type="checkbox" value="Email Management" name="chkbox">Email Management';
		echo '<br />';			
		if(in_array('Mobile Apps Settings',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Mobile Apps Settings" name="chkbox">Mobile Apps Settings';
		else
		echo '<input type="checkbox" value="Mobile Apps Settings" name="chkbox">Mobile Apps Settings';
		echo '<br />';
		/*if(in_array('Social Settings',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Social Settings" name="chkbox">Social Settings';
		else
		echo '<input type="checkbox" value="Social Settings" name="chkbox">Social Settings';
		echo '<br />';	*/	
		echo '<h3>Newsletter</h3>';
		if(in_array('Add Contacts',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Add Contacts" name="chkbox">Add Contacts';
		else
		echo '<input type="checkbox" value="Add Contacts" name="chkbox">Add Contacts';
		echo '<br />';
		if(in_array('Send Newsletter',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Send Newsletter" name="chkbox">Send Newsletter';
		else
		echo '<input type="checkbox" value="Send Newsletter" name="chkbox">Send Newsletter';
		echo '<br />';
		if(in_array('Get Contacts List',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Get Contacts List" name="chkbox">Get Contacts List';
		else
		echo '<input type="checkbox" value="Get Contacts List" name="chkbox">Get Contacts List';
		echo '<br />';
		echo '<h3>General Settings</h3>';
		if(in_array('Manage Modules',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Modules" name="chkbox">Manage Modules';
		else
		echo '<input type="checkbox" value="Manage Modules" name="chkbox">Manage Modules';
		echo '<br />';
		if(in_array('Google Analytics',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Google Analytics" name="chkbox">Google Analytics';
		else
		echo '<input type="checkbox" value="Google Analytics" name="chkbox">Google Analytics';
		echo '<br />';
		echo '<h3>Banner Settings</h3>';
		if(in_array('Banners',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Manage Banner" name="chkbox">Banners';
		else
		echo '<input type="checkbox" value="Manage Banner" name="chkbox">Banners';
		echo '<br />';
		echo '<h3>Error Pages</h3>';
		if(in_array('404 page',$menu_list))
		echo '<input type="checkbox" checked="checked" value="404 page" name="chkbox">404 page';
		else
		echo '<input type="checkbox" value="404 page" name="chkbox">404 page';
		echo '<br />';
		echo '<h3>Help Pages</h3>';
		if(in_array('Faq',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Faq" name="chkbox">Faq';
		else
		echo '<input type="checkbox" value="Faq" name="chkbox">Faq';
		echo '<br />';
		if(in_array('Contact',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Contact" name="chkbox">Contact';
		else
		echo '<input type="checkbox" value="Contact" name="chkbox">Contact';
		echo '<br />';
		if(in_array('Terms of Sale',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Terms of Sale" name="chkbox">Terms of Sale';
		else
		echo '<input type="checkbox" value="Terms of Sale" name="chkbox">Terms of Sale';
		echo '<br />';
		if(in_array('Terms of Service',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Terms of Service" name="chkbox">Terms of Service';
		else
		echo '<input type="checkbox" value="Terms of Service" name="chkbox">Terms of Service';
		echo '<br />';
		if(in_array('Privacy Policy',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Privacy Policy" name="chkbox">Privacy Policy';
		else
		echo '<input type="checkbox" value="Privacy Policy" name="chkbox">Privacy Policy';
		echo '<br />';
		if(in_array('Terms and Conditions',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Terms and Conditions" name="chkbox">Terms and Conditions';
		else
		echo '<input type="checkbox" value="Terms and Conditions" name="chkbox">Terms and Conditions';
		echo '<br />';
		if(in_array('Copyright Policy',$menu_list))
		echo '<input type="checkbox" checked="checked" value="Copyright Policy" name="chkbox">Copyright Policy';
		else
		echo '<input type="checkbox" value="Copyright Policy" name="chkbox">Copyright Policy';
		echo '<br />';
	echo '</div>';
	echo '<div style="width:30%;float:right;margin-top:70px;position:relative;left:50px;">';
		echo '<input type="button" value="Save" onclick="menu_list()" class="btn btn-primary">';
		echo '<input type="button" value="Cancel" onclick="close_button()" class="btn btn-primary">';
	echo '</div>';
?>
