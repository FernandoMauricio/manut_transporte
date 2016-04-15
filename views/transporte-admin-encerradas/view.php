<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TransporteAdminEncerradas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitações de Transportes - Encerradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-admin-encerradas-view">

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
            'data_solicitacao',
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
            [ 
            'attribute' => 'situacao.nome', //situacao_id
              'format'=>'raw',
              'value' => '<span class="label label-danger">' .$model->situacao->nome .'</span>' 
            ],
            'motorista.descricao', //motorista_id
            'usuario_solic_nome',
            'usuario_suport_nome',
        ],
    ]) ?>

        </div>
     </div>
    </div>

<?= $this->render('/forum/view', [
            'forum' => $forum,
        ]); ?>
        
</div>
