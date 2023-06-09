<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\RefMataKuliah;
use yii\web\NotFoundHttpException;
use backend\models\searchs\RefMataKuliah as RefMataKuliahSearch;

/**
 * RefMataKuliahController implements the CRUD actions for RefMataKuliah model.
 */
class RefMataKuliahController extends Controller
{
    const BASE_URL = 'http://http://127.0.0.1:8000/api';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => Yii::$app->user->identity->occupationki->occupation == "administrator",
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all RefMataKuliah models.
     * @return mixed
     */
    public function actionIndex()
    {
        // if (RefMataKuliah::find()->count() == 0) {
        //     $client = new Client();
        //     $response = $client->createRequest()
        //     ->setMethod('GET')
        //     ->setUrl('http://127.0.0.1:8000/api/matkul/prodi/'.Yii::$app->user->identity->prodigy->prodi)
        //     ->addHeaders([
        //         'content-type' => 'application/json',
        //     ])
        //     ->send();
        //     if ($response->isOk) {
        //         $i = 0;
        //         while ($i < count($response->getData())) {
        //             $model = new RefMataKuliah();
        //             $model->kode = $response->data[$i]['kode'];
        //             $model->nama = $response->data[$i]['nama'];
        //             $model->sks = $response->data[$i]['sks'];
        //             $model->status = 1;
        //             $model->save();
        //             $i++;
        //         }
        //     }
        // }
        $searchModel = new RefMataKuliahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMonitoring()
    {
        $searchModel = new RefMataKuliahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('monitoring', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMonitoringUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_user = Yii::$app->user->identity->username;
            $model->save();
            Yii::$app->session->setFlash('warning', [['Update', 'Data Berhasil Diperbarui']]);
            return $this->redirect(['monitoring']);
        }

        return $this->render('monitoring-update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single RefMataKuliah model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefMataKuliah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefMataKuliah();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_user = Yii::$app->user->identity->username;
            $model->contoh_soal = '';
            $model->save();
            Yii::$app->session->setFlash('success', [['Success', 'Data Berhasil Dimasukkan']]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefMataKuliah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_user = Yii::$app->user->identity->username;
            $model->save();
            Yii::$app->session->setFlash('warning', [['Update', 'Data Berhasil Diperbarui']]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefMataKuliah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->updated_user = Yii::$app->user->identity->username;
            $model->status  = 0;
            $model->save();
            Yii::$app->session->setFlash('error', [['Delete', 'Data Berhasil Dihapus']]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the RefMataKuliah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefMataKuliah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefMataKuliah::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
