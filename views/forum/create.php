<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Forum */

$this->title = 'Chat Suporte';
?>
<div class="forum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('/forum/_form', [
        'forum' => $forum,
    ]) ?>

</div>
