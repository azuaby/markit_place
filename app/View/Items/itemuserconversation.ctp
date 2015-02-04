<body class=""> 
  <!--<![endif]-->
      
   
   
   
 <div class="content">
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Conversation</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
					<ul class="breadcrumb">
					    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
					    <li><a href="<?php echo SITE_URL.'admin/contacteditem'; ?>">Manage Seller Chat</a> <span class="divider">/</span></li>
					   	<li><a href="<?php echo SITE_URL.'admin/itemconversation/'.$itemid; ?>">Item Conversation Users</a> <span class="divider">/</span></li>
					   	<li class="active">Item Conversation</li>
					</ul>
				</div>
			</div>
 

    
<div class="btn-toolbar">
	<a href="<?php echo SITE_URL.'admin/deletecsconversation/'.$csid.'/'.$itemid; ?>" ><button class="btn btn-primary"><i class="icon-trash"></i> Delete Conversation </button></a>
	</div>
   

   
   
						<!-----Contacted User Conversation------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>User Conversation</h2>
						
					</div>
					<div class="box-content">

<?php	
	echo "<div class='containerdiv'>";
		//echo "<div class='addctdivs'>";
			//echo $this->Html->link('Add Category',array('controller'=>'/','action'=>'/admin/add/category/'),array('class'=>'btn btn-success'));
		//echo "</div>";
		
		echo "<a href='".SITE_URL.'adminitemview/'.$itemid."' title='View Item' target='_blank' style='float: right; margin-top: -40px;'>Product: ".$contactsellerModel['Contactseller']['itemname']."</a>";
  		echo "<div id='searchite'>";
			echo "<div class='conversation'>";
				foreach ($csmessageModel as $csmessage){
					if ($csmessage['Contactsellermsg']['sentby'] == 'buyer'){
						$contactPerson = $contactsellerModel['Contactseller']['buyername'];
					}else{
						$contactPerson = $contactsellerModel['Contactseller']['sellername'];
					}
					echo $contactPerson." : ".$csmessage['Contactsellermsg']['message']."</br></br>";
				}
			echo "</div>";
		echo "</div>";
		
	echo "</div>";
?>		</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Contacted User Conversation------->	



     </div></div></div>
     

    
        </div>
    </div>
</div>
    


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>
