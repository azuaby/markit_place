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
					<h2>Admin settings</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					<li><a href="<?php echo SITE_URL.'addadminsettings/'; ?>">Admin Change Settings</a></li>
					</ul>
				</div>
			</div>
    

                    
<div class="btn-toolbar">
    <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
    <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
  <div class="btn-group">
  </div>
</div>

 
 
						<!-----Admin settings------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Profile</h2>
						
					</div>
					<div class="box-content">

				
		<?php 
   			
   			echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/addadminsettings'), 'id'=>'adduserform1','onsubmit'=>'return chngeadmindet()'));
			
			echo "<div id='alert' style='color: #E8222F; font-size: 20px;'></div><br />";
			echo "<div class='input_wrap_popup'>";
				echo "<input type='text' style='color:#555555! important;'  id='firstname' name='data[signup][firstname]' placeholder='First Name' value='".$userDett['User']['first_name']."' />";	
			echo "</div>";
			
			
			echo "<div class='input_wrap_popup'>";
				echo '<input type="text" style="color:#555555! important;" id="lastname" name="data[signup][lastname]" placeholder="Last Name" value="'.$userDett['User']['last_name'].'"/>';
			echo "</div>";			
						
			
			/* echo "<div class='input_wrap_popup'>";
				echo '<input type="text" id="username" name="data[signup][username]" value="'.$userDett['User']['username'].'" placeholder="Username" class="placeholder">';
			echo "</div>"; */
			
			echo "<div class='input_wrap_popup'>";
				echo '<input type="password" id="password" name="data[signup][password]"  placeholder="password is 123456" class="placeholder" readonly >';
			echo "</div>";
			
			echo "<div class='input_wrap_popup confirm'>";
				echo '<input type="password" id="rpassword" name="data[signup][rpassword]"  placeholder="Confirm password is 123456" class="placeholder" readonly>';
			echo "</div>";
						
			echo "<div class='input_wrap_popup'>";
				echo '<input type="text" style="color:#555555! important;" id="email" name="data[signup][email]" placeholder="E-mail" class="placeholder" value="'.$userDett['User']['email'].'">';
			echo "</div>";
			
				
			
			echo "<div class='enter_sub_pop' style='float: left;'>";
				echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn'));
				
			echo "</div><br />";
			
		echo $this->Form->end();
		
		
		
		
		?>
   					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Admin settings------->	
 
 
   		
   			
   	 </div>
      
  </div>

</div>
