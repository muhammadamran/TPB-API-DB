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
$FindNoAJU          = '';
$Field_RTU          = '';
$Field_RTM          = '';
$ShowFindNoAJU      = '';
$ShowField_RTU      = '';
$ShowField_RTM      = '';

// RTU
if (isset($_POST["Find_NP"])) {
    $FindNoAJU      = $_POST['FindNoAJU'];
    $ShowFindNoAJU  = "Nomor Pengajuan: " . $_POST['FindNoAJU'];
}

// RTU
if (isset($_POST["Find_RTU"])) {
    $Field_RTU      = $_POST['default-daterange-upload'];
    $Field_RTUE     = explode(" - ", $Field_RTU);
    $RTUStart       = $Field_RTUE[0];
    $RTUStart_T     = strtotime($RTUStart);
    $S_RTU          = date("Y-m-d", $RTUStart_T);
    $RTUEnd         = $Field_RTUE[1];
    $RTUEnd_T       = strtotime($RTUEnd);
    $E_RTU          = date("Y-m-d", $RTUEnd_T);
    $ShowField_RTU  = "Tanggal Upload: " . $_POST['default-daterange-upload'];
}

// RTM
if (isset($_POST["Find_RTM"])) {
    $Field_RTM      = $_POST['default-daterange-masuk'];
    $Field_RTME     = explode(" - ", $Field_RTM);
    $RTMStart       = $Field_RTME[0];
    $RTMStart_T     = strtotime($RTMStart);
    $S_RTM          = date("Y-m-d", $RTMStart_T);
    $RTMEnd         = $Field_RTME[1];
    $RTMEnd_T       = strtotime($RTMEnd);
    $E_RTM          = date("Y-m-d", $RTMEnd_T);
    $ShowField_RTM  = "Tanggal Masuk: " . $_POST['default-daterange-masuk'];
}

// START
// TANGGAL UPLOAD FIRST
$dataRangeFirstUpload   = $dbcon->query("SELECT ck5_plb_submit FROM rcd_status AS rcd 
                                    LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                    LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                    LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                    WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                    ORDER BY sts.ck5_plb_submit ASC LIMIT 1");
$resultRangeFirstUpload = mysqli_fetch_array($dataRangeFirstUpload);
$iniUploadFirst         = $resultRangeFirstUpload['ck5_plb_submit'];
$alldateUploadFirst     = $iniUploadFirst;
$tglUFirst              = substr($alldateUploadFirst, 0, 10);
$tglUFirstE             = explode("-", $tglUFirst);
$RUFirst                = $tglUFirstE[1] . "/" . $tglUFirstE[2] . "/" . $tglUFirstE[0];
// TANGGAL UPLOAD LAST
$dataRangeLastUpload    = $dbcon->query("SELECT ck5_plb_submit FROM rcd_status AS rcd 
                                    LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                    LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                    LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                    WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                    ORDER BY sts.ck5_plb_submit DESC LIMIT 1");
$resultRangeLastUpload  = mysqli_fetch_array($dataRangeLastUpload);
$iniUploadLast          = $resultRangeLastUpload['ck5_plb_submit'];
$alldateUploadLast      = $iniUploadLast;
$tglULast               = substr($alldateUploadLast, 0, 10);
$tglULastE              = explode("-", $tglULast);
$RULast                 = $tglULastE[1] . "/" . $tglULastE[2] . "/" . $tglULastE[0];
// END

// START
// TANGGAL MASUK FIRST
$dataRangeFirstMasuk    = $dbcon->query("SELECT TGL_CEK FROM rcd_status AS rcd 
                                    LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                    LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                    LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                    WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                    ORDER BY plb.TGL_CEK ASC LIMIT 1");
$resultRangeFirstMasuk  = mysqli_fetch_array($dataRangeFirstMasuk);
$iniMasukFirst          = $resultRangeFirstMasuk['TGL_CEK'];
$alldateMasukFirst      = $iniMasukFirst;
$tglMFirst              = substr($alldateMasukFirst, 0, 10);
$tglMFirstE             = explode("-", $tglMFirst);
$RMFirst                = $tglMFirstE[1] . "/" . $tglMFirstE[2] . "/" . $tglMFirstE[0];
// TANGGAL MASUK LAST
$dataRangeLastMasuk     = $dbcon->query("SELECT TGL_CEK FROM rcd_status AS rcd 
                                    LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                    LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                    LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                    WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                    ORDER BY plb.TGL_CEK DESC LIMIT 1");
$resultRangeLastMasuk   = mysqli_fetch_array($dataRangeLastMasuk);
$iniMasukLast           = $resultRangeLastMasuk['TGL_CEK'];
$alldateMasukLast       = $iniMasukLast;
$tglMLast               = substr($alldateMasukLast, 0, 10);
$tglMLastE              = explode("-", $tglMLast);
$RMLast                 = $tglMLastE[1] . "/" . $tglMLastE[2] . "/" . $tglMLastE[0];
// END

if (isset($_POST['Find_NP']) != '') {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
} else if (isset($_POST['Find_RTU']) != '') {
    $displayOne = 'none';
    $displayTwo = 'show';
    $displayThree = 'none';

    $selectOne = '';
    $selectTwo = 'selected';
    $selectThree = '';
} else if (isset($_POST['Find_RTM']) != '') {
    $displayOne = 'none';
    $displayTwo = 'none';
    $displayThree = 'show';

    $selectOne = '';
    $selectTwo = '';
    $selectThree = 'selected';
} else {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Barang Masuk App Name | Company </title>
<?php } else { ?>
    <title>Laporan Barang Masuk - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-circle-down icon-page"></i>
                <font class="text-page">Laporan Barang Masuk</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Masuk Barang Berdasarkan
                        <select name="Filter" id="input-filter" style="background: #202124;color: #fff;font-weight: 800;border-color: transparent;">
                            <option value="NP" <?= $selectOne ?>>Nomor Pengajuan</option>
                            <option value="RTU" <?= $selectTwo ?>>Range Tanggal Upload</option>
                            <option value="RTM" <?= $selectThree ?>>Range Tanggal Masuk</option>
                        </select>
                    </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- Nomor Pengajuan -->
                    <div id="form_NP" style="display: <?= $displayOne ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/search-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>BC 2.7 PLB (Nomor Pengajuan)</label>
                                            <input type="number" id="IDAJU_PLB" name="FindNoAJU" class="form-control" placeholder="BC 2.7 PLB (Nomor Pengajuan) ..." value="<?= $FindNoAJU; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_NP" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tanggal Upload -->
                    <div id="form_RTU" style="display: <?= $displayTwo ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Upload</label>
                                            <div class="input-group" id="default-daterange-upload">
                                                <input type="text" name="default-daterange-upload" class="form-control" value="<?= $Field_RTU ?>" placeholder="Pilih Range Tanggal Upload" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_RTU" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Range Tanggal Masuk -->
                    <div id="form_RTM" style="display: <?= $displayThree ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Masuk</label>
                                            <div class="input-group" id="default-daterange-masuk">
                                                <input type="text" name="default-daterange-masuk" class="form-control" value="<?= $Field_RTM ?>" placeholder="Pilih Range Tanggal Masuk" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_RTM" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
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
                    <?php if (isset($_POST["Find_NP"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                        <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                        <button type="submit" name="Find_NP" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                            <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                            <button type="submit" name="Find_NP" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_RTU"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                        <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                        <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                        <button type="submit" name="Find_RTU" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                            <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                            <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                            <button type="submit" name="Find_RTU" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_RTM"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_RTM" value="<?= $S_RTM ?>">
                                        <input type="hidden" name="E_RTM" value="<?= $E_RTM ?>">
                                        <input type="hidden" name="ShowField_RTM" value="<?= $ShowField_RTM ?>">
                                        <button type="submit" name="Find_RTM" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_RTM" value="<?= $S_RTM ?>">
                                            <input type="hidden" name="E_RTM" value="<?= $E_RTM ?>">
                                            <input type="hidden" name="ShowField_RTM" value="<?= $ShowField_RTM ?>">
                                            <button type="submit" name="Find_RTM" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <a href="report_masuk_barang_pdf.php" target="_blank" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</a>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="report_masuk_barang_excel.php" target="_blank" class="dropdown-item">Download as XLS</a>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
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
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN PEMASUKAN BARANG PER DOKUMEN
                            PABEAN</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            <?= $ShowFindNoAJU; ?>
                            <?= $ShowField_RTU; ?>
                            <?= $ShowField_RTM; ?>
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
                                    <th colspan="6" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah Satuan</th>
                                    <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal & Waktu Masuk</th>
                                    <th colspan="2" style="text-align: center;">Petugas Penerima</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Berita Acara</th>
                                </tr>
                                <tr>
                                    <th class="no-sort" style="text-align: center;">Jenis Dokumen</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">No. Daftar</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Tanggal Upload</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <th style="text-align: center;"><?= $resultSetting['company']; ?></th>
                                    <th style="text-align: center;">BeaCukai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["Find_NP"])) {
                                    $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND rcd.bm_no_aju_plb LIKE '%" . $FindNoAJU . "%'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                                } else if (isset($_POST["Find_RTU"])) {
                                    $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND sts.ck5_plb_submit BETWEEN '" . $S_RTU . "' AND '" . $E_RTU . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                                } else if (isset($_POST["Find_RTM"])) {
                                    $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND plb.TGL_CEK BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC LIMIT 100", 0);
                                }

                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td style="text-align: center">
                                                BC <?= $row['KODE_DOKUMEN_PABEAN']; ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <div style="width: 80px;">
                                                    <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['NOMOR_DAFTAR']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
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
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['PERUSAHAAN']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        </center>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG']; ?>
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
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_SATUAN']; ?></font>
                                                    <font><?= $row['JUMLAH_SATUAN']; ?></font>
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
                                                    <?php if ($row['TGL_CEK'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['TGL_CEK']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['OPERATOR_ONE']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php if ($row['bc_in'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['bc_in']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['upload_beritaAcara_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Belum diupload!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <a href="#detail<?= $row['rcd_id'] ?>" class="btn btn-sm btn-success" data-toggle="modal" title="Add">
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
                                        </tr>

                                        <!-- Detail -->
                                        <div class="modal fade" id="detail<?= $row['rcd_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Berita Acara] Laporan Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Pengajuan PLB</label>
                                                                        <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
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
                                        <!-- End Detail -->
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="14">
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
                            Laporan Barang Masuk | IT Inventory <?= $resultHeadSetting['company'] ?>
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
        $("#IDAJU_PLB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "NP") {
                $("#form_NP").show();
                $("#form_RTU").hide();
                $("#form_RTM").hide();
            } else if ($(this).val() == "RTU") {
                $("#form_NP").hide();
                $("#form_RTU").show();
                $("#form_RTM").hide();
            } else if ($(this).val() == "RTM") {
                $("#form_NP").hide();
                $("#form_RTU").hide();
                $("#form_RTM").show();
            } else {
                $("#form_NP").show();
                $("#form_RTU").hide();
                $("#form_RTM").hide();
            }
        });
    });
    var handleDateRangePicker = function() {
        // RANGE TANGGAL UPLOAD
        $('#default-daterange-upload').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RUFirst ?>',
            maxDate: '<?= $RULast ?>',
        }, function(start, end) {
            $('#default-daterange-upload input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
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
    };
</script>