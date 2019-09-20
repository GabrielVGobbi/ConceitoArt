<div class="modal fade bd-example-modal-lg" id="modalCadastro" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title fc-center" align="center" id="">Cadastro de Cliente</h2>
            </div>


            <div class="box box-default ">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar</h3>

                </div>
                <div class="modal-body">
                    <div class="box box-default box-solid">
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

                                        <div class="col-md-4" id="cpf_campo">
                                            <div class="form-group" id="">
                                                <label>CPF/CPNJ</label>
                                                <input id="cpfcnpj" class="form-control" type="text" placeholder="digite o CPF ou CNPJ" name="cpf" required>
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
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>CEP</label>
                                                            <input type="text" class="form-control" name="cep" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" data-inputmask="'mask': ['99999-999']" data-mask>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Rua</label>
                                                            <input type="text" class="form-control" name="rua" id="rua" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Nº</label>
                                                            <input type="text" class="form-control" name="numero" id="numero" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Bairro</label>
                                                            <input type="text" class="form-control" name="bairro" id="bairro" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Cidade</label>
                                                            <input type="text" class="form-control" name="cidade" id="cidade" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Estado</label>
                                                            <input type="text" class="form-control" name="estado" id="uf" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Complemento</label>
                                                            <input type="text" class="form-control" name="complemento" id="complemento" value="">
                                                        </div>
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
                        </form>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                var maskCpfOuCnpj = IMask(document.getElementById('cpfcnpj'), {
                    mask: [{
                            mask: '000.000.000-00',
                            maxLength: 11
                        },
                        {
                            mask: '00.000.000/0000-00'
                        }
                    ]
                });

                function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('rua').value = ("");
                    document.getElementById('bairro').value = ("");
                    document.getElementById('cidade').value = ("");
                    document.getElementById('uf').value = ("");
                }

                function meu_callback(conteudo) {
                    if (!("erro" in conteudo)) {
                        //Atualiza os campos com os valores.
                        document.getElementById('rua').value = (conteudo.logradouro);
                        document.getElementById('bairro').value = (conteudo.bairro);
                        document.getElementById('cidade').value = (conteudo.localidade);
                        document.getElementById('uf').value = (conteudo.uf);

                    } //end if.
                    else {
                        //CEP não Encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                }

                function pesquisacep(valor) {

                    //Nova variável "cep" somente com dígitos.
                    var cep = valor.replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if (validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            document.getElementById('rua').value = "...";
                            document.getElementById('bairro').value = "...";
                            document.getElementById('cidade').value = "...";
                            document.getElementById('uf').value = "...";


                            //Cria um elemento javascript.
                            var script = document.createElement('script');

                            //Sincroniza com o callback.
                            script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                            //Insere script no documento e carrega o conteúdo.
                            document.body.appendChild(script);

                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                };
            </script>
        </div>


    </div>
</div>