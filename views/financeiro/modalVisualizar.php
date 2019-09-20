<div class="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalVisualizar<?php echo $fin['id_financeiro']; ?>">
    <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>financeiro/edit_action/">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title fc-center" align="center" id="exampleModalLabel">Visualizar</h2>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" value="<?php echo $fin['id_financeiro_mes'];?>" name="id_financeiro_mes" id="id_financeiro_mes" value="">
                    <input type="hidden" class="form-control" value="<?php echo $fin['id_financeiro'];?>" name="id_financeiro" id="id_financeiro" value="">

                    <div class="box box-default box-solid" id='boxleilao'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border" id="box-header_leilao">
                                    <h3 class="box-title">Dados</h3>
                                </div>
                                <div class="box-body" style="">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Instituição</label>
                                            <input type="text" class="form-control" value="<?php echo $fin['instituicao'];?>" name="instituicao" id="instituicao" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Valor</label>
                                            <input type="text" class="form-control" value="<?php echo number_format($fin['valor'], 2, ',', '.') ?>" name="pagamento_valor" id="pagamento_valor">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Dia</label>
                                            <input type="number" class="form-control" value="<?php echo $fin['pagamento_dia'];?>" name="pagamento_dia" id="pagamento_dia" data-inputmask="'alias': 'dd'" data-mask="">
                                        </div>
                                    </div>
                                    
                                    <!--<div class="col-md-2">
                                        <div class="form-group">
                                        <label></label>
                                            <input class="form-control"  type="checkbox" id="" />
                                        </div>
                                    </div>-->



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
</div>
</div>
