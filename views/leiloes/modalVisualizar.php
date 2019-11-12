    <div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $cli['id_leilao']; ?>">
        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/leilao/edit_action/<?php echo $cli['id_leilao'] ?>">
            
        <input type="text" class="form-control" style="display:none" name="id_endereco" id="id_endereco" autocomplete="off" value="<?php echo ( isset($cli['leilao_endereco'])) ? $cli['leilao_endereco'] : ''; ?>">
        <input type="text" class="form-control" style="display:none" name="id_leilao" id="id_leilao" autocomplete="off" value="<?php echo $cli['id_leilao']; ?>">
        <input type="text" class="form-control" style="display:none" name="leilao_nome" id="leilao_nome" autocomplete="off" value="<?php echo $cli['leilao_nome']; ?>">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title fc-center" align="center" id=""><?php echo $cli['leilao_nome']; ?></h2>
                    </div>

                    <div class="modal-body">
                        <div class="box box-default box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Dados</h3>
                                    </div>
                                    <div class="box-body" style="">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" name="leilao_nome" id="leilao_nome" autocomplete="off" value="<?php echo $cli['leilao_nome']; ?>">
                                            </div>
                                        </div>

                                         <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <input type="text" class="form-control" name="leilao_endereco" id="leilao_endereco" autocomplete="off" value="<?php echo ( isset($cli['leilao_endereco'])) ? $cli['leilao_endereco'] : ''; ?>">
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

<script type="text/javascript">
    var maskCpfOuCnpj = IMask(document.getElementById('cpfcnpj'), {
            mask:[
                {
                    mask: '000.000.000-00',
                    maxLength: 11
                },
                {
                    mask: '00.000.000/0000-00'
                }
            ]
        });

</script>