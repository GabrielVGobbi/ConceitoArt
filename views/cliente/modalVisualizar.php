    <div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $cli['id_cliente']; ?>">
        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/cliente/edit_action/<?php echo $cli['id_cliente'] ?>">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title fc-center" align="center" id=""><?php echo $cli['cliente_nome']; ?></h2>
                    </div>

                    <div class="modal-body">
                        <div class="box box-default box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Dados</h3>
                                    </div>
                                    <div class="box-body" style="">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="email" autocomplete="off" value="<?php echo $cli['cliente_email']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>RG</label>
                                                <input type="text" class="form-control" name="rg" id="rg" autocomplete="off" value="<?php echo $cli['cliente_rg']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CPF</label>
                                                <input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" value="<?php echo $cli['cliente_cpf']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="box box-default box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">oBRAS</h3>
                                    </div>
                                    <div class="box-body" style="">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="email" autocomplete="off" value="<?php echo $cli['cliente_email']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>RG</label>
                                                <input type="text" class="form-control" name="rg" id="rg" autocomplete="off" value="<?php echo $cli['cliente_rg']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CPF</label>
                                                <input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" value="<?php echo $cli['cliente_cpf']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>