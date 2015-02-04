<?php
	$db = mysql_connect('localhost', 'root', '');
	$db1 = mysql_select_db('fred',$db);
?>


<?php
		$tot = 0;
		foreach($rateval_data as $rateval)
		{
			$tot += $rateval['Review']['ratings'];	
		}
		$percentage = ($tot * 100) / ($review_count * 5);
		$percentage = floor($percentage * 2) / 2;
		echo $shop_details[0]['Shop']['shop_name']."<br />".$shop_description[0]['User']['about']."<br />".$percentage."%<br >";
	echo '<table style="width:100% !important;text-align:center;">';
	$i = 1;
	if(!empty($reviews_added))
	{
		foreach($reviews_added as $reviews)
		{
			$uid = $reviews['Review']['userid'];
			$query = mysql_query("select username from ak_users where id='$uid'");
			$row = mysql_fetch_array($query);
			
			
			
			echo '<tr><td style="width:10%">'.$i.'</td>
			<td style="width:20%">'.$row['username'].'</td>
			<td style="width:50%">'.$reviews['Review']['reviews'].'</td>
			<td style="width:30%">'.$reviews['Review']['date'].'</td>
			</tr><tr><td colspan="4">&nbsp;</td></tr>';
			$i++;
		}
	
		$j = $count+1;
		echo '<tr><td>&nbsp;</td></tr><tr><td colspan="4" align="center"><input type="hidden" value="'.$j.'" id="loadcount">';
		echo '<input type="hidden" id="sid" value="'.$reviews['Review']['sellerid'].'">
		<input type="button" style="float:none;display:none;" class="btn-save" value="Load more" onclick="view_review('.$reviews['Review']['sellerid'].')">';
		echo '</td></tr></table>';
	}
	else
	{
		echo '<center>No reviews added</center>';
	}
	echo '<br />';
?>
<script type="text/javascript">
	$(window).scroll(function () 
	{
		sellerid = $("#sid").val();
		view_review(sellerid);
	});
</script>