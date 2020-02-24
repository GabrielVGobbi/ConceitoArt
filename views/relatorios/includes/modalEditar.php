<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalEdit<?php echo $inv['id_inventario']; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fc-center" align="center" id="exampleModalLabel"><?php echo $inv['art_nome']; ?></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/inventario/edit_action/<?php echo $inv['id_inventario'] ?>">
					<div style="display: none;" class="box box-default box-solid descricao">

						<div class="row">
							<div class="col-md-12">
								<div class="box-header with-border">
									<h3 class="box-title">Dados da Obra</h3>

								</div>
								<div class="box-body" style="">

									<input type="hidden" class="form-control" name="server" id="server" autocomplete="off" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

									<div class="col-md-8">
										<div class="form-group">
											<label>Titulo</label>
											<input type="text" class="form-control" name="titulo" id="titulo" autocomplete="off" value="<?php echo $inv['inv_descricao']; ?>">
										</div>

										<label for="fl_art_nome">Tecnica</label>
										<div class="form-group">
											<select class="form-control select2" style="width: 100%;" name="id_tecnica" id="id_tecnica">
												<option value="<?php echo $inv['id_tecnica'] ?>"><?php echo ucfirst($inv['nome_tecnica']) ?></option>
												<?php #foreach ($viewData['tecnica'] as $a) : ?>
													<option value="<?php #echo $a['id_tecnica']; ?>"><?php #echo ucfirst($a['nome_tecnica']) ?></option>
												<?php #endforeach; ?>
											</select>
										</div>

										<div class="form-group">
											<label>Tamanho (cm)</label>
											<input type="text" class="form-control" name="tamanho" id="tamanho" autocomplete="off" value="<?php echo $inv['inv_tamanho']; ?>">
										</div>

										<div class="form-group">
											<label>Assinatura</label>
											<input type="text" class="form-control" name="assinatura" id="assinatura" autocomplete="off" value="<?php echo $inv['inv_assinatura']; ?>">
										</div>

										<div class="form-group">
											<label>Data</label>
											<input type="text" class="form-control" name="datado" id="datado" autocomplete="off" value="<?php echo $inv['inv_data']; ?>">
										</div>

										<div class="form-group">
											<label>Tiragem</label>
											<input type="text" class="form-control" name="tiragem" id="tiragem" autocomplete="off" value="<?php echo $inv['inv_tiragem']; ?>">
										</div>

										<div class="form-group">
											<label>Observação</label>
											<input type="text" class="form-control" name="observacao" id="observacao" autocomplete="off" value="<?php echo $inv['inv_observacao']; ?>">
										</div>

									</div>
									<div class="col-md-4">
										<div class="form-group">
											<img src="<?php echo BASE_URL ?>assets/images/anuncios/<?php echo $artista . '/' . $inv['id_inventario'] ?>.jpg" class="img-responsive">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="situacao" style="display: none;">
						<div class="box box-default box-solid">

							<div class="box box-default box-solid">
								<div class="row">
									<div class="col-md-12">
										<div class="box-header with-border">

											<h3 class="box-title">Situação da Obra</h3>


										</div>

										<div class="box-body situation<?php echo $inv['id_inventario'] ?>" style="">

											<?php
												$i = new Inventario;
												$historico = $i->getHistorico($inv['id_inventario'], '');
											?>

											<?php foreach ($historico as $hist) : ?>


												<div class="col-md-2">
													<input type="hidden" name="id_situacao" id="id_situacao" value="<?php echo $hist['id_situacao'] ?>">
													<div class="form-group">
														<label>Situação</label>
														<input type="text" class="form-control" id="edit_situacao" name="edit_situacao" autocomplete="off" value="<?php echo $hist['descricao_situacao']; ?>">
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label>Codigo</label>
														<input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off" value="<?php echo ($hist['codigo']); ?>">
													</div>
												</div>


												<div class="col-md-2">
													<div class="form-group">
														<label>Data</label>
														<input type="text" class="form-control" id="edit_data_situacao" name="edit_data_situacao" autocomplete="off" value="<?php echo $hist['data_situacao']; ?>">
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label>Preço Bruto</label>
														<input type="text" class="form-control" id="edit_preco_bruto" name="edit_preco_bruto" autocomplete="off" value="R$ <?php echo ($hist['preco_bruto'] != '' ? number_format($hist['preco_bruto'], 2, ',', '.') : '') ?>">
													</div>
												</div>


												<div class="col-md-2">
													<div class="form-group">
														<label>Preço</label>
														<input type="text" class="form-control" id="codigo" name="edit_preco_situacao" autocomplete="off" value="R$ <?php echo ($hist['preco_situacao'] != '' ? number_format($hist['preco_situacao'], 2, ',', '.') : '') ?>">
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group <?php echo ($hist['situacao_char'] == 1 ? 'has-error'  : ''); ?>">
														<label>Venda</label>
														<select class="form-control " id="edit_venda_situacao" name="edit_venda_situacao" style="<?php echo ($hist['situacao_char'] == 1 ? 'color: #ff0909;'  : ''); ?>">
															<?php if ($hist['situacao_char'] == 1) : ?>
																<option selected="selected" value="1"> Vendido</option>
																<option value="0">Não vendido</option>
																<option value="2"> Defendido</option>
															<?php elseif ($hist['situacao_char'] == 0) : ?>
																<option selected="selected" value="0">Não vendido</option>
																<option value="1"> Vendido</option>
																<option value="2"> Defendido</option>
															<?php else : ?>
																<option value="0">Não vendido</option>
																<option value="1"> Vendido</option>
																<option selected="selected" value="2"> Defendido</option>
															<?php endif; ?>
														</select>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>

		</div>
	</div>