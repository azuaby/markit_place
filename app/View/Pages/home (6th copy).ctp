<div id="container-wrapper">
	<div class="container timeline classic">
		<p class="welcome">
			<strong>Welcome to Anekart!</strong><br>
			Discover amazing stuff, collect the things you love, buy it all in one place.
		</p>
		<div class="wrapper-content">
			<div class="top-menu">
				
				<div class="viewer">
					<ul>
						<li class="classic"><a href="#"  onclic="$('.container.timeline').addClass('classic').find('.wrapper-content').removeAttr('class').addClass('wrapper-content');"><i class="ic-view4"></i> <span>Classic View<b></b></span></a></li>
						<li class="normal"><a href="#" class="current"><i class="ic-view2"></i> <span>Grid View<b></b></span></a></li>
						<li class="vertical"><a href="#" ><i class="ic-view3"></i> <span>Compact View<b></b></span></a></li>
						<li class="slideshow"><a href="#" class="btn-slideshow"><i class="ic-slideshow"></i> <span>Slideshow<b></b></span></a></li>
					</ul>
				</div>
		</div>

		<div id="content">
			<ol class="stream" >
			
			
			
			
			
			
	
		  <?php
		  
		  	if(!empty($items_data)){
			foreach($items_data as $key=>$itms){
			
			if(@isset($user_idss[$itms['Item']['user_id']])){
				$user_idss[$itms['Item']['user_id']] = $user_idss[$itms['Item']['user_id']]+1;
			}else{
				$user_idss[$itms['Item']['user_id']] = 1;
			}
			
			
			}
			//print_r($user_idss);die;
			}
		  
		  
		  
		  
		  
		  
		if(!empty($items_data)){
			foreach($items_data as $key=>$itms){
				$itm_id = $itms['Item']['id'];
				$user_id = $itms['Item']['user_id'];
				$item_title_url = $itms['Item']['item_title_url'];
				$item_title = $itms['Item']['item_title'];
				$item_price = $itms['Item']['price'];
				if(isset($itms['Photo'][0])){
					$image_name = $itms['Photo'][0]['image_name'];
				}
				$username_url = $itms['User']['profile_image'];
				$username = $itms['User']['username'];
				
				
				
				
				
				
			if($user_idss[$user_id] > 2){
				if($user_idss[$user_id]%3==2){
					echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="mid " >'; 
				}else if($user_idss[$user_id]%3==0){
					echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="sm " >'; 
				}else if($user_idss[$user_id]%3==1){
					echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="big " >'; 
				}
			}else if($user_idss[$user_id]==2){
				echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="mid" >'; 
			}
			//$user_idss[$user_id]--;
			
			
			
			
			
			
			
			
			
			
			
			
		/*	if($group.length>2){
			$group.removeClass("big mid").addClass("sm").each(function(i){
				if(i%3==0) $(this).addClass("clear");
			});

			if($group.length%3==2){
				$group.last().removeClass("sm").addClass("mid").prev().removeClass("sm").addClass("mid");
			}else if($group.length%3==1){
				$group.last().removeClass("sm").addClass("big");
			}
		}else if($group.length==2){
			$group.removeClass("big").addClass("mid");
		}
			
			*/
			
			
			
				echo  '<div class="figure-item">';
				if(isset($countuser) && $countuser == 0 ){
				echo  "<a href='".SITE_URL."avatars/thumb70/".$username_url."' class='vcard'><img src='".SITE_URL."avatars/thumb70/".$username_url."'></a>";
				$countuser = 1;
				}
				echo  '<a href="/" class="figure-img" >';
				echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".SITE_URL."photos/original/".$image_name."' data-310-url='".SITE_URL."photos/thumb350/".$image_name."' ><em class='back'></em></span>";
				echo  '<span class="figure classic">';
				echo  '<em class="back"></em>';
				echo  "<img src='".SITE_URL."photos/original/".$image_name."' >";
				echo  '</span>';
				echo  '<span class="figure vertical">';
				echo  '<em class="back"></em>';
				echo  "<img src='".SITE_URL."photos/thumb350/".$image_name."' >";
				echo  '</span>';
				echo  '<span class="figcaption">'.$item_title.'</span>';
				echo  '</a>';
				echo  '<em class="figure-detail">';
				echo  '<span class="price"> '.$item_price.' <small>USD</small></span>';
				echo  '<span class="username"><em><i> by </i><a href="'.SITE_URL."avatars/thumb70/".$username.'">'.$username.'</a>  + 0</em></span>';
				echo  '</em>';
				echo  "<a href='/' class='button fancy' require_login='true' tid='.$image_name.' item_img_url='".SITE_URL."photos/original/".$image_name."'><span><i></i></span> Fancy it</a>";
				echo  '</div>';
			echo  '</li>';
			
			
				if($itms['Item']['user_id'] != @$items_data[$key+1]['Item']['user_id']){
					$countuser = 0;
				}
			
			 }	
			}else{
				echo "<center>No Items Found</center>";
			}
		?>

		</ol>
			
			
				<div id="infscr-loading" style="display:none">
					<!--img alt='Loading...' src="/_ui/images/common/ajax-loader.gif"-->
					<span class="loading">Loading...</span>
				</div>


			
			
		</div>
		<!-- / content -->


		
		<a href="#header" id="scroll-to-top"><span>Jump to top</span></a>

	</div>
	<!-- / container -->
</div>

<!-- popups -->
<div id="popup_container">
<img class="loader" src="/_ui/images/common/loading.gif">


<!-- add_to_list overlay -->
<div id="add-to-list-new" class="popup ly-title update add-to-list">
	<div class="default">
		<p class="ltit">Add to List</p>
		<button type="button" class="ly-close"><i class="ic-del-black"></i></button>
		<div class="fancyd-item">
			<div class="image-wrapper">
				<div class="item-image"><img src="/_ui/images/common/blank.gif"></div>
			</div>
			<div class="item-categories">
				<form action="#">
					<fieldset class="list-categories"><div class="list-box"><ul><li>&nbsp;Loading...</li></ul></div></fieldset>
					<fieldset class="new-list">
						<i class="ic-plus"></i>
						<input type="text" name="list_name" id="quick-create-list" placeholder="Create New List">
						<button type="submit" class="btn-create">Create</button>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="btn-area">
				<button type="button" class="btn-add-to-list btn-done">Done</button>
				<button type="button" class="btn-want" id="i-want-this"><i class="ic-plus"></i> <b>Want</b></button>
				<a href="#" class="btn-set"><i class="ic-setting"></i><span class="hidden">Settings</span><i class="ic-arrow"></i></a>
				<div class="set-dropdown">
					<ul>
						<li><a href="#" class="btn-unfancy">Unfancy</a></li>
						<li><a href="#" class="btn-create-list">Create New List</a></li>
					</ul>
					<div class="hr"></div>
					<ul>
						<li><a href="/settings/preferences">List Settings</a></li>
					</ul>
				</div>
			</div>
	</div>
	<div class="create-list" style="display:none">
		<p class="ltit">Create New List</p>
		<button class="close cancel" title="Close"><i class="ic-del-black"></i></button>
		<form loid="">
		<fieldset>
			<div class="frm">
				<p><b class="stit">Title</b> <input type="text" name="list_name" class="right" placeholder="Enter a title"></p>
				
			</div>
			<div class="frm">
				<p>
					<b class="stit">Category</b>
					<select name="category_id" id="categories-for-new-list" class="right">
						<option value="0">Select category</option>
					</select>
				</p>
			</div>
			
			<div class="frm">
				<b class="stit">Contributors</b>
				<div class="right">
					<p>
						<input type="text" id="create-list-find-user" placeholder="Username or email address">
						<button class="btn-invite">Invite</button>
						<div class="comment-autocomplete">
							<ul>
								<script type="fancy/template">
									<li><img src="##image_url##" class="photo"><span class="username">##username##</span><span class="name">(##fullname##)</span></li>
								</script>
							</ul>
						</div>
						<input type="hidden" name="collaborators" id="create-list-collaborators" value="">
					</p>
					<ul class="user-list">
						<li>
							<img src="" alt="">
							<span class="left"><b></b></span>
							<span class="right">Creator</span>
						</li>
						<script type="fancy/template" id="tpl-invite-user-list">
							<li data-id="##id##"><img src="##image_url##"><span class="left"><b>##fullname##</b>##username##</span><span class="right"><a href="#"><i class="ic-del"></i><span class="hidden">Delete</span></a></span></li>
						</script>
					</ul>
				</div>
			</div>
		</fieldset>
		<div class="btn-area">
			<button type="submit" class="btn-create">Create list</button>
			<button type="button" class="cancel">Cancel</button>
		</div>
		</form>
	</div>
</div>
<!-- /add_to_list overlay -->


<div class="popup shortcut ly-title">
	<p class="ltit">Keyboard Shortcuts</p>
	<div class="ltxt">
		<dl class="left">
			<dt>Timeline</dt>
			<dd>
				<ul>
					<li><b>S</b><span>Shuffle</span></li>
					<li><b>J</b><span>Next</span></li>
					<li><b>K</b><span>Previous</span></li>
					<li><b>F</b><span>Fancy</span></li>
					<li><b>A</b><span>Add to List</span></li>
					<li><b>C</b><span>Comment</span></li>
					<li><b>H</b><span>Share</span></li>
					<li><b>Enter</b><span>View Thing</span></li>
				</ul>
			</dd>
		</dl>
		<dl class="right">
			<dt>Slideshow</dt>
			<dd>
				<ul>
					<li><b>J</b><span>Next</span></li>
					<li><b>K</b><span>Previous</span></li>
					<li><b>F</b><span>Fancy</span></li>
					<li><b>C</b><span>Comment</span></li>
					<li><b>P</b><span>Play / Pause</span></li>
					<li><b>L</b><span>Loop</span></li>
				</ul>
			</dd>
		</dl>
	</div>
	<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
</div>









<div class="popup ly-title gift-recommend">
	<h3 class="ltit">Gift Recommendations</h3>
	<dl>
		<dt>Ask the Fancy experts</dt>
		<dd><p>Fill in the form below and we'll email you back with some great gift ideas you can buy right here on Fancy.</p></dd>
	</dl>
	<dl>
		<dt>Description</dt>
		<dd>
			<select id="gift-for" class="gift-target">
				<option value="none">For</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
			<select id="gift-cat" class="gift-category">
				<option value="none">Category</option>
				<option value="1">Men&#39;s</option><option value="2">Women&#39;s</option><option value="3">Kids</option><option value="4">Pets</option><option value="5">Home</option><option value="6">Gadgets</option><option value="7">Art</option><option value="8">Food</option><option value="9">Media</option><option value="11">Architecture</option><option value="12">Travel &amp; Destinations</option><option value="13">Sports &amp; Outdoors</option><option value="14">DIY &amp; Crafts</option><option value="15">Workspace</option><option value="16">Cars &amp; Vehicles</option><option value="10">Other</option>
			</select>
			<select id="gift-price" class="gift-point">
				<option value="none">Price</option>
				<option value="1-20">$1-20</option>
				<option value="20-100">$20-100</option>
				<option value="100-200">$100-200</option>
				<option value="200-500">$200-500</option>
				<option value="500+">$500+</option>
			</select><br />
			<textarea placeholder='Please give us as much detail as possible to help you find the perfect gift, including information about the recipient, price range, etc.'></textarea>
		</dd>
	</dl>
	<div class="btn-area">
		<button class="btn-share">Send Request</button>
	</div>
	<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
</div>


<div class="popup add-cmt ly-title">
	<p class="ltit">Add a Comment</p>
	<div class="ltxt">
		<p class="figcaption"></p>
		<textarea placeholder="Write a comment..."></textarea>
	</div>
	<div class="btn-area">
		<small>Use @ to mention someone</small>
		<button class="btn-done">Post Comment</button>
	</div>
	<button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
</div>






<!--fancy-share-->
<div id="fancy-share" class="popup fancy-share">
	<div class="box-rnd-shadow-2 ly-title">
		<p class="ltit">
			<span class="share-thing">Share This Thing</span>
			<span class="share-comment">Share This Comment</span>
			<span class="share-list">Share This List</span>
			<span class="share-gift">Share This Gift Campaign</span>
			<span class="share-user">Share {{name}}'s Profile</span>
		</p>
		<div class="fig">
			<span class="thum"><img src="/_ui/images/common/blank.gif"></span>
			<div class="fig-info">
				<h4></h4><p class="from"></p>
				<dl>
					<dt><label for="share-link-input">Link</label></dt>
					<dd><input type="text" id="share-link-input" readonly></dd>
				</dl>
				<dl>
					<dt><label for="share-embed-input">Embed</label></dt>
					<dd><input type="text" id="share-embed-input" readonly></dd>
				</dl>
			</div>
			<div class="bio"></div>
		</div>
		<div class="direct-link clear">
			<h4>Direct Link</h4>
			<input type="text" id="direct-link-input">
		</div>
		<div class="clear">
			<h4>Share via</h4>
			<ul class="share-via clearfix">
				
				<li class="clear"><a href="#" class="fb" target="_blank"><span class="ic-fb"></span> Facebook</a></li>
				<li><a href="#" class="tw" target="_blank"><span class="ic-tw"></span> Twitter</a></li>
				<li><a href="#" id="gplus-share" class="gg" target="_blank"><span class="ic-gg"></span> Google+</a></li>
				<li class="end"><a href="#" class="su" target="_blank"><span class="ic-su"></span> StumbleUpon</a></li>
				<li class="clear"><a href="#" class="li" target="_blank"><span class="ic-link"></span> LinkedIn</a></li>
				<li><a href="#" class="tb" target="_blank"><span class="ic-tb"></span> Tumblr</a></li>
				<li><a href="#" class="vk" target="_blank"><span class="ic-vk"></span> ВКонтакте</a></li>
				<li class="end"><a href="#" class="od" target="_blank"><span class="ic-od"></span> Одноклассники</a></li>
				
				<li class="clear"><a href="#" class="mx"><span class="ic-mx"></span> mixi</a></li>
				<li><a href="#" class="qz" target="_blank"><span class="ic-qz"></span> q-zone</a></li>
				<li><a href="#" class="wb" target="_blank"><span class="ic-wb"></span> Weibo</a></li>
				<li class="end"><a href="#" class="rr" target="_blank"><span class="ic-rr"></span> renren</a></li>

			</ul>
		</div>
		<div class="share-with-someone clear">
			<h4>Share with someone</h4>
			<div class="email-frm">
				<b class="name"><button type="button" class="btn-del">Delete</button></b>
				<span class="add" tabindex="0">+ Add email addresses or user names|+ Add more people</span>
				<input type="text" class="text">
				<ul class="user-list"><li><img src="/_ui/images/common/blank.gif"><!--user image--><b><!--full name--></b><small><!--username--></small></li></ul>
			</div>
			<textarea placeholder='Include a personal note'></textarea>
		</div>
		<div class="btn-area">
			<button type="button" class="btn-share">Share</button>
		</div>
		<button type="button" class="ly-close" title="Close"><i class="ic-del-black"></i></button>
	</div>
</div>
<!--/fancy-share-->


<div class="popup sign signup signin-overlay">
	<div class="popup_wrap update2">
		<h2>Join Fancy today</h2>
		<div class="sns-login">
			<p>Discover amazing stuff, collect the things you love, buy it all in one place. Sign up today and start curate your own catalog.</p>
            <ul class="sns-major">
                
				<li><button class="btn-f facebook"><span class="icon ic-fb"><i></i></span> <b>Facebook</b></button></li>
				<li><button class="btn-g google" id="fancy-g-signin" next="/"><span class="icon ic-gg"><i></i></span> <b>Google</b></button></li>
				<li><button class="btn-t twitter"><span class="icon ic-tw"><i></i></span> <b>Twitter</b></button></li>
                
			</ul>
        </div>
		<fieldset class="frm default">
            <div class="sns-minor" style="display:none;" >
				<span class="trick"></span>
				<ul>
                    
					<li><button class="btn-b social bk" data-backend="VK" data-type="signin"><span class="icon ic-bk"><i></i></span> <b>ВКонтакте</b></button></li>
					<li><button class="btn-r social renren" data-backend="renren" data-type="signin" next="/"><span class="icon ic-re"><i></i></span> <b>Renren</b></button></li>
					<li><button class="btn-w social weibo" data-backend="weibo" data-type="signin" next="/"><span class="icon ic-we"><i></i></span> <b>Weibo</b></button></li>
                    
				</ul><i class="arrow"></i>
			</div>
			<h3 class="stit">Sign up with your email address or <a href="#" class="more" ><b>other social networks</b></a></h3>
			<p><input type="text" placeholder="Enter your email address" id="signin-email" />
			<button class="btns-blue-embo btn-signup">Sign Up</button></p>
            <input type="hidden" class="next_url" value="/">
			<p class="anyway">Have an account? <a href="/login?next=/">Login</a></p>
		</fieldset>
	</div>
	<p class="footer">Are you a business? <a href="/business">Learn more</a></p>
	<a href="#" class="btn-close">X</a>
</div>
<div class="popup sign register">
	<div class="popup_wrap">
		<h2>Almost Done!</h2>
		<h3 class="stit">We need a few more things to set up your account.</h3>
		<form>
            <fieldset class="frm">
                <p class="error" style="margin:-10px 0 20px;display:none;"></p>
                <p><label class="label">Full name</label>
                <input type="text" name="fullname" id="fullname" placeholder="" /></p>
                <p style="display:none;"><label class="label">Email Address</label>
                <input type="text" name="email" id="email" value="" /></p>
                <p><label class="label">Choose your username</label>
                <input type="text" name="username" id="username" placeholder="" />
                <small class="url">Your Fancy page: http://fancy.com/<b>Username</b></small></p>
                <p><label class="label">Create a password</label>
                <input type="password" name="user_password" id="user_password" placeholder="" />
                <span class="loader"><b></b> <em></em></span></p>
                <p class="account-txt">By creating an account, I accept Fancy’s <a href="#">Terms of Service</a><br /> and <a href="#">Privacy Policy</a> .</p>
                <button class="btns-blue-embo btn-create sign" from_popup="true" >Create my account</button>
            </fieldset>
        </form>
	</div>
</div>





<!-- slideshow_box -->
<section id="slideshow-box">
	<header>
		<div class="container">
			<a href="/" id="slideshow-logo">Fancy</a>
			<div class="controls"><a href="#" id="btn-browse">Exit</a></div>
		</div>
	</header>
	<div class="container">
		<ul id="anekartSlide">
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp1.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp1.jpg" title="Lone Tree Yellowstone"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp2.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp2.jpg" title="Is He Still There?!"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp4.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp4.jpg" title="Noni Nectar For Green Gecko"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp7.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp7.jpg" title="Flight of an Eagle Owl"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp14.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp14.jpg" title="Winter Lollipops"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp26.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp26.jpg" title="Day of Youth"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp27.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp27.jpg" title="Sunbathing Underwater"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp28.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp28.jpg" title="Untitled"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp41.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp41.jpg" title="New Orleans Streetcar"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp49.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp49.jpg" title="By The Wind of Chance"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp52.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp52.jpg" title="Fishing on the Cloud"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp53.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp53.jpg" title="Blue Lagoon"  />
            <li><img data-frame="http://www.spaceforaname.com/galleryview/img/photos/crops/bp54.jpg" src="http://www.spaceforaname.com/galleryview/img/photos/bp54.jpg" title="Time" data-description="A solitary tree surviving another harsh winter in Yellowstone National Park. Yellowstone National Park, Wyoming. (Photo and caption by Anita Erdmann/Nature/National Geographic Photo Contest) "/>
        </ul>
	</div>
</section>
<!-- /slideshow_box -->





</div>
<!-- /popups -->











<script>
jQuery(function($){
	$('a.more').mouseover(function(){$('.sns-minor').show();return false;});
	$('a.more').click(function(){
		$('.sns-minor').toggleClass('toggle');
	});
	$('.sns-minor .trick').click(function(){
		$('.sns-minor').removeClass('toggle');
		return false;
	});
	$('.sns-major').mouseover(function(){$('.sns-minor').hide();return false;});
	$('.sns-minor').mouseover(function(){if ($(this).hasClass('toggle')==false) $(this).hide();});
});
</script>
<div id="fb-root"></div>




<script>

	
jQuery(function($){
    $('ol.stream')
        .delegate('div.figure-item > a', 'click', function(){
            var url = $(this).parent().find('a[rel]').attr('href');
            //alert(url.val());
            $('#fancy-g-signin').attr('next', url);
            $social = $('.social');
            if ($social.length > 0) {
                 $social.attr('next', url);
            }
            $(".popup.signin-overlay")
                .find('input.next_url').val(url).end()
                .find('a.signup').attr('href','/register?next='+url).end()
                .find('a.signin').attr('href','/login?next='+url);
            $.dialog('signin-overlay').open();
            return false;
        });
    });










(function(){
	var $btns = $('.viewer li'), $stream = $('ol.stream'), $container=$('.container'), $wrapper = $('.wrapper-content'), first_id = 'stream-first-item_', latest_id = 'stream-latest-item_';
	//alert($btns.val());
	$stream.data('feed-url', '/');
	
	// show images as each image is loaded
	$stream.on('itemloaded', function(){
		
		var $latest = $stream.find('>#'+latest_id).removeAttr('id'),
	 	    $first = $stream.find('>#'+first_id).removeAttr('id'),
		    $target=$(), viewMode;
		// merge sameuser thing 
		var userid = $latest.attr('auserid');
		
		var $currents = $latest.prevUntil('li[auserid!='+userid+"]");
		var $nexts = $latest.nextUntil('li[auserid!='+userid+"]");
		var $group = $($currents).add($latest).add($nexts);
		$nexts.filter(".clear").removeClass("clear").find("a.vcard").detach();
		if($group.length>2){
			$group.removeClass("big mid").addClass("sm").each(function(i){
				if(i%3==0) $(this).addClass("clear");
			});

			if($group.length%3==2){
				$group.last().removeClass("sm").addClass("mid").prev().removeClass("sm").addClass("mid");
			}else if($group.length%3==1){
				$group.last().removeClass("sm").addClass("big");
			}
		}else if($group.length==2){
			$group.removeClass("big").addClass("mid");
		}
		
		var forceRefresh = false;

		if(!$first.length || !$latest.length) {
			$target = $stream.children('li');
		} else {
			var newThings = $first.prevAll('li');			
			if(newThings.length) forceRefresh = true;
			$target = newThings.add($latest.nextAll('li'));
		}

		$stream.find('>li:first-child').attr('id', first_id);
		$stream.find('>li:last-child').attr('id', latest_id);

	    viewMode = $container.hasClass('vertical') ? 'vertical' : ($container.hasClass('normal') ? 'grid':'classic');

		if(viewMode=='grid'){
			$target.each(function(i,v,a){
				var $li = $(this), src_g;
				var $grid_img = $li.find(".figure.grid");
				
				if($grid_img.height()>400){
					$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
				}else{
					$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
				}
			});
		}

		if(viewMode == 'vertical'){
			$('#infscr-loading').show();
			setTimeout(function(){
				arrange(forceRefresh);
				$('#infscr-loading').hide();
			},10);
		}

	});
	$stream.trigger('itemloaded');
	
	$btns.each(function(){
		var $tip = $(this).find('span');
		$tip.css('margin-left', -$tip.width()/2 - 8 + 'px');
	});
	
	$('.btn-slideshow').click(function(){
		$('#popup_container').show();
		$('#popup_container').css({"opacity":"1"}); 
		$('#anekartSlide').galleryView();
		$('#slideshow-box').show();
    }); 
    $('#btn-browse').click(function(){
		$('#popup_container').hide();
		$('#popup_container').css({"opacity":"0"}); 
		$('#slideshow-box').hide();
    });
	
	$btns.click(function(event){
		event.preventDefault();
		if($wrapper.hasClass('anim')) return;
		
		var $btn = $(this);

		// hightlight this button only
		$btns.find('a.current').removeClass('current');
		$btn.find('a').addClass('current');
		
		if(/\b(normal|vertical|classic)\b/.test($btn.attr('class'))){
			setView(RegExp.$1);
		}
	});

	$wrapper.on('redraw', function(event){
		var curMode = '';
		if(/\b(normal|vertical|classic)\b/.test($container.attr('class'))) curMode = RegExp.$1;
		if(curMode) setView(curMode, true);
	});

	function setView(mode, force){
		if(!force && $container.hasClass(mode)) return;
		var $items = $stream.find('>li');

		if($items.length>100){
			$items.filter(":eq(100)").nextAll().detach();			
		}

		if(!window.Modernizr || !Modernizr.csstransitions ){
			$stream.addClass('loading');
			$wrapper.trigger('before-fadeout');
			$stream.removeClass('loading');

			$wrapper.trigger('before-fadein');
			switchTo(mode);	

			if(mode=='normal'){
				$items.each(function(i,v,a){
					var $li = $(this);
					var $grid_img = $li.find(".figure.grid");
					//$li.css("left","0");
					if($li.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}
			
			$stream.find('>li').css('opacity',1);
			$wrapper.trigger('after-fadein');
			return;
		} 

		$wrapper.trigger('before-fadeout').addClass('anim');
		$stream.addClass('loading');

		var item,
		    $visibles, visibles = [], prevVisibles, thefirst, 
		    offsetTop = $stream.offset().top,
		    hh = $('#header-new').height(),
		    sc = $(window).scrollTop(),
		    wh = $(window).innerHeight(),
			f_right, f_bottom, v_right, v_bottom,
			i, c, v, d, animated = 0;

		// get visible elements
		for(i=0,c=$items.length; i < c; i++){
			item = $items[i];
			if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
				//item.style.visibility = 'hidden';
			} else if (offsetTop + item.offsetTop > sc + wh) {
				//item.style.visibility = 'hidden';
				break;
			} else {
				visibles[visibles.length] = item;
			}
		}
		prevVisibles = visibles;

		// get the first animated element
		for(i=0,c=Math.min(visibles.length,10),thefirst=null; i < c; i++){
			v = visibles[i];
			
			if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
				thefirst = v;
			}
		}

		if(visibles.length==0) fadeIn();
		// fade out elements using delay based on the distance between each element and the first element.
		for(i=0,c=visibles.length; i < c; i++){
			v = visibles[i];

			d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
			delayOpacity(v, 0, d/5);

			if(i == c -1){
				setTimeout(fadeIn,300+d/5);
			}
		}

		function fadeIn(){
			$wrapper.trigger('before-fadein');

			if($wrapper.hasClass("wait")){
				setTimeout(fadeIn, 50);
				return;
			}

			var i, c, v, thefirst, COL_COUNT, visibles = [], item;
			
			if($items.length !== $stream.get(0).childNodes.length || $items.get(0).parentNode !== $stream.get(0)) $items = $stream.find('>li');
			$stream.height($stream.parent().height());
			
			switchTo(mode);

			if(mode=='normal'){
				$items.each(function(i,v,a){
					var $li = $(this);
					var $grid_img = $li.find(".figure.grid");
					
					if($li.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}

			$stream.removeClass('loading');
			$wrapper.removeClass('anim');

			// get visible elements
			for(i=0,c=$items.length; i < c; i++){
				item = $items[i];
				if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
					//item.style.visibility = 'hidden';
				} else if (offsetTop + item.offsetTop > sc + wh) {
					//item.style.visibility = 'hidden';
					break;
				} else {
					visibles[visibles.length] = item;
					item.style.opacity = 0;
				}
			}
			
			$wrapper.addClass('anim');

			$(visibles).css({opacity:0,visibility:''});
			COL_COUNT = Math.floor($stream.width()/$(visibles[0]).width());

			// get the first animated element
			for(i=0,c=Math.min(visibles.length,COL_COUNT),thefirst=null; i < c; i++){
				v = visibles[i];
				
				if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
					thefirst = v;
				}
			}

			// fade in elements using delay based on the distance between each element and the first element.
			if(visibles.length==0) done();
			for(i=0,c=visibles.length; i < c; i++){
				v = visibles[i];

				d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
				delayOpacity(v, 1, d/5);

				if(i == c -1) setTimeout(done, 300+d/5);
			}
		};

		function done(){
			$wrapper.removeClass('anim');
			/*if(prevVisibles && prevVisibles.length) {
				for(var i=0,c=visibles.length; i < c; i++){
					if(visibles[i].style.opacity == '0') visibles[i].style.opacity = 1;
				}
			}*/
			$stream.find('>li').css('opacity',1);
			$wrapper.trigger('after-fadein');
		};
		
		function delayOpacity(element, opacity, interval){
			setTimeout(function(){ element.style.opacity = opacity }, Math.floor(interval));
		};
		
		function switchTo(mode){
			var currentMode = $container.hasClass('vertical')?'vertical':($container.hasClass('classic')?'classic':'normal')
			$container.removeClass('vertical normal classic').addClass(mode);
			if(mode == 'vertical') {
				arrange(true);
				$.infiniteshow.option('prepare',2000);
			} else {
				$stream.css('height','');
				$.infiniteshow.option('prepare',4000);
			}
			if($.browser.msie) $.infiniteshow.option('prepare',1000);
			$.cookie.set('timeline-view',mode,9999);
		};

	};
	
	var bottoms = [0,0,0,0];
	function arrange(force_refresh){
		
		var i, c, x, w, h, nh, min, $target, $marker, $first, $img, COL_COUNT, ITEM_WIDTH;

		var ts = new Date().getTime();
		$marker = $stream.find('li.page_marker_');
		
		if(force_refresh || !$marker.length) {
			force_refresh = true;
			bottoms = [0,0,0,0];
			$target = $stream.children('li');
		} else {
			$target = $marker.nextAll('li');
		}

		if(!$target.length) return;

		$first = $target.eq(0);
		$target.eq(-1).addClass('page_marker_');
		$marker.removeClass('page_marker_');
			
		//ITEM_WIDTH  = parseInt($first.width());
		//COL_COUNT   = Math.floor($stream.width()/ITEM_WIDTH);
		ITEM_WIDTH = 230;
		COL_COUNT = 4;
		
		for(i=0,c=$target.length; i < c; i++){
			min = Math.min.apply(Math, bottoms);			

			for(x=0; x < COL_COUNT; x++) if(bottoms[x] == min) break;

			//$li = $target.eq(i);
			$li = $($target[i]);
			$img = $li.find('.figure.vertical > img');
			if(!(nh = $img.attr('data-calcHeight'))){
				w = +$img.attr('data-width');
				h = +$img.attr('data-height');

				if(w && h) {
					//nh = $img.width()/w * h;
					nh = 210/w * h;
					nh = Math.max(nh,150);
					$img.attr('height', nh).data('calcHeight', nh);
				}else{
					nh = $img.height();
				}
			}

			$li.css({top:bottoms[x], left:x*ITEM_WIDTH})
			bottoms[x] = bottoms[x] + nh + 20;
		}
		
		$stream.height(Math.max.apply(Math, bottoms));	
		
	};
	$wrapper.on('arrange', function(){ arrange(true); });

	$notibar = $('.new-content');
	$notibar.off('click').on('click', function(){
		setTimeout(function(){
		    $.jStorage.deleteKey("fancy.prefetch.stream");
		    $.jStorage.deleteKey("first-featured");
		    $.jStorage.deleteKey("first-all");
		    $.jStorage.deleteKey("first-following");
			$stream.trigger('itemloaded');	

			if( $container.hasClass("normal") ){					
				$stream.find("li").each(function(i,v,a){
					var $li = $(this), src_g;
					var $grid_img = $li.find(".figure.grid");

					if($grid_img.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}		
		},100);
	});

	// feed selection
	var $feedtabs = $('.sorting a[data-feed]');	
	var init_ts = $stream.attr("ts");
	var ttl  = 5 * 60 * 1000;

	$feedtabs.click(function(e){
		var tab = $(e.target).data("feed")||"featured";
		switchTab(tab);
		e.preventDefault();
	});

	function switchTab(tab){
		$.jStorage.deleteKey("fancy.prefetch.stream");
		$feedtabs.removeClass("current");
		var $currentTab = $feedtabs.filter("a[data-feed="+tab+"]").addClass("current");
		$url = $('a.btn-more').hide();
		$win = $(window);

		var result = null;
		$wrapper.addClass("wait");	
		// hide notibar if it showing
		$notibar.hide();
		$stream.attr('ts','').data('feed-url', '/user-stream-updates?new-timeline&feed='+tab);
		var loc = tab;
		var keys = {
			timestamp : 'fancy.home-new.timestamp.'+loc,
			stream  : 'fancy.home-new.stream.'+loc,
			latest  : 'fancy.home-new.latest.'+loc,
			nextURL : 'fancy.home-new.nexturl.'+loc
		};

		if(!(result=$.jStorage.get('first-'+tab))){			
			$.ajax({
				url : '/?new-timeline&feed='+tab,
				dataType : 'html',
				success : function(data, st, xhr) {
					result = data;
					$.jStorage.set('first-'+tab, result, {TTL:5*60*1000});
				},
				error : function(xhr, st, err) {
					url = '';
				},
				complete : function(){
				}
			});
		}

		var swapContent = function(){
			if(!result){
				setTimeout(swapContent,50);
				return;
			}

			if($wrapper.hasClass("swapping")) return;
			$wrapper.addClass("swapping");
			$stream.find(">li").detach();

			$container.removeClass('pattern2 pattern3');			
			if( $container.hasClass("normal") ){
				var patterns = ['','pattern2','pattern3'];
				var pattern = patterns[Math.floor(Math.random()*3)]
				if(pattern){
					$container.addClass(pattern);
				}				
				$stream.find("li").each(function(i,v,a){
					var $li = $(this), src_g;
					var $grid_img = $li.find(".figure.grid");

					if($grid_img.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}

			var $sandbox = $('<div>'),
		    $contentBox = $('#content ol.stream'),
			$next, $rows;

			$sandbox[0].innerHTML = result.replace(/^[\s\S]+<body.+?>|<((?:no)?script|header|nav)[\s\S]+?<\/\1>|<\/body>[\s\S]+$/ig, '');
			$next = $sandbox.find('a.btn-more');
			$rows = $sandbox.find('#content ol.stream > li');
			
			$contentBox.append($rows);
			if(window.Modernizr && Modernizr.csstransitions )	$rows.css('opacity',0);

			$stream.trigger('itemloaded');

			if (tab!="suggestions" && $next.length) {
				url = $next.attr('href');
				$url.attr({
					'href' : $next.attr('href'),
					'ts'   : $next.attr('ts')
				});
				$stream.attr("ts",$currentTab.data("ts")||init_ts);
				$(window).trigger("prefetch.infiniteshow");
			} else {
				url = ''
				$url.attr({
					'href' : '',
					'ts'   : ''
				});
			}
			
			slideshow_request_url = '/home_slideshow.json?new-timeline&feed='+tab;
			Fancy.slideshow.reset();

			$wrapper.removeClass("wait");
			$wrapper.removeClass("swapping");
		}

		var done = function(){
			//setTimeout(function(){$('#content ol.stream > li').css('opacity',1)},500);
		}

		$stream.trigger("changeloc");
		$wrapper.off('before-fadein').on('before-fadein', swapContent);
		$wrapper.off('after-fadein').on('after-fadein', done);				
		$wrapper.trigger("redraw");
		$.cookie.set('timeline-feed',tab,9999);
	}

	$stream.on('changeloc',function(){
		$stream.attr("loc", ($feedtabs.filter(".current").attr("data-feed")||"featured") );
	})

	if("vertical"=="normal"){
		$wrapper.trigger("arrange");		
	}
	$(window).trigger("prefetch.infiniteshow");

	$stream.delegate('.figure-item',"mouseover",function(){
		if ($(this).parents('.timeline').hasClass('classic')==true) {
			$(this).find('.figure.classic .back')
				.width($(this).find('.figure.classic img').width())
				.height($(this).find('.figure.classic img').height())
				.css('margin-left',-($(this).find('.figure.classic img').width()/2)+'px')
				.css('margin-top',-($(this).find('.figure.classic img').height()/2)+'px')
				.css('left','50%')
				.css('top','50%')
			.end();
			$(this).find('.price').css('margin-top',($(this).find('.figure.classic').height()-$(this).find('.figure.classic img').height())/2+'px').css('margin-left',($(this).find('.figure.classic').width()-$(this).find('.figure.classic img').width())/2+'px');
			$(this).find('.share').css('margin-top',($(this).find('.figure.classic').height()-$(this).find('.figure.classic img').height())/2+'px').css('margin-right',($(this).find('.figure.classic').width()-$(this).find('.figure.classic img').width())/2+'px');
		}else{
			$(this).find('.figure.classic .back').removeAttr('style').end()
			.find('.price').removeAttr('style').end()
			.find('.figure.classic .share').removeAttr('style');
		}
	});
})();

	$.infiniteshow({
		itemSelector:'#content ol.stream > li',
		streamSelector:'#content ol.stream',
		dataKey:'home-new',
		post_callback: function($items){ $('ol.stream').trigger('itemloaded') },
		prefetch:true,
		
		newtimeline:true
	})
	if($.browser.msie) $.infiniteshow.option('prepare',1000);




<!-- MyThings Ads Start -->

function _mt_ready(){
   if (typeof(MyThings) != "undefined") {
       MyThings.Track({
           EventType: MyThings.Event.Visit,
               Action: "200"
       });
   }
}
var mtHost = (("https:" == document.location.protocol) ? "https" : "http") + "://rainbow-us.mythings.com";
//alert(mtHost);
var mtAdvertiserToken = "2236-100-us";
document.write(unescape("%3Cscript src='" + mtHost + "/c.aspx?atok="+mtAdvertiserToken+"' type='text/javascript'%3E%3C/script%3E"));




    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
        });
    });

</script>
