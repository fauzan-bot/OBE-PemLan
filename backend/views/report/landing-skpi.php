<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RefMahasiswa;
use kartik\datecontrol\DateControl;

$this->title = 'Cetak SKPI';
$this->params['breadcrumbs'][] = $this->title;

$js = <<< JS

JS;
$this->registerJs($js);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Laporan Surat Keterangan Pendamping Ijazah</h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['method' => 'post']); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 10px;">Nama</label>
            <div class="input-group col-sm-10">
                <input value="<?= $data->nama ?>" name="nama" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <label class="col-sm-2 control-label" style="margin-top: 10px;">NIM</label>
            <div class="input-group col-sm-10">
                <input value="<?= $data->nim ?>" name="nim" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group" style="margin-top: -5px;">
            <label class="col-sm-2 control-label" style="margin-top: 18px;">Tempat dan Tanggal Lahir</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'ttl')->label(false)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 18px;">
            <label class="col-sm-2 control-label" style="margin-top: 10px;">Tanggal Masuk</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'tgl_masuk')->label(false)->textInput(['maxlength' => true])->widget(\kartik\date\DatePicker::class, [
                    'options' => ['placeholder' => 'Pilih Tanggal ...'],
                    'language' => 'id',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd MM yyyy'
                    ]
                ]) ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: -12px;">
            <label class="col-sm-2 control-label" style="margin-top: 10px;">Tanggal Lulus</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'tgl_lulus')->label(false)->textInput(['maxlength' => true])
                    ->widget(
                        \kartik\date\DatePicker::class,
                        [
                            'options' => ['placeholder' => 'Pilih Tanggal ...'],
                            'language' => 'id',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd MM yyyy',
                            ]
                        ]
                    ) ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: -21px;">
            <label class="col-sm-2 control-label" style="margin-top: 20px;">Total SKS</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'total_sks')->label(false)
                    ->textInput(
                        [
                            'maxlength' => true,
                            'type' => 'number',
                            'min' => '0',
                            'max' => '250',
                        ]
                    )
                ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: -10px;">
            <label class="col-sm-2 control-label" style="margin-top: 22px;">Nomor SKPI</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'no_skpi')->label(false)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <?= Html::button(
                    'Back',
                    [
                        'name' => 'btnBack',
                        'class' => 'btn btn-danger',
                        'onclick' => "window.location.href='" . Yii::$app->urlManager
                            ->createUrl(['monev-cpl/individual', 'jk' => $data->id]) . "';",
                    ]
                ); ?>
                <?= Html::submitButton(
                    'Save',
                    [
                        'class' => 'btn btn-success',
                        'formaction' => Yii::$app->urlManager->createUrl(['report/save', 'jk' => $data->id]),
                        'formmethod' => 'post'
                    ]
                )
                ?>
                <?= Html::submitButton('Print', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>