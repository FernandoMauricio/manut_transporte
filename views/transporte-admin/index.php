<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransporteAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transporte Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transporte Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_solicitacao',
            'descricao_transporte:ntext',
            'local',
            'bairro_id',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
