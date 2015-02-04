<div class="popup contact-seller">
	<div class="ly-title">
		<p class="ltit">Contact Seller</p>
		<button type="button" class="ly-close" id="btn-browses-cs"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
	</div>
	<div class="contact-seller-content">
		<div class="cs-element">
			<p class="cs-label">Query about Item</p>
			<div class="selectdiv" style="display: inline-block;width: 318px;">
			<select id="queryaboutitem" class="selectboxdiv" style="width: 318px !important;">
					<option value="">Select a Query</option>
			<?php foreach ($csqueries as $csquery){ ?>
					<option value="<?php echo $csquery; ?>"><?php echo $csquery; ?></option>
				<?php } ?>
					<option value="Others">Others</option>
			</select><div class='out' >Select a Query</div>
			</div>
			<!-- <select id="queryaboutitem">
				<?php foreach ($csqueries as $csquery){ ?>
					<option value="<?php echo $csquery; ?>"><?php echo $csquery; ?></option>
				<?php } ?>
					<option value="Others">Others</option>
			</select> -->
		</div>
		<div class="cs-element cs-subject">
			<p class="cs-label">Subject</p>
			<input type="text" value="" id="subject" />
		</div>
		<div class="cs-element">
			<p class="cs-label">Message</p>
			<textarea id="message" rows="8"></textarea>
		</div>
		<div class="cs-element" style='margin-bottom:0;'>
			<button class="btn-save" onclick="sendmessage('buyer');">Send</button>
			<div class="sendmessageloader">
        		<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading..." />
        	</div>
		</div>
		<div class="cs-error">Error</div>
		<div class="cs-success">Message Sent Successfully</div>
	</div>
</div>
