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
    <!-- Begin Row -->
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
                        <div class="icon"><i class="fa-solid fa-file-invoice"></i></div>
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
    <br>
    <!-- End Begin Row -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-th-large"></i> [Laporan] Menu Navigation</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <!-- begin alert -->
                <div class="alert alert-secondary fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Lihat detil <b>Laporan</b> pada <b><?= $resultSetting['app_name'] ?></b>, silahkan klik pada setiap button laporan yang tersedia.</p>
                </div>
                <!-- end alert -->
                <div class="panel-body text-inverse">
                    sss
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
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