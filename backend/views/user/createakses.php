<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;


$this->title = 'Tambah Hak Akses';
$this->params['breadcrumbs'][] = ['label' => 'Hak akses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Data</h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => $user,
            'options' => [
                'placeholder' => 'Pilih Pengguna'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Pengguna'); ?>

        <?= $form->field($model, 'prodi_id')->widget(Select2::classname(), [
            'data' => $prodi,
            'options' => [
                'placeholder' => 'Pilih Prodi'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Prodi'); ?>

        <?= $form->field($model, 'occupation_id')->widget(Select2::classname(), [
            'data' => $occupation,
            'options' => [
                'placeholder' => 'Pilih Jabatan'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Jabatan'); ?>

        <div class="form-group">
            <?= Html::submitButton('Tambah hak akses', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>