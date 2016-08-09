

jQuery(function(){
	// $githubUsername = "Dearyuer";
	// $githubContri = file_get_contents("https://github.com/users/".$githubUsername."/contributions"); 
	// $githubContri = preg_replace('/class="js-calendar-graph-svg"/','viewBox="0 -7 796 126"',$githubContri);
	// $githubContri = preg_replace('/#1e6823/','#1d9af6',$githubContri);
	// $githubContri = preg_replace('/#8cc665/','#00a8f2',$githubContri);
	// $githubContri = preg_replace('/#44a340/','#00bfff',$githubContri);
	// echo $githubContri;

	var $ = jQuery;
	var G_H_C_A = GIT_HUB_CON_AJAX;

	$.get(
		G_H_C_A.home_url+"/wp-content/themes/palette/libs/githubContri/contri.php"
	).done(function(data){
		$('.git-contri-loading-anim').hide();
		result = '<div class="animated fadeIn">';
		data = data.replace(/class="js-calendar-graph-svg"/,'viewBox="0 -7 796 126"');
		data = data.replace(/#1e6823/g,'#1d9af6');
		data = data.replace(/#8cc665/g,'#00a8f2');
		data = data.replace(/#44a340/g,'#00bfff');
		data = data.replace(/#d6e685/g,'#86e1ff');
		result += data;
		result += '</div>';
		$('.contri').append(result);

	});

});