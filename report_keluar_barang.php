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
$Field_RTM          = '';
$ShowFindNoAJU      = '';
$ShowField_RTM      = '';
$info_filter        = "100 Data Terakhir Barang Keluar";
$col                = "4";
$display            = "none";

// NP
if (isset($_POST["Find_NP"])) {
    $FindNoAJU      = $_POST['FindNoAJU'];
    $ShowFindNoAJU  = "Nomor Pengajuan: " . $_POST['FindNoAJU'];
    // OTHERS
    $info_filter    = "Data Berdasarkan Nomor Pengajuan";
    $col            = "2";
    $display        = "show";
}

// RTM
if (isset($_POST["Find_RTM"])) {
    $Field_RTM      = $_POST['default-daterange-keluar'];
    $Field_RTME     = explode(" - ", $Field_RTM);
    $RTMStart       = $Field_RTME[0];
    $RTMStart_T     = strtotime($RTMStart);
    $S_RTM          = date("Y-m-d", $RTMStart_T);
    $RTMEnd         = $Field_RTME[1];
    $RTMEnd_T       = strtotime($RTMEnd);
    $E_RTM          = date("Y-m-d", $RTMEnd_T);
    $ShowField_RTM  = "Tanggal Keluar: " . $_POST['default-daterange-keluar'];
    // OTHERS
    $info_filter    = "Data Berdasarkan Tgl. Brg. Keluar";
    $col            = "2";
    $display        = "show";
}

// START
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
    $tglMFirst              = substr($alldateKeluarFirst, 0, 10);
    $tglMFirstE             = explode("-", $tglMFirst);
    $RMFirst                = $tglMFirstE[1] . "/" . $tglMFirstE[2] . "/" . $tglMFirstE[0];
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
    $tglMLast               = substr($alldateKeluarLast, 0, 10);
    $tglMLastE              = explode("-", $tglMLast);
    $RMLast                 = $tglMLastE[1] . "/" . $tglMLastE[2] . "/" . $tglMLastE[0];
}
// END

if (isset($_POST['Find_NP']) != '') {
    $displayOne = 'show';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
} else if (isset($_POST['Find_RTM']) != '') {
    $displayOne = 'none';
    $displayThree = 'show';

    $selectOne = '';
    $selectThree = 'selected';
} else {
    $displayOne = 'show';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectThree = '';
}

// RINCIAN JUMLAH BARANG
$dataRincianBRG = $dbcon->query("SELECT COUNT(*) AS r_total_brg
                                FROM plb_barang AS brg 
                                LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'", 0);
$resultRincianBRG = mysqli_fetch_array($dataRincianBRG);
// RINCIAN CT
$dataRincianCT = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR) AS r_total_ct
                                FROM plb_barang AS brg 
                                LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'", 0);
$resultRincianCT = mysqli_fetch_array($dataRincianCT);
// RINCIAN TOTAL BOTOL
$dataRincianBTL = $dbcon->query("SELECT SUM(brg.TOTAL_BOTOL_AKHIR) AS r_total_btl
                                FROM plb_barang AS brg 
                                LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'", 0);
$resultRincianBTL = mysqli_fetch_array($dataRincianBTL);
// RINCIAN TOTAL LITER
$dataRincianLTR = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR) AS r_total_ltr
                                FROM plb_barang AS brg 
                                LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'", 0);
$resultRincianLTR = mysqli_fetch_array($dataRincianLTR);

if (isset($_POST["Find_NP"])) {
    // RINCIAN JUMLAH BARANG
    $dataRincianBRG_F = $dbcon->query("SELECT COUNT(*) AS r_total_brg
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND rcd.bk_no_aju_sarinah LIKE '%" . $FindNoAJU . "%'", 0);
    // RINCIAN CT
    $dataRincianCT_F = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR) AS r_total_ct
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND rcd.bk_no_aju_sarinah LIKE '%" . $FindNoAJU . "%'", 0);
    // RINCIAN TOTAL BOTOL
    $dataRincianBTL_F = $dbcon->query("SELECT SUM(brg.TOTAL_BOTOL_AKHIR) AS r_total_btl
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND rcd.bk_no_aju_sarinah LIKE '%" . $FindNoAJU . "%'", 0);
    // RINCIAN TOTAL LITER
    $dataRincianLTR_F = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR) AS r_total_ltr
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND rcd.bk_no_aju_sarinah LIKE '%" . $FindNoAJU . "%'", 0);
} else if (isset($_POST["Find_RTM"])) {
    // RINCIAN JUMLAH BARANG
    $dataRincianBRG_F = $dbcon->query("SELECT COUNT(*) AS r_total_brg,brg.TGL_CEK_GB
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND brg.TGL_CEK_GB BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'", 0);
    // RINCIAN CT
    $dataRincianCT_F = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR) AS r_total_ct,brg.TGL_CEK_GB
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND brg.TGL_CEK_GB BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'", 0);
    // RINCIAN TOTAL BOTOL
    $dataRincianBTL_F = $dbcon->query("SELECT SUM(brg.TOTAL_BOTOL_AKHIR) AS r_total_btl,brg.TGL_CEK_GB
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND brg.TGL_CEK_GB BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'", 0);
    // RINCIAN TOTAL LITER
    $dataRincianLTR_F = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR) AS r_total_ltr,brg.TGL_CEK_GB
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                            AND brg.TGL_CEK_GB BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'", 0);
} else {
    // RINCIAN JUMLAH BARANG
    $dataRincianBRG_F = $dbcon->query("SELECT COUNT(*) AS r_total_brg
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai' LIMIT 100", 0);
    // RINCIAN CT
    $dataRincianCT_F = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR) AS r_total_ct
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai' LIMIT 100", 0);
    // RINCIAN TOTAL BOTOL
    $dataRincianBTL_F = $dbcon->query("SELECT SUM(brg.TOTAL_BOTOL_AKHIR) AS r_total_btl
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai' LIMIT 100", 0);
    // RINCIAN TOTAL LITER
    $dataRincianLTR_F = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR) AS r_total_ltr
                            FROM plb_barang AS brg 
                            LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb
                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                            AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai' LIMIT 100", 0);
}
// RINCIAN JUMLAH BARANG
$resultRincianBRG_F = mysqli_fetch_array($dataRincianBRG_F);
// RINCIAN CT
$resultRincianCT_F = mysqli_fetch_array($dataRincianCT_F);
// RINCIAN TOTAL BOTOL
$resultRincianBTL_F = mysqli_fetch_array($dataRincianBTL_F);
// RINCIAN TOTAL LITER
$resultRincianLTR_F = mysqli_fetch_array($dataRincianLTR_F);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Barang Keluar App Name | Company </title>
<?php } else { ?>
    <title>Laporan Barang Keluar - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-circle-up icon-page"></i>
                <font class="text-page">Laporan Barang Keluar</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Barang Keluar</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-8">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Keluar Barang Berdasarkan
                        <select name="Filter" id="input-filter" style="background: #202124;color: #fff;font-weight: 800;border-color: transparent;">
                            <option value="NP" <?= $selectOne ?>>Nomor Pengajuan</option>
                            <option value="RTM" <?= $selectThree ?>>Range Tanggal Keluar</option>
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
                                    <img src="assets/img/svg/search-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 57%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>BC 2.7 GB (Nomor Pengajuan)</label>
                                            <input type="number" id="IDAJU_PLB" name="FindNoAJU" class="form-control" placeholder="BC 2.7 GB (Nomor Pengajuan) ..." value="<?= $FindNoAJU; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_NP" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_keluar_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Range Tanggal Keluar -->
                    <div id="form_RTM" style="display: <?= $displayThree ?>;">
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
                                                <input type="text" name="default-daterange-keluar" class="form-control" value="<?= $Field_RTM ?>" placeholder="Pilih Range Tanggal Keluar" />
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
                                        <a href="report_keluar_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
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
        <div class="col-xl-<?= $col ?>">
            <div class="panel-body text-inverse">
                <div class="card border-0 bg-dark-darker text-white mb-3">
                    <div class="card-body">
                        <div class="mb-3 text-grey">
                            <b>LAPORAN DATA BARANG KELUAR</b>
                            <span class="text-grey ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Laporan Data Barang Keluar <?= $resultSetting['app_name'] ?> - <?= $resultSetting['company'] ?>"></i></span>
                        </div>
                        <h3 class="m-b-10"><i class="fas fa-check-circle"></i> <span data-animation="number" data-value="<?= $resultRincianBRG['r_total_brg']; ?>">0.00</span> Brg. Keluar</h3>
                        <div class="text-grey m-b-1"><i class="fa fa-calendar"></i> <?= date_indo_s(date('Y-m-d'), TRUE); ?></div>
                    </div>
                    <div class="widget-list widget-list-rounded inverse-mode">
                        <a href="#" class="widget-list-item rounded-0 p-t-3" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-box-open bg-warning text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Carton</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= $resultRincianCT['r_total_ct']; ?>">0.00</span>
                            </div>
                        </a>
                        <a href="#" class="widget-list-item" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-wine-bottle bg-blue text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Botol</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= $resultRincianBTL['r_total_btl']; ?>">0.00</span>
                            </div>
                        </a>
                        <a href="#" class="widget-list-item" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-tint bg-aqua text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Liter</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= round($resultRincianLTR['r_total_ltr']); ?>">0.00</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2" style="display:<?= $display ?>">
            <div class="panel-body text-inverse">
                <div class="card border-0 bg-dark-darker text-white mb-3">
                    <div class="card-body">
                        <div class="mb-3 text-grey">
                            <b>HASIL FILTER LAP. DATA BRG. KELUAR</b>
                            <span class="text-grey ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hasil Filter Laporan Data Barang Keluar <?= $resultSetting['app_name'] ?> - <?= $resultSetting['company'] ?>"></i></span>
                        </div>
                        <h3 class="m-b-10"><i class="fas fa-filter"></i> <span data-animation="number" data-value="<?= $resultRincianBRG_F['r_total_brg']; ?>">0.00</span> Brg. Keluar</h3>
                        <div class="text-grey m-b-1"><i class="fab fa-creative-commons-nd"></i> <?= $info_filter ?></div>
                    </div>
                    <div class="widget-list widget-list-rounded inverse-mode">
                        <a href="#" class="widget-list-item rounded-0 p-t-3" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-box-open bg-warning text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Carton</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= $resultRincianCT_F['r_total_ct']; ?>">0.00</span>
                            </div>
                        </a>
                        <a href="#" class="widget-list-item" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-wine-bottle bg-blue text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Botol</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= $resultRincianBTL_F['r_total_btl']; ?>">0.00</span>
                            </div>
                        </a>
                        <a href="#" class="widget-list-item" style="background: #fff;color:#202124;">
                            <div class="widget-list-media icon">
                                <i class="fas fa-tint bg-aqua text-white"></i>
                            </div>
                            <div class="widget-list-content">
                                <div class="widget-list-title text-black">Liter</div>
                            </div>
                            <div class="widget-list-action text-nowrap text-black">
                                <span data-animation="number" data-value="<?= round($resultRincianLTR_F['r_total_ltr']); ?>">0.00</span>
                            </div>
                        </a>
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
                                    <form action="report_keluar_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                        <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                        <button type="submit" name="Find_NP" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_keluar_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                            <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                            <button type="submit" name="Find_NP" class="dropdown-item">Download as XLS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_RTM"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_keluar_barang_pdf.php" target="_blank" method="POST">
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
                                        <form action="report_keluar_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_RTM" value="<?= $S_RTM ?>">
                                            <input type="hidden" name="E_RTM" value="<?= $E_RTM ?>">
                                            <input type="hidden" name="ShowField_RTM" value="<?= $ShowField_RTM ?>">
                                            <button type="submit" name="Find_RTM" class="dropdown-item">Download as XLS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <a href="report_keluar_barang_pdf.php" target="_blank" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</a>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="report_keluar_barang_excel.php" target="_blank" class="dropdown-item">Download as XLS</a>
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
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN PENGELUARAN BARANG PER DOKUMEN PABEAN</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            <?= $ShowFindNoAJU; ?>
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
                                    <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 GB</th>
                                    <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
                                    <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal<font style="color: #dadddf;">.</font>&<font style="color: #dadddf;">.</font>Waktu<font style="color: #dadddf;">.</font>Keluar</th>
                                    <th colspan="2" style="text-align: center;">Petugas</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Berita Acara</th>
                                </tr>
                                <tr>
                                    <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
                                    <th style="text-align: center;">Nomor<font style="color: #dadddf;">.</font>Pengajuan</th>
                                    <th style="text-align: center;">No.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <th style="text-align: center;"><?= $resultSetting['company']; ?></th>
                                    <th style="text-align: center;">BeaCukai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["Find_NP"])) {
                                    $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN tpb_header AS hdr ON rcd.bk_no_aju_sarinah=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND plb.STATUS_GB='Sesuai'
                                                            AND rcd.bk_no_aju_sarinah LIKE '%" . $FindNoAJU . "%'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK_GB DESC", 0);
                                } else if (isset($_POST["Find_RTM"])) {
                                    $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN tpb_header AS hdr ON rcd.bk_no_aju_sarinah=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND plb.STATUS_GB='Sesuai'
                                                            AND plb.TGL_CEK_GB BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK_GB DESC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN tpb_header AS hdr ON rcd.bk_no_aju_sarinah=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND plb.STATUS_GB='Sesuai'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK_GB DESC LIMIT 100", 0);
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
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <div style="width: 80px;">
                                                    <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= $row['NOMOR_DAFTAR']; ?>
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
                                                    <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                        <center>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
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
                                                    <font><?= $row['CIF_BRG']; ?></font>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?php
                                                    $alldateM = $row['TGL_CEK_GB'];
                                                    $tglM = substr($alldateM, 0, 10);
                                                    $timeM = substr($alldateM, 10, 20);
                                                    ?>
                                                    <?php if ($row['TGL_CEK_GB'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?= date_indo_s($tglM); ?> <?= $timeM; ?>
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
                                                            <h4 class="modal-title">[Berita Acara] Laporan Barang Keluar</h4>
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
                                                                        <label>Tanggal Keluar Barang</label>
                                                                        <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_tgl_keluar']; ?>" readonly>
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
                                        <!-- End Detail -->
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="15">
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
                            Laporan Barang Keluar | <?= $resultHeadSetting['app_name'] ?> <?= $resultHeadSetting['company'] ?>
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
            source: 'function/autocomplete/nomor_aju_gb.php'
        });
    });
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "NP") {
                $("#form_NP").show();
                $("#form_RTM").hide();
            } else if ($(this).val() == "RTM") {
                $("#form_NP").hide();
                $("#form_RTM").show();
            } else {
                $("#form_NP").show();
                $("#form_RTM").hide();
            }
        });
    });
    var handleDateRangePicker = function() {
        // RANGE TANGGAL KELUAR
        $('#default-daterange-keluar').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RMFirst ?>',
            maxDate: '<?= $RMLast ?>',
        }, function(start, end) {
            $('#default-daterange-keluar input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
    };
</script>