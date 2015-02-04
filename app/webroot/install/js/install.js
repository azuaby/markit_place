var gsiteurl;
var dbname,dbpass,dbuser,dbhost;

function contnue() {
	console.log("continue JS");
	$('.confirmation').hide();
	$('.step1').fadeIn('slow');
}

function back(level) {
	if (level == 1){
		$('.step1').hide();
		$('.confirmation').fadeIn('slow');
	}else if (level == 2){
		$('.step2').hide();
		$('.step1').fadeIn('slow');
	}else if (level == 3){
		$('.step3').hide();
		$('.step2').fadeIn('slow');
	}else if (level == 4){
		$('.step5').hide();
		$('.step4').fadeIn('slow');
	}
}

function skip() {
	console.log("skip");
	$('.step4').hide();
	$('.step5').fadeIn('slow');
}

function loadsite() {
	$.ajax({
	      url: 'writer.php',
	      type: "post",
	      data: {filetype: 'remove'},
	      dataType: "text",
	      beforeSend: function () {
	    	  	$('.loading').show();
	    	  },
	      success: function(responce){
	    	  	$('.loading').hide();
	      }
	    });
	window.location = '/';
}

function step1() {
	console.log('Step1 JS');
	$('.errormsg').html('');
	var sitename = $('#sitetitle').val();
	var siteurl = $('#siteurl').val();
	var sp = siteurl.split('/');
	var splen = sp.length - 1;
	
	if (sp[splen] != ""){
		siteurl += "/";
	}
	gsiteurl = siteurl;
	
	if (sitename == ''){
		$('.errormsg').html('Website Name cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}else if (sp[0] != 'http:' || sp[1] != ''){
		$('.errormsg').html('Enter a valid Website URL ex.http://example.com/');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}else if (siteurl == ''){
		$('.errormsg').html('Website URL cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}
	
	$.ajax({
      url: 'writer.php',
      type: "post",
      data: {siteurl: siteurl, sitename: sitename, filetype: 'config'},
      dataType: "text",
      beforeSend: function () {
    	  	$('.loading').show();
    	  },
      success: function(responce){
    	  	$('.loading').hide();
          if (responce == 'success'){
        	  $('.step1').hide();
        	  $('.step2').fadeIn('slow');
          }else {
        	  $('.errormsg').html(responce);
        	  $('.errormsg').slideToggle();
        	  setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
          }
      },
      failure: function(){
    	$('.errormsg').html('Something went wrong check the Website URL');
  		$('.errormsg').slideToggle();
  		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
  		return  false;
      }
    });
	return false;
	
}

function step2() {
	console.log('Step2 JS');
	$('.errormsg').html('');
	dbname = $('#dbname').val();
	dbhost = $('#dbhost').val();
	dbuser = $('#dbusername').val();
	dbpass = $('#dbpassword').val();
	
	if (dbname == ''){
		$('.errormsg').html('Database Name cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}else if (dbhost == ''){
		$('.errormsg').html('Host Name cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}else if (dbuser == ''){
		$('.errormsg').html('Database Username cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}else if (dbpass == ''){
		$('.errormsg').html('Database Password cannot be Empty');
		$('.errormsg').slideToggle();
		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
		return  false;
	}
	$.ajax({
      url: 'writer.php',
      type: "post",
      data: {dbname: dbname, dbhost: dbhost, dbusername: dbuser, dbpassword: dbpass, filetype: 'database'},
      dataType: "text",
      beforeSend: function () {
    	  	$('.loading').show();
    	  },
      success: function(responce){
    	  	$('.loading').hide();
          if (responce == 'success'){
        	  $('.step2').hide();
        	  $('.step3').fadeIn('slow');
          }else {
        	  $('.errormsg').html(responce);
        	  $('.errormsg').slideToggle();
        	  setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
          }
      },
      failure: function(){
    	$('.errormsg').html('Something went wrong');
  		$('.errormsg').slideToggle();
  		setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
  		return  false;
      }
    });
	return false;
	
}

function step3() {
	$.ajax({
      url: 'writer.php',
      type: "post",
      data: {dbname: dbname, dbhost: dbhost, dbusername: dbuser, dbpassword: dbpass, filetype: 'databaseinstall'},
      dataType: "text",
      beforeSend: function () {
    	  	$('.loading').show();
    	  },
      success: function(responce){
    	  	$('.loading').hide();
          if (responce == 'success'){
        	  $('.step3').hide();
        	  $('.step4').fadeIn('slow');
          }else {
        	  $('.errormsg').html(responce);
        	  $('.errormsg').slideToggle();
        	  setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
          }
      },
      failure: function(){
    	$('.errormsg').html('Something went wrong');
  		$('.errormsg').slideToggle();
  		setTimeout(function(){$('.errormsg').slideToggle();}, 3000);
      }
    });
	return false;
}

function step4() {
	$.ajax({
      url: 'writer.php',
      type: "post",
      data: {dbname: dbname, dbhost: dbhost, dbusername: dbuser, dbpassword: dbpass, filetype: 'demodata'},
      dataType: "text",
      beforeSend: function () {
    	  	$('.loading').show();
    	  },
      success: function(responce){
    	  	$('.loading').hide();
          if (responce == 'success'){
        	  $('.step4').hide();
        	  $('.step5').fadeIn('slow');
          }else {
        	  $('.errormsg').html(responce);
        	  $('.errormsg').slideToggle();
        	  setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
          }
      },
      failure: function(){
    	$('.errormsg').html('Something went wrong');
  		$('.errormsg').slideToggle();
  		setTimeout(function(){$('.errormsg').slideToggle();}, 3000);
      }
    });
	return false;
}

function step5() {
	var currencycode = $('#currencycode').val();
	$.ajax({
      url: 'writer.php',
      type: "post",
      data: {dbname: dbname, dbhost: dbhost, dbusername: dbuser, dbpassword: dbpass, 
    	  		currencycode: currencycode, filetype: 'currency'},
      dataType: "text",
      beforeSend: function () {
    	  	$('.loading').show();
    	  },
      success: function(responce){
    	  	$('.loading').hide();
          if (responce == 'success'){
        	  $('.step5').hide();
        	  $('.finishpopup').fadeIn('slow');
          }else {
        	  $('.errormsg').html(responce);
        	  $('.errormsg').slideToggle();
        	  setTimeout(function(){$('.errormsg').slideToggle();}, 3000); 
          }
      },
      failure: function(){
    	$('.errormsg').html('Something went wrong');
  		$('.errormsg').slideToggle();
  		setTimeout(function(){$('.errormsg').slideToggle();}, 3000);
      }
    });
	return false;
}