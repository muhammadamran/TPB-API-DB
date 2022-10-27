<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
$DATAAJU = $_GET['AJU'];
// Form Sesuai
if (isset($_POST["FSesuai"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangSesuai&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// All Sesuai
if (isset($_POST["All_sesuai"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangSesuaiAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Kurang
if (isset($_POST["FKurang"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangKurang&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Kurang
if (isset($_POST["All_kurang"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangKurangAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Lebih
if (isset($_POST["FLebih"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangLebih&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Lebih
if (isset($_POST["All_lebih"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangLebihAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Pecah
if (isset($_POST["FPecah"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangPecah&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Pecah
if (isset($_POST["All_pecah"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangPecahAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Rusak
if (isset($_POST["FRusak"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangRusak&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Rusak
if (isset($_POST["All_rusak"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangRusakAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST["ct_submit"])) {

    $contentBarang = $dbcon->query("SELECT * FROM plb_barang WHERE ID='" . $_POST['ID_BARANG'] . "'");
    $dataBarang    = mysqli_fetch_array($contentBarang);
    $jml_pcs = $dataBarang['JUMLAH_SATUAN'];
    $pcs = str_replace(".0000", "", "$jml_pcs");

    // TOTAL BOTOL
    $botol = explode('X', $dataBarang['UKURAN']);
    $t_botol = $botol[0];
    // TOTAL LITER
    $liter =  $botol[1];
    $t_liter = str_replace('Ltr', '', $liter);


    for ($i = 0; $i < $pcs; $i++) {
        $sql = $dbcon->query("INSERT INTO plb_barang_ct 
                            (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,TOTAL_LITER)
                            VALUES
                            ('','$dataBarang[NOMOR_AJU]','$dataBarang[ID]','$dataBarang[KODE_BARANG]','$t_botol','$t_liter')
                            ");
    }

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?AJU=$dataBarang[NOMOR_AJU]&ID=$dataBarang[ID]&LOOP=$pcs';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?InputIconFailed=true';</script>";
    }
}

// TOTAL BARANG
$contentBarangTotal = $dbcon->query("SELECT COUNT(*) AS total FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangTotal    = mysqli_fetch_array($contentBarangTotal);
// CEK BARANG
$contentBarangCek   = $dbcon->query("SELECT COUNT(*) AS total_cek FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangCek      = mysqli_fetch_array($contentBarangCek);
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
                <li class="breadcrumb-item"><a href="javascript:;">Barang Masuk</a></li>
                <li class="breadcrumb-item active">Detail Nomor AJU: <?= $_GET['AJU'] ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Detail] Pengecekan Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">

                    <!-- Menu -->
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link active">
                                <span class="d-sm-none">Barang Masuk</span>
                                <span class="d-sm-block d-none">
                                    Total Barang Masuk:
                                    <?= $dataBarangTotal['total']; ?>
                                    Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link">
                                <?php if ($dataBarangCek['total_cek'] == NULL) { ?>
                                    <span class="d-sm-none">Proses Barang Masuk</span>
                                    <span class="d-sm-block d-none">
                                        <font class="blink_me" style="color: green;">
                                            Proses Pengecekan Barang:
                                            <?= $rowBarangCek['total_cek']; ?>
                                            Barang DiCek!
                                        </font>
                                    </span>
                                <?php } else { ?>
                                    <span class="d-sm-none">Proses Barang Masuk</span>
                                    <span class="d-sm-block d-none">
                                        <font class="blink_me" style="color: red;">Proses pengecekan Proses Barang Masuk!</font>
                                    </span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                    <!-- Menu -->

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
                                    <!-- Sesuai ALl -->
                                    <input type="hidden" name="AJU" value="<?= $DATAAJU; ?>">
                                    <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                    <?php
                                    $checking = $dbcon->query("SELECT brg.NOMOR_AJU,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING='Done') AS checking,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS barang
                                                            FROM plb_barang AS brg  WHERE brg.NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY brg.NOMOR_AJU");
                                    $resultChecking = mysqli_fetch_array($checking);
                                    ?>
                                    <?php if ($resultChecking['checking'] == $resultChecking['barang']) { ?>
                                        <button type="submit" id="btn-sesuai" name="All_sesuai" class="btn btn-sm btn-custom btn-success" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Masuk!">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Simpan Barang Masuk
                                        </button>
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-sm-12" style="display: flex;">
                                                <button type="button" id="btn-tidak" name="All_tidak" class="btn btn-sm btn-custom btn-danger" data-toggle="popover" data-trigger="hover" data-title="Selesaikan Pengecekan Barang" data-placement="top" data-content="Klik untuk selesaikan Barang Masuk!">
                                                    <i class="fa-solid fa-hourglass-start"></i>
                                                    Cek Satuan Botol
                                                </button>
                                                <div id="buttonPilihAll" style="display:none;margin-left: 10px;">
                                                    <button type="submit" id="btn-sesuai" name="All_sesuai" class="btn btn-sm btn-custom btn-success" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Masuk!">
                                                        <i class="fa-solid fa-check-circle"></i>
                                                        Simpan Barang Masuk
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="margin-left: 20px;margin-top: 10px;display: flex;">
                                                <input type="checkbox" onclick="MyCekBotolLewat()" class="form-check-input" id="CekBotolLewat" name="CekBotolLewat">
                                                <p align="justify" style="margin-left: 5px;" class="form-check-label" id="CekBotolLewat">Klik untuk melewati proses pengecekan Botol.</p>
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
                                                        <button type="button" class="btn btn-sm btn-info" id="chk_new" onclick="checkAll('chk');" style="font-size: 10px;">
                                                            <i class="fa-solid fa-square-check"></i>
                                                            Pilih Semua Sesuai
                                                        </button>
                                                    </div>
                                                </th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">
                                                    <div style="display: flex;justify-content: space-evenly;align-content: center;width: 130px;">
                                                        Cek Barang Masuk
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
                                            if (mysqli_num_rows($dataTable) > 0) {
                                                $noBarang = 0;
                                                while ($rowBarang = mysqli_fetch_array($dataTable)) {
                                                    $jml_pcs = $rowBarang['JUMLAH_SATUAN'];
                                                    $pcs = str_replace(".0000", "", "$jml_pcs");
                                                    $noBarang++;
                                                    // TOTAL BOTOL
                                                    $t_botol = explode('X', $rowBarang['UKURAN']);
                                                    // TOTAL LITER
                                                    $t_liter = str_replace('Ltr', '', $t_botol[1]);
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $noBarang ?>. </td>
                                                        <td style="text-align: center;">
                                                            <div style="margin-left: 25px;margin-bottom: 15px;margin-top: 15px;">
                                                                <input type="checkbox" class="form-check-input" id="chk" name="CekBarang[<?= $noBarang - 1; ?>][ID]" value="<?= $row['ID'] ?>">
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <!-- <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][OPERATOR_ONE]" value="<?= $_SESSION['username']; ?>"> -->
                                                            <!-- <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][TGL_CEK]" value="<?= date('Y-m-d H:m:i') ?>"> -->
                                                            <!-- Kurang -->
                                                            <!-- <a href="#Kurang<?= $rowBarang['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-danger"><i class="fa-solid fa-minus"></i> Kurang</a> -->
                                                            <!-- Lebih -->
                                                            <!-- <a href="#Lebih<?= $rowBarang['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Lebih</a> -->
                                                            <!-- Pecah -->
                                                            <!-- <a href="#Pecah<?= $rowBarang['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pecah</a> -->
                                                            <!-- Rusak -->
                                                            <!-- <a href="#Rusak<?= $rowBarang['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</a> -->
                                                            <?php if ($rowBarang['KODE_BARANG'] != NULL) { ?>
                                                                <?php if ($pcs == 0) { ?>
                                                                    <!-- No QTY -->
                                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-danger">
                                                                        <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                        <br>
                                                                        Cek <?= $pcs ?> CT
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <!-- Check -->
                                                                    <!-- <a href="gm_pemasukan_ct.php?AJU=<?= $rowBarang['NOMOR_AJU'] ?>&ID=<?= $rowBarang['ID'] ?>&LOOP=<?= $pcs ?>" class="btn btn-sm btn-custom btn-warning" target="_blank">
                                                                        <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                        <br>
                                                                        Cek <?= $pcs ?> CT
                                                                    </a> -->
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="ID_BARANG" value="<?= $rowBarang['ID'] ?>">
                                                                        <button type="submit" name="ct_submit" class="btn btn-sm btn-custom btn-warning">
                                                                            <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                            <br>
                                                                            Cek <?= $pcs ?> CT
                                                                        </button>
                                                                    </form>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <!-- Disabled -->
                                                                <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-secondary">
                                                                    <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                    <br>
                                                                    Cek <?= $pcs ?> CT
                                                                </a>
                                                            <?php } ?>
                                                            <div style="margin-top: 5px;font-size: 9px;margin-left: -145px;">
                                                                <?php if ($rowBarang['STATUS'] != NULL) { ?>
                                                                    <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <div style="display: grid;font-size: 10px;width: 115px;">
                                                                <?php if ($rowBarang['STATUS'] == NULL) { ?>
                                                                    <font><i class="fa-solid fa-user-pen"></i>: Petugas</font>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: Status</font>
                                                                <?php } else { ?>
                                                                    <font><i class="fa-solid fa-user-pen"></i>: <?= $rowBarang['OPERATOR_ONE']; ?></font>
                                                                    <?php if ($rowBarang['STATUS'] == 'Sesuai') { ?>
                                                                        <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-success"><?= $rowBarang['STATUS']; ?></span></font>
                                                                    <?php } else if ($rowBarang['STATUS'] == 'Kurang') { ?>
                                                                        <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-danger"><?= $rowBarang['STATUS']; ?></span></font>
                                                                    <?php } else if ($rowBarang['STATUS'] == 'Lebih') { ?>
                                                                        <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-lime"><?= $rowBarang['STATUS']; ?></span></font>
                                                                    <?php } else if ($rowBarang['STATUS'] == 'Pecah') { ?>
                                                                        <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-dark"><?= $rowBarang['STATUS']; ?></span></font>
                                                                    <?php } else if ($rowBarang['STATUS'] == 'Rusak') { ?>
                                                                        <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-warning"><?= $rowBarang['STATUS']; ?></span></font>
                                                                    <?php } ?>
                                                                <?php } ?>
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
                                                    <!-- Kurang -->
                                                    <div class="modal fade" id="Kurang<?= $rowBarang['ID'] ?>">
                                                        <div class="modal-dialog sm">
                                                            <div class="modal-content">
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">[Kurang] Barang Masuk</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <fieldset>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                                        <div style="font-size: 40px;">
                                                                                            <i class="fas fa-info"></i>
                                                                                        </div>
                                                                                        <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                            <font>Pengecekan Kode Barang: <?= $rowBarang['KODE_BARANG'] ?></font>
                                                                                            <br>
                                                                                            <font>Jumlah Satuan: <?= $pcs ?> <?= $rowBarang['KODE_SATUAN'] ?></font>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="line-page-cek"></div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Kurang</label>
                                                                                        <?php if ($rowBarang['KURANG'] == NULL) { ?>
                                                                                            <input type="number" name="Kurang" class="form-control" placeholder="Kurang ..." value="0" required>
                                                                                        <?php } else { ?>
                                                                                            <input type="number" name="Kurang" class="form-control" placeholder="Kurang ..." value="<?= $rowBarang['KURANG'] ?>" required>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <div style="margin-top: 26px;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                                    <div class="modal fade" id="Lebih<?= $rowBarang['ID'] ?>">
                                                        <div class="modal-dialog sm">
                                                            <div class="modal-content">
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">[Lebih] Barang Masuk</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <fieldset>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                                        <div style="font-size: 40px;">
                                                                                            <i class="fas fa-info"></i>
                                                                                        </div>
                                                                                        <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                            <font>Pengecekan Kode Barang: <?= $rowBarang['KODE_BARANG'] ?></font>
                                                                                            <br>
                                                                                            <font>Jumlah Satuan: <?= $pcs ?> <?= $rowBarang['KODE_SATUAN'] ?></font>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="line-page-cek"></div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Lebih</label>
                                                                                        <?php if ($rowBarang['LEBIH'] == NULL) { ?>
                                                                                            <input type="number" name="Lebih" class="form-control" placeholder="Lebih ..." value="0" required>
                                                                                        <?php } else { ?>
                                                                                            <input type="number" name="Lebih" class="form-control" placeholder="Lebih ..." value="<?= $rowBarang['LEBIH'] ?>" required>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
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
                                                    <div class="modal fade" id="Pecah<?= $rowBarang['ID'] ?>">
                                                        <div class="modal-dialog sm">
                                                            <div class="modal-content">
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">[Pecah] Barang Masuk</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <fieldset>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                                        <div style="font-size: 40px;">
                                                                                            <i class="fas fa-info"></i>
                                                                                        </div>
                                                                                        <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                            <font>Pengecekan Kode Barang: <?= $rowBarang['KODE_BARANG'] ?></font>
                                                                                            <br>
                                                                                            <font>Jumlah Satuan: <?= $pcs ?> <?= $rowBarang['KODE_SATUAN'] ?></font>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="line-page-cek"></div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Pecah</label>
                                                                                        <?php if ($rowBarang['PECAH'] == NULL) { ?>
                                                                                            <input type="number" name="Pecah" class="form-control" placeholder="Pecah ..." value="0" required>
                                                                                        <?php } else { ?>
                                                                                            <input type="number" name="Pecah" class="form-control" placeholder="Pecah ..." value="<?= $rowBarang['PECAH'] ?>" required>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
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
                                                    <div class="modal fade" id="Rusak<?= $rowBarang['ID'] ?>">
                                                        <div class="modal-dialog sm">
                                                            <div class="modal-content">
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">[Rusak] Barang Masuk</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <fieldset>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                                        <div style="font-size: 40px;">
                                                                                            <i class="fas fa-info"></i>
                                                                                        </div>
                                                                                        <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                            <font>Pengecekan Kode Barang: <?= $rowBarang['KODE_BARANG'] ?></font>
                                                                                            <br>
                                                                                            <font>Jumlah Satuan: <?= $pcs ?> <?= $rowBarang['KODE_SATUAN'] ?></font>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="line-page-cek"></div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Rusak</label>
                                                                                        <?php if ($rowBarang['RUSAK'] == NULL) { ?>
                                                                                            <input type="number" name="Rusak" class="form-control" placeholder="Rusak ..." value="0" required>
                                                                                        <?php } else { ?>
                                                                                            <input type="number" name="Rusak" class="form-control" placeholder="Rusak ..." value="<?= $rowBarang['RUSAK'] ?>" required>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
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
                                                    <td colspan="51">
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

    // SESUAI
    $("#btn-sesuai").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=sesuai`)
        var confirm = window.confirm("Klik OK jika Barang Masuk sudah Sesuai!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // KURANG
    $("#btn-kurang").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=kurang`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Kurang!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // LEBIH
    $("#btn-lebih").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=lebih`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Lebih!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // PECAH
    $("#btn-pecah").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=pecah`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Pecah!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // RUSAK
    $("#btn-rusak").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=rusak`)
        // console.log($("#form-submit").attr('action'))
        // return;
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
        history.replaceState({}, '', './gm_pemasukan_detail.php?AJU=<?= $DATAAJU ?>');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pemasukan_detail.php');
    }

    function MyCekBotolLewat() {
        var checkBox = document.getElementById("CekBotolLewat");
        var VarAll = document.getElementById("buttonPilihAll");
        if (checkBox.checked == true) {
            VarAll.style.display = "block";
        } else {
            VarAll.style.display = "none";
        }
    }
</script>