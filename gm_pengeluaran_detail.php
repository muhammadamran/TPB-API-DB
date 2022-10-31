<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

// TOTAL BARANG
$contentBarangTotal     = $dbcon->query("SELECT COUNT(*) AS total FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangTotal        = mysqli_fetch_array($contentBarangTotal);
// CEK BARANG
$contentBarangCek       = $dbcon->query("SELECT COUNT(*) AS total_cek FROM plb_barang WHERE CHECKING_2 IS NOT NULL AND STATUS_CT_2='Complete' AND NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangCek          = mysqli_fetch_array($contentBarangCek);
// DETAIL, PERUSAHAAN DAN TUJUAN
$contentdatahdrbrg      = $dbcon->query("SELECT * FROM plb_header WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$datahdrbrg             = mysqli_fetch_array($contentdatahdrbrg);
// JUMLAH HARGA_PENYERAHAN DAN POS_TARIF
$dataHPPT               = $dbcon->query("SELECT SUM(HARGA_PENYERAHAN) AS HP, SUM(POS_TARIF) AS PT
                                        FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY NOMOR_AJU ORDER BY ID", 0);
$HPPT                   = mysqli_fetch_array($dataHPPT);
// CEK ADA PENGECEKAN BOTOL ATAU TIDAK
$contentcekbrgvalidasi  = $dbcon->query("SELECT COUNT(CHECKING_2) AS validasi_cek FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING_2='Checking Botol' ORDER BY ID ASC", 0);
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
?>
<style>
    .btn-custom {
        font-size: 10px;
        padding: 5px;
    }

    .sm {
        max-width: 471pxpx;
        margin: 16.75rem auto;
        width: 375px;
    }

    .line-page-cek {
        height: 0.5px;
        margin: 6px 866px 23px 0px;
        background: #444e66;
    }

    .detail-barang-ct {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-ct {
        background: #fff;
        border-radius: 5px;
        padding: 5px 10px 5px 10px;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 10px;
        border: 2px solid #2d353c !important;
        text-transform: uppercase;
    }

    .total-ct-ak {
        background: #00acac;
        border-radius: 5px;
        padding: 5px 10px 5px 10px;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 10px;
        color: #fff !important;
        border: 2px solid #fff !important;
        text-transform: uppercase;
    }
</style>

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
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-door-open icon-page"></i>
                <font class="text-page">Gate Mandiri</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Barang Keluar</a></li>
                <li class="breadcrumb-item active">Detail Nomor AJU: <?= $_GET['AJU'] ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css">
                <i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span>
            </button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- BACK -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1" style="padding: 15px;">
                <a href="gm_pengeluaran.php" class="btn btn-yellow"><i class="fas fa-caret-square-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- END BACK -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Detail] Pengecekan Data Barang Keluar</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- DETAIL -->
                    <div class="detail-barang-ct">
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
                                        <font style="color:#000!important;font-size: .9375rem;">Pos Tarif:</font>
                                        <b> <?= Rupiah($HPPT['PT']); ?></b>
                                    </h4>
                                </div>
                                <div class="widget-card-content bottom">
                                    <b class="text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><i class="fas fa-building"></i> Asal PLB: <?= $datahdrbrg['PERUSAHAAN'] ?> - Tujuan/Penerima: <?= $datahdrbrg['NAMA_PENERIMA_BARANG'] ?>.</b>
                                </div>
                            </a>
                        </div>
                        <div style="padding: 0px;">
                            <!-- NILAI AWAL -->
                            <div>
                                <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b>NILAI AWAL BARANG</b></h5>
                            </div>
                            <div class="total-ct">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fas fa-boxes"></i></td>
                                            <td style="width: 110px; height: 18px;">Total CT</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $CT['p_CT']; ?> CT</td>
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
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $BTL['p_BOTOL']; ?> Botol</td>
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
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $LTR['p_LITER']; ?> Liter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- NILAI AKTUAL -->
                            <div>
                                <h5 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b>NILAI AKTUAL BARANG</b></h5>
                            </div>
                            <div class="total-ct-ak">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fas fa-boxes"></i></td>
                                            <td style="width: 110px; height: 18px;">Total CT</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $A_CT['p_CT']; ?> CT</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-ct-ak">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fa-solid fa-bottle-droplet"></i></td>
                                            <td style="width: 110px; height: 18px;">Total Botol</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= $A_BTL['p_BOTOL']; ?> Botol</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-ct-ak">
                                <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 10px;"><i class="fa-solid fa-glass-water-droplet"></i></td>
                                            <td style="width: 110px; height: 18px;">Total Liter</td>
                                            <td style="width: 10px; height: 18px;">:</td>
                                            <td style="width: 150px; height: 18px; text-align: right;"><?= floor($A_LTR['p_LITER']); ?> Liter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- DETAIL -->
                    <hr>
                    <!-- PETUGAS -->
                    <div class="row">
                        <div class="col-sm-6" style="margin-left: 5px;font-size: 14px;font-weight: 800;">
                            <i class="far fa-user-circle"></i> Petugas: <?= $_SESSION['username']; ?>
                        </div>
                    </div>
                    <!-- END PETUGAS -->
                    <!-- Kurang -->
                    <?php if ($_GET['AlertSimpan'] == 'Success') { ?>
                        <hr>
                        <div class="note note-success">
                            <div class="note-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Berhasil Disimpan!</b></h4>
                                <p> Detail CT <b>Berhasil disimpan</b>!</p>
                            </div>
                        </div>
                    <?php } else if ($_GET['AlertSimpan'] == 'Failed') { ?>
                        <hr>
                        <div class="note note-danger">
                            <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="note-content">
                                <h4><b>Gagal Disimpan!</b></h4>
                                <p> Detail CT <b>Gagal disimpan</b>!</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDBarang -->
                        <div class="tab-pane fade active show" id="IDBarang">
                            <hr>
                            <form id="form-submit" action="" method="POST">
                                <div style="margin-bottom: 10px;">
                                    <font style="font-weight: 800;">Status Barang:</font>
                                </div>
                                <div style="display: flex;justify-content: flex-start;align-content: baseline;">
                                    <?php
                                    $checking = $dbcon->query("SELECT brg.NOMOR_AJU,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING_2='Done') AS checking,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS barang
                                                            FROM plb_barang AS brg  WHERE brg.NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY brg.NOMOR_AJU");
                                    $resultChecking = mysqli_fetch_array($checking);
                                    ?>
                                    <?php if ($resultChecking['checking'] == $resultChecking['barang']) { ?>
                                        <button type="submit" id="btn-sesuai" name="PilihSemua" class="btn btn-sm btn-custom btn-success" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Keluar!">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Barang Sudah DiCek!
                                        </button>
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-sm-12" style="display: flex;">
                                                <button type="button" id="btn-tidak" name="All_tidak" class="btn btn-sm btn-custom btn-danger" data-toggle="popover" data-trigger="hover" data-title="Selesaikan Pengecekan Barang" data-placement="top" data-content="Klik untuk selesaikan Barang Keluar!">
                                                    <i class="fa-solid fa-hourglass-start"></i>
                                                    Cek Satuan Botol
                                                </button>
                                                <?php if ($cekbrgvalidasi['validasi_cek'] == 0) { ?>
                                                    <div id="buttonPilihAll" style="display:none;margin-left: 10px;">
                                                        <button type="submit" id="btn-all" name="All_sesuai" class="btn btn-sm btn-custom btn-primary" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Keluar!">
                                                            <i class="fas fa-tasks"></i>
                                                            Semua Barang Sesuai
                                                        </button>
                                                    </div>
                                                <?php } else { ?>
                                                    <div id="buttonPilihAll" style="display:none;margin-left: 10px;">
                                                        <button type="button" class="btn btn-sm btn-custom btn-warning" data-toggle="popover" data-trigger="hover" data-title="Selesaikan dahulu Data Pengecekan Barang!" data-placement="top" data-content="Silahkan selesaikan pengecekatan CT anda terlebih dahulu!">
                                                            <i class="fas fa-warning"></i>
                                                            Simpan Barang Keluar
                                                        </button>
                                                        <small class="blink_me" style="color: red;"><i>(*) Anda masih memiliki pengecekan Data CT yang belum disimpan!</i></small>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="1%">No.</th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">
                                                    <div style="display: flex;justify-content: space-evenly;align-content: center;width: 130px;">
                                                        <button type="button" class="btn btn-sm btn-primary" id="chk_new" onclick="checkAll('chk');" style="font-size: 10px;">
                                                            <i class="fa-solid fa-square-check"></i>
                                                            Pilih Semua
                                                        </button>
                                                    </div>
                                                </th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">
                                                    <div style="display: flex;justify-content: space-evenly;align-content: center;width: 130px;">
                                                        Cek Barang Keluar
                                                    </div>
                                                </th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">Status</th>
                                                <th colspan="6" style="text-align: center;">Barang</th>
                                                <th colspan="3" style="text-align: center;">Jumlah</th>
                                                <th rowspan="2" style="text-align: center;">CIF</th>
                                                <th rowspan="2" style="text-align: center;">Harga Penyerahan</th>
                                                <th rowspan="2" style="text-align: center;">NETTO</th>
                                                <th rowspan="2" style="text-align: center;">Pos Tarif</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Kode</th>
                                                <th style="text-align: center;">Seri Barang</th>
                                                <th style="text-align: center;">Uraian</th>
                                                <th style="text-align: center;">Tipe</th>
                                                <th style="text-align: center;">Ukuran</th>
                                                <th style="text-align: center;">Spesifikasi Barang</th>
                                                <th style="text-align: center;">Jumlah Bahan Baku</th>
                                                <th style="text-align: center;">Jumlah Kemasan</th>
                                                <th style="text-align: center;">Jumlah Satuan</th>
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
                                                            <?php if ($rowBarang['CHECKING_2'] == 'Checking Botol') { ?>
                                                                <span class="btn btn-sm btn-yellow" data-toggle="popover" data-trigger="hover" data-title="Sedang melakukan Pengecekan Barang" data-placement="top" data-content="Sedang melakukan Pengecekan Data Barang Keluar!">
                                                                    <i class="fa-solid fa-hourglass-start"></i>
                                                                </span>
                                                            <?php } else if ($rowBarang['CHECKING_2'] == 'Botol') { ?>
                                                                <span class="btn btn-sm btn-yellow" data-toggle="popover" data-trigger="hover" data-title="Selesai melakukan Pengecekan Botol" data-placement="top" data-content="Sedang melakukan Pengecekan Data Barang Keluar!">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            <?php } else if ($rowBarang['CHECKING_2'] == 'DONE') { ?>
                                                                <span class="btn btn-sm btn-success" data-toggle="popover" data-trigger="hover" data-title="Barang Di Simpan Di GB" data-placement="top" data-content="Barang Di Simpan Di GB!">
                                                                    <i class="fa-solid fa-house-circle-check"></i>
                                                                </span>
                                                            <?php } else { ?>
                                                                <div style="margin-left: 25px;margin-bottom: 15px;margin-top: 15px;">
                                                                    <input type="checkbox" class="form-check-input" id="chk" name="CekBarang[<?= $noBarang - 1; ?>][ID]" value="<?= $rowBarang['ID'] ?>">
                                                                    <!-- PLB_BARANG_CT -->
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][NOMOR_AJU]" value="<?= $rowBarang['NOMOR_AJU'] ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][KODE_BARANG]" value="<?= $rowBarang['KODE_BARANG'] ?>">
                                                                    <!-- PLB_BARANG -->
                                                                    <!-- STATUS,OPERATOR_ONE,TGL_CEK -->
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][STATUS_2]" value="Sesuai">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][OPERATOR_ONE_2]" value="<?= $_SESSION['username'] ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TGL_CEK_2]" value="<?= date('Y-m-d H:m:i') ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][CHECKING_2]" value="DONE">
                                                                    <!-- STATUS_CT,DATE_CT,TOTAL_BOTOL_AKHIR,TOTAL_LITER_AKHIR,TOTAL_CT_AKHIR -->
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][STATUS_CT_2]" value="Complete">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][DATE_CT_2]" value="<?= date('Y-m-d H:m:i') ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_BOTOL]" value="<?= $t_botol ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_BOTOL_AKHIR]" value="<?= $t_botol * $pcs ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_LITER]" value="<?= $t_liter ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_LITER_AKHIR]" value="<?= $t_liter * ($t_botol * $pcs) ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_CT]" value="<?= $pcs ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_CT_AKHIR]" value="<?= $pcs ?>">
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <?php if ($rowBarang['KODE_BARANG'] != NULL) { ?>
                                                                <?php if ($rowBarang['CHECKING_2'] == 'DONE') { ?>
                                                                    <a href="gm_pengeluaran_ct_detail.php?ID=<?= $rowBarang['ID'] ?>&AJU=<?= $_GET['AJU'] ?>" target="_blank" class="btn btn-sm btn-custom btn-success">
                                                                        <i class="fas fa-eye" style="font-size: 16px;"></i>
                                                                        <br>
                                                                        Cek <?= $pcs ?> CT
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <?php if ($pcs == 0) { ?>
                                                                        <!-- No QTY -->
                                                                        <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-danger">
                                                                            <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                            <br>
                                                                            Cek <?= $pcs ?> CT
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <!-- Check -->
                                                                        <a href="gm_pengeluaran_ct.php?ID_BARANG=<?= $rowBarang['ID'] ?>&aksi=SubmitCT&AJU=<?= $_GET['AJU'] ?>" onClick="openWindowReload(this)" target="_blank" class="btn btn-sm btn-custom btn-warning">
                                                                            <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                            <br>
                                                                            Cek <?= $pcs ?> CT
                                                                        </a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <!-- Disabled -->
                                                                <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-secondary">
                                                                    <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                    <br>
                                                                    Cek <?= $pcs ?> CT
                                                                </a>
                                                            <?php } ?>
                                                            <div style="margin-top: 5px;font-size: 9px;">
                                                                <?php if ($rowBarang['STATUS_2'] != NULL) { ?>
                                                                    <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <div style="display: grid;font-size: 10px;width: 115px;">
                                                                <font><i class="fa-solid fa-user-pen"></i>: Petugas</font>
                                                                <font><i class="fa-solid fa-file-circle-check"></i>: Status</font>
                                                            </div>
                                                        </td>
                                                        <td style=" text-align: center;"><?= $rowBarang['KODE_BARANG']; ?>
                                                        </td>
                                                        <td style="text-align: center;"><?= $rowBarang['SERI_BARANG']; ?></td>
                                                        <td style="text-align: left;"><?= $rowBarang['URAIAN']; ?></td>
                                                        <td style="text-align: center;"><?= $rowBarang['TIPE']; ?></td>
                                                        <td style="text-align: center;"><?= $rowBarang['UKURAN']; ?></td>
                                                        <td style="text-align: center;"><?= $rowBarang['SPESIFIKASI_LAIN']; ?></td>
                                                        <td style="text-align: center">
                                                            <?php if ($rowBarang['JUMLAH_BAHAN_BAKU'] == NULL) { ?>
                                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                                </font>
                                                            <?php } else { ?>
                                                                <?= $rowBarang['JUMLAH_BAHAN_BAKU']; ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php if ($rowBarang['JUMLAH_KEMASAN'] == NULL) { ?>
                                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                                </font>
                                                            <?php } else { ?>
                                                                <?= $rowBarang['JUMLAH_KEMASAN']; ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex;justify-content: space-evenly;align-items:center">
                                                                <font><?= $rowBarang['KODE_SATUAN']; ?></font>
                                                                <font><?= $rowBarang['JUMLAH_SATUAN']; ?></font>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;"><?= $rowBarang['CIF']; ?></td>
                                                        <td style="text-align: center;">
                                                            <div style="width: 155px;">
                                                                <?= Rupiah($rowBarang['HARGA_PENYERAHAN']); ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;"><?= $rowBarang['NETTO']; ?></td>
                                                        <td style="text-align: center;">
                                                            <div style="width: 155px;">
                                                                <?= Rupiah($rowBarang['POS_TARIF']); ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $noBarang++;
                                                endforeach
                                                ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="17">
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
                            </form>
                        </div>
                        <!-- End IDBarang -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
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
        var VarAll = document.getElementById("buttonPilihAll");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                if (inputs[i].checked == true) {
                    inputs[i].checked = false;
                    VarAll.style.display = "none";
                } else if (inputs[i].checked == false) {
                    inputs[i].checked = true;
                    VarAll.style.display = "block";
                }
            }
        }
    }

    // CEK BARANG
    $("#btn-all").click(function() {
        // $("#form-submit").attr('action', `gm_pengeluaran_proses.php?aksi=SubmitCT&AJU=<?= $_GET['AJU'] ?>`)
        $("#form-submit").attr('action', `gm_pengeluaran_proses.php?aksi=SubmitCTT&AJU=<?= $_GET['AJU'] ?>`)
        var confirm = window.confirm("Klik OK jika Barang Keluar sudah Sesuai!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });

    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran_detail.php?AJU=<?= $DATAAJU ?>');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran_detail.php');
    }
</script>
<script>
    function openWindowReload(link) {
        var href = link.href;
        window.open(href, '_blank');
        document.location.reload(true)
    }
</script>