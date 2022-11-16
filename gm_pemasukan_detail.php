<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
$GetNew             = '';
if (isset($_POST["GetNew_"])) {
    $GetNew         = $_POST['GetNew'];
    echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$GetNew';</script>";
}

// SIMPAN SEMUA BARANG SESUAI
if (isset($_POST["SimpanSemuaSesuai_"])) {
    $AJU            = $_GET['AJU'];
    $InputDate      = date('Y-m-d h:m:i');
    $meOK           = $_SESSION['username'];

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL", 0);
    foreach ($dataTable as $rowLine) {
        if (@$rowLine['ID']) {
            $ID = $rowLine['ID'];

            // CEK CT
            $cekCT     = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='$ID'");
            $dataCT    = mysqli_fetch_array($cekCT);

            if ($dataCT['ID_BARANG'] == NULL) {
                $contentBarang   = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$ID'");
                $dataBarang      = mysqli_fetch_array($contentBarang);
                $jml_pcs         = $dataBarang['JUMLAH_SATUAN'];
                $pcs             = str_replace(".0000", "", "$jml_pcs");
                // BOTOL
                $botol           = explode('X', $dataBarang['UKURAN']);
                $t_botol         = $botol[0];
                // LITER
                $liter           =  $botol[1];
                $r_liter         = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
                $t_liter         = str_replace(',', '.', $r_liter);
                // TOTAL BOTOL
                $total_btl = $t_botol * $pcs;
                // TOTAL NETTO
                $total_netto = $t_botol * $t_liter * $total_btl;
                // TOTAL LITER
                $total_ltr = ($t_botol * $pcs) * $t_liter;

                for ($i = 0; $i < $pcs; $i++) {
                    $query = $dbcon->query("INSERT INTO plb_barang_ct 
                                    (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,LITER,TOTAL_LITER)
                                    VALUES
                                    ('','$dataBarang[NOMOR_AJU]','$ID','$dataBarang[KODE_BARANG]','$t_botol','$t_liter','$total_ltr')
                                    ");
                }
                // PLB HEADER
                $query .= $dbcon->query("UPDATE plb_header SET CEK_BARANG=1
                                     WHERE NOMOR_AJU='$AJU'");

                // PLB BARANG
                $query .= $dbcon->query("UPDATE plb_barang SET STATUS='Sesuai',
                                                           OPERATOR_ONE='$meOK',
                                                           TGL_CEK='$InputDate',
                                                           CHECKING='DONE',
                                                           STATUS_CT='Complete',
                                                           DATE_CT='$InputDate',
                                                           TOTAL_BOTOL_AKHIR='$total_btl',
                                                           TOTAL_LITER_AKHIR='$total_ltr',
                                                           TOTAL_CT_AKHIR='$pcs',
                                                           BOTOL='$t_botol',
                                                           LITER='$t_liter',                                                      
                                                           NETTO_AKHIR='$total_netto'                                                      
                                     WHERE NOMOR_AJU='$AJU' AND ID='$ID'");

                // FOR AKTIFITAS
                $me         = $_SESSION['username'];
                $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
                $resultme   = mysqli_fetch_array($datame);

                $IDUNIQme             = $resultme['USRIDUNIQ'];
                $InputUsername        = $me;
                $InputModul           = 'Gate In/Detail/CT';
                $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'];
                $InputAction          = 'Simpan Barang Masuk';
                $InputDate            = date('Y-m-d h:m:i');

                $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
            }
        }
    }
    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertSuccess';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertFailed';</script>";
    }
}
// END SIMPAN SEMUA BARANG SESUAI

// TOTAL BARANG
$contentBarangTotal     = $dbcon->query("SELECT COUNT(*) AS total FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangTotal        = mysqli_fetch_array($contentBarangTotal);
// CEK BARANG
$contentBarangCek       = $dbcon->query("SELECT COUNT(*) AS total_cek FROM plb_barang WHERE CHECKING IS NOT NULL AND STATUS_CT='Complete' AND NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangCek          = mysqli_fetch_array($contentBarangCek);
// DETAIL, PERUSAHAAN DAN TUJUAN
$contentdatahdrbrg      = $dbcon->query("SELECT * FROM plb_header AS plb
                                         LEFT OUTER JOIN referensi_negara AS ngr ON ngr.KODE_NEGARA=plb.KODE_NEGARA_PEMASOK
                                         WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY plb.ID ASC", 0);
$datahdrbrg             = mysqli_fetch_array($contentdatahdrbrg);
// JUMLAH HARGA_PENYERAHAN DAN POS_TARIF
$dataHPPT               = $dbcon->query("SELECT SUM(HARGA_PENYERAHAN) AS HP, SUM(POS_TARIF) AS PT
                                        FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY NOMOR_AJU ORDER BY ID", 0);
$HPPT                   = mysqli_fetch_array($dataHPPT);
// CEK ADA PENGECEKAN BOTOL ATAU TIDAK
$contentcekbrgvalidasi  = $dbcon->query("SELECT COUNT(CHECKING) AS validasi_cek FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING='Checking Botol' ORDER BY ID ASC", 0);
$cekbrgvalidasi         = mysqli_fetch_array($contentcekbrgvalidasi);
// CEK CT
$contentCT              = $dbcon->query("SELECT SUM(JUMLAH_SATUAN) AS p_CT FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY NOMOR_AJU ORDER BY ID", 0);
$CT                     = mysqli_fetch_array($contentCT);
// CEK BOTOL
$contentBTL             = $dbcon->query("SELECT SUM(UKURAN*JUMLAH_SATUAN) AS p_BOTOL FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$BTL                    = mysqli_fetch_array($contentBTL);
// CEK LITER
$contentLTR             = $dbcon->query("SELECT SUM(JUMLAH_SATUAN*SUBSTRING_INDEX(UKURAN, 'X', 1)*(REPLACE(SUBSTRING_INDEX(UKURAN, 'X', -1),',','.'))) AS p_LITER
                                        FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$LTR                    = mysqli_fetch_array($contentLTR);
// NILAI AKTUAL
// CT
// $content_A_CT            = $dbcon->query("SELECT SUM(TOTAL_CT_AKHIR) AS p_CT FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY NOMOR_AJU ORDER BY ID", 0);
$content_A_CT           = $dbcon->query("SELECT SUM(TOTAL_CT_AKHIR) AS p_CT FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$A_CT                   = mysqli_fetch_array($content_A_CT);
// BOTOL
// $content_A_BTL           = $dbcon->query("SELECT SUM(UKURAN*TOTAL_CT_AKHIR) AS p_BOTOL FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$content_A_BTL          = $dbcon->query("SELECT SUM(TOTAL_BOTOL_AKHIR) AS p_BOTOL FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$A_BTL                  = mysqli_fetch_array($content_A_BTL);
// LITER
// $content_A_LTR           = $dbcon->query("SELECT SUM(TOTAL_CT_AKHIR*SUBSTRING_INDEX(UKURAN, 'X', 1)*(REPLACE(SUBSTRING_INDEX(UKURAN, 'X', -1),',','.'))) AS p_LITER
//                                         FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$content_A_LTR          = $dbcon->query("SELECT SUM(TOTAL_BOTOL * LITER) AS p_LITER FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID", 0);
$A_LTR                  = mysqli_fetch_array($content_A_LTR);

// CEK PENYESUAIAN
$contentPenyesuaian     = $dbcon->query("SELECT COUNT(btl.NOMOR_AJU) AS total_penyesuaian FROM plb_barang_ct_botol AS btl WHERE btl.NOMOR_AJU='" . $_GET['AJU'] . "'");
$resultPenyesuaian      = mysqli_fetch_array($contentPenyesuaian);

// CHECKING
$checking               = $dbcon->query("SELECT brg.NOMOR_AJU,
                                        (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING='Done') AS checking,
                                        (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS barang
                                        FROM plb_barang AS brg  WHERE brg.NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY brg.NOMOR_AJU");
$resultChecking         = mysqli_fetch_array($checking);

// CEK PETUGAS COMPANY
$contentPetugas         = $dbcon->query("SELECT * FROM rcd_status WHERE bm_no_aju_plb='" . $_GET['AJU'] . "'");
$resultPetugas          = mysqli_fetch_array($contentPetugas);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Pengecekan Barang Gate In App Name | Company </title>
<?php } else { ?>
    <title>Pengecekan Barang Gate In - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<style>
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
</style>
<!-- begin #content -->
<div id="content" class="content">
    <div class="header-page">
        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-8">
                    <a href="gm_pemasukan.php" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
                </div>
                <div class="col-sm-3" style="display: flex;justify-content: end;">
                    <select name="GetNew" class="default-select2 form-control" required>
                        <option value="<?= $_GET['AJU']; ?>"><?= $_GET['AJU']; ?></option>
                        <option value="">Pilih Nomor Pengajuan GB</option>
                        <?php
                        $resultMitra = $dbcon->query("SELECT NOMOR_AJU FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NULL");
                        foreach ($resultMitra as $RowMitra) {
                        ?>
                            <option value="<?= $RowMitra['NOMOR_AJU'] ?>"><?= $RowMitra['NOMOR_AJU'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-1" style="display: flex;justify-content: end;">
                    <button type="submit" name="GetNew_" class="btn btn-block btn-dark"><i class="fas fa-link"></i> Get</button>
                </div>
            </div>
        </form>
    </div>
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-door-open icon-page"></i>
                <font class="text-page">Gate Mandiri</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate In</a></li>
                <li class="breadcrumb-item active">Detail Nomor AJU: <?= $_GET['AJU'] ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css">
                <i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span>
            </button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- BACK -->
    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="gm_pemasukan.php" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="gm_pemasukan.php" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- END BACK -->

    <!-- Status Gate In -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-star"></i> Status Data Gate In</h4>
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
                                                    <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="far fa-star"></i> NOMOR PENGAJUAN PLB: <?= $datahdrbrg['NOMOR_AJU']; ?></b></h5>
                                                    <h4 class="mb-10px text-blue">
                                                        <b>
                                                            <i class="fas fa-layer-group"></i>
                                                            TOTAL: <?= $dataBarangTotal['total']; ?> BARANG -
                                                            <i class="fas fa-cubes"></i>
                                                            <?php if ($dataBarangCek['total_cek'] == 0) { ?>
                                                                <font style="color:#6f7d87!important;">CEK: <?= $dataBarangCek['total_cek']; ?> BARANG</font>
                                                            <?php } else if ($dataBarangCek['total_cek'] != 0 || $dataBarangCek['total_cek'] != $dataBarangTotal['total']) { ?>
                                                                <font style="color: #e91e63!important;" class="blink_me">CEK: <?= $dataBarangCek['total_cek']; ?> BARANG</font>
                                                            <?php } else if ($dataBarangCek['total_cek'] == $dataBarangTotal['total']) { ?>
                                                                CEK: <?= $dataBarangCek['total_cek']; ?> BARANG
                                                            <?php } ?>
                                                        </b>
                                                    </h4>
                                                    <h4 class="mb-10px text-blue">
                                                        <font style="color:#000!important;font-size: .9375rem;">Harga Penyerahan:</font>
                                                        <b> <?= Rupiah($HPPT['HP']); ?></b>
                                                    </h4>
                                                    <h4 class="mb-10px text-blue">
                                                        <font style="color:#000!important;font-size: .9375rem;">Negara Asal:</font>
                                                        <?php if ($datahdrbrg['URAIAN_NEGARA'] == NULL) { ?>
                                                            <b style="color: red;"> Not Found</b>
                                                        <?php } else { ?>
                                                            <b> <?= $datahdrbrg['URAIAN_NEGARA']; ?></b>
                                                        <?php } ?>
                                                    </h4>
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
                                                            <?= $datahdrbrg['PERUSAHAAN']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;font-size: 10px;">
                                                            Asal BC 2.7 PLB
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
                                                            Tujuan BC 2.7 PLB
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
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $CT['p_CT']; ?>">0</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                                            TOTAL BOTOL
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $BTL['p_BOTOL']; ?>">0</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                                            TOTAL LITER
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $LTR['p_LITER']; ?>">0</span></div>
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
                                                            <?php if ($A_CT['p_CT'] == NULL) { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0">0</span></div>
                                                            <?php } else { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $A_CT['p_CT']; ?>">0</span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                                            TOTAL BOTOL
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <?php if ($A_BTL['p_BOTOL'] == NULL) { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0">0</span></div>
                                                            <?php } else { ?>
                                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $A_BTL['p_BOTOL']; ?>">0</span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
                                                            TOTAL LITER
                                                        </div>
                                                        <div class="d-flex align-items-center ml-auto">
                                                            <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= floor($A_LTR['p_LITER']); ?>">0</span></div>
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
                    <?php if ($resultPenyesuaian['total_penyesuaian'] != 0) { ?>
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 10px;">
                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                    <div style="font-size: 30px;">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="font-size: 17px;font-weight: 900;">
                                            DATA PENYESUAIAN
                                        </div>
                                        <div style="margin-top: -5px;font-size: 10px;">
                                            Gate Mandiri - Gate In
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="table-responsive">
                                    <table id="C_TableDefault_L_3" class="table table-striped table-bordered table-td-valign-middle">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="1%">No.</th>
                                                <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Barang</th>
                                                <!-- <th rowspan="2" class="text-nowrap" style="text-align: center;">Uraian</th> -->
                                                <!-- <th rowspan="2" class="text-nowrap" style="text-align: center;">Tipe</th> -->
                                                <!-- <th rowspan="2" class="text-nowrap" style="text-align: center;">Ukuran</th> -->
                                                <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Uraian</th>
                                                <th colspan="4" class="text-nowrap no-sort" style="text-align: center;">Kriteria</th>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap no-sort" style="text-align: center;">
                                                    <span class="btn btn-block btn-yellow"><i class="fa fa-minus"></i> Kurang</span>
                                                </th>
                                                <th class="text-nowrap no-sort" style="text-align: center;">
                                                    <span class="btn btn-block btn-lime"><i class="fa fa-plus"></i> Lebih</span>
                                                </th>
                                                <th class="text-nowrap no-sort" style="text-align: center;">
                                                    <span class="btn btn-block btn-dark"><i class="fa fa-tag"></i> Pecah</span>
                                                </th>
                                                <th class="text-nowrap no-sort" style="text-align: center;">
                                                    <span class="btn btn-block btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dataKriteria = $dbcon->query("SELECT btl.KODE_BARANG,brg.URAIAN,brg.TIPE,brg.URAIAN,brg.UKURAN,brg.SPESIFIKASI_LAIN,
                                                                           btl.KURANG AS t_KURANG,
                                                                           btl.LEBIH AS t_LEBIH,
                                                                           btl.PECAH AS t_PECAH,
                                                                           btl.RUSAK AS t_RUSAK
                                                                           FROM plb_barang_ct_botol AS btl
                                                                           LEFT OUTER JOIN plb_barang AS brg ON brg.ID=btl.ID_BARANG
                                                                           WHERE btl.NOMOR_AJU='" . $_GET['AJU'] . "' AND POSISI='IN' ORDER BY btl.ID DESC");
                                            if (mysqli_num_rows($dataKriteria) > 0) {
                                                $noKriteria = 0;
                                                while ($rowKriteria = mysqli_fetch_array($dataKriteria)) {
                                                    $noKriteria++;
                                            ?>
                                                    <tr>
                                                        <td><?= $noKriteria; ?>.</td>
                                                        <td style="text-align: left;">
                                                            <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kode Barang, Tipe & Spesifikasi Lain">
                                                                    <i class="fas fa-boxes"></i>
                                                                </div>
                                                                <div style="display: grid;margin-left:5px">
                                                                    <div>
                                                                        <?= $rowKriteria['KODE_BARANG']; ?>
                                                                    </div>
                                                                    <div style="margin-top: -5px;">
                                                                        <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowKriteria['SPESIFIKASI_LAIN']; ?> - <?= $rowKriteria['TIPE']; ?></font>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Uraian & Ukuran">
                                                                    <i class="fas fa-quote-right"></i>
                                                                </div>
                                                                <div style="display: grid;margin-left:5px">
                                                                    <div>
                                                                        <?= $rowKriteria['URAIAN']; ?>
                                                                    </div>
                                                                    <div style="margin-top: -5px;">
                                                                        <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowKriteria['UKURAN']; ?></font>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;"><?= $rowKriteria['t_KURANG'] == NULL ? "<font style='background:#000;width:100px'>Not Found</font>" : "$rowKriteria[t_KURANG]" ?></td>
                                                        <td style="text-align: center;"><?= $rowKriteria['t_LEBIH'] == NULL ? "<font style='background:#000;width:100px'>Not Found</font>" : "$rowKriteria[t_LEBIH]" ?></td>
                                                        <td style="text-align: center;"><?= $rowKriteria['t_PECAH'] == NULL ? "<font style='background:#000;width:100px'>Not Found</font>" : "$rowKriteria[t_PECAH]" ?></td>
                                                        <td style="text-align: center;"><?= $rowKriteria['t_RUSAK'] == NULL ? "<font style='background:#000;width:100px'>Not Found</font>" : "$rowKriteria[t_RUSAK]" ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="7">
                                                        <center>
                                                            <div style="display: grid;">
                                                                <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            // KURANG
                                            $dataTKURANG = $dbcon->query("SELECT SUM(KURANG) AS f_KURANG FROM plb_barang_ct_botol WHERE POSISI='IN' AND NOMOR_AJU='" . $_GET['AJU'] . "'");
                                            $resultTKURANG = mysqli_fetch_array($dataTKURANG);
                                            // LEBIH
                                            $dataTLEBIH = $dbcon->query("SELECT SUM(LEBIH) AS f_LEBIH FROM plb_barang_ct_botol WHERE POSISI='IN' AND NOMOR_AJU='" . $_GET['AJU'] . "'");
                                            $resultTLEBIH = mysqli_fetch_array($dataTLEBIH);
                                            // PECAH
                                            $dataTPECAH = $dbcon->query("SELECT SUM(PECAH) AS f_PECAH FROM plb_barang_ct_botol WHERE POSISI='IN' AND NOMOR_AJU='" . $_GET['AJU'] . "'");
                                            $resultTPECAH = mysqli_fetch_array($dataTPECAH);
                                            // RUSAK
                                            $dataTRUSAK = $dbcon->query("SELECT SUM(RUSAK) AS f_RUSAK FROM plb_barang_ct_botol WHERE POSISI='IN' AND NOMOR_AJU='" . $_GET['AJU'] . "'");
                                            $resultTRUSAK = mysqli_fetch_array($dataTRUSAK);
                                            ?>
                                            <tr>
                                                <th colspan="3" style="text-align: center;">TOTAL</th>
                                                <th style="text-align: center;"><?= $resultTKURANG['f_KURANG'] == NULL ? '0' : "$resultTKURANG[f_KURANG]" ?></th>
                                                <th style="text-align: center;"><?= $resultTLEBIH['f_LEBIH'] == NULL ? '0' : "$resultTLEBIH[f_LEBIH]" ?></th>
                                                <th style="text-align: center;"><?= $resultTPECAH['f_PECAH'] == NULL ? '0' : "$resultTPECAH[f_PECAH]" ?></th>
                                                <th style="text-align: center;"><?= $resultTRUSAK['f_RUSAK'] == NULL ? '0' : "$resultTRUSAK[f_RUSAK]" ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <img src="assets/img/svg/research-paper-animate.svg" alt="Data Gate In Penyusuaian Images">
                            </div>
                        </div>
                    <?php } else { ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status Gate In -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-info-circle"></i> [Gate Mandiri] Data Gete In</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- ALERT NO SWEET -->
                    <!-- BERHASIL -->
                    <?php if (isset($_GET['AlertSuccess'])) { ?>
                        <div class="alert alert-success fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Berhasil!</strong>
                            Data Gate In berhasil disimpan!
                        </div>
                    <?php } ?>
                    <!-- END BERHASIL -->

                    <!-- GAGAL -->
                    <?php if (isset($_GET['AlertFailed'])) { ?>
                        <div class="alert alert-danger fade show m-b-10">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Gagal!</strong>
                            Data Gate In gagal disimpan!
                        </div>
                    <?php } ?>
                    <!-- END GAGAL -->
                    <!-- END ALERT NO SWEET -->

                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDBarang -->
                        <div class="tab-pane fade active show" id="IDBarang">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if ($resultChecking['checking'] == $resultChecking['barang']) { ?>
                                        <div class="note note-success m-b-15">
                                            <div class="note-icon"><i class="fa-solid fa-check-circle"></i></div>
                                            <div class="note-content">
                                                <h4><b>Barang disimpan!</b></h4>
                                                <p>
                                                    Data <b>Gate In</b> pada <b>Nomor Pengajuan BC 2.7 PLB <?= $_GET['AJU']; ?></b> berhasil disimpan kedalam sistem <b><?= $resultSetting['app_name'] ?></b>.
                                                    <br>
                                                    Selanjutnya, lengkapi <b>Nomor Pengajuan BC 2.7 GB</b>, <b>Tanggal Gate In</b>, <b>Nama Petugas <?= $resultSetting['company'] ?></b>, <b>Berita Acara</b> dan <b>Petugas BeaCukai</b> yang mengawasi, pada halaman <a href="gm_pemasukan.php" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Klik Disini!"><b>Gate In</b></a>.
                                                </p>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="note note-yellow m-b-15">
                                            <div class="note-icon"><i class="fa-solid fa-warning"></i></div>
                                            <div class="note-content">
                                                <h4><b>Pengecekan Barang Gate In!</b></h4>
                                                <p>
                                                    Silahkan lakukan pengecekan data <b>Gate In</b> pada <b>Nomor Pengajuan BC 2.7 PLB <?= $_GET['AJU']; ?></b> <b><?= $resultSetting['app_name'] ?></b>.
                                                <ul style="margin-top: -15px;">
                                                    <li>Klik <b>Pilih Semua</b> pada tabel jika <b>Semua Barang Sesuai</b>.</li>
                                                    <li>Silahkan pilih dan klik button <b>CT</b> pada setiap kolom jika terdapat <b>Kriteria Botol Kurang</b>, <b>Lebih</b>, <b>Pecah</b> atau <b>Rusak</b>.</li>
                                                </ul>
                                                </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
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
                                    <!-- END PETUGAS -->
                                    <?php if ($cekbrgvalidasi['validasi_cek'] == 0) { ?>
                                        <!-- BUTTON SAVE ALL -->
                                        <div id="buttonPilihAll" style="display:none;margin-top: 15px;">
                                            <a href="#modal-User-Web-System" name="All_sesuai" class="btn btn-primary" data-toggle="modal">
                                                <i class="fa-solid fa-square-check" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Semua Barang Gate In Sesuai"></i>
                                                Semua Barang Sesuai
                                            </a>
                                        </div>
                                        <!-- Simpan Barang -->
                                        <div class="modal fade" id="modal-User-Web-System">
                                            <div class="modal-dialog">
                                                <div class="modal-content sm">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Gate Mandiri] Data Gate In</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-primary m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan meyimpan data ini Status Barang Sesuai?</h5>
                                                                <p><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penyimpanan data dengan Status <b>Semua Barang Sesuai</b>."</i></p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="SimpanSemuaSesuai_" class="btn btn-primary"><i class="fa-solid fa-square-check"></i> Ya</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Simpan Barang -->
                                        <!-- END BUTTON SAVE ALL -->
                                    <?php } else { ?>
                                        <div class="note note-yellow m-t-15 m-b-15">
                                            <div class="note-icon"><i class="fa-solid fa-hourglass-start"></i></div>
                                            <div class="note-content">
                                                <h4><b>Selesaikan Pengecekan Kriteria!</b></h4>
                                                <p>
                                                    Silahkan selesaikan Pengecekan <b>Kriteria Botol Kurang</b>, <b>Lebih</b>, <b>Pecah</b> atau <b>Rusak</b> untuk menyimpan data <b>Gate In</b>.
                                                </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="C_TableDefault" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="1%">No.</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">
                                                <div style="display: flex;justify-content: space-evenly;align-content: center;">
                                                    <?php if ($resultChecking['checking'] == $resultChecking['barang']) { ?>
                                                        <button type="submit" id="btn-sesuai" name="PilihSemua" class="btn btn-success" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Barang disimpan!">
                                                            <i class="fa-solid fa-check-circle"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <?php if ($cekbrgvalidasi['validasi_cek'] == 0) { ?>
                                                            <button type="button" class="btn btn-primary" id="chk_new" onclick="checkAll('chk');" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Klik jika Semua Barang Sesuai">
                                                                <i class="fa-solid fa-square-check"></i>
                                                                Pilih Semua
                                                            </button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-yellow" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sedang melakukan Pengecekan Kriteria Botol.">
                                                                <i class="fa-solid fa-hourglass-start"></i>
                                                            </button>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">
                                                <div style="display: flex;justify-content: space-evenly;align-content: center;">
                                                    Cek CT
                                                </div>
                                            </th>
                                            <th colspan="3" class="no-sort" style="text-align: center;">Barang</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">Jumlah Satuan</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">Harga Penyerahan & CIF</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">NETTO & Pos Tarif</th>
                                        </tr>
                                        <tr>
                                            <th class="no-sort" style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th class="no-sort" style="text-align: center;">Uraian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
                                        if ($dataTable) : $noBarang = 1;
                                            foreach ($dataTable as $rowBarang) :
                                                $jml_pcs = $rowBarang['JUMLAH_SATUAN'];
                                                $pcs = str_replace(".0000", "", "$jml_pcs");
                                                // TOTAL BOTOL
                                                $botol = explode('X', $rowBarang['UKURAN']);
                                                $t_botol = $botol[0];
                                                // TOTAL LITER
                                                $liter =  $botol[1];
                                                $r_liter = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
                                                $t_liter = str_replace(',', '.', $r_liter);
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noBarang ?>. </td>
                                                    <td style="text-align: center;">
                                                        <?php if ($rowBarang['CHECKING'] == 'Checking Botol') { ?>
                                                            <span class="btn btn-yellow" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sedang melakukan Pengecekan Kriteria Botol -> Klik kolom Cek CT.">
                                                                <i class="fa-solid fa-hourglass-start"></i>
                                                            </span>
                                                        <?php } else if ($rowBarang['CHECKING'] == 'Botol') { ?>
                                                            <span class="btn btn-yellow" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sedang melakukan Pengecekan Kriteria Botol -> Klik kolom Cek CT.">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>
                                                        <?php } else if ($rowBarang['CHECKING'] == 'DONE') { ?>
                                                            <span class="btn btn-success" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Barang disimpan!">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                            </span>
                                                        <?php } else { ?>
                                                            <div style="margin-left: 25px;margin-bottom: 15px;margin-top: 15px;">
                                                                <input type="checkbox" class="form-check-input" id="chk" name="chk[<?= $noBarang - 1; ?>][ID]" value="<?= $rowBarang['ID'] ?>">
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php if ($rowBarang['KODE_BARANG'] != NULL) { ?>
                                                            <?php if ($rowBarang['CHECKING'] == 'DONE') { ?>
                                                                <a href="gm_pemasukan_ct_detail.php?ID=<?= $rowBarang['ID'] ?>&AJU=<?= $_GET['AJU'] ?>" target="_blank" class="btn btn-block btn-success">
                                                                    <i class="fas fa-boxes" style="font-size: 14px;"></i>
                                                                    <font><?= $pcs ?> CT</font>
                                                                </a>
                                                            <?php } else { ?>
                                                                <?php if ($pcs == 0) { ?>
                                                                    <!-- No QTY -->
                                                                    <a href="#" data-toggle="modal" class="btn btn-block btn-danger">
                                                                        <i class="fas fa-boxes" style="font-size: 14px;"></i>
                                                                        <font><?= $pcs ?> CT</font>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <!-- Check -->
                                                                    <a href="gm_pemasukan_ct.php?ID=<?= $rowBarang['ID'] ?>&AJU=<?= $_GET['AJU'] ?>&aksi=SubmitCT&Alert=CekBarangMasuk" onClick="openWindowReload(this)" target="_blank" class="btn btn-block btn-yellow">
                                                                        <i class="fas fa-boxes" style="font-size: 14px;"></i>
                                                                        <font><?= $pcs ?> CT</font>
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <!-- Disabled -->
                                                            <a href="#" data-toggle="modal">
                                                                <div class="ct-content-secondary">
                                                                    <i class="fas fa-boxes" style="font-size: 14px;"></i>
                                                                    <br>
                                                                    <font><?= $pcs ?> CT</font>
                                                                </div>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: left;">
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                            <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kode Barang, Tipe & Spesifikasi Lain">
                                                                <i class="fas fa-boxes"></i>
                                                            </div>
                                                            <div style="display: grid;margin-left:5px">
                                                                <div>
                                                                    <?= $rowBarang['KODE_BARANG']; ?>
                                                                </div>
                                                                <div style="margin-top: -5px;">
                                                                    <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowBarang['SPESIFIKASI_LAIN']; ?> - <?= $rowBarang['TIPE']; ?></font>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: flex;margin-top: 5px;margin-left:5px">
                                                            <?php if ($rowBarang['STATUS'] != NULL) { ?>
                                                                <font style="font-size: 9px;font-weight: 300;margin-top:0px"><i class="fa-solid fa-clock"></i> <i>Time: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;"><?= $rowBarang['SERI_BARANG']; ?></td>
                                                    <td style="text-align: left;">
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                            <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Uraian & Ukuran">
                                                                <i class="fas fa-quote-right"></i>
                                                            </div>
                                                            <div style="display: grid;margin-left:5px">
                                                                <div>
                                                                    <?= $rowBarang['URAIAN']; ?>
                                                                </div>
                                                                <div style="margin-top: -5px;">
                                                                    <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowBarang['UKURAN']; ?></font>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div style="display: flex;justify-content: space-evenly;align-items:center">
                                                            <font><?= $rowBarang['KODE_SATUAN']; ?></font>
                                                            <font><?= $rowBarang['JUMLAH_SATUAN']; ?></font>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: left;">
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                            <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Harga Penyerahan & CIF">
                                                                <i class="fas fa-money-bill"></i>
                                                            </div>
                                                            <div style="display: grid;margin-left:5px">
                                                                <div>
                                                                    <?= Rupiah($rowBarang['HARGA_PENYERAHAN']); ?>
                                                                </div>
                                                                <div style="margin-top: -5px;">
                                                                    <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowBarang['CIF']; ?></font>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                            <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="NETTO & Pos Tarif">
                                                                <i class="fas fa-tint"></i>
                                                            </div>
                                                            <div style="display: grid;margin-left:5px">
                                                                <div>
                                                                    <?= $rowBarang['NETTO']; ?>
                                                                </div>
                                                                <div style="margin-top: -5px;">
                                                                    <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $rowBarang['POS_TARIF']; ?></font>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                $noBarang++;
                                            endforeach
                                            ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarang -->
                    </div>
                    <!-- Menu Tap -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>
<script type="text/javascript">
    function openWindowReload(link) {
        var href = link.href;
        window.open(href, '_blank');
        document.location.reload(true)
    }
</script>