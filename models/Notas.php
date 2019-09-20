<?php
class Notas extends model
{

    public function __construct()
    {
        parent::__construct();

        $this->artista = new Artista();
        $this->array = array();
        $this->retorno = array();
    }

    public function getCountNotas($id, $filtro)
    {

        $r = 0;
        $where = $this->buildWhere($filtro, $id);


        $sql = "SELECT COUNT(*) AS c 
        FROM  nota nta
        INNER JOIN cliente clc ON (nta.clc_id = clc.id_cliente)
        LEFT JOIN cliente_endereco cle ON (clc.clend_id = cle.id_endereco)

        WHERE " . implode(' AND ', $where);
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filtro, $sql);

        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    public function getAll($offset, $filtro, $id)
    {
        
        $where = $this->buildWhere($filtro, $id);

        $sql = "SELECT * 
        FROM  nota nta
        INNER JOIN cliente clc ON (nta.clc_id = clc.id_cliente)
        LEFT JOIN cliente_endereco cle ON (clc.clend_id = cle.id_endereco)
                    INNER JOIN leilao lei ON (lei.id_leilao = nta.id_leilao)



        WHERE " . implode(' AND ', $where) . " ORDER BY nota_numero ASC LIMIT $offset, 10";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filtro, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->array = $sql->fetchAll();
        }

        return $this->array;
    }

    public function getNotaById($id, $id_company)
    {


        $sql = $this->db->prepare(
            "SELECT * 
            FROM  nota nta
            INNER JOIN cliente clc ON (nta.clc_id = clc.id_cliente)
            INNER JOIN cliente_endereco cle ON (clc.clend_id = cle.id_endereco)
            INNER JOIN leilao lei ON (lei.id_leilao = nta.id_leilao)

            WHERE id_nota = :id AND nta.id_company = :id_company
        "
        );
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->array = $sql->fetchAll();
        }

        return $this->array;
    }

    public function getNotaPeriodo($Paramentros, $id_company)
    {

        $id_leilao = $Paramentros['id_leilao'] ;

        $valor = $Paramentros['periodo_nota'];

        $periodo = str_replace('/', '-', $valor);



        $sql = $this->db->prepare(
            "SELECT * 
            FROM  nota nta
            INNER JOIN cliente clc ON (nta.clc_id = clc.id_cliente)
            LEFT JOIN cliente_endereco cle ON (clc.clend_id = cle.id_endereco)
                        INNER JOIN leilao lei ON (lei.id_leilao = nta.id_leilao)

            WHERE nta.id_leilao = :id_leilao AND nta.id_company = :id_company AND leilao_data LIKE :periodo
        "
        );
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_leilao", $id_leilao);
        $sql->bindValue(":periodo", '%' . $periodo . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->array = $sql->fetchAll();
        }

        error_log(print_r($this->array,1));

        return $this->array;
    }

    private function buildWhere($filtro, $id)
    {

        $where = array(
            'nta.id_company=' . $id
        );


        if (!empty($filtro['nota_numero'])) {
            $where[] = "nta.nota_numero LIKE :nota_numero";
        }

        return $where;
    }

    private function bindWhere($filtro, &$sql)
    {

        if (!empty($filtro['nota_numero'])) {
            if ($filtro['nota_numero'] != '') {
                $sql->bindValue(":nota_numero", '%' . $filtro['nota_numero'] . '%');
            }
        }
    }

    public function add($Paramentros, $id_company)
    {

        $num = $this->getNumber();

        $resultado = "";

        for ($i = 0; $i < 6 - strlen($num); $i++)
            $resultado .= "0";
        $resultado .= $num;

        $leilao_data = str_replace("/","-",$Paramentros['leilao_data']);
    

        $sql = $this->db->prepare("INSERT INTO 
        
            nota (clc_id, id_company, leilao_data, nota_numero, id_leilao)
            VALUES (:clc_id, :id_company, :leilao_data , :nota_numero, :id_leilao)
        ");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":nota_numero", $resultado);
        $sql->bindValue(":clc_id", $Paramentros['cliente']);
        $sql->bindValue(":leilao_data", $leilao_data);
        $sql->bindValue(":id_leilao", $Paramentros['id_leilao']);

        if ($sql->execute()) {
            $this->retorno['nota_add']['mensagem']['sucess'] = 'sucesso';
        } else {
            $this->retorno['nota_add']['mensagem']['error'] = 'erro ao cadastrar';
        }

        $id_nota = $this->db->lastInsertId();

        if (isset($Paramentros['objeto'])) {
            if (count($Paramentros['objeto']) > 0) {
                for ($q = 0; $q < count($Paramentros['objeto']['lote']); $q++) {

                    $lote = $Paramentros['objeto']['lote'][$q];
                    $descricao = $Paramentros['objeto']['descricao'][$q];
                    $quantia = $Paramentros['objeto']['quantia'][$q];

                    $sql = $this->db->prepare("INSERT INTO objeto 
                               (obj_lote, obj_descricao, obj_valor)
                        VALUES (:obj_lote, :obj_descricao, :obj_valor)
                            ");
                    $sql->bindValue(":obj_lote", $lote);
                    $sql->bindValue(":obj_descricao", $descricao);
                    $sql->bindValue(":obj_valor", $quantia);
                    $sql->execute();

                    $id_objeto = $this->db->lastInsertId();

                    $sql = $this->db->prepare("INSERT INTO nota_objeto (id_objeto,id_nota)
                            VALUES (:id_objeto, :id_nota)
                            ");
                    $sql->bindValue(":id_objeto", $id_objeto);
                    $sql->bindValue(":id_nota", $id_nota);
                    if ($sql->execute()) {
                        $this->retorno['objeto_add']['mensagem']['sucess'] = 'sucesso';
                    } else {
                        $this->retorno['objeto_add']['mensagem']['error'] = 'erro ao cadastrar';
                    }
                }
            }
        }

        return $this->retorno;
    }

    public function getObjetosByNota($id)
    {

        $sql =
            "   SELECT * 
            FROM  nota_objeto nta
            INNER JOIN objeto obj ON (obj.id_objeto = nta.id_objeto)
            WHERE id_nota = :id;
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->array = $sql->fetchAll();
        }

        return $this->array;
    }

    public function getValorTotalObjNota($id)
    {

        $sql =
            "   SELECT SUM(obj_valor) as c
            FROM  nota_objeto nta
            INNER JOIN objeto obj ON (obj.id_objeto = nta.id_objeto)
            WHERE id_nota = :id;
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    public function getNumber()
    {

        $sql =
            "   SELECT nota_numero as c
            FROM  nota ORDER BY id_nota DESC LIMIT 1
            
        ";
        $sql = $this->db->prepare($sql);

        $sql->execute();

        $row = $sql->fetch();

        $r = $row['c'];

        return $r+1;
      
    }

    
}
