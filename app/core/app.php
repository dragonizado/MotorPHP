<?php 
/**
 * Dragonizado 2018
 */
class app
{

	private $file_controller = CONTROLLERS_FOLDER;
	private $url_controller = null;
	private $url_method = null;
	private $url_params = [];


	function __construct()
	{
		$this->url_filter();
		if(!$this->url_controller){
			require APP.$this->file_controller.'defaultController.php';
			$page = new defaultController();
			$page->index();
		}else if(file_exists(APP.$this->file_controller.$this->url_controller.".php")){
			require_once APP.$this->file_controller.$this->url_controller.".php";
			$this->url_controller = new $this->url_controller();
			if(method_exists($this->url_controller, $this->url_method)){
			    //Verificar si hay parametros
			   	if(!empty($this->url_params)){
			   		call_user_func_array(array($this->url_controller,$this->url_method), $this->url_params);
			   	}else{
			   		$this->url_controller->{$this->url_method}();
			   	}
			}else{
				//Si el metodo llamado no existe se verifica si se ingreso alguna palabra en el metodo.
			   	if(strlen($this->url_method) == 0){
			        $this->url_controller->index();
			    }else{
			        //Mostrar pagina de error ya que el metodo ingrasado no existe en el controlador ingresado.
					header("location:".URL."public/?url=error");
			    }
			}

		}else{
			//Mostrar pagina de error si el controlador que se ingresa en la url no existe.
			header("location:".URL."public/?url=error");
		}
	}

	private function url_filter(){
		if(isset($_GET['url'])) {
			$url = trim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);

            $this->url_controller = (isset($url[0]))?$url[0]."Controller":null;
        	$this->url_method = (isset($url[1]))?$url[1]:null;
        	unset($url[0],$url[1]);
        	$this->url_params = array_values($url);

        	//echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_method . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
		}
	}

}
 ?>