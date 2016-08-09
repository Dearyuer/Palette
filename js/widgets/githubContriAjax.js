(function(){


	// $githubUsername = "Dearyuer";
	// $githubContri = file_get_contents("https://github.com/users/".$githubUsername."/contributions"); 
	// $githubContri = preg_replace('/class="js-calendar-graph-svg"/','viewBox="0 -7 796 126"',$githubContri);
	// $githubContri = preg_replace('/#1e6823/','#1d9af6',$githubContri);
	// $githubContri = preg_replace('/#8cc665/','#00a8f2',$githubContri);
	// $githubContri = preg_replace('/#44a340/','#00bfff',$githubContri);
	// echo $githubContri;

	var $ = jQuery;

	$.get(
		'https://github.com/users/Dearyuer/contributions'
	).done(function(data){

		console.log(data);



	});









})();