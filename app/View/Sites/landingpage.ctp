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
        
        <a href="#sitemanage-menu" class="nav-header " data-toggle="collapse"><i class="icon-globe"></i>Site Management<!--span class="label label-info">+3</span--><i class="icon-chevron-up"></i></a>
        <ul id="sitemanage-menu" class="nav nav-list collapse in">
            <li ><a href="<?php echo SITE_URL.'admin/site/setting'; ?>">Manage Sites</a></li>
            <li class="active" ><a href="<?php echo SITE_URL.'admin/manage/landingpage'; ?>">Manage Landing Page</a></li>
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
	
    </div>
   
   
   
   
   
   
 <div class="content">
 <div class="header">
     <h1 class="page-title">Manage Landing Page</h1>
  </div>
<ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Manage Landing Page</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">
  
<div class="well">
   
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

<?php
	echo "<div class='containerdiv'>";
		echo $this->Form->Create('Managelandingpage',array('url'=>array('controller'=>'/',
				'action'=>'/admin/manage/landingpage'),'onsubmit'=>'return validatelandingpage();'));
			
			echo "<div id='forms'>";
				if(empty($homepageModel['Homepagesettings']['layout'])){
					$layoutstatus = 'default';
				}else{
					$layoutstatus = $homepageModel['Homepagesettings']['layout'];
				}
				$displaydiv = "display:block;";
				if ($layoutstatus == 'default'){
					$displaydiv = "display:none;";
				}
				$options2['default'] = "Default";
				$options2['custom'] = "Custom";
				//echo $this->Form->input('display_banner',array('type'=>'radio','options'=>array('yes'=>'Yes','no'=>'No'),'label'=>'Display Banners','id'=>'display_banner','class'=>'inputform status','default'=>$status));
				echo $this->Form->input('Layout', array('options' => $options2,'default'=>$layoutstatus,
						'id'=>'layout','class'=>'inputform layout', 'onchange'=>
						'$(".customslider").slideToggle();$(".widgetsselector").slideToggle();'));
				
				$availwidgets = array('Recently Added','Most Popular', 'Most Commented', 'Top Stores',
						'Most Popular Categories', 'Featured Items');
				if (!empty($homepageModel['Homepagesettings']['widgets'])){
					$widgets = $homepageModel['Homepagesettings']['widgets'];
					$widgetarray = explode('(,)', $widgets);
				}else{
					$widgets = '';
					$widgetarray = array();
				}
				if (!empty($homepageModel['Homepagesettings']['properties'])){
					$sliderProperty = json_decode($homepageModel['Homepagesettings']['properties'],true);
				}
				echo $this->Form->input('widgets',array('type'=>'hidden','value'=>$widgets,'id'=>'widgets'));
				?>	
				<div class="customslider" style="<?php echo $displaydiv;?>">
					<?php 
					echo $this->Form->input('Slider Height',array('type'=>'text','value'=>$sliderProperty['sliderheight'],'placeholder'=>'Ex. 306px or auto','id'=>'sliderheight'));
					echo "<div class='sliderheighterror error'></div>";
					echo $this->Form->input('Slider Background Color',array('type'=>'text','value'=>$sliderProperty['sliderbg'],'placeholder'=>'Ex. #E6E6E6','id'=>'sliderbg'));
					echo "<div class='sliderbgerror error'></div>";
					
					if (!empty($homepageModel['Homepagesettings']['slider'])) {
						$sliders = json_decode($homepageModel['Homepagesettings']['slider'], true);
						$slidercount = count($sliders);
						echo '<P class="widgettophead">Manage Custom Slider</P>';
						echo $this->Form->input('sliders',array('type'=>'hidden','value'=>$slidercount,'id'=>'sliders'));
						echo "<table class='slidertable'>";
						echo "<thead>
								<tr>
									<th>#</th>
									<th>Slider Image</th>
									<th>Slider Link</th>
									<th>Actions</th>
								<tr>
								</thead><tbody>";
						foreach ($sliders as $skey => $slider){
							$curskey  = $skey+1;
							echo "<tr>";
							echo "<td>$curskey</td>";
							echo "<td><img src=".SITE_URL."images/slider/".$slider['image']." width='110'/></td>";
							echo "<td>".$slider['link']."</td>";
							echo "<td><a href='".SITE_URL."admin/addslider/".$curskey."'><i class='icon-pencil'></i></a>/
							<a href='".SITE_URL."admin/deleteslider/".$curskey."'><i class='icon-remove'></i></a></td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
					}else{
						echo "<div class='slideerror'>No Sliders Found</div>";
					}?>
					<a class="btn btn-success" href="<?php echo SITE_URL;?>admin/addslider" title="add slider">
						Add Slider
					</a>
				</div>
				<div class='slidererror error'></div>
				<div class="widgetsselector" style="<?php echo $displaydiv;?>">
				<P class="widgettophead">Choose Widgets (Drag and Drop)</P>
					<div class="availwidget">
						<p class="widgethead">Available Widgets</p>
						<ul id="sortable1" class="droptrue">
						<?php 
						if (!empty($widgetarray)){
						foreach($availwidgets as $avail){
							if (!in_array($avail, $widgetarray)){
						?>
						  <li class="ui-state-default"><?php echo $avail; ?></li>
						 <?php } } }else{
						 	foreach($availwidgets as $avail){
						 		?>
 								<li class="ui-state-default"><?php echo $avail; ?></li>
 						<?php } } ?>
						</ul>
					</div>
					<div class="availwidget">
						<p class="widgethead">Selected Widgets</p>
						<ul id="sortable3" class="droptrue">
						<?php if (!empty($widgetarray)){
						 foreach($widgetarray as $avail){
						?>
						  <li class="ui-state-default"><?php echo $avail; ?></li>
						 <?php } } ?>
						</ul>
					</div>
				</div>
				<div class='widgeterror error'></div></br>
				<div class="savebtn">
			<?php 	
			echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-success reg_btn'));
			echo "</div>";
		echo $this->Form->end();
	echo "</div>";
?>


   </div></div></div>
     <script src="<?php echo SITE_URL; ?>js/colpick.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>css/colpick.css" type="text/css"/>
<script type="text/javascript">
$('#sliderbg').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'light',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		//$(el).css('border-color','#'+hex);
		$('#sliderbg').val("#"+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val("#"+hex);
	}
}).keyup(function(){
	$(this).colpickSetColor(this.value);
});
</script>
<footer>
    <hr>
	<p class="pull-right">A <a href="#" target="_blank">Markit Social eCommerce</a> by <a href="http://simplit.co" target="_blank">Simpl!t Co.</a></p>
	&copy; <?PHP echo date("Y").' <a href="#" target="_blank">'.$setngs[0]['Sitesetting']['site_name'].'</a>';?>
</footer>
