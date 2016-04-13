<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

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
            ],
            [
                'attribute' => 'tipocarga_id',
                'value' => 'tipoCarga.descricao',
                 'contentOptions' =>['style' => 'width:30px'],
            ],
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
    'pjax'=>false, // pjax is set to always true for this demo
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