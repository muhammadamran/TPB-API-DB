<?php if ($resultSetting['bg_sidebar'] == NULL) { ?>
<style>
.sidebar .nav>li.nav-profile .cover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('assets/images/sidebar/sidebar-default.png');
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<?php } else { ?>
<style>
.sidebar .nav>li.nav-profile .cover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('assets/images/sidebar/<?= $resultSetting['bg_sidebar'] ?>');
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<?php } ?>
<?php
$user = $_SESSION['username'];
$roleSidebar = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$user' ");
$accessSidebar = mysqli_fetch_array($roleSidebar);
?>
<?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <?php if ($accessSidebar['foto'] == NULL || $accessSidebar['foto'] == 'default-user-images.jpeg') { ?>
                        <img src="assets/images/users/default-user-images.jpeg" alt="Foto Profile" />
                        <?php } else { ?>
                        <img src="assets/images/users/<?= $accessSidebar['foto'] ?>" alt="Foto Profile" />
                        <?php } ?>
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        <!-- NAMA LENGKAP -->
                        <?php if ($accessSidebar['nama_lengkap'] == NULL) { ?>
                        Belum dilengkapi!
                        <?php } else { ?>
                        <?= $accessSidebar['nama_lengkap'] ?>
                        <?php } ?>
                        <!-- END NAMA LENGKAP -->
                        <!-- HAK AKSES -->
                        <small><?= $accessSidebar['role'] ?></small>
                        <!-- END HAK AKSES -->
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="usr_profile.php"><i class="fa-solid fa-user-gear"></i> Profile</a></li>
                    <?php if ($resultForPrivileges['UPDATE_PASSWORD'] == 'Y') { ?>
                    <li><a href="usr_password.php"><i class="fa-solid fas fa-lock"></i> Ganti Password</a></li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-header">NAVIGATION</li>
            <li class="<?= $uriSegments[1] == 'index.php' ? 'active' : '' ?>">
                <a href="index.php"><i class="fas fa-chalkboard-teacher"></i> <span>Index</span></a>
            </li>
            <!-- <li class="<?= $uriSegments[1] == 'dashboard.php' ? 'active' : '' ?>">
				<a href="dashboard.php"><i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
			</li> -->
            <?php
			if ($resultRoleModules['da_one'] == 'none' && $resultRoleModules['da_two'] == 'none') {
				$TitleDashboard = 'none';
			} else {
				$TitleDashboard = 'show';
			}
			?>
            <li class="<?= $uriSegments[1] == 'index_dashboard.php' ? 'active' : '' ?>"
                style="display: <?= $TitleDashboard ?>;">
                <a href="index_dashboard.php"><i class="fas fa-chart-pie"></i> <span>Dashboard - Summary</span></a>
            </li>
            <!-- <li class="<?= $uriSegments[1] == 'index_summary.php' ? 'active' : '' ?>">
				<a href="index_summary.php"><i class="fas fa-tasks"></i> <span>Summary</span></a>
			</li> -->
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
            <li class="<?= $uriSegments[1] == 'index_viewonline.php' ? 'active' : '' ?>"
                style="display: <?= $TitleViewDataOnline ?>;">
                <a href="index_viewonline.php"><i class="fas fa-globe"></i> <span>View Data Online</span></a>
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
            <li class="<?= $uriSegments[1] == 'index_report.php' ? 'active' : '' ?>"
                style="display: <?= $TitleReport ?>;">
                <a href="index_report.php"><i class="fas fa-clipboard"></i> <span>Report</span></a>
            </li>
            <!-- Dokumen Pabean -->
            <?php include 'modules/DokumenPabean/menu.php' ?>
            <!-- Gate Mandiri -->
            <?php
			// include 'modules/GateMandiri/menu.php' 
			?>
            <!-- Komunikasi -->
            <?php
			// include 'modules/Komunikasi/menu.php' 
			?>
            <!-- Database -->
            <?php include 'modules/Database/menu.php' ?>
            <!-- Referensi -->
            <?php include 'modules/Referensi/menu.php' ?>
            <!-- Utility -->
            <?php
			// include 'modules/Utility/menu.php' 
			?>
            <!-- Report -->
            <?php
			// include 'modules/Report/menu.php' 
			?>
            <!-- Administrator -->
            <?php include 'modules/Administrator/menu.php' ?>
            <!-- Do not delete! "begin sidebar minify button" -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- End Do not delete! "begin sidebar minify button" -->
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->