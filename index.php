<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
// include "include/sidebar.php";
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
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span
                    id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <style type="text/css">
    #for-alert-index {
        margin-bottom: -35px;
        padding: 10px;
    }

    #for-info-index {
        /*margin-top: 30px;*/
        margin-bottom: -50px;
        padding: 10px;
    }
    </style>
    <!-- begin row -->
    <div class="col-xl-12 col-md-12" id="for-alert-index">
        <!-- Alert -->
        <?php if ($access['nama_lengkap'] == NULL) { ?>
        <div class="note note-danger">
            <div class="note-icon"><i class="fas fa-id-badge"></i></div>
            <div class="note-content">
                <h4><b>Lengkapi Profile Anda!</b></h4>
                <p> Anda belum melengkapi profile anda! <a href="usr_profile.php" style="color:#bd0500;"><b>Klik
                            disini!</b></a> untuk melengkapi data profile anda!</p>
            </div>
        </div>
        <?php } else { ?>
        <?php } ?>
        <!-- End Alert -->
    </div>
    <div class="col-xl-12 col-md-12" id="for-info-index">
        <?php
        $dataForInfo = $dbcon->query("SELECT * FROM tbl_informasi WHERE id='1'");
        $resultForInfo = mysqli_fetch_array($dataForInfo);
        ?>
        <?php if ($resultForInfo['info_tipe'] == 'Text Berjalan') { ?>
        <div style="background: <?= $resultForInfo['info_bg'] ?>;padding: 5px;border-radius: 5px;margin-bottom: 10px;">
            <marquee style="color: <?= $resultForInfo['info_color'] ?>" class="text-announcement-m"><b><i
                        class="<?= $resultForInfo['info_icon'] ?>"></i> <?= $resultForInfo['info_title'] ?></b>
                <?= $resultForInfo['info_isi'] ?></marquee>
        </div>
        <?php } else if ($resultForInfo['info_tipe'] == 'Blink') { ?>
        <div style="background: <?= $resultForInfo['info_bg'] ?>;padding: 5px;border-radius: 5px;margin-bottom: 10px;">
            <p style="color: <?= $resultForInfo['info_color'] ?>" class="text-announcement blink_me"><b><i
                        class="<?= $resultForInfo['info_icon'] ?>"></i> <?= $resultForInfo['info_title'] ?></b>
                <?= $resultForInfo['info_isi'] ?></p>
        </div>
        <?php } else { ?>
        <?php } ?>
    </div>
    <!-- end row -->

    <!-- Begin Row -->
    <style>
    .row-choose {
        display: flex;
        margin-top: 30px;
        /*margin-bottom: 30px;*/
        justify-content: center;
    }

    .class-utama {
        padding: 10px;
        width: 100%;
    }

    @media only screen and (min-width: 800px) {
        .class-utama {
            padding: 10px;
            width: 30%;
        }
    }

    .class-one {
        background: #fff;
        border-radius: 5px;
    }

    .class-one:hover {
        box-shadow: 0 5px 25px rgb(0 0 0 / 30%)
    }

    .show-choose {
        position: relative;
    }

    .image {
        display: block;
        width: 100%;
        height: auto;
    }

    .overlay {
        position: absolute;
        bottom: 100%;
        left: 0;
        right: 0;
        background-color: #4f78c9de;
        overflow: hidden;
        width: 100%;
        height: 0;
        transition: .5s ease;
        border-radius: 5px;
    }

    .show-choose:hover .overlay {
        bottom: 0;
        height: 100%;
    }

    .text {
        color: white;
        font-size: 20px;
        font-weight: 700;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }


    @media (max-width: 992.5px) {
        .row-choose {
            display: grid;
            justify-items: center;
        }
    }
    </style>
    <?php
    if ($resultRoleModules['da_one'] == 'none' && $resultRoleModules['da_two'] == 'none') {
        $TitleDashboard = 'none';
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
        $TitleViewDataOnline = 'none';
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
        $TitleReport = 'none';
    } else {
        $TitleReport = 'show';
    }
    ?>
    <div class="row-choose">
        <!-- begin col-3 -->
        <!-- <div class="col-md-4"> -->
        <!-- <a href="index_dashboard.php" class="class-utama"> -->
        <a href="index_dashboard.php" class="class-utama" style="display: <?= $TitleDashboard ?>;">
            <div class="class-one">
                <div class="show-choose">
                    <img src="assets/img/icons/dashboard-summary.png" alt="DASHBOARD" class="image">
                    <div class="overlay">
                        <div class="text">DASHBOARD</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- </div> -->
        <!-- <a href="index_summary.php" class="class-utama">
			<div class="class-one">
				<div class="show-choose">
				  <img src="assets/img/icons/summary.png" alt="SUMMARY" class="image">
				  <div class="overlay">
				    <div class="text">SUMMARY</div>
				  </div>
				</div>
			</div>
		</a> -->
        <!-- <div class="col-md-4" style="display: <?= $TitleViewDataOnline ?>;"> -->
        <a href="index_viewonline.php" class="class-utama" style="display: <?= $TitleViewDataOnline ?>;">
            <div class="class-one">
                <div class="show-choose">
                    <img src="assets/img/icons/viewonline.png" alt="VIEW DATA" class="image">
                    <div class="overlay">
                        <div class="text">VIEW DATA ONLINE</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- </div> -->
        <!-- <div class="col-md-4" style="display: <?= $TitleReport ?>;"> -->
        <a href="index_report.php" class="class-utama" style="display: <?= $TitleReport ?>;">
            <div class="class-one">
                <div class="show-choose">
                    <img src="assets/img/icons/report.png" alt="REPORT" class="image">
                    <div class="overlay">
                        <div class="text">REPORT</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- </div> -->
        <!-- end col-3 -->
    </div>
    <!-- End Begin Row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
// include "include/panel.php";
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