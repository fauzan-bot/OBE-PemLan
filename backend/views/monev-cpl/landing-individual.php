<?php

use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

$url = \yii\helpers\Url::to(['mahasiswa-list', 'status' => 1]);
$url2 = \yii\helpers\Url::to(['angkatan-list', 'status' => 1]);

?>

<div style="margin: 0 12px 20px;">
    <?php $form = ActiveForm::begin(); ?>
    <?php

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

    //drop down tahun untuk filter mahasiswa
    // echo $form->field($model, 'tahun')->widget(Select2::classname(), [
    //     'data' => ['2013' => '2013', '2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021', '2022' => '2022'],
    //     'options' => [
    //         'placeholder' => '- Pilih -',
    //         'id' => 'input-tahun' // tambah id pada dropdown tahun
    //     ],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    // ]);

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