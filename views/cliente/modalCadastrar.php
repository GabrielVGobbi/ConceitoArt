<div class="col-xs-12">

    <div class="box box-default box-solid collapsed-box">
        <a type="button" style="cursor: pointer;" data-widget="collapse">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastrar</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </a>

        <div class="box-body" style="">
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>cliente/add_action">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="cliente_nome" id="cliente_nome" required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" data-inputmask="'mask': ['999.999.999-99']" data-mask>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>RG</label>
                                <input type="text" class="form-control" name="rg" id="rg" autocomplete="off" data-inputmask="'mask': ['99.999.999-9']" data-mask>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="endereco" id="endereco" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

