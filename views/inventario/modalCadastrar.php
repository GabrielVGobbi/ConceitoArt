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
            <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>inventario/add_action">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Artista</label>
                            <div class="input-group">
                                <input type="hidden" name="id_artista" id="id_artista" class="form-control">
                                <input type="text" class="form-control" name="artista" id="artista" required data-type="search_artista" required="" autocomplete="off">
                                <span onclick="add_artista()" style="cursor: pointer;border-color: #f00;border-left: 1%;" class="input-group-addon span-artist"><i class="fa fa-check has-error"></i></span>
                            </div>
                            <div id="art" type="hidden">

                                <span class="span-dropdown">
                                    <span class="span-dropdown-2">
                                        <ul class="ul-span-dropdown">
                                            <div class="searchresultsArtista">

                                            </div>
                                        </ul>
                                    </span>
                                </span>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Tecnica</label>
                            <div class="input-group">
                                <input type="hidden" name="id_tecnica" id="id_tecnica" class="form-control">
                                <input type="text" class="form-control" name="tecnica" id="tecnica" required data-type="search_tecnica" required="" autocomplete="off">
                                <span onclick="add_tecnica()" style="cursor: pointer;border-color: #f00;border-left: 1%;" class="input-group-addon span-tecnica"><i class="fa fa-check"></i></span>
                            </div>
                            <div id="art" type="hidden">

                                <span class="span-dropdown">
                                    <span class="span-dropdown-2">
                                        <ul class="ul-span-dropdown">
                                            <div class="searchresultsTecnica">

                                            </div>
                                        </ul>
                                    </span>
                                </span>

                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Assinatura</label>
                                <input type="text" class="form-control" name="assinatura" id="assinatura" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tamanho</label>
                                <input type="text" class="form-control" name="tamanho" id="tamanho" autocomplete="off">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Data</label>
                                <input type="text" class="form-control" name="datado" id="datado" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tiragem</label>
                                <input type="text" class="form-control" name="tiragem" id="tiragem" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Observação </label>
                                <input type="text" class="form-control" name="observacao" id="observacao" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Localização da Obra </label>
                                <input type="text" class="form-control" name="localizacao" id="localizacao" autocomplete="off">
                            </div>
                        </div>


                    </div>

                    <div class="box box-default box-solid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Procêdencia de Compra</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Procêdencia</label>
                                            <input type="text" class="form-control" name="procedencia" id="procedencia" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="text" class="form-control" name="data_procedencia" id="data_procedencia" data-inputmask="'alias': 'mm/yyyy'" data-mask="">

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input type="text" class="form-control" name="preco_procedencia" id="preco_procedencia" autocomplete="off">
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
                                    <h3 class="box-title">Situação</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input type="text" class="form-control" name="descricao_situacao" id="descricao" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <input type="text" class="form-control" name="data_situacao" id="data_situacao" data-inputmask="'alias': 'mm/yyyy'" data-mask="">

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input type="text" class="form-control" name="preco_situacao" id="preco_situacao" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input type="text" class="form-control" name="leilao_codigo_foto" id="leilao_codigo_foto" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Venda</label>
                                            <select class="form-control select2 select2-hidden-accessible" name="situacao_char" id="situacao_char" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option value="1">Vendido</option>
                                                <option selected="selected" value="0">Não vendido</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotos">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Foto
                            <input type="file" name="fotos[]" multiple />
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