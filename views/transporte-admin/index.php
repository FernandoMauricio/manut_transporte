<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use app\models\TipoCarga;
use app\models\Motorista;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Solicitação de Transporte  ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-index">

    <h1><?= Html::encode($this->title) . '<small>Área Administrativa</small>'  ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
$gridColumns = [
            'id',
            'usuario_solic_nome',

            [
                'attribute' => 'data_solicitacao',
                'format' => ['date', 'php:d/m/Y'],
                'width' => '190px',
                'hAlign' => 'center',
                'filter'=> DatePicker::widget([
                'model' => $searchModel, 
                'attribute' => 'data_solicitacao',
                'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'yyyy-mm-dd',
                ]
            ])
            ],

            [
                'attribute'=>'tipo_carga_label', 
                'vAlign'=>'middle',
                'width'=>'160px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->tipoCarga->descricao);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(TipoCarga::find()->orderBy('idtipo_carga')->asArray()->all(), 'descricao', 'descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipo'],
                'format'=>'raw'
            ],


            'local',

            [
                'attribute' => 'bairro_id',
                'value' => 'bairro.descricao',
                 'contentOptions' =>['style' => 'width:30px'],
            ],

            [
                'attribute'=>'motorista_label', 
                'width'=>'460px',
                'value'=> 'motorista.descricao',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Motorista::find()->asArray()->all(), 'descricao', 'descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Motorista'],
                'format'=>'raw'
            ],


            [
                'attribute' => 'data_confirmacao',
                'format' => ['date', 'php:d/m/Y'],
                'width' => '190px',
                'hAlign' => 'center',
                'filter'=> DatePicker::widget([
                'model' => $searchModel, 
                'attribute' => 'data_confirmacao',
                'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'yyyy-mm-dd',
                ]
            ])
            ],

             'hora_confirmacao',

            ['class' => 'yii\grid\ActionColumn' ,'template' => ' {view} {update}'],
        ];
    ?>

    <?php

    $gridColumnsExport = [
                'usuario_solic_nome',
                [
                  'attribute' => 'data_solicitacao',
                  'format' => ['date', 'php:d/m/Y'],
                ],
                'descricao_transporte:ntext',
                'local',
                [
                    'attribute' => 'bairro_id',
                    'value' => 'bairro.descricao',
                     'contentOptions' =>['style' => 'width:30px'],
                ],
                [
                    'attribute' => 'motorista_id',
                    'value' => 'motorista.descricao',
                     'contentOptions' =>['style' => 'width:30px'],
                ],
                [
                  'attribute' => 'data_confirmacao',
                  'format' => ['date', 'php:d/m/Y'],
                   'contentOptions' =>['style' => 'width:30px'],
                ],
                'hora_confirmacao',
            ];
?>


<?php Pjax::begin(['id'=>'w0-pjax']); ?>

   <?php 
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK,
            'autoXlFormat'=>true,

        ],

 'exportConfig' => [
        kartik\export\ExportMenu::EXCEL => true,
        kartik\export\ExportMenu::PDF => true,
    ],  

'toolbar' => [
        '{toggleData}',
        '{export}',
    ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Transporte', 'options'=>['colspan'=>9, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'condensed' => true,
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem das Solicitações de Transporte</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>