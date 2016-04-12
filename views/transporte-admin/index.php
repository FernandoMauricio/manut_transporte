<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
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
            // [
            //   'attribute' => 'data_prevista',
            //   'format' => ['date', 'php:d/m/Y'],
            // ],
            // 'hora_prevista',
            [
              'attribute' => 'data_confirmacao',
              'format' => ['date', 'php:d/m/Y'],
               'contentOptions' =>['style' => 'width:30px'],
            ],
             'hora_confirmacao',
            // 'data_prevista',
            // 'hora_prevista',
            // 'data_confirmacao',
            // 'hora_confirmacao',
            // 'tipo_solic_id',
            // 'tipocarga_id',
            // 'situacao_id',
            // 'motorista_id',
            // 'idusuario_solic',
            // 'usuario_solic_nome',
            // 'idusuario_suport',
            // 'usuario_suport_nome',
            ['class' => 'yii\grid\ActionColumn' ,'template' => ' {view} {update}'],
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
// 'toolbar' => [
//         '{toggleData}',
//         '{export}',
//     ],
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Transporte', 'options'=>['colspan'=>9, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'condensed' =>true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem das Solicitações de Transporte</h3>',
        'persistResize'=>true,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>