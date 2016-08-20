(function(){

	var $ = this.jQuery;
	var lanAnchor = $('a.palette-lan');
	var anchor = $('.menu a:not(a.palette-lan)');
	function getUrlVars(){
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}
	if(getUrlVars()['lan'] && getUrlVars()['lan'] == 'en_us'){
		$.each(anchor, function(index, item){
			$(this).attr('href', $(this).attr('href').replace(/\/?(\?|#|$)/, '/$1') + '?' + $.param({
				'lan' : 'en_us'
				})
			);
		});
	}else{
		$.each(anchor, function(index, item){
			$(this).attr('href', $(this).attr('href').replace(/\/?(\?|#|$)/, '/$1') + '?' + $.param({
				'lan' : 'zh_cn'
				})
			);
		});
	}
}).call(this);