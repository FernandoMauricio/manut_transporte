<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Forum;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Forum */

$this->title = $forum->id;
?>

<?php

$id = $_GET['id'];
$cod_usuario = $forum->usuario_id;

        //busca pelas mensagens enviadas no Atendimento
        $sql_forum = 'SELECT * FROM forum WHERE solicitacao_id ='.$id.' ';
        $forum = Forum::findBySql($sql_forum)->all();  

        //busca pelas mensagens enviadas no Atendimento
         $sql_usuario = 'SELECT usu_nomeusuario FROM `usuario_usu` WHERE usu_codusuario ='.$cod_usuario.' ';
         $usuario = Usuario::findBySql($sql_usuario)->one();  
?>


<div class="forum-view">

    <h1><?= Html::encode($this->title) ?></h1>



<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Histórico de Mensagens</h3>
  </div>
  <div class="panel-body">
  <div class="row">

<?php 

foreach ($forum as $value) {

    $forums = $value["mensagem"];
    $data = $value["data"];
?>

<div class="well">

<strong>Atualizado Por: </strong> <?php echo $usuario->usu_nomeusuario ?> - <strong>Feita em:</strong> <?php echo date('d/m/Y à\s H:i', strtotime($data)); ?><br>
<strong>Mensagem: </strong><br><?php echo $forums ?>


</div>

<?php 
}
?>
  </div>
</div>
</div>

</div>
