
	
	$('.btn-slideshow').live('click' , function(){
	$('#popup_container').show();
	$('#popup_container').css({"opacity":"1"});
	$('#slideshow-box').show();
	$('#add-to-list-new').hide();
			// We only want these styles applied when javascript is enabled
			$('div.content').css('display', 'block');
			
			var slideImage = $('#slideshow img');
			var slide = $('.slideshow-container');
		$('.image-caption').width(slideImage.width());
		$('.image-caption').css({
				'bottom' : Math.floor((slide.height() - slideImage.outerHeight()) / 2),
				'left' : Math.floor((slide.width() - slideImage.width()) / 2) + slideImage.outerWidth() - slideImage.width()
			});
			var screenSize = screen.height;
	
		if (screenSize > 768) {
			screenSize = (screenSize - 768)/2 + 'px';
			$('#slideshow-box .contant').css({ 'margin-top' : screenSize });
		}
	});
	
	$(document).live('keydown' , function(e) {
		var keycode = e.keyCode;
		
		if (keycode == 27) {
			$('#popup_container').hide();
			$('#popup_container').css({"opacity":"0"}); 
			$('#slideshow-box').hide();
			$('.btn-slideshow').removeClass('current');
		}
	});
	
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
		
    });
	
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

	(function(){
		
		var onMouseOutOpacity = 0.67;
		$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
		});
		var captionOpacity = 0.7;
		
		// Initialize Advanced Galleriffic Gallery
		var gallery = $('#thumbs').galleriffic({
			delay:                     2500,
			numThumbs:                 10,
			preloadAhead:              10,
			enableTopPager:            false,
			enableBottomPager:         false,
			imageContainerSel:         '#slideshow',
			controlsContainerSel:      '#controls',
			captionContainerSel:       '#caption',
			loadingContainerSel:       '#loading',
			renderSSControls:          true,
			renderNavControls:         true,
			playLinkText:              'Play Slideshow',
			pauseLinkText:             'Pause Slideshow',
			prevLinkText:              '&lsaquo; Previous Photo',
			nextLinkText:              'Next Photo &rsaquo;',
			nextPageLinkText:          'Next &rsaquo;',
			prevPageLinkText:          '&lsaquo; Prev',
			enableHistory:             true,
			autoStart:                 false,
			syncTransitions:           true,
			defaultTransitionDuration: 900,
			onSlideChange:             function(prevIndex, nextIndex) {
				// 'this' refers to the gallery, which is an extension of $('#thumbs')
				this.find('ul.thumbs').children()
					.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
					.eq(nextIndex).fadeTo('fast', 1.0);
			},
			onTransitionOut:           function(slide, caption, isSync, callback) {
				slide.fadeTo(this.getDefaultTransitionDuration(isSync), 0.0, callback);
				caption.fadeTo(this.getDefaultTransitionDuration(isSync), 0.0);
			},
			onTransitionIn:            function(slide, caption, isSync) {
				var duration = this.getDefaultTransitionDuration(isSync);
				slide.fadeTo(duration, 1.0);
				
				// Position the caption at the bottom of the image and set its opacity
				var slideImage = slide.find('img');
				caption.width(slideImage.width())
					.css({
						'bottom' : Math.floor((slide.height() - slideImage.outerHeight()) / 2),
						'left' : Math.floor((slide.width() - slideImage.width()) / 2) + slideImage.outerWidth() - slideImage.width()
					})
					.fadeTo(duration, captionOpacity);
			},
			onPageTransitionOut:       function(callback) {
				this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn:        function() {
				var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
				var nextPageLink = this.find('a.next').css('visibility', 'hidden');
				
				// Show appropriate next / prev page links
				if (this.displayedPage > 0)
					prevPageLink.css('visibility', 'visible');

				var lastPage = this.getNumPages() - 1;
				if (this.displayedPage < lastPage)
					nextPageLink.css('visibility', 'visible');

				this.fadeTo('fast', 1.0);
			}
		});

		/**************** Event handlers for custom next / prev page links **********************/

		gallery.find('a.prev').click(function(e) {
			gallery.previousPage();
			e.preventDefault();
		});

		gallery.find('a.next').click(function(e) {
			gallery.nextPage();
			e.preventDefault();
		});

		/****************************************************************************************/

		/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

		// PageLoad function
		// This function is called when:
		// 1. after calling $.historyInit();
		// 2. after calling $.historyLoad();
		// 3. after pushing "Go Back" button of a browser
		function pageload(hash) {
			// alert("pageload: " + hash);
			// hash doesn't contain the first # character.
			if(hash) {
				$.galleriffic.gotoImage(hash);
			} else {
				gallery.gotoIndex(0);
			}
		}

		// Initialize history plugin.
		// The callback is called at once by present location.hash. 
		$.historyInit(pageload, "advanced.html");

		// set onlick event for buttons using the jQuery 1.3 live method
		$("a[rel='history']").live('click', function(e) {
			if (e.button != 0) return true;

			var hash = this.href;
			hash = hash.replace(/^.*#/, '');

			// moves to a new page. 
			// pageload is called at once. 
			// hash don't contain "#", "?"
			$.historyLoad(hash);

			return false;
		});
		
	var $btns = $('.viewer li'), $stream = $('ol.stream'), $container=$('.container'), $wrapper = $('.wrapper-content'), first_id = 's-f_', latest_id = 's-l_';
	
	var sIndex = 21, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
	var followid = 0, loadmoretab = 'all';
	var baseurl = getBaseURL();

	
	
	
	$(window).scroll(function () {
		 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
			if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {	 
		  if (isPreviousEventComplete && isDataAvailable) {

		    isPreviousEventComplete = false;
		    $(".LoaderImage").css("display", "block");

		    $.ajax({
		      type: "GET",
		      url: baseurl+'getMorePosts?startIndex=' + sIndex + '&offset=' + offSet + '&followid='+followid+'&loadmoretab='+loadmoretab,
		      beforeSend: function () {
					$('#infscr-loading').show();
				},
			  dataType: 'html',
		      success: function (result) {
		      	$('#infscr-loading').hide();
		      	var out = result.toString();
		      	if (out != 'false') {//When data is not available
		        	$(".stream").append(result);
		        	var $latest = $stream.find('>#'+latest_id).removeAttr('id'),
			 	    $first = $stream.find('>#'+first_id).removeAttr('id'),
				    $target=$(), viewMode;
				// merge sameuser thing 
				var userid = $latest.attr('auserid');
				
				var $currents = $latest.prevUntil('li[auserid!='+userid+"]");
				var $nexts = $latest.nextUntil('li[auserid!='+userid+"]");
				var $group = $($currents).add($latest).add($nexts);
				$nexts.filter(".clear").removeClass("clear").find("a.vcard").detach();
				
				
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
		        }else {
		            isDataAvailable = false;
				}
		        sIndex = sIndex + offSet;
		        isPreviousEventComplete = true;
		      }
		    });

		  }
		 }
		 });
	
	
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
	
	



	
	
	$btns.live('each' , function(){
		var $tip = $(this).find('span');
		$tip.css('margin-left', -$tip.width()/2 - 8 + 'px');
	});
	
	$(window).resize(function() {
		$btns.each(function(){
		var $tip = $(this).find('span');
		$tip.css('margin-left', -$tip.width()/2 - 8 + 'px');
	});
	});
	
	
	$btns.live('click' , function(event){
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
					//alert('mod1212');
			
				$items.each(function(i,v,a){
					var $li = $(this);
					var $grid_img = $li.find(".figure.grid");
					//alert($li.height());
					//$li.css("left","0");
					if($li.height()>400){
						$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
					}else{
						$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
					}
				});
			}
			
			$stream.find('>li').css('opacity',1);
			//$stream.find('>li').css('left',0);
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
//alert();
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
			//alert($items.length);
				$items.each(function(i,v,a){
					var $li = $(this);
					$li.css({top:0, left:6})
					
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
			//alert('ddd');
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

	$feedtabs.live('click' , function(e){
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
		var baseurl = getBaseURL();
		if(!(result=$.jStorage.get('first-'+tab))){			
			$.ajax({
				url : baseurl+'changeTab?feed='+tab,
				dataType : 'html',
				beforeSend : function () {
					$(".stream").fadeOut("fast");
					$('#index-loading').show();
				},
				success : function(data, st, xhr) {
					var out = eval(data);
					if (tab == 'following') {
						followid = out[1];
						loadmoretab = tab;
					}else {
						followid = 0;
						loadmoretab = tab;
					}
					$(".stream").html(out[0]);
					$('#index-loading').hide();
					$(".stream").fadeIn(3000);
					$wrapper.removeClass("wait");
					$wrapper.removeClass("swapping");
					var done = function(){
						setTimeout(function(){$('#content ol.stream > li').css('opacity',1)},500);
					};
					$stream.trigger("changeloc");
					$wrapper.off('before-fadein').on('before-fadein');				
					$wrapper.trigger("redraw");
					$wrapper.off('after-fadein').on('after-fadein', done);
					$.cookie.set('timeline-feed',tab,9999);
					sIndex = 21; offSet = 10; isPreviousEventComplete = true; isDataAvailable = true;
					//result = data;
					//$.jStorage.set('first-'+tab, result, {TTL:5*60*1000});
				},
				error : function(xhr, st, err) {
					url = '';
				},
				complete : function(){
				}
			});
		}
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