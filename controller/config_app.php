<?php 
	/**
	* 
	*/
	class ConfigApp 
	{
		
		

		/* Clasificación de usuarios */
		public static $USER_NO_LOGUEADO  = "user_default";
		public static $USER_LOGUEADO     = "logueado";
		public static $USER_ADMIN        = "admin";

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

		/* Clasificación de ID'S */
		public static $ID_CATEGORIA          = "categoria";
		public static $ID_PRODUCTO           = "product";

		public static $BUSCAR_TXT            = "buscar_txt";

		/* Clasificación de carpetas para los distintos usuarios */
		public static $PATH_USER_ADMIN       = "/rol/user-admin";
		public static $PATH_USER_NO_LOGUEADO = "/rol/user-no-logueado";
		public static $PATH_USER_LOGUEADO    = "/rol/user-logueado";

	}

 ?>