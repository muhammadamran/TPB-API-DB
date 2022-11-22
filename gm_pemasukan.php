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
// Tanggal Upload
if (isset($_POST['UploadBC27PLB_'])) {
    $DateUpload          = $_POST['DateUpload'];
    $NOAJU               = $_POST['NOAJU'];

    $sql = $dbcon->query("UPDATE plb_status SET ck5_plb_submit='$DateUpload'
                          WHERE NOMOR_AJU_PLB='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?UpdateFailed=true';</script>";
    }
}

// Kode Negara
if (isset($_POST['KodeNegara_'])) {
    $KodeNegara          = $_POST['KodeNegara'];
    $NOAJU               = $_POST['NOAJU'];

    $sql = $dbcon->query("UPDATE plb_header SET KODE_NEGARA_PEMASOK='$KodeNegara'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}
if (isset($_POST['UKodeNegara_'])) {
    $KodeNegara          = $_POST['KodeNegara'];
    $NOAJU               = $_POST['NOAJU'];

    $sql = $dbcon->query("UPDATE plb_header SET KODE_NEGARA_PEMASOK='$KodeNegara'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?UpdateFailed=true';</script>";
    }
}

// NOMOR PENGAJUAN GB
if (isset($_POST['add_'])) {
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'] . ' ' . date('H:m:i');
    $bm_nama_operator       = $_POST['bm_operator'];
    // CEK
    $dataREF                = $dbcon->query("SELECT COUNT(*) AS total FROM rcd_status WHERE bm_no_aju_plb='$bm_no_aju_plb'");
    $resultREF              = mysqli_fetch_array($dataREF);
    // CEK
    if ($resultREF['total'] != 0) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    } else {
        $sql = $dbcon->query("INSERT INTO rcd_status 
                        (rcd_id,bm_no_aju_plb,bm_tgl_masuk,bm_nama_operator,bk_no_aju_sarinah)
                        VALUES
                        ('','$bm_no_aju_plb','$bm_tgl_masuk','$bm_nama_operator','$bk_no_aju_sarinah')");

        if ($sql) {
            echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
        }
    }
}

if (isset($_POST['edit_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'] . ' ' . date('H:m:i');
    $bm_nama_operator       = $_POST['bm_operator'];
    $sql = $dbcon->query("UPDATE rcd_status SET bm_no_aju_plb='$bm_no_aju_plb',
                                                bm_tgl_masuk='$bm_tgl_masuk',
                                                bm_nama_operator='$bm_nama_operator',
                                                bk_no_aju_sarinah='$bk_no_aju_sarinah'
                                            WHERE rcd_id='$rcd_id'");

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['upload_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bk_nama_operator       = $_POST['bk_nama_operator'];
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
    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'jfif' || $ext == 'gif' || $ext == 'pdf') {
        move_uploaded_file($tmpname, "files/ck5plb/BA/PLB/" . $newname);
        $sql = $dbcon->query("UPDATE rcd_status SET upload_beritaAcara_PLB='$newname',
                                                    bc_in='$bk_nama_operator'
                                                WHERE rcd_id='$rcd_id'");
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?UploadQuestion=true';</script>";
    }

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true';</script>";
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
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Gate In App Name | Company </title>
<?php } else { ?>
    <title>Gate In - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
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
                <li class="breadcrumb-item active">Gate In</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i><span> <?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Search AJU PLB -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Find Data Gate In</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;">
                                <img src="assets/img/svg/search-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="80%">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>BC 2.7 PLB (Nomor Pengajuan)</label>
                                        <input type="number" id="IDAJU_PLB" name="AJU_PLB" class="form-control" placeholder="BC 2.7 PLB (Nomor Pengajuan) ..." value="<?= $AJU_PLB; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="gm_pemasukan.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                        <font class="f-action">Reset</font>
                                    </a>
                                    <button type="submit" name="show_all" class="btn btn-default m-r-5"><i class="fas fa-calendar-check"></i>
                                        <font class="f-action">Tampilkan Semua</font>
                                    </button>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Gate Mandiri] Data Gate In</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <!-- begin alert -->
                <div class="alert alert-secondary fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Jika Barang <b>Gate In</b> sudah disimpan, silahkan lengkapi <b>Nomor Pengajuan GB</b>, <b>Tanggal Gate In</b> dan <b>Upload Berita Acara</b></p>
                    <p>
                        Note:
                    <ul>
                        <li>Lakukan penyelesaian pengecekan <b>Barang Gate In</b> pada setiap <b>Nomor Pengajuan BC 2.7 PLB</b> yang telah diupload.</li>
                        <li>
                            Jika <b>Barang Gate In</b> pada setiap <b>Nomor Pengajuan BC 2.7 PLB</b> sudah sesuai, lengkapi <b>Nomor Pengajuan Gudang Berikat (GB)</b> pada module <b>CIESA</b> dan <b>Pilih Tanggal Gate In</b>.
                            <ul>
                                <li> Jika <b>Nomor Pengajuan Gudang Berikat (GB)</b> dan <b>Tanggal Gate In</b> sudah di lengkapi, silahkan lihat <b>Laporan Masuk <?= $resultSetting['app_name'] ?></b>;</li>
                                <li> Jika <b>Nomor Pengajuan Gudang Berikat (GB)</b> dan <b>Tanggal Gate In</b> sudah di lengkapi, silahkan <b>Download (.xls)/Print Packing List </b>dan<b> Invoice</b> pada <b>Laporan Gudang Berikat <?= $resultSetting['company'] ?></b>;</li>
                            </ul>
                        </li>
                        <li>
                            Jika <b>Nomor Pengajuan Gudang Berikat (GB)</b> dan <b>Tanggal Gate In</b> sudah di lengkapi, silahkan <b>Upload Berita Acara Gate In</b> dan <b>Isi Nama Petugas BeaCukai</b> yang mengawasi.
                            <ul>
                                <li>Jika <b>Upload Berita Acara Gate In</b> dan <b>Isi Nama Petugas BeaCukai</b> yang mengawasi sudah dilengkapi, <b>Status Barang Gate In</b> akan berubah menjadi <b>Status Barang Gate Out</b> pada <b><?= $resultSetting['app_name'] ?></b>;</li>
                            </ul>
                        </li>
                    </ul>
                    </p>
                </div>
                <!-- end alert -->
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
                                        <p class="mb-2">Nomor Pengajuan BC 2.7 PLB: <?= $AJU_PLB; ?></p>
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
                        <table id="TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="2" class="text-nowrap" style="text-align: center;">BC 2.7 PLB</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Asal</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Tujuan</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Kode Negara</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Status</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- Nomor Pengajuan PLB -->
                                    <th class="text-nowrap no-sort" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['filter'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
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
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                (SELECT COUNT(STATUS) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                WHERE hdr.NOMOR_AJU LIKE '%" . $_POST['AJU_PLB'] . "%'
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC", 0);
                                } else if (isset($_POST['show_all'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
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
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                (SELECT COUNT(STATUS) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT hdr.ID,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
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
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                (SELECT COUNT(STATUS) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
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
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU = $row['TGL_AJU'];
                                                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NOMOR_AJU']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?php
                                                    $alldate = $row['ck5_plb_submit'];
                                                    $tgl = substr($alldate, 0, 10);
                                                    $time = substr($alldate, 10, 20);
                                                    ?>
                                                    <?= date_indo_s($tgl, TRUE) ?> - <?= $time ?>
                                                    <a href="#MUploadDate<?= $row['ID'] ?>" class="label label-default" data-toggle="modal"><i class="fas fa-edit" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Edit Tanggal Upload"></i></a>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang PLB -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['PERUSAHAAN']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['KODE_NEGARA_PEMASOK'] == NULL) { ?>
                                                    <a href="#MKodeNegara<?= $row['ID'] ?>" class="btn btn-primary" data-toggle="modal">
                                                        <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tambah Kode Negara">
                                                            <div>
                                                                <div style="font-size: 12px;">
                                                                    <i class="fas fa-plus-circle"></i>
                                                                </div>
                                                            </div>
                                                        </font>
                                                    </a>
                                                <?php } else { ?>
                                                    <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                                    <a href="#MUKodeNegara<?= $row['ID'] ?>" class="label label-default" data-toggle="modal"><i class="fas fa-edit" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Tambah/Edit Kode Negara"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['STATUS'] == $row['JUMLAH_BARANG']) { ?>
                                                    <?php if ($row['bm_no_aju_plb'] == NULL) { ?>
                                                        <span class="badge-dot badge-aju mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Input Nomor Pengajuan GB -> <?= $row['NAMA_PENERIMA_BARANG'] ?>"></span> Input
                                                    <?php } else if ($row['upload_beritaAcara_PLB'] == NULL) { ?>
                                                        <span class="badge-dot badge-upload mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Upload Berita Acara -> <?= $row['PERUSAHAAN'] ?>"></span> Upload
                                                    <?php } else { ?>
                                                        <span class="badge-dot badge-complete mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Complete"></span> Complete
                                                    <?php } ?>
                                                <?php } else if ($row['STATUS'] > 0) { ?>
                                                    <span class="badge-dot badge-on-progress mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Proses Pengecekan Barang -> <?= $row['PERUSAHAAN']; ?>, Sisa Barang <?= $row['JUMLAH_BARANG'] - $row['STATUS']; ?>"></span> On Process
                                                <?php } else if ($row['STATUS'] == NULL || $row['STATUS'] == 0) { ?>
                                                    <span class="badge-dot badge-need-checking mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Cek Barang Masuk -> <?= $row['PERUSAHAAN']; ?>, Jumlah Barang <?= $row['JUMLAH_BARANG']; ?>"></span> Check
                                                <?php } ?>
                                            </td>
                                            <!-- Aksi -->
                                            <td style="text-align: left;">
                                                <?php if ($row['total_All'] == $row['JUMLAH_BARANG']) { ?>
                                                    <!-- Cek Done -->
                                                    <a href="gm_pemasukan_detail.php?AJU=<?= $row['NOMOR_AJU'] ?>" class="btn btn-sm btn-success">
                                                        <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Pengecekan Barang Gate In Selesai, Klik jika ingin melihat Detil">
                                                            <div style="display: grid;">
                                                                <div style="font-size: 12px;">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </div>
                                                            </div>
                                                        </font>
                                                    </a>
                                                    <!-- End Cek Done -->
                                                    <?php if ($row['bm_no_aju_plb'] == NULL) { ?>
                                                        <!-- Add -->
                                                        <a href="#add<?= $row['ID'] ?>" class="btn btn-sm btn-primary" data-toggle="modal">
                                                            <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tambah Data Gate In">
                                                                <div>
                                                                    <div style="font-size: 12px;">
                                                                        <i class="fas fa-plus-circle"></i>
                                                                    </div>
                                                                </div>
                                                            </font>
                                                        </a>
                                                        <!-- End Add -->
                                                    <?php } else { ?>
                                                        <?php if ($row['upload_beritaAcara_PLB'] == NULL) { ?>
                                                            <!-- Edit -->
                                                            <a href="#edit<?= $row['ID'] ?>" class="btn btn-sm btn-info" data-toggle="modal">
                                                                <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Edit Data Gate In">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-edit"></i>
                                                                        </div>
                                                                    </div>
                                                                </font>
                                                            </a>
                                                            <!-- End Edit -->
                                                            <!-- Upload -->
                                                            <a href="#upload<?= $row['ID'] ?>" class="btn btn-sm btn-warning" data-toggle="modal">
                                                                <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Upload Berita Acara Gate In">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-upload"></i>
                                                                        </div>
                                                                    </div>
                                                                </font>
                                                            </a>
                                                            <!-- End Upload -->
                                                        <?php } else { ?>
                                                            <!-- Detail -->
                                                            <a href="#detail<?= $row['ID'] ?>" class="btn btn-sm btn-success" data-toggle="modal">
                                                                <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lihat Detail Data Gate In">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-file-invoice"></i>
                                                                        </div>
                                                                    </div>
                                                                </font>
                                                            </a>
                                                            <!-- End Detail -->
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <a href="gm_pemasukan_detail.php?AJU=<?= $row['NOMOR_AJU']; ?>" class="btn btn-sm btn-yellow">
                                                        <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lakukan Pengecekan Barang Gate In">
                                                            <div>
                                                                <div style="font-size: 12px;">
                                                                    <i class="fas fa-warning"></i>
                                                                </div>
                                                            </div>
                                                        </font>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <!-- EDIT TIME SUBMIT -->
                                        <div class="modal fade" id="MUploadDate<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Edit Data] Tanggal Upload BC 2.7 PLB - No. AJU: <?= $row['NOMOR_AJU'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label>Nomor Pengajuan</label>
                                                                        <input type="text" name="NOAJU" class="form-control" value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label>Tanggal Upload BC 2.7 PLB</label>
                                                                        <input type="datetime-local" name="DateUpload" class="form-control" value="<?= $row['ck5_plb_submit']; ?>">
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="UploadBC27PLB_" class="btn btn-default"><i class="fas fa-edit"></i> Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END EDIT TIME SUBMIT -->

                                        <!-- Kode Negara -->
                                        <div class="modal fade" id="MKodeNegara<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Tambah Data] Kode Negara - No. AJU: <?= $row['NOMOR_AJU'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label>Kode Negara <small style="color:red">*</small></label>
                                                                        <select name="KodeNegara" class="default-select2 form-control" required>
                                                                            <?php if ($row['KODE_NEGARA'] != NULL) { ?>
                                                                                <option value="<?= $row['KODE_NEGARA']; ?>"><?= $row['KODE_NEGARA']; ?></option>
                                                                                <option value="">Pilih Kode Negara</option>
                                                                            <?php } else { ?>
                                                                                <option value="">Pilih Kode Negara</option>
                                                                                <?php
                                                                                $dataKDN = $dbcon->query("SELECT * FROM referensi_negara");
                                                                                foreach ($dataKDN as $rowKDN) { ?>
                                                                                    <option value="<?= $rowKDN['KODE_NEGARA']; ?>"><?= $rowKDN['KODE_NEGARA']; ?> - <?= $rowKDN['URAIAN_NEGARA']; ?></option>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <input type="hidden" name="NOAJU" value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="KodeNegara_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Kode Negara -->

                                        <!-- Kode Negara -->
                                        <div class="modal fade" id="MUKodeNegara<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Edit Data] Kode Negara - No. AJU: <?= $row['NOMOR_AJU'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label>Kode Negara <small style="color:red">*</small></label>
                                                                        <select name="KodeNegara" class="default-select2 form-control" required>
                                                                            <?php if ($row['KODE_NEGARA_PEMASOK'] != NULL) { ?>
                                                                                <option value="<?= $row['KODE_NEGARA_PEMASOK']; ?>"><?= $row['KODE_NEGARA_PEMASOK']; ?></option>
                                                                                <option value="">Pilih Kode Negara</option>
                                                                            <?php } else { ?>
                                                                                <option value="">Pilih Kode Negara</option>
                                                                            <?php } ?>
                                                                            <?php
                                                                            $dataKDN = $dbcon->query("SELECT * FROM referensi_negara");
                                                                            foreach ($dataKDN as $rowKDN) { ?>
                                                                                <option value="<?= $rowKDN['KODE_NEGARA']; ?>"><?= $rowKDN['KODE_NEGARA']; ?> - <?= $rowKDN['URAIAN_NEGARA']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <input type="hidden" name="NOAJU" value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="UKodeNegara_" class="btn btn-default"><i class="fas fa-edit"></i> Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Kode Negara -->

                                        <!-- Add -->
                                        <div class="modal fade" id="add<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Tambah Data] Data Gate In</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <h4>PLB</h4>
                                                                        </div>
                                                                    </div>
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
                                                                                    <option value="">Pilih Nomor Pengajuan GB</option>
                                                                                <?php } else { ?>
                                                                                    <option value="">Pilih Nomor Pengajuan GB</option>
                                                                                <?php } ?>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT plb.NOMOR_AJU,rcd.bk_no_aju_sarinah FROM tpb_header AS plb
                                                                                                            LEFT JOIN rcd_status AS rcd ON plb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                                                                            WHERE rcd.bk_no_aju_sarinah IS NULL
                                                                                                            ORDER BY plb.ID DESC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['NOMOR_AJU'] ?>"><?= $RowMitra['NOMOR_AJU'] ?> </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Petugas <?= $resultSetting['company'] ?></label>
                                                                            <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Gate In <small style="color:red">*</small></label>
                                                                            <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Masuk ..." required>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Gate In -->
                                                                    <div class="col-md-12">
                                                                        <font style="color: red;">*</font> <i>Wajib diisi.</i>
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
                                                            <h4 class="modal-title">[Edit Data] Gate In</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <h4>PLB</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nomor Pengajuan PLB</label>
                                                                            <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nomor Pengajuan GB</label>
                                                                            <select name="bk_aju" class="default-select2 form-control" required>
                                                                                <?php if ($row['bk_no_aju_sarinah'] != NULL) { ?>
                                                                                    <option value="<?= $row['bk_no_aju_sarinah']; ?>"><?= $row['bk_no_aju_sarinah']; ?></option>
                                                                                    <option value="">Pilih Nomor Pengajuan GB</option>
                                                                                <?php } else { ?>
                                                                                    <option value="">Pilih Nomor Pengajuan GB</option>
                                                                                <?php } ?>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT plb.NOMOR_AJU,rcd.bk_no_aju_sarinah FROM tpb_header AS plb
                                                                                                            LEFT JOIN rcd_status AS rcd ON plb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                                                                            WHERE rcd.bk_no_aju_sarinah IS NULL
                                                                                                            ORDER BY plb.ID DESC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['NOMOR_AJU'] ?>"><?= $RowMitra['NOMOR_AJU'] ?> </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Petugas <?= $resultSetting['company'] ?></label>
                                                                            <?php if ($row['bm_nama_operator'] == NULL) { ?>
                                                                                <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                            <?php } else { ?>
                                                                                <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bm_nama_operator'] ?>" readonly>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Gate In</label>
                                                                            <?php
                                                                            $tgl_msk = $row['bm_tgl_masuk'];
                                                                            $tgl = substr($tgl_msk, 0, 10);
                                                                            $time = substr($tgl_msk, 10, 20);
                                                                            ?>
                                                                            <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Masuk ..." value="<?= $tgl; ?>">
                                                                            <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                        </div>
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
                                                            <h4 class="modal-title">[Upload Data] Berita Acara</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Petugas BeaCukai <font style="color: red;">*</font></label>
                                                                            <input type="text" name="bk_nama_operator" class="form-control" placeholder="Nama Petugas BeaCukai ..." required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                                <label>Upload Berita Acara Kembali!</label>
                                                                            <?php } else { ?>
                                                                                <label>Upload Berita Acara <font style="color: red;">*</font></label>
                                                                            <?php } ?>
                                                                            <input type="file" name="uploadBA" class="form-control" placeholder="Upload Berita Acara ..." value="<?= $row['upload_beritaAcara_PLB']; ?>" required>
                                                                            <input type="hidden" name="rcd_id" class="form-control" value="<?= $row['rcd_id']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <font style="color: red;">*</font> <i>Wajib diisi.</i>
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
                                                            <h4 class="modal-title">[Detail Data] Gate In</h4>
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
                                                                    <!-- Gate In -->
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
                                                                                    <label>Nomor Pengajuan GB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bk_no_aju_sarinah']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Petugas <?= $resultSetting['company'] ?></label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bm_nama_operator']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Gate In</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bm_tgl_masuk'];
                                                                                    $tgl = substr($tgl_msk, 0, 10);
                                                                                    $time = substr($tgl_msk, 10, 20);
                                                                                    ?>
                                                                                    <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Masuk ..." value="<?= $tgl; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Petugas BC</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bc_in']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Gate In -->
                                                                    <!-- Barang Keluar -->
                                                                    <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                        <div class="col-6">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <embed src="files/ck5plb/BA/PLB/<?= $row['upload_beritaAcara_PLB']; ?>" style="width: 100%" height="500">
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
                                        <td colspan="8">
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
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
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
    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: 'Data berhasil disimpan!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal disimpan!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: 'Data berhasil diupdate!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal diupdate!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    // UPLOAD EXT TIDAK SESUAI!
    if (window?.location?.href?.indexOf('UploadQuestion') > -1) {
        Swal.fire({
            title: 'Perhatikan Extensions File!',
            icon: 'info',
            html: 'Extensions File Tidak Sesuai, Silahkan Pilih Extensions File <b>.xlsx</b> atau <b>xls</b>!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
</script>