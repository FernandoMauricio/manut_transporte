<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManutencaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_solicitacao') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'descricao_manut') ?>

    <?= $form->field($model, 'idusuario_solic') ?>

    <?php // echo $form->field($model, 'usuario_solic_nome') ?>

    <?php // echo $form->field($model, 'idusuario_suport') ?>

    <?php // echo $form->field($model, 'usuario_suport_nome') ?>

    <?php // echo $form->field($model, 'usuario_encerramento') ?>

    <?php // echo $form->field($model, 'data_encerramento') ?>

    <?php // echo $form->field($model, 'cod_unidade_solic') ?>

    <?php // echo $form->field($model, 'cod_unidade_suport') ?>

    <?php // echo $form->field($model, 'tipo_solic_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>