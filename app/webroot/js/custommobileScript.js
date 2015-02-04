var galleryLoad = 1;
var galleryLoadAjax = 1;
var wantitajax = 1, ownitajax = 1, invajax = 0;
var allcatvaluess = [];

$('.smlght').live('click' , function(){
   var srcToChange= $(this).data("img-src");
    $('#fullimgtag').attr('src',srcToChange);
   return false; 
});

$(document).keydown(function(e) {
	var keycode = e.keyCode;

	//if($('#popup_container').hasClass('headpopupp')){
	if (keycode == 27) {
			$('#popup_container').hide();		
			$('#popupforadditem').hide();
			$('#itemurls').hide();
			$('#popupcommision').hide();
			$('#popup_container').css({"opacity":"0"}); 
			$('#slideshow-box').hide();
			$('.btn-slideshow').removeClass('current');
	
	}
});

$(document).ready(function () {
    $("select").change(function () {
        var str = "";
        str = $(this).find(":selected").text();
        $(this).next(".out").text(str);
    });//.trigger('change');
    
    setTimeout(function(){$('#flashmsg').fadeOut();}, 2000); 
})

/*********************List check box enable******************/

$(".list-box li").live("click",function() {alert("hai");
    var checkbox = $(this).find("input[type='checkbox']");
    if(checkbox.attr("checked")){
        checkbox.attr("checked",false);
        console.log("Checkbox checking value: "+checkbox.attr("checked"));
    } else {
        checkbox.attr("checked",true);
        console.log("Checkbox unchecking value: "+checkbox.attr("checked"));
    }
});

$('.list-box li input[type=checkbox]').click(function(e){
        e.stopPropagation();
});


$(document).click(function(e) {

		$('.rssmenu').hide();
});


/*** Group Gift ***/

$('.pick').live('click' , function(){
	//alert('pickk working111');
	$(".pick").addClass('current');
	$(".add").removeClass('current');
	$(".pick-friends").show();
	$(".add-friends").hide();
	
});

$('.add').live('click' , function(){
	//alert('aa12345');
	$(".add").addClass('current');
	$(".pick").removeClass('current');
	$(".pick-friends").hide();
	$(".add-friends").show();
	
});

$('#additem_prices').live('keyup', function() {
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});

$('#ggift').live('click' , function(){
	var loguserid = $("#loguserid").val();
	var baseurl = getBaseURL();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
		return false;
	}
	//alert('working111');
	$('#popup_container').show();
	
	//$('.popup').show();
	$('.create-group-gifts').show();
	$('#popup_container').css({"opacity":"1"});
	$('#add-to-list-new').hide();
	$('#videourrls').hide();
	$('#showprofile').hide();
	$('#share-social').hide();
	 
	//$('#slideshow-box').hide();
	//$('.btn-slideshow').removeClass('current');
});
$(document).keydown(function(e) {
	var keycode = e.keyCode;
	
	if (keycode == 27) {
		$('#popup_container').hide();
		$('#popupforadditem').hide();
		
		$('#popup_container').css({"opacity":"0"}); 
		$('#slideshow-box').hide();
		$('.btn-slideshow').removeClass('current');
	}
});

//Called from keyup on the search textbox.
//Starts the AJAX request.

/*$(".usersearch").keyup(function(event) {
	if ( event.keyCode != '13' && event.keyCode != '38' && event.keyCode != '40') { 
	 
	     
	        $("#helpBox").show() //show autocomplete box
	                   
	    
	}
	var blocksPerRow = 4;
	var thisIndex = $(".usersearch li").index();
	    var newIndex = null;

	var e = str.charAt( str.length-1 );
	 $('.username').keyup(function(e){
	        if(e.keyCode == 38 || e.keyCode == 40){
	            if (e.keyCode == 40){ 
	            
	            	newIndex = thisIndex - blocksPerRow;   
	         
	                
	            }
	            else if (e.keyCode == 38){ 
	            
	            	newIndex = thisIndex + blocksPerRow;
	            }
	        }else{
	            // code that gets the search results
	            alert('ajax'); 
	        }
	    }); 
	}); */
/*var currentSelection = 0;

google.load("jquery", "1.3.1");
google.setOnLoadCallback(function()
{
   // Register keypress events on the whole document
   $(document).keypress(function(e) {
      switch(e.keyCode) { 
         // User pressed "up" arrow
         case 38:
            navigate('up');
         break;
         // User pressed "down" arrow
         case 40:
            navigate('down');
         break;
         // User pressed "enter"
       
      }
   });
});
function navigate(direction) {
	   // Check if any of the menu items is selected
	   if($("#comment-autocomplete ul li  .itemhover").size() == 0) {
	      currentSelection = 1;
	   }
	   
	   if(direction == 'up' ) {
	      if(currentSelection != 0) {
	         currentSelection--;
	      }
	   } else if (direction == 'down') {
	      if(currentSelection != $("#menu ul li").size() -1) {
	    	  
	   	   $("#comment-autocomplete ul li ").removeClass("itemhover");
	   	   $("#comment-autocomplete ul li ").eq(menuitem).addClass("itemhover");
	   	   currentUrl = $("#comment-autocomplete ul li ").eq(comment-autocomplete).attr(src);
	   	currentSelection++;

	      }
	   }
	 
	}*/



$('#fbconn').live('click' , function(){
	alert('working111');
	var baseurl = getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
	}else{
		//newwindow=window.open(baseurl+'getUsersocialList?provider=Facebook','name','height=600,width=600');
		 
		var baseurl = getBaseURL()+'getUsersocialList?provider=Facebook';
		$.ajax({
		      url: baseurl,
		      type: "GET",
		      dataType: "html",
		      success: function(responce){
		    	  alert(responce);
		          if(responce == 'Not Connected'){
		        	  newwindow=window.open(baseurl+'getUsersocialList?provider=Facebook','name','height=600,width=600');
		          }else{

			          alert(responce);
		          }
		    		//$('#invoice-popup-overlay').show();
		    	//	$('#invoice-popup-overlay').css("opacity", "1");
		         // $('.invoice-popup').html(responce);
		      }
	    });
	}
	
});


$('#reportflag').live('click' , function(){
	var baseurl = getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
	}else{
		//newwindow=window.open(baseurl+'getUsersocialList?provider=Facebook','name','height=600,width=600');

		var itemid = $("#featureditemid").val();
		if(confirm("Report this as inappropriate or broken ?")) {
			$.ajax({
			      url: baseurl+'reportitem',
			      type: "GET",
			      data: { 'itemid':itemid, 'userid':loguserid},
			      beforeSend: function () {
			    	  $('.reportloader').show();
			    	  },
			      success: function(responce){
			    	  var data = '<p id="unreportflag">Undo reporting'+
			    	  '<img class="reportloader" src="'+baseurl+'images/loading.gif" alt="loading..." />'+
					  '</p>';
			    	  $('.reportitem').html(data);
			      }  
			}); 
		}
	}
	
});


$('#unreportflag').live('click' , function(){
	var baseurl = getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
	}else{
		//newwindow=window.open(baseurl+'getUsersocialList?provider=Facebook','name','height=600,width=600');

		var itemid = $("#featureditemid").val();
		if(confirm("Cancel Report this ?")) {
			$.ajax({
			      url: baseurl+'undoreportitem',
			      type: "GET",
			      data: { 'itemid':itemid, 'userid':loguserid},
			      beforeSend: function () {
			    	  $('.reportloader').show();
			    	  },
			      success: function(responce){
			    	  var data = '<p id="reportflag">Report inappropriate'+
			    	  '<img class="reportloader" src="'+baseurl+'images/loading.gif" alt="loading..." />'+
					  '</p>';
			    	  $('.reportitem').html(data);
			      }  
			}); 
		}
	}
	
});


$('#gglistdone').live('click' , function(){
	$('#popup_container').hide();
	$('#popup_container').css({"opacity":"0"});
	$('.summary').hide();
	$(".step").removeClass('step3');
	$(".step").addClass('step1');
	$(".recipient").show();

	
	
});

/*** Group Gift ***/


$('#btn-browse').live('click' , function(){
	$('#popup_container').hide();
	$('#popup_container').css({"opacity":"0"}); 
	$('#slideshow-box').hide();
	$('.btn-slideshow').removeClass('current');
});

$('#btn-browses').live('click' , function(){
	$('#popup_container').hide();
	$('#popup_container').css({"opacity":"0"});
	
});

$('#btn_close_share').live('click' , function(){
	$('#popup_container').hide();
	$('#popup_container').css({"opacity":"0"});
	$('#share-social').hide();
	$('.share-thing').hide();
	$('#videourrls').hide();
	 
});

$(window).scroll(function() {
	if($(this).scrollTop() > 300) {
		$('#backtotop').fadeIn();
	} else {
		$('#backtotop').fadeOut();
	}
});

$('#zip').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) { return ''; } ) );
});

$('#passw, #confirmpass').live('keyup', function() {
    var password = $('#passw').val();
    var confirmPwd = $('#confirmpass').val();
	if (password == confirmPwd) {
		$('#save_password').removeAttr('disabled','disabled');
	}else {
		$('#save_password').attr('disabled','disabled');
	}
});


$('#phne, #person_phone_number, .order,#userentercreditamt, #zipcodegg, #telephonegg, #ggamt').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});
var instantSearch = 1;
$('.search-string').live('keyup', function(e) {
	var str = $('.search-string').val();
	if (instantSearch == 1){
		 $(".label").css("opacity", "0");
		 $(".del-val").css("opacity", "1");
	}
   if(e.keyCode == 13 && str != '') {
	   var selectedCategory = $('.sub-category').val();
		if (selectedCategory == '') {
			selectedCategory = $('#currentCatPath').val();
		}
		var priceRange = $('.price-range').val();
		var color = $('.color-filter').val();
		var sortPrice = $('.sort-by-price').val();
		var searchKey = str;
		var baseurl = getBaseURL()+"mobilecategories/getItemByCategory";
		var categoryId = $('#hiddencatvalue').val();
		
		$.ajax({
		      url: baseurl,
		      type: "post",
		      data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
		      dataType: "html",
		      beforeSend: function () {
		    	  $('.stream').fadeOut("slow","linear");
		    	  },
		      success: function(responce){
		          $('.shopcont').html(responce);
		          $('.stream').fadeIn("slow","linear");
		      }   
		    }); 
   }else {
	   if (str == ''){
		$(".label").css("opacity", "1");
		$(".del-val").css("opacity", "0");
	   }
   }
});

$(".del-val").live('click' , function(){
	$('.search-string').val('');
	$('.search-string').blur();
	$(".label").css("opacity", "1");
	$(".del-val").css("opacity", "0");
});

$('#fullname, #country, #state, #city, #merchant_name, #loc, #name').live('keyup', function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z_ -!@#$%&*(){}[]?<>;:'+="0-9]/g, function(str) { return ''; } ) );
});

$('#backtotop').live('click' , function(){
	$('body,html').animate({scrollTop:0},500,"linear");
});


$('.featuredon').live('click' , function(){
	//alert('dddddd');
	var BaseURL = getBaseURL();
	var featureditemid = $("#featureditemid").val();
	//alert(featureditemid);
  	$.post(BaseURL+'featureditem', {"featureditemid":featureditemid},
				function(datas) {
						$('#change_img').attr('src', BaseURL+'images/featured.png');
						$(".featuredon").text('Featured on my profile');
					
					return false;
					
				}
			);
});





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

function shippingRemove(id) {
	var baseurl = getBaseURL();
	baseurl += "mobiles/deleteshipping";
	var trid = ".shipping"+id;
	var loading = ".loading"+id;
	var remove = ".remove_"+id;
	if(confirm("Are you sure want to delete this Address")) {
		$.ajax({
		      url: baseurl,
		      type: "post",
		      data: { shippingid:id},
		      beforeSend: function () {
		    	  $(loading).show();
		    	  $(remove).hide();
		    	  },
		      success: function(responce){
		    	  $(loading).hide();
		          $(trid).hide();
		      }  
		}); 
	}
}

function CartshippingRemove(id,itemuserid,itemshopid) {
	var baseurl = getBaseURL();
	baseurl += "deletecartshipping";
	var trid = ".shipping"+id;
	var loading = ".shipchload"+itemuserid;
	var remove = ".remove_"+id;
	if(confirm("Are you sure want to delete this Address")) {
		$.ajax({
		      url: baseurl,
		      type: "post",
		      data: { shippingid:id, itemuserid:itemuserid, itemshopid:itemshopid},
		      beforeSend: function () {
		    	  $(loading).show();
		    	  $(remove).hide();
		    	  },
		      success: function(responce){
		    	  $(loading).hide();
		          $(trid).hide();
		          if (responce != 1){
			    	  var data = eval(responce);
			    	  $('.addressstyledremove'+itemuserid).html(data[0]);
			    	  $('.default_addr'+itemuserid).html(data[1]);
		          }else{
		        	  $('.addressstyledremove'+itemuserid).hide();
			    	  $('.default_addr'+itemuserid).hide();
			    	  $('.delete_addr'+itemuserid).hide();
		          }
		      	  window.location.reload();
		      }  
		}); 
	}
}

function shippingEdit(id) {
	var baseurl = getBaseURL();
	baseurl += "mobile/addshipping/"+id;
	window.location = baseurl;
}

function shippingdefault(id) {
	var baseurl = getBaseURL();
	baseurl += "mobiles/defaultshipping";
	var trid = ".default"+id;
	$.ajax({
		url:baseurl,
		type:"post",
		data: {shippingid:id},
		success: function(){
			$(".dall").show();
			$(trid).hide();
		}
	});
}

function cartshipping(id,shopid) {
	var baseurl = getBaseURL();
	baseurl += "mobilepaypals/changeshipping";
	var cartid = '#address-cart';
	var shipaddrid = "#shop";
	var loading = ".shipchload";
	var cartshipping = $(cartid).val();
	
	var couponnId = $('#coupon_idhide').val();
	if(couponnId !=''){
		//alert(couponnId);
		couponnId = couponnId;
	}else{
		couponnId = 0;
	}
	
	
	$.ajax({
	      url: baseurl,
	      type: "post",
	      data: { shippingid:cartshipping,shopid:shopid,couponnId:couponnId},
	      beforeSend: function () {
	    	  $(loading).show();
	    	  },
	      success: function(responce){
	    	  $(loading).hide();
	    	  var obj = eval (responce);
	    	  if (obj[0] != null) {
	    	 $(shipaddrid).html(obj[0]); 
	    	 }
	      } 
	}); 
}

$('.updatelist').live('click', function(){ 
	$("#myPopup").hide();
	$("#myPopup1").hide();
	var selectedCategory = $('#sub-category').val();
	if (selectedCategory == '') {
		selectedCategory = $('#currentCatPath').val();
	}
	var priceRange = $('#price-range').val();
	var color = $('#color-filter').val();
	var sortPrice = $('#sort-by-price').val();
	var searchKey = $('.search-string').val();;
	var baseurl = getBaseURL()+"mobilecategories/getItemByCategory";
	var categoryId = $('#hiddencatvalue').val();
	
	$.ajax({
	      url: baseurl,
	      type: "post",
	      data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
	      dataType: "html",
	      beforeSend: function () {
	    	  $('.stream').fadeOut("slow","linear");
	    	  $('.itemLoader').show();
	    	  },
	      success: function(responce){
	    		 
	    		  $("#myPopup").hide();
	    		  $("#myPopup1").hide();
	    	  $('.itemLoader').hide();
	          $('.shopcont').html(responce);
	          $('.stream').fadeIn("slow","linear");
	          sIndex = 21;
	          isDataAvailable = true;
	      }
	    }); 
	//alert(selectedCategory+" "+priceRange+" "+color);
});

$('#pop').live('click', function(){ 
	$("#myPopup1").show();
});



$('.updaterecomend').live('click', function(){ 
	$("#myPopup").hide();
	$("#myPopup1").hide();
	var selectedCategory = $('#sub-category').val();
	if (selectedCategory == '') {
		selectedCategory = $('#currentCatPath').val();
	}
	var priceRange = $('#price-range').val();
	var relation = $('#relation-filter').val();
	var gender = $('#sort-by-gender').val();
	var baseurl = getBaseURL()+"mobilecategories/getItemByRelation";
	var categoryId = $('#hiddencatvalue').val();
	
	$.ajax({
	      url: baseurl,
	      type: "post",
	      data: {price : priceRange, relation:relation, category:selectedCategory, catids:categoryId, gender:gender},
	      dataType: "html",
	      beforeSend: function () {
	    	  $('.stream').fadeOut("slow","linear");
	    	  $('.itemLoader').show();
	    	  },
	      success: function(responce){
	    		  $("#myPopup").hide();
	    		  $("#myPopup1").hide();
	    	  $('.itemLoader').hide();
	          $('.shopcont').html(responce);
	          $('.stream').fadeIn("slow","linear");
	          sIndex = 21;
	          isDataAvailable = true;
	      }
	    }); 
	//alert(selectedCategory+" "+priceRange+" "+color);
});

function indexSearch (event) {
	var searchString = $('#search-query').val();
	//var keycode = $('#search-query').keyCode;
	var keycode = event.keyCode;
	var stringLength = searchString.length;
	var baseurl = getBaseURL();
	if (keycode == 13){
		indcall(event);
		return;
	}
	if (stringLength >= 3 && keycode != 40 && keycode != 38 && keycode != 37 && keycode != 39 && keycode != 13 && keycode != 27) {
		$.ajax({
			url: baseurl+'ajaxSearch',
			type: "post",
			data: {searchStr:searchString},
			beforeSend: function () {
				$('.loading').show();
			},
			success: function(responce) {
				$('.loading').hide();
				$('div.feed-search').show();
				var outli = eval(responce);
				if (outli['0'] == 'No Data') {
					$('.user').hide();
				}else {
					$('.user').show();
					$('.user').html(outli['0']);
				}
				if (outli['1'] == 'No Data') {
					$('.thing').hide();
				}else {
					$('.thing').show();
					$('.thing').html(outli['1']);
				}
				if(outli['0'] == 'No Data' && outli['1'] == 'No Data'){
					$('.user').show();
					$('.user').html('<div style="text-align:center;font-size:12px">Search string not found</div>');
				}
			}
		});
	}else if(keycode == 27) {
		$('.feed-search').hide();
		//$('.loading').show();
	}
}

function getXmlHttpRequestObject() {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
return new XMLHttpRequest();
} else if(window.ActiveXObject) {
       // code for IE6, IE5
return new ActiveXObject("Microsoft.XMLHTTP");
} else {
alert("It's about time to upgrade your browser. don't you think so?");
}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();
function searchSuggest() {
	
	}

	
function ajaxuserautoc (val, commndid, autocompid) {
	/*if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtSearch').value);
		searchReq.open("GET", 'searchSuggest.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggest;
		searchReq.send(null);
		}*/
	//var nn = document.getElementById('comment_msg').value;
	var searchString = $('#'+commndid).val();
	//var stringLength = searchString.length;
	var baseurl = getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
		return false;
	}
	
	 var iChars = "@";

	    for (var i = 0; i < searchString.length; i++) {
	       if (iChars.indexOf(searchString.charAt(i)) != -1) {
	    	   
	    	   var splitted = searchString.split('@');
	    	   var splittedstr = splitted[1];
	    	   var splittedstrbef = splitted[0];
	    	   
	    	   $.ajax({
	   			url: baseurl+'ajaxUserAuto',
	   			type: "post",
	   			data: {searchStr:splittedstr},
	   			success: function(responce) {
	   				var outli = eval(responce);
	   				if (outli['0'] == 'No Data') {
	   					$('.'+autocompid+' .usersearch').hide();
	   				}else {
	   					$('.usersearch').show();
	   					$('.'+autocompid).show();
	   					$('.'+autocompid+' .usersearch').html(outli['0']);
	   					//var l = 0;
	   					$('.'+autocompid+' .usersearch li').click(function() {
	   						//for(var l=0;l<6;l++){
	   						//alert( $(this).text() ); 
   							//className = $('#k'+l).val();
	   						className = $(this).text();
	   						
	   						//var link = '<a href="'+baseurl+'people/'+className+'" >@'+className+'</a>';
	   						//var links = $("#txt").val().split('\n');

	   	                    /*$.each(className, function (i, val) {
	   	                        var newA = $("<a />").text(val).attr("href", $.trim(val));

	   	                        $("#links").append(newA).append("<br>");
	   	                    });
   							*/
   							document.getElementById(commndid).value = splittedstrbef + '@'+className+' ';
   							$('.'+autocompid).hide();
   							//l++;
	   					});
	   					
	   					
	   				}
	   			}
	   		});
	       }
	    }
        
	
	
	
	
		
	/*}else {
		$('.loading').show();
	}*/
}
function handleSearchSuggest() {
	 if (searchReq.readyState == 4) {
	  var ss = document.getElementById('search_suggest')
	  ss.innerHTML = '';
	  var str = searchReq.responseText.split("\n");
	  for(i=0; i < str.length - 1; i++) {
	   //Build our element string.  This is cleaner using the DOM, but
	   //IE doesn't support dynamically added attributes.
	   var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
	   suggest += 'onmouseout="javascript:suggestOut(this);" ';
	                        suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
	   suggest += 'class="suggest_link">' + str[i] + '</div>';
	   ss.innerHTML += suggest;
	  }
	 }
	}

	//Mouse over function
	function suggestOver(div_value) {
	 div_value.className = 'suggest_link_over';
	}
	//Mouse out function
	function suggestOut(div_value) {
	 div_value.className = 'suggest_link';
	}

	//Click function
	function setSearch(value) {
	 document.getElementById('txtSearch').value = value;
	 document.getElementById('search_suggest').innerHTML = '';
	}

function isValidEmail(email) {
	var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	return emailreg.test(email);
}



function sellersignupfrm(){
	//alert('ss');
	var data = $('#sellerchk').serialize();
	var brand_name=$('#brand_name').val();
	var merchant_name=$('#merchant_name').val();
	var person_phone_number=$('#person_phone_number').val();
	var paypalid=$('#paypalid').val();
	//alert(password);
	//alert(data);
	
	if(brand_name == ''){
		$("#alert").show();
		$('#alert').text('Please Enter Brand Name ');
		return false;
	}
	if(merchant_name == ''){
		$("#alert").show();
		$('#alert').text('Please Enter Merchant name');
		return false;
	}
	if(person_phone_number == ''){
		$("#alert").show();
		$('#alert').text('Please Enter Phone Number');
		return false;
	}
	if(paypalid == ''){
		$("#alert").show();
		$('#alert').text('Please Enter paypal Id!');
		return false;
	}
	if(!(isValidEmail(paypalid))){
		$("#alert").show();
		$('#alert').text('Enter a Valid Paypal ID');
		return false;
	}
	
}

function validforgot() {
	var email = $('#username').val();
	
	if(email == ''){
		$('.addshiperror').text('Please Enter the Email');
		return false;
	}else if (!isValidEmail(email)) {
		$('.addshiperror').text('Please Enter a valid Email');
		return false;
	}
	return true;
}

function validaddship() {

	var name = $('#fullname').val();
	var nickName = $('#nick').val();
	var country = $('#countrys').val();
	var state = $('#state').val();
	var add1 = $('#add1').val();
	var city = $('#city').val();
	var zip = $('#zip').val();

	if (name == '') {
		$("#alert_em").show();
		$("#badMessage").hide();
		$('#alert_em').text('Full name is required');
		$('#fullname').focus()
		$('#fullname').keydown(function() {
			$('#alert_em').hide();
		});

		return false;
	}
	if (nickName == '') {
		$("#alert_nick").show();
		$("#badMessage").hide();
		$('#alert_nick').text('Enter your nickname');
		$('#nick').focus()
		$('#nick').keydown(function() {
			$('#alert_nick').hide();
		})
		return false;
	}
	if (country == '') {
		$("#alert_country").show();
		$("#badMessage").hide();
		$('#alert_country').text('Enter your country');
		$('#countrys').focus()
		$('#countrys').keydown(function() {
			$('#alert_country').hide();
		})
		return false;
	}
	if (state == '') {
		$("#alert_state").show();
		$("#badMessage").hide();
		$('#alert_state').text('Enter  your  state');
		$('#state').focus()
		$('#state').keydown(function() {
			$('#alert_state').hide();
		})
		return false;
	}
	if (add1 == '') {
		$("#alert_add1").show();
		$("#badMessage").hide();
		$('#alert_add1').text('Enter your address');
		$('#add1').focus()
		$('#add1').keydown(function() {
			$('#alert_add1').hide();
		})
		return false;
	}
	if (city == '') {
		$("#alert_city").show();
		$("#badMessage").hide();
		$('#alert_city').text('Enter your  city');
		$('#city').focus()
		$('#city').keydown(function() {
			$('#alert_city').hide();
		})
		return false;
	}
	if (zip == '') {
		$("#alert_zip").show();
		$("#badMessage").hide();
		$('#alert_zip').text('Enter your area code');
		$('#zip').focus()
		$('#zip').keydown(function() {
			$('#alert_zip').hide();
		})
		return false;
	}
	if (phone == '') {
		$("#alert_ph").show();
		$("#badMessage").hide();
		$('#alert_ph').text('Enter your phone no');
		$('#phne').focus()
		$('#phne').keydown(function() {
			$('#alert_ph').hide();
		})
		return false;
	}
	return true;
}
function deactiateac(id){
	var BaseURL=getBaseURL();
		var x=window.confirm("Are you sure you want to deactivate your account?");
		if (x){
			$.post(BaseURL+'deactivateacc', {"userid":id},
					function(datas) {
					window.location.href=BaseURL;
					}
				);
		}else{
		return false;
		}
	}
	
function helpcontact() {
	if($('.name').val() == '') {
		$('.contact-error').html("Please Enter the Name");
		$('.contact-error').show();
		return false;
	}else if($('.email').val() == '') {
		$('.contact-error').html("Please Enter the Email");
		$('.contact-error').show();
		return false;
	}else if(!isValidEmail($('.email').val())) {
		$('.contact-error').html("Please Enter a Valid Email");
		$('.contact-error').show();
		return false;
	}else if($('.order').val() != '' && $('.order').val().length < 8) {
		$('.contact-error').html("Please Enter 8 digit order no.");
		$('.contact-error').show();
		return false;
	}else if($('.user').val() == '') {
		$('.contact-error').html("Please Enter the Username");
		$('.contact-error').show();
		return false;
	}else if($('.description').val() == '') {
		$('.contact-error').html("Please Enter the Description");
		$('.contact-error').show();
		return false;
	}
	return true;
}


$('#bio').live('keyup', function() {
		var maxLen = 180; 
		//alert(maxLen);
		if ($('#bio').val().length >= maxLen) {
		//var msg = "You have reached your maximum limit of characters allowed";
		//alert(msg);
			document.getElementById('bio').value = $('#bio').val().substring(0, maxLen);
   	 		$('#biodata_tex').css('color', 'red');
			$('#biodata_tex').show();
		$('#biodata_tex').text('You have reached your maximum limit of characters allowed');
		 }
		else{ 
			document.getElementById('text_num').value = maxLen - $('#bio').val().length;
			$('#biodata_tex').hide();
		}
	});

function checkcoupon(count,userId,shopId){
	//alert(count);
	//alert(userId);
	//alert(shopId);
	var shipaddrid = "#shop";
	var cartid = '#address-cart';
	var cartshipping = $(cartid).val();
	var coupon_value = $('#couponcode').val();
	if(coupon_value==''){
		$('#couponsemp').show();
		setTimeout(function(){$('#couponsemp').fadeOut();}, 3000); 
	}else{

		var baseurlforcoupon = getBaseURL()+"entercouponvalue";
		var baseurl = getBaseURL()+'mobile/checkcouponcode?coupon_value='+coupon_value+'&userid='+userId+'&shopid='+shopId;
		//var element = '.inv-loader-'+id;
		if (couajax == 0) {
			couajax = 1;
			$.ajax({
			      url: baseurl,
			      type: "get",
			      dataType: "html",
			      /*before: function(){
			    	 $('#loadingimgs'+count).show();
			      },*/
			      success: function(responce){
			          //alert(responce);
	 			    	 $('#loadingimgs').show();
			          if(responce == '0'){
			        	$('#couponsnotvalid').show();
			      		setTimeout(function(){$('#couponsnotvalid').fadeOut();}, 3000); 
			      		$('#loadingimgs').hide();
			          }
			          if(responce == 'Expired'){
				        	$('#couponsExpired').show();
				      		setTimeout(function(){$('#couponsExpired').fadeOut();}, 3000); 
				      		$('#loadingimgs').hide();
			          }
			          
			          if(responce == 'Not valid merchant'){
				        	$('#couponsntvalidsmer').show();
				      		setTimeout(function(){$('#couponsntvalidsmer').fadeOut();}, 3000); 
				      		$('#loadingimgs').hide();
			          }
			          
			          var vv=responce;
			          var splitt = vv.split(" ");
			          
			          if(splitt[0] == 'validmerchant'){
			        	  //alert(splitt[1]);
			        	  //var spltt = splitt[1].split(",");
			        	 // alert(spltt[0]);
			        	 // alert(spltt[1]);
			        	 // alert(spltt[2]);
			        	  $('#coupon_idhide').val(splitt[1]);
			        	  

	        	    	  //alert(splitt[1]);
			        	  $.ajax({
			        	      url: baseurlforcoupon,
			        	      type: "post",
			        	      data: { shippingid:cartshipping,coupon_id:splitt[1],shopid:userId},
			        	     /* before: function(){
			 			    	 $('#loadingimgs'+count).show(); 
			 			      },*/
			        	      success: function(responce){
			        	    	  //alert(responce);
			 			    	  //$('#loadingimgs'+count).show();
			        	    	  var obj = eval (responce);
			        	    	  if (obj[0] != null) {
			        	    		  //alert(obj[0]);
			        	    	  $(shipaddrid).html(obj[0]); 
			        	    	 }
			        	      } 
			        	}); 
			        	  
			        	  
			        	  
			        	  
			        	  
			          }
			          
			          couajax = 0;
			      }
			    });
		}
		
	}
}



function Checkgiftcard(merchantId,shopId){
	var shipaddrid = "#shop";
	var giftcard_value = $('#giftcode').val();
	var cartid = '#address-cart';
	var cartshipping = $(cartid).val();
	
	if(giftcard_value==''){
		$('#giftcodesemp').show();
		setTimeout(function(){$('#giftcodesemp').fadeOut();}, 3000); 
	}else{
		var baseurlforgiftcard = getBaseURL()+"entergfcardvalue";
		var baseurl = getBaseURL()+'mobile/checkgiftcardcode?gfcode_value='+giftcard_value;
		
		if (couajax == 0) {
			couajax = 1;
			//alert(baseurl);
			$.ajax({
			      url: baseurl,
			      type: "get",
			      dataType: "html",
			      /*before: function(){
			    	 $('#loadingimgsforgf').show();
			      },*/
			      success: function(responce){
			         //alert(responce);
			    	 $('#loadingimgsforgf').show();
			         if(responce == '0'){
			        	$('#giftcodesnotvalid').show();
			      		setTimeout(function(){$('#giftcodesnotvalid').fadeOut();}, 3000); 
		      			$('#loadingimgsforgf').hide();
			          }
			         
			          
			          
			          var vv=responce;
			          var splitt = vv.split(" ");
			          if(splitt[0] == 'Valid'){
			        	  $('#giftcard_idhide').val(splitt[1]);
				           $.ajax({
				        	      url: baseurlforgiftcard,
				        	      type: "post",
				        	      data: { shippingid:cartshipping,gfcardId:splitt[1],shopid:shopId},
				        	     /* before: function(){
				 			    	 $('#loadingimgsforgfd').show(); 
				 			      },*/
				        	      success: function(responce){
				        	    	  //alert(responce);
				 			    	  //$('#loadingimgs'+count).show();
				 		        	 //$('#loadingimgsforgfd').hide();
				        	    	  var obj = eval (responce);
				        	    	  if (obj[0] != null) {
				        	    	  $(shipaddrid).html(obj[0]); 
				        	    	 }
				        	      } 
				        	}); 
		         
			          }
		      	 couajax = 0;
		      }
			    });
		}
		
	}
}



function giftcardchk() {
	var giftval = $('#gift-value').val();
	var recipName = $('#recipName').val();
	var recipEmail = $('#recipEmail').val();
	var message = $('#message').val();
	
	if (giftval == '') {
		alert('Please select the Gift amount');
		return false;
	}
	if (recipName == '') {
    	$('#recipNameErr').show();
		setTimeout(function(){$('#recipNameErr').fadeOut();}, 3000); 
  		//alert('Please Enter the Recipient’s name');
		return false;
	}
	if (recipEmail == '') {
		//alert('Please Enter the Recipient’s Email');
    	$('#recipEmailErr').show();
		setTimeout(function(){$('#recipEmailErr').fadeOut();}, 3000); 
		return false;
	}
	if(!(isValidEmail(recipEmail))){
		//alert('Please Enter the Valid Recipient’s Email');
    	$('#recipEmailErrv').show();
		setTimeout(function(){$('#recipEmailErrv').fadeOut();}, 3000); 
		return false;
	}
	if (message == '') {
    	$('#messageErr').show();
		setTimeout(function(){$('#messageErr').fadeOut();}, 3000); 
		return false;
	}
	return true;
}
/*function change() {

	var img = $("#image_computer").val();
	var baseurl = getBaseURL();
	
	$.ajax({
		type : 'POST',
		url : baseurl + 'update',
		data : {
			src : img
		},
	
		success : function(msg) {
			if(img!='')
			{
				$('.prof_img').attr('src',
					baseurl + "media/avatars/thumb350/" + img);
			$('#popup_container').hide();
			
			}else	{
				$('.prof_img').attr('src',
						baseurl + "media/avatars/thumb350/usrimg.jpg" );
				$('#popup_container').hide();
				
				}
			// location.reload();
		}
	});

}*/

function change(ItemId) {

	var img = $("#image_computer").val();
	var baseurl = getBaseURL();
	
	$.ajax({
		type : 'POST',
		url : baseurl + 'update',
		//data : { src : img	},
		data : { 'src': img,'ItemId': ItemId },
		beforeSend: function() {
			$('#loadingimgg').show();
		},
		success : function(msg) {
			document.getElementById('show_Userurl').src='';
			$('#loadingimgg').hide();
			if(img!=''){
				$('.prof_img').attr('src',baseurl + "media/avatars/thumb350/" + img);
				$('#popup_container').hide();			
			}else{
				$('.prof_img').attr('src',baseurl + "media/avatars/thumb350/usrimg.jpg" );
				$('#popup_container').hide();
			}
			$("#image_computer").val('');
			// location.reload();
		}
	});

}

function getmorepostGallery (lastPage,imageCount,galleryobj) {
	baseurl = getBaseURL();
	imageCount += 1;
	if (galleryLoad == 1 && galleryLoadAjax == 1){
		galleryLoadAjax = 0;
		$.ajax({
			url : baseurl+'getmoregallery',
			type : "POST",
			dataType : "json",
			data : {startIndex : imageCount},
			success : function (responce){
				if (responce == 0){
					galleryLoad = 0;
				}else {
					var data = eval(responce);
					var datalength = data.length;
					for (var i=0; i<datalength;i++){
						galleryobj.appendImage(data[i]);
					}
				}
				galleryLoadAjax = 1;
			}
		});
	}
}

/*function userpro(id) {
	var BaseURL = getBaseURL();
	var loguserid = $("#loguserid").val();
	if (loguserid == 0) {
		window.location.href = BaseURL + "login";
		return false;
	}

	$('#slideshow-box').hide();
	$('#popup_container').show();
	$('#showprofile').show();
	$('#popup_container').css({
		"opacity" : "1"
	});
	$("#selectimgs").attr("src",$('#img_id' + id).find('img:first').attr('src'));
	$('#add-to-list-new').hide();
	$('#videourrls').hide();
	
	$('#share-user-profile').hide();
}*/




function userpro(id) {
	var BaseURL = getBaseURL();
	var loguserid = $("#loguserid").val();
	if (loguserid == 0) {
		window.location.href = BaseURL + "mobile/login";
		return false;
	}
	$('#slideshow-box').hide();
	$('#popup_container').show();
	$('#showprofile').show();
	$('#popup_container').css({
		"opacity" : "1"
	});
	$('#add-to-list-new').hide();	
	//$('#share-user-profile').hide();
	$('.create-group-gifts').hide();
	$('#videourrls').hide();
	$('#share-social').hide();
	$("#selectimgs").attr("src",$('#img_id' + id).find('img:first').attr('src'));
}


function inshopprofile(id) {
	var BaseURL = getBaseURL();
	var loguserid = $("#loguserid").val();
	if (loguserid == 0) {
		window.location.href = BaseURL + "mobile/login";
		return false;
	}
	$('#slideshow-box').hide();
	$('#popup_container').show();
	$('#showprofile').show();
	$('#popup_container').css({
		"opacity" : "1"
	});
	//$("#selectimgs").attr("src",$('#img_id' + id).find('img:first').attr('src'));
	$('#add-to-list-new').hide();
	
	$('#share-user-profile').hide();
}


/*** Group Gift ****/

function validggusersave() {
	
	
	
	var recipient = $('#recipient').val();
	var name = $('#name').val();
	var address1 = $('#address1').val();
	var address2 = $('#address2').val();
	var country = $('#countrygg').val();
	var state = $('#stategg').val();
	var city = $('#citygg').val();
	var zipcode = $('#zipcodegg').val();
	var telephone = $('#telephonegg').val();
	var listingid = $('#listingid').val();
	var fullimgtag = $('#fullimgtag').val();
	var image = $('#image_computer').val();
	//alert(image);
	if (recipient == '') {
		//alert('Enter the Recipient name');
		$('#recipient_name_err').show();
		setTimeout(function(){$('#recipient_name_err').fadeOut();}, 3000); 
		$('#recipient').focus();
		return false;
	}
	if (name == '') {
		//alert('Enter the Recipient name');
		$('#name_err').show();
		setTimeout(function(){$('#name_err').fadeOut();}, 3000); 
		$('#name').focus();
		return false;
	}
	if (address1 == '') {
		//alert('Enter the Recipient name');
		$('#address1_err').show();
		setTimeout(function(){$('#address1_err').fadeOut();}, 3000); 
		$('#address1').focus();
		return false;
	}
	if (address2 == '') {
		//alert('Enter the Recipient name');
		$('#address2_err').show();
		setTimeout(function(){$('#address2_err').fadeOut();}, 3000); 
		$('#address2').focus();
		return false;
	}
	if (country == '') {
		//alert('Enter the Recipient name');
		$('#country_err').show();
		setTimeout(function(){$('#country_err').fadeOut();}, 3000); 
		$('#countrygg').focus();
		return false;
	}
	if (state == '') {
		//alert('Enter the Recipient name');
		$('#state_err').show();
		setTimeout(function(){$('#state_err').fadeOut();}, 3000); 
		$('#stategg').focus();
		return false;
	}
	
	if (city == '') {
		$('#city_err').show();
		setTimeout(function(){$('#city_err').fadeOut();}, 3000); 
		$('#citygg').focus();
		return false;
	}
	if (zipcode == '') {
		//alert('Enter the Recipient name');
		$('#zipcode_err').show();
		setTimeout(function(){$('#zipcode_err').fadeOut();}, 3000); 
		$('#zipcodegg').focus();
		return false;
	}
	if (telephone == '') {
		//alert('Enter the Recipient name');
		$('#telephone_err').show();
		setTimeout(function(){$('#telephone_err').fadeOut();}, 3000); 
		$('#telephonegg').focus();
		return false;
	}
	if (image == '') {
		alert('Please attach the Image');
		return false;
	}
	
	
	
	//var baseurl = getBaseURL()+'ggusersave';
	var baseurl = getBaseURL()+'ggusersave?recipient='+recipient+'&name='+name+'&address1='+address1+'&address2='+address2+'&country='+country+'&state='+state+'&city='+city+'&zipcode='+zipcode+'&telephone='+telephone+'&item_id='+listingid+'&image='+image;
	
	$.ajax({
	      url: baseurl,
	      type: "GET",
	      dataType: "text",
	      success: function(responce){
	    	  //alert(responce);
	          var splitt = responce.split(",");
	         // alert(splitt[0]);
	         // alert(splitt[1]);
	         // alert(splitt[2]);
	         // alert(splitt[3]);
	          
	    	  $(".step").removeClass('step1');
	    	  $(".step").addClass('step2');
	    	  $(".recipient").hide();
	    	  $('.personalize').show();
	    	  $('.personalize').css("opacity", "1");
	    	  //alert( $('#fullimgtag').prop('src') );
	    	  $('#listingitemids').attr('src', $('#fullimgtag').prop('src'));
	    	  $('#lastestidgg').attr('value', splitt[0]);
	    	  $('#totitemshipcost').attr('value', splitt[3]);
	    	  $('#totalscosts').text(splitt[3]);
	    	  $('#totalscosts1').text(splitt[3]);
	    	  $('#totalscosts2').text(splitt[2]);
	    	  $('#totalscosts3').text(splitt[2]);
	    	  $('#shipscosts').text(splitt[1]);
	    	  $('#shipscosts1').text(splitt[1]);
	    	  $('#recepietName').attr('value', name);
	    	  $('#recepietcity').attr('value', city);
	    	  
	    	  var recipient = $('#recipient').val('');
	    	  var address1 = $('#address1').val('');
	    	  var address2 = $('#address2').val('');
	    	  var country = $('#countrygg').val('');
	    	  var state = $('#stategg').val('');
	    	  var zipcode = $('#zipcodegg').val('');
	    	  var telephone = $('#telephonegg').val('');
	    	  var image = $('#image_computer').val('');
	    	  
	    	  
	      }
    });
	

	return false;
	
	//return true;
}


function createggift() {
	var BaseURL=getBaseURL();
	var title = $('#ggift-title').val();
	var descr = $('#ggift-description').val();
	var notes = $('#ggift-note').val();
	var lastestidgg = $('#lastestidgg').val();
	var fullimgtag = $('#fullimgtag').val();
	var totitemshipcost = $('#totitemshipcost').val();
	var recepietName = $('#recepietName').val();
	var recepietcity = $('#recepietcity').val();
	
	if (title == '') {
		//alert('Enter the Recipient name');
		$('#title_err').css('display','block');
		setTimeout(function(){$('#title_err').fadeOut();}, 3000); 
		$('#ggift-title').focus();
		return false;
	}else if (descr == '') {
		//alert('Enter the Recipient name');
		$('#description_err').css('display','block');
		setTimeout(function(){$('#description_err').fadeOut();}, 3000); 
		$('#ggift-description').focus();
		return false;
	}
	
	//alert(totitemshipcost);
	
	var baseurl = getBaseURL()+'groupgiftreason?title='+title+'&description='+descr+'&notes='+notes+'&lastestidgg='+lastestidgg;
	
	$.ajax({
	      url: baseurl,
	      type: "GET",
	      dataType: "text",
	      success: function(responce){
	    	  //alert(responce);
	    	  $(".step").removeClass('step2');
	    	  $(".step").addClass('step3');
	    	  $('.personalize').hide();
	    	  $('.summary').show();
	    	  $('#listingitemids1').attr('src', $('#fullimgtag').prop('src'));
	    	  

	    	  $('#Usergifttitle').text(title);
	    	  $('#Usergiftdescription').text(descr);
	    	  $('#UsergiftNamee').text(recepietName);
	    	  $('#Usergiftcity').text(recepietcity);

	    	  var urlss = BaseURL+'gifts/'+lastestidgg;
				//alert(urlss);
				
				encry_urlss = encodeURIComponent(urlss);
				encry_title = encodeURIComponent(recepietName);
				//alert(encry_urlss);
				
				$('.facebook').attr('href', 'http://www.facebook.com/sharer.php?s=100&p[title]='+encry_title+'&p[url]='+encry_urlss);
				//$('.facebook').attr('href', 'http://www.facebook.com/sharer.php?u='+encry_urlss+'&t='+encry_title);
				
				$('.twitter').attr('href', 'http://twitter.com/?status='+encry_urlss);
				$('.google').attr('href', 'http://plus.google.com/share?url='+encry_urlss);
				$('.linkedin').attr('href', 'http://www.linkedin.com/cws/share?url='+encry_urlss+'&title='+encry_title);
				$('.stumbleupon').attr('href', 'http://www.stumbleupon.com/submit?url='+encry_urlss+'&title='+encry_title);
				$('.tumblr').attr('href', 'http://www.tumblr.com/share/link?url='+encry_urlss+'&name='+encry_title);
				
		    	  var notes = $('#ggift-note').val('');
		    	  
		    	  
	    	  
	    	  
	      }
    });
	
}

function MyPopUpWinsocial(urls) {
	var BaseURL=getBaseURL();
	var x = screen.width/2 - 700/2;
    var y = screen.height/2 - 450/2;
	var lastestidgg = $('#lastestidggs').val();
    
	
    var urlss = BaseURL+'gifts/'+lastestidgg;
	//alert(urlss);
	
	encry_urlss = encodeURIComponent(urlss);
    
    window.open(urls.href+encry_urlss, 'sharegplus','height=485,width=700,left='+x+',top='+y);

	
}

function MyPopUpWinsocialggfb(urls) {
	var BaseURL=getBaseURL();
	var x = screen.width/2 - 700/2;
    var y = screen.height/2 - 450/2;
	var lastestidgg = $('#lastestidggs').val();
    
	
    //var urlss = BaseURL+'gifts/'+lastestidgg;
	//alert(urlss);
	
	//encry_urlss = encodeURIComponent(urlss);
    
    window.open(urls.href, 'sharegplus','height=485,width=700,left='+x+',top='+y);

	
}
function contributeChkOut(ggid) {
	var UserEntrAmt = parseInt($('#ggamt').val());
	var itemId = $('#itemidval').val();
	var totalcost = parseInt($('#costforitem').val());
	var BaseURL=getBaseURL();
	
	var remainContri = parseInt($('#remainingContribution').val());
	var totalContri = parseInt($('#totalContribution').val());
	var adaptiveload = "#loadingimgsforgf";
	var aftercontri = totalcost - (UserEntrAmt + totalContri);
	
	if(totalcost < UserEntrAmt){
		alert('Entered amount is high');
		return false;
	}else  if(remainContri < UserEntrAmt){
		alert('Contribution Amount is High');
		return false;
	}else if (aftercontri != 0 && aftercontri < 5){
		alert('Remaining Contribution should be greater than 4');
		return false;
	}else if (UserEntrAmt < 5){
		alert('Minimum Contribution should be 5');
		return false;
	}
	if(UserEntrAmt > 0){
	$.ajax({
	      url: BaseURL+"ggcheckout/",
	      type: "post",
	      data : { 'itemId': itemId,'UserEntrAmt': UserEntrAmt,'ggid': ggid},
	      dataType: "html",
			beforeSend: function() {
				$(adaptiveload).show();
				$('.contribubtn-green').attr("disabled", "disabled");
			},
	      success: function(responce){
	    	  //alert(responce);
	    	  $(adaptiveload).hide();	
	    	  $('#ggpaypalfom').html(responce);
	    	  $('#ggpaypal').submit();
	      }
	});
	}else{
		alert('Please Enter amount');
		return false;
	}
}

function wantit(id) {
	var BaseURL=getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=BaseURL+"mobile/login";
		return false;
	}
	if (wantitajax == 1){
		wantitajax = 0;
		$.ajax({
		      url: BaseURL+"wantit",
		      type: "post",
		      data : { 'id': id},
		      dataType: "html",
				beforeSend: function() {
					$('.wantitload').show();
				},
		      success: function(responce){
					$('.wantitload').hide();
					if (responce == 1){
						$('.wantit').html('<i class="glyphicons circle_ok"></i>You want it');
						$('.ownit').html('<i class="glyphicons lock"></i>I own it');
					}else{
						$('.wantit').html('<i class="glyphicons pushpin"></i>I want it');
					}
		    	  //$('#ggpaypal').submit();
					$('#wantit_'+id).remove();
					wantitajax = 1;
		      }
		});
	}
}

function ownit(id) {
	var BaseURL=getBaseURL();
	var loguserid = $("#loguserid").val();
	if(loguserid == 0){
		window.location.href=BaseURL+"mobile/login";
		return false;
	}
	if (ownitajax == 1){
		ownitajax = 0;
		$.ajax({
		      url: BaseURL+"ownit",
		      type: "post",
		      data : { 'id': id},
		      dataType: "html",
				beforeSend: function() {
					$('.ownitload').show();
				},
		      success: function(responce){
					$('.ownitload').hide();
					if (responce == 1){
						$('.ownit').html('<i class="glyphicons circle_ok"></i>You own it');
						$('.wantit').html('<i class="glyphicons pushpin"></i>I want it');
					}else{
						$('.ownit').html('<i class="glyphicons lock"></i>I own it');
					}
		    	  //$('#ggpaypal').submit();
					$('#ownit_'+id).remove();
					ownitajax = 1;
		      }
		});
	}
}

function markprocess (oid, process){
	var BaseURL=getBaseURL();
	var status = ".status"+oid;
	var curlist = "."+process+oid;
	var markloader = '';
	
	if (process == 'Processing'){
		markloader = ".process-loader-"+oid;
	}else if(process == 'Delivered'){
		markloader = ".buyerst-loader-"+oid;
	}
	if(process == 'Shipped'){
		window.location = BaseURL+'markshipped/'+oid;
		return;
	}else if(process == 'Track'){
		window.location = BaseURL+'trackingdetails/'+oid;
		return;
	}else if(process == 'ContactBuyer'){
		window.location = BaseURL+'sellerconversation/'+oid;
		return;
	}
	$.ajax({
	      url: BaseURL+"orderstatus",
	      type: "post",
	      data : { 'orderid': oid, 'chstatus': process},
		  beforeSend: function() {
			  if (markloader != ''){
				$(markloader).show();
			  }
			},
	      success: function(){
	    	  if (markloader != ''){
	    	  	$(markloader).hide();
	    	  }
				$(status).html(process);
	    	  //$('#ggpaypal').submit();
				$(curlist).remove();
				$('.moreactionlistmyord'+oid).slideToggle();
				if (process == 'Delivered'){
					$('.buyerstatusmarker'+oid).hide();
				}
	      }
	});
}

function loadpurchasedetails(oid){
	var BaseURL=getBaseURL();
	window.location = BaseURL+'buyerorderdetails/'+oid;
}

function contactseller(oid){
	var BaseURL=getBaseURL();
	window.location = BaseURL+'buyerconversation/'+oid;
}

function markshipped(){
	var BaseURL=getBaseURL();
	var orderid = $('#hiddenorderid').val();
	var buyeremail = $('#hiddenbuyeremail').val();
	var buyername = $('#hiddenbuyername').val();
	var subject = $('#emailsubject').val();
	var message = $('#emailmessage').val();
	$('.error').html('');
	
	if (subject == ''){
		$('.emailsubjecterror').html('Subject cannot be empty');
		return false;
	}else if(message == ''){
		$('.emailmessageerror').html('Message cannot be empty');
		return false;
	} 
	$.ajax({
	      url: BaseURL+"markshipped",
	      type: "post",
	      data : { 'orderid': orderid, 'buyeremail': buyeremail, 'subject': subject, 
	    	  		'message': message, 'buyername': buyername,},
		  beforeSend: function() {
				$('.markshipbtnloader').show();
			},
	      success: function(responce){
				$('.markshipbtnloader').hide();
				window.location = BaseURL+'orders';
	      }
	});
	return true;
}

function addtracking(){
	var BaseURL=getBaseURL();
	var shippingdate = $('#shipmentdate').val();
	var couriername = $('#couriername').val();
	var courierservice = $('#courierservice').val();
	var trackid = $('#trackingid').val();
	var notes = $('#notes').val();
	var orderid = $('#hiddenorderid').val();
	var buyeremail = $('#hiddenbuyeremail').val();
	var buyername = $('#hiddenbuyername').val();
	var orderstatus = $('#hiddenorderstatus').val();
	var address = $('#hiddenbuyeraddress').val();
	var id = $('#trackid').val();
	$('.error').html('');
	
	if (shippingdate == ''){
		$('.shipmentdateerror').html('Shipment Date cannot be empty');
		return false;
	}else if(couriername == ''){
		$('.couriernameerror').html('Courier Name cannot be empty');
		return false;
	}else if(trackid == ''){
		$('.trackingiderror').html('Tracking Id cannot be empty');
		return false;
	}
	
	$.ajax({
	      url: BaseURL+"updatetrackingdetails",
	      type: "post",
	      data : { 'orderid': orderid, 'buyeremail': buyeremail, 'orderstatus': orderstatus, 
	    	  		'address': address, 'buyername': buyername, 'shippingdate': shippingdate,
	    	  		'couriername': couriername, 'trackid': trackid, 'notes': notes,
	    	  		'courierservice': courierservice, 'id':id},
		  beforeSend: function() {
				$('.updatetrackingbtnloader').show();
			},
	      success: function(responce){
				$('.updatetrackingbtnloader').hide();
				//window.location = BaseURL+'orders';
	      }
	});
	return true;
}

function showInvoicePopup (id) {
	//alert(id);
	var baseurl = getBaseURL()+'users/viewinvoice/'+id;
	var element = '.inv-loader-'+id;
	if (invajax == 0) {
		invajax = 1;
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      beforeSend: function(){
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

function postordersellercomment() {
	var baseurl = getBaseURL()+'postordercomment';
	var orderid = $('#hiddenorderid').val();
	var merchantid = $('#hiddenmerchantid').val();
	var buyerid = $('#hiddenbuyerid').val();
	var comment = $('#mercntcmnd').val();
	var usrimg = $('#hiddenusrimg').val();
	var usrname = $('#hiddenusrname').val();
	var usrurl = $('#hiddenusrurl').val();
	var postedby = "seller";
	$('.postcommenterror').html("");
	if (comment == ''){
		$('.postcommenterror').html("Comment cannot be empty");
		return false;
	}
	if (invajax == 0) {
		invajax = 1;
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      data : { 'orderid': orderid, 'merchantid': merchantid, 'buyerid': buyerid, 
	    	  		'comment': comment, 'usrimg': usrimg, 'usrname': usrname, 'usrurl': usrurl, 
	    	  		'postedby': postedby},
		      beforeSend: function(){
		    	 $('.postcommentloader').show(); 
		      },
		      success: function(responce){
		          //alert(responce);
		    	$('.postcommentloader').hide(); 
			    $('.noordercmnt').html("");
			    //var previousmsg = $('.prvcmntcont').html();
			    //var currentmsg = responce + previousmsg;
		        //$('.prvcmntcont').html(currentmsg);
		        $('#mercntcmnd').val("");
		        invajax = 0;
		      }
		    });
	}
}

function postorderbuyercomment() {
	var baseurl = getBaseURL()+'postordercomment';
	var orderid = $('#hiddenorderid').val();
	var merchantid = $('#hiddenmerchantid').val();
	var buyerid = $('#hiddenbuyerid').val();
	var comment = $('#mercntcmnd').val();
	var usrimg = $('#hiddenusrimg').val();
	var usrname = $('#hiddenusrname').val();
	var usrurl = $('#hiddenusrurl').val();
	var postedby = "buyer";
	$('.postcommenterror').html("");
	if (comment == ''){
		$('.postcommenterror').html("Comment cannot be empty");
		return false;
	}
	if (invajax == 0) {
		invajax = 1;
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      data : { 'orderid': orderid, 'merchantid': merchantid, 'buyerid': buyerid, 
	    	  		'comment': comment, 'usrimg': usrimg, 'usrname': usrname, 'usrurl': usrurl, 
	    	  		'postedby': postedby},
		      beforeSend: function(){
		    	 $('.postcommentloader').show(); 
		      },
		      success: function(responce){
		          //alert(responce);
		    	$('.postcommentloader').hide(); 
			    $('.noordercmnt').html("");
			    //var previousmsg = $('.prvcmntcont').html();
			    //var currentmsg = responce + previousmsg;
		        //$('.prvcmntcont').html(currentmsg);
		        $('#mercntcmnd').val("");
		        invajax = 0;
		      }
		    });
	}
}

function date(){
	       var dateToday = new Date() ;
	       //alert(dateToday);
	       $("#datepicker").datepicker({  minDate:  dateToday })
	 
	     
	     
}
function enddate(){
	  //var date=$("#datepicker").val();
	  
	var start_date=$("#datepicker").val();
   	if(start_date!=''){
      var date=new Date(start_date);
      //alert("Currentc Date : "+date);
     var end= new Date(date.setDate(date.getDate()+1));
     // alert("Next Date : "+end);
	//var dateToday = new Date(new Date().getTime() + 24 * 60 * 60 * 1000) ;
	// alert(end);
     var dateToday = new Date(end) ;
    // alert(dateToday);
   

    $("#datepicked").datepicker({ minDate: dateToday
    })

   	}	
}


function hoteldet(){
    
	//alert(hi);
	
	var dateToday = new Date() ;
    //alert(dateToday);
	
		
		
	    $("#showdate").datepicker({  minDate:  dateToday });
	     
	   $("#showdate").click(function(){
	    	   start=$("#showdate").val();
	      $('#datepick').val(start);
	    });
}
function hotelend(){
	
	var checkin_date=$("#datepick").val();
	//alert(checkin_date);
	if(checkin_date!=''){
      var date=new Date(checkin_date);
      //alert("Currentc Date : "+date);
     var end= new Date(date.setDate(date.getDate()+1));
     // alert("Next Date : "+end);
	//var dateToday = new Date(new Date().getTime() + 24 * 60 * 60 * 1000) ;
	// alert(end);
     var dateToday = new Date(end) ;
    // alert(dateToday);
     $("#showdate").hide('slow');
   
    $("#showend").datepicker({ minDate: dateToday,showAnim: 'slideDown' })
    $("#showend").click(function(){
 	   start=$("#showend").val();
   $('#datepicked').val(start);
  
 
 });
   	}	
   	else
   		{
   	
   		$("#datepick").focus();
   	
   	 }
   	
}

function valid(){   
		
	var start_date=$("#owner_start").val();
	var end_date=$("#owner_end").val();
	var valuetax=$("#tax").val();
	
	
	
		var checkin_date=$("#datepick").val();
		var checkout_date=$("#datepicked").val();
		//var hi = checkout_date-checkin_date;
		
		//alert(checkout_date);
if((checkin_date>=start_date)&&(checkout_date<=end_date) && checkin_date<checkout_date)
	{		
	$("#success").html("Yes available go to cart ");
	$("#cart-button").show();
	$("#failed").hide();
	$("#success").show();
	
 adult=$("#adult").val();
 
	child=$("#child").val();
 both=+adult + +child;
 price=$("#price").val();
 peritem=price*both;
 checkin_date=$("#showdate").datepicker('getDate');
 checkout_date=$("#showend").datepicker('getDate');
// $('#total').val((Math.abs((checkout_date-checkin_date)/86400000)));
  days   = (checkout_date - checkin_date)/1000/60/60/24;
 total= "Your due is: $" +(peritem*days);
 alert(days);
 $('#total').val( total);
 var valuetax=$("#tax").val();
 valtax = valuetax*days;
 tax="tax include services :$"+(valtax);
$('#taxvalue').val(tax);
//summ= (+total + +valuetax);
tot=peritem*days;
overall="Overall due is :$"+(+tot + +valtax);
$('#tot1').val(overall);
 
	   // alert(summ);
 

	}
else
	{
	$("#failed").html("sorry check with other dates ");
	$("#cart-button").hide();
	$("#success").hide();
	$("#failed").show();
	$("#failed").fadeOut(14500)
	}
		
  
}


/*** Group Gift ****/

function showvideourll(videoId){
	$('#popup_container').show();
	$('#popup_container').css({"opacity":"1"}); 
	$('#videourrls').show();
	$('#add-to-list-new').hide();
	$('#popupforadditem').hide();
	$('#itemurls').hide();
	$('#popupcommision').hide();
	$('#slideshow-box').hide();		
}

function validateaddcart (){
	$('.addcarterror').html('');
	var sizeset = $('#sizeset').val();
	var qty = $('#qty_opt').val();
	if (sizeset == 1){
		var size = $('#size_opt').val();
		if (size == ''){
			$('.addcarterror').html('Select a size');
			return false;
		}
	}else if(qty == ''){
		$('.addcarterror').html('Select a Quantity');
		return false;
	}else {
		return true;
	}
}



/*** Shop can change user added fashion image stauts Show/hide ****/
function changeUserImgStatus(Id,statuss){
	$baseurl = getBaseURL();
	$eleid = "#statuss"+Id;
		$.ajax({
	      url: $baseurl+"changeuserimgstatuss/"+Id+"/"+statuss,
	      type: "post",
	      dataType: "html",
	      beforeSend: function () {
	    	  $("#loadd"+Id).show();
	      },
	      success: function(responce){
	          //alert(responce);
	    	  $("#loadd"+Id).hide();
	          $($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
}

/*** In Shop page user added image using ajax ****/

function inshopuseraddimage(){
	baseurl = getBaseURL();
	var loguserid=$("#loguserid").val();
	var shopIId=$("#shopIId").val();
	var srcimage = $("#image_computer").val();
	if(loguserid == 0){
		window.location.href=baseurl+"mobile/login";
		return false;
	}
	
	if(srcimage!=''){
		//$eleid = "#statuss"+Id;
		$.ajax({
	      url: baseurl+"inshopuseraddimage/"+loguserid+"/"+shopIId+"/"+srcimage,
	      type: "post",
	      dataType: "html",
	      beforeSend: function () {
	    	  $("#loadderss").show();
	      },
	      success: function(responce){
	    	  $("#loadderss").hide();
	    	  $('#popup_container').hide();
	    	  $('#showprofile').hide();
	          alert('Wait for shop approval');
	          //$($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
	}
}

/*** Shop can change user added In shop page image stauts Show/hide ****/

function changeStatusForuserphotoinshppage(Id,statuss){
	$baseurl = getBaseURL();
	$eleid = "#statuss"+Id;	
		$.ajax({
	      url: $baseurl+"changeStatusForuserphotoinshppage/"+Id+"/"+statuss,
	      type: "post",
	      dataType: "html",
	      beforeSend: function () {
	    	  $("#loaddsuId"+Id).show();
	      },
	      success: function(responce){
	          //alert(responce);
	    	  $("#loaddsuId"+Id).hide();
	          $($eleid).html(responce);
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
}

function openselectcate(){
	Baseurl = getBaseURL();
	  $('#selecttCate').show();
	  $('#WelcomePop').hide();
	  $('#WelcomePop3').hide();	
}

/***** Welcome popup *****/

function seleectccate(PCId){
	Baseurl = getBaseURL();
	$('#seleectccate'+PCId).toggleClass('seleectccateopac');
	
	if($('#seleectccate'+PCId).hasClass('seleectccateopac')){
		allcatvaluess.push(PCId);
	}else{
		allcatvaluess.splice(allcatvaluess.indexOf(PCId),1);	
	}
}


$('#sbmtcategg').live('click' , function(){
	Baseurl = getBaseURL();
	if(allcatvaluess!=''){
	$.ajax({
	      url: Baseurl+"users/savecategoryLists/"+allcatvaluess,
	      type: "post",
	      dataType: "html",
	      beforeSend: function () {
	    	  $("#loaddsusId").show();
	      },
	      success: function(responce){
	    	  //alert(responce);
	    	  $("#loaddsusId").hide();
	    	  $('#selecttCate').hide();
	    	  $('#WelcomePop').hide();	
	    	  $('#WelcomePop3').show();
	      },
	      error:function(){
	          alert("An unexpected error has occurred!");
	      }   
	    }); 
	}else{
		alert("Please select atleast one category");
	}
	

});



function itemlikefirsttime(id){
	var likedbtncnt = $("#likedbtncnt").val();
	var likebtncnt = $("#likebtncnt").val();
	$.post(BaseURL+'userlike', {"itemid":id},
			function(datas) {
			$(".itemdd"+id).html(likedbtncnt);
			$('#ddheart'+id).addClass('heart');
			$('#ddheart'+id).removeClass('heart_empty');
			$('#dd'+id).removeClass('fantacy');
			$('#dd'+id).addClass('fantacyd');
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
				
			});
}

function afterfirstlike(){
	
	$("#loaddsusId").hide();
	$('#selecttCate').hide();
	$('#WelcomePop').hide();	
	$('#WelcomePop3').hide();
	$('#WelcomePopup4').show();

}

$('#sbmtcategg4').live('click' , function(){
	$("#loaddsusId").hide();
	$('#selecttCate').hide();
	$('#WelcomePop').hide();	
	$('#WelcomePop3').hide();
	$('#WelcomePopup4').hide();
	$('#WelcomePopup5').show();

});


$('#sbmtcategg5').live('click' , function(){
	Baseurl = getBaseURL();
	window.location.href=Baseurl;
});





/***** Welcome popup *****/


