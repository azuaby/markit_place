<?php
echo "<table>";
	echo "<tr >";
		echo "<th>Template ID</th>";
		echo "<th>Template Name</th>";
		echo "<th>Template Type</th>";
		echo "<th>Template Version</th>";
		echo "<th>Action</th>";
		
	echo "</tr>";
	if(!empty($template_det)){
		foreach($template_det as $view_template)
		{
			$Template_id=$view_template['Template']['id'];
			$Template_name=$view_template['Template']['template_name'];
			$Template_version=$view_template['Template']['template_version'];
			$Template_type=$view_template['Templatetype']['type_name'];
			echo "<tr>";
				echo "<td>".$Template_id."</td>";
				echo "<td>".$Template_name."</td>";
				echo "<td>".$Template_type."</td>";
				echo "<td>".$Template_version."</td>";
				echo "<td>".$this->Html->link('EDIT',array('controller'=>'/','action'=>'/edit_template/'.$Template_id))."</td>";
				
			echo "</tr>";
		}
	}else{
		echo "<tr><td></td>";
		echo "<td></td>";
		echo "<td>No record found</td>";
		echo "<td> </td>";
		echo "<td></td></tr>";
		
	}			
echo "</table>";

?>