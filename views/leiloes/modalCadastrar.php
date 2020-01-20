<div class="modal fade bd-example-modal-lg" id="modalCadastro<?php echo ucfirst($viewData['pageController']) ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title fc-center" align="center" id="">Cadastro de Leilão</h2>
            </div>


            <div class="box box-default ">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar</h3>
                </div>
                <div class="modal-body">
                    <?php if ($this->userInfo['userName']['id_company'] == 2) : ?>

                        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>leilao/add_action">
                            <div class="box box-default box-solid">
                                <div class="box-body" style="">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nome do Leilão</label>
                                                    <input type="text" class="form-control" name="leilao_nome" id="leilao_nome" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Leilão endereço</label>
                                                    <input type="text" class="form-control" name="leilao_endereco" id="leilao_endereco" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>

                    <?php else : ?>
                        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>leilao/add_action">
                            <div class="box box-default box-solid">
                                <div class="box-body" style="">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nome do Leilão</label>
                                                    <input type="text" class="form-control" name="leilao_nome" id="leilao_nome" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Leilão Preço</label>
                                                    <input type="text" class="form-control" name="leilao_preco" id="leilao_preco" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Leilão Compras</label>
                                                    <input type="text" class="form-control" name="leilao_compras" id="leilao_compras" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
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