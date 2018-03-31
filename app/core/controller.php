<?php 
	/**
	* Dragonizado 2018
	*/
	class Controller 
	{
		public $db = null;
		public $pageName = "";

		function __construct()
		{
			$this->abrirconexionbasedatos();
		}

		private function abrirconexionbasedatos(){
			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
		}

		public function cargarModelo($nombre_modelo){
			$this->abrirconexionbasedatos();
			require APP.'models/'.$nombre_modelo.'.php';
			return new $nombre_modelo($this->db);
		}
	}

 ?>