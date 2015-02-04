<div class="ui-body ui-body-a" style="border-radius:5px;font-size:13px;">
<div id="container-wrapper">
	<div class="container invite-new" style="top: 0px;">
		<div class="wrapper-content">
   		 <h2>Invite Friends to <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?><br /> <small style="color:#CACDD0">Invite your friends and earn credits when they <?php echo __('join'); ?>.</small></h2>
   			 <hr /><div class="how-to">
        
		<dl class="sns">
			<h3>Social network <br /><small style="color:#CACDD0">Invite friends to <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> from your social networks</small></h3>
			
			<table width="100%"><thead><tr><th></th><th></th></tr></thead>
			<tbody><tr><td>
				<button class='btn-facebook' onclick="FacebookInviteFriends();"  id='fb-invite-all'><img src="<?php echo SITE_URL.'images/facebook.png'; ?>"><span class="soci_letter"> Facebook</span></button>
				</td></tr>
				<tr><td>
				<button class="btn-twitter-dlg"><img src="<?php echo SITE_URL.'images/twittershare.png'; ?>"> <span class="soci_letter"  style="right: 42px;"> Twitter</span></button>
				</td></tr>
				<tr><td>
				<button  id="google_invite" ><img src="<?php echo SITE_URL.'images/gshare.png'; ?>"><span class="soci_letter"> Google+</span></button>
				</td></tr>
				<tr><td>
				<button id="gmail_invite"><img src="<?php echo SITE_URL.'images/gmail.png'; ?>"><span class="soci_letter" style="right: 50px;"> Gmail</span></button>
				</td></tr></tbody></table>
			
			<p style="font-size:13px;line-height:18px;">We won't share your contacts with anybody or email anyone without your consent.</p>
</dl>
		
			<?php 
			
			$siteurlsfor_ref = 'http://fancyclone.net/demo/signup?referrer='.$username.'';
			//$siteurlsfor_ref = $siteur;
			$siteurlsref = UrlfriendlyComponent::getUrlShorten($siteurlsfor_ref); 
			?>
		
		<input type="hidden" id="short_urls" value="<?php echo $siteurlsref; ?>" >
		<dl class="link">
			<h3>Referral link<br /> <small style="font-size:13px;line-height:18px;">Use this link to share on Twitter, Facebook or in an Email.</small><h3>
			<dd><fieldset>
		
				<input type="text" class="text" value="<?php echo $siteurlsref; ?>" id="message-to-post"/>
				<?php echo '<button class="btns-blue-embo" id = "zclipp" >Copy link</button>'; ?>
			</fieldset>
			<div class="alert-copy">Referral link was copied to clipboard.</div>
		
			<br /><br />
				
				<a style="float: left;margin-left: 3px;" class='facebook' href="#" alt="Share this on facebook" onclick="socialsharef();"><img src="<?php echo SITE_URL; ?>images/facebook.png"></a> 
				<a style="float: left;margin-left: 3px;" class='twitter' href="#" alt="Share this on twitter"  onclick="socialsharetwt();"><img src="<?php echo SITE_URL; ?>images/twittershare.png"></a>
				<a style="float: left;margin-left: 3px;" class='google'  href="#" alt="Share this on Google+" onclick="socialshareg();"><img src="<?php echo SITE_URL; ?>images/gshare.png"></a>
				<a style="float: left;margin-left: 3px;" class='linkedin' href="#" alt="Share this on linkedin"  onclick="socialsharel();"><img src="<?php echo SITE_URL; ?>images/linkshare.png"></a>
				<a style="float: left;margin-left: 3px;" class='stumbleupon' alt="Share this on stumbleupon" href="#" onclick="socialshares();"><img src="<?php echo SITE_URL; ?>images/stumbleupon.png"></a>
				<a style="margin-left: 3px;float: left;"class='tumblr' href="#" alt="Share this on tumblr"  onclick="socialsharetum();"><img src="<?php echo SITE_URL; ?>images/tumblrshare.png"></a>
			
			<br /><br />

			
			<br /><p style="font-size:16px;">
				<small><b>Tip!</b> Earn more credits by sharing your link with friends on social networks.</small></p></dd>
		</dl>
		<dl class="via">
			<dt><h3>Invite via email<br /> <small style="color:#CACDD0">Invite your friends to Fancy via email.</small></h3></dt>
			<dd><fieldset>
				<div class="email-frm">
					<span class="add" tabindex="0" style="display: inline;"><span class="ui-text">Enter your friends email address</span></span>
					<input type="text" class="text" style="display:none;" onkeyup="emailEnd(event.keyCode)">
				</div>
				
				<textarea class="text inviaemailnotes" name="additionalnotes" placeholder="Add a personal note (optional)"></textarea>
				<button class="btns-blue-embo invite-friends-by-email">Send Invites</button>
				<span class="after-sent" style="display:none;">Invites Sent!</span>
			</fieldset></dd>
		</dl>
</div>		
<p class="bonus" style="font-size:13px;">
	<b >Bonus!</b>
	You will be rewarded with <?php echo $_SESSION['default_currency_symbol'].$creditAmount['credit_amount'];?> if your friend signs up and makes a purchase within 60 days.
		
</p>

</div>



<div id="popup_container" style="display:none;">
<div class="popup ly-title reply-popup" >
</div>

<div class="popup invite-twitter ly-title invite">
    <p class="ltit">User Contacts</p>
    
    <!-- list -->
    <dl class="invite-new">
    	<form action="<?php echo SITE_URL.'sendinviteemail'; ?>" method="post">
        <dt><b>Invite friends and family to <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?></b> <small>Select the people you want to invite to <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> and get <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> Credits.</small></dt>
		<dd class="scroll">
      	<?php 
      	if(isset($user_contacts)){
      	foreach($user_contacts as $contact ){
      				$img = $contact->photoURL;
      				$displaname = $contact->displayName;
      				$useridentifier = $contact->identifier;
      				echo '<div class="userc">';
					echo '<img src="'.$img.'" title="Invite" style="float: left; margin: 10px;"/>';
					echo '<span  style="float: left; margin: 26px 0px 1px;">'.$displaname.'</span>';
       				echo '<a style="float: right;margin: 9px 13px;" onclick="invitetweet(\''.$useridentifier.'\');" class="btns-blue-embo" ><span class="invite_tw'.$useridentifier.'">Invite</span></a>';
					//echo '<button class="btn-invite" id="btn_close_twit" title="Invite">';
					 //. " " . $contact->profileURL . "<hr />";
					 echo '</div>';
					 echo "<br clear='all'/ >";
		} 
		} 
		
		if(isset($result)){
		foreach ($result as $title) {	
				$emails = $title->attributes()->address;		
				echo '&nbsp;&nbsp;<input type="checkbox" name="data[field][]" value="'.$emails.'">&nbsp;&nbsp;&nbsp;';
				echo $email_adderss[] = $title->attributes()->address;
				echo "<br />";
		}
		}
		?>
		
		</dd>
		<?php if(isset($result)){ ?>
		<input type="Submit" class="btns-blue-embo" value="Invite" title="Invite">
		<?php } ?>
		</form>
    </dl>
    <button class="ly-close" id="btn_close_twit" title="Close"><img src="<?php echo SITE_URL.'images/closebt.png'; ?>" ></button>
</div>

</div>
<!-- /popups -->

<!-- / content -->
		<footer id="footer">
			<a href="https://twitter.com/markitkw" class="follow-twitter">Follow on Twitter</a>
			
			
				<a href="<?php echo SITE_URL.'help'; ?>">Help</a>
				<a href="<?php echo SITE_URL.'help'; ?>/contact">Contact</a>
				<a href="<?php echo SITE_URL.'help'; ?>/terms_service">Terms</a>
			
			<!-- / footer-nav -->
		</footer>
	</div>
	<!-- / container -->
</div>
 <script src="http://connect.facebook.net/en_US/all.js">
   </script> <script src="http://www.steamdev.com/zclip/js/jquery.zclip.min.js">
   </script>
   <script>
 FB.init({ 
       appId:'657287144301044', cookie:true, 
       status:true, xfbml:true 
     });
			

function FacebookInviteFriends()
{
FB.ui({ method: 'apprequests', 
   message: 'Invitation from <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?>...'});
}



    $('button.btn-twitter-dlg').click(function(){
   		var BaseURL=getBaseURL();
   		window.location=BaseURL+'invite_friends/Twitter';
   	

 });



	function invitetweet(tweetname){
	//alert(tweetname); 
	var BaseURL=getBaseURL();
	$.post(BaseURL+'invite_twit_msg', {"tweetname":tweetname},
					function(datas) {
						$('.invite_tw'+tweetname).html("Invited");
					}
				);
	}

	


<?php

if(isset($user_contacts) || isset($email_adderss)){
?>
   	$('#popup_container').show();
   	$('#popup_container').css({"opacity":"1"});
   	$('.popup').show();
   	
   	
<?php
	}
?>
   	

$('#btn_close_twit').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"});
		$('.popup').hide();
    });
    
    
   $('#google_invite').click(function(){
  		//alert('aaa');
		var BaseURL=getBaseURL();
		//$('.google').attr('href', 'http://plus.google.com/share?url='+encry_urlss);
		newwindow=window.open('http://plus.google.com/share?url='+BaseURL,'name','height=600,width=600');
		
		
    });
    
    
     $('#gmail_invite').click(function(){
		var BaseURL=getBaseURL();
		//localo////window.location = 'https://accounts.google.com/o/oauth2/auth?client_id=146312791564-0cial8qh35dr3ekjqs3cjkf0gomjd2p6.apps.googleusercontent.com&redirect_uri='+BaseURL+'invite_friends/Google/&scope=https://www.google.com/m8/feeds/&response_type=code'
	 	window.location = 'https://accounts.google.com/o/oauth2/auth?client_id=146312791564.apps.googleusercontent.com&redirect_uri='+BaseURL+'invite_friends/Google/&scope=https://www.google.com/m8/feeds/&response_type=code'
	 
	 	
	 });
	
   </script>
<script>
    var email_addrs = [];
    function add_email(addr){
	if(/[\w\-\.\+]+@[\w\-\.]+[a-z]+/.test(addr)){
            if($.inArray(addr,email_addrs) === -1) email_addrs.push(addr);
	}
    }
    function remove_mail(addr){
	var index = email_addrs.indexOf(addr);
	email_addrs.splice(index,1);
    }
   
    $('.email-frm .add').click(function(){
	$(this).hide().parents('.email-frm').addClass('focus').find('input').show().focus();
    });
    $('.email-frm input[type="text"]').blur(function(){
	var email_a = $(this).val().replace(",","");
	var email = email_a.replace(" ","");
	$(this).parents('.email-frm').removeClass('focus');
	if(email==''){$(this).hide().parents('.email-frm').find('.add').show();}
	else{
	    
		var email_a = $('.email-frm input').val().replace(",","");
		var email = email_a.replace(" ","");
		if(email.indexOf(".") == -1 || email.indexOf("@") == -1) {
			$('.email-frm input').val(email);
		}else{
			
			var email_a = $('.email-frm input').val().replace(",","");
			var email = email_a.replace(" ","");
			if(email.indexOf(".") == -1 || email.indexOf("@") == -1) {
				$('.email-frm input').val(email);
			}else{
				$('<b class="name">'+email+'<button type="button" class="icon btn-del glyphicons delete" onclick="$(this).parents('+"'.name'"+').remove();if ($('+"'.email-frm .name'"+').length<1) {$('+"'.email-frm .add').text('Enter your friends email address')"+'}"></button></b>').insertBefore('.email-frm .add');
				$('.email-frm input').val('');
			}
		}
		add_email(email);
	}
    });
    /*$('.link .more').click(function(){
	if ($(this).hasClass('less')==true) {
	    $(this).parents('dd').find('.more-sns').css('overflow','hidden').animate({width:'0'},'fast').end().end().removeClass('less');
	} else {
	    $(this).parents('dd').find('.more-sns').animate({width:'185px'},'fast',function(){$('.link .more-sns').css('overflow','visible');}).end().end().addClass('less');
	}
	$('.tooltip').each(function(){$(this).css('margin-left',-($(this).width()/2)-9+'px');});
	return false;
    });
   */

    function emailEnd(str){
		if(str != 188 && str != 32 && str != 13) return;
		var $input = $('.email-frm input'), $name, email = $input.val().replace(/[, ]/g,''), MAX_W = 340, MIN_W = 100, new_w = 0;

		if(/^[\w\.\-\+]+@[\w\.\-]+\.[a-z]+$/i.test(email)){
			$name = $('<b class="name">'+email+'<button type="button" class="icon btn-del glyphicons delete" onclick="$(this).parents('+"'.name'"+').remove();if ($('+"'.email-frm .name'"+').length<1) {$('+"'.email-frm .add').text('Enter your friends email address')"+'}"></button></b>').insertBefore('.email-frm .add');
			new_w = $name[0].parentNode.offsetWidth - $name[0].offsetLeft - $name[0].offsetWidth - 20;
			if(new_w < MIN_W || $input[0].offsetLeft < 10) new_w = MAX_W;
			$input.val('').width(new_w);
		}
		add_email(email);
    }
    var is_sending_invitation = false;
    $('.invite-friends-by-email').click(function(){
        console.log("In send email");
	var msg = $('dl.via textarea').val();
	var emails=[],valid_emails=[], param = {};
	$('.email-frm b.name').each(function(){
            var em = $(this).text();
            if(/[\w\-\.\+]+@[\w\-\.]+[a-z]+/.test(em)){
		if($.inArray(em, valid_emails) === -1) valid_emails.push(em);
            }
	});
    console.log("Email Count "+email_addrs.length);
	if(!email_addrs.length) return false;

	param['use_credit_email'] = true;
	param['emails'] = email_addrs.join(',');
	//alert(param['emails']);
	var BaseURL=getBaseURL();
	var selectedRow = $(this);
	if(!is_sending_invitation){
	    is_sending_invitation=true;
	    
	     
	    
	    //$.post(BaseURL+'sendinviteemailref/',param,
			   //function(response){
			   
		    $.ajax({
			url: BaseURL+"sendinviteemailref/",
			type: "post",
			data : { 'emails': param, 'msg': msg},
			dataType: "html",
			success: function(responce){
			//alert(responce);
				$('.after-sent').fadeIn();
    			setTimeout(function(){
		               $('.after-sent').fadeOut();
			   },2000);
			   
		      /* if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
			   $('dl.via input,dl.via textarea').val('');
			   $('.email-frm .name').remove();
			   $('.email-frm .add').text('Enter your friends email address');
			   $('.after-sent').fadeIn();
               email_addrs = [];
			   setTimeout(function(){
		               $('.after-sent').fadeOut();
			   },2000);
		       }
		       else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
			   alert($(xml).find("message").text());
		       } */
		       is_sending_invitation=false;
		     }
		   });
	}
	return false;

    });
    
     $('#zclipp').zclip({
          
	path:'http://www.steamdev.com/zclip/js/ZeroClipboard.swf',
	copy:function(){return $('dl.link input[type="text"]').val();},
	afterCopy:function(){
	    $('.alert-copy').animate({opacity:'1'},'0.4s',function(){setTimeout(function(){$('.alert-copy').animate({opacity:'0'},'0.4s')},2000);});
	}
    });
  

</script>
<style>
.alert-copy {
   	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.898);
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    color: #E1E1E1;
    display: block;
    font-size: 12px;
    line-height: 16px;
    padding: 10px 0;
    position: absolute;
    text-align: center;
    top: 400px;
    width: 230px;
	opacity:0;
	filter:alpha(opacity=0);
}



</style>