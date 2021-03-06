<body class=""> 
  <!--<![endif]-->
       <?php echo $this->element('adminheader'); ?>
    


    <div class="sidebar-nav">
         <a href="#dashboard-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard<i class="icon-chevron-up"></i></a>
        <ul id="dashboard-menu" class="nav nav-list collapse ">
            <li><a href="<?php echo SITE_URL.'admin/'; ?>">Home</a></li>
            
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
        	<li><a href="<?php echo SITE_URL.'couponlog'; ?>">Logs Coupon </a></li>
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
        <ul id="banner-menu" class="nav nav-list collapse ">
	        <li><a href="<?php echo SITE_URL.'admin/add/banner'; ?>">Add Banner</a></li>
            <li><a href="<?php echo SITE_URL.'admin/view/banner'; ?>">Manage Banner</a></li>
        </ul>
		
		<a href="#news-menu" class="nav-header " data-toggle="collapse"><i class="icon-tint"></i>News Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="news-menu" class="nav nav-list collapse in">
            <li><a href="<?php echo SITE_URL.'admin/add/news'; ?>">Add News</a></li>
            <li class="active" ><a href="<?php echo SITE_URL.'admin/view/news'; ?>">manage News</a></li>
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

    </div>
   

<div class="content">
<div class="header">
     <h1 class="page-title">News</h1>
</div>
<ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo SITE_URL.'admin/view/news'; ?>">News</a> <span class="divider">/</span></li>
    <li class="active">Edit News</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
  
<div class="well">
   
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
   			
 

<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('News',array('url'=>array('controller'=>'/','action'=>'/admin/edit/news/'.$id),'id'=>'newsform'));
			
			echo "<div id='forms'>";
				echo $this->Form->input('title',array('type'=>'text','label'=>'News Title','id'=>'title','class'=>'inputform','value'=>$news_data['News']['title']));
				echo $this->Form->input('id',array('type'=>'hidden','value'=>$news_data['News']['id']));
				
				//echo "<span>Maximum 100 words allowed for summary</span>";
				//echo $this->Form->input('summary',array('type'=>'textarea','label'=>'News Summary','id'=>'summary','class'=>'textareas','value'=>$news_data['News']['summary'],'maxlength'=>'100'));
				
				//echo $this->Form->input('content',array('type'=>'textarea','label'=>'News Description','id'=>'description','class'=>'textareas','value'=>$news_data['News']['content']));
				
				echo "<span>Maximum 100 words allowed for summary</span>";
				echo '<br/>';
				echo 'News Summary:';echo '<br/>';
				echo '<textarea rows="2" cols="20" name="data[News][summary]" id="summary" class = "textareas" maxlength="100">'.$news_data['News']['summary'].'</textarea>';
				echo '<br/>';
				echo 'News Description:';echo '<br/>';
				echo '<textarea rows="2" cols="20" name="data[News][content]" id="description" class = "textareas">'.$news_data['News']['content'].'</textarea>';
				
				
				
				echo $this->Form->input('status',array('type'=>'radio','options'=>array('publish'=>'Publish','unpublish'=>'Unpublish'),'label'=>'Status','id'=>'status','class'=>'inputform status','default'=>$news_data['News']['status']));
					
			echo "</div>";
			echo "<div id='alert' class='error'></div>";
			
			echo $this->Form->submit('Submit',array('class'=>'btn btn-success reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>
</div>
      
  </div>

</div>
<footer>
    <hr>
	<p class="pull-right">A <a href="#" target="_blank">Markit Social eCommerce</a> by <a href="http://simplit.co" target="_blank">Simpl!t Co.</a></p>
	&copy; <?PHP echo date("Y").' <a href="#" target="_blank">'.$setngs[0]['Sitesetting']['site_name'].'</a>';?>
</footer>
