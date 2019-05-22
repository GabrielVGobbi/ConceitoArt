
<?php include_once("filtro.php"); ?>
<?php include("cadastro.php"); ?>
<div class="col-sm-12">
	<div class="row">
	<div class="box box-primary">
		<div class="box-header" style="margin-bottom: 10px;">
			<h3 class="box-title">Obras</h3>

			<div class="box-tools pull-right">
				<div class="has-feedback">
					<a href="<?php echo BASE_URL;?>inventario" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
					<a type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm"><i class="fa fa-fw fa-file-excel-o"></i></a>
				</div>
			</div>
		</div>
		
		<div class="box-body no-padding " style="margin-bottom: 10px;">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered ">
					<?php if(count($tableDados) > 0): ?>
						<tbody>
							<thead class="thead-dark">
								<tr>
									<th class="scope"><input type="checkbox" id="marcarTodos" /></th>
									<th class="scope" style="    width: 10%;">Ação</th>
									<th class="scope" style="width: 38%;">Imagem / Artista</th>
									<th class="scope">Descrição</th>
									<th class="text-center" style="width: 2%;">Situação</th>
								</tr>
							</thead>
							<?php foreach ($tableDados as $inv ): ?>
								<?php $artista = str_replace(' ','_',$inv['art_nome']);?>
								<tr <?php echo ($inv['inv_venda'] == '1') ? 'class="table-danger"' : ''?>> 
									<td style="width:4%;padding-left: 14px;">
										<input type="checkbox" value="<?php echo $inv['id_inventario']?>"  name="check[]" class="check">
									</td>
									<td class="button_edit_delet" >
										<button class="btn btn-sm btn-danger pop"  data-toggle="popover" title="Remover?" data-content="<a href='<?php echo BASE_URL;?>inventario/delete/<?php echo $inv['id_inventario']?>' class='btn btn-danger'>Sim</a> <button type='button' class='btn btn-default pop-hide'>Não</button>" >
										<i class="fa fa-fw fa-close"></i>

										<button class="btn btn-sm btn-info pop"  data-toggle="popover" title="Duplicar?" data-content="<a href='<?php echo BASE_URL;?>inventario/duplicarObra/<?php echo $inv['id_inventario']?>' class='btn btn-danger'>Sim</a> <button type='button' class='btn btn-default pop-hide'>Não</button>" >
										<i class="fa fa-fw fa-info"></i>
									</td>
									<td class="button_edit_delet_mobile">

										<button class="btn btn-sm btn-danger pop"  data-toggle="popover" title="Remover?" data-content="<a href='<?php echo BASE_URL;?>inventario/delete/<?php echo $inv['id_inventario']?>' class='btn btn-danger'>Sim</a> <button type='button' class='btn btn-default pop-hide'>Não</button>" >
										<i class="fa fa-fw fa-close"></i>
									</button>

									<button class="btn btn-sm btn-info pop"  data-toggle="popover" title="Duplicar?" data-content="<a href='<?php echo BASE_URL;?>inventario/duplicarObra/<?php echo $inv['id_inventario']?>' class='btn btn-danger'>Sim</a> <button type='button' class='btn btn-default pop-hide'>Não</button>" >
										<i class="fa fa-fw fa-info"></i>
									</td>
									<td class=""><a href=""></a>
										<?php 
										$img = $this->inventario->getImagesByProductId($inv['id_inventario']);
										
										?>
										<?php if(!file_exists('assets/images/anuncios/'.$artista.'/'.$inv['id_inventario'].'.jpg')): ?>
												<?php if(!empty($img[0]['url'] && $img[0]['url'] != '')): ?>
													<img src="<?php echo BASE_URL?>assets/images/anuncios/<?php echo $artista ?>/<?php echo $img[0]['url'] ?>" class="img-table" style="    max-width: 17%;
    max-height: 25%;" /> 
												<?php else: ?>
												
												<?php endif; ?>

											<?php else: ?>
												<img src="<?php echo BASE_URL?>assets/images/anuncios/<?php echo $artista.'/'.$inv['id_inventario'] ?>.jpg" style="    max-width: 17%;
    max-height: 25%;" >
											<?php endif; ?>
										- <?php echo $inv['id_inventario'].' - '. $inv['art_nome']; ?> 
									</td>
									<td class="" onclick="verInventario(<?php echo $inv['id_inventario']; ?>)">
										<?php 
										echo ( $inv['inv_descricao'] != null ? $inv['inv_descricao'].' - ' : "" );
										echo ( ucfirst($inv['nome_tecnica']) != null ? ucfirst($inv['nome_tecnica']).' - ' : "" );
										echo ( $inv['inv_assinatura'] != null ? $inv['inv_assinatura'].' - ' : "" );
										echo ( $inv['inv_data'] != null ? $inv['inv_data'].' - ' : "" );
										echo ( $inv['inv_tamanho'] != null ? $inv['inv_tamanho'] : "" );
										echo ( $inv['inv_tiragem'] != null ? ' - '.$inv['inv_tiragem'] : "" );
										?> 
									</td>
									<td><?php echo ($inv['inv_venda'] == '1') ? '<span class="label label-danger">Vendido</span>' : '<span class="label label-success">Não Vendido</span>'?> </td>
								</tr>
							<?php include ("modalVisualizar.php"); ?>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form action="<?php echo BASE_URL?>relatorio/importar" method="POST" enctype="multipart/form-data">

						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Importar Obras</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<input type="file" name="arquivo" multiple /> </br>
						<!-- <label>Importar Leilão</label>
							<input type="checkbox" name="import" id="import" value="importarLeilao" /> <br> -->
							<label>Importar Tableau</label>
							<input type="checkbox" name="leilao" id="leilao" value="1" /></br>
							<label>Importar Marcia</label>
							<input type="checkbox" name="leilao" id="leilao" value="2" />

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
