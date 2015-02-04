<body class=""> 
  <!--<![endif]-->

   
 <div class="content">
 
			<div class="box span12">
				<div class="box-header">
					<h2>Category</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL; ?>">Home</a> <span class="divider">/</span></li>
           	<li><a href="<?php echo SITE_URL.'admin/view/category'; ?>">Category</a> <span class="divider">/</span></li>
   	<li class="active">Edit Category</li>
			        </ul>
				</div>
			</div> 


						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
				
						<h2>Manage Shared Items</h2>
					</div>
					
						
				
					<div class="box-content">   



<?php

echo "<div class='containerdiv'>";


	echo $this->Form->Create('Category',array('url'=>array('controller'=>'/','action'=>'/admin/edit/category/'.$id),'id'=>'Categoryform'));
		if(!empty($mainsec[0]['Category']['category_parent'])){
			foreach($mainsec_prnts as $main_sec){
				$options2[$main_sec['Category']['id']] =  $main_sec['Category']['category_name'];
			}
		}else{
			$options2 = '';
		}
		if(!empty($mainsec[0]['Category']['category_parent'])){
			echo $this->Form->input('categories', array('options' => $options2,'default'=>$mainsec[0]['Category']['category_parent'],'id'=>'mainsec','class'=>'inputform catchnge'));
			
			echo "<br clear='all' /><br />";
			echo "<span><b>hints : if you select the main category , the below category will be treated as subcategory.</b></span>";
			echo "<br clear='all' />";
		}
		if(!empty($mainsec[0]['Category']['category_sub_parent'])){
			echo $this->Form->input('categoryname',array('type'=>'text','value'=>$mainsunprnts[0]['Category']['category_name'],'label'=>'Category Name','id'=>'category_name','class'=>'inputform','disabled'=>'disabled'));
			echo "<input type='hidden' value='yes' name='disabled' />";
		}else{
			echo $this->Form->input('categoryname',array('type'=>'text','value'=>$mainsec[0]['Category']['category_name'],'label'=>'Category Name','id'=>'category_name','class'=>'inputform'));
			echo "<input type='hidden' value='no' name='disabled' />";
		}
		
		echo $this->Form->input('vrintype',array('type'=>'text','label'=>'Variant Name','class'=>'inputform','value'=>$mainsec[0]['Category']['category_vrintype']));
		echo $this->Form->input('sub_vrintype',array('type'=>'text','label'=>'Sub Variant','class'=>'inputform','value'=>$mainsec[0]['Category']['category_sub_vrintype']));
        echo $this->Form->input('Delivery type', array('options' => array('regular' => 'Regular', 'special' => 'Special'),'value'=>$mainsec[0]['Category']['category_del_type']));
		
		echo $this->Form->input('created_by',array('type'=>'hidden','value'=>$mainsec[0]['Category']['created_by']));
		echo $this->Form->input('secid',array('type'=>'hidden','value'=>$mainsec[0]['Category']['id']));
		echo $this->Form->input('subparid',array('type'=>'hidden','value'=>$mainsec[0]['Category']['category_sub_parent']));
		
		echo "<br clear='all' />";
			
		echo "<div id='forms'>";
			if(!empty($mainsec[0]['Category']['category_sub_parent'])){
				echo '<label>Add Sub of Sub category</label><br /><input name="data[Category][categoryname_2]" value="'.$mainsec[0]['Category']['category_name'].'" id="Category_names" class="inputform" type="text" />';
			}else{
				echo '<input name="data[Category][categoryname_2]" value="" id="Category_names" class="inputform" type="hidden" />';
			}
		echo "</div>";
		echo "<br clear='all' />";
		if(!empty($mainsec[0]['Category']['category_parent']) && empty($mainsec[0]['Category']['category_sub_parent'])){
			echo "<a href='javascript:void(0);' onclick='addformss();' class='show_hid'>Add another Sub category</a>";
		}	
		
		//echo "<a href='javascript:void(0);' onclick='deleteform()' style='display:none;' class='deletfrm'>Delete</a>";
		echo $this->Form->submit('Submit');
	echo $this->Form->end();
?>


</div>

</div>
</div>
</div>
