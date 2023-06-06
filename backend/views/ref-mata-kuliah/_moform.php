<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="ref-mata-kuliah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rps')->textInput() ?>
    <?= $form->field($model, 'presensi')->textInput() ?>
    <?= $form->field($model, 'contoh_soal')->textInput() ?>
    <?= $form->field($model, 'nilai')->textInput() ?>
    <?= $form->field($model, 'kueisioner')->textInput() ?>
    <?= $form->field($model, 'evaluasi')->textInput() ?>
    <?= $form->field($model, 'kinerja')->textInput() ?>

    <div class="form-group">
        <?= Html::button(
            'Back',
            array(
                'name' => 'btnBack',
                'class' => 'btn btn-danger',
                'onclick' => "history.go(-1)",
            )
        ); ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>