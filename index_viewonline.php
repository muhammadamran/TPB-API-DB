<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
// include "include/top-sidebar.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// PLB
// TOTAL BC PLB
$dataBCPLB = $dbcon->query("SELECT COUNT(*) AS total_bc_plb FROM plb_header");
$resultBCPLB = mysqli_fetch_array($dataBCPLB);
if ($resultBCPLB['total_bc_plb'] == NULL) {
    $resultBCPLB_show = 0;
} else {
    $resultBCPLB_show = $resultBCPLB['total_bc_plb'];
}
// BC 23
$dataBCPLB23 = $dbcon->query("SELECT COUNT(*) AS total_bc_23 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='23'");
$resultBCPLB23 = mysqli_fetch_array($dataBCPLB23);
if ($resultBCPLB23 == NULL) {
    $resultBCPLB23_show = 0;
} else {
    $resultBCPLB23_show = $resultBCPLB23['total_bc_23'];
}
// BC 25
$dataBCPLB25 = $dbcon->query("SELECT COUNT(*) AS total_bc_25 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='25'");
$resultBCPLB25 = mysqli_fetch_array($dataBCPLB25);
if ($resultBCPLB25 == NULL) {
    $resultBCPLB25_show = 0;
} else {
    $resultBCPLB25_show = $resultBCPLB25['total_bc_25'];
}
// BC 261
$dataBCPLB261 = $dbcon->query("SELECT COUNT(*) AS total_bc_261 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='261'");
$resultBCPLB261 = mysqli_fetch_array($dataBCPLB261);
if ($resultBCPLB261 == NULL) {
    $resultBCPLB261_show = 0;
} else {
    $resultBCPLB261_show = $resultBCPLB261['total_bc_261'];
}
// BC 27
$dataBCPLB27 = $dbcon->query("SELECT COUNT(*) AS total_bc_27 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='27'");
$resultBCPLB27 = mysqli_fetch_array($dataBCPLB27);
if ($resultBCPLB27 == NULL) {
    $resultBCPLB27_show = 0;
} else {
    $resultBCPLB27_show = $resultBCPLB27['total_bc_27'];
}
// BC 40
$dataBCPLB40 = $dbcon->query("SELECT COUNT(*) AS total_bc_40 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='40'");
$resultBCPLB40 = mysqli_fetch_array($dataBCPLB40);
if ($resultBCPLB40 == NULL) {
    $resultBCPLB40_show = 0;
} else {
    $resultBCPLB40_show = $resultBCPLB40['total_bc_40'];
}
// BC 41
$dataBCPLB41 = $dbcon->query("SELECT COUNT(*) AS total_bc_41 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='41'");
$resultBCPLB41 = mysqli_fetch_array($dataBCPLB41);
if ($resultBCPLB41 == NULL) {
    $resultBCPLB41_show = 0;
} else {
    $resultBCPLB41_show = $resultBCPLB41['total_bc_41'];
}

// GB
// TOTAL BC GB
$dataBCGB = $dbcon->query("SELECT COUNT(*) AS total_bc_gb FROM tpb_header");
$resultBCGB = mysqli_fetch_array($dataBCGB);
if ($resultBCGB == NULL) {
    $resultBCGB_show = 0;
} else {
    $resultBCGB_show = $resultBCGB['total_bc_gb'];
}
// BC 23
$dataBCGB23 = $dbcon->query("SELECT COUNT(*) AS total_bc_23 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='23'");
$resultBCGB23 = mysqli_fetch_array($dataBCGB23);
if ($resultBCGB23 == NULL) {
    $resultBCGB23_show = 0;
} else {
    $resultBCGB23_show = $resultBCGB23['total_bc_23'];
}
// BC 25
$dataBCGB25 = $dbcon->query("SELECT COUNT(*) AS total_bc_25 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='25'");
$resultBCGB25 = mysqli_fetch_array($dataBCGB25);
if ($resultBCGB25 == NULL) {
    $resultBCGB25_show = 0;
} else {
    $resultBCGB25_show = $resultBCGB25['total_bc_25'];
}
// BC 261
$dataBCGB261 = $dbcon->query("SELECT COUNT(*) AS total_bc_261 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='261'");
$resultBCGB261 = mysqli_fetch_array($dataBCGB261);
if ($resultBCGB261 == NULL) {
    $resultBCGB261_show = 0;
} else {
    $resultBCGB261_show = $resultBCGB261['total_bc_261'];
}
// BC 27
$dataBCGB27 = $dbcon->query("SELECT COUNT(*) AS total_bc_27 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='27'");
$resultBCGB27 = mysqli_fetch_array($dataBCGB27);
if ($resultBCGB27 == NULL) {
    $resultBCGB27_show = 0;
} else {
    $resultBCGB27_show = $resultBCGB27['total_bc_27'];
}
// BC 40
$dataBCGB40 = $dbcon->query("SELECT COUNT(*) AS total_bc_40 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='40'");
$resultBCGB40 = mysqli_fetch_array($dataBCGB40);
if ($resultBCGB40 == NULL) {
    $resultBCGB40_show = 0;
} else {
    $resultBCGB40_show = $resultBCGB40['total_bc_40'];
}
// BC 41
$dataBCGB41 = $dbcon->query("SELECT COUNT(*) AS total_bc_41 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='41'");
$resultBCGB41 = mysqli_fetch_array($dataBCGB41);
if ($resultBCGB41 == NULL) {
    $resultBCGB41_show = 0;
} else {
    $resultBCGB41_show = $resultBCGB41['total_bc_41'];
}

// DATA BC PLB TERAKHIR
$dataBCPLBTerakhir = $dbcon->query("SELECT *,SUBSTR(NOMOR_AJU,13,8) AS TGL_AJU 
                                    FROM plb_header ORDER BY ID DESC LIMIT 1");
$resultBCPLBTerakhir = mysqli_fetch_array($dataBCPLBTerakhir);
// DATA BC TPB TERAKHIR
$dataBCTPBTerakhir = $dbcon->query("SELECT *,SUBSTR(NOMOR_AJU,13,8) AS TGL_AJU 
                                    FROM tpb_header ORDER BY ID DESC LIMIT 1");
$resultBCTPBTerakhir = mysqli_fetch_array($dataBCTPBTerakhir);

// TOTAL BARANG MASUK
$QBarangMasukNULL = $dbcon->query("SELECT COUNT(*) AS total_in FROM plb_barang");
$resultQBarangMasukNULL = mysqli_fetch_array($QBarangMasukNULL);

$QBarangMasuk = $dbcon->query("SELECT COUNT(*) AS total_in FROM plb_barang WHERE STATUS_CT='Complete'");
$resultQBarangMasuk = mysqli_fetch_array($QBarangMasuk);
// TOTAL BARANG KELUAR
$QBarangKeluarNULL = $dbcon->query("SELECT COUNT(*) AS total_out FROM plb_barang");
$resultQBarangKeluarNULL = mysqli_fetch_array($QBarangKeluarNULL);

$QBarangKeluar = $dbcon->query("SELECT COUNT(*) AS total_out FROM plb_barang WHERE STATUS_CT_GB='Complete'");
$resultQBarangKeluar = mysqli_fetch_array($QBarangKeluar);

$resultDataBMBK = $resultQBarangMasuk['total_in'] + $resultQBarangKeluar['total_out'];

// DATA LINE
// BARANG MASUK
// TAHUN BARANG MASUK AWAL
$thnBMAwal = $dbcon->query("SELECT EXTRACT(YEAR FROM DATE_CT) AS THN_BM_AWAL,STATUS_CT
                            FROM `plb_barang` 
                            WHERE STATUS_CT='Complete'
                            ORDER BY EXTRACT(YEAR FROM DATE_CT) ASC LIMIT 1");
$resultthnBMAwal = mysqli_fetch_array($thnBMAwal);
// TAHUN BARANG MASUK AKHIR
$thnBMAkhir = $dbcon->query("SELECT EXTRACT(YEAR FROM DATE_CT) AS THN_BM_AKHIR,STATUS_CT
                            FROM `plb_barang` 
                            WHERE STATUS_CT='Complete'
                            ORDER BY EXTRACT(YEAR FROM DATE_CT) DESC LIMIT 1");
$resultthnBMAkhir = mysqli_fetch_array($thnBMAkhir);

$dataLineBM = $dbcon->query("SELECT COUNT(*) AS BMLine,EXTRACT(YEAR FROM DATE_CT),DATE_CT 
                            FROM `plb_barang` 
                            WHERE STATUS_CT='Complete'
                            GROUP BY EXTRACT(YEAR FROM DATE_CT) HAVING DATE_CT");
foreach ($dataLineBM as $resultdataLineBM) {
    $arrdataLineBM[] = array(
        $resultdataLineBM['BMLine']
    );
}
$JEnLineBM  = json_encode($arrdataLineBM, JSON_ERROR_NONE);
$pregLineBM = preg_replace("/[^0-9,.]/", "", $JEnLineBM);
// BARANG KELUAR
// TAHUN BARANG KELUAR AWAL
$thnBKAwal = $dbcon->query("SELECT EXTRACT(YEAR FROM DATE_CT) AS THN_BK_AWAL,STATUS_CT
                            FROM `plb_barang` 
                            WHERE STATUS_CT_GB='Complete'
                            ORDER BY EXTRACT(YEAR FROM DATE_CT) ASC LIMIT 1");
$resultthnBKAwal = mysqli_fetch_array($thnBKAwal);
// TAHUN BARANG KELUAR AKHIR
$thnBKAkhir = $dbcon->query("SELECT EXTRACT(YEAR FROM DATE_CT) AS THN_BK_AKHIR,STATUS_CT_GB
                            FROM `plb_barang` 
                            WHERE STATUS_CT_GB='Complete'
                            ORDER BY EXTRACT(YEAR FROM DATE_CT) DESC LIMIT 1");
$resultthnBKAkhir = mysqli_fetch_array($thnBKAkhir);

$dataLineBK = $dbcon->query("SELECT COUNT(*) AS BKLine,EXTRACT(YEAR FROM DATE_CT),DATE_CT 
                            FROM `plb_barang` 
                            WHERE STATUS_CT_GB='Complete'
                            GROUP BY EXTRACT(YEAR FROM DATE_CT) HAVING DATE_CT");
foreach ($dataLineBK as $resultdataLineBK) {
    $arrdataLineBK[] = array(
        $resultdataLineBK['BKLine']
    );
}
$JEnLineBK  = json_encode($arrdataLineBK, JSON_ERROR_NONE);
$pregLineBK = preg_replace("/[^0-9,.]/", "", $JEnLineBK);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Data Online App Name | Company </title>
<?php } else { ?>
    <title>Data Online - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-globe icon-page"></i>
                <font class="text-page">Data Online</font>
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
    <div class="row">
        <!-- LINE PERGERAKAN BARANG -->
        <div class="col-xl-12">
            <div class="widget-chart with-sidebar inverse-mode">
                <div class="widget-chart-content bg-white">
                    <h4 class="chart-title text-dark">
                        <i class="fas fa-chart-line"></i> Analisis Gate Mandiri
                        <small>Tansaksi Barang Masuk & Barang Keluar</small>
                    </h4>
                    <div id="LINEBMBK" class="widget-chart-full-width nvd3-inverse-mode" style="height: 260px;"></div>
                </div>
                <div class="widget-chart-sidebar bg-dark-darker">
                    <div class="chart-number">
                        <?= decimal($resultDataBMBK); ?>
                        <small>Total Transaksi Barang</small>
                    </div>
                    <div style="display: flex;justify-content: space-around;align-items: center;height: 220px;" class="text-white">
                        <div>
                            <div class="chart-number-oke">
                                <?= decimal($resultQBarangMasuk['total_in']); ?>
                            </div>
                            Gate In
                        </div>
                        <div>
                            <div class="chart-number-oke">
                                <?= decimal($resultQBarangKeluar['total_out']); ?>
                            </div>
                            Gate Out
                        </div>
                    </div>
                    <div class="flex-grow-1 d-flex align-items-center">
                    </div>
                    <ul class="chart-legend f-s-11">
                        <li>
                            <i class="fa fa-circle fa-fw text-blue f-s-9 m-r-5 t-minus-1"></i>
                            <?php
                            $perBM = $resultQBarangMasuk['total_in'] / $resultQBarangMasukNULL['total_in'];
                            $rperBM = $perBM * 100;
                            echo round($rperBM);
                            ?>%
                            <span>Barang Masuk</span>
                        </li>
                        <li>
                            <i class="fa fa-circle fa-fw text-teal f-s-9 m-r-5 t-minus-1"></i>
                            <?php
                            $perBK = $resultQBarangKeluar['total_out'] / $resultQBarangKeluarNULL['total_out'];
                            $rperBK = $perBK * 100;
                            echo round($rperBK);
                            ?>%
                            <span>Barang Keluar</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- DASHBOARD PLB -->
        <div class="col-sm-6">
            <div class="card border-0 bg-white text-dark text-truncate mb-3">
                <div class="card-body">
                    <div class="mb-3 text-drak">
                        <b class="mb-3">DASHBOARD DOKUMEN PABEAN PLB</b>
                        <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean PLB"></i></span>
                    </div>
                    <div id="PLBBC"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" class="widget-card rounded mb-20px" data-id="widget">
                        <div class="widget-card-cover rounded"></div>
                        <div class="widget-card-content">
                            <h6 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="fas fa-clock"></i> UPDATE DATA BC PLB TERAKHIR</b></h6>
                            <div class="line-page-terakhir"></div>
                            <div style="display: flex;justify-content: space-between;align-items: center;color: #2d353c;">
                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                    <div style="font-size: 30px;">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="font-size: 17px;font-weight: 900;">
                                            <?= $resultBCPLBTerakhir['PERUSAHAAN']; ?>
                                        </div>
                                        <div style="margin-top: -5px;font-size: 10px;">
                                            <?= $resultBCPLBTerakhir['NOMOR_IJIN_TPB']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                    <div style="font-size: 30px;">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="font-size: 17px;font-weight: 900;">
                                            <?= $resultBCPLBTerakhir['NAMA_PENERIMA_BARANG']; ?>
                                        </div>
                                        <div style="margin-top: -5px;font-size: 10px;">
                                            <?= $resultBCPLBTerakhir['NOMOR_IJIN_TPB_PENERIMA']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-card-content bottom">
                            <?php
                            $TGLTPLB = $resultBCPLBTerakhir['TGL_AJU'];
                            $TGLTPLBY = substr($TGLTPLB, 0, 4);
                            $TGLTPLBM = substr($TGLTPLB, 4, 2);
                            $TGLTPLBD =  substr($TGLTPLB, 6, 2);

                            $TGLAJUTPLB = $TGLTPLBY . '-' . $TGLTPLBM . '-' . $TGLTPLBD;
                            ?>
                            <b class="text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75">BC <?= $resultBCPLBTerakhir['KODE_DOKUMEN_PABEAN']; ?> - <?= $resultBCPLBTerakhir['JUMLAH_BARANG']; ?> Barang | <?= $resultBCPLBTerakhir['NOMOR_AJU']; ?> (<?= date_indo_s($TGLAJUTPLB, TRUE) ?>)</b>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">DOKUMEN PABEAN PLB</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean PLB"></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $resultBCPLB_show; ?>"></span> AJU</h2>
                                <div class="ml-auto">
                                    <div id="conversion-rate-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-calendar"></i> <?= date_indo(date('Y-m-d'), TRUE) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 2.3
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB23_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 2.5
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB25_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 2.6.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB261_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 2.7
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB27_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 4.0
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB40_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 4.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB41_show; ?>"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" class="widget-card rounded mb-20px" data-id="widget">
                        <div class="widget-card-cover rounded"></div>
                        <div class="widget-card-content">
                            <h6 class="fs-12px text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75"><b><i class="fas fa-clock"></i> UPDATE DATA BC GB TERAKHIR</b></h6>
                            <div class="line-page-terakhir"></div>
                            <div style="display: flex;justify-content: space-between;align-items: center;color: #2d353c;">
                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                    <div style="font-size: 30px;">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="font-size: 17px;font-weight: 900;">
                                            <?= $resultBCTPBTerakhir['NAMA_PENGUSAHA']; ?>
                                        </div>
                                        <div style="margin-top: -5px;font-size: 10px;">
                                            <?= $resultBCTPBTerakhir['NOMOR_IJIN_TPB']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                    <div style="font-size: 30px;">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="font-size: 17px;font-weight: 900;">
                                            <?= $resultBCTPBTerakhir['NAMA_PENERIMA_BARANG']; ?>
                                        </div>
                                        <div style="margin-top: -5px;font-size: 10px;">
                                            <?= $resultBCTPBTerakhir['NOMOR_IJIN_TPB_PENERIMA']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-card-content bottom">
                            <?php
                            $TGLTTPB = $resultBCTPBTerakhir['TGL_AJU'];
                            $TGLTTPBY = substr($TGLTTPB, 0, 4);
                            $TGLTTPBM = substr($TGLTTPB, 4, 2);
                            $TGLTTPBD =  substr($TGLTTPB, 6, 2);

                            $TGLAJUTTPB = $TGLTTPBY . '-' . $TGLTTPBM . '-' . $TGLTTPBD;
                            ?>
                            <b class="text-black text-opacity-75" data-id="widget-elm" data-light-class="fs-12px text-black text-opacity-75" data-dark-class="fs-12px text-white text-opacity-75">BC <?= $resultBCTPBTerakhir['KODE_DOKUMEN_PABEAN']; ?> - <?= $resultBCTPBTerakhir['JUMLAH_BARANG']; ?> Barang | <?= $resultBCTPBTerakhir['NOMOR_AJU']; ?> (<?= date_indo_s($TGLAJUTTPB, TRUE) ?>)</b>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">DOKUMEN PABEAN GB</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean GB"></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $resultBCGB_show; ?>"></span> AJU</h2>
                                <div class="ml-auto">
                                    <div id="store-session-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-calendar"></i> <?= date_indo(date('Y-m-d'), TRUE) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 2.3
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB23_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 2.5
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB25_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 2.6.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB261_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 2.7
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB27_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 4.0
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB40_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 4.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB41_show; ?>"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- DASHBOARD TPB -->
        <div class="col-sm-6">
            <div class="card border-0 bg-white text-white text-truncate mb-3">
                <div class="card-body">
                    <div class="mb-3 text-dark">
                        <b class="mb-3">DASHBOARD DOKUMEN PABEAN TPB</b>
                        <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean PLB"></i></span>
                    </div>
                    <div id="TPBBC"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>

<!-- <script src="assets/js/demo/dashboard-v2.js"></script> -->
<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/modules/exporting.js"></script>
<script src="assets/highcharts/modules/variable-pie.js"></script>
<script src="assets/highcharts/modules/export-data.js"></script>
<script src="assets/highcharts/modules/accessibility.js"></script>
<script type="text/javascript">
    // LINE BARANG MASUK - BARANG KELUAR
    Highcharts.chart('LINEBMBK', {
        title: {
            text: 'Tansaksi Barang Masuk & Barang Keluar Per Tahun'
        },

        yAxis: {
            title: {
                text: 'Jumlah Barang'
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 2022 to 2022'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: <?= $resultthnBMAwal['THN_BM_AWAL'] ?>
            }
        },

        series: [{
            name: "Barang Masuk",
            color: "#1a2229",
            marker: {
                symbol: "circle"
            },
            data: [<?= $pregLineBM ?>],
        }, {
            name: "Barang Keluar",
            color: "#00acac",
            marker: {
                symbol: "circle"
            },
            data: [<?= $pregLineBK ?>],
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

    // PLB
    Highcharts.chart('PLBBC', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Dashboard BC Pusat Logistik Berikat'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f} Data</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [{
                name: 'BC 2.7',
                y: <?= $resultBCPLB27_show ?>,
                sliced: true,
                color: "#00acac",
                selected: true,
            }, {
                name: '2.3',
                y: <?= $resultBCPLB23_show ?>
            }, {
                name: 'BC 2.5',
                y: <?= $resultBCPLB25_show ?>
            }, {
                name: 'BC 2.6.1',
                y: <?= $resultBCPLB261_show ?>
            }, {
                name: 'BC 4.0',
                y: <?= $resultBCPLB40_show ?>
            }, {
                name: 'BC 4.1',
                y: <?= $resultBCPLB41_show ?>
            }]
        }]
    });

    // TPB
    Highcharts.chart('TPBBC', {
        chart: {
            // backgroundColor: '#2d353c',
            textColor: '#ddd',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Dashboard BC Gudang Berikat'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f} Data</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [{
                name: 'BC 2.7',
                y: <?= $resultBCGB27_show ?>,
                sliced: true,
                color: "#00acac",
                selected: true
            }, {
                name: '2.3',
                y: <?= $resultBCGB23_show ?>
            }, {
                name: 'BC 2.5',
                y: <?= $resultBCGB25_show ?>
            }, {
                name: 'BC 2.6.1',
                y: <?= $resultBCGB261_show ?>
            }, {
                name: 'BC 4.0',
                y: <?= $resultBCGB40_show ?>
            }, {
                name: 'BC 4.1',
                y: <?= $resultBCGB41_show ?>
            }]
        }]
    });
    // HP Awal
    function Page_totalHP_awal() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_totalHP_awal").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/viewdataonline.php?function=totalHP_awal", true);
        xhttp.send();
    }
    setInterval(function() {
        Page_totalHP_awal();
    }, 1000);
    window.onload = Page_totalHP_awal;

    // HP Akhir
    function Page_totalHP_akhir() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_totalHP_akhir").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/viewdataonline.php?function=totalHP_akhir", true);
        xhttp.send();
    }
    setInterval(function() {
        Page_totalHP_akhir();
    }, 1000);
    window.onload = Page_totalHP_akhir;
</script>