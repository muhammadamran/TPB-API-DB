<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// Submit CT
if (isset($_POST["ct_submit"])) {
    $keyy = $_POST['CekBarangBotol'];
    var_dump($keyy);
    exit;
    // CEK CT
    $cekCT = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='$keyy'");
    $dataCT    = mysqli_fetch_array($cekCT);

    if ($dataCT['ID_BARANG'] == NULL) {
        $contentBarang = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$keyy'");
        $dataBarang    = mysqli_fetch_array($contentBarang);
        $jml_pcs = $dataBarang['JUMLAH_SATUAN'];
        $pcs = str_replace(".0000", "", "$jml_pcs");

        // TOTAL BOTOL
        $botol = explode('X', $dataBarang['UKURAN']);
        $t_botol = $botol[0];
        // TOTAL LITER
        $liter =  $botol[1];
        $r_liter = str_replace('Ltr', '', $liter);
        $t_liter = str_replace(',', '.', $r_liter);

        for ($i = 0; $i < $pcs; $i++) {
            $sql = $dbcon->query("INSERT INTO plb_barang_ct 
                            (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,TOTAL_LITER)
                            VALUES
                            ('','$dataBarang[NOMOR_AJU]','$keyy','$dataBarang[KODE_BARANG]','$t_botol','$t_liter')
                            ");
        }

        $sql .= $dbcon->query("UPDATE plb_barang SET CHECKING='Checking Botol'
                                WHERE ID='$keyy'");

        if ($sql) {
            echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$keyy';'_blank'</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_ct.php?InputIconFailed=true';</script>";
        }
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$keyy';'_blank'</script>";
    }
}

// KURANG
if (isset($_POST["kurang_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU             = $_POST['NOMOR_AJU'];
    $ID_BARANG             = $_POST['ID_BARANG'];
    $KODE_BARANG             = $_POST['KODE_BARANG'];
    $Kurang             = $_POST['Kurang'];
    $TOTAL_BOTOL             = $_POST['TOTAL_BOTOL'];

    $cek = $TOTAL_BOTOL - $Kurang;

    $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek'
                            WHERE ID='$ID_CT'");

    $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,KURANG)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Kurang')");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=?ID=$ID_BARANG&DeleteFailed=true';</script>";
    }
}

// LEBIH
if (isset($_POST["lebih_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU             = $_POST['NOMOR_AJU'];
    $ID_BARANG             = $_POST['ID_BARANG'];
    $KODE_BARANG             = $_POST['KODE_BARANG'];
    $Lebih             = $_POST['Lebih'];
    $TOTAL_BOTOL             = $_POST['TOTAL_BOTOL'];

    $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$TOTAL_BOTOL'
                            WHERE ID='$ID_CT'");

    $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,LEBIH)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Lebih')");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=?ID=$ID_BARANG&DeleteFailed=true';</script>";
    }
}

// PECAH
if (isset($_POST["pecah_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU             = $_POST['NOMOR_AJU'];
    $ID_BARANG             = $_POST['ID_BARANG'];
    $KODE_BARANG             = $_POST['KODE_BARANG'];
    $Pecah             = $_POST['Pecah'];
    $TOTAL_BOTOL             = $_POST['TOTAL_BOTOL'];

    $cek = $TOTAL_BOTOL - $Pecah;

    $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek'
                            WHERE ID='$ID_CT'");

    $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,PECAH)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Pecah')");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=?ID=$ID_BARANG&DeleteFailed=true';</script>";
    }
}

// RUSAK
if (isset($_POST["rusak_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU             = $_POST['NOMOR_AJU'];
    $ID_BARANG             = $_POST['ID_BARANG'];
    $KODE_BARANG             = $_POST['KODE_BARANG'];
    $Rusak             = $_POST['Rusak'];
    $TOTAL_BOTOL             = $_POST['TOTAL_BOTOL'];

    $cek = $TOTAL_BOTOL - $Rusak;

    $query = $dbcon->query("UPDATE plb_barang_ct SET TOTAL_BOTOL='$cek'
                            WHERE ID='$ID_CT'");

    $query .= $dbcon->query("INSERT INTO plb_barang_ct_botol
    (ID,ID_CT,NOMOR_AJU,ID_BARANG,KODE_BARANG,RUSAK)
    VALUES
    ('','$ID_CT','$NOMOR_AJU','$ID_BARANG','$KODE_BARANG','$Rusak')");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=?ID=$ID_BARANG&DeleteFailed=true';</script>";
    }
}


if (isset($_POST["simpan"])) {

    $ID             = $_POST['ID'];
    $NOMOR_AJU      = $_POST['NOMOR_AJU'];


    $query = $dbcon->query("UPDATE plb_barang SET CHECKING='Botol'
                            WHERE ID='$ID'");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$NOMOR_AJU';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=?ID=$NOMOR_AJU&DeleteFailed=true';</script>";
    }
}

if (isset($_POST["Delete_"])) {

    $ID_CT             = $_POST['ID_CT'];
    $NOMOR_AJU         = $_POST['NOMOR_AJU'];
    $ID_BARANG         = $_POST['ID_BARANG'];
    $KODE_BARANG       = $_POST['KODE_BARANG'];

    $query = $dbcon->query("DELETE FROM plb_barang_ct WHERE ID='$ID_BARANG'");

    if ($query) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?DeleteFailed=true';</script>";
    }
}

// Find
if (isset($_POST['filter'])) {
    if ($_POST["AJU_PLB"] != '') {
        $AJU_PLB   = $_POST['AJU_PLB'];
    }
}

if (isset($_POST['show_all'])) {
}
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
</style>
<?php
$list = $dbcon->query("SELECT * FROM plb_barang WHERE ID='" . $_GET['ID'] . "' ORDER BY ID ASC LIMIT 1");
$resultList = mysqli_fetch_array($list);
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
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Detail Nomor AJU: <?= $resultList['NOMOR_AJU'] ?></a></li>
                <li class="breadcrumb-item active">Cek CT Data Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="card-title">Detail Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></h4>
                    <h6 class="card-subtitle mb-10px text-muted">Harga Penyerahan <?= Rupiah($resultList['HARGA_PENYERAHAN']) ?></h6>
                    <p class="card-text">Uraian Barang: <?= $resultList['URAIAN'] ?></p>
                    <a href="javascript:;" class="card-link">Ukuran <?= $resultList['UKURAN'] ?></a>
                    <a href="javascript:;" class="card-link">Golongan <?= $resultList['SPESIFIKASI_LAIN'] ?></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Cek <?= $_GET['LOOP']; ?> CT Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- <div style="display: flex;justify-content: flex-start;align-content: baseline;margin-bottom:10px">
                        <div style="margin-left: 0px;">
                            <button type="submit" name="CT_kurang" class="btn btn-sm btn-custom btn-danger"><i class="fa-solid fa-minus"></i> Pilih Semua Kurang</button>
                        </div>
                        <div style="margin-left: 5px;">
                            <button type="submit" name="CT_lebih" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Pilih Semua Lebih</button>
                        </div>
                        <div style="margin-left: 5px;">
                            <button type="submit" name="CT_pecah" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pilih Semua Pecah</button>
                        </div>
                        <div style="margin-left: 5px;">
                            <button type="submit" name="CT_rusak" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Pilih Semua Rusak</button>
                        </div>
                    </div> -->
                    <form action="" method="POST">
                        <input type="text" name="ID" value="<?= $resultList['ID'] ?>">
                        <input type="text" name="NOMOR_AJU" value="<?= $resultList['NOMOR_AJU'] ?>">
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th style="text-align: center;">Aksi</th>
                                    <th width="1%" class="no-sort" style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">ID Barang</th>
                                    <th style="text-align: center;">KD Barang</th>
                                    <th style="text-align: center;">Total Botol</th>
                                    <th style="text-align: center;">Total Liter</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Remarks</th>
                                    <th style="text-align: center;">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='" . $_GET['ID'] . "' ORDER BY ID DESC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <a href="#Delete<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                <!-- Kurang -->
                                                <a href="#Kurang<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-danger"><i class="fa-solid fa-minus"></i> Kurang</a>
                                                <!-- Lebih -->
                                                <a href="#Lebih<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Lebih</a>
                                                <!-- Pecah -->
                                                <a href="#Pecah<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pecah</a>
                                                <!-- Rusak -->
                                                <a href="#Rusak<?= $row['ID'] ?>" data-toggle="modal" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</a>
                                            </td>
                                            <td>
                                                <img src="assets/img/png/box.png" style="width: 70px;" alt="">
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
                                                <i class="fa-solid fa-glass-water-droplet"></i> <?= $row['TOTAL_LITER']; ?> Liter
                                            </td>
                                            <td style="text-align: center">
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
                                            </td>
                                        </tr>
                                        <!-- Delete -->
                                        <div class="modal fade" id="Delete<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Delete] 1 CT Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <p>Hapus 1 CT dengan Total <?= $row['TOTAL_BOTOL'] ?></p>
                                                                        <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                        <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                        <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                        <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
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
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</a>
                                                            <button type="submit" name="Delete_" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Ya</button>
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
                                                            <h4 class="modal-title">[Kurang] Botol Barang Masuk - Total Botol: <?= $row['TOTAL_BOTOL']; ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- <div class="col-sm-12">
                                                                        <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                            <div style="font-size: 40px;">
                                                                                <i class="fas fa-info"></i>
                                                                            </div>
                                                                            <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                <font>Pengecekan Kode Barang: <?= $row['KODE_BARANG'] ?></font>
                                                                                <br>
                                                                                <font>Total Botol: <?= $pcs ?> <?= $row['TOTAL_BOTOL'] ?></font>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="line-page-cek"></div>
                                                                    </div> -->
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Kurang</label>
                                                                            <?php if ($row['KURANG'] == NULL) { ?>
                                                                                <input type="number" name="Kurang" class="form-control" placeholder="Kurang ..." value="0" required>
                                                                            <?php } else { ?>
                                                                                <input type="number" name="Kurang" class="form-control" placeholder="Kurang ..." value="<?= $row['KURANG'] ?>" required>
                                                                            <?php } ?>

                                                                            <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                            <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                            <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                            <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                            <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
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
                                        <div class="modal fade" id="Lebih<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Lebih] Botol Barang Masuk - Total Botol: <?= $row['TOTAL_BOTOL']; ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- <div class="col-sm-12">
                                                                        <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                            <div style="font-size: 40px;">
                                                                                <i class="fas fa-info"></i>
                                                                            </div>
                                                                            <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                <font>Pengecekan Kode Barang: <?= $row['KODE_BARANG'] ?></font>
                                                                                <br>
                                                                                <font>Total Botol: <?= $pcs ?> <?= $row['TOTAL_BOTOL'] ?></font>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="line-page-cek"></div>
                                                                    </div> -->
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Lebih</label>
                                                                            <?php if ($row['LEBIH'] == NULL) { ?>
                                                                                <input type="number" name="Lebih" class="form-control" placeholder="Lebih ..." value="0" required>
                                                                            <?php } else { ?>
                                                                                <input type="number" name="Lebih" class="form-control" placeholder="Lebih ..." value="<?= $row['LEBIH'] ?>" required>
                                                                            <?php } ?>

                                                                            <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                            <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                            <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                            <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                            <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
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
                                        <div class="modal fade" id="Pecah<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Pecah] Botol Barang Masuk - Total Botol: <?= $row['TOTAL_BOTOL']; ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- <div class="col-sm-12">
                                                                        <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                            <div style="font-size: 40px;">
                                                                                <i class="fas fa-info"></i>
                                                                            </div>
                                                                            <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                <font>Pengecekan Kode Barang: <?= $row['KODE_BARANG'] ?></font>
                                                                                <br>
                                                                                <font>Total Botol: <?= $pcs ?> <?= $row['TOTAL_BOTOL'] ?></font>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="line-page-cek"></div>
                                                                    </div> -->
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Pecah</label>
                                                                            <?php if ($row['PECAH'] == NULL) { ?>
                                                                                <input type="number" name="Pecah" class="form-control" placeholder="Pecah ..." value="0" required>
                                                                            <?php } else { ?>
                                                                                <input type="number" name="Pecah" class="form-control" placeholder="Pecah ..." value="<?= $row['PECAH'] ?>" required>
                                                                            <?php } ?>
                                                                            <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                            <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                            <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                            <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                            <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
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
                                        <div class="modal fade" id="Rusak<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Rusak] Botol Barang Masuk - Total Botol: <?= $row['TOTAL_BOTOL']; ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- <div class="col-sm-12">
                                                                        <div style="font-size: 14px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 15px;">
                                                                            <div style="font-size: 40px;">
                                                                                <i class="fas fa-info"></i>
                                                                            </div>
                                                                            <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                <font>Pengecekan Kode Barang: <?= $row['KODE_BARANG'] ?></font>
                                                                                <br>
                                                                                <font>Total Botol: <?= $pcs ?> <?= $row['TOTAL_BOTOL'] ?></font>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="line-page-cek"></div>
                                                                    </div> -->
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Rusak</label>
                                                                            <?php if ($row['RUSAK'] == NULL) { ?>
                                                                                <input type="number" name="Rusak" class="form-control" placeholder="Rusak ..." value="0" required>
                                                                            <?php } else { ?>
                                                                                <input type="number" name="Rusak" class="form-control" placeholder="Rusak ..." value="<?= $row['RUSAK'] ?>" required>
                                                                            <?php } ?>
                                                                            <input type="hidden" name="ID_CT" value="<?= $row['ID']; ?>">
                                                                            <input type="hidden" name="NOMOR_AJU" value="<?= $row['NOMOR_AJU']; ?>">
                                                                            <input type="hidden" name="ID_BARANG" value="<?= $row['ID_BARANG']; ?>">
                                                                            <input type="hidden" name="KODE_BARANG" value="<?= $row['KODE_BARANG']; ?>">
                                                                            <input type="hidden" name="TOTAL_BOTOL" value="<?= $row['TOTAL_BOTOL']; ?>">
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
</script>