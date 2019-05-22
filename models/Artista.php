<?php

class Artista extends model 
{

	private $userInfo;
	private $permissions;

	public function getAll($filtro,$id_company){

		$array = array();
		$id = 1;

		$where = $this->buildWhere($filtro,$id);


	$sql = "SELECT * 
		FROM  artista 
		
		WHERE ".implode(' AND ', $where);
		$sql = $this->db->prepare($sql);


		$this->bindWhere($filtro, $sql);
		
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}


		return $array;
	}

	private function buildWhere($filtro,$id) {


		$where = array(
			'id_company='.$id
		);	


		if(!empty($filtro['artista'])) {

			if($filtro['artista'] != ''){

				$where[] = "art_nome LIKE :art_nome";
			}
		}

		return $where;

	}

	private function bindWhere($filtro, &$sql) {

		if(!empty($filtro['artista'])) {
			if($filtro['artista'] != ''){
				$sql->bindValue(":art_nome", '%'.$filtro['artista'].'%');
			}
		}

	}

	public function getObrasArtista($id,$id_company){

		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM artista WHERE id_company = :id_company AND id_artista = :id");
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':id', $id);
		/*$sql->bindValue(':id_user', $id_user);*/
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function searchArtistaByName($name, $id_company) {

		$array = array();

		$sql = $this->db->prepare("SELECT art_nome, id_artista FROM artista WHERE art_nome LIKE :name AND id_company = :id_company LIMIT 5");
		$sql->bindValue(':name', '%'.$name.'%');
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getNameArtistaById($id, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT art_nome, id_artista FROM artista WHERE id_artista = :id_artista AND id_company = :id_company");
		$sql->bindValue(':id_artista', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getNameArtistaByName($artista, $id_company) {
		$id = 0;

		$sql = $this->db->prepare("SELECT id_artista FROM artista WHERE art_nome LIKE :artista AND id_company = :id_company");
		$sql->bindValue(":artista", '%'.$artista.'%');
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
			$id = $array[0]['id_artista'];
		}

		return $id;
	}

	public function getName($id_company,$artista){
		
		$sql = $this->db->prepare("SELECT * FROM artista WHERE art_nome LIKE :artista AND id_company = :id_company");
		$sql->bindValue(":artista", '%'.$artista.'%');
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			return true;
			
		}else{
	
			return false;
		}

	}

	public function add($id_company,$Parametros){


		$artista = stripslashes($Parametros['artista']);
		$artista = trim($Parametros['artista']);

		$sql = $this->db->prepare("INSERT INTO artista SET art_nome = :artista, id_company = :id_company");
		$sql->bindValue(":artista", ucfirst($artista));
		$sql->bindValue(":id_company", $id_company);
		
		$sql->execute();
		
		

		return $this->db->lastInsertId();

	}

	public function delete($id, $id_company) {

		$sql = $this->db->prepare("DELETE FROM artista WHERE id_artista = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		if($sql->execute()){
			return true;
		}else {
			return false;
		}
		
	}

	public function getCountArtista($id_company){

		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM artista WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		/*$sql->bindValue(':id_user', $id_user);*/
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;

	}

}





?>