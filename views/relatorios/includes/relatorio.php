
<div class="box box-default box-solid no-padding" style="display: all;" id="gerar_relatorio_page">
	<div class="row">
		<div class="col-md-12">
			<form method="GET" action="<?php echo BASE_URL?>relatorio/getRelatorio">
				<div class="box-header with-border">
					<h3 class="box-title">Geração de Relatorio</h3>
				</div>

				<div class="box-body" style="margin-bottom: 20px;">
					<div class="box box-default color-palette-box">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tag"></i> Opções</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
								<!-- <div class="col-md-4">
										<label for="fl_art_nome">Tipo de Relatório</label>
										<div class="form-group">

											<select class="form-control select2" style="width: 100%;" name="tpi_relatorio" id="tpi_relatorio" onchange="tpiRelatorio()">
												<option>Escolha o tipo de Relatório</option>
												<option value="rel_venda"  >Relatório de Venda</option>
												<option value="rel_compra"  >Relatório de Compra</option>
											</select>
										</div>
									</div>
								-->

								<div class="form-group">
									<label>Titulo da Página</label>
									<input type="text" class="form-control" name="titulo" id="titulo" autocomplete="off">
								</div>
								

							</div>
						</div>
						<div class="row">
							<div id="rel_venda" style="display: ;">
								<div class="col-md-4">
									<label for="fl_art_nome">Artista</label>
									<div class="form-group">

										<select class="form-control select2" style="width: 100%;" name="filtros[artista]" id="filtros[artista]">
											<option value="">nenhum</option>
											<?php foreach ($artista as $a): ?>
												<option value="<?php echo $a['art_nome'];?>"  ><?php echo $a['art_nome'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>


								<div class="col-md-4">
									<label for="fl_art_nome">Situacão</label>
									<div class="form-group">
										<select class="form-control select2" style="width: 100%;" name="filtros[situacao]" id="filtros[situacao]" onchange="optionChange()">
											<option value="0">nennhum</option>
											<?php foreach ($viewData['descricao_name'] as $v): ?>
												<option value="<?php echo trim($v['descricao_situacao']);?>"  ><?php echo $v['descricao_situacao'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="venda_div" style="display: none;">
									<label for="fl_art_nome" >Venda</label>
									<div class="form-group">
										<select class="form-control select2" style="width: 100%;" name="filtros[venda]" id="filtros[venda]">
											<option value="">Todos</option>
											<option value="sim">Sim</option>
											<option value="nao">Não</option>
										</select>
									</div>
								</div>

								<div class="col-md-2">
									<label>Data:</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control" name="filtros[data]" id="filtros[data]" data-inputmask="'alias': 'mm/yyyy'" data-mask="">
									</div>
								</div>

							</div>
						</div>
					</div>	

				</div>

				<div class="pull-right">
					<button type="submit" class="btn btn-primary">Emitir</button>
				</div>
			</div>
		</form>
	</div>
</div>
