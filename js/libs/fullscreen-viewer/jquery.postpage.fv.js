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
			client = doc.clientWidth;
			inner = this.innerWidth;
		}
		else if( axis === 'y' ) {
			client = doc.clientHeight;
			inner = this.innerHeight;
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
						
						loadContent(self,self.parent().parent(),mainContent,self.parent()); 
						
						
					}, 500);
				}, 1000);

				//handlesubmit comment

				var submitHandler = function(e){
					e.preventDefault();
					try{
						$.ajax({
							url: COMMENT_SUBMIT_AJAX.ajaxurl,
							type: 'POST',
							dataType: 'json',
							data: {
								//comment_post_ID: self.attr("post-id"),
								comment_post_ID: self.attr("post-id"),
								author: $(".comment-form-author #author").val(),
								email: $(".comment-form-email #email").val(),
								url: $(".comment-form-url #url").val(),
								comment: $(".comment-form-comment #comment").val(),
								comment_parent: $(".form-submit #comment_parent").val()
								// _wp_unfiltered_html_comment: ""
								//test it out



								//add action nonce!!!!!!!!!!!!





							},
							success: function (obj){
								console.log(obj);
							},
							error: function (obj){
								console.log(obj);
								//console.log(obj.responseText);
								// (.|[\r\n]) include newline
								try{
								// var reg = /({{<\/div>)((.|[\r\n])+?)(?=<div>}})/;
								var reg = /({{<\/div>)((.|[\r\n])+?)(?=<div class="elem-hidden">}})/;
								var data = obj.responseText.match(reg)[0];
								data = data.slice(8,data.length);
								$(".comments-template-area").html(data);
								$(".form-submit #submit").on('click',submitHandler);



								//add animation!!!loading



								// remove handler delete element!!!!!
								// console.log(reg.exec(obj.responseText)[0]);
								console.log(2);
								//{{<\/div>(.+?)<div>}}
								}catch(e){
									//var reg2 = /(<body)((.|[\r\n])+?)(<\/body>)/;
									var reg2 = /(<body)((.|[\r\n])+?)(<\/body>)/;
									var data2 = obj.responseText.match(reg2)[0];
									data2 = data2.replace(/(<a)((.|[\r\n])+?)(<\/a>)/,'');
									var iframe = $("<div></div");
									iframe.addClass('iframe-notice-div');
									iframe.html(data2);
									// iframe.html(obj.responseText);
									$(".iframe-notice-div").remove();

									// use # go to that id!!!!!!!!!!!!!!!! or not



									$("#respond").append(iframe);
								}
							},
							statusCode: {
							    404: function() {
							      alert( "page not found" );
							    }
							}

						}).done(function(){
							console.log('done');
						}).fail(function() {
						    console.log('fail');
						}).always(function() {
							console.log('always');
						});
					}catch(error){
						alert("You are not supported ajax in your current browser!plz consider update=)");
						throw error;
					}
				};


				$(".form-submit #submit").on('click',submitHandler);
				//$(".form-submit #submit").unbind()
				//remove handler
			});
			//stop load
		});
	});


	function loadContent(item, parent, mainContent,postArticle) {

		//const
		//var paddingLeft = 20;
		var paddingLeft = 2;
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
		var offsetWidth = 15;
		var expandSize = "";

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
		$dummy.on('transitionend webkitTransitionEnd oTransitionEnd', function () {

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
				hideContent(initPos,initSize,mainContent,postArticle);
			});


			body.addClass('noscroll');

			//custom
			// $(".main-container").hide();
			// $('.header').hide();
			// $('.footer').hide();

			isAnimating = false;
		});


	}


	function hideContent(initPos,initSize,mainContent,postArticle) {
		// $(".main-container").show();
		// $('.header').show();
		// $('.footer').show();

		// var nextElem = postArticle.next();
		// if(!nextElem.is('div')){
		// 	postArticle.hide();
		// 	nextElem.css({
		// 		'marginTop': -postArticle.height()
		// 	});
		// }
		mainContent.removeClass('content-show');
		
		// classie.remove(closeCtrl, 'close-button--show');
		body.removeClass('view-single');

		setTimeout(function() {
			//var dummy = gridItemsContainer.querySelector('.placeholder');
			var $dummy = $(".placeholder");
			
			$dummy.css({
				transform: initPos + separator + initSize
			});
			// setTimeout(function(){
			// 	//var nextElem = postArticle.next();
			// 	if(!nextElem.is('div')){
			// 		postArticle.show();
			// 		nextElem.css({
			// 			'marginTop': 0
			// 		});
			// 	}
				
			// },150);
			
			$dummy.on('transitionend webkitTransitionEnd oTransitionEnd', function () {

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
			// 	lockScroll = false;
			// 	window.removeEventListener( 'scroll', noscroll );
			// });
			
			// reset current
			// current = -1;
		}, 25);
	}



}).call(this);