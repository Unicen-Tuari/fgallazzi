function Buscador() {
	this.objTpl = null;
	this.optionsTpl ={};
	this.content = "";
	this.cant = 10;
	this.page = 1;
	this.cantPage = 1;
	this.action ="";
	this.url = "index.php";
	this.txt = "";
	this.data= {};
	var that = this;
	this.next = function(){
		this.page += 1;
		this.load();
	};
	this.prev = function(){
		this.page -= 1;
		this.load();
	};
	this.buscarTxt = function(txt){
		this.txt = txt;
		this.page = 1;
		this.load();
	}

	this.init = function(){
		this.load();
	};

	this.load = function(){
		LOADING.show();
		var params = {
			action : that.action,
			page : that.page,
			cant : that.cant,
			txt  : that.txt
		}
		$.each(that.data,function(k,v){
			params[k] = v;
		});
		$.ajax({
			url: that.url,
			type: 'POST',
			dataType: 'json',
			data: params,
			success : function(data){
				LOADING.hide();
				if ('success' in data && data.success){
					that.page = parseInt(data.page);
					that.cantPage = parseInt(data.cant_pages);
					updateListado(data.rows,that.objTpl,that.optionsTpl,that.content);
					$('[data-toggle="tooltip"]').tooltip();
				}
			}
		});
	}
}