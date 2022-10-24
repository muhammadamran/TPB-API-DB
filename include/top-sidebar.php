<style type="text/css">
.nav-top-content {
    padding: 20px;
    margin-top: 30px;
}

@media (max-width: 767.5px) {
    .nav-top-content {
        padding: 20px;
        margin-top: 0px;
    }
}
</style>
<!-- begin #top-menu -->
<div id="top-menu" class="top-menu">
    <!-- begin nav -->
    <ul class="nav">
        <li>
            <a href="index.php">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Index </span>
            </a>
        </li>
        <style type="text/css">
        li.active-top {
            background: #2d353c;
        }
        </style>
        <?php $uriSegmentsTop = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
        <?php
		if ($resultRoleModules['da_one'] == 'none' && $resultRoleModules['da_two'] == 'none') {
			$TitleDashboard = 'none';
		} else {
			$TitleDashboard = 'show';
		}
		?>
        <li class="<?= $uriSegmentsTop[1] == 'index_dashboard.php' ? 'active-top' : '' ?>"
            style="display: <?= $TitleDashboard ?>;">
            <a href="index_dashboard.php">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard - Summary </span>
            </a>
        </li>
        <?php
		if (
			$resultRoleModules['v_bc'] == 'none' &&
			$resultRoleModules['v_cttpb'] == 'none' &&
			$resultRoleModules['v_filterttpb'] == 'none' &&
			$resultRoleModules['v_daftar_barang'] == 'none' &&
			$resultRoleModules['v_tarif_hs'] == 'none' &&
			$resultRoleModules['v_pemasok'] == 'none' &&
			$resultRoleModules['v_perusahaan'] == 'none' &&
			$resultRoleModules['v_alat_angkut'] == 'none' &&
			$resultRoleModules['v_tempat_penimbunan'] == 'none' &&
			$resultRoleModules['v_kantor_bea_cukai'] == 'none' &&
			$resultRoleModules['v_negara'] == 'none' &&
			$resultRoleModules['v_pelabuhan_dn'] == 'none' &&
			$resultRoleModules['v_pelabuhan_ln'] == 'none' &&
			$resultRoleModules['v_mata_uang'] == 'none' &&
			$resultRoleModules['v_satuan'] == 'none' &&
			$resultRoleModules['v_kemasan'] == 'none' &&
			$resultRoleModules['v_departemen'] == 'none' &&
			$resultRoleModules['v_hak_akses'] == 'none' &&
			$resultRoleModules['v_jabatan'] == 'none' &&
			$resultRoleModules['v_kuota_mitra'] == 'none' &&
			$resultRoleModules['v_pengaturan_tbb'] == 'none' &&
			$resultRoleModules['v_pengaturan_realtime'] == 'none' &&
			$resultRoleModules['v_pengaturan_informasi'] == 'none' &&
			$resultRoleModules['v_user_manajemen'] == 'none'
		) {
			$TitleViewDataOnline = 'none';
		} else {
			$TitleViewDataOnline = 'show';
		}
		?>
        <li class="<?= $uriSegmentsTop[1] == 'index_viewonline.php' ? 'active-top' : '' ?>"
            style="display: <?= $TitleViewDataOnline ?>;">
            <a href="index_viewonline.php">
                <i class="fas fa-globe"></i>
                <span>View Data Online </span>
            </a>
        </li>
        <?php
		if (
			$resultRoleModules['re_masuk_barang'] == 'none' &&
			$resultRoleModules['re_keluar_barang'] == 'none' &&
			$resultRoleModules['re_mutasi_barang'] == 'none' &&
			$resultRoleModules['re_posisi_barang'] == 'none' &&
			$resultRoleModules['re_realisasi'] == 'none' &&
			$resultRoleModules['re_data_tpb'] == 'none' &&
			$resultRoleModules['re_ck_plb'] == 'none' &&
			$resultRoleModules['re_ck_sarinah'] == 'none' &&
			$resultRoleModules['re_log'] == 'none'
		) {
			$TitleReport = 'none';
		} else {
			$TitleReport = 'show';
		}
		?>
        <li class="has-sub
				   <?= $uriSegmentsTop[1] == 'index_report.php' ||
						$uriSegmentsTop[1] == 'report_masuk_barang.php' ||
						$uriSegmentsTop[1] == 'report_keluar_barang.php' ||
						$uriSegmentsTop[1] == 'report_mutasi_barang.php' ||
						$uriSegmentsTop[1] == 'report_posisi_barang.php' ||
						$uriSegmentsTop[1] == 'report_realisasi.php' ||
						$uriSegmentsTop[1] == 'report_realisasi_all_mitra.php' ||
						$uriSegmentsTop[1] == 'report_realisasi_per_mitra.php' ||
						$uriSegmentsTop[1] == 'report_realisasi_per_tahun.php' ||
						$uriSegmentsTop[1] == 'report_data_tpb.php' ||
						$uriSegmentsTop[1] == 'report_log_system.php' ||
						$uriSegmentsTop[1] == 'report_ck5_plb_data.php' ||
						$uriSegmentsTop[1] == 'report_ck5_plb.php' ||
						$uriSegmentsTop[1] == 'report_ck5_sarinah.php'
						? 'active-top' : '' ?>" style="display: <?= $TitleReport ?>;">
            <a href="index_report.php">
                <i class="fas fa-clipboard"></i>
                <span>Report </span>
            </a>
            <ul class="sub-menu">
                <li class="<?= $uriSegmentsTop[1] == 'report_masuk_barang.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_masuk_barang']; ?>;"><a
                        href="report_masuk_barang.php">Masuk Barang</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_keluar_barang.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_keluar_barang']; ?>;"><a
                        href="report_keluar_barang.php">Keluar Barang</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_mutasi_barang.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_mutasi_barang']; ?>;"><a
                        href="report_mutasi_barang.php">Mutasi Barang</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_posisi_barang.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_posisi_barang']; ?>;"><a
                        href="report_posisi_barang.php">Posisi Barang</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_realisasi.php' ||
								$uriSegmentsTop[1] == 'report_realisasi_all_mitra.php' ||
								$uriSegmentsTop[1] == 'report_realisasi_per_mitra.php' ||
								$uriSegmentsTop[1] == 'report_realisasi_per_tahun.php'
								? 'active' : '' ?>" style="display: <?= $resultRoleModules['re_realisasi']; ?>;"><a
                        href="report_realisasi.php">Realisasi</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_data_tpb.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_data_tpb']; ?>;"><a href="report_data_tpb.php">Data
                        TPB</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_ck5_plb.php' || $uriSegmentsTop[1] == 'report_ck5_plb_data.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_ck_plb']; ?>;"><a href="report_ck5_plb.php">PLB CK5</a>
                </li>
                <li class="<?= $uriSegmentsTop[1] == 'report_ck5_sarinah.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_ck_sarinah']; ?>;"><a
                        href="report_ck5_sarinah.php">Sarinah CK5</a></li>
                <li class="<?= $uriSegmentsTop[1] == 'report_log_system.php' ? 'active' : '' ?>"
                    style="display: <?= $resultRoleModules['re_log']; ?>;"><a href="report_log_system.php">Log
                        System</a></li>
            </ul>
        </li>
    </ul>
    <!-- end nav -->
</div>
<!-- end #top-menu -->