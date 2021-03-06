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

		$sql = "SELECT * FROM  
			cliente cli
		LEFT JOIN cliente_endereco cled ON (cli.clend_id = cled.id_endereco)
		
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
		$cliente_email = mb_strtolower($Parametros['email']);
		$cliente_rg = controller::ReturnFormatLimpo($Parametros['rg']);
		$cliente_cpf = ($Parametros['cpf']);

		if (isset($Parametros['cep']) && $Parametros['cep'] != '') {
			try {
				$sql = $this->db->prepare("INSERT INTO cliente_endereco SET 
            		rua = :rua, 
            		numero = :numero,
            		cidade = :cidade,
            		bairro = :bairro,
            		estado = :estado,
					cep = :cep,
					complemento = :complemento
				");

				$sql->bindValue(":rua", $Parametros['rua']);
				$sql->bindValue(":numero", $Parametros['numero']);
				$sql->bindValue(":cidade", $Parametros['cidade']);
				$sql->bindValue(":bairro", $Parametros['bairro']);
				$sql->bindValue(":estado", $Parametros['estado']);
				$sql->bindValue(":cep", $Parametros['cep']);
				$sql->bindValue(":complemento", $Parametros['complemento']);
				$sql->execute();

				$id_endereco = $this->db->lastInsertId();

				if ($id_endereco != 0) {
					$sql = $this->db->prepare("INSERT INTO cliente SET 
            			cliente_nome = :cliente_nome, 
            			cliente_email = :cliente_email,
            			id_company = :id_company,
            			cliente_rg = :cliente_rg,
            			cliente_cpf = :cliente_cpf,
						clend_id = :id_endereco
					");

					$sql->bindValue(":cliente_nome", $cliente_nome);
					$sql->bindValue(":cliente_rg", $cliente_rg);
					$sql->bindValue(":cliente_cpf", $cliente_cpf);
					$sql->bindValue(":cliente_email", $cliente_email);
					$sql->bindValue(":id_company", $id_company);
					$sql->bindValue(":id_endereco", $id_endereco);

					if ($sql->execute()) {
						$this->retorno['cliente_add']['mensagem']['sucess'] = 'sucesso';
					} else {
						$this->retorno['cliente_add']['mensagem']['error'] = 'erro ao cadastrar';
					}
				}
			} catch (PDOExecption $e) {
				$sql->rollback();
				error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
			}
		} else {
			$sql = $this->db->prepare("INSERT INTO cliente SET 
            			cliente_nome = :cliente_nome, 
            			cliente_email = :cliente_email,
            			id_company = :id_company,
            			cliente_rg = :cliente_rg,
            			cliente_cpf = :cliente_cpf
        			");

			$sql->bindValue(":cliente_nome", $cliente_nome);
			$sql->bindValue(":cliente_rg", $cliente_rg);
			$sql->bindValue(":cliente_cpf", $cliente_cpf);
			$sql->bindValue(":cliente_email", $cliente_email);
			$sql->bindValue(":id_company", $id_company);

			$sql->execute();
		}

		return $this->retorno;
	}

	public function edit($Parametros)
	{

		$cliente_nome = controller::ReturnValor($Parametros['cliente_nome']);
		$cliente_email = strtolower($Parametros['email']);
		$cliente_rg = controller::ReturnFormatLimpo($Parametros['rg']);
		$cliente_cpf = ($Parametros['cpf']);

		if (isset($Parametros['id_cliente']) && $Parametros['id_cliente'] != '') {

			$sql = $this->db->prepare("UPDATE cliente SET 
				cliente_nome = :cliente_nome, 
				cliente_email = :cliente_email,
				cliente_rg = :cliente_rg,
				cliente_cpf = :cliente_cpf

				WHERE id_cliente = :id_cliente
        	");

			$sql->bindValue(":cliente_nome", $cliente_nome);
			$sql->bindValue(":cliente_rg", $cliente_rg);
			$sql->bindValue(":cliente_cpf", $cliente_cpf);
			$sql->bindValue(":cliente_email", $cliente_email);
			$sql->bindValue(":id_cliente", $Parametros['id_cliente']);
			$sql->execute();
		}

		if (isset($Parametros['id_endereco']) && $Parametros['id_endereco'] != '') {

			$sql = $this->db->prepare("UPDATE cliente_endereco SET 
					rua = :rua, 
            		numero = :numero,
            		cidade = :cidade,
            		bairro = :bairro,
            		estado = :estado,
					cep = :cep,
					complemento = :complemento

					WHERE id_endereco = :id_endereco
			");

			$sql->bindValue(":rua", $Parametros['rua']);
			$sql->bindValue(":numero", $Parametros['numero']);
			$sql->bindValue(":cidade", $Parametros['cidade']);
			$sql->bindValue(":bairro", $Parametros['bairro']);
			$sql->bindValue(":estado", $Parametros['estado']);
			$sql->bindValue(":cep", $Parametros['cep']);
			$sql->bindValue(":id_endereco", $Parametros['id_endereco']);
			$sql->bindValue(":complemento", $Parametros['complemento']);
			$sql->execute();
		} else {
			
			$this->updateEnderecoCliente($Parametros);
		}
	}

	public function updateEnderecoCliente($Parametros)
	{
		$sql = $this->db->prepare("INSERT INTO cliente_endereco SET 
            		rua = :rua, 
            		numero = :numero,
            		cidade = :cidade,
            		bairro = :bairro,
            		estado = :estado,
					cep = :cep,
					complemento = :complemento

				");

		$sql->bindValue(":rua", $Parametros['rua']);
		$sql->bindValue(":numero", $Parametros['numero']);
		$sql->bindValue(":cidade", $Parametros['cidade']);
		$sql->bindValue(":bairro", $Parametros['bairro']);
		$sql->bindValue(":estado", $Parametros['estado']);
		$sql->bindValue(":cep", $Parametros['cep']);
		$sql->bindValue(":complemento", $Parametros['complemento']);

		$sql->execute();

		$id_endereco = $this->db->lastInsertId();

		if (isset($Parametros['id_cliente']) && $Parametros['id_cliente'] != '') {

			$sql = $this->db->prepare("UPDATE cliente SET 
				clend_id = :clen_id

				WHERE id_cliente = :id_cliente
        	");

			$sql->bindValue(":id_cliente", $Parametros['id_cliente']);
			$sql->bindValue(":clen_id", $id_endereco);
			$sql->execute();
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
		$sql = $this->db->prepare("
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
