<?php

class ClienteController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->cliente = new Cliente();
        $this->user->setLoggedUser();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $company = new Companies($this->user->getCompany());
        $this->dataInfo = array();

        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'cliente'
        );
    }

    public function index()
    {

        if ($this->user->hasPermission('clientes_view')) {

            if (isset($_GET['filtros'])) {
                $this->filtro = $_GET['filtros'];
            }

            $this->dataInfo['tableDados'] = $this->cliente->getAll($this->filtro, $this->user->getCompany());
            $this->dataInfo['getCountCliente'] = $this->cliente->getCountCliente($this->user->getCompany());

            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else { }
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

        if (isset($_POST['cliente_nome']) && $_POST['cliente_nome'] != '') {

            $result = $this->cliente->add($this->user->getCompany(),$_POST);
            
            $this->addValicao($result);

            header('Location:' . BASE_URL . 'cliente');
            exit();
        }
    }

    public function delete($id) {

        $result = $this->cliente->delete($id,$this->user->getCompany());
    
        header("Location: ".BASE_URL."cliente");
    
        if($result){
          $this->dataInfo['success'] = 'true';
          $this->dataInfo['mensagem'] = "Exclusão feita com sucesso!!";
        }else{
          $this->dataInfo['error'] = 'true';
          $this->dataInfo['mensagem'] = "Não foi possivel excluir!";
        } 
      
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
       }
      
       return $_SESSION['form'];
      
      }
}
