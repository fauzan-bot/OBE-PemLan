<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\RefDosen */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosen Pengajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Tabel Dosen</h1>
    </div>
    <div class="panel-body">
        <?php
        if (Yii::$app->user->identity->occupationki->occupation == "administrator") {
        ?>
            <p align="right">
                <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php
        }
        ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'kode_dosen',
                'nip',
                'nama_dosen',
                // 'status',
                [
                    'class'      => 'kartik\grid\DataColumn',   // can be omitted, as it is the default
                    'attribute'  => 'status',
                    'format'     => 'raw',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter'     => [
                        '1' => 'Aktif',
                        '9' => 'Tidak Aktif',
                    ],
                    'filterWidgetOptions' => [
                        'theme'         => Select2::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ],
                    'filterInputOptions' => [
                        'placeholder' => '',
                    ],
                    'value' => function ($dataProvider) {
                        if ($dataProvider->status == 1) {
                            return 'Aktif';
                        } elseif ($dataProvider->status == 9) {
                            return 'Tidak Aktif';
                        }
                        // return $dataProvider->status; // $data['name'] for array data, e.g. using SqlDataProvider.
                    },
                ],
                //'created_at',
                //'updated_at',
                //'created_user',
                //'updated_user',

                // ['class' => 'yii\grid\ActionColumn'],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'options' => [
                        'style' => 'min-width: 100px',
                    ],
                    'template' => '{view} {update} {delete}',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    // 'urlCreator' => function($action, $model, $key, $index) {
                    //     $url = Url::to([$action, 'id' => $key]);
                    //     return $url;
                    // },
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fa fa-info-circle"></i>', $url, [
                                'data-original-title' => 'Lihat',
                                'title'               => 'Lihat',
                                'data-toggle'         => 'tooltip',
                                'class'               => 'btn btn-primary btn-xs',
                                // 'role'                => 'modal-remote',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                'data-original-title' => 'Perbarui',
                                'title'               => 'Perbarui',
                                'data-toggle'         => 'tooltip',
                                'class'               => 'btn btn-warning btn-xs',
                                // 'role'                => 'modal-remote',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fa fa-trash"></i>', $url, [
                                'data-original-title'  => 'Hapus',
                                'title'                => 'Hapus',
                                'data-toggle'          => 'tooltip',
                                'class'                => 'btn btn-danger btn-xs',
                                'role'                 => 'modal-remote',
                                'data-confirm'         => false,
                                'data-method'          => false, // for overide yii data api
                                'data-request-method'  => 'post',
                                'data-confirm-title'   => 'Konfirmasi',
                                'data-confirm-message' => 'Apakah anda yakin akan menghapus data ini?',
                            ]);
                        }
                    ],
                    'visibleButtons' =>
                    [
                        'update' => Yii::$app->user->identity->occupationki->occupation == "administrator",
                        'delete' => Yii::$app->user->identity->occupationki->occupation == "administrator",
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>