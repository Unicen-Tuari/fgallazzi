<?php 

	/**
	* 
	*/
	class Validar
	{
		
		function __construct(){
			
		}

		public function validar($datos,$reglas){
			$eval = array();
			foreach ($datos as $key => $dato) {
				foreach ($reglas[$key] as $reglaKey => $reglaVal) {
					$r = $this->ejecuteRegla($reglaKey,$reglaVal,$datos,$key);
					if (!$r['r']){
						if (isset($reglaVal['msj'])){
							$eval[$key][$reglaKey] = $reglaVal['msj'];
						}else {
							$eval[$key][$reglaKey] = $r['msj'];
						}
					}
				}
			}
			if (empty($eval)){
				return true;
			}
			return $eval;
		}
		
		private function requerido($val,$bool){

			return ($bool) ? (!empty($val)) : true;
		}

		private function minLength($val,$l){
			return (strlen($val) >= $l);
		}

		private function maxLength($val,$l){
			return (strlen($val) <= $l);
		}

		private function esNumero($val){
			return (is_numeric($val));
		}

		private function esEntero($val){
			if (is_numeric($val)){
				$val = $val * 1;
				if (is_int($val)){
					return true;
				}
			}
			return false;
		}

		private function esFloat($val){
			if (is_numeric($val)){
				$val = $val * 1;
				if (is_float($val)){
					return true;
				}
			}
			return false;
		}

		private function sonIguales($val1,$val2){
			return ($val1 == $val2);
		}

		private function esEmail($val){
			return filter_var($val, FILTER_VALIDATE_EMAIL);
		}

		private function ejecuteRegla($regla,$reglaVal,$dato,$key){
			$msj = "";
			switch ($regla) {
				case Validar::$SON_IGUALES : 
					$r =  $this->sonIguales($dato[$reglaVal[0]],$dato[$reglaVal[1]]);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$ES_FLOAT:
					$r =  $this->esFloat($dato[$key]);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$ES_ENTERO:
					$r =  $this->esEntero($dato[$key]);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$ES_NUMERO:
					$r =  $this->esNumero($dato[$key]);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$MAX_LENGTH:
					$r =  $this->maxLength($dato[$key],$reglaVal);
					$msj = (!$r) ? $this->getMensaje($regla, $reglaVal) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$MIN_LENGTH:
					$r =  $this->minLength($dato[$key],$reglaVal);
					$msj = (!$r) ? $this->getMensaje($regla, $reglaVal) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$REQUERIDO:
					$r =  $this->requerido($dato[$key],$reglaVal);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				case Validar::$ES_EMAIL:
					$r =  $this->esEmail($dato[$key]);
					$msj = (!$r) ? $this->getMensaje($regla) : "";
					return array('r' => $r , 'msj' => $msj);
					break;
				default:
					return true;
				break;
			}
		}

		private function getMensaje($regla,$val = false){
			switch ($regla) {
				case Validar::$SON_IGUALES : 
					return 'Los datos no coinciden.';
					break;
				case Validar::$ES_FLOAT:
					return 'Por favor ingrese un numero con decimales válido.';
					break;
				case Validar::$ES_ENTERO:
					return 'Por favor ingrese un numero entero válido.';
					break;
				case Validar::$ES_NUMERO:
					return 'Por favor ingrese un numero válido.';
					break;
				case Validar::$MAX_LENGTH:
					return 'Indique como máximo ' . $val . ' caracteres.';
					break;
				case Validar::$MIN_LENGTH:
					return 'Indique como minimo ' . $val . ' caracteres.';
					break;
				case Validar::$REQUERIDO:
					return 'Este dato es requerido.';
					break;
				case Validar::$ES_EMAIL:
					return 'Por favor ingrese una dirección de e-mail válida';
					break;
				default:
					return true;
				break;
			}
		}

		public static  $SON_IGUALES = 'son_iguales';
		public static  $ES_FLOAT    = 'es_float';     
		public static  $ES_ENTERO   = 'es_entero';
		public static  $ES_NUMERO   = 'es_numero';
		public static  $MAX_LENGTH  = 'max_length';
		public static  $MIN_LENGTH  = 'min_length';
		public static  $REQUERIDO   = 'es_requerido';
		public static  $ES_EMAIL    = 'es_email';

	}



 ?>