<?php

$endereco_r = ($endereco_r != '') ? ', localizado na'.$endereco_r : '';
$rg_r = ($rg_r != '') ? ' e RG: '.$rg_r : '';



?>


<html><head><meta content="text/html; charset=UTF-8" http-equiv="content-type"><style type="text/css">ol{margin:0;padding:0}table td,table th{padding:0}.c4{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:240.9pt;border-top-color:#000000;border-bottom-style:solid}.c10{-webkit-text-decoration-skip:none;color:#000000;font-weight:400;text-decoration:underline;vertical-align:baseline;text-decoration-skip-ink:none;font-size:20pt;font-family:"Arial";font-style:normal}.c0{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:left;height:11pt}.c1{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:14pt;font-family:"Arial";font-style:normal}.c2{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:center;height:11pt}.c12{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:20pt;font-family:"Arial";font-style:normal}.c13{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:center}.c9{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:left}.c5{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:right}.c3{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:left}.c6{border-spacing:0;border-collapse:collapse;margin-right:auto}.c14{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:center}.c11{background-color:#ffffff;max-width:481.9pt;padding:56.7pt 56.7pt 56.7pt 56.7pt}.c8{height:172pt}.c7{height:11pt}.title{padding-top:0pt;color:#000000;font-size:26pt;padding-bottom:3pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}.subtitle{padding-top:0pt;color:#666666;font-size:15pt;padding-bottom:16pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}li{color:#000000;font-size:11pt;font-family:"Arial"}p{margin:0;color:#000000;font-size:11pt;font-family:"Arial"}h1{padding-top:20pt;color:#000000;font-size:20pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h2{padding-top:18pt;color:#000000;font-size:16pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h3{padding-top:16pt;color:#434343;font-size:14pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h4{padding-top:14pt;color:#666666;font-size:12pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h5{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h6{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;font-style:italic;orphans:2;widows:2;text-align:left}</style></head><body class="c11"><p class="c13"><span class="c10">RECIBO</span></p><p class="c0"><span class="c12"></span></p><p class="c9"><span class="c1">Eu, <?php echo $nome; ?> do CPF n&ordm; <?php echo $cpf; ?>, localizado em <?php echo $endereco; ?>, declaro ter recebido de <?php echo $nome_r; ?> do CPF n&ordm; <?php echo $cpf_r; ?><?php echo $rg_r; ?> <?php echo $endereco_r; ?>, a quantia de R$ <?php echo ($quantia != '' ? number_format($quantia, 2, ',', '.') : '') ?>, pela venda livre e desembara&ccedil;ada, me responsabilizando pela origem e autenticidade da obra reproduzida e descrita abaixo:</span></p><p class="c0"><span class="c1"></span></p><p class="c0"><span class="c1"></span></p><p class="c0"><span class="c1"></span></p>








	
	
	<a id="t.36936c8441f0bf022c1c67086292673baf405a3c"></a><a id="t.0"></a>





<?php foreach ($dados as $d ): ?>
<?php 

$data = ($rg_r != '') ? 'Data: &nbsp;'.$d['inv_data'] : ''; 

?>
	<table class="c6"><tbody><tr class="c8"><td class="c4" colspan="1" rowspan="1"><p class="c14"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 140.70px; height: 208.14px;">

		<?php $this->loadImg($d, 'recibo'); ?>



	</span></p></td><td class="c4" colspan="1" rowspan="1"><p class="c3"><span class="c1">Artista: <?php echo $d['art_nome'] ?> </span></p><p class="c3 c7"><span class="c1"></span></p><p class="c3"><span class="c1">Titulo: <?php echo $d['inv_descricao'] ?></span></p><p class="c3"><span class="c1">T&eacute;cnica: <?php echo $d['nome_tecnica'] ?></span></p><p class="c3"><span class="c1">Medida: <?php echo $d['inv_tamanho'] ?> cm </span></p><p class="c3"><span class="c1"><?php echo $data ?></span></p></td></tr></tbody>
	</table>
<?php endforeach; ?>







	<p class="c9"><span class="c1">Sem mais, </span></p><p class="c0"><span class="c1"></span></p><p class="c0"><span class="c1"></span></p><p class="c13"><span class="c1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php    
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');

	$semana1 = ucfirst('%A');

	$data = strftime($semana1.', %d de %B de %Y', strtotime('today'));
	echo ucwords($data);

	?></span></p><p class="c2"><span class="c1"></span></p><p class="c5"><span class="c1">______________________________________ </span></p></body></html>