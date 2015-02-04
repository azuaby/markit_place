var $ = jQuery.noConflict();
var BaseURL=getBaseURL();
$(document).ready(function(){
	
	$('#commission_type').on('change', function() {
		var currency_sym = 	$('#commission_type').val();
		if(currency_sym == '$') {
		$('.currency_symbol').text('$');
		}
		else if(currency_sym == '%') {
		$('.currency_symbol').text('%');
		}
	});
	
	
	$('#coupontype').on('change', function() {
		var currency_sym = 	$('#coupontype').val();
		if(currency_sym == 'fixed') {
		$('.currency_symbol').text('$');
		}
		else if(currency_sym == 'percent') {
		$('.currency_symbol').text('%');
		}
	});
	
	
	$('#generate_coupon').click(function(){
		//alert('Welcome');
		var baseurl = getBaseURL()+'admin/generatecoupons/';
		if (invajax == 0) {
			invajax = 1;
			$.ajax({
			      url: baseurl,
			      type: "post",
			      dataType: "html",
			      beforeSend: function () {
			    	  $('#loading_img').show();
			      },
			      success: function(responce){
			          //alert(responce);
			          $('#couponcodes').val(responce);
			    	  $('#loading_img').hide();
			          invajax = 0;
			      }
			    });
		}
	});
	
	
	$('#select_merchant').bind('change keyup', function(){
		if($(this).val() == 0)
		{	
			$('#invoice-popup-overlayss').hide();
			$('#invoice-popup-overlayss').css("opacity", "0");
		}
		else
		{
			$('#invoice-popup-overlayss').show();
			$('#invoice-popup-overlayss').css("opacity", "1");
		}
		
		
		
		$('#save_merchant').click(function(){
			$('#invoice-popup-overlayss').hide();
			$('#invoice-popup-overlayss').css("opacity", "0");
			
		});
		
		
	});
	
	
});

$('#amountss , #couponrange').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});


$('#start_range, #end_range').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9.]/g, function(str) { return ''; } ) );
});

$('#shippingPrice, #Category_name').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});

$(document).ready(function(){
	if($('#commission_type').val() == '$') {
		$('.currency_symbol').text('$');
		}
		else if($('#commission_type').val() == '%') {
		$('.currency_symbol').text('%');
		}
	
	/*$('#usersrchSrch').keyup(function() {
		 var value1 = $('#usersrchSrch').val();
		 $.ajax({
				type: "post",		// Request method: post, get
				url: BaseURL+"admin/user/management/"+value1,	// URL to request
				dataType: "html",	// Expected response type
				success: function(response, status) {
//					alert(value1);
					$('#search_user1').html(response);
				},
				error: function(response, status) {
					alert('An unexpected error has occurred!');
				}
			});

			return false;
		});
	*/
	
	

	$('#srchItms').click(function(){
		var startddates = $('#deal-start').val();
		var endDates = $('#deal-end').val();
		/*if(startddates>endDates){
			alert('End date must be greater');
			return false;
		}*/
		
		var serchkeywrd = $('#serchkeywrd').val();		
		var baseurl = getBaseURL()+'admin/searchitemkeyword/';
		if (invajax == 0) {
			invajax = 1;
			$.ajax({
			      url: baseurl,
			      type: "post",
			      dataType: "html",
			      data : { 'startdate': startddates,'enddate': endDates,'serchkeywrd': serchkeywrd},
			      //data: "startdate:"+startddates+"enddate:"+endDates+"serchkeywrd:"+serchkeywrd,
			      beforeSend: function () {
			    	  $('#loading_img').show();
			      },
			      success: function(responce){
			          //alert(responce);
			          $('#searchite').html(responce);
			    	  $('#loading_img').hide();
			          invajax = 0;
			      }
			    });
		}
	});
	
	$('#srchSeller').click(function(){
		var serchkeywrd = $('#serchkeywrd').val();		
		var baseurl = getBaseURL()+'admin/searchsellerkeyword/';
		if (invajax == 0) {
			invajax = 1;
			$.ajax({
			      url: baseurl,
			      type: "post",
			      dataType: "html",
			      data : {'serchkeywrd': serchkeywrd},
			      beforeSend: function () {
			    	  $('#loading_img').show();
			      },
			      success: function(responce){
			          //alert(responce);
			          $('#userdata').html(responce);
			    	  $('#loading_img').hide();
			          invajax = 0;
			      }
			    });
		}
	});
	
	
	
	var flashMessage = $('#flashMessage');
	flashMessage.load();
		setTimeout(function() {
		  $('#flashMessage').fadeOut('slow');
		}, 5000);
		
		
		//$('.dropdown-toggle').dropdown();
		$("#myTable").tablesorter(); 
		
	$('.appliform').blur(function(){
		// $(".vld_eml").hide();
		var val = $('#'+$(this).attr('id')).val();
		// alert(val);
		if(val != ''){
			$('#error_'+$(this).attr('id')).hide();
		}else{
			$('#error_'+$(this).attr('id')).show();
		}
		$('.'+$(this).attr('id')).hide();
		
		var name = $(this).attr('name');
		// alert(name);
		if(name=='data[appli][emailaddress]'){
			// alert('email');
			var emails = $(this).val();
			// alert(x);
			if(emails != ''){
				if(!isValidEmailAddress(emails)){
					alert("Enter valid email, otherwise the email not sent if needed");
				}
			}	
		}
		/* var name = $(this).attr('name');
		if(name=='data[email]')
		{
		var x = $('#'+$(this).attr('id')).val();
		if(x!= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
		{
		
		}
		
		} */
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
	$('.appliform').change(function(){
		var val = $('#'+$(this).attr('id')).val();
		if(val != ''){
			$('#error_'+$(this).attr('id')).hide();
		}else{
			$('#error_'+$(this).attr('id')).show();
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
	$('#couponform').submit(function(){
		var couponcodes = $('#couponcodes').val();
		var couponrange = $('#couponrange').val();
		var coupontype = $('.coupontype').val();
		
		
		
		if(couponcodes == ''){
			alert('Please enter the Coupon code');
			return false;
		}
		if(couponrange == ''){
			alert('Please enter the Coupon Range');
			return false;
		}
		if(coupontype == ''){
			alert('Please enter the Coupon Type');
			return false;
		}
	});
	
	
	
	
	
	
	
	
	
	
	/* Login Form */
	$('#loginform').submit(function(){
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
	
	/* User creation Form */
	$('#useraccount').submit(function(){
		var name = $('#name').val();
		var email = $('#emailid').val();
		var types = $('#types').val();
		if(name == ''){
			alert('Please enter the username');
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
		if(types == ''){
			alert('Please select user type');
			return false;
		}
	});
	
	
	/* Site setting creation form */
	$('#siteform').submit(function(){
		var name = $('#site_name').val();
		var tempowner = $('#site_title').val();
		var temptypes1 = $('#meta_key').val();
		var tempversion = $('#meta_desc').val();
		var welcome_email = $('.welcome_email').val();
		var signup_active = $('.signup_active').val();
		var notification_email = $('#notification_email').val();
		var support_email = $('#support_email').val();
		var noreply_name = $('#noreply_name').val();
		var noreply_email = $('#noreply_email').val();
		// alert(signup_active);

		if(name == ''){
			alert('Please enter the Site Name');
			return false;
		}
		if(tempowner == ''){
			alert('Please enter the Site Title');
			return false;
		}
		if(temptypes1 == ''){
			alert('Please select the Meta keyword');
			return false;
		}
		if(tempversion == ''){
			alert('Please select the Description');
			return false;
		}
		if(welcome_email == undefined){
			alert('Please select the Welcome email choice');
			return false;
		}		
		if(signup_active == undefined){
			alert('Please select the Signup Active choice');
			return false;
		}
		if(notification_email == ''){
			alert('Please select the e-mal for notifications');
			return false;
		}
		if(support_email == ''){
			alert('Please select the support email');
			return false;
		}
		if(!(isValidEmailAddress(support_email))){
			alert('Enter The Valid support email');
			return false;
		}
		if(noreply_name == ''){
			alert('Please enter the no-reply name');
			return false;
		}
		if(noreply_email == ''){
			alert('Please enter the no-reply email');
			return false;
		}
		if(!(isValidEmailAddress(noreply_email))){
			alert('Enter The Valid no-reply email');
			return false;
		}
		
		// return false;
	});
	
	$('#bannerform').submit(function(){
		var banner_name = $('#banner_name').val();
		var html_source = $('#html_source').val();
		var about_adv = $('#about_adv').val();
		var start_date = $('#startDate').val();
		var end_date = $('#endDate').val();
		var status = $('.status').val();
		
		if(banner_name == ''){
			$('#alert').show().html('Please enter the banner name');
			return false;
		}
		if(html_source == ''){
			$('#alert').show().html('Please enter the Html Source');
			return false;
		}
		if(about_adv == ''){
			$('#alert').show().html('Please enter the About Advertisement');
			return false;
		}
		if(start_date == ''){
			$('#alert').show().html('Please enter the Start Date');
			return false;
		}
		if(end_date == ''){
			$('#alert').show().html('Please enter the End Date');
			return false;
		}
		//alert(start_date);
		//alert(end_date);
		if(start_date > end_date){
			$('#alert').show().html('The start date can not be greater then the end date');
			return false;
		}
		/*if(start_date > end_date){
			$('#alert').show().html('The end date can not be less then the start date');
			return false;
		}*/
		if(status == undefined){
			$('#alert').show().html('Please Select the status');
			return false;
		}		
	});
	
	/* news form */
	$('#newsform').submit(function(){
		var title = $('#title').val();
		var summary = $('#summary').val();
		var description = $('#description').val();
		var status = $('.status').val();
		
		if(title == ''){
			$('#alert').show().html('Please enter the News Title');
			return false;
		}
		if(summary == ''){
			$('#alert').show().html('Please enter the News Summary');
			return false;
		}
		if(description == ''){
			$('#alert').show().html('Please enter the News Description');
			return false;
		}
		if(status == undefined){
			$('#alert').show().html('Please Select the status');
			return false;
		}
		
		
	});
	
	$(".catchnge").change(function(){
		var mainsel = $("#mainsec").val();
		if(mainsel == ''){
			$(".show_hid").hide();
		}else{
			$(".show_hid").show();
		}
	});
	
		/* invoice popup */
	
	$('#btn_close, .inv-close').live ('click' ,function(){
		$('#invoice-popup-overlay').invisible();
		$('#invoice-popup-overlay').css("opacity", "0");
		
	});
	
	$('#invoice-popup-overlay, .inv-close').live ('click',function(){
		$('#invoice-popup-overlay').show();
		$('#invoice-popup-overlay').css("opacity", "1");
	});
	
	$('#invoice-popup-overlay, .inv-close').live ('keyup',function(e){
		if (e.keyCode == 27) 
		  { 
		     $('#invoice-popup-overlay').invisible();
		     $('#invoice-popup-overlay').css("opacity", "0");
		  }   // esc
		});
	
	$('#invoice-popup-overlay').keydown(function(e) {
		if(e.keyCode == 27) {
		window.close();
		}
	});
	
	$("#cate_id").change(function(){
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
				$("#categ-container-2 label").removeClass('invisible');
				$("#categ-selectbx-2").html(items); 
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
				  items+="<option value='"+cate.ID+"'>"+cate.Name+"</option>";
				});
				$("#categ-container-3").removeClass('inactive');
				$("#categ-container-3 label").removeClass('invisible');
				$("#categ-selectbx-3").html(items); 
			});
		}else{
			$("#categ-container-3").addClass('inactive');
			$("#categ-container-3 label").addClass('invisible');
			$("#categ-selectbx-3").html(''); 
		}		
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
		// alert(lctn);
		// alert(lctn_name);
		if ($('#shpng_div tbody tr').hasClass(lctn)){
			$('.shippingcountryerror').html("Country already exist");
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
					htms += '$';
					htms += '<input type="text" value="" class="money text text-small input-small" name="country_shipping['+lctn+']['+incrmt_val+'][primary]">';
				htms += '</div>';
			htms += '</td>';  
			htms += '<td class="input-group-close">';
				htms += '<div class="shippingClose input-group input-group-price price-input primary-shipping-price"><a class="remove" href="javascript:void(0)" id='+lctn+'></a></div>';
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
	
});
var invajax = 0;
/* Add category Form */
function addform(){
	var html = '<label>Add Sub of Sub category</label><br /><input name="data[Category][categoryname_2]" id="Category_names" class="inputform" type="text" />';
	$("#forms").html(html);
	$('.deletfrm').show();
	$(".show_hid").hide();
	
}

function removeimg(val){
	$('#image_computer_'+val).val('');
	$('#show_url_'+val).attr({src: "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"});
	$('#removeimg_'+val).hide();
}

function Price_range(){
	//alert('hai');
	$('.adminitemerror').html('');
	var price1 = $(".inputform1").val();
	var price2 = $(".inputform2").val();
	
	if(price1 > price2){
		alert("Give Correct Price Range");
		
	}
	else
		{
		$.ajax({
		      url: BaseURL+"admins/addprice/"+price1+"/"+price2,
		      type: "post",
		      dataType: "html",
		      success: function(){
		         
				//$("#del_"+Id).remove();
		    	 
				}
		      
			});
		}
}


function commisionRange(){
	//alert('hai');
	$('.adminitemerror').html('');
	var price1 = $('#minrange').val();
	var price2 = $('#maxrange').val();
	//alert(price1);
	
	if(price1 > price2){
		alert("Give Correct Price Range");
		
	}
	else
		{
		
		}
}

function validate(){
	$('.adminitemerror').html('');
	$('.form-error').html('');
	var img0  = $("#image_computer_0").val();
	var img1  = $("#image_computer_1").val();
	var img2  = $("#image_computer_2").val();
	var img3  = $("#image_computer_3").val();
	var check = 0;
	if($('#cate_id').val() == '') {
		$('.cat-error').html('Select Category');
		check = 1;
	}
	if($('#categ-selectbx-2').val() == '') {
		$('.subcat-error').html('Select Sub Category');
		check = 1;
	}
	if($('.itemtitle').val() == '') {
		$('.title-error').html('Item Title cannot be empty');
		check = 1;
	}
	if($('#description').val() == '') {
		$('.description-error').html('Description cannot be empty');
		check = 1;
	}
	if($('#price').val() == '') {
		$('.price-error').html('Item Price cannnot be empty');
		check = 1;
	}
	if($('#quantity').val() == '') {
		$('.qty-error').html('Item Quantity cannnot be empty');
		check = 1;
	}
	if($('#processing-time-id').val() == '') {
		$('.proc-error').html('Select Processing Time');
		check = 1;
	}
	if($('#selct_lctn_bxs').val() == '') {
		$('.shipfrom-error').html('Select atleast one Ships from location');
		check = 1;
	}
	if(img0 == '' && img1 == '' && img2 == '' && img3 == ''){
		$('.photo-error').html('Please add atleast one photo');
		check = 1;
	}
	if (check == 1) {
		$('.form-error').html("please fill all the details");
		return false;
	}
	return true;
}

function paypalactive(){
    var normalid = $("#PaypalmodePaypalnormal");
    var normal = (normalid.attr("checked") != "undefined" && normalid.attr("checked") == "checked");
    if (normal) {
    	$("#paypal_api_userid").attr("disabled",true);
    	$("#paypal_api_password").prop('disabled', true);
    	$("#paypal_api_signature").prop('disabled', true);
    	$("#paypal_application_id").prop('disabled', true);
    }else {
    	$("#paypal_api_userid").removeAttr("disabled");
    	$("#paypal_api_password").prop('disabled', false);
    	$("#paypal_api_signature").removeAttr("disabled", "disabled");
    	$("#paypal_application_id").removeAttr("disabled", "disabled");
    }
}

function addformss(){
	var sub_cat_names = $("#Category_names").val();
	var html = '<label>Add Sub of Sub category</label><br /><input name="data[Category][categoryname_2]" value="'+sub_cat_names+'" id="Category_names" class="inputform" type="text" />';
	$("#forms").html(html);
	$('.deletfrm').show();
	$(".show_hid").hide();
	
}

/* Delete category Form */
function deleteform(){
	$("#forms").html('');
	
	$('.deletfrm').hide();
	
	var mainsel = $("#mainsec").val();
	if(mainsel == ''){
		$(".show_hid").hide();
	}else{
		$(".show_hid").show();
	}
}


/* user and user corressponding details delete  */
function deleteusrlists(uid){
	//alert(BaseURL+'deleteusrdetls');
	
	if (confirm("Are you sure you want to delete this User? ")) {
		$.post(BaseURL+'admin/user/deleteusrdetls/', { "uid": uid},
			function(data) {
				$("#del_"+uid).remove();

			}
		);
	
	}
	return false;	
}





function deletecommision(Id) {
	$baseurl = getBaseURL();
	//$eleid = "#curr"+Id;
	
	if(confirm("Are you sure want to delete this Item")) {
	$.ajax({
      url: $baseurl+"admin/deletecommission/"+Id,
      type: "post",
      dataType: "html",
      success: function(){
      
		$("#del_"+Id).remove();
    	 
      },
      error:function(){
          alert("An unexpected error has occurred!");
      }   
    });
	}
}

/* banner delete */
function bannerdelete(id){
	// alert(id);
	
	if (confirm("Are you sure you want to delete this banner? ")) {
		$.post(BaseURL+'bannerdeletes', { "id": id},
			function(data) {
				$("#del_"+id).remove();

			}
		);
	
	}
	return false;	
}


function pricedelete(id){
	//alert(id);
	
	if (confirm("Are you sure you want to delete this Price? ")) {
		$.post(BaseURL+'deleteprice', { "id": id},
			function(data) {
				$("#del_"+id).remove();

			}
		);
	
	}
	return false;	
}

function deletecolor(id){
	//alert(id);
	
	if (confirm("Are you sure you want to delete this Color? ")) {
		$.post(BaseURL+'deletecolor', { "id": id},
			function(data) {
				$("#del_"+id).remove();

			}
		);
	
	}
	return false;	
}

function deletecoupon(id){
	//alert(id);
	if (confirm("Are you sure you want to delete this Coupon? ")) {
		$.post(BaseURL+'deletecoupon', { "id": id},
			function(data) {
				$("#del_"+id).remove();

			}
		);
	
	}
	return false;	
}

/* News delete */
function newsdelete(id){
	// alert(id);	
	if (confirm("Are you sure you want to delete this News? ")) {
		$.post(BaseURL+'newsdeletes', { "id": id},
			function(data) {
				$("#del_"+id).remove();

			}
		);
	
	}
	return false;	
}

/* front end js */


function signform(){
	var data = $('#signupform').serialize();
	var firstname=$('#firstname').val();
	var lastname=$('#lastname').val();
	var email=$('#email').val();
	var signupGender = $('.genderradio:checked').val();
	var city=$('#regcity').val();
	var signupDay=$('#signupDobDay').val();
	var signupMonth=$('#signupDobMonth').val();
	var signupYear=$('#signupDobYear').val();
	var password=$('#password').val();
	var rpassword=$('#rpassword').val();
	// alert(signupGender);
	if(firstname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor digitar primeiro nome');
		$("#alert").append(newdiv);
		return false;
	}
	if(lastname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor digitar ultimo nome');
		$("#alert").append(newdiv);
		return false;
	}
	if(email == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor digitar e-mail');
		$("#alert").append(newdiv);
		return false;
	}
	if(!(isValidEmailAddress(email))){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Digite um e-mail válido');
		$("#alert").append(newdiv);
		return false;
	}
	if(!signupGender){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor selecionar o sexo');
		$("#alert").append(newdiv);
		return false;
	}
	if(city == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor digitar o cidade');
		$("#alert").append(newdiv);
		return false;
	}
	if(signupDay == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor escolher o dia');
		$("#alert").append(newdiv);
		return false;
	}
	if(signupMonth == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor escolher o mês');
		$("#alert").append(newdiv);
		return false;
	}
	if(signupYear == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor escolher o ano');
		$("#alert").append(newdiv);
		return false;
	}
	if(password == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Favor digitar sua senha');
		$("#alert").append(newdiv);
		return false;
	}
	if(password.length < 6){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Senha deve ter mais que 5 caracteres.');
		$("#alert").append(newdiv);
		return false;
	}
	if(rpassword == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Confirmação da senha não pode estar vazia!');
		$("#alert").append(newdiv);
		return false;
	}
	if(password != rpassword){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Senha e confirmação de senha não estão iguais!');
		$("#alert").append(newdiv);
		return false;
	}
	// $('.popupContact2').hide();
	//$(".app_event").css({"opacity" : "0.4"})
      //                  .fadeIn("slow");
	$('#signupform').submit();
	
}

function adduserform(){
	var data = $('#adduserform1').serialize();
	var firstname=$('#firstname').val();
	var username=$('#username').val();
	var lastname=$('#lastname').val();
	var usr_access=$('#usr_access').val();
	var email=$('#email').val();
	var password=$('#password').val();
	var rpassword=$('#rpassword').val();
	//alert(firstname);
	if(firstname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the first name');
		$("#alert").append(newdiv);
		return false;
	}
	if(lastname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the last name');
		$("#alert").append(newdiv);
		return false;
	}
	if(username == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the user name');
		$("#alert").append(newdiv);
		return false;
	}
	if(usr_access == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the User Status');
		$("#alert").append(newdiv);
		return false;
	}
	if(email == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the e-mail');
		$("#alert").append(newdiv);
		return false;
	}
	if(!(isValidEmailAddress(email))){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the valid e-mail');
		$("#alert").append(newdiv);
		return false;
	}
	if(password == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the password');
		$("#alert").append(newdiv);
		return false;
	}
	if(password.length < 6){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Password Should be atleast 5 characters');
		$("#alert").append(newdiv);
		return false;
	}
	if(rpassword == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the Confirm password');
		$("#alert").append(newdiv);
		return false;
	}
	if(password != rpassword){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Password does not match');
		$("#alert").append(newdiv);
		return false;
	}
	$('#adduserform1').submit();
	
}




function chngeadmindet(){
	var data = $('#adduserform1').serialize();
	var firstname=$('#firstname').val();
	var username=$('#username').val();
	var lastname=$('#lastname').val();
	var email=$('#email').val();
	var password=$('#password').val();
	var rpassword=$('#rpassword').val();
	//alert(firstname);
	if(firstname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the first name');
		$("#alert").append(newdiv);
		return false;
	}
	if(lastname == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the last name');
		$("#alert").append(newdiv);
		return false;
	}
	if(username == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the user name');
		$("#alert").append(newdiv);
		return false;
	}
	if(email == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the e-mail');
		$("#alert").append(newdiv);
		return false;
	}
	if(!(isValidEmailAddress(email))){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the valid e-mail');
		$("#alert").append(newdiv);
		return false;
	}
	/*if(password == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the password');
		$("#alert").append(newdiv);
		return false;
	}
	if(password.length < 6){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Password Should be atleast 5 characters');
		$("#alert").append(newdiv);
		return false;
	}
	if(rpassword == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the Confirm password');
		$("#alert").append(newdiv);
		return false;
	}
	if(password != rpassword){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Password does not match');
		$("#alert").append(newdiv);
		return false;
	}*/
	$('#adduserform1').submit();
	
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
		return baseURL + "/"; 
	}
}

function search_func(){ 

		 var value1 = $('#usersrchSrch').val();
		 if(value1.length>2 || value1.length == 0){
		 $.ajax({
				type: "post",		// Request method: post, get
				url: BaseURL+"admin/user/searchmgmt/"+value1,	// URL to request
				dataType: "html",	// Expected response type
				success: function(response, status) {
					$('#userdata').html(response);
					
				},
				error: function(response, status) {
					alert('An unexpected error has occurred!');
				}
			});
}

			return false;
	
}
function changeItemStatus(itemId,state){
	$baseurl = getBaseURL();
	$eleid = "#status"+itemId;
	//alert($eleid);
		$.ajax({
	      url: $baseurl+"items/change_item_status/"+itemId+"/"+state,
	      type: "post",
	      dataType: "html",
	      success: function(responce){
	          //alert(responce);
	          $($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
}

function changeCurrencyStatus(itemId,state){

	$baseurl = getBaseURL();
	$eleid = "#status"+itemId;
	//alert($eleid);
		$.ajax({

	      url: $baseurl+"admins/change_currency_status/"+itemId+"/"+state,
	      type: "post",
	      dataType: "html",
	      success: function(responce){
		
	         // alert(responce);
	          $($eleid).html(responce);
	      },
	      error:function(){
	          //alert("An unexpected error has occurred!");
	      }   
	    }); 
}

function currencyCode()
	{
		$baseurl=getBaseURL();
		var currency = $('#currency_code').val();
		//alert(currency);
  			$.ajax({

  		      url: $baseurl+"admins/currency_code/"+currency,
  		      type: "post",
		      datatype: "html",
  		      
  		      success: function(responce){
  		    	// alert("hai");
  		    	  
  		      }
  		});
	}

function markfeature(itemId){
	$baseurl = getBaseURL();
	var remember = document.getElementById('featured'+itemId);
	  if (remember.checked){
	    //alert("checked") ;
	    var status = 1;
	  }else{
	    //alert("You didn't check it! Let me check it for you.");
	    var status = 0;
	  }
	  $.ajax({
	      url: $baseurl+"featureditem",
	      type: "post",
	      data: {'itemid': itemId, 'status': status},
	      dataType: "html",
	      success: function(responce){
	          //alert(responce);
	          //$($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
}

function deleteItem(itemId) {
	//alert(itemId);
	$baseurl = getBaseURL();
	$eleid = "#item"+itemId;
	if(confirm("Are you sure want to delete this Item")) {
	$.ajax({
      url: $baseurl+"items/delete_item_admin/"+itemId,
      type: "post",
      dataType: "html",
      success: function(responce){
          //alert(responce);
    	  if (responce == 'false') {
    		  alert('Unable to process now');
    	  }else {
              $($eleid).remove();
    	  }
      },
      error:function(){
          alert("An unexpected error has occurred!");
      }   
    });
	}
}

     /* saravana pandian */

function deleteCurrency(Id) {
	$baseurl = getBaseURL();
	//alert($baseurl);
	$eleid = "#curr"+Id;
	
	if(confirm("Are you sure want to delete this Currency")) {
	$.ajax({
      url: $baseurl+"delete_currency_admin/"+Id,
      type: "post",
      dataType: "html",
      success:function(data){
        
	     $($eleid).remove();
		//$("#del_"+Id).remove();
      	},
      error:function(){
          alert("An unexpected error has occurred!");
      }   
    });
	}
}



function deleteCategory (catId) {
	$baseurl = getBaseURL();
	$eleid = "#catgy"+catId;
	//alert($eleid);
	if(confirm("Are you sure want to delete this Category")) {
	$.ajax({
      url: $baseurl+"delete_category_admin/"+catId,
      type: "post",
      dataType: "html",
      success: function(){
		
          $($eleid).remove();
      },
      error:function(){
          alert("An unexpected error has occurred!");
      }   
    });
	}
}

function changeSellerStatus (userId, status) {
	$baseurl = getBaseURL();
	$eleid = "#status"+userId;
		$.ajax({
	      url: $baseurl+"admins/change_seller_status/"+userId+"/"+status,
	      type: "post",
	      dataType: "html",
	      success: function(responce){
	          //alert(responce);
	          $($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    });
}

function sellersignupfrm(){
	var check = 0;
	
	if($('#brand_name').val() == '') {
		$('.brand_name-error').html('Brand Name Cannot be Empty');
		check = 1;
	}
	if($('#merchant_name').val() == '') {
		$('.merchant_name-error').html('Brand Full Name Cannot be Empty');
		check = 1;
	}
	if($('#paypalId').val() == '') {
		$('.paypalId-error').html('Email Id Cannot be Empty');
		check = 1;
	}
	if($('#person_phone_number').val() == '') {
		$('.person_phone_number-error').html('Phone No. Cannot be Empty');
		check = 1;
	}
	if($('#officeaddress').val() == '') {
		$('.officeaddress-error').html('office Address Cannot be Empty');
		check = 1;
	}
	if($('#mpowerid').val() == '') {
		$('.mpowerid-error').html('Mpowerpayment Id Cannot be Empty');
		check = 1;
	}
	if($('#longid').val() == '') {
		$('.longid-error').html('Longitude Cannot be Empty');
		check = 1;
	}
	if($('#latid').val() == '') {
		$('.latid-error').html('Lattitude Cannot be Empty');
		check = 1;
	}
	if (check == 1) {
		$('.form-error').html("please fill all the details");
		return false;
	}
	return true;
}

function changeUserStatus (userId, status) {
	$baseurl = getBaseURL();
	$eleid = "#status"+userId;
		$.ajax({
	      url: $baseurl+"admins/change_user_status/"+userId+"/"+status,
	      type: "post",
	      dataType: "html",
	      success: function(responce){
	          //alert(responce);
	          $($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    });
}

function showInvoicePopup (id) {
	//alert(id);
	var baseurl = getBaseURL()+'admin/viewinvoice/'+id;
	var element = '.inv-loader-'+id;
	/*var popup = window.open('');
	$(popup.document).on('keydown', function(e) {
  	  if(e.keyCode == 27) {
  		 popup.close();
  	  }
    });*/
	if (invajax == 0) {
		invajax = 1;
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      before: function(){
		    	 $(element).show(); 
		      },
		      success: function(responce){
		          //alert(responce);
		    	  $(element).hide(); 
		    	  $('.moreactionlistmyord'+id).slideToggle();
		    		$('#invoice-popup-overlay').show();
		    		$('#invoice-popup-overlay').css("opacity", "1");
		          $('.invoice-popup').html(responce);
		          
		          invajax = 0;
		          
		      }
		    });
	}
}

/*
function checkout (itemids,merchid,shipamt) {
	$baseurl = getBaseURL();
	var addrid = '#address-cart'+merchid;
	var shippingid = $(addrid).val();
	$.ajax({
	      url: $baseurl+"checkout/",
	      type: "post",
	      data : { 'item_id': itemids,'shippingid': shippingid,'shipamt': shipamt},
	      dataType: "html",
	      success: function(responce){
	    	  $('#paypalfom').html(responce);
	    	  $('#paypal').submit();
	      }
	});
}*/


function checkouttomer (merchname,price,orderid) {
	$baseurl = getBaseURL();
	//alert(merchname);
	//alert(orderid);
	var currencyid = '#currency'+orderid;
	var currency = $(currencyid).val();
	$.ajax({
	      url: $baseurl+"paytomerchant/",
	      type: "post",
	      data : { 'merchname': merchname,'price': price,'orderid': orderid, 'currency': currency},
	      dataType: "html",
	      success: function(responce){
	    	  $('#paypalfom').html(responce);
	    	  $('#paypal').submit();
	      }
	});
}





function search_func(){

	 var value1 = $('#usersrchSrch').val();
	 if(value1.length>2 || value1.length == 0){
	 $.ajax({
			type: "post",		// Request method: post, get
			url: BaseURL+"admin/user/searchmgmt/"+value1,	// URL to request
			dataType: "html",	// Expected response type
			success: function(response, status) {
				$('#userdata').html(response);
				
			},
			error: function(response, status) {
				alert('An unexpected error has occurred!');
			}
		});
}

		return false;

}

function validateaddslider() {
	var image = $('#image_computer_0').val();
	var url = $('#sliderLink').val();
	var regexp = /^(ftp:\/\/|http:\/\/|https:\/\/)?(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!-\/]))?$/;
	$('.error').html("");
	
	if (image == ''){
		$('.sliderimageerror').html('Select a Image');
		return false;
	}else if (url != "" && !regexp.test(url)){
		$('.addurlerror').html("Enter a valid URL");
		return false;
	}else{
		return true;
	}
}

function validatelandingpage() {
	var slider = $('#sliders').val();
	var sliderheight = $('#sliderheight').val();
	var sliderbg = $('#sliderbg').val();
	var widget = $('#widgets').val();
	$('.error').html("");
	
	if (sliderheight == ''){
		$('.sliderheighterror').html('Enter slider height');
		return false;
	}else if (sliderbg == ""){
		$('.sliderbgerror').html("Enter slider background color");
		return false;
	}else if (slider == ""){
		$('.slidererror').html("Add atleast one slider");
		return false;
	}else if (widget == ""){
		$('.widgeterror').html("Select some widgets");
		return false;
	}else{
		return true;
	}
}

function sendpushnot(){
	var message = $('#message').val();
	$('.adminitemerror').html('');
	if (message == ''){
		$('.message-error').html('Enter a message to send');
		return false;
	}else{
		 $.ajax({
			type: "post",		// Request method: post, get
			url: BaseURL+"sendpushnot",	// URL to request
			data: {'messages':message},
			dataType: "html",	// Expected response type
			beforeSend: function(){
				$('.pushnotloader img').show();
			},
			success: function(response) {
				$('.pushnotloader img').hide();
				$('.message-success').html(response);
			}
		});
	}
}


