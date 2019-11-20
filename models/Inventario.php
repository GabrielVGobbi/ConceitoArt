<?php



class Inventario extends model
{
  use Pagination;
  

  private $InvetarioInfo;
  
  var $table = 'inventario';


  

  public function __construct()
  {
    parent::__construct();

    $this->artista = new Artista();
    $this->array = array();
    $this->retorno = array();
  }

  public function getCountInventario($id_inv_situacao, $id)
  {

    $r = 0;

    $sql = "SELECT COUNT(*) AS c FROM inventario inv 
            INNER JOIN artista art ON (inv.id_artista = art.id_artista)
            INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)    
          ";

    $sql = $this->db->prepare($sql);
    $sql->execute();

    $row = $sql->fetch();
    $r = $row['c'];

    return $r;
  }

  public function getAll($offset, $filtro, $id)
  {

    $where = $this->buildWhere($filtro, $id);

    $sql = "
    SELECT inv.*, art.art_nome, tec.nome_tecnica
    
            FROM  inventario inv
           
            INNER JOIN artista art ON (inv.id_artista = art.id_artista)
            INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

        
        WHERE " . implode(' AND ', $where) . " GROUP BY inv.id_inventario ORDER BY inv.id_inventario  DESC LIMIT $offset, 10";
    $sql = $this->db->prepare($sql);

    $this->bindWhere($filtro, $sql);




    $sql->execute();

    if ($sql->rowCount() > 0) {
        $this->array = $sql->fetchAll();

       
        
    }

    return $this->array;
  }

  public function getID($offset, $filtro, $id)
  {



    $where = $this->buildWhere($filtro, $id);

    $sql = "
        SELECT inv.id_inventario 
        FROM  procedencia proc
        RIGHT JOIN inventario inv ON (inv.id_inventario = proc.id_inventario)
        INNER JOIN artista art ON (inv.id_artista = art.id_artista)
        INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

        
        WHERE " . implode(' AND ', $where) . " GROUP BY inv.id_inventario ORDER BY inv.id_inventario  DESC LIMIT $offset, 10";
    $sql = $this->db->prepare($sql);

    $this->bindWhere($filtro, $sql);

    $sql->execute();

    if ($sql->rowCount() > 0) {
        $this->array = $sql->fetchAll();    
    }

    return $this->array;
  }

  public function getAllNoOffset($offset, $filtro, $id)
  {



    $where = $this->buildWhere($filtro, $id);

    $sql = "
        SELECT *  FROM inventario inv 
        INNER JOIN artista art ON (inv.id_artista = art.id_artista)
        INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)
        INNER JOIN inventario_image img ON (inv.id_inventario = img.id_inventario)

        
        WHERE " . implode(' AND ', $where);


    $sql = $this->db->prepare($sql);

    $this->bindWhere($filtro, $sql);



    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetchAll();
    }


    return $this->array;
  }

  private function buildWhere($filtro, $id)
  {

    $where = array(
      'inv.id_company=' . $id
    );


    if (!empty($filtro['id_inventario'])) {
      $where[] = "inv.id_inventario = :id_inventario";
    }

    if (!empty($filtro['id_inv_situacao'])) {
      $where[] = "inv.id_inv_situacao = :id_inv_situacao";
    }


    if (!empty($filtro['artista'])) {

      if ($filtro['artista'] != '') {

        $where[] = "art.art_nome LIKE :art_nome";
      }
    }

    if (!empty($filtro['titulo'])) {

      if ($filtro['titulo'] != '') {

        $where[] = "(inv_descricao LIKE :inv_descricao) OR (inv_tiragem LIKE :inv_descricao) OR (tec.nome_tecnica LIKE :inv_descricao)";
      }
    }

    if (!empty($filtro['procedencia'])) {

      if ($filtro['procedencia'] != '') {

        $where[] = "proc.descricao LIKE :procedencia";
      }
    }

    if (!empty($filtro['venda'])) {

      if ($filtro['venda'] != '') {

        $where[] = "inv.inv_venda = :venda";
      }
    }

    return $where;
  }

  private function Filds($filtro){

    $placesValues = array();

    if (!empty($filtro['id_inventario'])) {
      $placesValues += (["id_inventario" => $filtro['id_inventario']]);
    }

    if (!empty($filtro['artista'])) {
      $placesValues += (["art_nome" => $filtro['artista']]);
    }

    if (!empty($filtro['titulo'])) {
      $placesValues += (["inv_descricao" => $filtro['titulo']]);
    }

    if (!empty($filtro['procedencia'])) {
      $placesValues += (["procedencia" => $filtro['procedencia']]);
    }

    if (!empty($filtro['venda'])) {
      $placesValues += (["venda" => $filtro['venda']]);
    }

    $this->bindValues($placesValues);

  }

  public function add($id_company, $id_user, $Parametros, $photo)
  {
    $action = 'CADASTRO';
    $id_inv_situacao = '2';

    $compra = array();
    $situacao = array();

    $visivel = isset($Parametros['visivel']) ? $Parametros['visivel'] : '1';
    $etiqueta = isset($Parametros['etiqueta']) ? $Parametros['etiqueta'] : '1';


    $titulo                     = controller::ReturnValor($Parametros['titulo']);
    $assinatura                 = controller::ReturnValor($Parametros['assinatura']);

    $id_artista                                       = ($Parametros['id_artista']);
    $id_tecnica                                       = ($Parametros['id_tecnica']);
    $tamanho                                          = ($Parametros['tamanho']);
    $datado                                           =  controller::ReturnValor($Parametros['datado']);
    $tiragem                                          =  controller::ReturnValor($Parametros['tiragem']);
    $observacao                                       =  controller::ReturnValor($Parametros['observacao']);
    $localizacao                                      =  controller::ReturnValor($Parametros['localizacao']);

    $compra['procedencia']                            =  controller::ReturnValor($Parametros['procedencia']);
    $compra['data_procedencia']                       = ($Parametros['data_procedencia']);
    $compra['preco_procedencia']                      =  controller::PriceSituation($Parametros['preco_procedencia']);

    $situacao['descricao_situacao']                   =  controller::ReturnValor($Parametros['descricao_situacao']);
    $situacao['data_situacao']                        = ($Parametros['data_situacao']);
    $situacao['preco_situacao']                       =  controller::PriceSituation($Parametros['preco_situacao']);
    $situacao['situacao_char']                        = ($Parametros['situacao_char']);
    $situacao['retirada']                             =  isset($Parametros['retirada']) ? strtoupper($Parametros['retirada']) : '';
    $situacao['localizacao']                          = ($Parametros['localizacao']);
    $situacao['leilao_codigo']                        =  controller::ReturnFormatLimpo($Parametros['leilao_codigo']);


    try {

      $sql = $this->db->prepare("INSERT INTO inventario SET
                id_company          = :id_company, 
                id_tecnica          = :id_tecnica,
                id_artista          = :id_artista, 
                inv_descricao       = :titulo,
                inv_assinatura      = :assinatura,
                inv_tamanho         = :tamanho,
                inv_tiragem         = :tiragem,
                inv_data            = :datado,
                inv_visivel         = :visivel,
                inv_etiqueta        = :etiqueta,
                id_inv_situacao     = :id_inv,
                inv_observacao      = :observacao,
                inv_venda           = :situacao_venda,
                inv_localizacao     = :localizacao

                ");

      $sql->bindValue(':id_company',   $id_company);
      $sql->bindValue(':id_artista',   $id_artista);
      $sql->bindValue(':id_tecnica',   $id_tecnica);

      $sql->bindValue(':titulo',       $titulo);
      $sql->bindValue(':assinatura',   $assinatura);
      $sql->bindValue(':tamanho',      $tamanho);
      $sql->bindValue(':tiragem',      $tiragem);
      $sql->bindValue(':datado',       $datado);
      $sql->bindValue(':id_inv',       $id_inv_situacao);
      $sql->bindValue(':observacao',   $observacao);
      $sql->bindValue(':localizacao',   $localizacao);
      $sql->bindValue(':situacao_venda',   $situacao['situacao_char']);

      $sql->bindValue(':visivel',      $visivel);
      $sql->bindValue(':etiqueta',     $etiqueta);


      if ($sql->execute()) {
        $this->retorno['inventario_add']['mensagem']['sucess'] = 'sucesso';
      } else {
        $this->retorno['inventario_add']['mensagem']['error'] = 'erro ao cadastrar';
      }

      $id_product = $this->db->lastInsertId();

      $this->setLog($id_product, $id_company, $id_user, $action, '', $Parametros);

      if (isset($compra['procedencia']) && $compra['procedencia'] != '') {
        $this->setProcedencia($id_product, $id_company, $id_user, $compra);
      }

      if (isset($situacao['descricao_situacao']) && $situacao['descricao_situacao']     != '') {
        $this->setSituacao($id_product, $id_company, $id_user, $situacao);
      }

      if (isset($photo) && $photo != '') {

        $this->addPhoto($id_product, $Parametros, $photo, $id_company);
      }
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }

    return $this->retorno;
  }

  public function edit($id_company, $id_user, $Parametros, $photo, $id)
  {
    if (isset($Parametros['id_artista']) && $Parametros['id_artista'] != '') {
      $id_artista = $Parametros['id_artista'];
    }

    $compra = array();
    $situacao = array();
    $action = 'EDIÇÃO';

    $id_tecnica                                       = ($Parametros['id_tecnica']);
    $titulo                                           =  controller::ReturnValor($Parametros['titulo']);
    $assinatura                                       =  controller::ReturnValor($Parametros['assinatura']);
    $tamanho                                          =  controller::ReturnValor($Parametros['tamanho']);
    $datado                                           =  controller::ReturnValor($Parametros['datado']);
    $tiragem                                          = ($Parametros['tiragem']);
    $observacao                                       =  controller::ReturnValor($Parametros['observacao']);
    $price_venda = isset($Parametros['preco']) ? controller::PriceSituation($Parametros['preco']) : '';
    $localizacao = isset($Parametros['localizacao']) ? $Parametros['localizacao'] : '';

    //PROCEDENCIA DA OBRA
    $compra['procedencia']                            =  controller::ReturnValor($Parametros['procedencia']);
    $compra['data_procedencia']                       = ($Parametros['data_procedencia']);
    $compra['preco_procedencia']                      =  controller::PriceSituation($Parametros['preco_procedencia']);

    //SITUACAO DA OBRA
    $situacao['descricao_situacao']                   =  controller::ReturnValor($Parametros['descricao_situacao']);
    $situacao['data_situacao']                        = ($Parametros['data_situacao']);
    $situacao['preco_situacao']                       =  controller::PriceSituation($Parametros['preco_situacao']);
    $situacao['preco_bruto']                       =  controller::PriceSituation($Parametros['preco_bruto']);

    $situacao['situacao_char']                        = ($Parametros['situacao_char']);
    $situacao['retirada']                             = isset($Parametros['retirada']) ? strtoupper($Parametros['retirada']) : '';
    $situacao['leilao_codigo']                        =  controller::ReturnFormatLimpo($Parametros['leilao_codigo']);


    //SITUACAO DA OBRA (EDIÇÃO)
    if (!empty($Parametros['edit_situacao'])) {

      $situacaoEdit['edit_situacao']                        =  controller::ReturnValor($Parametros['edit_situacao']);
      $situacaoEdit['edit_data_situacao']                   = ($Parametros['edit_data_situacao']);
      $situacaoEdit['codigo']                   = ($Parametros['codigo']);

      $situacaoEdit['edit_preco_situacao'] = !empty($Parametros['edit_preco_situacao']) ? controller::PriceSituation($Parametros['edit_preco_situacao']) : '';
      $situacaoEdit['edit_preco_bruto'] = !empty($Parametros['edit_preco_bruto']) ? controller::PriceSituation($Parametros['edit_preco_bruto']) : '';

      $situacaoEdit['edit_venda_situacao']                  = ($Parametros['edit_venda_situacao']);
      $situacaoEdit['id_situacao']                          = ($Parametros['id_situacao']);
      $situacaoEdit['edit_retirada']                        = strtoupper($Parametros['edit_retirada']);
    }

    try {

      $sql = $this->db->prepare("UPDATE inventario SET
                
                id_company          = :id_company, 
                id_tecnica          = :id_tecnica, 
                inv_descricao       = :titulo,
                inv_assinatura      = :assinatura,
                inv_tamanho         = :tamanho,
                inv_tiragem         = :tiragem,
                inv_data            = :datado,
                inv_observacao      = :observacao,
                inv_venda           = :situacao_venda,
                inv_localizacao     = :localizacao,
                inv_price_venda     = :price_venda
                
                WHERE id_inventario = :id;  

            ");

      $sql->bindValue(':id_company',   $id_company);

      $sql->bindValue(':id',           $id);
      $sql->bindValue(':id_tecnica',   $id_tecnica);
      $sql->bindValue(':titulo',       $titulo);
      $sql->bindValue(':assinatura',   $assinatura);
      $sql->bindValue(':tamanho',      $tamanho);
      $sql->bindValue(':tiragem',      $tiragem);
      $sql->bindValue(':datado',       $datado);
      $sql->bindValue(':observacao',   $observacao);
      $sql->bindValue(':localizacao',   $localizacao);
      $sql->bindValue(':price_venda',   $price_venda);

      $sql->bindValue(':situacao_venda',   $situacao['situacao_char']);

      if ($sql->execute()) {
        $this->retorno['inventario_add']['mensagem']['sucess'] = 'sucesso';
      } else {
        $this->retorno['inventario_add']['mensagem']['error'] = 'erro ao cadastrar';
      }

      $this->setLog($id, $id_company, $id_user, $action, $compra['preco_procedencia'], $Parametros);

      if (isset($compra['procedencia']) && $compra['procedencia'] != '') {
        $this->setEditarProcedencia($id, $id_company, $id_user, $compra);
      }

      if (isset($situacaoEdit['edit_situacao']) && $situacaoEdit['edit_data_situacao']  != '') {
        $this->setEditarSituacao($id, $id_company, $id_user, $situacaoEdit);
      }

      if (isset($situacao['descricao_situacao']) && $situacao['descricao_situacao']     != '') {
        $this->setSituacao($id, $id_company, $id_user, $situacao);
      }

      if (isset($photo) && $photo != null) {
        $this->addPhoto($id, $Parametros, $photo, $id_company);
      }

      /* if(isset($situacao['descricao_situacao']) && $situacao['descricao_situacao'] == 'Mercado livre'){
                if(isset($situacao['preco_situacao']) && $situacao['preco_situacao'] != ''){
                    $this->updatePriceMercadolivre($id, $Parametros);
                }
            }*/
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }

    return $this->retorno;
  }

  public function setProcedencia($id_product, $id_company, $id_user, $compra)
  {

    $sql = $this->db->prepare("INSERT INTO procedencia SET 

            id_company             = :id_company, 
            id_inventario          = :id_product, 
            id_user                = :id_user, 
            inventario_preco       = :inventario_preco,
            descricao              = :descricao_compra,
            data                   = :data_compra

            ");

    $sql->bindValue(":id_company",          $id_company);
    $sql->bindValue(":id_product",          $id_product);
    $sql->bindValue(":id_user",             $id_user);
    $sql->bindValue(":inventario_preco",    $compra['preco_procedencia']);
    $sql->bindValue(":descricao_compra",    trim($compra['procedencia']));
    $sql->bindValue(":data_compra",         $compra['data_procedencia']);

    $sql->execute();
  }

  public function setSituacao($id_product, $id_company, $id_user, $situacao)
  {

    $sql = $this->db->prepare("INSERT INTO situacao_obra SET 

            id_company             = :id_company, 
            id_inventario          = :id_product, 
            id_user                = :id_user, 
            preco_situacao         = :preco_situacao,
            preco_bruto            = :preco_bruto,
            descricao_situacao     = :descricao_situacao,
            data_situacao          = :data_situacao,
            situacao_char          = :situacao_char,
            retirada               = :retirada,
            localizacao            = :localizacao,
            codigo                 = :codigo

            ");

    $sql->bindValue(":id_company",          $id_company);
    $sql->bindValue(":id_product",          $id_product);
    $sql->bindValue(":id_user",             $id_user);
    $sql->bindValue(":preco_situacao",      $situacao['preco_situacao']);
    $sql->bindValue(":preco_bruto",      $situacao['preco_bruto']);
    $sql->bindValue(":descricao_situacao",  trim($situacao['descricao_situacao']));
    $sql->bindValue(":data_situacao",       $situacao['data_situacao']);
    $sql->bindValue(":situacao_char",       $situacao['situacao_char']);
    $sql->bindValue(":retirada",            $situacao['retirada']);
    $sql->bindValue(":localizacao",         $situacao['localizacao']);
    $sql->bindValue(":codigo",              $situacao['leilao_codigo']);

    $sql->execute();

    
    try {

      $sql = $this->db->prepare("UPDATE inventario SET

                inv_venda           = :situacao_venda

                WHERE id_inventario = :id_inventario AND id_company = :id_company;
                ");

      $sql->bindValue(':id_company',       $id_company);
      $sql->bindValue(':id_inventario',    $id_product);
      $sql->bindValue(':situacao_venda',   $situacao['edit_venda_situacao']);

      $sql->execute();
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }
  }

  public function updatePriceMercadolivre($id_product, $Parametros)
  {


    $sql = $this->db->prepare("UPDATE inventario SET 

            inv_price_venda = :inv_price_venda

            WHERE id_inventario = :id_product

            ");

    $sql->bindValue(":id_product",          $id_product);
    $sql->bindValue(":inv_price_venda",     $Parametros['preco_situacao']);



    $sql->execute();
  }


  public function setEditarSituacao($id_product, $id_company, $id_user, $situacao)
  {

    $id_situacao = $situacao['id_situacao'];


        $sql = $this->db->prepare("UPDATE situacao_obra SET 

            id_company             = :id_company,  
            id_user                = :id_user, 
            descricao_situacao     = :descricao_situacao,
            data_situacao          = :data_situacao,
            situacao_char          = :situacao_char,
            preco_situacao         = :preco_situacao, 
            retirada               = :retirada,
            codigo                  = :codigo

            WHERE id_situacao = :id_situacao

            ");

        $sql->bindValue(":id_company",          $id_company);
        $sql->bindValue(":id_situacao",         $id_situacao);
        $sql->bindValue(":id_user",             $id_user);
        $sql->bindValue(":descricao_situacao",  trim($situacao['edit_situacao']));
        $sql->bindValue(":data_situacao",       $situacao['edit_data_situacao']);
        $sql->bindValue(":situacao_char",       $situacao['edit_venda_situacao']);
        $sql->bindValue(":preco_situacao",      $situacao['edit_preco_situacao']);
        $sql->bindValue(":retirada",            $situacao['edit_retirada']);
        $sql->bindValue(':codigo',   $situacao['codigo']);



        $sql->execute();


    try {

      $sql = $this->db->prepare("UPDATE inventario SET

                inv_venda           = :situacao_venda

                WHERE id_inventario = :id_inventario AND id_company = :id_company;
                ");

      $sql->bindValue(':id_company',       $id_company);
      $sql->bindValue(':id_inventario',    $id_product);
      $sql->bindValue(':situacao_venda',   $situacao['edit_venda_situacao']);

      $sql->execute();
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }
  }

  public function setEditarProcedencia($id_product, $id_company, $id_user, $compra)
  {


    $compra['preco_procedencia'] = str_replace('R$', '', $compra['preco_procedencia']);
    $compra['preco_procedencia'] = explode(',', $compra['preco_procedencia']);
    $compra['preco_procedencia'] = str_replace('.', '', $compra['preco_procedencia']);

    $sql = $this->db->prepare(

      "SELECT * FROM procedencia WHERE id_inventario = :id_product "
    );

    $sql->bindValue(":id_product", $id_product);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $sql = $this->db->prepare("UPDATE procedencia SET 

                id_company             = :id_company, 
                id_inventario          = :id_product, 
                id_user                = :id_user, 
                inventario_preco       = :inventario_preco,
                descricao              = :descricao_compra,
                data                   = :data_compra

                WHERE id_inventario = :id_product

                ");

      $sql->bindValue(":id_company",          $id_company);
      $sql->bindValue(":id_product",          $id_product);
      $sql->bindValue(":id_user",             $id_user);
      $sql->bindValue(":inventario_preco",    $compra['preco_procedencia'][0]);
      $sql->bindValue(":descricao_compra",    trim($compra['procedencia']));
      $sql->bindValue(":data_compra",         $compra['data_procedencia']);

      $sql->execute();
    } else {
      $sql = $this->db->prepare("INSERT INTO procedencia SET 

                id_company             = :id_company, 
                id_inventario          = :id_product, 
                id_user                = :id_user, 
                inventario_preco       = :inventario_preco,
                descricao              = :descricao_compra,
                data                   = :data_compra

                ");

      $sql->bindValue(":id_company",          $id_company);
      $sql->bindValue(":id_product",          $id_product);
      $sql->bindValue(":id_user",             $id_user);
      $sql->bindValue(":inventario_preco",    $compra['preco_procedencia'][0]);
      $sql->bindValue(":descricao_compra",    $compra['procedencia']);
      $sql->bindValue(":data_compra",         $compra['data_procedencia']);

      $sql->execute();
    }
  }

  public function setLog($id_product, $id_company, $id_user, $action, $compra, $Parametros)
  {

    $action = $action . ' - ' . $compra;

    $sql = $this->db->prepare("INSERT INTO inventario_log 
            SET id_company = :id_company, 
            id_inventario = :id_product, 
            id_user = :id_user, 
            action = :action, 
            date_action = NOW()
            ");

    $sql->bindValue(":id_company", $id_company);
    $sql->bindValue(":id_product", $id_product);
    $sql->bindValue(":id_user", $id_user);
    $sql->bindValue(":action", $action);
    $sql->execute();

    $compra = array();
    $situacao = array();

    $titulo                     = controller::ReturnValor($Parametros['titulo']);
    $assinatura                 = controller::ReturnValor($Parametros['assinatura']);

    $id_artista                                       = ($Parametros['id_artista']);
    $id_tecnica                                       = ($Parametros['id_tecnica']);
    $tamanho                                          = ($Parametros['tamanho']);
    $datado                                           =  controller::ReturnValor($Parametros['datado']);
    $tiragem                                          =  controller::ReturnValor($Parametros['tiragem']);
    $observacao                                       =  controller::ReturnValor($Parametros['observacao']);
    $localizacao                                      =  controller::ReturnValor($Parametros['localizacao']);

    $sql = $this->db->prepare("INSERT INTO inventario_set_log SET
            id_company          = :id_company, 
            id_tecnica          = :id_tecnica,
            id_artista          = :id_artista, 
            inv_descricao       = :titulo,
            inv_assinatura      = :assinatura,
            inv_tamanho         = :tamanho,
            inv_tiragem         = :tiragem,
            inv_data            = :datado,
            id_inv_situacao     = :id_inv,
            inv_observacao      = :observacao,
            inv_venda           = :situacao_venda,
            inv_localizacao     = :localizacao, 
            inv_id_inventario   = $id_product

            ");

    $sql->bindValue(':id_company',   $id_company);
    $sql->bindValue(':id_artista',   $id_artista);
    $sql->bindValue(':id_tecnica',   $id_tecnica);

    $sql->bindValue(':titulo',          $titulo);
    $sql->bindValue(':assinatura',      $assinatura);
    $sql->bindValue(':tamanho',         $tamanho);
    $sql->bindValue(':tiragem',         $tiragem);
    $sql->bindValue(':datado',          $datado);
    $sql->bindValue(':id_inv',          $id_inv_situacao);
    $sql->bindValue(':observacao',      $observacao);
    $sql->bindValue(':localizacao',     $localizacao);
    $sql->bindValue(':situacao_venda',   $situacao['situacao_char']);

    $sql->execute();
  }

  private function addphoto($id_product, $Parametros, $photo, $id_company)
  {

    $artista = array();

    $id_anuncio = $id_product;

    $artista = $this->artista->getNameArtistaById($Parametros['id_artista'], $id_company);

    $artistaName = $artista[0]['art_nome'];

    $artista_name = $artistaName;
    $artista = str_replace(' ', '_', $artista_name);

    $param = isset($Parametros['leilao_codigo_foto']) ? $Parametros['leilao_codigo_foto'] : '';

    if (!empty($param) && $param != '') {


      $string = $param;
      $array = str_split($string, 4);
      $novaString = implode("-", $array);
      $tmpname = $novaString . '.jpg';

      $imgurl = 'https://www.tableau.com.br/leilao/' . $tmpname;

      if (is_dir("assets/images/anuncios/" . $artista)) {
        $link   = 'assets/images/anuncios/' . $artista . '/' . $tmpname;
      } else {
        mkdir("assets/images/anuncios/" . $artista);
        $link   = 'assets/images/anuncios/' . $artista . '/' . $tmpname;
      }

      if (!@copy($imgurl, $link)) {
        $errors = error_get_last();
        echo "COPY ERROR: " . $errors['type'];
        echo "<br />\n" . $errors['message'];
      } else { }

      $sql = $this->db->prepare("INSERT INTO inventario_image (id_inventario,url)
                VALUES (:id_inventario, :url)
                ");
      $sql->bindValue(":id_inventario", $id_anuncio);
      $sql->bindValue(":url", $tmpname);
      $sql->execute();
    }

    if (isset($photo)) {
      if (count($photo) > 0) {
        for ($q = 0; $q < count($photo['tmp_name']); $q++) {

          $tipo = $photo['type'][$q];

          if (in_array($tipo, array('image/jpeg', 'image/png', 'image/jpg'))) {

            $Parametros['titulo'] = str_replace(' ', '_', $Parametros['titulo']);

            $Parametros['titulo'] = preg_replace("/[áàâãä]/", "a", $Parametros['titulo']);

            $Parametros['titulo'] = lcfirst($Parametros['titulo']);

            $tmpname = md5(time() . rand(0, 999)) . '.jpg';
            /*$tmpname = $id_anuncio.'.jpg';*/

            if (is_dir("assets/images/anuncios/" . $artista)) {
              move_uploaded_file($photo['tmp_name'][$q], 'assets/images/anuncios/' . $artista . '/' . $tmpname);
            } else {
              mkdir("assets/images/anuncios/" . $artista);
              move_uploaded_file($photo['tmp_name'][$q], 'assets/images/anuncios/' . $artista . '/' . $tmpname);
            }

            list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/' . $artista . '/' . $tmpname);
            $ratio = $width_orig / $height_orig;

            $width = 500;
            $height = 500;

            if ($width / $height > $ratio) {
              $width = $height * $ratio;
            } else {
              $height = $width / $ratio;
            }

            $img = imagecreatetruecolor($width, $height);
            if ($tipo == 'image/jpeg') {
              $origi = imagecreatefromjpeg('assets/images/anuncios/' . $artista . '/' . $tmpname);
            } elseif ($tipo == 'image/png') {
              $origi = imagecreatefrompng('assets/images/anuncios/' . $artista . '/' . $tmpname);
            }

            imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            $imgag = imagejpeg($img, 'assets/images/anuncios/' . $artista . '/' . $tmpname, 80);

            $sql = $this->db->prepare("INSERT INTO inventario_image (id_inventario,url)
                            VALUES (:id_inventario, :url)
                            ");
            $sql->bindValue(":id_inventario", $id_anuncio);
            $sql->bindValue(":url", $tmpname);
            $sql->execute();
          }
        }
      }
    } else {

      error_log(print_r('erro na foto', 1));
    }
  }

  public function getImagesByProductId($id)
  {
    $sql = "SELECT id_image,url FROM inventario_image WHERE id_inventario = :id ORDER BY id_image LIMIT 1 ";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetch();
    }

    return $this->array;
  }

  public function getLucro($id)
  {
    $sql = "
      SELECT preco_situacao, situacao_char, inventario_preco FROM situacao_obra sit
        INNER JOIN inventario inv ON (inv.id_inventario = sit.id_inventario)
        INNER JOIN procedencia pro ON (pro.id_inventario = inv.id_inventario)
      WHERE sit.id_inventario = :id AND sit.situacao_char = '1'";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetch();
    }

    return $this->array;
  }

  public function getleilaoON($id)
  {
    $sql = "
      SELECT id_situacao,retirada, situacao_char, id_inventario, descricao_situacao FROM situacao_obra sit
      WHERE sit.id_inventario = :id AND retirada <> :retirada ORDER BY id_situacao DESC LIMIT 1 ";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->bindValue(":retirada", 'OK');

    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetch();
    }

    return $this->array;
  }

  public function getProcedencia($id)
  {
    $sql = "
      SELECT * FROM procedencia proc
      WHERE proc.id_inventario = :id LIMIT 1 ";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);

    $sql->execute();

    if ($sql->rowCount() == 1) {
      $this->array = $sql->fetch();
    }

    return $this->array;
  }

  

  public function getImagesByProduct($id)
  {
    $sql = "SELECT id_image,url FROM inventario_image WHERE id_inventario = :id  ";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetchAll();
    }

    return $this->array;
  }

  public function getHistorico($id_inventario, $orderBY)
  {

    $array = array();

    $sql = $this->db->prepare("SELECT * 
            FROM  situacao_obra sit
            WHERE sit.id_inventario = :id ORDER BY sit.id_situacao" . $orderBY);

    $sql->bindValue(':id', $id_inventario);

    $sql->execute();


    if ($sql->rowCount() > 0) {
      $array = $sql->fetchALL();
    }

    return $array;
  }

  public function getInventarioById($id_inventario, $id_company)
  {

    $sql = $this->db->prepare("SELECT * FROM inventario inv

            INNER JOIN artista  art ON (inv.id_artista = art.id_artista) 
            INNER JOIN tecnica tec ON (tec.id_tecnica = inv.id_tecnica) 

            WHERE inv.id_company = :id_company AND inv.id_inventario = :id_inventario");

    $sql->bindValue(':id_company', $id_company);
    $sql->bindValue(':id_inventario', $id_inventario);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetchAll();
    }

    return $this->array;
  }

  public function getSituacaoByOK($id_inventario)
  {

    $sql = $this->db->prepare("SELECT 
            retirada FROM situacao_obra sit
            WHERE sit.id_inventario = :id_inventario 
            ORDER BY sit.id_inventario DESC limit 1");

    $sql->bindValue(':id_inventario', $id_inventario);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $this->array = $sql->fetch();
    }

    return $this->array;
  }

  public function duplicarObra($Parametros, $id_inv_situacao)
  {
    $action = 'CADASTRO';
    $Parametros['visivel'] = isset($Parametros['visivel']) ? $Parametros['visivel'] : '1';
    $Parametros['etiqueta'] = isset($Parametros['etiqueta']) ? $Parametros['etiqueta'] : '1';

    try {
      $sql = $this->db->prepare("INSERT INTO inventario SET

                id_company = :id_company, 
                id_tecnica = :id_tecnica,
                id_artista = :id_artista, 
                inv_descricao = :titulo,
                inv_assinatura = :assinatura,
                inv_tamanho = :tamanho,
                inv_tiragem = :tiragem,
                inv_data = :datado,
                inv_price_venda = :price_venda,
                inv_visivel = :visivel,
                inv_etiqueta = :etiqueta,
                id_inv_situacao = :id_inv_situacao


                ");

      $sql->bindValue(':id_company',   $Parametros[0]['id_company']);
      $sql->bindValue(':id_artista',   $Parametros[0]['id_artista']);
      $sql->bindValue(':titulo',       ucfirst($Parametros[0]['inv_descricao']));
      $sql->bindValue(':id_tecnica',   $Parametros[0]['id_tecnica']);
      $sql->bindValue(':assinatura',   ucfirst($Parametros[0]['inv_assinatura']));
      $sql->bindValue(':tamanho',      $Parametros[0]['inv_tamanho']);
      $sql->bindValue(':tiragem',      ucfirst($Parametros[0]['inv_tiragem']));
      $sql->bindValue(':datado',       $Parametros[0]['inv_data']);
      $sql->bindValue(':price_venda',  $Parametros[0]['inv_price_venda']);
      $sql->bindValue(':visivel',      $Parametros[0]['inv_visivel']);
      $sql->bindValue(':etiqueta',     $Parametros[0]['inv_etiqueta']);
      $sql->bindValue(':id_inv_situacao',     $id_inv_situacao);


      if ($sql->execute()) {
        $this->retorno['inventario_add']['mensagem']['sucess'] = 'sucesso';
      } else {
        $this->retorno['inventario_add']['mensagem']['error'] = 'erro ao cadastrar';
      }


      $id_product = $this->db->lastInsertId();
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }

    return $this->retorno;
  }

  public function addImport($id_company, $Parametros, $id_user, $id_inv_situacao)
  {

    $action = 'CADASTRO';

    $compra = array();
    $situacao = array();

    $visivel = isset($Parametros['visivel']) ? $Parametros['visivel'] : '1';
    $etiqueta = isset($Parametros['etiqueta']) ? $Parametros['etiqueta'] : '1';

    $id_artista                                       = ($Parametros['id_artista']);
    $id_tecnica                                       =  $Parametros['id_tecnica'];
    $titulo                                           =  ucfirst($Parametros['titulo']);
    $assinatura                                       =  ucfirst($Parametros['assinatura']);
    $tamanho                                          = ($Parametros['tamanho']);
    $datado                                           = ($Parametros['datado']);
    /*$tiragem                                          =  ucfirst($Parametros['tiragem']); */

    try {

      $sql = $this->db->prepare("INSERT INTO inventario SET
                /*id_inventario       = :id_inventario,*/
                id_company          = :id_company, 
                id_tecnica          = :id_tecnica,
                id_artista          = :id_artista, 
                inv_descricao       = :titulo,
                inv_assinatura      = :assinatura,
                inv_tamanho         = :tamanho,
                inv_data            = :datado,
                inv_visivel         = :visivel,
                inv_etiqueta        = :etiqueta,
                id_inv_situacao     = :id_inv,
                inv_venda           = :situacao_venda
                ");

      $sql->bindValue(':id_company',   $id_company);
      $sql->bindValue(':id_artista',   $id_artista);
      $sql->bindValue(':id_tecnica',   $id_tecnica);

      $sql->bindValue(':titulo',       $titulo);
      $sql->bindValue(':assinatura',   $assinatura);
      $sql->bindValue(':tamanho',      $tamanho);

      $sql->bindValue(':datado',       $datado);
      $sql->bindValue(':id_inv',       $id_inv_situacao);
      $sql->bindValue(':situacao_venda',   '0');

      $sql->bindValue(':visivel',      $visivel);
      $sql->bindValue(':etiqueta',     $etiqueta);


      if ($sql->execute()) {
        $this->retorno['inventario_add']['mensagem']['sucess'] = 'sucesso';
      } else {
        $this->retorno['inventario_add']['mensagem']['error'] = 'erro ao cadastrar';
      }

      $id_product = $this->db->lastInsertId();

      if (!empty($Parametros['situacao']) && $Parametros['situacao'] == 'TA') {
        $Parametros['descricao_situacao'] = 'Leilão Tableau';
        $Parametros['data_situacao'] = '04/2019';

        $this->setSituacao($id_product, $id_company, $id_user, $Parametros);
        $this->addPhoto($id_product, $Parametros, $photo, $id_company);
      }

      if (!empty($Parametros['leilao_codigo_marcia']) && $Parametros['leilao_codigo_marcia'] != '') {
        $this->addPhotoMarcia($id_product, $Parametros, $photo, $id_company);
      }



      $this->setLog($id_product, $id_company, $id_user, $action, '', $Parametros);
    } catch (PDOExecption $e) {
      $sql->rollback();
      error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
    }

    return $this->retorno;
  }

  public function getCountObraMercadolivre()
  {
    $r = 0;

    $sql = $this->db->prepare("
            SELECT COUNT(*) as c
            FROM  situacao_obra sit
            INNER JOIN inventario inv ON (inv.id_inventario = sit.id_inventario)
            INNER JOIN artista art ON (inv.id_artista = art.id_artista)
            INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)
            WHERE sit.situacao_char = '0' AND inv.id_inv_situacao = '1';
            ");


    $sql->execute();

    $row = $sql->fetch();

    $r = $row['c'];

    return $r;
  }

  public function delete($id, $id_company)
  {

    $sql = $this->db->prepare("DELETE FROM inventario WHERE id_inventario = :id AND id_company = :id_company");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":id_company", $id_company);
    if ($sql->execute()) {
      return true;
      $sql = $this->db->prepare("INSERT INTO inventario_log SET id_company = :id_company, id_inventario = :id_product, action = :action, date_action = NOW()");
      $sql->bindValue(":id_company", $id_company);
      $sql->bindValue(":id_product", $id_product);
      $sql->bindValue(":action", 'DELETA');
      $sql->execute();
    } else {
      return false;
    }
  }
}
