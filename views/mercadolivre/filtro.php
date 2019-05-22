

<div class="col-xs-12">
	<a type="button" style="cursor: pointer;" data-widget="collapse">
		<div class="box box-default box-solid collapsed">

			<div class="box-header with-border">
				<h3 class="box-title">Buscar</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		</a>
		
		<div class="box-body" style="">
			<form method="GET">
				<div class="box-body">
					<div class="row">
						<div class="col-md-1">
							<div class="form-group">
								<label for="fl_art_nome">ID</label>
								<input class="form-control" id="filtro_id_inventario" name="filtros[id_inventario]" placeholder="" autocomplete="off">
							</div>
						</div>

						<div class="col-md-7">
							<label for="fl_art_nome">Artista</label>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="filtros[artista]" id="filtros[artista]">
									<option selected="selected" value="0">Selecione </option>
									<?php foreach ($viewData['artista'] as $a): ?>
										<option value="<?php echo $a['art_nome'];?>"  ><?php echo $a['art_nome'] ?></option>
									<?php endforeach; ?>
								</select> 
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="fl_art_nome">Descrição</label>
								<input class="form-control" id="filtro_descricao" name="filtros[titulo]" placeholder="" autocomplete="off">
							</div>
						</div>

						

					</div>
					
					<div class="pull-right">
						<button type="submit" class="btn btn-primary">Buscar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
