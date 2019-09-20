<?php

require "modalCadastrar.php";
?>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-credit-card"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Contas à Pagar Hoje</span>
      <span class="info-box-number"><?php echo ($this->financeiro->getContaNow($tableDados[0]['id_company']) > 0 ? $this->financeiro->getContaNow($tableDados[0]['id_company']) : '0');?></span>
    </div>
  </div>
</div>


<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header" style="margin-bottom: 10px;">
            <h3 class="box-title">Financeiro</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <a href="<?php echo BASE_URL; ?>financeiro" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                    <button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalCadastro">
                        <i class="fa fa-fw fa-plus-circle"></i>
                    </button> 
                </div>
            </div>
        </div>

        <div class="box-body" style="margin-bottom: 10px;">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <?php if (count($tableDados) > 0): ?>
                        <tbody>
                            <thead class="thead-dark">
                                <tr>
                                    <th class="scope" style="width: 10%">Ação</th>
                                    <th class="text-center">Instituição</th>
                                    <th style="width: 15%" class="text-center">Pagamento Dia</th>
                                    <th style="width: 15%" class="text-center">Valor</th>
                                    <th style="width: 10%" class="text-center">Pago</th>

                                </tr>
                            </thead>
                            <?php foreach ($tableDados as $fin): ?>
                                <tr>
                                    <td class="">
                                    <button class="btn btn-sm btn-info pop" data-toggle="modal" data-target="#modalVisualizar<?php echo $fin['id_financeiro']; ?>">
                                        <i class="fa fa-fw fa-info"></i>
                                    </button> 
                        
                                    </td>
                                    <td class="text-center" class=""><?php echo $fin['instituicao']; ?></td>
                                    <td class="text-center"><?php echo $fin['pagamento_dia']; ?></td>
                                    <td class="text-center"><?php echo number_format($fin['valor'], 2, ',', '.') ?></td>

                                    <td class="text-center"><a href="<?php echo BASE_URL;?>financeiro/pagar/<?php echo $fin['id_financeiro'];?>/<?php echo $fin['mes_financeiro'];?>/<?php echo $fin['ano'];?>" data-toggle="tooltip" title="" data-original-title="Pagar" ><?php echo ($fin['pago'] == '1') ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Não Pago</span>' ?> </a></td>
                                </tr>
                                <?php include("modalVisualizar.php");?>
                            <?php endforeach;?>
                        </tbody>
                    <?php else: ?>
                        <tr>
                            <td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>
                        </tr>
                    <?php endif;?>
                </table>
            </div>
            <div class="pull-left" style="right: 10px;">
                <p> Quantidade de contas: <?php ?> </p>
            </div>
        </div>
        <div class="box-footer no-padding">
            <div class="mailbox-controls">


                <ul class="pagination pagination-sm pull-right">
                    <?php
for ($q = 1; $q <= $p_count; $q++): ?>
                        <li class="<?php echo ($q == $p) ? 'active' : '' ?> "><a href="<?php echo BASE_URL; ?>financeiro?p=<?php
$w = $_GET;
$w['p'] = $q;
echo http_build_query($w);
?>
																    "><?php echo $q; ?></a></li>
                    <?php endfor;?>

                </ul>

            </div>
        </div>
    </div>
</div>