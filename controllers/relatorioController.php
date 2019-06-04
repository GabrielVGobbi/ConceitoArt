<?php
class relatorioController extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user = new Users();
        $this->user->setLoggedUser();
        $this->artista = new Artista();
        $this->relatorio = new Relatorio();
        $this->tecnica = new Tecnica();
        $this->cliente = new Cliente();
        $this->vendas = new Vendas();
        $this->id_company = $this->user->getCompany();

        if ($this->user->getName() != 'marcio') {
            $this->filtro['obras'] = 1;
            $this->id_inv_situacao = 1;
        } else {
            $this->filtro['obras'] = 2;
            $this->id_inv_situacao = 2;
        }

        if ($this->user->isLogged() == false) {

            header("Location: " . BASE_URL . "login");
            exit();
        }

        $this->inventario = new Inventario();
        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'relatorios'
        );
    }

    public function index()
    {

        $this->dataInfo['artista'] = $this->artista->getAll('', $this->id_company);
        $this->dataInfo['cliente'] = $this->cliente->getAll('', $this->id_company);
        $this->dataInfo['obras'] =  $this->inventario->getAllNoOffset('0', '', $this->id_company);

        $this->dataInfo['descricao_name'] = $this->vendas->getByNameDescricao();

        $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
    }

    public function getRecibo()
    {



        if (isset($_GET) && $_GET != '') {

            $array = $_GET['obras'];
            $id_inventario = implode(",", $array);

            $this->dataInfo['dados'] =  $this->relatorio->getRecibo($id_inventario, $this->id_company);

            $this->dataInfo['nome'] = ucfirst($_GET['nome']);
            $this->dataInfo['cpf'] = $_GET['cpf'];
            $this->dataInfo['endereco'] = $_GET['endereco'];
            $this->dataInfo['quantia'] = controller::PriceSituation($_GET['quantia']);

            if(isset($_GET['cliente']) && $_GET['cliente'] != ''){
                $dados_cliente = $this->cliente->getClienteById($_GET['cliente'], $this->id_company);
                error_log(print_r($dados_cliente,1));
                $this->dataInfo['nome_r']       =  $dados_cliente[0]['cliente_nome'];
                $this->dataInfo['cpf_r']        =  $dados_cliente[0]['cliente_cpf'];
                $this->dataInfo['endereco_r']   =  $dados_cliente[0]['cliente_endereco'];
                $this->dataInfo['rg_r']         =  $dados_cliente[0]['cliente_rg'];
                
            }else {
                $this->dataInfo['nome_r']       = $_GET['nome_r'];
                $this->dataInfo['cpf_r']        = ucfirst($_GET['cpf_r']);
                $this->dataInfo['endereco_r']   = $_GET['endereco_r'];
                $this->dataInfo['rg_r']         = $_GET['rg_r'];
            }
        }

        $this->loadRelatorio('recibo', $this->dataInfo);
    }

    public function getRelatorio()
    {

        $this->dataInfo['titulo'] = '';

        if (isset($_GET['titulo']) && $_GET['titulo'] != '') {
            $this->dataInfo['titulo'] = ucfirst($_GET['titulo']);
        }

        if (isset($_GET['filtros']) && !empty($_GET['filtros'])) {
            $this->filtro = $_GET['filtros'];
        }

        $this->dataInfo['artista'] = $this->artista->getAll('', $this->user->getCompany());
        $this->dataInfo['tecnica'] = $this->tecnica->getAll('', $this->user->getCompany());
        $this->dataInfo['tableDados'] = $this->relatorio->getRelatorioByFiltro($this->filtro);
        $this->dataInfo['total'] = $this->relatorio->getTotalByFiltro($this->filtro);

        $this->loadRelatorio('relatorio', $this->dataInfo);
    }

    public function getRelatorioObras()
    {

        if (isset($_GET['filtros']) && !empty($_GET['filtros'])) {
            $this->filtro = $_GET['filtros'];

            $this->dataInfo['title'] = 'Relatorio de obras';

            if (!empty($_GET['filtros']['foto'])) {
                if ($_GET['filtros']['foto'] == 1) {
                    $this->dataInfo['foto'] = true;
                }
            } else {
                $this->dataInfo['foto'] = false;
            }
        }


        $this->dataInfo['tableDados'] = $this->relatorio->getRelatorioObra($this->filtro);
        /*
        ob_start();*/
        $this->loadRelatorio('relatorioObra', $this->dataInfo);
        /* $html = ob_get_contents();
        ob_end_clean();

        $mpdf = new mPDF();

        $mpdf->WriteHTML($html);
        $mpdf->Output();*/
    }



    public function getCertificado($id)
    {

        if (isset($_GET['filtros']) && !empty($_GET['filtros'])) {
            $this->filtro = $_GET['filtros'];
        }

        $this->dataInfo['obra'] = $this->inventario->getInventarioById($id, $this->user->getCompany());
        $this->loadRelatorio('certificado', $this->dataInfo);
    }

    public function getObraById($id)
    {


        if (isset($_GET['filtros']) && !empty($_GET['filtros'])) {
            $this->filtro = $_GET['filtros'];
        }

        $this->dataInfo['inv'] = $this->inventario->getInventarioById($id, $this->user->getCompany());


        $this->loadRelatorio('obra', $this->dataInfo);
    }


    public function gerarEtiquetaMercadolivre()
    {

        $i = new Mercadolivre();

        if (isset($_POST['check']) && !empty($_POST['check'])) {

            //$check = implode(',', $_POST['check']);

            $this->dataInfo['list_table'] = $i->getNotEtiqueta($_POST['check'], $this->user->getCompany());
            //print_r($data['list_table']);

            $this->loadXls("xls/etiquetamercadolivre", $this->dataInfo);
        }
    }

    /*public function importar(){

    $Parametros = array();

    if(!empty($_FILES['arquivo']['tmp_name'])){
        
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);
        $linhas = $arquivo->getElementsByTagName("Row");
        
        $primeira_linha = true;

        foreach($linhas as $linha){

            if($primeira_linha == false){

                $Parametros['id_artista']           = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $Parametros['id_tecnica']           = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $Parametros['titulo']               = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $Parametros['assinatura']           = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $Parametros['tamanho']              = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                $Parametros['datado']               = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                $Parametros['leilao_codigo_marcia'] = $linha->getElementsByTagName("Data")->item(6)->nodeValue;


                $this->inventario->addImport($this->user->getCompany(), $Parametros, $this->user->getId());

            }

            $primeira_linha = false;
        }
    }else {
        
        echo "erro";
    }
    
}*/

    public function importar()
    {

        ##Leilão Marcia##

        $Parametros = array();

        if (!empty($_FILES['arquivo']['tmp_name'])) {

            $arquivo = new DomDocument();
            $arquivo->load($_FILES['arquivo']['tmp_name']);
            $linhas = $arquivo->getElementsByTagName("Row");

            $primeira_linha = true;

            foreach ($linhas as $linha) {

                if ($primeira_linha == false) {

                    $Parametros['id_artista']           = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                    $Parametros['id_tecnica']           = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                    $Parametros['titulo']               = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                    $Parametros['assinatura']           = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                    $Parametros['tamanho']              = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                    $Parametros['datado']               = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                    $Parametros['leilao_codigo_marcia'] = $linha->getElementsByTagName("Data")->item(6)->nodeValue;


                    $this->inventario->addImport($this->user->getCompany(), $Parametros, $this->user->getId(), $this->id_inv_situacao);
                }

                $primeira_linha = false;
            }
        }
    }
}
