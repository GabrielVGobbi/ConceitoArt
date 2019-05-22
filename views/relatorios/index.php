<div class="row">
	<div class="col-md-2">
		<a class="btn btn-app" onclick="gerarRelatorio()">
			<i class="fa fa-print" "></i> Gerar Relatorio
		</a>
	</div>

	<div class="col-md-2" >
		<a class="btn btn-app" onclick="gerarRecibo()" >
			<i class="fa fa-print" ></i> Gerar Recibo
		</a>
	</div>

	<div class="col-md-10">
		
	</div>

</div>

<?php require("includes/recibo.php"); ?>
<?php require("includes/relatorio.php"); ?>
