<?php

class Leilao extends model
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

		$sql = "SELECT *, lei.id_leilao as id_leilao FROM  
			leilao lei
			LEFT JOIN leilao_info leif ON (lei.id_leilao = leif.id_leilao)
		
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
			'lei.id_company=' . $id
		);


		if (!empty($filtro['leilao_nome'])) {

			if ($filtro['leilao_nome'] != '') {

				$where[] = "leilao_nome LIKE :leilao_nome";
			}
		}

		if (!empty($filtro['id_leilao'])) {

			if ($filtro['id_leilao'] != '') {

				$where[] = "id_leilao = :id_leilao";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['leilao_nome'])) {
			if ($filtro['leilao_nome'] != '') {
				$sql->bindValue(":leilao_nome", '%' . $filtro['leilao_nome'] . '%');
			}
		}

		if (!empty($filtro['id_leilao'])) {
			if ($filtro['id_leilao'] != '') {
				$sql->bindValue(":id_leilao", $filtro['id_leilao']);
			}
		}
	}


	public function add($id_company, $Parametros)
	{

		$leilao_nome = $Parametros['leilao_nome'];
		$leilao_endereco = $Parametros['leilao_endereco'];

		$leilao_preco = isset($Parametros['leilao_preco']) ? $Parametros['leilao_preco'] : '';
		$leilao_compra = isset($Parametros['leilao_compras']) ? $Parametros['leilao_compras'] : '';


		$sql = $this->db->prepare("INSERT INTO leilao SET 
					leilao_nome = :leilao_nome, 
					leilao_endereco = :leilao_endereco,
					leilao_compras = :leilao_compra,
					leilao_preco = :leilao_preco,

					id_company = :id_company
			
				");

		$sql->bindValue(":leilao_nome", $leilao_nome);
		$sql->bindValue(":leilao_compra", $leilao_compra);
		$sql->bindValue(":leilao_preco", $leilao_preco);

		$sql->bindValue(":leilao_endereco", $leilao_endereco);
		$sql->bindValue(":id_company", $id_company);

		$sql->execute();

		$id_leilao = $this->db->lastInsertId();

		if ($id_company == 1) {

			$sql = $this->db->prepare("INSERT INTO leilao_info SET 
						
					pagamento = 0,
					comprovante = 0,
					cadastro = 0,
					id_company = :id_company,
					id_leilao = :id_leilao
			
				");

			$sql->bindValue(":id_leilao", $id_leilao);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();
		}
	}

	public function edit($id_company, $Parametros)
	{

		$leilao_nome = $Parametros['leilao_nome'];
		$leilao_endereco = $Parametros['leilao_endereco'];
		$id_leilao = $Parametros['id_leilao'];

		$leilao_preco = isset($Parametros['leilao_preco']) ? $Parametros['leilao_preco'] : '';
		$leilao_compra = isset($Parametros['leilao_compras']) ? $Parametros['leilao_compras'] : '';

		if (isset($Parametros['id_leilao']) && $Parametros['id_leilao'] != '') {

			$sql = $this->db->prepare("UPDATE leilao SET 
				leilao_nome = :leilao_nome, 
				leilao_endereco = :leilao_endereco,
				leilao_compras = :leilao_compra,
					leilao_preco = :leilao_preco,
				id_company = :id_company

				WHERE id_leilao = :id_leilao
        	");
			$sql->bindValue(":leilao_nome", $leilao_nome);
			$sql->bindValue(":leilao_compra", $leilao_compra);
			$sql->bindValue(":leilao_preco", $leilao_preco);
			$sql->bindValue(":leilao_endereco", $leilao_endereco);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":id_leilao", $id_leilao);
			$sql->execute();
		}
	}


	public function financeiro($id_leilao, $tipoPagamento, $tipo, $id_company)
	{



		switch ($tipoPagamento) {
			case 'pagamento':
				$coluna = 'pagamento';
				$salvamento = $tipo;
				break;
			case 'envio':
				$coluna = 'comprovante';
				$salvamento = $tipo;	
				break;
			case 'cadastro':
				$coluna = 'cadastro';
				$salvamento = $tipo;	
				break;
		}


		if (isset($id_leilao) && $id_leilao != '') {

			$sql = $this->db->prepare("UPDATE leilao_info SET 
						
					`$coluna` = :salvamento

				WHERE id_leilao = :id_leilao AND id_company = :id_company
			");
			
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":id_leilao", $id_leilao);
			$sql->bindValue(":salvamento", $salvamento);

			

			$sql->execute();
		}
	}


	public function delete($id, $id_company)
	{

		$sql = $this->db->prepare("DELETE FROM leilao WHERE id_leilao = :id AND id_company = :id_company");
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

		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM leilao WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		/*$sql->bindValue(':id_user', $id_user);*/
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function getClienteById($id, $id_company)
	{
		$sql = $this->db->prepare("
			SELECT * FROM cliente
			WHERE id_company = :id_company AND id_leilao = :id
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
