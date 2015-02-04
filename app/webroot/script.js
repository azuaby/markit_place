var siteURL = 'http://fantacyscript.com/';
var imgdata;
(function (e, a, g, h, f, c, b, d) {
 if (!(f = e.jQuery) || g > f.fn.jquery || h(f)) {
     c = a.createElement("script");
     c.type = "text/javascript";
     c.src = "http://ajax.googleapis.com/ajax/libs/jquery/" + g + "/jquery.min.js";
     c.onload = c.onreadystatechange = function () {
         if (!b && (!(d = this.readyState) || d == "loaded" || d == "complete")) {
             h((f = e.jQuery).noConflict(1), b = 1);
             f(c).remove()
         }
     };
     a.documentElement.childNodes[0].appendChild(c)
 }
})

function getEmbed(){
var e = window.frames["instacalc_bookmarklet_iframe"];
return e;
}

function addCSS(url){
var headID = document.getElementsByTagName("head")[0];
var cssNode = document.createElement('link');
cssNode.type = 'text/css';
cssNode.rel = 'stylesheet';
cssNode.href = url;
cssNode.media = 'screen';
headID.appendChild(cssNode);
}

var END_OF_INPUT = -1;
var base64Chars = new Array(
 'A','B','C','D','E','F','G','H',
 'I','J','K','L','M','N','O','P',
 'Q','R','S','T','U','V','W','X',
 'Y','Z','a','b','c','d','e','f',
 'g','h','i','j','k','l','m','n',
 'o','p','q','r','s','t','u','v',
 'w','x','y','z','0','1','2','3',
 '4','5','6','7','8','9','+','/'
);

var reverseBase64Chars = new Array();
for (var i=0; i < base64Chars.length; i++){
 reverseBase64Chars[base64Chars[i]] = i;
}

var base64Str;
var base64Count;
function setBase64Str(str){
 base64Str = str;
 base64Count = 0;
}
function readBase64(){    
 if (!base64Str) return END_OF_INPUT;
 if (base64Count >= base64Str.length) return END_OF_INPUT;
 var c = base64Str.charCodeAt(base64Count) & 0xff;
 base64Count++;
 return c;
}
function encodeBase64(str){
 setBase64Str(str);
 var result = '';
 var inBuffer = new Array(3);
 var lineCount = 0;
 var done = false;
 while (!done && (inBuffer[0] = readBase64()) != END_OF_INPUT){
     inBuffer[1] = readBase64();
     inBuffer[2] = readBase64();
     result += (base64Chars[ inBuffer[0] >> 2 ]);
     if (inBuffer[1] != END_OF_INPUT){
         result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30) | (inBuffer[1] >> 4) ]);
         if (inBuffer[2] != END_OF_INPUT){
             result += (base64Chars [((inBuffer[1] << 2) & 0x3c) | (inBuffer[2] >> 6) ]);
             result += (base64Chars [inBuffer[2] & 0x3F]);
         } else {
             result += (base64Chars [((inBuffer[1] << 2) & 0x3c)]);
             result += ('=');
             done = true;
         }
     } else {
         result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30)]);
         result += ('=');
         result += ('=');
         done = true;
     }
     lineCount += 4;
     if (lineCount >= 76){
         result += ('\n');
         lineCount = 0;
     }
 }
 return result;
}

/* make string URL safe; remove padding =, replace "+" and "/" with "*" and "-" */
function encodeBase64ForURL(str){
var str = encodeBase64(str).replace(/=/g, "").replace(/\+/g, "*").replace(/\//g, "-");
str = str.replace(/\s/g, "");   /* Watch out! encodeBase64 breaks lines at 76 chars -- we don't want any whitespace */
return str;
}

function keyPressHandler(e) {
   var kC  = (window.event) ?    // MSIE or Firefox?
              event.keyCode : e.keyCode;
   var Esc = (window.event) ?   
             27 : e.DOM_VK_ESCAPE // MSIE : Firefox
   if(kC==Esc){
      // alert("Esc pressed");
      toggleItem("instacalc_bookmarklet");
   }
}


function toggleItem(id){
var item = document.getElementById(id);
if(item){
 if ( item.style.display == "none"){
   item.style.display = "";
 }
 else{
   item.style.display = "none";
 } 
}
}

function showItem(id){
try{
 var item = document.getElementById(id);
 if(item){
     item.style.display = "";
 }
}
catch(e){

}
}

(function(){

function logDebug() {
if(console) {
  if(console.log) {
    console.log(arguments.title);
  }
}
}

var BIG_DIMENSION = 250,      // min width of image that counts as big
   THUMBNAIL_SIZE = 250;

logDebug("Bookmarklet and jQuery is ready");
//alert($("img"));
var allImages = $("img");
var bigImages = allImages.filter(function() {
 return getRealWidth(this) >= BIG_DIMENSION || getRealHeight(this) >= BIG_DIMENSION;
});
var data = {};
var j = 0;
var bigImageSrcs = bigImages.map(function(i, e){
		if($(e).attr("src")){
		data[j] = $(e).attr("src");
		data[j] = data[j].replace("http://", "http");
		//data[j] = data[j].replace("https://", "**");
		j += 1;
		return $(e).attr("src");
		}
	
})

logDebug("Number of images", allImages.length, " and big images", bigImages.length);
logDebug("Big Images are");
$.each(bigImageSrcs, function(i,s) {
 logDebug(i, s);
});

$.fn.centerMe = function () {
// return $(this).css({'left': $(window).width()/2 - $(this).width()/2, 'top': $(window).height()/2 - $(this).height()/2});
	  return $(this).css({'left': $(window).width()/2 - $(this).width()/2, 'top': 0});
};

function getRealWidth(elem) {
 if (elem.naturalWidth) {
   return elem.naturalWidth;
 } else {
   return $(elem).width();
 }
}
function getRealHeight(elem) {
 if (elem.naturalHeight) {
   return elem.naturalHeight;
 } else {
   return $(elem).height();
 }
}


function aElem(tag, attrs, child) {
 var elem = $("<"+tag+" />").attr(attrs);
 var childArray = $.makeArray(child);
 $.each(childArray, function(i, c){
   elem.append(c);
 });
 return elem;
}

function aElemClass(tag, classes, child) {
 return aElem(tag, {"class":classes}, child);
}

function aElemId(tag, id, child) {
 return aElem(tag, {id:id}, child);
}

imgdata = bigImageSrcs;

var out =  imgdata;

jsondata = JSON.stringify(data);
var titles = document.title;

var sites_url = document.URL;

sites_url = sites_url.replace("http://", "http");
main_url = siteURL.replace("http://", "");

var iframe_url = siteURL+"bookmark.php" + "?imge=" + encodeURIComponent(jsondata) + "&lengt=" + out.length + "&siteUrl=" + encodeURIComponent(sites_url)+ "&titles=" + encodeURIComponent(titles)+ "&mainurl=" + encodeURIComponent(main_url);

//var iframe_url = "http://fancyclone.net/dev/bookmark.php" + "?imge=" + encodeURIComponent(jsondata)+ "&lengt=" + out.length;

addCSS(siteURL+"bookmarkcss.css");

var div = document.createElement("div");
div.id = "instacalc_bookmarklet";

var str = "";
str += "<table id='instacalc_bookmarklet_table' valign='top' width='0' cellspacing='0' cellpadding='0'><tr><td width ='0' height='0'>";
str += "<iframe frameborder='0' scrolling='no' name='instacalc_bookmarklet_iframe' id='instacalc_bookmarklet_iframe' src='" + iframe_url + "' width='273px' height='340px' style='textalign:right; backgroundColor: white;'></iframe>";
str += "</td><td style='font-size: 29px;position: absolute;right: 8px;opacity:1;vertical-align: top;top: 0px;' onClick='toggleItem(\"instacalc_bookmarklet\");'  title='click to close window' valign='top' align='center' width='20px'>";
str += "<a href='javascript:void(0);' style='width:100%; text-align: center; color: #4d4d4d;text-decoration:none;'>x</a>";
str += "</td></tr></table>";

div.innerHTML = str;

div.onkeypress = keyPressHandler;
document.body.insertBefore(div, document.body.firstChild);
})()
