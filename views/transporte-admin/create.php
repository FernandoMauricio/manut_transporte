<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TransporteAdmin */

$this->title = 'Create Transporte Admin';
$this->params['breadcrumbs'][] = ['label' => 'Transporte Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporte-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
