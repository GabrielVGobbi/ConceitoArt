
<div class="box box-default box-solid no-padding" style="display: none;" id="gerar_recibo_page">
	<div class="row">
		<div class="col-md-12">
			<form method="GET" action="<?php echo BASE_URL?>relatorio/getRecibo">
				<div class="box-header with-border">
					<h3 class="box-title">Opções Para Geração de Recibo</h3>
				</div>

				<div class="box-body" style="">
					<div class="box box-default color-palette-box">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tag"></i> Contribuidor</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label>Nome do Contribuidor</label>
										<input type="text" class="form-control" name="nome" id="nome" autocomplete="off" value="Marcio Gobbi Fernandes" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>CPF</label>
										<input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" value="264.295.538-92" required>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Endereço</label>
										<input type="text" class="form-control" name="endereco" id="endereco" autocomplete="off" value="Rua dos Franceses 125 - Bela Vista - São Paulo - SP - CEP: 01329-01" >
									</div>
								</div>
							</div>
							<div class="row">

							</div>
						</div>		
					</div>

					<div class="box box-default color-palette-box">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tag"></i> Recebidor</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label>Nome do Recebidor</label>
										<input type="text" class="form-control" name="nome_r" id="nome_r" autocomplete="off" value="" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>CPF</label>
										<input type="text" class="form-control" name="cpf_r" id="cpf_r" autocomplete="off" value="" required>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Endereço</label>
										<input type="text" class="form-control" name="endereco_r" id="endereco_r" autocomplete="off" >
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label>RG</label>
										<input type="text" class="form-control" name="rg_r" id="rg_r" autocomplete="off" >
									</div>
								</div>

							</div>

						</div>		
					</div>

					<div class="box box-default color-palette-box">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tag"></i> Dados</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Obras</label>
										<select class="form-control select2" multiple="multiple" style="width: 100%;" name="obras[]" id="obras[]" aria-hidden="true" required>

											<?php foreach ($viewData['obras'] as $inv): ?>
												<option value="<?php echo $inv['id_inventario'];?>"  ><?php echo $inv['id_inventario'].' - '.$inv['art_nome'] ?></option>
											<?php endforeach; ?>
										</select> 
									</div>
								</div>	

								<div class="col-md-4">
									<div class="form-group">
										<label>Quantia</label>

										<div class="input-group">
											<input type="text" class="form-control" id="quantia" name="quantia" required>

											<div class="input-group-addon">
												<i class="">R$</i>
											</div>
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
</div>