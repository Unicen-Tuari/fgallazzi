<?php 
	include_once "controller_class.php";
	include_once "model/model_class.php";

	/**
	 * PaginadorController
	 * 
     */
	class PaginadorController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new Model();
		}

		private $model;
		private $cant = 10;
		private $tabla;
		private $cols = array();
		private $where = "";
		private $dataParamsPrepare = false;
		private $page = 1;
		private $cantPages = -1;
		private $txt = "";
		private $colsArr = array();

		public function setTxt($txt){
			if ($txt !== false && strlen($txt) > 0 ){
				$this->txt = $txt;
				$this->setBuscador();
			}
		}
		public function setPage($p){
			$this->page =($p !== false) ? $p : $this->page ;
		}
		public function setCant($c){
			$this->cant = ($c !== false) ? $c : $this->cant;
		}

		public function setTabla($tabla){
			$this->tabla = $tabla;
		}

		public function setCols($cols){
			$this->colsArr = $cols;
			$this->cols = implode(" , ",$cols);
		}

		public function setWhere($params){
			$this->where = "";
			$this->dataParamsPrepare = false;
			if (count($params) > 0){
				$this->where = " WHERE ";
				$this->dataParamsPrepare = array();
				foreach ($params AS $key => $val){
					$this->dataParamsPrepare[':'.$key]=$val;
					$this->where .= $key . '=:' . $key . ' and ';
				}
				$this->where = substr($this->where,0,strlen($this->where)-4);
			}
		}

		public function getPage(){
			
			$offset = $this->getOffset();	

			$limit = " limit {$offset} , {$this->cant} ";

			$sql = "SELECT  {$this->cols}  FROM  {$this->tabla}  {$this->where} {$limit}";

			return $data = $this->model->query($sql,$this->dataParamsPrepare);
		}

		public function count(){
			$sql = "SELECT count(1) as count from {$this->tabla} {$this->where}";
			$count = $this->model->query($sql,$this->dataParamsPrepare);
			return isset($count[0]['count']) ? $count[0]['count'] : 0;
		}

		private function countPages(){
			$count = $this->count($this->tabla,$this->where,$this->dataParamsPrepare);
			$nPaginas = ceil($count / $this->cant);
			$this->cantPages = $nPaginas;
			return $nPaginas;
		}

		private function setBuscador(){
			$buscador = "";
			foreach ($this->colsArr AS $col){
				$buscador .= " {$col} like '%{$this->txt}%' OR ";
			}
			$this->buscador = substr($buscador, 0, strlen($buscador)-4);
			$this->concatWhereBuscador();
		}

		private function concatWhereBuscador(){
			$where = "";
			if ($this->where == ""){
				$this->where = " WHERE  ( {$this->buscador} )";
			}else{
				$this->where .= " and ( {$this->buscador} )";
			}
		}

		public function getCountPages(){
			if ($this->cantPages == -1){
				return $this->countPages();
			}else{
				return $this->cantPages;
			}

		}

		public function getNPage(){
			return $this->page;
		}

		public function getOffset(){
			$cantPages = $this->getCountPages();
			if ($this->page >= $cantPages){
				$this->page = $cantPages;
				return (($this->page > 0) ? $this->page - 1 : 0) * $this->cant;
			}else if ($this->page <= 0){
				$this->page = 1;
				return 0;
			} else {
				return (($this->page > 0) ? $this->page - 1 : 0) * $this->cant;
				return $offset;
			}
		}
	}

 ?>