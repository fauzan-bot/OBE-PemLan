<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\RefMataKuliah */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitoring Pembelajaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Tabel Mata Kuliah</h1>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                // 'kode',
                'nama',
                // 'sks',
                // 'status',
                //'created_at',
                //'updated_at',
                //'created_user',
                //'updated_user',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'options' => [
                        'style' => 'min-width: 100px',
                    ],
                    'template' => '{rps} {presensi} {contohSoal} {nilai} {kueisioner} {evaluasi} {kinerja}',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    // 'urlCreator' => function($action, $model, $key, $index) {
                    //     $url = Url::to([$action, 'id' => $key]);
                    //     return $url;
                    // },
                    'buttons' => [
                        'rps' => function ($url, $model) {
                            if ($model->rps) {
                                return Html::a('RPS', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('RPS', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                        },
                        'presensi' => function ($url, $model) {
                            if ($model->presensi) {
                                return Html::a('Presensi', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('Presensi', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }                         
                        },
                        'contohSoal' => function ($url, $model) {
                            if ($model->contoh_soal) {
                                return Html::a('Contoh Soal', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            } else {
                                return Html::a('Contoh Soal', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                        },
                        'nilai' => function ($url, $model) {
                            if ($model->nilai) {
                                return Html::a('Nilai', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('Nilai', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                        },
                        'kueisioner' => function ($url, $model) {
                            if ($model->kueisioner) {
                                return Html::a('Kueisioner', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('Kueisioner', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }  
                        },
                        'evaluasi' => function ($url, $model) {
                            if ($model->evaluasi) {
                                return Html::a('Evaluasi', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('Evaluasi', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                        },
                        'kinerja' => function ($url, $model) {
                            if ($model->kinerja) {   
                                return Html::a('Kinerja', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-success btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                            else {
                                return Html::a('Kinerja', '/ref-mata-kuliah/monitoring-update?id='.$model->id, [
                                    'data-original-title' => 'Perbarui',
                                    'title'               => 'Perbarui',
                                    'data-toggle'         => 'tooltip',
                                    'class'               => 'btn btn-warning btn-xs',
                                    // 'role'                => 'modal-remote',
                                ]);
                            }
                        },
                    ],
                    'visibleButtons' =>
                    [
                        
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>