<?php

class Tecnica extends model 
{

	private $userInfo;
	private $permissions;

	public function getAll($filtro, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT nome_tecnica, id_tecnica FROM tecnica WHERE id_company = :id_company ORDER BY nome_tecnica");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function searchTecnicaByName($name, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT nome_tecnica, id_tecnica FROM tecnica WHERE nome_tecnica LIKE :name AND id_company = :id_company LIMIT 10");
		$sql->bindValue(':name', '%'.$name.'%');
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function searchTecnicaByNameLim1($name, $id_company) {
		$id_tecnica = 0;

		$sql = $this->db->prepare("SELECT id_tecnica FROM tecnica WHERE nome_tecnica LIKE :name AND id_company = :id_company LIMIT 1");
		$sql->bindValue(':name', '%'.$name.'%');
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$id_tecnica = $row['id_tecnica'];
		}

		return $id_tecnica;
	}

	public function getName($id_company,$tecnica){

		$sql = $this->db->prepare("SELECT * FROM tecnica WHERE nome_tecnica LIKE :tecnica");
		$sql->bindValue(":tecnica", '%'.$tecnica.'%');
		$sql->bindValue(":id_company", $id_company);
		
		if($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}

	}

	public function add($id_company,$Parametros){
		
		$tecnica = trim($Parametros['tecnica']);

		$sql = $this->db->prepare("INSERT INTO tecnica SET nome_tecnica = :tecnica, id_company = :id_company");
		$sql->bindValue(":tecnica", ucfirst($tecnica));
		$sql->bindValue(":id_company", $id_company);
		
		$sql->execute();

		return $this->db->lastInsertId();

	}

}


?>