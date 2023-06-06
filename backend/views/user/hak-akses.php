<?php

use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;
use yii\helpers\Html;
$this->title = 'Hak Akses';
?>

<?php
  if (Yii::$app->user->identity->occupationki->occupation == "administrator") {
  ?>
  <?= Html::a('Tambah hak akses', ['create-akses'], ['class' => 'btn btn-primary']) ?>
<?php
}
?>

<table class="table table-striped" style="table-layout: fixed">
  <thead>
    <tr>
      <th scope="col">no</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Prodi</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach ($userModel as $row): ?>
        <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $row->jabatan->occupation ?></td>
            <td><?= $row->prodit->prodi ?></td>
            <?php if($row->jabatan->occupation == Yii::$app->user->identity->occupationki->occupation && $row->prodit->prodi == Yii::$app->user->identity->prodigy->prodi): ?>
            <td>
              <?= Html::a('Ganti', ['akses'], ['class' => 'btn btn-warning']) ?>
              <?php if (Yii::$app->user->identity->occupationki->occupation == "administrator") : ?>
                <?= Html::a('Hapus', ['delete-akses', 'id' => $row->id], ['class' => 'btn btn-danger']) ?>
              <?php endif ?>
            </td>
            <?php else : ?>
            <td>
              <?= Html::a('Ganti', ['change-status', 'jabatan' => $row->jabatan->id, 'prodi' => $row->prodit->id], ['class' => 'btn btn-success']) ?>
              <?php if (Yii::$app->user->identity->occupationki->occupation == "administrator") : ?>
                <?= Html::a('Hapus', ['delete-akses', 'id' => $row->id], ['class' => 'btn btn-danger']) ?>
              <?php endif ?>
            </td>
            <?php endif ?>  
        </tr>
    <?php $no++; ?>
    <?php endforeach; ?>
  </tbody>
</table>