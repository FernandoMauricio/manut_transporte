<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transporte */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
<div class="transporte-view">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Detalhes - Solicitação de Transporte </h3>
  </div>
  <div class="panel-body">
  <div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'data_solicitacao',
                'format'=>['datetime', 'php:d/m/Y'],
            ],
            'descricao_transporte:ntext',
            'local',
            'bairro.descricao', //bairro_id
            [
                'attribute' => 'data_prevista',
                'format'=>['datetime', 'php:d/m/Y'],
            ],
            'hora_prevista',
            [
                'attribute' => 'data_confirmacao',
                'format'=>['datetime', 'php:d/m/Y'],
            ],
            'hora_confirmacao',
            'tipoSolic.descricao', //tipo_solic_id
            'tipoCarga.descricao', //tipocarga_id
            'situacao.nome', //situacao_id
            'motorista.descricao', //motorista_id
            //'idusuario_solic',
            'usuario_solic_nome',
            //'idusuario_suport',
            'usuario_suport_nome',
        ],
    ]) ?>

        </div>
     </div>
    </div>

<?= $this->render('/forum/view-transporte', [
            'forum' => $forum,
        ]); ?>
        

    <?= $this->render('/forum/create', [
        'forum' => $forum,
    ]) ?>

</div>
