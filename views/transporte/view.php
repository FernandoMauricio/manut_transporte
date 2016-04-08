<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transporte */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data_solicitacao',
            'descricao_transporte:ntext',
            'local',
            'bairro.descricao', //bairro_id
            'data_prevista',
            'hora_prevista',
            'data_confirmacao',
            'hora_confirmacao',
            'tipoSolic.descricao', //tipo_solic_id
            'tipoCarga.descricao', //tipocarga_id
            'situacao.nome', //situacao_id
            'motorista.descricao', //motorista_id
            'idusuario_solic',
            'usuario_solic_nome',
            'idusuario_suport',
            'usuario_suport_nome',
        ],
    ]) ?>

</div>
