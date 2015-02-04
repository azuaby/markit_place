<?php
	$db = mysql_connect('localhost', 'root', '');
	$db1 = mysql_select_db('fantacy',$db);
?>

<?php
//<script src="'.SITE_URL.'js/jquery.js" type="text/javascript" language="javascript"></script>
/* echo '
			<script src="'.SITE_URL.'js/jquery.MetaData.js" type="text/javascript" language="javascript"></script>
 			<script src="'.SITE_URL.'js/jquery.rating.js" type="text/javascript" language="javascript"></script>
 			<link href="'.SITE_URL.'css/jquery.rating.css" type="text/css" rel="stylesheet"/>'; */
 			?>

<div class="popup write-review" style="width:510px !important;">
	<div class="ly-title">
		<p class="ltit">Write Review</p>
		<button type="button" class="ly-close" id="btn-browses"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	</div>

	 		  

	<div class="contact-seller-content">
			<div class="cs-element">
			<p class="cs-label">Ratings</p>
			<div style="padding-top:7px;padding-left:104px;">
				<i class="rating one" onclick="ratingClick('1');"></i>
				<i class="rating two" onclick="ratingClick('2');"></i>
				<i class="rating three" onclick="ratingClick('3');"></i>
				<i class="rating four" onclick="ratingClick('4');"></i>
				<i class="rating five" onclick="ratingClick('5');"></i>
				&nbsp;<span class="current-rate">0</span> Out of 5
		 		   <!-- <input name="star3" type="radio" class="star" value="1"/>
			       <input name="star3" type="radio" class="star" value="2"/>
			       <input name="star3" type="radio" class="star" value="3"/>
			       <input name="star3" type="radio" class="star" value="4"/>
			       <input name="star3" type="radio" class="star" value="5"/> -->
			</div>
					       
			<!-- <script type="text/javascript">
			    $('.star').rating({ 
			    	callback: function(value, link)
			    	{ 
			    		$("#rateval").val(value);
			    		$("#alrt").html("<span style='color:red'>Thanks for rating</span>");
			    					setTimeout(function() {
	  									$('#alrt').fadeOut('slow');
									}, 5000);
			    	} 
			    });
			    
			</script> -->
			<input type="hidden" id="rateval">
			<p class="cs-label" id="alrt" style="margin-top:-6px;margin-left:10px;"></p>	
		</div>
		
		
		<div class="cs-element">
			<p class="cs-label">Order</p>
					<?php
					echo '<select id="ordername">';
					
		foreach($order_datas as $orders)
		{
		$orderdate = date('Y-m-d H:i:s',$orders['Orders']['orderdate']);
		$today = date('Y-m-d H:i:s');
		$date = date_create($orderdate);
		date_add($date, date_interval_create_from_date_string('30 days'));
		$review_date = date_format($date, 'Y-m-d H:i:s');
		if($today<$review_date)
		{
			$orderid = $orders['Orders']['orderid'];
			$query = mysql_query("select itemname from fc_order_items where orderid='$orderid'");
			$row = mysql_fetch_array($query);
			//echo $row['itemname'];
			echo '<option value="'.$orderid.'">'.$orders['Orders']['orderid'].'</option>';
		}
		}
		echo '</select>';
		?>
		</div>
		
		
		<div class="cs-element">
			<p class="cs-label">Review</p>
			<textarea rows="5" cols="20" id="review" maxlength="250"></textarea><div id="err_txt"></div>
		</div>
		
				<div class="cs-element" style='margin-bottom:0;'>
					<?php
					echo '
					<input type="hidden" id="uname" value="'.$loguser[0]['User']['username'].'">
					<input type="button" style="cursor:pointer;" class="btn-save" value="Submit" onclick="review('.$usr_datas['User']['id'].','.$loguser[0]['User']['id'].')">';
					?>
				</div>
	</div>
</div>