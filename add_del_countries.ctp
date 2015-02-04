<body class=""> 
  <!--<![endif]-->
     
   
    
<div class="content">
	<div class="box span12">
		<div class="box-header">
			<h2>Delivery Countries</h2>
		</div>
		<div class="box-content" style="margin-bottom:-20px;">
			<ul class="breadcrumb">
				<li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
				<li><a href="<?php echo SITE_URL.'admin/deliverycountries/'; ?>">Delivery Countries</a><span class="divider">/</span></li>
				<li class="active"><a href="<?php echo SITE_URL.'admin/add/countries/'; ?>">Add Country</a></li>
			</ul>
		</div>
	</div>

    <div class="btn-toolbar">
        <!--button class="btn btn-primary"><i class="icon-save"></i> Save</button>
        <a href="#myModal" data-toggle="modal" class="btn">Delete</a-->
      <div class="btn-group">
      </div>
    </div>

      <!-----Commission------->				
	<div class="row-fluid">		
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>Add Delivery Country</h2>
			</div>
			<div class="box-content">
    <?php
            echo "<div class='containerdiv'>";
            echo $this->Form->Create('delcountry',array('id'=>'Delcountryform'));
		        echo $this->Form->input('dcountry',array('type'=>'text','label'=>'Allowed countries','id'=>'dcountry','class'=>'inputform1'));
		        echo $this->Form->input('darea',array('type'=>'text','label'=>'Areas','id'=>'darea', 'class'=>'inputform2'));
		        echo $this->Form->input('dcurrency',array('type'=>'text','label'=>'Select country currency','id'=>'dcurrency', 'class'=>'inputform3'));
		        echo $this->Form->input('dzone',array('type'=>'text','label'=>'Delivery charge Zone','id'=>'dzone', 'class'=>'inputform4'));
		        echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
        echo $this->Form->end();
	        echo "</div>";
    ?>
		    </div>
	    </div><!--/span-->
    </div><!--/row-->
						<!-----Commission------->	
</div>


