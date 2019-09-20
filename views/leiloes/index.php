<?php
include_once("filtro.php");
include("modalCadastrar.php");
?>

<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header" style="margin-bottom: 10px;">
            <h3 class="box-title">Leilões</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <a href="<?php echo BASE_URL; ?>leilao" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                    <button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalCadastro<?php echo ucfirst($viewData['pageController']) ?>">
                        <i class="fa fa-fw fa-plus-circle"></i>
                    </button>
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
                               
                                </tr>
                            </thead>
                            <?php foreach ($tableDados as $cli) : ?>
                                <tr>
                                    <td>
                                        <?php $this->include1($button = 'button_table', $dados = array('leilao', $cli['id_leilao'])); ?>
                                        <button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalVisualizar<?php echo $cli['id_leilao']?>">
											<i class="fa fa-fw fa-info"></i>
										</button>
                                    
                                    </td>
                                    <td><?php echo $cli['leilao_nome'] ?></td>
                                    <td><?php echo $cli['leilao_endereco'] ?></td>
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
                <p> Quantidade de Leilões: <?php echo $getCountleilao; ?> </p>
            </div>
        </div>
    </div>
</div>


<script>
    <?php if (isset($_GET['modalcadastro'])) : error_log(print_r($_GET,1));?>
    var id = '<?php echo ucfirst($viewData['pageController']) ?>';
    console.log(id);
    $(function() {
        $('#modalCadastro' + id).modal('show');
    });
    <?php endif; ?>
</script>