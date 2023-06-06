<?php

namespace backend\controllers;

use Yii;
use app\models\Prodi;
use yii\web\Response;
use common\models\User;
use yii\web\Controller;
use app\models\Occupation;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\UserOccupationProdi;
use backend\models\searchs\User as UserSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['akses', 'view', 'change-status'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create-akses', 'index', 'update', 'deactive', 'active', 'delete-akses'],
                        'allow' => Yii::$app->user->identity->occupationki->occupation == "administrator",
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAkses()
    {
        $model = new UserOccupationProdi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['akses']);
        }

        return $this->render('createakses', [
            'model' => $model,
            'user' => ArrayHelper::map(User::find()->all(), 'id', 'nama'),
            'prodi' => ArrayHelper::map(Prodi::find()->all(), 'id', 'prodi'),
            'occupation' => ArrayHelper::map(Occupation::find()->all(), 'id', 'occupation'),
        ]);
    }

    public function actionDeleteAkses()
    {
        $model = UserOccupationProdi::findOne($_GET['id']);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('error', [['Delete', 'Akses Berhasil Dihapus']]);
        }
        return $this->redirect(['akses']);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeactive($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->status  = 9;
            $model->save();
        }
        return $this->redirect(['index']);
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->status  = 10;
            $model->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionAssign($id, $assign)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $listAssign = array_values(Yii::$app->assign->getListAssign($model->id));
        if (in_array($assign, $listAssign)) {
            Yii::$app->assign->revokeAssign($model->id, $assign);
            $data = false;
        } else {
            Yii::$app->assign->addAssign($model->id, $assign);
            $data = true;
        }

        return $data;
    }

    public function actionChangeStatus(){
        $model = $this->findModel(Yii::$app->user->identity->id);
        if ($model) {
            $model->jabatan = $_GET['jabatan'];
            $model->prodi = $_GET['prodi'];
            $model->save();    
        }
        return $this->redirect(['akses']);
    }

    public function actionAkses()
    {
        $resourcegrporgs = UserOccupationProdi::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        return $this->render('hak-akses', [
            'userModel' => $resourcegrporgs,
            // 'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
