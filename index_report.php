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
<style type="text/css">
.class-report {
    display: flex;
    /* justify-content: space-between; */
    justify-content: center;
    align-items: center;
}

.for-class-report {
    width: 40%;
    padding: 10px;
}

@media (max-width: 862.5px) {
    .class-report {
        display: grid;
        justify-content: normal;
        align-items: center;
    }

    .for-class-report {
        width: 100%;
        padding: 0px;
    }
}
</style>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-clipboard icon-page"></i>
                <font class="text-page">Report</font>
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

    <div class="class-report">
        <!-- begin col-3 -->
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_masuk_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-circle-down"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Masuk Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_masuk_barang.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_keluar_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-circle-up"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Keluar Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_keluar_barang.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_mutasi_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-building-circle-exclamation"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Mutasi Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_mutasi_barang.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="class-report">
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_posisi_barang']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-map-location"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Posisi Barang</p>
                </div>
                <div class="stats-link">
                    <a href="report_posisi_barang.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_realisasi']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Realisasi</p>
                </div>
                <div class="stats-link">
                    <a href="report_realisasi.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_data_tpb']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-building-flag"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Data TPB</p>
                </div>
                <div class="stats-link">
                    <a href="report_data_tpb.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="class-report">
        <div class="for-class-report" style="display: <?= $resultRoleModules['re_ck_plb']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-arrow-right-to-city"></i></div>
                <div class="stats-info">
                    <h4>PLB Report </h4>
                    <p>CK5</p>
                </div>
                <div class="stats-link">
                    <a href="report_ck5_plb.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_ck_sarinah']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-school-lock"></i></div>
                <div class="stats-info">
                    <h4>GB - Sarinah Report </h4>
                    <p>CK5</p>
                </div>
                <div class="stats-link">
                    <a href="report_ck5_sarinah.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="for-class-report" style="display: <?= $resultRoleModules['re_log']; ?>">
            <div class="widget widget-stats bg-grey">
                <div class="stats-icon"><i class="fa-solid fa-clipboard-question"></i></div>
                <div class="stats-info">
                    <h4>Laporan </h4>
                    <p>Log System</p>
                </div>
                <div class="stats-link">
                    <a href="report_log_system.php">View Report <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>