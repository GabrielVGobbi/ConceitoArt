<div class="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalCadastro">
    <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>notas/add_action/">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title fc-center" align="center" id="exampleModalLabel"></h2>
                </div>

                <input type="hidden" class="form-control" name="server" id="server" autocomplete="off" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="modal-body">

                    <div class="box box-default box-solid" id="boxcliente">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border" id="box-header-cliente">
                                    <h3 class="box-title">Cliente</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Selecione o Cliente</label>
                                            <select class="form-control select2" style="width: 100%;" name="cliente" id="cliente_nome" aria-hidden="true" onchange="optionChangeCliente()">
                                                <option value="">Selecione</option>

                                                <?php foreach ($cliente as $cli) : ?>
                                                    <option value="<?php echo $cli['id_cliente']; ?>"><?php echo $cli['cliente_nome'] . ' - ' . $cli['cliente_cpf'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default box-solid" id='boxleilao'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border" id="box-header_leilao">
                                    <h3 class="box-title">Leilão</h3>
                                    <a class="btn btn-sm btn-info pop pull-right" href="<?php echo BASE_URL; ?>leilao?modalcadastro">Add Leilão
                                        <i class="fa fa-fw fa-plus-circle"></i>
                                    </a>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>Selecione o Leilao</label>
                                            <select  class="form-control select2" style="width: 100%;" name="id_leilao" id="id_leilao" aria-hidden="true">
                                                <option value="">Selecione</option>

                                                <?php foreach ($leilao as $lei) : ?>
                                                    <option value="<?php echo $lei['id_leilao']; ?>"><?php echo $lei['leilao_nome']; ?></option>
                                                <?php endforeach; error_log(print_r($lei,1)); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Data do Leilão</label>
                                        <div class="input-group">
                                            <input   type="text" class="form-control" name="leilao_data" id="leilao_data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
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
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool new_objeto"><i class="fa fa-plus-circle"></i></button>
                                    </div>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Nº Lote</label>
                                            <input type="text" class="form-control" name="objeto[lote][]" id="objeto[lote][]" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input type="text" class="form-control" name="objeto[descricao][]" id="objeto[descricao][]" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Valor</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="objeto[quantia][]" name="objeto[quantia][]" required>
                                                <div class="input-group-addon">
                                                    <i class="">R$</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="objeto"> </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>



                <div class="modal-footer">
                    *Revise os Dados antes de Salvar <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
    </form>
</div>
</div>

<script>
    function optionChangeCliente() {

        if ($('#cliente_nome').val() == 0) {

            $("#boxcliente").removeClass("box-success");
            $("#box-header-cliente").removeClass("solid-green");
            $("#boxcliente").addClass("box-default");

        } else {
            $("#boxcliente").addClass("box-success");
            $("#box-header-cliente").addClass("solid-green");
            $("#boxcliente").removeClass("box-default");
        }

    }
</script>