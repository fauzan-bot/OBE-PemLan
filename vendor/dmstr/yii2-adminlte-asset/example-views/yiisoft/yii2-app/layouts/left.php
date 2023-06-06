<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Dosen</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <form class="sidebar-form">
                <select id="tahun_ajaran_aktif" class="form-control">
                    <option>-- Tahun Ajaran --</option>
                    <option value="3">2019/2020</option>
                    <option value="2">2018/2019</option>
                    <option value="1">2017/2018</option>
                    <option value="4">2016/2017</option>
                </select>
            </form>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                    ['label' => 'Import Nilai', 'icon' => 'ioxhost', 'url' => ['/data-utama']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'CP Lulusan',
                        'icon' => 'black-tie',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Referensi CPL', 'icon' => 'file-code-o', 'url' => ['/ref-cpl'],],
                            [
                                'label' => 'Monev CPL',
                                'icon' => 'file-code-o',
                                'url' => ['#'],
                                'items' => [
                                    ['label' => 'CPL Individual', 'icon' => 'file-code-o', 'url' => ['/monev-cpl'],],
                                    ['label' => 'CPL Semester', 'icon' => 'file-code-o', 'url' => ['/#'],],
                                    ['label' => 'CPL Angkatan', 'icon' => 'file-code-o', 'url' => ['/#'],],
                                    ['label' => 'CPL Lulusan', 'icon' => 'file-code-o', 'url' => ['/#'],],
                                ]
                            ],
                        ],
                    ],
                    [
                        'label' => 'CP Mata Kuliah',
                        'icon' => 'black-tie',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Mata Kuliah', 'icon' => 'file-code-o', 'url' => ['/ref-mata-kuliah'],],
                            ['label' => 'CPMK', 'icon' => 'file-code-o', 'url' => ['/ref-cpmk'],],
                            ['label' => 'Relasi CPMK to CPL', 'icon' => 'file-code-o', 'url' => ['/relasi-cpmk-cpl'],],
                        ],
                    ],
                    [
                        'label' => 'Data Pendukung',
                        'icon' => 'black-tie',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Mahasiswa', 'icon' => 'file-code-o', 'url' => ['/ref-mahasiswa'],],
                            ['label' => 'Tahun Ajaran', 'icon' => 'file-code-o', 'url' => ['/ref-tahun-ajaran'],],
                            ['label' => 'Kelas', 'icon' => 'file-code-o', 'url' => ['/ref-kelas'],],
                        ],
                    ],
                    ['label' => 'Setup User', 'icon' => 'user', 'url' => ['#']],
                    ['label' => 'Tentang', 'icon' => 'optin-monster', 'url' => ['#']],

                ],
            ]
        ) ?>

    </section>

</aside>