<div class="modal fade" id="modalInfo<?php echo $inv['id_inventario'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title text-center"><?php echo $inv['art_nome'] ?></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<a class="btn btn-app" href="<?php echo BASE_URL; ?>inventario/duplicarObra/<?php echo $inv['id_inventario'] ?>">
							<i class="fa fa-object-group"></i> Duplicar
						</a>
					</div>

					<div class="col-md-4">
						<a class="btn btn-app" href="<?php echo BASE_URL; ?>relatorio/getCertificado/<?php echo $inv['id_inventario'] ?>">
							<i class="fa fa-print"></i> Gerar Certificado
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>