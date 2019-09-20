<?php
class ajaxController extends controller {

    public function __construct() {

     
        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }

    public function index(){}

    public function search_artista() {
        $data = array();
        $u = new Users();
        $a = new Artista();
        $u->setLoggedUser();



        if(isset($_GET['q']) && !empty($_GET['q'])) {

         
            $q = addslashes($_GET['q']);

            $artista = $a->searchArtistaByName($q, $u->getCompany());
            
            foreach($artista as $citem) {
                $data[] = array(
                    'name' => $citem['art_nome'],
                    'id'   => $citem['id_artista']
                );
            }

            
        }

        echo json_encode($data);
    }

    public function add_artista() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Artista();
        $Parametros = array();

        if(isset($_POST['name']) && !empty($_POST['name'])) {

            error_log(print_r($_POST,1));
            $Parametros['artista'] = addslashes($_POST['name']);

            $data['id'] = $a->add($u->getCompany(), $Parametros);
            
        }

        echo json_encode($data);
    }

    public function search_tecnica() {
       $data = array();
       $u = new Users();
       $a = new Tecnica();
       $u->setLoggedUser();



       if(isset($_GET['tecnica']) && !empty($_GET['tecnica'])) {

         
        $t = addslashes($_GET['tecnica']);

        $tecnica = $a->searchTecnicaByName($t, $u->getCompany());
        
        foreach($tecnica as $citem) {
            $data[] = array(
                'nameTecnica' => ucfirst($citem['nome_tecnica']),
                'idTecnica'   => $citem['id_tecnica']
            );
        }

        
    }

    echo json_encode($data);
}

public function add_tecnica() {
    $data = array();
    $u = new Users();
    $u->setLoggedUser();
    $a = new Tecnica();
    $Parametros = array();



    if(isset($_POST['name']) && !empty($_POST['name'])) {

        $validacao = $a->getName($u->getCompany(),$_POST['name']);

        if($validacao){
            return false;
            
        }else {
            $Parametros['tecnica'] = addslashes($_POST['name']);

            $data['id'] = $a->add($u->getCompany(), $Parametros); 
        }
    }

    echo json_encode($data);
}

    public function getPosto(){

          $a = new Tecnica();
        $array = array(
            
           
                
                'gasolina' => '50%',
                'id' => '1',
                
               
            
        );

        header("Content-Type: application/json");
        echo json_encode($array);
    }
}
