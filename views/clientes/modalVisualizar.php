    <div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $cli['id_cliente']; ?>">
        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/cliente/edit_action/<?php echo $cli['id_cliente'] ?>">
            
        <input type="text" class="form-control" style="display:none" name="id_endereco" id="id_endereco" autocomplete="off" value="<?php echo $cli['id_endereco']; ?>">
        <input type="text" class="form-control" style="display:none" name="id_cliente" id="id_cliente" autocomplete="off" value="<?php echo $cli['id_cliente']; ?>">
        <input type="text" class="form-control" style="display:none" name="cliente_nome" id="cliente_nome" autocomplete="off" value="<?php echo $cli['cliente_nome']; ?>">

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
                                                
                                                 
                                                 <input id="cpfcnpj" class="form-control" type="text" placeholder="digite o CPF ou CNPJ" name="cpf" value="<?php echo $cli['cliente_cpf']; ?>" required>

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
                                        <h3 class="box-title">Endereço</h3>
                                    </div>
                                    <div class="box-body" style="">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Rua</label>
                                                <input type="text" class="form-control" name="rua" id="rua" autocomplete="off" value="<?php echo $cli['rua']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Nº</label>
                                                <input type="text" class="form-control" name="numero" id="numero" autocomplete="off" value="<?php echo $cli['numero']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control" name="bairro" id="bairro" autocomplete="off" value="<?php echo $cli['bairro']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" class="form-control" name="cidade" id="cidade" autocomplete="off" value="<?php echo $cli['cidade']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input type="text" class="form-control" name="estado" id="estado" autocomplete="off" value="<?php echo $cli['estado']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input type="text" class="form-control" name="cep" id="cep" autocomplete="off" value="<?php echo $cli['cep']; ?>">
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" class="form-control" name="complemento" id="complemento" autocomplete="off" value="<?php echo $cli['complemento']; ?>">
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