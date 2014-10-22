$(document).ready(function() {

	marcarActiveMenu(location.href);

});	


function marcarActiveMenu(url){
	$('#navbar-trastos li').removeClass('active');
	var uri = url.split('?');
	if (uri.length > 1){
		uri = uri[1].split('&');
		for (var i = 0; i < uri.length; i++) {
			var param = uri[i].split('=');
			if (param.length > 1){
				if (param[0] == 'action'){
					$('#navbar-trastos li').find("a[href*='"+param[1]+"']").parent('li').addClass('active');
					return;
				}
			}
		}

	}else{
		$('#navbar-trastos li').find("a[href*='home']").parent('li').addClass('active');
	}
}