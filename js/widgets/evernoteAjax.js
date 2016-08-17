jQuery(function(){
	var $ = jQuery;
	var EAS = EVERNOTE_AJAX_SETTINGS;

	$.get(
		EAS.home_url+"/wp-content/themes/palette/libs/evernoteCloudSdk/evernote.php",{
		count:EAS.count
	}).done(function(data){
		console.log(data);
		try{
			var data = $.parseJSON(data);
			$(".evernote .loading-anim").hide();
			$.each(data,function(index,val){ 
		        var $note = $("<li></li>");
                var $anchor = $("<a></a>");
                $anchor.attr("href","#");
                $anchor.html(val.title);
                $note.append($anchor);
				$(".evernote").append($note);
                console.log($note);
			});
		}
		catch(e){
			throw e;
		}
	});
});
