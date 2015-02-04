   <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
  <body class=""> 
  <!--<![endif]-->
    
  
  <?php echo $this->element('adminheader'); ?>
    


    <div class="sidebar-nav">
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard<i class="icon-chevron-up"></i></a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li class="active" ><a href="<?php echo SITE_URL.'admin/'; ?>">Home</a></li>
            
        </ul>

       <a href="#accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-user-md"></i>User Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li><a href="<?php echo SITE_URL.'addmember/'; ?>">Add User</a></li>
            <li><a href="<?php echo SITE_URL.'admin/user/management/'; ?>">Manage user</a></li>
        </ul>
        
        
		
		
		<a href="#payment-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-money"></i>Payments<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="payment-menu" class="nav nav-list collapse">
        	<li><a href="<?php echo SITE_URL.'admin/pgsetup/'; ?>">Payment Gateway</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/merchant_payment/'; ?>">Orders</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/viewcommission/'; ?>">Commission Setup</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/payments/'; ?>">Invoices</a></li>
        </ul>
        
        <a href="#coupons-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-key"></i>Coupons<i class="icon-chevron-up"></i></a>
        <ul id="coupons-menu" class="nav nav-list collapse">
        	<li><a href="<?php echo SITE_URL.'admin/addcoupon/'; ?>">Add coupon</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/managecoupon/'; ?>">Manage coupon</a></li>
        	  <li ><a href="<?php echo SITE_URL.'couponlog'; ?>">Logs Coupon </a></li>
        </ul>
           
        <a href="#giftcard-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-gift"></i>Giftcard<i class="icon-chevron-up"></i></a>
        <ul id="giftcard-menu" class="nav nav-list collapse">
        	<li><a href="<?php echo SITE_URL.'giftcard/'; ?>">Add Gift Card</a></li>
       		<li><a href="<?php echo SITE_URL.'giftcardlog/'; ?>">Logs</a></li>
        </ul>
           
        <a href="#storep-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-briefcase"></i>Store Preferences<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="storep-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/view/category'; ?>">Manage Category</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/items'; ?>">Manage Items</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/affiliate'; ?>">Manage Affiliate</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/price'; ?>">Manage Prices</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/colors'; ?>">Manage Colors</a></li>
	    	<li ><a href="<?php echo SITE_URL.'admin/manage/currency'; ?>">Manage Currency</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/manage/sellers'; ?>">Manage Sellers</a></li>
        </ul>  

		<a href="#dispute-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-group"></i>Dispute Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="dispute-menu" class="nav nav-list collapse">
	    <li ><a href="<?php echo SITE_URL.'admin/manage/problemlist'; ?>">User Options</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/user/dispute'; ?>">Manage Dispute</a></li>
        </ul>         
        
        <a href="#sellerchat-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-comments"></i>Seller Chat Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sellerchat-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/contacteditem'; ?>">Manage Seller Chat</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/contactsellersubject'; ?>">Manage Subjects</a></li>
        </ul>  
        
        <a href="#sitemanage-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-globe"></i>Site Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sitemanage-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/site/setting'; ?>">Manage Sites</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/landingpage'; ?>">Manage Landing Page</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/widgets'; ?>">Manage Widgets</a></li>
	    <li ><a href="<?php echo SITE_URL.'admin/mobile/settings'; ?>">Mobile Apps Settings</a></li>
        </ul> 
        
        
        <a href="#sitesett-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-filter"></i>General Preferences<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sitesett-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/module/setting'; ?>">Manage Modules</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/google/code'; ?>">Google Analytics</a></li>
        </ul> 
        
          
        
        <a href="#banner-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-film"></i>Banner Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="banner-menu" class="nav nav-list collapse">
	        <li><a href="<?php echo SITE_URL.'admin/add/banner'; ?>">Add Banner</a></li>
            <li><a href="<?php echo SITE_URL.'admin/view/banner'; ?>">Manage Banner</a></li>
        </ul>
		
		<a href="#news-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-tint"></i>News Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="news-menu" class="nav nav-list collapse ">
            <li><a href="<?php echo SITE_URL.'admin/add/news'; ?>">Add News</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/view/news'; ?>">manage News</a></li>
        </ul>
		

        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error Pages <i class="icon-chevron-up"></i></a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'err404'; ?>">404 page</a></li>
        </ul>

        <a href="#legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-legal"></i>Help Page Management <i class="icon-chevron-up"></i></a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/faq'; ?>">Faq</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/contact'; ?>">Contact</a></li>
	    <li ><a href="<?php echo SITE_URL.'admin/terms_sale'; ?>">Terms of Sale</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/terms_service'; ?>">Terms of Service</a></li>
	    <li ><a href="<?php echo SITE_URL.'admin/privacy'; ?>">Privacy Policy</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/terms_merchant'; ?>">Terms and Conditions</a></li>
	   <li ><a href="<?php echo SITE_URL.'admin/copyright'; ?>">Copyright Policy</a></li>
        </ul>

      <!--  <a href="<?php echo SITE_URL.'help'; ?>" target="_blank" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
        <a href="<?php echo SITE_URL.'help'; ?>" target="_blank" class="nav-header" ><i class="icon-comment"></i>Faq</a>-->

    </div>
    
