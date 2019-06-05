<?php
class controller
{

	protected $db;
	private $userInfo;

	public function __construct()
	{


		$u = new Users;
		$u->setLoggedUser();

		$this->userInfo = array(
			'userName' 	  	=> $u->getInfo($u->getId(), $u->getCompany()),
			'user'			=> $u
		);
	}

	public function loadView($viewName, $viewData = array())
	{
		extract($viewData);
		include 'views/' . $viewName . '.php';
	}

	public function loadTemplate($viewName, $viewData = array())
	{
		extract($viewData);

		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData)
	{
		extract($viewData);
		include 'views/' . $viewName . '.php';
	}

	public function loadViewError()
	{
		header("Location: error");
	}

	public function include1($view, $dados)
	{
		include('views/include/' . $view . '.php');
	}

	public function loadRelatorio($viewName, $viewData = array())
	{
		extract($viewData);

		include 'views/relatorios/' . $viewName . '.php';
	}

	public function loadImg($viewData = array(), $lay_Width)
	{
		extract($viewData);

		include 'views/include/image.php';
	}

	public static function ReturnValor($valor)
	{

		$valor = trim($valor);
		$valor = ucfirst($valor);

		return $valor;
	}

	public static function PriceSituation($valor)
	{

		$valor = trim($valor);
		$valor = str_replace(' ', '', $valor);
		$valor = str_replace('R$', '', $valor);
		$valor = explode(',', $valor);
		$valor = str_replace('.', '', $valor);

		return $valor[0];
	}

	public static function ReturnFormatLimpo($valor)
	{
		$valor = trim($valor);
		$valor = str_replace(' ', '', $valor);
		$valor = str_replace('-', '', $valor);
		$valor = str_replace('.', '', $valor);

		return $valor;
	}

	public static function returnMobile()
	{
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
		$ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
		$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
		$symbian =  strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

		if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
			$mobile = true;
		} else {
			$mobile = false;
		}

		return $mobile;
	}
}
