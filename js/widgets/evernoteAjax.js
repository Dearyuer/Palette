jQuery(function(){
	var $ = jQuery;
	var EAS = EVERNOTE_AJAX_SETTINGS;

	$.get(
		EAS.home_url+"/wp-content/themes/palette/libs/evernoteCloudSdk/evernote.php",{
		count:EAS.count
	}).done(function(data){
		console.log(data);
		$(".evernote .loading-anim").hide();
		$(".evernote").append(data);
	});
});