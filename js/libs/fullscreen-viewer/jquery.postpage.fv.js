(function(){

	var $ = this.jQuery,
		doc = this.document.documentElement,
		isAnimating = false,
		lockScroll = false,
		xscroll,yscroll;

	var	separator = " ",
		body = $('body'),
		postItem = $(".post-item");
	/**
	 * gets the viewport width and height
	 * based on http://responsejs.com/labs/dimensions/
	 */
	function getViewport( axis ) {
		var client, inner;
		if( axis === 'x' ) {
			client = doc['clientWidth'];
			inner = this['innerWidth'];
		}
		else if( axis === 'y' ) {
			client = doc['clientHeight'];
			inner = this['innerHeight'];
		}
		
		return client < inner ? inner : client;
	}
	function scrollX() { return this.pageXOffset || doc.scrollLeft; }
	function scrollY() { return this.pageYOffset || doc.scrollTop; }

	function noscroll() {
		if(!lockScroll) {
			lockScroll = true;
			xscroll = scrollX();
			yscroll = scrollY();
		}
		window.scrollTo(xscroll, yscroll);
	}

	postItem.each(function(){
		var self = $(this);
		self.on('click', function(e){
			e.preventDefault();
			if(isAnimating){
				return false;
			}
			isAnimating = true;
			self.addClass("post-item-loading");
			self.children().css({
				'backgroundColor': "#e6e6e6"
			});
			$.get(self.attr("url")).done(function(data){
				try {
					body.append(data);
				}catch(e){
					self.html("cant reach server");
					throw e;
				}
				var mainContent = $(".main-content");
				setTimeout(function(){
					self.addClass("post-item-loaded");
				},500);
				setTimeout(function() {
					self.addClass('post-item-animate'); //fade out
					// reveal/load content after the last element animates out (todo: wait for the last transition to finish)
					setTimeout(function() { 
						loadContent(self,self.parent().parent(),mainContent); 
					}, 500);
				}, 1000);
			});
			//stop load
			
		});
	});


	function loadContent(item, parent, mainContent) {

		//const
		var paddingLeft = 20;
			// titleTop = 36;
		

		var $dummy = $("<div></div>");

		$dummy.addClass('placeholder');

		var initPos = "";
		initPos += 'translate3d(' + (item.position().left) + 'px,' + separator;
		initPos += (item.position().top) + 'px,' + separator;
		initPos += '0px)';

		var initSize = 'scale3d(' + item.parent().width()/parent[0].offsetWidth + ',' + separator;
		initSize += item.parent().height()/getViewport('y') + ',' + separator;
		initSize += '1)';

		$dummy.css({
			'transform': initPos + separator + initSize
		});
		$dummy.addClass('placeholder-trans-in');
		parent.append($dummy);
		body.addClass('view-single');
		

		// console.log(parent.position());
		//expand
		var offsetWidth = 16;
		var expandSize = "";
		//console.log(parent.position())
		expandSize += 'translate3d(' + (-parent.position().left - paddingLeft + getViewport('x')) + 'px,' + separator;
		expandSize += scrollY() - parent.position().top + 'px,' + separator;
		expandSize += '0px)';
		//console.log(expandSize);
		var expandScale = 'scale3d(' + (getViewport('x')-offsetWidth)/$dummy.width() + ',' + separator;
		expandScale += getViewport('y')/$dummy.height() + ',' + separator;
		expandScale += '1)';
		setTimeout(function() {
			$dummy.css({
				'transform': expandSize + separator + expandScale
			});
			window.addEventListener('scroll', noscroll);
		}, 35);
		$dummy.on('transitionend webkitTransitionEnd oTransitionEnd', function (e) {

			/////notice
			mainContent.show();


			$dummy.removeClass('placeholder-trans-in');
			$dummy.addClass('placeholder-trans-out');

			mainContent.css({
				'top':  scrollY() + 'px'
			});
			mainContent.addClass('content-show');
			mainContent.addClass('content-animate');
			// console.log($(".main-content .content-item")[current]);
			//$(".main-content .content-item")[current].className += ' content-item-show';

			//close button
			$(".fa-times").on('click',function(){
				hideContent(initPos,initSize,mainContent);
			})


			body.addClass('noscroll');

			//custom
			// $(".main-container").hide();
			// $('.header').hide();
			// $('.footer').hide();

			isAnimating = false;
		});

	}


	function hideContent(initPos,initSize,mainContent) {
		// $(".main-container").show();
		// $('.header').show();
		// $('.footer').show();
		mainContent.removeClass('content-show');
		
		// classie.remove(closeCtrl, 'close-button--show');
		body.removeClass('view-single');

		setTimeout(function() {
			//var dummy = gridItemsContainer.querySelector('.placeholder');
			var $dummy = $(".placeholder");
			
			$dummy.css({
				transform: initPos + separator + initSize
			});
			$dummy.on('transitionend webkitTransitionEnd oTransitionEnd', function (e) {
				$dummy.remove();
				mainContent.hide();
			
				postItem.removeClass('post-item-loading');
				postItem.removeClass('post-item-loaded');
				postItem.removeClass('post-item-animate');
				body.removeClass('noscroll');
				lockScroll = false;
				window.removeEventListener( 'scroll', noscroll );
				mainContent.removeClass('content-animate');
				setTimeout(function(){
					postItem.children().css({
						'backgroundColor': "white"
					});
				},500);
				mainContent.remove();
			});

			// onEndTransition(dummy, function() {
			// 	// reset content scroll..
			// 	contentItem.parentNode.scrollTop = 0;
			// 	gridItemsContainer.removeChild(dummy);
			// 	classie.remove(gridItem, 'grid__item--loading');
			// 	classie.remove(gridItem, 'grid__item--animate');
			// 	lockScroll = false;
			// 	window.removeEventListener( 'scroll', noscroll );
			// });
			
			// reset current
			// current = -1;
		}, 25);
	}



}).call(this);