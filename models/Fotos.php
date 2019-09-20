<?php

class Fotos extends model
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

		$sql = "SELECT * FROM  
			inventario_image invimg
			INNER JOIN inventario inv ON (inv.id_inventario = invimg.id_inventario)
			INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		
		WHERE " . implode(' AND ', $where) . " LIMIT $offset, 10";

		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);


		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
			error_log(print_r($sql,1));

		}

		return $this->array;
	}

	private function buildWhere($filtro, $id)
	{

		$where = array(
			'1=1'
		);


		if (!empty($filtro['art_nome'])) {

			if ($filtro['art_nome'] != '') {

				$where[] = "art.art_nome LIKE :art_nome";
			}
		}

		if (!empty($filtro['id_inventario'])) {

			if ($filtro['id_inventario'] != '') {

				$where[] = "inv.id_inventario = :id_inventario";
			}
		}

		if (!empty($filtro['inventario'])) {

			if ($filtro['inventario'] != '') {

			
				$where[] = "inv.id_inventario IN (:inventario)";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['art_nome'])) {
			if ($filtro['art_nome'] != '') {
				$sql->bindValue(":art_nome", '%' . $filtro['art_nome'] . '%');
			}
		}

		
		if (!empty($filtro['id_inventario'])) {
			if ($filtro['id_inventario'] != '') {
				$sql->bindValue(":id_inventario", $filtro['id_inventario']);
			}
		}

		if (!empty($filtro['inventario'])) {
			if ($filtro['inventario'] != '') {
				$params = implode(',', $filtro['inventario']);
				error_log(print_r($params,1));
				$sql->bindValue(":inventario", $params);
			}
		}
	}

	public function getCount($id, $filtro)
	{

		$r = 0;


		$where = $this->buildWhere($filtro, $id);


		$sql = "SELECT COUNT(*) AS c 
			FROM 
			inventario_image invimg
			INNER JOIN inventario inv ON (inv.id_inventario = invimg.id_inventario)
			INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		  
		  WHERE " . implode(' AND ', $where);
		$sql = $this->db->prepare($sql);


		$this->bindWhere($filtro, $sql);

		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function delete($id)
	{



		$sql = "SELECT * FROM  
			inventario_image invimg 
			INNER JOIN inventario inv ON (inv.id_inventario = invimg.id_inventario)
			INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		
			WHERE id_image = :id";


		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			
		
			
			$artista = str_replace(' ', '_', $array['art_nome']);
			$img =  'assets/images/anuncios/' . $artista . '/' . $array['url'];
			unlink($img);
		}

		$sql = $this->db->prepare("DELETE FROM inventario_image WHERE id_image = :id");
		$sql->bindValue(":id", $id);
		if ($sql->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
