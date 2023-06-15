<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RefMahasiswa;

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
            <label class="col-sm-2 control-label">Nama</label>
            <div class="input-group col-sm-10">
                <input value="<?= $data->nama ?>" name="nama" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">NIM</label>
            <div class="input-group col-sm-10">
                <input value="<?= $data->nim ?>" name="nim" class="form-control" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 18px;">Tempat dan Tanggal Lahir</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'ttl')->label(false)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 18px;">Tanggal Masuk</label>
            <div class="input-group col-sm-10 ">
                <?= $form->field($data, 'tgl_masuk')->label(false)->textInput(['maxlength' => true])->widget(\kartik\date\DatePicker::class, [
                    'options' => ['placeholder' => 'Pilih tanggal lulus'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd MM yyyy',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 18px;">Tanggal Lulus</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'tgl_lulus')->label(false)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 22px;">Total SKS</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'total_sks')->label(false)->textInput(['maxlength' => true, 'style' => 'margin-bottom: 0px;margin-top: 0px;']) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" style="margin-top: 22px;">Nomor SKPI</label>
            <div class="input-group col-sm-10">
                <?= $form->field($data, 'no_skpi')->label(false)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <?= Html::button(
                    'Back',
                    array(
                        'name' => 'btnBack',
                        'class' => 'btn btn-danger',
                        'onclick' => "history.go(-1)",
                    )
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