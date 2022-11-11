<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// Submit CT
if (isset($_GET["aksi"]) == 'SubmitCT') {
    $keyy      = @$_GET['ID_BARANG'];
    // CEK CT

    $query = $dbcon->query("UPDATE plb_barang SET CHECKING_GB='Checking Botol'
                            WHERE ID='$keyy'");

    // FOR AKTIFITAS
    $me         = $_SESSION['username'];
    $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme   = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Gate In/Detail/CT';
    $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'];
    $InputAction          = 'Cek Barang Keluar';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$keyy&Alert=CekBarangKeluar&AJU=" . $_GET['AJU'] . "'</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran_detail.php?AJU=" . $_GET['AJU'] . "';</script>";
    }
}

// KURANG
if (isset($_POST["kurang_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_K'] == 0) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$v_ID_BARANG&Alert=CekBarangKeluar&AJU=$v_NOMOR_AJU';</script>";
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
                                                         POSISI='OUT'
                            WHERE ID='$ID_CT'");
        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,KURANG,POSISI)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Kurang','OUT')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Botol Kurang:" . $Kurang;
        $InputAction          = 'Botol Kurang';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                       (id,IDUNIQ,username,modul,description,action,date_created)
                       VALUES
                       ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertKurang=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertKurang=Failed';</script>";
        }
    }
}

// LEBIH
if (isset($_POST["lebih_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_L'] == 0) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$v_ID_BARANG&Alert=CekBarangKeluar&AJU=$v_NOMOR_AJU';</script>";
    } else {
        $ID_CT                  = $_POST['ID_CT'];
        $NOMOR_AJU              = $_POST['NOMOR_AJU'];
        $ID_BARANG              = $_POST['ID_BARANG'];
        $KODE_BARANG            = $_POST['KODE_BARANG'];
        $Lebih                  = $_POST['TOTAL_BOTOL_L'];
        $TOTAL_BOTOL            = $_POST['TOTAL_BOTOL'];

        $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$TOTAL_BOTOL',
        POSISI='OUT'
                                WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
                                (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,LEBIH,POSISI)
                                VALUES
                                ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Lebih','OUT')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Botol Lebih:" . $Lebih;
        $InputAction          = 'Botol Lebih';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                       (id,IDUNIQ,username,modul,description,action,date_created)
                       VALUES
                       ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertLebih=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertLebih=Failed';</script>";
        }
    }
}

// PECAH
if (isset($_POST["pecah_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_P'] == 0) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$v_ID_BARANG&Alert=CekBarangKeluar&AJU=$v_NOMOR_AJU';</script>";
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
                                                         POSISI='OUT'
                            WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
                                (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,PECAH,POSISI)
                                VALUES
                                ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Pecah','OUT')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Botol Pecah:" . $Pecah;
        $InputAction          = 'Botol Pecah';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                   (id,IDUNIQ,username,modul,description,action,date_created)
                   VALUES
                   ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
        if ($query) {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertPecah=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertPecah=Failed';</script>";
        }
    }
}

// RUSAK
if (isset($_POST["rusak_"])) {
    $v_NOMOR_AJU              = $_POST['NOMOR_AJU'];
    $v_ID_BARANG              = $_POST['ID_BARANG'];
    if ($_POST['TOTAL_BOTOL_R'] == 0) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$v_ID_BARANG&Alert=CekBarangKeluar&AJU=$v_NOMOR_AJU';</script>";
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
                                                         POSISI='OUT'
                            WHERE ID='$ID_CT'");

        $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,RUSAK,POSISI)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Rusak','OUT')");

        // FOR AKTIFITAS
        $me         = $_SESSION['username'];
        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme   = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Gate In/Detail/CT';
        $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Botol Rusak:" . $Rusak;
        $InputAction          = 'Botol Rusak';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                   (id,IDUNIQ,username,modul,description,action,date_created)
                   VALUES
                   ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertRusak=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertRusak=Failed';</script>";
        }
    }
}


if (isset($_POST["simpan"])) {

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
    $TLS = $A_BOTOL * $A_LITER;
    $NTS = $TLS * $TOTAL_BOTOL;

    $query = $dbcon->query("UPDATE plb_barang SET STATUS_GB='Sesuai',
                                                  OPERATOR_ONE_GB='$meOK',
                                                  TGL_CEK_GB='$InputDate',
                                                  CHECKING_GB='DONE',
                                                  STATUS_CT_GB='Complete',
                                                  DATE_CT_GB='$InputDate',
                                                  BOTOL_GB='$A_BOTOL',
                                                  TOTAL_BOTOL_AKHIR_GB='$TOTAL_BOTOL',
                                                  LITER_GB='$A_LITER',
                                                  TOTAL_LITER_AKHIR_GB='$TLS',
                                                  TOTAL_CT_AKHIR_GB='$TOTAL_CT',
                                                  NETTO_AKHIR_GB='$NTS'
                            WHERE ID='$ID'");

    // FOR AKTIFITAS
    $me         = $_SESSION['username'];
    $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme   = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Gate In/Detail';
    $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Status: Complete";
    $InputAction          = 'Cek Barang Keluar';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
               (id,IDUNIQ,username,modul,description,action,date_created)
               VALUES
               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='gm_pengeluaran_detail.php?AJU=$NOMOR_AJU&AlertSimpan=Success';</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertSimpan=Failed';</script>";
    }
}

if (isset($_POST["Delete_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU         = $_POST['NOMOR_AJU'];
    $ID_BARANG         = $_POST['ID_BARANG'];
    $KODE_BARANG       = $_POST['KODE_BARANG'];
    $InputDate         = date('Y-m-d h:m:i');

    $query = $dbcon->query("UPDATE plb_barang_ct SET STATUS_CT='Broken',
                                                     DATE_CT='$InputDate',
                                                     POSISI='OUT'
                            WHERE ID='$ID_CT'");
    // FOR AKTIFITAS
    $me         = $_SESSION['username'];
    $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme   = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Gate In/Detail';
    $InputDescription     = $me . " Cek Barang Keluar: ID Barang Keluar" . @$_GET['ID_BARANG'] . " Status: Broken CT";
    $InputAction          = 'Cek Barang Keluar Broken CT';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
               (id,IDUNIQ,username,modul,description,action,date_created)
               VALUES
               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
    if ($query) {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertBroken=Success';</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran_ct.php?ID=$ID_BARANG&Alert=CekBarangKeluar&AJU=$NOMOR_AJU&AlertBroken=Failed';</script>";
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
$contentdatahdrbrg      = $dbcon->query("SELECT * FROM plb_header WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$datahdrbrg             = mysqli_fetch_array($contentdatahdrbrg);
// NILAI AKTUAL
// CT
$contentNA_CT           = $dbcon->query("SELECT COUNT(*) AS p_CT FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL ORDER BY ID", 0);
$NA_CT                  = mysqli_fetch_array($contentNA_CT);
// BOTOL
$contentNA_BOTOL        = $dbcon->query("SELECT SUM(TOTAL_BOTOL) AS p_BOTOL FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL ORDER BY ID", 0);
$NA_BOTOL               = mysqli_fetch_array($contentNA_BOTOL);
// LITER
$contentNA_LITER        = $dbcon->query("SELECT TOTAL_LITER AS p_LITER FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL GROUP BY ID ORDER BY ID LIMIT 1", 0);
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
?>
<style>
    .btn-custom {
        font-size: 10px;
        padding: 5px;
    }

    .sm {
        max-width: 471pxpx;
        margin: 16.75rem auto;
        width: 549px;
    }

    /* Check Box */
    .form-check-input[type=checkbox] {
        border-radius: 0.25em;
    }

    .form-check-input:checked[type=checkbox] {
        background-image: url('assets/img/svg/download.svg');
    }

    .form-check-input:checked {
        background-color: #348fe2;
        border-color: #348fe2;
    }

    .form-check-input[type=checkbox] {
        border-radius: 0.25em;
    }

    .form-check .form-check-input {
        float: left;
        margin-left: -2em;
    }

    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        margin-top: 0;
        vertical-align: top;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 2px solid #9e9e9e;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }

    .form-check-input {
        position: inherit;
        margin-top: 0;
        margin-left: -1.25rem;
    }

    .btn-custom {
        font-size: 10px;
        padding: 5px;
    }

    .detail-barang-ct {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-ct {
        background: #fff;
        border-radius: 5px;
        padding: 10px;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 10px;
        border: 2px solid #2d353c !important;
        text-transform: uppercase;
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
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- BACK -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1" style="padding: 15px;">
                <a href="gm_pengeluaran_detail.php?AJU=<?= $_GET['AJU'] ?>" class="btn btn-yellow"><i class="fas fa-caret-square-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- END BACK -->

    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data Barang Keluar: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- DETAIL -->
                    <div class="detail-barang-ct">
                        <div>
                            <a href="#" class="widget-card rounded mb-20px" data-id="widget">
                                <div class="widget-card-cover rounded"></div>
                                <div class="widget-card-content">
                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="far fa-star"></i> NOMOR PENGAJUAN PLB: <?= $_GET['AJU']; ?></b></h5>
                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75">
                                        <b>
                                            <font style="margin-left: 21px;">DETAIL TIPE BARANG: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></font>
                                        </b>
                                    </h5>
                                    <h5 class="mb-10px text-blue">
                                        <div>
                                            <!-- CT -->
                                            <div style="display: flex;">
                                                <div><i class="fas fa-boxes"></i></div>
                                                <div style="margin-left: 5px;">Total CT</div>
                                                <div style="margin-left: 22px;">:</div>
                                                <div style="margin-left: 12px;"><?= $forCT; ?> CT</div>
                                            </div>
                                            <!-- BTL -->
                                            <div style="display: flex;">
                                                <div><i class="fa-solid fa-bottle-droplet"></i></div>
                                                <div style="margin-left: 13px;">Total Botol</div>
                                                <div style="margin-left: 4px;">:</div>
                                                <div style="margin-left: 12px;"><?= $forBTL; ?> BTL</div>
                                            </div>
                                            <!-- LTR -->
                                            <div style="display: flex;">
                                                <div><i class="fa-solid fa-glass-water-droplet"></i></div>
                                                <div style="margin-left: 11px;">Total Liter</div>
                                                <div style="margin-left: 11px;">:</div>
                                                <div style="margin-left: 12px;"><?= $forLTR; ?> LTR</div>
                                            </div>
                                        </div>
                                    </h5>
                                    <h4 class="mb-10px text-blue">
                                        <font style="color:#000!important;font-size: .9375rem;">Harga Penyerahan:</font>
                                        <b> <?= Rupiah($resultList['HARGA_PENYERAHAN']); ?></b>
                                    </h4>
                                    <h4 class="mb-10px text-blue">
                                        <font style="color:#000!important;font-size: .9375rem;">Pos Tarif:</font>
                                        <b> <?= Rupiah($resultList['POS_TARIF']); ?></b>
                                    </h4>
                                    <div style="margin-bottom: -35px;">
                                        <p>Uraian: <?= $resultList['URAIAN']; ?><br>Ukuran: <?= $resultList['UKURAN']; ?></p>
                                    </div>
                                </div>
                                <div class="widget-card-content bottom">
                                    <b class="text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><i class="fas fa-building"></i> Asal PLB: <?= $datahdrbrg['PERUSAHAAN'] ?> - Tujuan/Penerima: <?= $datahdrbrg['NAMA_PENERIMA_BARANG'] ?>.</b>
                                </div>
                            </a>
                        </div>
                        <div style="padding: 0px;">
                            <div>
                                <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b>NILAI AKTUAL BARANG</b></h5>
                            </div>
                            <div class="total-ct">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fas fa-boxes"></i></td>
                                            <td style="width: 110px; height: 18px;">Total CT</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $NA_CT['p_CT']; ?> CT</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-ct">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fa-solid fa-bottle-droplet"></i></td>
                                            <td style="width: 110px; height: 18px;">Total Botol</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $NA_BOTOL['p_BOTOL']; ?> Botol</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-ct">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fa-solid fa-glass-water-droplet"></i></td>
                                            <td style="width: 110px; height: 18px;">Total Liter</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $NA_BOTOL['p_BOTOL'] * $NA_LITER['p_LITER']; ?> Liter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- PETUGAS -->
                    <div class="row">
                        <div class="col-sm-6" style="margin-left: 5px;font-size: 14px;font-weight: 800;">
                            <i class="far fa-user-circle"></i> Petugas: <?= $_SESSION['username']; ?>
                        </div>
                        <div class="col-sm-6" style="margin-left: 5px;font-size: 14px;font-weight: 800;margin-top: 10px;">
                            <?php if ($ST_KURANG['s_KURANG'] != 0) { ?>
                                <a href="#" class="btn btn-sm btn-custom btn-yellow"><i class="fa-solid fa-minus"></i> <b><?= $ST_KURANG['s_KURANG']; ?></b> Kurang</a>
                            <?php } ?>
                            <?php if ($ST_LEBIH['s_LEBIH'] != 0) { ?>
                                <a href="#" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> <b><?= $ST_LEBIH['s_LEBIH']; ?></b> Lebih</a>
                            <?php } ?>
                            <?php if ($ST_PECAH['s_PECAH'] != 0) { ?>
                                <a href="#" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> <b><?= $ST_PECAH['s_PECAH']; ?></b> Pecah</a>
                            <?php } ?>
                            <?php if ($ST_RUSAK['s_RUSAK'] != 0) { ?>
                                <a href="#" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> <b><?= $ST_RUSAK['s_RUSAK']; ?></b> Rusak</a>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END PETUGAS -->
                    <!-- DETAIL -->
                    <hr>
                    <!-- Alert -->
                    <?php if ($_GET['Alert'] == 'CekBarangKeluar') { ?>
                        <div class="note note-warning">
                            <div class="note-icon"><i class="fas fa-boxes"></i></div>
                            <div class="note-content">
                                <h4><b>Pengecekan Barang!</b></h4>
                                <p> Silahkan lakukan pengecekan pada <b>Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- Simpan -->
                    <?php if ($_GET['AlertSimpan'] == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Simpan pengecekan Botol pada <b>Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></b>, Gagal disimpan!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- Kurang -->
                    <?php if ($_GET['AlertKurang'] == 'Success') { ?>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Jumlah Kekurangan Botol <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } else if ($_GET['AlertKurang'] == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Jumlah Kekurangan Botol <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- End Kurang -->
                    <!-- Lebih -->
                    <?php if ($_GET['AlertLebih'] == 'Success') { ?>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Jumlah Kelebihan Botol <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } else if ($_GET['AlertLebih'] == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Jumlah Kelebihan Botol <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- End Lebih -->
                    <!-- Pecah -->
                    <?php if ($_GET['AlertPecah'] == 'Success') { ?>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Jumlah Botol Pecah <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } else if ($_GET['AlertPecah'] == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Jumlah Botol Pecah <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- End Pecah -->
                    <!-- Rusak -->
                    <?php if ($_GET['AlertRusak'] == 'Success') { ?>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Jumlah Botol Rusak <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } else if ($_GET['AlertRusak'] == 'Failed') { ?>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Jumlah Botol Rusak <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <!-- End Rusak -->
                    <!-- Broken -->
                    <?php if ($_GET['AlertBroken'] == 'Success') { ?>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Jumlah CT Broken <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                        <hr>
                    <?php } else if ($_GET['AlertBroken'] == 'Failed') { ?>
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
                    <!-- Alert -->
                    <a href="#simpan" data-toggle="modal" class="btn btn-primary" style="margin-bottom: 15px;"><i class="fas fa-tasks"></i> Simpan Data</a>
                    <!-- Simpan Data -->
                    <div class="modal fade" id="simpan">
                        <div class="modal-dialog">
                            <div class="modal-content sm">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Simpan Data] <b>Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12" style="display: grid;justify-content: center;align-content: center;">
                                                    <i class="fas fa-warning" style="font-size: 150px;color: #f59c1a;"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="alert alert-warning">
                                                        <h5><i class="fa fa-info"></i> Anda yakin akan menyimpan data ini?</h5>
                                                        <p>Data Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?> tidak dapat ubah jika sudah dilakukan penyimpanan kedalam sistem!</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="ID" value="<?= $resultList['ID'] ?>">
                                            <input type="hidden" name="NOMOR_AJU" value="<?= $resultList['NOMOR_AJU'] ?>">
                                            <input type="hidden" name="A_BOTOL" value="<?= $add_forBTL ?>">
                                            <input type="hidden" name="TOTAL_BOTOL" value="<?= $NA_BOTOL['p_BOTOL'] ?>">
                                            <input type="hidden" name="A_LITER" value="<?= $add_forLTR ?>">
                                            <input type="hidden" name="TOTAL_LITER" value="<?= $NA_BOTOL['p_BOTOL'] * $add_forLTR; ?>">
                                            <input type="hidden" name="TOTAL_CT" value="<?= $NA_CT['p_CT']; ?>">
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</a>
                                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fas fa-check-circle"></i> Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Simpan Data -->
                    <br>
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="1%" class="no-sort" style="text-align: center;">#</th>
                                    <th class="no-sort" style="text-align: center;">Statu CT</th>
                                    <th class="no-sort" style="text-align: center;">Aksi</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">ID Barang</th>
                                    <th style="text-align: center;">KD Barang</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Liter</th>
                                    <!-- <th style="text-align: center;">Status</th> -->
                                    <!-- <th style="text-align: center;">Remarks</th> -->
                                    <!-- <th style="text-align: center;">File</th> -->
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
                                                <img src="assets/img/png/box.png" style="width: 70px;" alt="">
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="#Delete<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-danger"><i class="fas fa-box-open"></i></a>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TOTAL_BOTOL'] == 0) { ?>
                                                    <button class="btn btn-warning" data-toggle="popover" data-trigger="hover" data-title="Jumlah Botol: <?= $row['TOTAL_BOTOL'] ?>" data-placement="top" data-content="Anda tidak dapat melakukan aksi pada status botol!"><i class="fas fa-warning"></i></button>
                                                    <small style="color: #e91e63;"><i>Jumlah Botol Habis!</i></small>
                                                <?php } else { ?>
                                                    <!-- Kurang -->
                                                    <a href="#Kurang<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-yellow"><i class="fa-solid fa-minus"></i> Kurang</a>
                                                    <!-- Lebih -->
                                                    <a href="#Lebih<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Lebih</a>
                                                    <!-- Pecah -->
                                                    <a href="#Pecah<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pecah</a>
                                                    <!-- Rusak -->
                                                    <a href="#Rusak<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</a>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?= $row['NOMOR_AJU']; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?= $row['ID_BARANG']; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?= $row['KODE_BARANG']; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <i class="fa-solid fa-bottle-droplet"></i> <?= $row['TOTAL_BOTOL']; ?> Botol
                                            </td>
                                            <td style="text-align: center;">
                                                <i class="fa-solid fa-glass-water-droplet"></i> <?= $row['LITER']; ?> Liter
                                            </td>
                                            <!-- <td style="text-align: center">
                                                <?php if ($row['STATUS'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['STATUS']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['REMAKS'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['REMAKS']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['DOKS'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['DOKS']; ?>
                                                <?php } ?>
                                            </td> -->
                                        </tr>
                                        <!-- Delete -->
                                        <div class="modal fade" id="Delete<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Broken] 1 CT</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: grid;justify-content: center;">
                                                                    <div style="display: flex;">
                                                                        <img src="assets/img/png/box.png" style="width: 50%;" alt="">
                                                                        <div class="card-body" style="margin-left: -45px;">
                                                                            <h4 class="card-title">1 CT Broken</h4>
                                                                            <p class="card-text">Total Botol: <?= $row['TOTAL_BOTOL']; ?><br>Total Liter: <?= $row['TOTAL_BOTOL'] * $row['TOTAL_LITER']; ?></p>
                                                                            <a href="javascript:;" class="btn btn-default">Anda yakin ingin mengubah status CT?</a>
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
                                                            <button type="submit" name="Delete_" class="btn btn-danger"><i class="fas fa-box-open"></i> Ya</button>
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
                                                            <h4 class="modal-title">[Kurang] Isi Jumlah Kekurangan Botol!</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <i class="fa-solid fa-bottle-droplet" style="color: #ffd900;font-size:221px"></i>
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">ID CT <?= $row['NOMOR_AJU']; ?></h4>
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
                                                            <button type="submit" name="kurang_" class="btn btn-danger"><i class="fa-solid fa-minus"></i> Kurang</button>
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
                                                            <h4 class="modal-title">[Lebih] Isi Jumlah Kelebihan Botol!</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <i class="fa-solid fa-bottle-droplet" style="color: #90ca4b;font-size:221px"></i>
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">ID CT <?= $row['NOMOR_AJU']; ?></h4>
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
                                                            <h4 class="modal-title">[Pecah] Isi Jumlah Botol Pecah!</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <i class="fa-solid fa-bottle-droplet" style="color: #2d353c;font-size:221px"></i>
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">ID CT <?= $row['NOMOR_AJU']; ?></h4>
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
                                                            <h4 class="modal-title">[Rusak] Isi Jumlah Botol Rusak!</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div style="display: flex;">
                                                                    <i class="fa-solid fa-bottle-droplet" style="color: #f59c1a;font-size:221px"></i>
                                                                    <div class="card-body" style="margin-left: 0px;">
                                                                        <h4 class="card-title">ID CT <?= $row['NOMOR_AJU']; ?></h4>
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
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
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