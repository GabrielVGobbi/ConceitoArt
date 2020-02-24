<?php

class FotosController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->fotos = new Fotos();
        $this->inventario = new Inventario();
        $this->user->setLoggedUser();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $company = new Companies($this->user->getCompany());
        $this->dataInfo = array();

        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'fotos'
        );
    }

    public function index()
    {

       

            if (isset($_GET['filtros'])) {
                $this->filtro = $_GET['filtros'];
                
            }

            $this->dataInfo['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $this->dataInfo['p'] = intval($_GET['p']);
                if ($this->dataInfo['p'] == 0) {
                    $this->dataInfo['p'] = 1;
                }
            }

            $offset = (10 * ($this->dataInfo['p'] - 1));

            $this->dataInfo['foto_count']       = $this->fotos->getCount($this->user->getCompany(), $this->filtro);
            $this->dataInfo['p_count']          = ceil($this->dataInfo['foto_count'] / 10);

            $this->dataInfo['tableDados']       = $this->fotos->getAll($offset, $this->filtro, $this->user->getCompany());
            $this->dataInfo['inventario']       = $this->inventario->getAllNoOffset(0, '', $this->user->getCompany());

            $this->dataInfo['getCountFotos']    = $this->fotos->getCount('',$this->user->getCompany());


            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        
    }


    public function add()
    {

        if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {

            $this->dataInfo['errorForm'] = $_SESSION['formError'];
            unset($_SESSION['formError']);
        }
    }

    public function delete($id)
    {

        $result = $this->fotos->delete($id, $this->user->getCompany());

        controller::alert('success', 'erro');

        header("Location: " . BASE_URL . "inventario");
    }

}
