<?php
class controller {

	protected $db;
	private $userInfo;

	public function __construct() {


		$u = new Users;
		$u->setLoggedUser();

		$this->userInfo = array(
			'userName' 	  	=> $u->getInfo($u->getId(), $u->getCompany()),
			'user'			=> $u
		);


	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		extract($viewData);

		include 'views/template.php';

	}
	
	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadViewError() {
		header("Location: error");
	}

	public function include1($view, $dados) {	
		include ('views/include/'.$view.'.php');	
	}

	public function loadRelatorio($viewName, $viewData = array()) {
		extract($viewData);

		include 'views/relatorios/'.$viewName.'.php';
	}

	public function loadImg($viewData = array(),$lay_Width) {
		extract($viewData);

		include 'views/include/image.php';
	}

	public static function ReturnValor($valor){

		$valor = trim($valor);
		$valor = ucfirst($valor);

		return $valor;
	}

	public static function PriceSituation($valor){

		$valor = trim($valor);
		$valor = str_replace(' ', '', $valor);
		$valor = str_replace('R$', '',$valor);
		$valor = explode(',', $valor);
		$valor = str_replace('.', '', $valor);
		
		return $valor[0];
	}


}