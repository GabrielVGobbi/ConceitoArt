<?php
setlocale(LC_ALL, 'pt_BR.utf8');
date_default_timezone_set('America/Sao_Paulo');

$data = new DateTime($tableDados[0]['leilao_data']);

$data_nota = mb_strtoupper(strftime('%d   %B   %Y', strtotime('today')));
$str = strftime('%d de %B  de %Y', strtotime($tableDados[0]['leilao_data']));
$data_leilao = mb_strtoupper($str, 'UTF-8');


?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <meta charset="UTF-8" />
  <style>
    <!--
    /* Font Definitions */
    @font-face {
      font-family: "Cambria Math";
      panose-1: 2 4 5 3 5 4 6 3 2 4;
    }

    @font-face {
      font-family: Calibri;
      panose-1: 2 15 5 2 2 2 4 3 2 4;
    }

    @font-face {
      font-family: "Segoe UI";
      panose-1: 2 11 5 2 4 2 4 2 2 3;
    }

    /* Style Definitions */
    p.MsoNormal,
    li.MsoNormal,
    div.MsoNormal {
      margin-top: 0cm;
      margin-right: 0cm;
      margin-bottom: 8.0pt;
      margin-left: 0cm;
      line-height: 107%;
      font-size: 11.0pt;
      font-family: "Calibri", sans-serif;
    }

    h2 {
      mso-style-link: "Título 2 Char";
      margin-right: 0cm;
      margin-left: 0cm;
      font-size: 18.0pt;
      font-family: "Times New Roman", serif;
    }

    a:link,
    span.MsoHyperlink {
      color: #0563C1;
      text-decoration: underline;
    }

    a:visited,
    span.MsoHyperlinkFollowed {
      color: #954F72;
      text-decoration: underline;
    }

    p.MsoAcetate,
    li.MsoAcetate,
    div.MsoAcetate {
      mso-style-link: "Texto de balão Char";
      margin: 0cm;
      margin-bottom: .0001pt;
      font-size: 9.0pt;
      font-family: "Segoe UI", sans-serif;
    }

    p.MsoNoSpacing,
    li.MsoNoSpacing,
    div.MsoNoSpacing {
      margin: 0cm;
      margin-bottom: .0001pt;
      font-size: 11.0pt;
      font-family: "Calibri", sans-serif;
    }

    span.text2 {
      mso-style-name: text_2;
    }

    span.text3 {
      mso-style-name: text_3;
    }

    span.TextodebaloChar {
      mso-style-name: "Texto de balão Char";
      mso-style-link: "Texto de balão";
      font-family: "Segoe UI", sans-serif;
    }

    span.Ttulo2Char {
      mso-style-name: "Título 2 Char";
      mso-style-link: "Título 2";
      font-family: "Times New Roman", serif;
      font-weight: bold;
    }

    .MsoChpDefault {
      font-family: "Calibri", sans-serif;
    }

    .MsoPapDefault {
      margin-bottom: 8.0pt;
      line-height: 107%;
    }

    @page WordSection1 {
      size: 595.3pt 841.9pt;
      margin: 36.0pt 36.0pt 36.0pt 36.0pt;
    }

    div.WordSection1 {
      page: WordSection1;
    }

    .break  {
      page-break-before: always;
    }
    
  </style>

</head>

<body lang=PT-BR link="#0563C1" vlink="#954F72" onload="window.print();">

  <div class="WordSection1 break">

    <table class=MsoNormalTable border=1 cellspacing=10 cellpadding=0 width="100%" style='width:100.0%;border:none;border-bottom:solid black 1.0pt'>
      <tr>
        <td width=668 valign=top style='width:501.0pt;border:dashed black 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
          <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Courier New"'><img style="    margin-bottom: 2px;
    margin-top: 2px;
    margin-right: 2px;
    margin-left: 2px;" width=239 height=125 id="Picture 3" src="https://www.leiloesbr.com.br/imagens/nfs/6/topo-1.png" alt="https://www.leiloesbr.com.br/imagens/nfs/6/topo-1.png"></span></p>
        </td>
        <td width=667 valign=top style='width:500.35pt;border:dashed black 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Courier New"'>&nbsp;</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Courier New"'>Rua dos Franceses, 125 </span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Courier New"'>Bela Vista</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Courier New"'> São Paulo / SP</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=EN-US style='font-size:8.0pt;
  font-family:"Courier New"'>CEP: 01329-010</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=EN-US style='font-size:8.0pt;
  font-family:"Courier New"'>&nbsp;</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=EN-US style='font-size:8.0pt;
  font-family:"Courier New"'>Tel: (11) 3473-3945</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span lang=EN-US style='font-size:8.0pt;
  font-family:"Courier New"'>&nbsp;</span></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><a href="http://www.budanoleiloeiro.com.br"><span lang=EN-US style='font-size:
  8.0pt;font-family:"Courier New"'>www.budanoleiloeiro.com.br</span></a></p>
          <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Courier New"'>budanoleiloeiro@gmail.com</span></p>
        </td>
        <td width=333 valign=top style='width:249.4pt;border:dashed black 1.0pt;
  padding:0cm 0cm 0cm 0cm'>
          <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Courier New"'><img style="    margin-bottom: 2px;
    margin-top: 2px;
    margin-right: 2px;
    margin-left: 2px;" border=0 width=138 height=66 id="Picture 1" src="https://www.leiloesbr.com.br/imagens/nfs/6/topo-3.png" alt="https://www.leiloesbr.com.br/imagens/nfs/6/topo-3.png"></span></p>
          <p class=MsoNormal><span style='font-size:8.0pt;line-height:107%;font-family:
  "Courier New"'>&nbsp;</span></p>
          <p class=MsoNormal style='text-indent:35.4pt'><b><span style='font-size:16.0pt;
  line-height:107%;font-family:"Courier New"'><?php echo $tableDados[0]['nota_numero']; ?></span></b></p>
        </td>
      </tr>
    </table>

    <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:8.0pt;font-family:"Courier New";display:none'>&nbsp;</span></p>

    <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border:none;border-bottom:solid black 1.0pt'>
      <thead>
        <tr>
          <td width=428 style='width:321.15pt;border:none;padding:0cm 0cm 0cm 0cm'></td>
          <td width=428 style='width:321.15pt;border:none;padding:0cm 0cm 0cm 0cm'></td>
          <td width=428 style='width:321.15pt;border:none;padding:0cm 0cm 0cm 0cm'></td>
          <td width=428 style='width:321.15pt;border:none;padding:0cm 0cm 0cm 0cm'></td>
        </tr>
      </thead>
      <tr>
        <td colspan=4 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>&nbsp;</span></p>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>&nbsp;</span></p>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'><?php echo $data_nota; ?>
                Cartela:&nbsp;        Leilão:&nbsp;</span><span style='font-size:8.0pt;
  font-family:"Courier New";color:black;background:white'><?php echo $tableDados[0]['leilao_nome']; ?></span></p>
        </td>
      </tr>
      <tr>
        <td colspan=4 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Ilmo.(a)
              Sr.(a):</span><span style='font-size:8.0pt;font-family:"Courier New"'>&nbsp;</span><span style='font-size:8.0pt;font-family:"Courier New"'><?php echo $tableDados[0]['cliente_nome']; ?></span></p>
        </td>
      </tr>
      <tr>
        <td colspan=4 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Endereço:
              <?php echo $tableDados[0]['rua']; ?>, <?php echo $tableDados[0]['numero']; ?><?php echo ($tableDados[0]['complemento'] != "" ? " - " . $tableDados[0]['complemento'] : ""); ?></span></p>
        </td>
      </tr>
      <tr>
        <td style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Bairro:
            </span></p>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'><?php echo $tableDados[0]['bairro']; ?></span></p>
        </td>
        <td style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>  
                 Cidade: </span></p>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>     
              <?php echo $tableDados[0]['cidade']; ?></span></p>
        </td>
        <td style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>    
                  Estado:&nbsp;<?php echo $tableDados[0]['estado']; ?><br>
              <br>
            </span></p>
        </td>
        <td style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <h2 style='margin-top:3.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:
  0cm;margin-bottom:.0001pt;background:white;vertical-align:baseline'><span style='font-size:8.0pt;font-family:"Courier New";color:black;font-weight:
  normal'>   </span></h2>
          <h2 style='margin-top:3.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:
  0cm;margin-bottom:.0001pt;background:white;vertical-align:baseline'><span style='font-size:8.0pt;font-family:"Courier New";color:black;font-weight:
  normal'>CEP.: <?php echo $tableDados[0]['cep']; ?></span></h2>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'><br>
              <br>
            </span></p>
        </td>
      </tr>
      <tr>
        <td colspan=2 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>CNPJ(M.F.)
              ou CPF:<br>
              <?php echo $tableDados[0]['cliente_cpf']; ?></span></p>
        </td>
        <td colspan=2 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Insc.
              Est. e/ou Mun.:</span></p>
          <p class=MsoNoSpacing><span lang=EN-US style='font-size:8.0pt;font-family:
  "Courier New"'>-</span><span style='font-size:8.0pt;font-family:"Courier New"'>&nbsp;<br>
              <br>
            </span></p>
        </td>
      </tr>
      <tr>
        <td colspan=4 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Comprou
              em leilão realizado à&nbsp;<?php echo $tableDados[0]['leilao_endereco']; ?></span></p>
        </td>
      </tr>
      <tr>
        <td colspan=2 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>No(s)
              dia(s)<br>
              <?php echo $data_leilao; ?></span></p>
        </td>
        <td colspan=2 style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'>
          <p class=MsoNoSpacing><span style='font-size:8.0pt;font-family:"Courier New"'>Autorizado
              por:<br>
              FRANCESCO BUDANO JUNIOR - LEILOEIRO OFICIAL - SP</span></p>
        </td>
        <td style='border:none;padding:2.25pt 2.25pt 7.5pt 2.25pt'></td>
      </tr>
    </table>

    <p class=MsoNormal style='line-height:normal'><span style='font-size:8.0pt;
font-family:"Courier New";color:black;display:none'>&nbsp;</span></p>

    <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse'>
      <thead>
        <tr>
          <td width="10%" style='width:10.0%;border:none;border-bottom:solid black 1.0pt;
   padding:7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
   text-align:center;line-height:normal'><span style='font-size:8.0pt;
   font-family:"Courier New";text-transform:uppercase'>Nº LOTE</span></p>
          </td>
          <td width="70%" colspan=3 style='width:70.0%;border:none;border-bottom:solid black 1.0pt;
   padding:7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
   text-align:center;line-height:normal'><span style='font-size:8.0pt;
   font-family:"Courier New";text-transform:uppercase'>DESCRIÇÃO DO OBJETO</span></p>
          </td>
          <td width="20%" style='width:20.0%;border:none;border-bottom:solid black 1.0pt;
   padding:7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
   text-align:center;line-height:normal'><span style='font-size:8.0pt;
   font-family:"Courier New";text-transform:uppercase'>VALOR UNITÁRIO</span></p>
          </td>
        </tr>
      </thead>
      <tr>




        <?php
        $objeto_nota = $this->notas->getObjetosByNota($tableDados[0]['id_nota']);

        ?>
        <?php foreach ($objeto_nota as $notObj) : ?>
          <td style='border:none;border-bottom:solid black 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal><span style='font-size:8.0pt;line-height:107%;font-family:
    "Courier New";color:black'><?php echo $notObj['obj_lote']; ?></span></p>
          </td>
          <td colspan=3 style='border:none;border-bottom:solid black 1.0pt;padding:
    7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal><span style='font-size:8.0pt;line-height:107%;font-family:
    "Courier New";color:black;background:white'><?php echo $notObj['obj_descricao']; ?></span></p>
          </td>
          <td style='border:none;border-bottom:solid black 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
            <p class=MsoNormal><span style='font-size:8.0pt;line-height:107%;font-family:
    "Courier New";color:black'>R$ <?php echo number_format($notObj['obj_valor'], 2, ',', '.'); ?></span></p>
          </td>
      </tr>

    <?php endforeach; ?>
    <tr>
      <?php $valor_total = $this->notas->getValorTotalObjNota($tableDados[0]['id_nota']); ?>
      <td style="border:none;border-bottom:solid black 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt"></td>
      <td colspan="3" style="border:none;border-bottom:solid black 1.0pt;padding:
  7.5pt 7.5pt 7.5pt 7.5pt">
        <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:8.0pt;font-family:&quot;Courier New&quot;">Soma parcial:</span></p>
      </td>
      <td style="border:none;border-bottom:solid black 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt">
        <p class="MsoNormal"><span style="font-size:8.0pt;line-height:107%;font-family:
  &quot;Courier New&quot;;color:black">R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></span></p>
      </td>
    </tr>
    <tr>
      <td style="border:none;padding:0cm 0cm 0cm 0cm" width="10%">
        <p class="MsoNormal">&nbsp;</p>
      </td>
      <td width="33%" style="
   width:33.0%;
   border: solid black 1.0pt;
   /* border-top:none; */
   padding:3.75pt 3.75pt 3.75pt 3.75pt;
   ">
        <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
   line-height:normal"><span style="font-size:8.0pt;font-family:&quot;Courier New&quot;;
   text-transform:uppercase">COMISSÃO</span></p>
      </td>
      <td width="33%" style="
   width:33.0%;
   /* border-top:none; */
   /* border-left:none; */
   /* border-bottom:inset 1.0pt; */
   /* border-right:dashed black 1.0pt; */
   padding:3.75pt 3.75pt 3.75pt 3.75pt;
   border: solid black 1.0pt;
   ">
        <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
   line-height:normal"><span style="font-size:8.0pt;font-family:&quot;Courier New&quot;;
   text-transform:uppercase">TAXAS</span></p>
      </td>
      <td width="24%" colspan="2" style="
   width:24.0%;
   /* border-top:none; */
   /* border-left:
   none; */
   /* border-bottom:inset 1.0pt; */
   /* border-right:inset 1.0pt; */
   padding:3.75pt 3.75pt 3.75pt 3.75pt;
   border: solid black 1.0pt;
   ">
        <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
   line-height:normal"><span style="font-size:8.0pt;font-family:&quot;Courier New&quot;;
   text-transform:uppercase">VALOR TOTAL</span></p>
      </td>
    </tr>
    </thead>


    <?php
    $valor = $valor_total;
    $porcent = 5;
    $totalporcent = 100;
    $total = $porcent / $totalporcent;


    $resultado = $total * $valor;
    $valor_total_comissao = $resultado + $valor_total;
    ?>
    <tbody>
      <tr>
        <td style="border:none;padding:0cm 0cm 0cm 0cm" width="10%">
          <p class="MsoNormal">&nbsp;</p>
        </td>
        <td style="border: solid black 1.0pt;/* border-top:none; */padding:0cm 3.75pt 3.75pt 3.75pt;">
          <p class="MsoNormal"><span style="font-size:8.0pt;line-height:107%;font-family:
  &quot;Courier New&quot;;color:black">&nbsp;</span></p>
          <p class="MsoNormal"><span style="font-size:8.0pt;line-height:107%;font-family:
  &quot;Courier New&quot;;color:black">R$ <?php echo number_format($resultado, 2, ',', '.'); ?></span></p>
          <p class="MsoNormal"><span lang="EN-US" style="font-size:8.0pt;line-height:107%;
  font-family:&quot;Courier New&quot;">&nbsp;</span></p>
        </td>
        <td style="border: solid black 1.0pt;/* border-top:none; */padding:0cm 3.75pt 3.75pt 3.75pt;
  border-right:dashed black 1.0pt;padding:0cm 3.75pt 3.75pt 3.75pt">
          <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:8.0pt;font-family:&quot;Courier New&quot;">&nbsp;-</span></p>
        </td>
        <td colspan="2" style="border: solid black 1.0pt;/* border-top:none; */padding:0cm 3.75pt 3.75pt 3.75pt;padding:0cm 3.75pt 3.75pt 3.75pt">
          <p class="MsoNormal"><span style="font-size:8.0pt;line-height:107%;font-family:
  &quot;Courier New&quot;;color:black">R$ <?php echo number_format($valor_total_comissao, 2, ',', '.'); ?></span></p>
        </td>
      </tr>
      <tr height="0">
        <td width="71" style="border:none"></td>
        <td width="234" style="border:none"></td>
        <td width="234" style="border:none"></td>
        <td width="28" style="border:none"></td>
        <td width="142" style="border:none"></td>
      </tr>
    </tbody>
    </table>

    <p class=MsoNormal><span style='font-size:8.0pt;line-height:107%;font-family:
"Courier New"'>&nbsp;</span></p>

  </div>

</body>

</html>