<?php

use backend\models\RefCpl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js", [
	'depends' => ["yii\web\JqueryAsset"]
]);
$this->registerJsFile("@web/js/utils.js", [
	'depends' => ["yii\web\JqueryAsset"]
]);

$_data = Json::encode(array_values($data));
$_label = RefCpl::find()
	->orderBy(['id' => SORT_ASC])
	->where(['status' => 1])
	->all();
$_label = ArrayHelper::getColumn($_label, 'kode');
$_label = Json::encode(array_values($_label));

$url = Url::to(['/report/chart']);

//echo '<pre>';
//print_r($_label);
//exit;
$js = <<< JS

		$('#download').click(function(){
			/*Get image of canvas element*/
			var radar = document.getElementById("radar").toDataURL("image/png");
			var bar   = document.getElementById("vertical-bar").toDataURL("image/png");
			$.ajax({
					url: "{$url}",
					type: 'POST',
					data: {radar: radar, bar: bar, id_mahasiswa:$id_mahasiswa}
				});
		});

		var color = Chart.helpers.color;
		var radarData = {
			labels: $_label,
			datasets: [{
				label: 'Nilai Capaian',
				backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
				borderColor: window.chartColors.red,
				pointBackgroundColor: window.chartColors.red,
				data: $_data,
				fill: true
			}]
		};

		var color = Chart.helpers.color;
		var barChartData = {
			labels: $_label,
			datasets: [{
				label: 'Nilai Capaian',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: $_data,
				fill: true
			}]
		};

		window.onload = function() {
			// window.myRadar = new Chart(document.getElementById('radar'), config);

			var radar = document.getElementById('radar');
			window.myRadar = new Chart(radar, {
				type: 'radar',
				data: radarData,
				options: {
					legend: {
						position: 'top',
					},
					
					title: {
						display: true,
						text: "$mahasiswa->nama"
					},
					scale: {
						ticks: {
							min: 0,
							max: 100
						}
					},
					tooltips: {
						intersect: false,
						enabled: true,
						displayColors: false,
						title: false,
						callbacks: {
							title: function(tooltipItem) {
								return tooltipItem.yLabel;
							},
							label: function(tooltipItem, data) {
								var label = data.labels[tooltipItem.index];
								var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
								return val;
							}
						}
					},
				}
			});


			var ctx = document.getElementById('vertical-bar').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					scales: {
						yAxes: [{
							ticks: {
								min: 0,
								max: 100
							}
						}]
					},
					title: {
						display: true,
						text: "$mahasiswa->nama"
					},
					tooltips: {
						enabled: true,
						displayColors: false,
						title: false,
						callbacks: {
							title: function(tooltipItem) {
								return tooltipItem.yLabel;
							},
							label: function(tooltipItem, data) {
								var label = data.labels[tooltipItem.index];
								var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
								return val;
							}
						}
					}
				}
			});
		};
JS;

$this->registerJs($js);

$css = <<< CSS
canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background: none;
    outline: none;
}
CSS;
$this->registerCss($css);
?>
<?php
if ($mahasiswa->status == 1) {
	$status = 'Aktif';
} else if ($mahasiswa->status == 9) {
	$status = 'DO';
} else if ($mahasiswa->status == 8) {
	$status = 'Lulus';
} else if ($mahasiswa->status == 7) {
	$status = 'Undur Diri';
} else if ($mahasiswa->status == 6) {
	$status = 'Hilang';
} else if ($mahasiswa->status == 5) {
	$status = 'Meninggal Dunia';
} else {
	$status = 'Tidak Ditemukan';
}
$this->title = 'Capaian Pembelajaran Lulusan Per Individu';
?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-body ">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<?php echo Html::a('<i></i> Pilih Mahasiswa', ['landing-individual'], [
								'class' => 'btn btn-success btn-flat',
								'role' => 'modal-remote',
							]) ?>
						</div>
						<div class="col-sm-6">
							<p align="right">
								<?= Html::a('Transkip Nilai', [
									'/capaian-mahasiswa/download-transkip/',
									'jk' => $id_mahasiswa
								], ['class' => 'btn btn-success']) ?>
								<a id="download" download="ChartImage.jpg" class="btn btn-primary float-right bg-flat-color-1" title="Download">
									<!-- <i class="fa fa-download"></i> -->
									Cetak SKPI
								</a>
								<!-- <a type="button" id="link2" class="btn btn-primary">Download</a> -->
							</p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label id="nim" class="col-sm-2 control-label">Nim</label>
					<div class="col-sm-10">
						<input value="<?php echo $mahasiswa->nim ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label id="nim" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-10">
						<input value="<?php echo $mahasiswa->nama ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label id="nim" class="col-sm-2 control-label">Angkatan</label>
					<div class="col-sm-10">
						<input value="<?php echo $mahasiswa->angkatan ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label id="nim" class="col-sm-2 control-label">Status</label>
					<div class="col-sm-10">
						<input value="<?php echo $status ?>" class="form-control" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box box-solid">

	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Grafik Radar</a></li>
		<li><a data-toggle="tab" href="#menu1">Grafik Bar</a></li>
		<li><a data-toggle="tab" href="#nilai1">Evaluasi Nilai</a></li>
	</ul>
	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<div style="width:80% , center">
				<canvas id="radar"></canvas>
			</div>
		</div>
		<div id="menu1" class="tab-pane fade in active">
			<div id="container" style="width: 50%, center">
				<canvas id="vertical-bar"></canvas>
			</div>
		</div>
		<div id="nilai1" class="tab-pane fade in active">
			<div id="container" style="width: 50%, center;">
				<ul class="nav nav-tabs">
					<?php for ($x = 0; $x < count($eval); $x++) : ?>
						<li><a data-toggle="tab" href="#cpmk<?= $x + 1 ?>">CPL <?= $x + 1 ?></a></li>
					<?php endfor; ?>
				</ul>
				<div class="tab-content">
					<?php for ($z = 1; $z <= count($eval); $z++) : ?>
						<div class="tab-pane fade in active" id="cpmk<?= $z ?>">
							<table class="table table-striped" style="table-layout: fixed">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nilai</th>
										<th scope="col">Ref Cpmk</th>
										<th scope="col">Mata Kuliah</th>
										<th scope="col">Dosen</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php for ($y = 0; $y < count($eval[$z]); $y++) : ?>
										<tr>
											<th scope="row"><?= $no ?></th>
											<td><?= $eval[$z][$y]['nilai'] ?></td>
											<td><?= $eval[$z][$y]['refCpmk']['isi'] ?></td>
											<td><?= $eval[$z][$y]['mataKuliah']['nama'] ?></td>
											<td><?= $eval[$z][$y]['dosen']['nama_dosen'] ?></td>
										</tr>
										<?php $no++; ?>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
</div>