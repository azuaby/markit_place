<html>
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
body.tagger-js {
	background: none repeat scroll 0 0 #EFF1F7;
}
.header {
	background-color: #FDFDFD;
	padding: 6px 0 6px 20px;
	border-bottom: 1px solid #D3D5DA;
}
.notloggedin {
	text-align: center;
	font-size: 14px;
	color: #fd2525;
	font-weight: bold;
}
.header img {
	vertical-align: top;
}
.main {
	background-color: #FFFFFF;
	padding: 20px;
}
.header .close_box {
	float: right;
}
.main p {
	line-height: 133%;
}
.footer {
	background-color: #EFF1F7;
	color: #4C515C;
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
img.f-preview {
	border: 1px solid #D3D5DA;
	margin-bottom: 5px;
	max-height: 100px;
	max-width: 200px;
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
#f-tagger .f-preview {
margin: 0;
vertical-align: middle;
}
#main.f-tagger {
width: 620px;
}
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
<script type="text/javascript">
function closebookmarklet(){
	//alert('closing start');
	window.parent.document.getElementById('instacalc_bookmarklet').innerHTML='';
	//alert('closing end');
}
</script>

</head>
<body>

<div id="main">

<div class="header">
<img src="images/logo/logo.png">
<a href="#" id="closebt"><img src="images/closebtnbk.png" style="position: absolute; top: 10px;opacity: 0.8; right: 8px;" /></a>
</div>
<br />
<div class='notloggedin'>
Please login and then try again.
</div>
</div>

</body>
</html>
