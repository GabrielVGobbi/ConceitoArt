<?php
class InventarioController extends controller
{

  private $user;

  public function __construct()
  {
    parent::__construct();
    $this->user = new Users();
    $this->user->setLoggedUser();
    if ($this->user->isLogged() == false) {

      header("Location: " . BASE_URL . "login");
      exit();
    }

    $this->mobile = controller::returnMobile();

    $this->id_inv_situacao = '';


    //CLASSES//
    $this->inventario = new Inventario();
    $this->artista = new Artista();
    $this->tecnica = new Tecnica();

    $this->dataInfo['errorForm'] = array();
    $this->dataInfo = array(
      'pageController' => 'inventario',
      'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),
      'filtro' => array(),
    );
  }

  public function index()
  {

    if ($this->user->hasPermission('inventario_view')) {
      if (isset($_GET['filtros'])) {
        $this->dataInfo['filtro'] = $_GET['filtros'];
      }

      $this->dataInfo['artista']      = $this->artista->getAll('', $this->user->getCompany());
      $this->dataInfo['tecnica']      = $this->tecnica->getAll('', $this->user->getCompany());


      $this->dataInfo['p'] = 1;
      if (isset($_GET['p']) && !empty($_GET['p'])) {
        $this->dataInfo['p'] = intval($_GET['p']);
        if ($this->dataInfo['p'] == 0) {
          $this->dataInfo['p'] = 1;
        }
      }

      $offset = (10 * ($this->dataInfo['p'] - 1));

      $this->dataInfo['inventario_count'] = $this->inventario->getCountInventario($this->id_inv_situacao, $this->user->getCompany(), $this->dataInfo['filtro']);
      $this->dataInfo['p_count']          = ceil($this->dataInfo['inventario_count'] / 10);
      $this->dataInfo['id_inventarioArray'] = $this->inventario->getID($offset, $this->dataInfo['filtro'], $this->user->getCompany());

      $this->dataInfo['tableDados']   = $this->inventario->getAll($offset, $this->dataInfo['filtro'], $this->user->getCompany());









      //if($this->mobile == false){
      $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
      //}else {
      // $this->loadTemplate($this->dataInfo['pageController'] . "/index_mobile", $this->dataInfo);
      //}
    } else { }
  }

  public function add()
  {

    $this->dataInfo['artista'] = $this->artista->getAll($this->dataInfo['filtro'] = array(), $this->id_company);
    $this->dataInfo['tecnica'] = $this->tecnica->getAll($this->dataInfo['filtro'] = array(), $this->id_company);

    if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {

      $this->dataInfo['errorForm'] = $_SESSION['formError'];
      unset($_SESSION['formError']);
    }

    if ($this->user->getName() == 'marcio') {
      $this->dataInfo['parametroSituacao'] = $this->parametro->getSituacaoOn();
      $this->dataInfo['parametroProcedencia'] = $this->parametro->getProcedenciaOn();

      $this->loadTemplate($this->dataInfo['pageController'] . "/marcio/modalCadastro", $this->dataInfo);
    } else {

      $this->loadTemplate($this->dataInfo['pageController'] . "/modalCadastro", $this->dataInfo);
    }
  }

  public function add_action()
  {

    if (isset($_POST['id_artista']) && $_POST['id_artista'] != '') {

      if (isset($_POST['id_tecnica']) && $_POST['id_tecnica'] != '') {

        $result = $this->inventario->add($this->user->getCompany(), $this->user->getId(), $_POST, $_FILES['fotos']);
      }

      $this->addValicao($result);

      header('Location:' . BASE_URL . 'inventario');
      exit();
    }
  }

  public function edit_action($id)
  {

    $result = $this->inventario->edit($this->user->getCompany(), $this->user->getId(), $_POST, $_FILES['fotos'], $id);

    if (!empty($_POST['server'])) {
      $location = explode('admin/', $_POST['server']);
      header('Location:' . BASE_URL . $location[1]);
      exit();
    } else {
      header('Location:' . BASE_URL . 'inventario');
      exit();
    }
  }

  public function duplicarObra($id)
  {

    $obra = $this->inventario->getInventarioById($id, $this->user->getCompany());

    $result = $this->inventario->duplicarObra($obra, $this->id_inv_situacao);

    if (isset($result['inventario_add']['mensagem']['sucess'])) {
      $_SESSION['form']['success'] = 'Success';
      $_SESSION['form']['type'] = 'success';
      $_SESSION['form']['mensagem'] = "Ediçao efetuada com sucesso!!";
    } elseif (isset($result['inventario_add']['mensagem']['error'])) {

      $_SESSION['form']['success'] = 'Oops!!';
      $_SESSION['form']['type'] = 'error';
      $_SESSION['form']['mensagem'] = "Não foi possivel fazer a edição no inventario";
    }

    header('Location:' . BASE_URL . 'inventario');
    exit();
  }

  public function delete($id)
  {

    $result = $this->inventario->delete($id, $this->user->getCompany());

    header("Location: " . BASE_URL . "inventario");

    if ($result) {
      $this->dataInfo['success'] = 'true';
      $this->dataInfo['mensagem'] = "Exclusão feita com sucesso!!";
    } else {
      $this->dataInfo['error'] = 'true';
      $this->dataInfo['mensagem'] = "Não foi possivel excluir!";
    }
  }























  public function addValicao($result)
  {

    if (isset($result['inventario_add']['mensagem']['sucess']) && isset($result['mercadolivre_add']['mensagem']['sucess'])) {
      $_SESSION['form']['success'] = 'Success';
      $_SESSION['form']['type'] = 'success';
      $_SESSION['form']['mensagem'] = "Cadastro no inventario e no mercado livre efetuado com sucesso!!";
    } elseif (isset($result['inventario_add']['mensagem']['error']) && isset($result['mercadolivre_add']['mensagem']['error'])) {
      $_SESSION['form']['success'] = 'Oops!!';
      $_SESSION['form']['type'] = 'error';
      $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro no inventario nem no mercado livre!";
    } elseif (isset($result['inventario_add']['mensagem']['sucess']) && isset($result['mercadolivre_add']['mensagem']['error'])) {
      $_SESSION['form']['success'] = 'Sucess';
      $_SESSION['form']['type'] = 'warning';
      $_SESSION['form']['mensagem'] = "Cadastro efetuado no inventario mas deu erro no mercado livre!";
    } elseif (isset($result['inventario_add']['mensagem']['sucess'])) {
      $_SESSION['form']['success'] = 'Sucess';
      $_SESSION['form']['type'] = 'success';
      $_SESSION['form']['codigo'] = 'Codigo: ';
      $_SESSION['form']['mensagem'] = "Cadastro efetuado com sucesso";
    } elseif (isset($result['inventario_add']['mensagem']['error'])) {
      $_SESSION['form']['success'] = 'Oops!!';
      $_SESSION['form']['type'] = 'error';
      $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro";
    } elseif (isset($result['mercadolivre_add']['mensagem']['sucess'])) {
      $_SESSION['form']['success'] = 'Sucess!!';
      $_SESSION['form']['type'] = 'success';
      $_SESSION['form']['mensagem'] = "Cadastro no mercado livre efetuado com sucesso!!";
    } elseif (isset($result['mercadolivre_add']['mensagem']['error'])) {
      $_SESSION['form']['success'] = 'Oops!!';
      $_SESSION['form']['type'] = 'error';
      $_SESSION['form']['mensagem'] = "erro no mercado livre!";
    }

    return $_SESSION['form'];
  }
}
