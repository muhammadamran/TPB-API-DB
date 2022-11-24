<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// FUNCTION SEARCHING
$Field_MASUK          = '';
$Field_KELUAR         = '';
$ShowField_MASUK      = '';
$ShowField_KELUAR     = '';
$info_filter          = "100 Data Terakhir Posisi Barang";

// MASUK
if (isset($_POST["Find_MASUK"])) {
    $Field_MASUK      = $_POST['default-daterange-masuk'];
    $Field_MASUKE     = explode(" - ", $Field_MASUK);
    $MASUKStart       = $Field_MASUKE[0];
    $MASUKStart_T     = strtotime($MASUKStart);
    $S_MASUK          = date("Y-m-d", $MASUKStart_T);
    $MASUKEnd         = $Field_MASUKE[1];
    $MASUKEnd_T       = strtotime($MASUKEnd);
    $E_MASUK          = date("Y-m-d", $MASUKEnd_T);
    $ShowField_MASUK  = "Tanggal Masuk: " . $_POST['default-daterange-masuk'];
    // OTHERS
    $info_filter    = "Data Berdasarkan Tgl. Barang Masuk";
}

// KELUAR
if (isset($_POST["Find_KELUAR"])) {
    $Field_KELUAR      = $_POST['default-daterange-keluar'];
    $Field_KELUARE     = explode(" - ", $Field_KELUAR);
    $KELUARStart       = $Field_KELUARE[0];
    $KELUARStart_T     = strtotime($KELUARStart);
    $S_KELUAR          = date("Y-m-d", $KELUARStart_T);
    $KELUAREnd         = $Field_KELUARE[1];
    $KELUAREnd_T       = strtotime($KELUAREnd);
    $E_KELUAR          = date("Y-m-d", $KELUAREnd_T);
    $ShowField_KELUAR  = "Tanggal Keluar: " . $_POST['default-daterange-keluar'];
    // OTHERS
    $info_filter    = "Data Berdasarkan Tgl. Barang Keluar";
}

// START TANGGAL BARANG MASUK
// TANGGAL MASUK FIRST
$dataRangeFirstMasuk    = $dbcon->query("SELECT plb.TGL_CEK FROM rcd_status AS rcd 
                                        LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                        LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                        LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                        WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                        ORDER BY plb.TGL_CEK ASC LIMIT 1");
$resultRangeFirstMasuk  = mysqli_fetch_array($dataRangeFirstMasuk);
if ($resultRangeFirstMasuk != NULL) {
    $iniMasukFirst          = $resultRangeFirstMasuk['TGL_CEK'];
    $alldateMasukFirst      = $iniMasukFirst;
    $tglMFirst              = substr($alldateMasukFirst, 0, 10);
    $tglMFirstE             = explode("-", $tglMFirst);
    $RMFirst                = $tglMFirstE[1] . "/" . $tglMFirstE[2] . "/" . $tglMFirstE[0];
}
// TANGGAL MASUK LAST
$dataRangeLastMasuk     = $dbcon->query("SELECT plb.TGL_CEK FROM rcd_status AS rcd 
                                        LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                        LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                        LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                        WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                        ORDER BY plb.TGL_CEK DESC LIMIT 1");
$resultRangeLastMasuk   = mysqli_fetch_array($dataRangeLastMasuk);
if ($resultRangeLastMasuk != NULL) {
    $iniMasukLast           = $resultRangeLastMasuk['TGL_CEK'];
    $alldateMasukLast       = $iniMasukLast;
    $tglMLast               = substr($alldateMasukLast, 0, 10);
    $tglMLastE              = explode("-", $tglMLast);
    $RMLast                 = $tglMLastE[1] . "/" . $tglMLastE[2] . "/" . $tglMLastE[0];
}
// END TANGGAL BARANG MASUK

// START TANGGAL BARANG KELUAR
// TANGGAL KELUAR FIRST
$dataRangeFirstKeluar    = $dbcon->query("SELECT plb.TGL_CEK_GB FROM rcd_status AS rcd 
                                        LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                        LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                        LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                        WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND plb.STATUS_GB='Sesuai'
                                        ORDER BY plb.TGL_CEK_GB ASC LIMIT 1");
$resultRangeFirstKeluar  = mysqli_fetch_array($dataRangeFirstKeluar);
if ($resultRangeFirstKeluar != NULL) {
    $iniKeluarFirst          = $resultRangeFirstKeluar['TGL_CEK_GB'];
    $alldateKeluarFirst      = $iniKeluarFirst;
    $tglKFirst              = substr($alldateKeluarFirst, 0, 10);
    $tglKFirstE             = explode("-", $tglKFirst);
    $RKFirst                = $tglKFirstE[1] . "/" . $tglKFirstE[2] . "/" . $tglKFirstE[0];
}
// TANGGAL KELUAR LAST
$dataRangeLastKeluar     = $dbcon->query("SELECT plb.TGL_CEK_GB FROM rcd_status AS rcd 
                                        LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                        LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                        LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                        WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND plb.STATUS_GB='Sesuai'
                                        ORDER BY plb.TGL_CEK_GB DESC LIMIT 1");
$resultRangeLastKeluar   = mysqli_fetch_array($dataRangeLastKeluar);
if ($resultRangeLastKeluar != NULL) {
    $iniKeluarLast           = $resultRangeLastKeluar['TGL_CEK_GB'];
    $alldateKeluarLast       = $iniKeluarLast;
    $tglKLast               = substr($alldateKeluarLast, 0, 10);
    $tglKLastE              = explode("-", $tglKLast);
    $RKLast                 = $tglKLastE[1] . "/" . $tglKLastE[2] . "/" . $tglKLastE[0];
}
// END TANGGAL BARANG KELUAR

if (isset($_POST['Find_MASUK']) != '') {
    $displayTGLMASUK   = 'show';
    $displayTGLKELUAR  = 'none';

    $selectTGLMASUK    = 'selected';
    $selectTGLKELUAR   = '';
} else if (isset($_POST['Find_KELUAR']) != '') {
    $displayTGLMASUK   = 'none';
    $displayTGLKELUAR  = 'show';

    $selectTGLMASUK    = '';
    $selectTGLKELUAR   = 'selected';
} else {
    $displayTGLMASUK   = 'show';
    $displayTGLKELUAR  = 'none';

    $selectTGLMASUK    = 'selected';
    $selectTGLKELUAR   = '';
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Posisi Barang App Name | Company </title>
<?php } else { ?>
    <title>Laporan Posisi Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-map-location icon-page"></i>
                <font class="text-page">Laporan Posisi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Posisi Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Posisi Berdasarkan
                        <select name="Filter" id="input-filter" style="background: #202124;color: #fff;font-weight: 800;border-color: transparent;">
                            <option value="TGLMASUK" <?= $selectTGLMASUK ?>>Range Tanggal Masuk</option>
                            <option value="TGLKELUAR" <?= $selectTGLKELUAR ?>>Range Tanggal Keluar</option>
                        </select>
                    </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- Tanggal Upload -->
                    <div id="form_MASUK" style="display: <?= $displayTGLMASUK ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 57%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Masuk</label>
                                            <div class="input-group" id="default-daterange-masuk">
                                                <input type="text" name="default-daterange-masuk" class="form-control" value="<?= $Field_MASUK ?>" placeholder="Pilih Range Tanggal Masuk" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_MASUK" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_posisi_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tanggal Keluar -->
                    <div id="form_KELUAR" style="display: <?= $displayTGLKELUAR ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 57%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Keluar</label>
                                            <div class="input-group" id="default-daterange-keluar">
                                                <input type="text" name="default-daterange-keluar" class="form-control" value="<?= $Field_KELUAR ?>" placeholder="Pilih Range Tanggal Keluar" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_KELUAR" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_posisi_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->

    <!-- Begin Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row" style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;padding: 25px;margin: 10px;">
                    <?php if (isset($_POST["Find_MASUK"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <!-- <div>
                                    <form action="report_posisi_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_MASUK" value="<?= $S_MASUK ?>">
                                        <input type="hidden" name="E_MASUK" value="<?= $E_MASUK ?>">
                                        <input type="hidden" name="ShowField_MASUK" value="<?= $ShowField_MASUK ?>">
                                        <button type="submit" name="Find_MASUK" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div> -->
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 5px 0 0 5px ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_posisi_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_MASUK" value="<?= $S_MASUK ?>">
                                            <input type="hidden" name="E_MASUK" value="<?= $E_MASUK ?>">
                                            <input type="hidden" name="ShowField_MASUK" value="<?= $ShowField_MASUK ?>">
                                            <button type="submit" name="Find_MASUK" class="dropdown-item">Download as XLS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_KEUAR"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <!-- <div>
                                    <form action="report_posisi_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_KELUAR" value="<?= $S_KELUAR ?>">
                                        <input type="hidden" name="E_KELUAR" value="<?= $E_KELUAR ?>">
                                        <input type="hidden" name="ShowField_KELUAR" value="<?= $ShowField_KELUAR ?>">
                                        <button type="submit" name="Find_KELUAR" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div> -->
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 5px 0 0 5px ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_posisi_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_KELUAR" value="<?= $S_KELUAR ?>">
                                            <input type="hidden" name="E_KELUAR" value="<?= $E_KELUAR ?>">
                                            <input type="hidden" name="ShowField_KELUAR" value="<?= $ShowField_KELUAR ?>">
                                            <button type="submit" name="Find_KELUAR" class="dropdown-item">Download as XLS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <!-- <div>
                                    <a href="report_posisi_barang_pdf.php" target="_blank" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</a>
                                </div> -->
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 5px 0 0 5px ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="report_posisi_barang_excel.php" target="_blank" class="dropdown-item">Download as XLS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-3 m-b-20">
                        <div style="display: flex;justify-content: center;">
                            <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                <img src="assets/images/logo/logo-default.png" width="30%">
                            <?php } else { ?>
                                <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9" style="display: grid;justify-content: left;">
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN POSISI BARANG PER DOKUMEN PABEAN</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            <?= $ShowField_MASUK; ?>
                            <?= $ShowField_KELUAR; ?>
                        </font>
                        <div class="line-page-table"></div>
                        <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                        <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                        </font>
                    </div>
                    <div class="col-md-12" style="margin-bottom: -40px;">
                        <hr>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <!-- BARANG MASUK -->
                                    <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
                                    <th colspan="2" style="text-align: center;">Tanggal & Waktu</th>
                                    <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
                                    <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
                                    <th colspan="2" style="text-align: center;">Petugas</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Berita Acara</th>
                                    <!-- END BARANG MASUK -->
                                    <!-- BARANG KELUAR -->
                                    <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 GB</th>
                                    <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
                                    <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal<font style="color: #dadddf;">.</font>&<font style="color: #dadddf;">.</font>Waktu<font style="color: #dadddf;">.</font>Keluar</th>
                                    <th colspan="2" style="text-align: center;">Petugas</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Berita Acara</th>
                                    <!-- END BARANG MASUK -->
                                </tr>
                                <tr>
                                    <!-- BARANG MASUK -->
                                    <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">No.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Upload<font style="color: #dadddf;">.</font>PLB</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Masuk<font style="color: #dadddf;">.</font>Barang</th>
                                    <th style="text-align: center;"><?= $resultSetting['company']; ?></th>
                                    <th style="text-align: center;">BeaCukai</th>
                                    <!-- END BARANG MASUK -->
                                    <!-- BARANG KELUAR -->
                                    <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
                                    <th style="text-align: center;">Nomor<font style="color: #dadddf;">.</font>Pengajuan</th>
                                    <th style="text-align: center;">No.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <th style="text-align: center;"><?= $resultSetting['company']; ?></th>
                                    <th style="text-align: center;">BeaCukai</th>
                                    <!-- END BARANG MASUK -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["Find_MASUK"])) {
                                    $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                AND brg.TGL_CEK BETWEEN '" . $S_MASUK . "' AND '" . $E_MASUK . " 23:59:59'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC", 0);
                                } else if (isset($_POST["Find_KELUAR"])) {
                                    $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                AND brg.TGL_CEK_GB BETWEEN '" . $S_KELUAR . "' AND '" . $E_KELUAR . " 23:59:59'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC LIMIT 100", 0);
                                }

                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- BARANG MASUK -->
                                            <td style="text-align: center">
                                                BC <?= $row['KODE_DOKUMEN_PABEAN_BCPLB']; ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU_BCPLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_BCPLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_DAFTAR_BCPLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR_BCPLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['PERUSAHAAN']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 100px;">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG_BCPLB'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG_BCPLB']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?php
                                                        $alldate = $row['ck5_plb_submit'];
                                                        $tgl = substr($alldate, 0, 10);
                                                        $time = substr($alldate, 10, 20);
                                                        ?>
                                                        <?= date_indo_s($tgl) ?> <?= $time ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php
                                                    $alldateM = $row['TGL_CEK'];
                                                    $tglM = substr($alldateM, 0, 10);
                                                    $timeM = substr($alldateM, 10, 20);
                                                    ?>
                                                    <?php if ($row['TGL_CEK'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= date_indo_s($tglM); ?> <?= $timeM; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php
                                                if ($row['KODE_BARANG'] == NULL) {
                                                    $KDBRG = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $KDBRG = $row['KODE_BARANG'];
                                                }
                                                if ($row['POS_TARIF'] == NULL) {
                                                    $POSTARIF = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $POSTARIF = $row['POS_TARIF'];
                                                }
                                                ?>
                                                <?= $KDBRG ?>
                                            </td>
                                            <td>
                                                <div style="width: 280px;">
                                                    <?= $row['URAIAN']; ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?= $row['SPESIFIKASI_LAIN']; ?>
                                            </td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_SATUAN']; ?></font>
                                                    <?php
                                                    $myString = $row['JUMLAH_SATUAN'];
                                                    if (strstr($myString, '.0000')) {
                                                        echo  "<font>" . $row['JUMLAH_SATUAN'] . "</font>";
                                                    } else {
                                                        echo  "<font>" . $row['JUMLAH_SATUAN'] . ".0000</font>";
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_VALUTA']; ?></font>
                                                    <font><?= $row['CIF']; ?></font>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['OPERATOR_ONE']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['bc_in'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['bc_in']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['upload_beritaAcara_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Belum diupload!</i></font>
                                                <?php } else { ?>
                                                    <a href="#detailIN<?= $row['rcd_id'] ?>" class="btn btn-sm btn-success" data-toggle="modal" title="Add">
                                                        <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lihat Berita Acara: <?= $row['NOMOR_AJU'] ?>">
                                                            <div>
                                                                <div style="font-size: 12px;">
                                                                    <i class="fas fa-file-invoice"></i>
                                                                </div>
                                                            </div>
                                                        </font>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <!-- END BARANG MASUK -->
                                            <!-- BARANG KELUAR -->
                                            <td style="text-align: center">
                                                BC <?= $row['KODE_DOKUMEN_PABEAN_BCGB']; ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU_BCGB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_BCGB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <div style="width: 80px;">
                                                    <?php if ($row['NOMOR_DAFTAR_BCGB'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['NOMOR_DAFTAR_BCGB']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 100px;">
                                                    <?php if ($row['NAMA_PENGUSAHA'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENGUSAHA']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG_BCGB'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG_BCGB']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php
                                                if ($row['KODE_BARANG'] == NULL) {
                                                    $KDBRG = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $KDBRG = $row['KODE_BARANG'];
                                                }
                                                if ($row['POS_TARIF'] == NULL) {
                                                    $POSTARIF = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $POSTARIF = $row['POS_TARIF'];
                                                }
                                                ?>
                                                <?= $KDBRG ?>
                                            </td>
                                            <td>
                                                <div style="width: 280px;">
                                                    <?= $row['URAIAN']; ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?= $row['SPESIFIKASI_LAIN']; ?>
                                            </td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_SATUAN']; ?></font>
                                                    <?php
                                                    $myString = $row['JUMLAH_SATUAN'];
                                                    if (strstr($myString, '.0000')) {
                                                        echo  "<font>" . $row['JUMLAH_SATUAN'] . "</font>";
                                                    } else {
                                                        echo  "<font>" . $row['JUMLAH_SATUAN'] . ".0000</font>";
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_VALUTA']; ?></font>
                                                    <font><?= $row['CIF']; ?></font>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['TGL_CEK_GB'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['TGL_CEK_GB']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['OPERATOR_ONE']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['bc_out'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['bc_out']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['upload_beritaAcara_GB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Belum diupload!</i></font>
                                                <?php } else { ?>
                                                    <a href="#detailOUT<?= $row['rcd_id'] ?>" class="btn btn-sm btn-success" data-toggle="modal" title="Add">
                                                        <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lihat Berita Acara: <?= $row['NOMOR_AJU'] ?>">
                                                            <div>
                                                                <div style="font-size: 12px;">
                                                                    <i class="fas fa-file-invoice"></i>
                                                                </div>
                                                            </div>
                                                        </font>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <!-- END BARANG KELUAR -->
                                        </tr>

                                        <!-- Detail IN -->
                                        <div class="modal fade" id="detailIN<?= $row['rcd_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Berita Acara] Laporan Posisi Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Pengajuan PLB</label>
                                                                        <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bm_no_aju_plb']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Pengajuan GB</label>
                                                                        <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_no_aju_sarinah']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Tanggal Masuk Barang</label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bm_tgl_masuk']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Petugas <?= $resultSetting['company']; ?></label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bm_nama_operator']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Petugas BeaCukai</label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bc_in']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                        <div style="font-size: 30px;">
                                                                            <i class="fas fa-file-pdf"></i>
                                                                        </div>
                                                                        <div style="margin-left: 10px;">
                                                                            <div style="font-size: 17px;font-weight: 900;">
                                                                                Dokumen Berita Acara
                                                                            </div>
                                                                            <div style="margin-top: -5px;font-size: 10px;">
                                                                                Lampiran Gate In
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <embed src="files/ck5plb/BA/PLB/<?= $row['upload_beritaAcara_PLB']; ?>" style="width: 100%" height="500">
                                                                        </object>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail IN -->
                                        <!-- Detail OUT -->
                                        <div class="modal fade" id="detailOUT<?= $row['rcd_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Berita Acara] Laporan Posisi Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Pengajuan PLB</label>
                                                                        <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['bm_no_aju_plb']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Pengajuan GB</label>
                                                                        <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_no_aju_sarinah']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Tanggal Masuk Barang</label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_tgl_keluar']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Petugas <?= $resultSetting['company']; ?></label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_nama_operator']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Petugas BeaCukai</label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bc_out']; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                        <div style="font-size: 30px;">
                                                                            <i class="fas fa-file-pdf"></i>
                                                                        </div>
                                                                        <div style="margin-left: 10px;">
                                                                            <div style="font-size: 17px;font-weight: 900;">
                                                                                Dokumen Berita Acara
                                                                            </div>
                                                                            <div style="margin-top: -5px;font-size: 10px;">
                                                                                Lampiran Gate Out
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <embed src="files/ck5plb/BA/GB/<?= $row['upload_beritaAcara_GB']; ?>" style="width: 100%" height="500">
                                                                        </object>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail OUT -->
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="31">
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
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Posisi Barang | <?= $resultHeadSetting['app_name'] ?> <?= $resultHeadSetting['company'] ?>
                        </p>
                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                                <?= $resultHeadSetting['website'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Begin Row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>
<script type="text/javascript">
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "TGLMASUK") {
                $("#form_MASUK").show();
                $("#form_KELUAR").hide();
            } else if ($(this).val() == "TGLKELUAR") {
                $("#form_MASUK").hide();
                $("#form_KELUAR").show();
            } else {
                $("#form_MASUK").show();
                $("#form_KELUAR").hide();
            }
        });
    });
    var handleDateRangePicker = function() {
        // RANGE TANGGAL MASUK
        $('#default-daterange-masuk').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RMFirst ?>',
            maxDate: '<?= $RMLast ?>',
        }, function(start, end) {
            $('#default-daterange-masuk input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        // RANGE TANGGAL KELUAR
        $('#default-daterange-keluar').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RKFirst ?>',
            maxDate: '<?= $RKLast ?>',
        }, function(start, end) {
            $('#default-daterange-keluar input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
    };
</script>