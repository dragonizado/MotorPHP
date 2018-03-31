<?php 
	/**
	* Dragonizado 2018
	*/
	class app
	{
		private $file_controller= "controllers";
		private $url_controller= null;
		private $url_action= null;
		private $url_params = array();

		function __construct()
		{
			$this->url_filter();

			if(!$this->url_controller){
				require APP.$this->file_controller.'/defaultController.php';
				$page = new defaultController();
				$page->index();

			}else if(file_exists(APP . $this->file_controller.'/' . $this->url_controller . '.php')){
				   require APP .$this->file_controller.'/' . $this->url_controller . '.php';
				   $this->url_controller = new $this->url_controller();
				   if(method_exists($this->url_controller, $this->url_action)){
					   	if (!empty($this->url_params)) {
					   		call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
					   	}else{
					   		 $this->url_controller->{$this->url_action}();
					   	}
				   }else{
					   	if (strlen($this->url_action) == 0) {
		                    // no action defined: call the default index() method of a selected controller
		                    $this->url_controller->index();
		                }else{
		                    header('location: ' . URL . 'problem');
		                }
				   }

			}else{
				 header('location: ' . URL . 'problem');
			}

		}

		private function url_filter(){
			if (isset($_GET['url'])) {
				$url = trim($_GET['url'], '/');
	            $url = filter_var($url, FILTER_SANITIZE_URL);
	            $url = explode('/', $url);

	            $this->url_controller = isset($url[0]) ? $url[0] : null;
            	$this->url_action = isset($url[1]) ? $url[1] : null;

            	unset($url[0], $url[1]);

            	 $this->url_params = array_values($url);

            	//echo 'Controller: ' . $this->url_controller . '<br>';
	            //echo 'Action: ' . $this->url_action . '<br>';
	            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';

			}
		}

	}
 ?>