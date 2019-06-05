<?php
include_once("filtro.php");
include("modalCadastrar.php");
?>

<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header" style="margin-bottom: 10px;">
            <h3 class="box-title">Clientes</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <a href="<?php echo BASE_URL; ?>cliente" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>

        <div class="box-body  " style="margin-bottom: 10px;">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered ">
                    <?php if (count($tableDados) > 0) : ?>
                        <tbody>
                            <thead class="thead-dark">
                                <tr>
                                    <th class="scope" style="width: 10%">Ação</th>
                                    <th class="scope">Nome</th>
                                    <th class="scope">Email</th>
                                    <th class="text-center">Ultima Compra</th>
                                </tr>
                            </thead>
                            <?php foreach ($tableDados as $cli) : ?>
                                <tr>
                                    <td>
                                        <?php $this->include1($button = 'button_table', $dados = array($viewData['pageController'], $cli['id_cliente'])); ?>
                                        <button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalVisualizar<?php echo $cli['id_cliente']?>">
											<i class="fa fa-fw fa-info"></i>
										</button>
                                    </td>
                                    <td><?php echo $cli['cliente_nome'] ?></td>
                                    <td><?php echo $cli['cliente_email'] ?></td>
                                    <td></td>
                                </tr>
                                <?php require("modalVisualizar.php"); ?>
                            <?php endforeach; ?>
                        </tbody>
                    <?php else : ?>
                        <tr>
                            <td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div class="pull-left" style="right: 10px;">
                <p> Quantidade de Clientes: <?php echo $getCountCliente; ?> </p>
            </div>
        </div>
    </div>
</div>