<?php $titulo = isset($viewData['titulo']) ? 'Relatório - '.$viewData['titulo'] : 'Relatório'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modal</title>
	<script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">

	<script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">


</head>
<body>
	<div id="normal" style="display: all;">
		<a style="width: 8%;" type="button" onclick="modoexcel();" class="btn btn-block btn-info btn-lg pull-right">Modo Excel</a>
		<div class="container theme-showcase normal" role="main">
			<div class="page-header">
				<a style="width: 8%;" type="button" href="<?php echo BASE_URL;?>relatorio" class="btn btn-block btn-info btn-lg pull-right">Voltar</a>
				<h1><?php echo $titulo ?></h1>

			</div>

			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>

								<th style="width: 9%;">Foto</th>

								<th>Artista</th>
								<th>Descricao</th>
								<th>Situação</th>
								<th>Preço</th>
								<th>Dia</th>
								<!-- <th style="text-align: center;">Venda</th> -->
							</tr>
						</thead>
						<?php foreach ($tableDados as $inv): ?>

							<?php $artista = str_replace(' ','_',$inv['art_nome']); ?>
							<tbody>

								<tr>
									<th scope="row"><?php echo $inv['id_inventario'] ?></th>

									<th>
										<a type="button" data-toggle="modal" data-target="#imgModal<?php echo $inv['id_inventario']?>">
											<?php $this->loadImg($inv, true); ?>

										</a>
									</th>


									<div class="modal fade" id="imgModal<?php echo $inv['id_inventario']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<?php $this->loadImg($inv, false); ?>
										</div>
									</div>

									<th><?php echo $inv['art_nome'] ?></th>
									<th onclick="modalEdit(<?php echo $inv['id_inventario']; ?>, 'Descricao')">
										<?php 
										echo ($inv['inv_descricao'] != null ?$inv['inv_descricao'].' - ' : "" );
										echo ($inv['nome_tecnica'] != null ?$inv['nome_tecnica'].' - ' : "" );
										echo ($inv['inv_assinatura'] != null ?$inv['inv_assinatura'].' - ' : "" );
										echo ($inv['inv_data'] != null ?$inv['inv_data'].' - ' : "" );
										echo ($inv['inv_tamanho'] != null ?$inv['inv_tamanho'].' - ' : "" );
										echo ($inv['inv_tiragem'] != null ?$inv['inv_tiragem'].' - ' : "" );
										echo ($inv['inv_observacao'] != null ? $inv['inv_observacao'] : "" );
										?> 
									</th>
									<?php 
									$i = new Inventario;
									$historico = $i->getHistorico($inv['id_inventario'], $orderby = ' DESC LIMIT 1');
									?>

									<?php foreach ($historico as $hist): ?> 
										<th onclick="modalEdit(<?php echo $inv['id_inventario']; ?>, 'Situacao')">
											<?php echo $hist['descricao_situacao']; ?>
										</th>
									<?php endforeach; ?>
									<th>R$ <?php echo ($inv['preco_situacao'] != '' ? number_format($inv['preco_situacao'], 2, ',', '.') : '') ?></th>
									<th><?php echo $inv['data_situacao'] ?></th>
									<th style="position: relative;text-align: center;<?php echo ($inv['inv_venda'] == 1 ? 'color: #d80000 ' : '') ?> "><?php echo ($inv['inv_venda'] == 1 ? 'V' : 'NV') ?></th>
								</tr>
							</div>
							<?php include('includes/modalEditar.php'); ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div>
				Quantidade de obras: <?php echo count($tableDados); ?>

				
			</div>		
		</div>
	</div>

	<div id="excel123" style="display: none;">
		<a style="width: 8%;" type="button" onclick="modonormal();" class="btn btn-block btn-info btn-lg pull-right">Modo Normal</a>
		<div class="container theme-showcase" role="main" >
			<div class="page-header">


			</div>

			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>

								
								<th>Descricao</th>
								<th>Preço</th>

								<!-- <th style="text-align: center;">Venda</th> -->
							</tr>
						</thead>
						<?php foreach ($tableDados as $inv): ?>

							<?php $artista = str_replace(' ','_',$inv['art_nome']); ?>
							<tbody>


								<tr>
									<th scope="row"><?php echo $inv['id_inventario'] ?></th>
									





									<th>
										<?php 
										echo mb_strtoupper($inv['art_nome'],'UTF-8').' - ';
										echo ($inv['inv_descricao'] != null ?$inv['inv_descricao'].' - ' : "" );
										echo ($inv['nome_tecnica'] != null ?$inv['nome_tecnica'].' - ' : "" );
										echo ($inv['inv_assinatura'] != null ?$inv['inv_assinatura'].' - ' : "" );
										echo ($inv['inv_data'] != null ?$inv['inv_data'].' - ' : "" );
										echo ($inv['inv_tamanho'] != null ?$inv['inv_tamanho'].' - ' : "" );
										echo ($inv['inv_tiragem'] != null ?$inv['inv_tiragem'].' - ' : "" );
										echo ($inv['inv_observacao'] != null ? $inv['inv_observacao'] : "" );
										?> 
									</th>
									<th>R$ <?php echo ($inv['preco_situacao'] != '' ? number_format($inv['preco_situacao'], 2, ',', '.') : '') ?></th>

								</tr>
							</div>
							<?php include('includes/modalEditar.php'); ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	<script type="text/javascript">
		
		function modoexcel(){
			$('#excel123').show();
			$('#normal').hide();
		}

		function modonormal(){
			$('#excel123').hide();
			$('#normal').show();
		}


	</script>
</body>
</html>