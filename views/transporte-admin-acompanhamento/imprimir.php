<?php
use yii\helpers\Html;
?>
<style type="text/css">
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th 
	{
		font-size: 10px;
	}

	.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th
	{
		vertical-align: inherit;
		text-align: center;
	}
</style>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<table class="table table-condensed table-hover">
		<tr> 
			<td style="border-top: 0px solid;width: 10%;"><img width="60%" src="css/img/logo.png"></td>
			<td style="border-top: 0px solid;width: 50%;"><h3>Histórico do Percurso da Solicitação de Transporte</h3></td>
		</tr>
	</table>

	<table class="table table-condensed table-hover">
		<tr>
			<td style="border-top: 0px solid; font-size: 12px"><b>Nome do Motorista:</b> <?= $motorista['descricao'] ?></td>
		</tr>
		<tr>
			<td style="border-top: 0px solid; font-size: 12px"><b>Modelo do Veículo/Placa:</b> ____________________________</td>
		</tr>
	</table>

	<table class="table">
		<thead>
	  	<tr>
	  		<th>Unidade</th>
	  		<th>Solicitante</th>
	    	<th>Destino</th>
	    	<th>Bairro</th>
	    	<th>Hora</th>
	    	<th>Observação</th>
	  	</tr>
		</thead>
		<tbody>
			<?php foreach ($models as $i => $model): ?>
		  	<tr>
		    	<td class="col-sm-2"><?= $model->unidade_solic ?></td>
		    	<td class="col-sm-1"><?= $model->usuario_solic_nome ?></td>
		    	<td class="col-sm-2"><?= $model->local ?></td>
		    	<td class="col-sm-1"><?= $model->bairro->descricao ?></td>
		    	<td class="col-sm-1"><?=  date("H:i",strtotime($model->hora_confirmacao)) ?></td>
		    	<td class="col-sm-3"></td>
		  	</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<table class="table table-bordered">
	  	<tr>
	    	<th style="vertical-align:inherit;" rowspan="2">Data</th>
	    	<th style="vertical-align:inherit;" colspan="2">Horário</th>
	    	<th style="vertical-align:inherit;" colspan="2">Odômetro</th>
	    	<th style="vertical-align:inherit;" rowspan="2">Diferença</th>
	    	<th style="vertical-align:inherit;" rowspan="2">Quem Utilizou</th>
	    	<th style="vertical-align:inherit;" rowspan="2" class="col-sm-3">Intinerário</th>
	  	</tr>
	    	<tr>
	      		<td>Saída</td>
	      		<td>Regresso</td>
	      		<td>Saída</td>
	      		<td>Regresso</td>
	    	</tr>
	    <?php for ($row = 0; $row < 5; $row ++): ?>
	      	<tr style="height: 30px;">
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      		<td></td>
	      	</tr>
	    <?php endfor; ?>
	</table>

	<table class="table table-condensed">
		<tbody>
			<tr>
		  		<td style="border-top: 0px solid">Assinatura do Motorista: _______________________ _______/_______/______</td>
		  		<td style="border-top: 0px solid">Visto GMT: _______________________ _______/_______/______</td>
		  	</tr>
		</tbody>
	</table>
</body>