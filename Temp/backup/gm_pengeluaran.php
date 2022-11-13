<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

$AJU_GB = '';
// API - 
include "include/api.php";

if (isset($_POST['edit_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bk_tgl_keluar          = $_POST['bk_tgl_keluar'];
    $bk_nama_operator       = $_POST['bk_nama_operator'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangKeluarProses.php?function=PostEDIT&bk_tgl_keluar=' . $bk_tgl_keluar . '&bk_nama_operator=' . $bk_nama_operator . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['upload_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    // File
    $filename = $_FILES['uploadBA']['name'];
    $tmpname = $_FILES['uploadBA']['tmp_name'];
    $sizename = $_FILES['uploadBA']['size'];
    $exp = explode('.', $filename);
    $ext = end($exp);
    $uniq_file =  "Berita-Acara-GB" . '_' . time();
    $newname =  "Berita-Acara-GB" . '_' . time() . "." . $ext;
    $config['upload_path'] = './files/ck5plb/BA/GB/';
    $config['allowed_types'] = "jpg|jpeg|png|jfif|gif|pdf";
    $config['max_size'] = '2000000';
    $config['file_name'] = $newname;
    move_uploaded_file($tmpname, "files/ck5plb/BA/GB/" . $newname);

    $content = get_content($resultAPI['url_api'] . 'gmBarangKeluarProses.php?function=PostUPLOAD&newname=' . $newname . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveFailed=true';</script>";
    }
}

// Find
if (isset($_POST['filter'])) {
    if ($_POST["AJU_GB"] != '') {
        $AJU_GB   = $_POST['AJU_GB'];
    }
    $content = get_content($resultAPI['url_api'] . 'gmBarangKeluar.php?function=get_noAJU&AJU_GB=' . $AJU_GB);
    $data = json_decode($content, true);
}

if (isset($_POST['show_all'])) {
    $content = get_content($resultAPI['url_api'] . 'gmBarangKeluar.php?function=get_all');
    $data = json_decode($content, true);
}

// NOMOR PENGAJUAN GB
$contentAJUGB = get_content($resultAPI['url_api'] . 'nomor_AJU.php?function=get_AJU_GB');
$dataAJUGB = json_decode($contentAJUGB, true);
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
                <li class="breadcrumb-item active">Barang Keluar</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Search AJU PLB -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Find Data Keluar Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">

                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;">
                                <img src="assets/img/svg/filter-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="80%">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nomor Pengajuan GB</label>
                                        <input type="text" id="IDAJU_GB" name="AJU_GB" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $AJU_GB; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-search"></i> Cari</button>
                                    <a href="gm_pengeluaran.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i> Reset</a>
                                    <button type="submit" name="show_all" class="btn btn-default m-r-5"><i class="fas fa-calendar-check"></i> Tampilkan Semua</button>
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
                    <h4 class="panel-title">[Gate Mandiri] Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php if (isset($_POST['filter'])) { ?>
                        <div class="card text-white border-0 bg-blue text-center mb-2">
                            <div class="card-body">
                                <div>
                                    <h4>
                                        <i class="fas fa-search"></i> Hasil Pencarian.
                                    </h4>
                                    <hr>
                                    <div>
                                        <p class="mb-2">Nomor Pengajuan GB: <?= $AJU_GB; ?></p>
                                    </div>
                                </div>
                                <figcaption class="blockquote-footer mt-n2 mb-1 text-white text-opacity-75">
                                    Time <cite title="Source Title"> <?= date('H:m:i A'); ?></cite>
                                </figcaption>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_POST['show_all'])) { ?>
                        <div class="card text-white border-0 bg-blue text-center mb-2">
                            <div class="card-body">
                                <div>
                                    <h4>
                                        <i class="fas fa-info"></i> Hasil Pencarian
                                    </h4>
                                    <hr>
                                    <div>
                                        <p class="mb-2">Anda menampilkan semua data!</p>
                                    </div>
                                </div>
                                <figcaption class="blockquote-footer mt-n2 mb-1 text-white text-opacity-75">
                                    Time <cite title="Source Title"> <?= date('H:m:i A'); ?></cite>
                                </figcaption>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="5" class="text-nowrap" style="text-align: center;">PLB</th>
                                    <th colspan="5" class="text-nowrap" style="text-align: center;">GB</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- PLB -->
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal</th>
                                    <th class="text-nowrap" style="text-align: center;">Total Barang</th>
                                    <th class="text-nowrap" style="text-align: center;">Asal PLB</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Negara</th>
                                    <!-- GB -->
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal</th>
                                    <th class="text-nowrap" style="text-align: center;">Total Barang</th>
                                    <th class="text-nowrap" style="text-align: center;">Asal GB</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Negara</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 200) { ?>
                                    <?php $no = 0; ?>
                                    <?php foreach ($data['result'] as $row) { ?>
                                        <?php $no++ ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <!-- PLB -->
                                            <td style="text-align: center">
                                                <?php if ($row['bm_no_aju_plb'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bm_no_aju_plb']; ?>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $dataTGLAJU_PLB = $row['TGL_AJU_PLB'];
                                            $dataTGLAJU_PLBY = substr($dataTGLAJU_PLB, 0, 4);
                                            $dataTGLAJU_PLBM = substr($dataTGLAJU_PLB, 4, 2);
                                            $dataTGLAJU_PLBD =  substr($dataTGLAJU_PLB, 6, 2);

                                            $datTGLAJU_PLB = $dataTGLAJU_PLBY . '-' . $dataTGLAJU_PLBM . '-' . $dataTGLAJU_PLBD;
                                            ?>
                                            <td style="text-align: center;">
                                                <div style="width: 85px;">
                                                    <i class="fas fa-calendar-alt"></i> <?= $datTGLAJU_PLB ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['JUMLAH_BARANG_PLB'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['JUMLAH_BARANG_PLB']; ?> Barang
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['PERUSAHAAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['KODE_NEGARA_PEMASOK_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_NEGARA_PEMASOK_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- TPB -->
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $dataTGLAJU_TPB = $row['TGL_AJU'];
                                            $dataTGLAJU_TPBY = substr($dataTGLAJU_TPB, 0, 4);
                                            $dataTGLAJU_TPBM = substr($dataTGLAJU_TPB, 4, 2);
                                            $dataTGLAJU_TPBD =  substr($dataTGLAJU_TPB, 6, 2);

                                            $datTGLAJU_TPB = $dataTGLAJU_TPBY . '-' . $dataTGLAJU_TPBM . '-' . $dataTGLAJU_TPBD;
                                            ?>
                                            <td style="text-align: center;">
                                                <div style="width: 85px;">
                                                    <i class="fas fa-calendar-alt"></i> <?= $datTGLAJU_TPB ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['JUMLAH_BARANG'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['JUMLAH_BARANG']; ?> Barang
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NAMA_PENGUSAHA'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PENGUSAHA']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['KODE_NEGARA_PEMASOK'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Aksi -->
                                            <td style="text-align: center;">
                                                <div style="display: flex;justify-content: center;align-items: center;width: 300px;">
                                                    <?php if ($row['JUMLAH_BARANG'] == $row['tpb_total_All']) { ?>
                                                        <div>
                                                            <a href="gm_pengeluaran_detail.php?AJU=<?= $row['ID'] ?>" class="btn btn-success" target="_blank">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Barang Keluar Total: <?= $row['JUMLAH_BARANG']; ?> Barang! - Barang diCek: <?= $row['tpb_total_All']; ?> Barang!" data-placement="top" data-content="Anda sudah melakukan pengecekan Barang Keluar!">
                                                                    <div style="display: grid;">
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-check-circle"></i>
                                                                        </div>
                                                                        <!-- <div style="font-size: 8px;">
                                                                            <font>Barang Keluar Sudah diCek!</font>
                                                                        </div> -->
                                                                    </div>
                                                                </font>
                                                            </a>
                                                        </div>
                                                        <div style="margin-left: 10px;">
                                                            <?php if ($row['bk_no_aju_sarinah'] == NULL) { ?>
                                                                <a href="#add<?= $row['ID'] ?>" class="btn btn-primary" data-toggle="modal" title="Add">
                                                                    <font data-toggle="popover" data-trigger="hover" data-title="Add Nomor Pengajuan GB!" data-placement="top" data-content="Klik untuk menginput Nomor Pengajuan GB!">
                                                                        <div>
                                                                            <div style="font-size: 12px;">
                                                                                <i class="fas fa-plus-circle"></i>
                                                                            </div>
                                                                            <!-- <div style="font-size: 8px;">
                                                                                <font>Add</font>
                                                                            </div> -->
                                                                        </div>
                                                                    </font>
                                                                </a>
                                                            <?php } else { ?>
                                                                <?php if ($row['upload_beritaAcara_GB'] == NULL) { ?>
                                                                    <div style="display: flex;">
                                                                        <div>
                                                                            <a href="#edit<?= $row['ID'] ?>" class="btn btn-info" data-toggle="modal" title="Add">
                                                                                <div>
                                                                                    <div style="font-size: 12px;">
                                                                                        <i class="fas fa-calendar-alt"></i>
                                                                                    </div>
                                                                                    <!-- <div style="font-size: 8px;">
                                                                                        <font>Update Tanggal Keluar</font>
                                                                                    </div> -->
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div style="margin-left: 10px;">
                                                                            <a href="#upload<?= $row['ID'] ?>" class="btn btn-warning" data-toggle="modal" title="Upload Berita Acara!">
                                                                                <div>
                                                                                    <div style="font-size: 12px;">
                                                                                        <i class="fas fa-file"></i>
                                                                                    </div>
                                                                                    <!-- <div style="font-size: 8px;">
                                                                                        <font>Upload Berita Acara!</font>
                                                                                    </div> -->
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <a href="#detail<?= $row['ID'] ?>" class="btn btn-dark" data-toggle="modal" title="Add">
                                                                        <font data-toggle="popover" data-trigger="hover" data-title="Data Lengkap, No. AJU GB & Berita Acara Terisi!" data-placement="top" data-content="Data Masuk Barang Lengkap pada Nomor Pengajuan: <?= $row['NOMOR_AJU'] ?>!">
                                                                            <div>
                                                                                <div style="font-size: 12px;">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </div>
                                                                                <!-- <div style="font-size: 8px;">
                                                                                    <font>No. AJU GB & Berita Acara Terisi!</font>
                                                                                </div> -->
                                                                            </div>
                                                                        </font>
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div>
                                                            <a href="gm_pengeluaran_detail.php?AJU=<?= $row['ID'] ?>" class="btn btn-yellow" target="_blank">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Cek Barang Keluar Total: <?= $row['JUMLAH_BARANG']; ?> Barang!" data-placement="top" data-content="Klik untuk melakukan pengecekan Barang Keluar.">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-warning"></i>
                                                                        </div>
                                                                        <!-- <div style="font-size: 8px;">
                                                                            <font>Cek Barang Keluar!</font>
                                                                        </div> -->
                                                                    </div>
                                                                </font>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- Aksi -->
                                        </tr>
                                        <!-- Edit -->
                                        <div class="modal fade" id="edit<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Edit] Data Barang Keluar</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- Barang Keluar -->
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB & GB Sarinah</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bm_no_aju_plb']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Keluar</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bk_tgl_keluar'];
                                                                                    $tgl = substr($tgl_msk, 0, 10);
                                                                                    $time = substr($tgl_msk, 10, 20);
                                                                                    ?>
                                                                                    <input type="date" name="bk_tgl_keluar" class="form-control" placeholder="Tanggal Keluar ..." value="<?= $tgl; ?>">
                                                                                    <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bk_nama_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Keluar -->
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="edit_" class="btn btn-info"><i class="fas fa-calendar-alt"></i> Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Edit -->
                                        <!-- Upload -->
                                        <div class="modal fade" id="upload<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Upload] Berita Acara</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- Barang Keluar -->
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB & GB Sarinah</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bm_no_aju_plb']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Keluar</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bk_tgl_keluar'];
                                                                                    $tgl = substr($tgl_msk, 0, 10);
                                                                                    $time = substr($tgl_msk, 10, 20);
                                                                                    ?>
                                                                                    <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Keluar ..." value="<?= $tgl; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php if ($row['upload_beritaAcara_GB'] != NULL) { ?>
                                                                                        <label>Upload Berita Acara Kembali!</label>
                                                                                    <?php } else { ?>
                                                                                        <label>Upload Berita Acara</label>
                                                                                    <?php } ?>
                                                                                    <input type="file" name="uploadBA" class="form-control" placeholder="Upload Berita Acara ..." value="<?= $row['upload_beritaAcara_GB']; ?>">
                                                                                    <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Keluar -->
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="upload_" class="btn btn-warning"><i class="fas fa-file"></i> Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Upload -->
                                        <!-- Detail -->
                                        <div class="modal fade" id="detail<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Detail] Data Barang Keluar</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- Barang Masuk -->
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bm_no_aju_plb']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Masuk</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bm_tgl_masuk'];
                                                                                    $tgl = substr($tgl_msk, 0, 10);
                                                                                    $time = substr($tgl_msk, 10, 20);
                                                                                    ?>
                                                                                    <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Masuk ..." value="<?= $tgl; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bm_nama_operator']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>Berita Acara Barang Masuk</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr> -->
                                                                            <div class="col-md-12">
                                                                                <embed src="https://itinventory-sarinah.com/files/ck5plb/BA/PLB/<?= $row['upload_beritaAcara_PLB']; ?>" style="width: 100%" height="500">
                                                                                </object>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Masuk -->
                                                                    <!-- Barang Keluar -->
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>GB Sarinah</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Keluar</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bk_tgl_keluar'];
                                                                                    $tgl = substr($tgl_msk, 0, 10);
                                                                                    $time = substr($tgl_msk, 10, 20);
                                                                                    ?>
                                                                                    <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Keluar ..." value="<?= $tgl; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bk_nama_operator']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>Berita Acara Barang Keluar</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr> -->
                                                                            <div class="col-md-12">
                                                                                <embed src="https://itinventory-sarinah.com/files/ck5plb/BA/GB/<?= $row['upload_beritaAcara_GB']; ?>" style="width: 100%" height="500">
                                                                                </object>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Keluar -->
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <!-- <button type="submit" name="add_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button> -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail -->
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="12">
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
<?php include "include/jsForm.php"; ?>
<script type="text/javascript">
    $(".default-select2").select2();
    $(function() {
        $("#IDAJU_GB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
</script>