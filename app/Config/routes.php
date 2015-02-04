<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect('/', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/mobile/', array('controller' => 'mobiles', 'action' => 'index'));
	Router::connect('/login/*', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/mobile/login/*', array('controller' => 'mobiles', 'action' => 'login'));
	Router::connect('/signup/*', array('controller' => 'users', 'action' => 'signup'));
	Router::connect('/mobile/signup/*', array('controller' => 'mobiles', 'action' => 'signup'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/mobile/logout', array('controller' => 'mobiles', 'action' => 'logout'));
	Router::connect('/verification/*', array('controller' => 'users', 'action' => 'verification'));
	Router::connect('/mobile/verification/*', array('controller' => 'mobiles', 'action' => 'verification'));
	Router::connect('/manage/profile/*', array('controller' => 'users', 'action' => 'manageprofile'));
	Router::connect('/people/*', array('controller' => 'users', 'action' => 'userprofiles'));
	Router::connect('/mobile/people/*', array('controller' => 'mobiles', 'action' => 'userprofiles'));
	//Router::connect('/people/*', array('controller' => 'users', 'action' => 'userprofile_added'));
	Router::connect('/conversation/*',array('controller'=>'users','action'=>'conversation'));
	Router::connect('/composemsg/*',array('controller'=>'users','action'=>'composemsg'));
	Router::connect('/readmsg/*',array('controller'=>'users','action'=>'readmsg'));
	Router::connect('/search/shops/*',array('controller'=>'users','action'=>'shopsearch'));
	Router::connect('/search/people/*',array('controller'=>'users','action'=>'peoplesearch'));
	Router::connect('/mobile/search/people/*',array('controller'=>'mobiles','action'=>'peoplesearch'));
	Router::connect('/daily/update/*',array('controller'=>'users','action'=>'daily_update'));
	Router::connect('/update/*',array('controller'=>'users','action'=>'user_update'));
	Router::connect('/mobile/update/*',array('controller'=>'mobiles','action'=>'user_update'));
	Router::connect('/settings/*',array('controller'=>'users','action'=>'user_settings'));
	Router::connect('/mobile/settings/*',array('controller'=>'mobiles','action'=>'settings'));
	Router::connect('/mobile/user_settings/*',array('controller'=>'mobiles','action'=>'user_settings'));
	Router::connect('/purchases/*',array('controller'=>'users','action'=>'purchaseditem'));
	Router::connect('/mobile/purchases/*',array('controller'=>'mobiles','action'=>'purchaseditem'));
	Router::connect('/orders/*',array('controller'=>'users','action'=>'myorders'));
	Router::connect('/mobile/orders/*',array('controller'=>'mobiles','action'=>'myorders'));
	Router::connect('/password/*',array('controller'=>'users','action'=>'password_change'));
	Router::connect('/mobile/password/*',array('controller'=>'mobiles','action'=>'password_change'));
	Router::connect('/addshipping/*',array('controller'=>'users','action'=>'addshipping'));
	Router::connect('/mobile/addshipping/*',array('controller'=>'mobiles','action'=>'addshipping'));
	Router::connect('/shipping/*',array('controller'=>'users','action'=>'shipping'));
	Router::connect('/mobile/shipping/*',array('controller'=>'mobiles','action'=>'shipping'));
	Router::connect('/notifications/*',array('controller'=>'users','action'=>'user_notifications'));
	Router::connect('/mobile/notifications/*',array('controller'=>'mobiles','action'=>'user_notifications'));
	Router::connect('/userlike/*',array('controller'=>'users','action'=>'userlike'));
	Router::connect('/mobile/userlike/*',array('controller'=>'mobiles','action'=>'userlike'));
	Router::connect('/ajaxSearch',array('controller'=>'users','action'=>'ajaxSearch'));
	Router::connect('/getMorePosts',array('controller'=>'users','action'=>'getMorePosts'));
	Router::connect('/mobile/getMorePosts',array('controller'=>'mobiles','action'=>'getMorePosts'));
	Router::connect('/sellersignup/*',array('controller'=>'users','action'=>'sellersignup'));
	Router::connect('/mobile/sellersignup/*',array('controller'=>'mobiles','action'=>'sellersignup'));
	Router::connect('/delerteflw_usrs',array('controller'=>'users','action'=>'delerteflw_usrs'));
	Router::connect('/forgotpassword/*',array('controller'=>'users','action'=>'forgotpassword'));
	Router::connect('/mobile/forgotpassword/*',array('controller'=>'mobiles','action'=>'forgotpassword'));
	Router::connect('/findusers',array('controller'=>'users','action'=>'findusers'));
	Router::connect('/changeTab',array('controller'=>'users','action'=>'changeTab'));
	Router::connect('/mobile/changeTab',array('controller'=>'mobiles','action'=>'changeTab'));
	Router::connect('/adduserlist',array('controller'=>'users','action'=>'adduserlist'));
	Router::connect('/mobile/adduserlist',array('controller'=>'mobiles','action'=>'adduserlist'));
	Router::connect('/totaladduserlist',array('controller'=>'users','action'=>'totaladduserlist'));
	Router::connect('/mobile/totaladduserlist',array('controller'=>'mobiles','action'=>'totaladduserlist'));
	Router::connect('/userUnlike',array('controller'=>'users','action'=>'userUnlike'));
	Router::connect('/mobile/userUnlike',array('controller'=>'mobiles','action'=>'userUnlike'));
	Router::connect('/loginwith/*',array('controller'=>'users','action'=>'loginwith'));
	Router::connect('/loginwithtwitter/*',array('controller'=>'users','action'=>'loginwithtwitter'));
	Router::connect('/twittlogin_save/*',array('controller'=>'users','action'=>'twittlogin_save'));
	Router::connect('/deactivateacc/*',array('controller'=>'users','action'=>'deactivateacc'));
	Router::connect('/mobile/deactivateacc/*',array('controller'=>'mobiles','action'=>'deactivateacc'));
	Router::connect('/invite_twit_msg/*',array('controller'=>'users','action'=>'invite_twit_msg'));
	Router::connect('/sendinviteemail/*',array('controller'=>'users','action'=>'sendinviteemail'));
	Router::connect('/sendinviteemailref/*',array('controller'=>'users','action'=>'sendinviteemailref'));
	Router::connect('/user_lists/*',array('controller'=>'users','action'=>'user_lists'));
	Router::connect('/mobile/user_lists/*',array('controller'=>'mobiles','action'=>'user_lists'));
	Router::connect('/push_notifications/*',array('controller'=>'users','action'=>'push_notifications'));
	Router::connect('/mobile/push_notifications/*',array('controller'=>'mobiles','action'=>'push_notifications'));
	Router::connect('/referrals/*',array('controller'=>'users','action'=>'referrals'));
	Router::connect('/mobile/referrals/*',array('controller'=>'mobiles','action'=>'referrals'));
	Router::connect('/credits/*',array('controller'=>'users','action'=>'credits'));
	Router::connect('/mobile/credits/*',array('controller'=>'mobiles','action'=>'credits'));
	Router::connect('/gift_cards/*',array('controller'=>'users','action'=>'gift_cards'));
	Router::connect('/mobile/gift_cards/*',array('controller'=>'mobiles','action'=>'gift_cards'));
	Router::connect('/searches/*', array('controller' => 'users', 'action' => 'searches'));
	Router::connect('/nearme/*', array('controller' => 'users', 'action' => 'nearme'));
	Router::connect('/getMorenearme/*', array('controller' => 'users', 'action' => 'getMorenearme'));
	Router::connect('/getmoregallery',array('controller'=>'users','action'=>'getmoregallery'));
	Router::connect('/getmoreprofile/*',array('controller'=>'users','action'=>'getmoreprofile'));
	Router::connect('/mobile/getmoreprofile/*',array('controller'=>'mobiles','action'=>'getmoreprofile'));
	
	Router::connect('/sellerpost/*', array('controller' => 'users', 'action' => 'sellerpost'));
	Router::connect('/changeuserimgstatuss/*', array('controller' => 'users', 'action' => 'changeuserimgstatuss'));
	Router::connect('/inshopuseraddimage/*', array('controller' => 'users', 'action' => 'inshopuseraddimage'));
	Router::connect('/changeStatusForuserphotoinshppage/*', array('controller' => 'users', 'action' => 'changeStatusForuserphotoinshppage'));
	Router::connect('/mostpopular/*', array('controller' => 'users', 'action' => 'mostpopular'));
	Router::connect('/getMostpopular/*', array('controller' => 'users', 'action' => 'getMostpopular'));
	
	
	Router::connect('/rss/*',array('controller'=>'users','action'=>'rssfeed'));
	
	Router::connect('/captcha/*', array('controller' => 'users', 'action' => 'captcha'));
	Router::connect('/email/notification/*', array('controller' => 'users', 'action' => 'notification_email'));
	Router::connect('/ajaxUserAuto/*', array('controller' => 'users', 'action' => 'ajaxUserAuto'));
	Router::connect('/mobile/ajaxUserAuto/*', array('controller' => 'mobiles', 'action' => 'ajaxUserAuto'));
	Router::connect('/invite_friends/*', array('controller' => 'users', 'action' => 'invite_friends'));
	Router::connect('/mobile/invite_friends/*', array('controller' => 'mobiles', 'action' => 'invite_friends'));
	Router::connect('/twtusercon/*', array('controller' => 'users', 'action' => 'twtusercon'));
	Router::connect('/bookmarklet/*', array('controller' => 'users', 'action' => 'bookmarklet'));
	Router::connect('/orderstatus/*', array('controller' => 'users', 'action' => 'orderstatus'));
	Router::connect('/markshipped/*', array('controller' => 'users', 'action' => 'markshipped'));
	Router::connect('/trackingdetails/*', array('controller' => 'users', 'action' => 'trackingdetails'));
	Router::connect('/users/viewinvoice/*', array('controller' => 'users', 'action' => 'viewinvoice'));
	Router::connect('/updatetrackingdetails/*', array('controller' => 'users', 'action' => 'updatetrackingdetails'));
	Router::connect('/buyerconversation/*', array('controller' => 'users', 'action' => 'buyerconversation'));
	Router::connect('/postordercomment/*', array('controller' => 'users', 'action' => 'postordercomment'));
	Router::connect('/buyerorderdetails/*', array('controller' => 'users', 'action' => 'buyerorderdetails'));
	Router::connect('/sellerconversation/*', array('controller' => 'users', 'action' => 'sellerconversation'));
	Router::connect('/getrecentcmnt/*', array('controller' => 'users', 'action' => 'getrecentcmnt'));
	Router::connect('/oldorders/*', array('controller' => 'users', 'action' => 'oldmyorders'));
	Router::connect('/mobile/oldorders/*', array('controller' => 'mobiles', 'action' => 'oldmyorders'));
	Router::connect('/getmorecomment/*', array('controller' => 'users', 'action' => 'getmorecomment'));
	Router::connect('/category_verification/*', array('controller' => 'users', 'action' => 'category_verification'));
	Router::connect('/findsearch',array('controller'=>'users','action'=>'findsearch'));
	Router::connect('/ajaxUsergiftcard/*', array('controller' => 'users', 'action' => 'ajaxUsergiftcard'));
	Router::connect('/ajaxUsergroupgiftcard/*', array('controller' => 'users', 'action' => 'ajaxUsergroupgiftcard'));
	Router::connect('/ajaxUserAutogroupgift/*', array('controller' => 'users', 'action' => 'ajaxUserAutogroupgift'));
	
	
	Router::connect('/addcomments/*',array('controller'=>'items','action'=>'addcomments'));
	Router::connect('/mobile/addcomments/*',array('controller'=>'mobileitems','action'=>'addcomments'));
	Router::connect('/deletecomments/*',array('controller'=>'items','action'=>'deletecomments'));
	Router::connect('/mobile/deletecomments/*',array('controller'=>'mobileitems','action'=>'deletecomments'));
	Router::connect('/deleteadditem/*',array('controller'=>'items','action'=>'deleteadditem'));
	Router::connect('/editcommentsave/*',array('controller'=>'items','action'=>'editcommentsave'));
	Router::connect('/wantit',array('controller'=>'items','action'=>'wantit'));
	Router::connect('/ownit',array('controller'=>'items','action'=>'ownit'));
	
	Router::connect('/color/*', array('controller' => 'categories', 'action' => 'show_color'));
	Router::connect('/mobile/color/*', array('controller' => 'mobilecategories', 'action' => 'show_color'));
	Router::connect('/price/*', array('controller' => 'categories', 'action' => 'show_price'));
	Router::connect('/mobile/price/*', array('controller' => 'mobilecategories', 'action' => 'show_price'));
	Router::connect('/shop/*', array('controller' => 'categories', 'action' => 'showByCategory'));
	Router::connect('/mobile/shop/*', array('controller' => 'mobilecategories', 'action' => 'showByCategory'));
	Router::connect('/recomendations/*', array('controller' => 'categories', 'action' => 'showByRelation'));
	Router::connect('/mobile/recomendations/*', array('controller' => 'mobilecategories', 'action' => 'showByRelation'));
	Router::connect('/delete_category_admin/*', array('controller' => 'categories', 'action' => 'delete_category_admin'));
	Router::connect('/mobile/delete_category_admin/*', array('controller' => 'mobilecategories', 'action' => 'delete_category_admin'));
	Router::connect('/getmorepricecolor/*', array('controller' => 'categories', 'action' => 'getmorepricecolor'));
	Router::connect('/mobile/getmorepricecolor/*', array('controller' => 'mobilecategories', 'action' => 'getmorepricecolor'));
	Router::connect('/delete_currency_admin/*', array('controller' => 'admins', 'action' => 'delete_currency_admin'));
	
	
	
	//ADMIN
	Router::connect('/addadminsettings', array('controller' => 'admins', 'action' => 'addadminsettings'));
	Router::connect('/addmember', array('controller' => 'admins', 'action' => 'add_member'));
	Router::connect('/mobile/addmember', array('controller' => 'mobileadmins', 'action' => 'add_member'));
	Router::connect('/additem/*', array('controller' => 'admins', 'action' => 'add_item'));
	Router::connect('/mobile/additem/*', array('controller' => 'mobileadmins', 'action' => 'add_item'));
	Router::connect('/admin/edititem/*', array('controller' => 'admins', 'action' => 'editItem'));
	Router::connect('/admin', array('controller' => 'admins', 'action' => 'admin'));
	Router::connect('/mobile/admin', array('controller' => 'mobileadmins', 'action' => 'admin'));
	Router::connect('/admin/user/management/*', array('controller' => 'admins', 'action' => 'user_management'));
	Router::connect('/admin/deliverycharges/*', array('controller' => 'admins', 'action' => 'delivery_charges'));
	Router::connect('/admin/deliveryarea/*', array('controller' => 'admins', 'action' => 'delivery_area'));
	Router::connect('/admin/edit/delcharge/*', array('controller' => 'admins', 'action' => 'edit_delcharge'));
	Router::connect('/delete_delcharge/*', array('controller' => 'admins', 'action' => 'delete_delcharge'));
	
	Router::connect('/admin/allowcountries/*', array('controller' => 'admins', 'action' => 'allowed_countries'));
	Router::connect('/admin/edit/allowcountries/*', array('controller' => 'admins', 'action' => 'edit_countries'));
	Router::connect('/admin/add/allowcountries/*', array('controller' => 'admins', 'action' => 'add_countries'));
	Router::connect('/delete_alcntry/*', array('controller' => 'admins', 'action' => 'delete_alcntry'));
	
	Router::connect('/admin/specialdelivery/*', array('controller' => 'admins', 'action' => 'specialdelivery'));
	Router::connect('/admin/edit_specialdelivery/*', array('controller' => 'admins', 'action' => 'edit_specialdelivery'));
	
	Router::connect('/admin/deliverycountries/*', array('controller' => 'admins', 'action' => 'delivery_countries'));
	Router::connect('/admin/add/countries/*', array('controller' => 'admins', 'action' => 'add_del_countries'));
	Router::connect('/admin/edit/countries/*', array('controller' => 'admins', 'action' => 'edit_del_countries'));
	Router::connect('/delete_delcntry/*', array('controller' => 'admins', 'action' => 'delete_delcntry'));
	
	Router::connect('/mobile/admin/user/management/*', array('controller' => 'mobileadmins', 'action' => 'user_management'));
	Router::connect('/admin/user/searchmgmt/*', array('controller' => 'admins', 'action' => 'user_searchmgmt'));
	Router::connect('/admin/payments/*', array('controller' => 'admins', 'action' => 'invoice_management'));
	Router::connect('/admin/invoice_search_management/*', array('controller' => 'admins', 'action' => 'invoice_search_management'));
	Router::connect('/mobile/admin/payments/*', array('controller' => 'mobileadmins', 'action' => 'invoice_management'));
	Router::connect('/admin/merchant_payment/*', array('controller' => 'admins', 'action' => 'merchant_payment'));
	Router::connect('/admin/merchant_payment_export/*', array('controller' => 'admins', 'action' => 'merchant_payment_export'));
	Router::connect('/admin/merchant_payment_search/*', array('controller' => 'admins', 'action' => 'merchant_payment_search'));
	Router::connect('/mobile/admin/merchant_payment/*', array('controller' => 'mobileadmins', 'action' => 'merchant_payment'));
	Router::connect('/admin/viewinvoice/*', array('controller' => 'admins', 'action' => 'invoice_view'));
	Router::connect('/err404', array('controller' => 'admins', 'action' => 'err404'));
	Router::connect('/paytomerchant/*', array('controller' => 'admins', 'action' => 'pay_to_merchant'));
	Router::connect('/admin/add/category', array('controller' => 'admins', 'action' => 'create_category'));
	Router::connect('/profile/edit/*', array('controller' => 'admins', 'action' => 'profile_edit'));
	Router::connect('/admin/user/deleteusrdetls/*', array('controller' => 'admins', 'action' => 'deleteusrdetls'));
	Router::connect('/payadminurl/*', array('controller' => 'admins', 'action' => 'payadminurl'));
	Router::connect('/admin/commission/*', array('controller' => 'admins', 'action' => 'commission'));
	Router::connect('/admin/viewcommission/*', array('controller' => 'admins', 'action' => 'view_commission'));
	Router::connect('/mobile/admin/viewcommission/*', array('controller' => 'mobileadmins', 'action' => 'view_commission'));
	Router::connect('/admin/editcommission/*', array('controller' => 'admins', 'action' => 'editcommission'));
	Router::connect('/admin/deletecommission/*', array('controller' => 'admins', 'action' => 'deletecommission'));
	Router::connect('/admin/activatecommission/*', array('controller' => 'admins', 'action' => 'activatecommission'));
	Router::connect('/admin/merchant_payment_ship/*', array('controller' => 'admins', 'action' => 'merchant_payment_ship'));
	Router::connect('/admin/merchant_payment_ship_search/*', array('controller' => 'admins', 'action' => 'merchant_payment_ship_search'));
	Router::connect('/admin/merchant_payment_deliver/*', array('controller' => 'admins', 'action' => 'merchant_payment_deliver'));
	Router::connect('/admin/merchant_payment_deliver_search/*', array('controller' => 'admins', 'action' => 'merchant_payment_deliver_search'));
	Router::connect('/admin/merchant_payment_paid/*', array('controller' => 'admins', 'action' => 'merchant_payment_paid'));
	Router::connect('/admin/merchant_payment_paid_search/*', array('controller' => 'admins', 'action' => 'merchant_payment_paid_search'));
	Router::connect('/admin/pgsetup/*', array('controller' => 'admins', 'action' => 'pgsetup'));
	Router::connect('/mobile/admin/pgsetup/*', array('controller' => 'mobileadmins', 'action' => 'pgsetup'));
	Router::connect('/admin/add/price/*', array('controller' => 'admins', 'action' => 'addprice'));
	Router::connect('/admin/manage/price/*', array('controller' => 'admins', 'action' => 'manageprice'));
	Router::connect('/admin/edit/price/*', array('controller' => 'admins', 'action' => 'editprice'));
	Router::connect('/admin/edit/user/*', array('controller' => 'admins', 'action' => 'edituser'));
	Router::connect('/deleteprice/*', array('controller' => 'admins', 'action' => 'deleteprice'));
	Router::connect('/admin/add/colors/*', array('controller' => 'admins', 'action' => 'addcolors'));
	Router::connect('/admin/edit/color/*', array('controller' => 'admins', 'action' => 'editcolor'));
	Router::connect('/deletecolor/*', array('controller' => 'admins', 'action' => 'deletecolor'));
	Router::connect('/admin/manage/colors/*', array('controller' => 'admins', 'action' => 'managecolors'));
	Router::connect('/admin/addcoupon/*', array('controller' => 'admins', 'action' => 'addcoupon'));
	Router::connect('/viewCoupon/*', array('controller' => 'admins', 'action' => 'viewCoupon'));	
	Router::connect('/viewMerchant/*', array('controller' => 'admins', 'action' => 'viewMerchant'));
	Router::connect('/viewShip/*', array('controller' => 'admins', 'action' => 'viewShip'));
	Router::connect('/viewDeliver/*', array('controller' => 'admins', 'action' => 'viewDeliver'));
	Router::connect('/viewPaid/*', array('controller' => 'admins', 'action' => 'viewPaid'));
	Router::connect('/mobile/admin/addcoupon/*', array('controller' => 'mobileadmins', 'action' => 'addcoupon'));
	Router::connect('/admin/managecoupon/*', array('controller' => 'admins', 'action' => 'managecoupon'));
	Router::connect('/mobile/admin/managecoupon/*', array('controller' => 'mobileadmins', 'action' => 'managecoupon'));
	Router::connect('/admin/generatecoupons/*', array('controller' => 'admins', 'action' => 'generatecoupons'));
	Router::connect('/deletecoupon/*', array('controller' => 'admins', 'action' => 'deletecoupon'));
	Router::connect('/editcoupon/*', array('controller' => 'admins', 'action' => 'editcoupon'));
	Router::connect('/couponlog/*', array('controller' => 'admins', 'action' => 'couponlog'));
	Router::connect('/mobile/couponlog/*', array('controller' => 'mobileadmins', 'action' => 'couponlog'));
	Router::connect('/giftcard/*', array('controller' => 'admins', 'action' => 'giftcard'));
	Router::connect('/giftcardlog/*', array('controller' => 'admins', 'action' => 'giftcardlog'));
	Router::connect('/admin/searchitemkeyword/*', array('controller' => 'admins', 'action' => 'searchitemkeyword'));
	Router::connect('/admin/searchaffiliate/*', array('controller' => 'admins', 'action' => 'searchaffiliate'));
	Router::connect('/admin/manage/currency/*', array('controller' => 'admins', 'action' => 'managecurrency'));
	Router::connect('/admin/add/currency/*', array('controller' => 'admins', 'action' => 'addcurrency'));
	Router::connect('/admin/edit/currency/*', array('controller' => 'admins', 'action' => 'editcurrency'));
	Router::connect('/admin/manage/sellers/*', array('controller' => 'admins', 'action' => 'manageseller'));
	Router::connect('/admin/manage/nonapproved_sellers/*', array('controller' => 'admins', 'action' => 'nonapproved_sellers'));
	Router::connect('/admin/manage/nonapproved_users/*', array('controller' => 'admins', 'action' => 'nonapproved_users'));
	Router::connect('/admin/manage/nonapproved_items/*', array('controller' => 'items', 'action' => 'nonapproved_items'));
	Router::connect('/admin/searchsellerkeyword/*', array('controller' => 'admins', 'action' => 'searchsellerkeyword'));
	Router::connect('/admin/manage/searchnonapprovedusers/*', array('controller' => 'admins', 'action' => 'searchnonapprovedusers'));
	Router::connect('/admin/manage/searchnonapproveditems/*', array('controller' => 'admins', 'action' => 'searchnonapproveditems'));
	Router::connect('/admin/searchnonapproveseller/*', array('controller' => 'admins', 'action' => 'searchnonapproveseller'));
	Router::connect('/admin/editseller/*', array('controller' => 'admins', 'action' => 'editseller'));
	Router::connect('/admin/mobile/settings', array('controller' => 'admins', 'action' => 'mobile_settings'));
	Router::connect('/deleteinactivemembers/*', array('controller' => 'admins', 'action' => 'deleteinactivemembers'));
	Router::connect('/inactivemembers/*', array('controller' => 'admins', 'action' => 'inactivemembers'));
	Router::connect('/admin/item/upload', array('controller' => 'admins', 'action' => 'upload_item'));
	Router::connect('/admin/newsletter', array('controller' => 'admins', 'action' => 'newsletter'));
	Router::connect('/admin/addnews', array('controller' => 'admins', 'action' => 'addnews'));
	Router::connect('/admin/get_contacts', array('controller' => 'admins', 'action' => 'get_contacts'));
	Router::connect('/admin/list_contacts', array('controller' => 'admins', 'action' => 'list_contacts'));
	Router::connect('/admin/addcontactslist', array('controller' => 'admins', 'action' => 'addcontactslist'));
	

	/* Help fro Admin */
	Router::connect('/admin/contact', array('controller' => 'admins', 'action' => 'contact'));
	Router::connect('/admin/terms_sale', array('controller' => 'admins', 'action' => 'terms_sale'));
	Router::connect('/admin/terms_service', array('controller' => 'admins', 'action' => 'terms_service'));
	Router::connect('/admin/privacy', array('controller' => 'admins', 'action' => 'privacy'));
	Router::connect('/admin/terms_merchant', array('controller' => 'admins', 'action' => 'terms_merchant'));
	Router::connect('/admin/copyright', array('controller' => 'admins', 'action' => 'copyright'));
	Router::connect('/admin/faq', array('controller' => 'admins', 'action' => 'faq'));
	
	/* category controller */
	Router::connect('/admin/view/category/*', array('controller' => 'categories', 'action' => 'view_category'));
	Router::connect('/admin/edit/category/*', array('controller' => 'categories', 'action' => 'edit_category'));
	Router::connect('/browse/*', array('controller' => 'categories', 'action' => 'view_details_categitem'));
	
	/* site controller */
	Router::connect('/admin/site/setting', array('controller' => 'sites', 'action' => 'sitesetng'));
	Router::connect('/admin/media/setting', array('controller' => 'sites', 'action' => 'mediasetng'));
	Router::connect('/admin/mail/setting', array('controller' => 'sites', 'action' => 'mailsetng'));
	Router::connect('/admin/social/setting', array('controller' => 'sites', 'action' => 'socialsetng'));
	Router::connect('/admin/module/setting', array('controller' => 'sites', 'action' => 'manage_modules'));
	Router::connect('/admin/manage/landingpage/*', array('controller' => 'sites', 'action' => 'landingpage'));
	Router::connect('/admin/addslider/*', array('controller' => 'sites', 'action' => 'addslider'));
	Router::connect('/admin/deleteslider/*', array('controller' => 'sites', 'action' => 'deleteslider'));
	Router::connect('/updatecounts/*', array('controller' => 'sites', 'action' => 'updatecounts'));
	Router::connect('/admin/manage/widgets/*', array('controller' => 'sites', 'action' => 'managewidgets'));
	Router::connect('/changecurrency/*', array('controller' => 'sites', 'action' => 'changecurrency'));
	Router::connect('/downimage/*', array('controller' => 'sites', 'action' => 'downimage'));
	Router::connect('/sendpushnot/*', array('controller' => 'sites', 'action' => 'sendpushnot'));
	Router::connect('/sitemaintenance/*', array('controller' => 'sites', 'action' => 'sitemaintenance'));
	
	/* Banners controller */
	Router::connect('/admin/view/banner', array('controller' => 'banners', 'action' => 'view_banner'));
	Router::connect('/admin/add/banner', array('controller' => 'banners', 'action' => 'add_banner'));
	Router::connect('/admin/edit/banner/*', array('controller' => 'banners', 'action' => 'edit_banner'));
	Router::connect('/bannerdeletes/*', array('controller' => 'banners', 'action' => 'bannerdeletes'));
	Router::connect('/admin/google/code/*', array('controller' => 'banners', 'action' => 'googleanlay'));
	
	
	/* News controller */
	Router::connect('/admin/view/news', array('controller' => 'managenews', 'action' => 'view_news'));
	Router::connect('/admin/add/news', array('controller' => 'managenews', 'action' => 'add_news'));
	Router::connect('/admin/edit/news/*', array('controller' => 'managenews', 'action' => 'edit_news'));
	Router::connect('/newsdeletes/*', array('controller' => 'managenews', 'action' => 'newsdeletes'));
	Router::connect('/getpushajax/*', array('controller' => 'managenews', 'action' => 'getpushajax'));
	
	/* Items controller */
	Router::connect('/admin/manage/items/*', array('controller' => 'items', 'action' => 'manage_items'));
	Router::connect('/admin/manage/affiliate/*', array('controller' => 'items', 'action' => 'manage_affiliate'));
	Router::connect('/mobile/admin/manage/items/*', array('controller' => 'mobileitems', 'action' => 'manage_items'));
	Router::connect('/admin/itemconversation/*', array('controller' => 'items', 'action' => 'itemconversation'));
	Router::connect('/admin/itemuserconversation/*', array('controller' => 'items', 'action' => 'itemuserconversation'));
	Router::connect('/admin/manage/contactsellersubject/*', array('controller' => 'items', 'action' => 'contactsellersubject'));
	Router::connect('/admin/contacteditem/*', array('controller' => 'items', 'action' => 'contacteditem'));
	Router::connect('/admin/deletecsconversation/*', array('controller' => 'items', 'action' => 'deletecsconversation'));
	Router::connect('/admin/deletecssubject/*', array('controller' => 'items', 'action' => 'deletecssubject'));
	Router::connect('/admin/addcssubject/*', array('controller' => 'items', 'action' => 'addcssubject'));
	
	Router::connect('/create/item/*', array('controller' => 'items', 'action' => 'create_item'));
	Router::connect('/mobile/create/item/*', array('controller' => 'mobileitems', 'action' => 'create_item'));
	Router::connect('/saveitems/*', array('controller' => 'items', 'action' => 'saveitems'));
	Router::connect('/mobile/saveitems/*', array('controller' => 'mobileitems', 'action' => 'saveitems'));
	Router::connect('/listing/*', array('controller' => 'items', 'action' => 'listings'));
	Router::connect('/mobile/listing/*', array('controller' => 'mobileitems', 'action' => 'listings'));
	Router::connect('/tags/*', array('controller' => 'items', 'action' => 'tags_mtrls'));
	Router::connect('/featureditem',array('controller'=>'items','action'=>'featureditem'));
	Router::connect('/viewitemdesc/*',array('controller'=>'items','action'=>'viewitemdesc'));
	Router::connect('/mobile/viewitemdesc/*',array('controller'=>'mobileitems','action'=>'viewitemdesc'));
	Router::connect('/create/giftcard/*',array('controller'=>'items','action'=>'create_giftcard'));
	Router::connect('/mobile/create/giftcard/*',array('controller'=>'mobileitems','action'=>'create_giftcard'));
	Router::connect('/getsizeqty/*', array('controller' => 'items', 'action' => 'getsizeqty'));
	Router::connect('/mobile/getsizeqty/*', array('controller' => 'mobileitems', 'action' => 'getsizeqty'));
	Router::connect('/adminitemview/*', array('controller' => 'items', 'action' => 'adminitemview'));
	Router::connect('/viewmore/*', array('controller' => 'items', 'action' => 'customviewmore'));
	Router::connect('/getviewmore/*', array('controller' => 'items', 'action' => 'getviewmore'));
	Router::connect('/editselleritem/*', array('controller' => 'items', 'action' => 'editselleritem'));
	Router::connect('/reportitem/*',array('controller'=>'items', 'action' => 'reportitem'));
	Router::connect('/mobile/reportitem/*',array('controller'=>'mobileitems', 'action' => 'reportitem'));
	Router::connect('/undoreportitem/*',array('controller'=>'items', 'action' => 'undoreportitem'));
	Router::connect('/mobile/undoreportitem/*',array('controller'=>'mobileitems', 'action' => 'undoreportitem'));
	Router::connect('/sendmessage/*',array('controller'=>'items', 'action' => 'sendmessage'));
	Router::connect('/viewmessage/*',array('controller'=>'items', 'action' => 'viewmessage'));
	Router::connect('/replymessage/*',array('controller'=>'items', 'action' => 'replymessage'));
	Router::connect('/getmoreviewmessage/*',array('controller'=>'items', 'action' => 'getmoreviewmessage'));
	Router::connect('/getmoremessage/*',array('controller'=>'items', 'action' => 'getmoremessage'));
	Router::connect('/searchmessage/*',array('controller'=>'items', 'action' => 'searchmsg'));
	Router::connect('/messages/*',array('controller'=>'items', 'action' => 'messages'));
	Router::connect('/ajaxHashAuto/*',array('controller'=>'items', 'action' => 'ajaxHashAuto'));
	Router::connect('/hashtag/*',array('controller'=>'items', 'action' => 'hashtag'));
	Router::connect('/getmorehashtag/*',array('controller'=>'items', 'action' => 'getmorehashtag'));
	Router::connect('/poststatus/*',array('controller'=>'items', 'action' => 'poststatus'));
	Router::connect('/getmorefeeds/*',array('controller'=>'items', 'action' => 'getmorefeeds'));
	Router::connect('/deletestatus/*',array('controller'=>'items', 'action' => 'deletestatus'));
	
	/* Shops controller */
	Router::connect('/your/shops/*', array('controller' => 'shops', 'action' => 'create_shop'));
	//Router::connect('/shop/*', array('controller' => 'shops', 'action' => 'viewshops'));
	Router::connect('/your-shop-details/*', array('controller' => 'shops', 'action' => 'create_shop_details'));
	Router::connect('/policies/*', array('controller' => 'shops', 'action' => 'policies'));
	
	/* ajax calls */
	Router::connect('/suprsubcategry/*', array('controller' => 'categories', 'action' => 'suprsubcategry'));
	Router::connect('/suprcountry/*', array('controller' => 'users', 'action' => 'suprcountry'));
	Router::connect('/shpng_country/*', array('controller' => 'users', 'action' => 'shpng_country'));
	Router::connect('/country_phonecode/*', array('controller' => 'users', 'action' => 'country_phonecode'));
	Router::connect('/mobile/suprsubcategry/*', array('controller' => 'mobilecategories', 'action' => 'suprsubcategry'));
	Router::connect('/addfavitems/*', array('controller' => 'items', 'action' => 'addfavitems'));
	Router::connect('/addfavshops/*', array('controller' => 'items', 'action' => 'addfavshops'));
	
	Router::connect('/addflw_usrs/*', array('controller' => 'users', 'action' => 'addflw_usrs'));
	
	Router::connect('/additemusingurl/*', array('controller' => 'users', 'action' => 'additemusingurl'));
	Router::connect('/additemsave/*', array('controller' => 'users', 'action' => 'additemsave'));
	
	
	Router::connect('/cart/*', array('controller' => 'paypals', 'action' => 'pay'));
	Router::connect('/mobile/cart/*', array('controller' => 'mobilepaypals', 'action' => 'pay'));
	Router::connect('/checkout/*', array('controller' => 'paypals', 'action' => 'checkout'));
	Router::connect('/mobile/checkout/*', array('controller' => 'mobilepaypals', 'action' => 'checkout'));
	Router::connect('/gfcrdcheckout/*', array('controller' => 'paypals', 'action' => 'gfcrdcheckout'));
	Router::connect('/mobile/gfcrdcheckout/*', array('controller' => 'mobilepaypals', 'action' => 'gfcrdcheckout'));
	Router::connect('/pays/*', array('controller' => 'paypals', 'action' => 'paycart'));
	Router::connect('/mobile/pays/*', array('controller' => 'mobilepaypals', 'action' => 'paycart'));
	Router::connect('/merupdate/*', array('controller' => 'paypals', 'action' => 'merupdate'));
	Router::connect('/custupdate/*', array('controller' => 'paypals', 'action' => 'custupdate'));
	Router::connect('/custupdatend/*', array('controller' => 'paypals', 'action' => 'custupdatend'));
	Router::connect('/cartmousehover/*', array('controller' => 'paypals', 'action' => 'cartmousehover'));
	Router::connect('/deletecartshipping/*', array('controller' => 'paypals', 'action' => 'deleteshippingadd'));
	
        
	Router::connect('/mobile/collections/*',array('controller'=>'mobiles','action'=>'collections'));
	Router::connect('/mobile/getmorecollections/*',array('controller'=>'mobiles','action'=>'getmorecollections'));        
        
	Router::connect('/paypal/payments/*', array('controller' => 'paypals', 'action' => 'payments'));
	Router::connect('/mobile/paypal/payments/*', array('controller' => 'mobilepaypals', 'action' => 'payments'));
	Router::connect('/payment-successful/*', array('controller' => 'paypals', 'action' => 'payment_success'));
	Router::connect('/mobile/payment-successful/*', array('controller' => 'mobilepaypals', 'action' => 'payment_success'));
	Router::connect('/payment-cancelled/*', array('controller' => 'paypals', 'action' => 'payment_cancel'));
	Router::connect('/mobile/payment-cancelled/*', array('controller' => 'mobilepaypals', 'action' => 'payment_cancel'));
	Router::connect('/paypal/ipnprocess/*', array('controller' => 'paypals', 'action' => 'ipnprocess'));
	Router::connect('/mobile/paypal/ipnprocess/*', array('controller' => 'mobilepaypals', 'action' => 'ipnprocess'));
	Router::connect('/paypal/adaptiveipnprocess/*', array('controller' => 'paypals', 'action' => 'adaptiveipnprocess'));
	Router::connect('/mobile/paypal/adaptiveipnprocess/*', array('controller' => 'mobilepaypals', 'action' => 'adaptiveipnprocess'));
	Router::connect('/adaptiveresponce/*', array('controller' => 'paypals', 'action' => 'adaptiveresponce'));
	Router::connect('/checkcouponcode/*',array('controller'=>'paypals','action'=>'checkcouponcode'));
	Router::connect('/mobile/checkcouponcode/*',array('controller'=>'mobilepaypals','action'=>'checkcouponcode'));
	Router::connect('/entercouponvalue/*',array('controller'=>'paypals','action'=>'entercouponvalue'));
	Router::connect('/mobile/entercouponvalue/*',array('controller'=>'mobilepaypals','action'=>'entercouponvalue'));
	Router::connect('/checkoutgiftcard/*',array('controller'=>'paypals','action'=>'checkoutgiftcard'));
	Router::connect('/mobile/checkoutgiftcard/*',array('controller'=>'mobilepaypals','action'=>'checkoutgiftcard'));
	Router::connect('/paypal/giftcardipnIpn/*',array('controller'=>'paypals','action'=>'giftcardipnIpn'));
	Router::connect('/mobile/paypal/giftcardipnIpn/*',array('controller'=>'mobilepaypals','action'=>'giftcardipnIpn'));
	
	Router::connect('/checkgiftcardcode/*',array('controller'=>'paypals','action'=>'checkgiftcardcode'));
	Router::connect('/mobile/checkgiftcardcode/*',array('controller'=>'mobilepaypals','action'=>'checkgiftcardcode'));
	Router::connect('/entergfcardvalue/*',array('controller'=>'paypals','action'=>'entergfcardvalue'));
	Router::connect('/mobile/entergfcardvalue/*',array('controller'=>'mobilepaypals','action'=>'entergfcardvalue'));
	
	/* Paypal IPN plugin */
	Router::connect('/paypal_ipn/process', array('plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'process'));
	/* Optional Route, but nice for administration */
	Router::connect('/paypal_ipn/*', array('admin' => 'true', 'plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'index'));
	/* End Paypal IPN plugin */
	
	/* Home page more ways to shop links */
	Router::connect('/categories/search/*', array('controller' => 'categories', 'action' => 'show_categories'));
	//Router::connect('/color/*', array('controller' => 'categories', 'action' => 'show_color'));

	/****Help links *****/
	Router::connect('/help',array('controller'=>'fantasyhelps', 'action' => 'faq'));
	Router::connect('/help/faq',array('controller'=>'fantasyhelps', 'action' => 'faq'));
	Router::connect('/help/contact',array('controller'=>'fantasyhelps', 'action' => 'contact'));
	Router::connect('/help/copyright_policy',array('controller'=>'fantasyhelps', 'action' => 'copyrights'));
	Router::connect('/help/terms_of_sale',array('controller'=>'fantasyhelps', 'action' => 'termsofsale'));
	Router::connect('/help/terms_service',array('controller'=>'fantasyhelps', 'action' => 'termsofservice'));
	Router::connect('/help/terms_merchant',array('controller'=>'fantasyhelps', 'action' => 'termsofmerchant'));
	Router::connect('/help/privacy',array('controller'=>'fantasyhelps', 'action' => 'privacy'));
	Router::connect('/addto/*',array('controller'=>'fantasyhelps', 'action' => 'addto'));
	Router::connect('/mobileapps/*',array('controller'=>'fantasyhelps', 'action' => 'mobile'));
    Router::connect('/mobile/mobileapps/*',array('controller'=>'mobilefantasyhelps', 'action' => 'mobileapps'));
	
	/*API Handling urls*/
	Router::connect('/api/login',array('controller'=>'api', 'action' => 'login'));
	Router::connect('/api/signup',array('controller'=>'api', 'action' => 'signup'));
	Router::connect('/api/home',array('controller'=>'api', 'action' => 'home'));
	Router::connect('/api/comments/*',array('controller'=>'api', 'action' => 'item_comments'));
	Router::connect('/api/item_like/*',array('controller'=>'api', 'action' => 'item_like'));
	Router::connect('/api/item_favorited/*',array('controller'=>'api', 'action' => 'item_favorited'));
	Router::connect('/api/changepassword',array('controller'=>'api', 'action' => 'changePassword'));
	Router::connect('/api/userdetails',array('controller'=>'api', 'action' => 'userDetails'));
	Router::connect('/api/followers',array('controller'=>'api', 'action' => 'followersList'));
	Router::connect('/api/following',array('controller'=>'api', 'action' => 'followingList'));
	Router::connect('/api/followingid',array('controller'=>'api', 'action' => 'followingidList'));
	Router::connect('/api/loginwithsocial',array('controller'=>'api', 'action' => 'loginWithSocial'));
	Router::connect('/api/getsettings',array('controller'=>'api', 'action' => 'getSettings'));
	Router::connect('/api/searchitem',array('controller'=>'api', 'action' => 'searchItem'));
	Router::connect('/api/shop',array('controller'=>'api', 'action' => 'shop'));
	Router::connect('/api/shopfilter',array('controller'=>'api', 'action' => 'shopsearch'));
	Router::connect('/api/setsettings',array('controller'=>'api', 'action' => 'setSettings'));
	Router::connect('/api/collections',array('controller'=>'api', 'action' => 'userCollections'));
	Router::connect('/api/myorders',array('controller'=>'api', 'action' => 'myOrders'));
	Router::connect('/api/mysales',array('controller'=>'api', 'action' => 'mysales'));
	Router::connect('/api/changeorderstatus',array('controller'=>'api', 'action' => 'orderstatus'));
	Router::connect('/api/gettrackdetails',array('controller'=>'api', 'action' => 'gettrackdetails'));
	Router::connect('/api/cart',array('controller'=>'api', 'action' => 'myCart'));
	Router::connect('/api/getlist',array('controller'=>'api', 'action' => 'itemList'));
	Router::connect('/api/additemtolist',array('controller'=>'api', 'action' => 'addItemToList'));
	Router::connect('/api/additemtolisthome',array('controller'=>'api', 'action' => 'addItemToListHome'));
	Router::connect('/api/addtocart',array('controller'=>'api', 'action' => 'addToCart'));
	Router::connect('/api/changecartquantity',array('controller'=>'api', 'action' => 'changeCartQuantity'));
	Router::connect('/api/getcartdetails',array('controller'=>'api', 'action' => 'getCartDetails'));
	Router::connect('/api/removecartitem',array('controller'=>'api', 'action' => 'removeCartItem'));
	Router::connect('/api/getpaymentdetails',array('controller'=>'api', 'action' => 'cartCommissionPross'));
	Router::connect('/api/slideshow',array('controller'=>'api', 'action' => 'slideshow'));
	Router::connect('/api/mobileipnprocess',array('controller'=>'api', 'action' => 'mobileIpnProcess'));
	Router::connect('/api/getprofilelist',array('controller'=>'api', 'action' => 'getListItems'));
	Router::connect('/api/getprofilelistdetails',array('controller'=>'api', 'action' => 'getlistitemdetails'));
	Router::connect('/api/findfriends/*',array('controller'=>'api', 'action' => 'findfriends'));
	Router::connect('/api/followuser',array('controller'=>'api', 'action' => 'followUser'));
	Router::connect('/api/unfollowuser',array('controller'=>'api', 'action' => 'unfollowUser'));
	Router::connect('/api/addshipping',array('controller'=>'api', 'action' => 'addShippingAdddress'));
	Router::connect('/api/getshipping',array('controller'=>'api', 'action' => 'getShippingAddress'));
	Router::connect('/api/nearme/*',array('controller'=>'api', 'action' => 'nearme'));
	Router::connect('/api/pushnotifications/*',array('controller'=>'api', 'action' => 'pushnotifications'));
	Router::connect('/api/moreinfos/*',array('controller'=>'api', 'action' => 'moreinfos'));
	Router::connect('/api/addproduct/*',array('controller'=>'api', 'action' => 'addproduct'));
	Router::connect('/api/productbeforeadd/*',array('controller'=>'api', 'action' => 'productbeforeadd'));
	Router::connect('/api/addfashionuser/*',array('controller'=>'api', 'action' => 'addfashionuser'));
	Router::connect('/api/findplaces/*',array('controller'=>'api', 'action' => 'findplaces'));
	Router::connect('/api/shop_comments/*',array('controller'=>'api', 'action' => 'shop_comments'));
	Router::connect('/api/nearmeshop/*',array('controller'=>'api', 'action' => 'nearmeshop'));
	Router::connect('/api/mostpopularitem/*',array('controller'=>'api', 'action' => 'mostpopularitem'));
	Router::connect('/api/addshopphotos/*',array('controller'=>'api', 'action' => 'addshopphotos'));
	Router::connect('/api/userrseller/*',array('controller'=>'api', 'action' => 'userrseller'));
	Router::connect('/api/userimagechange/*',array('controller'=>'api', 'action' => 'userimagechange'));
	Router::connect('/api/morecategoryitems/*',array('controller'=>'api', 'action' => 'morecategoryitems'));
	Router::connect('/api/badgereset/*',array('controller'=>'api', 'action' => 'badgereset'));
	Router::connect('/api/pushsignout/*',array('controller'=>'api', 'action' => 'pushsignout'));
	Router::connect('/api/reportitem/*',array('controller'=>'api', 'action' => 'reportitem'));
	Router::connect('/api/undoreportitem/*',array('controller'=>'api', 'action' => 'undoreportitem'));
	Router::connect('/api/adddeviceid/*',array('controller'=>'api', 'action' => 'adddeviceid'));
	Router::connect('/api/getlanguage/*',array('controller'=>'api', 'action' => 'getlanguage'));
	Router::connect('/api/gethashtag/*',array('controller'=>'api', 'action' => 'gethashtag'));
	Router::connect('/api/getatuser/*',array('controller'=>'api', 'action' => 'getatuser'));
	Router::connect('/api/hashtag/*',array('controller'=>'api', 'action' => 'hashtag'));
	
	
	
	
	Router::connect('/tes/*', array('controller' => 'pages', 'action' => 'testing'));
	
	
	/******* Dispute Management ********/
	
	Router::connect('/disputemain/*', array('controller' => 'users', 'action' => 'dispute'));
	Router::connect('/userdispute/*', array('controller' => 'users', 'action' => 'dispute')); /* finish */
	Router::connect('/dispute/*', array('controller' => 'users', 'action' => 'disputepro'));
	Router::connect('/dis/*', array('controller' => 'users', 'action' => 'purdisp'));
	Router::connect('/disputemessage/*', array('controller' => 'users', 'action' => 'disputemessage'));
	Router::connect('/disputeBuyer/*', array('controller' => 'users', 'action' => 'disputesellermsg'));
	Router::connect('/dispute_status/*', array('controller' => 'users', 'action' => 'dispute_status'));
	Router::connect('/getbuyercmnt/*', array('controller' => 'users', 'action' => 'getbuyercmnt'));
	Router::connect('/getmorecommentbuyer/*', array('controller' => 'users', 'action' => 'getmorecommentbuyer'));
	Router::connect('/getsellercmnt/*', array('controller' => 'users', 'action' => 'getsellercmnt'));
	Router::connect('/getmorecommentseller/*', array('controller' => 'users', 'action' => 'getmorecommentseller'));
	Router::connect('/getadmin/*', array('controller' => 'admins', 'action' => 'getadmin'));
	Router::connect('/getmorecommentadmin/*', array('controller' => 'admins', 'action' => 'getmorecommentadmin'));
	Router::connect('/getrecentdispallbuyer/*', array('controller' => 'users', 'action' => 'getrecentdispallbuyer'));
	Router::connect('/getmorecommentview/*', array('controller' => 'users', 'action' => 'getmorecommentview'));
	Router::connect('/getrecentdispallseller/*', array('controller' => 'users', 'action' => 'getrecentdispallseller'));
	Router::connect('/getmorecommentviewseller/*', array('controller' => 'users', 'action' => 'getmorecommentviewseller'));
	Router::connect('/getrecentpurchasebuyer/*', array('controller' => 'users', 'action' => 'getrecentpurchasebuyer'));
	Router::connect('/getmorecommentviewpurchase/*', array('controller' => 'users', 'action' => 'getmorecommentviewpurchase'));
	Router::connect('/getoldorderseller/*', array('controller' => 'users', 'action' => 'getoldorderseller'));
	Router::connect('/getmoreoldorderseller/*', array('controller' => 'users', 'action' => 'getmoreoldorderseller'));
	Router::connect('/getrecentorder/*', array('controller' => 'users', 'action' => 'getrecentorder'));
	Router::connect('/getmorerecentorder/*', array('controller' => 'users', 'action' => 'getmorerecentorder'));
	Router::connect('/disputeimage/*', array('controller' => 'users', 'action' => 'disputeimage'));

	/***** Admin Dispute Management *****/
	Router::connect('/admin/user/dispute/*', array('controller' => 'admins', 'action' => 'disp'));
	Router::connect('/admin/user/view_dispute/*', array('controller' => 'admins', 'action' => 'viewdisp'));
	Router::connect('/deletdispmsg/*', array('controller' => 'admins', 'action' => 'deletdispmsg'));
	Router::connect('/admin/manage/problemlist/*', array('controller' => 'admins', 'action' => 'manageproblem'));
	Router::connect('/admin/add/dispquestion/*', array('controller' => 'admins', 'action' => 'dispquestion'));
	Router::connect('/delete_disp_plm_admin/*', array('controller' => 'admins', 'action' => 'delete_disp_plm_admin'));
	Router::connect('/dispstatus/*', array('controller' => 'admins', 'action' => 'dispstatus'));



	/***** Group Gift  ******/
	
	
	Router::connect('/ggusersave/*',array('controller'=>'items', 'action' => 'ggusersave'));
	Router::connect('/ggdelete/*',array('controller'=>'items', 'action' => 'ggdelete'));
	Router::connect('/groupgiftreason/*',array('controller'=>'items', 'action' => 'groupgiftreason'));
	Router::connect('/groupgifts/*',array('controller'=>'items', 'action' => 'groupgifts'));
	Router::connect('/group-gift-lists/*',array('controller'=>'items', 'action' => 'gglists'));
	Router::connect('/gifts/*',array('controller'=>'items', 'action' => 'gifts'));
	Router::connect('/ggcheckout/*',array('controller'=>'paypals', 'action' => 'ggcheckout'));
	Router::connect('/mobile/ggcheckout/*',array('controller'=>'mobilepaypals', 'action' => 'ggcheckout'));
	Router::connect('/paypal/ggipn/*', array('controller' => 'paypals', 'action' => 'ggipn'));
	Router::connect('/mobile/paypal/ggipn/*', array('controller' => 'mobilepaypals', 'action' => 'ggipn'));
	Router::connect('/getUsersocialList/*', array('controller' => 'users', 'action' => 'getUsersocialList'));
	Router::connect('/ggcronjob/*',array('controller'=>'items','action'=>'ggcronjob'));
	
	
	


	
	/****** Seller Rating *******/
	Router::connect('/rating',array('controller'=>'users', 'action' => 'rating'));
	Router::connect('/view_review',array('controller'=>'users', 'action' => 'view_review'));
	
        
	/********** Mobile fantacy comment page *************/
	Router::connect('/mobile/comments/*',array('controller'=>'mobiles', 'action' => 'comments'));
	Router::connect('/mobile/editcommentsave/*',array('controller'=>'mobileitems','action'=>'editcommentsave'));        
	
	/***** MULTILINGUAL  ******/
	
	Router::connect('/:language/:controller/:action/*',array(),array('language' => '[a-z]{3}'));
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
