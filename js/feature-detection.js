(function(){
	var $ = jQuery;
	// console.log("test");

	var supports = [
	 "csspointerevents",
	 "rgba",
	 "opacity",
	 "supports",
	 "cssanimations",
	 "borderradius",
	 "boxshadow",
	 "boxsizing",
	 "csstransforms",
	 "csstransforms3d",
	 "csstransitions",
	 "svg"
	];

	$.each(supports,function(index,value){
		if(!$("html").hasClass(value)){
			$("body").html("your browser does not support this site's some features,plz consider update=)");
			return false;
		}
	})


}).call(this);