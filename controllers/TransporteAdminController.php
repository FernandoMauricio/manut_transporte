<?php

namespace app\controllers;

use Yii;
use app\models\Bairro;
use app\models\Forum;
use app\models\Motorista;
use app\models\TipoCarga;
use app\models\TransporteAdmin;
use app\models\TransporteAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransporteAdminController implements the CRUD actions for TransporteAdmin model.
 */
class TransporteAdminController extends Controller
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
     * Lists all TransporteAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransporteAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransporteAdmin model.
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
     * Creates a new TransporteAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransporteAdmin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TransporteAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;

        $model = $this->findModel($id);

        //Localização dos bairros, motoristas e tipo de carga
        $bairros = Bairro::find()->all();
        $motoristas = Motorista::find()->all();
        $tipoCarga = TipoCarga::find()->all();

        //Atualiza a Solicitação para Agendado e inclui o usuário que está realizando o agendamento
        $model->idusuario_suport = $session['sess_codusuario'];
        $model->usuario_suport_nome = $session['sess_nomeusuario'];


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->situacao_id = 2; //Agendado
            $model->save();

            //MENSAGEM DE CONFIRMAÇÃO
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Transporte de código <strong>' .$model->id. '</strong> foi ATUALIZADA!</strong>');
                
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'bairros'=> $bairros,
                'motoristas'=>$motoristas,
                'tipoCarga'=>$tipoCarga,
            ]);
        }
    }

    /**
     * Deletes an existing TransporteAdmin model.
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
     * Finds the TransporteAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransporteAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransporteAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
