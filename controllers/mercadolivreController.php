<?php
class MercadolivreController extends controller {

	private $user;

  public function __construct() {
    parent::__construct();
    $this->user = new Users();
    $this->user->setLoggedUser();
    if($this->user->isLogged() == false){

      header("Location: ".BASE_URL."login");
      exit();
    }

    $this->id_inv_situacao = '';
    $this->filtro = array();


    

    //CLASSES//
    $this->inventario = new Inventario();
    $this->mercadolivre = new MercadoLivre();
    $this->artista = new Artista();
    $this->tecnica = new Tecnica();

    $this->dataInfo['errorForm'] = array();
    $this->dataInfo = array(
      'pageController' => 'mercadolivre',
      'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),

    );
  }

  public function index() {


    if(isset($_GET['filtros'])) {
      $this->filtro = $_GET['filtros'];
    }

    $this->filtro['id_inv_situacao'] = TRUE;
    

    $this->dataInfo['artista']      = $this->artista->getAll('', $this->user->getCompany());
    $this->dataInfo['tecnica']      = $this->tecnica->getAll('', $this->user->getCompany());


    $this->dataInfo['p'] = 1;
    if(isset($_GET['p']) && !empty($_GET['p'])){
      $this->dataInfo['p'] = intval($_GET['p']);
      if($this->dataInfo['p'] == 0){
        $this->dataInfo['p'] = 1;
      }
    } 

    $offset = (10 * ($this->dataInfo['p']-1) );

    $this->dataInfo['inventario_count'] = $this->inventario->getCountInventario($this->id_inv_situacao,$this->user->getCompany(), $this->filtro);
    $this->dataInfo['p_count']          = ceil( $this->dataInfo['inventario_count'] / 10);


    $this->dataInfo['tableDados']   = $this->inventario->getAll($offset, $this->filtro,$this->user->getCompany());


    $this->loadTemplate($this->dataInfo['pageController']."/index", $this->dataInfo);
  }

  public function addmercadolivre($id) {

    $this->dataInfo['errorForm'] = array();

    if($this->user->hasPermission('inventario_add')){

      if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){

        $this->dataInfo['errorForm'] = $_SESSION['formError'];
        unset($_SESSION['formError']);      
      }

      $obra = $this->inventario->getInventarioById($id, $this->user->getCompany());

      $result = $this->mercadolivre->addmercadolivreById($obra);

      $this->addValicao($result);

      header('Location:'.BASE_URL.'mercadolivre');
      exit();

    }else {

      $this->loadViewError($data);
    }

  }

  public function vendas() {


    $this->dataInfo['tableDados']   = $this->mercadolivre->getAllVendas();
    
    $this->loadTemplate($this->dataInfo['pageController']."/vendas", $this->dataInfo);
  }




















 public function addValicao($result){

  if(isset($result['inventario_add']['mensagem']['sucess']) && isset($result['mercadolivre_add']['mensagem']['sucess'])){
   $_SESSION['form']['success'] = 'Success';
   $_SESSION['form']['type'] = 'success';
   $_SESSION['form']['mensagem'] = "Cadastro no inventario e no mercado livre efetuado com sucesso!!";
 }elseif (isset($result['inventario_add']['mensagem']['error']) && isset($result['mercadolivre_add']['mensagem']['error'])){
   $_SESSION['form']['success'] = 'Oops!!';
   $_SESSION['form']['type'] = 'error';
   $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro no inventario nem no mercado livre!";
 }elseif (isset($result['inventario_add']['mensagem']['sucess']) && isset($result['mercadolivre_add']['mensagem']['error'])){
   $_SESSION['form']['success'] = 'Sucess';
   $_SESSION['form']['type'] = 'warning';
   $_SESSION['form']['mensagem'] = "Cadastro efetuado no inventario mas deu erro no mercado livre!";
 }elseif (isset($result['inventario_add']['mensagem']['sucess'])){
   $_SESSION['form']['success'] = 'Sucess';
   $_SESSION['form']['type'] = 'success';
   $_SESSION['form']['codigo'] = 'Codigo: ';
   $_SESSION['form']['mensagem'] = "Cadastro efetuado com sucesso";
 }elseif (isset($result['inventario_add']['mensagem']['error'])){
   $_SESSION['form']['success'] = 'Oops!!';
   $_SESSION['form']['type'] = 'error';
   $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro";
 }elseif (isset($result['mercadolivre_add']['mensagem']['sucess'])){
   $_SESSION['form']['success'] = 'Sucess!!';
   $_SESSION['form']['type'] = 'success';
   $_SESSION['form']['mensagem'] = "Cadastro no mercado livre efetuado com sucesso!!";
 }elseif (isset($result['mercadolivre_add']['mensagem']['error'])){
   $_SESSION['form']['success'] = 'Oops!!';
   $_SESSION['form']['type'] = 'error';
   $_SESSION['form']['mensagem'] = "erro no mercado livre!";
 }

 return $_SESSION['form'];

}

}