<html id="maindev">
<head>
<title>Markit</title>
<style>
* {
	list-style: none outside none;
	margin: 0;
	padding: 0;
}
fieldset, img, button {
	border: 0 none;
}
button {
	cursor: pointer;
}
body {
	background: none repeat scroll 0 0 #FFFFFF;
	color: black;
	font-family: "Helvetica Neue","Helvetica","Arial",sans-serif;
	font-size: 13px;
	line-height: 18px;
}
p {
	padding-bottom: 20px;
}

.header {
	background-color: #FDFDFD;
	padding: 6px 0 6px 20px;
	border-bottom: 1px solid #D3D5DA;
}
.header img {
	vertical-align: top;
}
.main {
	background-color: #FFFFFF;
	padding: 8px;
	position:relative;
}
.header .close_box {
	float: right;
}
.main p {
	line-height: 133%;
}
.footer {
	//background-color: #EFF1F7;
	//color: #4C515C;
	padding: 10px 20px;
}
.footer a.l2 {
	color: #4C515C;
	margin-left: 20px;
	text-decoration: none;
}
.f-button {
	background: -moz-linear-gradient(center top , #F0F0F0, #D9D9D9) repeat scroll 0 0 transparent;
			border: 1px solid #8A8F9C;
			border-radius: 5px 5px 5px 5px;
	color: #000000;
	display: inline-block;
	font-weight: bold;
	height: 30px;
	line-height: 30px;
	padding: 0 7px 1px;
	text-align: center;
	text-decoration: none;
	text-shadow: 0 1px 0 white;
	width: auto;
}
.f-button:hover {
	background: -moz-linear-gradient(center top , #F0F0F0, #D9D9D9) repeat scroll 0 0 transparent;
			border-color: #4C515C;
			color: #000000;
			text-decoration: none;
}
.f-button:active {
	background: -moz-linear-gradient(center top , #D9D9D9, #F0F0F0) repeat scroll 0 0 transparent;
			color: #000000;
			text-decoration: none;
	text-shadow: none;
}
.f-field {
	border: 1px solid #D3D5DA;
	display: block;
	font-family: 'Helvetica Neue',Arial,sans-serif;
	font-size: 13px;
	margin-bottom: 5px;
	padding: 5px;
	width: 225px;
}
#f-category-for-thing, #f-category, .second-tab select {
border: 1px solid #D3D5DA;
padding: 5px;
width: 225px;
}
#f-imgpick a {
display: inline-block;
margin: 0 5px 20px 0;
}
img.imgview {
    border: 1px solid #D3D5DA;
    margin-bottom: 10px;
    margin-left: 60px;
    max-height: 100px;
    max-width: 200px;
}
#countdown {
margin-left: 5px;
margin-top: 10px;
}
#prev{
	left: 0;
    position: absolute;
    top: 50px;
}
#next{
    position: absolute;
    right: 0;
    top: 50px;
}
/* 
body.tagger-js {
	background: none repeat scroll 0 0 #EFF1F7;
}

#f-tagger {
background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAMAAAC6sdbXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF5eXl////4sXsSQAAAAJ0Uk5T/wDltzBKAAAAGUlEQVR42mJgYAQCBkYGMAlFUD4jA0CAAQABSgAVvm3obwAAAABJRU5ErkJggg==");
background-position: left top;
background-repeat: repeat;
height: 100px;
line-height: 98px;
margin: 5px 0;
text-align: center;
width: 200px;
} 
#f-tagger .imgview {
margin: 0;
vertical-align: middle;
}
#main.f-tagger {
width: 620px;
}*/
.status-msg {
	display: none;
	line-height: 30px;
	margin-left: 5px;
}
#if-success .center {
text-align: center;
}
#if-success .f-button {
width: 206px;
}
</style>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

var first = getUrlVars()["imge"];
var total_img_coun = getUrlVars()["lengt"];
var notlogged = getUrlVars()["notloggin"];
var siteUrl = getUrlVars()["siteUrl"];
var titles = getUrlVars()["titles"];
var mainurl = getUrlVars()["mainurl"];
mainurl = "http://"+decodeURIComponent(mainurl);



if(notlogged =="yes"){
	//var win=window.open(mainurl+"login", '_blank');
 	//win.focus();
 	window.location.href = mainurl+"bookmarknotlogin.php";
}

first = decodeURIComponent(first);
var array = JSON.parse(first); 

$(document).ready(function(){
var im = 0;
	$('#prev').click(function(){
		if(im>0){
			im-=1;
			$('#r_image').attr('src', array[im].replace("http", "http://"));
		}
	});
	
	$('#next').click(function(){
		if(total_img_coun>im){
			im+=1;
			$('#r_image').attr('src', array[im].replace("http", "http://"));
		}
	});
	
	
	if ($('#r_image').attr('src')) {
		im = 0;
		$('#r_image').attr('src', array[im].replace("http", "http://"));
	} else {
		alert('Blank');
	}

	//alert(titles);
	var title = decodeURIComponent(titles);
	$('#title_g').val(title);
	//alert(title);
	
	$('#savveimg').click(function(){
		var img_ite = $("#r_image").attr("src");
		var description = $("#description_g").val();
		var itmeprices = $("#price_g").val();
		//var description = '';
		var title = $("#title_g").val();
		var category = $("#category").val();
		/*if(title == ''){
			alert('Enter the title');
			return false;
		}
		if(description == ''){
			alert('Enter the description');
			return false;
		}*/
		if(category == ''){
			alert('Select the category');
			return false;
		}

		//alert(mainurl);
		
		img_ite = img_ite.replace("http://", "http");
		img_ite = img_ite.replace("//", "http");
		siteUrl = siteUrl.replace("http://", "http");
		//alert("http://localhost:9002/fred/bookmarklet?id="+img_ite+"&tit="+title+"&descr="+description+"&site_ridirect="+siteUrl);
		window.location.href = mainurl+"bookmarklet?id="+img_ite+"&tit="+title+"&descr="+description+"&site_ridirect="+siteUrl+"&itmeprices="+itmeprices;
	 /* $.ajax({
	      url: "http://fancyclone.net/devddd/bookmarklet?id="+itemId,
	      type: "get",
	      dataType: "html",
	      success: function(responce){
	          alert(responce);
	      }
	    });  */
	});

		
});

//alert('Outside1');
</script>

</head>
<body>
<div id="main">

<form action="" >
<div class="header">
<img src="images/logo/logo.png">
<a href="#" id="closebt">
<!-- <img src="images/closebtnbk.png" style="position: absolute; top: 10px;opacity: 0.8; right: 8px;" /> -->
</a>
</div>
<div class="main">
<fieldset>
<img id="r_image" class="imgview" src="#" >



<div id="f-imgpick">
<a id="prev" href="#" >
<img src="images/leftarr.png">
</a>
<a id="next" href="#">
<img src="images/rightarr.png">
</a>
</div>
<input id="title_g" class="f-field" type="text" name="title_g" value="">
<input id="price_g" class="f-field" type="text" name="price_g" placeholder="Price">
<input id="description_g" class="f-field f-ghost" type="text" maxlength="200" placeholder="Short Description" name="description_g">
<select id="category" size="1" name="category">
<option value="">Select category</option>
<option value="Mens">Men's</option>
<option value="Womens">Women's</option>
<option value="Kids">Kids</option>
<option value="Pets">Pets</option>
<option value="Home">Home</option>
<option value="Gadgets">Gadgets</option>
<option value="Art">Art</option>
<option value="Food">Food</option>
<option value="Media">Media</option>
<option value="Other">Other</option>
</select>
</fieldset>
</div>
<div class="footer">
<a class="f-button add_new_thing" id="savveimg"  href="#">Save</a>
<!--a class="l2 cancel_add_thing" href="#">Cancel</a-->
</div>
</form>
<div id="iframess">

</div>

</div>


</body>
</html>
