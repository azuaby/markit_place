<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "fast",
				control:"#sidetreecontrol",
				prerendered: true,
				persist: "location"
			});
		});
		function cloneforms_clone(){
			//alert('Test');
			var html = $("#applications").html();
			alert(html);
		}
	</script>
<style>
	.hide_divs{
		display:none;
	}
</style>
<?php

	echo "<h3 style='float:left;'><u id='chgdiv'>".$alltemplsects[0]['Section']['section_name']."</u></h3><br />";
	echo "<div class='right_sectors'>";
		if(!empty($secform)){
			foreach($section_chld as $ke=>$secsr){	
				$nxtids[$secsr['Section']['section_parent']] = $secsr['Section']['id'];
				
			}
			foreach($section_prnt as $sections){				
				$prntscnids[] = $sections['Section']['id'];
			}
			echo "<input type='hidden' id='prntscids' value='".implode(',',$prntscnids)."' />";
			echo "<input type='hidden' id='clne_secid' value='".$section_prnt[0]['Section']['id']."' />";
			echo "<input type='hidden' id='clne_prntid' value='".$section_prnt[0]['Section']['section_parent']."' />";
			
			echo '<div class="prev_imgs"><a href="javascript:void(0)" style="text-decoration:none;font-weight:normal;">p</a></div>';
			echo '<div class="nxt_imgs"><a href="javascript:void(0)" onclick="getdashed_url(\''.$section_prnt[1]['Section']['section_urlname'].'\',\''.$section_prnt[1]['Section']['section_name'].'\',\''.$section_prnt[1]['Section']['id'].'\',\''.$section_prnt[1]['Section']['section_parent'].'\');" style="text-decoration:none;font-weight:normal;">n</a></div>';
			
			echo "<div class='submit_th'>";
				echo $this->Form->submit('save_btn.png',array('onclick'=>'saveallforms()','style'=>'height: 37px;width: 84px;'));
			echo "</div>";
			
			echo "<div class='submit_th'>";
				echo $this->Form->submit('new_record_btn.png',array('onclick'=>'cloneforms_clone()','style'=>'height: 37px;width: 164px;'));
			echo "</div>";	
		}	
	echo "</div>";
	echo "<div class='leftside' style='float:left;width:540px;clear:both;'>";
		if(!empty($secform)){
			echo $this->Form->create('appli',array('url'=>array('controller'=>'/','action'=>'/template/addppsect'),'id'=>'applidynamicform'));
				$i = 0;
				foreach($secform as $key=>$secformers){
					//echo "<pre>";print_R($key);
					if($i == 0){
					echo "<div id='".$key."' class='new_divs'>";
					}else{
					echo "<div id='".$key."' class='new_divs hide_divs'>";
					}
					if(!empty($secformers)){
						foreach($secformers as $secforms){
							//echo "<pre>";print_R($secforms);die;
							if($secforms['Sectionform']['type'] == 'radio'){
								$valer = explode (',',$secforms['Sectionform']['value']);
								//echo "<pre>";print_R($valer);die;
								$valopt = array();
								foreach($valer as $k=>$vals){
									$valopt[$vals] = $vals;
									//echo "<pre>";print_R($vals);die;
								}
								if($secforms['Sectionform']['is_mandatory'] == 'yes'){
									//echo $this->Form->input($secforms['Sectionform']['field_name'], array('type'=>'hidden','label'=>false,'name'=>'imp','value'=>$secforms['Sectionform']['field_name'],'class'=>'inputform appliform'));
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']." <span style='color:red;'>*</span></label>";
								}else{
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']."</label>";
								}
								//print_r($val);
								
								echo $this->Form->input($secforms['Sectionform']['field_name'],array('type' => $secforms['Sectionform']['type'],'options' => $valopt,'default'=>$datadatas[$secforms['Sectionform']['id']],'label'=>$secforms['Sectionform']['label'],'fieldset'=>false,'legend'=>false,'class'=>'appliform')); 
								echo "<span class='".$secforms['Sectionform']['id']." j'><span class='tip_left'></span><span class='tool'><p>".$secforms['Sectionform']['hint']."</p></span><span class='tip_right'></span></span>";
								echo "<br clear='all'/><br/>";
							}else if($secforms['Sectionform']['type'] == 'list'){
								if($secforms['Sectionform']['is_mandatory'] == 'yes'){
									echo $this->Form->input($secforms['Sectionform']['field_name'], array('type'=>'hidden','label'=>false,'name'=>'imp','value'=>$secforms['Sectionform']['field_name'],'class'=>'inputform appliform'));
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']." <span style='color:red;'>*</span></label>";
								}else{
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']."</label>";
								}
								$valse = explode (',',$secforms['Sectionform']['value']);
								$valselct = array();
								foreach($valse as $k=>$valsd){
									$valselct[$valsd] = $valsd;
									//echo "<pre>";print_R($vals);die;
								}
								echo $this->Form->input($secforms['Sectionform']['field_name'], array('options' => $valselct,'empty' => '-- Select --','default'=>$datadatas[$secforms['Sectionform']['id']],'label'=>false,'class'=>'inputform appliform','id'=>$secforms['Sectionform']['id']));
								echo "<span class='".$secforms['Sectionform']['id']." j'><span class='tip_left'></span><span class='tool'><p>".$secforms['Sectionform']['hint']."</p></span><span class='tip_right'></span></span>";
								echo "<br clear='all'/><br/>";
							}else{
								//echo $this->Form->label($secforms['Sectionform']['label'],null,array('class'=>'labelcls'));
								if($secforms['Sectionform']['is_mandatory'] == 'yes'){
									echo $this->Form->input($secforms['Sectionform']['field_name'], array('type'=>'hidden','label'=>false,'name'=>'imp','value'=>$secforms['Sectionform']['field_name'],'class'=>'inputform appliform'));
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']." <span style='color:red;'>*</span></label>";
								}else{
									echo "<label class='labelcls'>".$secforms['Sectionform']['label']."</label>";
								}
								echo $this->Form->input($secforms['Sectionform']['field_name'], array('type'=>$secforms['Sectionform']['type'],'label'=>false,'value'=>$datadatas[$secforms['Sectionform']['id']],'class'=>'inputform appliform','id'=>$secforms['Sectionform']['id']));
								echo "<span class='".$secforms['Sectionform']['id']." j'><span class='tip_left'></span><span class='tool'><p>".$secforms['Sectionform']['hint']."</p></span><span class='tip_right'></span></span>";
								echo "<br clear='all'/><br/>";
							}
							
						}
					}else{
						echo "<div style='text-align: center; margin: 0 auto; font-family: arial; font-size: 16px; font-weight: bold;'>No Data Found</div>";
					}
					echo "</div>";	
					
					$i++;
				}
				echo $this->Form->input('tempid', array('type'=>'hidden','label'=>false,'value'=>$id,'class'=>'inputform appliform'));
				//echo $this->Form->input('sec_idss', array('type'=>'hidden','label'=>false,'value'=>$secinid,'class'=>'inputform appliform'));
				echo $this->Form->input('formids', array('type'=>'hidden','label'=>false,'value'=>$formids,'class'=>'inputform appliform'));
				
				if(!empty($datadatas)){
					echo $this->Form->input('agnts', array('type'=>'hidden','label'=>false,'value'=>$agnts,'class'=>'inputform appliform'));
				}else{	
					echo $this->Form->input('agnts', array('type'=>'hidden','label'=>false,'value'=>$agnts,'class'=>'inputform appliform'));
				}
				//echo $this->Form->submit('Save',array('class' => 'submit','onclick'=>'saveallforms()'));
			echo $this->Form->end();
			
		}else{
			echo "<div style='text-align: center; margin: 0 auto; font-family: arial; font-size: 16px; font-weight: bold;'>No Data Found</div>";
		}
	
	echo "</div>";	
		echo "<div class='rightside' style='float: right; width: 300px;'>";
			/*echo "<h1 class='headers'>Application</h1>";
			echo ' <ul class="treeview" id="tree">';
				$i = 0;
				//$ulemnt = '<ul style="display: none;">';
				$ulemnt = array();
					foreach($section_chld as $ke=>$secsr){	
						$section_parentids[$secsr['Section']['section_parent']] = $secsr['Section']['section_name'];
						if($ke == $i){
							$ulemnt[$secsr['Section']['section_parent']] .= "<li class='last'>";
						}else{
							$ulemnt[$secsr['Section']['section_parent']] .= "<li>";
						}
							$ulemnt[$secsr['Section']['section_parent']] .= "<div class='subclass_".$secsr['Section']['id']."'><a href='javascript:void(0)' onclick='getdashed(\"".$sections['Section']['section_name']."\");'>".$secsr['Section']['section_name']."</a></div></li>";
						$i++;
					}							
				//$ulemnt .= "</ul>";		
				//echo "<pre>";print_r($ulemnt);die;
				foreach($section_prnt as $sections){						
					$var = $sections['Section']['id'];
					
					if(!@$ulemnt[$var]){
						echo '<li class="collapsable">';
					}else{	
						echo '<li class="expandable">';
					}	
						//echo '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="'.SITE_URL.'template/appsect/'.$id.$secinids.'" onclick="subapp('.$var.')" style="text-decoration:none;font-weight:normal;">'.$sections['Section']['section_name'].'</a></li>';
						//echo '<div class="hitarea expandable-hitarea"></div><a href="'.SITE_URL.'template/appsect/'.$id.'/'.$sections['Section']['id'].'-'.$sections['Section']['section_name'].'" style="text-decoration:none;font-weight:normal;">'.$sections['Section']['section_name'].'</a>';
						echo '<div class="hitarea expandable-hitarea"></div><a href="javascript:void(0)" onclick="getdashed(\''.$sections['Section']['section_name'].'\');" style="text-decoration:none;font-weight:normal;">'.$sections['Section']['section_name'].'</a>';
						if(@$ulemnt[$var]){				
							echo '<ul style="display: none;">';
								echo $ulemnt[$var];
							echo "</ul>";
						}
					echo "</li>";
					
				}
			echo "</ul>";
		*/
			echo "<br/>";
			if(!empty($secform)){
				echo "<div style='margin-top:15px;border:1px solid #a7b38b;border-top:none;'>";
					echo "<h1 class='headers ai'>Action Items</h1>";
					$j = 0;
					foreach($secform as $keys=>$sec_formers){
						if($j == 0){
						echo "<div id='appli_".$keys."' class='new_divs'>";
						}else{
						echo "<div id='appli_".$keys."' class='new_divs hide_divs'>";
						}
						foreach($sec_formers as $sec_forms){
							if($sec_forms['Sectionform']['is_mandatory'] == 'yes' && empty($datadatas[$sec_forms['Sectionform']['id']])){
								echo "<div id='error_".$sec_forms['Sectionform']['id']."' style='padding:5px;margin-left:10px;margin-right:10px;border-bottom:1px solid #e6edd1;font-size:12px;'><span style='color:red;font-size:12px;font-weight:bold;font-family:arial;margin-right: 12px;'>X</span>".$sec_forms['Sectionform']['label']."</div>";
								//echo "<br/>";
							}
							
						}	
						$j++;
						echo "</div>";	
						
					}	
				echo "</div>";	
			}	
	echo "</div>";
	
?>