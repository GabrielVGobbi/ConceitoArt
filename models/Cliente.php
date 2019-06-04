<?php

class Cliente extends model
{

	public function __construct()
	{
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
	}

	public function getAll($filtro, $id_company)
	{

		$where = $this->buildWhere($filtro, $id_company);

		$sql = "SELECT * FROM  cliente WHERE " . implode(' AND ', $where);

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
			'id_company=' . $id
		);


		if (!empty($filtro['cliente_nome'])) {

			if ($filtro['cliente_nome'] != '') {

				$where[] = "cliente_nome LIKE :cliente_nome";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['cliente_nome'])) {
			if ($filtro['cliente_nome'] != '') {
				$sql->bindValue(":cliente_nome", '%' . $filtro['cliente_nome'] . '%');
			}
		}
	}


	public function add($id_company, $Parametros)
	{


		$cliente_nome = controller::ReturnValor($Parametros['cliente_nome']);
		$cliente_email = controller::ReturnValor($Parametros['email']);
		$cliente_rg = controller::ReturnFormatLimpo($Parametros['rg']);
		$cliente_cpf = controller::ReturnFormatLimpo($Parametros['cpf']);
		$cliente_endereco = controller::ReturnValor($Parametros['endereco']);

		$sql = $this->db->prepare("INSERT INTO cliente SET 
            cliente_nome = :cliente_nome, 
            cliente_email = :cliente_email,
            id_company = :id_company,
            cliente_rg = :cliente_rg,
            cliente_cpf = :cliente_cpf,
            cliente_endereco = :cliente_endereco
        ");

		$sql->bindValue(":cliente_nome", $cliente_nome);
		$sql->bindValue(":cliente_rg", $cliente_rg);
		$sql->bindValue(":cliente_cpf", $cliente_cpf);
		$sql->bindValue(":cliente_email", $cliente_email);
		$sql->bindValue(":cliente_endereco", $cliente_endereco);
		$sql->bindValue(":id_company", $id_company);

		$sql->execute();

		return $this->db->lastInsertId();
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

	public function getCountCliente($id_company)
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

	public function getClienteById($id, $id_company)
	{
		$sql = $this->db->prepare
		("
			SELECT * FROM cliente
			WHERE id_company = :id_company AND id_cliente = :id
		");

		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}
}
