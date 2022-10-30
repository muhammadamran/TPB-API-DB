<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

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
$contentNA_LITER        = $dbcon->query("SELECT  SUM(TOTAL_BOTOL * LITER) AS p_LITER FROM plb_barang_ct WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID_BARANG='" . $_GET['ID'] . "' AND STATUS_CT IS NULL GROUP BY ID ORDER BY ID LIMIT 1", 0);
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
                <a href="gm_pemasukan_detail.php?AJU=<?= $_GET['AJU'] ?>" class="btn btn-yellow"><i class="fas fa-caret-square-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- END BACK -->

    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data Barang Masuk: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></h4>
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
                                                    <button class="btn btn-sm btn-warning" data-toggle="popover" data-trigger="hover" data-title="Jumlah Botol: <?= $row['TOTAL_BOTOL'] ?>" data-placement="top" data-content="Anda tidak dapat melakukan aksi pada status botol!"><i class="fas fa-warning"></i></button>
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
                                                                            <a href="javascript:;" class="btn btn-sm btn-default">Anda yakin ingin mengubah status CT?</a>
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
                                                                        <a href="javascript:;" class="btn btn-sm btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
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
                                                                        <a href="javascript:;" class="btn btn-sm btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
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
                                                                        <a href="javascript:;" class="btn btn-sm btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
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
                                                                        <a href="javascript:;" class="btn btn-sm btn-default">Jumlah Botol Saat Ini: <?= $row['TOTAL_BOTOL']; ?> Botol</a>
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
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
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