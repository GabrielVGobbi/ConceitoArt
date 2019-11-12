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

        <?php if($this->userInfo['userName']['id_company'] == 2): ?>
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
            <?php else: ?>
                <div class="box-body  " style="margin-bottom: 10px;">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered ">
                            <?php if (count($tableDados) > 0) : ?>
                                <tbody>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="scope" style="width: 10%">Ação</th>
                                            <th class="scope">Nome</th>
                                            <th class="scope">Ações</th>
                                    
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
                                            <td class="text-center">
                                                <a href="<?php echo BASE_URL;?>leilao/financeiro/<?php echo $cli['id_leilao']; ?>/pagamento/<?php echo ( $cli['pagamento'] == 1) ? '0' : '1' ?>" data-toggle="tooltip" title="" data-original-title="Pagar" ><?php echo ($cli['pagamento'] == 1) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Não Pago</span>' ?> </a>
                                                <a href="<?php echo BASE_URL;?>leilao/financeiro/<?php echo $cli['id_leilao']; ?>/envio/<?php echo ( $cli['comprovante'] == 1) ? '0' : '1' ?>" data-toggle="tooltip" title="" data-original-title="Enviar Comprovante" ><?php echo ($cli['comprovante'] == 1) ? '<span class="label label-success">Enviado</span>' : '<span class="label label-danger">Não Enviado</span>' ?> </a>
                                                <a href="<?php echo BASE_URL;?>leilao/financeiro/<?php echo $cli['id_leilao']; ?>/cadastro/<?php echo ( $cli['cadastro'] == 1) ? '0' : '1' ?>" data-toggle="tooltip" title="" data-original-title="Cadastrar Peça" ><?php echo ($cli['cadastro'] == 1) ? '<span class="label label-success">Cadastrado</span>' : '<span class="label label-danger">Não Cadastrado</span>' ?> </a>
                                            </td>

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
            <?php endif; ?>
    
    
    
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