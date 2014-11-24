<?php 
	/**
	* 
	*/
	class ConfigApp 
	{
		
		

		/* Clasificación de usuarios */
		public static $USER_NO_LOGUEADO  = 0;
		public static $USER_LOGUEADO     = 1;
		public static $USER_ADMIN        = 2;

		/* Clasificación de grupos de usuarios */
		public static $GRUPO_USER_NO_LOGUEADO  = 'gNL';
		public static $GRUPO_USER_LOGUEADO     = 'gL';
		public static $GRUPO_USER_ADMIN        = 'gA';

		/* Clasificacion de actions */
		public static $ACTION            = 'action';
		public static $ACTION_HOME       = 'home';
		public static $ACTION_PRODUCTOS  = 'productos';
		public static $ACTION_DETALLE    = 'detalle';
		public static $ACTION_PUBLICAR   = 'publicar';
		public static $ACTION_CARGAR_PUBLICACION = "cargar_publicacion";
		public static $ACTION_GET_CATEGORIAS = "get_categorias";
		public static $ACTION_GET_CARACTERISTICAS = "get_caracteristicas";
		public static $ACTION_BUSCADOR   = "buscar";
		public static $ACTION_GET_ALL_PRODUCTOS_BY_AJAX = "get_all_productos_by_ajax";
		public static $ACTION_GET_CARRITO_BY_AJAX = "carrito_compra_by_ajax";
		public static $ACTION_FORM_LOGIN_BY_AJAX = "form_login_by_ajax";
		public static $ACTION_LOGIN_BY_AJAX = "login_by_ajax";
		public static $ACTION_GET_TMP_LISTADO_BY_AJAX = "get_tmp_listado_by_ajax";
		public static $ACTION_FORM_NUEVO_USUARIO_BY_AJAX = "form_nuevo_usuario_by_ajax";
		public static $ACTION_ALTA_NUEVO_USUARIO_BY_AJAX = "alta_nuevo_usuario_by_ajax";
		public static $ACTION_LOGOUT_BY_AJAX = "logout_by_ajax";
		public static $ACTION_FORM_LOGIN     = "form_login";
		public static $ACTION_INSERT_PRODUCTO_CARRITO_BY_AJAX = "insert_producto_carrito_by_ajax";
		public static $ACTION_GET_CONTENT_BY_AJAX = "getcontent";
		public static $ACTION_UPDATE_CARRITO_BY_AJAX = "updatecarritobyajax";
		public static $ACTION_CONFIRMAR_COMPRA_BY_AJAX = "confirmar_compra_by_ajax";
		
		/* Clasificación de ID'S */
		public static $ID_CATEGORIA          = "categoria";
		public static $ID_PRODUCTO           = "product";

		public static $BUSCAR_TXT            = "buscar_txt";

		/* Clasificación de carpetas para los distintos usuarios */
		public static $PATH_USER_ADMIN       = "./rol/user-admin";
		public static $PATH_USER_NO_LOGUEADO = "./rol/user-no-logueado";
		public static $PATH_USER_LOGUEADO    = "./rol/user-logueado";

		/* Tiempo de vida del carrito esperando por confirmacion de compra */
		const VIDA_CARRITO =  72000; // dos horas 

	}

 ?>