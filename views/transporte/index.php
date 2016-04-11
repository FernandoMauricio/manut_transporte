<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

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

<?php Pjax::begin(); ?>

    <?php 
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>false, // pjax is set to always true for this demo
    // 'export'=>[
    //         'showConfirmAlert'=>false,
    //         'target'=>GridView::TARGET_BLANK,
    //         'autoXlFormat'=>true,
    //     ],

//  'exportConfig' => [
//         kartik\export\ExportMenu::EXCEL => true,
//         kartik\export\ExportMenu::PDF => true,
//     ],  

// 'toolbar' => [
//         '{toggleData}',
//         '{export}',
//     ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Transporte', 'options'=>['colspan'=>12, 'class'=>'text-center warning']], 
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
