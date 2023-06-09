<?php

namespace backend\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\Controller;
use backend\models\RefCpmk;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\RefMahasiswa;
use backend\models\searchs\RefCpl;
use backend\models\CapaianMahasiswa;
use backend\models\searchs\RelasiCpmkCpl;

class MonevCplController extends Controller
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

    /**
     * INDEX DIGUNAKAN UNTUK MENAMPILKAN MONEV INDIVIDU ALUMNI
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan id_mahasiswa
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionIndex()
    {
        $id_mahasiswa = Yii::$app->getRequest()->getQueryParam('jk');
        if (!$id_mahasiswa) {
            $mahasiswa = CapaianMahasiswa::find()
                ->joinWith(['refMahasiswa'])
                ->where([RefMahasiswa::tableName() . '.status' => 8])
                ->one();
            $id_mahasiswa = $mahasiswa->id_ref_mahasiswa;
        }
        if (!empty($id_mahasiswa)) {
            $cpl = RefCpl::find()->where(['status' => 1])->all();
            $total_cpl = count($cpl);

            // for ($i = 1; $i <= $total_cpl; $i++) {
            //     // $cpl[$i]        = RelasiCpmkCpl::find()->where(['id_ref_cpl' => $i])->all();
            //     $individu[$i] = CapaianMahasiswa::find()
            //         ->joinWith(['relasiCpmkCpls'])
            //         ->where([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => $i])
            //         ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
            //         ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
            //         ->average(CapaianMahasiswa::tableName() . '.nilai');
            //     // $jumlah_cpl[$i] = count($cpl[$i]) * 100;
            //     // $nilai_cpl[$i]  = $nilai[$i] / $jumlah_cpl[$i] * 100;
            //     // $data[$i]       = $nilai_cpl[$i];
            // }
            $individu[1] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 1])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[2] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 2])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[3] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 3])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 18])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[4] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 4])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 24])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[5] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 5])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[6] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 6])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[7] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 7])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[8] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 8])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[9] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 9])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 20])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $individu[10] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 10])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            if (Yii::$app->user->identity->prodigy->prodi != 'elektro') {
                $individu[11] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 11])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                    // ->all();
                    ->average(CapaianMahasiswa::tableName() . '.nilai');

                $individu[12] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 12])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 25])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                    // ->all();
                    ->average(CapaianMahasiswa::tableName() . '.nilai');
                if (Yii::$app->user->identity->prodigy->prodi == 'mesin') {
                    $individu[13] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 13])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 26])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');

                    $individu[14] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 14])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 23])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');

                    $individu[15] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 15])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');
                }
            }

            $mahasiswa = RefMahasiswa::findOne(["id" => $id_mahasiswa]);
            return $this->render(
                '/monev-cpl/index',
                [
                    'data'         => $individu,
                    'mahasiswa'    => $mahasiswa,
                    'id_mahasiswa' => $id_mahasiswa
                ]
            );
        }
        return $this->render(
            '/monev-cpl/index',
            [
                // 'data' => $individu,
            ]
        );
    }

    /**
     * INDIVIDUAL DIGUNAKAN UNTUK MENAMPILKAN MONEV INDIVIDU
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan id_mahasiswa
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionIndividual()
    {
        $id_mahasiswa = Yii::$app->getRequest()->getQueryParam('jk');
        $id_capaian = Yii::$app->getRequest()->getQueryParam('kk');
        if (!$id_capaian) {
            $id_capaian = 1;
        } else {
            $id_capaian = Yii::$app->getRequest()->getQueryParam('kk');
        }

        if (!$id_mahasiswa) {
            $mahasiswa = CapaianMahasiswa::find()
                ->joinWith(['refMahasiswa'])
                ->where([RefMahasiswa::tableName() . '.status' => 1])
                ->one();
            $id_mahasiswa = $mahasiswa->id_ref_mahasiswa;
        }
        if (!empty($id_mahasiswa)) {
            $cpl = RefCpl::find()->where(['status' => 1])->all();
            $total_cpl = count($cpl);
            $individu[1] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 1])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[1] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 1])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[2] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 2])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[2] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 2])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 17])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[3] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 3])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 18])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[3] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 3])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 18])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[4] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 4])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 24])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[4] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 4])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 24])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[5] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 5])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[5] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 5])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[6] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 6])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[6] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 6])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[7] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 7])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[7] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 7])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[8] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 8])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[8] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 8])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[9] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 9])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 20])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[9] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 9])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 20])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            $individu[10] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 10])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                // ->all();
                ->average(CapaianMahasiswa::tableName() . '.nilai');

            $eval[10] = CapaianMahasiswa::find()
                ->joinWith(
                    [
                        'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                            $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                        }
                    ]
                )
                ->with('dosen')
                ->with('mataKuliah')
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 10])
                ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 21])
                ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

            if (Yii::$app->user->identity->prodigy->prodi != "elektro") {
                $individu[11] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 11])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                    // ->all();
                    ->average(CapaianMahasiswa::tableName() . '.nilai');

                $eval[11] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->with('dosen')
                    ->with('mataKuliah')
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 11])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 19])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

                $individu[12] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 12])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 25])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                    // ->all();
                    ->average(CapaianMahasiswa::tableName() . '.nilai');

                $eval[12] = CapaianMahasiswa::find()
                    ->joinWith(
                        [
                            'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                            }
                        ]
                    )
                    ->with('dosen')
                    ->with('mataKuliah')
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 12])
                    ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 25])
                    ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                    ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                    ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

                if (Yii::$app->user->identity->prodigy->prodi == "mesin") {
                    $individu[13] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 13])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 26])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');

                    $eval[13] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->with('dosen')
                        ->with('mataKuliah')
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 13])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 26])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

                    $individu[14] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 14])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 23])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');

                    $eval[14] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->with('dosen')
                        ->with('mataKuliah')
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 14])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 23])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();

                    $individu[15] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 15])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])
                        // ->all();
                        ->average(CapaianMahasiswa::tableName() . '.nilai');

                    $eval[15] = CapaianMahasiswa::find()
                        ->joinWith(
                            [
                                'refCpmk.' . 'relasiCpmkCpls' => function ($query) {
                                    $query->where([RelasiCpmkCpl::tableName() . '.status' => 1]);
                                }
                            ]
                        )
                        ->with('dosen')
                        ->with('mataKuliah')
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 15])
                        ->orWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => 22])
                        ->andWhere([CapaianMahasiswa::tableName() . '.id_ref_mahasiswa' => $id_mahasiswa])
                        ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                        ->orderBy([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => SORT_ASC])->asArray()->all();
                }
            }
            $mahasiswa = RefMahasiswa::findOne(["id" => $id_mahasiswa]);
            // var_dump($eval[1]);
            return $this->render(
                '/monev-cpl/individual',
                [
                    'data' => $individu,
                    'mahasiswa' => $mahasiswa,
                    'id_mahasiswa' => $id_mahasiswa,
                    'id_capaian' => $id_capaian,
                    'eval' => $eval,
                ]
            );
        }
        return $this->render(
            '/monev-cpl/individual',
            [
                // 'data' => $individu,
            ]
        );
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN MONEV ANGKATAN
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan tahun angkatan
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionAngkatan()
    {
        $tahun = Yii::$app->getRequest()->getQueryParam('jk');

        $cpl = RefCpl::find()->where(['status' => 1])->all();
        $total_cpl = count($cpl);

        for ($i = 1; $i <= $total_cpl; $i++) {
            $angkatan[] = RefMahasiswa::find()
                ->joinWith(['relasiCpmkCpls'])
                ->where([RefMahasiswa::tableName() . '.angkatan' => $tahun])
                ->andWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => $i])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->andWhere([RefMahasiswa::tableName() . '.status' => 1])
                ->average(CapaianMahasiswa::tableName() . '.nilai');
        }
        return $this->render(
            '/monev-cpl/angkatan',
            [
                'data' => $angkatan,
                'angkatan' => $tahun
            ]
        );
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN MONEV SEMESTER
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan tahun dan semester
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionSemester()
    {
        $tahun = Yii::$app->getRequest()->getQueryParam('js');
        $sem = Yii::$app->getRequest()->getQueryParam('jk');

        $cpl = RefCpl::find()->where(['status' => 1])->all();
        $total_cpl = count($cpl);

        for ($i = 1; $i <= $total_cpl; $i++) {
            $semester[] = RefMahasiswa::find()
                ->joinWith(['capaianMahasiswas.relasiCpmkCpls'])
                ->where([CapaianMahasiswa::tableName() . '.tahun' => $tahun])
                ->andWhere([CapaianMahasiswa::tableName() . '.semester' => $sem])
                ->andWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => $i])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->andWhere([RefMahasiswa::tableName() . '.status' => 1])
                ->average(CapaianMahasiswa::tableName() . '.nilai');
        }
        return $this->render(
            '/monev-cpl/semester',
            [
                'data' => $semester,
                'tahun' => $tahun,
                'semester' => $sem
            ]
        );
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN MAHASISWA
     * jika data telah dimasukkan maka akan diredirect ke function individual
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingIndividual()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new CapaianMahasiswa();
        $model2    = new RefMahasiswa();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect([
                'individual',
                'jk' => $model->id_ref_mahasiswa,
            ]);
        }

        return [
            'title'   => 'Portal Individual',
            'content' => $this->renderAjax('landing-individual', [
                'model' => $model, 'model2' => $model2
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN ANGKATAN
     * jika data telah dimasukkan maka akan diredirect ke function angkatan
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingAngkatan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new RefMahasiswa();
        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect([
                'angkatan',
                'jk' => $model->angkatan,
            ]);
        }

        return [
            'title'   => 'Portal Angkatan',
            'content' => $this->renderAjax('landing-angkatan', [
                'model'    => $model
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN SEMESTER
     * jika data telah dimasukkan maka akan diredirect ke function semester
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingSemester()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new CapaianMahasiswa();
        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect([
                'semester',
                'jk' => $model->semester,
                'js' => $model->tahun,
            ]);
        }

        return [
            'title'   => 'Portal Semester',
            'content' => $this->renderAjax('landing-semester', [
                'model'    => $model
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN MONEV ANGKATAN ALUMNI
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan tahun
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionAngkatanLulusan()
    {
        $tahun = Yii::$app->getRequest()->getQueryParam('jk');

        $cpl = RefCpl::find()->where(['status' => 1])->all();
        $total_cpl = count($cpl);

        for ($i = 1; $i <= $total_cpl; $i++) {
            $angkatan[] = RefMahasiswa::find()
                ->joinWith(['relasiCpmkCpls'])
                ->where([RefMahasiswa::tableName() . '.angkatan' => $tahun])
                ->andWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => $i])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->andWhere([RefMahasiswa::tableName() . '.status' => 8])
                ->average(CapaianMahasiswa::tableName() . '.nilai');
        }
        return $this->render(
            '/monev-cpl/angkatan-lulusan',
            [
                'data' => $angkatan,
                'angkatan' => $tahun
            ]
        );
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN MONEV SEMESTER ALUMNI
     * melakukan looping sesuai jumlah CPL yang ada di tabel RefCPL
     * mengambil data dari database sesuai dengan tahun dan semester
     * menghitung rata" data yang didapat
     * mengirimm data ke view
     */
    public function actionSemesterLulusan()
    {
        $tahun = Yii::$app->getRequest()->getQueryParam('js');
        $sem = Yii::$app->getRequest()->getQueryParam('jk');

        $cpl = RefCpl::find()->where(['status' => 1])->all();
        $total_cpl = count($cpl);

        for ($i = 1; $i <= $total_cpl; $i++) {
            $semester[] = RefMahasiswa::find()
                ->joinWith(['capaianMahasiswas.relasiCpmkCpls'])
                ->where([CapaianMahasiswa::tableName() . '.tahun' => $tahun])
                ->andWhere([CapaianMahasiswa::tableName() . '.semester' => $sem])
                ->andWhere([RelasiCpmkCpl::tableName() . '.id_ref_cpl' => $i])
                ->andWhere([CapaianMahasiswa::tableName() . '.status' => 1])
                ->andWhere([RefMahasiswa::tableName() . '.status' => 8])
                ->average(CapaianMahasiswa::tableName() . '.nilai');
        }
        return $this->render(
            '/monev-cpl/semester-lulusan',
            [
                'data' => $semester,
                'tahun' => $tahun,
                'semester' => $sem
            ]
        );
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN MAHASISWA ALUMNI
     * jika data telah dimasukkan maka akan diredirect ke function index
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingIndividualLulusan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new CapaianMahasiswa();
        $model2    = new RefMahasiswa();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect([
                'index',
                'jk' => $model->id_ref_mahasiswa,
            ]);
        }

        return [
            'title'   => 'Portal Individual',
            'content' => $this->renderAjax('landing-individual-lulusan', [
                'model'            => $model, 'model2' => $model2
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN ANGKATAN ALUMNNI
     * jika data telah dimasukkan maka akan diredirect ke function angkatanlulusan
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingAngkatanLulusan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new RefMahasiswa();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect([
                'angkatan-lulusan',
                'jk' => $model->angkatan,
            ]);
        }
        return [
            'title'   => 'Portal Angkatan',
            'content' => $this->renderAjax('landing-angkatan-lulusan', [
                'model'            => $model
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN POP UP PILIHAN SEMESTER ALUMNI
     * jika data telah dimasukkan maka akan diredirect ke function semester-lulusan
     * ketika mengakses function ini maka akan menampilkan pop up ke view
     */
    public function actionLandingSemesterLulusan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model    = new CapaianMahasiswa();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect([
                'semester-lulusan',
                'jk' => $model->semester,
                'js' => $model->tahun,
            ]);
        }
        return [
            'title'   => 'Portal Semester',
            'content' => $this->renderAjax('landing-semester-lulusan', [
                'model'            => $model
            ]),
            'footer'  => '<div class="col-12 text-right">' .
                Html::button(
                    'Batal',
                    [
                        'class'        => 'btn btn-secondary',
                        'data-dismiss' => 'modal',
                    ]
                ) . ' ' .
                Html::button(
                    'Submit',
                    [
                        'class'  => 'btn btn-success',
                        'type'   => 'submit',
                    ]
                ) .
                '</div>'
        ];
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN LIST MAHASISWA DENGAN AJAX
     * Mengambil data mahasiswa sesuai dengan nama yang diinputkan user dengan limit 10
     * Membuat array yang berisi id dan text
     */
    public function actionMahasiswaList($q = null, $id = null, $status, $angkatan)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $mahasiswa = CapaianMahasiswa::find()
                ->distinct()
                ->joinWith(['refMahasiswa'])
                ->where([RefMahasiswa::tableName() . '.status' => $status])
                ->andWhere([RefMahasiswa::tableName() . '.angkatan' => $angkatan]) //untuk filter angkatan
                ->andWhere(['like', RefMahasiswa::tableName() . '.nama', $q])
                ->groupBy([RefMahasiswa::tableName() . '.nama'])
                ->limit(10)
                ->asArray()
                ->all();

            foreach ($mahasiswa as $key => $value) {
                $data[] = [
                    "id" => $value['refMahasiswa']['id'],
                    "text" => $value['refMahasiswa']['nama']
                ];
            }

            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => RefMahasiswa::find($id)->nama];
        }
        return $out;
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN LIST SEMESTER DENGAN AJAX
     * Mengambil data tahun sesuai dengan nama tahun yang diinputkan user dengan limit 10
     * Membuat array yang berisi id dan text
     */
    public function actionSemesterList($q = null, $id = null, $status)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $mahasiswa = CapaianMahasiswa::find()
                ->distinct()
                ->joinWith(['refMahasiswa'])
                ->where([RefMahasiswa::tableName() . '.status' => $status])
                ->andWhere(['like', CapaianMahasiswa::tableName() . '.tahun', $q])
                ->groupBy([CapaianMahasiswa::tableName() . '.tahun'])
                ->limit(10)
                ->asArray()
                ->all();
            foreach ($mahasiswa as $key => $value) {
                $data[] = [
                    "id" => $value['tahun'],
                    "text" => $value['tahun']
                ];
            }
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => CapaianMahasiswa::find($id)->tahun];
        }
        return $out;
    }

    /**
     * DIGUNAKAN UNTUK MENAMPILKAN LIST SEMESTER DENGAN AJAX
     * Mengambil data angkatan sesuai dengan nama angkatan yang diinputkan user dengan limit 10
     * Membuat array yang berisi id dan text
     */
    public function actionAngkatanList($q = null, $id = null, $status)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $mahasiswa = CapaianMahasiswa::find()
                ->distinct()
                ->joinWith(['refMahasiswa'])
                ->where([RefMahasiswa::tableName() . '.status' => $status])
                ->andWhere(['like', RefMahasiswa::tableName() . '.angkatan', $q])
                ->groupBy([RefMahasiswa::tableName() . '.angkatan'])
                ->limit(10)
                ->asArray()
                ->all();

            foreach ($mahasiswa as $key => $value) {
                $data[] = [
                    "id" => $value['refMahasiswa']['angkatan'],
                    "text" => $value['refMahasiswa']['angkatan']
                ];
            }

            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => RefMahasiswa::find($id)->angkatan];
        }
        return $out;
    }
}
