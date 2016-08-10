(function(){

	var $ = this.jQuery,
		doc = this.document.documentElement,
		isAnimating = false,
		current = -1,
		lockScroll = false,
		xscroll,yscroll;
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

	$(".post-item").each(function(index){
		var self = $(this);
		self.on('click', function(e){
			e.preventDefault();
			if(isAnimating || current === index){
				return false;
			}
			isAnimating = true;
			current = index;
			self.addClass("post-item-loading");

			self.children().css({
				'backgroundColor': "#e1e8ed"
			});
			setTimeout(function() {
				self.addClass('post-item-animate');
				// reveal/load content after the last element animates out (todo: wait for the last transition to finish)
				setTimeout(function() { 
					loadContent(self,self.parent().parent()); 
				}, 500);
			}, 1000);
		});
	});


	function loadContent(item, parent) {

		//const
		var paddingLeft = 20,
			titleTop = 35;
			separator = " ";

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
		$('body').addClass('view-single');
		

		// console.log(parent.position());
		//expand
		var offsetNum = 15;
		var expandSize = "";
		expandSize += 'translate3d(' + (-parent.position().left + getViewport('x')) + 'px,' + separator;
		expandSize += (scrollY() - parent.position().top) + 'px,' + separator;
		expandSize += '0px)';
		//console.log(expandSize);
		var expandScale = 'scale3d(' + (getViewport('x')-offsetNum)/$dummy.width() + ',' + separator;
		expandScale += getViewport('y')/$dummy.height() + ',' + separator;
		expandScale += '1)';
		setTimeout(function() {
			$dummy.css({
				'transform': expandSize + separator + expandScale
			});
			window.addEventListener('scroll', noscroll);
		}, 35);
		$dummy.on('transitionend webkitTransitionEnd oTransitionEnd', function (e) {
			$dummy.removeClass('placeholder-trans-in');
			$dummy.addClass('placeholder-trans-out');

			$(".main-content").css({
				'top':  scrollY() + 'px'
			});
			$(".main-content").addClass('content-show');
			// console.log($(".main-content .content-item")[current]);
			$(".main-content .content-item")[current].className += ' content-item-show';

			//close button
			$('body').addClass('noscroll');

			isAnimating = false;
		});

	}



}).call(this);





// console.log(parent.width());
// console.log(item.parent().width());
// console.log(parent);
// console.log(item.parent());
// dummy.style.WebkitTransform = 'translate3d(' + (item.offsetLeft - 5) + 'px, ' + (item.offsetTop - 5) + 'px, 0px) scale3d(' + item.offsetWidth/gridItemsContainer.offsetWidth + ',' + item.offsetHeight/getViewport('y') + ',1)';
// dummy.style.transform = 'translate3d(' + (item.offsetLeft - 5) + 'px, ' + (item.offsetTop - 5) + 'px, 0px) scale3d(' + item.offsetWidth/gridItemsContainer.offsetWidth + ',' + item.offsetHeight/getViewport('y') + ',1)';

// // console.log(getViewport('x'));
// // console.log(scrollX())
// // $(".side-area").css({
// // 	opacity:0
// // });
// // $(".contri").css({
// // 	opacity:0
// // });
// // add expanding element/placeholder 
// // var dummy = $('<div></div>');
// // dummy.addClass('placeholder');
// // console.log(item);
// // // set the width/heigth and position
// // // dummy[0].style.WebkitTransform = 'translate3d(' + (item.offsetLeft - 5) + 'px, 
// // //' + (item.offsetTop - 5) + 'px, 
// // //0px) 
// // //scale3d(
// // //' + item.offsetWidth/$(".container").offsetWidth + ',
// // //' + item.offsetHeight/getViewport('y') + ',1)';



// // // dummy[0].style.transform = 'translate3d(' + (item.offsetLeft - 5) + 'px, ' + (item.offsetTop - 5) + 'px, 0px) scale3d(' + item.offsetWidth/$(".container").offsetWidth + ',' + item.offsetHeight/getViewport('y') + ',1)';

// // // add transition class 
// // dummy.addClass('placeholder-trans-in');

// // // insert it after all the grid items
// // $(".post").append(dummy);













// // $('body').addClass('view-single');
// // console.log(item.children('.main-post')[0].offsetWidth);

// // item.children('.main-post').css({
// // 	transform:"translate3d( 87vw,0,0) scale3d("+(getViewport('x')-15)/item.children('.main-post')[0].offsetWidth+","+getViewport('y')/item.children('.main-post')[0].offsetHeight+","+"1)",
	
// // })
// // setTimeout(function(){
// // 	item.children('.main-post').css({
// // 		//transform:"scale3d("+item.children('.main-post')[0].offsetWidth/getViewport('x')+","+item.children('.main-post')[0].offsetHeight/getViewport('y')+","+"1)",
// // 		// width:"100vw",
// // 		// height:"100vw",
// // 		// position:"fixed",
// // 		// top:0,
// // 		// left:0,
// // 		// pointerEvents: "none",
// // 		// position: "fixed",
// // 		// width: "100%",
// // 		// height: "100vh",
// // 		// zIndex: 100,
// // 		// top: 0,
// // 		// left: 0,
// // 		// background: "#fff",
// // 		// transformOrigin: "0 0",
// // 	});
// // },300)


// // window.addEventListener('scroll', noscroll);
// // // // body overlay
// // // classie.add(bodyEl, 'view-single');

// console.log(item.position());
// dummy = $('<article></article>');
// dummy.addClass('placeholder');

// dummy.css({
// 	transform : 'translate3d(' + (item.children('.main-post')[0].offsetLeft - 5) + 'px, ' + (item.children('.main-post')[0].offsetTop - 5) + 'px, 0px) scale3d(' + item.children('.main-post')[0].offsetWidth/$(".main-area")[0].offsetWidth + ',' + item.children('.main-post')[0].offsetHeight/getViewport('y') + ',1)'
// });
// // add transition class 
// dummy.addClass('placeholder-trans-in');

// // insert it after all the grid items
// $(".main-area").prepend(dummy);

// $('body').addClass('view-single');
// setTimeout(function() {
// 	// expands the placeholder
// 	dummy.css({
// 		//transform:"translate3d( 87vw,0,0) scale3d("+(getViewport('x')-15)/item.children('.main-post')[0].offsetWidth+","+getViewport('y')/item.children('.main-post')[0].offsetHeight+","+"1)",
// 		transform : 'translate3d(-5px, ' + (scrollY() - 5) + 'px, 0px)'
// 	});
// 	// disallow scroll
// 	window.addEventListener('scroll', noscroll);
// }, 25);



// // setTimeout(function() {
// // // 	// expands the placeholder
// // // 	dummy.style.WebkitTransform = 'translate3d(-5px, ' + (scrollY() - 5) + 'px, 0px)';
// // 	dummy[0].style.transform = 'translate3d(-5px, ' + (scrollY() - 5) + 'px, 0px)';
// // // 	// disallow scroll
// // // 	window.addEventListener('scroll', noscroll);
// // }, 25);


// // $(".main-area").on('transitionend webkitTransitionEnd oTransitionEnd', function (e) {
//     // your event handler
//     // $(".hidden-content").addClass('content--show');
// // });


// // onEndTransition(dummy, function() {
// // 	// add transition class 
// // 	classie.remove(dummy, 'placeholder--trans-in');
// // 	classie.add(dummy, 'placeholder--trans-out');
// // 	// position the content container
// // 	contentItemsContainer.style.top = scrollY() + 'px';
// // 	// show the main content container
// // 	classie.add(contentItemsContainer, 'content--show');
// // 	// show content item:
// // 	classie.add(contentItems[current], 'content__item--show');
// // 	// show close control
// // 	classie.add(closeCtrl, 'close-button--show');
// // 	// sets overflow hidden to the body and allows the switch to the content scroll
// // 	classie.addClass(bodyEl, 'noscroll');

// // 	isAnimating = false;
// // });