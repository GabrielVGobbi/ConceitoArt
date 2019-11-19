<?php
class ajaxController extends controller
{

    public function __construct()
    {


        $u = new Users();
        if ($u->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

    }

    public function index()
    { }

    public function search_artista()
    {
        $data = array();
        $u = new Users();
        $a = new Artista();
        $u->setLoggedUser();



        if (isset($_GET['q']) && !empty($_GET['q'])) {


            $q = addslashes($_GET['q']);

            $artista = $a->searchArtistaByName($q, $u->getCompany());

            foreach ($artista as $citem) {
                $data[] = array(
                    'name' => $citem['art_nome'],
                    'id'   => $citem['id_artista']
                );
            }
        }

        echo json_encode($data);
    }

    public function add_artista()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Artista();
        $Parametros = array();

        if (isset($_POST['name']) && !empty($_POST['name'])) {

            $Parametros['artista'] = addslashes($_POST['name']);

            $data['id'] = $a->add($u->getCompany(), $Parametros);
        }

        echo json_encode($data);
    }

    public function search_tecnica()
    {
        $data = array();
        $u = new Users();
        $a = new Tecnica();
        $u->setLoggedUser();



        if (isset($_GET['tecnica']) && !empty($_GET['tecnica'])) {


            $t = addslashes($_GET['tecnica']);

            $tecnica = $a->searchTecnicaByName($t, $u->getCompany());

            foreach ($tecnica as $citem) {
                $data[] = array(
                    'nameTecnica' => ucfirst($citem['nome_tecnica']),
                    'idTecnica'   => $citem['id_tecnica']
                );
            }
        }

        echo json_encode($data);
    }

    public function add_tecnica()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Tecnica();
        $Parametros = array();



        if (isset($_POST['name']) && !empty($_POST['name'])) {

            $validacao = $a->getName($u->getCompany(), $_POST['name']);

            if ($validacao) {
                return false;
            } else {
                $Parametros['tecnica'] = addslashes($_POST['name']);

                $data['id'] = $a->add($u->getCompany(), $Parametros);
            }
        }

        echo json_encode($data);
    }
    
    public function getObras()
    {

        $data = array();
        $u = new Users();
        $e = new Inventario();
        $u->setLoggedUser();

        $requestData = $_REQUEST;
        
        $obras = $e->getAll($offset = 0, $requestData, 1);
        $total  = $e->getCountInventario('', '1', $requestData);
    
        
        $dados = array();
        foreach ($obras as $obr) {

            $row = array();
            $row[] = " ";
            $row[] = $obr["art_nome"];
            $row[] = $obr["inv_descricao"];
            $row[] = $obr["inv_descricao"];


            $dados[] = $row;

        }
  

        if(isset($requestData['search']['value']) && !empty($requestData['search']['value']) && count($obras) > 0 ){
            $total = $obras['rowCount']; 
        }

        if(count($obras) == 0 ){
            $total = 0;
        }


        $json_data = array(
            "draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval($total),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval($total), //Total de registros quando houver pesquisa
            "data" => $dados   //Array de dados completo dos dados retornados da tabela 
        );


        echo json_encode($json_data);
    }

    public function getInventarioById($id){
        $u = new Users();
        $u->setLoggedUser();
        $a = new Inventario();
       
        $json_data = array();
       
        if(!empty($id)){
            $json_data = $a->getInventarioById($id, $u->getCompany());
        }
        
        echo json_encode($json_data);

    }
}
