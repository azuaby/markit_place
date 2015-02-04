<body class=""> 
  <!--<![endif]-->
       <?php echo $this->element('adminheader'); ?>
  <script>
  $(function() {
    $( "ul.droptrue" ).sortable({
      connectWith: "ul",
      placeholder: "ui-state-highlight",
      stop: function( event, ui ) {
			var selected = getdatafromli();
			console.log(selected);
			$('#widgets').val(selected);
          }
    });
 
    $( "#sortable1, #sortable3" ).disableSelection();
  });
  function getdatafromli(){
	  $.extend( $.fn, {
		    textnodes: function() {
		        return $(this).contents().filter(function(){
		            return this.nodeType === 3;
		        });
		    }
		});

		var nodes = $("#sortable3 li").textnodes();
		var data = '';
		for(var i=0; i<nodes.length;i++ ){
			if(data == ''){
				data += nodes[i]['data'];
			}else{
				data += "(,)"+nodes[i]['data'];
			}
		}
		console.log( nodes );
		return data;
  }
  </script>
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
            <li ><a href="<?php echo SITE_URL.'admin/manage/price'; ?>">Manage Prices</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/colors'; ?>">Manage Colors</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/currency'; ?>">Manage Currency</a></li>
        	<li><a href="<?php echo SITE_URL.'admin/manage/sellers'; ?>">Manage Sellers</a></li>
        </ul>           
        
        <a href="#sellerchat-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-comments"></i>Seller Chat Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sellerchat-menu" class="nav nav-list collapse">
            <li ><a href="<?php echo SITE_URL.'admin/contacteditem'; ?>">Manage Seller Chat</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/contactsellersubject'; ?>">Manage Subjects</a></li>
        </ul>  
        
        <a href="#sitemanage-menu" class="nav-header " data-toggle="collapse"><i class="icon-globe"></i>Site Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sitemanage-menu" class="nav nav-list collapse in">
            <li ><a href="<?php echo SITE_URL.'admin/site/setting'; ?>">Manage Sites</a></li>
            <li class="active" ><a href="<?php echo SITE_URL.'admin/manage/landingpage'; ?>">Manage Landing Page</a></li>
            <li ><a href="<?php echo SITE_URL.'admin/manage/widgets'; ?>">Manage Widgets</a></li>
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
    </div>
   
   
   
   
   
   
 <div class="content">
 <div class="header">
     <h1 class="page-title"><?php echo $pagetitle; ?></h1>
  </div>
<ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo SITE_URL; ?>admin/manage/landingpage">Manage Landing Page</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $pagetitle; ?></li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">
  
<div class="well">
   
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('addslider',array('url'=>array('controller'=>'/','action'=>'/admin/addslider'),'onsubmit'=>'return validateaddslider();'));
			
			echo "<div id='forms'>";
				$display="display:none";
				$imageurl = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
				if ($sliderImage != ''){
					$display="display:block";
					$imageurl = SITE_URL.'images/slider/'.$sliderImage;
				}
				echo "<div class='widgettophead'>Select Slider Image</div>";
				echo "<div class='img_upld' style='float: none; min-height: 150px;'>";
				echo "<img id='show_url_0'  style='width: 100px; border: 1px solid rgb(221, 221, 221); padding: 5px; border-radius: 3px 3px 3px 3px;' src='".$imageurl."'>";
				echo '<div class="venueimg"><iframe class="image_iframe" id="frame_0" name="frame0" src="'.$this->webroot.'sliderupload.php?image=0&media_url='.$media.'&site_url='.$site.'&username='.$username.'&password='.$password.'&hostname='.$hostname.'" frameborder="0" height="40px" width="120px" scrolling="no" HSPACE=0 VSPACE=0 style="float:left;left: 5px;position: relative;"></iframe>';
				echo $this->Form->input('item_image', array('type'=>'hidden','id'=>'image_computer_0', 'class'=> 'fullwidth','class'=>'celeb_name','value'=>$sliderImage,'name'=>'data[image][]'));
				echo "<a href='javascript:void(0);' id='removeimg_0' class='btn' style='".$display."; margin-top: 5px; float: left;' onclick='removeimg(0)'>Remove</a>";
				echo "</div>";
				echo "</div>";
				echo "<div class='sliderimageerror error'></div>";
				
				echo $this->Form->input('sliderurl',array('type'=>'text','value'=>$sliderLink,'id'=>'sliderLink'));
				$options[''] = 'Select slider effect';
				$options['sliceDown'] = 'sliceDown';
				$options['sliceDownLeft'] = 'sliceDownLeft';
				$options['sliceUp'] = 'sliceUp';
				$options['sliceUpLeft'] = 'sliceUpLeft';
				$options['sliceUpDown'] = 'sliceUpDown';
				$options['sliceUpDownLeft'] = 'sliceUpDownLeft';
				$options['fold'] = 'fold';
				$options['fade'] = 'fade';
				$options['random'] = 'random';
				$options['slideInRight'] = 'slideInRight';
				$options['slideInLeft'] = 'slideInLeft';
				$options['boxRandom'] = 'boxRandom';
				$options['boxRain'] = 'boxRain';
				$options['boxRainReverse'] = 'boxRainReverse';
				$options['boxRainGrow'] = 'boxRainGrow';
				$options['boxRainGrowReverse'] = 'boxRainGrowReverse';
				echo $this->Form->input('slidereffect', array('options' => $options,'default'=>$sliderEffect,'id'=>'slidereffect','class'=>'inputform slidereffect'));
				echo $this->Form->input('editid',array('type'=>'hidden','value'=>$editid,'id'=>'editid'));
					
				echo "<div class='addurlerror error'></div>";
				echo '<div class="savebtn">';
				echo $this->Form->submit($pagetitle,array('div'=>false,'class'=>'btn btn-success reg_btn'));
				echo "</div>";
				echo $this->Form->end();
			?>	
				<div class="customslider">
					<P class="widgettophead">Custom Sliders Already Active</P>
					<?php if (!empty($homepageModel['Homepagesettings']['slider'])) {
						$sliders = json_decode($homepageModel['Homepagesettings']['slider'], true);
						$slidercount = count($sliders);
						echo $this->Form->input('sliders',array('type'=>'hidden','value'=>$slidercount,'id'=>'widgets'));
						echo "<table class='slidertable'>";
						echo "<thead>
								<tr>
									<th>#</th>
									<th>Slider Image</th>
									<th>Slider Link</th>
								<tr>
								</thead><tbody>";
						foreach ($sliders as $skey => $slider){
							$curskey  = $skey+1;
							echo "<tr>";
							echo "<td>$curskey</td>";
							echo "<td><img src=".$_SESSION['media_url']."images/slider/".$slider['image']." width='110'/></td>";
							echo "<td>".$slider['link']."</td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
					}else{
						echo "<div class='slideerror'>No Sliders Found</div>";
					}?>
				</div>
			<?php 	
	echo "</div>";
?>


   </div></div></div>
     
<footer>
    <hr>
	<p class="pull-right">A <a href="#" target="_blank">Markit Social eCommerce</a> by <a href="http://simplit.co" target="_blank">Simpl!t Co.</a></p>
	&copy; <?PHP echo date("Y").' <a href="#" target="_blank">'.$setngs[0]['Sitesetting']['site_name'].'</a>';?>
</footer>
