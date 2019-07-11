<?php 
Class Relatorio extends model {


	public function __construct(){
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
		$this->artista = new Artista();

		$this->where = array(
			'1=1'
		);	
	}

	public function getRelatorioByFiltro($filtro){

		$this->where = $this->buildWhere($filtro);

		
		$sql = "SELECT * 
		FROM  situacao_obra sit
		INNER JOIN inventario inv ON (inv.id_inventario = sit.id_inventario)
		INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

		
		WHERE " .implode(' AND ', $this->where)." ORDER BY art.art_nome";
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	public function getTotalByFiltro($filtro){
		$r = 0;
		$this->where = $this->buildWhere($filtro);

		
		$sql = "SELECT SUM(preco_situacao) as c
		FROM  situacao_obra sit
		INNER JOIN inventario inv ON (inv.id_inventario = sit.id_inventario)
		INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

		
		WHERE " .implode(' AND ', $this->where)." ORDER BY art_nome";
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		$row = $sql->fetch();
		$this->array['r'] = $row['c'];

		return $this->array['r'];
	}


	public function getRelatorioObra($filtro){

		$this->where = $this->buildWhere($filtro);

		
		$sql = "SELECT * 
		FROM  inventario inv
		INNER JOIN artista art ON (inv.id_artista = art.id_artista)
		INNER JOIN tecnica tec ON (inv.id_tecnica = tec.id_tecnica)

		
		WHERE ".implode(' AND ', $this->where)." ORDER BY art_nome";
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

		if(!empty($filtro['situacao'])) {

			$this->where[] = "sit.descricao_situacao = :situacao";	
		}

		if(!empty($filtro['data'])) {

			$this->where[] = "sit.data_situacao = :data";	
		}

		if(!empty($filtro['venda'])) {
			if($filtro['venda'] != ''){
				$this->where[] = "sit.situacao_char = :situacao_char";	
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

		if(!empty($filtro['situacao'])) {
			if($filtro['situacao'] != ''){
				$sql->bindValue(":situacao", $filtro['situacao']);
			}
		}

		if(!empty($filtro['data'])) {
			if($filtro['data'] != ''){
				$sql->bindValue(":data", $filtro['data']);
			}
		}

		if(!empty($filtro['venda'])) {
			if($filtro['venda'] != ''){
				if($filtro['venda'] == 'sim'){
					$sit = 1;
					$sql->bindValue(":situacao_char", 1);
				}else {
					$sit = 0;
					$sql->bindValue(":situacao_char", 0);
				}
			}
		}


	}


	public function getRecibo($id_inventario,$id_company){

		$sql = $this->db->prepare("SELECT * FROM inventario inv

			INNER JOIN artista  art ON (inv.id_artista = art.id_artista) 
			INNER JOIN tecnica tec ON (tec.id_tecnica = inv.id_tecnica) 

			WHERE inv.id_company = :id_company AND inv.id_inventario IN ($id_inventario)");

		$sql->bindValue(':id_company', $id_company);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;

	}

}