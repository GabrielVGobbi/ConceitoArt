<?php
include_once("filtro.php");
include("modalCadastrar.php");
?>

<?php foreach ($tableDados as $inv) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border text-center">
                    <h3 class="box-title t"><?php echo $inv['art_nome']; ?></h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="text-center">
                                <?php $this->loadImg($inv, true); ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-footer no-padding">

                    <ul class="nav nav-pills nav-stacked" onclick="Modal(<?php echo $inv['id_inventario']; ?>, 'modalVisualizar')">
                        <li class="list-group-item">
                            <b>Descrição:</b> <b class="pull-right"><?php echo $inv['inv_descricao']; ?></b>
                        </li>
                        <li class="list-group-item">
                            <b>Tecnica:</b> <b class="pull-right"><?php echo $inv['nome_tecnica']; ?></b>
                        </li>
                        <li class="list-group-item">
                            <b>Tamanho:</b> <b class="pull-right"><?php echo $inv['inv_tamanho']; ?></b>
                        </li>
                    </ul>
                </div>
                <?php require("modalVisualizar.php"); ?>
            </div>
        </div>
    </div>

<?php endforeach; ?>