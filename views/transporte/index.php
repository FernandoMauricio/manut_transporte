<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use app\models\TipoCarga;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitação de Transporte';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
<div class="transporte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

        <?php

        $gridColumns = [

                    'id',

                    [
                    'attribute'=>'usuario_solic_nome',
                    'width' => '2500px',
                    ],
                    [
                        'attribute' => 'data_solicitacao',
                        'format' => ['date', 'php:d/m/Y'],
                        //'width' => '100px',
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

                    'descricao_transporte:ntext',
                    [
                        'attribute' => 'local',
                        'width' => '2500px',
                       
                    ],
                    [
                        'attribute' => 'bairro_id',
                        'value' => 'bairro.descricao',
                       
                    ],
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

                    ['class' => 'yii\grid\ActionColumn' ,'template' => ' {view}'],
                ];

         ?>

<?php Pjax::begin(['id'=>'w0-pjax']); ?>

    <?php 
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo

    'toolbar' => [
            '{toggleData}',
        ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Transporte', 'options'=>['colspan'=>7, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],  
            ],
        ]
    ],
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
