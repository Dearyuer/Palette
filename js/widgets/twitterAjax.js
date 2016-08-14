jQuery(function(){

	var TAS = TWITTER_AJAX_SETTINGS;
	var $ = jQuery;

	function timeAgo(now,time){
		    var time_ago  = Math.floor((now - time)/1000); 
		    var temp = 0;
			if(time_ago){
				if(time_ago < 60){
					return TAS.time_ago.just_now;
				}else if(time_ago < 1800){
					temp = Math.floor(time_ago/60);
					return  temp+TAS.time_ago.min_ago;
				}else if(time_ago < 3600){
					return  TAS.time_ago.h_a_ago
				}else if(time_ago < 3600*24){
					temp = Math.floor(time_ago/3600);
					return temp+TAS.time_ago.h_ago;
				}else if(time_ago < 3600*24*2){
					return TAS.time_ago.yes;
				}else{
					temp = Math.floor(time_ago/(3600*24));
					return temp+TAS.time_ago.days_ago;
				}
			}
			else{
				return null;
			}
	}
	$.get(
		TAS.home_url+"/wp-content/themes/palette/libs/tmhOAuth/tweets_json.php",{
		count:TAS.count
	}).done(function(data){
			$('.palette-twitter .loading-anim').hide();
			var data = jQuery.parseJSON(data);
			if(TAS.lan == 'zh_cn'){
				for(var i = 0;i < TAS.count;i++){
					if(data[i].lang == "zh"){
						var elemLi = $('<li></li>');
						var elemP = $('<p></p>');
						var elemSpan = $('<span></span>');
						var elemI = $('<i></i>');


						var create_at_date = Date.parse(data[i].created_at);




						//<span class="tweet-time"><i class="fa fa-twitter-square" aria-hidden="true"></i></span>
						elemP.addClass("tweet-text");
						elemP.html(
							data[i].text
						);


						elemSpan.addClass("tweet-time");
						elemSpan.html(
							timeAgo(new Date().getTime(),create_at_date)+' '
							//$.timeago()
						);




						elemP.append(elemSpan);


						elemI.addClass("fa").addClass("fa-clock-o").attr({
							"aria-hidden": "true"
						});
						elemSpan.append(elemI);

						elemLi.addClass('fadeIn').addClass('animated');
						elemLi.append(elemP);
						$(".tweets").append(elemLi);
						//console.log(data);
					}
					
				}
			}else if(TAS.lan == 'en_us'){
				// for(var i = 0;i < TAS.count;i++){
				// 	if(data[i].lang == "en"){
				// 		$(".tweet-text")[i].innerHTML= data[i].text;
				// 		console.log(data);
				// 	}
					
				// }
				// wait for update
			}
			
		});
});