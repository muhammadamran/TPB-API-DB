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

if (isset($_POST['edit_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bk_tgl_keluar          = $_POST['bk_tgl_keluar'];
    $bk_nama_operator       = $_POST['bk_nama_operator'];

    $sql = $dbcon->query("UPDATE rcd_status SET bk_tgl_keluar='$bk_tgl_keluar',
                                                bk_nama_operator='$bk_nama_operator'
                                            WHERE rcd_id='$rcd_id'");

    if ($sql) {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['upload_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bk_nama_operator       = $_POST['bk_nama_operator'];
    // File
    $filename               = $_FILES['uploadBA']['name'];
    $tmpname                = $_FILES['uploadBA']['tmp_name'];
    $sizename               = $_FILES['uploadBA']['size'];
    $exp                    = explode('.', $filename);
    $ext                    = end($exp);
    $uniq_file              =  "Berita-Acara-GB" . '_' . time();
    $newname                =  "Berita-Acara-GB" . '_' . time() . "." . $ext;
    $config['upload_path']      = './files/ck5plb/BA/GB/';
    $config['allowed_types']    = "jpg|jpeg|png|jfif|gif|pdf";
    $config['max_size']         = '2000000';
    $config['file_name']        = $newname;
    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'jfif' || $ext == 'gif' || $ext == 'pdf') {
        move_uploaded_file($tmpname, "files/ck5plb/BA/GB/" . $newname);

        $sql = $dbcon->query("UPDATE rcd_status SET upload_beritaAcara_GB='$newname',
                                            bc_out='$bk_nama_operator'
                                            WHERE rcd_id='$rcd_id'");
    } else {
        echo "<script>window.location.href='gm_pengeluaran.php?UploadQuestion=true';</script>";
    }
    if ($sql) {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran.php?SaveFailed=true';</script>";
    }
}

// Find
if (isset($_POST['filter'])) {
    if ($_POST["AJU_GB"] != '') {
        $AJU_GB   = $_POST['AJU_GB'];
    }
}

if (isset($_POST['show_all'])) {
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Gate Out App Name | Company </title>
<?php } else { ?>
    <title>Gate Out - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
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
                <li class="breadcrumb-item active">Gate Out</li>
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
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Find Data Gate Out</h4>
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
                                        <label>BC 2.7 GB (Nomor Pengajuan)</label>
                                        <input type="text" id="IDAJU_GB" name="AJU_GB" class="form-control" placeholder="BC 2.7 GB (Nomor Pengajuan) ..." value="<?= $AJU_GB; ?>">
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
                    <h4 class="panel-title"><i class="fa fa-info-circle"></i> [Gate Mandiri] Data Gate Out</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <!-- begin alert -->
                <div class="alert alert-secondary fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Jika Barang <b>Gate Out</b> sudah disimpan, silahkan lengkapi <b>Tanggal Gate Out</b> dan <b>Upload Berita Acara</b></p>
                    <p>
                        Note:
                    <ul>
                        <li>Lakukan penyelesaian pengecekan <b>Barang Gate Out</b> pada setiap <b>Nomor Pengajuan BC 2.7 GB</b> yang telah diupload.</li>
                        <li>
                            Jika <b>Barang Gate Out</b> pada setiap <b>Nomor Pengajuan BC 2.7 GB</b> sudah sesuai, lengkapi <b>Tanggal Gate Out</b>.
                            <ul>
                                <li> Jika <b>Tanggal Gate Out</b> sudah di lengkapi, silahkan lihat <b>Laporan Keluar <?= $resultSetting['app_name'] ?></b>;</li>
                                <li> Jika <b>Tanggal Gate Out</b> sudah di lengkapi, silahkan lihat <b>Laporan Mutasi <?= $resultSetting['app_name'] ?></b>;</li>
                            </ul>
                        </li>
                        <li>
                            Jika <b>Tanggal Gate Out</b> sudah di lengkapi, silahkan <b>Upload Berita Acara Gate Out</b> dan <b>Isi Nama Petugas BeaCukai</b> yang mengawasi.
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
                        <table id="TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="3" class="text-nowrap no-sort" style="text-align: center;">BC 2.7 Pusat Logistik Berikat (PLB)</th>
                                    <th colspan="3" class="text-nowrap no-sort" style="text-align: center;">BC 2.7 Gudang Berikat (GB)</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Kode Negara</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Status</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- PLB -->
                                    <th class="text-nowrap no-sort" style="text-align: center;">Nomor Pengajuan</th>
                                    <!-- <th class="text-nowrap" style="text-align: center;">Tanggal Upload</th> -->
                                    <th class="text-nowrap no-sort" style="text-align: center;">Asal</th>
                                    <th class="text-nowrap" style="text-align: center;">Tujuan</th>
                                    <!-- GB -->
                                    <th class="text-nowrap no-sort" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Asal</th>
                                    <th class="text-nowrap" style="text-align: center;">Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['filter'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
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
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL AND rcd.bk_no_aju_sarinah LIKE '%" . $_POST['AJU_GB'] . "%'
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC", 0);
                                } else if (isset($_POST['show_all'])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
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
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL
                                                                -- END
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
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
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL
                                                                -- END
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC LIMIT 100", 0);
                                }
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <!-- NOMOR AJU PLB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_PLB = $row['TGL_AJU_PLB'];
                                                $dataTGLAJU_PLBY = substr($dataTGLAJU_PLB, 0, 4);
                                                $dataTGLAJU_PLBM = substr($dataTGLAJU_PLB, 4, 2);
                                                $dataTGLAJU_PLBD = substr($dataTGLAJU_PLB, 6, 2);

                                                $datTGLAJU_PLB = $dataTGLAJU_PLBY . '-' . $dataTGLAJU_PLBM . '-' . $dataTGLAJU_PLBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bm_no_aju_plb']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_PLB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- TANGGAL UPLOAD PLB -->
                                            <!-- <td style="text-align: left">
                                                <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?php
                                                    $alldate = $row['ck5_plb_submit'];
                                                    $tgl = substr($alldate, 0, 10);
                                                    $time = substr($alldate, 10, 20);
                                                    ?>
                                                    <div style="width:200px">
                                                        <?= date_indo_s($tgl, TRUE); ?> - <?= $time ?>
                                                    </div>
                                                <?php } ?>
                                            </td> -->
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 280px;">
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
                                            <!-- NAMA PENERIMA BARANG PLB -->
                                            <td style="text-align: left">
                                                <div style="width:200px">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- NOMOR AJU GB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_TPB = $row['TGL_AJU_GB'];
                                                $dataTGLAJU_TPBY = substr($dataTGLAJU_TPB, 0, 4);
                                                $dataTGLAJU_TPBM = substr($dataTGLAJU_TPB, 4, 2);
                                                $dataTGLAJU_TPBD =  substr($dataTGLAJU_TPB, 6, 2);

                                                $datTGLAJU_TPB = $dataTGLAJU_TPBY . '-' . $dataTGLAJU_TPBM . '-' . $dataTGLAJU_TPBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bk_no_aju_sarinah']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_TPB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 110px;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_PENGUSAHA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- NAMA PENERIMA BARANG GB -->
                                            <td style="text-align: left">
                                                <div style="width:150px">
                                                    <?= $row['NAMA_PENERIMA_BARANG_GB']; ?>
                                                </div>
                                            </td>
                                            <!-- NEGARA PEMASOK PLB -->
                                            <td style="text-align: center">
                                                <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                            </td>
                                            <td style="text-align: center">
                                                <div style="width: 100px">
                                                    <?php if ($row['STATUS'] == $row['JUMLAH_BARANG']) { ?>
                                                        <?php if ($row['upload_beritaAcara_GB'] == NULL) { ?>
                                                            <span class="badge-dot badge-upload mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Upload Berita Acara -> <?= $row['NAMA_PENGUSAHA'] ?>"></span> Upload Berita Acara
                                                        <?php } else { ?>
                                                            <span class="badge-dot badge-complete mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Complete"></span> Complete
                                                        <?php } ?>
                                                    <?php } else if ($row['STATUS'] > 0) { ?>
                                                        <span class="badge-dot badge-on-progress mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Proses Pengecekan Barang -> <?= $row['NAMA_PENGUSAHA']; ?>, Sisa Barang <?= $row['JUMLAH_BARANG'] - $row['STATUS']; ?>"></span> On Process
                                                    <?php } else if ($row['STATUS'] == NULL || $row['STATUS'] == 0) { ?>
                                                        <span class="badge-dot badge-need-checking mr-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Cek Barang Masuk -> <?= $row['NAMA_PENGUSAHA']; ?>, Jumlah Barang <?= $row['JUMLAH_BARANG']; ?>"></span> Check
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- AKSI -->
                                            <td style="text-align: left;">
                                                <div style="width:150px">
                                                    <?php if ($row['total_All'] == $row['JUMLAH_BARANG']) { ?>
                                                        <!-- Cek Done -->
                                                        <a href="gm_pengeluaran_detail.php?AJU=<?= $row['bm_no_aju_plb'] ?>" class="btn btn-sm btn-success">
                                                            <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Pengecekan Barang Gate Out Selesai, Klik jika ingin melihat Detil">
                                                                <div style="display: grid;">
                                                                    <div style="font-size: 12px;">
                                                                        <i class="fas fa-check-circle"></i>
                                                                    </div>
                                                                </div>
                                                            </font>
                                                        </a>
                                                        <!-- End Cek Done -->
                                                        <?php if ($row['bk_no_aju_sarinah'] == NULL) { ?>
                                                            <!-- Add -->
                                                            <a href="#add<?= $row['IDH'] ?>" class="btn btn-sm btn-primary" data-toggle="modal">
                                                                <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tambah Data Gate Out">
                                                                    <div>
                                                                        <div style="font-size: 12px;">
                                                                            <i class="fas fa-plus-circle"></i>
                                                                        </div>
                                                                    </div>
                                                                </font>
                                                            </a>
                                                            <!-- End Add -->
                                                        <?php } else { ?>
                                                            <?php if ($row['upload_beritaAcara_GB'] == NULL) { ?>
                                                                <!-- Edit -->
                                                                <a href="#edit<?= $row['IDH'] ?>" class="btn btn-sm btn-info" data-toggle="modal">
                                                                    <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Edit Data Gate Out">
                                                                        <div>
                                                                            <div style="font-size: 12px;">
                                                                                <i class="fas fa-edit"></i>
                                                                            </div>
                                                                        </div>
                                                                    </font>
                                                                </a>
                                                                <!-- End Edit -->
                                                                <!-- Upload -->
                                                                <a href="#upload<?= $row['IDH'] ?>" class="btn btn-sm btn-warning" data-toggle="modal">
                                                                    <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Upload Berita Acara Gate Out">
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
                                                                <a href="#detail<?= $row['IDH'] ?>" class="btn btn-sm btn-success" data-toggle="modal">
                                                                    <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lihat Detail Data Gate Out">
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
                                                        <a href="gm_pengeluaran_detail.php?AJU=<?= $row['bm_no_aju_plb']; ?>" class="btn btn-sm btn-yellow">
                                                            <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lakukan Pengecekan Barang Gate Out">
                                                                <div>
                                                                    <div style="font-size: 12px;">
                                                                        <i class="fas fa-warning"></i>
                                                                    </div>
                                                                </div>
                                                            </font>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Add -->
                                        <div class="modal fade" id="add<?= $row['IDH'] ?>">
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
                                        <div class="modal fade" id="edit<?= $row['IDH'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Edit Data] Gate Out</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <h4>PLB</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <h4>GB</h4>
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
                                                                            <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bk_no_aju_sarinah']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Petugas <?= $resultSetting['company'] ?></label>
                                                                            <?php if ($row['bk_nama_operator'] == NULL) { ?>
                                                                                <input type="text" name="bk_nama_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                            <?php } else { ?>
                                                                                <input type="text" name="bk_nama_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $row['bk_nama_operator'] ?>" readonly>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Gate Out <font style="color: red;">*</font></label>
                                                                            <?php
                                                                            $tgl_msk = $row['bk_tgl_keluar'];
                                                                            $tgl = substr($tgl_msk, 0, 10);
                                                                            $time = substr($tgl_msk, 10, 20);
                                                                            ?>
                                                                            <input type="date" name="bk_tgl_keluar" class="form-control" placeholder="Tanggal Keluar ..." value="<?= $tgl; ?>" required>
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
                                        <div class="modal fade" id="upload<?= $row['IDH'] ?>">
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
                                                                            <?php if ($row['upload_beritaAcara_GB'] != NULL) { ?>
                                                                                <label>Upload Berita Acara Kembali!</label>
                                                                            <?php } else { ?>
                                                                                <label>Upload Berita Acara <font style="color: red;">*</font></label>
                                                                            <?php } ?>
                                                                            <input type="file" name="uploadBA" class="form-control" placeholder="Upload Berita Acara ..." value="<?= $row['upload_beritaAcara_GB']; ?>" required>
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
                                        <div class="modal fade" id="detail<?= $row['IDH'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Detail Data] Gate Out</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <?php if ($row['upload_beritaAcara_GB'] != NULL) { ?>
                                                                        <?php $col = '6'; ?>
                                                                    <?php } else { ?>
                                                                        <?php $col = '12'; ?>
                                                                    <?php } ?>
                                                                    <!-- Gate In -->
                                                                    <div class="col-<?= $col; ?>">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <h4>GB</h4>
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
                                                                                    <label>Tanggal Gate Out</label>
                                                                                    <?php
                                                                                    $tgl_msk = $row['bk_tgl_keluar'];
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
                                                                    <?php if ($row['upload_beritaAcara_GB'] != NULL) { ?>
                                                                        <div class="col-6">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <embed src="files/ck5plb/BA/GB/<?= $row['upload_beritaAcara_GB']; ?>" style="width: 100%" height="500">
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
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="13">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif ?>
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
        $("#IDAJU_GB").autocomplete({
            source: 'function/autocomplete/nomor_aju_gb.php'
        });
    });
    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: 'Data berhasil disimpan!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal disimpan!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: 'Data berhasil diupdate!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal diupdate!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
    // UPLOAD EXT TIDAK SESUAI!
    if (window?.location?.href?.indexOf('UploadQuestion') > -1) {
        Swal.fire({
            title: 'Perhatikan Extensions File!',
            icon: 'info',
            html: 'Extensions File Tidak Sesuai, Silahkan Pilih Extensions File <b>.xlsx</b> atau <b>xls</b>!'
        })
        history.replaceState({}, '', './gm_pengeluaran.php');
    }
</script>