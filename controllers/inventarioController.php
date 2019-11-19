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


      //if($this->mobile == false){
      $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
      //}else {
      // $this->loadTemplate($this->dataInfo['pageController'] . "/index_mobile", $this->dataInfo);
      //}
    } else { }
  }

  public function getAll()
  {
    $tabela = $this->inventario->getAll($_REQUEST, $this->user->getCompany());

    $data = array();

    if ($tabela) {
      foreach ($tabela as $list) {

        $situacao = $this->inventario->getleilaoON($list['id_inventario']);

        $sit = !empty($situacao) ? '<span class="label label-danger">' . $situacao['descricao_situacao'] . '</span' : '';

        $venda = ($list['inv_venda'] == '1') ? '<span class="label label-danger">Vendido</span>' : '<span class="label label-success">Não Vendido</span>';

        $descricao = !empty($list['inv_descricao']) ? $list['inv_descricao'] . ' - ' : '';
        $tecnica = !empty($list['nome_tecnica']) ? ucfirst($list['nome_tecnica']) . ' - ' : '';
        $assinatura = !empty($list['inv_assinatura']) ? $list['inv_assinatura'] . ' - ' : '';
        $invData = !empty($list['inv_data']) ? $list['inv_data'] . ' - ' : '';
        $tamanho = !empty($list['inv_tamanho']) ? $list['inv_tamanho'] . ' - ' : '';
        $tiragem = !empty($list['inv_tiragem']) ? $list['inv_tiragem'] : '';

        $artista = str_replace(' ', '_', $list['art_nome']);

        $img = '';

        if (!empty($list['url'])) {
          $img = '<img src="' . BASE_URL . '/assets/images/anuncios/' . $artista . '/' . $list["url"] . ' " class="img-table" style="width:30%"/>';
        }

        $row = array();
        $row[] =
          ' <a class="btn btn-sm btn-info" href="' . BASE_URL . 'inventario/edit/' . $list['id_inventario'] . '" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $list['id_inventario'] . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>
        ';
        $row[] = $img . ' ' . ucfirst($list['art_nome']);

        $row[] = ($descricao . $tecnica . $assinatura . $invData . $tamanho . $tiragem);

        $row[] = ($venda) . ($sit);
        $row[] = ($list['inv_venda']);
        $row[] = ($list['id_inventario']);



        $data[] = $row;
      }

      $total = $this->dataInfo['inventario_count'] = $this->inventario->getCountInventario('', $this->user->getCompany(), $this->dataInfo['filtro']);
    }

    if (isset($_POST['search']['value']) && !empty($_POST['search']['value']) && $tabela) {
      $total = count($tabela);
    }

    if (!$tabela) {
      $total = 0;
    }
    


    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $total,
      "recordsFiltered" =>  $total,
      "data" => $data,
    );

    echo json_encode($output);
  }

  public function edit($id)
  {
    $this->dataInfo['tecnica']      = $this->tecnica->getAll('', $this->user->getCompany());

    $this->dataInfo['inv'] = $this->inventario->getInventarioById($id, $this->user->getCompany());

    $this->loadTemplate($this->dataInfo['pageController'] . "/modalVisualizar", $this->dataInfo);
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
      //$this->dataInfo['parametroSituacao'] = $this->parametro->getSituacaoOn();
      //$this->dataInfo['parametroProcedencia'] = $this->parametro->getProcedenciaOn();

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

    return true;
  }
}
