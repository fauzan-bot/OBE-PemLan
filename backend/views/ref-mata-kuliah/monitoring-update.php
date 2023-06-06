<?php

use yii\helpers\Html;

$this->title = 'Update Monitoring Pembelajaran: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Mata Kuliah', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Data</h1>
    </div>
    <div class="panel-body">

        <?= $this->render('_moform', [
            'model' => $model,
        ]) ?>
    </div>
</div>