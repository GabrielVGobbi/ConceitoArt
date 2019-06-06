<?php
include_once("filtro.php");
include_once("modalCadastrar.php");
?>



<div class="col-xs-12">
<?php foreach ($tableDados as $inv) : ?>

    <div class="box box-default">
        
        <div class="box-header with-border text-center">
            <h3 class="box-title t"><?php echo $inv['art_nome']; ?></h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="text-center">
                        <?php $this->loadImg($inv, 'mobile'); ?>
                        
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
       
    </div>

    <?php include("modalVisualizar.php"); ?>
<?php endforeach; ?>
<ul class="pagination pagination-sm pull-right">
					<?php
					for ($q = 1; $q <= $p_count; $q++) : ?>
						<li class="<?php echo ($q == $p) ? 'active' : '' ?> "><a href="<?php echo BASE_URL; ?>inventario?p=<?php
																															$w = $_GET;
																															$w['p'] = $q;
																															echo http_build_query($w);
																															?>
														"><?php echo $q; ?></a></li>
					<?php endfor; ?>

				</ul>