<?php

namespace backend\controllers;

use backend\models\CapaianMahasiswa;
use backend\models\RefCpl;
use backend\models\RefMahasiswa;
use backend\models\RelasiCpmkCpl;
use kartik\mpdf\Pdf;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use backend\models\searchs\RefCpl as RefCplSearch;
use backend\models\SetupAplikasi;
use backend\models\UploadFileImporter;
use Mpdf\Mpdf;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
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

    public function actionImage()
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $_POST['cek'];
    }

    public function actionChart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $radar = Yii::$app->request->post('radar');
        $img   = str_replace('data:image/png;base64,', '', $radar);
        $img   = str_replace(' ', '+', $img);
        $data  = base64_decode($img);
        $path  = Yii::getAlias("@webroot/images");
        $base  = "{$path}/radar.png";
        @unlink($base);
        $radar_done = file_put_contents($base, $data);

        $bar   = Yii::$app->request->post('bar');
        $img   = str_replace('data:image/png;base64,', '', $bar);
        $img   = str_replace(' ', '+', $img);
        $data  = base64_decode($img);
        $path  = Yii::getAlias("@webroot/images");
        $base  = "{$path}/bar.png";
        @unlink($base);
        $bar_done = file_put_contents($base, $data);

        if ($bar_done && $radar_done) {
            $jk   = Yii::$app->request->post('id_mahasiswa');
            return  $this->redirect(['landing-skpi', 'jk' => $jk]);
        }
    }

    public function actionLandingSkpi($jk)
    {
        if ($model = Yii::$app->request->post()) {
            $data['refCpl']        = RefCpl::find()->where(['status' => 1])->all();
            $data['setupAplikasi'] = SetupAplikasi::find()->one();
            $data['setupPrint']    = $model;

            $date1 = $data['setupPrint']['tgl_masuk'];
            $date2 = $data['setupPrint']['tgl_lulus'];

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $day1 = date('d', $ts1);
            $day2 = date('d', $ts2);

            $total_bulan = (($year2 - $year1) * 12) + ($month2 - $month1);
            $total_hari = $day2 - $day1;
            $semester1 = $total_bulan / 6;
            $semester = floor($semester1);
            $total_bulan = $total_bulan - ($semester * 6);
            $total_bulan = $total_bulan + 1;
            if ($total_bulan == 6) {
                $semester = $semester + 1;
                $total_bulan = 0;
            }

            $data['total_bulan'] = $total_bulan;
            $data['semester'] = $semester;

            // echo '<pre>';
            // print_r("Total Hari =" . $total_hari);
            // print_r("total bulan =" . $total_bulan);
            // print_r("total semester =" . $semester);
            // exit;

            $mpdf = new Mpdf(['tempDir' => Yii::getAlias("@backend/uploads/temp")]);
            $mpdf->debug = true;
            $mpdf->showImageErrors = true;
            $mpdf->adjustFontDescLineheight = 1.15;
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->AddPageByArray([
                'margin-top' => 38,
                'margin-bottom' => 0,
            ]);
            // $mpdf->SetDefaultBodyCSS('background', "url('images/background_skpi.png')");
            $mpdf->WriteHTML($this->renderPartial('page1', [
                'data' => $data,
            ]));
            $mpdf->AddPage();
            $mpdf->WriteHTML($this->renderPartial('page2', [
                'data' => $data,
            ]));

            $mpdf->Output();
            exit;
        }
        $data = RefMahasiswa::findOne(['id' => $jk]);
        return $this->render(
            'landing-skpi',
            [
                'data' => $data
            ]
        );
    }

    public function actionTes()
    {
        $a = [8, 2, 6];
        $b = [9, 2, 8];

        $alice = 0;
        $bob = 0;

        if ($a[0] > $b[0]) {
            $alice += 1;
            $bob += 0;
        } else if ($a[0] < $b[0]) {
            $alice += 0;
            $bob += 1;
        } else if ($a[0] == $b[0]) {
            $alice += 0;
            $bob += 0;
        }
        if ($a[1] > $b[1]) {
            $alice += 1;
            $bob += 0;
        } else if ($a[1] < $b[1]) {
            $alice += 0;
            $bob += 1;
        } else if ($a[1] == $b[1]) {
            $alice += 0;
            $bob += 0;
        }
        if ($a[2] > $b[2]) {
            $alice += 1;
            $bob += 0;
        } else if ($a[2] < $b[2]) {
            $alice += 0;
            $bob += 1;
        } else if ($a[2] == $b[2]) {
            $alice += 0;
            $bob += 0;
        }
        $array = [$alice, $bob];
        echo '<pre>';
        print_r($array);
        exit;
    }

    public function actionSavexx($jk)
    {
        $model = $this->findModel($jk);
        // Mengecek apakah request adalah POST
        if ($model->load(Yii::$app->request->post())) {
            // Mengambil data dari POST request
            $nama = Yii::$app->request->post('nama');
            $nim = Yii::$app->request->post('nim');
            $ttl = Yii::$app->request->post('ttl');
            $tgl_masuk = Yii::$app->request->post('tgl_masuk');
            $tgl_lulus = Yii::$app->request->post('tgl_lulus');
            $total_sks = Yii::$app->request->post('total_sks');
            $no_skpi = Yii::$app->request->post('no_skpi');

            // Lakukan validasi data jika diperlukan
            // Simpan data ke database menggunakan model atau metode lainnya
            // Contoh: menggunakan ActiveRecord
            $model = new RefMahasiswa(); // Ganti "YourModel" dengan model yang sesuai
            $model->nama = $nama;
            $model->nim = $nim;
            $model->ttl = $ttl;
            $model->tgl_masuk = $tgl_masuk;
            $model->tgl_lulus = $tgl_lulus;
            $model->total_sks = $total_sks;
            $model->no_skpi = $no_skpi;
            $model->save();

            return $this->redirect(['landing-skpi', 'jk' => $model->id]);
        }
        return $this->render('landing-skpi', [
            'data' => $model,
        ]);
    }

    public function actionSave($jk)
    {
        $model = $this->findModel($jk);

        // Check if the request is a POST request and the model is loaded with data
        if ($model->load(Yii::$app->request->post())) {
            // Save the model
            if ($model->save()) {
                // Redirect to the landing-skpi page with the saved model ID
                return $this->redirect(['landing-skpi', 'jk' => $model->id]);
            } else {
                // Handle the case when saving fails
                Yii::$app->session->setFlash('error', 'Failed to save data.');
            }
        }

        return $this->render('landing-skpi', [
            'data' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = RefMahasiswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // public function actionUpdate($jk)
    // {
    //     $model = $this->findModel($jk);

    //     if ($model->load(Yii::$app->request->post())) {
    //         $model->updated_user = Yii::$app->user->identity->username;
    //         $model->save();
    //         Yii::$app->session->setFlash('warning', [['Update', 'Data Berhasil Diperbarui']]);
    //         return $this->redirect(['monev-cpl/individual', 'id' => $model->id]);
    //     }

    //     return $this->render('landing-skpi', [
    //         'data' => $model,
    //     ]);
    // }

    public function actionUpdate($jk)
    {
        $model = RefMahasiswa::findOne($jk);
        if (!$model) {
            throw new NotFoundHttpException('Data not found.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Data saved successfully.');
            return $this->redirect(['monev-cpl/individual', 'jk' => $model->id]);
        }

        return $this->render('landing-skpi', ['data' => $model]);
    }
}
