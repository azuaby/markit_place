<body class=""> 
  <!--<![endif]-->
   

 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Banner</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li><a href="<?php echo SITE_URL.'admin/view/banner'; ?>">Banner</a> <span class="divider">/</span></li>
					    <li class="active">Add Banner</li>
					</ul>
				</div>
			</div>

	<!-----Banner------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Banner</h2>
						
					</div>
					<div class="box-content">

				
	

<?php
	echo "<div class='containerdiv'>";
		echo "<br clear='all' />";
		echo $this->Form->Create('Banner',array('url'=>array('controller'=>'/','action'=>'/admin/add/banner'),'id'=>'bannerform'));
			echo "<div id='alert' class='error'></div>";
				
				

				echo "<div id='forms1'>";
					echo '<b>Banner Place : Gift Card (Max-width:314px)</b>';
					echo '<table><tr><td>';
					if($giftName) {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name1','class'=>'inputform','name' => 'banner_name1','value'=>$giftName));
					}
					else {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name1','class'=>'inputform','name' => 'banner_name1'));
					}
					echo '</td><td rowspan="2"><img src="'.SITE_URL.'images/Type1.png"></td>';
					echo '</tr><tr><td>';
					echo 'Html Source:';echo '<br/>';
					if($giftSource){
					echo '<textarea rows="7" cols="10" name="data[html_source1]" value="">'.$giftSource.'</textarea>';
					}
					else {
					echo '<textarea rows="7" cols="10" name="data[html_source1]" ></textarea>';
					}
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type1" value="giftcard">';
					if($giftStatus == "Active") {
					echo '<legend>Status</legend>
					<label>
						<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status1]">
						Active
					</label>
					<label>
						<input type="radio"  value="Inactive" class="inputform status" id="statusInactive" name="data[status1]">
						De-active
					</label>';
					} else {
					echo '<legend>Status</legend>
					<label>
						<input type="radio"  value="Active" class="inputform status" id="statusActive" name="data[status1]">
						Active
					</label>
					<label>
						<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status1]">
						De-active
					</label>';
					}
				echo "</div>";
				echo '<br />';
					

	
				echo "<div id='forms2'>";
					echo '<b>Banner Place : Product page (Max-width:314px)</b>';
					echo '<table><tr><td>';
					if($productName) {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name2','class'=>'inputform','name' => 'banner_name2','value'=>$productName));
					}
					else {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name2','class'=>'inputform','name' => 'banner_name2'));
					}
					echo '</td><td rowspan="2"><img src="'.SITE_URL.'images/Type2.png"></td>';
					echo '</tr><tr><td>';					
					echo 'Html Source:';echo '<br/>';
					if($productSource){
					echo '<textarea rows="7" cols="10" name="data[html_source2]" value="">'.$productSource.'</textarea>';
					}
					else {
					echo '<textarea rows="7" cols="10" name="data[html_source2]"></textarea>';
					}
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type2" value="product">';
					if($productStatus == "Active") {
					echo '<legend>Status</legend>
					<label>
						<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status2]">
						Active
					</label>
					<label>
						<input type="radio"  value="Inactive" class="inputform status" id="statusInactive" name="data[status2]">
						De-active
					</label>';
					} else {
					echo '<legend>Status</legend>
					<label>
						<input type="radio"  value="Active" class="inputform status" id="statusActive" name="data[status2]">
						Active
					</label>
					<label>
						<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status2]">
						De-active
					</label>';
					}
				echo "</div>";
				echo '<br />';
			
				echo "<div id='forms3'>";
					echo '<b>Banner Place : Shop / Recommendations (Width:960px;Height:200px)</b>';
					echo '<table><tr><td>';
					if($shopName) {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name3','value'=>$shopName));
					}
					else {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name3'));
					}
					echo '</td><td rowspan="2"><img src="'.SITE_URL.'images/Type3456.png"></td>';
					echo '</tr><tr><td>';					
					echo 'Html Source:';echo '<br/>';
					
					if($shopSource){
					echo '<textarea rows="7" cols="10" name="data[html_source3]" value="">'.$shopSource.'</textarea>';
					}
					else {
					echo '<textarea rows="7" cols="10" name="data[html_source3]"></textarea>';
					}
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type3" value="shop">';
					if($shopStatus == "Active") {
					echo '<legend>Status</legend>
					<label>
						<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status3]">
						Active
					</label>
					<label>
						<input type="radio"  value="Inactive" class="inputform status" id="statusInactive" name="data[status3]">
						De-active
					</label>';
					} else {
					echo '<legend>Status</legend>
					<label>
						<input type="radio"  value="Active" class="inputform status" id="statusActive" name="data[status3]">
						Active
					</label>
					<label>
						<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status3]">
						De-active
					</label>';
					}
				echo "</div>";
				echo '<br />';
			
				echo "<div id='forms4'>";
					echo '<b>Banner Place : Find Friends (Width:960px;Height:200px)</b>';
					echo '<table><tr><td>';
					if($findName) {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name4','value'=>$findName));
					}
					else {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name4'));
					}
					echo '</td><td rowspan="2"><img src="'.SITE_URL.'images/Type3456.png"></td>';
					echo '</tr><tr><td>';					
					echo 'Html Source:';echo '<br/>';
					if($findSource) {
					echo '<textarea rows="7" cols="10" name="data[html_source4]" value="">'.$findSource.'</textarea>';
					}
					else {
					echo '<textarea rows="7" cols="10" name="data[html_source4]"></textarea>';
					}
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type4" value="findfriends">';
					if($findStatus == "Active") {
					echo '<legend>Status</legend>
					<label>
						<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status4]">
						Active
					</label>
					<label>
						<input type="radio"  value="Inactive" class="inputform status" id="statusInactive" name="data[status4]">
						De-active
					</label>';
					} else {
					echo '<legend>Status</legend>
					<label>
						<input type="radio"  value="Active" class="inputform status" id="statusActive" name="data[status4]">
						Active
					</label>
					<label>
						<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status4]">
						De-active
					</label>';
					}
				echo "</div>";
				echo '<br />';
			
				echo "<div id='forms5'>";
					echo '<b>Banner Place : Invite Friends (Width:960px;Height:200px)</b>';
					echo '<table><tr><td>';
					if($inviteName) {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name5','value'=>$inviteName));
					}
					else {
					echo $this->Form->input('banner_name',array('type'=>'text','label'=>'Banner Name','id'=>'banner_name','class'=>'inputform','name' => 'banner_name5'));
					}
					echo '</td><td rowspan="2"><img src="'.SITE_URL.'images/Type3456.png"></td>';
					echo '</tr><tr><td>';					
					echo 'Html Source:';echo '<br/>';
					if($inviteSource) {
					echo '<textarea rows="7" cols="10" name="data[html_source5]" value="">'.$inviteSource.'</textarea>';
					}
					else {
					echo '<textarea rows="7" cols="10" name="data[html_source5]"></textarea>';
					}
					echo '</td></tr></table>';
					echo '<br/>';
					echo '<input type="hidden" name="banner_type5" value="invitefriends">';
					
					if($inviteStatus == "Active") {
					echo '<legend>Status</legend>
					<label>
						<input type="radio" checked="checked" value="Active" class="inputform status" id="statusActive" name="data[status5]">
						Active
					</label>
					<label>
						<input type="radio"  value="Inactive" class="inputform status" id="statusInactive" name="data[status5]">
						De-active
					</label>';
					} else {
					echo '<legend>Status</legend>
					<label>
						<input type="radio"  value="Active" class="inputform status" id="statusActive" name="data[status5]">
						Active
					</label>
					<label>
						<input type="radio" checked="checked" value="Inactive" class="inputform status" id="statusInactive" name="data[status5]">
						De-active
					</label>';
					}
				echo "</div>";
			
				
			echo $this->Form->submit('Submit',array('class'=>'btn btn-primary reg_btn'));
		echo $this->Form->end();
	echo "</div>";
?>

		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Banner------->	

   			
   			

 </div>
      
  </div>

</div>

