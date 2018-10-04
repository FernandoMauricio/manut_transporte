<?php
use yii\helpers\Html;
?>
<style type="text/css">
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th 
	{
		font-size: 12px;
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
	<div>
	  	<h3>Histórico do Percurso da Solicitação de Transporte</h3>
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
<?php foreach ($models as $i => $model): ?>
	    <tbody>
	      	<tr>
	        	<td class="col-sm-2"><?= $model->unidade_solic ?></td>
	        	<td class="col-sm-1"><?= $model->usuario_solic_nome ?></td>
	        	<td class="col-sm-2"><?= $model->local ?></td>
	        	<td class="col-sm-1"><?= $model->bairro->descricao ?></td>
	        	<td class="col-sm-1"><?=  date("H:i",strtotime($model->hora_confirmacao)) ?></td>
	        	<td class="col-sm-3"></td>
<!-- 	        	<pre>
	        	<?= print_r($model);?> -->
	      	</tr>
	    </tbody>
<?php endforeach; ?>
	  	</table>
	</div>

	<div>
	  	<table class="table table-bordered">
	    	<thead>
	      	<tr>
	        	<th class="col-sm-3">Local</th>
	        	<th>Data</th>
	        	<th>Horário</th>
	        	<th>Odômetro</th>
	        	<th>Diferença</th>
	        	<th>Quem Utilizou</th>
	        	<th class="col-sm-3">Intinerário</th>
	      	</tr>
	    	</thead>
		    <tbody>
		    <?php for ($row = 0; $row < 7; $row ++) { ?>
		      	<tr style="height: 30px;">
		      		<td></td>
		      		<td></td>
		      		<td></td>
		      		<td></td>
		      		<td></td>
		      		<td></td>
		      		<td></td>
		      	</tr>
		    <?php } ?>
		    </tbody>
	  	</table>
	</div>
</body>