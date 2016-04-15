<?php

namespace app\controllers;

use Yii;
use app\models\Bairro;
use app\models\Forum;
use app\models\Motorista;
use app\models\Emailusuario;
use app\models\Transporte;
use app\models\TransporteSearch;
use app\models\TipoCarga;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransporteController implements the CRUD actions for Transporte model.
 */
class TransporteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transporte models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transporte model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;

         $model = $this->findModel($id);
         $forum = new Forum();


         $forum->solicitacao_id = $model->id;
         $forum->usuario_id = $session['sess_codusuario'];
         $forum->data = date('Y-m-d H:i');


        //CONVERSA ENTRE USUARIO E SUPORTE
        if ($forum->load(Yii::$app->request->post()) && $forum->save()) {

         //ENVIANDO EMAIL PARA O USUÁRIO INFORMANDO SOBRE UMA NOVA MENSAGEM....
          $sql_email = "SELECT emus_email FROM `db_base`.emailusuario_emus WHERE emus_codusuario = '".$model->idusuario_suport."'";
      
      $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
      foreach ($email_solicitacao as $email)
          {
            $email_usuario  = $email["emus_email"];

                            Yii::$app->mailer->compose()
                            ->setFrom(['gmt@am.senac.br' => 'GMT - INFORMA'])
                            ->setTo($email_usuario)
                            ->setSubject('Nova Mensagem! - Solicitação de Transporte '.$model->id.'')
                            ->setTextBody('Por favor, verique uma nova mensagem na solicitação de transporte de código: '.$model->id.' com status de '.$model->situacao->nome.' ')
                            ->setHtmlBody('<p>Prezado(a), <span style="color:rgb(247, 148, 29)"><strong>'.$model->usuario_suport_nome.'</strong></span></p>

                            <p>A solicita&ccedil;&atilde;o de transporte de c&oacute;digo <span style="color:rgb(247, 148, 29)"><strong>'.$model->id.'</strong></span> foi atualizada:</p>

                            <p><strong>Mensagem</strong>: '.$forum->mensagem.'</p>

                            <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                            <p>Atenciosamente,&nbsp;</p>

                            <p>Ger&ecirc;ncia de Manutenção e Transporte - GMT</p>')
                            ->send();
               } 


            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Transporte de código <strong>' .$model->id. '</strong> foi ATUALIZADA!</strong>');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                        'model' => $model,
                        'forum' => $forum,
                    ]);
            return $this->render('create', [
                'forum' => $forum,
            ]);
        }

    }

    /**
     * Creates a new Transporte model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        $model = new Transporte();

        //Localização dos bairros, motoristas e tipo de carga
        $bairros = Bairro::find()->all();
        $tipoCarga = TipoCarga::find()->all();

        //Encaminhado para providências
        $model->tipo_solic_id = 1;
        $model->idusuario_solic = $session['sess_codusuario'];
        $model->usuario_solic_nome = $session['sess_nomeusuario'];
        $model->cod_unidade_solic = $session['sess_codunidade'];
        $model->data_solicitacao = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        //ENVIANDO EMAIL PARA OS RESPONSÁVEIS DO GMT INFORMANDO SOBRE O RECEBIMENTO DE UMA NOVA SOLICITAÇÃO DE TRANSPORTE 
        //-- 12 - GERENCIA DE MATERIAIS E TRANSPORTE // 16 - SEDE ADMINISTRATIVA GMT
                  $sql_email = "SELECT DISTINCT emus_email FROM emailusuario_emus,colaborador_col,responsavelambiente_ream,responsaveldepartamento_rede WHERE ream_codunidade = '12' AND rede_coddepartamento = '16' AND rede_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
              
              $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
              foreach ($email_solicitacao as $email)
                  {
                    $email_usuario  = $email["emus_email"];

                                    Yii::$app->mailer->compose()
                                    ->setFrom(['gmt@am.senac.br' => 'GMT - INFORMA'])
                                    ->setTo($email_usuario)
                                    ->setSubject('Solicitação de Transporte - ' . $model->id)
                                    ->setTextBody('Existe uma solicitação de Transporte de código: '.$model->id.' - PENDENTE')
                                    ->setHtmlBody('<p>Prezado(a) Senhor(a),</p>

                                    <p>Existe uma solicita&ccedil;&atilde;o de transporte de c&oacute;digo: <strong><span style="color:#F7941D">'.$model->id.' </span></strong>- <strong><span style="color:#F7941D">PENDENTE</span></strong></p>

                                    <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicita&ccedil;&atilde;o de transporte.</p>

                                    <p>Atenciosamente,</p>

                                    <p>Ger&ecirc;ncia de Manuten&ccedil;&atilde;o e Transporte -&nbsp;GMT</p>
                                    ')
                                    ->send();
                                } 


            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Transporte <strong> criada!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'bairros'=> $bairros,
                'tipoCarga'=>$tipoCarga,
            ]);
        }
    }

    /**
     * Updates an existing Transporte model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transporte model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transporte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transporte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transporte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
