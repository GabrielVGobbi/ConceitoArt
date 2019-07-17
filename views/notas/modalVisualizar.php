<div class="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $not['id_nota']; ?>">
    <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/inventario/edit_action/<?php echo $not['id_nota'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title fc-center" align="center" id="exampleModalLabel"><?php echo $not['nota_numero']; ?></h2>
                </div>

                <input type="hidden" class="form-control" name="server" id="server" autocomplete="off" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="modal-body">
                    <div class="box box-default box-solid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cliente</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" disabled name="nota_cliente_nome" id="nota_cliente_nome" autocomplete="off" value="<?php echo $not['cliente_nome'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" disabled name="nota_cliente_email" id="nota_cliente_email" autocomplete="off" value="<?php echo $not['cliente_email'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input type="text" class="form-control" disabled name="nota_cliente_cpf" id="nota_cliente_cpf" autocomplete="off" value="<?php echo $not['cliente_cpf'] ?>">
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
                                    <h3 class="box-title">Leilão</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input type="text" class="form-control" disabled name="leilao_descricao" id="leilao_descricao" value="<?php echo $not['leilao_descricao']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" class="form-control" disabled name="leilao_endereco" id="leilao_endereco" value="<?php echo $not['leilao_endereco']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Data do Leilão</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" disabled name="leilao_data" id="leilao_data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?php echo $not['leilao_data']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Data da Nota</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" disabled name="nota_data" id="nota_data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?php echo $not['nota_data']; ?>">
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
                                    <h3 class="box-title">Objetos</h3>
                                </div>
                                <div class="box-body" style="">
                                    <?php $objeto_nota = $this->notas->getObjetosByNota($not['id_nota']); ?>
                                    <?php foreach ($objeto_nota as $notObj) : ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Nº Lote</label>
                                                <input type="text" class="form-control" disabled value="<?php echo $notObj['obj_lote']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <input type="text" class="form-control" disabled value="<?php echo $notObj['obj_descricao']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Quantia</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled value="<?php echo $notObj['obj_valor']; ?>">
                                                    <div class="input-group-addon">
                                                        <i class="">R$</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">

                    <a href="<?php echo BASE_URL; ?>notas/GerarNota/<?php echo $not['id_nota']; ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Gerar Nota
                    </a>
                </div>
            </div>
    </form>
</div>
</div>