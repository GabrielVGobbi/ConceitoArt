<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Usuario</h3>
		<div class="box-tools pull-right">
			<div class="has-feedback">
				<input type="text" class="form-control input-sm" placeholder="Buscar">
				<span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		</div>
	</div>

	<div class="box-body no-padding">
		<div class="table-responsive mailbox-messages">
			<table class="table table-hover table-striped">
				<tbody>
					<div class="box">
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover">
								<tbody>
									<tr>
										<th style="width: 22%;">Ações</th>
										<th>ID</th>
										<th>Usuario</th>
										<th>Email</th>
									</tr>
									<?php foreach ($tableInfo as $inf): ?>
										<tr>
											<td>
												<?php if($this->user->hasPermission('user_view')): ?>
													<a type="button" class="btn btn-info" 	href="<?php echo BASE_URL?>usuario/edit/<?php echo $inf['id'] ?>"><i class="fa fa-fw fa-edit"></i></a>
												<?php endif; ?>
												<?php if($this->user->hasPermission('user_delet')): ?>
													<a type="button" class="btn btn-danger" href="<?php echo BASE_URL?>usuario/delet/<?php echo $inf['id'] ?>"><i class="fa fa-fw fa-trash"></i></a>
												<?php endif; ?>
												<?php if($inf['usu_ativo'] == ATIVO): ?>
													<a type="button" class="btn btn-success"><i class="fa fa-fw fa-toggle-on"></i></a>
												<?php else: ?>
													<a type="button" class="btn btn-default"><i class="fa fa-fw fa-toggle-off"></i></a>
												<?php endif; ?>
											</td>
											<td><?php echo $inf['id'] ?></td>
											<td><?php echo $inf['login'] ?></td>
											<td><?php echo $inf['email'] ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</tbody>
			</table>
		</div>	
	</div>
	<div class="box-footer no-padding">

	</div>
</div>