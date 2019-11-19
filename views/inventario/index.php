<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo ucfirst($viewData['pageController']); ?></h3>
            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalCadastro">
                        <i class="fa fa-fw fa-plus-circle"></i> Novo
                    </button>
                </div>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped table-bordered">
                    <tbody>
                        <div class="box">
                            <div class="box-body table-responsive no-padding">
                                <table id="table" class="table table-hover table-bordered dataTable" style="width:100%">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 12%;"> Ação </th>
                                            <th style="width: 27%;"> Artista </th>
                                            <th style="width: 80%;>" Descrição </th> <th> Situação </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer no-padding"></div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title fc-center" align="center">/h2>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="box box-default box-solid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Dados</h3>
                                </div>
                                <div class="box-body" style="">

                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label for="">Nome da Etapa</label>
                                            <input class="form-control" name="nome_etapa" value="" placeholder="Nome da Etapa">

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <label for="">Quantidade</label>
                                            <input class="form-control" name="quantidade" value="" placeholder="Nome da Etapa">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <label for="">Tipo</label>
                                            <input class="form-control" name="tipo_compra" value="" placeholder="Nome da Etapa">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <label for="">Preço</label>
                                            <input class="form-control" name="preco" value="" placeholder="Nome da Etapa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Variaveis</h3>

                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body" id="variavel_etapa">
                            
                                

                        </div>

                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    function edit_obra(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        //Ajax Load data from ajax
        $.ajax({
            url: BASE_URL + 'ajax/getInventarioById/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id_inventario);
                $('#modal_form').modal('show');
                $('.modal-title').text('"' + data.art_nome + '"');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            },
        });
    
    }

    
</script>