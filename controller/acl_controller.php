<?php  
	include_once "controller_class.php";
	include_once "config_app.php";
	include_once "registry.php";

	/**
	* 
	*/
	class AclController extends Controller
	{
		
		private static $_instance = null;

		function __construct()
		{
			parent::__construct();
			
		}

		public static function getInstance(){
			if (self::$_instance === null){
				self::$_instance = new self;
			}
			return self::$_instance;
		}

		public function validarAcceso(){
			return $this->controlUsuario();
		}
			
		private function getGrupoUsuario(){
			if (!$this->getDataSession('user')){
				return ConfigApp::$GRUPO_USER_NO_LOGUEADO;
			}else if ($this->getDataSession('rol') == ConfigApp::$USER_LOGUEADO){
				return ConfigApp::$GRUPO_USER_LOGUEADO;
			}else if ($this->getDataSession('rol') == ConfigApp::$USER_ADMIN){
				return ConfigApp::$GRUPO_USER_ADMIN;
			}else{
				return false;
			}
		}

		private function controlUsuario(){
			$grupo = $this->getGrupoUsuario();
			if ($this->getDataRequest(ConfigApp::$ACTION) === false){
				return true;
			}
			$action = $this->getAction($this->getDataRequest(ConfigApp::$ACTION));
			
			if ($action !== false){
				if ($action[$grupo] == 1){
					return true;
				} else {
					$requiere = $this->getRequiereAction($action['action'],$grupo);
					if ($requiere !== false){
						$this->requiereAction($requiere['requiere']);
					}
				}
				return false;
			}
		}

		private function requiereAction($requiere){
			$view = new View();
			if ($this->isAjax()){
				$json = array('success' => false,
						  'action' => $requiere);
				return $view->json($json);
				break;
			}else{
				header("Location: index.php?".ConfigApp::$ACTION."=".$requiere."&next=".urlencode($this->getUriParamsRequest()));
				exit();
			}
		}

		public function setUser (){
			$grupo = $this->getGrupoUsuario();
			if ($grupo == ConfigApp::$GRUPO_USER_NO_LOGUEADO){
				Registry::set('pathUser',ConfigApp::$PATH_USER_NO_LOGUEADO);
			}else if ($grupo == ConfigApp::$GRUPO_USER_LOGUEADO){
				Registry::set('pathUser',ConfigApp::$PATH_USER_LOGUEADO);
			}else if ($grupo == ConfigApp::$GRUPO_USER_ADMIN){
				Registry::set('pathUser',ConfigApp::$PATH_USER_ADMIN);
			}
			Registry::set('nameUser',$this->getDataSession('user'));
		}
		
		/**
		 * Estructura de actions
		 * array (
		 *        action -> nombre de action,
		 * 		  gNL -> grupo no logueado 1 permitido 0 no permitido,
		 * 		  gL -> grupo logueado	1 permitido 0 no permitido,			
		 * 		  gA -> grupo admin 1 permitido 0 no permitido
		 * 		  	
		 * */
		private function getAction($action){
			$actions = array(
				array ('action' => ConfigApp::$ACTION_HOME,'gNL' => 1, 'gL' => 1, 'gA' => 1),
				array ('action' => ConfigApp::$ACTION_PRODUCTOS, 'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_DETALLE,'gNL' => 0, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_PUBLICAR,'gNL' => 1, 'gL' => 1, 'gA' => 0 ),
				array ('action' => ConfigApp::$ACTION_CARGAR_PUBLICACION,'gNL' => 0, 'gL' => 1, 'gA' => 0 ),
				array ('action' => ConfigApp::$ACTION_GET_CATEGORIAS,'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_GET_CARACTERISTICAS,'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_BUSCADOR,'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_GET_ALL_PRODUCTOS_BY_AJAX,'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_GET_CARRITO_BY_AJAX,'gNL' => 0, 'gL' => 1, 'gA' => 0 ),
				array ('action' => ConfigApp::$ACTION_FORM_LOGIN_BY_AJAX,'gNL' => 1, 'gL' => 0, 'gA' => 0 ),
				array ('action' => ConfigApp::$ACTION_LOGIN_BY_AJAX, 'gNL' => 1, 'gL' => 0, 'gA' => 0 ),
				array ('action' => ConfigApp::$ACTION_GET_TMP_LISTADO_BY_AJAX,'gNL' => 1, 'gL' => 1, 'gA' => 1 ),
				array ('action' => ConfigApp::$ACTION_FORM_NUEVO_USUARIO_BY_AJAX,'gNL' => 1, 'gL' => 0, 'gA' => 0),
				array ('action' => ConfigApp::$ACTION_ALTA_NUEVO_USUARIO_BY_AJAX, 'gNL' => 1, 'gL' => 0, 'gA' => 0),
				array ('action' => ConfigApp::$ACTION_LOGOUT_BY_AJAX, 'gNL' => 0, 'gL' => 1, 'gA' => 1),
				array ('action' => ConfigApp::$ACTION_FORM_LOGIN, 'gNL' => 1, 'gL' => 0, 'gA' => 0)
			);

			foreach ($actions as $a) {
				if ($a['action'] == $action){
					return $a;
				}
			}
			return false;
		}

		private function getRequiereAction($action,$grupo){
			$actions = array(
				array ('action' => ConfigApp::$ACTION_CARGAR_PUBLICACION, 'grupo' => 'gNL' , 'requiere' => 'login'),
				array ('action' => ConfigApp::$ACTION_DETALLE, 'grupo' => 'gNL' , 'requiere' => ConfigApp::$ACTION_FORM_LOGIN)
			);

			foreach ($actions as $a) {
				if ($a['action'] == $action && $a['grupo'] == $grupo ){
					return $a;
				}
			}
			return false;
		}

	}
	
?>