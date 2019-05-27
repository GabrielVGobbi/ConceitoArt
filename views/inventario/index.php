<?php 
include_once("filtro.php"); 
include("modalCadastrar.php"); 
?>

<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header" style="margin-bottom: 10px;">
			<h3 class="box-title">Obras</h3>

			<div class="box-tools pull-right">
				<div class="has-feedback">
					<a href="<?php echo BASE_URL;?>inventario" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
					<a style="padding: 4px;" data-toggle="modal" data-target="#modalImportar" class="btn btn-default"><i class="fa fa-link"></i>  Importar</a>			
				</div>
			</div>
		</div>

		<div class="box-body  " style="margin-bottom: 10px;">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered ">
					<?php if(count($tableDados) > 0): ?>
						<tbody>
							<thead class="thead-dark">
								<tr>
									<!-- <th class="scope"><input type="checkbox" id="marcarTodos" /></th> -->
									<th class="scope" style="    width: 14%;">Ação</th>
									<th class="scope" style="width: 38%;">Imagem / Artista</th>
									<th class="scope">Descrição</th>
									<th class="text-center" style="width: 2%;">Situação</th>
								</tr>
							</thead>
							<?php foreach ($tableDados as $inv ): ?>
								<tr 
								<?php 
								if($inv['inv_venda'] == '1'){ 
									echo 'class="table-danger"';
								}elseif($inv['id_inv_situacao'] == '1') {
									echo 'class="table-warning"';
								}

								?>> 
									<td class="" >
										<?php $this->include1($button = 'button_table', $dados = array($viewData['pageController'],$inv['id_inventario'])); ?>
										<button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalInfo<?php echo $inv['id_inventario']?>">
											<i class="fa fa-fw fa-info"></i>
										</button>
										<?php if($this->userInfo['user']->hasPermission('mercadolivre_view')): ?>
											<a href="<?php echo BASE_URL;?>mercadolivre/addmercadolivre/<?php echo $inv['id_inventario']?>"><i class="fa fa-fw fa-info"></i></a>
										<?php endif; ?>

									</td>
									<td class="">
										<a type="button" data-toggle="modal" data-target="#imgModal<?php echo $inv['id_inventario']?>">
											<?php $this->loadImg($inv, false); ?> </a>
											- <?php echo $inv['id_inventario'].' - '. $inv['art_nome']; ?> 

										</td>
										<td class="" onclick="Modal(<?php echo $inv['id_inventario']; ?>, 'modalVisualizar')">
											<?php 
											echo ( $inv['inv_descricao'] != null ? $inv['inv_descricao'].' - ' : "" );
											echo ( ucfirst($inv['nome_tecnica']) != null ? ucfirst($inv['nome_tecnica']).' - ' : "" );
											echo ( $inv['inv_assinatura'] != null ? $inv['inv_assinatura'].' - ' : "" );
											echo ( $inv['inv_data'] != null ? $inv['inv_data'].' - ' : "" );
											echo ( $inv['inv_tamanho'] != null ? $inv['inv_tamanho'] : "" );
											echo ( $inv['inv_tiragem'] != null ? ' - '.$inv['inv_tiragem'] : "" );
											?> 
										</td>
										<?php 
											$sit__= $this->inventario->getSituacaoByOK($inv['id_inventario']); 
											
											
												if(isset($sit['retirada']) != 'OK'){
													$span = '<span class="label label-danger">Em Leilão</span>';
												}else {
													$span = '';
												}

											

										?>
										<td><?php echo ($inv['inv_venda'] == '1') ? '<span class="label label-danger">Vendido</span>' : '<span class="label label-success">Não Vendido</span>'?> <?php echo ($inv['id_inv_situacao'] == '1') ? '<span class="label label-warning">Mercado Livre</span>' : '' ?>  </td>
									</tr>

									<div class="modal fade" id="imgModal<?php echo $inv['id_inventario']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<?php $this->loadImg($inv, true); ?>
										</div>
									</div>
									<?php include ("modalVisualizar.php"); ?>
									<?php include ("modalRelatorio.php"); ?>
								<?php endforeach; ?>
							</tbody>	
							<?php else: ?> 
								<tr>
									<td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>	
								</tr>
							<?php endif; ?>
						</table>
					</div>
					<div class="pull-left" style="right: 10px;">
						<p> Quantidade de obras: <?php echo $inventario_count; ?> </p>
					</div>
				</div>
				<div class="box-footer no-padding">
					<div class="mailbox-controls">


						<ul class="pagination pagination-sm pull-right">
							<?php 
							for($q=1;$q<=$p_count;$q++): ?>
								<li class="<?php echo ($q==$p)?'active':'' ?> "><a href="<?php echo BASE_URL; ?>inventario?p=<?php 
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


		<div class="modal" id="modalImportar" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<form action="<?php echo BASE_URL?>relatorio/importar" method="POST" enctype="multipart/form-data">
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

										<div class="col-xs-5">
											<div class="btn btn-default btn-file">
												<i class="fa fa-paperclip"></i> Arquivo
												<input type="file" name="arquivo" />
											</div>
										</div>
									</div>
								</div>
								<!-- /.box-body -->
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