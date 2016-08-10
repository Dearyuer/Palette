/*
Plugin Name : jQuery Fullscreen viewer
Github repository: https://github.com/Dearyuer/Fullscreen-viewer
Author: Dearyuer
Author URL: http://codrips.com
Description: Fullscreen viewer
Dependence: jQuery & jQuery Draggable

*/

(function($){
	$overlay = $("<div></div>");
	$overlay.addClass("drop-overlay");
	$overlay.css({
		position: "fixed",
	    top: 0,
	    left: 0,
	    right: 0,
	    bottom: 0,
	    background: "rgba(0,86,132,.9)",
	    zIndex: -250000,
	    opacity: 0,
	});
	$("body").append($overlay);

	$.prototype.fullscreenViewer = function(){
		var self = $(this);
		// inst.draggable();
		$(".fullscreen-component").on('mousedown', function(e){

			
			$(".drop-overlay").css({
				opacity: 1,
				zIndex: 240000,
			});
			
			self.css({
				zIndex:"250000",
				// float:"right",
				// width: "50%",
				// height: "50%"
				
			});
			self.draggable({ 
				revert: true
			});
			// console.log(inst.parent("a"));
			// inst.draggable();
		}).on('mouseup', function(e){
			self.draggable( 'destroy' );
			self.css({
				
			});
			$(".drop-overlay").css({
				opacity: 0,
				zIndex: -250000,
			});
		});

	}


}).call(this, jQuery);

jQuery(function(){
	jQuery(".palette-sidebar-profile").fullscreenViewer();
});
