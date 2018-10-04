<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\solicitacao\Solicitacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transporte-imprimir-dia-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="panel-body">
	<div class="row">
		<div class="col-md-6">
	        <?php
	            $data_motoristas = ArrayHelper::map($motoristas, 'id', 'descricao');
	            echo $form->field($model, 'motorista_id')->widget(Select2::classname(), [
	                'data' => $data_motoristas,
	                'options' => ['placeholder' => 'Selecione um motorista...'],
	                'pluginOptions' => [
	                    'allowClear' => true
	                ],
	            ]);                    
	         ?> 
		</div>
		<div class="col-md-6">
		    <?php
		        echo $form->field($model, 'data_prevista')->widget(DateControl::classname(), [
		        'type'=>DateControl::FORMAT_DATE,
		        'ajaxConversion'=>true,
		        'options' => [
		            'pluginOptions' => [
		                'autoclose' => true,
			            ]
			        ]
		        ]);
		    ?> 
		</div>
	</div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Criar dia', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>