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
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
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
                    <div class="row">
                        <!-- LAPORAN BARANG MASUK -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_masuk_barang']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-circle-down"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_masuk_barang.php">Laporan Barang Masuk</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan <b>Data Gate In</b> setelah proses pengecekan barang dilakukan dan melengkapi <b>Nomor Pengajuan Gudang Berikat (GB)</b>, <b>Tanggal Gate In</b> pada <b>Nomor Pengajuan PLB</b>.</p>
                                        <div>
                                            <a href="report_masuk_barang.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN BARANG KELUAR -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_keluar_barang']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-circle-up"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_keluar_barang.php">Laporan Barang Keluar</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan <b>Data Gate Out</b> setelah proses pengecekan barang dilakukan dan melengkapi <b>Tanggal Gate Out</b> pada <b>Nomor Pengajuan GB</b>.</p>
                                        <div>
                                            <a href="report_keluar_barang.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN POSISI -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_posisi_barang']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-map-location"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_posisi_barang.php">Laporan Posisi Barang</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan Data Barang berdasarkan <b>Gate In</b> dan <b>Gate Out</b>. pada <b><?= $resultSetting['app_name'] ?></b>.</p>
                                        <div>
                                            <a href="report_posisi_barang.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN MUTASI -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_mutasi_barang']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-building-circle-exclamation"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_mutasi_barang.php">Laporan Mutasi Barang</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan pencatatan aktifitas barang berdasarkan <b>Data Gate In</b> dan <b>Data Gate Out</b>. Pencatatan aktivitas barang pada <b><?= $resultSetting['app_name'] ?></b> sesuai dengan aktivitas aktualnya.</p>
                                        <div>
                                            <a href="report_mutasi_barang.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN REALISASI -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_realisasi']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-check-to-slot"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_realisasi.php">Laporan Realisasi Barang</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan data monitoring <b>Kuota Mitra</b> berdasarkan Capaian <b>Realisasi Mitra</b> yang telah digunakan.</p>
                                        <div>
                                            <a href="report_realisasi.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN DATA TPB -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_data_tpb']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-building-flag"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_data_tpb.php">Laporan Data TPB</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan detil <b>Data Pusat Logistik Berikat (PLB)</b> dan <b>Data Gudang Berikat (GB)</b> pada <b><?= $resultSetting['app_name'] ?></b>.</p>
                                        <div>
                                            <a href="report_data_tpb.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN DATA PLB -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_data_plb']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-arrow-right-to-city"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_data_plb.php">Laporan Data PLB</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan <b>Dokumen CK5 Pusat Logistik Berikat</b>, <b>Packing List</b> dan <b>Inovice</b> barang <b><?= $resultSetting['app_name'] ?></b>.</p>
                                        <div>
                                            <a href="report_data_plb.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN DATA GB -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_ck_sarinah']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-school-lock"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_data_gb.php">Laporan Data GB</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan <b>Dokumen CK5 Gudang Berikat</b>, <b>Packing List</b> dan <b>Inovice</b> barang <b><?= $resultSetting['app_name'] ?></b>.</p>
                                        <div>
                                            <a href="report_data_gb.php" class="btn btn-default-index">Lihat Laporan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LAPORAN AKTIFITAS -->
                        <div class="col-sm-6" style="display: <?= $resultRoleModules['re_log']; ?>">
                            <div class="lap">
                                <!-- ICON -->
                                <div class="lap-icon-isi">
                                    <i style="margin: 0px;" class="fa-solid fa-clipboard-question"></i>
                                </div>
                                <!-- TITLE & DESC -->
                                <div class="lap-t-d">
                                    <!-- TITLE -->
                                    <div>
                                        <h4><a href="report_log_system.php">Laporan Aktifitas (Log System)</a></h4>
                                    </div>
                                    <!-- DESC -->
                                    <div>
                                        <p>Menampilkan Riwayat Aktifitas <b><?= $resultSetting['app_name'] ?></b> berdasarkan Pengguna.</p>
                                        <div>
                                            <a href="report_log_system.php" class="btn btn-default-index">Lihat Laporan</a>
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