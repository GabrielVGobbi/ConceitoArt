<?php

class NotasController extends controller
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


        $this->notas  = new Notas;
        $this->clientes  = new Cliente;
        $this->leilao  = new Leilao;

        $this->dataInfo['errorForm'] = array();
        $this->dataInfo = array(
            'pageController' => 'notas',

        );
    }

    public function index()
    {

        if ($this->user->hasPermission('notas_view')) {

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

            $this->dataInfo['tableDados']   = $this->notas->getAll($this->offset, $this->dataInfo['filtro'], $this->user->getCompany());
            $this->dataInfo['notas_count'] = $this->notas->getCountNotas($this->user->getCompany(), $this->dataInfo['filtro']);


            $this->dataInfo['cliente']      = $this->clientes->getAll('', $this->user->getCompany());
            $this->dataInfo['leilao']      = $this->leilao->getAll('', $this->user->getCompany());


            $this->dataInfo['p_count']      = ceil($this->dataInfo['notas_count'] / 10);

            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else {

            echo "not permission";
        }
    }

    public function GerarNota($id)
    {

        if ($this->user->hasPermission('notas_view')) {

            $this->dataInfo['tableDados']   = $this->notas->getNotaById($id, $this->user->getCompany());


            $this->loadViewInTemplate($this->dataInfo['pageController'] . "/gerarNota", $this->dataInfo);
        } else {

            echo "not permission";
        }
    }

    public function notasLeilao()
    {

        if ($this->user->hasPermission('notas_view')) {


            $this->dataInfo['tableDados']   = $this->notas->getNotaPeriodo($_POST, $this->user->getCompany());

            if (count($this->dataInfo['tableDados']) > 0) {
                $this->loadViewInTemplate($this->dataInfo['pageController'] . "/gerarNotaLeilao", $this->dataInfo);
            } else {

                header("Location: " . BASE_URL . $this->dataInfo['pageController']);
                controller::alert('warning', 'não existe notas para esse periodo');
                exit();
            }
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

        if (isset($_POST['cliente']) && $_POST['cliente'] != '') {

            $result = $this->notas->add($_POST, $this->user->getCompany());

            $this->addValicao($result);

            header('Location:' . BASE_URL . 'notas');
            exit();
        }
    }

    public function addValicao($result)
    {

        if (isset($result['nota_add']['mensagem']['sucess'])) {
            $_SESSION['form']['success'] = 'Success';
            $_SESSION['form']['type'] = 'success';
            $_SESSION['form']['mensagem'] = "Cadastro da Nota Efetuado com sucesso!!";
        } elseif (isset($result['nota_add']['mensagem']['error'])) {
            $_SESSION['form']['success'] = 'Oops!!';
            $_SESSION['form']['type'] = 'error';
            $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro, Contate o administrador do sistema";
        } elseif (isset($result['objeto_add']['mensagem']['error']) && isset($result['objeto_add']['mensagem']['sucess'])) {
            $_SESSION['form']['success'] = 'Oops!!';
            $_SESSION['form']['type'] = 'error';
            $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro dos objetos, Contate o administrador do sistema";
        } elseif (isset($result['objeto_add']['mensagem']['error']) && isset($result['objeto_add']['mensagem']['error'])) {
            $_SESSION['form']['success'] = 'Oops!!';
            $_SESSION['form']['type'] = 'error';
            $_SESSION['form']['mensagem'] = "Não foi possivel fazer o cadastro, Contate o administrador do sistema";
        }

        return $_SESSION['form'];
    }
}
