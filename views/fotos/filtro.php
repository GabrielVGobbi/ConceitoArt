<div class="col-xs-12">

	<div class="box box-default box-solid collapsed">
		<a type="button" style="cursor: pointer;" data-widget="collapse">
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
								<input class="form-control" id="filtro_id_cliente" name="filtros[id_inventario]" placeholder="" autocomplete="off">
							</div>
						</div>

						<div class="col-md-8">
							<label for="fl_art_nome">Artista</label>
							<div class="form-group">
								<input class="form-control" id="filtro_cliente_Nome" name="filtros[art_nome]" placeholder="" autocomplete="off">

							</div>
						</div>
						<div class="col-md-12">
							<label for="fl_art_nome">Inventario</label>
							<div class="form-group">
								<select class="form-control select2 " multiple style="width: 100%;" name="filtros[inventario][]" id="filtros[inventario]">
									<?php foreach ($viewData['inventario'] as $inv) : ?>
										<option  value="<?php echo $inv['id_inventario']; ?>"><?php echo $inv['id_inventario'];?> - <?php echo $inv['art_nome'] ?></option>
									<?php endforeach; ?>
								</select>
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