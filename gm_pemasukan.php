<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";

$AJU_PLB = '';

if (isset($_POST['filter'])) {
    if ($_POST["AJU_PLB"] != '') {
        $AJU_PLB   = $_POST['AJU_PLB'];
    }
}

// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?AJU_PLB=' . $AJU_PLB);
$data = json_decode($content, true);
?>
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
                <li class="breadcrumb-item"><a href="javascript:;">Gate</a></li>
                <li class="breadcrumb-item active">Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Search AJU PLB -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">

                        <div class="row">
                            <div class="col-sm-3">
                                <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label>Nomor Pengajuan PLB</label>
                                            <input type="number" name="AJU_PLB" class="form-control" value="<?= $AJU_PLB; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-filter"></i>
                                            Filter Tanggal</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search AJU PLB -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Content] Coming Soon</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <center>
                        <img class="picture-w-550" src="assets/images/coming-soon/01.jpg" alt="coming-soon">
                    </center>
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