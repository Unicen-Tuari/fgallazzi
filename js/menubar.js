$(document).ready(function() {

	marcarCategoriaSeleccionada(location.href);

	$("#menubar  li").click(function(event) {
		$.each($("#menubar li"), function(index, val) {
			//$(this).removeClass('active');
			$(this).removeClass('active-menu-bar');
			$.each($(this).find("ul"), function(index,val){
				$(this).addClass('hidden');

			});
		});
        
		$(this).find('ul').removeClass('hidden');
		if ($(this).find('ul > li').length > 0){
			if ($(this).hasClass('active-menu-bar')){
				$(this).removeClass('active-menu-bar');
				
			}else{
				$(this).addClass('active-menu-bar');
			}

		}else{
			$(this).addClass('active');
		}
		
		
	});


});	


function marcarCategoriaSeleccionada(url){
	var uri = url.split('?');
	if (uri.length > 1){
		uri = uri[1].split('&');
		for (var i = 0; i < uri.length; i++) {
			var param = uri[i].split('=');
			if (param.length > 1){
				if (param[0] == 'categoria'){
					var li = $('#menubar').find('li[id='+param[1]+']');
					li.parent().removeClass('hidden').parent().addClass('active-menu-bar');
					li.find('span').addClass('glyphicon glyphicon-hand-left');
					return;
				}
			}
		}

	}
}