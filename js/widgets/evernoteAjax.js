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
				$(".evernote").append(val.title);
			});
		}
		catch(e){
			throw e;
		}
	});
});