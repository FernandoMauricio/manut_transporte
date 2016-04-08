<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Forum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($forum, 'mensagem')->textarea(['rows' => 6]) ?>

    <?= $form->field($forum, 'data')->textInput() ?>

    <?= $form->field($forum, 'usuario_id')->textInput() ?>

    <?= $form->field($forum, 'solicitacao_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($forum->isNewRecord ? 'Create' : 'Update', ['class' => $forum->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
