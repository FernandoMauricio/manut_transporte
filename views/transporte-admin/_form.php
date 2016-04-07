<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use \kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\Transporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transporte-form">

    <?php $form = ActiveForm::begin(); ?>



         <?php
             echo Form::widget([
                 'model'=>$model,
                 'form'=>$form,
                 'columns'=>10,
                 'attributes'=>[
                 'tipo_transporte'=>['staticValue' => 'Transporte','type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]], 
                 'tipocarga_id'=>['staticValue' => $model->tipoCarga->descricao,'type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]],  
                 'bairro_id'=>['staticValue' =>$model->bairro->descricao ,'type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]],  
                 'situacao_id'=>['staticValue' =>$model->situacao->nome ,'type'=>Form::INPUT_STATIC,'options'=>['inline'=>true,'readonly'=>true],'columnOptions'=>['colspan'=>2]], 
                 'data_solicitacao'=>['type'=>Form::INPUT_STATIC,'options'=>['inline'=>true,'readonly'=>true],'columnOptions'=>['colspan'=>2]],   
                             ],
             ]);
         ?>


<?= $form->field($model, 'local')->textInput(['maxlength' => true, 'readonly' => true]) ?>



    <?= $form->field($model, 'descricao_transporte')->textarea(['rows' => 6,'readonly'=>true]) ?>

    <?php

            echo $form->field($model, 'data_prevista')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'readonly' => true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ]
        ]);

    ?>

    <?php

    echo $form->field($model, 'hora_prevista')->widget(TimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...', 'readonly' => true],
        'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'showSeconds' => false,
        'showMeridian' => false,
    ]
]);
    ?>

    <?= $form->field($model, 'situacao_id')->textInput() ?>


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

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
