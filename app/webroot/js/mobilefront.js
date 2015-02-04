var $ = jQuery.noConflict();
var BaseURL=getBaseURL();
var unfantid;
$(document).ready(function(){
	
	/*$('#flashMessage').live('load' , function(){
			alert('hide');
			setTimeout(function() {
				  $('#flashMessage').fadeOut('slow');
				}, 5000);
			});*/
	
	$('.share-via a').click(function(e) {
	    e.preventDefault();
	});
	
	$(".close").click(function(){
		$(".popupbox3").hide();
		$("#fade").hide();
	});
	
	
	$('.appliform').focus(function(){
		var val = $(this).attr('id');		
		$('.'+$(this).attr('id')).show();
			
	});
	$('.appliform').keyup(function(){
		var val = $('#'+$(this).attr('id')).val();
		if(val != ''){
			$('#error_'+$(this).attr('id')).hide();
		}else{
			$('#error_'+$(this).attr('id')).show();
		}
	});
	$('.appliform').click(function(){
		var val = $('#'+$(this).attr('id')).val();
		var str = $(this).attr('id');
		// alert(str);
		// var sid = str.slice(0,-1);
		var sid = str.replace(/\D/g,'');
		// sid = (str.split(""));
		// alert(val);
		// alert(sid);
		if(val != ''){
			// $('#error_'+sid[0]).hide();
			$('#error_'+sid).hide();
		}else{
			// $('#error_'+sid[0]).show();
			$('#error_'+sid).show();
		}
	});
	
	$('.changepass').click(function(){
		var val = $(this).val();
		// alert(val);
		if(val == 'yes'){
			$('#editpassword').show();
			$('.pass1').show();
		}else if(val == 'no'){
			$('#editpassword').hide();
			$('.pass1').hide();
		}
	});
	/* Profile Edit Form */
	$('#profileform').submit(function(){
		var username = $('#edituser').val();
		var email = $('#editemail').val();
		var vals = $('.changepass:checked').val();
		var password = $('#editpassword').val();
		if(username == ''){
			alert('Please enter the Username');
			return false;
		}
		if(email == ''){
			alert('Please enter the Email');
			return false;
		}
		if(!(isValidEmailAddress(email))){
			alert('Enter The Valid Email');
			return false;
		}
		if(vals == 'yes'){
			if(password == ''){
				alert('Please enter the Password');
				return false;
			}
			if(password.length < 6){
				alert('Password should be greater that 5 digits');
				return false;
			}
		}
	});
	
	/* Login Form */
/*	$('#loginform').submit(function(){
		var email = $('#user_email').val();
		var password = $('#user_pass').val();
		if(email == ''){
			alert('Please enter the Email');
			return false;
		}
		if(!(isValidEmailAddress(email))){
			alert('Enter The Valid Email');
			return false;
		}
		if(password == ''){
			alert('Please enter the Password');
			return false;
		}
	});
	*/
	
	$(".catchnge").change(function(){
		var mainsel = $("#mainsec").val();
		if(mainsel == ''){
			$(".show_hid").hide();
		}else{
			$(".show_hid").show();
		}
	});
	
	$("#cate_id").change(function(){
		var cate_id = $("#cate_id :selected").val();
		// alert(cate_id);
		var items="";
		if(cate_id != ''){
			 $.getJSON(BaseURL+"suprsubcategry?cate_id="+cate_id+"&suprsub=yes",function(data){
				 
				items+="<option value=''>Select Category</option>";
				$.each(data,function(index,cate) 
				{
					if(cate.Name != undefined){
						items+="<option value='"+cate.ID+"'>"+cate.Name+"</option>";
					}
				});
				
				//$("#categ-container-2").removeClass('inactive');
				//$("#categ-container-2 label").removeClass('invisible');
				$("#categ-container-2").show();
				$("#categ-selectbx-2").html(items); 
				$("#categ-container-2 .out").html('Select category');
				$("#categ-container-3 .out").html('Select category');
			});
		}else{
			$("#categ-container-2").addClass('inactive');
			$("#categ-container-2 label").addClass('invisible');
			$("#categ-selectbx-2").html(''); 
		}		
	});
	
	$("#categ-selectbx-2").change(function(){
		var cate_id = $("#categ-selectbx-2 :selected").val();
		// alert(cate_id);
		var items="";
		if(cate_id != ''){
			 $.getJSON(BaseURL+"suprsubcategry?cate_id="+cate_id+"&suprsub=no",function(data){
				// alert(data);
				// return false;
				items+="<option value=''>Select Category</option>";
				$.each(data,function(index,cate) 
				{
					if(cate.Name != undefined){
						items+="<option value='"+cate.ID+"'>"+cate.Name+"</option>";
					}
				});
				//$("#categ-container-3").removeClass('inactive');
				//$("#categ-container-3 label").removeClass('invisible');
				$("#categ-container-3").show();
				$("#categ-selectbx-3").html(items); 
				$("#categ-container-3 .out").html('Select category');
			});
		}else{
			$("#categ-container-3").addClass('inactive');
			$("#categ-container-3 label").addClass('invisible');
			$("#categ-selectbx-3").html(''); 
		}		
	});


	$("#text_box_id").keyup(function () {
		var name = $(this).val();
		// alert(name);
		var dname_without_space = $("#text_box_id").val().replace(/ /g, "");
		var name_without_special_char = dname_without_space.replace(/[^a-zA-Z 0-9]+/g, "");
		$(this).attr("value", name_without_special_char);
		
	});
	
	$("#shopform").submit(function(){
		var shopnme = $("#text_box_id").val();
		if(shopnme == ''){
			alert('Shop name is required');
			return false;
		}
	});
	
	
	/* listing item  who make it select box*/
	
	$("#who-made").change(function(){
		var whom = $("#who-made :selected").val();
		// alert(whom);
		
		if(whom == ''){
			$("#is-supply").addClass('inactive');
			$("#when-made").addClass('inactive');
		}else{
			$("#is-supply").removeClass('inactive');
			$("#is-supply select").removeAttr('disabled');
		}
	});
	
	$("#is-supply").change(function(){
		var sply = $("#is-supply :selected").val();
		
		if(sply == ''){
			$("#when-made").addClass('inactive');
		}else{
			$("#when-made").removeClass('inactive');
			$("#when-made select").removeAttr('disabled');
		}
		
		
	});
	
	
	/*$("#cate_id").change(function(){
		var cate_id = $("#cate_id :selected").val();
		// alert(cate_id);
		var items="";
		if(cate_id != ''){
			 $.getJSON(BaseURL+"suprsubcategry?cate_id="+cate_id+"&suprsub=yes",function(data){
				// alert(data);
				// return false;
				items+="<option value=''>Select Category</option>";
				$.each(data,function(index,cate) 
				{
				  items+="<option value='"+cate.ID+"'>"+cate.Name+"</option>";
				});
				$("#categ-container-2").removeClass('inactive');
				$("#categ-container-2 h4").removeClass('invisible');
				$("#categ-selectbx-2").html(items); 
			});
		}else{
			$("#categ-container-2").addClass('inactive');
			$("#categ-container-2 h4").addClass('invisible');
			$("#categ-selectbx-2").html(''); 
		}		
	});
	
	$("#categ-selectbx-2").change(function(){
		var cate_id = $("#categ-selectbx-2 :selected").val();
		// alert(cate_id);
		var items="";
		if(cate_id != ''){
			 $.getJSON(BaseURL+"suprsubcategry?cate_id="+cate_id+"&suprsub=no",function(data){
				// alert(data);
				// return false;
				items+="<option value=''>Select Category</option>";
				$.each(data,function(index,cate) 
				{
				  items+="<option value='"+cate.ID+"'>"+cate.Name+"</option>";
				});
				$("#categ-container-3").removeClass('inactive');
				$("#categ-container-3 h4").removeClass('invisible');
				$("#categ-selectbx-3").html(items); 
			});
		}else{
			$("#categ-container-3").addClass('inactive');
			$("#categ-container-3 h4").addClass('invisible');
			$("#categ-selectbx-3").html(''); 
		}		
	});
	*/
	
	/* add tags */
	$(".button-medium").live('click',function(){
		var tags = $("#tags-input-text").val();
		
		if(tags == ''){
			return false;
		}
		
		var filters = new Array();

		var tags_cnt = $("#tags_cnt").val();
		if(tags_cnt > 12){
			$(".tags-remaining").html("You've used all 13 tags");
			$(".tags-remaining").css('color','red');
			return false;
		}
		
		var htms = '<span class="tag tag-rem" id="'+tags_cnt+'">'+tags+'<a class="remove close close_x" href="javascript:void(0)"></a><input type="hidden" value="'+tags+'" name="tags[]"></span> ';
		
		$(".instructions").css('display','none');
		$(".tags-remaining").css('color','black');
		var added = false;
		
		if(tags_cnt > 0){
			$('#item-tags input').each(function(items,val) {
				
				var valse = $('#'+items+' input').val();
				// alert(valse);
				// Element was not found, add it.
				if(valse == tags){
					added = false;
					return false;
				}else{	
					added = true;
					
				}	
				
			});	
		}else{	
			added = true;					
		}
		// alert(added);
		if(!added){
			// alert(tags_cnt);
			$(".tags-remaining").html("You can not add same tag again");
			$(".tags-remaining").css('color','red');
			$('#'+tags_cnt).remove();
			return false;
		}else{	
			$("#item-tags").append(htms);
			// console.log(filters);
			var tls = 12-tags_cnt;
			//alert(tls);
			var hts = 'Add '+tls+' more <span style="text-transform: lowercase">Tags</span>';
			$(".tags-remaining").html(hts);
			tags_cnt++;
			$("#tags_cnt").val(tags_cnt);
			
		}	
		
		/* if(!$.inArray(tags, filters)){
			alert(tags_cnt);
			if(tags_cnt > 0){
				$(".tags-remaining").html("You can not add same tag again");
				$(".tags-remaining").css('color','red');
				$('#'+tags_cnt).remove();
				return false;
			}
		}
		
		$("#item-tags").append(htms);
		console.log(filters);
		var tls = 12-tags_cnt;
		//alert(tls);
		var hts = 'Add '+tls+' more <span style="text-transform: lowercase">Tags</span>';
		$(".tags-remaining").html(hts);
		tags_cnt++;
		$("#tags_cnt").val(tags_cnt);
		$("#tags-input-text").val(''); */
		
	
		$("#tags-input-text").val('');
	
		$("#tags-input-text").focus();
		
		return false;
	});
	
	/* add meterails */
	$(".button-mediumer").live('click',function(){
		var metrl = $("#metrl-input-text").val();
		
		if(metrl == ''){
			return false;
		}
		
		var filters = new Array();

		var mtrls_cnt = $("#mtrls_cnt").val();
		if(mtrls_cnt > 12){
			$(".metrl-remaining").html("You've used all 13 materials");
			$(".metrl-remaining").css('color','red');
			return false;
		}
		
		var htms1 = '<span class="materials" id="mtrl_'+mtrls_cnt+'">'+metrl+'<a class="remove close close_x" href="javascript:void(0)"></a><input type="hidden" value="'+metrl+'" name="metrl[]"></span> ';
		
		$(".metrl-remaining").css('color','black');
		var mtrladded = false;
		
		if(mtrls_cnt > 0){
			$('#item-materials input').each(function(items,val) {
				
				var valsemtr = $('#mtrl_'+items+' input').val();
				// alert(valsemtr);
				// Element was not found, add it.
				if(valsemtr == metrl){
					mtrladded = false;
					return false;
				}else{	
					mtrladded = true;
					
				}	
				
			});	
		}else{	
			mtrladded = true;					
		}
		// alert(added);
		if(!mtrladded){
			// alert(tags_cnt);
			$(".metrl-remaining").html("You can not add same material again");
			$(".metrl-remaining").css('color','red');
			$('#mtrl_'+mtrls_cnt).remove();
			return false;
		}else{	
			$("#item-materials").append(htms1);
			// console.log(filters);
			var tls = 12-mtrls_cnt;
			//alert(tls);
			var hts = 'Add '+tls+' more <span style="text-transform: lowercase">Materials</span>';
			$(".metrl-remaining").html(hts);
			mtrls_cnt++;
			$("#mtrls_cnt").val(mtrls_cnt);
			
		}	
		$("#metrl-input-text").val('');
	
		$("#metrl-input-text").focus();
		
		return false;
	});
	
	$(".materials").live('click',function(){
		var mtr_id = $(this).attr('id');
		// alert(mtr_id);
		$(this).remove();
		var mtrls_cnt = parseInt($("#mtrls_cnt").val());
		
		var tls = mtrls_cnt+1;
		// alert(tls);
		var rmng = 13-tls;
		var hts = 'Add '+rmng+' more <span style="text-transform: lowercase">Materials</span>';
		$(".metrl-remaining").html(hts);
		mtrls_cnt--;
		$("#mtrls_cnt").val(mtrls_cnt);
		
	});
	$(".tag-rem").live('click',function(){
		$(this).remove();
		var tags_cnt = parseInt($("#tags_cnt").val());
		
		var tlstg = tags_cnt+1;
		// alert(tls);
		var tgrem = 13-tlstg;
		var htstg = 'Add '+tgrem+' more <span style="text-transform: lowercase">Tags</span>';
		$(".instructions").html(htstg);
		tags_cnt--;
		$("#tags_cnt").val(mtrls_cnt);
		
	});
	
   /* $('select#languages').selectList({ sort: true,
		onAdd: function (select, value, text) {
			var sty_cnt = $("#style_cnt").val();
			sty_cnt++;
			$("#style_cnt").val(sty_cnt);
			
			if(sty_cnt > 1){
				$('.selectlist-select').attr('disabled','disabled');				
			}
			if(sty_cnt > 0){
				var hts = 'Add 1 more style. optional';
			}
			if(sty_cnt == 2){
				var hts = "You've used your 2 styles.";
			}
			
			$('.style_msg').html(hts);
			// alert(value + ' is a good choice, sir!');
			//Add 1 more style.<span class="optional">optional</span>
			//You've used your 2 styles.
		}
	});*/
	
	$('#price,#quantity').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	
	$("#processing-time-id").change(function(){
		var vals = $("#processing-time-id :selected").val();
		// alert(vals);
		if(vals == 'custom'){
			$("#processing-time-days").show();
		}else{
			$("#processing-time-days").hide();
		}
	});
	
	$("#selct_lctn_bxs").change(function(){
		var incrmt_val = $("#incrmt_val").val();
		incrmt_val++;
		$('.shippingcountryerror').hide();
		
		var lctn = $("#selct_lctn_bxs :selected").val();
		var lctn_name = $("#selct_lctn_bxs :selected").text();
		var default_currency = $("#default_currency_symbol").val();
		// alert(lctn);
		// alert(lctn_name);
		if ($('#shpng_div tbody tr').hasClass(lctn)){
			$('.shippingcountryerror').html(" Country already exist");
			$('.shippingcountryerror').show();
			return;
		}else if (lctn == ''){
			return;
		}
		$(".input-group-close").removeClass('clsehide');
		var htms = '<tr class="new-shipping-location '+lctn+'">';
			htms += '<td id="'+lctn+'">';
				htms += '<div class="input-group-location">'+lctn_name+'</div>';
				htms += '<div class="regions-box"></div>';
			htms += '</td>';      
			htms += '<td>';
				htms += '<div class="input-group input-group-price price-input primary-shipping-price">';
					htms += '<label>'+default_currency+' </label>';
					htms += '<input type="text" value="" class="money text text-small" name="country_shipping['+lctn+']['+incrmt_val+'][primary]">';
				htms += '</div>';
			htms += '</td>';  
			htms += '<td class="input-group-close">';
				htms += '<div class="input-group input-group-price price-input primary-shipping-price"><a class="remove" href="javascript:void(0)" id='+lctn+'><span  class="glyphicons bin"> </span></a></div>';
			htms += '</td>';
		htms += '</tr> ';
		
		$("#shpng_div tbody").prepend(htms);
		
		$("#incrmt_val").val(incrmt_val);
	});
	
	$(".input-group-close a").live('click',function(){
		//alert(this.id);
		$("."+this.id).remove();
		return false;
	});
	
	
	$("#itemform").submit(function(){
		/*var whomade  = $("#who-made select option:selected").val();
		var suply  = $("#is-supply select option:selected").val();
		var whenmade  = $("#when-made select option:selected").val();*/
		
		
		var cate_id  = $("#cate_id").val();
		var subcate_id  = $("#categ-selectbx-2").val();
		//alert(cate_id);
		
		var img0  = $("#image_computer_0").val();
		var img1  = $("#image_computer_1").val();
		var img2  = $("#image_computer_2").val();
		var img3  = $("#image_computer_3").val();
		
		var title  = $("#title").val();
		//var description  = $("#description").val();
		var description  = tinyMCE.get('description').getContent();
		var price  = $("#price").val();
		var quantity  = $("#quantity").val();
		var prmry_val  = $(".primary-shipping-price input").val();
		var scndry_val  = $(".scdry-shipping-price input").val();
		// alert(whomade);
		
		/*if(whomade == ''){
			$("#alert").show();
			$('#alert').text('Please select who made it, what type of item it is, and when it was made.');
			 
			return false;
		}
		if(suply == ''){
			$("#alert").show();
			$('#alert').text(' Please select the type of item and when it was made.');
			 
			return false;
		}
		if(whenmade == ''){
			$("#alert").show();
			$('#alert').text(' Please select when it was made.');
			 
			return false;
		}*/
		
		if(cate_id == ''){
			$("#alert").show();
			$('#alert').text('Please select the Category');
			 
			return false;
		}
		
		if(subcate_id == ''){
			$("#alert").show();
			$('#alert').text('Please select the Sub-Category');
			 
			return false;
		}
		
		if(img0 == '' && img1 == '' && img2 == '' && img3 == ''){
			$("#alert").show();
			$('#alert').text('Please add atleast one photo.');
			 
			return false;
		}
		if(title == ''){
			$("#alert").show();
			$('#alert').text('Please enter the title for the item.');
			 
			return false;
		}
		if(description == ''){
			$("#alert").show();
			$('#alert').text('Please enter a description for the item.');
			 
			return false;
		}
		if(price == ''){
			$("#alert").show();
			$('#alert').text('Please enter the price for the item');
			 
			return false;
		}
		if(quantity == '' || quantity <= 0){
			$("#alert").show();
			$('#alert').text('Please enter a valid quantity for the item.');
			 
			return false;
		}
		if(prmry_val == ''){
			$("#alert").show();
			$('#alert').text('Please enter a shipping cost for at least one country or region.');
			 
			return false;
		}
		
		// return false;
	});
	
	
	
	
	
	
	
	
	
	
	
	
	/* add items to favourite item */
	$("#add-favorite").live('click',function(){
		var loguserid = $("#loguserid").val();
		if(loguserid == 0){
			alert("Please Login");
			return false;
		}else{
			var listingid = $("#listingid").val();
			// alert(listingid);
			if(listingid == 0 || listingid == ''){
				return false;
			}
			//$("#add-favorite span").text('waiting item Adding to favorites...');
			$("#add-favorite span").text('Item added to favourites');
			
			$.post(BaseURL+'addfavitems', {"itemid":listingid},
				function(datas) {
					if(datas != 0){
						alert("Item already favorited");
					}
						$("#add-favorite").attr('id','itemfav');
						$("#add-favorite span").text('Item added to favorites ');
					
					return false;
					
				}
			);
		}
	});
	/* add shop to favourite */
	$(".shop-favorite").live('click',function(){
		var loguserid = $("#loguserid").val();
		if(loguserid == 0){
			alert("Please Login");
			return false;
		}else{
			var shopid = $("#shopid").val();
			// alert(shopid);
			if(shopid == 0 || shopid == ''){
				return false;
			}
			$("#shop-favorite span").text('waiting shop Adding to favorites...');
			
			$.post(BaseURL+'addfavshops', {"shopid":shopid},
				function(datas) {
					if(datas != 0){
						alert("Shop already favorited");
					}
					$("#shop-favorite").removeClass('shop-favorite');
					$("#shop-favorite span").text('Shop added to favorites');
					
					return false;
					
				}
			);
		}
	});
	
	$("#shopinfoform").submit(function(){
		var shop_title = $("#shop_title").val();
		var image_computer = $("#image_computer").val();
		// alert(shop_title);
		
		if(image_computer == ''){
			alert('Shop Banner image is neccsary');
			return false;
		}
		if(shop_title == ''){
			alert('Shop Title is neccsary');
			return false;
		}
	});
	
	
	/* dynamic image change */
	/*$('#categories_list').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: false,
        disableLink: true,
        speed: 'fast',
        showCount: true,
        autoExpand: true
       // cookie  : 'dcjq-accordion-1',
        //classExpand  : 'dcjq-current-parent'
      });*/
	
	$('.button fantacyd').click(function(){alert("Unfantacy");
		var id = unfantid;
		var likedbtncnt = $("#likedbtncnt").val();
		var likebtncnt = $("#likebtncnt").val();
		unfant = false;
		$.post(BaseURL+'mobile/userUnlike', {"itemid":id},
					function(datas) {
					//if(datas != 0 && datas == 1){
						$(".itemdd"+id).html(likebtncnt);
						$('#ddheart'+id).removeClass('heart');
						$('#ddheart'+id).addClass('heart_empty');
						$('#dd'+id).removeClass('fantacyd');
						$('#dd'+id).addClass('fantacy');
			   	 		//$('#dd'+id).css('background-color', '#5385BE');
			   	 		//$('#spandd'+id).css('background-color', '#3E73B7');
						$('#popup_container').hide();
						$('#popup_container').css({"opacity":"0"});
						$('.set-dropdown').hide();
						var fav_counts = $('#fav_count'+id).attr("fav_counts");
					    var fav_counts1 = parseInt(fav_counts) - 1;
					    //alert(fav_counts1);
					    $(".countvall"+id).html(fav_counts1);
						$('#chngehearts'+id).removeClass('heart');
						$('#chngehearts'+id).addClass('heart_empty');
					//}
					
					return false;
					}
				);
	});
	
	
	$('.button fantacy').click(function(){alert("Fantacy")
		var id = unfantid;
		var likedbtncnt = $("#likedbtncnt").val();
		var likebtncnt = $("#likebtncnt").val();
		unfant = false;
		$.post(BaseURL+'mobile/userlike', {"itemid":id},
					function(datas) {
					//if(datas != 0 && datas == 1){
						$(".itemdd"+id).html(likedbtncnt);
						$('#ddheart'+id).removeClass('heart');
						$('#ddheart'+id).addClass('heart_empty');
						$('#dd'+id).removeClass('fantacyd');
						$('#dd'+id).addClass('fantacy');
			   	 		//$('#dd'+id).css('background-color', '#5385BE');
			   	 		//$('#spandd'+id).css('background-color', '#3E73B7');
						$('#popup_container').hide();
						$('#popup_container').css({"opacity":"0"});
						$('.set-dropdown').hide();
						var fav_counts = $('#fav_count'+id).attr("fav_counts");
					    var fav_counts1 = parseInt(fav_counts) - 1;
					    //alert(fav_counts1);
					    $(".countvall"+id).html(fav_counts1);
						$('#chngehearts'+id).removeClass('heart');
						$('#chngehearts'+id).addClass('heart_empty');
					//}
					
					return false;
					}
				);
	});
	
	$('#btn-doneid').click(function(){
		var BaseURL=getBaseURL();
		var id = unfantid;
		var data = $('.categorycls').serialize();
		$.post(BaseURL+'totaladduserlist', {"alldata":data,"itemid":id},
					function(datas) {
					$('#popup_container').hide();
					$('#popup_container').css({"opacity":"0"});
					}
				);
	});
		
		
	$('#list_createid').click(function(){
		var BaseURL=getBaseURL();
		var id = unfantid;
		var newlist_val = $("#new-create-list").val();
		if(newlist_val!=''){
		$.post(BaseURL+'adduserlist', {"itemid":id,"newlist":newlist_val},
				function(datas) {
				if(datas!='' ){
					var appval = '<li><input type="checkbox" value="'+datas+'" name="category_items[]" checked="checked" />'+datas+'</br></li>';
					$(".appen_div").append(appval);
					document.getElementById('new-create-list').value = "";
					return false;
				}
				}
			);
			}
	});
	
});


/* front end js */

function close_x(){
	$("#alert").html('');
	$("#alert").hide();
}

function signform(){
	var data = $('#signupform').serialize();
	var fullname=$('#fullname').val();
	//var lastname=$('#lastname').val();
	var username=$('#username').val();
	var email=$('#email').val();
	//var signupGender = $('.genderradio:checked').val();
	var password=$('#password').val();
	//var terms=$('#terms').val();
	//var rpassword=$('#rpassword').val();
	//alert(data);
	if(fullname == ''){
		$("#alertName").show();
		$("#badmessage").hide();
		$('#alertName').text('Name is required');
			$('#fullname').focus()
		$('#fullname').keydown(function() {
			$('#alertName').hide();
		});

		return false;
	}
	if(username == ''){
		$("#alertUname").show();
		$("#badmessage").hide();
		$('#alertUname').text('Username is required');
			$('#username').focus()
		$('#username').keydown(function() {
			$('#alertUname').hide();
		});
		
		return false;
	}
	
	if(email == ''){
		$("#alertEmail").show();
		$("#badmessage").hide();
		$('#alertEmail').text('Email is required');
			$('#email').focus()
		$('#email').keydown(function() {
			$('#alertEmail').hide();
		});
		
		return false;
	}
	if(!(isValidEmailAddress(email))){
		$("#alertEmail").show();
		$("#badmessage").hide();
		$('#alertEmail').text('Enter a valid email');
			$('#email').focus()
		$('#email').keydown(function() {
			$('#alertEmail').hide();
		});
		
		return false;
	}
	
	
	if(password == ''){
		$("#alertPass").show();
		$("#badmessage").hide();
		$('#alertPass').text('Password should not empty');
			$('#password').focus()
		$('#password').keydown(function() {
			$('#alertPass').text('Password must be greater than 6 characters long');
		});
		
	
		return false;
	}
	
	if(password.length < 6){
		$("#alertPass").show();
		$("#badmessage").hide();
		$('#alertPass').text('Password must be greater than 6 characters long');
			$('#password').focus()
		$('#password').keydown(function() {
			$('#alertPass').hide();
		});
	
		return false;
	}
	
	/*if(terms == ''){
		$("#alert").show();
		$('#alert').text('Please check the Terms and Conditions');
		return false;
	}*/
	

}


function validsigninfrm() {
	var email=$('#username').val();
	var password=$('#password').val();
	if(email == ''){
		$("#alert_em").show();
		$("#badMessage").hide();
		$('#alert_em').text('Email is required');
		$('#username').focus();
		$('#username').keydown(function() {
			$('#alert_em').hide();
		});
		return false;
	}
	if(!(isValidEmailAddress(email))){
		$("#alert_em").show();
		$("#badMessage").hide();
		$('#alert_em').text('Enter a valid email');
		$('#username').focus();
		return false;
	}
	if(password == ''){
		$("#alert_pass").show();
		$("#alert_em").hide();
		$("#badMessage").hide();
		$('#alert_pass').text('Password is required');
		$('#password').focus();
		return false;
	}
}


function passwordconfirm(){
	var data = $('#passchk').serialize();
	var password=$('#passw').val();
	var rpassword=$('#confirmpass').val();
	//alert(password);
	//alert(data);
	
	if(password == ''){
		$("#alert").show();
		
		$('#alert').text('password is not empty');
		 
		return false;
	}
	if(password.length < 6){
		$("#alert").show();
		
		$('#alert').text('password must be greater than 5 characters long.');
		 
		return false;
	}
	if(rpassword == ''){
		$("#alert").show();
		
		$('#alert').text('Confirm password is not empty!');
		 
		return false;
	}
	if(password != rpassword){
		$("#alert").show();
		
		$('#alert').text('Password and confrim password is not match');
		 
		return false;
	}
	
}

function getfollows(usrid){
	//alert(usrid);
	var baseurl = getBaseURL();
	//alert(usrid);
	var logid = $("#gstid").val();
	if(logid == 0){
		//alert("Please Login");
		window.location = baseurl+"mobile/login";
		return false;
	}else{
		// return false;
		//$("#flw_"+usrid).text('waiting ...');
			//alert(baseurl);
			$.post(baseurl+'addflw_usrs', {"usrid":usrid},
				function(datas) {
				//alert(datas);
				/*if(datas != 0){
					alert("You already followed this user");
				}*/
				
				//var cmtval = '<p  id="oritext'+id+'">'+datas+'</p>';
				//$("#oritextvalafedit"+id).append(cmtval);
				
				$("#foll"+usrid).hide(); $("#mainfoll"+usrid).hide();
				$("#unfoll"+usrid).hide(); $("#mainunfoll"+usrid).hide();
				var cmtval = '<span class="follow" id="unfoll'+usrid+'"><button class="ui-btn" id="unfollow_btn'+usrid+'" onclick="deletefollows('+usrid+')"><span class="unfoll'+usrid+'" >Following</span></button></span>';
				$("#changebtn"+usrid).html(cmtval); $("#mainchangebtn"+usrid).html(cmtval);
				//$(".foll"+usrid).text('Following... ');

				return false;
			}
		);
	}
}
function deletefollows(usrid){
	//alert(usrid);
	var baseurl = getBaseURL();
	//alert(baseurl);
	var logid = $("#gstid").val();
	if(logid == 0){
		//alert("Please Login");
		window.location = baseurl+"mobile/login";
		return false;
	}else{
		// return false;
		//$("#flw_"+usrid).text('waiting ...');
			//alert(baseurl);
			$.post(baseurl+'delerteflw_usrs', {"usrid":usrid},
				function(datas) {
				//alert(datas);
				//if(datas != 0){
					//alert("You already followed this user");
				//}

				$("#foll"+usrid).hide(); $("#mainfoll"+usrid).hide();
				$("#unfoll"+usrid).hide(); $("#mainunfoll"+usrid).hide();
				var cmtval = '<span class="follow" id="foll'+usrid+'"><button class="ui-btn" id="follow_btn'+usrid+'" onclick="getfollows('+usrid+')"><span class="foll'+usrid+'" >Follow</span></button></span>';
				$("#changebtn"+usrid).html(cmtval); $("#mainchangebtn"+usrid).html(cmtval);
				
				
				//$(".unfoll"+usrid).text('Follow ');
				
				return false;
			}
		);
	}
}



function getfollowsuserpro(usrid){
	var baseurl = getBaseURL();
	//alert(usrid);
	var logid = $("#gstid").val();
	if(logid == 0){
		//alert("Please Login");
		window.location = baseurl+"mobile/login";
		return false;
	}else{
		// return false;
		//$("#flw_"+usrid).text('waiting ...');
			//alert(baseurl);
			$.post(baseurl+'addflw_usrs', {"usrid":usrid},
				function(datas) {
				//alert(datas);
				/*if(datas != 0){
					alert("You already followed this user");
				}*/
				
				//var cmtval = '<p  id="oritext'+id+'">'+datas+'</p>';
				//$("#oritextvalafedit"+id).append(cmtval);
				
				$("#foll"+usrid).hide();
				$("#unfoll"+usrid).hide();
				var cmtval = '<span class="follow" id="unfoll'+usrid+'"><div class="profilImgName"><button type="button" id="unfollow_btn'+usrid+'" class="editPrfcls" onclick="deletefollowsuserpro('+usrid+')" style="height: 57px;"><span class="unfoll'+usrid+'" >Following</span></button></div></span>';
				$("#changebtn"+usrid).html(cmtval);
				//$(".foll"+usrid).text('Following... ');

				return false;
			}
		);
	}
}
function deletefollowsuserpro(usrid){
	//alert(usrid);
	var baseurl = getBaseURL();
	//alert(baseurl);
	var logid = $("#gstid").val();
	if(logid == 0){
		//alert("Please Login");
		window.location = baseurl+"mobile/login";
		return false;
	}else{
		// return false;
		//$("#flw_"+usrid).text('waiting ...');
			//alert(baseurl);
			$.post(baseurl+'delerteflw_usrs', {"usrid":usrid},
				function(datas) {
				//alert(datas);
				//if(datas != 0){
					//alert("You already followed this user");
				//}

				$("#foll"+usrid).hide();
				$("#unfoll"+usrid).hide();
				var cmtval = '<span class="follow" id="foll'+usrid+'"><div class="profilImgName"><button type="button" id="follow_btn'+usrid+'" class="editPrfcls" onclick="getfollowsuserpro('+usrid+')" style="height: 57px;"><span class="foll'+usrid+'" >Follow</span></button></div></span>';
				$("#changebtn"+usrid).html(cmtval);
				
				
				//$(".unfoll"+usrid).text('Follow ');
				
				return false;
			}
		);
	}
}
/*function itemcou(id){
	var BaseURL=getBaseURL();
		//alert(id);
		var loguserid = $("#loguserid").val();
		if(loguserid == 0){
			window.location.href=BaseURL+"login";
			return false;
		}else{
			$("#dd .itemp"+id).text('Liked');
			
			$.post(BaseURL+'userlike', {"itemid":id},
				function(datas) {
					if(datas != 0 && datas == 1){
						$("#dd .itemp"+id).text('Like it');
					}
						//$("#add-favorite").attr('id','itemfav');
						//$("#add-favorite span").text('Item added to favorites ');
					
					return false;
					
				}
			);
		}
	}*/



function removeimg(val){
	$('#image_computer_'+val).val('');
	$('#show_url_'+val).attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg_'+val).hide();
	$('#frame_'+val).show();
}
function removeusrimg(val){
	var baseurl = getBaseURL();
	$('#image_computer').val('');
	$('#show_url').attr({src: baseurl+'media/avatars/thumb350/usrimg.jpg'});
	$('#removeimg').hide();
}

function confirmExit()
{
	if (needToConfirm){
		return "If you have made any changes to the fields without clicking the Save button, your changes will be lost. Are you sure you want to exit this page?";
	}else{
		window.location = BaseURL+"fact-finds";
	}
}


function isValidEmailAddress(email) {
	var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	return emailreg.test(email);
}

function getBaseURL(){ 
	var url = location.href; 
	var baseURL = url.substring(0, url.indexOf('/', 14));  
	if (baseURL.indexOf('http://localhost') != -1) { 
		var url = location.href; 
		var pathname = location.pathname; 
		var index1 = url.indexOf(pathname); 
		var index2 = url.indexOf("/", index1 + 1); 
		var baseLocalUrl = url.substr(0, index2);  
		return baseLocalUrl + "/"; 
	} else { 
		return baseURL + "/dev/"; 
	}
}


function removecart (itemId, userId, shopId, id) {
	$baseurl = getBaseURL();
	var x=window.confirm("Are you sure to remove the item?");
	if (x){
	var eleid = "#shop";
	var cartid = '#address-cart';
	var cartshipping = $(cartid).val();
	$.ajax({
      url: $baseurl+"mobilepaypals/delete_cart_item/"+itemId+"/"+userId+"/"+shopId,
      type: "post",
      data : { 'currentship': cartshipping},
      dataType: "json",
      success: function(responce){
          //alert(eleid);
    	  var obj = eval (responce);
    	  if (obj[0] != null) {
    	 $(eleid).html(obj[0]); 
    	 }else {
    		 window.location.assign(obj['url']+'cart');
    	 }
    	 $('.totalItemsCart').html(obj[1]+" item(s)");
    	 $('.totalYouHave').html("You have "+obj[1]+" Items in your Cart");
      } 
    });
	}else{
		return false;
		}
	}





function removegiftcart (giftcartid) {
	$baseurl = getBaseURL();
	
	//var giftcartids = $("#giftcartids"+giftcartid).remove();
	var y=window.confirm("Are you sure you want to delete?");
	if (y){
	
	$.ajax({
      url: $baseurl+"mobilepaypals/delete_giftcart_item?giftcartid="+giftcartid,
      type: "GET",
      dataType: "html",
      success: function(responce){
      	$('#gfremoved').show();
  		setTimeout(function(){$('#gfremoved').fadeOut();}, 3000);
  		$("#giftcartids"+giftcartid).remove();
      } 
    });
	}else{
		return false;
	}
	}
	
	
	



function getColor (color) {
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"color/"+color+"/1",
	      type: "post",
	      dataType: "html",
	      success: function(responce){
	          //alert(eleid);
	    	 $('.products-list').html(responce); 
	      } 
	});
}

function itemlistingloadqty(id) {
	$baseurl = getBaseURL();
	var size = $('#size_opt').val();
	$.ajax({
	      url: $baseurl+"getsizeqty",
	      type: "post",
	      dataType: "html",
	      data : { 'id': id, 'size': size},
	      beforeSend: function () {
	    	  $('.sizeqtyloader').show();
	    	  $('.sizeqtydiv').hide();
	      },
	      success: function(responce){
	    	  $('.sizeqtyloader').hide();
	          //alert(eleid);
	    	 $('#qty_opt').html(responce); 
	    	 $('.sizeqtydiv .out').html('1');
	    	 $('.sizeqtydiv').show();
	      } 
	});
}

function selectChange(itemId, userId, shopId, id) {
	$baseurl = getBaseURL();
	var eleid = "#shop";
	var load = '.selectLoad'+itemId;
	var qntyid = '#qnty'+itemId;
	var qnty = $(qntyid).val();
	var cartid = '#address-cart';
	var cartshipping = $(cartid).val();
	
	var couponnId = $('#coupon_idhide'+id).val();
	if(couponnId !=''){
		//alert(couponnId);
		couponnId = couponnId;
	}else{
		couponnId = '';
	}
	
	
	
	$.ajax({
	      url: $baseurl+"mobilepaypals/delete_cart_item/"+itemId+"/"+userId+"/"+shopId+"/"+qnty+"/"+couponnId,
	      type: "post",
	      dataType: "json",
	      data : { 'currentship': cartshipping},
	      beforeSend: function () {
	    	  $(load).show();
	      },
	      success: function(responce){
	          //alert(eleid);
	    	  $(load).hide();
	    	  var obj = eval (responce);
	    	  if (obj[0] != null) {
	    	 $(eleid).html(obj[0]); 
	    	 }else {
	    		 $(eleid).remove();
	    	 }
	      }
	});
}


function checkout (itemids,merchid,shipamt) {
	$baseurl = getBaseURL();
	var addrid = '#address-cart';
	var shippingid = $(addrid).val();
	var adaptiveload = ".adaptiveLoader"+merchid;
	var button = ".button"+merchid;
	
	//alert(merchid);
	
	var userEnterCreditAmt = $('#availablee_credits').html();

	
	if(userEnterCreditAmt !==''){
		userEnterCreditAmt = userEnterCreditAmt;
	}else{
		userEnterCreditAmt = 0;
	}
	

	var couponnId = $('#coupon_idhide').val();
	if(couponnId !=''){
		couponnId = couponnId;
	}else{
		couponnId = 0;
	}
	
	
	var giftCardId = $('#giftcard_idhide').val();
	if(giftCardId !=''){
		giftCardId = giftCardId;
	}else{
		giftCardId = 0;
	}
	
	var shipping_addre = $("#shipping_addre").val();
	//alert(shipping_addre);
	if(shipping_addre==0){
		alert('Please add the shipping address');
		return false;
	}
	
	$.ajax({
	      url: $baseurl+"mobile/checkout/",
	      type: "post",
	      data : { 'item_id': itemids,'shippingid': shippingid,'shipamt': shipamt,'couponId': couponnId,'userEnterCreditAmt': userEnterCreditAmt,'giftCardId': giftCardId},
	      dataType: "html",
			beforeSend: function() {
				$(adaptiveload).show();
				$(button).attr("disabled", "disabled");
			},
	      success: function(responce){
	    	  $('#paypalfom').html(responce);
	    	  $('#paypal').submit();
	      }
	});
}



function giftcardusebuynow (itemids,merchid,shipamt) {
	//alert('Hello');
	//alert(itemids);
	//alert(merchid);
	//alert(shipamt);
	baseurl = getBaseURL();
	var addrid = '#address-cart';
	var shippingid = $(addrid).val();
	var adaptiveload = ".adaptiveLoader"+merchid;
	var button = ".button"+merchid;
	
	//alert(merchid);
	
	var userEnterCreditAmt = $('#availablee_credits').html();

	
	if(userEnterCreditAmt !==''){
		userEnterCreditAmt = userEnterCreditAmt;
	}else{
		userEnterCreditAmt = 0;
	}
	

	var couponnId = $('#coupon_idhide').val();
	if(couponnId !=''){
		couponnId = couponnId;
	}else{
		couponnId = 0;
	}
	
	
	var giftCardId = $('#giftcard_idhide').val();
	if(giftCardId !=''){
		giftCardId = giftCardId;
	}else{
		giftCardId = 0;
	}
	
	var shipping_addre = $("#shipping_addre").val();
	//alert(shipping_addre);
	if(shipping_addre==0){
		alert('Please add the shipping address');
		return false;
	}
	
	$.ajax({
	      url: baseurl+"gfcrdcheckout/",
	      type: "post",
	      data : { 'item_id': itemids,'shippingid': shippingid,'shipamt': shipamt,'couponId': couponnId,'userEnterCreditAmt': userEnterCreditAmt,'giftCardId': giftCardId},
	      dataType: "html",
			beforeSend: function() {
				$(adaptiveload).show();
				$(button).attr("disabled", "disabled");
			},
	      success: function(responce){
	    	  //alert(responce);
	    	  window.location.href=baseurl+"payment-successful";
	    	  //$('#paypalfom').html(responce);
	    	  //$('#paypal').submit();
	      }
	});
}


function giftcardcheckout(id){
	var baseurl = getBaseURL();
	var adaptiveload = ".PLoader"+id;
	var button = ".button"+id;
	///alert('checkoout'+id+baseurl);
	$.ajax({
	      url: baseurl+"mobile/checkoutgiftcard/",
	      type: "post",
	      data : { 'giftcardchkid': id},
	      dataType: "html",
			beforeSend: function() {
				$(adaptiveload).show();
				$(button).attr("disabled", "disabled");
			},
	      success: function(responce){
	    	  //alert(responce);
				$(adaptiveload).hide();
	    	  $('#paypalfom').html(responce);
	    	  $('#paypal').submit();
	      }
	});
}










function deletecmnt(id){
		baseurl = getBaseURL();
		var eleid = ".delecmt_"+id;
		var itemid = $('#itemid').val();
		//alert(eleid);
		if(id!=''){
		$.post(baseurl+'deletecomments', {"addid":id,"itemid":itemid},
			function(datas) {
			$(eleid).remove();
			return false;
		}
		);
	}
}

/// sathish for delete add item ////
function deleteadditem(id){
	
	baseurl = getBaseURL();
	var eleid = "#addeitem_"+id;
	//alert(eleid);
	var x=window.confirm("Are you sure to remove the item?");
	if (x){
	if(id!=''){
	$.post(baseurl+'deleteadditem', {"addid":id},
		function(datas) {
			$(eleid).remove();
		//return false;
	}
	);
}
	}else{
		return false;
	}
	}

/////sathish ends delete added item //////
function editcmnt(id){
	//alert(id);
	$("#oritext"+id).css('display','none');
	$("#txt1"+id).css('display','inline');
	$("#oritextvalafedit"+id).css('display','none');
	var edithide = ".delecmt_"+id+ " .c-reply";
	$(edithide).hide();
}



function editcmntsave(id){
	//alert(id);
	var txt1val = $("#txt1val"+id).val();
	//alert(txt1val);
	baseurl = getBaseURL();
	if(id!=''){
		
		var pattern = /@([\S]*?)(?=\s)/g;
		if(txt1val.match(pattern)){
		var result = txt1val.match(pattern);
		for (var i = 0; i < result.length; i++) {
		    if (result[i].length > 1) {
		       result[i] = result[i].substring(1, result[i].length);
		    }
		    //alert(result[i]);
		    var link = "<a href='"+baseurl+"people/"+result[i]+"'>"+result[i]+"</a>";
		    var replacestr = result[i];
		}
		
		
		txt1val = txt1val.replace(replacestr,link);
		}
		
		$.ajax({
			type: "POST",
			url: baseurl+'editcommentsave',
			data:  {"cmtid":id,"cmntval":txt1val},
			beforeSend: function() {
				$(".btn-savecmd").attr("disabled", "disabled");
			},
			success: function(datas) {
				$("#oritextvalafedit"+id).css('display','inline');
				$("#oritext"+id).css('display','none');
				$("#txt1"+id).css('display','none');
				var cmtval = '<p  id="oritext'+id+'" style="margin-top:-10px;">'+datas+'</p>';
				$("#oritextvalafedit"+id).append(cmtval);
				$('#oritext'+id).remove();
				$(".btn-savecmd").removeAttr("disabled");
				var edithide = ".delecmt_"+id+ " .c-reply";
				$(edithide).show();
			},
			dataType: 'html'
			});
		
	}

}



function cmntsubmit(profileFlag){
	//alert('ddre');
	var commentss = $('#comment_msg').val();
	var commid = $('#commid').val();
	var itemid = $('#itemid').val();
	var userid = $('#userid').val();
	var usernames = $('#usernames').val();
	var userimges = $('#userimges').val();
	var baseurl = getBaseURL();
	//echo '<p class="c-reply"><a class="edit-comment" href="#">Edit</a><span class="bar"></span> <a class="delete-comment" href="#"  onclick = "return deletecmnt('.$cmnt['Comment']['id'].')" >Delete</a></p>
	//var appval = '<li class="comment  delecmt_'+datas+'" commid="'+datas+'" cuid="'+userid+'" ><a class="milestone" ></a><span class="vcard"><a href="'+baseurl+'people/'+usernames+'" class="url"><img src="'+baseurl+'avatars/thumb70/'+userimges+'" alt="" class="photo"><span class="fn nickname">'+usernames+'</span></a></span><p class="c-text">'+commentss+'</p><p class="c-reply"></p><p class="c-reply"><a class="edit-comment" href="#">Edit</a><span class="bar"></span> <a class="delete-comment" href="#"  onclick = "return deletecmnt('+datas+')" >Delete</a></p></li>';
	//var appval = '<li class="comment  delecmt_'+datas+'" commid="'+datas+'" cuid="'+userid+'" ><a class="milestone" ></a><span class="vcard"><a href="'+baseurl+'people/'+usernames+'" class="url"><img src="'+baseurl+'avatars/thumb70/'+userimges+'" alt="" class="photo"><span class="fn nickname">'+usernames+'</span></a></span><p class="c-text">'+commentss+'</p><p class="c-reply"></p><p class="c-reply"><a class="edit-comment" href="#">Edit</a><span class="bar"></span> <a class="delete-comment" href="#"  onclick = "return deletecmnt('+datas+')" >Delete</a></p></li>';
	var logid = $("#loguser_id").val();
	if(logid == 0){
		window.location.href=baseurl+"mobile/login";
		return false;
	}else{
		if(commentss!='' && comment_status ){
			comment_status=false;
			

			//var str = $('#a').text();
			var pattern = /@([\S]*?)(?=\s)/g;
			
			var commentsss = commentss;
				
			if(commentss.match(pattern)){
			var result = commentss.match(pattern);
			for (var i = 0; i < result.length; i++) {
			    if (result[i].length > 1) {
			       result[i] = result[i].substring(1, result[i].length);
			    }
			    //alert(result[i]);
			    var link = "<a href='"+baseurl+"people/"+result[i]+"'>"+result[i]+"</a>";
			    var replacestr = result[i];
			}
			
			
			commentsss = commentss.replace(replacestr,link);
			
			}
			
			$.ajax({
				type: "POST",
				url: baseurl+'addcomments',
				data: {"userid":userid,"itemid":itemid, "commentss":commentsss},
				beforeSend: function() {
					$('.post-loading').show();
					$("#commentssave").attr("disabled", "disabled");
				},
				success: function(datas) {
					//alert(commentss);
					//var appval = '<li class="comment  delecmt_'+datas+'" commid="'+datas+'" cuid="'+userid+'" ><a class="milestone" ></a><span class="vcard"><a href="'+baseurl+'people/'+usernames+'" class="url"><img src="'+baseurl+'avatars/thumb70/'+userimges+'" alt="" class="photo"><span class="fn nickname">'+usernames+'</span></a></span><p class="c-text" id="txt1'+datas+'"  style="display:none;"><textarea id="txt1val'+datas+'" maxlength="180">'+commentss+'</textarea><button class="edit-comment-save" onclick = "return editcmntsave('+datas+')" >Save</button></p><p id="oritext'+datas+'">'+commentss+'</p><div id="oritextvalafedit'+datas+'"></div><p class="c-text">'+commentss+'</p><p class="c-reply"></p><p class="c-reply"><a class="edit-comment" href="#">Edit</a><span class="bar"></span><a class="delete-comment" href="#"  onclick = "return deletecmnt('+datas+')" >Delete</a></p></li>';
					var radius = "";
					if (profileFlag == 1) {
						radius = "border-radius:30px;";
					}
					var appval = '<tr><td><span class="comment  delecmt_'+datas+'" commid="'+datas+'" cuid="'+userid+'" ><a class="milestone" ></a><span class="vcard"><a href="'+baseurl+'people/'+usernames+'" class="url"><img src="'+baseurl+'media/avatars/thumb70/'+userimges+'" alt="" class="photo" style="'+radius+'"></a></span></td><td><span class="vcard cmntusername" style="position:relative;"><a href="'+baseurl+'people/'+usernames+'" class="url"><span class="fn nickname">'+usernames+'</span></a></span><p class="c-text" id="txt1'+datas+'"  style="display:none;"><textarea id="txt1val'+datas+'" maxlength="180" style="float: right; overflow: auto; resize: none; height: 50px; width: 541px; padding: 5px 0px 0px 10px;">'+commentss+'</textarea><br /><button class="btn-blue-post btn-savecmd" onclick = "return editcmntsave('+datas+')" >Save comment</button></p><p id="oritext'+datas+'" style="margin-top:-10px;">'+commentsss+'</p><div id="oritextvalafedit'+datas+'"></div><p class="c-reply"></p><p class="c-reply"><button class="edit-comment" onclick = "return editcmnt('+datas+')" >Edit</button><span class="bar"></span><button class="delete-comment"  onclick = "return deletecmnt('+datas+')" >Delete</button></p></span></td></tr>';
						
						$("#sat tbody").append(appval);
						document.getElementById('comment_msg').value = "";
						commentsss = "";
						comment_status = true;
						$('.post-loading').hide();
						$("#commentssave").removeAttr("disabled");
				},
				dataType: 'html'
				});
	}
	}
}




function itemadd(){
	//alert('Worked');
	var baseurl1 = getBaseURL();
	$('#popupforadditem').show();
	$('#popupforadditem').css({"opacity":"1"});
	$('#itemaddid').show();
	
	$('#closebtnn').click(function(){
		$('#loading_img').hide();
		$('#popupforadditem').hide();
		$('#popupforadditem').css({"opacity":"0"});
		$('#itemaddid').hide();
	});
	
	$('#webupload').click(function(){
		$('#popupforadditem').show();
		$('#popupforadditem').css({"opacity":"1"});
		$('#itemaddid').hide();
		$('#itemurls').show();
		
		
		$('#closebtnn1').click(function(){
			$('#popupforadditem').hide();
			$('#popupforadditem').css({"opacity":"0"});
			$('#itemurls').hide();
		});
		
		
		$('#getimg').click(function(){
			//alert('d');
			var text_url = $('#text_url').val();
			if(text_url != '' && url_status){
				url_status=false;
				text_url = text_url.replace("http://", "");
				var baseurl = getBaseURL()+'additemusingurl?url='+text_url;
				$.ajax({
				      url: baseurl,
				      type: "GET",
				      dataType: "html",
				      beforeSend: function () {
				    	  $('#loading_img').show();
				      },
				      success: function(responce){
				         // alert(responce);
				          var obj = eval (responce);
				          if(obj.length > 0){
				          $('#images_orig').attr('src',obj[0]);
				            var im = 1;
					      	$('#prev_img').click(function(){
					      		//alert('Pre');
					      		if(im>1){
					      			im-=1;
					      			$('#images_orig').attr('src', obj[im]);
							      	$('#first_value').html(im);	
					      		}
					      	});
					      	
					      	$('#next_img').click(function(){
					      		if(obj.length>im){
					      			im+=1;
					      			$('#images_orig').attr('src', obj[im]);
							      	$('#first_value').html(im);	
					      		}
					      	});
					        

				    	    $('#loading_img').hide();
					      	$('#first_value').html(im);
					      	$('#totlcnt').html(obj.length);	
							$('#givenlink').val(text_url);
	
					  		$('#popupforadditem').show();
					  		$('#popupforadditem').css({"opacity":"1"});
					  		$('#itemaddid').hide();
					  		$('#itemurls').hide();
					  		$('#item_views').show();
					  		
					  		$('#closebtnn2').click(function(){
								$('#popupforadditem').hide();
								$('#popupforadditem').css({"opacity":"0"});
								$('#item_views').hide();
							});
					  		
					  		$('#saveimgs').click(function(){

					      		//alert('save');


					      		var additem_title = $('#additem_title').val();
					      		var additem_prices = $('#additem_prices').val();
					      		var categoryname = $('#categoryname').val();
					      		var additems_notes = $('#additems_notes').val();
					      		var image_name = $('#images_orig').attr('src');
					      		
					      		image_name = image_name.replace("http://", "http");
					      		if(additem_title == ''){
					      			alert('Please enter Title');
					      			return false;
					      		}
					      		
					      		if(categoryname == ''){
					      			alert('Please select Category');
					      			return false;
					      		}
					      			
					      		//alert("additem title   -  "+additem_title);
					      		//alert("categoryname   -  "+categoryname);
					      		//alert("additems_notes   - "+additems_notes);
					      		//alert("Site url  -  "+text_url);
					      		//alert("Image url  - "+image_name);
					      		
					      		if(item_save){
					      			item_save=false;
						      		var baseurl = getBaseURL();
						      		var urls = baseurl +'additemsave?title='+additem_title+'&desc='+additems_notes+'&categoryname='+ categoryname +'&siteurl='+encodeURIComponent(text_url)+'&imageurl='+ image_name+'&additem_prices='+ additem_prices;
									$.ajax({
									      url: urls,
									      type: "GET",
									      dataType: "html",
									      beforeSend: function () {
									    	  $('#loading_img_save').show();
									      },
									      success: function(responce){
									    	  	var splitt = responce.split(",");
									    	  	window.location.href=baseurl+"listing/"+splitt[0]+"/"+splitt[1];
									    	  	//alert("Item added successfully");
									    	  	$('#popupforadditem').hide();
										  		$('#popupforadditem').css({"opacity":"0"});
										  		$('#itemaddid').hide();
										  		$('#itemurls').hide();
										  		$('#item_views').hide();
									    	    $('#loading_img').hide();
									    	    additem_title = '';
									      		categoryname = '';
									      		additems_notes = '';
									      		image_name = '';
									    	  
									      }
						      		
									});

					      		}
					      		//$('#images_orig').attr('src');
					      		
					      	});

					    	$('#loading_img_save').hide();
			      			item_save=true;
					  		$('#gobacktomain1').click(function(){
					      		//alert('backtomain');
					      		$('#itemurls').hide();
					      		$('#item_views').hide();
					    		$('#popupforadditem').show();
					    		$('#popupforadditem').css({"opacity":"1"});
					    		$('#itemaddid').show();
					      	});
					  		

							url_status=true;
				      	}else{
				      		alert('Oooops There is no images for this page.');
				      		$('#loading_img').hide();
							url_status=true;
				      	}
				      }
			    });
				
			}	
		});
		
	});
	$('#gobacktomain').click(function(){
		$('#itemurls').hide();
		$('#loading_img').hide();
		$('#popupforadditem').show();
		$('#popupforadditem').css({"opacity":"1"});
		$('#itemaddid').show();
		
		
	});
	
	
	
}


function itemcou(id){	
	var addusrlist = true;
	unfantid = id;
	var BaseURL=getBaseURL();
	//alert(id);
	var likedbtncnt = $("#likedbtncnt").val();
	var likebtncnt = $("#likebtncnt").val();
	//alert(likebtncnt);
		var loguserid = $("#loguserid").val();
		if(loguserid == 0){
			window.location.href=BaseURL+"mobile/login";
			return false;
		}
		
		//alert($('#img_id'+id).find('img:first').attr('src'));
		
		$('#slideshow-box').hide();
		$('#popup_container').show();
		$('#popup_container').css({"opacity":"1"});
		$('#add-to-list-new').css({"margin":"300px auto 0"});
		$("#selectimgs").attr("src",$('#img_id'+id).find('img:first').attr('src'));
		//$('#add-to-list-new').show();
		setTimeout(function() {
			$('#add-to-list-new').css({"margin":"25px auto 0"});
			}, 30);
		$('#videourrls').hide();
		$('.create-group-gifts').hide();
		$('#share-social').hide();
		$('#showprofile').hide();
		$('.btn_set').click(function(){
			$('.set-dropdown').show();
		});
		console.log("List Item id"+id);

		/*$('#btn-doneid').click(function(){
		var BaseURL=getBaseURL();
		var data = $('.categorycls').serialize();
		if(addusrlist){
			alert(id);
		addusrlist = false;
		$.post(BaseURL+'totaladduserlist', {"alldata":data,"itemid":id},
					function(datas) {
					$('#popup_container').hide();
					$('#popup_container').css({"opacity":"0"});
					}
				);
		}
		});
		
		
		$('#list_createid').click(function(){
			var BaseURL=getBaseURL();
			var newlist_val = $("#new-create-list").val();
			if(newlist_val!=''){
			$.post(BaseURL+'adduserlist', {"itemid":id,"newlist":newlist_val},
					function(datas) {
					if(datas!='' ){
						var appval = '<li><input type="checkbox" name="category_item" checked="checked" />'+datas+'</br></li>';
						$(".appen_div").append(appval);
						document.getElementById('new-create-list').value = "";
						return false;
					}
					}
				);
				}
		});*/
		
		/*$('.btn-unfancy').click(function(){
			if(unfant){unfantid
				unfant = false;
				$.post(BaseURL+'userUnlike', {"itemid":id},
							function(datas) {
							//if(datas != 0 && datas == 1){
								$(".itemdd"+id).html(likebtncnt);
								$('#ddheart'+id).removeClass('heart');
								$('#ddheart'+id).addClass('heart_empty');
					   	 		$('#dd'+id).css('background-color', '#5385BE');
					   	 		$('#spandd'+id).css('background-color', '#3E73B7');
								$('#popup_container').hide();
								$('#popup_container').css({"opacity":"0"});
								$('.set-dropdown').hide();
								var fav_counts = $('#fav_count'+id).attr("fav_counts");
							    var fav_counts1 = parseInt(fav_counts) - 1;
							    //alert(fav_counts1);
							    $(".countvall"+id).html(fav_counts1);
								$('#chngehearts'+id).removeClass('heart');
								$('#chngehearts'+id).addClass('heart_empty');
							//}
							
							return false;
							}
						);
			}
		});*/
		
		
		if(loguserid == 0){
			window.location.href=BaseURL+"mobile/login";
			return false;
		}else{				    
			$.post(BaseURL+'mobile/userlike', {"itemid":id},
				function(datas) {
				datas = eval(datas);
				$("input[type=checkbox]").removeAttr('checked');
				for (var i = 0; i<datas.length; i++){
					if (datas[i]['listcheck'] == '1'){
						$("input[type=checkbox][value="+datas[i]['listname']+"]").attr("checked","true");
					}
				}
				$(".itemdd"+id).html(likebtncnt);
				$('#ddheart'+id).addClass('heart');
				$('#ddheart'+id).removeClass('heart_empty');
				$('#dd'+id).removeClass('fantacy ui-link');
				$('#dd'+id).addClass('fantacyd ui-link');
	   	 	   	//$('#dd'+id).css('background-color', '#84C069');
	   	 		//$('#spandd'+id).css('background-color', '#6EAA53');	   	 		
	   	 		//$('#spandd'+id).css('border-color', '#4A9528');
			    var fav_counts = $('#fav_count'+id).attr("fav_counts");
			    var fav_counts1 = parseInt(fav_counts) + 1;
			   // alert(fav_counts1);
			    $(".countvall"+id).html(fav_counts1);	
				$('#chngehearts'+id).removeClass('heart_empty');
				$('#chngehearts'+id).addClass('heart');
					/*if(datas != 0 && datas == 1){
						$(".itemdd"+id).text('Like it');
			   	 		$('#dd'+id).css('background-color', '#5385BE');
			   	 		$('#spandd'+id).css('background-color', '#5385BE');
					} */
					return false;
					
				}
			);
		}
	}





	
	
	
	function share_post(id){
	var BaseURL=getBaseURL();
		//alert(id);
		var loguserid = $("#loguserid").val();
		if(loguserid == 0){
			window.location.href=BaseURL+"mobile/login";
			return false;
		}
		
		$('#popup_container').show();
		$('#popup_container').css({"opacity":"1"});
		$('#share-social').css({"margin-top":"400px"});
		$('#share-social').show();
		$('.share-thing').show();
		setTimeout(function() {
			$('#share-social').css({"margin-top":"100px"});
			}, 30);
		$('#slideshow-box').hide();
		$('#add-to-list-new').hide();
		$('.create-group-gifts').hide();
		$('#videourrls').hide();
		$('#showprofile').hide();
		
           $("#thum_img").attr("src",$('#img_id'+id).find('img:first').attr('src'));
           var shareImg = $("#thum_img").attr("src");
           var title = $('#figcaption_titles'+id).attr("figcaption_title");
		   $("#figcaption_title_popup").text(title);
		   
		   
           var username_p = $('#price_vals'+id).attr("price_val");
		   $("#username_popup").text(username_p);
		
		   var usernames = $('#user_n'+id).attr("usernameval");
		   $("#usernames_popup").text(usernames);
		   
		   var fav_counts = $('#fav_count'+id).attr("fav_counts");
		   $("#fav_countsvv").text(fav_counts);
		   
			var urlss = BaseURL+'listing/'+id +'/'+ title;
			//alert(urlss);
			
			encry_urlss = encodeURIComponent(urlss);
			encry_title = encodeURIComponent(title);
			encry_image = encodeURIComponent(shareImg);
			//alert(encry_urlss);
			
			$('.facebook').attr('href', 'http://www.facebook.com/sharer.php?s=100&p[title]='+encry_title+'&p[url]='+encry_urlss+'&p[images][0]='+encry_image);
			//$('.facebook').attr('href', 'http://www.facebook.com/sharer.php?u='+encry_urlss+'&t='+encry_title);
			
			$('.twitter').attr('href', 'http://twitter.com/?status='+encry_urlss);
			$('.google').attr('href', 'http://plus.google.com/share?url='+encry_urlss);
			$('.linkedin').attr('href', 'http://www.linkedin.com/cws/share?url='+encry_urlss+'&title='+encry_title);
			$('.stumbleupon').attr('href', 'http://www.stumbleupon.com/submit?url='+encry_urlss+'&title='+encry_title);
			$('.tumblr').attr('href', 'http://www.tumblr.com/share/link?url='+encry_urlss+'&name='+encry_title);
					
					
		
	}
	
	
	
	
	function share_user_bio(uname,id){
		var BaseURL=getBaseURL();
		//var BaseURL='www.example.com/'
			//alert(id);
			var loguserid = $("#loguserid").val();
			if(loguserid == 0){
				window.location.href=BaseURL+"mobile/login";
				return false;
			}
			
			$('#popup_container').show();
			$('#popup_container').css({"opacity":"1"});
			$('#share-user-profile').hide();
			$('.share-thing').hide();
			$('#slideshow-box').hide();
			$('#add-to-list-new').hide();
			$('#videourrls').hide();
			$('#share-social').hide();
			
	         /* var usernames = $('#user_n'+id).attr("usernameval");
			   $("#usernames_popup").text(usernames);*/
			   
			  
				var urlss = BaseURL+'people/'+uname;
				//alert(urlss);
				var title = 'Checkout '+uname+' Profile';
				
				
				encry_urlss = encodeURIComponent(urlss);
				encry_title = encodeURIComponent(title);
				//alert(encry_urlss);
				
				$('.facebook_usr').attr('href', 'http://www.facebook.com/sharer.php?s=100&p[title]='+encry_title+'&p[url]='+encry_urlss);
				$('.twitter_usr').attr('href', 'http://twitter.com/?status='+encry_urlss);
				$('.google_usr').attr('href', 'http://plus.google.com/share?url='+encry_urlss);
				$('.linkedin_usr').attr('href', 'http://www.linkedin.com/cws/share?url='+encry_urlss+'&title='+encry_title);
				$('.stumbleupon_usr').attr('href', 'http://www.stumbleupon.com/submit?url='+encry_urlss+'&title='+encry_title);
				$('.tumblr_usr').attr('href', 'http://www.tumblr.com/share/link?url='+encry_urlss+'&name='+encry_title);
						
						
			
		}
	
	
	

	function showdescription (id) {
		//alert(id);
		var baseurl = getBaseURL()+'viewitemdesc/'+id;
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      success: function(responce){
		          //alert(responce);
		    		$('#invoice-popup-overlay').show();
		    		$('#invoice-popup-overlay').css("opacity", "1");
		          $('.invoice-popup').html(responce);
		      }
	    });
	}
	
	  function socialsharef(){
    	var short_urls = $("#short_urls").val();
		var title = 'Join with me';
			encry_urlss = encodeURIComponent(short_urls);
			encry_title = encodeURIComponent(title);
    	newwindow=window.open('http://www.facebook.com/sharer.php?s=100&p[title]='+encry_title+'&p[url]='+encry_urlss,'name','height=600,width=600');
	 }
	  function socialsharetwt(){
    	var short_urls = $("#short_urls").val();
		var title = 'Join with me';
			encry_urlss = encodeURIComponent(short_urls);
			encry_title = encodeURIComponent(title);
			newwindow=window.open('http://twitter.com/share?text='+encry_title+'&url='+encry_urlss,'name','height=600,width=600');
	 }
	 
	  
	  function socialshareg(){
	    	var short_urls = $("#short_urls").val();
			var title = 'Join with me';
				encry_urlss = encodeURIComponent(short_urls);
				encry_title = encodeURIComponent(title);
				newwindow=window.open('http://plus.google.com/share?url='+encry_urlss,'name','height=600,width=600');
		 }
	  
	  function socialsharel(){
	    	var short_urls = $("#short_urls").val();
			var title = 'Join with me';
				encry_urlss = encodeURIComponent(short_urls);
				encry_title = encodeURIComponent(title);
				newwindow=window.open('http://www.linkedin.com/cws/share?url='+encry_urlss+'&title='+encry_title,'name','height=600,width=600');
		 }
	  
	  function socialshares(){
	    	var short_urls = $("#short_urls").val();
			var title = 'Join with me';
				encry_urlss = encodeURIComponent(short_urls);
				encry_title = encodeURIComponent(title);
				newwindow=window.open('http://www.stumbleupon.com/submit?url='+encry_urlss+'&title='+encry_title,'name','height=600,width=600');
		 }
	  
	  function socialsharetum(){
	    	var short_urls = $("#short_urls").val();
			var title = 'Join with me';
				encry_urlss = encodeURIComponent(short_urls);
				encry_title = encodeURIComponent(title);
				newwindow=window.open('http://www.tumblr.com/share/link?url='+encry_urlss+'&name='+encry_title,'name','height=600,width=600');
		 }
	 
	  function usecreditamount(shopid,userid){
		  if($("#usecreditamount"+shopid).attr("checked")){
			  $('#popup_container').show();
			  $('#popup_container').css({"opacity":"1"});
			  $('#add-to-list-new').show();
			 // if(creditamnts == 0){  
			  
			  $('#usercreditamntchek').click(function(){
				  //creditamnts = 1;
				 var totalval = parseInt($('#ca'+shopid).val());
				 var totalshipp = parseFloat($('#totalshipp'+shopid).val());
				 var userentercreditamt = parseInt($('#userentercreditamt').val());
				 if(totalval >= userentercreditamt){
					 var totalitemcost = $('#totalitemcost'+shopid).val();
					 var credit_reduced = totalitemcost-userentercreditamt;
					 if(credit_reduced < 1){
						 alert('Item cost is low');
						 return false;
					 }	
					 var grandTotal = (credit_reduced+totalshipp).toFixed(2);
					  $("#Creditamnt"+shopid).show();
					  $("#Creditamnt_total"+shopid).show();
					  $("#availablee_credits").html(userentercreditamt);
					  $("#total_credits"+shopid).html(grandTotal);
					  $("#Creditamnt_totals"+shopid).hide();
					  
					  $('#popup_container').hide();
					  $('#popup_container').css({"opacity":"0"});
					  $('#add-to-list-new').hide();
				 }else{
					 alert('Enter the correct amount');
				 }
			  });
			  //creditamnts = 0;
		// }

		  }else{

			  $("#Creditamnt"+shopid).hide();
			  $("#Creditamnt_total"+shopid).hide();
			  $("#Creditamnt_totals"+shopid).show();
			  //alert('nnnn checked'+shopid);
		  }
	  }

	 function indcall(event) {
		var searchString = $('#search-query').val();
		//alert(searchString);
		var baseurl = getBaseURL();
		$(document).ready(function(){
			$("#content").hide();
			$("#thing").show();
		});
	
		window.location = baseurl+"searches/"+searchString;
			
	}
	  
	  
	  function itmcall(event) {
		var searchString = $('#searcheduser').val();
	
		var baseurl = getBaseURL();
	
		$("#itemlists").show();
		$("#thing").hide();
		$("#user").hide();
			
	}
	  
	  
	  function usrcall(event) {
		var searchString = $('#searcheduser').val();
		//alert(searchString);
		var baseurl = getBaseURL();
		
		
		$("#thing").hide();
		
		$("#user").show();
		$("#itemlists").hide();
	}

	function thingcall(event) {
		var searchString = $('#searcheduser').val();
		//alert(searchString);
		var baseurl = getBaseURL();
	
		$("#user").hide();
		$("#thing").show();
			
	}
	function show_comment() {
		$("#all").slideToggle('slow');
		$("#all").show();
		$("#show_all").hide();
		$("#hide_all").show();
	}
	function hided_comment() {
		$("#hide_all").hide();
		$("#show_all").show();
		$("#all").slideToggle('slow');
		$("#few").show();
	}
	
	function hideDiv() {
	   
	    document.getElementById("itemlists").style.display = 'none';  
	    document.getElementById("user").style.display = 'none';     
	}  
	function hideshop() {
		   
	    document.getElementById("shopshow").style.display = 'none';  
	      
	}  
	
	function hidediv() {		   
	    document.getElementById("feed").style.display = 'none';   	   
	}  
	
	function hotel_details() {
		
			$("#hotel").show();
		
		}
	function shownoti()
	{
		var BaseURL=getBaseURL();
		var loguserid = $('#loguserid').val();
		//var loadingimg = $('.loading').val();
		if(pushnoii){
			pushnoii=false; 
  			//alert(loguserid);
  			$.ajax({
  		      url: BaseURL+"getpushajax/",
  		      type: "post",
  		      data : { 'loginuserid': loguserid},
  		      dataType: "html",
  				beforeSend: function() {
  					$('.loading').show();
  					//$(button).attr("disabled", "disabled");
  				},
  		      success: function(responce){
  		    	  //alert(responce);
  		    	  $('.loading').hide();
  		    	  $('#pushappend').html(responce);
  		      }
  		});
		}
				
		$("#feed").show();
		  $(document).click(function() {
		 	    $('#feed').css("display", "none");
		 	});	
		 $("#noti").mouseout(function(){
				$("#feed").hide();
			}); 
		
	
	}

	
	

	function showcarthov()
	{
		var BaseURL=getBaseURL();
		if(cartnoii){
			cartnoii=false; 
  			$.ajax({
  		      url: BaseURL+"cartmousehover/",
  		      type: "post",
  		      //data : { 'loginuserid': loguserid},
  		      dataType: "html",
  				beforeSend: function() {
  					$('#loading_imgcart').show();
  				},
  		      success: function(responce){
  		    	  //alert(responce);
  		    	  $('#loading_imgcart').hide();
  		    	  $('#cartmousehoverval').html(responce);
  		      }
  		});
		}
	}
	
	
	
	
	
function greenfont(){
var hi=	$("#hi").html();
	 if(hi="Fantacy'd"){
		 $("#hi").html("edit");
	 }
	 $("#hi").mouseout(function(){
		  $("#hi").html("Fantacy'd");
		}); 
	
}
/* sathish for commision popup */
function commisiondetails()
 {
		
		$('#popupcommision').show();
		$('#popupcommision').css({"opacity":"1"});
	
		$('#commisionrate').show();
		$('#commisionrate').css({"opacity":"1"});
		$('#cornerdbutton').click(function(){
			
			$('#popupcommision').hide();
			
		});
		
 }
/* sathish for commision popup ended */


function getLatLong(kilometer){
	
  window.google = window.google || {};
  google.maps = google.maps || {};
  (function() {
  function getScript(src) {
  document.write('<' + 'script src="' + src + '"' +
  ' type="text/javascript"><' + '/script>');
  }
  var modules = google.maps.modules = {};
  google.maps.__gjsload__ = function(name, text) {
  modules[name] = text;
  };
  google.maps.Load = function(apiLoad) {
  delete google.maps.Load;
  apiLoad([0.009999999776482582,[[["http://mt0.googleapis.com/vt?lyrs=m@249000000\u0026src=api\u0026hl=en-US\u0026","http://mt1.googleapis.com/vt?lyrs=m@249000000\u0026src=api\u0026hl=en-US\u0026"],null,null,null,null,"m@249000000",["https://mts0.google.com/vt?lyrs=m@249000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.google.com/vt?lyrs=m@249000000\u0026src=api\u0026hl=en-US\u0026"]],[["http://khm0.googleapis.com/kh?v=145\u0026hl=en-US\u0026","http://khm1.googleapis.com/kh?v=145\u0026hl=en-US\u0026"],null,null,null,1,"145",["https://khms0.google.com/kh?v=145\u0026hl=en-US\u0026","https://khms1.google.com/kh?v=145\u0026hl=en-US\u0026"]],[["http://mt0.googleapis.com/vt?lyrs=h@249000000\u0026src=api\u0026hl=en-US\u0026","http://mt1.googleapis.com/vt?lyrs=h@249000000\u0026src=api\u0026hl=en-US\u0026"],null,null,null,null,"h@249000000",["https://mts0.google.com/vt?lyrs=h@249000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.google.com/vt?lyrs=h@249000000\u0026src=api\u0026hl=en-US\u0026"]],[["http://mt0.googleapis.com/vt?lyrs=t@132,r@249000000\u0026src=api\u0026hl=en-US\u0026","http://mt1.googleapis.com/vt?lyrs=t@132,r@249000000\u0026src=api\u0026hl=en-US\u0026"],null,null,null,null,"t@132,r@249000000",["https://mts0.google.com/vt?lyrs=t@132,r@249000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.google.com/vt?lyrs=t@132,r@249000000\u0026src=api\u0026hl=en-US\u0026"]],null,null,[["http://cbk0.googleapis.com/cbk?","http://cbk1.googleapis.com/cbk?"]],[["http://khm0.googleapis.com/kh?v=83\u0026hl=en-US\u0026","http://khm1.googleapis.com/kh?v=83\u0026hl=en-US\u0026"],null,null,null,null,"83",["https://khms0.google.com/kh?v=83\u0026hl=en-US\u0026","https://khms1.google.com/kh?v=83\u0026hl=en-US\u0026"]],[["http://mt0.googleapis.com/mapslt?hl=en-US\u0026","http://mt1.googleapis.com/mapslt?hl=en-US\u0026"]],[["http://mt0.googleapis.com/mapslt/ft?hl=en-US\u0026","http://mt1.googleapis.com/mapslt/ft?hl=en-US\u0026"]],[["http://mt0.googleapis.com/vt?hl=en-US\u0026","http://mt1.googleapis.com/vt?hl=en-US\u0026"]],[["http://mt0.googleapis.com/mapslt/loom?hl=en-US\u0026","http://mt1.googleapis.com/mapslt/loom?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt?hl=en-US\u0026","https://mts1.googleapis.com/mapslt?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt/ft?hl=en-US\u0026","https://mts1.googleapis.com/mapslt/ft?hl=en-US\u0026"]]],["en-US","US",null,0,null,null,"http://maps.gstatic.com/mapfiles/","http://csi.gstatic.com","https://maps.googleapis.com","http://maps.googleapis.com"],["http://maps.gstatic.com/intl/en_us/mapfiles/api-3/15/8","3.15.8"],[202022107],1,null,null,null,null,0,"",null,null,0,"http://khm.googleapis.com/mz?v=145\u0026",null,"https://earthbuilder.googleapis.com","https://earthbuilder.googleapis.com",null,"http://mt.googleapis.com/vt/icon",[["http://mt0.googleapis.com/vt","http://mt1.googleapis.com/vt"],["https://mts0.googleapis.com/vt","https://mts1.googleapis.com/vt"],[null,[[0,"m",249000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[47],[37,[["smartmaps"]]]]],0],[null,[[0,"m",249000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[47],[37,[["smartmaps"]]]]],3],[null,[[0,"m",249000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[50],[37,[["smartmaps"]]]]],0],[null,[[0,"m",249000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[50],[37,[["smartmaps"]]]]],3],[null,[[4,"t",132],[0,"r",132000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[5],[37,[["smartmaps"]]]]],0],[null,[[4,"t",132],[0,"r",132000000]],[null,"en-US","US",null,18,null,null,null,null,null,null,[[5],[37,[["smartmaps"]]]]],3],[null,null,[null,"en-US","US",null,18],0],[null,null,[null,"en-US","US",null,18],3],[null,null,[null,"en-US","US",null,18],6],[null,null,[null,"en-US","US",null,18],0],["https://mts0.google.com/vt","https://mts1.google.com/vt"],"/maps/vt"],2,500], loadScriptTime);
  };
  var loadScriptTime = (new Date).getTime();
  getScript("http://maps.gstatic.com/intl/en_us/mapfiles/api-3/15/8/main.js");
  })(); 
	
	var BaseURL=getBaseURL();
	//alert(kilometer);
	var lat;
	var lon;
	  // Try HTML5 geolocation
	  if(navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(function(position) {
	      var pos = new google.maps.LatLng(position.coords.latitude,
	                                       position.coords.longitude);
	      	//alert(pos);
			lat = pos.lat();
			lon = pos.lng();
			//alert(lat);
			//alert(lon);
			//alert(BaseURL+"tes?lat"+lat+"long"+lon);
			window.location.href=BaseURL+"nearme?lat="+lat+"&long="+lon+"&kilometer="+kilometer;
			
	    });
	  }else{
		  alert('Browser not support Geo Location');
	  }
	  
}



function sellerloc(latt,longg) {
	

	
ll = new google.maps.LatLng(latt, longg);
zoom=10;
var mO = {
scaleControl:true,
zoom:zoom,
zoomControl:true,
zoomControlOptions: {style:google.maps.ZoomControlStyle.LARGE},
center: ll,
disableDoubleClickZoom:true,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
map = new google.maps.Map(document.getElementById("map"), mO);
map.setTilt(0);
map.panTo(ll);
marker = new google.maps.Marker({position:ll,map:map,draggable:true,title:'Marker is Draggable'});   

if(navigator.appName == 'Microsoft Internet Explorer'){}
else
{
google.maps.event.addListener(marker, 'click', function(mll) {
gC(mll.latLng);
var html= "<div style='color:#000; background-color:#fff; padding:3px;'><p>Latitude - Longitude:<br />" + String(mll.latLng.toUrlValue()) + "<br /><br />Lat: " + ls +  "&#176; " + lm +  "&#39; "  + ld + "&#34;<br />Long: " + lgs +  "&#176; " + lgm +  "&#39; " + lgd + "&#34;</p></div>";
iw = new google.maps.InfoWindow({content:html});
iw.open(map,marker);
});
google.maps.event.addListener(marker, 'dragstart', function() {if (iw){iw.close();}});
}

google.maps.event.addListener(marker, 'dragend', function(event) {
posset = 1;
if (map.getZoom() < 10){map.setZoom(10);}
map.setCenter(event.latLng);
computepos(event.latLng);
});

google.maps.event.addListener(map, 'click', function(event) {
posset = 1;
fc(event.latLng) ;
if (map.getZoom() < 10){map.setZoom(10);}
map.panTo(event.latLng);
computepos(event.latLng);
});

}

	

