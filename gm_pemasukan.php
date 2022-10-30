<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
// API - 
include "include/api.php";

$AJU_PLB = '';
// NOMOR PENGAJUAN GB
if (isset($_POST['add_'])) {
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'] . ' ' . date('H:m:i');
    $bm_nama_operator       = $_POST['bm_operator'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostADD&bm_no_aju_plb=' . $bm_no_aju_plb . '&bk_no_aju_sarinah=' . $bk_no_aju_sarinah . '&bm_tgl_masuk=' . $bm_tgl_masuk . '&bm_nama_operator=' . $bm_nama_operator);
    $data = json_decode($content, true);
    $sql = $dbcon->query("INSERT INTO rcd_status 
                                (rcd_id,bm_no_aju_plb,bm_tgl_masuk,bm_nama_operator,bk_no_aju_sarinah)
                                VALUES
                                ('','$bm_no_aju_plb','$bm_tgl_masuk','$bm_nama_operator','$bk_no_aju_sarinah')");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['edit_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'] . ' ' . date('H:m:i');
    $bm_nama_operator       = $_POST['bm_operator'];
    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostEDIT&bm_no_aju_plb=' . $bm_no_aju_plb . '&bk_no_aju_sarinah=' . $bk_no_aju_sarinah . '&bm_tgl_masuk=' . $bm_tgl_masuk . '&bm_nama_operator=' . $bm_nama_operator . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);
    $sql = $dbcon->query("UPDATE rcd_status SET bm_no_aju_plb='$bm_no_aju_plb',
                                                bm_tgl_masuk='$bm_tgl_masuk',
                                                bm_nama_operator='$bm_nama_operator',
                                                bk_no_aju_sarinah='$bk_no_aju_sarinah'
                                            WHERE rcd_id='$rcd_id'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
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
    $uniq_file =  "Berita-Acara-PLB" . '_' . time();
    $newname =  "Berita-Acara-PLB" . '_' . time() . "." . $ext;
    $config['upload_path'] = './files/ck5plb/BA/PLB/';
    $config['allowed_types'] = "jpg|jpeg|png|jfif|gif|pdf";
    $config['max_size'] = '2000000';
    $config['file_name'] = $newname;
    move_uploaded_file($tmpname, "files/ck5plb/BA/PLB/" . $newname);
    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostUPLOAD&newname=' . $newname . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);

    $sql = $dbcon->query("UPDATE rcd_status SET upload_beritaAcara_PLB='$newname'
                                            WHERE rcd_id='$rcd_id'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Find Data Masuk Barang</h4>
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
                                        <label>CK5 PLB (Nomor Pengajuan)</label>
                                        <input type="number" id="IDAJU_PLB" name="AJU_PLB" class="form-control" placeholder="CK5 PLB (Nomor Pengajuan) ..." value="<?= $AJU_PLB; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-search"></i> Cari</button>
                                    <a href="gm_pemasukan.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i> Reset</a>
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
                                        <p class="mb-2">Nomor Pengajuan CK5 PLB: <?= $AJU_PLB; ?></p>
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
                                    <th colspan="3" class="text-nowrap" style="text-align: center;">Nomor Pengajuan PLB</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Total Barang PLB</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Asal PLB</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Kode Negara</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- Nomor Pengajuan PLB -->
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Tanggal Submit/Upload CK5 PLB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['filter'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_Sesuai,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Kurang' AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_Kurang,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Lebih' AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_Lebih,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Pecah' AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_Pecah,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Rusak' AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_Rusak,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=" . $_POST['AJU_PLB'] . ") AS total_All
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                WHERE hdr.NOMOR_AJU LIKE '%" . $_POST['AJU_PLB'] . "%' GROUP BY hdr.NOMOR_AJU", 0);
                                } else if (isset($_POST['show_all'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Sesuai,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Kurang' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Kurang,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Lebih' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Lebih,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Pecah' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Pecah,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Rusak' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Rusak,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Sesuai,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Kurang' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Kurang,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Lebih' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Lebih,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Pecah' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Pecah,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS='Rusak' AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_Rusak,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC LIMIT 100", 0);
                                }
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $dataTGLAJU = $row['TGL_AJU'];
                                            $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                            $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                            $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                            $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                            ?>
                                            <td style="text-align: center;">
                                                <div style="width: 85px;">
                                                    <i class="fas fa-calendar-alt"></i> <?= $datTGLAJU ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?php
                                                    $alldate = $row['ck5_plb_submit'];
                                                    $tgl = substr($alldate, 0, 10);
                                                    $time = substr($alldate, 10, 20);
                                                    ?>
                                                    <div style="display: grid;">
                                                        <font><i class="fa-solid fa-calendar-days"></i> <?= $tgl ?></font>
                                                        <font style="margin-left: -26px;"><i class="fa-solid fa-clock"></i> <?= $time ?></font>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang PLB -->
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
                                                <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['PERUSAHAAN']; ?>
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

                                                <div style="display: flex;justify-content: center;align-items: center;">
                                                    <?php if ($row['JUMLAH_BARANG'] == $row['total_All']) { ?>
                                                        <div>
                                                            <a href="gm_pemasukan_detail.php?AJU=<?= $row['NOMOR_AJU'] ?>" class="btn btn-success">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Barang Masuk Total: <?= $row['JUMLAH_BARANG']; ?> Barang! - Barang diCek: <?= $row['total_All']; ?> Barang!" data-placement="top" data-content="Anda sudah melakukan pengecekan Barang Masuk!">
                                                                    <div style="display: grid;">
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-check-circle"></i>
                                                                        </div>
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
                                                                        </div>
                                                                    </font>
                                                                </a>
                                                            <?php } else { ?>
                                                                <?php if ($row['upload_beritaAcara_PLB'] == NULL) { ?>
                                                                    <div style="display: flex;">
                                                                        <div>
                                                                            <a href="#edit<?= $row['ID'] ?>" class="btn btn-info" data-toggle="modal" title="Add">
                                                                                <div>
                                                                                    <div style="font-size: 12px;">
                                                                                        <i class="fas fa-edit"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div style="margin-left: 10px;">
                                                                            <a href="#upload<?= $row['ID'] ?>" class="btn btn-warning" data-toggle="modal" title="Upload Berita Acara!">
                                                                                <div>
                                                                                    <div style="font-size: 12px;">
                                                                                        <i class="fas fa-file"></i>
                                                                                    </div>
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
                                                                            </div>
                                                                        </font>
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div>
                                                            <a href="gm_pemasukan_detail.php?AJU=<?= $row['NOMOR_AJU']; ?>" class="btn btn-yellow">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Cek Barang Masuk Total: <?= $row['JUMLAH_BARANG']; ?> Barang!" data-placement="top" data-content="Klik untuk melakukan pengecekan Barang Masuk.">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-warning"></i>
                                                                        </div>
                                                                    </div>
                                                                </font>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                            </td>
                                        </tr>
                                        <!-- Add -->
                                        <div class="modal fade" id="add<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Add] Data Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <select name="bk_aju" class="default-select2 form-control" required>
                                                                                        <?php if ($row['bk_no_aju_sarinah'] != NULL) { ?>
                                                                                            <option value="<?= $row['bk_no_aju_sarinah']; ?>"><?= $row['bk_no_aju_sarinah']; ?></option>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } ?>
                                                                                        <?php foreach ($dataAJUGB['result'] as $rowAJUGB) { ?>
                                                                                            <option value="<?= $rowAJUGB['NOMOR_AJU']; ?>"><?= $rowAJUGB['NOMOR_AJU']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
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
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Masuk -->
                                                                    <div class="col-md-12">
                                                                        <small style="color: red"><i>(*) Harus diisi</i></small>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="add_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Add -->
                                        <!-- Edit -->
                                        <div class="modal fade" id="edit<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Edit] Data Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <select name="bk_aju" class="default-select2 form-control" required>
                                                                                        <?php if ($row['bk_no_aju_sarinah'] != NULL) { ?>
                                                                                            <option value="<?= $row['bk_no_aju_sarinah']; ?>"><?= $row['bk_no_aju_sarinah']; ?></option>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } ?>
                                                                                        <?php foreach ($dataAJUGB['result'] as $rowAJUGB) { ?>
                                                                                            <option value="<?= $rowAJUGB['NOMOR_AJU']; ?>"><?= $rowAJUGB['NOMOR_AJU']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
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
                                                                                    <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <small style="color: red"><i>(*) Harus diisi</i></small>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="edit_" class="btn btn-info"><i class="fas fa-edit"></i> Edit</button>
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
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                                <label>Upload Berita Acara Kembali!</label>
                                                                            <?php } else { ?>
                                                                                <label>Upload Berita Acara</label>
                                                                            <?php } ?>
                                                                            <input type="file" name="uploadBA" class="form-control" placeholder="Upload Berita Acara ..." value="<?= $row['upload_beritaAcara_PLB']; ?>">
                                                                            <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <small style="color: red"><i>(*) Harus diisi</i></small>
                                                                    </div>
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
                                                            <h4 class="modal-title">[Detail] Data Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                        <?php $col = '6'; ?>
                                                                    <?php } else { ?>
                                                                        <?php $col = '12'; ?>
                                                                    <?php } ?>
                                                                    <!-- Barang Masuk -->
                                                                    <div class="col-<?= $col; ?>">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <select name="bk_aju" class="default-select2 form-control" required>
                                                                                        <?php if ($row['bk_no_aju_sarinah'] != NULL) { ?>
                                                                                            <option value="<?= $row['bk_no_aju_sarinah']; ?>"><?= $row['bk_no_aju_sarinah']; ?></option>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php } ?>
                                                                                        <?php foreach ($dataAJUGB['result'] as $rowAJUGB) { ?>
                                                                                            <option value="<?= $rowAJUGB['NOMOR_AJU']; ?>"><?= $rowAJUGB['NOMOR_AJU']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
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
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Masuk -->
                                                                    <!-- Barang Keluar -->
                                                                    <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                        <div class="col-6">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <embed src="https://itinventory-sarinah.com/files/ck5plb/BA/PLB/<?= $row['upload_beritaAcara_PLB']; ?>" style="width: 100%" height="500">
                                                                                    </object>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail -->
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="9">
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
        $("#IDAJU_PLB").autocomplete({
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