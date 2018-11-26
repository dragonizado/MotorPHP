<?php 
class defaultController extends controller{

	private $model = null;
	private $user_model = null;
	function __construct(){
		$this->model = $this->cargarModelo("default");
		$this->user_model = $this->cargarModelo("users");
	}

	public function index(){
		//Descomentar para validar el login del usuario.	
		// if (!$this->isLogin()) {
		// 		// $this->login();
		// 		exit();
		// 	}	

		$this->pageName="Pagina Principal";
		
		//metodo antiguo para renderizar las vistas
		// require APP.'views/default/template/header.php';
		// require APP.'views/default/index.php';
		// require APP.'views/default/template/footer.php';

		//Nuevo metodo para renderizar las vitas 
		$this->render("default/index");

	}

	public function login(){
		$this->pageTitle = 'Iniciar sesión';
		$errors = '';
		if(isset($_POST['btn-login'])){
			$model = $this->user_model;
			$model->__set("name",$_POST['name']);
			$model->__set("password",$_POST['password']);
			if($model->login()){
				session_start();
				$_SESSION['user'] = $model->__get('name');
				$_SESSION['email'] = $model->__get('email');
				$this->redirect("default/index");
			}else{
				$this->message('danger','Los datos no concuerdan con nuestros registros.');
				$errors = 'is-invalid';
			}
		}
		$this->render("default/login",["errors"=>$errors],'login');
	}

	public function logout(){
		session_start();
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		session_destroy();
		$this->redirect("default/index");
	}
}
 ?>
