<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
// include "include/sidebar.php";
if ($resultRoleModules['da_one'] == 'none' && $resultRoleModules['da_two'] == 'none') {
    $TitleDashboard = 'none!important';
} else {
    $TitleDashboard = 'show';
}

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
    $TitleViewDataOnline = 'none!important';
    $long = '8';
} else {
    $TitleViewDataOnline = 'show';
}

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
    $TitleReport = 'none!important';
} else {
    $TitleReport = 'show';
}
?>
<!-- begin #content -->
<div id="content" style="padding: 20px">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fab fa-medapps icon-page"></i>
                <font class="text-page">Index / <?= $alertAppName ?></font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Perusahaan: <?= $resultSetting['company']  ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- Alert -->
    <?php if ($access['nama_lengkap'] == NULL) { ?>
        <div class="note note-danger" style="margin-bottom: 10px;">
            <div class="note-icon"><i class="fas fa-id-badge"></i></div>
            <div class="note-content">
                <h4><b>Lengkapi Profile Anda!</b></h4>
                <p> Anda belum melengkapi profile anda! <a href="usr_profile.php" style="color:#bd0500;"><b>Klik Disini!</b></a> untuk melengkapi data profile anda!</p>
            </div>
        </div>
    <?php } else { ?>
    <?php } ?>
    <!-- End Alert -->
    <!-- Informasi -->
    <?php
    $dataForInfo = $dbcon->query("SELECT * FROM tbl_informasi WHERE id='1'");
    $resultForInfo = mysqli_fetch_array($dataForInfo);
    ?>
    <?php if ($resultForInfo['info_tipe'] == 'Text Berjalan') { ?>
        <div style="background: <?= $resultForInfo['info_bg'] ?>;padding: 5px;border-radius: 5px;margin-bottom: 10px;">
            <marquee style="color: <?= $resultForInfo['info_color'] ?>" class="text-announcement-m"><b><i class="<?= $resultForInfo['info_icon'] ?>"></i> <?= $resultForInfo['info_title'] ?></b>
                <?= $resultForInfo['info_isi'] ?></marquee>
        </div>
    <?php } else if ($resultForInfo['info_tipe'] == 'Blink') { ?>
        <div style="background: <?= $resultForInfo['info_bg'] ?>;padding: 5px;border-radius: 5px;margin-bottom: 10px;">
            <p style="color: <?= $resultForInfo['info_color'] ?>" class="text-announcement blink_me"><b><i class="<?= $resultForInfo['info_icon'] ?>"></i> <?= $resultForInfo['info_title'] ?></b>
                <?= $resultForInfo['info_isi'] ?></p>
        </div>
    <?php } else { ?>
    <?php } ?>
    <!-- End Informasi -->
    <!-- End Begin Row -->
    <div id="services" class="services section-show" style="background: #fff;padding: 20px;border-radius: 5px;">
        <div class="col-xl-12 col-md-12">
            <div class="section-title">
                <h2>Menu</h2>
                <p style="color: #333;">NAVIGATION</p>
            </div>
            <hr>
            <div class="row" style="justify-content: center;">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" style="display: <?= $TitleDashboard ?>;">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-solid fa-chart-pie"></i></div>
                        <h4><a href="index_dashboard.php">Dashboard</a></h4>
                        <p>Menampilkan Monitoring Data PLB (Pusat Logistik Berikat) dan GB (Gudang Berikat) dari module Ciesa <?= $resultHeadSetting['company'] ?></p>
                        <div style="margin-top: 25px;">
                            <a href="index_dashboard.php" class="btn btn-default-index">Lihat Dahsboard</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" style="display: <?= $TitleViewDataOnline ?>;">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-solid fa-globe"></i></div>
                        <h4><a href="index_viewonline.php">Data Online</a></h4>
                        <p>Menampilkan Data online PLB (Pusat Logistik Berikat) dan GB (Gudang Berikat) dari module Ciesa <?= $resultHeadSetting['company'] ?></p>
                        <div style="margin-top: 25px;">
                            <a href="index_viewonline.php" class="btn btn-default-index">Lihat Data Online</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" style="display: <?= $TitleReport ?>;">
                    <div class="icon-box">
                        <div class="icon"><i class="fa-solid fa-laptop-file"></i></div>
                        <h4><a href="index_report.php">Laporan</a></h4>
                        <p>Menampilkan laporan Data PLB (Pusat Logistik Berikat) dan GB (Gudang Berikat) dari module Ciesa <?= $resultHeadSetting['company'] ?></p>
                        <div style="margin-top: 25px;">
                            <a href="index_report.php" class="btn btn-default-index">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Begin Row -->
    <?php include "include/creator.php"; ?>
</div>
<?php
include "include/panel.php";
include "include/footer.php";
?>

<script type="text/javascript">
    // UPDATE PASSWORD SUCCESS
    if (window?.location?.href?.indexOf('SUpdatePasswordSuccessCC') > -1) {
        Swal.fire({
            title: 'Password berhasil diupdate!',
            icon: 'success',
            text: 'Password berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './index.php');
    }
</script>