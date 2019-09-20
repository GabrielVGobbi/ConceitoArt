<?php
include_once("filtro.php");
require("modalCadastrar.php");
?>

<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header" style="margin-bottom: 10px;">
			<h3 class="box-title">Notas</h3>

			<div class="box-tools pull-right">
				<div class="has-feedback">

					<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalGerarNotaLeilao">
						<i class="fa fa-fw fa-file"></i>
					</button>

					<a href="<?php echo BASE_URL; ?>notas" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>

					<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalCadastro">
						<i class="fa fa-fw fa-plus-circle"></i>
					</button>
				</div>
			</div>
		</div>

		<div class="box-body" style="margin-bottom: 10px;">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered">
					<?php if (count($tableDados) > 0) : ?>
						<tbody>
							<thead class="thead-dark">
								<tr>
									<th class="scope" style="width: 20%">Ação</th>
									<th class="scope" style="width: 10%;">Nº Nota</th>
									<th class="scope">Cliente</th>
									<th class="text-center">Leilão</th>
								</tr>
							</thead>
							<?php foreach ($tableDados as $not) : ?>
								<tr>
									<td class="">
										<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalVisualizar<?php echo $not['id_nota'] ?>">
											<i class="fa fa-fw fa-info"></i>

										</button>
										<a href="<?php echo BASE_URL; ?>notas/GerarNota/<?php echo $not['id_nota']; ?>" target="_blank" class="btn btn-primary " style="margin-right: 5px;">
											<i class="fa fa-download"></i> Gerar Nota
										</a>

									</td>
									<td class=""><?php echo $not['nota_numero']; ?></td>
									<td class=""><?php echo $not['cliente_nome']; ?></td>
									<td><?php echo $not['leilao_nome']; ?></td>
								</tr>
								<?php require("modalVisualizar.php"); ?>
							<?php endforeach; ?>
						</tbody>
					<?php else : ?>
						<tr>
							<td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
			<div class="pull-left" style="right: 10px;">
				<p> Quantidade de notas: <?php  ?> </p>
			</div>
		</div>
		<div class="box-footer no-padding">
			<div class="mailbox-controls">


				<ul class="pagination pagination-sm pull-right">
					<?php
					for ($q = 1; $q <= $p_count; $q++) : ?>
						<li class="<?php echo ($q == $p) ? 'active' : '' ?> "><a href="<?php echo BASE_URL; ?>notas?p=<?php
																															$w = $_GET;
																															$w['p'] = $q;
																															echo http_build_query($w);
																															?>
																"><?php echo $q; ?></a></li>
					<?php endfor; ?>

				</ul>

			</div>
		</div>
	</div>
</div>

<div class="modal" id="modalGerarNotaLeilao" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<form action="<?php echo BASE_URL ?>notas/notasLeilao" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title text-center">Importar</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Opções</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Selecione o Leilao</label>
										<select  required class="form-control select2" style="width: 100%;" name="id_leilao" id="id_leilao" aria-hidden="true">
											<option value="">Selecione</option>

											<?php foreach ($leilao as $lei) : ?>
												<option value="<?php echo $lei['id_leilao']; ?>"><?php echo $lei['leilao_nome']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<label>Periodo (Por mês)</label>
									<div class="input-group">
										<input type="text" class="form-control" name="periodo_nota" id="periodo_nota" data-inputmask="'alias': 'mm/yyyy'" data-mask="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Aplicar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</form>
	</div>
</div>