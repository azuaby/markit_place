<script>
	$(document).ready(function(){
		//alert($.browser.msie);
		if ($.browser.msie) {
			$('.placeholder').each(function(){
			//$('input[placeholder]').each(function(){
			   
				var input = $(this);       
			   
				$(input).val(input.attr('placeholder'));
					   
				$(input).focus(function(){
					 if (input.val() == input.attr('placeholder')) {
						 input.val('');
					 }
				});
			   
				$(input).blur(function(){
					if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.val(input.attr('placeholder'));
					}
				});
			});
		}
    });
</script>
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
    
<div class="content">


			<div class="box span12">
				<div class="box-header">
					<h2>User</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
				<ul class="breadcrumb">
					<li><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					<li><a style="text-decoration:none;" data-ajax="false" href="<?php echo SITE_URL.'admin/user/management/'; ?>">Users</a> <span class="divider">/</span></li>
					<li class="active">User</li>
				</ul>
				</div>
			</div>

    

<div class="btn-toolbar">

</div>
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Profile</h2>
						
					</div>
					<div class="box-content">

				
   			<?php 
   			
   			echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/addmember'), 'id'=>'adduserform1','onsubmit'=>'return adduserform()'));
			
			echo "<div id='alert' style='color: #E8222F; font-size: 20px;'></div>";
			echo "<div class='input_wrap_popup'>";
				echo '<input type="text" value="" id="firstname" name="data[signup][firstname]" placeholder="Full Name" style="color:#555555! important;" />';	
			echo "</div>";
			
			
			/*echo "<div class='input_wrap_popup'>";
				echo '<input type="text" value="" id="lastname" name="data[signup][lastname]" placeholder="Last Name" style="color:#555555! important;" />';
			echo "</div>";	*/		
						
			
			echo "<div class='input_wrap_popup'>";
				echo '<input type="text" id="username" name="data[signup][username]" value="" placeholder="Username" class="placeholder" style="color:#555555! important;">';
			echo "</div>";
			
			echo "<div class='input_wrap_popup'>";
				echo '<input type="password" id="password" name="data[signup][password]"  placeholder="password" class="placeholder" style="color:#555555! important;">';
			echo "</div>";
			
			echo "<div class='input_wrap_popup confirm'>";
				echo '<input type="password" id="rpassword" name="data[signup][rpassword]"  placeholder="Confirm password" class="placeholder" style="color:#555555! important;">';
			echo "</div>";
						
			echo "<div class='input_wrap_popup'>";
				echo '<input type="text" id="email" name="data[signup][email]" value="" placeholder="E-mail" class="placeholder" style="color:#555555! important;">';
			echo "</div>";
			
			echo "<div class='input_wrap_popup'>";
				echo '<input type="hidden" id="menulist" name="data[signup][menulist]" value="">';
			echo "</div>";
						
			/*echo "<div class='input_wrap_popup'>";
				echo "<span class='labelclass' style='margin-bottom: 3px;margin-top: 0px;margin-left: 20px;width: 85px;'>Gender : </span>";							
				echo "<span style='font-weight: bold; font-size: 16px;'>";
					echo $this->Form->radio('gender',array( 'male'=>'Male', 'female'=>'Female'),array('fieldset'=>false,'label'=>false,'legend'=>false,'name'=>'data[signup][gender]','class'=>'genderradio'));
				echo "</span>";
			echo "</div>";
			echo "<br clear='all' />";
					*/
			
			echo "<div class='input_wrap_popup'>";		
			echo '<select id="usr_access" name="usr_access" onchange="showrestriction()">';
			echo '<option value="" >Select User Type</option>';
			echo '<option value="normal">User</option>';
			echo '<option value="god">Admin</option>';
			echo '<option value="moderate">Moderate</option>';
			echo '</select>';
			echo '<button type="button" class="btn btn-primary" id="restrict" value="restrict" style="display:none;vertical-align:top;" onclick="admin_menu_list()">Restriction</button>';
			echo "</div>";
			
			
			echo "<div class='input_wrap_popup'>";		
			echo '<select id="usr_access" name="usr_country">';
			echo '<option value="" >Choose Country</option>';
			foreach($countries as $countri){
				echo '<option value="'.$countri['Countries']['country'].'">'.$countri['Countries']['country'].'</option>';
			}
			echo '</select>';
			echo "</div>";
			
			//$this->Form->input('Leaf.id', array('type'=>'select', 'label'=>'Leaf', 'options'=>$leafs, 'default'=>'3'));
					
			
			//echo '<span class="termsline">By clicking Register, you confirm that you accept our <a href="'.SITE_URL.'terms" target="_blank">Terms of Use</a> and <a href="'.SITE_URL.'terms" target="_blank" style="color:#1BB3E2;">Privacy Policy.</a></span>';
			//echo "<br clear='all'/><br/>";
			echo "<div class='enter_sub_pop' style='float: left;'>";
				echo $this->Form->submit('Add Member',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
				
			echo "</div>";
			
		echo $this->Form->end();
		
		?>
   			
   			<br />
   	 </div>
      
  </div>

</div>



<div id="invoice-popup-overlay1">
	<div class="invoice-popup">
<!--button class="btn btn-danger inv-close1" id="btn_close" style="width: 90px; margin: 14px 6px 0px; font-size: 11px;float:right;">Back</button-->
<div id="userdata" class="invoice-datas" style="height:670px;">
<?php echo $this->element('menu_select'); ?>
</div>
	</div>



</div>
<!--script>
	$('#invoice-popup-overlay1, .inv-close1').live ('click',function(){
		$('#invoice-popup-overlay1').hide();
		$('#invoice-popup-overlay1').css("opacity", "0");
	});
</script-->

<style>
/**************Invoice Popup ************/


#invoice-popup-overlay1 {
	background: none repeat scroll 0 0 rgba(31, 33, 36, 0.898);
    display: none;
    height: 100%;
    left: 0;
    opacity: 0;
    overflow: scroll;
    padding: 0 24px 24px 0;
    position: fixed;
    top: 0;
    transition: opacity 0.2s ease 0s;
    width: 100%;
    z-index: 12;
}

#invoice-popup-overlay1 div.invoice-popup {
	width: 800px;
	margin: 92px auto;
}

#invoice-popup-overlay1 .invoice-popup div#userdata {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 25px 25px 100px;
}


</style>


