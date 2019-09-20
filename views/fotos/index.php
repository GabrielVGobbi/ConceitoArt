<?php
include_once("filtro.php");
include("modalCadastrar.php");
?>

<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header" style="margin-bottom: 10px;">
            <h3 class="box-title">Fotos</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <a href="<?php echo BASE_URL; ?>fotos" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                    
                </div>
            </div>
        </div>

        <div class="box-body  " style="margin-bottom: 10px;">
            <div class="table-responsive">

                <?php if (count($tableDados) > 0) : ?>

                <?php foreach ($tableDados as $invimg) : ?>
                <div class="col-md-3">
                    <div class="box box-danger">
                        <div class="box-tools">

                            <button class="btn btn-sm btn-danger pop" data-toggle="popover" title="Remover?" data-content="<a href='<?php echo BASE_URL; ?>fotos/delete/<?php echo $invimg['id_image']; ?>' class='btn btn-danger'>Sim</a> <button type='button' class='btn btn-default pop-hide'>Não</button>">
                                <i class="fa fa-fw fa-close"></i> </i>
                        </div>
                        <div class="box-body no-padding">
                            <?php $artista = str_replace(' ', '_', $invimg['art_nome']); ?>
                            <?php echo $invimg['id_inventario']; ?> - <?php echo $invimg['art_nome']; ?>
                            <img class="img-responsive pad" src="<?php echo BASE_URL ?>assets/images/anuncios/<?php echo $artista ?>/<?php echo $invimg['url'] ?>" alt="Photo">
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>

                <?php else : ?>

                <?php endif; ?>

            </div>
            <div class="box-footer no-padding">
                <div class="mailbox-controls">


                    <ul class="pagination pagination-sm pull-right">
                        <?php
                        for ($q = 1; $q <= $p_count; $q++) : ?>
                        <li class="<?php echo ($q == $p) ? 'active' : '' ?> "><a href="<?php echo BASE_URL; ?>fotos?p=<?php
                                                                                                                                $w = $_GET;
                                                                                                                                $w['p'] = $q;
                                                                                                                                echo http_build_query($w);
                                                                                                                                ?>
														  "><?php echo $q; ?></a></li>
                        <?php endfor; ?>

                    </ul>

                </div>
            </div>
        </div>
    </div>