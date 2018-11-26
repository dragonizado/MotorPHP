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
		$this->openDbConection();
	}

	private function openDbConection(){
		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
		$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
	}

	public function cargarModelo($nombre_modelo){
		$this->openDbConection();
		$nombre_modelo = $nombre_modelo."Model";
		require APP.'models/'.$nombre_modelo.'.php';
		return new $nombre_modelo($this->db);
	}

	public function render($view)
    {
      $folderf = '';
      $default_folder = _DEFAULTFOLDER_TEMPLATE_;
      $arguments = func_get_args();
      if (isset($arguments[1])) {
        if(is_array($arguments[1])){
            if (count($arguments[1]) != 0) {
                foreach ($arguments[1] as $key => $value) {
                    ${$key} = $value;
                }
            }
            if(isset($arguments[2])){
                if (!is_null($arguments[2]) || !$arguments[2] == "") {
                    $folderf = $arguments[2];
                }else{
                    $folderf = $default_folder;   
                }
            }else{
                $folderf = $default_folder;
            }
        }else{
            if(isset($arguments[2])){
                if (count($arguments[2]) != 0) {
                    foreach ($arguments[2] as $key => $value) {
                        ${$key} = $value;
                    }
                }
            }
            if($arguments[1] == "" || $arguments[1] == null){
                $folderf = $default_folder;
            }else{
                $folderf = $arguments[1];
            }
        }
		}else{
			$folderf = $default_folder;
		}

		if(isset($_SESSION['message'])){
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
		}
      
        if(is_array($view)){
            require APP . 'views/_templates/'.$folderf.'/header.php';
            foreach ($view as $key => $value) {
               require APP . 'views/'.$value.'.php';
            }
            require APP . 'views/_templates/'.$folderf.'/footer.php';
        }else{
            require APP . 'views/_templates/'.$folderf.'/header.php';
            require APP . 'views/'.$view.'.php';
            require APP . 'views/_templates/'.$folderf.'/footer.php';
        }
    }

    public function isLogin(){
        session_start();
        if(isset($_SESSION['user'])){
            return true;
        }
        return false;
    }

    public function mensajes($tipo,$msn){
    	session_start();
		$_SESSION['message'] = [$tipo,$msn];
    }

    public function redirect($url){
		header("location:".URL."public/?url=".$url);
	}
}
	

 ?>