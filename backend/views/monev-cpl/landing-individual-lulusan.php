<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

$url = \yii\helpers\Url::to(['mahasiswa-list', 'status' => 8]);
$url2 = \yii\helpers\Url::to(['angkatan-list', 'status' => 8]);

?>

<div style="margin: 0 12px 20px;">
    <?php $form = ActiveForm::begin([
        // 'action'    => Url::to(['download', 'dl' => 1])
    ]); ?>
    <?php
    // echo "<pre>";
    // print_r($mahasiswa);
    // exit;
    // echo $form->field($model, 'id_ref_mahasiswa')->widget(Select2::classname(), [
    //     'data' => $mahasiswa,
    //     'options' => [
    // 'id'    => 'id_tahun_ajaran',
    // 'name'  => 'id_tahun_ajaran',
    //         'placeholder' => '- Pilih -'
    //     ],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    // ]);

    echo $form->field($model2, 'angkatan')->widget(Select2::classname(), [
        'options' => ['multiple' => false, 'placeholder' => 'Ketik tahun angkatan ...', 'id' => 'input-tahun'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url2,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ]
        ],
    ]);

    echo $form->field($model, 'id_ref_mahasiswa')->widget(Select2::classname(), [
        'options' => ['multiple' => false, 'placeholder' => 'Ketik nama ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) {
                    var tahun = $("#input-tahun").val(); // ambil nilai dropdown tahun
                    return { q: params.term, angkatan: tahun }; // gunakan nilai input tahun sebagai angkatan
                }'),
            ],
        ],
    ]);

    ?>
    <?php ActiveForm::end(); ?>
</div>