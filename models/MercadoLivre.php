<?php 
Class Mercadolivre extends model {


    private $companyInfo;

    public function loginMl() {

        $loginMl = $this->SessionUser();
        $category_id = '';

        foreach ($loginMl as $MlSession) {
            $this->array['mercadolivre']['access_token']        = $MlSession['access_token'];
            $this->array['mercadolivre']['expires_in']          = $MlSession['expires_in'];
            $this->array['mercadolivre']['refresh_token']       = $MlSession['refresh_token'];
        }

    
        // We can check if the access token in invalid checking the time
        if($this->array['mercadolivre']['expires_in'] + time() + 1 < time()) {
            try {
                print_r($meli->refreshAccessToken());
            } catch (Exception $e) {
                echo "Exception: ",  $e->getMessage(), "\n";
            }
        }
        
        return $this->array;
    }

    public function getAllVendas(){

        $login = $this->loginML();
        $id_saller = 189261743;
        $access_token = $login['mercadolivre']['access_token'];


        $json = json_decode(file_get_contents('https://api.mercadolibre.com/orders/search/recent?seller=189261743&access_token=APP_USR-4525547766629735-050617-0842100073ce71453cd4b781549ac812-189261743'), true);

        error_log(print_r($json,1));



    }

    public function addMercadoLivre($Parametros,$id_product){

        $this->loginMl();

        $meli = new Meli(appId, secretKey);
        
        $artista     = '';
        $titulo      = '';
        $tecnica     = '';
        $medida      = '';
        $tiragem     = '';
        $assinatura  = '';
        $datado      = '';

        if($Parametros['artista'] != '')
        {
            $artista     = 'Artista: '.$Parametros['art_nome'];
            $titulo      = 'Titulo: '.$Parametros['titulo'];
            $tecnica     = 'Técnica: '.$Parametros['tecnica'];
            $medida      = 'Medida: '.$Parametros['tamanho'];
            $assinatura  = 'Assinatura: '.$Parametros['inv_assinatura'];

            if($Parametros['tiragem'] != ''){

                if($Parametros)
                    $tiragem     = ' - '.$Parametros['tiragem'];
            }

            if($Parametros['datado'] != ''){
                $datado      = 'Datado: '.$Parametros['datado'];
            }
        }


        if($Parametros['datado'] != ''){
            
            $assinDatada = 'Ass/Dat '.$Parametros['datado'].' - '.$Parametros['tamanho'].'cm';

            if(strlen($Parametros['titulo']) > 10){
                $assinDatada = 'Ass/Dat '.$Parametros['datado'].' - '.$Parametros['tamanho'];
            }
            
        }else {
            $assinDatada = 'Ass - '.$Parametros['tamanho'].'cm';
        }

        $title = $Parametros['artista'].'-'.'"'.$Parametros['titulo'].'" - '. $assinDatada;

        if(isset($Parametros['tecnica'])){
            $category_id = $this->getCategoryMl($Parametros['tecnica']);
        }

        $artista_name = $Parametros['artista'];
        $artista = str_replace(' ','_',$artista_name);

        $photo = BASE_URL.'assets/images/anuncios/'.$artista.'/'.$id_product.'.jpg';

        $item = array(
            "title" => $title,
            "category_id" => $category_id,
            "price" => $Parametros['price_venda'],
            "currency_id" => "BRL",
            "available_quantity" => 1,
            "buying_mode" => "buy_it_now",
            "listing_type_id" => "bronze",
            "condition" => "new",
            "description" => array(
                "plain_text" => 
                "
                $title \n
                $artista_name 
                $titulo $tiragem
                $tecnica
                $medida cm
                $assinatura
                $datado \n 

            Conceito Art 15 anos no mercado de artes- Pituras, Gravuras e Esculturas. 
                Garantimos a autenticidade e boa Procedência de nossas obras. \n
                TODAS AS OBRAS SÃO ASSINADA PELO ARTISTA.\n
                Peça um certificado de Autenticidade. \n

                Palavras chaves: $artista, $titulo, $tecnica"

            ),

            "video_id" => "",
            "warranty" => "",
            "pictures" => array(
                array(
                    "source" => BASE_URL.'assets/images/anuncios/'.$artista.'/'.$id_product.'.jpg'
                )
            )
        );

        $meli = $meli->post('/items', $item, array('access_token' => $this->array['mercadolivre']['access_token']));

        if($meli['httpCode'] == 201){

            return true;

        }else if($meli['httpCode'] == 400 || $meli['httpCode'] == 401){
            error_log(print_r($meli,1));

            return false;

        }

    }

    public function addMercadoLivreById($Parametros){

        $Parametros = $Parametros[0];

        $meli = new Meli(appId, secretKey);
        
        $category_id = '';

        $this->inventario = new Inventario;

        $this->loginMl();
        
        $artista     = '';
        $titulo      = '';
        $tecnica     = '';
        $medida      = '';
        $tiragem     = '';
        $assinatura  = '';
        $datado      = '';

        if($Parametros['art_nome'] != '')
        {
            $artista     = 'Artista: '.$Parametros['art_nome'];
            $titulo      = 'Titulo: '.$Parametros['inv_descricao'];
            $tecnica     = 'Técnica: '.$Parametros['nome_tecnica'];
            $medida      = 'Medida: '.$Parametros['inv_tamanho'];
            $assinatura  = 'Assinatura: '.$Parametros['inv_assinatura'];

            if($Parametros['inv_tiragem'] != ''){

                if($Parametros)
                    $tiragem     = ' - '.$Parametros['inv_tiragem'];
            }

            if($Parametros['inv_data'] != ''){
                $datado      = 'Datado: '.$Parametros['inv_data'];
            }
        }


        if($Parametros['inv_data'] != ''){
            
            $assinDatada = 'Ass/Dat '.$Parametros['inv_data'].' - '.$Parametros['inv_tamanho'].'cm';

            if(strlen($Parametros['inv_descricao']) > 10){
                if(strlen($Parametros['art_nome'] > 14)){
                    $assinDatada = 'Ass/Dat - '.$Parametros['inv_tamanho'];
                }else {
                    $assinDatada = 'Ass/Dat '.$Parametros['inv_data'].' - '.$Parametros['inv_tamanho'];
                }
            }
            
        }else {
            if(strlen($Parametros['inv_descricao']) > 10){
                $assinDatada = 'Ass - '.$Parametros['inv_tamanho'];
            }else {
                $assinDatada = 'Ass - '.$Parametros['inv_tamanho'].'cm';
            }
            
        }

        $title = $Parametros['art_nome'].' - '.'"'.$Parametros['inv_descricao'].'" - '. $assinDatada;

        if(isset($Parametros['nome_tecnica'])){
            $category_id = $this->getCategoryMl($Parametros['nome_tecnica']);       
        }

        $artista_name = $Parametros['art_nome'];
        $artista = str_replace(' ','_',$artista_name);

        if(file_exists('assets/images/anuncios/'.$artista.'/'.$Parametros['id_inventario'].'.jpg')){
            $photo = BASE_URL.'assets/images/anuncios/'.$artista.'/'.$Parametros['id_inventario'].'.jpg';

        }else {
            $img = $this->inventario->getImagesByProductId($Parametros['id_inventario']);
            
            if(isset($img['url']) && $img['url'] != ''){
                $photo = BASE_URL.'assets/images/anuncios/'.$artista.'/'.$img['url'];
                
            }

        }

        $item = array(
            "title" => $title,
            "category_id" => $category_id,
            "price" => $Parametros['inv_price_venda'],
            "currency_id" => "BRL",
            "available_quantity" => 1,
            "buying_mode" => "buy_it_now",
            "listing_type_id" => "bronze",
            "condition" => "new",
            "description" => array(
                "plain_text" => 
                "
                $title \n
                $artista_name 
                $titulo $tiragem
                $tecnica
                $medida cm
                $assinatura
                $datado \n 

                º Conceito Art 15 anos no mercado de artes: Pituras, Gravuras e Esculturas.
                º Garantimos a autenticidade e boa Procedência de nossas obras.
                º TODAS AS OBRAS SÃO ASSINADA PELO ARTISTA.
                º Peça um certificado de Autenticidade.
                
                Palavras chaves: $artista, $titulo, $tecnica"

            ),

            "video_id" => "",
            "warranty" => "",
            "pictures" => array(
                array(
                    "source" => BASE_URL.'assets/images/anuncios/'.$artista.'/'.$Parametros['id_inventario'].'.jpg'
                )
            )
        );

        $meli = $meli->post('/items', $item, array('access_token' => $this->array['mercadolivre']['access_token']));


        if($meli['httpCode'] == 201){

            $retorno = true;

        }else if($meli['httpCode'] == 400 || $meli['httpCode'] == 401){
            error_log(print_r($meli,1));

            $retorno = false;

        }

        if($retorno){

            $situacao = array();
            $situacao['preco_situacao']     = $Parametros['inv_price_venda'];
            $situacao['descricao_situacao'] = 'Mercado livre';
            $situacao['data_situacao'] = '05/2019';
            $situacao['situacao_char'] = 0;

            $this->setSituacao($Parametros['id_inventario'], $Parametros['id_company'],$situacao);
            $this->updateSitMercadolivre($Parametros['id_inventario']);
            $this->retorno['mercadolivre_add']['mensagem']['sucess'] = 'cadastro mercado livre efetuado com sucesso';

        }else {
            $this->retorno['mercadolivre_add']['mensagem']['error'] = 'erro ao cadastrar no mercadolivre';
        }


        return $this->retorno;

    }

    public function setSituacao($id_product, $id_company,$situacao) {


        $sql = $this->db->prepare("INSERT INTO situacao_obra SET 

            id_company             = :id_company, 
            id_inventario          = :id_product, 
            preco_situacao         = :preco_situacao,
            descricao_situacao     = :descricao_situacao,
            data_situacao          = :data_situacao,
            situacao_char          = :situacao_char

            ");

        $sql->bindValue(":id_company",          $id_company);
        $sql->bindValue(":id_product",          $id_product);
        $sql->bindValue(":preco_situacao",      $situacao['preco_situacao']);
        $sql->bindValue(":descricao_situacao",  $situacao['descricao_situacao']);
        $sql->bindValue(":data_situacao",       $situacao['data_situacao']);
        $sql->bindValue(":situacao_char",       $situacao['situacao_char']);

        $sql->execute();

    }

    public function updateSitMercadolivre($id_product) {

        $id_inv_situacao = '1';

        $sql = $this->db->prepare("UPDATE inventario SET 

            id_inv_situacao = :id_inv_situacao

            WHERE id_inventario = :id_product

            ");

        $sql->bindValue(":id_product",          $id_product);
        $sql->bindValue(":id_inv_situacao",     $id_inv_situacao);

        $sql->execute();
    }


    private function SessionUser() {

        $sql = $this->db->prepare("SELECT * FROM mercadolivre");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $this->array = $sql->fetchAll();
        }

        return $this->array;

    }

    private function getCategoryMl($Parametros) {

        $Parametros = ucfirst($Parametros);

        switch ($Parametros) {
            case 'Serigrafia':
            $category = Serigrafia;
            break;
            case 'Xilogravura':
            $category = Xilogravura;
            break;
            case 'Gravura em metal':
            $category = Gravuraemmetal;
            break;
            case 'Litografia':
            $category = Litogravura;
            break;
            case 'Off Set':
            $category = OffSet;
            break;
            default:
                $category = Outros;
            break;
        }

        $category_id = $category;

        return $category_id;

    }


    public function getNotEtiqueta($check, $id_company){
        $const = 'constant';

        $sql = $this->db->prepare("
            SELECT * FROM inventario inv
            INNER JOIN artista art ON inv.id_artista = art.id_artista
            INNER JOIN tecnica tec ON inv.id_tecnica = tec.id_tecnica
            WHERE /*inv.id_inv_sts_id = {$const('MERCADOLIVRE')} AND*/ inv.id_inventario IN ($check)
            ORDER BY inv.id_inventario, art.art_nome");

        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;

    }


}