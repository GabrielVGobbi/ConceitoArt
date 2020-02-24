<?php $titulo = isset($viewData['titulo']) && ($viewData['titulo'] != '') ? 'Relatório - ' . $viewData['titulo'] : $_GET['filtros']['situacao']; ?>
<?php $tituloSite = isset($viewData['titulo']) && ($viewData['titulo'] != '') ? $viewData['titulo'] : strtolower(str_replace(' ', '',$_GET['filtros']['situacao'])); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $tituloSite; ?></title>
	<script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="icon" href="#" sizes="16x16" type="image/png">
	<script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">

	<style>
		@media print {
			#noprint {
				display: none;
			}
		}
	</style>

</head>

<body>

	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2"></h1>
			<div class="btn-toolbar mb-2 mb-md-0">
				<div class="btn-group mr-2" id="noprint">
					<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
					<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
				</div>

			</div>
		</div>

		<h2><?php echo $titulo; ?></h2>

		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th style="width: 9%;">Foto</th>
						<th>Artista</th>
						<th>Descricao</th>
						<th>Situação</th>
						<th>Preço</th>
						<th>Dia</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tableDados as $inv) : ?>

						<?php $artista = str_replace(' ', '_', $inv['art_nome']); ?>
						<?php include('includes/modalEditar.php'); ?>

						<tr>
							<th scope="row"><?php echo $inv['id_inventario'] ?></th>

							<th>
								<a type="button" data-toggle="modal" data-target="#imgModal<?php echo $inv['id_inventario'] ?>">
									<?php $this->loadImg($inv, true); ?>

								</a>
							</th>


							<div class="modal fade" id="imgModal<?php echo $inv['id_inventario'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<?php $this->loadImg($inv, false); ?>
								</div>
							</div>

							<th><?php echo $inv['art_nome'] ?></th>
							<th 
								onclick="modalEdit(<?php #echo $inv['id_inventario']; ?>, 'Descricao')">
								<?php
								echo ($inv['inv_descricao'] != null ? $inv['inv_descricao'] . ' - ' : "");
								echo ($inv['nome_tecnica'] != null ? $inv['nome_tecnica'] . ' - ' : "");
								echo ($inv['inv_assinatura'] != null ? $inv['inv_assinatura'] . ' - ' : "");
								echo ($inv['inv_data'] != null ? $inv['inv_data'] . ' - ' : "");
								echo ($inv['inv_tamanho'] != null ? $inv['inv_tamanho'] . ' - ' : "");
								echo ($inv['inv_tiragem'] != null ? $inv['inv_tiragem'] . ' - ' : "");
								echo ($inv['inv_observacao'] != null ? $inv['inv_observacao'] : "");
								?>
							</th>
							<?php
							$i = new Inventario;
							$historico = $i->getHistorico($inv['id_inventario'], $orderby = ' DESC LIMIT 1');
							?>

							<?php foreach ($historico as $hist) : ?>
								<th onclick="modalEdit(<?php echo $inv['id_inventario']; ?>, 'Situacao')">
									<?php echo $hist['descricao_situacao']; ?>
								</th>
							<?php endforeach; ?>
							<th>R$ <?php echo ($inv['preco_situacao'] != '' ? number_format($inv['preco_situacao'], 2, ',', '.') : '') ?></th>
							<th><?php echo $inv['data_situacao'] ?></th>
							<th id="noprint" style="position: relative;text-align: center;<?php echo ($inv['inv_venda'] == 1 ? 'color: #d80000 ' : '') ?> "><?php echo ($inv['inv_venda'] == 1 ? 'V' : 'NV') ?></th>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div>
				Quantidade de obras: <?php echo count($tableDados); ?>

				
			</div>	
	</div>
</body>
<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

</html>