<?php 
Class Vendas extends model {


	public function __construct(){
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
		$this->artista = new Artista();

		$this->where = array(
			'1=1'
		);	
	}

	public function getAll($offset,$filtro,$id){

		$sql = "SELECT * FROM situacao_obra";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}


		return $this->array;
		
	}

	public function getByNameDescricao(){

		$sql = "SELECT descricao_situacao FROM situacao_obra GROUP BY descricao_situacao";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
		
	}

	public function getRelatorioByFiltro($filtro){

		$this->where = $this->buildWhere($filtro);

		$sql = "SELECT * 
		FROM  situacao_obra sit
		INNER JOIN inventario inv ON (inv.id_inventario = sit.id_inventario)
		INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

		
		WHERE ".implode(' AND ', $this->where);
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	private function buildWhere($filtro) {

		if(!empty($filtro['artista'])) {

			if($filtro['artista'] != ''){

				$this->where[] = "art.art_nome LIKE :art_nome";
			}
		}

		return $this->where;
	}

	private function bindWhere($filtro, &$sql) {

		if(!empty($filtro['artista'])) {
			if($filtro['artista'] != ''){
				$sql->bindValue(":art_nome", '%'.$filtro['artista'].'%');
			}
		}

	}

}