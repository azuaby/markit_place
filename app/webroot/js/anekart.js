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
			          var respon = $.trim(responce)
			          $('#couponcodes').val(respon);
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

$('#amountss, #couponrange, #commission').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});


$('#start_range, #end_range, #currency_rate').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9.]/g, function(str) { return ''; } ) );
});

$('#shippingPrice, #Category_name , #quantity').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});

$('#minrange, #maxrange , #comision').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});


$(' #color_name').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^A-Za-z]/g, function(str) { return ''; } ) );
});

//Author:Saravana pandian Date:19.05.2014 Reason:Not allowing special characters
$('#price').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9.]/g, function(str) { return ''; } ) );
});

$('#tags_Amt').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9.,]/g, function(str) { return ''; } ) );
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
	
	$('#srchnonItms').click(function(){
		var startddates = $('#deal-start').val();
		var endDates = $('#deal-end').val();
		/*if(startddates>endDates){
			alert('End date must be greater');
			return false;
		}*/
		
		var serchkeywrd = $('#serchkeywrd').val();		
		var baseurl = getBaseURL()+'admin/manage/searchnonapproveditems/';
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

	$('#srchAffiliate').click(function(){
		var startddates = $('#deal-start').val();
		var endDates = $('#deal-end').val();
		/*if(startddates>endDates){
			alert('End date must be greater');
			return false;
		}*/
		
		var serchkeywrd = $('#serchkeywrd').val();		
		var baseurl = getBaseURL()+'admin/searchaffiliate/';
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
	
	$('#srchnonapproveSeller').click(function(){
		var serchkeywrd = $('#serchkeywrd').val();		
		var baseurl = getBaseURL()+'admin/searchnonapproveseller/';
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
		var amountss = $('#amountss').val();
		
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
		if(amountss == ''){
			alert('Please enter the Discount Amount');
			return false;
		}
		if(amountss > 100){
			alert('Please Give Discount Amount in Below 100');
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
		var welcome_email = $('.welcome_email').val();
		var signup_active = $('.signup_active').val();
		

		if(name == ''){
			alert('Please enter the Site Name');
			return false;
		}
		if(tempowner == ''){
			alert('Please enter the Site Title');
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
		
	});
	
	$('#mediaform').submit(function(){
		
		var temptypes1 = $('#meta_key').val();
		var tempversion = $('#meta_desc').val();
		
		
		if(temptypes1 == ''){
			alert('Please select the Meta keyword');
			return false;
		}
		if(tempversion == ''){
			alert('Please select the Description');
			return false;
		}
		
	});

	$('#mailform').submit(function(){
		
		var notification_email = $('#notification_email').val();
		var support_email = $('#support_email').val();
		var noreply_name = $('#noreply_name').val();
		var noreply_email = $('#noreply_email').val();
		
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
		
	});

	/*$('#bannerform').submit(function(){
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
		if(start_date > end_date){
			$('#alert').show().html('The end date can not be less then the start date');
			return false;
		}
		if(status == undefined){
			$('#alert').show().html('Please Select the status');
			return false;
		}		
	});
	*/
	
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
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
		
	});
	
	$('#invoice-popup-overlay, .inv-close').live ('click',function(){
		$('#invoice-popup-overlay').show();
		$('#invoice-popup-overlay').css("opacity", "1");
	});
	
	$('#invoice-popup-overlay, .inv-close').live ('keyup',function(e){
		if (e.keyCode == 27) 
		  { 
		     $('#invoice-popup-overlay').hide();
		     $('#invoice-popup-overlay').css("opacity", "0");
		  }   // esc
		});
$("#invoice-popup-overlay, #btn_close").live ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
window.close();
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
					htms += '<input type="text" value="" id="price" class="money text text-small input-small" name="country_shipping['+lctn+']['+incrmt_val+'][primary]">';
				htms += '</div>';
			htms += '</td>';  
			htms += '<td class="input-group-close">';
				htms += '<div class="shippingClose input-group input-group-price price-input primary-shipping-price"><a class="remove" href="javascript:void(0)" id='+lctn+'><i class="icon-trash"></i></a></div>';
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
	$('#frame_'+val).show();
}

function Price_range(){
	//alert('hai');
	$('.adminitemerror').html('');
	var price1 = $(".inputform1").val();
	var price2 = $(".inputform2").val();
	
	if(parseInt(price1) > parseInt(price2)){
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

function editPrice_range(){
	//alert('hai');
	$('.adminitemerror').html('');
	var price1 = $(".inputform1").val();
	var price2 = $(".inputform2").val();
	if(parseInt(price1) > parseInt(price2)){
		alert("Give Correct Price Range");
		
	}
	else
		{
		$.ajax({
		      url: BaseURL+"admins/editprice/"+price1+"/"+price2,
		      type: "post",
		      dataType: "html",
		      success: function(){
		         
				//$("#del_"+Id).remove();
		    	 
				}
		      
			});
		}
}

function set_deltype(){
	var id = $('#mainsec').attr('value');
    var dtype = window.cat_type[id];
    var type = $('#CategoryDeliveryType').val(dtype);
}

function commisionRange(){
	//alert('hai');
	$('.adminitemerror').html('');
	var price1 = $('#minrange').val();
	var price2 = $('#maxrange').val();
	var amount = $('#commission').val();
	if (price1 == '' || price2 == ''){
		alert("Price Range cannot be empty");
		return false;
	}else if(parseInt(price1) > parseInt(price2)){
		alert("Give Correct Price Range");
		return false;
	}else if(amount == ''){
		alert("Commission percentage cannot be empty");
		return false;
	}else if(amount > 100){
		alert("Give Commission percentage below 100");
		return false;
	}else{
		return true;
	}
}


function validate(){
	$('.adminitemerror').html('');
	$('.form-error').html('');
	var img0  = $("#image_computer_0").val();
	var img1  = $("#image_computer_1").val();
	var img2  = $("#image_computer_2").val();
	var img3  = $("#image_computer_3").val();
	var color_method = $("#detectmethod").val();
	var prmry_val  = $(".primary-shipping-price input").val();
	var check = 0;
	if($('#cate_id').val() == '') {
		$('.cat-error').html('Select Category');
		check = 1;
	}
	if($('#categ-selectbx-2').val() == '') {
		$('.subcat-error').html('Select Sub Category');
		check = 1;
	}
	if($.trim($('.itemtitle').val()) == '') {
		$('.title-error').html('Item Title cannot be empty');
		check = 1;
	}
	if(color_method=='')
	{
		$('.color-error').html('Please select method for choosing color');
		check = 1;		
	}
	if(color_method=='manual')
	{
		item_manual_color = $("#item_color_manual").val();
		if(item_manual_color==null)
		{
			$('.color-error').html('Please select colors');
			check = 1;		
		}
	}	
	if($.trim($('#description').val()) == '') {
		$('.description-error').html('Description cannot be empty');
		check = 1;
	}
	if($.trim($('#price').val()) == '') {
		$('.price-error').html('Item Price cannnot be empty');
		check = 1;
	}
	if($.trim($('#quantity').val()) == '') {
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
	if($.trim(prmry_val) == ''){
		$('.ship-error').html('Please enter a shipping cost for at least one country or region');
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
/* Dispute Delete*/
function deletedisp(did){
	//alert(BaseURL);
	//alert(did);
	if (confirm("Are you sure you want to delete this Dispute? ")) {
		//alert(did);
		$.post(BaseURL+'deletdispmsg', { "did": did},
				
			function(data) {
				$("#scatgys"+did).remove();
				

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

function areadelete(id){
	//alert(id);
	
	if (confirm("Are you sure you want to delete this Area? ")) {
		$.post(BaseURL+'delete_delcharge', { "id": id},
			function(data) {
				$("#dchar_"+id).remove();

			}
		);
	
	}
	return false;	
}

function dcntry_delete(id){
	//alert(id);
	
	if (confirm("Are you sure you want to delete this Location? ")) {
		$.post(BaseURL+'delete_delcntry', { "id": id},
			function(data) {
				$("#dcntry_"+id).remove();

			}
		);
	
	}
	return false;	
}

function alcntry_delete(id){
	//alert(id);
	
	if (confirm("Are you sure you want to delete this Location? ")) {
		$.post(BaseURL+'delete_alcntry', { "id": id},
			function(data) {
				$("#alcntry_"+id).remove();

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
	var usr_access=$('#usr_access').val();
	var email=$('#email').val();
	var password=$('#password').val();
	var rpassword=$('#rpassword').val();
	var user_level = $("#usr_access").val();
	//alert(firstname);
	if($.trim(firstname) == ''){
		$("#alert").show();
		var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
		$('#alert').text('Enter the full name');
		$("#alert").append(newdiv);
		return false;
	}
	if($.trim(username) == ''){
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
	if(user_level == 'moderate'){
		valu = new Array();
		j = 0;
		$("[name='chkbox']").each(function(){
		checkd = $(this).attr("checked");
		if(checkd=="checked")
		{
			valu[j] = $(this).val();
			j++;
		}
		});	
		/*if(valu=="")
		{
			$("#alert").show();
			var newdiv='<button class="close close_x" onclick="close_x();">x</button>';
			$('#alert').text('Choose the menu lists');
			$("#alert").append(newdiv);
			return false;
		}*/
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
function search_user_func(){ 
	 var value1 = $('#nonusersrchSrch').val();
	 if(value1.length>2 || value1.length == 0){
		 $.ajax({
			type: "post",		// Request method: post, get
			url: BaseURL+"admin/manage/searchnonapprovedusers/"+value1,	// URL to request
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

function inactive_search_func(){ 
	 var value1 = $('#usersrchSrch').val();
	 var timeperiod = $('.inactivedays').val();
	 if(value1.length > 2 || value1.length == 0 || timeperiod != oldperiod){
		 oldperiod = timeperiod;
		 $.ajax({
			type: "post",		// Request method: post, get
			url: BaseURL+"inactivemembers/"+timeperiod+"/"+value1,	// URL to request
			data:{'search':1},
			dataType: "html",	// Expected response type
			success: function(response, status) {
				$('#userdata').html(response);
				var inactivecnt = $('.inactivecnt').val();
				$('.deleterecordcnt').html(inactivecnt+' record(s) found');
			},
			error: function(response, status) {
				alert('An unexpected error has occurred!');
			}
		});
	 }

		return false;

}
function deleteinactiveusers(){
	 var value1 = $('#usersrchSrch').val();
	 var timeperiod = $('.inactivedays').val();
	 
	 if($('.inactivecnt').val() > 0 && confirm("Are you sure want to delete "+$('.inactivecnt').val()+" user(s) ?")){
		 window.location = BaseURL+"deleteinactivemembers/"+timeperiod+"/"+value1;
	 }
}
function deleteinactiveselected() {
	var names = [];
	$('input:checkbox.inactiveuser').each(function () {
		var sThisVal = (this.checked ? $(this).val() : "");
		if (sThisVal != ""){
			names.push(sThisVal);
		}
	});
	if (names.length > 0 && confirm("Are you sure want to delete "+names.length+" user(s) ?")){
		$.ajax({
			type: "post",		// Request method: post, get
			url: BaseURL+"deleteinactivemembers/",	// URL to request
			data:{'selectedusers':names},
			dataType: "html",	// Expected response type
			beforeSend: function(){
				$('.deleteselectload').show();
			},
			success: function(response) {
				$('.deleteselectload').hide();
				window.location = BaseURL+"inactivemembers/";
			},
			error: function(response, status) {
				//alert('An unexpected error has occurred!');
			}
		});
	}
	console.log(names);
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
	          //alert("An unexpected error has occurred!");
	      }   
	    }); 
}

function changeCurrencyStatus(currId,status){

	$baseurl = getBaseURL();
	$eleid = "#status"+currId;
	//alert(status);
	      $.ajax({
	      url: $baseurl+"admins/change_currency_status/"+currId+"/"+status,
	      type: "post",
	      dataType: "html",
	      success:function(responce){
	         // alert(responce);
	          $($eleid).html(responce);
	      },
	      error:function(){
	          //alert("An unexpected error has occurred!");
	      }   
		
	    }); 
	return false;
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
	     window.location.reload();
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
	//alert($eleid);
		$.ajax({
	      url: $baseurl+"admins/change_seller_status/"+userId+"/"+status,
	      type: "post",
	      dataType: "html",
	      success: function(responce){
	          //alert(responce);
	          $($eleid).html(responce);
	          window.location.reload();
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
	if(status=="enable")
	{
		if (confirm("Are you sure you want to disable this User? ")) {
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
		return false;
	}
	else
	{
		if (confirm("Are you sure you want to enable this User? ")) {
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
		return false;
	}	
	
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
				$('#message').val('');
			}
		});
	}
}


/*********** Add color validation for Admin ***********/
function addcolorform()
{
	color_name = $("#Color_name").val();
	rgbval1 = $("input[name=rgbval1]").val();
	rgbval2 = $("input[name=rgbval2]").val();
	rgbval3 = $("input[name=rgbval3]").val();
	if($.trim(color_name)=="")
	{
		alert("Enter color name");
		$("#Color_name").val("");
		$("#Color_name").focus();
		return false;
	}
	else if($.trim(rgbval1)=="")
	{
		alert("Enter R value");
		$("input[name=rgbval1]").val("");
		$("input[name=rgbval1]").focus();
		return false;
	}
	if($.trim(rgbval2)=="")
	{
		alert("Enter G value");
		$("input[name=rgbval2]").val("");
		$("input[name=rgbval2]").focus();
		return false;
	}
	if($.trim(rgbval3)=="")
	{
		alert("Enter B value");
		$("input[name=rgbval3]").val("");
		$("input[name=rgbval3]").focus();
		return false;
	}	
		
}
/*********** Add color validation for Admin ***********/


function order_search()
{
	searchval = $("#ordersearchval").val();
	startdate = $("#sdate").val();
	enddate = $("#edate").val();
	
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"admin/merchant_payment_search/",
	      type: "post",
	      data : { 'sval':searchval,'stdate':startdate,'eddate':enddate},
	      dataType: "html",
	      success: function(responce){
			$("#userdata").html(responce);
	      }
	});	
}

function ship_order_search()
{
	searchval = $("#ordersearchval").val();
	startdate = $("#sdate").val();
	enddate = $("#edate").val();	
	
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"admin/merchant_payment_ship_search/",
	      type: "post",
	      data : { 'sval':searchval,'stdate':startdate,'eddate':enddate},
	      dataType: "html",
	      success: function(responce){
			$("#userdata").html(responce);
	      }
	});	
}

function deliver_order_search()
{
	searchval = $("#ordersearchval").val();
	startdate = $("#sdate").val();
	enddate = $("#edate").val();
	
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"admin/merchant_payment_deliver_search/",
	      type: "post",
	      data : { 'sval':searchval,'stdate':startdate,'eddate':enddate},
	      dataType: "html",
	      success: function(responce){
			$("#userdata").html(responce);
	      }
	});	
}

function paid_order_search()
{
	searchval = $("#ordersearchval").val();
	startdate = $("#sdate").val();
	enddate = $("#edate").val();	
	
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"admin/merchant_payment_paid_search/",
	      type: "post",
	      data : { 'sval':searchval,'stdate':startdate,'eddate':enddate},
	      dataType: "html",
	      success: function(responce){
			$("#userdata").html(responce);
	      }
	});	
}

function invoice_search()
{
	searchval = $("#invoicesval").val();
	
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"admin/invoice_search_management/",
	      type: "post",
	      data : { 'sval':searchval},
	      dataType: "html",
	      success: function(responce){
			$("#userdata").html(responce);
	      }
	});		
}

function admin_menu_list()
{
	user_level = $("#usr_access").val();
	if(user_level=="moderate")
	{
	    $('#invoice-popup-overlay1').show();
		$('#invoice-popup-overlay1').css("opacity", "1");
	}
}

function menu_list()
{

	valu = new Array();
	j = 0;
	$("[name='chkbox']").each(function(){
	checkd = $(this).attr("checked");
	if(checkd=="checked")
	{
		valu[j] = $(this).val();
		j++;
	}
	});
	values = JSON.stringify(valu);
	if(valu=="")
	{
		alert("Please select menus");
	}
	else
	{
		$("#menulist").val(values);
	    $('#invoice-popup-overlay1').hide();
		$('#invoice-popup-overlay1').css("opacity", "0");
		
	}	
}


function sendnewsletter()
{
	subject = $("#subject").val();
	message = $("#message").val();
	
	key = "66ZU4UGGZBRNQ095CZU1";
	username = "6vxf";
	output = "JSON";
	$baseurl = "http://www.ymlp.com/api/Newsletter.Send";
		$.ajax({
	      url: $baseurl,
	      type: "GET",
	      crossDomain:true,
	      data : { 'Key':key,'Username':username,'TestMessage':'0','Subject':subject,'Text':message,'Output':output},
	      dataType: "jsonp",
	      contentType: "application/json",	
	      beforeSend: function () {
		$('#loading_image').show();
	     },      
	      success: function(responce){
		$('#loading_image').hide();
	    	  alert(responce.Output);
		$("#subject").val('');
		$("#message").val('');
	      }
	});	
	
}


function addcontacts()
{
	var check = $( "input:checked" ).length;
	
	if(check == 0){
		email = $( "#email option:selected" ).text();	
		
		key = "66ZU4UGGZBRNQ095CZU1";
		username = "6vxf";
		output = "JSON";
		$baseurl = "https://www.ymlp.com/api/Contacts.Add";
		
			      $.ajax({
				      url: $baseurl,
				      type: "GET",
				      crossDomain:true,
				      data : { 'Key':key,'Username':username,'Email':email,'GroupId':'1','Output':output},
				      dataType: "jsonp",
				      contentType: "application/json",
				       beforeSend: function () {
					$('#loading_image').show();
				      }, 	      
				      success: function(responce){
						$('#loading_image').hide();
				    	  	alert(responce.Output);
				      }
				});
	}
	else {
		var mailVal = $( "#count" ).val();
		
		for(var i=0; i<mailVal; i++) {
			var mailid = '#check'+i;
			var email = $(mailid).val();
	
			key = "66ZU4UGGZBRNQ095CZU1";
			username = "6vxf";
			output = "JSON";
			$baseurl = "https://www.ymlp.com/api/Contacts.Add";
		
				      $.ajax({
					      url: $baseurl,
					      type: "GET",
					      crossDomain:true,
					      data : { 'Key':key,'Username':username,'Email':email,'GroupId':'1','Output':output},
					      dataType: "jsonp",
					      contentType: "application/json",	
						beforeSend: function () {
						$('#loading_image').show();
					      },       
					      success: function(responce){
						  $('#loading_image').hide();
					    	  alert(responce.Output);
					      }
					});
		}
		
		
	}	
	
}

function get_contacts_list()
{
	subject = $("#subject").val();
	message = $("#message").val();
	
	key = "66ZU4UGGZBRNQ095CZU1";
	username = "6vxf";
	output = "JSON";
	$baseurl = "https://www.ymlp.com/api/Contacts.GetList";
		$.ajax({
	      url: $baseurl,
	      type: "GET",
	      crossDomain:true,
	      data : { 'Key':key,'Username':username,'GroupID':'1','Output':output},
	      dataType: "jsonp",
	      contentType: "application/json",	      
	      success: function(responce){
		    	 $baseurl = getBaseURL();
		    		$.ajax({
		    		      url: $baseurl+"admin/list_contacts",
		    		      type: "post",
		    		      data : { 'responce':responce},
		    		      dataType: "html",
		    		      success: function(datas){
		    		    	  $("#emailslist").html(datas);
		    		      }
		    		});		    	  
	    	 /* responce = responce.toSource();
	    	  responce = responce.replace('[','');
	    	  responce = responce.replace(']','');
	    	  resp = responce.split(",");
	    	  $("#emailslist").html("");
	    	 for(i=0;i<=resp.length;i++)
	    		 {
	    		 	$("#emailslist").append(resp[i]);
	    		 	$("#emailslist").append('<br />');
	    		 }*/
		    	 
	      }
	});	
	
}


function get_contacts_list_email()
{
	subject = $("#subject").val();
	message = $("#message").val();
	
	key = "66ZU4UGGZBRNQ095CZU1";
	username = "6vxf";
	output = "JSON";
	$baseurl = "https://www.ymlp.com/api/Contacts.GetList";
		$.ajax({
	      url: $baseurl,
	      type: "GET",
	      crossDomain:true,
	      data : { 'Key':key,'Username':username,'GroupID':'1','Output':output},
	      dataType: "jsonp",
	      contentType: "application/json",	      
	      success: function(responce){
		    	 $baseurl = getBaseURL();
		    		$.ajax({
		    		      url: $baseurl+"admin/addcontactslist",
		    		      type: "post",
		    		      data : { 'responce':responce},
		    		      dataType: "html",
		    		      success: function(datas){
		    		    	  $("#listemail").html(datas);
		    		      }
		    		});		    	  
	    	 /* responce = responce.toSource();
	    	  responce = responce.replace('[','');
	    	  responce = responce.replace(']','');
	    	  resp = responce.split(",");
	    	  $("#emailslist").html("");
	    	 for(i=0;i<=resp.length;i++)
	    		 {
	    		 	$("#emailslist").append(resp[i]);
	    		 	$("#emailslist").append('<br />');
	    		 }*/
		    	 
	      }
	});	
	
}

function delete_contacts(email)
{
	
	key = "66ZU4UGGZBRNQ095CZU1";
	username = "6vxf";
	output = "JSON";
	$baseurl = "https://www.ymlp.com/api/Contacts.Delete";
	
		      $.ajax({
			      url: $baseurl,
			      type: "GET",
			      crossDomain:true,
			      data : { 'Key':key,'Username':username,'Email':email,'GroupId':'1','Output':output},
			      dataType: "jsonp",
			      contentType: "application/json",
			       beforeSend: function () {
				$('#loading_image').show();
			      }, 	      
			      success: function(responce){
					$('#loading_image').hide();
			    	  	alert(responce.Output);
			    	  	window.location.reload();
			      }
			});
}

function showrestriction()
{
	user_level = $("#usr_access").val();
	if(user_level=="moderate")
	{
	    $("#restrict").show();
	}
	else
		$("#restrict").hide();
}

function close_button()
{
		$('#invoice-popup-overlay1').hide();
		$('#invoice-popup-overlay1').css("opacity", "0");
}


function save_err_code()
{
	error_code = $("#err_content").val();
	$baseurl = getBaseURL();
	$.ajax({
	      url: $baseurl+"err404",
	      type: "post",
	      data : { 'errorcode':error_code},
	      dataType: "html",
	      success: function(responce){
		alert(responce);
		window.location.reload();
	      }
	});			
}


function show_export()
{
		$('#invoice-popup-overlay1').show();
		$('#invoice-popup-overlay1').css("opacity", "1");
}



function export_view()
{
		$('#invoice-popup-overlay').show();
		$('#invoice-popup-overlay').css("opacity", "1");
}

function detect_method()
{
	color_method = $("#detectmethod").val();
	if(color_method=="manual")
	{
		$("#manual_select").show();
	}
	else
	{
		$("#manual_select").hide();
	}
}
