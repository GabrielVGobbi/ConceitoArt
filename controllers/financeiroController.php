<?php

class FinanceiroController extends controller
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


        $this->financeiro  = new Financeiro;
        $this->clientes  = new Cliente;

        $this->dataInfo['errorForm'] = array();
        $this->dataInfo = array(
            'pageController' => 'financeiro',

        );
    }

    public function index()
    {

        if ($this->user->hasPermission('financeiro_view')) {

            $this->dataInfo['filtro'] = array();

            if (isset($_GET['filtros'])) {
                $this->dataInfo['filtro'] = $_GET['filtros'];
            }

            $this->dataInfo['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $this->dataInfo['p'] = intval($_GET['p']);
                if ($this->dataInfo['p'] == 0) {
                    $this->dataInfo['p'] = 1;
                }
            }

            $this->offset = (10 * ($this->dataInfo['p'] - 1));

            $this->dataInfo['tableDados']   = $this->financeiro->getAll($this->offset, $this->dataInfo['filtro'], $this->user->getCompany());
            $this->dataInfo['financeiro_count'] = $this->financeiro->getCount($this->user->getCompany(), $this->dataInfo['filtro']);


            $this->dataInfo['cliente']      = $this->clientes->getAll('', $this->user->getCompany());

            $this->dataInfo['p_count']      = ceil($this->dataInfo['financeiro_count'] / 10);

            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else {

            echo "not permission";
        }
    }


    public function add()
    {

        if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {

            $this->dataInfo['errorForm'] = $_SESSION['formError'];
            unset($_SESSION['formError']);
        }
    }

    public function add_action()
    {

        if (isset($_POST['instituicao']) && $_POST['instituicao'] != '') {

            $result = $this->financeiro->add($_POST, $this->user->getCompany());

            header('Location:' . BASE_URL . 'financeiro');
            exit();
        }
    }

    public function edit_action()
    {

        if (isset($_POST['instituicao']) && $_POST['instituicao'] != '' && $_POST['id_financeiro'] != '') {

            $result = $this->financeiro->edit($_POST, $this->user->getCompany());

            header('Location:' . BASE_URL . 'financeiro');
            exit();
        }
    }


    public function pagar($id, $mes, $ano)
    {

        if (isset($id) && $id != '') {

            $result = $this->financeiro->pagar($id,$mes,$ano,$this->user->getCompany());

            header('Location:' . BASE_URL . 'financeiro');
            exit();
        }
    }

    
}
