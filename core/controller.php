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
            'userName' => $u->getInfo($u->getId(), $u->getCompany()),
            'user' => $u,
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
        include 'views/include/' . $view . '.php';
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
        $valor = str_replace('/', '', $valor);

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
        $symbian = strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile = true;
        } else {
            $mobile = false;
        }

        return $mobile;
    }

    public static function alert($tipo, $mensagem)
    {

        $_SESSION['alert']['mensagem'] = $mensagem;
        $_SESSION['alert']['tipo'] = $tipo;

        return $_SESSION['alert'];
    }

    public static function getMesNOW()
    {

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $semana1 = ucfirst('%A');
        $de = mb_strtolower('de');

        $data = strftime('%B', strtotime('today'));

        return ucwords($data);
    }

    public static function getMesDayNOW()
    {

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $semana1 = ucfirst('%A');
        $de = mb_strtolower('de');

		$data = strftime('%m', strtotime('today'));
		$valor = str_replace('0', '', $data);
 
        return ucwords($valor);
	}

    public static function getDayNOW()
    {

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $semana1 = ucfirst('%A');
        $de = mb_strtolower('de');

        $data = strftime('%d', strtotime('today'));
 
        return ucwords($data);
    }
	
	public static function getAnoNow()
    {

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $semana1 = ucfirst('%A');
        $de = mb_strtolower('de');

		$data = strftime('%Y', strtotime('today'));
		

        return ucwords($data);
    }

    public function getLucro($id_inventario)
    {
        
        $u = new Inventario;
        $array = $u->getLucro($id_inventario);
        if(count($array) > 0){
            

            $preco_venda = $array['preco_situacao'];
            $preco_compra = $array['inventario_preco'];


            $lucro = $preco_venda - $preco_compra;

            include 'views/inventario/lucro.php';
        }
    }

    public function getLeilaoON($id_inventario)
    {
        
        $u = new Inventario;
        $array = $u->getleilaoON($id_inventario);
        if(count($array) > 0){
            
            include 'views/inventario/leilaoON.php';
        }
    }

    public function getProcedencia($id_inventario)
    {
        
        $u = new Inventario;

        $array = $u->getProcedencia($id_inventario);
        if(count($array) > 0){
            
            return $array;
        }else {
            return 0;
        }
    }



}
