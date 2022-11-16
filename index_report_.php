<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan App Name | Company </title>
<?php } else { ?>
    <title>Laporan - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-file-invoice icon-page"></i>
                <font class="text-page">Laporan</font>
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

    <!-- <div class="row" style="padding: 10px;">
        <div class="col-xl-12">
            <div style="display: flex;justify-content: space-between;align-items:center;">
                <div style="font-size: 22px;font-weight: 900;margin-bottom: 5px;text-shadow: 0px 1px 0px #0000006e;">
                    <font>Gate Mandiri</font> <small>Monitoring</small>
                </div>
                <div>
                    <a class="btn btn-sm btn-RD"><i class="fas fa-chart-line"></i> Lihat Dahsboard ...</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card border-0 bg-dark text-white mb-3 overflow-hidden" id="RD">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="mb-3 text-grey">
                                <b>Barang Masuk <small>Antrian PLB</small></b>
                                <span class="ml-2">
                                    <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Barang Masuk" data-placement="top" data-content="Gate Mandiri - Monitoring Data Barang Masuk, In Warehouse dan Barang Keluar"></i>
                                </span>
                            </div>
                            <div class="d-flex mb-1">
                                <h2 class="mb-0">Rp.<span data-animation="number" data-value="64559.25">0.00</span></h2>
                                <div class="ml-auto mt-n1 mb-n1">
                                    <div id="total-sales-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-3 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="33.21">0.00</span>% Persen
                            </div>
                            <hr class="bg-white-transparent-2" />
                            <div class="row text-truncate">
                                <div class="col-4">
                                    <div class="f-s-12 text-grey">Barang Masuk</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="f-s-12 text-grey">In Warehouse</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="41.20">0.00</span></div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="f-s-12 text-grey">Barang Keluar</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="41.20">0.00</span></div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                            <img src="../assets/img/svg/barcode-animate.svg" height="150px" class="d-none d-lg-block" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3" id="RD">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">Gate In</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Conversion Rate" data-placement="top" data-content="Percentage of sessions that resulted in orders from total number of sessions." data-original-title="" title=""></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="2.19">0.00</span>%</h2>
                                <div class="ml-auto">
                                    <div id="conversion-rate-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-down"></i> <span data-animation="number" data-value="0.50">0.00</span>% Persen
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    Kurang
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.79">0.00</span>%</div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    Lebih
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.85">0.00</span>%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                    Pecah
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="57">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="2.19">0.00</span>%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-yellow f-s-8 mr-2"></i>
                                    Rusak
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="57">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="2.19">0.00</span>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3" id="RD">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">Gate Out</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Store Sessions" data-placement="top" data-content="Number of sessions on your online store. A session is a period of continuous activity from a visitor." data-original-title="" title=""></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="70719">0</span></h2>
                                <div class="ml-auto">
                                    <div id="store-session-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="9.5">0.00</span>% Persen
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    Kurang
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="25.7">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="53210">0</span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    Lebih
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="16.0">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="11959">0</span></div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
                                    Pecah
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="7.9">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="5545">0</span></div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
                                    Rusak
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="7.9">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="5545">0</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="class-report">
        <!-- begin col-3 -->
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_masuk_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-circle-down"></i></div>
                <div class="stats-info">
                    <h4>Laporan Gate In</h4>
                    <p>Masuk Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_masuk_barang.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_keluar_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-circle-up"></i></div>
                <div class="stats-info">
                    <h4>Laporan Gate Out</h4>
                    <p>Keluar Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_keluar_barang.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_mutasi_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-building-circle-exclamation"></i></div>
                <div class="stats-info">
                    <h4>Laporan</h4>
                    <p>Mutasi Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_mutasi_barang.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="class-report">
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_posisi_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-map-location"></i></div>
                <div class="stats-info">
                    <h4>Laporan</h4>
                    <p>Posisi Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_posisi_barang.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_realisasi']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                <div class="stats-info">
                    <h4>Laporan Realisasi Kuota Mitra</h4>
                    <p>Realisasi</p>
                </div>
                <div class="stats-link">
                    <a href="report_realisasi.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_data_tpb']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-building-flag"></i></div>
                <div class="stats-info">
                    <h4>Laporan Tempat Penimbunan Berikat (TPB)</h4>
                    <p>Data TPB</p>
                </div>
                <div class="stats-link">
                    <a href="report_data_tpb.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="class-report">
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_ck_plb']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-arrow-right-to-city"></i></div>
                <div class="stats-info">
                    <h4>Laporan Pusat Logistik Berikat</h4>
                    <p>CK5</p>
                </div>
                <div class="stats-link">
                    <a href="report_ck5_plb.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_ck_sarinah']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-school-lock"></i></div>
                <div class="stats-info">
                    <h4>Laporan Gudang Berikat <?= $resultSetting['company']; ?></h4>
                    <p>CK5 - Packing List - Invoice</p>
                </div>
                <div class="stats-link">
                    <a href="report_ck5_sarinah.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_log']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-clipboard-question"></i></div>
                <div class="stats-info">
                    <h4>Laporan Riwayat Aktifitas</h4>
                    <p>Log System</p>
                </div>
                <div class="stats-link">
                    <a href="report_log_system.php">Lihat Laporan <i class="fa fa-arrow-alt-circle-right"></i></a>
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