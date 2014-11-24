<?php 
	// Libreria de Smarty
		require_once "libs/Smarty/Smarty.class.php";
		include_once "controller/config_app.php";
	/**
	* Clase Padre View
	*/
	class View
	{
		
		
		/**
		 * Constructor
		 */
		function __construct()
		{
			$this->templateEng = new Smarty();

			$this->set("pathUser",Registry::get('pathUser'));
			$this->set("NOMBRE_USER",Registry::get('nameUser'));
			$this->addDir("./templates/layouts");
		}

		/**
		 * Atributos
		 */
		private $templateEng;


		protected function set($name,$value){
			$this->templateEng->assign($name,$value);
		}

		protected function setParams($params){
			foreach ($params as $key => $value){
				$this->set($key,$value);
			}
		}

		protected function render($file){
			$this->templateEng->display($file);
		}

		protected function read($file){
			return $this->templateEng->fetch($file);
		}

		protected function addDir($path){
			$d = $this->templateEng->getTemplateDir();
			$d[] = $path;
			$this->templateEng->setTemplateDir($d);
		}

		public function json($data){
			echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			exit();
		}
		
		public function success($success){
			$json = ($success) ? array ('success' => true) : array ('success' => false);
			$this->json($json);
		}

		public function getContents(){

			$tpl_navBar = 'content-nav-bar.tpl';
			$navbar =  $this->templateEng->fetch($tpl_navBar);

			$json = array(
				'success' => true,
				'contents' => array('content-navbartrastos' => $navbar)
				);
			$this->json($json);
		}

		 function json_last_error_msg() {
        static $errors = array(
            JSON_ERROR_NONE             => null,
            JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
            JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
            JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );
        $error = json_last_error();
        return array_key_exists($error, $errors) ? $errors[$error] : "Unknown error ({$error})";
    }
	}

 ?>