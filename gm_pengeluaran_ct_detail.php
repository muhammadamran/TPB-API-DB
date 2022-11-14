<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
// KURANG
if (isset($_POST["kurang_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_K'] == 0) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$v_ID_BARANG&Alert=CekBarangMasuk&AJU=$v_NOMOR_AJU';</script>";
    } else {
        $ID_CT                  = $_POST['ID_CT'];
        $NOMOR_AJU              = $_POST['NOMOR_AJU'];
        $ID_BARANG              = $_POST['ID_BARANG'];
        $KODE_BARANG            = $_POST['KODE_BARANG'];
        $Kurang                 = $_POST['TOTAL_BOTOL_K'];
        $TOTAL_BOTOL            = $_POST['TOTAL_BOTOL'];
        $LITER                  = $_POST['LITER'];
        // VALIDASI KURANG
        $cek                    = $TOTAL_BOTOL - $Kurang;
        $t_liter                = $cek * $LITER;
        // END VALIDASI KURANG
        $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek',
                                                         TOTAL_LITER='$t_liter',
                                                         POSISI='IN'
                            WHERE ID='$ID_CT'");
        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
                                (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,KURANG,POSISI)
                                VALUES
                                ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Kurang','IN')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Botol Kurang:" . $Kurang;
        $InputAction          = 'Botol Kurang';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                       (id,IDUNIQ,username,modul,description,action,date_created)
                       VALUES
                       ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertKurang=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertKurang=Failed';</script>";
        }
    }
}

// LEBIH
if (isset($_POST["lebih_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_L'] == 0) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$v_ID_BARANG&Alert=CekBarangMasuk&AJU=$v_NOMOR_AJU';</script>";
    } else {
        $ID_CT                  = $_POST['ID_CT'];
        $NOMOR_AJU              = $_POST['NOMOR_AJU'];
        $ID_BARANG              = $_POST['ID_BARANG'];
        $KODE_BARANG            = $_POST['KODE_BARANG'];
        $Lebih                  = $_POST['TOTAL_BOTOL_L'];
        $TOTAL_BOTOL            = $_POST['TOTAL_BOTOL'];

        $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$TOTAL_BOTOL',
                                                            POSISI='IN'
                            WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,LEBIH,POSISI)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Lebih','IN')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Botol Lebih:" . $Lebih;
        $InputAction          = 'Botol Lebih';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                       (id,IDUNIQ,username,modul,description,action,date_created)
                       VALUES
                       ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertLebih=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertLebih=Failed';</script>";
        }
    }
}

// PECAH
if (isset($_POST["pecah_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_P'] == 0) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$v_ID_BARANG&Alert=CekBarangMasuk&AJU=$v_NOMOR_AJU';</script>";
    } else {
        $ID_CT                  = $_POST['ID_CT'];
        $NOMOR_AJU              = $_POST['NOMOR_AJU'];
        $ID_BARANG              = $_POST['ID_BARANG'];
        $KODE_BARANG            = $_POST['KODE_BARANG'];
        $Pecah                  = $_POST['TOTAL_BOTOL_P'];
        $TOTAL_BOTOL            = $_POST['TOTAL_BOTOL'];
        $LITER                  = $_POST['LITER'];
        // VALIDASI PECAH
        $cek                    = $TOTAL_BOTOL - $Pecah;
        $t_liter                = $cek * $LITER;
        // END VALIDASI PECAH
        $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek',
                                                         TOTAL_LITER='$t_liter',
                                                         POSISI='IN'
                            WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,PECAH,POSISI)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Pecah','IN')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Botol Pecah:" . $Pecah;
        $InputAction          = 'Botol Pecah';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                   (id,IDUNIQ,username,modul,description,action,date_created)
                   VALUES
                   ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
        if ($query) {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertPecah=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertPecah=Failed';</script>";
        }
    }
}

// RUSAK
if (isset($_POST["rusak_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_R'] == 0) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$v_ID_BARANG&Alert=CekBarangMasuk&AJU=$v_NOMOR_AJU';</script>";
    } else {
        $ID_CT                  = $_POST['ID_CT'];
        $NOMOR_AJU              = $_POST['NOMOR_AJU'];
        $ID_BARANG              = $_POST['ID_BARANG'];
        $KODE_BARANG            = $_POST['KODE_BARANG'];
        $Rusak                  = $_POST['TOTAL_BOTOL_R'];
        $TOTAL_BOTOL            = $_POST['TOTAL_BOTOL'];
        $LITER                  = $_POST['LITER'];
        // VALIDASI RUSAK
        $cek                    = $TOTAL_BOTOL - $Rusak;
        $t_liter                = $cek * $LITER;
        // END VALIDASI RUSAK
        $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek',
                                                         TOTAL_LITER='$t_liter',
                                                         POSISI='IN'
                            WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,RUSAK,POSISI)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Rusak','IN')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Botol Rusak:" . $Rusak;
        $InputAction          = 'Botol Rusak';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                   (id,IDUNIQ,username,modul,description,action,date_created)
                   VALUES
                   ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertRusak=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertRusak=Failed';</script>";
        }
    }
}

// HAPUS 1 KARTON
if (isset($_POST["Delete_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU         = $_POST['NOMOR_AJU'];
    $ID_BARANG         = $_POST['ID_BARANG'];
    $KODE_BARANG       = $_POST['KODE_BARANG'];
    $InputDate         = date('Y-m-d h:m:i');

    $query = $dbcon->query("UPDATE plb_barang_ct SET STATUS_CT='Broken',
                                                     DATE_CT='$InputDate',
                                                     POSISI='IN'
                            WHERE ID='$ID_CT'");
    // FOR AKTIFITAS
    $me         = $_SESSION['username'];
    $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme   = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Gate In/Detail';
    $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Status: Broken CT";
    $InputAction          = 'Cek Barang Masuk Broken CT';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
               (id,IDUNIQ,username,modul,description,action,date_created)
               VALUES
               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertBroken=Success';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertBroken=Failed';</script>";
    }
}

if (isset($_POST["Simpan_"])) {

    $ID             = $_POST['ID'];
    $NOMOR_AJU      = $_POST['NOMOR_AJU'];
    $InputDate      = date('Y-m-d h:m:i');
    // TOTAL BOTOL
    $A_BOTOL        = $_POST['A_BOTOL'];
    $TOTAL_BOTOL    = $_POST['TOTAL_BOTOL'];
    // TOTAL LITER
    $A_LITER        = $_POST['A_LITER'];
    $TOTAL_LITER    = $_POST['TOTAL_LITER'];
    // TOTAL CT
    $TOTAL_CT       = $_POST['TOTAL_CT'];
    $meOK           = $_SESSION['username'];
    // TOTAL LITER SATUAN
    $NTS            = $_POST['NETTO_AKHIR'];

    $query = $dbcon->query("UPDATE plb_barang SET STATUS='Sesuai',
                                                  OPERATOR_ONE='$meOK',
                                                  TGL_CEK='$InputDate',
                                                  CHECKING='DONE',
                                                  STATUS_CT='Complete',
                                                  DATE_CT='$InputDate',
                                                  BOTOL='$A_BOTOL',
                                                  TOTAL_BOTOL_AKHIR='$TOTAL_BOTOL',
                                                  LITER='$A_LITER',
                                                  TOTAL_LITER_AKHIR='$TOTAL_LITER',
                                                  TOTAL_CT_AKHIR='$TOTAL_CT',
                                                  NETTO_AKHIR='$NTS'
                            WHERE ID='$ID'");

    // FOR AKTIFITAS
    $me         = $_SESSION['username'];
    $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme   = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Gate In/Detail';
    $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'] . " Status: Complete";
    $InputAction          = 'Cek Barang Masuk';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
               (id,IDUNIQ,username,modul,description,action,date_created)
               VALUES
               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$NOMOR_AJU&AlertSuccess';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID&AJU=$NOMOR_AJU&Alert=CekBarangMasuk&AlertSimpan=Failed';</script>";
    }
}

// DETAIL BARANG
$list                   = $dbcon->query("SELECT * FROM plb_barang WHERE ID='" . $_GET['ID'] . "' ORDER BY ID ASC LIMIT 1");
$resultList             = mysqli_fetch_array($list);
// FOR CT
$forCT                  = str_replace(".0000", "", $resultList['JUMLAH_SATUAN']);
// FOR BOTOL
$botol                  = explode('X', $resultList['UKURAN']);
$forBTL                 = $botol[0] * $forCT;
$add_forBTL             = $botol[0];
// FOR LITER
$liter                  =  $botol[1];
$r_liter                = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
$forLTR                 = str_replace(',', '.', $r_liter) * $forBTL;
$add_forLTR             = str_replace(',', '.', $r_liter);
// DETAIL, PERUSAHAAN DAN TUJUAN
$contentdatahdrbrg      = $dbcon->query("SELECT * FROM plb_header AS plb
                                         LEFT OUTER JOIN rcd_status AS rcd ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                         LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                         LEFT OUTER JOIN referensi_negara AS ngr ON ngr.KODE_NEGARA=tpb.KODE_NEGARA_PEMASOK
                                         WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY tpb.ID ASC", 0);
$datahdrbrg             = mysqli_fetch_array($contentdatahdrbrg);
// NILAI AKTUAL
// CT
$contentNA_CT           = $dbcon->query("SELECT COUNT(*) AS p_CT FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL ORDER BY ID", 0);
$NA_CT                  = mysqli_fetch_array($contentNA_CT);
// BOTOL
$contentNA_BOTOL        = $dbcon->query("SELECT SUM(TOTAL_BOTOL) AS p_BOTOL FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL ORDER BY ID", 0);
$NA_BOTOL               = mysqli_fetch_array($contentNA_BOTOL);
// LITER
$contentNA_LITER        = $dbcon->query("SELECT LITER AS p_LITER FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL GROUP BY ID ORDER BY ID LIMIT 1", 0);
$NA_LITER               = mysqli_fetch_array($contentNA_LITER);

// FOR STATUS BOTOL
// -- KURANG
$contentKURANG          = $dbcon->query("SELECT SUM(KURANG) AS s_KURANG FROM plb_barang_ct_botol  WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "'", 0);
$ST_KURANG              = mysqli_fetch_array($contentKURANG);
// -- LEBIH
$contentLEBIH           = $dbcon->query("SELECT SUM(LEBIH) AS s_LEBIH FROM plb_barang_ct_botol  WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "'", 0);
$ST_LEBIH               = mysqli_fetch_array($contentLEBIH);
// -- PECAH
$contentPECAH           = $dbcon->query("SELECT SUM(PECAH) AS s_PECAH FROM plb_barang_ct_botol  WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "'", 0);
$ST_PECAH               = mysqli_fetch_array($contentPECAH);
// -- RUSAK
$contentRUSAK           = $dbcon->query("SELECT SUM(RUSAK) AS s_RUSAK FROM plb_barang_ct_botol  WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "'", 0);
$ST_RUSAK               = mysqli_fetch_array($contentRUSAK);

// CEK PETUGAS COMPANY
$contentPetugas         = $dbcon->query("SELECT * FROM rcd_status WHERE bm_no_aju_plb='" . $_GET['AJU'] . "'");
$resultPetugas          = mysqli_fetch_array($contentPetugas);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Pengecekan Kriteria Botol Gate In App Name | Company </title>
<?php } else { ?>
    <title>Pengecekan Kriteria Botol Gate In - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<style>
    .sm {
        max-width: 471px;
        margin: 16.75rem auto;
        width: 549px;
    }

    .inline-group {
        max-width: 9rem;
        padding: .5rem;
        margin-left: -7px;
    }

    .inline-group .form-control-custom {
        text-align: right;
    }

    .form-control-custom[type="number"]::-webkit-inner-spin-button,
    .form-control-custom[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<!-- CUSTOM FOR INPUT NUMBER -->
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-door-open icon-page"></i>
                <font class="text-page">Gate Mandiri</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Detail Nomor AJU: <?= $resultList['NOMOR_AJU'] ?></a></li>
                <li class="breadcrumb-item active">Detail Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- BACK -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1" style="padding: 15px;">
                <a href="gm_pemasukan_detail.php?AJU=<?= $_GET['AJU'] ?>" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- END BACK -->

    <!-- Status Gate In -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-star"></i> Status Gate In Kriteria</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="row" style="align-items: center;">
                        <div class="col-sm-2">
                            <img src="assets/img/svg/product-quality-animate.svg" alt="Status Data Gate In Images">
                        </div>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col-sm-4">
                                    <!-- DETAIL -->
                                    <div class="detail-barang-ct" style="margin-left: -12px;">
                                        <div>
                                            <a href="#" class="widget-card rounded mb-20px" data-id="widget">
                                                <div class="widget-card-cover rounded"></div>
                                                <div class="widget-card-content">
                                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="far fa-star"></i> NOMOR PENGAJUAN PLB: <?= $_GET['AJU']; ?></b></h5>
                                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="far fa-star"></i> NOMOR PENGAJUAN GB: <?= $datahdrbrg['NOMOR_AJU']; ?></b></h5>
                                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75">
                                                        <b>
                                                            <font>DETAIL TIPE BARANG: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></font>
                                                        </b>
                                                    </h5>
                                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75">
                                                        <b>
                                                            <font>SPESIFIKASI BARANG: <?= $resultList['SPESIFIKASI_LAIN'] ?></font>
                                                        </b>
                                                    </h5>
                                                    <h4 class="mb-10px text-blue">
                                                        <font style="color:#000!important;font-size: .9375rem;">Harga Penyerahan:</font>
                                                        <b> <?= Rupiah($resultList['HARGA_PENYERAHAN']); ?></b>
                                                    </h4>
                                                    <h4 class="mb-10px text-blue">
                                                        <font style="color:#000!important;font-size: .9375rem;">Negara Asal:</font>
                                                        <?php if ($datahdrbrg['URAIAN_NEGARA'] == NULL) { ?>
                                                            <b style="color: red;"> Not Found</b>
                                                        <?php } else { ?>
                                                            <b> <?= $datahdrbrg['URAIAN_NEGARA']; ?></b>
                                                        <?php } ?>
                                                    </h4>
                                                    <div style="margin-bottom: -35px;">
                                                        <p>Uraian: <?= $resultList['URAIAN']; ?><br>Ukuran: <?= $resultList['UKURAN']; ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- DETAIL -->
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <!-- ASAL DAN TUJUAN -->
                                        <div class="col-sm-12">
                                            <div style="display: flex;justify-content: space-between;align-items: center;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 30px;">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="margin-left: 10px;">
                                                        <div style="font-size: 17px;font-weight: 900;">
                                                            <?= $datahdrbrg['NAMA_PENGUSAHA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;font-size: 10px;">
                                                            Asal BC 2.7 GB
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 30px;">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    <div style="margin-left: 10px;">
                                                        <div style="font-size: 17px;font-weight: 900;">
                                                            <?= $datahdrbrg['NAMA_PENERIMA_BARANG']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;font-size: 10px;">
                                                            Tujuan BC 2.7 GB
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <style>
                                                .line-page-detil {
                                                    height: 1px;
                                                    margin: 0px 0px 5px 0px;
                                                    background: #444e66;
                                                }
                                            </style>
                                            <div class="line-page-detil"></div>
                                        </div>
                                        <!-- NILAI AWAL -->
                                        <div class="col-sm-6">
                                            <div class="card border-0 bg-dark text-white text-truncate mb-3">
                                                <div class="card-body">
                                                    <div class="mb-3 text-grey">
                                                        <b class="mb-3">NILAI AWAL</b>
                                                        <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Nilai Awal." data-original-title="" title=""></i></span>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                                            TOTAL CT
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $forCT; ?>">0</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                                            TOTAL BOTOL
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $forBTL; ?>">0</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                                            TOTAL LITER
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $forLTR; ?>">0</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- NILAI AKHIR -->
                                        <div class="col-sm-6">
                                            <div class="card border-0 bg-dark text-white text-truncate mb-3">
                                                <div class="card-body">
                                                    <div class="mb-3 text-grey">
                                                        <b class="mb-3">NILAI AKHIR</b>
                                                        <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="NILAI AKHIR." data-original-title="" title=""></i></span>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                                            TOTAL CT
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <?php if ($NA_CT['p_CT'] == NULL) { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0">0</span></div>
                                                            <?php } else { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $NA_CT['p_CT']; ?>">0</span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                                            TOTAL BOTOL
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <?php if ($NA_BOTOL['p_BOTOL'] == NULL) { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0">0</span></div>
                                                            <?php } else { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $NA_BOTOL['p_BOTOL']; ?>">0</span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
                                                            TOTAL LITER
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <?php if ($NA_LITER['p_LITER'] == NULL) { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0">0</span></div>
                                                            <?php } else { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $NA_BOTOL['p_BOTOL'] * $NA_LITER['p_LITER']; ?>">0</span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-left: 5px;font-size: 14px;font-weight: 800;margin-top: 10px;">
                            <?php if ($ST_KURANG['s_KURANG'] != 0) { ?>
                                <button type="button" class="btn btn-sm btn-custom btn-yellow" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Botol Kurang <?= $ST_KURANG['s_KURANG']; ?>"><i class="fa-solid fa-minus"></i> <b><?= $ST_KURANG['s_KURANG']; ?></b> Kurang</button>
                            <?php } ?>
                            <?php if ($ST_LEBIH['s_LEBIH'] != 0) { ?>
                                <button type="button" class="btn btn-sm btn-custom btn-lime" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Botol Lebih <?= $ST_LEBIH['s_LEBIH']; ?>"><i class="fa-solid fa-plus"></i> <b><?= $ST_LEBIH['s_LEBIH']; ?></b> Lebih</button>
                            <?php } ?>
                            <?php if ($ST_PECAH['s_PECAH'] != 0) { ?>
                                <button type="button" class="btn btn-sm btn-custom btn-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Botol Pecah <?= $ST_PECAH['s_PECAH']; ?>"><i class="fa-solid fa-tags"></i> <b><?= $ST_PECAH['s_PECAH']; ?></b> Pecah</button>
                            <?php } ?>
                            <?php if ($ST_RUSAK['s_RUSAK'] != 0) { ?>
                                <button type="button" class="btn btn-sm btn-custom btn-warning" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Botol Rusak <?= $ST_RUSAK['s_RUSAK']; ?>"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> <b><?= $ST_RUSAK['s_RUSAK']; ?></b> Rusak</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status Gate In -->

    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Gate Mandiri] Data Get In - Tipe: <?= $resultList['TIPE'] ?> (<?= $resultList['URAIAN'] ?>)</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- Alert -->
                    <!-- Simpan -->
                    <?php if (isset($_GET['AlertSimpan']) == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Simpan pengecekan Botol pada <b>Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></b>, Gagal disimpan!</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Kurang -->
                    <?php if (isset($_GET['AlertKurang']) == 'Success') { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Jumlah Kekurangan Botol <b>Berhasil Disimpan</b>!
                        </div>
                    <?php } else if (isset($_GET['AlertKurang']) == 'Failed') { ?>
                        <div class="alert alert-danger fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Gagal!</strong>
                            Jumlah Kekurangan Botol <b>Gagal Disimpan</b>!
                        </div>
                    <?php } ?>
                    <!-- End Kurang -->
                    <!-- Lebih -->
                    <?php if (isset($_GET['AlertLebih']) == 'Success') { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Jumlah Kelebihan Botol <b>Berhasil Disimpan</b>!
                        </div>
                    <?php } else if (isset($_GET['AlertLebih']) == 'Failed') { ?>
                        <div class="alert alert-danger fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Gagal!</strong>
                            Jumlah Kelebihan Botol <b>Gagal Disimpan</b>!
                        </div>
                    <?php } ?>
                    <!-- End Lebih -->
                    <!-- Pecah -->
                    <?php if (isset($_GET['AlertPecah']) == 'Success') { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Jumlah Botol Pecah <b>Berhasil Disimpan</b>!
                        </div>
                    <?php } else if (isset($_GET['AlertPecah']) == 'Failed') { ?>
                        <div class="alert alert-danger fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Gagal!</strong>
                            Jumlah Botol Pecah <b>Gagal Disimpan</b>!
                        </div>
                    <?php } ?>
                    <!-- End Pecah -->
                    <!-- Rusak -->
                    <?php if (isset($_GET['AlertRusak']) == 'Success') { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Jumlah Botol Rusak <b>Berhasil Disimpan</b>!
                        </div>
                    <?php } else if (isset($_GET['AlertRusak']) == 'Failed') { ?>
                        <div class="alert alert-danger fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Gagal!</strong>
                            Jumlah Botol Rusak <b>Gagal Disimpan</b>!
                        </div>
                    <?php } ?>
                    <!-- End Rusak -->
                    <!-- Broken -->
                    <?php if (isset($_GET['AlertBroken']) == 'Success') { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Data Gate In berhasil disimpan!
                        </div>
                    <?php } else if (isset($_GET['AlertBroken']) == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Jumlah CT Broken <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- End Broken -->
                    <?php if (isset($_GET['Alert']) == 'CekBarangMasuk') { ?>
                        <div class="note note-yellow">
                            <div class="note-icon"><i class="fas fa-boxes"></i></div>
                            <div class="note-content">
                                <h4><b>Pengecekan Kriteria Botol!</b></h4>
                                <p> Silahkan lakukan pengecekan pada <b>Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></b>!</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Alert -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- PETUGAS -->
                            <div style="display: flex;justify-content: flex-start;align-items: center;">
                                <div style="font-size: 30px;">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div style="margin-left: 10px;">
                                    <div style="font-size: 17px;font-weight: 900;">
                                        <?php if ($resultPetugas['bm_nama_operator'] == NULL) { ?>
                                            <?= $_SESSION['username']; ?>
                                        <?php } else { ?>
                                            <?= $resultPetugas['bm_nama_operator']; ?>
                                        <?php } ?>
                                    </div>
                                    <div style="margin-top: -5px;font-size: 10px;">
                                        Petugas <?= $resultSetting['company']; ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- END PETUGAS -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="C_TableDefault" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">
                                        1 Karton Rusak
                                    </th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Kriteria</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Botol</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Liter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL ORDER BY ID DESC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <a href="#Delete<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-default">
                                                    <img src="assets/img/png/box.png" style="width: 35px;" alt="Carton">
                                                    1 Karton
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TOTAL_BOTOL'] == 0) { ?>
                                                    <button class="btn btn-warning" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Anda tidak dapat melakukan aksi pada status botol!"><i class="fas fa-warning"></i></button>
                                                    <small style="color: #e91e63;"><i>Jumlah Botol Habis!</i></small>
                                                <?php } else { ?>
                                                    <!-- Kurang -->
                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-yellow"><i class="fa-solid fa-minus"></i> Kurang</a>
                                                    <!-- Lebih -->
                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Lebih</a>
                                                    <!-- Pecah -->
                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pecah</a>
                                                    <!-- Rusak -->
                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</a>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="#" class="btn btn-default">
                                                    <img src="assets/img/svg/botol.svg" style="width: 15px;" alt="Botol">
                                                    <?= $row['TOTAL_BOTOL']; ?> Botol
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="#" class="btn btn-default">
                                                    <img src="assets/img/svg/liter.svg" style="width: 20px;" alt="Botol">
                                                    <?= $row['LITER']; ?> Liter
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Delete -->
                                        <div class="modal fade" id="Delete<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Karton Data] 1 Karton Rusak</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: grid;justify-content: center;">
                                                                    <div style="display: flex;">
                                                                        <img src="assets/img/png/box.png" style="width: 45%;" alt="">
                                                                        <div class="card-body" style="margin-left: -40px;">
                                                                            <h4 class="card-title">1 Karton Rusak</h4>
                                                                            <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                            <a href="javascript:;" class="btn btn-default">Anda yakin ingin mengubah Status Karton?</a>
                                                                        </div>
                                                                        <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                        <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                        <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                        <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</a>
                                                            <button type="submit" name="Delete_" class="btn btn-default"><i class="fas fa-check-circle"></i> Ya</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete -->
                                        <!-- Kurang -->
                                        <div class="modal fade" id="Kurang<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Kurang] Isi Jumlah Kekurangan Botol</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <img src="assets/img/svg/botol.svg" style="width: 100px;" alt="Botol">
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">Input Jumlah Kurang Botol dalam 1 Karton</h4>
                                                                        <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                        <a href="javascript:;" class="btn btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
                                                                        <div>
                                                                            <div style="margin-top: 15px;margin-bottom: -13px;margin-left: 3px;font-size: 15px;font-weight: 700;">
                                                                                <label>Kurang</label>
                                                                            </div>
                                                                            <div class="input-group inline-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span type="button" class="btn btn-danger btn-minus">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="number" class="form-control-custom quantity" min="0" max="<?= $row['TOTAL_BOTOL']; ?>" name="TOTAL_BOTOL_K" value="0" readonly>
                                                                                <div class="input-group-append">
                                                                                    <span type="button" class="btn btn-yellow btn-plus">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                    <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                    <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                    <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                    <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
                                                                    <input type="hidden" name="LITER" value="<?= $row['LITER']; ?>">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="kurang_" class="btn btn-yellow"><i class="fa-solid fa-minus"></i> Kurang</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Kurang -->
                                        <!-- Lebih -->
                                        <div class="modal fade" id="Lebih<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Lebih] Isi Jumlah Kelebihan Botol</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <img src="assets/img/svg/botol.svg" style="width: 100px;" alt="Botol">
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">Input Jumlah Lebih Botol dalam 1 Karton</h4>
                                                                        <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                        <a href="javascript:;" class="btn btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
                                                                        <div>
                                                                            <div style="margin-top: 15px;margin-bottom: -13px;margin-left: 3px;font-size: 15px;font-weight: 700;">
                                                                                <label>Lebih</label>
                                                                            </div>
                                                                            <div class="input-group inline-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span type="button" class="btn btn-danger btn-minus">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="number" class="form-control-custom quantity" min="0" max="<?= $row['TOTAL_BOTOL']; ?>" name="TOTAL_BOTOL_L" value="0" readonly>
                                                                                <div class="input-group-append">
                                                                                    <span type="button" class="btn btn-yellow btn-plus">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                    <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                    <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                    <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                    <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
                                                                    <input type="hidden" name="LITER" value="<?= $row['LITER']; ?>">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="lebih_" class="btn btn-lime"><i class="fa-solid fa-plus"></i> Lebih</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Lebih -->
                                        <!-- Pecah -->
                                        <div class="modal fade" id="Pecah<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Pecah] Isi Jumlah Botol Pecah</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <img src="assets/img/svg/botol.svg" style="width: 100px;" alt="Botol">
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">Input Jumlah Pecah Botol dalam 1 Karton</h4>
                                                                        <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                        <a href="javascript:;" class="btn btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
                                                                        <div>
                                                                            <div style="margin-top: 15px;margin-bottom: -13px;margin-left: 3px;font-size: 15px;font-weight: 700;">
                                                                                <label>Pecah</label>
                                                                            </div>
                                                                            <div class="input-group inline-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span type="button" class="btn btn-danger btn-minus">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="number" class="form-control-custom quantity" min="0" max="<?= $row['TOTAL_BOTOL']; ?>" name="TOTAL_BOTOL_P" value="0" readonly>
                                                                                <div class="input-group-append">
                                                                                    <span type="button" class="btn btn-yellow btn-plus">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                    <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                    <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                    <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                    <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
                                                                    <input type="hidden" name="LITER" value="<?= $row['LITER']; ?>">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="pecah_" class="btn btn-dark"><i class="fa-solid fa-tags"></i> Pecah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Pecah -->
                                        <!-- Rusak -->
                                        <div class="modal fade" id="Rusak<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Rusak] Isi Jumlah Botol Rusak</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <img src="assets/img/svg/botol.svg" style="width: 100px;" alt="Botol">
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">Input Jumlah Rusak Botol dalam 1 Karton</h4>
                                                                        <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                        <a href="javascript:;" class="btn btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
                                                                        <div>
                                                                            <div style="margin-top: 15px;margin-bottom: -13px;margin-left: 3px;font-size: 15px;font-weight: 700;">
                                                                                <label>Rusak</label>
                                                                            </div>
                                                                            <div class="input-group inline-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span type="button" class="btn btn-danger btn-minus">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="number" class="form-control-custom quantity" min="0" max="<?= $row['TOTAL_BOTOL']; ?>" name="TOTAL_BOTOL_R" value="0" readonly>
                                                                                <div class="input-group-append">
                                                                                    <span type="button" class="btn btn-yellow btn-plus">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                    <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                    <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                    <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                    <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
                                                                    <input type="hidden" name="LITER" value="<?= $row['LITER']; ?>">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="rusak_" class="btn btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Rusak -->
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Data CT -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'
            ],
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            iDisplayLength: -1
        });
    });

    function checkAll(checkId) {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                if (inputs[i].checked == true) {
                    inputs[i].checked = false;
                } else if (inputs[i].checked == false) {
                    inputs[i].checked = true;
                }
            }
        }
    }

    function checkAllDel(checkId) {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                if (inputs[i].checked == true) {
                    inputs[i].checked = false;
                } else if (inputs[i].checked == false) {
                    inputs[i].checked = true;
                }
            }
        }
    }

    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }

    // !--CUSTOM FOR INPUT NUMBER-- >
    $('.btn-plus, .btn-minus').on('click', function(e) {
        const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
        const input = $(e.target).closest('.input-group').find('input');
        if (input.is('input')) {
            input[0][isNegative ? 'stepDown' : 'stepUp']()
        }
    })
</script>