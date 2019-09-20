<?php

class Financeiro extends model
{

    public function __construct()
    {
        parent::__construct();
        $this->array = array();
        $this->retorno = array();
    }

    public function getAll($offset, $filtro, $id_company)
    {

        $where = $this->buildWhere($filtro, $id_company);

        $sql = "SELECT *,finme.id_mes as mes_financeiro FROM financeiro fin

				INNER JOIN financeiro_mes finme ON (finme.id_financeiro = fin.id_financeiro)
				INNER JOIN mes ms ON (ms.id_mes = finme.id_mes)


		WHERE " . implode(' AND ', $where). ' ORDER BY finme.pago ASC,fin.pagamento_dia';

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
            'id_company=' . $id,
			'ms.nome_mes LIKE :mes',
			'finme.ano = :ano'
        );

        return $where;
    }

    private function bindWhere($filtro, &$sql)
    {
		$mes = controller::getMesNOW();
		$ano = controller::getAnoNOW();

		$sql->bindValue(":mes", '%' . $mes . '%');
		$sql->bindValue(":ano", $ano);

    }

    public function add($Parametros, $id_company)
    {

		$dia = controller::getMesDayNOW();
		$ano = controller::getAnoNOW();

		$tipo = "Inserido";
		
		$instituicao 		= $Parametros['instituicao'];
		$pagamento_dia 		= $Parametros['pagamento_dia'];
		$valor 				= $Parametros['pagamento_valor'];


        try {
            $sql = $this->db->prepare("INSERT INTO financeiro SET
        		instituicao 		= :instituicao,
                pagamento_dia       = :pagamento_dia,
				id_company 			= :id_company

			");

            $sql->bindValue(":instituicao", $instituicao);
			$sql->bindValue(":pagamento_dia", $pagamento_dia);
			$sql->bindValue(":id_company", $id_company);

            if ($sql->execute()) {
                controller::alert('success', 'Inserido com sucesso!!');
            } else {
                controller::alert('danger', 'Não foi possivel fazer a inserção');
			}
			
        } catch (PDOExecption $e) {
            $sql->rollback();
            error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
        }

        $id_financeiro = $this->db->lastInsertId();

        for ($q = $dia; $q < 13; $q++) {
            $sql = $this->db->prepare("INSERT INTO financeiro_mes SET
        		id_financeiro = :id_financeiro,
                id_mes        = :id_mes,
                pago          = :pago,
				ano 		  = :ano,
                valor         = :valor

			");

            $sql->bindValue(":id_financeiro", $id_financeiro);
            $sql->bindValue(":id_mes", $q);
			$sql->bindValue(":pago", '0');
			$sql->bindValue(":ano", $ano);
            $sql->bindValue(":valor", $valor);



            $sql->execute();
        }

	}

    public function edit($Parametros, $id_company)
    {
        $tipo = 'Editado';

        $id_financeiro = $Parametros['id_financeiro'];
        $id_financeiro_mes = $Parametros['id_financeiro_mes'];

        $instituicao        = $Parametros['instituicao'];
        $pagamento_dia      = $Parametros['pagamento_dia'];
        $valor              = $Parametros['pagamento_valor'];

        error_log(print_r($Parametros,1));

        if (isset($Parametros['id_financeiro']) && $Parametros['id_financeiro'] != '') {
            try {

                $sql = $this->db->prepare("UPDATE financeiro SET 
                    
                    instituicao         = :instituicao,
                    pagamento_dia       = :pagamento_dia

                    WHERE id_financeiro = :id_financeiro AND id_company = :id_company
                ");

                $sql->bindValue(":instituicao", $instituicao);
                $sql->bindValue(":pagamento_dia", $pagamento_dia);
                $sql->bindValue(":id_company", $id_company);
                $sql->bindValue(":id_financeiro", $id_financeiro);

                if ($sql->execute()) {
                    controller::alert('success', 'Editado com sucesso!!');
                } else {
                    controller::alert('danger', 'Erro ao fazer a edição!!');
                }

                $sql = $this->db->prepare("UPDATE financeiro_mes SET
    
                    valor         = :valor

                    WHERE id_financeiro = :id_financeiro AND id_financeiro_mes = :id_financeiro_mes
                ");

                $sql->bindValue(":id_financeiro", $id_financeiro);
                $sql->bindValue(":id_financeiro_mes", $id_financeiro_mes);

                $sql->bindValue(":valor", $valor);

                $sql->execute();




            } catch (PDOExecption $e) {
                $sql->rollback();
                error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
            }
        } else {
            controller::alert('danger', 'Não foi selecionado nenhum arquivo!!');
        }
    }

	public function pagar($id_financeiro,$mes,$ano)
    {
		$tipo = 'Editado';
		$pago = '1';

        if (isset($id_financeiro) && $id_financeiro != '') {
            try {

                $sql = $this->db->prepare("UPDATE financeiro_mes SET 
					
					pago = :pago

					WHERE id_financeiro = :id_financeiro AND ano = :ano AND id_mes = :mes
	        	");

				$sql->bindValue(":pago", $pago);
				$sql->bindValue(":ano", $ano);
				$sql->bindValue(":mes", $mes);
                $sql->bindValue(":id_financeiro", $id_financeiro);

                if ($sql->execute()) {
                    controller::alert('success', 'Editado com sucesso!!');
                } else {
                    controller::alert('danger', 'Erro ao fazer a edição!!');
                }
            } catch (PDOExecption $e) {
                $sql->rollback();
                error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
            }
        } else {
            controller::alert('danger', 'Não foi selecionado nenhum arquivo!!');
        }
    }

    public function delete($id, $id_company)
    {

        $sql = $this->db->prepare("DELETE FROM cliente WHERE id_cliente = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCount($id_company)
    {

        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM cliente WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        /*$sql->bindValue(':id_user', $id_user);*/
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

     public function getContaNow($id_company)
    {

        $r = 0;

        $hoje = controller::getDayNOW();
        

        $sql = $this->db->prepare("SELECT COUNT(*) AS c FROM financeiro WHERE id_company = :id_company AND pagamento_dia = :hoje");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':hoje', $hoje);

        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }



}
