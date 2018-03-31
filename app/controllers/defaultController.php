<?php 
class defaultController extends controller{

	private $model = null;

	function __construct(){
		$this->model = $this->cargarModelo("defaultModel");
	}

	public function index(){		
		$this->pageName="Pagina Principal";
		require APP.'views/default/template/header.php';
		require APP.'views/default/index.php';
		require APP.'views/default/template/footer.php';
	}

	public function ajax(){
		echo "Estas en el metodo de ajax";
	}
}
 ?>
