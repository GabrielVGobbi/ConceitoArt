<?php
$i = new Inventario;
$historico = $i->getHistorico($inv['id_inventario'], '');


?>



<div class="modal" role="dialog" z-index="99999" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $inv['id_inventario']; ?>">
    <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>/inventario/edit_action/<?php echo $inv['id_inventario'] ?>">
        <div style="float: right;">
            <?php $proximo = $i->getPage($inv['id_inventario'], 'proximo', $viewData['filtro']);?>
            <span onclick="changeModalInventario(<?php echo $proximo?>,<?php echo $inv['id_inventario']; ?>)" style="top: 400px;right: 67px;padding: 0px;font-size: 73px;color: #fff;" class="glyphicon glyphicon-chevron-right"></span>
        </div>
        <div style="float: left;">
            <?php $anterior = $i->getPage($inv['id_inventario'], 'anterior', $viewData['filtro']);?>
            <span onclick="changeModalInventario(<?php echo $anterior?>,<?php echo $inv['id_inventario']; ?>)" style="top: 400px;left: 67px;padding: 0px;font-size: 73px;color: #fff;" class="glyphicon glyphicon-chevron-left"></span></a>
        </div>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title fc-center" align="center" id="exampleModalLabel"><?php echo $inv['art_nome']; ?></h2>


                </div>

                <input type="hidden" class="form-control" name="server" id="server" autocomplete="off" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <input type="hidden" class="form-control" name="id_artista" id="id_artista" autocomplete="off" value="<?php echo $inv['id_artista']; ?>">

                <div class="modal-body">

                    <div class="box-header with-border">
                        <ul class="nav nav-tabs">
                            <li class="active"><a onclick="dados_obra(<?php echo $inv['id_inventario'] ?>)" data-toggle="tab">Dados</a></li>
                            <li><a onclick="fotos_obra(<?php echo $inv['id_inventario'] ?>)" data-toggle="tab">Fotos</a></li>
                        </ul>
                    </div>

                    <div id="dados_obras<?php echo $inv['id_inventario'] ?>">
                        <div class="box box-default box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-body" style="">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Titulo</label>
                                                <input type="text" class="form-control" name="titulo" id="titulo" autocomplete="off" value="<?php echo $inv['inv_descricao']; ?>">
                                            </div>

                                            <label for="fl_art_nome">Tecnica</label>
                                            <div class="form-group">
                                                <select class="form-control select2" style="width: 100%;" name="id_tecnica" id="id_tecnica">
                                                    <option value="<?php echo $inv['id_tecnica'] ?>"><?php echo ucfirst($inv['nome_tecnica']) ?></option>
                                                    <?php foreach ($viewData['tecnica'] as $a) : ?>
                                                        <option value="<?php echo $a['id_tecnica']; ?>"><?php echo ucfirst($a['nome_tecnica']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Tamanho (cm)</label>
                                                <input type="text" class="form-control" name="tamanho" id="tamanho" autocomplete="off" value="<?php echo $inv['inv_tamanho']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Assinatura</label>
                                                <input type="text" class="form-control" name="assinatura" id="assinatura" autocomplete="off" value="<?php echo $inv['inv_assinatura']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Data</label>
                                                <input type="text" class="form-control" name="datado" id="datado" autocomplete="off" value="<?php echo $inv['inv_data']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Tiragem</label>
                                                <input type="text" class="form-control" name="tiragem" id="tiragem" autocomplete="off" value="<?php echo $inv['inv_tiragem']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Observação</label>
                                                <textarea type="text" class="form-control" name="observacao" id="observacao" autocomplete="off"><?php echo $inv['inv_observacao']; ?></textarea>
                                            </div>

                                            <?php if ($this->userInfo['user']->hasPermission('mercadolivre_view')) : ?>
                                                <div class="form-group">
                                                    <label>Preço</label>
                                                    <input type="text" class="form-control" name="preco" id="preco" autocomplete="off" value="R$ <?php echo ($inv['inv_price_venda'] != '' ? number_format($inv['inv_price_venda'], 2, ',', '.') : '') ?>">
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php $this->loadImg($inv, true); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="btn btn-default btn-file">
                                                    <i class="fa fa-paperclip"></i> Foto
                                                    <input type="file" name="fotos[]" multiple>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4" style="    margin-top: 96px;">
                                            <div class="form-group">
                                                <label>Localização</label>
                                                <input type="text" class="form-control" name="localizacao" id="localizacao" autocomplete="off" value="<?php echo $inv['inv_localizacao']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $proc = controller::getProcedencia($inv['id_inventario']); ?>
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
                                                <input type="text" class="form-control" name="procedencia" id="procedencia" autocomplete="off" value="<?php echo $proc['descricao']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Data</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="data_procedencia" id="data_procedencia" data-inputmask="'alias': 'mm/yyyy'" data-mask="" value="<?php echo $proc['data']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Preço</label>
                                                <?php if ($proc['inventario_preco'] == '') : ?>
                                                    <input type="text" class="form-control" name="preco_procedencia" id="preco_procedencia" autocomplete="off" value="R$ <?php echo ($proc['inventario_preco'] != '' ? number_format($proc['inventario_preco'], 2, ',', '.') : '') ?>">
                                                <?php else : ?>
                                                    <input type="text" class="form-control" name="preco_procedencia" id="preco_procedencia" autocomplete="off" value="R$ <?php echo ($proc['inventario_preco'] != '' ? number_format($proc['inventario_preco'], 2, ',', '.') : '') ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="box box-default box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border" style="margin-bottom: 20px;">
                                        <h3 class="box-title">Situação</h3>
                                    </div>
                                    <?php if (count($historico) > 0) : ?>
                                        <?php foreach ($historico as $hist) : ?>
                                            <div class="box-body" style="margin-top: -20px;">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="id_situacao" id="id_situacao" value="<?php echo $hist['id_situacao'] ?>">
                                                    <div class="form-group">
                                                        <label>Situação</label>
                                                        <input type="text" class="form-control" id="edit_situacao" name="edit_situacao" autocomplete="off" value="<?php echo $hist['descricao_situacao']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Data</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="edit_data_situacao" id="edit_data_situacao" data-inputmask="'alias': 'mm/yyyy'" data-mask="" value="<?php echo $hist['data_situacao']; ?>">
                                                    </div>
                                                </div>
                                                <?php if ($hist['situacao_char'] == 1) : ?>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Preço Bruto</label>
                                                            <input type="text" class="form-control" id="edit_preco_bruto" name="edit_preco_bruto" autocomplete="off" value="R$ <?php echo ($hist['preco_bruto'] != '' ? number_format($hist['preco_bruto'], 2, ',', '.') : '') ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Preço de Venda</label>
                                                        <input type="text" class="form-control" id="edit_preco_situacao" name="edit_preco_situacao" autocomplete="off" value="R$ <?php echo ($hist['preco_situacao'] != '' ? number_format($hist['preco_situacao'], 2, ',', '.') : '') ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Retirada</label>
                                                        <input type="text" class="form-control" id="edit_retirada" name="edit_retirada" autocomplete="off" value="<?php echo $hist['retirada']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group <?php echo ($hist['situacao_char'] == 1 ? 'has-error'  : ''); ?>">
                                                        <label>Venda</label>
                                                        <select class="form-control " id="edit_venda_situacao" name="edit_venda_situacao" style="<?php echo ($hist['situacao_char'] == 1 ? 'color: #ff0909;'  : ''); ?>">
                                                            <?php if ($hist['situacao_char'] == 1) : ?>
                                                                <option selected="selected" value="1"> Vendido</option>
                                                                <option value="0">Não vendido</option>
                                                                <option value="2"> Defendido</option>
                                                            <?php elseif ($hist['situacao_char'] == 0) : ?>
                                                                <option selected="selected" value="0">Não vendido</option>
                                                                <option value="1"> Vendido</option>
                                                                <option value="2"> Defendido</option>
                                                            <?php else : ?>
                                                                <option value="0">Não vendido</option>
                                                                <option value="1"> Vendido</option>
                                                                <option selected="selected" value="2"> Defendido</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php if ($hist['situacao_char'] == 1) : ?>

                                                    <?php controller::getLucro($inv['id_inventario']); ?>

                                                <?php endif; ?>

                                                <div class="col-md-12 text-center">
                                                    --------------------------------------------------------------------------------------
                                                </div>
                                            </div>


                                        <?php endforeach; ?>

                                        <div class="box-body" style="<?php echo ($hist['situacao_char'] == 1 ? 'display: none;'  : ''); ?>; margin-top: -20px;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Situação</label>
                                                    <input type="text" class="form-control" id="descricao_situacao" name="descricao_situacao" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Data</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="data_situacao" id="data_situacao" data-inputmask="'alias': 'mm/yyyy'" data-mask="">
                                                </div>
                                            </div>
                                            <?php if ($hist['situacao_char'] == 1) : ?>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Preço Bruto</label>
                                                        <input type="text" class="form-control" id="preco_bruto" name="preco_bruto" autocomplete="off">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Preço de Venda</label>
                                                    <input type="text" class="form-control" id="preco_situacao" name="preco_situacao" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Retirada</label>
                                                    <input type="text" class="form-control" id="retirada" name="retirada" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Codigo</label>
                                                    <input type="text" class="form-control" id="leilao_codigo" name="leilao_codigo" autocomplete="off">
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Venda</label>
                                                    <select class="form-control " name="situacao_char" id="situacao_char">
                                                        <option value="1"> Vendido</option>
                                                        <option selected="selected" value="0">Não vendido</option>
                                                        <option value="2">Defendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <?php else : ?>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Situação</label>
                                            <input type="text" class="form-control" id="descricao_situacao" name="descricao_situacao" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Data</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="data_situacao" id="data_situacao" data-inputmask="'alias': 'mm/yyyy'" data-mask="">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input type="text" class="form-control" id="preco_situacao" name="preco_situacao" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Retirada</label>
                                            <input type="text" class="form-control" id="retirada" name="retirada" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input type="text" class="form-control" id="leilao_codigo" name="leilao_codigo" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Venda</label>
                                            <select class="form-control " name="situacao_char" id="situacao_char">
                                                <option value="1"> Vendido</option>
                                                <option selected="selected" value="0">Não vendido</option>
                                                <option value="2">Defendido</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="fotos<?php echo $inv['id_inventario'] ?>" style="display: none;">
                    <div class="box box-default box-solid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body" style="">
                                    <?php $img_obras = $this->inventario->getImagesByProduct($inv['id_inventario']) ?>
                                    <?php $artista = str_replace(' ', '_', $inv['art_nome']); ?>
                                    <?php foreach ($img_obras as $img) : ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo BASE_URL ?>assets/images/anuncios/<?php echo $artista ?>/<?php echo $img['url'] ?>" class="img-table" />
                                        </div>
                                    <?php endforeach ?>
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
    function dados_obra(id) {


        $("#dados_obras" + id).show("slow");
        $("#fotos" + id).hide("slow");

    }
    function changeModalInventario(idtroca, idatual){

        $('#modalVisualizar'+idatual).modal('hide');
        $('#modalVisualizar'+idtroca).modal('show');    
    }
    function fotos_obra(id) {

        $("#dados_obras" + id).hide("slow");
        $("#fotos" + id).show("slow");

    }

</script>