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

		/* Clasificación de ID'S */
		public static $ID_CATEGORIA      = "categoria";

		/* Clasificación de carpetas para los distintos usuarios */
		public static $PATH_USER_ADMIN       = "/rol/user-admin";
		public static $PATH_USER_NO_LOGUEADO = "/rol/user-no-logueado";
		public static $PATH_USER_LOGUEADO    = "/rol/user-logueado";
	}

 ?>